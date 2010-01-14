<?php

function admin_snippet_showpage(){
	global $db, $main_smarty, $the_template;
		
	include_once('config.php');
	include_once(mnminclude.'html1.php');
	include_once(mnminclude.'link.php');
	include_once(mnminclude.'tags.php');
	include_once(mnminclude.'smartyvariables.php');
	
	$main_smarty = do_sidebar($main_smarty);

	force_authentication();
	$canIhaveAccess = 0;
	$canIhaveAccess = $canIhaveAccess + checklevel('god');
	
	if($canIhaveAccess == 1)
	{	
		// breadcrumbs
			$navwhere['text1'] = $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel');
			$navwhere['link1'] = getmyurl('admin', '');
			$navwhere['text2'] = "Modify Snippet";
			$navwhere['link2'] = my_pligg_base . "/module.php?module=admin_snippet";
			$main_smarty->assign('navbar_where', $navwhere);
			$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel'));
		// breadcrumbs
		//Method for identifying modules rather than pagename
		define('modulename', 'admin_snippet'); 
		$main_smarty->assign('modulename', modulename);
		
		define('pagename', 'admin_modifysnippet'); 
		$main_smarty->assign('pagename', pagename);
		
		// Add new snippet
		if($_REQUEST['mode'] == 'new') {
			if($_POST['submit']) {
			    // Check some data
			    if(!$_POST['snippet_name']) {
				$main_smarty->assign('snippet_error', "Please specify Snippet Name");
			    } elseif(!$_POST['snippet_content']) {
				$main_smarty->assign('snippet_error', "Please specify Snippet Content");
			    } else {
				$snippet_name = $db->escape(sanitize($_POST['snippet_name'],4));
				$snippet_location = $db->escape(sanitize($_POST['snippet_location'],4));
				$snippet_content  = $db->escape($_POST['snippet_content']);
				$db->query("INSERT INTO ".table_prefix."snippets (snippet_name,snippet_location,snippet_updated,snippet_order,snippet_content) 
						   VALUES ('$snippet_name','$snippet_location',NOW(),'1','$snippet_content')");
				header("Location: ".my_pligg_base."/module.php?module=admin_snippet");
				die();
			    }
			}

			$main_smarty->assign('tpl_center', admin_snippet_tpl_path . 'admin_snippet_edit');
		// Edit snippet
		} elseif($_REQUEST['mode'] == 'edit') {
			if($_POST['submit']) {
			    // Check some data
			    if(!$_POST['snippet_name']) {
				$main_smarty->assign('snippet_error', "Please specify Snippet Name");
			    } elseif(!$_POST['snippet_content']) {
				$main_smarty->assign('snippet_error', "Please specify Snippet Content");
			    } elseif(!is_numeric($_POST['snippet_id'])) {
				$main_smarty->assign('snippet_error', "Wrong ID");
			    } else {
				$snippet_id = $_POST['snippet_id'];
				$snippet_name = $db->escape(sanitize($_POST['snippet_name'],4));
				$snippet_location = $db->escape(sanitize($_POST['snippet_location'],4));
				$snippet_content  = $db->escape($_POST['snippet_content']);
				$db->query("UPDATE ".table_prefix."snippets SET snippet_name='$snippet_name', snippet_location='$snippet_location', snippet_content='$snippet_content', snippet_updated=NOW() WHERE snippet_id='$snippet_id'");

				header("Location: ".my_pligg_base."/module.php?module=admin_snippet");
				die();
			    }
			}
	
			// Check ID
			if(!is_numeric($_GET['id'])) {
				header("Location: ".my_pligg_base."/module.php?module=admin_snippet");
				die();
			} else {
				$snippet = $db->get_row("SELECT * FROM ".table_prefix."snippets WHERE snippet_id={$_GET['id']}");
				if (!$snippet->snippet_id) {
					header("Location: ".my_pligg_base."/module.php?module=admin_snippet");
					die();
				}
				$main_smarty->assign("snippet",(array)$snippet);
			}
			$main_smarty->assign('tpl_center', admin_snippet_tpl_path . 'admin_snippet_edit');
		// Delete selected
		} elseif(isset($_POST['delete'])) { 
			if (sizeof($_POST["snippet_delete"]))
				$db->query("DELETE FROM ".table_prefix."snippets WHERE snippet_id IN(".join(",",array_keys($_POST["snippet_delete"])).")");

			header("Location: ".my_pligg_base."/module.php?module=admin_snippet");
			die();
		// Update orders
		} elseif(isset($_POST['update'])) {
			if (sizeof($_POST["snippet_order"]))
			    foreach ($_POST["snippet_order"] AS $k => $v)
				if (is_numeric($k) && is_numeric($v))
					$db->query("UPDATE ".table_prefix."snippets SET snippet_order='$v' WHERE snippet_id='$k'");

			header("Location: ".my_pligg_base."/module.php?module=admin_snippet");
			die();
		// Display the list
		} else {
	 		$filtered = $db->get_results("SELECT * FROM ".table_prefix."snippets ORDER BY snippet_location, snippet_order");
			if ($filtered)
			{
			    foreach($filtered as $dbfiltered) 
			  	$template_snippets[] = (array) $dbfiltered;
		  	    $main_smarty->assign('template_snippets', $template_snippets);
		  	}
			$main_smarty->assign('tpl_center', admin_snippet_tpl_path . 'admin_snippet_main');
		}
		$main_smarty->display($template_dir . '/admin/admin.tpl');
	}
	else
	{
		echo "Access denied";
	}
		

}	

?>
