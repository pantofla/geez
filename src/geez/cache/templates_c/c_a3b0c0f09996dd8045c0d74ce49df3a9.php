<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 08:14:53 CDT */ ?>

<div class="pagewrap">
<div style="margin: 0px 0px 10px; padding: 10px 0px" align="center">
<?php echo '

<script type="text/javascript"><!--
google_ad_client = "pub-5074133216375147";
/* 468x60, created 4/27/09 */
google_ad_slot = "3227571204";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
'; ?>

</div>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_topusers_start"), $this);?>
<table>
	<tr>

		<?php if (count((array)$this->_vars['headers'])): foreach ((array)$this->_vars['headers'] as $this->_vars['number'] => $this->_vars['header']): ?>
			<th>
				<?php if ($this->_vars['number'] == $_GET['sortby']): ?>
					<span><?php echo $this->_vars['header']; ?>
</span>
				<?php else: ?>
					<a href="?sortby=<?php echo $this->_vars['number']; ?>
"><?php echo $this->_vars['header']; ?>
</a>
				<?php endif; ?>
			</th>
		<?php endforeach; endif; ?>

		<th>
			<?php echo $this->_confs['PLIGG_Visual_TopUsers_TH_Karma']; ?>

		</th>
	</tr>

	<?php echo $this->_vars['users_table']; ?>


</table>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_topusers_end"), $this);?>
</div>

<br />
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_pagination_start"), $this); echo $this->_vars['topusers_pagination']; ?>

<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_pagination_end"), $this);?>
<div style="margin: 0px 0px 10px; padding: 10px 0px" align="center">
<?php echo '

<script type="text/javascript"><!--
google_ad_client = "pub-5074133216375147";
/* 468x60, created 4/27/09 */
google_ad_slot = "9734887712";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
'; ?>

</div>