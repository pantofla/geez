<?php
	include_once('Smarty.class.php');
	$main_smarty = new Smarty;

	include('config.php');
	include(mnminclude.'html1.php');
	include(mnminclude.'link.php');
	include(mnminclude.'smartyvariables.php');

	//GOT THE VALUES FROM THE END USER
	$rcode=$db->escape(trim($_GET['code']));
	$username=$db->escape(trim($_GET['uid']));
	
	//RETRIVE VALUES FROM DATABASE
	$user=("SELECT user_email, user_pass, user_karma, user_lastlogin FROM " . table_users . " WHERE user_login = '$username'");
	global $db;
	$result = $db->get_row ($user);
	if($result)
	{
		$decode=md5($result->user_email . $result->user_karma .  $username. pligg_hash().$main_smarty->get_config_vars('PLIGG_Visual_Name'));
	}
	else
	{
		$err2 = "failed to activate as did not get the results";
		$main_smarty->assign('err2', $err2);
		//echo "failed to activate as did not get the results";
	}

	//echo $decode."<br />";
	//echo $rcode;
		//COMPARE BOTH VALUES
		if($rcode==$decode)
		{
				$user1=("SELECT user_lastlogin FROM " . table_users . " WHERE user_login = '$username'");
				$reset = $db->get_results($user1);
				if ($user1) {
					foreach($reset as $dbuser) {
						$lastlogin = $dbuser->user_lastlogin;
					}
				}
			if($lastlogin == "0000-00-00 00:00:00"){
				$login_url=getmyurl("loginNoVar");
				
				$message = "&#922;&#940;&#957;&#949; <a href='".$login_url."'>Click</a>";
				$main_smarty->assign('message', $message);
				$sql="UPDATE " . table_users . " SET user_lastlogin = now() WHERE user_login='$username'";
			
				$result = @mysql_query ($sql);
					
					if($result)
					{/*echo"success";*/}
					else
					{
						$err1 = "failed to update user table";
						$main_smarty->assign('err1', $err1);
					}
			
			}
			else
			{
				$err = "Your account has been already activated!";
				$main_smarty->assign('error', $err);
			}
		}
		else
		{	$err3 =  "Invalid activation code";
			$main_smarty->assign('err3', $err3);
		}

		define('pagename', 'validation'); 
		$main_smarty->assign('pagename', pagename);
		$main_smarty->assign('tpl_center', $the_template . '/validation');
		$main_smarty->display($the_template . '/pligg.tpl');
?>