<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:32 CDT */ ?>

<?php $this->config_load(upload_lang_conf, null, null); ?>

<?php 
	global $db;

	$this->_vars['upload_directory'] = $upload_directory = get_misc_data('upload_directory');
        $sql = "SELECT * FROM " . table_prefix . "files where file_link_id='{$this->_vars['link_id']}' AND file_size='orig'";
	$images = $db->get_results($sql,ARRAY_A);
	if($images)
		$this->_vars['images'] = $images;
 ?>                                                          

<?php if (sizeof ( $this->_vars['images'] )): ?><h3><?php echo $this->_confs['PLIGG_Upload_Attached']; ?>
</h3><?php endif; ?>
<?php if (count((array)$this->_vars['images'])): foreach ((array)$this->_vars['images'] as $this->_vars['image']): ?>
	<?php if (strpos ( $this->_vars['image']['file_name'] , 'http' ) === 0): ?>
		<a href='<?php echo $this->_vars['image']['file_name']; ?>
'><?php echo $this->_vars['image']['file_name']; ?>
</a><br>
	<?php else: ?>
		<a href='<?php echo $this->_vars['my_pligg_base'];  echo $this->_vars['upload_directory']; ?>
/<?php echo $this->_vars['image']['file_name']; ?>
'><?php echo $this->_vars['image']['file_name']; ?>
</a><br>
	<?php endif; ?>
<?php endforeach; endif; ?>

<?php $this->config_load(upload_pligg_lang_conf, null, null); ?>