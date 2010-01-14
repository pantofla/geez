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
include(mnminclude.'smartyvariables.php');

if(isset($_REQUEST['id'])){$requestID = strip_tags($_REQUEST['id']);}
if(!is_numeric($requestID)){$requestID = 0;}
if($_REQUEST['title'])
{
	$requestTitle = $db->escape(strip_tags($_REQUEST['title']));
	//$requestTitle = sanitize($_GET['title'], 3);
	$requestID = $db->get_var("SELECT group_id FROM " . table_groups . " WHERE group_safename = '".$requestTitle."';");
}

// breadcrumbs and page titles
$navwhere['text1'] = $main_smarty->get_config_vars('PLIGG_Visual_Breadcrumb_Submit');
$navwhere['link1'] = getmyurl('submit', '');
$main_smarty->assign('posttitle', $requestTitle);
$main_smarty = do_sidebar($main_smarty);


// pagename
define('pagename', 'group_story'); 
$main_smarty->assign('pagename', pagename); 

$privacy = $db->get_var("SELECT group_privacy FROM " . table_groups . " WHERE group_id = '$requestID';");
if($requestID > 0)
{
    if (($privacy!='private' || isMemberActive($requestID)=='active'))
    {
	group_shared($requestID);
	group_stories($requestID);
	//displaying member of a group
	member_display($requestID);
    }
    else
    {
	$main_smarty->assign('group_shared_display', $main_smarty->get_config_vars('PLIGG_Visual_Group_Is_Private'));
	$main_smarty->assign('group_upcoming_display', $main_smarty->get_config_vars('PLIGG_Visual_Group_Is_Private'));
	$main_smarty->assign('group_published_display', $main_smarty->get_config_vars('PLIGG_Visual_Group_Is_Private'));
	$main_smarty->assign('member_display', $main_smarty->get_config_vars('PLIGG_Visual_Group_Is_Private'));
    }
} else 
{
	$redirect = '';
	$redirect = getmyurl("groups");
	header("Location: $redirect");
	die;
}

//displaying group as story
if(isset($requestID))
	group_display($requestID);

$main_smarty->assign('get_group_members', get_group_members($requestID));


$view = sanitize(sanitize($_REQUEST["view"],1),3);
if($view == '') $view = 'published';
$main_smarty->assign('groupview', $view);
if ($view == 'upcoming')
    $main_smarty->assign('URL_rss_page', getmyurl('rsspage', '', 'queued', $requestID));
elseif ($view != 'members')
    $main_smarty->assign('URL_rss_page', getmyurl('rsspage', '', $view, $requestID));

$main_smarty->assign('groupview_published', getmyurl('group_story2', $requestTitle, 'published', $requestID));
$main_smarty->assign('groupview_upcoming', getmyurl('group_story2', $requestTitle, 'upcoming', $requestID));
$main_smarty->assign('groupview_sharing', getmyurl('group_story2', $requestTitle, 'shared', $requestID));
$main_smarty->assign('groupview_members', getmyurl('group_story2', $requestTitle, 'members', $requestID));

$main_smarty->assign('group_edit_url', getmyurl('editgroup', $requestID));
$main_smarty->assign('group_delete_url', getmyurl('deletegroup', $requestID));
// uploading avatar
if($_POST["avatar"] == "uploaded")
{
	$user_image_path = "avatars/groups_uploaded" . "/";
	$user_image_apath = "/" . $user_image_path;
	$allowedFileTypes = array("image/jpeg","image/gif","image/png",'image/x-png','image/pjpeg');
	unset($imagename);
	$myfile = $_FILES['image_file']['name'];
	$imagename = basename($myfile);
	$mytmpfile = $_FILES['image_file']['tmp_name'];
	if(!in_array($_FILES['image_file']['type'],$allowedFileTypes))
	{
		$error['Type'] = 'Only these file types are allowed : jpeg, gif, png';
	}
 
	if(empty($error))
	{
		$imagesize = getimagesize($mytmpfile);
		$width = $imagesize[0];
		$height = $imagesize[1];
		$idname = $_POST["idname"];
		if(!is_numeric($idname)){die();}
		$imagename = $idname . "_original.jpg";
		$newimage = $user_image_path . $imagename ;
		$result = @move_uploaded_file($_FILES['image_file']['tmp_name'], $newimage);
		if(empty($result))
			$error["result"] = "There was an error moving the uploaded file.";
		else {
			$avatar_source = cleanit($_POST['avatarsource']);

			$sql = "UPDATE " . table_groups . " set group_avatar='uploaded' WHERE group_id=$idname";
			$db->query($sql);
			$main_smarty->assign('Avatar_uploaded', 'Avatar uploaded successfully..');
			/*if($avatar_source != "" && $avatar_source != "useruploaded"){
				loghack('Updating profile, avatar source is not one of the list options.', 'username: ' . $_POST["username"].'|email: '.$_POST["email"]);
				$avatar_source == "";
			}*/
			//$user->avatar_source=$avatar_source;
			//$user->store();
		}
	}
	// create large avatar
	include mnminclude . "class.pThumb.php";
	$img=new pThumb();
	$img->pSetSize(group_avatar_size_width, group_avatar_size_height);
	$img->pSetQuality(100);
	$img->pCreate($newimage);
	$img->pSave($user_image_path . $idname . "_".group_avatar_size_width.".jpg");
	$img = "";

	/*// create small avatar
	$img=new pThumb();
	$img->pSetSize(group_avatar_size_width, group_avatar_size_height);
	$img->pSetQuality(100);
	$img->pCreate($newimage);
	$img->pSave($user_image_path . $idname . "_".group_avatar_size_width.".jpg");
	$img = "";*/
}
function cleanit($value)
{
	$value = strip_tags($value);
	$value = trim($value);
	return $value;
}
$main_smarty->assign('tpl_center', $the_template . '/group_story_center');
$main_smarty->display($the_template . '/pligg.tpl');
/*else {

	// check for redirects
	include(mnminclude.'redirector.php');
	$x = new redirector($_SERVER['REQUEST_URI']);
	
	$main_smarty->assign('tpl_center', '404error');
	$main_smarty->display($the_template . '/pligg.tpl');		
	die();
}*/
?>
