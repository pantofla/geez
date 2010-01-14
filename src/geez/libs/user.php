<?php
// The source code packaged with this file is Free Software, Copyright (C) 2005 by
// Ricardo Galli <gallir at uib dot es>.
// It's licensed under the AFFERO GENERAL PUBLIC LICENSE unless stated otherwise.
// You can get copies of the licenses here:
// 		http://www.affero.org/oagpl.html
// AFFERO GENERAL PUBLIC LICENSE is also included in the file called "COPYING".

if(!defined('mnminclude')){header('Location: ../404error.php');}

class User {
	var $read = false;
	var $id = 0;
	var $username = '';
	var $level = 'normal';
	var $modification = false;
	var $date = false;
	var $pass = '';
	var $email = '';
	var $names = '';
	var $lang = 1;
	var $karma = 10;
	var $public_email = '';
	var $location = '';
	var $occupation = '';
	var $url = '';
	var $aim = '';
	var $msn = '';
	var $yahoo = '';
	var $gtalk = '';
	var $skype = '';
	var $irc = '';
	var $avatar_source = '';
	// For stats
	var $total_votes = 0;
	var $published_votes = 0;
	var $total_links = 0;
	var $published_links = 0;
	var $extra = '';
	

	function User($id=0) {
		if ($id>0) {
			$this->id = $id;
			$this->read();
		}
	}

function Create(){
		global $db, $main_smarty,$the_template,$my_base_url,$my_pligg_base;
		
		if($this->username == ''){return false;}
		if($this->pass == ''){return false;}
		if($this->email == ''){return false;}

		if (!user_exists($this->username)) {

			$userip=$_SERVER['REMOTE_ADDR'];
			$saltedpass=generateHash($this->pass);
			
				
		$sqlGetiCategory = "SELECT category__auto_id from " . table_categories . " where category__auto_id!= 0;";
		$sqlGetiCategoryQ = mysql_query($sqlGetiCategory);
		$arr = array();
		$i = 0;
		while ($row = mysql_fetch_array($sqlGetiCategoryQ, MYSQL_NUM)) 
		{
			$arr[$i] = $row['0'];
			$i++;
		}			
		$CategoriesId = implode(",", $arr);
			
			
			
			if(pligg_validate() == 1){
				if ($db->query("INSERT INTO " . table_users . " (user_login, user_email, user_pass, user_date, user_ip,user_categories) VALUES ('".$this->username."', '".$this->email."', '".$saltedpass."', now(), '".$userip."', '".$CategoriesId."')")) {
					
					$result = $db->get_row("SELECT user_email, user_pass, user_karma, user_lastlogin FROM " . table_users . " WHERE user_login = '".$this->username."'");
					$encode=md5($this->email . $result->user_karma .  $this->username. pligg_hash().$main_smarty->get_config_vars('PLIGG_Visual_Name'));

					$username = $this->username;
					$password = $this->pass;
					
					$my_base_url=$my_base_url;
					$my_pligg_base=$my_pligg_base;
					
					$domain = $main_smarty->get_config_vars('PLIGG_Visual_Name');			
					$validation = my_base_url . my_pligg_base . "/validation.php?code=$encode&uid=".$this->username;
					$str = $main_smarty->get_config_vars('PLIGG_PassEmail_verification_message');
					eval("\$str = \"$str\";");
					$message = "$str";

					if(phpnum()>=5)
						require("class.phpmailer5.php");
					else
						require("class.phpmailer4.php");

					$mail = new PHPMailer();
					$mail->From = $main_smarty->get_config_vars('PLIGG_PassEmail_From');
					$mail->FromName = "Administrator";
					$mail->AddAddress($this->email);
					$mail->AddReplyTo($main_smarty->get_config_vars('PLIGG_PassEmail_From'));
					$mail->IsHTML(false);
					$mail->Subject = $main_smarty->get_config_vars('PLIGG_PassEmail_Subject_verification');
					$mail->Body = $message;
					
					
					if(!$mail->Send())
					{
						return false;
						exit;
					}
					;
					return true;
				} else {
					return false;
				}
			} else{
			
					if ($db->query("INSERT INTO " . table_users . " (user_login, user_email, user_pass, user_date, user_ip, user_lastlogin,user_categories) VALUES ('".$this->username."', '".$this->email."', '".$saltedpass."', now(), '".$userip."', now(),'".$CategoriesId."')")) {
						return true;
					} else {
						return false;
					}
			
			}
		} else {
			die('User already exists');
		}
	}

