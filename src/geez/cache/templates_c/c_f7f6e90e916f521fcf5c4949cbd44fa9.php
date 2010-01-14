<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 22:27:55 CDT */ ?>

<div class="pagewrap" style="line-height:<?php echo $this->_vars['tags_max_pts']; ?>
pt;">
<div style="margin: 0px 0px 10px; padding: 10px 0px" align="center">
<?php echo '

<script type="text/javascript"><!--
google_ad_client = "pub-5074133216375147";
/* 468x60, created 4/27/09 */
google_ad_slot = "5662034226";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
'; ?>

</div>
<?php if ($this->_vars['SearchMethod'] == 4): ?>
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
		<span style="font-size: <?php echo $this->_vars['tag_size'][$this->_sections['customer']['index']]; ?>
pt"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/search.php?q=<?php echo $this->_vars['tag_name'][$this->_sections['customer']['index']]; ?>
&sa=Go&sitesearch=<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/&flav=0002&client=pub-1628281707918473&forid=1&ie=ISO-8859-1&oe=ISO-8859-1&cof=GALT%3A%23008000%3BGL%3A1%3BDIV%3A%23336699%3BVLC%3A663399%3BAH%3Acenter%3BBGC%3AFFFFFF%3BLBGC%3A336699%3BALC%3A0000FF%3BLC%3A0000FF%3BT%3A000000%3BGFNT%3A0000FF%3BGIMP%3A0000FF%3BFORID%3A11&hl=en"><?php echo $this->_vars['tag_name'][$this->_sections['customer']['index']]; ?>
</a></span>&nbsp;&nbsp;
	<?php endfor; endif;  else:  if (isset($this->_sections['customer'])) unset($this->_sections['customer']);
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
		<span style="font-size: <?php echo $this->_vars['tag_size'][$this->_sections['customer']['index']]; ?>
pt"><a href="<?php echo $this->_vars['tag_url'][$this->_sections['customer']['index']]; ?>
"><?php echo $this->_vars['tag_name'][$this->_sections['customer']['index']]; ?>
</a></span>&nbsp;&nbsp;
	<?php endfor; endif;  endif; ?>

</div>

<div style="margin: 0px 0px 10px; padding: 10px 0px" align="center">
<?php echo '

<script type="text/javascript"><!--
google_ad_client = "pub-5074133216375147";
/* 468x60, created 4/27/09 */
google_ad_slot = "3461559089";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
'; ?>

</div>