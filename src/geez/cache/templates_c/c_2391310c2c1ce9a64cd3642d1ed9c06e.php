<?php require_once('/home/pantofla/public_html/geez/plugins/modifier.sanitize.php'); $this->register_modifier("sanitize", "tpl_modifier_sanitize");  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:53 CDT */ ?>

<fieldset><legend><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/news_manage.gif" align="absmiddle" /> <?php echo $this->_confs['PLIGG_Visual_AdminPanel_Links']; ?>
</legend>

<form action="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_links.php" method="get">
	<select name="filter">
                <option value="all" <?php if (isset ( $_GET['filter'] ) && $_GET['filter'] == "all"): ?> selected="selected" <?php endif; ?>><?php echo $this->_confs['PLIGG_Visual_AdminPanel_All']; ?>
</option>
                <option value="published" <?php if (isset ( $_GET['filter'] ) && $_GET['filter'] == "published"): ?> selected="selected" <?php endif; ?>><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Published']; ?>
</option>
                <option value="upcoming" <?php if (isset ( $_GET['filter'] ) && $_GET['filter'] == "upcoming"): ?> selected="selected" <?php endif; ?>><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Upcoming']; ?>
</option>
                <option value="discard" <?php if (isset ( $_GET['filter'] ) && $_GET['filter'] == "discard"): ?> selected="selected" <?php endif; ?>><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Discarded']; ?>
</option>
		<option>   ---   </option>
                <option value="today" <?php if (isset ( $_GET['filter'] ) && $_GET['filter'] == "today"): ?> selected="selected" <?php endif; ?>><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Today']; ?>
</option>
                <option value="yesterday" <?php if (isset ( $_GET['filter'] ) && $_GET['filter'] == "yesterday"): ?> selected="selected" <?php endif; ?>><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Yesterday']; ?>
</option>
                <option value="week" <?php if (isset ( $_GET['filter'] ) && $_GET['filter'] == "week"): ?> selected="selected" <?php endif; ?>><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Week']; ?>
</option>
	</select>
	<input type="submit" value="Filter" class="log2">
</form>

<form action="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_links.php" method="get">
	<input type="hidden" name="mode" value="search">
                <?php if (isset ( $_GET['keyword'] ) && $_GET['keyword'] != ""): ?>
			<?php $this->assign('searchboxtext', $this->_run_modifier($_GET['keyword'], 'sanitize', 'plugin', 1, 2)); ?>
	<?php else: ?>
			<?php $this->assign('searchboxtext', $this->_confs['PLIGG_Visual_Search_SearchDefaultText']); ?>			
	<?php endif; ?>	
	<input type="text" name="keyword" value="<?php echo $this->_vars['searchboxtext']; ?>
