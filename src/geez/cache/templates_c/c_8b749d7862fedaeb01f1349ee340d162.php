<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 11:31:45 CDT */ ?>

<?php $this->config_load(upload_lang_conf, null, null); ?>

<h3><?php echo $this->_confs['PLIGG_Upload_Attach']; ?>
</h3>
(<?php echo $this->_vars['upload_extensions']; ?>
 <?php echo $this->_confs['PLIGG_Upload_Extensions_Allowed']; ?>
)<br>

<?php if (isset($this->_sections['files'])) unset($this->_sections['files']);
$this->_sections['files']['name'] = 'files';
$this->_sections['files']['start'] = (int)0;
$this->_sections['files']['loop'] = is_array($this->_vars['upload_maxnumber']) ? count($this->_vars['upload_maxnumber']) : max(0, (int)$this->_vars['upload_maxnumber']);
$this->_sections['files']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['files']['show'] = true;
$this->_sections['files']['max'] = $this->_sections['files']['loop'];
if ($this->_sections['files']['start'] < 0)
	$this->_sections['files']['start'] = max($this->_sections['files']['step'] > 0 ? 0 : -1, $this->_sections['files']['loop'] + $this->_sections['files']['start']);
else
	$this->_sections['files']['start'] = min($this->_sections['files']['start'], $this->_sections['files']['step'] > 0 ? $this->_sections['files']['loop'] : $this->_sections['files']['loop']-1);
if ($this->_sections['files']['show']) {
	$this->_sections['files']['total'] = min(ceil(($this->_sections['files']['step'] > 0 ? $this->_sections['files']['loop'] - $this->_sections['files']['start'] : $this->_sections['files']['start']+1)/abs($this->_sections['files']['step'])), $this->_sections['files']['max']);
	if ($this->_sections['files']['total'] == 0)
		$this->_sections['files']['show'] = false;
} else
	$this->_sections['files']['total'] = 0;
if ($this->_sections['files']['show']):

		for ($this->_sections['files']['index'] = $this->_sections['files']['start'], $this->_sections['files']['iteration'] = 1;
			 $this->_sections['files']['iteration'] <= $this->_sections['files']['total'];
			 $this->_sections['files']['index'] += $this->_sections['files']['step'], $this->_sections['files']['iteration']++):
$this->_sections['files']['rownum'] = $this->_sections['files']['iteration'];
$this->_sections['files']['index_prev'] = $this->_sections['files']['index'] - $this->_sections['files']['step'];
$this->_sections['files']['index_next'] = $this->_sections['files']['index'] + $this->_sections['files']['step'];
$this->_sections['files']['first']	  = ($this->_sections['files']['iteration'] == 1);
$this->_sections['files']['last']	   = ($this->_sections['files']['iteration'] == $this->_sections['files']['total']);
?>
    <?php echo $this->_confs['PLIGG_Upload_Upload']; ?>
: <input size='10' type='file' name='upload_files[]'>
    <?php if ($this->_vars['upload_external']): ?>
	<?php echo $this->_confs['PLIGG_Upload_OR']; ?>
 <?php echo $this->_confs['PLIGG_Upload_Link']; ?>
: <input type='text' name='upload_urls[]' value='http://'>
    <?php endif; ?>
    <br>
<?php endfor; endif; ?>

<?php $this->config_load(upload_pligg_lang_conf, null, null); ?>