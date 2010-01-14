<?php
// The source code packaged with this file is Free Software, Copyright (C) 2005 by
// Ricardo Galli <gallir at uib dot es>.
// It's licensed under the AFFERO GENERAL PUBLIC LICENSE unless stated otherwise.
// You can get copies of the licenses here:
// 		http://www.affero.org/oagpl.html
// AFFERO GENERAL PUBLIC LICENSE is also included in the file called "COPYING".

if(!defined('mnminclude')){header('Location: ../404error.php');}

function get_category_id($cat_name) {
	// find category id when given category name
	// $the_cats is set in /libs/smartyvariables.php
	global $dblang, $the_cats;

	foreach($the_cats as $cat){
		if($cat->category_name == $cat_name && $cat->category_lang == $dblang) { 
			return $cat->category_id; 
		}
	}
	return null;
}

function get_category_name($cat_id) {
	// find category name when given category id
	// $the_cats is set in /libs/smartyvariables.php
	global $dblang, $the_cats;

	foreach($the_cats as $cat){
		if($cat->category_id == $cat_id && $cat->category_lang == $dblang) { 
			return $cat->category_name; 
		}
	}
	return null;
}


function who_voted($storyid, $avatar_size){
	// this returns who voted for a story
	// eventually add support for filters (only show friends, etc)	
	global $db;
	if (!is_numeric($storyid)) die();

	$sql = 'SELECT ' . table_votes . '.*, ' . table_users . '.* FROM ' . table_votes . ' INNER JOIN ' . table_users . ' ON ' . table_votes . '.vote_user_id = ' . table_users . '.user_id WHERE (((' . table_votes . '.vote_value)>0) AND ((' . table_votes . '.vote_link_id)='.$storyid.') AND (' . table_votes . '.vote_type= "links")) AND user_level<>"god";';
	//echo $sql;
	$voters = $db->get_results($sql);
	$voters = object_2_array($voters);
	foreach($voters as $key => $val){
		$voters[$key]['Avatar_ImgSrc'] = get_avatar($avatar_size, "", $val['user_login'], $val['user_email']);
	}

	return $voters;	
}

function related_stories($storyid, $related_tags, $category){
	// this returns similar stories based on tags in common and in the same category    
	global $db;
	if (!is_numeric($storyid)) die();

	$related_tags="'".str_replace(", ","', '",addslashes($related_tags))."'"; // This gives us the proper string structure for IN SQL statement

	// Select 10 stories that share tags with the current story and order them by number of tags they share    
        $sql = "SELECT ".table_links.".link_id, ".table_links.".link_category, ".table_links.".link_title, ".table_links.".link_title_url, COUNT( ".table_tags.".tag_link_id ) AS relevance, ".table_tags.".tag_link_id FROM ".table_tags.", ".table_links."    WHERE ".table_tags.".tag_words IN (    ".$related_tags."    ) AND ".table_tags.".tag_link_id = ".table_links.".link_id    AND ".table_links.".link_status != 'discard' AND NOT ".table_links.".link_id = ".$storyid;
	$sql.= " GROUP BY ".table_tags.".tag_link_id, ".table_links.".link_title, ".table_links.".link_title_url ORDER BY relevance DESC LIMIT 10";

	$related_story = $db->get_results($sql);
	$related_story = object_2_array($related_story);

        foreach($related_story as $id => $rs){
					if ($rs['link_title_url'] == ""){
						$related_story[$id]['url'] = getmyurl("story", $rs['link_id']);
					} else {
						$related_story[$id]['url'] = getmyurl("storyURL", cat_safe_name($rs['link_category']), urlencode($rs['link_title_url']), $rs['link_id']);
					}
				}

	return $related_story;    
} 

function category_display()
{
	global $db;
	$maincategory = $db->get_results("select * from ".table_categories."");
	
	$maincategory = object_2_array($maincategory);

        foreach($maincategory as $id => $rs){
			$maincategory[$id]['safename'] = $rs['category_safe_name'];
			$maincategory[$id]['id'] = $rs['category_id'];
			$maincategory[$id]['parent'] = $rs['category_parent'];
			$maincategory[$id]['order'] = $rs['category_order'];
			
			$childcategory = $db->get_results("select * from ".table_categories." where category_parent =".$rs['category_id']);
			//echo "select * from ".table_categories." where category_parent =".$rs['category_id'];
			$childcategory = object_2_array($childcategory);
			foreach($childcategory as $id => $rc){
				$childcategory[$id]['safename'] = $rc['category_safe_name'];
				$childcategory[$id]['id'] = $rc['category_id'];
				$childcategory[$id]['parent'] = $rc['category_parent'];					
			}
		}
	return $maincategory;
}

function cat_safe_name($cat_id) {

	global $dblang, $the_cats;

	foreach($the_cats as $cat){
		if($cat->category_id == $cat_id && $cat->category_lang == $dblang)
		{
			return $cat->category_safe_name; 
		}
	}
}


function sanitize($var, $santype = 1, $allowable_tags = ''){
        if ($santype == 1) {return strip_tags($var, $allowable_tags = '');}
        if ($santype == 2) {return htmlentities(strip_tags($var, $allowable_tags),ENT_QUOTES,'UTF-8');}
	if ($santype == 3) {
		if (!get_magic_quotes_gpc()) {
                        return addslashes(htmlentities(strip_tags($var, $allowable_tags),ENT_QUOTES,'UTF-8'));
		} 
		else {
                   return htmlentities(strip_tags($var, $allowable_tags),ENT_QUOTES,'UTF-8');
		}
	}

	if ($santype == 4) {
                if (!get_magic_quotes_gpc()) {
                        return addslashes(strip_tags($var, $allowable_tags));
                }
                else {
                   return strip_tags($var, $allowable_tags);
                }
	}

}

function do_we_use_avatars(){
	// checks to see if avatars are enabled
	if(Enable_User_Upload_Avatar == true){return "1";}		
	return "0";
}

