<?php

$string['pluginname']  = 'SAML Authentication';
$string['auth_samldescription'] = 'SSO Authentication using SimpleSAML';


$string['saml_sp_source'] = 'SimpleSAMLPHP SP source';
$string['saml_sp_source_description'] = 'Select the SP source you want to connect to moodle. (Sources are in /config/authsources.php).';
$string['saml_errorsp_source'] = "SimpleSAMLPHP sp source {\$a} is not correct";

$string['saml_db_reset_button'] = 'Reset values to factory settings';
$string['saml_db_reset_error'] = 'Error reseting the saml plugin values';


$string['saml_dosinglelogout'] = 'Single Log out';
$string['saml_dosinglelogout_description'] = 'Check it to enable the single logout. This will log out you from moodle, identity provider and all conected service providers';

$string['saml_username'] = 'SAML username ';
$string['saml_username_description'] = 'SAML attribute that is mapped to Moodle username - this defaults to eduPersonPrincipalName';
$string['saml_username_not_found'] = 'IdP returned a set of data that no contain the SAML username mapping field ({$a}). This field is required to login';
$string['saml_local_user'] = 'Local user field';
$string['saml_local_user_description'] = 'What field to use when mapping users with SAML for example if SAML username is email then you can map to moodle user email field';


$string['saml_button'] = 'Logging with Salesforce';

$string['status_100'] = 'Moodle user not found.';
$string['status_100_desc'] = 'Your salesforce username have not been recognised by Moodle. Please contact your help desk for further assistance.';
$string['status_110'] = 'Login attempt timed out.';
$string['status_110_desc'] = 'Try to login again, and if you still experience problems please contact the  help desk for further assistance.';
$string['status_130'] = 'Authentication method error';
$string['status_130_desc'] = 'Your user account  is not set up to login with Salesforce. You should try to login using the Manual login, or contact the Moodle helpdesk for further assistance.';
$string['status_120'] = 'Account Suspended';
$string['status_120_desc'] = 'Your account is currently suspended or disabled. Please contact the Moodle helpdesk.';

