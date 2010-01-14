<?php
	include_once('wistie_avatars_settings.php');

	// tell pligg what pages this modules should be included in
	// pages are <script name> minus .php
	// index.php becomes 'index' and upcoming.php becomes 'upcoming'
	$do_not_include_in_pages = array();
	
	$include_in_pages = array('all');
	if( do_we_load_module() ) {		
		if(is_object($main_smarty)){
			$main_smarty->plugins_dir[] = wistie_avatars_plugins_path;

			module_add_action_tpl('tpl_pligg_story_title_start', wistie_avatars_tpl_path . 'wistie_avatars_index.tpl');

		}
		// module_add_action_tpl('tpl_pligg_below_center', wistie_avatars_tpl_path . '<your tpl name>.tpl');
	}
?>
