<?php
	include_once('blocker_settings.php');

	// tell pligg what pages this modules should be included in
	// pages are <script name> minus .php
	// index.php becomes 'index' and upcoming.php becomes 'upcoming'
	$do_not_include_in_pages = array();
	
	$include_in_pages = array('all');
	if( do_we_load_module() ) {		
		if(is_object($main_smarty)){
			$main_smarty->plugins_dir[] = blocker_plugins_path;

			module_add_action_tpl('tpl_pligg_head_start', blocker_tpl_path . 'blocker_index.tpl');

		}
		// module_add_action_tpl('tpl_pligg_below_center', blocker_tpl_path . '<your tpl name>.tpl');
	}
?>
