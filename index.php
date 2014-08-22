<?php

define('SAML_INTERNAL', 1);
$valid_saml_session = false;
$saml_attributes = false;

    // In order to avoid session problems we first do the SAML issues and then
    // we log in and register the attributes of user

    try{
        // We read saml parameters from a config file instead from the database
        // due we can not operate with the moodle database without load all
        // moodle session issue.
        include_once(dirname(__FILE__) .'/simplesamlphp/lib/_autoload.php');
        $as = new SimpleSAML_Auth_Simple('default-sp');

        if(isset($_GET["logout"])) {
            if(isset($_SERVER['SCRIPT_URI'])) {
                $urltogo = $_SERVER['SCRIPT_URI'];
                $urltogo = str_replace('auth/saml/index.php', '', $urltogo);
            }
            else if(isset($_SERVER['HTTP_REFERER'])) {
                $urltogo = $_SERVER['HTTP_REFERER'];
            }
            else{
                $urltogo = '/';
            }

            if($saml_param->dosinglelogout) {
                $as->logout($urltogo);
                assert("FALSE"); // The previous line issues a redirect
            } else {
                header('Location: '.$urltogo);
                exit();
            }
        }

        $as->requireAuth();
        $valid_saml_session = $as->isAuthenticated();
        $saml_attributes = $as->getAttributes();

    } catch (Exception $e) {
        session_write_close();
        var_dump($e->getMessage());
        //redirect( new moodle_url('/'), $e->getMessage(),2);
    }

    // Now we close simpleSAMLphp session
    session_write_close();
    require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
    global $SESSION, $DB, $CFG, $USER, $OUTPUT;

    // Get the plugin config for saml
    if (!$valid_saml_session) {
	    // Not valid session. Ship user off to Identity Provider
        unset($USER);
        try {
            $as = new SimpleSAML_Auth_Simple('default-sp');
            $as->requireAuth();

        } catch (Exception $e) {
            redirect( new moodle_url('/'), $e->getMessage(),2);
        }

    } else {
        $SESSION->valid_saml_session = $valid_saml_session;
        $SESSION->saml_attributes = $saml_attributes;
        if(!isloggedin() || isguestuser()){

            if(is_enabled_auth('saml')){

                $samlauth = get_auth_plugin('saml');

                $status = $samlauth->authenticate($SESSION->saml_attributes[$samlauth->config->username][0]);
                if($status == 200){
                    if (user_not_fully_set_up($USER)) {
                        $urltogo = $CFG->wwwroot.'/user/edit.php?id='.$USER->id.'&amp;course='.SITEID;
                        // We don't delete $SESSION->wantsurl yet, so we get there later

                    } else if (isset($SESSION->wantsurl) and (strpos($SESSION->wantsurl, $CFG->wwwroot) === 0)) {
                        $urltogo = $SESSION->wantsurl;    /// Because it's an address in this site
                        unset($SESSION->wantsurl);

                    } else {
                        $urltogo = $CFG->wwwroot.'/';      /// Go to the standard home page
                        unset($SESSION->wantsurl);         /// Just in case
                    }

                    /// Go to my-moodle page instead of homepage if defaulthomepage enabled
                    if (!has_capability('moodle/site:config',context_system::instance()) and !empty($CFG->defaulthomepage) && $CFG->defaulthomepage == HOMEPAGE_MY and !isguestuser()) {
                        if ($urltogo == $CFG->wwwroot or $urltogo == $CFG->wwwroot.'/' or $urltogo == $CFG->wwwroot.'/index.php') {
                            $urltogo = $CFG->wwwroot.'/my/';
                        }
                    }
                    redirect($urltogo);
                } else {

                    $SITE = get_site();
                    $PAGE->set_context(context_system::instance());
                    $PAGE->set_pagelayout('standard');
                    $PAGE->set_url('/auth/saml/index.php');
                    $PAGE->requires->css('/auth/saml/style.css');
                    $PAGE->navbar->add(get_string('pluginname' , 'auth_saml'));
                    $PAGE->set_title(get_string('pluginname' , 'auth_saml'));
                    $PAGE->set_heading(get_string('pluginname' , 'auth_saml'));
                    $PAGE->requires->css('/auth/saml/style.css');
                    echo $OUTPUT->header();
                    echo $OUTPUT->box_start('auth-error');

                    echo  html_writer::empty_tag('img', array('src' => $OUTPUT->pix_url('salesforce','auth_saml'), 'class' => 'saleforce-logo'));
                    echo $OUTPUT->heading(get_string('status_'. $status , 'auth_saml'), 3, 'title');
                    echo get_string('status_'. $status . '_desc' , 'auth_saml');
                    echo $OUTPUT->continue_button(new moodle_url('/login/index.php'));
                    echo $OUTPUT->box_end();
                    echo $OUTPUT->footer();
                }
            } else {
                unset($SESSION->wantsurl);
                redirect($CFG->wwwroot.'/'); //E.T go Home!!
            }
        } else {

            redirect($CFG->wwwroot.'/');
        }
    }