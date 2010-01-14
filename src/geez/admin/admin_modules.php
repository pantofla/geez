<?php
// The source code packaged with this file is Free Software, Copyright (C) 2005 by
// Ricardo Galli <gallir at uib dot es>.
// It's licensed under the AFFERO GENERAL PUBLIC LICENSE unless stated otherwise.
// You can get copies of the licenses here:
// http://www.affero.org/oagpl.html
// AFFERO GENERAL PUBLIC LICENSE is also included in the file called "COPYING".

include_once('../Smarty.class.php');
$main_smarty = new Smarty;

include('../config.php');
include(mnminclude.'html1.php');
include(mnminclude.'smartyvariables.php');

force_authentication();

$canIhaveAccess = 0;
$canIhaveAccess = $canIhaveAccess + checklevel('god');

if($canIhaveAccess == 0){	
	$main_smarty->assign('tpl_center', '/admin/admin_access_denied');
	$main_smarty->display($template_dir . '/admin/admin.tpl');		
	die();
}

// pagename
define('pagename', 'admin_modules'); 
$main_smarty->assign('pagename', pagename);


// breadcrumbs and page title
$navwhere['text1'] = $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel');
$navwhere['link1'] = getmyurl('admin', '');
$navwhere['text2'] = $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel_6');
$main_smarty->assign('navbar_where', $navwhere);
$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel_6'));

// sidebar
$main_smarty = do_sidebar($main_smarty);


if($canIhaveAccess == 1){	
	$main_smarty->assign('tpl_center', '/admin/admin_modules_center');
	$output = $main_smarty->fetch($template_dir . '/admin/admin.tpl');		

	if (!function_exists('clear_module_cache')) {
		echo "Your template is not compatible with this version of Pligg. Missing the 'clear_modules_cache' function in admin_modules_center.tpl.";
	} else {
		echo $output;
	}

}
?>
