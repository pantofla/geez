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
include(mnminclude.'smartyvariables.php');
include_once(mnminclude.'dbtree.php');
include(mnminclude.'qeip_0_3.php');

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

if(caching == 1){
	// this is to clear the cache and reload it for settings_from_db.php
	clearCatCache();
}

// breadcrumbs and page title
$navwhere['text1'] = $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel');
$navwhere['link1'] = getmyurl('admin', '');
$navwhere['text2'] = $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel_2');
$navwhere['link2'] = my_pligg_base . "/admin_categories.php";
$main_smarty->assign('navbar_where', $navwhere);
$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel'));

if($canIhaveAccess == 1)
{
	// clear the category sidebar module from the cache so it can regenerate in case we make changes
	$main_smarty->cache = 2; 
	$main_smarty->cache_dir = "cache";
	$main_smarty->clear_cache();
	$main_smarty->cache = false; 

	$main_smarty = do_sidebar($main_smarty);

	$QEIPA = array('table_name' => table_categories,  // the name of the table to use
			          'field_name' => 'category_name',  // the name of the field in the table
			          'key' => 'category__auto_id');  // a unique identifier for the row
	$main_smarty->assign('qeip_CatName', $QEIPA);

	$QEIPA = array('table_name' => table_categories,  // the name of the table to use
			          'field_name' => 'category_parent',  // the name of the field in the table
			          'key' => 'category__auto_id');  // a unique identifier for the row
	$main_smarty->assign('qeip_CatParent', $QEIPA);

	$QEIPA = array('table_name' => table_categories,  // the name of the table to use
			          'field_name' => 'category_order',  // the name of the field in the table
			          'key' => 'category__auto_id');  // a unique identifier for the row
	$main_smarty->assign('qeip_CatOrder', $QEIPA);

	$QEIPA = array('table_name' => table_categories,  // the name of the table to use
			          'field_name' => 'category_desc',  // the name of the field in the table
			          'key' => 'category__auto_id');  // a unique identifier for the row
	$main_smarty->assign('qeip_CatDesc', $QEIPA);

	$QEIPA = array('table_name' => table_categories,  // the name of the table to use
			          'field_name' => 'category_keywords',  // the name of the field in the table
			          'key' => 'category__auto_id');  // a unique identifier for the row
	$main_smarty->assign('qeip_CatMeta', $QEIPA);
	
	$QEIPA = array('table_name' => table_categories,  // the name of the table to use
			          'field_name' => 'category_author_level',  // the name of the field in the table
			          'key' => 'category__auto_id');  // a unique identifier for the row
	$main_smarty->assign('qeip_CatAuthor', $QEIPA);
	
	// DB 11/12/08
	$QEIPA = array('table_name' => table_categories,  // the name of the table to use
			          'field_name' => 'category_author_group',  // the name of the field in the table
			          'key' => 'category__auto_id');  // a unique identifier for the row
	$main_smarty->assign('qeip_CatGroup', $QEIPA);
	/////
	
	$smarty = $main_smarty;
	$QEIP = new QuickEIP();
	$main_smarty = $smarty;	

	// pagename
	define('pagename', 'admin_categories'); 
	$main_smarty->assign('pagename', pagename);

	rebuild_the_tree();
	ordernew();

// put the category tree into an array for use in the qeip dropdown

	$action = isset($_REQUEST['action']) && sanitize($_REQUEST['action'], 3) != '' ? sanitize($_REQUEST['action'], 3) : "view";
	
	if($action == "htaccess"){
		$htaccess = '../.htaccess';
		if (file_exists($htaccess)) {
		    echo "The file $htaccess already exists. To protect you from accidentally removing it, you must manually remove it from your server before moving on.";
		} else {
		    rename("../htaccess.default", "../.htaccess");
			echo "We have renamed htaccess.default to .htaccess for you. You still need to manually add the special category structure for it to fully work.";
		}
	}
	
	if($action == "save"){
		echo $QEIP->save_field();
		Cat_Safe_Names();
		if(caching == 1){
			// we need to do this here to ensure that other users see our newly save name
			clearCatCache();
		}
	}

	if($action == "add"){
		$sql = "insert into `" . table_categories . "` (`category_name`) VALUES ('new category');";
		$db->query($sql);
		$last_IDsql = $db->get_var("SELECT category__auto_id from " . table_categories . " where category_name = 'new category';");
		
		$User_cat = mysql_query("SELECT * from " . table_users . "");
		while ($row = mysql_fetch_array($User_cat)) {
		    
			$UserId = $row['user_id'];
			$new_cat = $row['user_categories'].",".$last_IDsql;
			$sql = "UPDATE " . table_users . " set user_categories='$new_cat' WHERE user_id = '$UserId'";	
			$query = mysql_query($sql);
		}
		
		
		
		rebuild_the_tree();
		ordernew();
		Cat_Safe_Names();
		header("Location: admin_categories.php");
	}

	if($action == "changecolor"){
		$id = sanitize($_REQUEST['id'], 3);
		$color = sanitize($_REQUEST['color'], 3);
		$color = utf8_str_replace('#', '', $color);
		if (!is_numeric($id)) die();
	
		$sql = "update ".table_categories." set category_color = '" . $color . "' where category__auto_id=" . $id . ";";
		echo $sql;
		$db->query($sql);

		Cat_Safe_Names();
	}

	if($action == "remove"){
		$id = sanitize($_REQUEST['id'], 3);
		if (!is_numeric($id)) die();

		$sql = "delete from ".table_categories." where category__auto_id=" . $id . ";";
		$db->query($sql);
		header("Location: admin_categories.php");
	}

	if($action == "changeparent"){
		$id = utf8_substr(sanitize($_REQUEST['id'], 3), 9, 100);
		$parent = utf8_substr(sanitize($_REQUEST['parent'], 3), 9, 100);
		if (!is_numeric($id)) die();
		
		children_id_to_array($array, table_categories, $id);
		if(is_array($array)){
			if(in_array($parent, $array)){
				die('You cannot move a category into it\'s own subcategory. Click <a href = "admin_categories.php">here</a> to reload.');
			}
		}
		
		if($id == $parent) {header("Location: admin_categories.php");die();}

		$sql = "update ".table_categories." set category_parent = " . $parent . " where category__auto_id=" . $id . ";";
		$db->query($sql);
		rebuild_the_tree();
		header("Location: admin_categories.php");
	}

	if($action == "move_above"){
		$id = utf8_substr(sanitize($_REQUEST['id_to_move'], 3), 9, 100);
		$move_id = utf8_substr(sanitize($_REQUEST['moveabove_id'], 3), 6, 100);
		if (!is_numeric($id)) die();
		if (!is_numeric($move_id)) die();

		if($id == $move_id) {header("Location: admin_categories.php");}

		$array = "";
		children_id_to_array($array, table_categories, $id);
		if(is_array($array)){
			if(!in_array($move_id, $array))
			{
				$sql = "Select * from ".table_categories." where category__auto_id=" . $move_id . ";";
				$results = $db->get_row($sql);
				$move_sort = $results->category_order;
				
				$sql = "update ".table_categories." set category_parent = ".$results->category_parent.", category_order = " . ($move_sort - 1) . " where category__auto_id=" . $id . ";";
				$db->query($sql);
				rebuild_the_tree();
				header("Location: admin_categories.php");
			}else{
				die('You cannot move a category into it\'s own subcategory. Click <a href = "admin_categories.php">here</a> to reload.');
			}
		}else{
			$sql = "Select * from ".table_categories." where category__auto_id=" . $move_id . ";";
			$results = $db->get_row($sql);
			$move_sort = $results->category_order;
			
			$sql = "update ".table_categories." set category_parent = ".$results->category_parent.", category_order = " . ($move_sort - 1) . " where category__auto_id=" . $id . ";";
			$db->query($sql);
			rebuild_the_tree();
			header("Location: admin_categories.php");
		}
	}

	if($action == "move_below"){
		$id = utf8_substr(sanitize($_REQUEST['id_to_move'], 3), 9, 100);
		$move_id = utf8_substr(sanitize($_REQUEST['movebelow_id'], 3), 6, 100);
		if (!is_numeric($id)) die();
		if (!is_numeric($move_id)) die();
		
		if($id == $move_id) {header("Location: admin_categories.php");}

		$array = "";
		children_id_to_array($array, table_categories, $id);
		if(is_array($array)){
			if(!in_array($move_id, $array))
			{
				$sql = "Select * from ".table_categories." where category__auto_id=" . $move_id . ";";
				$results = $db->get_row($sql);
				$move_sort = $results->category_order;
				
				$sql = "update ".table_categories." set category_parent = ".$results->category_parent.", category_order = " . ($move_sort + 1) . " where category__auto_id=" . $id . ";";
				$db->query($sql);
				rebuild_the_tree();
				header("Location: admin_categories.php");
			}else{
				die('You cannot move a category into it\'s own subcategory. Click <a href = "admin_categories.php">here</a> to reload.');
			}
		}else{
			$sql = "Select * from ".table_categories." where category__auto_id=" . $move_id . ";";
			$results = $db->get_row($sql);
			$move_sort = $results->category_order;
			
			$sql = "update ".table_categories." set category_parent = ".$results->category_parent.", category_order = " . ($move_sort + 1) . " where category__auto_id=" . $id . ";";
			$db->query($sql);
			rebuild_the_tree();
			header("Location: admin_categories.php");
		}
	}
					
	if($action == "view"){
	
		$array = tree_to_array(0, table_categories, true);
		$main_smarty->assign('cat_count', count($array));
		$main_smarty->assign('cat_array', $array);
		$main_smarty->assign('tpl_center', '/admin/category_manager');
		$main_smarty->display($template_dir . '/admin/admin.tpl');
		echo $QEIP->ShowOnloadJS();
	}

}else	{
	echo 'not for you! go away!';
}


