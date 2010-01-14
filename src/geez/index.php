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
include(mnminclude.'search.php');
include(mnminclude.'smartyvariables.php');

// module system hook
$vars = '';
check_actions('index_top', $vars);

// find the name of the current category
if(isset($_REQUEST['category'])){
	$thecat = get_cached_category_data('category_safe_name', urlencode(sanitize($_REQUEST['category'], 1)));
	$thecat = $thecat->category_name;
}

// start a new search
$search=new Search();

// check for some get/post
if(isset($_REQUEST['from'])){$search->newerthan = sanitize($_REQUEST['from'], 3);}
if(isset($_REQUEST['search'])){$search->searchTerm = sanitize($_REQUEST['search'], 3);}
if(isset($_REQUEST['search'])){$search->filterToStatus = "all";}
if(!isset($_REQUEST['search'])){$search->orderBy = "link_published_date DESC";}
if(isset($_REQUEST['tag'])){$search->searchTerm = sanitize($_REQUEST['search'], 3); $search->isTag = true;}
if(isset($thecat)){$search->category = $thecat;}

// figure out what "page" of the results we're on
$search->offset = (get_current_page()-1)*$page_size;

// pagesize set in the admin panel
$search->pagesize = $page_size;

// since this is index, we only want to view "published" stories
$search->filterToStatus = "published";

// this is for the tabs on the top that filter
if(isset($_GET['part'])){$search->setmek = $db->escape($_GET['part']);}
$search->do_setmek();	

// do the search
$search->doSearch();

$linksum_count = $search->countsql;
$linksum_sql = $search->sql;

if(isset($_REQUEST['category'])) {
	$category_data = get_cached_category_data('category_safe_name', urlencode(sanitize($_REQUEST['category'], 1)));
	$main_smarty->assign('meta_description', $category_data->category_desc);
	$main_smarty->assign('meta_keywords', $category_data->category_keywords);

	// breadcrumbs and page title for the category we're looking at
	$main_smarty->assign('title', ''.$main_smarty->get_config_vars('PLIGG_Visual_Published_News').' - ' . $thecat . '');
	$navwhere['text1'] = $main_smarty->get_config_vars('PLIGG_Visual_Published_News');
	$navwhere['link1'] = getmyurl('root', '');
	$navwhere['text2'] = $thecat;
	$main_smarty->assign('navbar_where', $navwhere);
	$main_smarty->assign('pretitle', $thecat );
	$main_smarty->assign('posttitle', $main_smarty->get_config_vars('PLIGG_Visual_Published_News'));
	$main_smarty->assign('page_header', $thecat . $main_smarty->get_config_vars('PLIGG_Visual_Published_News'));
	// pagename	
	define('pagename', 'published'); 
	$main_smarty->assign('pagename', pagename);
} else {
	// breadcrumbs and page title
	$navwhere['show'] = 'yes';
	$navwhere['text1'] = $main_smarty->get_config_vars('PLIGG_Visual_Published_News');
	$navwhere['link1'] = getmyurl('root', '');
	$main_smarty->assign('navbar_where', $navwhere);
	$main_smarty->assign('posttitle', $main_smarty->get_config_vars('PLIGG_Visual_Home_Title'));
	$main_smarty->assign('page_header', $main_smarty->get_config_vars('PLIGG_Visual_Published_News'));
	// pagename	
	define('pagename', 'index'); 
	$main_smarty->assign('pagename', pagename);
}

//  make sure my_base_url is set
if($my_base_url == ''){echo '<center><span class=error>ERROR: my_base_url is not set. Please correct this using the <a href = "/admin/admin_config.php?page=Location%20Installed">admin panel</a>. Then refresh this page.</span></center>';}

// sidebar
$main_smarty = do_sidebar($main_smarty);
$sql = "SELECT user_login FROM " . table_users . " ORDER BY user_id DESC LIMIT 1";
$last_user = $db->get_var($sql);
$main_smarty->assign('last_user', $last_user);

// misc smarty
if(isset($from_text)){$main_smarty->assign('from_text', $from_text);}
if(isset($search->setmek)){$main_smarty->assign('setmeka', $search->setmek);}else{$main_smarty->assign('setmeka', '');}

$main_smarty->assign('URL_rss_page', getmyurl('rsspage', $category_data->category__auto_id, 'published'));

$fetch_link_summary = true;
include('./libs/link_summary.php'); // this is the code that show the links / stories
$main_smarty->assign('link_pagination', do_pages($rows, $page_size, "published", true));

// show the template
$main_smarty->assign('tpl_center', $the_template . '/index_center');
$main_smarty->display($the_template . '/pligg.tpl');
?>