function get_avatar($size = "large", $avatarsource, $user_name = "", $user_email = "", $user_id=""){
	// returns the location of a user's avatar
	global $globals;
	
	if($avatarsource == ""){
		include_once(mnminclude.'user.php');
		$user=new User();
		if($user_name != ""){
			$user->username = $user_name;
		} else {
			$user->id = $user_id;
		}
		
		if(!$user->read()) {
			echo "invalid username or userid in get_avatar";
			die;
		}else {
			$avatarsource = $user->avatar_source;
			$user_name = $user->username;
			if(isset($user->login)){$user_email = $user->login;}
		}
		$user = "";
	}
	
	if($size == "large"){$imgsize = Avatar_Large;}else{$imgsize = Avatar_Small;}

	// use the user uploaded avatars ?
	if(Enable_User_Upload_Avatar == true && $avatarsource == "useruploaded"){
		$imgsrc = my_pligg_base . User_Upload_Avatar_Folder . "/" . $user_name . "_" . $imgsize . ".jpg";
		return $imgsrc;
	}
			
	
	if($size == "large"){return my_base_url . my_pligg_base . Default_Gravatar_Large;}
	if($size == "small"){return my_base_url . my_pligg_base . Default_Gravatar_Small;}
}


function do_sidebar($var_smarty, $navwhere = '') {
	// show the categories in the sidebar
	global $db, $dblang, $globals, $the_cats;
	
	if($navwhere == ''){global $navwhere;}

	// fix for 'undefined index' errors
		if(!isset($navwhere['text4'])){$navwhere['text4'] = '';}else{$navwhere['text4'] = htmlspecialchars($navwhere['text4']);}
		if(!isset($navwhere['text3'])){$navwhere['text3'] = '';}else{$navwhere['text3'] = htmlspecialchars($navwhere['text3']);}
		if(!isset($navwhere['text2'])){$navwhere['text2'] = '';}else{$navwhere['text2'] = htmlspecialchars($navwhere['text2']);}
		if(!isset($navwhere['text1'])){$navwhere['text1'] = '';}else{$navwhere['text1'] = htmlspecialchars($navwhere['text1']);}
		if(!isset($navwhere['link4'])){$navwhere['link4'] = '';}
		if(!isset($navwhere['link3'])){$navwhere['link3'] = '';}
		if(!isset($navwhere['link2'])){$navwhere['link2'] = '';}
		if(!isset($navwhere['link1'])){$navwhere['link1'] = '';}
		$var_smarty->assign('navbar_where', $navwhere);
	
		$var_smarty->assign('body_args', '');	
	// fix for 'undefined index' errors

	$_caching = $var_smarty->cache; 	// get the current cache settings
	$var_smarty->cache = true; 			// cache has to be on otherwise is_cached will always be false
	$var_smarty->cache_lifetime = -1;   // lifetime has to be set to something otherwise is_cached will always be false
	$thetpl = $var_smarty->get_template_vars('the_template_sidebar_modules') . '/categories.tpl';

	// check to see if the category sidebar module is already cached
	// if it is, use it

        if(isset($_GET['category'])){
                $thecat = sanitize($_GET['category'], 3);
	}else{
		$thecat = '';
	}
	if ($var_smarty->is_cached($thetpl, 'sidebar|category|'.$thecat)) {
		$var_smarty->assign('cat_array', 'x'); // this is needed. sidebar.tpl won't include the category module if cat_array doesnt have some data
	}else{
                if(isset($_GET['category'])){
                        $thecat = get_cached_category_data('category_safe_name', urlencode(sanitize($_GET['category'], 1)));
			$thecat = $thecat->category_name;
		}
	
		$var_smarty->assign('UrlMethod', urlmethod);

		foreach($the_cats as $cat){
			if($cat->category_id == $thecat && $cat->category_lang == $dblang && $cat->category_parent == 0)
			{ 
				$globals['category_id'] = $cat->category_id;
				$globals['category_name'] = $cat->category_name;
			}
		}
	
		$pos = strrpos($_SERVER["SCRIPT_NAME"], "/");
		$script_name = substr($_SERVER["SCRIPT_NAME"], $pos + 1, 100);
		$script_name = str_replace(".php", "", $script_name);
	
		include_once('dbtree.php');
		$login_user = $db->escape(sanitize($_COOKIE['mnm_user'],3));
		if($login_user)
		{
		/////// for user set category----sorojit.
		    $sqlGeticategory = $db->get_var("SELECT user_categories from " . table_users . " where user_login = '$login_user';");
		    if ($sqlGeticategory)
		    {
			$right = array();
			$array1 = "SELECT * from " . table_categories . " where category__auto_id in ($sqlGeticategory) ORDER BY lft";
			$result1 = mysql_query($array1);
			while ($row = mysql_fetch_object($result1)) {
			    $a[]=$row;  
			}
			$result = $a;
			$i = 0;
			$lastspacer = 0;
			$array = array();
			// added @ thanks to `parterburn` - http://www.pligg.com/forum/showthread.php?t=4888
			foreach($result as $row)
			{
				if (count($right)>0) {
					// check if we should remove a node from the stack
					while ($right[count($right)-1]<$row->rgt) {
						if (array_pop($right) == NULL) {
							break;  // We've reached the top of the category chain
						}
					}
				}

				$array[$i]['principlecat'] = $row->rgt - $row->lft -1;
				$array[$i]['spacercount'] = count($right);
				$array[$i]['lastspacercount'] = $lastspacer;
				$array[$i]['spacerdiff'] = abs($lastspacer - count($right));
				$array[$i]['auto_id'] = $row->category__auto_id;
				$array[$i]['name'] = $row->category_name;
				$array[$i]['safename'] = $row->category_safe_name;
				if(isset($row->category_color)){$array[$i]['color'] = $row->category_color;}
				if(isset($row->category_parent)){
					$array[$i]['parent'] = $row->category_parent;
					$array[$i]['parent_name'] = GetCatName($row->category_parent);
					$array[$i]['parent_subcat_count'] = GetSubCatCount($row->category_parent);
				}
				$array[$i]['subcat_count'] = GetSubCatCount($row->category__auto_id);


				$lastspacer = count($right);
				$i = $i + 1;
				$right[] = $row->rgt;
			}
		    }
			///////end of for user set category
			$var_smarty->assign('start', 0);	
		}
		else
		{
			$array = tree_to_array(0, table_categories);
			$var_smarty->assign('start', 1);
		}
		$var_smarty->assign('lastspacer', 0);
		$var_smarty->assign('cat_array', $array);		
	
		// use the 'totals' table now 
		$published_count = get_story_count('published');
		
		$var_smarty->assign('published_count', $published_count);
//	    $sql = "select *,  count(*) as count from " . table_links . ", " . table_categories . " where category_lang='$dblang' and category_id=link_category group by link_category ORDER BY category_name ASC";
//		$categorylist = object_2_array($db->get_results($sql));
//		$var_smarty->assign('categorylist', $categorylist);
		$var_smarty->assign('category_url', getmyurl('maincategory'));

	}

	$var_smarty->cache = $_caching; // set cache back to original value

	$vars = '';
	check_actions('do_sidebar', $vars);

	return $var_smarty;
}


