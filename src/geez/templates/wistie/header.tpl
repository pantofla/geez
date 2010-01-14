<!-- START -->
	

<div class="roundedcornr_box_995209">
   <div class="roundedcornr_top_995209"><div></div></div>
      <div class="roundedcornr_content_995209">




 {assign var=sidebar_module value="logintest"} {include file=$the_template_sidebar_modules."/wrapper2.tpl"}


        
   


<div id="logo"><a href="{$my_base_url}{$my_pligg_base}"><img src="{$my_pligg_base}/templates/{$the_template}/images/logo2.png" border="0"; ><a href="{$my_base_url}{$my_pligg_base}"></a></a>                       	             	
</div>

   </div>
   <div class="roundedcornr_bottom_995209"><div></div></div>
</div>





	<!-- start search -->
	<div class="search">
		{if isset($templatelite.get.search)}
			{assign var=searchboxtext value=$templatelite.get.search|sanitize:2}
		{else}
			{assign var=searchboxtext value=#PLIGG_Visual_Search_SearchDefaultText#}			
		{/if}

		{if $SearchMethod eq 4}
			<!-- Start SiteSearch Google -->
			<form method="get" action="{$my_base_url}{$my_pligg_base}/search.php" target="_top">
				<label for="sbi" style="display: none">"{$searchboxtext}</label>
				<input name="q" type="text" size="15" value="{$searchboxtext}" onfocus="if(this.value == '{$searchboxtext}') {ldelim}this.value = '';{rdelim}" onblur="if (this.value == '') {ldelim}this.value = '{$searchboxtext}';{rdelim}" />
				<label for="sbb" style="display: none">{#PLIGG_Visual_Search_Go#}</label>
				<input type="submit" name="sa" value= "{#PLIGG_Visual_Search_Go#}">
				<input type="hidden" name="sitesearch" value="{$my_base_url}{$my_pligg_base}" id="ss1"></input>
				<input type="hidden" name="flav" value="0002"></input>
				<input type="hidden" name="client" value="pub-1628281707918473"></input>
				<input type="hidden" name="forid" value="1"></input>
				<input type="hidden" name="ie" value="ISO-8859-1"></input>
				<input type="hidden" name="oe" value="ISO-8859-1"></input>
				<input type="hidden" name="cof" value="GALT:#008000;GL:1;DIV:#336699;VLC:663399;AH:center;BGC:FFFFFF;LBGC:336699;ALC:0000FF;LC:0000FF;T:000000;GFNT:0000FF;GIMP:0000FF;FORID:11"></input>
				<input type="hidden" name="hl" value="en"></input>
			</form>
			<!-- End SiteSearch Google -->				
		{else}
			<form action="{$my_pligg_base}/search.php" method="get" name="thisform-search" id="thisform-search">
				<input type="text" size="20" class="searchfield" name="search" id="searchsite" value="{$searchboxtext}" onfocus="if(this.value == '{$searchboxtext}') {ldelim}this.value = '';{rdelim}" onblur="if (this.value == '') {ldelim}this.value = '{$searchboxtext}';{rdelim}"/>
				<input type="submit" value="{#PLIGG_Visual_Search_Go#}"  class="searchbuttongo"/> 
			</form>
			<div class="clear"></div>
		{/if}
	</div>
	<!-- end search -->
	
	  	
  

	
	
<ul id="nav">

		{checkActionsTpl location="tpl_pligg_navbar_start"}
		<li {if $pagename eq "published" || $pagename eq "index"}class="current"{/if}><a href='{$my_base_url}{$URL_base}'>{#PLIGG_Visual_Published_News#}</a></li>
		<li {if $pagename eq "upcoming"}class="current"{/if}><a href="{$URL_upcoming}">{#PLIGG_Visual_Pligg_Queued#}</a></li>
		<li {if $pagename eq "submit"}class="current"{/if}><a href="{$URL_submit}">{#PLIGG_Visual_Submit_A_New_Story#}</a></li>
		{if $enable_group eq "true"}	
			<li {if $pagename eq "groups"}class="current"{/if}><a href="{$URL_groups}"><span>{#PLIGG_Visual_Groups#}</span></a></li>
			{if $group_allow eq "1"}
			<li {if $pagename eq "submit_groups"}class="current"{/if}><a href="{$URL_submit_groups}"><span>{#PLIGG_Visual_Submit_A_New_Group#}</span></a></li>
			{/if}
		{/if}	
		{if $user_authenticated eq true}<li {if $pagename eq "user"}class="current"{/if}><a href="{$URL_userNoVar}"><span>{#PLIGG_Visual_Profile#}</span></a></li>{/if}
		{if isset($isgod) && $isgod eq 1}<li><a href="{$URL_admin}"><span>{#PLIGG_Visual_Header_AdminPanel#}</span></a></li>{/if}
		   
		
		{checkActionsTpl location="tpl_pligg_navbar_end"}
	
	
	
	</ul>
  

	
{assign var=sidebar_module value="categories"}{include file=$the_template_sidebar_modules."/wrapper.tpl"}
<!-- END HEADER -->

<div class="rsslink">
	{if $URL_rss_page}
	<a href="{$URL_rss_page}" target="_blank">
		RSS &nbsp;<img src="{$my_pligg_base}/templates/{$the_template}/images/rss.gif" align="top" border="0" alt="RSS" />
	</a>
	{/if}
	</div>
	
    <h1>	
	
		{if $pagename eq "published" || $pagename eq "index" && $user_authenticated neq "true"}<a href="{$my_pligg_base}/rssfeeds.php" target="_blank">
		<img src="{$my_pligg_base}/templates/{$the_template}/images/rss.gif" RSS &nbsp; align="right" border="0" alt="RSS" />
	</a>{/if}
	

	{*	{if $pagename eq "published" || $pagename eq "index"}{#PLIGG_Visual_Published_News#}{/if} 
		{if $pagename eq "upcoming"}{#PLIGG_Visual_Pligg_Queued#}{/if}*}
		
		
		{if $pagename eq "groups" || $pagename eq "group_story" }{#PLIGG_Visual_Groups#}{/if}
		{if $pagename eq "user"}<span style="text-transform:capitalize">{$page_header} 	<a href="{$user_rss, $view_href}" target="_blank"><img src="{$my_pligg_base}/templates/{$the_template}/images/rss.gif" style="margin-left:6px;border:0;"></a>
		{/if}
		{if $pagename eq "login"}{#PLIGG_Visual_Login#}{/if}
		{if $pagename eq "register"}{#PLIGG_Visual_Register#}{/if}
		{if $pagename eq "rssfeeds"}{#PLIGG_Visual_RSS_Feeds#}{/if}
		{if $pagename eq "profile"}{#PLIGG_Visual_Profile_ModifyProfile#}{/if}
		{if $pagename eq "topusers"}{#PLIGG_Visual_TopUsers_Statistics#}{/if}
		{if $pagename eq "cloud"}{#PLIGG_Visual_Tags_Tags#}{/if}
		{if $pagename eq "live" || $pagename eq "live_unpublished" || $pagename eq "live_published" || $pagename eq "live_comments"}{#PLIGG_Visual_Live#}{/if}
		{if $pagename eq "advancedsearch"}{#PLIGG_Visual_Search_Advanced#}{/if}
		{if isset($templatelite.get.search)}{#PLIGG_Visual_Search_SearchResults#} {$templatelite.get.search|sanitize:2|stripslashes}{/if}
		{if isset($templatelite.get.q)}{#PLIGG_Visual_Search_SearchResults#} {$templatelite.get.q|sanitize:2|stripslashes}{/if} 
	
		{if $pagename neq "story" && $pagename neq "user" && $pagename neq "profile"}
			{if isset($navbar_where.link2) && $navbar_where.link2 neq ""} &#187; <a href="{$navbar_where.link2}">{$navbar_where.text2}</a>{elseif isset($navbar_where.text2) && $navbar_where.text2 neq ""} &#187; {$navbar_where.text2}{/if}
			{if isset($navbar_where.link3) && $navbar_where.link3 neq ""} &#187; <a href="{$navbar_where.link3}">{$navbar_where.text3}</a>{elseif isset($navbar_where.text3) && $navbar_where.text3 neq ""} &#187; {$navbar_where.text3}{/if}
			{if isset($navbar_where.link4) && $navbar_where.link4 neq ""} &#187; <a href="{$navbar_where.link4}">{$navbar_where.text4}</a>{elseif isset($navbar_where.text4) && $navbar_where.text4 neq ""} &#187; {$navbar_where.text4}{/if}
		{/if}
		{if $pagename eq "published" || $pagename eq "index" || $pagename eq "upcoming" && $pagename neq "groups"}


{if $pagename eq "index" || $pagename eq "upcoming"}
<div class="time">

<iframe src="http://free.timeanddate.com/clock/i1hcnyhr/n26/tlgr17/fs9/fti/tt0/tw1/tm1/ts1" frameborder="0" width="122" height="13"></iframe>

</div>
	{/if}  




 
 

<div class="headline3">

    
		<div id="navcontainer1">
		
		
		
		
			<ul id="navlist1">
			
		
			
			
			
				{if $setmeka eq "" || $setmeka eq "recent"}<li id="active"><a id="current" href="{$index_url_recent}"><span class="active">{#PLIGG_Visual_Recently_Pop#}</span></a>{else}<li><a href="{$index_url_recent}">{#PLIGG_Visual_Recently_Pop#}</a>{/if}</li>
				{if $setmeka eq "today"}<li id="active" href="{$index_url_today}"><a href="{$index_url_today}" id="current"><span class="active">{#PLIGG_Visual_Top_Today#}</span></a>{else}<li><a href="{$index_url_today}">{#PLIGG_Visual_Top_Today#}</a>{/if}</li>
				{if $setmeka eq "yesterday"}<li id="active"><a id="current" href="{$index_url_yesterday}"><span class="active">{#PLIGG_Visual_Yesterday#}</span></a>{else}<li><a href="{$index_url_yesterday}">{#PLIGG_Visual_Yesterday#}</a>{/if}</li>
				{if $setmeka eq "week"}<li id="active"><a id="current" href="{$index_url_week}"><span class="active">{#PLIGG_Visual_This_Week#}</span></a>{else}<li><a href="{$index_url_week}">{#PLIGG_Visual_This_Week#}</a>{/if}</li>
				{if $setmeka eq "month"}<li id="active"><a id="current" href="{$index_url_month}"><span class="active">{#PLIGG_Visual_This_Month#}</span></a>{else}<li><a href="{$index_url_month}">{#PLIGG_Visual_This_Month#}</a>{/if}</li>
				{if $setmeka eq "year"}<li id="active"><a id="current" href="{$index_url_year}"><span class="active">{#PLIGG_Visual_This_Year#}</span></a>{else}<li><a href="{$index_url_year}">{#PLIGG_Visual_This_Year#}</a>{/if}</li>

			</ul>

				</div>	
				
				
				
				

			</div>
	<!-- END SORT -->
	
		
	
	
	
	{/if}
	








	{if $pagename eq "groups"}
	<!-- START GROUP SORT -->
		<div class="headline">
			<div class="sectiontitle">{#PLIGG_Visual_Group_Sort#}</div>
		</div>
		<div id="navcontainer1">
			<ul id="navlist1">
				{checkActionsTpl location="tpl_pligg_group_sort_start"}
				{if $sortby eq "members"}
					<li id="active"><span class="active"><a id="current">
						{#PLIGG_Visual_Group_Sort_Members#}
					</a></span></li>
				{else} 
					<li><a href="{$group_url_members}">
						{#PLIGG_Visual_Group_Sort_Members#}
					</a></li>
				{/if}
				{if $sortby eq "name"}
					<li id="active"><span class="active"><a id="current">
						{#PLIGG_Visual_Group_Sort_Name#}
					</a></span></li> 
				{else}
					<li><a href="{$group_url_name}">
						{#PLIGG_Visual_Group_Sort_Name#}
					</a></li>
				{/if}
				{if $sortby eq "newest"}
					<li id="active"><span class="active"><a id="current">
						{#PLIGG_Visual_Group_Sort_Newest#}
					</a></span></li>
				{else}
					<li><a href="{$group_url_newest}">
						{#PLIGG_Visual_Group_Sort_Newest#}
					</a></li>
				{/if}
				{if $sortby eq "oldest"}
					<li id="active"><span class="active"><a id="current">
						{#PLIGG_Visual_Group_Sort_Oldest#}
					</a></span></li>
				{else}
					<li><a href="{$group_url_oldest}">
						{#PLIGG_Visual_Group_Sort_Oldest#}
					</a></li>
				{/if}
				{checkActionsTpl location="tpl_pligg_group_sort_end"}
			</ul>
		</div>
	<!-- END GROUP SORT -->
	{/if}

	{if $pagename eq "group_story"}
	<!-- START GROUP SORT -->
		<div class="headline">
			<div class="sectiontitle">{#PLIGG_Visual_Group_Sort#}</div>
		</div>
		<div id="navcontainer1">
			<ul id="navlist1">
				<div id="story_tabs">
					<span {if $groupview eq "published"}class="selected"{/if}><a href="{$groupview_published}">{#PLIGG_Visual_Group_Published#}</a></span>
					<span {if $groupview eq "upcoming"}class="selected"{/if}><a href="{$groupview_upcoming}">{#PLIGG_Visual_Group_Upcoming#}</a></span>
					<span {if $groupview eq "shared"}class="selected"{/if}><a href="{$groupview_sharing}">{#PLIGG_Visual_Group_Shared#}</a></span>
					<span {if $groupview eq "members"}class="selected"{/if}><a href="{$groupview_members}">{#PLIGG_Visual_Group_Member#}</a></span>
				</div>
			</ul>
		</div>
	<!-- END GROUP SORT -->
	{/if}
	
	{if $pagename eq "cloud"}
		<div class="headline">
			<div class="sectiontitle">{#PLIGG_Visual_Pligg_Queued_Sort#} {#PLIGG_Visual_Tags_Link_Summary#}</div>
		</div>
		<div id="navcontainer1">
			<ul id="navlist1">
				{section name=i start=0 loop=$count_range_values step=1}
					{if $templatelite.section.i.index eq $current_range}
						<li id="active"><a href="#"><span class="active">{$range_names[i]}</span></a></li>
					{else}	
						<li><a href="{$URL_tagcloud_range, $templatelite.section.i.index}"><span>{$range_names[i]}</span></a></li>
					{/if}
				{/section}
			</ul>   
		</div>
	{/if}

	{if $pagename eq "live" || $pagename eq "live_unpublished" || $pagename eq "live_published" || $pagename eq "live_comments"}
		<div class="headline">
			<div class="sectiontitle">{#PLIGG_Visual_Pligg_Queued_Sort#} {#PLIGG_Visual_Live#}</div>
		</div>
		<div id="navcontainer1">
			<ul id="navlist1">
				<li {if $pagename eq "live"}id="active"{/if}><a href="{$URL_live}"><span {if $pagename eq "live"}class="active"{/if}>{#PLIGG_Visual_Breadcrumb_All#}</span></a></li>
				<li {if $pagename eq "live_published"}id="active"{/if}><a href="{$URL_published}"><span {if $pagename eq "live_published"}class="active"{/if}>{#PLIGG_Visual_Breadcrumb_Published_Tab#}</span></a></li>
				<li {if $pagename eq "live_unpublished"}id="active"{/if}><a href="{$URL_unpublished}"><span {if $pagename eq "live_unpublished"}class="active"{/if}>{#PLIGG_Visual_Breadcrumb_Unpublished_Tab#}</span></a></li>
				<li {if $pagename eq "live_comments"}id="active"{/if}><a href="{$URL_comments}"><span {if $pagename eq "live_comments"}class="active"{/if}>{#PLIGG_Visual_Breadcrumb_Comments#}</span></a></li>
			</ul>
		</div>	
	{/if}
	
	
	
	
	
	
	
	
	
		{checkActionsTpl location="tpl_pligg_breadcrumb_end"}
	</h1>
	
	
	{if $pagename eq "submit"}
	{elseif $pagename neq "story" && $pagename neq "user" && $pagename neq "profile" && $pagename neq "login" && $pagename neq "register" }
		<div id="leftcol">
	{else}
		<div id="leftcol-wide">
	{/if}
	
	{if $pagename eq "group_story"}
	<div id="group_navbar"></div>
	{/if}
	
	
	
	