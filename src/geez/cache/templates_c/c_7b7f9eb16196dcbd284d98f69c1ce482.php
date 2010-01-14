<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:27 CDT */ ?>

<?php if ($this->_vars['user_authenticated'] != "true"): ?>	

<div id="yoatest">
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_widget_login_start"), $this);?>

	<form action="<?php echo $this->_vars['URL_login']; ?>
" method="post"> 
					<span class="boxcontent3"><input type="checkbox" name="persistent" tabindex="42" /><?php echo $this->_confs['PLIGG_Visual_Login_Remember']; ?>
 </span><a href="<?php echo $this->_vars['URL_login']; ?>
" class="boxcontent3" ><?php echo $this->_confs['PLIGG_Visual_Login_ForgottenPassword']; ?>
</a><br />		
			<input type="text" name="username" class="login " size="8" value="username" onfocus="if(this.value == 'username') {this.value = '';}" onblur="if (this.value == '') {this.value = 'username';}" "<?php if (isset ( $this->_vars['login_username'] )):  endif; ?>" tabindex="1" />
			<input type="password" name="password" size="8" class="login" tabindex="2"  value="password" onfocus="if(this.value == 'password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'password';}" />
			<span class="boxcontent3"><input type="image"  src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/button/but.png"  width=50 height=20 value="submit" class="submit-s loginbutton" tabindex="3" /></span>
			<input type="hidden" name="processlogin" value="1"/>
			<input type="hidden" name="return" value="<?php echo $this->_run_modifier($_GET['return'], 'sanitize', 'plugin', 1, 3); ?>
"/>

<br />


   	 <a href="<?php echo $this->_vars['URL_register']; ?>
" class="boxcontent3" ><?php echo $this->_confs['PLIGG_Visual_Register']; ?>
</a> 
	</form>
</div>


	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_widget_login_end"), $this);?>   

	
<?php elseif ($this->_vars['user_authenticated'] == "true"): ?>

<div class="boxcontent2">
				<?php echo $this->_confs['PLIGG_Visual_Welcome_Back']; ?>
<a href="<?php echo $this->_vars['URL_userNoVar']; ?>
"><?php echo $this->_vars['user_logged_in']; ?>
</a> | <a href="<?php echo $this->_vars['URL_logout']; ?>
"> <?php echo $this->_confs['PLIGG_Visual_Logout']; ?>
</a>

				</div>		
<?php endif; ?>