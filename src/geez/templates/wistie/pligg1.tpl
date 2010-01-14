<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html dir="{#PLIGG_Visual_Language_Direction#}" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	
	<head>
			
		{checkActionsTpl location="tpl_pligg_head_start"}
		{include file="meta.tpl"}
	
		<link rel="stylesheet" type="text/css" href="{$my_pligg_base}/templates/{$the_template}/css/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="{$my_pligg_base}/templates/{$the_template}/css/wick.css" />

		<link rel="stylesheet" type="text/css" href="{$my_pligg_base}/templates/{$the_template}/css/dropdown.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="{$my_pligg_base}/templates/{$the_template}/css/dropdown-default.css" media="screen" />
		<!--[if lt IE 7]>
		<script type="text/javascript" src="{$my_pligg_base}/templates/{$the_template}/js/jquery/jquery.js"></script>
		<script type="text/javascript" src="{$my_pligg_base}/templates/{$the_template}/js/jquery/jquery.dropdown.js"></script>
		<![endif]-->
	
		{if $Voting_Method eq 2}
			<link rel="stylesheet" type="text/css" href="{$my_pligg_base}/templates/{$the_template}/css/star_rating/star.css" media="screen" />
		{/if}
	
		{checkForCss}
		{checkForJs}		
	
		{if $pagename neq "published" && $pagename neq "upcoming"}
			{if $Spell_Checker eq 1}			
				<script src="{$my_pligg_base}/3rdparty/speller/spellChecker.js" type="text/javascript"></script>
			{/if}
		{/if}	

		{if $request_category}
			<title>{$pretitle} {$meta_description} {if $pagename eq "upcoming"}| {$posttitle} {/if}| {#PLIGG_Visual_Name#}</title>
		{elseif $pagename eq "groups"}
			<title>{#PLIGG_Visual_Name#} | {#PLIGG_Visual_Groups#}</title>
		{elseif $pagename eq "group_story"}
			<title>{#PLIGG_Visual_Group#} | {$posttitle} | {#PLIGG_Visual_Name#}</title>
		{elseif $pagename eq "submit_groups"}
			<title>{#PLIGG_Visual_Name#} | {$posttitle}</title>
		{elseif $pagename eq "upcoming"}
			<title>{#PLIGG_Visual_Name#} | {#PLIGG_Visual_Pligg_Queued#}</title>
		{elseif $pagename eq "published"}
			<title>{#PLIGG_Visual_Name#}</title>
		{elseif $pagename eq "index"}
			<title>{#PLIGG_Visual_Name#} - {#PLIGG_Visual_RSS_Description#}</title>
		{elseif $pagename eq "story"}
			<title>{$pretitle} {$posttitle} | {#PLIGG_Visual_Name#}</title>
		{else}
			<title>{$pretitle} {#PLIGG_Visual_Name#} | {$posttitle}</title>
		{/if}
		
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="{$my_base_url}{$my_pligg_base}/rss.php"/>
		<link rel="icon" href="{$my_pligg_base}/favicon.ico" type="image/x-icon"/>



			
		{checkActionsTpl location="tpl_pligg_head_end"}
	
	
		
</head>


       
    

<body dir="{#PLIGG_Visual_Language_Direction#}" {$body_args}>
	{checkActionsTpl location="tpl_pligg_body_start"}

	<div id="content">
			
		{literal}
			<script type="text/javascript" language="JavaScript">
			function checkForm() {
			answer = true;
			if (siw && siw.selectingSomething)
				answer = false;
			return answer;
			}//
			
			
			</script>
		{/literal}
		
		

		
		{checkActionsTpl location="tpl_pligg_banner_top"}
		
		{include file=$tpl_header.".tpl"}
		

		
		
		
		
<!-- START STORY -->
		{checkActionsTpl location="tpl_pligg_content_start"}
			{checkActionsTpl location="tpl_pligg_above_center"}
			{include file=$tpl_center.".tpl"}
			{checkActionsTpl location="tpl_pligg_below_center"}
		{checkActionsTpl location="tpl_pligg_content_end"}
<!-- END STORY -->
	</div>
	


<!-- START RIGHT COLUMN -->
	
	
	{checkActionsTpl location="tpl_pligg_banner_bottom"}
	{include file=$tpl_footer.".tpl"}

	<script src="{$my_pligg_base}/templates/xmlhttp.php" type="text/javascript"></script> {* this line HAS to be towards the END of pligg.tpl *}
		
	</div>
	
	{checkActionsTpl location="tpl_pligg_body_end"}
	
	{literal}	
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-8198648-1");
pageTracker._trackPageview();
} catch(err) {}</script>
{/literal}
	
	 
</body>
</html>

 