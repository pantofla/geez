<?php

// the path to the module. the probably shouldn't be changed unless you rename the wistie_avatars folder(s)
define('wistie_avatars_path', my_pligg_base . '/modules/wistie_avatars/');
// the path to the module. the probably shouldn't be changed unless you rename the wistie_avatars folder(s)
define('wistie_avatars_lang_conf', '/modules/wistie_avatars/lang.conf');
// the path to the modules templates. the probably shouldn't be changed unless you rename the wistie_avatars folder(s)
define('wistie_avatars_tpl_path', '../modules/wistie_avatars/templates/');
// the path for smarty / template lite plugins
define('wistie_avatars_plugins_path', 'modules/wistie_avatars/plugins');

// don't touch anything past this line.

if(is_object($main_smarty)){
	$main_smarty->assign('wistie_avatars_path', wistie_avatars_path);
	$main_smarty->assign('wistie_avatars_lang_conf', wistie_avatars_lang_conf);
	$main_smarty->assign('wistie_avatars_tpl_path', wistie_avatars_tpl_path);
}

?>
