<?php require_once('/home/pantofla/public_html/geez/plugins/modifier.sanitize.php'); $this->register_modifier("sanitize", "tpl_modifier_sanitize");  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:27 CDT */ ?>

<!-- START -->
	

<div class="roundedcornr_box_995209">
   <div class="roundedcornr_top_995209"><div></div></div>
      <div class="roundedcornr_content_995209">




 <?php $this->assign('sidebar_module', "logintest"); ?> <?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template_sidebar_modules']."/wrapper2.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


        
   


<div id="logo"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
"><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/logo2.png" border="0"; ><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
"></a></a>                       	             	
</div>

   </div>
   <div class="roundedcornr_bottom_995209"><div></div></div>
</div>





	<!-- start search -->
	<div class="search">
		<?php if (isset ( $_GET['search'] )): ?>
			<?php $this->assign('searchboxtext', $this->_run_modifier($_GET['search'], 'sanitize', 'plugin', 1, 2)); ?>
		<?php else: ?>
			<?php $this->assign('searchboxtext', $this->_confs['PLIGG_Visual_Search_SearchDefaultText']); ?>			
		<?php endif; ?>

		<?php if ($this->_vars['SearchMethod'] == 4): ?>
			<!-- Start SiteSearch Google -->
			<form method="get" action="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/search.php" target="_top">
				<label for="sbi" style="display: none">"<?php echo $this->_vars['searchboxtext']; ?>
</label>
				<input name="q" type="text" size="15" value="<?php echo $this->_vars['searchboxtext']; ?>
