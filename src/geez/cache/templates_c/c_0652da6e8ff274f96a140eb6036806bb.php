<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:27 CDT */ ?>

<br clear="all" />

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



<div id="logo"><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
"><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/logomini.png" border="0"; ><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
"></a></a>                       	             	


	
</div>	












<div class="footer">
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_footer_start"), $this);?>
	
</div>

<!-- START FOOTER -->
		<div id="footer">
        	
        	<div class="bottomleft">
      	<span class="capital"><?php echo $this->_confs['PLIGG_Visual_categor']; ?>
</span> <br />
	<span class="class1"><a href="/category/I%95I%80I%B9I%BAI%B1I%B9I%81I%8CI%84I%B7I%84I%B1"><?php echo $this->_confs['PLIGG_Visual_epikairothta']; ?>
</a></span> <br />
	<span class="class1"><a href="/category/I%9FI%B9I%BAI%BFI%BDI%BFI%BCI%AFI%B1"><?php echo $this->_confs['PLIGG_Visual_oikonomia']; ?>
</a></span> <br />
	<span class="class1"><a href="/category/I%A4I%B5I%87I%BDI%BFI%BBI%BFI%B3I%AFI%B1"><?php echo $this->_confs['PLIGG_Visual_texnologia']; ?>
</a></span> <br />
	<span class="class1"><a href="/category/I%A0I%BFI%BBI%B9I%84I%B9I%BAI%AE"><?php echo $this->_confs['PLIGG_Visual_politikh']; ?>
</a></span> <br />
	<span class="class1"><a href="/category/I%95I%80I%B9I%83I%84I%AEI%BCI%B5I%82"><?php echo $this->_confs['PLIGG_Visual_episthmes']; ?>
</a></span> <br />
	<span class="class1"><a href="/category/I%91I%B8I%BBI%B7I%84I%B9I%BAI%AC"><?php echo $this->_confs['PLIGG_Visual_athlitika']; ?>
</a></span> <br />
	<span class="class1"><a href="/category/Lifestyle">Lifestyle</a></span> <br />
	<span class="class1"><a href="/category/Shopping">Shopping</a></span> <br />
	<span class="class1"><a href="/category/I%A8I%85I%87I%B1I%B3I%89I%B3I%AFI%B1"><?php echo $this->_confs['PLIGG_Visual_psixagogia']; ?>
</a></span> <br />
	<span class="class1"><a href="/category/I%91I%83I%84I%B5I%AFI%B1"><?php echo $this->_confs['PLIGG_Visual_asteia']; ?>
</a></span> <br />


        </div>
      	
        	<div class="bottomleft">
      	      	<span class="capital"> WebSite Links </span> <br />
      	  <span class="class1">    <a href="http://www.geez.gr/">geez</a><br />
      	     	<a href="http://geez.gr/advancedsearch.php"><?php echo $this->_confs['PLIGG_Visual_Search_Advanced']; ?>
</a><br />
              	 <a href="http://geez.gr/submit">Submit Story</a><br />
              	  <a href="http://geez.gr/register">Register</a><br />
              	 <a href="http://geez.gr/login">Login</a><br />
              	<a href="http://geez.gr/rssfeeds.php">RSS Feeds</a><br />
       		 <a href="http://geez.gr/faq.php">FAQ</a>  <br />
       		 <a href="http://www.geez.gr/terms.php"><?php echo $this->_confs['PLIGG_Visual_termsandconditions']; ?>
</a><br />
  		<a href="http://www.geez.gr/module.php?module=ajaxcontact">Support/Problem?</a></span><br />
        </div>
 
        	<div class="bottomleft">
           	      	<span class="capital"> geez</span> <br />
    <span class="class1"> <a href="http://geez.gr/about_us.php"><?php echo $this->_confs['PLIGG_Visual_aboutusfooter']; ?>
</a><br />
           <a href="http://geez.gr/tour.php">Take the geez Tour</a><br />
           <a href="http://www.geez.gr/module.php?module=ajaxcontact"><?php echo $this->_confs['PLIGG_Visual_contactusfooter']; ?>
</a><br />
                  <a href="http://www.geez.gr/button.php">geez Button <img src="http://www.geez.gr/templates/images/geezadd1.png" border="0" ></span></a><br />
