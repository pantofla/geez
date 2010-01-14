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
// pagename
	define('pagename', 'admin_categories'); 
	$main_smarty->assign('pagename', pagename);

global $db;

include_once(mnminclude.'dbtree.php');
$array = tree_to_array(0, table_categories, FALSE);
$main_smarty->assign('submit_lastspacer', 0);
$main_smarty->assign('cat_array', $array);
	
if(isset($_REQUEST['action'])){
	$action = sanitize($_REQUEST['action'],3);
}
$main_smarty->assign('action', $action);

$main_smarty->assign('admin_categories_tasks_move_up', getmyurl('admin_categories_tasks','move_up'));

$mode = sanitize($_REQUEST['mode'],3);
$main_smarty->assign('mode', $mode);
//Deleting category
if($action == "deletebulk")
{
	echo "in".sanitize($_REQUEST["catcheckbox"],3);
	
	$delcat = array();
	if($_REQUEST["catcheckbox"])
	{
		foreach ($_REQUEST["catcheckbox"] as $k => $d) {
			$delcat[intval($k)] = sanitize($d, 3);
		}
		foreach($delcat as $key => $value) {
			echo "<br/>vals";
		}
	}
	/*$cat_title = $_POST['cat_title'];
	$cat_title_safename = str_replace(' ', '', $cat_title);
	$sql = "insert into `" . table_categories . "` (`category_name`,category_safe_name) VALUES ('$cat_title','$cat_title_safename');";
	$db->query($sql);
	rebuild_the_tree();
	ordernew();
	Cat_Safe_Names();
	header("Location: admin_categories_tasks.php");*/
}

//adding main category
if($action == "add")
{
	$cat_title = $db->escape(sanitize($_POST['cat_title'],3));
	$cat_title_safename = str_replace(' ', '', $cat_title);
	$sql = "insert into `" . table_categories . "` (`category_name`,category_safe_name) VALUES ('$cat_title','$cat_title_safename');";
	$db->query($sql);
	rebuild_the_tree();
	ordernew();
	Cat_Safe_Names();
	header("Location: admin_categories_tasks.php");
}
//Editing category
if($action == "editcat")
{
	$cat_title = $db->escape(sanitize($_REQUEST['cat_edit_title'],3));
	$editcatid = $_REQUEST['editcatid'];
	if (!is_numeric($editcatid)) die();

	$cat_title_safename = str_replace(' ', '', $cat_title);
	$sql = "update `" . table_categories . "` set category_name='$cat_title',category_safe_name='$cat_title_safename' where category_id = $editcatid;";
	$db->query($sql);
	rebuild_the_tree();
	ordernew();
	Cat_Safe_Names();
	header("Location: admin_categories_tasks.php");
}
//adding sub category
if($action == "addsubcat"){
	$cat_title = $db->escape(sanitize($_REQUEST['cat_title'],3));
	$maincatid = $_REQUEST['category_id'];
	if (!is_numeric($maincatid)) die();
	$cat_title_safename = str_replace(' ', '', $cat_title);
	
	//echo "inserted";
	$sql = "insert into `" . table_categories . "` (`category_name`,category_safe_name,category_parent) VALUES ('$cat_title','$cat_title_safename',$maincatid);";
	//echo $sql;
	$db->query($sql);
	rebuild_the_tree();
	ordernew();
	Cat_Safe_Names();
	header("Location: admin_categories_tasks.php");
}
//moving category above
if($action == "move_up")
{
	$move_id = $_REQUEST[''];
	$id = $_REQUEST['id_to_move'];
	$moveabove_id = $_REQUEST['moveabove_id'];
	
	//$sql = "update ".table_categories." set category_parent = ".$results->category_parent.", category_order = " . ($cat_order - 1) . " where category__auto_id=" . $cat_id . ";";
	//$sql = "update ".table_categories." set category_order = " . ($cat_order - 1) . " where category__auto_id=" . $cat_id . ";";
	//echo $sql;
	//$db->query($sql);
	//rebuild_the_tree();
	//ordernew();
	//Cat_Safe_Names();
	//header("Location: admin_categories_tasks.php");
	if($id == $move_id) {header("Location: admin_categories_tasks.php");}
	$array = "";
	children_id_to_array($array, table_categories, $id);
	if(is_array($array))
	{
		if(!in_array($move_id, $array))
		{
			if (!is_numeric($id)) die();
			if (!is_numeric($move_id)) die();

			$sql = "Select * from ".table_categories." where category__auto_id=" . $move_id . ";";
			$results = $db->get_row($sql);
			$move_sort = $results->category_order;
			
			$sql = "update ".table_categories." set category_parent = ".$results->category_parent.", category_order = " . ($move_sort - 1) . " where category__auto_id=" . $id . ";";
			//$sql = "update ".table_categories." set category_parent = ".$results->category_parent.", category_order = " . ($move_sort - 1) . " where category__auto_id=" . $id . ";";
			$db->query($sql);
			rebuild_the_tree();
			header("Location: admin_categories_tasks.php");
		}
	}
}
//moving category down
if($action == "move_down")
{
	$move_id = $_REQUEST[''];
	$id = $_REQUEST['id_to_move'];
	$movedown_id = $_REQUEST['movedown_id'];
	
	//$sql = "update ".table_categories." set category_parent = ".$results->category_parent.", category_order = " . ($cat_order - 1) . " where category__auto_id=" . $cat_id . ";";
	//$sql = "update ".table_categories." set category_order = " . ($cat_order - 1) . " where category__auto_id=" . $cat_id . ";";
	//echo $sql;
	//$db->query($sql);
	//rebuild_the_tree();
	//ordernew();
	//Cat_Safe_Names();
	//header("Location: admin_categories_tasks.php");
	if($id == $move_id) {header("Location: admin_categories_tasks.php");}
	$array = "";
	children_id_to_array($array, table_categories, $id);
	if(is_array($array))
	{
		if(!in_array($move_id, $array))
		{
			if (!is_numeric($id)) die();
			if (!is_numeric($move_id)) die();

			$sql = "Select * from ".table_categories." where category__auto_id=" . $move_id . ";";
			$results = $db->get_row($sql);
			$move_sort = $results->category_order;
			
			$sql = "update ".table_categories." set category_parent = ".$results->category_parent.", category_order = " . ($move_sort - 1) . " where category__auto_id=" . $id . ";";
			$db->query($sql);
			rebuild_the_tree();
			header("Location: admin_categories_tasks.php");
		}
	}
}
if($action == "delete"){
	$cat_id = $_REQUEST['id'];
	if (!is_numeric($cat_id)) die();

	$sql = "delete from ".table_categories." where category__auto_id=" . $cat_id . ";";
	echo $sql;
	$db->query($sql);
	rebuild_the_tree();
	ordernew();
	Cat_Safe_Names();
	header("Location: admin_categories_tasks.php");
}
function Cat_Safe_Names()
{
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
function makeCategoryFriendly($input) 
{
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

$main_smarty->assign('category_display', category_display());

$main_smarty->assign('tpl_center', '/admin/admin_categories_tasks');
$main_smarty->display($template_dir . '/admin/admin.tpl');

?>