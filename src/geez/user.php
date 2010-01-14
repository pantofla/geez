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
include(mnminclude.'group.php');
include(mnminclude.'user.php');
include(mnminclude.'friend.php');
include(mnminclude.'smartyvariables.php');

$offset=(get_current_page()-1)*$page_size;
$main_smarty = do_sidebar($main_smarty);

define('pagename', 'user'); 
$main_smarty->assign('pagename', pagename);


// if not logged in, redirect to the index page
	$login = isset($_GET['login']) ? sanitize($_GET['login'], 3) : '';
	$truelogin = isset($_COOKIE['mnm_user'] ) ? sanitize($_COOKIE['mnm_user'] , 3) : '';
	if($login === ''){
		if ($current_user->user_id > 0) {
			$login = $current_user->user_login;
		} else {
			header('Location: ./');
			die;
		}
	}

// setup the breadcrumbs
	$navwhere['text1'] = $main_smarty->get_config_vars('PLIGG_Visual_Breadcrumb_Profile');
	$navwhere['link1'] = getmyurl('topusers');
	$navwhere['text2'] = $login;
	$navwhere['link2'] = getmyurl('user2', $login, 'profile');

// read the users information from the database
	$user=new User();
	$user->username = $login;
	if(!$user->read()) {
		//echo "Error: The user does not exist.";
		$main_smarty->assign('tpl_center', '404error');
		$main_smarty->display($the_template . '/pligg.tpl');
		die;
	}
 
	require_once(mnminclude.'check_behind_proxy.php'); 	 

	if(ShowProfileLastViewers == true){
		$main_smarty->assign('ShowProfileLastViewers', true);		
		// setup some arrays
			$last_viewers_names = array();
			$last_viewers_profile = array();
			$last_viewers_avatar = array();
				
		// for each viewer, get their name, profile link and avatar and put it in an array
			$viewers=new User();
			if ($last_viewers) {
				foreach($last_viewers as $viewer_id) {
					$viewers->id=$viewer_id;
					$viewers->read();
					$last_viewers_names[] = $viewers->username;
					$last_viewers_profile[] = getmyurl('user2', $viewers->username, 'profile');
					$last_viewers_avatar[] = get_avatar('small', "", $viewers->username, $viewers->email);
				}
			}
		// tell smarty about our arrays
			$main_smarty->assign('last_viewers_names', $last_viewers_names);
			$main_smarty->assign('last_viewers_profile', $last_viewers_profile);
			$main_smarty->assign('last_viewers_avatar', $last_viewers_avatar);
	} else {
		$main_smarty->assign('ShowProfileLastViewers', false);		
	}
	
	
// check to see if the profile is of a friend
  $friend = new Friend;
  $main_smarty->assign('is_friend', $friend->get_friend_status($user->id));


// avatars
	$main_smarty->assign('UseAvatars', do_we_use_avatars());
	$main_smarty->assign('Avatar_ImgSrc', get_avatar('large', '', $user->username, $user->email));
	if ($user->url != "") {
		if(substr(strtoupper($user->url), 0, 7) != "HTTP://"){
			$main_smarty->assign('user_url', "http://" . $user->url);
		}	else {
			$main_smarty->assign('user_url', $user->url);
		}
	} else {
		$main_smarty->assign('user_url', '');
	}		


// setup the URL method 2 links
	$main_smarty->assign('user_url_personal_data', getmyurl('user2', $login, 'profile'));
	$main_smarty->assign('user_url_news_sent', getmyurl('user2', $login, 'history'));
	$main_smarty->assign('user_url_news_published', getmyurl('user2', $login, 'published'));
	$main_smarty->assign('user_url_news_unpublished', getmyurl('user2', $login, 'shaken'));
	$main_smarty->assign('user_url_news_voted', getmyurl('user2', $login, 'voted'));
	$main_smarty->assign('user_url_commented', getmyurl('user2', $login, 'commented'));
	$main_smarty->assign('user_url_saved', getmyurl('user2', $login, 'saved'));
	$main_smarty->assign('user_url_setting', getmyurl('user2', $login, 'setting'));
	$main_smarty->assign('user_url_friends', getmyurl('user_friends', $login, 'viewfriends'));
	$main_smarty->assign('user_url_friends2', getmyurl('user_friends', $login, 'viewfriends2'));
	$main_smarty->assign('user_url_add', getmyurl('user_add_remove', $login, 'addfriend'));
	$main_smarty->assign('user_url_remove', getmyurl('user_add_remove', $login, 'removefriend'));
	$main_smarty->assign('user_rss', getmyurl('rssuser', $login));
	$main_smarty->assign('URL_Profile', getmyurl('profile'));
	$main_smarty->assign('user_url_member_groups', getmyurl('user2', $login, 'member_groups	'));


