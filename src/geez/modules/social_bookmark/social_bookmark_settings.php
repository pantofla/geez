<?php

// the path to the module. the probably shouldn't be changed unless you rename the social_bookmark folder(s)
define('social_bookmark_path', my_pligg_base . '/modules/social_bookmark/');
// the path to the module. the probably shouldn't be changed unless you rename the social_bookmark folder(s)
define('social_bookmark_lang_conf', '/modules/social_bookmark/lang.conf');
// the path to the modules templates. the probably shouldn't be changed unless you rename the social_bookmark folder(s)
define('social_bookmark_tpl_path', '../modules/social_bookmark/templates/');
// the path for smarty / template lite plugins
define('social_bookmark_plugins_path', 'modules/social_bookmark/plugins');

// don't touch anything past this line.

if(is_object($main_smarty)){
	$main_smarty->assign('social_bookmark_path', social_bookmark_path);
	$main_smarty->assign('social_bookmark_lang_conf', social_bookmark_lang_conf);
	$main_smarty->assign('social_bookmark_tpl_path', social_bookmark_tpl_path);
}

?>