	function store() {
		global $db, $current_user, $cached_users;

		if(!$this->date) $this->date=time();
		$user_login = $db->escape($this->username);
		$user_level = $this->level;
		$user_karma = $this->karma;
		$user_date = $this->date;
		$user_pass = $db->escape($this->pass);
		$user_email = $db->escape($this->email);
		$user_names = $db->escape($this->names);
		$user_url = $db->escape(htmlentities($this->url));
		$user_public_email = $db->escape($this->public_email);
		$user_location = $db->escape($this->location);
		$user_occupation = $db->escape($this->occupation);
		$user_aim = $db->escape($this->aim);
		$user_msn = $db->escape($this->msn);
		$user_yahoo = $db->escape($this->yahoo);
		$user_gtalk = $db->escape($this->gtalk);
		$user_skype = $db->escape($this->skype);
		$user_irc = $db->escape(htmlentities($this->irc));
		$user_avatar_source = $db->escape($this->avatar_source);
		if (strlen($user_pass) < 49){
			$saltedpass=generateHash($user_pass);}
		else{
			$saltedpass=$user_pass;}
			
		if($this->id===0) {
			$this->id = $db->insert_id;
		} else {
			// Username is never updated
			$sql = "UPDATE " . table_users . " set user_avatar_source='$user_avatar_source' ";
			$extra_vars = $this->extra;
			if(is_array($extra_vars)){
				foreach($extra_vars as $varname => $varvalue){
					$sql .= ", " . $varname . " = '" . $varvalue . "' ";
				}
			}
			$sql .= " , user_login='$user_login', user_occupation='$user_occupation', user_location='$user_location', public_email='$user_public_email', user_level='$user_level', user_karma=$user_karma, user_date=FROM_UNIXTIME($user_date), user_pass='$saltedpass', user_email='$user_email', user_names='$user_names', user_url='$user_url', user_aim='$user_aim', user_msn='$user_msn', user_yahoo='$user_yahoo', user_gtalk='$user_gtalk', user_skype='$user_skype', user_irc='$user_irc' WHERE user_id=$this->id";
			//die($sql);
			$db->query($sql);
			//lets remove the old cached data
			if(array_key_exists($this->id, $cached_users))
			{
				unset($cached_users[$this->id]);
			}
		}
	}
	
	function read($data = "long") {
		// $data = long -- return all user data
		// $data = short -- return just basic info
		global $db, $current_user, $cached_users;

		if($this->id > 0)
		{
			$where = "user_id = $this->id";
		}	
		else if(!empty($this->username))
		{
			$where = "user_login='".$db->escape($this->username)."'";

			// if we only know the users login, check the cache to see if it's 
			// already in there and set $this->id so the code below can find it in the cache.
			foreach($cached_users as $user){
				if($user->user_login == $this->username){$this->id = $user->user_id;}
			}
		}

		if(!empty($where)) {
			
			// this is a simple cache type system
			// when we lookup a user from the DB, store the results in memory
			// in case we need to lookup that user information again
			// good for sites where the content is submitted by the same group of people

			if(isset($cached_users[$this->id])){
				$user = $cached_users[$this->id];
			}else{
				if(!$user = $db->get_row("SELECT  *  FROM " . table_users . " WHERE $where")){return false;}
				
				if($this->id > 0)
				{
					//only cache when the id is provided.
					$cached_users[$this->id] = $user;
				}	
			}

			$this->id =$user->user_id;
			$this->username = $user->user_login;
			$this->level = $user->user_level;
			$this->email = $user->user_email;
			$this->avatar_source = $user->user_avatar_source;
			// if short, then stop here
			if($data == 'short'){return true;}
			$this->names = $user->user_names;
			$date=$user->user_date;
			$this->date=unixtimestamp($date);
			$date=$user->user_modification;
			$this->modification=unixtimestamp($date);
			$this->pass = $user->user_pass;
			$this->karma = $user->user_karma;
			$this->public_email = $user->public_email;
			$this->location = $user->user_location;
			$this->occupation = $user->user_occupation;
			$this->url = $user->user_url;
			$this->aim = $user->user_aim;
			$this->msn = $user->user_msn;
			$this->yahoo = $user->user_yahoo;
			$this->gtalk = $user->user_gtalk;
			$this->skype = $user->user_skype;
			$this->irc = $user->user_irc;
			$this->read = true;

			$this->extra_field = object_2_array($user, 0, 0);

			return true;
		}
		$this->read = false;
		return false;
	}

