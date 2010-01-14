{php}
	include_once(mnminclude.'tags.php');
	global $main_smarty;
	
	$cloud=new TagCloud();
	$cloud->smarty_variable = $main_smarty; // pass smarty to the function so we can set some variables
	$cloud->word_limit = tags_words_limit_s;
	$cloud->min_points = tags_min_pts_s; // the size of the smallest tag
	$cloud->max_points = tags_max_pts_s; // the size of the largest tag
	
	$cloud->show();
	$main_smarty = $cloud->smarty_variable; // get the updated smarty back from the function
{/php}

<div class="test">
	<div class="sectiontitle"><a href="{$URL_tagcloud}">{#PLIGG_Visual_Top_5_Tags#}</a></div>
</div>
{checkActionsTpl location="tpl_widget_tags_start"}
<div id="space2"></div>
<div class="boxcontent tagformat testsection">
	{section name=customer loop=$tag_number}
	{if $SearchMethod eq 4}
		{* --- to change the way the words are displayed, change this part --- *}
			<span style="font-size: {$tag_size[customer]}pt">
				<a href="{$my_base_url}{$my_pligg_base}/search.php?q={$tag_name[customer]}&sa=Go&sitesearch={$my_base_url}{$my_pligg_base}/&flav=0002&client=pub-1628281707918473&forid=1&ie=ISO-8859-1&oe=ISO-8859-1&cof=GALT%3A%23008000%3BGL%3A1%3BDIV%3A%23336699%3BVLC%3A663399%3BAH%3Acenter%3BBGC%3AFFFFFF%3BLBGC%3A336699%3BALC%3A0000FF%3BLC%3A0000FF%3BT%3A000000%3BGFNT%3A0000FF%3BGIMP%3A0000FF%3BFORID%3A11&hl=en">{$tag_name[customer]}</a>
			</span>
		{* ---		--- *}
{else}
{* --- to change the way the words are displayed, change this part --- *}
			<span style="font-size: {$tag_size[customer]}pt">
				<a href="{$tag_url[customer]}">{$tag_name[customer]}</a>
			</span>
		{* ---		--- *}
{/if}
		
	{/section}
	{checkActionsTpl location="tpl_widget_tags_end"}
</div>