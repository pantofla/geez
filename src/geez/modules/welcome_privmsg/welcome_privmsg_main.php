<?php
function welcome_privmsg_send(&$registration_details)
{
	global $username, $main_smarty, $current_user;

	include_once(mnminclude.'user.php');
	include_once('./3rdparty/kmessaging/class.KMessaging.php');

	$siteName = $main_smarty->get_config_vars('PLIGG_Visual_Name'); 
	
	// User ID of Admin
	define('welcome_privmsg_admin_id', '1');
	
	// Message Subject
	define('welcome_privmsg_subject', 'geez.gr '.$siteName);
	
	// Message Body
	define('welcome_privmsg_body', '&#917;&#965;&#967;&#945;&#961;&#953;&#963;&#964;&#959;&#973;&#956;&#949; &#960;&#959;&#965; &#941;&#947;&#953;&#957;&#949; &#956;&#941;&#955;&#959;&#962; &#963;&#964;&#959; geez.gr. &#928;&#945;&#961;&#945;&#954;&#945;&#955;&#959;&#973;&#956;&#949;, &#949;&#960;&#953;&#954;&#959;&#953;&#957;&#969;&#957;&#942;&#963;&#964;&#949; &#956;&#945;&#950;&#943; &#956;&#945;&#962; &#947;&#953;&#945; &#964;&#965;&#967;&#972;&#957; &#949;&#961;&#969;&#964;&#942;&#963;&#949;&#953;&#962;, &#960;&#961;&#959;&#964;&#940;&#963;&#949;&#953;&#962;, &#960;&#945;&#961;&#945;&#964;&#951;&#961;&#942;&#963;&#949;&#953;&#962;, &#946;&#949;&#955;&#964;&#953;&#974;&#963;&#949;&#953;&#962; &#954;&#945;&#953; &#945;&#957;&#945;&#966;&#959;&#961;&#940; &#960;&#961;&#959;&#946;&#955;&#951;&#956;&#940;&#964;&#969;&#957;/ bugs &#945;&#966;&#959;&#973; &#960;&#961;&#974;&#964;&#945; &#949;&#960;&#953;&#963;&#954;&#949;&#966;&#952;&#949;&#943;&#964;&#949; &#964;&#953;&#962; FAQ! &#922;&#940;&#955;&#951; &#916;&#953;&#945;&#963;&#954;&#941;&#948;&#945;&#963;&#951;, geez.gr Webmaster');
			
	// Check User ID != 0
	if ($registration_details['id'] > 0)
	{		
		$msg_subject = sanitize(welcome_privmsg_subject, 2);
		$msg_body = welcome_privmsg_body;
		$msg_to_ID = $registration_details['id'];
		$msg_from_ID = welcome_privmsg_admin_id;
		
		$message = new KMessaging(true);
		$msg_result = $message->SendMessege($msg_subject, $msg_body, $msg_from_ID, $msg_to_ID, 0);
		
		if ($msg_result != 0) {
			echo "Module Error #".$msg_result;
		}
		
	} else {
	
		// Unable to find User ID
		echo "Module Error #1";
		die;
	}
}
	
?>