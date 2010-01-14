<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-10 23:26:51 CDT */ ?>

<div class="pagewrap">
	<table style="border-bottom:2px solid #dedede"><tr>
		<td width="290px" align="center"><strong><?php echo $this->_confs['PLIGG_Visual_Comments_Comment']; ?>
</strong></td>
		<td width="70px" align="center"><strong><?php echo $this->_confs['PLIGG_Visual_Comments_Author']; ?>
</strong></td>
		<td width="140px" align="center"><strong><?php echo $this->_confs['PLIGG_Visual_Comments_Link']; ?>
</strong></td>
		<td width="50px" align="center"><strong><?php echo $this->_confs['PLIGG_Visual_Comments_Date']; ?>
</strong></td>
	</tr></table>

<?php if (isset($this->_sections['live_item'])) unset($this->_sections['live_item']);
$this->_sections['live_item']['name'] = 'live_item';
$this->_sections['live_item']['loop'] = is_array($this->_vars['live_items']) ? count($this->_vars['live_items']) : max(0, (int)$this->_vars['live_items']);
$this->_sections['live_item']['show'] = true;
$this->_sections['live_item']['max'] = $this->_sections['live_item']['loop'];
$this->_sections['live_item']['step'] = 1;
$this->_sections['live_item']['start'] = $this->_sections['live_item']['step'] > 0 ? 0 : $this->_sections['live_item']['loop']-1;
if ($this->_sections['live_item']['show']) {
	$this->_sections['live_item']['total'] = $this->_sections['live_item']['loop'];
	if ($this->_sections['live_item']['total'] == 0)
		$this->_sections['live_item']['show'] = false;
} else
	$this->_sections['live_item']['total'] = 0;
if ($this->_sections['live_item']['show']):

		for ($this->_sections['live_item']['index'] = $this->_sections['live_item']['start'], $this->_sections['live_item']['iteration'] = 1;
			 $this->_sections['live_item']['iteration'] <= $this->_sections['live_item']['total'];
			 $this->_sections['live_item']['index'] += $this->_sections['live_item']['step'], $this->_sections['live_item']['iteration']++):
$this->_sections['live_item']['rownum'] = $this->_sections['live_item']['iteration'];
$this->_sections['live_item']['index_prev'] = $this->_sections['live_item']['index'] - $this->_sections['live_item']['step'];
$this->_sections['live_item']['index_next'] = $this->_sections['live_item']['index'] + $this->_sections['live_item']['step'];
$this->_sections['live_item']['first']	  = ($this->_sections['live_item']['iteration'] == 1);
$this->_sections['live_item']['last']	   = ($this->_sections['live_item']['iteration'] == $this->_sections['live_item']['total']);
?>

	<div class="live2-item">
	<table><tr>
		<td width="290px" align="left"><?php echo $this->_vars['live_items'][$this->_sections['live_item']['index']]['comment_content']; ?>
</td>
		<td width="90px"><a href="<?php echo $this->_vars['URL_user'].$this->_vars['live_items'][$this->_sections['live_item']['index']]['comment_author']; ?>
"><?php echo $this->_vars['live_items'][$this->_sections['live_item']['index']]['comment_author']; ?>
</a></td>
		<td width="140px" align="left"><a href="<?php echo $this->_vars['live_items'][$this->_sections['live_item']['index']]['comment_link_url']; ?>
"><?php echo $this->_vars['live_items'][$this->_sections['live_item']['index']]['comment_link_title']; ?>
</a></td>
		<td width="50px"><?php echo $this->_vars['live_items'][$this->_sections['live_item']['index']]['comment_date']; ?>
</td>
	</tr></table>
	</div>

<?php endfor; endif; ?>


<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_pagination_start"), $this); echo $this->_vars['live_pagination']; ?>

<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_pagination_end"), $this);?>
</div>