<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:35 CDT */ ?>

<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_profile_start"), $this);?>

<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_user_center_just_below_header"), $this);?>

<?php if ($this->_vars['user_view'] == 'search'): ?>
	<div id="navbar">
		<?php if ($this->_vars['Allow_Friends'] != "0"): ?>	
			<div id="search_users">
				<form action="<?php echo $this->_vars['my_pligg_base']; ?>
/user.php" method="get">
				<input type="hidden" name="view" value="search">
					<?php if ($_GET['keyword'] != ""): ?>
						<?php $this->assign('searchboxtext', $this->_run_modifier($_GET['keyword'], 'sanitize', 'plugin', 1, 2)); ?>
					<?php else: ?>
						<?php $this->assign('searchboxtext', $this->_confs['PLIGG_Visual_Search_SearchDefaultText']); ?>			
					<?php endif; ?>
				<input type="text" name="keyword" class="field" value="<?php echo $this->_vars['searchboxtext']; ?>
" onfocus="if(this.value == '<?php echo $this->_vars['searchboxtext']; ?>
') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $this->_vars['searchboxtext']; ?>
';}">
				<input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_User_Search_Users']; ?>
" class="button">
				</form>
			</div>
			<?php if ($this->_vars['user_login'] != $this->_vars['user_logged_in']): ?>
	  			<?php if ($this->_vars['is_friend'] > 0): ?>
					<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/user_delete.png" align="absmiddle"/>
					<a href="<?php echo $this->_vars['user_url_remove']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_Remove_Friend']; ?>
 <?php echo $this->_vars['user_login']; ?>
 <?php echo $this->_confs['PLIGG_Visual_User_Profile_Remove_Friend_2']; ?>
</a>

		   			<?php if ($this->_vars['user_authenticated'] == true): ?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_user_center"), $this);?>
					<?php endif; ?> 			
				<?php else: ?>
	  				
	   				<?php if ($this->_vars['user_authenticated'] == true): ?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/user_add.gif" align="absmiddle"/>
						<a href="<?php echo $this->_vars['user_url_add']; ?>
">	<?php echo $this->_confs['PLIGG_Visual_User_Profile_Add_Friend']; ?>
 <?php echo $this->_vars['user_login']; ?>
 <?php echo $this->_confs['PLIGG_Visual_User_Profile_Add_Friend_2']; ?>
</a>
				    <?php endif; ?>   
				<?php endif; ?>      		
			<?php else: ?>  
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/friends.png" align="absmiddle"/>
				<a href="<?php echo $this->_vars['user_url_friends']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_View_Friends']; ?>
</a> 
		  
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/friends2.png" align="absmiddle"/>
				<a href="<?php echo $this->_vars['user_url_friends2']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_View_Friends_2']; ?>
</a> 
			<div class="userborderbottom">&nbsp;</div>
				
			<?php endif; ?> 
		<?php endif; ?>
	</div>

	<h2><?php echo $this->_confs['PLIGG_Visual_Search_SearchResults']; ?>
 <?php echo $this->_vars['search']; ?>
</h2>

	<table cellpadding="1" border="0">
		<tr><th><?php echo $this->_confs['PLIGG_Visual_Login_Username']; ?>
</th><th><?php echo $this->_confs['PLIGG_Visual_User_Profile_Joined']; ?>
</th><th><?php echo $this->_confs['PLIGG_Visual_User_Profile_Homepage']; ?>
</th><th>Add/Remove</th></tr>
		<?php if (isset($this->_sections['nr'])) unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($this->_vars['userlist']) ? count($this->_vars['userlist']) : max(0, (int)$this->_vars['userlist']);
$this->_sections['nr']['show'] = true;
$this->_sections['nr']['max'] = $this->_sections['nr']['loop'];
$this->_sections['nr']['step'] = 1;
$this->_sections['nr']['start'] = $this->_sections['nr']['step'] > 0 ? 0 : $this->_sections['nr']['loop']-1;
if ($this->_sections['nr']['show']) {
	$this->_sections['nr']['total'] = $this->_sections['nr']['loop'];
	if ($this->_sections['nr']['total'] == 0)
		$this->_sections['nr']['show'] = false;
} else
	$this->_sections['nr']['total'] = 0;
if ($this->_sections['nr']['show']):

		for ($this->_sections['nr']['index'] = $this->_sections['nr']['start'], $this->_sections['nr']['iteration'] = 1;
			 $this->_sections['nr']['iteration'] <= $this->_sections['nr']['total'];
			 $this->_sections['nr']['index'] += $this->_sections['nr']['step'], $this->_sections['nr']['iteration']++):
$this->_sections['nr']['rownum'] = $this->_sections['nr']['iteration'];
$this->_sections['nr']['index_prev'] = $this->_sections['nr']['index'] - $this->_sections['nr']['step'];
$this->_sections['nr']['index_next'] = $this->_sections['nr']['index'] + $this->_sections['nr']['step'];
$this->_sections['nr']['first']	  = ($this->_sections['nr']['iteration'] == 1);
$this->_sections['nr']['last']	   = ($this->_sections['nr']['iteration'] == $this->_sections['nr']['total']);
?>
			<tr>
			<td width="240px"><img src="<?php echo $this->_vars['userlist'][$this->_sections['nr']['index']]['Avatar']; ?>
" align="absmiddle"/> <a href = "<?php echo $this->_vars['URL_user'].$this->_vars['userlist'][$this->_sections['nr']['index']]['user_login']; ?>
"><?php echo $this->_vars['userlist'][$this->_sections['nr']['index']]['user_login']; ?>
</a></td>
			<td width="120px"><?php echo $this->_vars['userlist'][$this->_sections['nr']['index']]['user_date']; ?>
</td>
			<td width="300px"><?php echo $this->_vars['userlist'][$this->_sections['nr']['index']]['user_url']; ?>
</td>
			<td width="80px"><?php if ($this->_vars['userlist'][$this->_sections['nr']['index']]['status'] == 0): ?>	
					<center><a href="<?php echo $this->_vars['userlist'][$this->_sections['nr']['index']]['add_friend']; ?>
"><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/user_add.gif" align="absmiddle" border="0" /></a></center>
				<?php else: ?>
					<center><a href="<?php echo $this->_vars['userlist'][$this->_sections['nr']['index']]['remove_friend']; ?>
"><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/user_delete.png" align="absmiddle" border="0"/></a></center>
				<?php endif; ?>
			</td>	
			</tr>
		<?php endfor; endif; ?>
	</table>
	
<?php endif; ?>


<?php if ($this->_vars['user_view'] == 'viewfriends'): ?>
	<div id="navbar">
		<?php if ($this->_vars['Allow_Friends'] != "0"): ?>
			<?php if ($this->_vars['user_authenticated'] == true): ?> 
				<div id="search_users">
					<form action="<?php echo $this->_vars['my_pligg_base']; ?>
/user.php" method="get">
					<input type="hidden" name="view" value="search">
					<input type="text" name="keyword" class="field">
					<input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_User_Search_Users']; ?>
" class="button">
					</form>
				</div>
			<?php endif; ?>
			
			<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/friends2.png" align="absmiddle"/> 
			<a href="<?php echo $this->_vars['user_url_friends2']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_View_Friends_2']; ?>
</a> 
			<div class="userborderbottom">&nbsp;</div>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php if ($this->_vars['user_view'] == 'setting'): ?>
	<div id="navbar" style="margin-bottom:-10px;"></div>
	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_profile_settings_start"), $this);?>
	<form action="<?php echo $this->_vars['my_pligg_base']; ?>
/user_settings.php?login=<?php echo $this->_vars['user_username']; ?>
" method="post">
		
		<div style="float:left;margin:20px 20px 0 20px;">
			<?php if ($this->_vars['Allow_User_Change_Templates']): ?>
			<strong><?php echo $this->_confs['PLIGG_Visual_User_Setting_Template']; ?>
</strong>
			<select name='template'>
			<?php if (count((array)$this->_vars['templates'])): foreach ((array)$this->_vars['templates'] as $this->_vars['template']): ?>
			<option <?php if ($this->_vars['template'] == $this->_vars['current_template']): ?>selected<?php endif; ?>><?php echo $this->_vars['template']; ?>
</option>
			<?php endforeach; endif; ?>
			</select>
			<?php endif; ?>
			<br /><br />
			<strong><?php echo $this->_confs['PLIGG_Visual_User_Setting_Categories']; ?>
</strong>
			<br /><br />
			<?php if (count((array)$this->_vars['category'])): foreach ((array)$this->_vars['category'] as $this->_vars['cat']): ?>
				<!--<?php if ($this->_vars['smarty']['foreach']['cate']['iteration'] % 5 == 0): ?><br style="clear:both;"><?php endif; ?>-->
				<div style="width:145px;margin:0 20px;border:1px solid #E9DDAB;float:left;background-color:#FBF7E5;">
					<div style="width:20px;padding:2px;border:0px solid red;float:left;text-align:center;">
						<input type="checkbox" name="chack[]" value="<?php echo $this->_vars['cat']['category__auto_id']; ?>
" <?php if (count((array)$this->_vars['user_category'])): foreach ((array)$this->_vars['user_category'] as $this->_vars['u_cat']): ?> <?php if ($this->_vars['u_cat'] == $this->_vars['cat']['category__auto_id']): ?> checked="checked"<?php endif;  endforeach; endif; ?>>
					</div>
					<div style="width:90px;padding:3px;border:0px solid red;float:left;text-align:center;">
						<?php echo $this->_vars['cat']['category_name']; ?>
<br/>
					</div>
				</div>
				
			<?php endforeach; endif; ?>
		</div>
		<br style="clear:both;" />
		<div style="float:left;margin:20px 0px 0px 20px;">
		<input type="submit" name="submit" value="update">
		</div>
	</form>
	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_profile_settings_end"), $this); endif; ?>

<?php if ($this->_vars['user_view'] == 'viewfriends2'): ?>
	<div id="navbar">
		<?php if ($this->_vars['Allow_Friends'] != "0"): ?>	 
			<?php if ($this->_vars['user_authenticated'] == true): ?> 
				<div id="search_users">
					<form action="<?php echo $this->_vars['my_pligg_base']; ?>
/user.php" method="get">
					<input type="hidden" name="view" value="search">
					<input type="text" name="keyword" class="field">
					<input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_User_Search_Users']; ?>
" class="button">
					</form>
				</div>
			<?php endif; ?>		
			<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/friends.png" align="absmiddle"/>
			<a href="<?php echo $this->_vars['user_url_friends']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_View_Friends']; ?>
</a>
			<div class="userborderbottom">&nbsp;</div>
		<?php endif; ?>
	</div>
<?php endif; ?>


<?php if ($this->_vars['user_view'] == 'removefriend'): ?>
	<div id="navbar">
		<?php if ($this->_vars['Allow_Friends'] != "0"): ?>		
			<?php if ($this->_vars['user_authenticated'] == true): ?> 
				<div id="search_users">
					<form action="<?php echo $this->_vars['my_pligg_base']; ?>
/user.php" method="get">
					<input type="hidden" name="view" value="search">
					<input type="text" name="keyword" class="field">
					<input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_User_Search_Users']; ?>
" class="button">
					</form>
				</div>
			<?php endif; ?>
			<?php if ($this->_vars['user_login'] != $this->_vars['user_logged_in']): ?>	  
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/friends.png" align="absmiddle"/>
				<a href="<?php echo $this->_vars['user_url_friends']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_View_Friends']; ?>
</a>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/friends2.png" align="absmiddle"/>
				<a href="<?php echo $this->_vars['user_url_friends2']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_View_Friends_2']; ?>
</a>	  
			<?php endif; ?>
			<div class="userborderbottom">&nbsp;</div>
		<?php endif; ?>
	</div>
<?php endif; ?>


<?php if ($this->_vars['user_view'] == 'addfriend'): ?>
	<div id="navbar">
		<?php if ($this->_vars['Allow_Friends'] != "0"): ?>	 
			<?php if ($this->_vars['user_authenticated'] == true): ?> 
				<div id="search_users">
					<form action="<?php echo $this->_vars['my_pligg_base']; ?>
/user.php" method="get">
					<input type="hidden" name="view" value="search">
					<input type="text" name="keyword" class="field">
					<input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_User_Search_Users']; ?>
" class="button">
					</form>
				</div>
			<?php endif; ?>
			
			<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/friends.png" align="absmiddle"/>
			<a href="<?php echo $this->_vars['user_url_friends']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_View_Friends']; ?>
</a>

		  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  
			<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/friends2.png" align="absmiddle"/>
			<a href="<?php echo $this->_vars['user_url_friends2']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_View_Friends_2']; ?>
</a>
			<div class="userborderbottom">&nbsp;</div>
		<?php endif; ?>
	</div>
<?php endif; ?>


<?php if ($this->_vars['user_view'] == 'profile'): ?>
	<div id="navbar">	
		<?php if ($this->_vars['Allow_Friends'] != "0"): ?>	
			<?php if ($this->_vars['user_authenticated'] == true): ?> 
				<div id="search_users">
					<form action="<?php echo $this->_vars['my_pligg_base']; ?>
/user.php" method="get">
					<input type="hidden" name="view" value="search">
					<input type="text" name="keyword" class="field">
					<input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_User_Search_Users']; ?>
" class="button">
					</form>
				</div>
			<?php endif; ?>
			<?php if ($this->_vars['user_login'] != $this->_vars['user_logged_in']): ?>
				<?php if ($this->_vars['is_friend'] > 0): ?>
					<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/user_delete.png" align="absmiddle"/>
					<a href="<?php echo $this->_vars['user_url_remove']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_Remove_Friend']; ?>
 <?php echo $this->_vars['user_login']; ?>
 <?php echo $this->_confs['PLIGG_Visual_User_Profile_Remove_Friend_2']; ?>
</a>

			   		<?php if ($this->_vars['user_authenticated'] == true): ?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
						<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_user_center"), $this);?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
		 			
				<?php else: ?>
		  				
		   			<?php if ($this->_vars['user_authenticated'] == true): ?> 					
						<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/user_add.gif" align="absmiddle"/>
						<a href="<?php echo $this->_vars['user_url_add']; ?>
">	<?php echo $this->_confs['PLIGG_Visual_User_Profile_Add_Friend']; ?>
 <?php echo $this->_vars['user_login']; ?>
 <?php echo $this->_confs['PLIGG_Visual_User_Profile_Add_Friend_2']; ?>
</a>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;					
					<?php endif; ?>   
		   
				<?php endif; ?>   
		   		
			<?php else: ?>
		  
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/friends.png" align="absmiddle"/>
				<a href="<?php echo $this->_vars['user_url_friends']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_View_Friends']; ?>
</a> 
		  
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/friends2.png" align="absmiddle"/>
				<a href="<?php echo $this->_vars['user_url_friends2']; ?>
"><?php echo $this->_confs['PLIGG_Visual_User_Profile_View_Friends_2']; ?>
</a> 

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  
			<?php endif; ?> 
			<?php if ($this->_vars['user_authenticated'] == true): ?> 
				<div class="userborderbottom">&nbsp;</div>
			<?php endif; ?>
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_user_center"), $this);?>
		<?php endif; ?>
	</div>	

	<div id="wrapper">
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_profile_info_start"), $this);?>
		
		<div id="personal_info">
			<fieldset><legend><?php echo $this->_confs['PLIGG_Visual_User_PersonalData']; ?>
</legend>
				<table style="border:none">
				<tr>
				<td style="background:none"><strong><?php echo $this->_confs['PLIGG_Visual_Login_Username']; ?>
:</strong></td>
				<td style="background:none"><?php if ($this->_vars['UseAvatars'] != "0"): ?><span id="ls_avatar"><img src="<?php echo $this->_vars['Avatar_ImgSrc']; ?>
" alt="Avatar" align="absmiddle"/></span><?php endif; ?> <?php echo $this->_vars['user_username']; ?>
</td>
				</tr>
				
				<?php if ($this->_vars['user_names'] != ""): ?>
				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_User']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_names']; ?>
