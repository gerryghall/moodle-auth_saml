<?php
/**
 * @author Erlend Strømsvik - Ny Media AS
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package auth/saml
 * @version 1.0
 *
 * Authentication Plugin: SAML based SSO Authentication
 *
 * Authentication using SAML2 with SimpleSAMLphp.
 *
 * Based on plugins made by Sergio Gómez (moodle_ssp) and Martin Dougiamas (Shibboleth).
 *
 * 2008-10  Created
 * 2009-07  added new configuration options.  Tightened up the session handling
**/

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); //  It must be included from a Moodle page
}

require_once($CFG->libdir.'/authlib.php');

/**
 * SimpleSAML authentication plugin.
**/
class auth_plugin_saml extends auth_plugin_base {

    /**
    * Constructor.
    */
    function auth_plugin_saml() {
		$this->authtype = 'saml';
		$this->config = get_config('auth/saml');
    }

    /**
    * Returns true if the username and password work and false if they are
    * wrong or don't exist.
    *
    * @param string $username The username (with system magic quotes)
    * @param string $password The password (with system magic quotes)
    * @return bool Authentication success or failure.
    */
    function user_login($username, $password) {
	    global $SESSION;

	    if(isset($SESSION->saml_login) && $SESSION->saml_login) {

            if($this->authenticate($SESSION->saml_attributes[$this->config->username][0]) == 200){
                return TRUE;
            }
	    }

	    return FALSE;
    }

    /**
    * Returns the user information for 'external' users. In this case the
    * attributes provided by Identity Provider
    *
    * @return array $result Associative array of user data
    */
    function get_userinfo($username) {
        global $SESSION;
	    if($login_attributes = $SESSION->saml_login_attributes) {
	        $attributemap = $this->get_attributes();
	        $result = array();

	        foreach ($attributemap as $key => $value) {
		        if(isset($login_attributes[$value]) && $attribute = $login_attributes[$value][0]) {
		            $result[$key] = $attribute;
		        } else {
		            $result[$key] = '';
		        }
	        }
	        unset($SESSION->saml_login_attributes);

	        $result["username"] = $username;
	        return $result;
	    }

	    return FALSE;
    }

    public function authenticate($saml_username){
        global $CFG, $DB;

        if($username = $DB->get_field('user', 'username', array($this->config->local_user => $saml_username))){

            if($user = get_complete_user_data('username', $username)){

                if (!empty($user->suspended)) {
                    return $this->auth_error(120,$username);
                }
                // is the user disabled 'nologin' is a moodle auth plugin that is used to prevent login
                // and it the use soft deleted
                if ($user->auth=='nologin' or $user->deleted) {
                    return $this->auth_error(120,$username);
                }
                // this just should not happen but lets check anyway
                if (empty($user->auth)) {             // For some reason auth isn't set yet
                    $DB->set_field('user', 'auth', $this->authtype, array('username'=>$username));
                    $user->auth = $this->authtype;
                }
                // last and final is the user a raven authenticating use in moodle
                if($user->auth !== $this->authtype){
                    return $this->auth_error(130,$username);
                }
                // at this point all validation as passed complete the user session are return 200 (as raven does)
                complete_user_login($user);
                return 200;
            } else {
                return $this->auth_error(100,$saml_username);
            }

        }
    }

    protected function auth_error($status , $user, $description = ''){
        global $CFG;
        try{
            $description = (!empty($description)) ? $description : get_string('status_' . $status , 'auth_saml');
            add_to_log(SITEID, 'Raven',$status , 'index.php', $description);
            error_log('[client '.getremoteaddr()."]  $CFG->wwwroot  $description  : $user  ".$_SERVER['HTTP_USER_AGENT']);
        }catch (Exception $e){
            // maybe moodle can't log let just continue
        }
        return $status;

    }


    /*
    * Returns array containg attribute mappings between Moodle and Identity Provider.
    */
    function get_attributes() {
	    $configarray = (array) $this->config;

        if(isset($configarray->userfields)) {
            $fields = $configarray->userfields;
        }
        else {
        	$fields = array("firstname", "lastname", "email", "phone1", "phone2",
			    "department", "address", "city", "country", "description",
			    "idnumber", "lang", "guid");
        }

	    $moodleattributes = array();
	    foreach ($fields as $field) {
	        if (isset($configarray["field_map_$field"])) {
		        $moodleattributes[$field] = $configarray["field_map_$field"];
	        }
	    }

	    return $moodleattributes;
    }

    /**
    * Returns true if this authentication plugin is 'internal'.
    *
    * @return bool
    */
    function is_internal() {
	    return false;
    }

    /**
    * Returns true if this authentication plugin can change the user's
    * password.
    *
    * @return bool
    */
    function can_change_password() {
	    return false;
    }

    function loginpage_hook() {

	    global $CFG;

	    // Prevent username from being shown on login page after logout
	    $CFG->nolastloggedin = true;
	    $GLOBALS['CFG']->nolastloggedin = true;
    }

    function logoutpage_hook() {
	        set_moodle_cookie('nobody');
	        require_logout();
	        redirect($GLOBALS['CFG']->wwwroot.'/auth/saml/logout.php');

    }


    function loginpage_idp_list($wantsurl) {
        global $CFG;
        $raven = array();
        $raven[] =  array(
            'url'   => new moodle_url('/auth/saml/index.php'),
            'icon'  => new pix_icon('salesforce','salesforce', 'auth_saml'),
            'name'  =>''
        );
        return $raven;
    }

    /**
    * Prints a form for configuring this authentication plugin.
    *
    * This function is called from admin/auth.php, and outputs a full page with
    * a form for configuring this plugin.
    *
    * @param array $page An object containing all the data for this page.
    */

    function config_form($config, $err, $user_fields) {
	    global $CFG, $DB;
	    require_once (dirname(__FILE__) . '/config.html');
    }

    /**
     * A chance to validate form data, and last chance to
     * do stuff before it is inserted in config_plugin
     */
    function validate_form($form, &$err) {


    }

    /**
    * Processes and stores configuration data for this authentication plugin.
    *
    *
    * @param object $config Configuration object
    */
    function process_config($config) {

        // set to defaults if undefined
	    if (!isset ($config->sp_source)) {
            $config->sp_source = 'saml';
	    }

	    if (!isset ($config->dosinglelogout)) {
            $config->dosinglelogout = false;
	    }
        if (!isset ($config->local_user)) {
            $config->local_user = 'username';
        }

	    if (!isset ($config->username)) {
	        $config->username = 'eduPersonPrincipalName';
	    }
        //internal_mapping

	    set_config('sp_source',         $config->sp_source,	'auth/saml');
	    set_config('dosinglelogout',    $config->dosinglelogout,	'auth/saml');
	    set_config('username',	        $config->username,	'auth/saml');
        set_config('local_user',	    $config->local_user,	'auth/saml');

	    return true;
    }

}
