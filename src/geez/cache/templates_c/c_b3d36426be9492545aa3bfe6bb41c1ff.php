<?php require_once('/home/pantofla/public_html/geez/plugins/modifier.sanitize.php'); $this->register_modifier("sanitize", "tpl_modifier_sanitize");  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:13:51 CDT */ ?>

<fieldset><legend><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/user_links.gif" align="absmiddle" /> <?php echo $this->_vars['user']; ?>
's <?php echo $this->_confs['PLIGG_Visual_TopUsers_TH_News']; ?>
</legend>

<form action="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_users.php?mode=viewlinks&user=<?php echo $this->_vars['user']; ?>
" method="post">
	<select name="filter">
		<option value="All"<?php if ($_POST['filter'] == "All"): ?> selected="selected" <?php endif; ?>>All</option>
		<option value="Published" <?php if ($_POST['filter'] == "Published"): ?> selected="selected" <?php endif; ?>>Published</option>
		<option value="Upcoming" <?php if ($_POST['filter'] == "Upcoming"): ?> selected="selected" <?php endif; ?>>Queued</option>
		<option value="Discard" <?php if ($_POST['filter'] == "Discard"): ?> selected="selected" <?php endif; ?>>Discard</option>
	</select>
	<input type="hidden" name="process" value="1">
	<input type="submit" value="Filter" class="log2">
</form>

<form action="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_users.php?mode=viewlinks&user=<?php echo $this->_vars['user']; ?>
" method="post">
	<?php if ($_POST['keyword'] != ""): ?>
			<?php $this->assign('searchboxtext', $this->_run_modifier($_POST['keyword'], 'sanitize', 'plugin', 1, 2)); ?>
	<?php else: ?>
			<?php $this->assign('searchboxtext', $this->_confs['PLIGG_Visual_Search_SearchDefaultText']); ?>			
	<?php endif; ?>	
	<input type="text" name="keyword" value="<?php echo $this->_vars['searchboxtext']; ?>
" onfocus="if(this.value == '<?php echo $this->_vars['searchboxtext']; ?>
') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $this->_vars['searchboxtext']; ?>
';}">
	<input type="hidden" name="filter" value="Search">
	<input type="hidden" name="process" value="1">
	<input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_Search_Go']; ?>
" class="log2">
</form>

<form name="bulk_moderate" action="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_users.php?mode=viewlinks&action=bulkmod" method="post">
<table cellpadding="1" cellspacing="2" border="0">
<tr><th><?php echo $this->_confs['PLIGG_Visual_View_Links_Status']; ?>
</th><th><?php echo $this->_confs['PLIGG_Visual_View_Links_New_Window']; ?>
</th><th><center>Publish</center></th><th><center>Queued</center></th><th><center>Discard</center></th></tr>
	<?php if (isset($this->_sections['nr'])) unset($this->_sections['nr']);
$this->_sections['nr']['name'] = 'nr';
$this->_sections['nr']['loop'] = is_array($this->_vars['links']) ? count($this->_vars['links']) : max(0, (int)$this->_vars['links']);
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
		<td><?php echo $this->_vars['links'][$this->_sections['nr']['index']]['link_status']; ?>
</td>
		<td><a href = "<?php echo $this->_vars['my_pligg_base']; ?>
/story.php?title=<?php echo $this->_vars['links'][$this->_sections['nr']['index']]['link_title_url']; ?>
" target="_blank"><?php echo $this->_vars['links'][$this->_sections['nr']['index']]['link_title']; ?>
</a></td>
		<td><center><input type="radio" name="link[<?php echo $this->_vars['links'][$this->_sections['nr']['index']]['link_id']; ?>
]" id="link-<?php echo $this->_vars['links'][$this->_sections['nr']['index']]['link_id']; ?>
" value="publish"></center></td>
		<td><center><input type="radio" name="link[<?php echo $this->_vars['links'][$this->_sections['nr']['index']]['link_id']; ?>
]" id="link-<?php echo $this->_vars['links'][$this->_sections['nr']['index']]['link_id']; ?>
" value="queued"></center></td>
		<td><center><input type="radio" name="link[<?php echo $this->_vars['links'][$this->_sections['nr']['index']]['link_id']; ?>
]" id="link-<?php echo $this->_vars['links'][$this->_sections['nr']['index']]['link_id']; ?>
" value="discard"></center></td>
	</tr>	
	<?php endfor; endif; ?>
</table>
<br/>
<p align="right"><input type="submit" name="submit" value="Change Status" class="log2" /></p>
<input type="hidden" name="user" value="<?php echo $this->_vars['user']; ?>
">
</form>

<center><a href="javascript:mark_all_publish()">Mark all for Published</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:mark_all_queued()">Mark all for Queued</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:mark_all_discard()">Mark all for Discarded</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:uncheck_all()">Uncheck All</a></center>

<br/>
<?php  
Global $db, $main_smarty, $rows, $offset;
do_pages($rows, 25, $the_page); 
 ?>

<br/>
</fieldset>


<?php echo '
<SCRIPT>
function mark_all_publish() {
	for (var i=0; i< document.bulk_moderate.length; i++) {
		if (document.bulk_moderate[i].value == "publish") {
			document.bulk_moderate[i].checked = true;
		}
	}
}
function mark_all_discard() {
	for (var i=0; i< document.bulk_moderate.length; i++) {
		if (document.bulk_moderate[i].value == "discard") {
			document.bulk_moderate[i].checked = true;
		}
	}
}
function mark_all_queued() {
	for (var i=0; i< document.bulk_moderate.length; i++) {
		if (document.bulk_moderate[i].value == "queued") {
			document.bulk_moderate[i].checked = true;
		}
	}
}
function uncheck_all() {
	for (var i=0; i< document.bulk_moderate.length; i++) {
		if ((document.bulk_moderate[i].value == "queued")||(document.bulk_moderate[i].value == "discard")|| (document.bulk_moderate[i].value == "publish")){
			document.bulk_moderate[i].checked = false;
		}
	}
}
</SCRIPT>
'; ?>
