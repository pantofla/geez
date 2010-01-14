<?php

// the path to the module. the probably shouldn't be changed unless you rename the embed_videos folder(s)
define('anonymous_story_path', my_pligg_base . '/modules/anonymous_story/');
// the path to the module. the probably shouldn't be changed unless you rename the embed_videos folder(s)
define('anonymous_story_lang_conf', '/modules/anonymous_story/lang.conf');
// the path to the modules templates. the probably shouldn't be changed unless you rename the embed_videos folder(s)
define('anonymous_story_tpl_path', '../modules/anonymous_story/templates/');


define('URL_anonymous_story', my_pligg_base.'/module.php?module=anonymous_story');

// don't touch anything past this line.

if(is_object($main_smarty)){
	$main_smarty->assign('anonymous_story_path', anonymous_story_path);
	$main_smarty->assign('anonymous_story_lang_conf', anonymous_story_lang_conf);
	$main_smarty->assign('anonymous_story_tpl_path', anonymous_story_tpl_path);
	$main_smarty->assign('URL_anonymous_story', URL_anonymous_story);
}

?>