function force_authentication() {
	// requires user to login before viewing the page
	global $current_user;

	if(!$current_user->authenticated) {
		header("Location: " . getmyurl('login', $_SERVER['REQUEST_URI']));
		die;
	}
	return true;
}

function do_pages($total, $page_size, $thepage, $fetch = false) {
	// "previous" and "next" page buttons
	global $db, $URLMethod, $main_smarty;   
	
	$index_limit = 10;
	
	$current = get_current_page();
	$total_pages=ceil($total/$page_size);
	$start=max($current-intval($index_limit/2), 1);
	$end=$start+$index_limit-1;

	$output = '';

	if ($URLMethod == 1) {

		$query=preg_replace('/page=[0-9]+/', '', $_SERVER['QUERY_STRING']);
		$query=preg_replace('/^&*(.*)&*$/', "$1", $query);
		if(!empty($query)) $query = "&amp;$query";

		$output .= '<div class="pagination"><p>';

		if($current==1) {
			$output .= '<span class="pagesnonactive">&#171; '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Previous"). ' </span>';
		} else {
			$i = $current-1;
			$output .= '<a href="?page='.$i.$query.'">&#171; '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Previous").'</a>';
		}

		if($start>1) {
			$i = 1;
			$output .= '<a href="?page='.$i.$query.'">'.$i.'</a>';
			$output .= '<span>...</span>';
		}
		
		for ($i=$start;$i<=$end && $i<= $total_pages;$i++) {
			if($i==$current) {
				$output .= '<span class="pagescurrent">'.$i.'</span>';
			} else {
				$output .= '<a href="?page='.$i.$query.'" class="pages">'.$i.'</a>';
			}
		}
		
		if($total_pages>$end) {
			$i = $total_pages;
			$output .= '<span>...</span>';
			$output .= '<a href="?page='.$i.$query.'">'.$i.'</a>';
		}
		
		if($current<$total_pages) {
			$i = $current+1;
			$output .= '<a href="?page='.$i.$query.'"> '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Next"). ' &#187;' . '</a>';
		} else {
			$output .= '<span class="pagesnonactive"> '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Next"). ' &#187;' . '</span>';
		}
		$output .= "</p></div>\n";
	}	
	
	if ($URLMethod == 2) {                       

		$query=preg_replace('(login=)', '/', $_SERVER['QUERY_STRING']);	//remove login= from query string //
		$query=preg_replace('(view=)', '', $query);	                    //remove view= from query string //
		$query=preg_replace('(part=)', '', $query);
		$query=preg_replace('(order)', '', $query);	
		$query=preg_replace('/page=[0-9]+/', '', $query);  				//remove page arguments to because its hardcoded in html   //
		$query=preg_replace('/tag=true/', '', $query);  				//remove tag=true in tag query because its handled in .htaccess and hidden for a cleaner look//
		$query=preg_replace('/(.*)=(.*)/', '$1/$2', $query); 	 		//main line to recompose arg to place in url //	
		$query=preg_replace('/&/', '', $query);							//whack any ampersands	//	
		$query=preg_replace('/module\/pagestatistics/', '', $query);
		$query=preg_replace('/search\/(.*)/', 'search=$1', $query);	

		$output .= '<div class="pagination"><p>';

		if($current==1) {
			$output .= '<span>&#171; '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Previous"). '</span>'; } 
		else {
			$i = $current-1;
			if (pagename == "search") {
				$output .= '<a href="'.my_pligg_base.'/'.pagename.'.php?page='.$i.'&'.$query.'">&#171; '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Previous").'</a>';
			}
			elseif ($pagename == "admin_users") {
				$output .= '<a href="'.my_pligg_base.'/admin/'.pagename.'.php?page='.$i.'">&#171; '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Previous").'</a>';
			}
			elseif ($pagename == "admin_links") {
				$output .= '<a href="'.my_pligg_base.'/admin/'.pagename.'.php?page='.$i.'">&#171; '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Previous").'</a>';
			}
			elseif ($pagename == "index") {
				$output .= '<a href="'.my_pligg_base.'/published/page/'.$i.'/'.$query.'">&#171; '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Previous").'</a>';
			}
			else {
				$output .= '<a href="'.my_pligg_base.'/'.pagename.'/page/'.$i.'/'.$query.'">&#171; '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Previous").'</a>';
			}
		}

		if($start>1) {
			$i = 1;
			if (pagename == "search") {
				$output .= '<a href="'.my_pligg_base.'/'.pagename.'.php?page='.$i.'&'.$query.'">'.$i.'</a>';
			}
			elseif ($pagename == "admin_users") {
				$output .= '<a href="'.my_pligg_base.'/admin/'.pagename.'.php?page='.$i.'">'.$i.'</a>';
			}
			elseif ($pagename == "admin_links") {
				$output .= '<a href="'.my_pligg_base.'/admin/'.pagename.'.php?page='.$i.'">'.$i.'</a>';
			}
			else {
				$output .= '<a href="'.my_pligg_base.'/'.pagename.'/page/'.$i.'/'.$query.'">'.$i.'</a>';	
			}
			$output .= '<span>...</span>';
		}
		for ($i=$start;$i<=$end && $i<= $total_pages;$i++) {
			if($i==$current) {
				$output .= '<span class="pagescurrent">'.$i.'</span>';	} 
			else {
				if (pagename == "search") {
					$output .= '<a href="'.my_pligg_base.'/'.pagename.'.php?page='.$i.'&'.$query.'">'.$i.'</a>';
				}
				elseif ($pagename == "admin_users") {
					$output .= '<a href="'.my_pligg_base.'/admin/'.pagename.'.php?page='.$i.'">'.$i.'</a>';
				}
				elseif ($pagename == "admin_links") {
					$output .= '<a href="'.my_pligg_base.'/admin/'.pagename.'.php?page='.$i.'">'.$i.'</a>';
				}
				else {
					$output .= '<a href="'.my_pligg_base.'/'.pagename.'/page/'.$i.'/'.$query.'">'.$i.'</a>';
				}
			}	
		}
		
		if($total_pages>$end) {
			$i = $total_pages;
			$output .= '<span>...</span>';
			if (pagename == "search") {
				$output .= '<a href="'.my_pligg_base.'/'.pagename.'.php?page='.$i.'&'.$query.'">'.$i.'</a>';
			}
			elseif ($pagename == "admin_users") {
				$output .= '<a href="'.my_pligg_base.'/admin/'.pagename.'.php?page='.$i.'">'.$i.'</a>';
			}
			elseif ($pagename == "admin_links") {
				$output .= '<a href="'.my_pligg_base.'/admin/'.pagename.'.php?page='.$i.'">'.$i.'</a>';
			}
			else {
				$output .= '<a href="'.my_pligg_base.'/'.pagename.'/page/'.$i.'/'.$query.'">'.$i.'</a>';
			}
		}
		
		if($current<$total_pages) {
			$i = $current+1;
			if (pagename == "search") {
				$output .= '<a href="'.my_pligg_base.'/'.pagename.'.php?page='.$i.'&'.$query.'"> '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Next"). ' &#187;' . '</a>';
			}
			elseif (pagename == "admin_users") {
				$output .= '<a href="'.my_pligg_base.'/admin/'.pagename.'.php?page='.$i.'"> '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Next"). ' &#187;' . '</a>';
			}
			elseif (pagename == "admin_links") {
				$output .= '<a href="'.my_pligg_base.'/admin/'.pagename.'.php?page='.$i.'"> '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Next"). ' &#187;' . '</a>';
			}
			else {
				$output .= '<a href="'.my_pligg_base.'/'.pagename.'/page/'.$i.'/'.$query.'"> '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Next"). ' &#187;' . '</a>'; 
			} 
		}		
		else {
			$output .= '<span> '.$main_smarty->get_config_vars("PLIGG_Visual_Page_Next"). ' &#187;' . '</span>';	}
		
		$output .= "</p></div>";
	}
	if($fetch == false){
		echo $output;
	} else {
		return $output;
	}
}

function generateHash($plainText, $salt = null){
    if ($salt === null) {
        $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH); }
    else {
        $salt = substr($salt, 0, SALT_LENGTH); 
	}		
    return $salt . sha1($salt . $plainText);
}

