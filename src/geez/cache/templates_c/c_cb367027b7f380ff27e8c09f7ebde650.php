<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-10 20:09:17 CDT */ ?>

    

	        	



<?php if ($this->_vars['pagename'] == "topusers" || $this->_vars['pagename'] == "tagcloud" || $this->_vars['pagename'] == "live"): ?>
 <div class="contact1">
		<?php echo '
<script type="text/javascript"><!--
google_ad_client = "pub-5074133216375147";
/* 160x600, created 4/27/09 */
google_ad_slot = "5481091797";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

'; ?>


</div>
 <div id="space">	            	</div>
<?php endif; ?>

<?php if ($this->_vars['pagename'] != "submit"): ?>
	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_sidebar2_start"), $this);?>
		<?php if ($this->_vars['pagename'] == "user"): ?>
			<div class="headline">
				<div class="sectiontitle"><a href="<?php echo $this->_vars['user_url_personal_data']; ?>
">Profile Links</a></div>
			</div>

			<div id="navcontainer">
				<ul id="navlist">
					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_profile_sort_start"), $this);?>
					<li><a href="<?php echo $this->_vars['user_url_personal_data']; ?>
" class="navbut<?php echo $this->_vars['nav_pd']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_User_PersonalData']; ?>
</span></a></li>
					<?php if ($this->_vars['user_login'] == $this->_vars['user_logged_in']): ?>
					<li><a href="<?php echo $this->_vars['user_url_setting']; ?>
" class="navbut<?php echo $this->_vars['nav_set']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_User_Setting']; ?>
</span></a></li>
					<?php endif; ?>
					<li><a href="<?php echo $this->_vars['user_url_news_sent']; ?>
" class="navbut<?php echo $this->_vars['nav_ns']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_User_NewsSent']; ?>
</span></a></li>
					<li><a href="<?php echo $this->_vars['user_url_news_published']; ?>
" class="navbut<?php echo $this->_vars['nav_np']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_User_NewsPublished']; ?>
</span></a></li>
					<li><a href="<?php echo $this->_vars['user_url_news_unpublished']; ?>
" class="navbut<?php echo $this->_vars['nav_nu']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_User_NewsUnPublished']; ?>
</span></a></li>
					<li><a href="<?php echo $this->_vars['user_url_commented']; ?>
" class="navbut<?php echo $this->_vars['nav_c']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_User_NewsCommented']; ?>
</span></a></li>
					<li><a href="<?php echo $this->_vars['user_url_news_voted']; ?>
" class="navbut<?php echo $this->_vars['nav_nv']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_User_NewsVoted']; ?>
</span></a></li>
					<li><a href="<?php echo $this->_vars['user_url_saved']; ?>
" class="navbut<?php echo $this->_vars['nav_s']; ?>
"><span><?php echo $this->_confs['PLIGG_Visual_User_NewsSaved']; ?>
</span></a></li>
					<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_profile_sort_end"), $this);?>
				</ul>
			</div>
		<?php endif; ?>
                 <?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_sidebar_middle"), $this);?>
                 

	<!-- START ABOUT -->

	
	
	
 		<?php $this->assign('sidebar_module', "about_box");  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template_sidebar_modules']."/wrapper.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
 		
 		
 		   
  
   
	<!-- END ABOUT -->
	



   <!-- START LINKS -->
   

 <div id="space">	            	</div>
   
   
     <div class="roundedcornr_box_699543">
   <div class="roundedcornr_top_699543"><div></div></div>
      <div class="roundedcornr_content_699543">

	
       
	
	
	        	<div class="links">
	            	<div class="sectiontitle1"><a href='<?php echo $this->_vars['URL_topusers']; ?>
'> <?php echo $this->_confs['PLIGG_Visual_Top_Users']; ?>
</a></div>
	            </div>
	            <div class="links">
	            	<div class="sectiontitle1"><?php if ($this->_vars['Enable_Tags'] == 'true'): ?><a href="<?php echo $this->_vars['URL_tagcloud']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Tags']; ?>
</a><?php endif; ?></div>
	            </div>
	            <div class="links">
	            	<div class="sectiontitle1"><?php if ($this->_vars['Enable_Live'] == 'false'): ?> <a href='<?php echo $this->_vars['URL_live']; ?>
'> <?php echo $this->_confs['PLIGG_Visual_Live']; ?>
</a><?php endif; ?></div>
	            </div>


  
	<!-- END LINKS -->

	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_sidebar2_end"), $this);?>
   </div>
   <div class="roundedcornr_bottom_699543"><div></div></div>
</div>      
      

	
<?php endif; ?>

  <div id="space">	            	</div>
	        	


 <div class="contact1">
<?php if ($this->_vars['pagename'] == "story"): ?>
	

<?php endif; ?>

</div>
    
		
 


	
 	        
		
		