</td>
				</tr>
				<?php endif; ?>

				<?php if ($this->_vars['user_url'] != ""): ?>
				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_Homepage']; ?>
:</strong></td>
				<td><a href="<?php echo $this->_vars['user_url']; ?>
" target="_blank"><?php echo $this->_vars['user_url']; ?>
</a></td>
				</tr>
				<?php endif; ?>

				<?php if ($this->_vars['user_publicemail'] != ""): ?>
				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_PublicEmail']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_publicemail']; ?>
</td>
				</tr>
				<?php endif; ?>

				<?php if ($this->_vars['user_location'] != ""): ?>
				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_Profile_Location']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_location']; ?>
</td>
				</tr>
				<?php endif; ?>

				<?php if ($this->_vars['user_occupation'] != ""): ?>
				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_Profile_Occupation']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_occupation']; ?>
</td>
				</tr>
				<?php endif; ?>

				<?php if ($this->_vars['user_aim'] != ""): ?>
				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_AIM']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_aim']; ?>
</td>
				</tr>
				<?php endif; ?>

				<?php if ($this->_vars['user_msn'] != ""): ?>
				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_MSN']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_msn']; ?>
</td>
				</tr>
				<?php endif; ?>

				<?php if ($this->_vars['user_yahoo'] != ""): ?>
				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_Yahoo']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_yahoo']; ?>
