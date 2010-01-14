<?php require_once('/home/pantofla/public_html/geez/plugins/modifier.repeat_count.php'); $this->register_modifier("repeat_count", "tpl_modifier_repeat_count");  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:27 CDT */ ?>

<div id="categories">
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_widget_categories_start"), $this);?>
	<ul class="dropdown dropdown-horizontal">
		<?php if (isset($this->_sections['thecat'])) unset($this->_sections['thecat']);
$this->_sections['thecat']['name'] = 'thecat';
$this->_sections['thecat']['loop'] = is_array($this->_vars['cat_array']) ? count($this->_vars['cat_array']) : max(0, (int)$this->_vars['cat_array']);
$this->_sections['thecat']['start'] = (int)$this->_vars['start'];
$this->_sections['thecat']['show'] = true;
$this->_sections['thecat']['max'] = $this->_sections['thecat']['loop'];
$this->_sections['thecat']['step'] = 1;
if ($this->_sections['thecat']['start'] < 0)
	$this->_sections['thecat']['start'] = max($this->_sections['thecat']['step'] > 0 ? 0 : -1, $this->_sections['thecat']['loop'] + $this->_sections['thecat']['start']);
else
	$this->_sections['thecat']['start'] = min($this->_sections['thecat']['start'], $this->_sections['thecat']['step'] > 0 ? $this->_sections['thecat']['loop'] : $this->_sections['thecat']['loop']-1);
if ($this->_sections['thecat']['show']) {
	$this->_sections['thecat']['total'] = min(ceil(($this->_sections['thecat']['step'] > 0 ? $this->_sections['thecat']['loop'] - $this->_sections['thecat']['start'] : $this->_sections['thecat']['start']+1)/abs($this->_sections['thecat']['step'])), $this->_sections['thecat']['max']);
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
			<?php if ($this->_vars['cat_array'][$this->_sections['thecat']['index']]['spacercount'] < $this->_vars['lastspacer']):  echo $this->_run_modifier($this->_vars['cat_array'][$this->_sections['thecat']['index']]['spacerdiff'], 'repeat_count', 'plugin', 1, '</ul>');  endif; ?>
			<li<?php if ($this->_vars['cat_array'][$this->_sections['thecat']['index']]['principlecat'] != 0): ?> class="dir"<?php endif; ?>>			
			<a href="<?php if ($this->_vars['pagename'] == "upcoming"):  echo $this->_vars['URL_queuedcategory'].$this->_vars['cat_array'][$this->_sections['thecat']['index']]['safename'];  else:  echo $this->_vars['URL_maincategory'].$this->_vars['cat_array'][$this->_sections['thecat']['index']]['safename'];  endif; ?>"><?php echo $this->_vars['cat_array'][$this->_sections['thecat']['index']]['name']; ?>
</a>
			<?php if ($this->_vars['cat_array'][$this->_sections['thecat']['index']]['principlecat'] == 0): ?></li><?php else: ?><ul><?php endif; ?>						
			<?php $this->assign('lastspacer', $this->_vars['cat_array'][$this->_sections['thecat']['index']]['spacercount']); ?>
		<?php endfor; endif; ?>
		</ul>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_widget_categories_end"), $this);?>
	</ul>
</div>