function getmyFullurl($x, $var1="", $var2="", $var3="") {
	return my_base_url . getmyurl($x, $var1, $var2, $var3);
}

function getmyurl($x, $var1="", $var2="", $var3="") {
	global $URLMethod;
	
	// DB 08/05/08
	$var1 = sanitize($var1,1);
	$var2 = sanitize($var2,1);
	$var3 = sanitize($var3,1);
	/////

	If ($x == "storyURL") {
		// var 1 = category_safe_name
		// var 2 = title_url
		// var 3 = story id
		if(enable_friendly_urls == true){
		    if(enable_friendly_caturls == true){
					return getmyurl("storycattitle", $var1, $var2);
		    } else {
					return getmyurl("storytitle", $var2);
		    }
		} else {
			return getmyurl("story", $var3);
		}
	}
	
	
	if ($URLMethod == 1) {
	
		If ($x == "index") {return my_pligg_base."/index.php";}
		If ($x == "maincategory") {return my_pligg_base."/index.php?category=" . $var1;}
		If ($x == "queuedcategory") {return my_pligg_base."/upcoming.php?category=" . $var1;}
		If ($x == "discardedcategory") {return my_pligg_base."/discarded.php?category=" . $var1;}
		If ($x == "editlink") {return my_pligg_base."/editlink.php?id=" . $var1;}
		If ($x == "edit") {return my_pligg_base."/edit.php?id=" . $var1 . "&amp;commentid=" . $var2;}
		If ($x == "user") {return my_pligg_base."/user.php?login=" . $var1;}
		If ($x == "user_inbox") {return my_pligg_base."/user.php?view=" . $var1;}
		If ($x == "user_add_remove") {return my_pligg_base."/user.php?login=" . $var1. "&amp;view=" . $var2;}
		If ($x == "user_add_links") {return my_pligg_base."/user_add_remove_links.php?action=add&amp;link=" . $var1;}
		If ($x == "user_remove_links") {return my_pligg_base."/user_add_remove_links.php?action=remove&amp;link=" . $var1;}
		If ($x == "user_friends") {return my_pligg_base."/user.php?login=" . $var1. "&amp;view=" . $var2;}
		If ($x == "index_sort") {return my_pligg_base."/index.php?part=".$var1.$var2;}
		If ($x == "userblank") {return my_pligg_base."/user.php?login=";}
		If ($x == "user2") {return my_pligg_base."/user.php?login=".$var1."&amp;view=".$var2;}
		If ($x == "search") {return my_pligg_base."/search.php?search=" . $var1;}
		If ($x == "advancedsearch") {return my_pligg_base."/advancedsearch.php";}
		If ($x == "search_url") {return my_pligg_base."/search.php?url=" . $var1;}
		If ($x == "login") {return my_pligg_base."/login.php?return=" . $var1;}
		If ($x == "logout") {return my_pligg_base."/login.php?op=logout&return=" . $var1;}
		If ($x == "register") {return my_pligg_base."/register.php";}
		If ($x == "category") {return my_pligg_base."/index.php?category=" . $var1;}
		If ($x == "submit") {return my_pligg_base."/submit.php";}
		If ($x == "story") {return my_pligg_base."/story.php?id=" . $var1;}
		If ($x == "storytitle") {return my_pligg_base."/story.php?title=" . $var1;}
		If ($x == "storycattitle") {return my_pligg_base."/story.php?title=" . $var2;}
		If ($x == "out") {return my_pligg_base."/out.php?id=" . $var1;}
		If ($x == "outtitle") {return my_pligg_base."/out.php?title=" . $var1;}
		If ($x == "outurl") {return my_pligg_base."/out.php?url=" . rawurlencode($var1);}
		If ($x == "root") {return my_pligg_base."/index.php";}
		If ($x == "upcoming") {return my_pligg_base."/upcoming.php";}
		If ($x == "upcoming_sort") {return my_pligg_base."/upcoming.php?part=upcoming&amp;order=".$var1.$var2;}
		If ($x == "discarded") {return my_pligg_base."/discarded.php";}
		If ($x == "topusers") {return my_pligg_base."/topusers.php";}
		If ($x == "profile") {return my_pligg_base."/profile.php";}
		If ($x == "userNoVar") {return my_pligg_base."/user.php";}
		If ($x == "loginNoVar") {return my_pligg_base."/login.php";}
		If ($x == "rssTime") {return my_pligg_base."/rss.php?time=" . $var1;}
		If ($x == "about") {return my_pligg_base."/faq-".$var1.".php";}
		If ($x == "bugreport") {return my_pligg_base."/bugreport.php";}
		If ($x == "rsspage") {return my_pligg_base."/rss.php?category=$var1&status=$var2&group=$var3";}
		If ($x == "rss") {return my_pligg_base."/rss.php";}
		If ($x == "rssqueued") {return my_pligg_base."/rss.php?status=queued";}
		If ($x == "rssall") {return my_pligg_base."/rss.php?status=all";}
		If ($x == "rsscategory") {return my_pligg_base."/rss.php?category=". $var1;}
		If ($x == "rsscategoryqueued") {return my_pligg_base."/rss.php?status=queued&amp;category=". $var1;}
		If ($x == "rsssearch") {return my_pligg_base."/rss.php?search=". $var1;}
		If ($x == "rssuser") {return my_pligg_base."/userrss.php?user=". $var1. "&amp;status=" . $var2;}
		If ($x == "trackback") {return my_pligg_base."/trackback.php?id=" . $var1;}
		If ($x == "page") {return my_pligg_base."/page.php?page=" . $var1;}
		If ($x == "upcoming_cat") {return my_pligg_base."/?category=";}
		If ($x == "discarded_cat") {return my_pligg_base."/?category=";}
        If ($x == "admin") {return my_pligg_base."/admin/index.php";}
        If ($x == "admin_modify") {return my_pligg_base."/admin/linkadmin.php?id=" . $var1 . "&amp;action=main";}
        If ($x == "admin_modify_do") {return my_pligg_base."/admin/linkadmin.php?id=" . $var1 . "&amp;action=do" . $var2;}
        If ($x == "admin_modify_edo") {return my_pligg_base."/admin/linkadmin.php?id=" . $var1 . "&amp;action=edo" . $var2;}
        If ($x == "admin_discard") {return my_pligg_base."/admin/linkadmin.php?id=" . $var1 . "&amp;action=discard";}
        If ($x == "admin_queued") {return my_pligg_base."/admin/linkadmin.php?id=" . $var1 . "&amp;action=queued";}
        If ($x == "admin_published") {return my_pligg_base."/admin/linkadmin.php?id=" . $var1 . "&amp;action=published";}
		If ($x == "editcomment") {return my_pligg_base."/edit.php?id=" . $var2 . "&amp;commentid=" . $var1;}
		If ($x == "tagcloud") {return my_pligg_base."/cloud.php";}
		If ($x == "tagcloud_range") {return my_pligg_base."/cloud.php?range=" . $var1;}
		If ($x == "live_comments") {return my_pligg_base."/live_comments.php";}
		If ($x == "live_published") {return my_pligg_base."/live_published.php";}
		If ($x == "live_unpublished") {return my_pligg_base."/live_unpublished.php";}
		If ($x == "tag") {return my_pligg_base."/search.php?search=" . $var1 . "&amp;tag=true";}
		If ($x == "tag2") {return my_pligg_base."/search.php?search=" . $var1 . "&amp;tag=true&amp;from=" . $var2;}
		If ($x == "live") {return my_pligg_base."/live.php";}
		If ($x == "template") {return my_pligg_base."/settemplate.php";}
		If ($x == "settemplate") {return my_pligg_base."/settemplate.php?template=" .$var1;}
		
		//group links
		If ($x == "groups") {return my_pligg_base."/groups.php";}
		If ($x == "submit_groups") {return my_pligg_base."/submit_groups.php";}
		If ($x == "group_story") {return my_pligg_base."/group_story.php?id=" . $var1;}
		If ($x == "group_story_title") {return my_pligg_base."/group_story.php?title=" . $var1;}
		If ($x == "group_story2") {return my_pligg_base."/group_story.php?title=".$var1."&amp;view=".$var2."&amp;id=".$var3;}
		If ($x == "join_group") {return my_pligg_base."/join_group.php?id=" . $var1 . "&amp;privacy=".$var2."&amp;join=true";}
		If ($x == "unjoin_group") {return my_pligg_base."/join_group.php?id=" . $var1 . "&amp;privacy=".$var2."&amp;join=false";}
		If ($x == "join_group_withdraw") {return my_pligg_base."/join_group.php?group_id=" . $var1 . "&amp;user_id=".$var2."&amp;activate=withdraw";}
		
		//If ($x == "group_admin") {return my_pligg_base."/groupadmin.php?id=" . $var1 . "&amp;role=admin";}
		If ($x == "group_admin") {return my_pligg_base."/groupadmin.php?id=" . $var1 . "&amp;role=admin&amp;userid=" . $var3;}
		If ($x == "group_normal") {return my_pligg_base."/groupadmin.php?id=" . $var1 . "&amp;role=normal&amp;userid=" . $var3;}
		If ($x == "group_moderator") {return my_pligg_base."/groupadmin.php?id=" . $var1 . "&amp;role=moderator&amp;userid=" . $var3;}
		If ($x == "group_flagged") {return my_pligg_base."/groupadmin.php?id=" . $var1 . "&amp;role=flagged&amp;userid=" . $var3;}
		If ($x == "group_banned") {return my_pligg_base."/groupadmin.php?id=" . $var1 . "&amp;role=banned&amp;userid=" . $var3;}
		If ($x == "group_avatar") {return my_pligg_base."/group_avatar.php?id=" . $var1;}
		If ($x == "group_sort") {return my_pligg_base."/groups.php?sortby=".$var1.$var2;}
		
		//new modules
		If ($x == "user_add_links_private") {return my_pligg_base."/user_add_remove_links.php?action=addprivate&amp;link=" . $var1;}
		If ($x == "user_add_links_public") {return my_pligg_base."/user_add_remove_links.php?action=addpublic&amp;link=" . $var1;}
		
		If ($x == "group_story_links_publish") {return my_pligg_base."/join_group.php?action=publish&amp;link=" . $var1;}
		If ($x == "group_story_links_queued") {return my_pligg_base."/join_group.php?action=queued&amp;link=" . $var1;}
		If ($x == "group_story_links_discard") {return my_pligg_base."/join_group.php?action=discard&amp;link=" . $var1;}
		
		If ($x == "admin_categories_tasks") {return my_pligg_base."/admin_categories_tasks.php?action=" . $var1;}
		
		If ($x == "editgroup") {return my_pligg_base."/editgroup.php?id=" . $var1;}
		If ($x == "deletegroup") {return my_pligg_base."/deletegroup.php?id=" . $var1;}
		
	}
	if ($URLMethod == 2) { 
	
		If ($x == "maincategory") {return my_pligg_base."/category/" . $var1;}
		If ($x == "queuedcategory") {return my_pligg_base."/upcoming/category/" . $var1;}
		If ($x == "discardedcategory") {return my_pligg_base."/discarded/category/" . $var1;}
		If ($x == "editlink") {return my_pligg_base."/story/" . $var1 . "/edit/";}
		If ($x == "edit") {return my_pligg_base."/story/" . $var1 . "/editcomment/" . $var2;}
		If ($x == "user") {return my_pligg_base."/user/view/profile/" . $var1;}
		If ($x == "user_friends") {return my_pligg_base."/user/view/" . $var2;}
		If ($x == "user_add_remove") {return my_pligg_base."/user/view/" . $var2. "/login/" . $var1;}
		If ($x == "user_add_links") {return my_pligg_base."/user/add/link/" . $var1;}
		If ($x == "user_remove_links") {return my_pligg_base."/user/remove/link/" . $var1;}
		If ($x == "user_inbox") {return my_pligg_base."/inbox";}
		If ($x == "userblank") {return my_pligg_base."/user/";}
		If ($x == "user2") {return my_pligg_base."/user/view/" . $var2 . "/login/" . $var1;}
		If ($x == "index") {return my_pligg_base."/published/";}
		If ($x == "index_sort") {return my_pligg_base."/published/" . $var1 . "/".$var2;}
		If ($x == "search") {return my_pligg_base."/search/" . $var1;}
		If ($x == "search") {return my_pligg_base."/advanced-search/" . $var1;}
		If ($x == "search_url") {return my_pligg_base."/searchurl/" . $var1;}
		If ($x == "login") {return my_pligg_base."/login.php?return=" . $var1;}
		If ($x == "logout") {return my_pligg_base."/login.php?op=logout&return=index.php";}
		If ($x == "register") {return my_pligg_base."/register";}
		If ($x == "submit") {return my_pligg_base."/submit";}
		If ($x == "story") {return my_pligg_base."/story/" . $var1;}
		If ($x == "storytitle") {return my_pligg_base."/story/title/" . $var1;}
		If ($x == "storycattitle") {return my_pligg_base."/category/" . $var1 . "/" . $var2 ."/";}
		If ($x == "out") {return my_pligg_base."/out/" . $var1 . "/";}
		If ($x == "outtitle") {return my_pligg_base."/out/" . $var1;}
		If ($x == "root") {return my_pligg_base."/";}
		If ($x == "upcoming") {return my_pligg_base."/upcoming";}
		If ($x == "upcoming_sort") {return my_pligg_base."/upcoming/" .$var1."/".$var2;}
		If ($x == "topusers") {return my_pligg_base."/topusers";}
		If ($x == "profile") {return my_pligg_base."/profile";}
		If ($x == "userNoVar") {return my_pligg_base."/user";}
		If ($x == "loginNoVar") {return my_pligg_base."/login";}
		If ($x == "rssTime") {return my_pligg_base."/rss.php?time=" . $var1;}
		If ($x == "about") {return my_pligg_base."/about/".$var1;}
		If ($x == "rss") {return my_pligg_base."/rss";}
		If ($x == "rssuser") {return my_pligg_base."/rss/user/" . $var1 . "/";}
		If ($x == "rssqueued") {return my_pligg_base."/rss/" . $var1;}
		If ($x == "rssall") {return my_pligg_base."/rss/" . $var1;}
		If ($x == "rsscategory") {return my_pligg_base."/rss/category/" . $var1;}
		If ($x == "rsscategoryqueued") {return my_pligg_base."/rss/category/upcoming/" . $var1;}
		If ($x == "rsssearch") {return my_pligg_base."/rss/search" . $var1 . "/";}
		If ($x == "page") {return my_pligg_base."/page/" . $var1 . "/";}
		If ($x == "editcomment") {return my_pligg_base."/story/" . $var2 . "/editcomment/" . $var1;} //leave the . in "./editcomment" because full url should be /story/15/editcomment/2
		If ($x == "tagcloud") {return my_pligg_base."/tagcloud";}
		If ($x == "tagcloud_range") {return my_pligg_base."/tagcloud/range/" . $var1;}
		If ($x == "live_comments") {return my_pligg_base."/comments";}
		If ($x == "live_published") {return my_pligg_base."/live_published";}
		If ($x == "live_unpublished") {return my_pligg_base."/unpublished";}
		If ($x == "tag") {return my_pligg_base."/tag/" . $var1;}
		If ($x == "tag2") {return my_pligg_base."/tag/" . $var1 . "/" . $var2 . "/";}
		If ($x == "live") {return my_pligg_base."/live";}
		If ($x == "template") {return my_pligg_base."/settemplate";}
		If ($x == "settemplate") {return my_pligg_base."/settemplate/" .$var1;}
		If ($x == "admin") {return my_pligg_base."/admin";}
		If ($x == "admin_modify") {return my_pligg_base."/story/" . $var1 . "/modify/main/";}
		If ($x == "admin_modify_do") {return my_pligg_base."/story/" . $var1 . "/modify/do" . $var2 . "/";}
		If ($x == "admin_modify_edo") {return my_pligg_base."/story/" . $var1 . "/modify/edo" . $var2 . "/";}
		If ($x == "admin_discard") {return my_pligg_base."/story/" . $var1 . "/modify/discard/";}
		If ($x == "admin_queued") {return my_pligg_base."/story/" . $var1 . "/modify/queued/";}
		If ($x == "admin_published") {return my_pligg_base."/story/" . $var1 . "/modify/published/";}
		
		If ($x == "groups") {return my_pligg_base."/groups/all/";}
		If ($x == "submit_groups") {return my_pligg_base."/groups/submit";}
		If ($x == "group_story") {return my_pligg_base."/groups/id/" . $var1;}
		If ($x == "group_story_title") {return my_pligg_base."/groups/title/" . $var1;}
		If ($x == "group_story2") {return my_pligg_base."/groups/" . $var1 . "/" . $var2;}
		If ($x == "join_group") {return my_pligg_base."/groups/join/id/" . $var1 . "/privacy/".$var2."/join/true";}
		If ($x == "unjoin_group") {return my_pligg_base."/groups/unjoin/id/" . $var1 . "/privacy/".$var2."/join/false";}
		//If ($x == "join_group") {return my_pligg_base."/join_group/" . $var1 . "/" . $var2 . "/";}
		//If ($x == "unjoin_group") {return my_pligg_base."/unjoin_group/" . $var1 . "/" . $var2 . "/";}
		If ($x == "join_group_withdraw") {return my_pligg_base."/groups/withdraw/id/" . $var1 . "/user_id/".$var2."/activate/withdraw";}
		
		If ($x == "group_admin") {return my_pligg_base."/groups/member/admin/id/" . $var1 . "/role/admin/userid/" . $var3;}
		If ($x == "group_normal") {return my_pligg_base."/groups/member/normal/id/" . $var1 . "/role/normal/userid/" . $var3;}
		If ($x == "group_moderator") {return my_pligg_base."/groups/member/moderator/" . $var1 . "/role/moderator/userid/" . $var3;}
		If ($x == "group_flagged") {return my_pligg_base."/groups/member/flagged/" . $var1 . "/role/flagged/userid/" . $var3;}
		If ($x == "group_banned") {return my_pligg_base."/groups/member/banned/id/" . $var1 . "/role/banned/userid/" . $var3;}
		
		If ($x == "group_avatar") {return my_pligg_base."/group_avatar/" . $var1;}
		If ($x == "group_sort") {return my_pligg_base."/groups". $var1 ."/". $var2;}
		
		If ($x == "user_add_links_private") {return my_pligg_base."/user_add_remove_links/action/addprivate/link/" . $var1;}
		If ($x == "user_add_links_public") {return my_pligg_base."/user_add_remove_links/action/addpublic/link/" . $var1;}
		
		If ($x == "editgroup") {return my_pligg_base."/groups/edit/id/" . $var1;}
		If ($x == "deletegroup") {return my_pligg_base."/groups/delete/id/" . $var1;}
		
		If ($x == "group_story_links_publish") {return my_pligg_base."/join_group/action/publish/link" . $var1;}
		If ($x == "group_story_links_queued") {return my_pligg_base."/join_group/action/queued/link" . $var1;}
		If ($x == "group_story_links_discard") {return my_pligg_base."/join_group/action/discard/link" . $var1;}
		If ($x == "admin_categories_tasks") {return my_pligg_base."/admin_categories_tasks/action/" . $var1;}
	}
}

