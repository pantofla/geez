<?php

// the path to the module. the probably shouldn't be changed unless you rename the embed_videos folder(s)
define('anonymous_comments_path', my_pligg_base . '/modules/anonymous_comments/');
// the path to the module. the probably shouldn't be changed unless you rename the embed_videos folder(s)
define('anonymous_comments_lang_conf', '/modules/anonymous_comments/lang.conf');
// the path to the modules templates. the probably shouldn't be changed unless you rename the embed_videos folder(s)
define('anonymous_comments_tpl_path', '../modules/anonymous_comments/templates/');


define('URL_anonymous_comments', my_pligg_base.'/module.php?module=anonymous_comments');

// don't touch anything past this line.

if(is_object($main_smarty)){
	$main_smarty->assign('anonymous_comments_path', anonymous_comments_path);
	$main_smarty->assign('anonymous_comments_lang_conf', anonymous_comments_lang_conf);
	$main_smarty->assign('anonymous_comments_tpl_path', anonymous_comments_tpl_path);
	$main_smarty->assign('URL_anonymous_comments', URL_anonymous_comments);
}
?>