// tell smarty about our user
	$main_smarty = $user->fill_smarty($main_smarty);


// setup breadcrumbs for the various views
	$view = isset($_GET['view']) && sanitize($_GET['view'], 3) != '' ? sanitize($_GET['view'], 3) : 'profile';
	if ($view=='setting' && $truelogin!=$login)
		$view = 'profile';

	$page_header = $user->username;
	$post_title = $main_smarty->get_config_vars('PLIGG_Visual_Breadcrumb_Profile') . " | " . $login;

	$main_smarty->assign('user_view', $view);

	if ($view == 'profile') {
		$main_smarty->assign('view_href', '');
		$main_smarty->assign('nav_pd', 4);
	} else {
		$main_smarty->assign('nav_pd', 3);
		}

	if ($view == 'voted') {
		$page_header .= ' | ' . $main_smarty->get_config_vars('PLIGG_Visual_User_NewsVoted');
		$navwhere['text3'] = $main_smarty->get_config_vars('PLIGG_Visual_User_NewsVoted');
		$post_title .= " | " . $main_smarty->get_config_vars('PLIGG_Visual_User_NewsVoted');
		$main_smarty->assign('view_href', 'voted');
		$main_smarty->assign('nav_nv', 4);
	 } else {
		$main_smarty->assign('nav_nv', 3);
		}	

	if ($view == 'history') {
		$page_header .= ' | ' . $main_smarty->get_config_vars('PLIGG_Visual_User_NewsSent');
		$navwhere['text3'] = $main_smarty->get_config_vars('PLIGG_Visual_User_NewsSent');
		$post_title .= " | " . $main_smarty->get_config_vars('PLIGG_Visual_User_NewsSent');
		$main_smarty->assign('view_href', 'all');
		$main_smarty->assign('nav_ns', 4);
	 } else {
		$main_smarty->assign('nav_ns', 3);
		}

	if ($view == 'setting') 
	{
		
		$usercategorysql = "SELECT * FROM " . table_users . " where user_login = '$login' ";
		$userresults = $db->get_results($usercategorysql);
		$userresults = object_2_array($userresults);
		$get_categories = $userresults['0']['user_categories'];
		$user_categories = explode(",", $get_categories);
		
		$categorysql = "SELECT * FROM " . table_categories . " where category__auto_id!='0' ";
		$results = $db->get_results($categorysql);
		$results = object_2_array($results);
		$category = array();
		foreach($results as $key => $val)
		{
			$category[] = $val['category_name'];
			
		}
		$sor = $_GET['err'];
		if($sor == 1)
		{
			$err = "You have to select at least 1 category";
			$main_smarty->assign('err', $err);
		}
		
		$main_smarty->assign('category', $results);
		$main_smarty->assign('user_category', $user_categories);
		$main_smarty->assign('view_href', 'all');

		if (Allow_User_Change_Templates)
		{
			$dir = "templates";
			$templates = array();
			foreach (scandir($dir) as $file)
			    if (strstr($file,".")!==0 && file_exists("$dir/$file/header.tpl"))
				$templates[] = $file;
			$main_smarty->assign('templates', $templates);
			$main_smarty->assign('current_template', sanitize($_COOKIE['template'],3));
			$main_smarty->assign('Allow_User_Change_Templates', Allow_User_Change_Templates);
		}
	
		$main_smarty->assign('nav_set', 4);
	} 
	else 
	{
		$main_smarty->assign('nav_set', 3);
	}
		
	if ($view == 'published') {
		$page_header .= ' | ' . $main_smarty->get_config_vars('PLIGG_Visual_User_NewsPublished');
		$navwhere['text3'] = $main_smarty->get_config_vars('PLIGG_Visual_User_NewsPublished');
		$post_title .= " | " . $main_smarty->get_config_vars('PLIGG_Visual_User_NewsPublished');
		$main_smarty->assign('view_href', 'published');
		$main_smarty->assign('nav_np', 4);
	 } else {
		$main_smarty->assign('nav_np', 3);
		}

	if ($view == 'shaken') {
		$page_header .= ' | ' . $main_smarty->get_config_vars('PLIGG_Visual_User_NewsUnPublished');
		$navwhere['text3'] = $main_smarty->get_config_vars('PLIGG_Visual_User_NewsUnPublished');
		$post_title .= " | " . $main_smarty->get_config_vars('PLIGG_Visual_User_NewsUnPublished');
		$main_smarty->assign('view_href', 'queued');
		$main_smarty->assign('nav_nu', 4);
	 } else {
		$main_smarty->assign('nav_nu', 3);
		}

	if ($view == 'commented') {
		$page_header .= ' | ' . $main_smarty->get_config_vars('PLIGG_Visual_User_NewsCommented');
		$navwhere['text3'] = $main_smarty->get_config_vars('PLIGG_Visual_User_NewsCommented');
		$post_title .= " | " . $main_smarty->get_config_vars('PLIGG_Visual_User_NewsCommented');
		$main_smarty->assign('view_href', 'commented');
		$main_smarty->assign('nav_c', 4);
	 } else {
		$main_smarty->assign('nav_c', 3);
		}

	if ($view == 'saved') {
		$page_header .= ' | ' . $main_smarty->get_config_vars('PLIGG_Visual_User_NewsSaved');
		$navwhere['text3'] = $main_smarty->get_config_vars('PLIGG_Visual_User_NewsSaved');
		$post_title .= " | " . $main_smarty->get_config_vars('PLIGG_Visual_User_NewsSaved');
		$main_smarty->assign('view_href', 'saved');
		$main_smarty->assign('nav_s', 4);
	 } else {
		$main_smarty->assign('nav_s', 3);
	}	

	if ($view == 'viewfriends') {
		$navwhere['text3'] = $main_smarty->get_config_vars('PLIGG_Visual_User_Profile_Viewing_Friends');
		$post_title .= " | " . $main_smarty->get_config_vars('PLIGG_Visual_User_Profile_Viewing_Friends');
		}

	if ($view == 'viewfriends2') {
		$navwhere['text3'] = $main_smarty->get_config_vars('PLIGG_Visual_User_Profile_Viewing_Friends_2a');
		$post_title .= " | " . $main_smarty->get_config_vars('PLIGG_Visual_User_Profile_Viewing_Friends_2');
		}

	if ($view == 'removefriend') {
		$page_header .= ' | ' . $main_smarty->get_config_vars('PLIGG_Visual_User_Profile_Removing_Friend');
		$navwhere['text3'] = $main_smarty->get_config_vars('PLIGG_Visual_User_Profile_Removing_Friend');
		$post_title .= " | " . $main_smarty->get_config_vars('PLIGG_Visual_User_Profile_Removing_Friend');
		}

	if ($view == 'addfriend') {
		$page_header .= ' | ' . $main_smarty->get_config_vars('PLIGG_Visual_User_Profile_Adding_Friend');
		$navwhere['text3'] = $main_smarty->get_config_vars('PLIGG_Visual_User_Profile_Adding_Friend');
		$post_title .= " | " . $main_smarty->get_config_vars('PLIGG_Visual_User_Profile_Adding_Friend');
		}
	if ($view == 'member_groups') 
	{
		$main_smarty->assign('view_href', '');
		$main_smarty->assign('nav_mg', 4);
	}	
	else 
	{
		$main_smarty->assign('nav_mg', 3);
	}	

	$main_smarty->assign('page_header', $page_header);
	$main_smarty->assign('posttitle', $post_title);

	if ($view == 'search') {
	
		if(isset($_REQUEST['keyword'])){$keyword = sanitize($_REQUEST['keyword'], 3);}

		$searchsql = "SELECT * FROM " . table_users . " where user_login LIKE '%".$keyword."%' OR public_email LIKE '%".$keyword."%' OR user_date LIKE '%".$keyword."%' ";
		$results = $db->get_results($searchsql);
		$results = object_2_array($results);
		foreach($results as $key => $val){
			if($val['user_level'] == 'god'){
				unset($results[$key]);
			} else {
				$results[$key]['Avatar'] = get_avatar('large', "", $val['user_login'], $val['user_email']);
				$results[$key]['add_friend'] = getmyurl('user_add_remove', $val['user_login'], 'addfriend');
				$results[$key]['remove_friend'] = getmyurl('user_add_remove', $val['user_login'], 'removefriend');
				$results[$key]['status'] = $friend->get_friend_status($val['user_id']);
			}
		}
		$userlist = $results;

		$main_smarty->assign('userlist', $userlist);
		$main_smarty->assign('search', $keyword);

		$main_smarty->assign('page_header', $user->username);
		$navwhere['text3'] = $main_smarty->get_config_vars('PLIGG_Visual_Search_SearchResults') . ' ' . $keyword;
		$main_smarty->assign('posttitle', $main_smarty->get_config_vars('PLIGG_Visual_Breadcrumb_Profile') . " " . $login . " - " . $main_smarty->get_config_vars('PLIGG_Visual_Search_SearchResults') . ' ' . $keyword);
		}




	$main_smarty->assign('navbar_where', $navwhere);