" onfocus="if(this.value == '<?php echo $this->_vars['searchboxtext']; ?>
') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $this->_vars['searchboxtext']; ?>
';}">
	<input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_Search_Go']; ?>
" class="log2">
</form>

<form action="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_links.php" method="get">
	<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Pagination_Items']; ?>

	<select name="pagesize">
		<option <?php if (isset ( $this->_vars['pagesize'] ) && $this->_vars['pagesize'] == 15): ?>selected<?php endif; ?>>15</option>
		<option <?php if (isset ( $this->_vars['pagesize'] ) && $this->_vars['pagesize'] == 30): ?>selected<?php endif; ?>>30</option>
		<option <?php if (isset ( $this->_vars['pagesize'] ) && $this->_vars['pagesize'] == 50): ?>selected<?php endif; ?>>50</option>
		<option <?php if (isset ( $this->_vars['pagesize'] ) && $this->_vars['pagesize'] == 100): ?>selected<?php endif; ?>>100</option>
		<option <?php if (isset ( $this->_vars['pagesize'] ) && $this->_vars['pagesize'] == 150): ?>selected<?php endif; ?>>150</option>
		<option <?php if (isset ( $this->_vars['pagesize'] ) && $this->_vars['pagesize'] == 200): ?>selected<?php endif; ?>>200</option>
	</select>
	<input type="submit" value="Go" class="log2">
</form>

<form name="bulk_moderate" action="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_links.php?action=bulkmod" method="post">
<table cellpadding="1" cellspacing="2" border="0">
	<tr><th><?php echo $this->_confs['PLIGG_Visual_View_Links_Status']; ?>
</th><th><?php echo $this->_confs['PLIGG_Visual_View_Links_Author']; ?>
</th><th><?php echo $this->_confs['PLIGG_Visual_View_Links_New_Window']; ?>
</th><th><center><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Publish']; ?>
</center></th><th><center><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Upcoming']; ?>
</center></th><th><center><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Discard']; ?>
</center></th><th></th></tr>
	<?php if (isset($this->_sections['id'])) unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($this->_vars['template_stories']) ? count($this->_vars['template_stories']) : max(0, (int)$this->_vars['template_stories']);
$this->_sections['id']['show'] = true;
$this->_sections['id']['max'] = $this->_sections['id']['loop'];
$this->_sections['id']['step'] = 1;
$this->_sections['id']['start'] = $this->_sections['id']['step'] > 0 ? 0 : $this->_sections['id']['loop']-1;
if ($this->_sections['id']['show']) {
	$this->_sections['id']['total'] = $this->_sections['id']['loop'];
	if ($this->_sections['id']['total'] == 0)
		$this->_sections['id']['show'] = false;
} else
	$this->_sections['id']['total'] = 0;
if ($this->_sections['id']['show']):

		for ($this->_sections['id']['index'] = $this->_sections['id']['start'], $this->_sections['id']['iteration'] = 1;
			 $this->_sections['id']['iteration'] <= $this->_sections['id']['total'];
			 $this->_sections['id']['index'] += $this->_sections['id']['step'], $this->_sections['id']['iteration']++):
$this->_sections['id']['rownum'] = $this->_sections['id']['iteration'];
$this->_sections['id']['index_prev'] = $this->_sections['id']['index'] - $this->_sections['id']['step'];
$this->_sections['id']['index_next'] = $this->_sections['id']['index'] + $this->_sections['id']['step'];
$this->_sections['id']['first']	  = ($this->_sections['id']['iteration'] == 1);
$this->_sections['id']['last']	   = ($this->_sections['id']['iteration'] == $this->_sections['id']['total']);
?>
	<tr>
		<td><?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_status']; ?>
</td>
		<td><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_users.php?mode=viewlinks&user=<?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_author']; ?>
" title="<?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_author']; ?>
's Articles"><?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_author']; ?>
</a></td>
		<td><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/story.php?title=<?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_title_url']; ?>
" rel="width:800,height:700" class="mb" title="<?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_title']; ?>
" ><?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_title']; ?>
</a></td>
		<td><center><input type="radio" name="link[<?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_id']; ?>
]" id="link-<?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_id']; ?>
" value="publish"></center></td>
		<td><center><input type="radio" name="link[<?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_id']; ?>
]" id="link-<?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_id']; ?>
" value="queued"></center></td>
		<td><center><input type="radio" name="link[<?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_id']; ?>
]" id="link-<?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_id']; ?>
" value="discard"></center></td>
		<td><center><a href='<?php echo $this->_vars['my_pligg_base']; ?>
/editlink.php?id=<?php echo $this->_vars['template_stories'][$this->_sections['id']['index']]['link_id']; ?>
' rel="width:800,height:700" class="mb"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Page_Edit']; ?>
</center></td>
	</tr>	
	<?php endfor; endif; ?>		
</table>
<hr/>
<center>
<a href="javascript:mark_all_publish()"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Mark_Published']; ?>
</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:mark_all_queued()"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Mark_Upcoming']; ?>
</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:mark_all_discard()"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Mark_Discarded']; ?>
</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:uncheck_all()"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Mark_Uncheck']; ?>
</a><br />
<a href="admin_delete_stories.php" rel="width:250,height:150" class="mb" title="<?php echo $this->_confs['PLIGG_Visual_AdminPanel_Delete_Stories']; ?>
" ><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Delete_Stories']; ?>
</a>
</center>

<p align="right"><input type="submit" name="submit" value="Change Status" class="log2" /></p>
</form>


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
