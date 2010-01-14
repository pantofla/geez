<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:42 CDT */ ?>

<?php if ($this->_vars['amIgod'] == 1): ?>
 <fieldset>
	<table width="500">
			<tr><th><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Main']; ?>
</th><th colspan="2"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Stats']; ?>
</th></tr>
			<tr><td valign="top" rowspan="2">
				<div class="admintitle"><?php echo $this->_confs['PLIGG_Visual_AdminPanel']; ?>
 Tools</div>
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/manage_config.gif" align="absmiddle"/> <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Configure']; ?>
</a><br/>
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/manage_user.gif" align="absmiddle"/> <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_users.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_User_Manage']; ?>
</a><br/>
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/manage_cat.gif" align="absmiddle"/> <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_categories.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Category_Manage']; ?>
</a><br/>
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/news_manage.gif" align="absmiddle"/> <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_links.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Links']; ?>
</a><br/>
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/user_comments.gif" align="absmiddle"/> <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_comments.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Comments']; ?>
</a><br/>
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/page.gif" align="absmiddle"/> <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_page.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Manage_Pages']; ?>
</a><br />
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/manage_backup.gif" align="absmiddle"/> <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_backup.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Backup']; ?>
</a><br/>
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/icon_raten.gif" align="absmiddle" /> <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_delete_cache.php" rel="width:350,height:100" class="mb" title="<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Delete_Cache']; ?>
"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Delete_Cache']; ?>
</a><br />
				<br />
				<div class="admintitle">Pligg</div>
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/cart.gif" align="absmiddle"/> <a href="http://www.pligg.com/pro/" target="_blank"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Shop']; ?>
</a><br/>
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/forum.gif" align="absmiddle"/> <a href="http://forums.pligg.com/" target="_blank">Pligg Forum</a><br/>
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/bug.gif" align="absmiddle"/> <a href="http://forums.pligg.com/projects.html" target="_blank">Report a Bug</a><br/>
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/paypal.gif" align="absmiddle"/> <a href="http://forums.pligg.com/donate/" target="_blank"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Donate']; ?>
</a><br />
				<br />
				<div class="admintitle">Modules</div>
				<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/manage_mods.gif" align="absmiddle"/> <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_modules.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Module_Management']; ?>
</a><br/>
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_header_admin_main_links"), $this);?>
			</td>
			<td valign="top">
				<strong>
				<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Version']; ?>
:<br/>
				<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Total_Members']; ?>
:<br/>
				<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Total_Groups']; ?>
:<br/>
				<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Total_Links']; ?>
:<br/>
				<?php echo $this->_confs['PLIGG_Visual_Published_News']; ?>
:<br/>
				<?php echo $this->_confs['PLIGG_Visual_Pligg_Queued']; ?>
:<br/>
				<?php echo $this->_confs['PLIGG_Visual_Votes']; ?>
:<br/>
				<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Comments']; ?>
:
				<hr/>
				<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Latest_Submission']; ?>
: <br/>
				<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Latest_Comment']; ?>
: <br/>
				<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Latest_User']; ?>
:
				</strong>
			</td>
			<td valign="top">
				<?php echo $this->_vars['version_number']; ?>
<br/>
				<?php echo $this->_vars['members']; ?>
<br/>
				<?php echo $this->_vars['grouptotal']; ?>
<br/>
				<?php echo $this->_vars['total']; ?>
<br/>
				<?php echo $this->_vars['published']; ?>
<br/>
				<?php echo $this->_vars['queued']; ?>
<br/>
				<?php echo $this->_vars['votes']; ?>
<br/>
				<?php echo $this->_vars['comments']; ?>

				<hr/>
				<a href="<?php echo $this->_vars['URL_story'].$this->_vars['link_id']; ?>
" rel="width:800,height:700" class="mb" title="<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Latest_Submission']; ?>
"><?php echo $this->_vars['link_date']; ?>
</a> <br/>
				<a href="<?php echo $this->_vars['URL_story'].$this->_vars['link_id']; ?>
#c<?php echo $this->_vars['comment_id']; ?>
" rel="width:800,height:700" class="mb"  title="<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Latest_Comment']; ?>
"><?php if (isset ( $this->_vars['comment_date'] )):  echo $this->_vars['comment_date'];  endif; ?></a> <br/>
				<a href="<?php echo $this->_vars['URL_user'].$this->_vars['last_user']; ?>
" rel="width:800,height:700" class="mb" title="<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Latest_User']; ?>
"><?php echo $this->_vars['last_user']; ?>
</a>
			</td>	
			</tr>
            <tr><td valign="top"><?php echo tpl_function_checkActionsTpl(array('location' => "tpl_admin_after_stats"), $this);?></td>
            </tr>
	</table>
</fieldset>

<?php else: ?>
	<?php echo $this->_confs['PLIGG_Visual_AdminPanel_NoAccess']; ?>

<?php endif; ?>
