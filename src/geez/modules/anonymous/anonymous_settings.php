<?php

// the path to the module. the probably shouldn't be changed unless you rename the embed_videos folder(s)
define('anonymous_path', my_pligg_base . '/modules/anonymous/');
// the path to the module. the probably shouldn't be changed unless you rename the embed_videos folder(s)
define('anonymous_lang_conf', '/modules/anonymous/lang.conf');
// the path to the modules templates. the probably shouldn't be changed unless you rename the embed_videos folder(s)
define('anonymous_tpl_path', '../modules/anonymous/templates/');


define('URL_anonymous', my_pligg_base.'/module.php?module=anonymous');

// don't touch anything past this line.

if(is_object($main_smarty)){
	$main_smarty->assign('anonymous_path', anonymous_path);
	$main_smarty->assign('anonymous_conf', anonymous_lang_conf);
	$main_smarty->assign('anonymous_tpl_path', anonymous_tpl_path);
	$main_smarty->assign('URL_anonymous', URL_anonymous);
}

?>