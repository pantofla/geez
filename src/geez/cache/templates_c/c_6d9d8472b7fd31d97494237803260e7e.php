<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:32 CDT */ ?>

<?php if ($this->_vars['url_short'] == "http://youtube.com" || $this->_vars['url_short'] == "http://www.youtube.com" || $this->_vars['url_short'] == "http://uk.youtube.com" || $this->_vars['url_short'] == "http://br.youtube.com" || $this->_vars['url_short'] == "http://fr.youtube.com" || $this->_vars['url_short'] == "http://ie.youtube.com" || $this->_vars['url_short'] == "http://it.youtube.com" || $this->_vars['url_short'] == "http://jp.youtube.com" || $this->_vars['url_short'] == "http://nl.youtube.com" || $this->_vars['url_short'] == "http://pl.youtube.com" || $this->_vars['url_short'] == "http://es.youtube.com" || $this->_vars['url_short'] == "http://www.collegehumor.com" || $this->_vars['url_short'] == "http://www.guba.com" || $this->_vars['url_short'] == "http://video.google.com" || $this->_vars['url_short'] == "http://video.google.co.uk" || $this->_vars['url_short'] == "http://video.google.nl" || $this->_vars['url_short'] == "http://www.livevideo.com" || $this->_vars['url_short'] == "http://www.metacafe.com" || $this->_vars['url_short'] == "http://www.veoh.com" || $this->_vars['url_short'] == "http://vimeo.com" || $this->_vars['url_short'] == "http://www.vimeo.com" || $this->_vars['url_short'] == "http://vids.myspace.com" || $this->_vars['url_short'] == "http://revver.com" || $this->_vars['url_short'] == "http://spike.com" || $this->_vars['url_short'] == "http://www.spike.com" || $this->_vars['url_short'] == "http://www.liveleak.com" || $this->_vars['url_short'] == "http://vbox7.com" || $this->_vars['url_short'] == "http://www.vbox7.com"): ?>

	<?php if ($this->_vars['pagename'] != "story"): ?>
		<div style="margin:0px;float:right;position:relative;width:125px;height:95px;overflow:hidden;margin:0 10px 10px 0;" >
			<a href="#<?php echo $this->_vars['link_id']; ?>
" class="group" >
				<img src="<?php echo $this->_vars['video_thumbnail']; ?>
" width="120px" height="90px" border="0" alt="Watch '<?php echo $this->_vars['title_short']; ?>
'" style="position:relative;top:5px;left:5px;z-index:1;" />
				<img src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/modules/video_plus/images/play_button.gif" border="0" alt="Play" style="float:left;position:relative;top:-62px;left:47px;z-index:3;">
			</a>
		
			
			
			<div id="<?php echo $this->_vars['link_id']; ?>
" style='display:none;background:#000;'>
				<div align="center">
					<iframe src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/modules/video_plus/video_plus.php?id=<?php echo $this->_vars['link_id']; ?>
" frameborder='0' scrolling="no" width="720" height="420" ></iframe>
				</div>
			</div>
			
		</div>
	<?php endif; ?>

	<?php if ($this->_vars['pagename'] == "story"): ?>
		<div style="margin:0px;float:left;position:relative;width:325px;height:245px;overflow:hidden;margin:0 10px 10px 0;" id='basicModal'>
			<a class="group basic" href="#video_pop">
				<img src="<?php echo $this->_vars['video_thumbnail_large']; ?>
" width="320px" height="240px" border="0" alt="Watch '<?php echo $this->_vars['title_short']; ?>
'" style="position:relative;top:5px;left:5px;z-index:1;" />
				<img src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/modules/video_plus/images/play_button_large.gif" border="0" alt="Play" style="float:left;position:relative;top:-150px;left:125px;z-index:3;">
			</a>
		</div>
		
		<div id="video_pop" style='display:none;background:#000;'>
			<div align="center">
				<iframe src="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/modules/video_plus/video_plus.php?id=<?php echo $this->_vars['link_id']; ?>
" frameborder='0' scrolling="no" width="720" height="420" ></iframe>
			</div>
		</div>
		
	<?php endif; ?>

<?php endif; ?>