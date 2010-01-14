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
	$output = str_replace("�", "i", $output);
	$output = str_replace("�", "i", $output);
	$output = str_replace("�", "i", $output);
	$output = str_replace("�", "i", $output);
	$output = str_replace("�", "I", $output);
	$output = str_replace("�", "I", $output);
	$output = str_replace("�", "I", $output);
	$output = str_replace("�", "I", $output);
	$output = str_replace("�", "o", $output);
	$output = str_replace("�", "o", $output);
	$output = str_replace("�", "o", $output);
	$output = str_replace("�", "o", $output);
	$output = str_replace("�", "o", $output);
	$output = str_replace("�", "o", $output);
	$output = str_replace("�", "O", $output);
	$output = str_replace("�", "O", $output);
	$output = str_replace("�", "O", $output);
	$output = str_replace("�", "O", $output);
	$output = str_replace("�", "O", $output);
	$output = str_replace("�", "O", $output);
	$output = str_replace("�", "u", $output);
	$output = str_replace("�", "u", $output);
	$output = str_replace("�", "u", $output);
	$output = str_replace("�", "u", $output);
	$output = str_replace("�", "U", $output);
	$output = str_replace("�", "U", $output);
	$output = str_replace("�", "U", $output);
	$output = str_replace("�", "U", $output);
	$output = str_replace("�", "e", $output);
	$output = str_replace("�", "e", $output);
	$output = str_replace("�", "e", $output);
	$output = str_replace("�", "e", $output);
	$output = str_replace("�", "E", $output);
	$output = str_replace("�", "E", $output);
	$output = str_replace("�", "E", $output);
	$output = str_replace("�", "E", $output);
	$output = str_replace("�", "a", $output);
	$output = str_replace("�", "a", $output);
	$output = str_replace("�", "a", $output);
	$output = str_replace("�", "a", $output);
	$output = str_replace("�", "a", $output);
	$output = str_replace("�", "a", $output);
	$output = str_replace("�", "A", $output);
	$output = str_replace("�", "A", $output);
	$output = str_replace("�", "A", $output);
	$output = str_replace("�", "A", $output);
	$output = str_replace("�", "A", $output);
	$output = str_replace("�", "A", $output);
	$output = str_replace("�", "n", $output);
	$output = str_replace("�", "N", $output);
	$output = str_replace("�", "ae", $output);
	$output = str_replace("�", "AE", $output);
	$output = str_replace("�", "ss", $output);
	$output = str_replace("�", "e", $output);
	$output = str_replace("�", "C", $output);
	$output = str_replace("�", "y", $output);
	$output = str_replace("�", "y", $output);
	$output = str_replace("�", "Y", $output);
	
	if(function_exists('utils_makeUrlFriendly')) {
		$output = utils_makeUrlFriendly($output);
	}
	
	return urlencode($output);	   
}

$main_smarty->assign('category_display', category_display());

$main_smarty->assign('tpl_center', '/admin/admin_categories_tasks');
$main_smarty->display($template_dir . '/admin/admin.tpl');

?>