// a hook	
	$vars = '';
	check_actions('user_post_views', $vars);

// determine which user page to display
	Global $db, $main_smarty, $view, $user, $rows, $page_size, $offset;
	$the_page = 'profile';
	switch ($view) {
		case 'history':
			do_history();
			$main_smarty->assign('user_pagination', do_pages($rows, $page_size, $the_page, true));
			break;
		case 'published':
			do_published();
			$main_smarty->assign('user_pagination', do_pages($rows, $page_size, $the_page, true));
			break;
		case 'shaken':
			do_shaken();
			$main_smarty->assign('user_pagination', do_pages($rows, $page_size, $the_page, true));
			break;	
		case 'commented':
			do_commented();
			$main_smarty->assign('user_pagination', do_pages($rows, $page_size, $the_page, true));
			break;
		case 'voted':
			do_voted();
			$main_smarty->assign('user_pagination', do_pages($rows, $page_size, $the_page, true));
			break;	
		case 'saved':
			do_stories();
			$main_smarty->assign('user_pagination', do_pages($rows, $page_size, $the_page, true));
			break;  
		case 'removefriend':
			do_removefriend();
			break;
		case 'addfriend':
			do_addfriend();
			break;
		case 'viewfriends':
			do_viewfriends();
			break;
		case 'viewfriends2':
			do_viewfriends2();
			break;
		case 'sendmessage':
			do_sendmessage();
			break;
		case 'member_groups':
			do_member_groups();
			//$main_smarty->assign('user_pagination', do_pages($rows, $page_size, $the_page, true));
			break;  	
	}

