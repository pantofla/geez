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
include(mnminclude.'comment.php');
include(mnminclude.'link.php');
include(mnminclude.'user.php');
include(mnminclude.'smartyvariables.php');
			
// require user to log in
force_authentication();

// restrict access to god only
$canIhaveAccess = 0;
$canIhaveAccess = $canIhaveAccess + checklevel('god');

if($canIhaveAccess == 0){	
	$main_smarty->assign('tpl_center', '/admin/admin_access_denied');
	$main_smarty->display($template_dir . '/admin/admin.tpl');		
	die();
}

// sidebar
$main_smarty = do_sidebar($main_smarty);

if($canIhaveAccess == 1) {
	global $offset;
	
	// Items per page drop-down
	if(isset($_GET["pagesize"]) && is_numeric($_GET["pagesize"])) {
		misc_data_update('pagesize',$_GET["pagesize"]);
	}
	$pagesize = get_misc_data('pagesize');
	if ($pagesize <= 0) $pagesize = 30;
	$main_smarty->assign('pagesize', $pagesize);

	// figure out what "page" of the results we're on
	$offset=(get_current_page()-1)*$pagesize;
	
	// if user is searching
	if(isset($_GET["mode"]) && sanitize($_GET["mode"], 3) == "search"){
		$filtered = $db->get_results("SELECT * FROM " . table_comments . " WHERE comment_content LIKE '%".sanitize($_GET["keyword"], 3)."%' ORDER BY comment_date DESC LIMIT $offset,$pagesize");
		$rows = $db->get_var("SELECT count(*) FROM " . table_comments . " WHERE comment_content LIKE '%".sanitize($_GET["keyword"], 3)."%'");		
	}
	else {
		$filtered = $db->get_results("SELECT * FROM " . table_comments . " ORDER BY comment_date DESC LIMIT $offset,$pagesize");
		$rows = $db->get_var("SELECT count(*) FROM " . table_comments . "");
	}
	
	// if admin uses the filter
	if(isset($_GET["filter"])) {
		switch (sanitize($_GET["filter"], 3)) {
			case $main_smarty->get_config_vars('PLIGG_Visual_Comments_Filter_All'):
				$filtered = $db->get_results("SELECT * FROM " . table_comments . " ORDER BY comment_date DESC LIMIT $offset,$pagesize");
				$rows = $db->get_var("SELECT count(*) FROM " . table_comments . "");
				break;
			case $main_smarty->get_config_vars('PLIGG_Visual_Comments_Filter_Today'):
			  $tsdt = date('Ymd000000', strtotime("now"));
				$fsdt = date('Ymd235959', strtotime("now"));
				$filtered = $db->get_results("SELECT * FROM " . table_comments . " WHERE (comment_date >= $tsdt AND comment_date <= $fsdt) ORDER BY comment_date DESC LIMIT $offset,$pagesize");
				$rows = $db->get_var("SELECT count(*) FROM " . table_comments . " WHERE (comment_date >= $tsdt AND comment_date <= $fsdt)");
				break;
			case $main_smarty->get_config_vars('PLIGG_Visual_Comments_Filter_Yesterday'):
				$tsdt = date('Ymd000000', strtotime("-1 day"));
				$fsdt = date('Ymd235959', strtotime("-1 day"));
				$filtered = $db->get_results("SELECT * FROM " . table_comments . " WHERE (comment_date >= $tsdt AND comment_date <= $fsdt) ORDER BY comment_date DESC LIMIT $offset,$pagesize");
				$rows = $db->get_var("SELECT count(*) FROM " . table_comments . " WHERE (comment_date >= $tsdt AND comment_date <= $fsdt)");						
				break;
			case $main_smarty->get_config_vars('PLIGG_Visual_Comments_Filter_This_Week'):
				$wknum =  date('w', strtotime("now"));
				if ($wknum > 0) {
					$tsdt = date('Ymd000000', strtotime("-{$wknum} day"));
					$fsdt = date('Ymd235959', strtotime("now"));
			 	} else {
					$tsdt = date('Ymd000000', strtotime("now"));
					$fsdt = date('Ymd235959', strtotime("now"));
			 	}
			 	$filtered = $db->get_results("SELECT * FROM " . table_comments . " WHERE (comment_date >= $tsdt AND comment_date <= $fsdt) ORDER BY comment_date DESC LIMIT $offset,$pagesize");
			 	$rows = $db->get_var("SELECT count(*) FROM " . table_comments . " WHERE (comment_date >= $tsdt AND comment_date <= $fsdt)");						
			 	break;					
	  }	
	}	
	
	// read comments from database 
	$user = new User;
	$comment = new Comment;
	if($filtered) {
      $template_comments = array();
	  foreach($filtered as $dbfiltered) {
	    $comment->id = $dbfiltered->comment_id;
 	    $cached_comments[$dbfiltered->comment_id] = $dbfiltered;
	    $comment->read();
	    $user->id = $comment->author;
	    $user->read();
		  $template_comments[] = array(
			'comment_id' => $comment->id,
			'comment_content' => txt_shorter($comment->content, 60),
			'comment_content_long' => $comment->content,
			'comment_votes' => $comment->votes,
			'comment_author' => $user->username,
			'comment_link_id' => $comment->link,
			'comment_date' => txt_time_diff($comment->date),
		  );
	  }
	  $main_smarty->assign('template_comments', $template_comments);
	}
	
	// breadcrumbs and page title
	$navwhere['text1'] = $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel');
	$navwhere['link1'] = getmyurl('admin', '');
	$navwhere['text2'] = $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel_Comments');
	$main_smarty->assign('navbar_where', $navwhere);
	$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel'));
	
	// if admin deletes comment
	if (isset($_GET['action']) && sanitize($_GET['action'], 3) == "bulkmod") {
		if(isset($_POST['submit'])) {
			$comment = array();
			foreach ($_POST["comment"] as $k => $v) {
				$comment[intval($k)] = sanitize($v, 3);
			}
			foreach($comment as $key => $value) {
				if ($value == "discard") {
					$link_id = $db->get_var("SELECT comment_link_id FROM `" . table_comments . "` WHERE `comment_id` = ".$key.";");
					
					$db->query('DELETE FROM `' . table_comments . '` WHERE `comment_id` = "'.$key.'"');
					$db->query('DELETE FROM `' . table_comments . '` WHERE `comment_parent` = "'.$key.'"');

					$link = new Link;
					$link->id=$link_id;
					$link->read();
					$link->recalc_comments();
					$link->store();
					$link='';
					
				}
			}

			header("Location: ".my_pligg_base."/admin/admin_comments.php");
		}
	}
	
	// pagename
	define('pagename', 'admin_comments'); 
	$main_smarty->assign('pagename', pagename);
	
	// show the template
	$main_smarty->assign('tpl_center', '/admin/admin_comments_center');
	$main_smarty->display($template_dir . '/admin/admin.tpl');

}
else {
	echo 'not for you! go away!';
}		

?>