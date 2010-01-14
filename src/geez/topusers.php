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
include(mnminclude.'tags.php');
include(mnminclude.'user.php');
include(mnminclude.'smartyvariables.php');

// -------------------------------------------------------------------------------------

// breadcrumbs and page titles
$navwhere['text1'] = $main_smarty->get_config_vars('PLIGG_Visual_Breadcrumb_TopUsers');
$navwhere['link1'] = getmyurl('topusers', '');
$main_smarty->assign('navbar_where', $navwhere);
$main_smarty->assign('posttitle', $main_smarty->get_config_vars('PLIGG_Visual_Breadcrumb_TopUsers'));

// figure out what "page" of the results we're on
$offset=(get_current_page()-1)*$top_users_size;

// put the table headers in an array for the top users tpl file
$header_items = array($main_smarty->get_config_vars('PLIGG_Visual_TopUsers_TH_User'), $main_smarty->get_config_vars('PLIGG_Visual_TopUsers_TH_News'), $main_smarty->get_config_vars('PLIGG_Visual_TopUsers_TH_PublishedNews'), $main_smarty->get_config_vars('PLIGG_Visual_TopUsers_TH_Comments'), $main_smarty->get_config_vars('PLIGG_Visual_TopUsers_TH_TotalVotes'), $main_smarty->get_config_vars('PLIGG_Visual_TopUsers_TH_PublishedVotes'));

// determine how to sort users
// validate and make sure value is between 0 and 5	
$sortby = isset($_GET['sortby']) && is_numeric($_GET['sortby']) && $_GET['sortby'] >= 0 && $_GET['sortby'] <= 5 ? $_GET['sortby'] : 0;	

switch ($sortby) {
	case 0: // sort users alphabetically
		$select = "SELECT user_id";
 		$from_where = " FROM " . table_users . " where user_level<>'god'";
 		$order_by = " ORDER BY user_login ";
		break;
	case 1: // sort users by number of submitted linkd
		$select = "SELECT user_id, count(*) as count ";
		$from_where = " FROM " . table_links . ", " . table_users . " WHERE  link_status != 'discard' AND link_author=user_id AND user_level<>'god' GROUP BY link_author";
		$order_by = " ORDER BY count DESC ";
		break;
	case 2: // sort users by number of published links
		$select = "SELECT user_id, count(*) as count ";
		$from_where = " FROM " . table_links . ", " . table_users . " WHERE  link_status = 'published' AND link_author=user_id AND user_level<>'god' GROUP BY link_author";
		$order_by = " ORDER BY count DESC ";
		break;
	case 3: //sort users by number of comments
		$select = "SELECT user_id, count(*) as count ";
		$from_where = " FROM " . table_comments . ", " . table_users . " WHERE comment_user_id=user_id AND user_level<>'god' GROUP BY comment_user_id";
		$order_by = " ORDER BY count DESC ";
		break;
	case 4: //sort users by number of votes
		$select = "SELECT user_id, count(*) as count ";
		$from_where = " FROM " . table_votes . ", " . table_users . " WHERE vote_user_id=user_id AND user_level<>'god' GROUP BY vote_user_id";
		$order_by = " ORDER BY count DESC ";
		break;
	case 5: // sort users by number of published votes
		$select = "SELECT user_id, count(*) as count ";
		$from_where = " FROM " . table_votes . ", " . table_users . ", " . table_links . " WHERE vote_user_id=user_id AND link_id=vote_link_id AND link_status='published' AND vote_date < link_published_date AND user_level<>'god' GROUP BY user_id";
		$order_by = " ORDER BY count DESC ";
		break;
}


$user = new User;
$rows = $db->get_var("select count(*) as count $from_where $order_by");
$users = $db->get_results("$select $from_where $order_by LIMIT $offset,$top_users_size");
$users_table = '';
if ($users) {
	foreach($users as $dbuser) {
		$user->id=$dbuser->user_id;
		$user->read();
		$user->all_stats();
		
		$main_smarty->assign('user_userlink', getmyurl("user", $user->username));
		$main_smarty->assign('user_username', $user->username);
		$main_smarty->assign('user_total_links', $user->total_links);
		$main_smarty->assign('user_published_links', $user->published_links);
		if($user->total_links>0) 
			$main_smarty->assign('user_published_links_percent', intval($user->published_links/$user->total_links*100));
		else
			$main_smarty->assign('user_published_links_percent', '');
		$main_smarty->assign('user_total_comments', $user->total_comments);
		$main_smarty->assign('user_total_votes', $user->total_votes);
		$main_smarty->assign('user_published_votes', $user->published_votes);
		if($user->total_votes>0) 
			$main_smarty->assign('user_published_votes_percent', intval($user->published_votes/$user->total_votes*100));
		else
			$main_smarty->assign('user_published_votes_percent', '');
		$main_smarty->assign('user_karma', $user->karma);
		
		$main_smarty->assign('user_avatar', get_avatar('large', "", $user->username, $user->email));
		
		$users_table .= $main_smarty->fetch(The_Template . "/topusers_data.tpl");

	}
}

$main_smarty->assign('users_table', $users_table);

// pagename
define('pagename', 'topusers'); 
$main_smarty->assign('pagename', pagename);

// sidebar
$main_smarty = do_sidebar($main_smarty);

$main_smarty->assign('headers', $header_items);
$main_smarty->assign('topusers_pagination', do_pages($rows, $top_users_size, "topusers", true));
// show the template
$main_smarty->assign('tpl_center', $the_template . '/topusers_center');
$main_smarty->display($the_template . '/pligg.tpl');
?>