// display the template
	$main_smarty->assign('tpl_center', $the_template . '/user_center');
	$main_smarty->display($the_template . '/pligg.tpl');


function do_stories () {
	global $db, $main_smarty, $rows, $user, $offset, $page_size,$current_user,$cached_links;
	//if ($current_user->user_id == $user->id)
	//{
	$output = '';
	$link = new Link;
	$rows = $db->get_var("SELECT count(*) FROM " . table_saved_links . " WHERE saved_user_id=$user->id");
		
		$fieldexists = checkforfield('saved_privacy', table_saved_links);
		if($fieldexists)
		{
			if ($current_user->user_id == $user->id)
			{	
				$links = $db->get_results("SELECT * FROM " . table_saved_links . " 
								LEFT JOIN " . table_links . " ON saved_link_id=link_id
								WHERE saved_user_id=$user->id ORDER BY saved_link_id DESC LIMIT $offset,$page_size");
			}
			else
			{
				$links = $db->get_results("SELECT * FROM " . table_saved_links . " 
								LEFT JOIN " . table_links . " ON saved_link_id=link_id
								WHERE saved_user_id=$user->id and saved_privacy = 'public' ORDER BY saved_link_id DESC LIMIT $offset,$page_size");	
			}
		}
		else
		{
			$links = $db->get_results("SELECT * FROM " . table_saved_links . " 
							LEFT JOIN " . table_links . " ON saved_link_id=link_id
							WHERE saved_user_id=$user->id ORDER BY saved_link_id DESC LIMIT $offset,$page_size");
		}	
	if ($links) {
		foreach($links as $dblink) {
			$link->id=$dblink->link_id;
			$cached_links[$dblink->link_id] = $dblink;
			$link->read();
				//$output.= $current_user->user_id."<br/>";
				//$output.= $user->id."<br/>";
			$output .= $link->print_summary('summary', true);
		}
	}
	$main_smarty->assign('user_page', $output);
	//}
}

function do_voted () {
	global $db, $main_smarty, $rows, $user, $offset, $page_size,$cached_links;

	$output = '';
	$link = new Link;
	$rows = $db->get_var("SELECT count(*) FROM " . table_links . ", " . table_votes . " WHERE vote_user_id=$user->id AND vote_link_id=link_id AND vote_value > 0 AND link_status!='discard'");
	$links = $db->get_results("SELECT DISTINCT * FROM " . table_links . ", " . table_votes . " WHERE vote_user_id=$user->id AND vote_link_id=link_id AND vote_value > 0  AND link_status!='discard' ORDER BY link_date DESC LIMIT $offset,$page_size");
	if ($links) {
		foreach($links as $dblink) {
			$link->id=$dblink->link_id;
			$cached_links[$dblink->link_id] = $dblink;
			$link->read();
			$output .= $link->print_summary('summary', true);
		}
	}
	$main_smarty->assign('user_page', $output);
}

function do_history () {
	global $db, $main_smarty, $rows, $user, $offset, $page_size,$cached_links;

	$output = '';
	$link = new Link;
	$rows = $db->get_var("SELECT count(*) FROM " . table_links . " WHERE link_author=$user->id AND link_status!='discard'");
	$links = $db->get_results("SELECT * FROM " . table_links . " WHERE link_author=$user->id AND link_status!='discard' ORDER BY link_date DESC LIMIT $offset,$page_size");
	if ($links) {
		foreach($links as $dblink) {
			$link->id=$dblink->link_id;
			$cached_links[$dblink->link_id] = $dblink;
			$link->read();
			$output .= $link->print_summary('summary', true);
		}
	}
	$main_smarty->assign('user_page', $output);
}

function do_published () {
	global $db, $main_smarty, $rows, $user, $offset, $page_size,$cached_links;

	$output = '';
	$link = new Link;
	$rows = $db->get_var("SELECT count(*) FROM " . table_links . " WHERE link_author=$user->id AND link_status='published'");
	$links = $db->get_results("SELECT * FROM " . table_links . " WHERE link_author=$user->id AND link_status='published'  ORDER BY link_published_date DESC LIMIT $offset,$page_size");
	if ($links) {
		foreach($links as $dblink) {
			$link->id=$dblink->link_id;
			$cached_links[$dblink->link_id] = $dblink;
			$link->read();
			$output .= $link->print_summary('summary', true);
		}
	}
	$main_smarty->assign('user_page', $output);
}

function do_shaken () {
	global $db, $main_smarty, $rows, $user, $offset, $page_size,$cached_links;

	$output = '';
	$link = new Link;
	$rows = $db->get_var("SELECT count(*) FROM " . table_links . " WHERE link_author=$user->id AND link_status='queued'");
	$links = $db->get_results("SELECT * FROM " . table_links . " WHERE link_author=$user->id AND link_status='queued' ORDER BY link_date DESC LIMIT $offset,$page_size");
	if ($links) {
		foreach($links as $dblink) {
			$link->id=$dblink->link_id;
			$cached_links[$dblink->link_id] = $dblink;
			$link->read();
			$output .= $link->print_summary('summary', true);
		}
	}
	$main_smarty->assign('user_page', $output);
}

function do_commented () {
	global $db, $main_smarty, $rows, $user, $offset, $page_size,$cached_links;

	$output = '';
	$link = new Link;
	$rows = $db->get_var("SELECT count(*) FROM " . table_links . ", " . table_comments . " WHERE comment_user_id=$user->id AND comment_link_id=link_id");
	$links = $db->get_results("SELECT DISTINCT * FROM " . table_links . ", " . table_comments . " WHERE comment_user_id=$user->id AND comment_link_id=link_id AND link_status != 'discard'  ORDER BY link_date DESC LIMIT $offset,$page_size");
	if ($links) {
		foreach($links as $dblink) {
			$link->id=$dblink->link_id;
			$cached_links[$dblink->link_id] = $dblink;
			$link->read();
			$output .= $link->print_summary('summary', true);
		}
	}     
	$main_smarty->assign('user_page', $output);
}

function do_removefriend (){
	global $db, $main_smarty, $user, $the_template;
	$friend = new Friend;
	$output =  '<br /><center> ';
	$output .=  '<h2>Successfully Removed Friend!</h2>';
	$friend->remove($user->id);
	$output .=  '</center>';
	$main_smarty->assign('user_page', $output);
}

function do_addfriend (){
	global $db, $main_smarty, $user, $the_template;
	$friend = new Friend;
	$output =  '<br /><center> ';
	$output .=  '<h2>Successfully Added Friend!</h2>';
	$friend->add($user->id);
	$output .=  '</center>';
	$main_smarty->assign('user_page', $output);
}

function do_viewfriends(){
	global $db, $main_smarty, $user, $the_template;
	$friend = new Friend;
	$friends = $friend->get_friend_list();

	$output = "<h2>Friends</h2>";	

	if ($friends){
	  $output .= '<table><th width="250px">Username</th><th width="60px">Message</th><th width="60px">Remove</th>';
		foreach($friends as $myfriend) {
			$friend_avatar = get_avatar('small', $myfriend->user_avatar_source, $myfriend->user_login, $myfriend->user_email);		    
			$output .= '<tr>';
			$output .= '<td><img src="'.$friend_avatar.'" align="absmiddle"/> <a href="'.getmyurl('user2', $myfriend->user_login, 'profile').'">' . $myfriend->user_login.'</a></td>';						
			$output .= '<td align="center"><a href="' . my_pligg_base . '/module.php?module=simple_messaging&view=compose&return=' . urlencode($_SERVER['REQUEST_URI']) .'&to=' .$myfriend->user_login . '"><img src="'.my_pligg_base.'/templates/'.$the_template.'/images/user_message.png" border="0"></a></td>';
			$output .= '<td align="center"><a href = "'.getmyurl('user_add_remove', $myfriend->user_login, 'removefriend').'"><img src='.my_pligg_base.'/templates/'.$the_template.'/images/user_delete.png border=0></a></td>';
			$output .= '</tr>';			
		}
		$output .= '</table>';
	}
	else {
		$output .= "<br /><br /><center><h2>(0) Friends.</h2></center>";
	}
	$main_smarty->assign('user_page', $output);
}

function do_viewfriends2(){
	global $db, $main_smarty, $user, $the_template;
	$friend = new Friend;
	$friends = $friend->get_friend_list_2();	

	$output = "<h2>&#928;&#959;&#953;&#972;&#962; &#956;&#949; &#949;&#967;&#949;&#953; &#960;&#961;&#959;&#963;&#952;&#941;&#963;&#949;&#953; &#963;&#945;&#957; friend</h2>";

	if ($friends){
	  $output .= '<table><th width="250px">Username</th><th width="500px">Message</th>';
		foreach($friends as $myfriend) {
			$friend_avatar = get_avatar('small', $myfriend->user_avatar_source, $myfriend->user_login, $myfriend->user_email);
		  $output .= '<tr>';
			$output .= '<td><img src="'.$friend_avatar.'" align="absmiddle"/> <a href="'.getmyurl('user2', $myfriend->user_login, 'profile'). '">' . $myfriend->user_login.'</a></td>';			
			$output .= '<td><a href="' . my_pligg_base . '/module.php?module=simple_messaging&view=compose&to=' .$myfriend->user_login . '&return=' . urlencode($_SERVER['REQUEST_URI']) .'"><img src="'.my_pligg_base.'/templates/'.$the_template.'/images/user_message.png" border="0"></a></td>';   		
			$output .= '</tr>';
		}
		$output .= '</table>';
	}
	else {
		$output .= "<br /><br /><center><h2>(0) friend.</h2>";
	}
	$main_smarty->assign('user_page', $output);
}
function do_member_groups()
{
	global $db, $main_smarty, $rows, $user, $offset, $page_size;
	//print_r(get_groupid_user($user->id));
	$ids  = get_groupid_user($user->id);
	if($ids)
	{
		foreach($ids as $groupid)
		{
			//print_r($groupid);
			//echo $groupid->group_id;
			$output .= group_print_summary($groupid->group_id);
			$main_smarty->assign('user_page', $output);
		}
	}
}
?>