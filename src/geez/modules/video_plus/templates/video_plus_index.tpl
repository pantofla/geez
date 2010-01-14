{if $url_short eq "http://youtube.com" || $url_short eq "http://www.youtube.com" || $url_short eq "http://uk.youtube.com" || $url_short eq "http://br.youtube.com" || $url_short eq "http://fr.youtube.com" || $url_short eq "http://ie.youtube.com" || $url_short eq "http://it.youtube.com" || $url_short eq "http://jp.youtube.com" || $url_short eq "http://nl.youtube.com" || $url_short eq "http://pl.youtube.com" || $url_short eq "http://es.youtube.com" || $url_short eq "http://www.collegehumor.com" || $url_short eq "http://www.guba.com" || $url_short eq "http://video.google.com" || $url_short eq "http://video.google.co.uk" || $url_short eq "http://video.google.nl" || $url_short eq "http://www.livevideo.com" || $url_short eq "http://www.metacafe.com" || $url_short eq "http://www.veoh.com" || $url_short eq "http://vimeo.com" || $url_short eq "http://www.vimeo.com" || $url_short eq "http://vids.myspace.com" || $url_short eq "http://revver.com" || $url_short eq "http://spike.com" || $url_short eq "http://www.spike.com" || $url_short eq "http://www.liveleak.com" || $url_short eq "http://vbox7.com" || $url_short eq "http://www.vbox7.com" }

	{if $pagename neq "story"}
		<div style="margin:0px;float:right;position:relative;width:125px;height:95px;overflow:hidden;margin:0 10px 10px 0;" >
			<a href="#{$link_id}" class="group" >
				<img src="{$video_thumbnail}" width="120px" height="90px" border="0" alt="Watch '{$title_short}'" style="position:relative;top:5px;left:5px;z-index:1;" />
				<img src="{$my_base_url}{$my_pligg_base}/modules/video_plus/images/play_button.gif" border="0" alt="Play" style="float:left;position:relative;top:-62px;left:47px;z-index:3;">
			</a>
		
			{* The following are examples of alternative thumbnail sizes that Youtube offers.
			   You can use these thumbnails in this file or the link_summary.tpl file.
				<img src="{$video_thumbnail_large}" />
				<img src="{$video_thumbnail_2}" />
				<img src="{$video_thumbnail_3}" />
			*}
			
			<div id="{$link_id}" style='display:none;background:#000;'>
				<div align="center">
					<iframe src="{$my_base_url}{$my_pligg_base}/modules/video_plus/video_plus.php?id={$link_id}" frameborder='0' scrolling="no" width="720" height="420" ></iframe>
				</div>
			</div>
			
		</div>
	{/if}

	{if $pagename eq "story"}
		<div style="margin:0px;float:left;position:relative;width:325px;height:245px;overflow:hidden;margin:0 10px 10px 0;" id='basicModal'>
			<a class="group basic" href="#video_pop">
				<img src="{$video_thumbnail_large}" width="320px" height="240px" border="0" alt="Watch '{$title_short}'" style="position:relative;top:5px;left:5px;z-index:1;" />
				<img src="{$my_base_url}{$my_pligg_base}/modules/video_plus/images/play_button_large.gif" border="0" alt="Play" style="float:left;position:relative;top:-150px;left:125px;z-index:3;">
			</a>
		</div>
		
		<div id="video_pop" style='display:none;background:#000;'>
			<div align="center">
				<iframe src="{$my_base_url}{$my_pligg_base}/modules/video_plus/video_plus.php?id={$link_id}" frameborder='0' scrolling="no" width="720" height="420" ></iframe>
			</div>
		</div>
		
	{/if}

{/if}