</td>
				</tr>
				<?php endif; ?>

				<?php if ($this->_vars['user_gtalk'] != ""): ?>
				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_GTalk']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_gtalk']; ?>
</td>
				</tr>
				<?php endif; ?>

				<?php if ($this->_vars['user_skype'] != ""): ?>
				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_Skype']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_skype']; ?>
</td>
				</tr>
				<?php endif; ?>

				<?php if ($this->_vars['user_irc'] != ""): ?>
				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_IRC']; ?>
:</strong></td>
				<td><a href="<?php echo $this->_vars['user_irc']; ?>
" target="_blank"><?php echo $this->_vars['user_irc']; ?>
</a></td>
				</tr>
				<?php endif; ?>

				<?php if ($this->_vars['user_login'] == $this->_vars['user_logged_in']): ?>
				<tr><td><input type="button" value="<?php echo $this->_confs['PLIGG_Visual_User_Profile_Modify']; ?>
" onclick="location='<?php echo $this->_vars['URL_Profile']; ?>
'"></td></tr>
				<?php endif; ?>
				</table>
				<?php echo tpl_function_checkActionsTpl(array('location' => ”tpl_show_extra_profile”), $this);?>

			</fieldset>
		</div>
		
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_profile_info_middle"), $this);?>
		
		<div id="stats">
			<fieldset><legend><?php echo $this->_confs['PLIGG_Visual_User_Profile_User_Stats']; ?>
