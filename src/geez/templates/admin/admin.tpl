<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	{checkActionsTpl location="tpl_pligg_admin_head_start"}
	<link rel="stylesheet" type="text/css" href="{$my_pligg_base}/templates/admin/css/fraxi.css" media="screen">
	{checkForCss}
	
	<meta name="Language" content="en-us">
	<meta name="Robots" content="none">
	
	<title>{#PLIGG_Visual_Name#} Admin Panel</title>
	<link rel="icon" href="{$my_pligg_base}/favicon.ico" type="image/x-icon"/>	
	
	<!--[if lte IE 6]><link rel="stylesheet" href="{$my_pligg_base}/templates/admin/css/ie6.css" type="text/css" media="all" /><![endif]-->
	
	{if $pagename eq "admin_categories" || $modulename eq "admin_language" || $modulename eq "rss_import" || $pagename eq "admin_config"}
		<script type='text/javascript' src='{$my_pligg_base}/templates/admin/js/prototype.js'></script>
		<script type='text/javascript' src='{$my_pligg_base}/templates/admin/js/scriptaculous.js?load=effects'></script>
		<script type='text/javascript' src='{$my_pligg_base}/templates/admin/js/effects.js'></script>
		<script type='text/javascript' src='{$my_pligg_base}/templates/admin/js/pligg_effects.js'></script>
		<script type='text/javascript' src='{$my_pligg_base}/templates/admin/js/dragdrop.js'></script>
		<script type='text/javascript' src="{$my_pligg_base}/templates/admin/js/EditInPlace.js" ></script>
		<script type='text/javascript' src="{$my_pligg_base}/templates/admin/js/EditInPlaceAL.js" ></script>
	{/if}
	
	{if $pagename eq "admin_page"}
		<script type='text/javascript' src="{$my_pligg_base}/templates/admin/js/sorting_table.js" ></script>
	{/if}

	{checkActionsTpl location="tpl_pligg_admin_head_end"}
</head>
<body dir="{#PLIGG_Visual_Language_Direction#}" >
{checkActionsTpl location="tpl_pligg_admin_body_start"}
<div class="logo"><a href="{$my_pligg_base}/index.php"><img src="{$my_pligg_base}/templates/admin/images/logo.gif" alt="Pligg CMS" title="Pligg CMS"/></a></div>

<div id="body-wrap">
	<div id="header">
		<div id="head-nav">
			<ul class="nav-menu">
				<li><a href="{$my_pligg_base}/admin/admin_index.php" {if $pagename eq "admin_index"}class="navcur"{else}class="nav"{/if}>{#PLIGG_Visual_AdminPanel#}</a></li>
				<li><a href="{$my_pligg_base}/admin/admin_links.php" {if $pagename eq "admin_categories" || $pagename eq "admin_comments" || $pagename eq "admin_links" || $pagename eq "admin_users" || $pagename eq "admin_user_validate" || $pagename eq "admin_page"}class="navcur"{else}class="nav"{/if} >{#PLIGG_Visual_AdminPanel_Manage_Nav#}</a></li> 
				<li><a href="{$my_pligg_base}/admin/admin_config.php" {if $pagename eq "admin_config"}class="navcur"{else}class="nav"{/if} >{#PLIGG_Visual_AdminPanel_Configure#}</a></li>
				<li><a href="{$my_pligg_base}/admin/admin_backup.php" {if $pagename eq "admin_backup"}class="navcur"{else}class="nav"{/if} >{#PLIGG_Visual_AdminPanel_Backup_Nav#}</a></li>
				<li><a href="{$my_pligg_base}/admin/admin_modules.php" {if $pagename eq "admin_modules"}class="navcur"{else}class="nav"{/if} >{#PLIGG_Visual_AdminPanel_Modules_Nav#}</a></li>
				<li><a href="{$my_pligg_base}/admin/admin_editor.php" {if $pagename eq "admin_editor"}class="navcur"{else}class="nav"{/if} >{#PLIGG_Visual_AdminPanel_Template_Nav#}</a></li>
				{checkActionsTpl location="tpl_header_admin_links"}
				<li><a href="{$my_pligg_base}/index.php" class="nav">{#PLIGG_Visual_Home#}</a></li>
			</ul>
			<div id="navbar">
				  <a href="{$my_pligg_base}/index.php">{#PLIGG_Visual_Home#}</a> &rsaquo; <a href="{$my_pligg_base}/admin/admin_index.php">{#PLIGG_Visual_AdminPanel#}</a> &rsaquo; 
				  {if $pagename eq "admin_backup"}{#PLIGG_Visual_AdminPanel_Backup#}{/if}
				  {if $module eq "captcha"}{#PLIGG_Visual_AdminPanel_Captcha#}{/if}
				  {if $pagename eq "admin_categories" || $pagename eq "admin_categories_tasks"}{#PLIGG_Visual_AdminPanel_Categories#}{/if}
				  {if $pagename eq "admin_comments"}{#PLIGG_Visual_AdminPanel_Comments#}{/if}
				  {if $pagename eq "admin_config"}{#PLIGG_Visual_AdminPanel_Configure#}{/if}
				  {if $pagename eq "admin_index"}{#PLIGG_Visual_AdminPanel_Home#}{/if}
				  {if $module eq "admin_language"}{#PLIGG_Visual_AdminPanel_Language#}{/if}
				  {if $pagename eq "admin_modules"}{#PLIGG_Visual_AdminPanel_Modules_Nav#}{/if}
				  {if $pagename eq "admin_page"}{#PLIGG_Visual_AdminPanel_Pages#}{/if}
				  {if $pagename eq "admin_links"}{#PLIGG_Visual_AdminPanel_News#}{/if}
				  {if $pagename eq "admin_editor"}{#PLIGG_Visual_AdminPanel_Template_Nav#}{/if}
				  {if $pagename eq "admin_users"}{#PLIGG_Visual_AdminPanel_Users#}{/if}
				  {checkActionsTpl location="tpl_pligg_admin_breadcrumbs"}
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div id="body-contents">
		{if $pagename eq "admin_links" || $pagename eq "admin_users" || $pagename eq "admin_comments" || $pagename eq "admin_categories" || $pagename eq "admin_categories_tasks" || $pagename eq "admin_page" || $pagename eq "edit_page" || $pagename eq "submit_page"}
		<div class="tab-nav-spacing"><div class="tab-nav">
		  <ul>
			{checkActionsTpl location="tpl_pligg_admin_navtabs_start"}
			<li {if $pagename eq "admin_links"}class="cur"{/if}><span><a href="{$my_pligg_base}/admin/admin_links.php">{#PLIGG_Visual_AdminPanel_News#}</a></span></li>
			<li {if $pagename eq "admin_users"}class="cur"{/if}><span><a href="{$my_pligg_base}/admin/admin_users.php">{#PLIGG_Visual_AdminPanel_Users#}</a></span></li>
			<li {if $pagename eq "admin_comments"}class="cur"{/if}><span><a href="{$my_pligg_base}/admin/admin_comments.php">{#PLIGG_Visual_AdminPanel_Comments#}</a></span></li>
			<li {if $pagename eq "admin_categories" || $pagename eq "admin_categories_tasks"}class="cur"{/if}><span><a href="{$my_pligg_base}/admin/admin_categories.php">{#PLIGG_Visual_AdminPanel_Categories#}</a></span></li>
			<li {if $pagename eq "admin_page" || $pagename eq "edit_page" || $pagename eq "submit_page"}class="cur"{/if}><span><a href="{$my_pligg_base}/admin/admin_page.php">{#PLIGG_Visual_AdminPanel_Pages#}</a></span></li>
			{checkActionsTpl location="tpl_pligg_admin_navtabs_end"}
		  </ul>
		</div></div>
		{/if}
		{if $pagename neq "module" && $pagename neq "admin_modules" && $pagename neq "submit_page" && $pagename neq "edit_page" && $pagename neq "admin_categories"}
	    <div class="sidebar" id="sideitems">
		  
			{checkActionsTpl location="tpl_pligg_admin_sidebar_start"}
			
		    <h3>Pligg News</h3>
			<div id="side-stories" class="side-box">
				{php}
				
				require '../templates/admin/simplepie.inc';
				$url = 'http://www.pligg.com/rss/blog';

				function shorten($string, $length)
				{
				// By default, an ellipsis will be appended to the end of the text.
				$suffix = '';

				// Convert 'smart' punctuation to 'dumb' punctuation, strip the HTML tags,
				// and convert all tabs and line-break characters to single spaces.
				$short_desc = trim(str_replace(array("\r","\n", "\t"), ' ', strip_tags($string)));

				// Cut the string to the requested length, and strip any extraneous spaces 
				// from the beginning and end.
				$desc = trim(substr($short_desc, 0, $length));

				// Find out what the last displayed character is in the shortened string
				$lastchar = substr($desc, -1, 1);

				// If the last character is a period, an exclamation point, or a question 
				// mark, clear out the appended text.
				if ($lastchar == '.' || $lastchar == '!' || $lastchar == '?') $suffix='';

				// Append the text.
				$desc .= $suffix;

				// Send the new description back to the page.
				return $desc;
				}

				$feed = new SimplePie();
				$feed->set_feed_url($url);
				$feed->init();

				// default starting item
				$start = 0;

				// default number of items to display. 0 = all
				$length = 5; 
				$shortdesc = 40;

				// set item link to script uri
				$link = $_SERVER['REQUEST_URI'];

				// loop through items
				foreach($feed->get_items($start,$length) as $key=>$item)
				{

				// set query string to item number
				$queryString = '?item=' . $key;

				$link = $item->get_link();
				$queryString = '';        

				// display item title and date    
				echo '<h4 style="padding-top:6px;"><a href="' . $link . $queryString . '">' . shorten($item->get_title(), 33) . '</a></h4>';
				echo ' <p style="padding-bottom:4px;"><span style="font-size:12px;line-height:13px;">',shorten($item->get_description(), 133),'...</span></p>';

				echo '';
				}
				
				{/php}
			</div>	
			
			<h3>New Products</h3>
			<div id="side-stories" class="side-box">
				{php}
				$url = 'http://www.pligg.com/rss/products';

				$feed = new SimplePie();
				$feed->set_feed_url($url);
				$feed->init();

				// default starting item
				$start = 0;

				// default number of items to display. 0 = all
				$length = 5; 
				$shortdesc = 40;

				// set item link to script uri
				$link = $_SERVER['REQUEST_URI'];

				// loop through items
				foreach($feed->get_items($start,$length) as $key=>$item)
				{

				// set query string to item number
				$queryString = '?item=' . $key;

				$link = $item->get_link();
				$queryString = '';        

				// display item title and date    
				echo '<li><a href="' . $link . $queryString . '">' . shorten($item->get_title(), 33) . '</a></li>';
				// if single item, display content
				if(isset($_GET['item']))

				echo '';
				}
				
				{/php}
			</div>	
			
			{checkActionsTpl location="tpl_pligg_admin_sidebar_end"}	
			
	    </div> <!-- End Sidebar and Sideitems -->
		{/if}
		
		<div class="bluerndcontent">
			{checkActionsTpl location="tpl_pligg_admin_legend_before"}
			{include file=$tpl_center.".tpl"}
			{* Start Pagination *}
				{if $pagename eq "admin_users" || $pagename eq "admin_comments" || $pagename eq "admin_links" || $pagename eq "admin_user_validate"}	
					<fieldset>
					<br />
					{php} 
					Global $db, $main_smarty, $rows, $offset, $URLMethod;
					$oldURLMethod=$URLMethod;
					$URLMethod=1;
					$pagesize=get_misc_data('pagesize');
					do_pages($rows, $pagesize ? $pagesize : 30, $the_page); 
					$URLMethod=$oldURLMethod;
					{/php}
					</fieldset>
				{/if} 
			{* End Pagination *}
			{checkActionsTpl location="tpl_pligg_admin_legend_after"}
		</div>
		
		{if $pagename neq "admin_modules"}
		<div id="footer-wrap">
			<div class="footer">
				<div class="rss-feeds">
				<h1>Pligg RSS Feeds</h1>
				<ul>
					<li><a href="http://www.pligg.com/blog/feed/" target="_blank">Blog</a></li>
					<li><a href="http://twitter.com/statuses/user_timeline/6024362.rss" target="_blank">SVN</a></li>
					<li><a href="http://forums.pligg.com/external.php" target="_blank">Forum</a></li>
				</ul>
				</div>
			</div>
			<div id="about">
			<h3><a href="http://forums.pligg.com/" target="_blank">{#PLIGG_Visual_AdminPanel_Help#}!</a></h3>
			<br /><div class="design">{#PLIGG_Visual_AdminPanel_Help_1#} <a href="http://www.pligg.com">Pligg.com</a> {#PLIGG_Visual_AdminPanel_Help_2#} <a href="http://forums.pligg.com">Pligg Forum.</a></div>
			<br>
			</div>
		</div>
		{/if}

	</div>
</div>

{checkActionsTpl location="tpl_pligg_admin_body_end"}
</body>
</html>