function SetSmartyURLs($main_smarty) {
	global $dblang, $URLMethod;
	if(strpos($_SERVER['PHP_SELF'], "login.php") === false){
		$main_smarty->assign('URL_login', htmlentities(getmyurl("login", $_SERVER['REQUEST_URI'])));
	} else{
		$main_smarty->assign('URL_login', getmyurl("loginNoVar"));
	}
	$main_smarty->assign('URL_logout', htmlentities(getmyurl("logout", $_SERVER['REQUEST_URI'])));
	
	//echo $v = getmyurl("pligg_index");
	//echo $v = my_base_url;
	//echo $v = getmyurl("index");
	
	//exit;
	
	$main_smarty->assign('URL_home', getmyurl("pligg_index"));	
	$main_smarty->assign('URL_register', getmyurl("register"));
	$main_smarty->assign('URL_root', getmyurl("root"));
	$main_smarty->assign('URL_index', getmyurl("index"));
	$main_smarty->assign('URL_search', getmyurl("search"));
	$main_smarty->assign('URL_advancedsearch', getmyurl("advancedsearch"));
	$main_smarty->assign('URL_maincategory', getmyurl("maincategory"));
	$main_smarty->assign('URL_queuedcategory', getmyurl("queuedcategory"));
	$main_smarty->assign('URL_category', getmyurl("category"));
	$main_smarty->assign('URL_user', getmyurl("user"));
	$main_smarty->assign('URL_userNoVar', getmyurl("userNoVar"));
	$main_smarty->assign('URL_user_inbox', getmyurl("user_inbox", "inbox"));
	$main_smarty->assign('URL_user_add_remove', getmyurl("user_add_remove"));
	$main_smarty->assign('URL_profile', getmyurl("profile"));
	$main_smarty->assign('URL_story', getmyurl("story"));
	$main_smarty->assign('URL_storytitle', getmyurl("storytitle"));
	$main_smarty->assign('URL_topusers', getmyurl("topusers"));
	$main_smarty->assign('URL_about', getmyurl("about", $dblang));
    	if(isset($_GET['category']) && sanitize($_GET['category'],1) != '' && strpos($_SERVER['PHP_SELF'], "upcoming.php") === false) {
            $main_smarty->assign('URL_upcoming', getmyurl("queuedcategory").sanitize(sanitize($_GET['category'],1),3));
	} else {
	    $main_smarty->assign('URL_upcoming', getmyurl("upcoming"));
	}
    	if(isset($_GET['category']) && sanitize($_GET['category'],1) != '' && strpos($_SERVER['PHP_SELF'], "index.php") === false) {
            $main_smarty->assign('URL_base', getmyurl("maincategory",sanitize(sanitize($_GET['category'],1),3)));
    	} else {
            $main_smarty->assign('URL_base', getmyurl("index"));
	}
	/////
	$main_smarty->assign('URL_submit', getmyurl("submit"));
	$main_smarty->assign('URL_rss', getmyurl("rss"));
	$main_smarty->assign('URL_rsscategory', getmyurl("rsscategory"));
	$main_smarty->assign('URL_rsscategoryqueued', getmyurl("rsscategoryqueued"));
	$main_smarty->assign('URL_rssqueued', getmyurl("rssqueued", "queued"));
	$main_smarty->assign('URL_rssall', getmyurl("rssall", "all"));
	$main_smarty->assign('URL_rsssearch', getmyurl("rsssearch"));
	$main_smarty->assign('URL_admin', getmyurl("admin"));
	$main_smarty->assign('URL_admin_users', getmyurl("admin_users"));
	$main_smarty->assign('URL_admin_language', getmyurl("admin_language"));
	$main_smarty->assign('URL_admin_categories', getmyurl("admin_categories"));
	$main_smarty->assign('URL_admin_backup', getmyurl("admin_backup"));
	$main_smarty->assign('URL_admin_modules', getmyurl("admin_modules"));
	$main_smarty->assign('URL_admin_config', getmyurl("admin_config"));
	$main_smarty->assign('URL_admin_rss', getmyurl("admin_rss"));
	$main_smarty->assign('URL_tagcloud', getmyurl("tagcloud"));
	$main_smarty->assign('URL_tagcloud_range', getmyurl("tagcloud_range"));
	$main_smarty->assign('URL_live', getmyurl("live"));
	$main_smarty->assign('URL_unpublished', getmyurl("live_unpublished"));
	$main_smarty->assign('URL_published', getmyurl("live_published"));
	$main_smarty->assign('URL_comments', getmyurl("live_comments"));
	$main_smarty->assign('URL_template', getmyurl("template"));
	$main_smarty->assign('URL_settemplate', getmyurl("settemplate"));
	
	$main_smarty->assign('URL_groups', getmyurl("groups"));
	$main_smarty->assign('URL_submit_groups', getmyurl("submit_groups"));
	$main_smarty->assign('URL_join_group', getmyurl("join_group"));
	$main_smarty->assign('unjoin_group', getmyurl("unjoin_group"));
	return $main_smarty;
}