" onfocus="if(this.value == '<?php echo $this->_vars['searchboxtext']; ?>
') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $this->_vars['searchboxtext']; ?>
';}" />
				<label for="sbb" style="display: none"><?php echo $this->_confs['PLIGG_Visual_Search_Go']; ?>
</label>
				<input type="submit" name="sa" value= "<?php echo $this->_confs['PLIGG_Visual_Search_Go']; ?>
">
				<input type="hidden" name="sitesearch" value="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
" id="ss1"></input>
				<input type="hidden" name="flav" value="0002"></input>
				<input type="hidden" name="client" value="pub-1628281707918473"></input>
				<input type="hidden" name="forid" value="1"></input>
				<input type="hidden" name="ie" value="ISO-8859-1"></input>
				<input type="hidden" name="oe" value="ISO-8859-1"></input>
				<input type="hidden" name="cof" value="GALT:#008000;GL:1;DIV:#336699;VLC:663399;AH:center;BGC:FFFFFF;LBGC:336699;ALC:0000FF;LC:0000FF;T:000000;GFNT:0000FF;GIMP:0000FF;FORID:11"></input>
				<input type="hidden" name="hl" value="en"></input>
			</form>
			<!-- End SiteSearch Google -->				
		<?php else: ?>
			<form action="<?php echo $this->_vars['my_pligg_base']; ?>
/search.php" method="get" name="thisform-search" id="thisform-search">
				<input type="text" size="20" class="searchfield" name="search" id="searchsite" value="<?php echo $this->_vars['searchboxtext']; ?>
" onfocus="if(this.value == '<?php echo $this->_vars['searchboxtext']; ?>
') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $this->_vars['searchboxtext']; ?>
';}"/>
				<input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_Search_Go']; ?>
"  class="searchbuttongo"/> 
			</form>
			<div class="clear"></div>
		<?php endif; ?>
	</div>
	<!-- end search -->
	
	  	
  

	
	
<ul id="nav">

		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_navbar_start"), $this);?>
		<li <?php if ($this->_vars['pagename'] == "published" || $this->_vars['pagename'] == "index"): ?>class="current"<?php endif; ?>><a href='<?php echo $this->_vars['my_base_url'];  echo $this->_vars['URL_base']; ?>
'><?php echo $this->_confs['PLIGG_Visual_Published_News']; ?>
</a></li>
		<li <?php if ($this->_vars['pagename'] == "upcoming"): ?>class="current"<?php endif; ?>><a href="<?php echo $this->_vars['URL_upcoming']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Pligg_Queued']; ?>
</a></li>
		<li <?php if ($this->_vars['pagename'] == "submit"): ?>class="current"<?php endif; ?>><a href="<?php echo $this->_vars['URL_submit']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Submit_A_New_Story']; ?>
</a></li>
		<?php if ($this->_vars['enable_group'] == "true"): ?>	
			<li <?php if ($this->_vars['pagename'] == "groups"): ?>class="current"<?php endif; ?>><a href="<?php echo $this->_vars['URL_groups']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_Groups']; ?>
</span></a></li>
			<?php if ($this->_vars['group_allow'] == "1"): ?>
			<li <?php if ($this->_vars['pagename'] == "submit_groups"): ?>class="current"<?php endif; ?>><a href="<?php echo $this->_vars['URL_submit_groups']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_Submit_A_New_Group']; ?>
</span></a></li>
			<?php endif; ?>
		<?php endif; ?>	
		<?php if ($this->_vars['user_authenticated'] == true): ?><li <?php if ($this->_vars['pagename'] == "user"): ?>class="current"<?php endif; ?>><a href="<?php echo $this->_vars['URL_userNoVar']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_Profile']; ?>
</span></a></li><?php endif; ?>
		<?php if (isset ( $this->_vars['isgod'] ) && $this->_vars['isgod'] == 1): ?><li><a href="<?php echo $this->_vars['URL_admin']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_Header_AdminPanel']; ?>
</span></a></li><?php endif; ?>
		   
		
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_navbar_end"), $this);?>
	
	
	
	</ul>
  

	
<?php $this->assign('sidebar_module', "categories");  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template_sidebar_modules']."/wrapper.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
<!-- END HEADER -->

<div class="rsslink">
	<?php if ($this->_vars['URL_rss_page']): ?>
	<a href="<?php echo $this->_vars['URL_rss_page']; ?>
" target="_blank">
		RSS &nbsp;<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/rss.gif" align="top" border="0" alt="RSS" />
	</a>
	<?php endif; ?>
	</div>
	
    <h1>	
	
		<?php if ($this->_vars['pagename'] == "published" || $this->_vars['pagename'] == "index" && $this->_vars['user_authenticated'] != "true"): ?><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/rssfeeds.php" target="_blank">
		<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/rss.gif" RSS &nbsp; align="right" border="0" alt="RSS" />
	</a><?php endif; ?>
	

	
		
		
		<?php if ($this->_vars['pagename'] == "groups" || $this->_vars['pagename'] == "group_story"):  echo $this->_confs['PLIGG_Visual_Groups'];  endif; ?>
		<?php if ($this->_vars['pagename'] == "user"): ?><span style="text-transform:capitalize"><?php echo $this->_vars['page_header']; ?>
 	<a href="<?php echo $this->_vars['user_rss'].$this->_vars['view_href']; ?>
" target="_blank"><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/rss.gif" style="margin-left:6px;border:0;"></a>
		<?php endif; ?>
		<?php if ($this->_vars['pagename'] == "login"):  echo $this->_confs['PLIGG_Visual_Login'];  endif; ?>
		<?php if ($this->_vars['pagename'] == "register"):  echo $this->_confs['PLIGG_Visual_Register'];  endif; ?>
		<?php if ($this->_vars['pagename'] == "rssfeeds"):  echo $this->_confs['PLIGG_Visual_RSS_Feeds'];  endif; ?>
		<?php if ($this->_vars['pagename'] == "profile"):  echo $this->_confs['PLIGG_Visual_Profile_ModifyProfile'];  endif; ?>
		<?php if ($this->_vars['pagename'] == "topusers"):  echo $this->_confs['PLIGG_Visual_TopUsers_Statistics'];  endif; ?>
		<?php if ($this->_vars['pagename'] == "cloud"):  echo $this->_confs['PLIGG_Visual_Tags_Tags'];  endif; ?>
		<?php if ($this->_vars['pagename'] == "live" || $this->_vars['pagename'] == "live_unpublished" || $this->_vars['pagename'] == "live_published" || $this->_vars['pagename'] == "live_comments"):  echo $this->_confs['PLIGG_Visual_Live'];  endif; ?>
		<?php if ($this->_vars['pagename'] == "advancedsearch"):  echo $this->_confs['PLIGG_Visual_Search_Advanced'];  endif; ?>
		<?php if (isset ( $_GET['search'] )):  echo $this->_confs['PLIGG_Visual_Search_SearchResults']; ?>
 <?php echo $this->_run_modifier($this->_run_modifier($_GET['search'], 'sanitize', 'plugin', 1, 2), 'stripslashes', 'PHP', 1);  endif; ?>
		<?php if (isset ( $_GET['q'] )):  echo $this->_confs['PLIGG_Visual_Search_SearchResults']; ?>
 <?php echo $this->_run_modifier($this->_run_modifier($_GET['q'], 'sanitize', 'plugin', 1, 2), 'stripslashes', 'PHP', 1);  endif; ?> 
	
		<?php if ($this->_vars['pagename'] != "story" && $this->_vars['pagename'] != "user" && $this->_vars['pagename'] != "profile"): ?>
			<?php if (isset ( $this->_vars['navbar_where']['link2'] ) && $this->_vars['navbar_where']['link2'] != ""): ?> &#187; <a href="<?php echo $this->_vars['navbar_where']['link2']; ?>
"><?php echo $this->_vars['navbar_where']['text2']; ?>
</a><?php elseif (isset ( $this->_vars['navbar_where']['text2'] ) && $this->_vars['navbar_where']['text2'] != ""): ?> &#187; <?php echo $this->_vars['navbar_where']['text2'];  endif; ?>
			<?php if (isset ( $this->_vars['navbar_where']['link3'] ) && $this->_vars['navbar_where']['link3'] != ""): ?> &#187; <a href="<?php echo $this->_vars['navbar_where']['link3']; ?>
"><?php echo $this->_vars['navbar_where']['text3']; ?>
</a><?php elseif (isset ( $this->_vars['navbar_where']['text3'] ) && $this->_vars['navbar_where']['text3'] != ""): ?> &#187; <?php echo $this->_vars['navbar_where']['text3'];  endif; ?>
			<?php if (isset ( $this->_vars['navbar_where']['link4'] ) && $this->_vars['navbar_where']['link4'] != ""): ?> &#187; <a href="<?php echo $this->_vars['navbar_where']['link4']; ?>
"><?php echo $this->_vars['navbar_where']['text4']; ?>
</a><?php elseif (isset ( $this->_vars['navbar_where']['text4'] ) && $this->_vars['navbar_where']['text4'] != ""): ?> &#187; <?php echo $this->_vars['navbar_where']['text4'];  endif; ?>
		<?php endif; ?>
		<?php if ($this->_vars['pagename'] == "published" || $this->_vars['pagename'] == "index" || $this->_vars['pagename'] == "upcoming" && $this->_vars['pagename'] != "groups"): ?>


<?php if ($this->_vars['pagename'] == "index" || $this->_vars['pagename'] == "upcoming"): ?>
<div class="time">

<iframe src="http://free.timeanddate.com/clock/i1hcnyhr/n26/tlgr17/fs9/fti/tt0/tw1/tm1/ts1" frameborder="0" width="122" height="13"></iframe>

</div>
	<?php endif; ?>  




 
 

<div class="headline3">

    
		<div id="navcontainer1">
		
		
		
		
			<ul id="navlist1">
			
		
			
			
			
				<?php if ($this->_vars['setmeka'] == "" || $this->_vars['setmeka'] == "recent"): ?><li id="active"><a id="current" href="<?php echo $this->_vars['index_url_recent']; ?>
"><span class="active"><?php echo $this->_confs['PLIGG_Visual_Recently_Pop']; ?>
</span></a><?php else: ?><li><a href="<?php echo $this->_vars['index_url_recent']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Recently_Pop']; ?>
</a><?php endif; ?></li>
				<?php if ($this->_vars['setmeka'] == "today"): ?><li id="active" href="<?php echo $this->_vars['index_url_today']; ?>
"><a href="<?php echo $this->_vars['index_url_today']; ?>
" id="current"><span class="active"><?php echo $this->_confs['PLIGG_Visual_Top_Today']; ?>
</span></a><?php else: ?><li><a href="<?php echo $this->_vars['index_url_today']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Top_Today']; ?>
</a><?php endif; ?></li>
				<?php if ($this->_vars['setmeka'] == "yesterday"): ?><li id="active"><a id="current" href="<?php echo $this->_vars['index_url_yesterday']; ?>
"><span class="active"><?php echo $this->_confs['PLIGG_Visual_Yesterday']; ?>
</span></a><?php else: ?><li><a href="<?php echo $this->_vars['index_url_yesterday']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Yesterday']; ?>
</a><?php endif; ?></li>
				<?php if ($this->_vars['setmeka'] == "week"): ?><li id="active"><a id="current" href="<?php echo $this->_vars['index_url_week']; ?>
"><span class="active"><?php echo $this->_confs['PLIGG_Visual_This_Week']; ?>
</span></a><?php else: ?><li><a href="<?php echo $this->_vars['index_url_week']; ?>
"><?php echo $this->_confs['PLIGG_Visual_This_Week']; ?>
</a><?php endif; ?></li>
				<?php if ($this->_vars['setmeka'] == "month"): ?><li id="active"><a id="current" href="<?php echo $this->_vars['index_url_month']; ?>
"><span class="active"><?php echo $this->_confs['PLIGG_Visual_This_Month']; ?>
</span></a><?php else: ?><li><a href="<?php echo $this->_vars['index_url_month']; ?>
"><?php echo $this->_confs['PLIGG_Visual_This_Month']; ?>
</a><?php endif; ?></li>
				<?php if ($this->_vars['setmeka'] == "year"): ?><li id="active"><a id="current" href="<?php echo $this->_vars['index_url_year']; ?>
"><span class="active"><?php echo $this->_confs['PLIGG_Visual_This_Year']; ?>
</span></a><?php else: ?><li><a href="<?php echo $this->_vars['index_url_year']; ?>
"><?php echo $this->_confs['PLIGG_Visual_This_Year']; ?>
</a><?php endif; ?></li>

			</ul>

				</div>	
				
				
				
				

			</div>
	<!-- END SORT -->
	
		
	
	
	
	<?php endif; ?>
	








	<?php if ($this->_vars['pagename'] == "groups"): ?>
	<!-- START GROUP SORT -->
		<div class="headline">
			<div class="sectiontitle"><?php echo $this->_confs['PLIGG_Visual_Group_Sort']; ?>
</div>
		</div>
		<div id="navcontainer1">
			<ul id="navlist1">
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_group_sort_start"), $this);?>
				<?php if ($this->_vars['sortby'] == "members"): ?>
					<li id="active"><span class="active"><a id="current">
						<?php echo $this->_confs['PLIGG_Visual_Group_Sort_Members']; ?>

					</a></span></li>
				<?php else: ?> 
					<li><a href="<?php echo $this->_vars['group_url_members']; ?>
">
						<?php echo $this->_confs['PLIGG_Visual_Group_Sort_Members']; ?>

					</a></li>
				<?php endif; ?>
				<?php if ($this->_vars['sortby'] == "name"): ?>
					<li id="active"><span class="active"><a id="current">
						<?php echo $this->_confs['PLIGG_Visual_Group_Sort_Name']; ?>

					</a></span></li> 
				<?php else: ?>
					<li><a href="<?php echo $this->_vars['group_url_name']; ?>
">
						<?php echo $this->_confs['PLIGG_Visual_Group_Sort_Name']; ?>

					</a></li>
				<?php endif; ?>
				<?php if ($this->_vars['sortby'] == "newest"): ?>
					<li id="active"><span class="active"><a id="current">
						<?php echo $this->_confs['PLIGG_Visual_Group_Sort_Newest']; ?>

					</a></span></li>
				<?php else: ?>
					<li><a href="<?php echo $this->_vars['group_url_newest']; ?>
">
						<?php echo $this->_confs['PLIGG_Visual_Group_Sort_Newest']; ?>

					</a></li>
				<?php endif; ?>
				<?php if ($this->_vars['sortby'] == "oldest"): ?>
					<li id="active"><span class="active"><a id="current">
						<?php echo $this->_confs['PLIGG_Visual_Group_Sort_Oldest']; ?>

					</a></span></li>
				<?php else: ?>
					<li><a href="<?php echo $this->_vars['group_url_oldest']; ?>
">
						<?php echo $this->_confs['PLIGG_Visual_Group_Sort_Oldest']; ?>

					</a></li>
				<?php endif; ?>
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_group_sort_end"), $this);?>
			</ul>
		</div>
	<!-- END GROUP SORT -->
	<?php endif; ?>

	<?php if ($this->_vars['pagename'] == "group_story"): ?>
	<!-- START GROUP SORT -->
		<div class="headline">
			<div class="sectiontitle"><?php echo $this->_confs['PLIGG_Visual_Group_Sort']; ?>
</div>
		</div>
		<div id="navcontainer1">
			<ul id="navlist1">
				<div id="story_tabs">
					<span <?php if ($this->_vars['groupview'] == "published"): ?>class="selected"<?php endif; ?>><a href="<?php echo $this->_vars['groupview_published']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Group_Published']; ?>
</a></span>
					<span <?php if ($this->_vars['groupview'] == "upcoming"): ?>class="selected"<?php endif; ?>><a href="<?php echo $this->_vars['groupview_upcoming']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Group_Upcoming']; ?>
</a></span>
					<span <?php if ($this->_vars['groupview'] == "shared"): ?>class="selected"<?php endif; ?>><a href="<?php echo $this->_vars['groupview_sharing']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Group_Shared']; ?>
</a></span>
					<span <?php if ($this->_vars['groupview'] == "members"): ?>class="selected"<?php endif; ?>><a href="<?php echo $this->_vars['groupview_members']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Group_Member']; ?>
</a></span>
				</div>
			</ul>
		</div>
	<!-- END GROUP SORT -->
	<?php endif; ?>
	
	<?php if ($this->_vars['pagename'] == "cloud"): ?>
		<div class="headline">
			<div class="sectiontitle"><?php echo $this->_confs['PLIGG_Visual_Pligg_Queued_Sort']; ?>
 <?php echo $this->_confs['PLIGG_Visual_Tags_Link_Summary']; ?>
</div>
		</div>
		<div id="navcontainer1">
			<ul id="navlist1">
				<?php if (isset($this->_sections['i'])) unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['start'] = (int)0;
$this->_sections['i']['loop'] = is_array($this->_vars['count_range_values']) ? count($this->_vars['count_range_values']) : max(0, (int)$this->_vars['count_range_values']);
$this->_sections['i']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
if ($this->_sections['i']['start'] < 0)
	$this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
	$this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
	$this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
	if ($this->_sections['i']['total'] == 0)
		$this->_sections['i']['show'] = false;
} else
	$this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

		for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
			 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
			 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']	  = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']	   = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
					<?php if ($this->_sections['i']['index'] == $this->_vars['current_range']): ?>
						<li id="active"><a href="#"><span class="active"><?php echo $this->_vars['range_names'][$this->_sections['i']['index']]; ?>
