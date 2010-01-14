<?php

function akismet_save_comment(&$x){

	if(phpnum()>=5){
			include akismet_lib_path . 'Akismet.class_5.php'; 
			
			$comment = $x['comment'];
			print_r($comment);
			$user = new User;
			$user->id = $comment->author;
			$user->read();
			
			$akismet = new Akismet(my_base_url . my_pligg_base, get_misc_data('wordpress_key'));
			$akismet->setCommentAuthor($user->username);
			$akismet->setCommentAuthorEmail($user->email);
			$akismet->setCommentContent($comment->content);
			$akismet->setPermalink(getmyurl('story', $comment->link));
			
			if($akismet->isCommentSpam()){
				$x['comment']->canSave = false;
				// store the comment but mark it as spam (in case of a mis-diagnosis)
				$spam_comments = get_misc_data('spam_comments');
				if($spam_comments != ''){
					$spam_comments = unserialize(get_misc_data('spam_comments'));
				} else {
					$spam_comments = array();
				}
				$spam_comments[] = $comment->link;
				misc_data_update('spam_comments', serialize($spam_comments));

				$sql = (" INSERT INTO ".table_prefix . "spam_comments ( `auto_id` , `userid` , `linkid` , `cmt_rand` , `cmt_content`, `cmt_date` , `cmt_parent`) VALUES ( NULL , $comment->author, $comment->link, $comment->randkey, '$comment->content', now(), $comment->parent) ");
				$result  = mysql_query($sql);
			}
			else {
				// echo 'not spam';
				$x['comment']->canSave = true;
			}
		}
	else{
		include akismet_lib_path . 'Akismet.class_4.php'; 
		echo "this is version 4";
		$comment = $x['comment'];
		
		print_r($comment);
		$user = new User;
	$user->id = $comment->author;
	$user->read();

		$story['author'] = $user->username;
		//$story['email'] = $user->email;
		$story['body'] = $comment->content;
		$story['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
		$story['referrer']   = $_SERVER['HTTP_REFERER'];
		$story['user_ip'] = $user->extra_field['user_lastip'];

		$akismet = new Akismet(my_base_url . my_pligg_base, get_misc_data('wordpress_key'), $story); 

		if($akismet->errorsExist()) { // returns true if any errors exist 
			if($akismet->isError('AKISMET_INVALID_KEY')) { 
				 echo 'invalid key';
			} elseif($akismet->isError('AKISMET_RESPONSE_FAILED')) { 
				 echo 'response failed';
			} elseif($akismet->isError('AKISMET_SERVER_NOT_FOUND')) { 
				 echo 'server not found';
			} 
		} else { // No errors, check for spam 
			if ($akismet->isSpam()){
			
				$x['comment']->canSave = false;
				$spam_comments = get_misc_data('spam_comments');
				if($spam_comments != ''){
					$spam_comments = unserialize(get_misc_data('spam_comments'));
				} else {
					$spam_comments = array();
				}
				$spam_comments[] = $comment->link;
				misc_data_update('spam_comments', serialize($spam_comments));
				
				$sql = (" INSERT INTO ".table_prefix . "spam_comments ( `auto_id` , `userid` , `linkid` , `cmt_rand` , `cmt_content`, `cmt_date` , `cmt_parent`) VALUES ( NULL , $comment->author, $comment->link, $comment->randkey, '$comment->content', now(), $comment->parent) ");
				echo "<br />".$sql."<br />";
				$result  = mysql_query($sql);
			} else {
				$x['comment']->canSave = true;
			}
		}
	}
}


function akismet_check_submit(&$vars){
	if(phpnum()>=5){
		include akismet_lib_path . 'Akismet.class_5.php'; 
		$x = $x['linkres'];

		$user = new User;
		$user->id = $x->author;
		$user->read();
	
		$akismet = new Akismet(my_base_url . my_pligg_base, get_misc_data('wordpress_key'));
		$akismet->setCommentAuthor($user->username);
		$akismet->setCommentAuthorEmail($user->email);
		$akismet->setCommentAuthorURL($x->url);
		$akismet->setCommentContent($x->content);
		$akismet->setPermalink(getmyurl('story', $x->id));
		if($akismet->isCommentSpam()) {
			// store the comment but mark it as spam (in case of a mis-diagnosis)
			$spam_links = get_misc_data('spam_links');
			if($spam_links != ''){
				$spam_links = unserialize(get_misc_data('spam_links'));
			} else {
				$spam_links = array();
			}
			$spam_links[] = $x->id;
			misc_data_update('spam_links', serialize($spam_links));
			
			totals_adjust_count($x->status, -1);
			totals_adjust_count('discard', 1);
			$x->status = 'discard';
		}
		else {
			// echo 'not spam';
		}
	}
	else{
		include akismet_lib_path . 'Akismet.class_4.php'; 

	$x = $vars['linkres'];
  
		$user = new User;
	$user->id = $x->author;
	$user->read();

		$story['author'] = $user->username;
		$story['email'] = $user->email;
		$story['website'] = $x->url;
		$story['body'] = $x->content;
		$story['permalink'] = getmyurl('story', $x->id);
		$story['user_ip'] = $user->extra_field['user_lastip'];

		$akismet = new Akismet(my_base_url . my_pligg_base, get_misc_data('wordpress_key'), $story); 

		// test for errors 

		if($akismet->errorsExist()) { // returns true if any errors exist 
			if($akismet->isError('AKISMET_INVALID_KEY')) { 
				// echo 'invalid key';
			} elseif($akismet->isError('AKISMET_RESPONSE_FAILED')) { 
				// echo 'response failed';
			} elseif($akismet->isError('AKISMET_SERVER_NOT_FOUND')) { 
				// echo 'server not found';
			} 
		} else { // No errors, check for spam 
			if ($akismet->isSpam()) { // returns true if Akismet thinks the comment is spam 


				$spam_links = get_misc_data('spam_links');
				if($spam_links != ''){
					$spam_links = unserialize(get_misc_data('spam_links'));
				} else {
					$spam_links = array();
				}
				$spam_links[] = $x->id;

				misc_data_update('spam_links', serialize($spam_links));

			} else { 
				// echo 'not spam';
			} 
		} 
	}
}

function akismet_top(){

	global $main_smarty, $the_template, $current_user, $db;

	//force_authentication();
	$canIhaveAccess = 0;
	$canIhaveAccess = $canIhaveAccess + checklevel('god');

	if($canIhaveAccess == 1)
	{

		$spam_links = get_misc_data('spam_links');
		if($spam_links != ''){
			$spam_links = unserialize(get_misc_data('spam_links'));
		} else {
			$spam_links = array();
		}
		
		$spam_comments = get_misc_data('spam_comments');
		
		if($spam_comments != ''){
			$spam_comments = unserialize(get_misc_data('spam_comments'));
		} else {
			$spam_comments = array();
		}

		$main_smarty->assign('menu_spam_comments', count($spam_comments));
	}
}

function akismet_showpage(){

	global $main_smarty, $the_template, $current_user, $db;


	force_authentication();
	$canIhaveAccess = 0;
	$canIhaveAccess = $canIhaveAccess + checklevel('god');

	if($canIhaveAccess == 1)
	{	
			if(phpnum()>=5){
				include_once akismet_lib_path . 'Akismet.class_5.php';
			}
			else{
				include_once akismet_lib_path . 'Akismet.class_4.php';
			}

		$navwhere['text1'] = 'Akismet';
		$navwhere['link1'] = URL_akismet;

		define('pagename', 'akismet'); 
		$main_smarty->assign('pagename', pagename);
		
		define('modulename', 'akismet'); 
		$main_smarty->assign('modulename', modulename);

		if(isset($_REQUEST['view'])){$view = sanitize($_REQUEST['view'], 3);}else{$view='';}

		if($view == ''){
			$wordpress_key = get_misc_data('wordpress_key');
			if($wordpress_key == ''){header('Location: ' . URL_akismet . '&view=manageKey');}

			$spam_links = get_misc_data('spam_links');
			if($spam_links != ''){
				$spam_links = unserialize(get_misc_data('spam_links'));
			} else {
				$spam_links = array();
			}

			$main_smarty->assign('spam_links', $spam_links);
			$main_smarty->assign('spam_links_count', count($spam_links));

			$spam_comments = get_misc_data('spam_comments');
			if($spam_comments != ''){
				$spam_comments = unserialize(get_misc_data('spam_comments'));
			} else {
				$spam_comments = array();
			}

			$main_smarty->assign('spam_comments', $spam_comments);
			$main_smarty->assign('spam_comments_count', count($spam_comments));
			
			$main_smarty = do_sidebar($main_smarty, $navwhere);
			$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel'));

			$main_smarty->assign('tpl_center', akismet_tpl_path . 'main');
			$main_smarty->display($template_dir . '/admin/admin.tpl');
		}

		if($view == 'manageKey'){
			$wordpress_key = get_misc_data('wordpress_key');
			$main_smarty->assign('wordpress_key', $wordpress_key);

			$main_smarty = do_sidebar($main_smarty, $navwhere);
			$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel'));

			$main_smarty->assign('tpl_center', akismet_tpl_path . 'manageKey');
			$main_smarty->display($template_dir . '/admin/admin.tpl');
		}

		if($view == 'updateKey'){
			if(isset($_REQUEST['key'])){$wordpress_key = sanitize($_REQUEST['key'], 3);}else{$wordpress_key='';}
			misc_data_update('wordpress_key', $wordpress_key);
			header('Location: ' . URL_akismet);
		}

		if($view == 'manageSpam'){

			$spam_links = get_misc_data('spam_links');
			if($spam_links != ''){
				$spam_links = unserialize(get_misc_data('spam_links'));
			} else {
				$spam_links = array();
			}

			if(count($spam_links) > 0){
				$sql = "SELECT " . table_links . ".* FROM " . table_links . " WHERE "; 
				$sql .= 'link_id IN ('.implode(',',$spam_links).')';
				$link_data = $db->get_results($sql);
				$main_smarty->assign('link_data', object_2_array($link_data));
			} else {

				header('Location: ' . URL_akismet);

			}

			$main_smarty = do_sidebar($main_smarty, $navwhere);
			$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel'));

			$main_smarty->assign('tpl_center', akismet_tpl_path . 'manageSpam');
			$main_smarty->display($template_dir . '/admin/admin.tpl');

		}

		if($view == 'manageSettings'){

			$main_smarty = do_sidebar($main_smarty, $navwhere);
			$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel'));

			$main_smarty->assign('tpl_center', akismet_tpl_path . 'manageSettings');
			$main_smarty->display($template_dir . '/admin/admin.tpl');

		}
		/*
		if($view == 'isSpam'){
			if(isset($_REQUEST['link_id'])){$link_id = sanitize($_REQUEST['link_id'], 3);}else{$link_id='';}

			$spam_links = get_misc_data('spam_links');
			$spam_links = unserialize(get_misc_data('spam_links'));

			unset($spam_links[$link_id]);
			misc_data_update('spam_links', serialize($spam_links));

			$link = new Link;
			$link->id = $link_id;
			$link->read(FALSE);
			$link->status = 'discard';
			$link->store();

			header('Location: ' . URL_akismet . '&view=manageSpam');
		}

		if($view == 'isNotSpam'){
			if(isset($_REQUEST['link_id'])){$link_id = sanitize($_REQUEST['link_id'], 3);}else{$link_id='';}

			$spam_links = get_misc_data('spam_links');
			$spam_links = unserialize(get_misc_data('spam_links'));

			unset($spam_links[$link_id]);
			misc_data_update('spam_links', serialize($spam_links));

			$link = new Link;
			$link->id = $link_id;
			$link->read(FALSE);
			$link->status = 'queued';
			$link->store();

			header('Location: ' . URL_akismet . '&view=manageSpam');
		}

		if($view == 'addSpam'){

			$spam_links[1] = 1;
			misc_data_update('spam_links', serialize($spam_links));
			header('Location: ' . URL_akismet . '&view=manageSpam');

		}
		*/
		if($view == 'manageSpamcomments'){

			$spam_comments = get_misc_data('spam_comments');
			if($spam_comments != ''){
				$spam_comments = unserialize(get_misc_data('spam_comments'));
			} else {
				$spam_comments = array();
			}

			if(count($spam_comments) > 0){
				$sql = "SELECT * FROM ".table_prefix . "spam_comments WHERE "; 
				$sql .= 'linkid IN ('.implode(',',$spam_comments).')';
				$link_data = $db->get_results($sql);
					$user_cmt = new User;
					$user_cmt_link = new Link;
					$spam_output .=' <form name="bulk_moderate" action="'.URL_akismet_isSpamcomment.'&action=bulkmod" method="post">';
					$spam_output .="<table>";
					$spam_output .="<tr><th>Author</th><th>Body</th><th>this is spam</th><th>this is NOT spam</th></tr>";
					if($link_data){
						foreach($link_data as $spam_cmts){
							$user_cmt->id=$spam_cmts->userid;
							$user_cmt->read();
							$user_name = $user_cmt->username;
							
							$user_cmt_link->id=$spam_cmts->linkid;
							$user_cmt_link->read();
							
							$spam_output .="<tr>";
							$spam_output .= "<td>".$user_name."</td>";
							$spam_output .= "<td>".save_text_to_html($spam_cmts->cmt_content)."</td>";
							$spam_output .= '<td><center><input type="radio" name="spamcomment['.$spam_cmts->auto_id.']" id="spamcomment-'.$spam_cmts->auto_id.'" value="spamcomment"></center></td>';
							$spam_output .= '<td><center><input type="radio" name="spamcomment['.$spam_cmts->auto_id.']" id="spamcomment-'.$spam_cmts->auto_id.'" value="notspamcomment"></center></td>';
							$spam_output .="</tr>";
						}
					}
					$spam_output .="</table>";
					$spam_output .='<p align="right"><input type="submit" name="submit" value="Change Status" class="log2" /></p>';
					$spam_output .="</form>";
					
				$main_smarty->assign('spam_output', $spam_output);
				$main_smarty->assign('link_data', object_2_array($link_data));
			} else {

				header('Location: ' . URL_akismet);

			}

			$main_smarty = do_sidebar($main_smarty, $navwhere);
			$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel'));

			$main_smarty->assign('tpl_center', akismet_tpl_path . 'manageSpamcomments');
			$main_smarty->display($the_template . '/pligg.tpl');

		}
		
		if($view == 'isSpam'){
				if ($_GET['action'] == "bulkmod") {
					if(isset($_POST['submit'])) {
					$spam = array();
					foreach ($_POST["spam"] as $k => $v) {
						$spam[intval($k)] = $v;
					}
					foreach($spam as $key => $value) {
						if ($value == "spam") {
							
							if(isset($key)){$link_id = sanitize($key, 3);}else{$link_id='';}
							
							$spam_links = get_misc_data('spam_links');
							$spam_links = unserialize(get_misc_data('spam_links'));
							$key = array_search($link_id, $spam_links); 
							unset($spam_links[$key]);
							
							
							misc_data_update('spam_links', serialize($spam_links));

							$link = new Link;
							$link->id = $link_id;
							$link->read();
							$link->status = 'discard';
							$link->store();
							
							$user = new User;
							$user->id = $link->author;
							$user->read();
					
							$akismet = new Akismet(my_base_url . my_pligg_base, get_misc_data('wordpress_key'));
							$akismet->setCommentAuthor($user->username);
							$akismet->setCommentAuthorEmail($user->email);
							$akismet->setCommentAuthorURL($link->url);
							$akismet->setCommentContent($link->content);
							$akismet->setPermalink(getmyurl('story', $link->id));
							$akismet->submitSpam();
							
						}
						elseif ($value == "notspam") {
							if(isset($key)){$link_id = sanitize($key, 3);}else{$link_id='';}

							$spam_links = get_misc_data('spam_links');
							$spam_links = unserialize(get_misc_data('spam_links'));
							$key = array_search($link_id, $spam_links); 
							unset($spam_links[$key]);
							misc_data_update('spam_links', serialize($spam_links));

							$link = new Link;
							$link->id = $link_id;
							$link->read(FALSE);
							$link->status = 'queued';
							$link->store();
							
							$user = new User;
							$user->id = $link->author;
							$user->read();
					
							$akismet = new Akismet(my_base_url . my_pligg_base, get_misc_data('wordpress_key'));
							$akismet->setCommentAuthor($user->username);
							$akismet->setCommentAuthorEmail($user->email);
							$akismet->setCommentAuthorURL($link->url);
							$akismet->setCommentContent($link->content);
							$akismet->setPermalink(getmyurl('story', $link->id));
							$akismet->submitHam();

						}
					}
				}
			}
			header('Location: ' . URL_akismet . '&view=manageSpam');
		}
		
		if($view == 'isSpamcomment'){
		
			if ($_GET['action'] == "bulkmod") {
					if(isset($_POST['submit'])) {
					$spamcomment = array();
					foreach ($_POST["spamcomment"] as $k => $v) {
						$spamcomment[intval($k)] = $v;
					}
					foreach($spamcomment as $key => $value) {
						 if ($value == "spamcomment") {
							if(isset($key)){$link_id = sanitize($key, 3);}else{$link_id='';}
							global $db;
							$spam_comments = get_misc_data('spam_comments');
							$spam_comments = unserialize(get_misc_data('spam_comments'));
							$key = array_search($link_id, $spam_comments); 
							unset($spam_comments[$key]);
							
							$sql_result = ("Select * from ".table_prefix . "spam_comments where auto_id=".$link_id);
							$result_arr=$db->get_results($sql_result);
							if($result_arr){
								foreach($result_arr as $result_arr_comments){
							
									$link = new Link;
									$link->id = $result_arr_comments->linkid;
									$link->read();
									
									$user = new User;
									$user->id = $result_arr_comments->userid;
									$user->read();
									
									$akismet = new Akismet(my_base_url . my_pligg_base, get_misc_data('wordpress_key'));
									$akismet->setCommentAuthor($user->username);
									$akismet->setCommentAuthorEmail($user->email);
									$akismet->setCommentAuthorURL($link->url);
									$akismet->setCommentContent($result_arr_comments->cmt_content);
									$akismet->setPermalink(getmyurl('story', $link->id));
									$akismet->submitSpam();
								}
							}
							
							misc_data_update('spam_comments', serialize($spam_comments));
							
							$db->query(' Delete from '.table_prefix . 'spam_comments where auto_id='.$link_id);
						}
						elseif ($value == "notspamcomment") {
							if(isset($key)){$link_id = sanitize($key, 3);}else{$link_id='';}
							global $db;
							$spam_comments = get_misc_data('spam_comments');
							$spam_comments = unserialize(get_misc_data('spam_comments'));
							$key = array_search($link_id, $spam_comments); 
							unset($spam_comments[$key]);
							
							 $sql_result = (" Select * from ".table_prefix . "spam_comments where auto_id=$link_id");
							
							$result_arr=$db->get_results($sql_result);
							if($result_arr){
								foreach($result_arr as $result_arr_comments){			
									$link = new Link;
									$link->id = $result_arr_comments->linkid;
									$link->read();
									
									$user = new User;
									$user->id = $result_arr_comments->userid;
									$user->read();
									
									$akismet = new Akismet(my_base_url . my_pligg_base, get_misc_data('wordpress_key'));
									$akismet->setCommentAuthor($user->username);
									$akismet->setCommentAuthorEmail($user->email);
									$akismet->setCommentAuthorURL($link->url);
									$akismet->setCommentContent($result_arr_comments->cmt_content);
									$akismet->setPermalink(getmyurl('story', $link->id));
									$akismet->submitHam();
									
									$sql = "INSERT INTO " . table_comments . " (comment_parent, comment_user_id, comment_link_id , comment_date, comment_randkey, comment_content) VALUES ($result_arr_comments->cmt_parent, $result_arr_comments->userid, $result_arr_comments->linkid, now(), '$result_arr_comments->cmt_rand', '$result_arr_comments->cmt_content')";
									$db->query($sql);
								}
							}
							misc_data_update('spam_comments', serialize($spam_comments));
							
							$sql_delete = (' Delete from '.table_prefix . 'spam_comments where auto_id='.$link_id);
							$db->query($sql_delete);
							
							$link->adjust_comment(1);
							$link->store();
						}
					}
					
				}
				header('Location: ' . URL_akismet . '&view=manageSpamcomments');
			}
		}
	}
}
?>
