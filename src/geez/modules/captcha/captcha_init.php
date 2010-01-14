<?php
if(defined('mnminclude')){
	include_once('captcha_settings.php');

	// tell pligg what pages this modules should be included in
	// pages are <script name> minus .php
	// index.php becomes 'index' and upcoming.php becomes 'upcoming'
	$include_in_pages = array('all');
	$do_not_include_in_pages = array();
		
	if( do_we_load_module() ) {		

		module_add_action_tpl('tpl_header_admin_main_links', captcha_tpl_path . 'captcha_admin_main_link.tpl');

		module_add_action('register_showform', 'captcha_register', '');
		module_add_action('register_check_errors', 'captcha_register_check_errors', '');

		$moduleName = (isset($_REQUEST['module'])) ? $_REQUEST['module'] : '';
		if($moduleName == 'captcha'){
			module_add_action('module_page', 'captcha_showpage', '');
		}

		include_once(mnmmodules . 'captcha/captcha_main.php');
	}
}
?>