</span></a></li>
					<?php else: ?>	
						<li><a href="<?php echo $this->_vars['URL_tagcloud_range'].$this->_sections['i']['index']; ?>
"><span><?php echo $this->_vars['range_names'][$this->_sections['i']['index']]; ?>
</span></a></li>
					<?php endif; ?>
				<?php endfor; endif; ?>
			</ul>   
		</div>
	<?php endif; ?>

	<?php if ($this->_vars['pagename'] == "live" || $this->_vars['pagename'] == "live_unpublished" || $this->_vars['pagename'] == "live_published" || $this->_vars['pagename'] == "live_comments"): ?>
		<div class="headline">
			<div class="sectiontitle"><?php echo $this->_confs['PLIGG_Visual_Pligg_Queued_Sort']; ?>
 <?php echo $this->_confs['PLIGG_Visual_Live']; ?>
</div>
		</div>
		<div id="navcontainer1">
			<ul id="navlist1">
				<li <?php if ($this->_vars['pagename'] == "live"): ?>id="active"<?php endif; ?>><a href="<?php echo $this->_vars['URL_live']; ?>
"><span <?php if ($this->_vars['pagename'] == "live"): ?>class="active"<?php endif; ?>><?php echo $this->_confs['PLIGG_Visual_Breadcrumb_All']; ?>
</span></a></li>
				<li <?php if ($this->_vars['pagename'] == "live_published"): ?>id="active"<?php endif; ?>><a href="<?php echo $this->_vars['URL_published']; ?>
