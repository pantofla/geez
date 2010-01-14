{config_load file=upload_lang_conf}

{php}
	global $db;

	$this->_vars['upload_directory'] = $upload_directory = get_misc_data('upload_directory');
        $sql = "SELECT * FROM " . table_prefix . "files where file_link_id='{$this->_vars['link_id']}' AND file_size='orig'";
	$images = $db->get_results($sql,ARRAY_A);
	if($images)
		$this->_vars['images'] = $images;
{/php}                                                          

{if sizeof($images)}<h3>{#PLIGG_Upload_Attached#}</h3>{/if}
{foreach from=$images item=image}
	{if strpos($image.file_name,'http')===0}
		<a href='{$image.file_name}'>{$image.file_name}</a><br>
	{else}
		<a href='{$my_pligg_base}{$upload_directory}/{$image.file_name}'>{$image.file_name}</a><br>
	{/if}
{/foreach}

{config_load file=upload_pligg_lang_conf}