{php}
	global $db;
//print_r($this->_vars);

	$upload_link = get_misc_data('upload_link');
	$upload_defsize = get_misc_data('upload_defsize');
	$this->_vars['upload_directory'] = $upload_directory = get_misc_data('upload_directory');
	$this->_vars['upload_thdirectory'] = $upload_thdirectory = get_misc_data('upload_thdirectory');
	if ($upload_link=='story')
	     $sql = "SELECT *, '' AS link_name from " . table_prefix . "files where file_link_id='{$this->_vars['link_id']}' AND file_size='$upload_defsize' ORDER BY file_id";
	elseif ($upload_link=='orig')
	     $sql = "SELECT a.*, IF(LEFT(b.file_name,4)='http',b.file_name,CONCAT('$upload_directory/',b.file_name)) AS link_name from " . table_prefix . "files a LEFT JOIN " . table_prefix . "files b ON a.file_orig_id=b.file_id WHERE a.file_link_id='{$this->_vars['link_id']}' AND a.file_size='$upload_defsize' ORDER BY file_id";
	else
	     $sql = "SELECT a.*, CONCAT('$upload_thdirectory/',b.file_name) AS link_name from " . table_prefix . "files a LEFT JOIN " . table_prefix . "files b ON a.file_orig_id=b.file_orig_id AND b.file_size='$upload_link' WHERE a.file_link_id='{$this->_vars['link_id']}' AND a.file_size='$upload_defsize' ORDER BY file_id";
	$images = $db->get_results($sql,ARRAY_A);
	if($images)
		$this->_vars['images'] = $images;
/*	{
	
	    foreach($images as $image) 
	    {
		if ($upload_link=='story')
			{if $use_title_as_link eq true}
				{if $url_short neq "http://" && $url_short neq "://"}
					<a href="{$url}" {if $open_in_new_window eq true} target="_blank"{/if} rel="nofollow">{$title_short}</a>
				{else}
					<a href="{$story_url}" {if $open_in_new_window eq true} target="_blank"{/if} rel="nofollow">{$title_short}</a>
				{/if}
			 {else}
				{if $pagename eq "story" && $url_short neq "http://" && $url_short neq "://"}
					<a href="{$url}" {if $open_in_new_window eq true} target="_blank"{/if} rel="nofollow">{$title_short}</a>
				{else} 
				  <a href="{$story_url}" rel="nofollow">{$title_short}</a>
				{/if}
			{/if}
		if (strpos($image->file_name,'http')===0)
			print "<img src='{$image->file_name}'/> ";
		elseif ($image->file_size=='orig')
			print "<img src='".my_pligg_base."$upload_directory/{$image->file_name}'/> ";
		else
			print "<img src='".my_pligg_base."$upload_thdirectory/{$image->file_name}'/> ";
	    }
	    print "<br>";
	}
*/
{/php}                                                          

{foreach from=$images item=image}
	{if $image.link_name}
		{if strpos($image.link_name,'http')===0}
			<a href='{$image.link_name}' {if $open_in_new_window eq true} target="_blank"{/if} rel="nofollow">
		{else}
			<a href='{$my_pligg_base}{$image.link_name}' {if $open_in_new_window eq true} target="_blank"{/if} rel="nofollow">
		{/if}
	{else}
			{if $use_title_as_link eq true}
				{if $url_short neq "http://" && $url_short neq "://"}
					<a href="{$url}" {if $open_in_new_window eq true} target="_blank"{/if} rel="nofollow">
				{else}
					<a href="{$story_url}" {if $open_in_new_window eq true} target="_blank"{/if} rel="nofollow">
				{/if}
			 {else}
				{if $pagename eq "story" && $url_short neq "http://" && $url_short neq "://"}
					<a href="{$url}" {if $open_in_new_window eq true} target="_blank"{/if} rel="nofollow">
				{else} 
				  <a href="{$story_url}" rel="nofollow">
				{/if}
			{/if}
	{/if}
	{if strpos($image.file_name,'http')===0}
		<img src='{$image.file_name}'/> 
	{elseif $image.file_size=='orig'}
		<img src='{$my_pligg_base}{$upload_directory}/{$image.file_name}'/> 
	{else}
		<img src='{$my_pligg_base}{$upload_thdirectory}/{$image.file_name}'/>
	{/if*}
	</a>
{/foreach}

{if sizeof($images)}<br>{/if}