"><span <?php if ($this->_vars['pagename'] == "live_published"): ?>class="active"<?php endif; ?>><?php echo $this->_confs['PLIGG_Visual_Breadcrumb_Published_Tab']; ?>
</span></a></li>
				<li <?php if ($this->_vars['pagename'] == "live_unpublished"): ?>id="active"<?php endif; ?>><a href="<?php echo $this->_vars['URL_unpublished']; ?>
"><span <?php if ($this->_vars['pagename'] == "live_unpublished"): ?>class="active"<?php endif; ?>><?php echo $this->_confs['PLIGG_Visual_Breadcrumb_Unpublished_Tab']; ?>
</span></a></li>
				<li <?php if ($this->_vars['pagename'] == "live_comments"): ?>id="active"<?php endif; ?>><a href="<?php echo $this->_vars['URL_comments']; ?>
"><span <?php if ($this->_vars['pagename'] == "live_comments"): ?>class="active"<?php endif; ?>><?php echo $this->_confs['PLIGG_Visual_Breadcrumb_Comments']; ?>
</span></a></li>
			</ul>
		</div>	
	<?php endif; ?>
	
	
	
	
	
	
	
	
	
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_breadcrumb_end"), $this);?>
	</h1>
	
	
	<?php if ($this->_vars['pagename'] == "submit"): ?>
	<?php elseif ($this->_vars['pagename'] != "story" && $this->_vars['pagename'] != "user" && $this->_vars['pagename'] != "profile" && $this->_vars['pagename'] != "login" && $this->_vars['pagename'] != "register"): ?>
		<div id="leftcol">
	<?php else: ?>
		<div id="leftcol-wide">
	<?php endif; ?>
	
	<?php if ($this->_vars['pagename'] == "group_story"): ?>
	<div id="group_navbar"></div>
	<?php endif; ?>
	
	
	
	