</legend>
				<table style="border:none;">
				<tr>
				<td style="background:none"><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_Joined']; ?>
:</strong></td>
				<td style="background:none"><?php echo $this->_vars['user_joined']; ?>
</td>
				</tr>

				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_Total_Links']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_total_links']; ?>
</td>
				</tr>

				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_Published_Links']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_published_links']; ?>
</td>
				</tr>

				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_Total_Comments']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_total_comments']; ?>
</td>
				</tr>

				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_Total_Votes']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_total_votes']; ?>
</td>
				</tr>

				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_Published_Votes']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_published_votes']; ?>
</td>
				</tr>

				<?php if ($this->_vars['user_karma'] != ""): ?>
				<tr>
				<td><strong><?php echo $this->_confs['PLIGG_Visual_User_Profile_KarmaPoints']; ?>
:</strong></td>
				<td><?php echo $this->_vars['user_karma']; ?>
</td>
				</tr>
				<?php endif; ?>

				</table>
			</fieldset>
		</div>
		
		<div id="groups">
			<fieldset><legend><?php echo $this->_confs['PLIGG_Visual_User_Profile_User_Groups']; ?>
</legend>
				<table style="border:none;">
<?php echo $this->_vars['group_display']; ?>

				</table>
			</fieldset>
		</div>

		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_profile_info_end"), $this);?>
		
		<?php if ($this->_vars['user_login'] == $this->_vars['user_logged_in']): ?>
			<div id="bookmarklet">
				<fieldset><legend><?php echo $this->_confs['PLIGG_Visual_User_Profile_Bookmarklet_Title']; ?>
