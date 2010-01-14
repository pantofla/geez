<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 09:27:26 CDT */ ?>

﻿<div id="feeds">
	<ul id="rssfeeds">
		<li>
			<?php if (isset($this->_sections['thecat'])) unset($this->_sections['thecat']);
$this->_sections['thecat']['name'] = 'thecat';
$this->_sections['thecat']['loop'] = is_array($this->_vars['cat_array']) ? count($this->_vars['cat_array']) : max(0, (int)$this->_vars['cat_array']);
$this->_sections['thecat']['show'] = true;
$this->_sections['thecat']['max'] = $this->_sections['thecat']['loop'];
$this->_sections['thecat']['step'] = 1;
$this->_sections['thecat']['start'] = $this->_sections['thecat']['step'] > 0 ? 0 : $this->_sections['thecat']['loop']-1;
if ($this->_sections['thecat']['show']) {
	$this->_sections['thecat']['total'] = $this->_sections['thecat']['loop'];
	if ($this->_sections['thecat']['total'] == 0)
		$this->_sections['thecat']['show'] = false;
} else
	$this->_sections['thecat']['total'] = 0;
if ($this->_sections['thecat']['show']):

		for ($this->_sections['thecat']['index'] = $this->_sections['thecat']['start'], $this->_sections['thecat']['iteration'] = 1;
			 $this->_sections['thecat']['iteration'] <= $this->_sections['thecat']['total'];
			 $this->_sections['thecat']['index'] += $this->_sections['thecat']['step'], $this->_sections['thecat']['iteration']++):
$this->_sections['thecat']['rownum'] = $this->_sections['thecat']['iteration'];
$this->_sections['thecat']['index_prev'] = $this->_sections['thecat']['index'] - $this->_sections['thecat']['step'];
$this->_sections['thecat']['index_next'] = $this->_sections['thecat']['index'] + $this->_sections['thecat']['step'];
$this->_sections['thecat']['first']	  = ($this->_sections['thecat']['iteration'] == 1);
$this->_sections['thecat']['last']	   = ($this->_sections['thecat']['iteration'] == $this->_sections['thecat']['total']);
?>
				<?php if ($this->_vars['lastspacer'] == ""): ?>
					<?php $this->assign('lastspacer', $this->_vars['cat_array'][$this->_sections['thecat']['index']]['spacercount']); ?>
				<?php endif; ?>

					<li><a href="<?php echo $this->_vars['URL_rsscategory'].$this->_vars['cat_array'][$this->_sections['thecat']['index']]['auto_id']; ?>
" target="_blank" style="border:none;"><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/rss.gif" border="0" alt="RSS" /></a><span class="feedname"><a href="<?php echo $this->_vars['URL_rsscategory'].$this->_vars['cat_array'][$this->_sections['thecat']['index']]['auto_id']; ?>
" target="_blank" style="border:none;"><?php echo $this->_vars['cat_array'][$this->_sections['thecat']['index']]['name']; ?>
</a></span></li>
					<p><input type="text" class="rssfield" value="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['URL_rsscategory'].$this->_vars['cat_array'][$this->_sections['thecat']['index']]['auto_id']; ?>
"></p>
					<div class="feed-spacer">&nbsp;</div>

				<?php $this->assign('lastspacer', $this->_vars['cat_array'][$this->_sections['thecat']['index']]['spacercount']); ?>
			<?php endfor; endif; ?>
		</li>
	</ul>
</div>