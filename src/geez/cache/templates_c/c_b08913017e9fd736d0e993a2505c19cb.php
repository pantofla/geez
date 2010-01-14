<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:36 CDT */ ?>

<?php 
	include_once(mnminclude.'tags.php');
	global $main_smarty;
	
	$cloud=new TagCloud();
	$cloud->smarty_variable = $main_smarty; // pass smarty to the function so we can set some variables
	$cloud->word_limit = tags_words_limit_s;
	$cloud->min_points = tags_min_pts_s; // the size of the smallest tag
	$cloud->max_points = tags_max_pts_s; // the size of the largest tag
	
	$cloud->show();
	$main_smarty = $cloud->smarty_variable; // get the updated smarty back from the function
 ?>

<div class="test">
	<div class="sectiontitle"><a href="<?php echo $this->_vars['URL_tagcloud']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Top_5_Tags']; ?>
</a></div>
</div>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_widget_tags_start"), $this);?>
<div id="space2"></div>
<div class="boxcontent tagformat testsection">
	<?php if (isset($this->_sections['customer'])) unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($this->_vars['tag_number']) ? count($this->_vars['tag_number']) : max(0, (int)$this->_vars['tag_number']);
$this->_sections['customer']['show'] = true;
$this->_sections['customer']['max'] = $this->_sections['customer']['loop'];
$this->_sections['customer']['step'] = 1;
$this->_sections['customer']['start'] = $this->_sections['customer']['step'] > 0 ? 0 : $this->_sections['customer']['loop']-1;
if ($this->_sections['customer']['show']) {
	$this->_sections['customer']['total'] = $this->_sections['customer']['loop'];
	if ($this->_sections['customer']['total'] == 0)
		$this->_sections['customer']['show'] = false;
} else
	$this->_sections['customer']['total'] = 0;
if ($this->_sections['customer']['show']):

		for ($this->_sections['customer']['index'] = $this->_sections['customer']['start'], $this->_sections['customer']['iteration'] = 1;
			 $this->_sections['customer']['iteration'] <= $this->_sections['customer']['total'];
			 $this->_sections['customer']['index'] += $this->_sections['customer']['step'], $this->_sections['customer']['iteration']++):
$this->_sections['customer']['rownum'] = $this->_sections['customer']['iteration'];
$this->_sections['customer']['index_prev'] = $this->_sections['customer']['index'] - $this->_sections['customer']['step'];
$this->_sections['customer']['index_next'] = $this->_sections['customer']['index'] + $this->_sections['customer']['step'];
$this->_sections['customer']['first']	  = ($this->_sections['customer']['iteration'] == 1);
$this->_sections['customer']['last']	   = ($this->_sections['customer']['iteration'] == $this->_sections['customer']['total']);
?>
	<?php if ($this->_vars['SearchMethod'] == 4): ?>
		
			<span style="font-size: <?php echo $this->_vars['tag_size'][$this->_sections['customer']['index']]; ?>
pt">
				<a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/search.php?q=<?php echo $this->_vars['tag_name'][$this->_sections['customer']['index']]; ?>
&sa=Go&sitesearch=<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/&flav=0002&client=pub-1628281707918473&forid=1&ie=ISO-8859-1&oe=ISO-8859-1&cof=GALT%3A%23008000%3BGL%3A1%3BDIV%3A%23336699%3BVLC%3A663399%3BAH%3Acenter%3BBGC%3AFFFFFF%3BLBGC%3A336699%3BALC%3A0000FF%3BLC%3A0000FF%3BT%3A000000%3BGFNT%3A0000FF%3BGIMP%3A0000FF%3BFORID%3A11&hl=en"><?php echo $this->_vars['tag_name'][$this->_sections['customer']['index']]; ?>
</a>
			</span>
		
<?php else: ?>

			<span style="font-size: <?php echo $this->_vars['tag_size'][$this->_sections['customer']['index']]; ?>
pt">
				<a href="<?php echo $this->_vars['tag_url'][$this->_sections['customer']['index']]; ?>
"><?php echo $this->_vars['tag_name'][$this->_sections['customer']['index']]; ?>
</a>
			</span>
		
<?php endif; ?>
		
	<?php endfor; endif; ?>
	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_widget_tags_end"), $this);?>
</div>