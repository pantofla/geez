<?php require_once('/home/pantofla/public_html/geez/plugins/function.checkForJs.php'); $this->register_function("checkForJs", "tpl_function_checkForJs");  require_once('/home/pantofla/public_html/geez/plugins/function.checkForCss.php'); $this->register_function("checkForCss", "tpl_function_checkForCss");  require_once('/home/pantofla/public_html/geez/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:27 CDT */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html dir="<?php echo $this->_confs['PLIGG_Visual_Language_Direction']; ?>
" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	
	<head>
			
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_head_start"), $this);?>
		<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include("meta.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	
		<link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/css/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/css/wick.css" />

		<link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/css/dropdown.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/css/dropdown-default.css" media="screen" />
		<!--[if lt IE 7]>
		<script type="text/javascript" src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/js/jquery/jquery.js"></script>
		<script type="text/javascript" src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/js/jquery/jquery.dropdown.js"></script>
		<![endif]-->
	
		<?php if ($this->_vars['Voting_Method'] == 2): ?>
			<link rel="stylesheet" type="text/css" href="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/css/star_rating/star.css" media="screen" />
		<?php endif; ?>
	
		<?php echo tpl_function_checkForCss(array(), $this);?>
		<?php echo tpl_function_checkForJs(array(), $this);?>		
	
		<?php if ($this->_vars['pagename'] != "published" && $this->_vars['pagename'] != "upcoming"): ?>
			<?php if ($this->_vars['Spell_Checker'] == 1): ?>			
				<script src="<?php echo $this->_vars['my_pligg_base']; ?>
/3rdparty/speller/spellChecker.js" type="text/javascript"></script>
			<?php endif; ?>
		<?php endif; ?>	
		






		<?php if ($this->_vars['request_category']): ?>
			<title><?php echo $this->_vars['pretitle']; ?>
 <?php echo $this->_vars['meta_description']; ?>
 <?php if ($this->_vars['pagename'] == "upcoming"): ?>| <?php echo $this->_vars['posttitle']; ?>
 <?php endif; ?>| <?php echo $this->_confs['PLIGG_Visual_Name']; ?>
</title>
		<?php elseif ($this->_vars['pagename'] == "groups"): ?>
			<title><?php echo $this->_confs['PLIGG_Visual_Name']; ?>
 | <?php echo $this->_confs['PLIGG_Visual_Groups']; ?>
</title>
		<?php elseif ($this->_vars['pagename'] == "group_story"): ?>
			<title><?php echo $this->_confs['PLIGG_Visual_Group']; ?>
 | <?php echo $this->_vars['posttitle']; ?>
 | <?php echo $this->_confs['PLIGG_Visual_Name']; ?>
</title>
		<?php elseif ($this->_vars['pagename'] == "submit_groups"): ?>
			<title><?php echo $this->_confs['PLIGG_Visual_Name']; ?>
 | <?php echo $this->_vars['posttitle']; ?>
</title>
		<?php elseif ($this->_vars['pagename'] == "upcoming"): ?>
			<title><?php echo $this->_confs['PLIGG_Visual_Name']; ?>
 | <?php echo $this->_confs['PLIGG_Visual_Pligg_Queued']; ?>
</title>
		<?php elseif ($this->_vars['pagename'] == "published"): ?>
			<title><?php echo $this->_confs['PLIGG_Visual_Name']; ?>
</title>
		<?php elseif ($this->_vars['pagename'] == "index"): ?>
			<title><?php echo $this->_confs['PLIGG_Visual_Name']; ?>
 - <?php echo $this->_confs['PLIGG_Visual_RSS_Description']; ?>
</title>
		<?php elseif ($this->_vars['pagename'] == "story"): ?>
			<title><?php echo $this->_vars['pretitle']; ?>
 <?php echo $this->_vars['posttitle']; ?>
 | <?php echo $this->_confs['PLIGG_Visual_Name']; ?>
</title>
		<?php else: ?>
			<title><?php echo $this->_vars['pretitle']; ?>
 <?php echo $this->_confs['PLIGG_Visual_Name']; ?>
 | <?php echo $this->_vars['posttitle']; ?>
</title>
		<?php endif; ?>
		
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/rss.php"/>
		<link rel="icon" href="<?php echo $this->_vars['my_pligg_base']; ?>
/favicon.ico" type="image/x-icon"/>



			
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_head_end"), $this);?>
	

		
</head>


       
    

<body dir="<?php echo $this->_confs['PLIGG_Visual_Language_Direction']; ?>
" <?php echo $this->_vars['body_args']; ?>
>
	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_body_start"), $this);?>

	<div id="content">
			
		<?php echo '
			<script type="text/javascript" language="JavaScript">
			function checkForm() {
			answer = true;
			if (siw && siw.selectingSomething)
				answer = false;
			return answer;
			}//
			
			
			</script>
		'; ?>

		
		

		
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_banner_top"), $this);?>
		
		<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_header'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
		

		
		
		
		
<!-- START STORY -->
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_content_start"), $this);?>
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_above_center"), $this);?>
			<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_center'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_below_center"), $this);?>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_content_end"), $this);?>
<!-- END STORY -->
	</div>
	
<?php if ($this->_vars['pagename'] != "story" && $this->_vars['pagename'] != "submit" && $this->_vars['pagename'] != "user" && $this->_vars['pagename'] != "profile" && $this->_vars['pagename'] != "login" && $this->_vars['pagename'] != "register"): ?>
<!-- START MIDDLE COLUMN -->
	<div id="midcol">
		<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_second_sidebar'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	</div>
<!-- END MIDDLE COLUMN -->
<?php endif; ?>

<!-- START RIGHT COLUMN -->
	<div id="rightcol">
		<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_right_sidebar'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	</div>
				<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_footer'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_banner_bottom"), $this);?>


	<script src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/xmlhttp.php" type="text/javascript"></script> 
		
	</div>

	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_body_end"), $this);?>
	
<?php echo '	
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-8198648-1");
pageTracker._trackPageview();
} catch(err) {}</script>
'; ?>

	 
</body>

</html>

 