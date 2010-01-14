
{if $SearchMethod eq 4}

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
	
{else}

	{$link_summary_output}
	<br />
	{checkActionsTpl location="tpl_pligg_pagination_start"}
	{$search_pagination}
	{checkActionsTpl location="tpl_pligg_pagination_end"}

{/if}
