<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:42 CDT */ ?>

<?php $this->config_load(captcha_lang_conf, null, null); ?>
<img src="<?php echo $this->_vars['captcha_img_path']; ?>
eye.png" align="absmiddle"/> <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/module.php?module=captcha"><?php echo $this->_confs['PLIGG_Captcha_BreadCrumb']; ?>
</a><br/>
<?php $this->config_load(captcha_pligg_lang_conf, null, null); ?>