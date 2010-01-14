<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:32 CDT */ ?>

<?php 
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
 ?>                                                          

<?php if (count((array)$this->_vars['images'])): foreach ((array)$this->_vars['images'] as $this->_vars['image']): ?>
	<?php if ($this->_vars['image']['link_name']): ?>
		<?php if (strpos ( $this->_vars['image']['link_name'] , 'http' ) === 0): ?>
			<a href='<?php echo $this->_vars['image']['link_name']; ?>
' <?php if ($this->_vars['open_in_new_window'] == true): ?> target="_blank"<?php endif; ?> rel="nofollow">
		<?php else: ?>
			<a href='<?php echo $this->_vars['my_pligg_base'];  echo $this->_vars['image']['link_name']; ?>
' <?php if ($this->_vars['open_in_new_window'] == true): ?> target="_blank"<?php endif; ?> rel="nofollow">
		<?php endif; ?>
	<?php else: ?>
			<?php if ($this->_vars['use_title_as_link'] == true): ?>
				<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"): ?>
					<a href="<?php echo $this->_vars['url']; ?>
" <?php if ($this->_vars['open_in_new_window'] == true): ?> target="_blank"<?php endif; ?> rel="nofollow">
				<?php else: ?>
					<a href="<?php echo $this->_vars['story_url']; ?>
" <?php if ($this->_vars['open_in_new_window'] == true): ?> target="_blank"<?php endif; ?> rel="nofollow">
				<?php endif; ?>
			 <?php else: ?>
				<?php if ($this->_vars['pagename'] == "story" && $this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"): ?>
					<a href="<?php echo $this->_vars['url']; ?>
" <?php if ($this->_vars['open_in_new_window'] == true): ?> target="_blank"<?php endif; ?> rel="nofollow">
				<?php else: ?> 
				  <a href="<?php echo $this->_vars['story_url']; ?>
" rel="nofollow">
				<?php endif; ?>
			<?php endif; ?>
	<?php endif; ?>
	<?php if (strpos ( $this->_vars['image']['file_name'] , 'http' ) === 0): ?>
		<img src='<?php echo $this->_vars['image']['file_name']; ?>
'/> 
	<?php elseif ($this->_vars['image']['file_size'] == 'orig'): ?>
		<img src='<?php echo $this->_vars['my_pligg_base'];  echo $this->_vars['upload_directory']; ?>
/<?php echo $this->_vars['image']['file_name']; ?>
'/> 
	<?php else: ?>
		<img src='<?php echo $this->_vars['my_pligg_base'];  echo $this->_vars['upload_thdirectory']; ?>
/<?php echo $this->_vars['image']['file_name']; ?>
'/>
	<?php endif; ?>
	</a>
<?php endforeach; endif; ?>

<?php if (sizeof ( $this->_vars['images'] )): ?><br><?php endif; ?>