	function all_stats($from = false) {
		global $db;
		if (!is_numeric($this->id)) die();

		if ($from !== false) {
			$link_date = "AND link_date > FROM_UNIXTIME($from)";
			$vote_date = "AND vote_date > FROM_UNIXTIME($from)";
			$comment_date = "AND comment_date > FROM_UNIXTIME($from)";
		} else {
			$link_date = "";
			$vote_date = "";
			$comment_date = "";
		}
		if(!$this->read) $this->read();

		$this->total_votes = $db->get_var("SELECT count(*) FROM " . table_votes . "," . table_links . " WHERE link_status != 'discard' AND vote_user_id = $this->id $vote_date AND link_id = vote_link_id");
		$this->published_votes = $db->get_var("SELECT count(*) FROM " . table_votes . "," . table_links . " WHERE vote_user_id = $this->id AND link_id = vote_link_id AND link_status = 'published' AND vote_date < link_published_date $vote_date");
		$this->total_links = $db->get_var("SELECT count(*) FROM " . table_links . " WHERE link_author = $this->id and link_status != 'discard' $link_date");
		$this->published_links = $db->get_var("SELECT count(*) FROM " . table_links . " WHERE link_author = $this->id AND link_status = 'published' $link_date");
		$this->total_comments = $db->get_var("SELECT count(*) FROM " . table_comments . " WHERE comment_user_id = $this->id $comment_date");

	}
	
	function fill_smarty($main_smarty, $stats = 1){
                $vars = '';
                check_actions('profile_show', $vars);
		$main_smarty->assign('user_publicemail', $this->public_email);
		$main_smarty->assign('user_location', $this->location);
		$main_smarty->assign('user_occupation', $this->occupation);
		$main_smarty->assign('user_aim', $this->aim);
		$main_smarty->assign('user_msn', $this->msn);
		$main_smarty->assign('user_yahoo', $this->yahoo);
		$main_smarty->assign('user_gtalk', $this->gtalk);
		$main_smarty->assign('user_skype', $this->skype);
		$main_smarty->assign('user_irc', $this->irc);
		$main_smarty->assign('user_karma', $this->karma);
		$main_smarty->assign('user_joined', get_date($this->date));
		$main_smarty->assign('user_login', $this->username);
		$main_smarty->assign('user_names', $this->names);
		$main_smarty->assign('user_username', $this->username);
		
/*		global $db;
		$groups = $db->get_results($sql="SELECT * FROM " . table_group_member . "  	
					LEFT JOIN " . table_groups . " ON group_id=member_group_id
					WHERE member_user_id = {$this->id} 
						AND member_status = 'active'
						AND group_status = 'Enable'");
//print $sql;
		for ($i=0; $i<sizeof($groups); $i++)
		    $groups[$i]->link = getmyurl("group_story", $groups[$i]->group_id);
		$main_smarty->assign('user_groups', $groups);
print_r($main_smarty);
*/
		user_group_read($this->id);
			
		if($stats == 1){		
			$this->all_stats();
			$main_smarty->assign('user_total_links', $this->total_links);
			$main_smarty->assign('user_published_links', $this->published_links);
			$main_smarty->assign('user_total_comments', $this->total_comments);
			$main_smarty->assign('user_total_votes', $this->total_votes);
			$main_smarty->assign('user_published_votes', $this->published_votes);
		}
					
		return $main_smarty;
	}
}

function user_group_read($user_id,$order_by='')
{
	global $db, $main_smarty, $view, $user, $rows, $page_size, $offset;

	if (!is_numeric($user_id)) die();

	if ($order_by == "")
		$order_by = "group_name DESC";
	include_once(mnminclude.'smartyvariables.php');

	$groups = $db->get_results($sql="SELECT * FROM " . table_group_member . "  	
					LEFT JOIN " . table_groups . " ON group_id=member_group_id
					WHERE member_user_id = $user_id 
						AND member_status = 'active'
						AND group_status = 'Enable'
						ORDER BY $order_by");
	if ($groups)
	{
		foreach($groups as $groupid)
			$group_display .= "<tr><td><b><a href='".getmyurl("group_story", $groupid->group_id)."'>".$groupid->group_name."</a></b></td></tr>";
		$main_smarty->assign('group_display', $group_display);
	}	
	return true;
}
?>