function makeCategoryFriendly($input) {
	// this was moved out of utils.php because it's only needed when changing
	// category information

	$input = utf8_substr($input, 0, 240);
	$output = utf8_strtolower($output);
	
	$output = trim($input);

	$output = str_replace(" ", "-", $output);
	$output = str_replace("_", "-", $output);
	$output = str_replace("'", "", $output);
	$output = str_replace('"', '', $output);
	$output = str_replace('&', '-', $output);
	$output = str_replace('/', '-', $output);
	$output = str_replace('!', '', $output);
	$output = str_replace('?', '', $output);
	$output = str_replace('$', '', $output);
	$output = str_replace("--", "-", $output);
	$output = str_replace("ì", "i", $output);
	$output = str_replace("í", "i", $output);
	$output = str_replace("î", "i", $output);
	$output = str_replace("ï", "i", $output);
	$output = str_replace("Ì", "I", $output);
	$output = str_replace("Í", "I", $output);
	$output = str_replace("Î", "I", $output);
	$output = str_replace("Ï", "I", $output);
	$output = str_replace("ò", "o", $output);
	$output = str_replace("ó", "o", $output);
	$output = str_replace("ô", "o", $output);
	$output = str_replace("õ", "o", $output);
	$output = str_replace("ö", "o", $output);
	$output = str_replace("ø", "o", $output);
	$output = str_replace("Ò", "O", $output);
	$output = str_replace("Ó", "O", $output);
	$output = str_replace("Ô", "O", $output);
	$output = str_replace("Õ", "O", $output);
	$output = str_replace("Ö", "O", $output);
	$output = str_replace("Ø", "O", $output);
	$output = str_replace("ù", "u", $output);
	$output = str_replace("ú", "u", $output);
	$output = str_replace("û", "u", $output);
	$output = str_replace("ü", "u", $output);
	$output = str_replace("Ù", "U", $output);
	$output = str_replace("Ú", "U", $output);
	$output = str_replace("Û", "U", $output);
	$output = str_replace("Ü", "U", $output);
	$output = str_replace("é", "e", $output);
	$output = str_replace("è", "e", $output);
	$output = str_replace("ê", "e", $output);
	$output = str_replace("ë", "e", $output);
	$output = str_replace("È", "E", $output);
	$output = str_replace("É", "E", $output);
	$output = str_replace("Ê", "E", $output);
	$output = str_replace("Ë", "E", $output);
	$output = str_replace("à", "a", $output);
	$output = str_replace("á", "a", $output);
	$output = str_replace("â", "a", $output);
	$output = str_replace("ã", "a", $output);
	$output = str_replace("ä", "a", $output);
	$output = str_replace("å", "a", $output);
	$output = str_replace("À", "A", $output);
	$output = str_replace("Á", "A", $output);
	$output = str_replace("Â", "A", $output);
	$output = str_replace("Ã", "A", $output);
	$output = str_replace("Ä", "A", $output);
	$output = str_replace("Å", "A", $output);
	$output = str_replace("ñ", "n", $output);
	$output = str_replace("Ñ", "N", $output);
	$output = str_replace("æ", "ae", $output);
	$output = str_replace("Æ", "AE", $output);
	$output = str_replace("ß", "ss", $output);
	$output = str_replace("ç", "e", $output);
	$output = str_replace("Ç", "C", $output);
	$output = str_replace("ý", "y", $output);
	$output = str_replace("ÿ", "y", $output);
	$output = str_replace("Ý", "Y", $output);
	
	if(function_exists('utils_makeUrlFriendly')) {
		$output = utils_makeUrlFriendly($output);
	}
	
	return urlencode($output);	   
}

function Cat_Safe_Names(){
	// this was moved out of dbtree.php because it's only needed when changing
	// category information
	
	global $db;
	$cats = $db->get_col("Select category_name from " . table_categories . ";");
	if ($cats) {
		foreach($cats as $catname) {
			$db->query("UPDATE `" . table_categories . '` SET `category_name` = "'.safeAddSlashes($catname).'"' . ", `category_safe_name` = '".makeCategoryFriendly($catname)."' WHERE `category_name` =".'"'.safeAddSlashes($catname).'";');
		}
	}
	$cats = $db->get_col("Select category__auto_id from " . table_categories . ";");
	if ($cats) {
		foreach($cats as $catid) {
			$db->query("UPDATE `" . table_categories . "` SET `category_id` = ".$catid." WHERE `category__auto_id` ='".$catid."';");
		}
	}
}

function clearCatCache() {
	global $db, $cached_categories;
	$db->cache_dir = mnmpath.'cache';
	$db->use_disk_cache = true;
	$db->cache_queries = true;
	$db->cache_timeout = 0;
	$cached_categories = loadCategoriesForCache(true);
	$db->cache_queries = false;
}

?>
