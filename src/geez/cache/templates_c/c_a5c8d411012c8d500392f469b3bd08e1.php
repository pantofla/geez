<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:41 CDT */ ?>

<?php $this->config_load(admin_language_lang_conf, null, null); ?>
<li><a href="<?php echo $this->_vars['my_pligg_base']; ?>
/module.php?module=admin_language" <?php if ($this->_vars['modulename'] == "admin_language"): ?>class="navcur"<?php else: ?>class="nav"<?php endif; ?> ><?php echo $this->_confs['PLIGG_Admin_Language_Menu']; ?>
</a></li>
<?php $this->config_load(admin_language_pligg_lang_conf, null, null); ?>
