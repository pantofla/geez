<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:14:59 CDT */ ?>


<?php if ($this->_vars['SearchMethod'] == 4): ?>

	<!-- Google Search Result Snippet Begins -->
	<div id="googleSearchUnitIframe"></div>
	
	<script type="text/javascript">
	   var googleSearchIframeName = 'googleSearchUnitIframe';
	   var googleSearchFrameWidth = 560;
	   var googleSearchFrameborder = 0 ;
	   var googleSearchDomain = 'www.google.com';
	</script>
	<script type="text/javascript" src="http://www.google.com/afsonline/show_afs_search.js"></script>
	
	<!-- Google Search Result Snippet Ends -->
	
<?php else: ?>

	<?php echo $this->_vars['link_summary_output']; ?>

	<br />
	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_pagination_start"), $this);?>
	<?php echo $this->_vars['search_pagination']; ?>

	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_pagination_end"), $this);?>

<?php endif; ?>
