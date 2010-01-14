<?php   
include_once(mnminclude.'../3rdparty/kmessaging/class.KMessaging.php');

function get_new_messages(){
    global $main_smarty, $the_template, $current_user;
    // Method for identifying modules rather than pagename
    define('modulename_sm', 'simple_messaging');
    $main_smarty->assign('modulename_sm', modulename_sm);

	global $main_smarty, $the_template, $current_user;

	// get the new messages
		if ($current_user->user_id > 0) {
			$message = new KMessaging(true);
			$array = $message->GetAllMesseges(5, $current_user->user_id, '', 1);
			if(is_array($array)){
				$message_count = count($array);
				$main_smarty->assign('messages', $message_count);
	
				$i = 1;
				foreach($array as $key => $val){
					if($i == 1){$msg_first = $array[$key]['id'];}
					if($i > 1){$array[$key]['prev_message_id'] = 'my_message' . ($i - 1);}
					if($i < $message_count){$array[$key]['next_message_id'] = 'my_message' . ($i + 1);}
					$array[$key]['count'] = $i;
					$array[$key]['my_message_id'] = 'my_message' . $i;
					
					$user=new User();
					$user->id = $array[$key]['sender'];
					if(!$user->read()) {
						echo "error 2";
						die;
					}
					$array[$key]['sender_name'] = $user->username;
					$user = "";
					
					$i = $i + 1;
				}
				$main_smarty->assign('msg_new_count', $i - 1);
				$main_smarty->assign('msg_array', $array);
			} else {
				$main_smarty->assign('msg_array', '');
			}
		}
	// get the new messages

}

