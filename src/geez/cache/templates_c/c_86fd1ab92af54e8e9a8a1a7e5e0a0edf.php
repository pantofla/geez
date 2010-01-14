<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:27 CDT */ ?>

	              <?php if ($this->_vars['user_authenticated'] == true): ?>
                	<div class="links">
	            	<div class="sectiontitle">

<?php $this->config_load($this->_vars['simple_messaging_lang_conf'], null, null); ?>



	<a href="<?php echo $this->_vars['URL_simple_messaging_inbox']; ?>
" class="main">
		<span><?php echo $this->_confs['PLIGG_MESSAGING_Inbox']; ?>
 <?php if ($this->_vars['msg_new_count'] > 0): ?>(<?php echo $this->_vars['msg_new_count']; ?>
 <?php echo $this->_confs['PLIGG_MESSAGING_New']; ?>
)<?php endif; ?> </span>
	</a>


<?php $this->config_load("/languages/lang_".$this->_vars['pligg_language'].".conf", null, null); ?>


</div>
	            </div>
	            <?php endif; ?>