function friend_MD5($userA, $userB) {
	include_once(mnminclude.'user.php');
	$user=new User();
	$user->username = $userA;
	if(!$user->read()) {
		echo "a-" . $userA . "error 2";
		die;
	}
	$userAdata = $user->username . $user->date;

	$user=new User();
	$user->username = $userB;
	if(!$user->read()) {
		echo "b-" . $userB . "error 2";
		die;
	}
	$userBdata = $user->username . $user->date;

	$themd5 = md5($userAdata . $userBdata);
	return $themd5;
}

function totals_regenerate(){
	global $db, $cached_totals;
	
	$name = 'queued';
	$count = $db->get_var("SELECT count(*) FROM " . table_links . " WHERE link_status='$name';");
	$db->query("UPDATE `" . table_totals . "` set `total` = $count where `name` = '$name';");	
	$cached_totals[$name] = $count;

	$name = 'published';
	$count = $db->get_var("SELECT count(*) FROM " . table_links . " WHERE link_status='$name';");
	$db->query("UPDATE `" . table_totals . "` set `total` = $count where `name` = '$name';");	
	$cached_totals[$name] = $count;

	if(caching == 1){
		// this is to clear the cache and reload it for settings_from_db.php
		$db->cache_dir = mnmpath.'cache';
		$db->use_disk_cache = true;
		$db->cache_queries = true;
		$db->cache_timeout = 0;
		$totals = $db->get_results("SELECT * FROM `" . table_totals . "`");
		$db->cache_queries = false;
	}

	return true;
}