function simple_messaging_showpage(){
    global $main_smarty, $the_template, $current_user;
    // Method for identifying modules rather than pagename
    define('modulename_sm', 'simple_messaging');
    $main_smarty->assign('modulename_sm', modulename_sm);

	if(isset($_REQUEST['view'])){$view = sanitize($_REQUEST['view'], 3);}else{$view='';}

	$navwhere['text1'] = 'Messaging';
	$navwhere['link1'] = URL_simple_messaging_inbox;

	define('pagename', 'simple_messaging-inbox'); 
	$main_smarty->assign('pagename', pagename);

	if($view == 'inbox'){

		$message = new KMessaging(true);
		$array = $message->GetAllMesseges(5, $current_user->user_id);
		if(is_array($array)){
			$message_count = count($array);
			$main_smarty->assign('messages', $message_count);
	
			foreach($array as $key => $val){
				$user=new User();
				$user->id = $array[$key]['sender'];
				if(!$user->read()) {
					echo "error 2";
					die;
				}
				$array[$key]['sender_name'] = $user->username;
				$user = "";
			}
			$main_smarty->assign('msg_array', $array);
		}

		$main_smarty = do_sidebar($main_smarty, $navwhere);
		$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel'));
	
		$main_smarty->assign('tpl_center', simple_messaging_tpl_path . 'inbox');
		$main_smarty->display($the_template . '/pligg.tpl');

	}


	if($view == 'compose'){

		if(isset($_REQUEST['return'])){$return = sanitize($_REQUEST['return'], 3);}else{$return='';}
		$main_smarty->assign('return', $return);

		if(isset($_REQUEST['to'])){$msgToName = sanitize($_REQUEST['to'], 3);}else{$msgToName='';}
		$main_smarty->assign('msgToName', $msgToName);

		if($msgToName == ''){die('error, invalid to');}

		$main_smarty = do_sidebar($main_smarty, $navwhere);
		$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel'));
	
		$main_smarty->assign('tpl_center', simple_messaging_tpl_path . 'compose');
		$main_smarty->display($the_template . '/pligg.tpl');

	}
	

	if($view == 'send'){

		if(isset($_REQUEST['return'])){$return = html_entity_decode(urldecode(sanitize($_REQUEST['return'], 3)));}else{$return='';}

		if(isset($_REQUEST['msg_subject'])){$msg_subject = sanitize($_REQUEST['msg_subject'], 3);}else{$msg_subject='';}
		if(isset($_REQUEST['msg_body'])){$msg_body = sanitize($_REQUEST['msg_body'], 3);}else{$msg_body='';}
		if(isset($_REQUEST['msg_to'])){$msg_to = sanitize($_REQUEST['msg_to'], 3);}else{$msg_to='';}

		$user_to=new User();
		$user_to->username = $msg_to;
		if(!$user_to->read()) {
			$main_smarty->assign('message', 'The person you are trying to send a message to does not exist!');
			$main_smarty->display(simple_messaging_tpl_path . 'error.tpl');
			die;
		}
		$msg_to_ID = $user_to->id;
		$msg_from_ID = $current_user->user_id;
		
		$message = new KMessaging(true);
		$msg_result = $message->SendMessege($msg_subject,$msg_body,$msg_from_ID,$msg_to_ID,0);
		if ($msg_result != 0){
			$main_smarty->assign('message', "There was an error. error number " . $msg_result);
			$main_smarty->display(simple_messaging_tpl_path . 'error.tpl');
			die;
		} else {
			// show 'message sent', click to continue or wait 5..4..3..2..1.. then redirect
			header('Location: ' . $return);
		}
	}

	if($view == "viewmsg"){

		if(isset($_REQUEST['msg_id'])){$msg_id = sanitize($_REQUEST['msg_id'], 3);}else{$msg_id='';}
		$main_smarty->assign('msg_id', $msg_id);

		$array = messaging_get_message_details($msg_id);
		$main_smarty->assign('msg_array', $array);
		$main_smarty->assign('js_reply', "lightbox_do_on_activate('view_message~!~action=reply~!~replyID=" . $array['id'] . "~!~view=small_msg_compose~!~login=" . $array['sender_name'] . "');");
		$main_smarty->assign('js_delete', "lightbox_do_on_activate('view_message~!~view=small_msg_confirm_delete~!~msgid=" . $array['id'] . "');");

		$main_smarty = do_sidebar($main_smarty, $navwhere);
		$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel'));
	
		$main_smarty->assign('tpl_center', simple_messaging_tpl_path . 'show_message');
		$main_smarty->display($the_template . '/pligg.tpl');

	}

	if($view == "delmsg"){

		if(isset($_REQUEST['msg_id'])){$msg_id = sanitize($_REQUEST['msg_id'], 3);}else{$msg_id='';}

		$array = messaging_get_message_details($msg_id);
		$message = new KMessaging(true);
		$result = $message->DeleteMessege($msg_id);

		header('Location: ' . URL_simple_messaging_inbox);

	}

	if($view == "reply"){

		if(isset($_REQUEST['msg_id'])){$msg_id = sanitize($_REQUEST['msg_id'], 3);}else{$msg_id='';}
		$main_smarty->assign('msg_id', $msg_id);

		$array = messaging_get_message_details($msg_id);
		$main_smarty->assign('msgToName', $array['sender_name']);
		$main_smarty->assign('msg_subject', 're: ' . $array['title']);
		$main_smarty->assign('return', URL_simple_messaging_viewmsg . $msg_id);

		$main_smarty = do_sidebar($main_smarty, $navwhere);
		$main_smarty->assign('posttitle', " / " . $main_smarty->get_config_vars('PLIGG_Visual_Header_AdminPanel'));
	
		$main_smarty->assign('tpl_center', simple_messaging_tpl_path . 'compose');
		$main_smarty->display($the_template . '/pligg.tpl');

	}

}

function messaging_get_message_details($msgID){
	global $db, $current_user, $main_smarty;
	// Method for identifying modules rather than pagename
	define('modulename_sm', 'simple_messaging'); 
	$main_smarty->assign('modulename_sm', modulename_sm);
	
	$message = new KMessaging(true);
	$array = $message->GetMessege($msgID);
	
	// check to make sure this is our message
	if($array['receiver'] == $current_user->user_id){
		$message->MarkAsRead($msgID);
		$thisuser=new User();
		$thisuser->id = $array['sender'];
		if(!$thisuser->read()) {
			$main_smarty->assign('message', 'The person you are trying to send a message to does not exist!');
			$main_smarty->display(messaging_tpl_path . 'error.tpl');
			die();
		}
		$array['sender_name'] = $thisuser->username;
		$thisuser = "";
		return $array;
	} else {
		$main_smarty->assign('message', 'This is not your message!');
		$main_smarty->display(messaging_tpl_path . 'error.tpl');
		die();
	}	
}
?>
