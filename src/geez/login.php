<?php
// The source code packaged with this file is Free Software, Copyright (C) 2005 by
// Ricardo Galli <gallir at uib dot es>.
// It's licensed under the AFFERO GENERAL PUBLIC LICENSE unless stated otherwise.
// You can get copies of the licenses here:
// 		http://www.affero.org/oagpl.html
// AFFERO GENERAL PUBLIC LICENSE is also included in the file called "COPYING".

include_once('Smarty.class.php');
$main_smarty = new Smarty;

include('config.php');
include(mnminclude.'html1.php');
include(mnminclude.'link.php');
include(mnminclude.'smartyvariables.php');

// breadcrumbs and page title
$navwhere['text1'] = $main_smarty->get_config_vars('PLIGG_Visual_Breadcrumb_Login');
$navwhere['link1'] = getmyurl('loginNoVar', '');
$main_smarty->assign('navbar_where', $navwhere);
$main_smarty->assign('posttitle', $main_smarty->get_config_vars('PLIGG_Visual_Breadcrumb_Login'));

// sidebar
$main_smarty = do_sidebar($main_smarty);

// initialize error message variable
$errorMsg="";

// if user requests to logout
if(isset($_GET["op"])){
	if(sanitize($_GET["op"], 3) == 'logout') {
		$current_user->Logout(sanitize($_GET['return'], 3));
	}
}

// if user tries to log in
if( (isset($_POST["processlogin"]) && is_numeric($_POST["processlogin"])) || (isset($_GET["processlogin"]) && is_numeric($_GET["processlogin"])) ){
	if($_POST["processlogin"] == 1) { // users logs in with username and password
		$username = sanitize(trim($_POST['username']), 3);
		$password = sanitize(trim($_POST['password']), 3);
		if(isset($_POST['persistent'])){$persistent = sanitize($_POST['persistent'], 3);}else{$persistent = '';}
		if($current_user->Authenticate($username, $password, $persistent) == false) {
			$errorMsg=$main_smarty->get_config_vars('PLIGG_Visual_Login_Error');
		} else {
			if(strlen(sanitize($_POST['return'], 3)) > 1) {
				$return = sanitize($_POST['return'], 3);
			} else {
				$return =  my_pligg_base.'/';
			}
			
			define('logindetails', $username . ";" . $password . ";" . $return);

			$vars = '';
			check_actions('login_success_pre_redirect', $vars);

			if(strpos($_SERVER['SERVER_SOFTWARE'], "IIS") && strpos(php_sapi_name(), "cgi") >= 0){
				echo '<SCRIPT LANGUAGE="JavaScript">window.location="' . $return . '";</script>';
				echo $main_smarty->get_config_vars('PLIGG_Visual_IIS_Logged_In') . '<a href = "'.$return.'">' . $main_smarty->get_config_vars('PLIGG_Visual_IIS_Continue') . '</a>';
			} else {
				header('Location: '.$return);
			}
			die;
		}
	}

	if($_POST["processlogin"] == 3) { // if user requests forgotten password
		$email = sanitize($db->escape(trim($_POST['email'])),4);
		$user = $db->get_row("SELECT * FROM `" . table_users . "` where `user_email` = '".$email."'");
		if($user){
			$username = $user->user_login;
			$salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
			$saltedlogin = generateHash($user->user_login);

			$to = $user->user_email;
			$subject = $main_smarty->get_config_vars("PLIGG_PassEmail_Subject");
			$body = $main_smarty->get_config_vars("PLIGG_PassEmail_Body") . $my_base_url . $my_pligg_base . '/login.php?processlogin=4&username=' . $username . '&confirmationcode=' . $saltedlogin;
			$headers = 'From: ' . $main_smarty->get_config_vars("PLIGG_PassEmail_From") . "\r\n";


			if(time() - strtotime($user->last_reset_request) > $main_smarty->get_config_vars("PLIGG_PassEmail_LimitPerSecond")){
				if (mail($to, $subject, $body, $headers))
				{
					$main_smarty->assign('user_login', $user->user_login);
					$main_smarty->assign('profile_url', getmyurl('profile'));
					$main_smarty->assign('login_url', getmyurl('loginNoVar'));

					$errorMsg = $main_smarty->get_config_vars("PLIGG_PassEmail_SendSuccess");

					$db->query('UPDATE `' . table_users . '` SET `last_reset_code` = "'. $saltedlogin . '" WHERE `user_login` = "'.$username.'"');
					$db->query('UPDATE `' . table_users . '` SET `last_reset_request` = FROM_UNIXTIME('.time().') WHERE `user_login` = "'.$username.'"');
					
					define('pagename', 'login'); 
					$main_smarty->assign('pagename', pagename);
					$errorMsg = $main_smarty->get_config_vars('PLIGG_Visual_Password_Sent');
				}
				else
				{
					$errorMsg = $main_smarty->get_config_vars('PLIGG_Visual_Login_Delivery_Failed');
				}
			}
			else{
				$errorMsg = $main_smarty->get_config_vars("PLIGG_PassEmail_LimitPerSecond_Message");
			}
		}
		else{
			$errorMsg = $main_smarty->get_config_vars('PLIGG_Visual_Password_Sent');
		}
	}

	if($_GET["processlogin"] == 4) { // if user clicks on the forgotten password confirmation code
		// DB 08/01/08
		$username = sanitize(sanitize(trim($_GET['username']), 3), 4);
		/////
		if(strlen($username) == 0){
			$errorMsg = $main_smarty->get_config_vars("PLIGG_Visual_Login_Forgot_Error");
		}
		else {
			$confirmationcode = sanitize($_GET["confirmationcode"], 3);
			$DBconf = $db->get_var("SELECT `last_reset_code` FROM `" . table_users . "` where `user_login` = '".$username."'");
			if($DBconf){
				if($DBconf == $confirmationcode && !empty($confirmationcode)){
					$db->query('UPDATE `' . table_users . '` SET `last_reset_code` = "" WHERE `user_login` = "'.$username.'"');
					$db->query('UPDATE `' . table_users . '` SET `user_pass` = "033700e5a7759d0663e33b18d6ca0dc2b572c20031b575750" WHERE `user_login` = "'.$username.'"');
					$errorMsg = $main_smarty->get_config_vars('PLIGG_Visual_Login_Forgot_PassReset');
				}	else {
					$errorMsg = $main_smarty->get_config_vars('PLIGG_Visual_Login_Forgot_ErrorBadCode');
				}
			} else {
				$errorMsg = $main_smarty->get_config_vars('PLIGG_Visual_Login_Forgot_ErrorBadCode');
			} 
		}
	}
}   
    
// pagename
define('pagename', 'login'); 
$main_smarty->assign('pagename', pagename);
 
// misc smarty 
$main_smarty->assign('errorMsg',$errorMsg);  
$main_smarty->assign('register_url', getmyurl('register'));

// show the template
$main_smarty->assign('tpl_center', $the_template . '/login_center');
$main_smarty->display($the_template . '/pligg.tpl');

?>
