<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:36 CDT */ ?>

<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_sidebar_start"), $this);?>








 

                 <div id="space1">	            	</div>
<?php $this->assign('sidebar_module', "sidebar_stories_u");  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template_sidebar_modules']."/wrapper.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
                 <div id="space1">	            	</div>
<?php $this->assign('sidebar_module', "sidebar_stories");  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template_sidebar_modules']."/wrapper.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
                 <div id="space1">	            	</div>
<?php $this->assign('sidebar_module', "sidebar_comments");  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template_sidebar_modules']."/wrapper.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>
                 <div id="space1">	            	</div>
<?php if ($this->_vars['Enable_Tags'] == 'true'): ?> <?php $this->assign('sidebar_module', "tags");  $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template_sidebar_modules']."/wrapper.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?> <?php endif; ?>

<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_sidebar_end"), $this);?>