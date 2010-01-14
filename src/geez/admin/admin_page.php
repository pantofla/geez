<?php
// The source code packaged with this file is Free Software, Copyright (C) 2005 by
// Ricardo Galli <gallir at uib dot es>.
// It's licensed under the AFFERO GENERAL PUBLIC LICENSE unless stated otherwise.
// You can get copies of the licenses here:
// 		http://www.affero.org/oagpl.html
// AFFERO GENERAL PUBLIC LICENSE is also included in the file called "COPYING".

include_once('../Smarty.class.php');
$main_smarty = new Smarty;

include('../config.php');
include(mnminclude.'html1.php');
include(mnminclude.'link.php');
include(mnminclude.'tags.php');
include(mnminclude.'smartyvariables.php');

// require user to log in
force_authentication();

// restrict access to god and admin only
$amIgod = 0;
$amIgod = $amIgod + checklevel('god');
$main_smarty->assign('amIgod', $amIgod);

$canIhaveAccess = 0;
$canIhaveAccess = $canIhaveAccess + checklevel('god');
$canIhaveAccess = $canIhaveAccess + checklevel('admin');

if($canIhaveAccess == 0){	
	$main_smarty->assign('tpl_center', '/admin/admin_access_denied');
	$main_smarty->display($template_dir . '/admin/admin.tpl');		
	die();
}

// misc smarty
$main_smarty->assign('isAdmin', $canIhaveAccess);

// sidebar
$main_smarty = do_sidebar($main_smarty);


// pagename
define('pagename', 'admin_page'); 
$main_smarty->assign('pagename', pagename);

global $db;

if(isset($_REQUEST['mode'])){
$mode = $_REQUEST['mode'];
	if(is_numeric($_REQUEST['link_id'])){
		$link_id = $_REQUEST['link_id'];
		if($mode=='delete' && is_numeric($link_id)){
			$db->query(" delete from ".table_links." where link_id=".$link_id);
			header("Location: ".my_pligg_base."/admin/admin_page.php");
		}
	}
}
$sql = (" SELECT * from ".table_links." where link_status='page'");

$page_id=$db->get_results($sql);
if($page_id){
	foreach($page_id as $page_results){
	$page_title .= '<tr><td><b><a href="'.getmyurl("page", $page_results->link_title).'" style="text-decoration:none;">'.$page_results->link_title.'</a></b></td><td><a href="'.$my_base_url.$my_pligg_base.'/admin/edit_page.php?link_id='.$page_results->link_id.'" style="text-decoration:none;" >edit</a></td><td><a href="'.$my_base_url.$my_pligg_base.'/admin/admin_page.php?link_id='.$page_results->link_id.'&mode=delete" style="text-decoration:none;" >delete</a></td></tr>';
	}
}
$page_text .= '<br/>';

$main_smarty->assign('page_title' , $page_title);
$main_smarty->assign('page_text' , $page_text);

// show the template
$main_smarty->assign('tpl_center', '/admin/admin_page');
$main_smarty->display($template_dir . '/admin/admin.tpl');
?>