<br />
                	      	<span class="capital">Follow geez</span> <br />
                         <span class="class1"><a href="http://twitter.com/geezgr" target="_blank">geez twitter<img src="http://www.geez.gr/templates/wistie/images/twitter1.png" border="0" ></a></span><br />
                           <span class="class1"><a href="http://www.facebook.com/pages/geez/74572593268?ref=s" target="_blank">geez facebook<img src="http://www.geez.gr/templates/wistie/images/facebook.png" border="0" ></a></span><br />
                           <span class="class1"><a href="http://friendfeed.com/geezza" target="_blank">geez friendfeed<img src="http://www.geez.gr/templates/wistie/images/friendfeed.gif" border="0" ></a></span><br />

        </div>

        	<div class="bottomleft">
              	      	<span class="capital"> Sites/Blogs </span> <br />
			<span class="class1"><a href="http://www.trendsinlife.blogspot.com/" target="_blank">Trends In Life</a></span><br />
			<span class="class1"><a href="http://www.webz.gr/" target="_blank">Webz</a></span><br />
			<span class="class1"><a href="http://www.antinews.gr/" target="_blank">Antinews</a></span><br />
			<span class="class1"><a href="http://www.troktiko.blogspot.com/" target="_blank">Troktiko</a></span><br />
			<span class="class1"><a href="http://www.prezatv.blogspot.com/" target="_blank">PrezaTV</a></span><br />
			<span class="class1"><a href="http://www.mediablog.gr/" target="_blank">Mediablog</a></span><br />
			<span class="class1"><a href="http://www.paideia-gr.blogspot.com/" target="_blank">Paideia-gr</a></span><br />
			<span class="class1"><a href="http://www.ourgreektv.blogspot.com/" target="_blank">OurgreekTV</a></span><br />
			<span class="class1"><a href="http://www.salonica-press.blogspot.com/" target="_blank">Salonica-Press</a></span><br />
			<span class="class1"><a href="http://www.hakis-hakis.blogspot.com/" target="_blank">Hakis</a></span><br />
			<span class="class1"><a href="http://www.diaporon-bl.blogspot.com/" target="_blank">Diaporon</a></span><br />
			<span class="class1"><a href="http://www.xblog.gr/" target="_blank">Xblog</a></span><br />
			<span class="class1"><a href="http://www.johnpatra.blogspot.com" target="_blank">JohnPatra</a></span><br />
			<span class="class1"><a href="http://hackaday-thema.blogspot.com" target="_blank">Hackaday</a></span><br />

			
        </div>

 <div class="bottomleft">
              	      	<span class="capital"> More Sites/Blogs </span> <br />
			<span class="class1"><a href="http://www.citypress-gr.blogspot.com/" target="_blank">Citypress-gr</a></span><br />
			<span class="class1"><a href="http://www.roadartist.blogspot.com/" target="_blank">Roadartist</a></span><br />
			<span class="class1"><a href="http://www.greekrider.blogspot.com/" target="_blank">Greekrider</a></span><br />
			<span class="class1"><a href="http://www.makelio.blogspot.com/" target="_blank">Makelio</a></span><br />
			<span class="class1"><a href="http://www.naftilos.blogspot.com/" target="_blank">Naftilos</a></span><br />
			<span class="class1"><a href="http://www.blog-tou-fititi.blogspot.com/" target="_blank">Blogfititi</a></span><br />
			<span class="class1"><a href="http://www.stoxasmos-politikh.blogspot.com/" target="_blank">Stoxasmos-Politikh</a></span><br />
			<span class="class1"><a href="http://www.tolimeri.blogspot.com/" target="_blank">Tolimeri</a></span><br />
			<span class="class1"><a href="http://www.metablogging.gr/" target="_blank">Metablogging</a></span><br />
			<span class="class1"><a href="http://www.techblog.gr/" target="_blank">Techblog</a></span><br />
			<span class="class1"><a href="http://apneagr.blogspot.com/" target="_blank">Apneagr</a></span><br />
			<span class="class1"><a href="http://www.peripteraki.gr" target="_blank">Peripteraki</a></span><br />

        </div>
 <?php echo '
<script type="text/javascript" src="http://www.geez.gr/clickheat/js/clickheat.js"></script><noscript><p><a href="http://www.labsmedia.com/clickheat/index.html">Open source heat map</a></p></noscript><script type="text/javascript"><!--
clickHeatSite = \'geez\';clickHeatGroup = \'geez\';clickHeatServer = \'http://www.geez.gr/clickheat/click.php\';initClickHeat(); //-->
</script>
'; ?>

   	 <?php echo '<script src="http://static.crowdscience.com/start.js?id=3f5dd285d4"></script> '; ?>

 <div class="power">Copyright 2009  <span class="class1"><a href="http://www.geez.gr/">geez</a> </span><br />
 			<br /><span class="orange">Powered by You :-) </span> <br />
 						
 			</div> 
      
      <?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_footer_end"), $this);?>

<!-- END FOOTER --> 
    </div>


      
    