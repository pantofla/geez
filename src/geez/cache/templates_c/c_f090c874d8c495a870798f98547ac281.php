<?php require_once('/home/pantofla/public_html/geez/plugins/function.checkForCss.php'); $this->register_function("checkForCss", "tpl_function_checkForCss");  require_once('/home/pantofla/public_html/geez/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:41 CDT */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_head_start"), $this);?>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/css/fraxi.css" media="screen">
	<?php echo tpl_function_checkForCss(array(), $this);?>
	
	<meta name="Language" content="en-us">
	<meta name="Robots" content="none">
	
	<title><?php echo $this->_confs['PLIGG_Visual_Name']; ?>
 Admin Panel</title>
	<link rel="icon" href="<?php echo $this->_vars['my_pligg_base']; ?>
/favicon.ico" type="image/x-icon"/>	
	
	<!--[if lte IE 6]><link rel="stylesheet" href="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/css/ie6.css" type="text/css" media="all" /><![endif]-->
	
	<?php if ($this->_vars['pagename'] == "admin_categories" || $this->_vars['modulename'] == "admin_language" || $this->_vars['modulename'] == "rss_import" || $this->_vars['pagename'] == "admin_config"): ?>
		<script type='text/javascript' src='<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/prototype.js'></script>
		<script type='text/javascript' src='<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/scriptaculous.js?load=effects'></script>
		<script type='text/javascript' src='<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/effects.js'></script>
		<script type='text/javascript' src='<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/pligg_effects.js'></script>
		<script type='text/javascript' src='<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/dragdrop.js'></script>
		<script type='text/javascript' src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/EditInPlace.js" ></script>
		<script type='text/javascript' src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/EditInPlaceAL.js" ></script>
	<?php endif; ?>
	
	<?php if ($this->_vars['pagename'] == "admin_page"): ?>
		<script type='text/javascript' src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/js/sorting_table.js" ></script>
	<?php endif; ?>

	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_head_end"), $this);?>
</head>
<body dir="<?php echo $this->_confs['PLIGG_Visual_Language_Direction']; ?>
" >
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_body_start"), $this);?>
<div class="logo"><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/index.php"><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/admin/images/logo.gif" alt="Pligg CMS" title="Pligg CMS"/></a></div>

<div id="body-wrap">
	<div id="header">
		<div id="head-nav">
			<ul class="nav-menu">
				<li><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_index.php" <?php if ($this->_vars['pagename'] == "admin_index"): ?>class="navcur"<?php else: ?>class="nav"<?php endif; ?>><?php echo $this->_confs['PLIGG_Visual_AdminPanel']; ?>
</a></li>
				<li><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_links.php" <?php if ($this->_vars['pagename'] == "admin_categories" || $this->_vars['pagename'] == "admin_comments" || $this->_vars['pagename'] == "admin_links" || $this->_vars['pagename'] == "admin_users" || $this->_vars['pagename'] == "admin_user_validate" || $this->_vars['pagename'] == "admin_page"): ?>class="navcur"<?php else: ?>class="nav"<?php endif; ?> ><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Manage_Nav']; ?>
</a></li> 
				<li><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_config.php" <?php if ($this->_vars['pagename'] == "admin_config"): ?>class="navcur"<?php else: ?>class="nav"<?php endif; ?> ><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Configure']; ?>
</a></li>
				<li><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_backup.php" <?php if ($this->_vars['pagename'] == "admin_backup"): ?>class="navcur"<?php else: ?>class="nav"<?php endif; ?> ><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Backup_Nav']; ?>
</a></li>
				<li><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_modules.php" <?php if ($this->_vars['pagename'] == "admin_modules"): ?>class="navcur"<?php else: ?>class="nav"<?php endif; ?> ><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Modules_Nav']; ?>
</a></li>
				<li><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_editor.php" <?php if ($this->_vars['pagename'] == "admin_editor"): ?>class="navcur"<?php else: ?>class="nav"<?php endif; ?> ><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Template_Nav']; ?>
</a></li>
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_header_admin_links"), $this);?>
				<li><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/index.php" class="nav"><?php echo $this->_confs['PLIGG_Visual_Home']; ?>
</a></li>
			</ul>
			<div id="navbar">
				  <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/index.php"><?php echo $this->_confs['PLIGG_Visual_Home']; ?>
</a> &rsaquo; <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_index.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel']; ?>
</a> &rsaquo; 
				  <?php if ($this->_vars['pagename'] == "admin_backup"):  echo $this->_confs['PLIGG_Visual_AdminPanel_Backup'];  endif; ?>
				  <?php if ($this->_vars['module'] == "captcha"):  echo $this->_confs['PLIGG_Visual_AdminPanel_Captcha'];  endif; ?>
				  <?php if ($this->_vars['pagename'] == "admin_categories" || $this->_vars['pagename'] == "admin_categories_tasks"):  echo $this->_confs['PLIGG_Visual_AdminPanel_Categories'];  endif; ?>
				  <?php if ($this->_vars['pagename'] == "admin_comments"):  echo $this->_confs['PLIGG_Visual_AdminPanel_Comments'];  endif; ?>
				  <?php if ($this->_vars['pagename'] == "admin_config"):  echo $this->_confs['PLIGG_Visual_AdminPanel_Configure'];  endif; ?>
				  <?php if ($this->_vars['pagename'] == "admin_index"):  echo $this->_confs['PLIGG_Visual_AdminPanel_Home'];  endif; ?>
				  <?php if ($this->_vars['module'] == "admin_language"):  echo $this->_confs['PLIGG_Visual_AdminPanel_Language'];  endif; ?>
				  <?php if ($this->_vars['pagename'] == "admin_modules"):  echo $this->_confs['PLIGG_Visual_AdminPanel_Modules_Nav'];  endif; ?>
				  <?php if ($this->_vars['pagename'] == "admin_page"):  echo $this->_confs['PLIGG_Visual_AdminPanel_Pages'];  endif; ?>
				  <?php if ($this->_vars['pagename'] == "admin_links"):  echo $this->_confs['PLIGG_Visual_AdminPanel_News'];  endif; ?>
				  <?php if ($this->_vars['pagename'] == "admin_editor"):  echo $this->_confs['PLIGG_Visual_AdminPanel_Template_Nav'];  endif; ?>
				  <?php if ($this->_vars['pagename'] == "admin_users"):  echo $this->_confs['PLIGG_Visual_AdminPanel_Users'];  endif; ?>
				  <?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_breadcrumbs"), $this);?>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div id="body-contents">
		<?php if ($this->_vars['pagename'] == "admin_links" || $this->_vars['pagename'] == "admin_users" || $this->_vars['pagename'] == "admin_comments" || $this->_vars['pagename'] == "admin_categories" || $this->_vars['pagename'] == "admin_categories_tasks" || $this->_vars['pagename'] == "admin_page" || $this->_vars['pagename'] == "edit_page" || $this->_vars['pagename'] == "submit_page"): ?>
		<div class="tab-nav-spacing"><div class="tab-nav">
		  <ul>
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_navtabs_start"), $this);?>
			<li <?php if ($this->_vars['pagename'] == "admin_links"): ?>class="cur"<?php endif; ?>><span><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_links.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_News']; ?>
</a></span></li>
			<li <?php if ($this->_vars['pagename'] == "admin_users"): ?>class="cur"<?php endif; ?>><span><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_users.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Users']; ?>
</a></span></li>
			<li <?php if ($this->_vars['pagename'] == "admin_comments"): ?>class="cur"<?php endif; ?>><span><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_comments.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Comments']; ?>
</a></span></li>
			<li <?php if ($this->_vars['pagename'] == "admin_categories" || $this->_vars['pagename'] == "admin_categories_tasks"): ?>class="cur"<?php endif; ?>><span><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_categories.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Categories']; ?>
</a></span></li>
			<li <?php if ($this->_vars['pagename'] == "admin_page" || $this->_vars['pagename'] == "edit_page" || $this->_vars['pagename'] == "submit_page"): ?>class="cur"<?php endif; ?>><span><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/admin/admin_page.php"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Pages']; ?>
</a></span></li>
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_navtabs_end"), $this);?>
		  </ul>
		</div></div>
		<?php endif; ?>
		<?php if ($this->_vars['pagename'] != "module" && $this->_vars['pagename'] != "admin_modules" && $this->_vars['pagename'] != "submit_page" && $this->_vars['pagename'] != "edit_page" && $this->_vars['pagename'] != "admin_categories"): ?>
	    <div class="sidebar" id="sideitems">
		  
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_sidebar_start"), $this);?>
			
		    <h3>Pligg News</h3>
			<div id="side-stories" class="side-box">
				<?php 
				
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
				
				 ?>
			</div>	
			
			<h3>New Products</h3>
			<div id="side-stories" class="side-box">
				<?php 
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
				
				 ?>
			</div>	
			
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_sidebar_end"), $this);?>	
			
	    </div> <!-- End Sidebar and Sideitems -->
		<?php endif; ?>
		
		<div class="bluerndcontent">
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_legend_before"), $this);?>
			<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_center'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
			
				<?php if ($this->_vars['pagename'] == "admin_users" || $this->_vars['pagename'] == "admin_comments" || $this->_vars['pagename'] == "admin_links" || $this->_vars['pagename'] == "admin_user_validate"): ?>	
					<fieldset>
					<br />
					<?php  
					Global $db, $main_smarty, $rows, $offset, $URLMethod;
					$oldURLMethod=$URLMethod;
					$URLMethod=1;
					$pagesize=get_misc_data('pagesize');
					do_pages($rows, $pagesize ? $pagesize : 30, $the_page); 
					$URLMethod=$oldURLMethod;
					 ?>
					</fieldset>
				<?php endif; ?> 
			
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_legend_after"), $this);?>
		</div>
		
		<?php if ($this->_vars['pagename'] != "admin_modules"): ?>
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
			<h3><a href="http://forums.pligg.com/" target="_blank"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Help']; ?>
!</a></h3>
			<br /><div class="design"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Help_1']; ?>
 <a href="http://www.pligg.com">Pligg.com</a> <?php echo $this->_confs['PLIGG_Visual_AdminPanel_Help_2']; ?>
 <a href="http://forums.pligg.com">Pligg Forum.</a></div>
			<br>
			</div>
		</div>
		<?php endif; ?>

	</div>
</div>

<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_admin_body_end"), $this);?>
</body>
</html>