function totals_adjust_count($name, $adjust){
	global $db, $cached_totals;

	$name = $db->escape($name);
	$db->query('UPDATE '.table_totals.' SET total=total+'.$adjust.' WHERE name="'.$name.'"');
	$cached_totals[$name] = $db->get_var('SELECT total FROM '.table_totals.' WHERE name="'.$name.'"');

	if(caching == 1){
		// this is to clear the cache and reload it for settings_from_db.php
		$db->cache_dir = mnmpath.'cache';
		$db->use_disk_cache = true;
		$db->cache_queries = true;
		$db->cache_timeout = 0;
		$totals = $db->get_results("SELECT * FROM `" . table_totals . "`");
		$db->cache_queries = false;
	}
	
	return true;
}

function get_story_count($name){
	global $db, $cached_totals;

	$name = $db->escape($name);
	if(summarize_mysql == 1){
		if(isset($cached_totals[$name])){
			return $cached_totals[$name];
		} else {
			
			if(caching == 1){
				$db->cache_dir = mnmpath.'cache';
				$db->use_disk_cache = true;
				$db->cache_queries = true;
			}
			
			$totals = $db->get_results("SELECT * FROM `" . table_totals . "`");

			$db->cache_queries = false;

			foreach ($totals as $total) {
				$cached_totals[$total->name] = $total->total;
			}
			return $cached_totals[$name];
		}
	}else{	
		return $db->get_var("SELECT count(*) FROM " . table_links . " WHERE link_status='$name';");
	}
}
?>
