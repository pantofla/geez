<?php
// The source code packaged with this file is Free Software, Copyright (C) 2005 by
// Ricardo Galli <gallir at uib dot es>.
// It's licensed under the AFFERO GENERAL PUBLIC LICENSE unless stated otherwise.
// You can get copies of the licenses here:
// 		http://www.affero.org/oagpl.html
// AFFERO GENERAL PUBLIC LICENSE is also included in the file called "COPYING".
// -------------------------------------------------------------------------------------

include_once('Smarty.class.php');
$main_smarty = new Smarty;

include_once('config.php');
include_once(mnminclude.'html1.php');
include_once(mnminclude.'link.php');
include_once(mnminclude.'tags.php');
include_once(mnminclude.'search.php');
include_once(mnminclude.'smartyvariables.php');

// -------------------------------------------------------------------------------------

global $the_template, $main_smarty, $db;

$body = '';

$res = "select comment_content,comment_id,link_id, ".table_links.".link_title_url, ".table_links.".link_category from ".table_comments.",".table_links." WHERE comment_link_id = link_id ORDER BY comment_date DESC limit ".comments_size_sidebar."";
$list_comments = $db->get_results($res);
if($list_comments)
{
	foreach($list_comments as $row){			
		if ($row->link_title_url == ""){
			$story_url = getmyurl("story", $row->link_id);			
		} else {
			$story_url = getmyurl("storyURL", comments_category_safe_name($row->link_category), urlencode($row->link_title_url), $row->link_id);			
		}

		$main_smarty->assign('comment_url', $story_url."#c".$row->comment_id);
		$main_smarty->assign('comment_text', ShortenText(save_text_to_html($row->comment_content)));
		$body .= $main_smarty->fetch($the_template . '/sidebar_comments.tpl');		
	}
}

$main_smarty->assign('live_url', getmyurl("comments"));
$main_smarty->assign('sc_body', $body);
$main_smarty->display($the_template . '/sidebar_comments_wrapper.tpl');
$main_smarty->assign('ss_toggle_id', 'latcomments');

// determine the amount of characters to show for each comment	
function ShortenText($text) {
  $chars = comments_length_sidebar;

  $text = strip_tags($text);
  $text = $text." ";
  $text = substr($text,0,$chars);
  $text = substr($text,0,strrpos($text,' '));
  $text = $text."...";

  return $text;
  }		
	
	function comments_category_safe_name($category) {
		// $the_cats is set in /libs/smartyvariables.php

		global $dblang, $the_cats;

		foreach($the_cats as $cat){
			if($cat->category_id == $category && $cat->category_lang == $dblang)
			{ 
				return $cat->category_safe_name; 
			}
		}
	}

?>
