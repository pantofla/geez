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
include(mnminclude.'user.php');
include(mnminclude.'csrf.php');
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

	$randkey = rand(1000000,100000000);
	$main_smarty->assign('randkey', $randkey);
	
// pagename	
define('pagename', 'edit_page'); 
$main_smarty->assign('pagename', pagename);
if(isset($_REQUEST['link_id'])){
	if(is_numeric($_REQUEST['link_id'])){
		$link_id=$_REQUEST['link_id'];
		if($link_id){
			global $db;
			$sql = (" SELECT * from ".table_links." where link_id='$link_id'");
			$page_id=$db->get_results($sql);
			foreach($page_id as $page_results){
				$main_smarty->assign('page_title' , $page_results->link_title);
				$main_smarty->assign('page_content' , $page_results->link_content);
			}
			$main_smarty->assign('link_id' , $link_id);
		}
	}
}
if($_REQUEST['process']=='edit_page'){
	global $current_user,$db;
   $page_title=makeUrlFriendly($db->escape(trim($_REQUEST['page_title'])));
   $page_content=$db->escape(trim($_REQUEST['page_content']));
   $page_randkey=$db->escape(trim($_REQUEST['randkey']));
   if(isset($_REQUEST['link_id'])){
		if(is_numeric($_REQUEST['link_id'])){
			$link_id=$_REQUEST['link_id'];
			$sql = " UPDATE ".table_links." SET `link_modified` = NOW( ) , `link_title` = '$page_title', `link_content` = '$page_content' WHERE `link_id` =".$link_id." LIMIT 1 ";
			$result = @mysql_query ($sql); 
			if($result==1){
				header('Location: '.getmyurl("page", $page_title));
			}
		}
	}
  }
// show the template
$main_smarty->assign('tpl_center', '/admin/edit_page');
$main_smarty->display($template_dir . '/admin/admin.tpl');	

?>

