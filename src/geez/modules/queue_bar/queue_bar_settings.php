<?php

// the path to the module. the probably shouldn't be changed unless you rename the queue_bar folder(s)
define('queue_bar_path', my_pligg_base . '/modules/queue_bar/');
// the path to the module. the probably shouldn't be changed unless you rename the queue_bar folder(s)
define('queue_bar_lang_conf', '/modules/queue_bar/lang.conf');
// the path to the modules templates. the probably shouldn't be changed unless you rename the queue_bar folder(s)
define('queue_bar_tpl_path', '../modules/queue_bar/templates/');
// the path for smarty / template lite plugins
define('queue_bar_plugins_path', 'modules/queue_bar/plugins');

// don't touch anything past this line.

if(is_object($main_smarty)){
	$main_smarty->assign('queue_bar_path', queue_bar_path);
	$main_smarty->assign('queue_bar_lang_conf', queue_bar_lang_conf);
	$main_smarty->assign('queue_bar_tpl_path', queue_bar_tpl_path);
}

?>
