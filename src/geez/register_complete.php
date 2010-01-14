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

$user=$_GET['user'];

$usr = new User();
$usr->username = $user;
if ($usr->read()){
	$email = $usr->email;
}

$main_smarty->assign('thank_reg', "Thank you for registering <strong>$user</strong>!<br />");
$main_smarty->assign('email_check', "Please check your e-mail (inbox & spam/junk folder) for activation link.<br />");
	
$main_smarty->assign('tpl_center', $the_template . '/register_step_1');
$main_smarty->display($the_template . '/pligg.tpl');
?>