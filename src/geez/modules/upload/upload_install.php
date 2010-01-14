<?php
	$module_info['name'] = 'upload';
	$module_info['desc'] = 'Allows you to attach images and files to an article';
	$module_info['version'] = 0.10;
	// this is where you set the modules "name" and "version" that is required
	// if more that one module is required then just make a copy of that line

	$module_info['db_add_table'][]=array(
	'name' => table_prefix . "files",
	'sql' => "CREATE TABLE `".table_prefix . "files` (
	  `file_id` int(11) NOT NULL auto_increment,
	  `file_name` varchar(255) default NULL,
	  `file_size` varchar(20) default NULL,
	  `file_user_id` int(11) NOT NULL,
	  `file_link_id` int(11) NOT NULL,
	  `file_orig_id` int(11) NOT NULL,
	  `file_real_size` int(11) NOT NULL,
	  PRIMARY KEY  (`file_id`)
	) ENGINE=MyISAM ");

	if (get_misc_data('upload_thumb')=='')
	{
		misc_data_update('upload_thumb', '1');
		misc_data_update('upload_sizes', serialize(array(250)));
		misc_data_update('upload_place', 'tpl_pligg_story_body_end');
		misc_data_update('upload_external', '0');
		misc_data_update('upload_link', 'o');
		misc_data_update('upload_directory', '/modules/upload/attachments/');
		misc_data_update('upload_thdirectory', '/modules/upload/attachments/thumbs/');
		misc_data_update('upload_filesize', '200');
		misc_data_update('upload_maxnumber', '1');
		misc_data_update('upload_extensions', 'jpg jpeg png gif');
		misc_data_update('upload_fileplace', 'tpl_pligg_story_who_voted_start');
	}

?>
