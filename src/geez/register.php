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
include_once(mnminclude.'user.php');

$vars = '';
check_actions('register_top', $vars);

$navwhere['text1'] = $main_smarty->get_config_vars('PLIGG_Visual_Breadcrumb_Register');
$navwhere['link1'] = getmyurl('register', '');
$main_smarty->assign('navbar_where', $navwhere);
$main_smarty->assign('posttitle', $main_smarty->get_config_vars('PLIGG_Visual_Breadcrumb_Register'));

// pagename
define('pagename', 'register'); 
$main_smarty->assign('pagename', pagename);

// sidebar
$main_smarty = do_sidebar($main_smarty);

$pligg_regfrom = isset($_POST["regfrom"]) && sanitize($_POST['regfrom'], 3) != '' ? sanitize($_POST['regfrom'], 3) : '';
if($pligg_regfrom != ''){

	$error = false;
	switch($pligg_regfrom){
		case 'full':
			$username = sanitize($_POST["reg_username"], 3);
			$email = sanitize($_POST["reg_email"], 3);
			$password = sanitize($_POST["reg_password"], 3);
			$password2 = sanitize($_POST["reg_password2"], 3);
			break;

		case 'sidebar':
			$username = sanitize($_POST["username"], 3);
			$email = sanitize($_POST["email"], 3);
			$password = sanitize($_POST["password"], 3);
			$password2 = sanitize($_POST["password2"], 3);	
			break;

	}

	if(isset($username)){$main_smarty->assign('reg_username', $username);}
	if(isset($email)){$main_smarty->assign('reg_email', $email);}
	if(isset($password)){$main_smarty->assign('reg_password', $password);}
	if(isset($password2)){$main_smarty->assign('reg_password2', $password2);}

	$error = register_check_errors($username, $email, $password, $password2);

	if($error == false){
		register_add_user($username, $email, $password, $password2);
	}

} else {

	$testing = false; // changing to true will populate the form with random variables for testing.
	if($testing == true){
		$main_smarty->assign('reg_username', mt_rand(1111111, 9999999));
		$main_smarty->assign('reg_email', mt_rand(1111111, 9999999) . '@test.com');
		$main_smarty->assign('reg_password', '12345');
		$main_smarty->assign('reg_password2', '12345');
	}

}

$vars = '';
check_actions('register_showform', $vars);

$main_smarty->assign('tpl_center', $the_template . '/register_center');
$main_smarty->display($the_template . '/pligg.tpl');

die();

function register_check_errors($username, $email, $password, $password2){

	global $main_smarty;

	if(!isset($username) || strlen($username) < 3) { // if no username was given or username is less than 3 characters
		$form_username_error[] = $main_smarty->get_config_vars('PLIGG_Visual_Register_Error_UserTooShort');
		$error = true;
	}	
	if(!preg_match('/^[a-zA-Z0-9\-]+$/', $username)) { // if username contains invalid characters
		$form_username_error[] = $main_smarty->get_config_vars('PLIGG_Visual_Register_Error_UserInvalid');
		$error = true;
	}
	if(user_exists(trim($username)) ) { // if username already exists
		$form_username_error[] = $main_smarty->get_config_vars('PLIGG_Visual_Register_Error_UserExists');
		$error = true;
	}
	if(!check_email(trim($email))) { // if email is not valid
		$form_email_error[] = $main_smarty->get_config_vars('PLIGG_Visual_Register_Error_BadEmail');
		$error = true;
	}
	if(email_exists(trim($email)) ) { // if email already exists
		$form_email_error[] = $main_smarty->get_config_vars('PLIGG_Visual_Register_Error_EmailExists');
		$error = true;
	}
	if(strlen($password) < 5 ) { // if password is less than 5 characters
		$form_password_error[] = $main_smarty->get_config_vars('PLIGG_Visual_Register_Error_FiveCharPass');
		$error = true;
	}
	if($password !== $password2) { // if both passwords do not match
		$form_password_error[] = $main_smarty->get_config_vars('PLIGG_Visual_Register_Error_NoPassMatch');
		$error = true;
	}	

	$vars = array('username' => $username);
	check_actions('register_check_errors', $vars);

	if($vars['error'] == true){
		$error = true;
	}

	$main_smarty->assign('form_username_error', $form_username_error);
	$main_smarty->assign('form_email_error', $form_email_error);
	$main_smarty->assign('form_password_error', $form_password_error);

	return $error;
}

function register_add_user($username, $email, $password, $password2){

	global $current_user;

	$user = new User();
	$user->username = $username;
	$user->pass = $password;
	$user->email = $email;
	if($user->Create()){

		$user->read('short');
		
		$registration_details = array(
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'id' => $user->id
		);
	
		check_actions('register_success_pre_redirect', $registration_details);

		$current_user->Authenticate($username, $password, false);
		echo pligg_validate();
		echo my_base_url.my_pligg_base.'/register_complete.php?user='.$username;
		if(pligg_validate() == 1){
			header('Location: '.my_base_url.my_pligg_base.'/register_complete.php?user='.$username);
		} else {
		    header('Location: ' . getmyurl('user', $username));
		}
	}

}
?>
