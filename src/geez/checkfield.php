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
include_once(mnminclude.'smartyvariables.php');

$type=sanitize($_REQUEST['type'], 2);
$name=sanitize($_GET["name"], 2);

switch ($type) {
	case 'username':
		if (strlen($name)<3) { // if username is less than 3 characters
			echo $main_smarty->get_config_vars("PLIGG_Visual_CheckField_UserShort");
			return;
		}
		if (!preg_match('/^[a-zA-Z0-9_\-]+$/i', $name)) { // if username contains invalid characters
			echo $main_smarty->get_config_vars("PLIGG_Visual_CheckField_InvalidChars");
			return;
		}
		if(user_exists($name)) { // if username already exists
			echo $main_smarty->get_config_vars("PLIGG_Visual_CheckField_UserExists");
			return;
		}
		echo "OK";
		break;
	case 'email':
		if (!check_email($name)) { // if email contains invald characters
			echo $main_smarty->get_config_vars("PLIGG_Visual_CheckField_EmailInvalid");
			return;
		}
		if(email_exists($name)) { // if email already exists
			echo $main_smarty->get_config_vars("PLIGG_Visual_CheckField_EmailExists");
			return;
		}
		echo "OK";
		break;
	default:
		echo "KO $type";
}
?>