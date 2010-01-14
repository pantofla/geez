<?php
// Supported Sites
//////////////////
// collegehumor.com
// guba.com
// liveleak.com
// livevideo.com
// metacafe.com
// putfile.com
// revver.com
// spike.com
// vbox7.com
// vids.myspace.com
// video.google.com
// vimeo.com
// veoh.com
// youtube.com


include('../../config.php');

$id = mysql_real_escape_string(strip_tags($_GET['id']));
$play_query = mysql_query("SELECT link_votes,link_tags,link_url FROM " . table_links . " WHERE link_id=\"$id\" LIMIT 1");
$play_array = mysql_fetch_array($play_query);
$play = $play_array['link_url'];
$tags = $play_array['link_tags'];


function embed_video($url){

	// code to display putfile.com
	if (preg_match("/http:\/\/media.putfile.com\/([0-9a-zA-Z-_-]*)(.*)/i", $url, $matches)) {
		return  '<object type="application/x-shockwave-flash" data="http://feat.putfile.com/flow/putfile.swf?videoFile='.$matches[1].'" height="349" width="420" align="middle">'.
				'<param name="movie" value="http://feat.putfile.com/flow/putfile.swf?videoFile='.$matches[1].'" />'.
				'<param name="quality" value="high" />'.
				'<param name="allowFullScreen" value="false" />'.
				'<param name="allowScriptAccess" value="always" />'.
				'<embed src="http://feat.putfile.com/flow/putfile.swf?videoFile='.$matches[1].'" allowFullScreen="true" allowScriptAccess="always" height="349" width="420"></embed>'.
				'</object>';
	}

    // code to display Google Video .com
    if (preg_match("/http:\/\/video.google.com\/videoplay\?docid=([0-9\-]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="426">'.
			   '<embed src="http://video.google.com/googleplayer.swf?docId='.$matches[1].'" type="application/x-shockwave-flash" width="700" height="400" />'.
			   '</object>';
    }
 // code to display Google Video .nl
    if (preg_match("/http:\/\/video.google.nl\/videoplay\?docid=([0-9\-]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="426">'.
			   '<embed src="http://video.google.com/googleplayer.swf?docId='.$matches[1].'" type="application/x-shockwave-flash" width="700" height="400" />'.
			   '</object>';
    }

    // code to display Google Video co.uk
    if (preg_match("/http:\/\/video.google.co.uk\/videoplay\?docid=([0-9\-]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="426">'.
			   '<embed src="http://video.google.co.uk/googleplayer.swf?docId='.$matches[1].'" type="application/x-shockwave-flash" width="400" height="400" />'.
			   '</object>';
    }

    // code to display YouTube WWW
    if (preg_match("/http:\/\/www.youtube.com\/watch\?v=([0-9a-zA-Z-_]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
               '<param name="movie" value="http://www.youtube.com/v/'.$matches[1].'" />'.
               '<param name="wmode" value="transparent" />'.
               '<embed src="http://www.youtube.com/v/'.$matches[1].'&autoplay=0" type="application/x-shockwave-flash" wmode="transparent" width="700" height="400" />'.
               '</object>';
    }

    // code to display YouTube NO WWW
    if (preg_match("/http:\/\/youtube.com\/watch\?v=([0-9a-zA-Z-_]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
               '<param name="movie" value="http://www.youtube.com/v/'.$matches[1].'" />'.
               '<param name="wmode" value="transparent" />'.
               '<embed src="http://www.youtube.com/v/'.$matches[1].'&autoplay=0" type="application/x-shockwave-flash" wmode="transparent" width="700" height="400" />'.
               '</object>';
    }

 // code to display YouTube United Kingdom
    if (preg_match("/http:\/\/uk.youtube.com\/watch\?v=([0-9a-zA-Z-_]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
               '<param name="movie" value="http://uk.youtube.com/v/'.$matches[1].'" />'.
               '<param name="wmode" value="transparent" />'.
               '<embed src="http://www.youtube.com/v/'.$matches[1].'&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="700" height="400" />'.
               '</object>';
    }

    // code to display YouTube Brazil
    if (preg_match("/http:\/\/br.youtube.com\/watch\?v=([0-9a-zA-Z-_]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
               '<param name="movie" value="http://br.youtube.com/v/'.$matches[1].'" />'.
               '<param name="wmode" value="transparnt" />'.
               '<embed src="http://www.youtube.com/v/'.$matches[1].'&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="700" height="400" />'.
               '</object>';
    }

    // code to display YouTube France
    if (preg_match("/http:\/\/fr.youtube.com\/watch\?v=([0-9a-zA-Z-_]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
               '<param name="movie" value="http://fr.youtube.com/v/'.$matches[1].'" />'.
               '<param name="wmode" value="transparnt" />'.
               '<embed src="http://www.youtube.com/v/'.$matches[1].'&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="700" height="400" />'.
               '</object>';
    }

    // code to display YouTube Ireland
    if (preg_match("/http:\/\/ie.youtube.com\/watch\?v=([0-9a-zA-Z-_]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
               '<param name="movie" value="http://ie.youtube.com/v/'.$matches[1].'" />'.
               '<param name="wmode" value="transparnt" />'.
               '<embed src="http://www.youtube.com/v/'.$matches[1].'&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="700" height="400" />'.
               '</object>';
    }

    // code to display YouTube Italy
    if (preg_match("/http:\/\/it.youtube.com\/watch\?v=([0-9a-zA-Z-_]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
               '<param name="movie" value="http://it.youtube.com/v/'.$matches[1].'" />'.
               '<param name="wmode" value="transparnt" />'.
               '<embed src="http://www.youtube.com/v/'.$matches[1].'&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="700" height="400" />'.
               '</object>';
    }

    // code to display YouTube Japan
    if (preg_match("/http:\/\/jp.youtube.com\/watch\?v=([0-9a-zA-Z-_]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
               '<param name="movie" value="http://jp.youtube.com/v/'.$matches[1].'" />'.
               '<param name="wmode" value="transparnt" />'.
               '<embed src="http://www.youtube.com/v/'.$matches[1].'&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="700" height="400" />'.
               '</object>';
    }

    // code to display YouTube Netherland
    if (preg_match("/http:\/\/nl.youtube.com\/watch\?v=([0-9a-zA-Z-_]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
               '<param name="movie" value="http://nl.youtube.com/v/'.$matches[1].'" />'.
               '<param name="wmode" value="transparnt" />'.
               '<embed src="http://www.youtube.com/v/'.$matches[1].'&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="700" height="400" />'.
               '</object>';
    }

    // code to display YouTube Poland
    if (preg_match("/http:\/\/pl.youtube.com\/watch\?v=([0-9a-zA-Z-_]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
               '<param name="movie" value="http://pl.youtube.com/v/'.$matches[1].'" />'.
               '<param name="wmode" value="transparnt" />'.
               '<embed src="http://www.youtube.com/v/'.$matches[1].'&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="700" height="400" />'.
               '</object>';
    }

    // code to display YouTube Spain
    if (preg_match("/http:\/\/es.youtube.com\/watch\?v=([0-9a-zA-Z-_]*)(.*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
               '<param name="movie" value="http://es.youtube.com/v/'.$matches[1].'" />'.
               '<param name="wmode" value="transparnt" />'.
               '<embed src="http://www.youtube.com/v/'.$matches[1].'&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="700" height="400" />'.
               '</object>';
    }
	
	// code to display vbox7
	if (preg_match("/http:\/\/vbox7.com\/play:([0-9a-zA-Z-_]*)/i", $url, $matches)) {
		return  '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="473" height="405" />'.
				'<param name="movie" value="http://i47.vbox7.com/player/ext.swf?vid='.$matches[1].'" />'.
				'<param name="quality" value="high" />'.
				'<embed src="http://i47.vbox7.com/player/ext.swf?vid='.$matches[1].'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="473" height="405" />'.
				'</embed>'.
				'</object>';
	}

    // code to display Revver
    if (preg_match("/http:\/\/revver.com\/video\/([0-9a-zA-Z\-\_]*)\/([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<script src="http://flash.revver.com/player/1.0/player.js?mediaId:'.$matches[1].';width:700;height:405;" type="text/javascript"></script>';
    }

    // code to display My Space
    if (preg_match("/http:\/\/vids.myspace.com\/index.cfm\?fuseaction=vids.individual&VideoID=([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<object width="700" height="415">'.
					'<param name="movie" value="http://vids.myspace.com/index.cfm?fuseaction=vids.individual&VideoID='.$matches[1].'" />'.
					'<param name="allowfullscreen" value="true" />'.
					'<embed src="http://lads.myspace.com/videos/vplayer.swf" flashvars="m='.$matches[1].'&type=video" type="application/x-shockwave-flash" width="700" height="400" />'.
				'</object>';
    }

    // code to display Vimeo NO WWW!!!
    if (preg_match("/http:\/\/vimeo.com\/([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<object width="700" height="415">'.
					'<param name="movie" value="http://vimeo.com/'.$matches[1].'" />'.
					'<param name="allowfullscreen" value="true" />'.
					'<embed src="http://www.vimeo.com/moogaloop.swf?clip_id='.$matches[1].'" quality="best" scale="exactfit" width="700" height="400" type="application/x-shockwave-flash" />'.
				'</object>';
    }

    // code to display Vimeo WWW
    if (preg_match("/http:\/\/www.vimeo.com\/([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<object width="700" height="415">'.
					'<param name="movie" value="http://vimeo.com/'.$matches[1].'" />'.
					'<param name="allowfullscreen" value="true" />'.
					'<embed src="http://www.vimeo.com/moogaloop.swf?clip_id='.$matches[1].'" quality="best" scale="exactfit" width="700" height="400" type="application/x-shockwave-flash" />'.
				'</object>';
    }

	// code to display Veoh
    if (preg_match("/http:\/\/www.veoh.com\/browse\/videos\/#watch%3Dv([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<object width="700" height="400" id="veohFlashPlayer" name="veohFlashPlayer"><param name="movie" value="http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.4.2.2.1003&permalinkId=v'.$matches[1].'&player=videodetailsembedded&videoAutoPlay=0&id=anonymous"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.4.2.2.1003&permalinkId=v'.$matches[1].'&player=videodetailsembedded&videoAutoPlay=0&id=anonymous" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="700" height="400" id="veohFlashPlayerEmbed" name="veohFlashPlayerEmbed"></embed></object>';
    }

	// code to display Veoh
    if (preg_match("/http:\/\/www.veoh.com\/search\/videos\/q\/([0-9a-zA-Z\-\_]*)#watch%3Dv([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<object width="700" height="400" id="veohFlashPlayer" name="veohFlashPlayer"><param name="movie" value="http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.4.2.2.1003&permalinkId=v'.$matches[2].'&player=videodetailsembedded&videoAutoPlay=0&id=anonymous"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.4.2.2.1003&permalinkId=v'.$matches[2].'&player=videodetailsembedded&videoAutoPlay=0&id=anonymous" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="700" height="400" id="veohFlashPlayerEmbed" name="veohFlashPlayerEmbed"></embed></object>';
    }

    // code to display MetaCafe
    if (preg_match("/http:\/\/www.metacafe.com\/watch\/([0-9a-zA-Z\-\_]*)\/([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<object width="700" height="410">'.
					'<param name="movie" value="http://www.metacafe.com/watch/'.$matches[1].'/'.$matches[2].'" />'.
					'<param name="allowfullscreen" value="true" />'.
					'<embed src="http://www.metacafe.com/fplayer/'.$matches[1].'/'.$matches[2].'.swf" width="700" height="410" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" />'.
				'</object>';
    }

    // code to display Spike
    if (preg_match("/http:\/\/www.spike.com\/video\/([0-9a-zA-Z\-\_]*)\/([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<embed width="550" height="410" src="http://www.spike.com/efp" quality="high" bgcolor="000000" name="efp" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="flvbaseclip='.$matches[2].'" allowfullscreen="true"></embed>';
    }
	
    // code to display Guba
    if (preg_match("/http:\/\/www.guba.com\/watch\/([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
					'<param name="movie" value="http://www.guba.com/watch/'.$matches[1].'" />'.
					'<param name="allowfullscreen" value="true" />'.
					'<embed src="http://www.guba.com/a/704270/a/f/root.swf?aid=704270&video_url=http://free.guba.com/uploaditem/'.$matches[1].'/flash.flv&isEmbeddedPlayer=true" quality="high" bgcolor="#FFFFFF" menu="false" width="700px" height="400px" name="root" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />'.
				'</object>';
    }

    // code to display Live Video
    if (preg_match("/http:\/\/www.livevideo.com\/video\/([0-9a-zA-Z\-\_]*)\/([0-9a-zA-Z\-\_]*)\/([0-9a-zA-Z\-\_]*).aspx/i", $url, $matches)) {
        return '<object width="700" height="420">'.
					'<param name="movie" value="http://www.livevideo.com/flvplayer/embed/'.$matches[2].'" />'.
					'<param name="allowfullscreen" value="true" />'.
					'<embed src="http://www.livevideo.com/flvplayer/embed/'.$matches[2].'" type="application/x-shockwave-flash" quality="high" WIDTH="700" HEIGHT="420" wmode="transparent" />'.
				'</object>';
    }
	
    // code to display Live Video
    if (preg_match("/http:\/\/www.livevideo.com\/video\/([0-9a-zA-Z\-\_]*)\/([0-9a-zA-Z\-\_]*).aspx/i", $url, $matches)) {
        return '<object width="700" height="420">'.
					'<param name="movie" value="http://www.livevideo.com/flvplayer/embed/'.$matches[1].'" />'.
					'<param name="allowfullscreen" value="true" />'.
					'<embed src="http://www.livevideo.com/flvplayer/embed/'.$matches[1].'" type="application/x-shockwave-flash" quality="high" WIDTH="700" HEIGHT="420" wmode="transparent" />'.
				'</object>';
    }

    // code to display LiveLeak NOWWW
    if (preg_match("/http:\/\/liveleak.com\/view\?i=([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
					'<param name="movie" value="http://www.liveleak.com/e/'.$matches[1].'" />'.
					'<param name="allowfullscreen" value="true" />'.
					'<embed src="http://www.liveleak.com/e/'.$matches[1].'" type="application/x-shockwave-flash" width="700" height="400" wmode="transparent" />'.
				'</object>';
    }

    // code to display LiveLeak WWW
    if (preg_match("/http:\/\/www.liveleak.com\/view\?i=([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
					'<param name="movie" value="http://www.liveleak.com/e/'.$matches[1].'" />'.
					'<param name="allowfullscreen" value="true" />'.
					'<embed src="http://www.liveleak.com/e/'.$matches[1].'" type="application/x-shockwave-flash" width="700" height="400" wmode="transparent" />'.
				'</object>';
    }

	// BROKEN code to display Blip.tv WWW
    if (preg_match("/http:\/\/www.blip.tv\/file\/([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<embed src="http://blip.tv/play/'.$matches[1].'" type="application/x-shockwave-flash" width="700" height="400" allowscriptaccess="always" allowfullscreen="true"></embed>';
    }

    // BROKEN code to display Blip.tv NOWWW
    if (preg_match("/http:\/\/blip.tv\/file\/([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<embed src="http://blip.tv/play/'.$matches[1].'" type="application/x-shockwave-flash" width="700" height="400" allowscriptaccess="always" allowfullscreen="true"></embed>';
    }
	
	
		
    // BROKEN code to display YouAreTv WWW
    if (preg_match("/http:\/\/www.youare.tv\/watch.php\?id=([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<embed src="http://www.youare.tv/yatvplayer.swf?videoID='.$matches[1].'&serverDomain=" allowScriptAccess="always" loop="false" quality="best" wmode="transparent" width="700" height="400" type="application\x-shockwave-flash" ></embed>';
    }

    // BROKEN code to display YouAreTv NOWWW
    if (preg_match("/http:\/\/youare.tv\/watch.php\?id=([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<embed src="http://www.youare.tv/yatvplayer.swf?videoID='.$matches[1].'&serverDomain=" allowScriptAccess="always" loop="false" quality="best" wmode="transparent" width="700" height="400" type="application\x-shockwave-flash" ></embed>';
    }
	
 


    // code to display CollegeHumor
    if (preg_match("/http:\/\/www.collegehumor.com\/video:([0-9a-zA-Z\-\_]*)/i", $url, $matches)) {
        return '<object width="700" height="400">'.
					'<param name="movie" value="http://www.collegehumor.com/video:'.$matches[1].'" />'.
					'<param name="allowfullscreen" value="true" />'.
					'<embed src="http://www.collegehumor.com/moogaloop/moogaloop.swf?clip_id='.$matches[1].'" quality="best" width="700" height="400" type="application/x-shockwave-flash" />'.
				'</object>';
    }

    return '';
}

?>


<?php if($type == 0) { ?>
<div style="background:#000;text-align:center;">
	<?php echo embed_video($play); ?>
</div>
<?php } ?>