</legend>
					<br /><?php echo $this->_confs['PLIGG_Visual_User_Profile_Bookmarklet_Title_1']; ?>
 <?php echo $this->_confs['PLIGG_Visual_Name']; ?>
.<?php echo $this->_confs['PLIGG_Visual_User_Profile_Bookmarklet_Title_2']; ?>
<br />
					<br /><b><?php echo $this->_confs['PLIGG_Visual_User_Profile_IE']; ?>
:</b> <?php echo $this->_confs['PLIGG_Visual_User_Profile_IE_1']; ?>

					<br /><b><?php echo $this->_confs['PLIGG_Visual_User_Profile_Firefox']; ?>
:</b> <?php echo $this->_confs['PLIGG_Visual_User_Profile_Firefox_1']; ?>

					<br /><b><?php echo $this->_confs['PLIGG_Visual_User_Profile_Opera']; ?>
:</b> <?php echo $this->_confs['PLIGG_Visual_User_Profile_Opera_1']; ?>

					<br /><br /><b><?php echo $this->_confs['PLIGG_Visual_User_Profile_The_Bookmarklet']; ?>
: <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("bookmarklet.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?></b>
				</fieldset>
			</div>
		<?php endif; ?>
		
		
	</div>	
<?php endif; ?>

<?php if (isset ( $this->_vars['user_page'] )):  echo $this->_vars['user_page'];  endif;  if (isset ( $this->_vars['user_pagination'] )):  echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_pagination_start"), $this); echo $this->_vars['user_pagination'];  echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_pagination_end"), $this); endif;  echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_profile_end"), $this);?>