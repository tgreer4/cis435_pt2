<?php
// database hostname - you don't usually need to change this
define('db_host','localhost');
// database username
define('db_user','root');
// database password
define('db_pass','');
// database name
define('db_name','phplogin');
// database charset - change this only if utf8 is unsupported by your language
define('db_charset','utf8');
/* Registration */
define('auto_login_after_register',false);
/* Account Activation */
// Email activation variables
// account activation required?
define('account_activation',false);
// Change "Your Company Name" and "yourdomain.com" - do not remove the < and > characters
define('mail_from','Your Company Name <noreply@yourdomain.com>');
// Link to activation file
define('activation_link','http://yourdomain.com/phplogin/activate.php');
?>