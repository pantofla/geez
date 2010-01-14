<?php require_once('/home/pantofla/public_html/geez/plugins/modifier.sanitize.php'); $this->register_modifier("sanitize", "tpl_modifier_sanitize");  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:15:56 CDT */ ?>

<fieldset><legend><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/manage_user.gif" align="absmiddle" /> <?php echo $this->_confs['PLIGG_Visual_AdminPanel_User_Manage']; ?>
</legend>

<form action="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_users.php" method="get">
<input type="hidden" name="mode" value="search">
	<?php if (isset ( $_GET['keyword'] )): ?>
			<?php $this->assign('searchboxtext', $this->_run_modifier($_GET['keyword'], 'sanitize', 'plugin', 1, 2)); ?>
	<?php else: ?>
			<?php $this->assign('searchboxtext', $this->_confs['PLIGG_Visual_Search_SearchDefaultText']); ?>			
	<?php endif; ?>
<input type="text" name="keyword" value="<?php echo $this->_vars['searchboxtext']; ?>
" onfocus="if(this.value == '<?php echo $this->_vars['searchboxtext']; ?>
') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $this->_vars['searchboxtext']; ?>
';}">
<input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_Search_Go']; ?>
">

&nbsp;&nbsp;

  <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_users.php?mode=create" rel="width:400,height:300" class="mb" title="Create User" id="create"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_New_User']; ?>
</a>
  <div class="multiBoxDesc create"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_New_User_Desc']; ?>
</div>
  
</form>

<?php if (isset ( $this->_vars['usererror'] )): ?> <span class="error"><?php echo $this->_vars['usererror']; ?>
</span><br/><br/><?php endif; ?>

<table cellpadding="1" border="0" width="90%">
<tr><th><?php echo $this->_confs['PLIGG_Visual_Login_Username']; ?>
</th><th><?php echo $this->_confs['PLIGG_Visual_View_User_Level']; ?>
</th><th><?php echo $this->_confs['PLIGG_Visual_View_User_Email']; ?>
</th><th><?php echo $this->_confs['PLIGG_Visual_User_Profile_Joined']; ?>
</th><th><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Validate']; ?>
</th></tr>
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
	<td><img src="<?php echo $this->_vars['userlist'][$this->_sections['nr']['index']]['Avatar']; ?>
" align="absmiddle"/> <a href = "?mode=view&user=<?php echo $this->_vars['userlist'][$this->_sections['nr']['index']]['user_login']; ?>
"><?php echo $this->_vars['userlist'][$this->_sections['nr']['index']]['user_login']; ?>
</a></td>	
	<td><?php echo $this->_vars['userlist'][$this->_sections['nr']['index']]['user_level']; ?>
</td>
	<td><?php echo $this->_vars['userlist'][$this->_sections['nr']['index']]['user_email']; ?>
</td>
	<td><?php echo $this->_vars['userlist'][$this->_sections['nr']['index']]['user_date']; ?>
</td>
	<td><?php if ($this->_vars['userlist'][$this->_sections['nr']['index']]['user_lastlogin'] != "0000-00-00 00:00:00"):  echo $this->_confs['PLIGG_Visual_AdminPanel_Validated'];  else: ?><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_user_validate.php?id=<?php echo $this->_vars['userlist'][$this->_sections['nr']['index']]['user_id']; ?>
" rel="width:280,height:150" class="mb" title="Validate Confirmation" style="text-decoration:none;"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Validate']; ?>
</a><?php endif; ?></td>
	</tr>
	<?php endfor; endif; ?>
</table>

</fieldset>