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
check_actions('search_top', $vars);

if(SearchMethod != 4){
	$search=new Search();
		if(isset($_REQUEST['from'])){$search->newerthan = sanitize($_REQUEST['from'], 3);}
		$search->searchTerm = $db->escape(sanitize($_REQUEST['search']), 3);
		if(!isset($_REQUEST['search'])){$search->orderBy = "link_modified DESC";}
		if(isset($_REQUEST['tag'])){$search->searchTerm = sanitize($_REQUEST['search'], 3); $search->isTag = true;}
		if(isset($_REQUEST['url'])){$search->url = sanitize($_REQUEST['url'], 3);}
	
		// figure out what "page" of the results we're on
		$search->offset = (get_current_page()-1)*$page_size;
	
		if(isset($_REQUEST['pagesize']))
			{$search->pagesize = sanitize($_REQUEST['pagesize'], 3);}
		else
			// $page_size is set in the admin panel
			{$search->pagesize = $page_size;}
	
		if(isset($_REQUEST['status'])){
			// if "status" is set, filter to that status
			$search->filterToStatus = sanitize($_REQUEST['status'], 3);
		} else {
			// we want to view "all" stories
			$search->filterToStatus = "all";
		}
	
		if(isset($_REQUEST['category'])){
			// filter to just the category we're looking at
			$search->category = urlencode(sanitize($_REQUEST['category'], 1));
		} 
	
	
	//Advanced Search
	if( isset( $_REQUEST['adv'] ) && $_REQUEST['adv'] == 1 ){
		$search->adv = true;
		$search->s_group = $_REQUEST['sgroup'];
		$search->s_tags = $_REQUEST['stags'];
		$search->s_story = $_REQUEST['slink'];
		$search->s_user = $_REQUEST['suser'];
		$search->s_cat = $_REQUEST['scategory'];
		$search->s_comments = $_REQUEST['scomments'];		
		
		if( intval( $_REQUEST['sgroup'] ) > 0 )
			$display_grouplinks = true;
	}
	//end Advanced Search
	
	$new_search = $search->new_search();

	$linksum_count = $search->countsql;
	$linksum_sql = $search->sql;
} else {
	$search=new Search();
	if(isset($_REQUEST['q'])){$search->searchTerm = $db->escape(sanitize($_REQUEST['q']), 3);}
}

// breadcrumbs and page title
$navwhere['text1'] = $main_smarty->get_config_vars('PLIGG_Visual_Breadcrumb_Search') . stripslashes($search->searchTerm);
$navwhere['link1'] = getmyurl('search', urlencode($search->searchTerm));
$main_smarty->assign('navbar_where', $navwhere);
$main_smarty->assign('posttitle', $main_smarty->get_config_vars('PLIGG_Visual_Breadcrumb_Search') . stripslashes($search->searchTerm));

//sidebar
$main_smarty = do_sidebar($main_smarty);

// misc smarty
$main_smarty->assign('cat_url', getmyurl("maincategory"));
$main_smarty->assign('URL_rss_page', my_pligg_base."/rsssearch.php?".$_SERVER['QUERY_STRING']);

// pagename	
define('pagename', 'search'); 
$main_smarty->assign('pagename', pagename);

$fetch_link_summary = true;
include('./libs/link_summary.php'); // this is the code that show the links / stories
$main_smarty->assign('search_pagination', do_pages($rows, $page_size, "search", true));

// show the template
$main_smarty->assign('tpl_center', $the_template . '/search_center');
$main_smarty->display($the_template . '/pligg.tpl');
?>
