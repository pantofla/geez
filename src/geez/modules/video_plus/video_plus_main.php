<?php
function video_plus_track($vars)
{
    global $db, $smarty, $dblang, $the_template, $linkres, $current_user;
	$siteurl = my_base_url . my_pligg_base;
	
    $link_id = $vars['smarty']->_vars['link_id'];
    $row = $db->get_row($sql = "SELECT * FROM " . table_links . " where link_id='$link_id'",ARRAY_A);
    if ($row)
	if (preg_match('/\/watch\?v=([^&]+)/',$row['link_url'],$m))
	{
	    $vars['smarty']->_vars["video_thumbnail"] = "http://img.youtube.com/vi/{$m[1]}/1.jpg";
            $vars['smarty']->_vars["video_thumbnail_2"] = "http://img.youtube.com/vi/{$m[1]}/2.jpg";
            $vars['smarty']->_vars["video_thumbnail_3"] = "http://img.youtube.com/vi/{$m[1]}/3.jpg";
            $vars['smarty']->_vars["video_thumbnail_large"] = "http://img.youtube.com/vi/{$m[1]}/0.jpg";	
	} else {
    	    $vars['smarty']->_vars["video_thumbnail"] = "$siteurl/modules/video_plus/images/noimage.jpg";
    	    $vars['smarty']->_vars["video_thumbnail_2"] = "$siteurl/modules/video_plus/images/noimage.jpg";
    	    $vars['smarty']->_vars["video_thumbnail_3"] = "$siteurl/modules/video_plus/images/noimage.jpg";
    	    $vars['smarty']->_vars["video_thumbnail_large"] = "$siteurl/modules/video_plus/images/noimage_large.jpg";
	}
}

?>