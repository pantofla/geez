<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:27 CDT */ ?>

<div class="linetop">&nbsp;</div>
<div class="leftwrapper">
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_login_top"), $this);?>

<div class="login-left">
<form action="<?php echo $this->_vars['URL_login']; ?>
" id="thisform" method="post">
	<h2><?php echo $this->_confs['PLIGG_Visual_Login_Login']; ?>
</h2>
	<p><?php echo $this->_confs['PLIGG_Visual_Login_Have_Account']; ?>
</p>
	<form action="<?php echo $this->_vars['URL_login']; ?>
" method="post">	
		<strong><?php echo $this->_confs['PLIGG_Visual_Login_Username']; ?>
:</strong><br />
			<input type="text" name="username" class="login" value="<?php if (isset ( $this->_vars['login_username'] )):  echo $this->_vars['login_username'];  endif; ?>" tabindex="10" /><br />
		<br /><strong><?php echo $this->_confs['PLIGG_Visual_Login_Password']; ?>
:</strong><br />
			<input type="password" name="password" class="login" tabindex="11" /><br />
		<input type="hidden" name="processlogin" value="1"/>
		<input type="hidden" name="return" value="<?php echo $this->_run_modifier($_GET['return'], 'sanitize', 'plugin', 1, 3); ?>
"/>
		<input type="checkbox" name="persistent" tabindex="12" /> <?php echo $this->_confs['PLIGG_Visual_Login_Remember']; ?>

		<br /><br />
		<input type="submit" value="<?php echo $this->_confs['PLIGG_Visual_Login_LoginButton']; ?>
" class="submit-s searchbutton" tabindex="13" />
	</form>
</form>
</div>

<div class="login-middle">
<form action="<?php echo $this->_vars['URL_login']; ?>
" id="thisform2" method="post">
	<h2><?php echo $this->_confs['PLIGG_Visual_Login_ForgottenPassword']; ?>
</h2>
	<p><?php echo $this->_confs['PLIGG_Visual_Login_EmailChangePass']; ?>
</p>
		<strong><?php echo $this->_confs['PLIGG_Visual_Register_Email']; ?>
:</strong><br />
		<input type="text" name="email" size="25" tabindex="14" id="forgot-email" value="" />
		<br /><br />
		<input type="submit" value="Submit" class="log2 searchbutton" tabindex="15" />
		<input type="hidden" name="processlogin" value="3"/>
		<input type="hidden" name="return" value="<?php echo $this->_run_modifier($_GET['return'], 'sanitize', 'plugin', 1, 3); ?>
"/>
</form>

</div>

<div class="login-right">
<h2><?php echo $this->_confs['PLIGG_Visual_Login_NewUsers']; ?>
</h2>
	<p><?php echo $this->_confs['PLIGG_Visual_Login_NewUsersA']; ?>
<a href="<?php echo $this->_vars['register_url']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Login_NewUsersB']; ?>
</a><?php echo $this->_confs['PLIGG_Visual_Login_NewUsersC']; ?>
</p>
</div>

<br style="clear:both;"/>
	<?php if ($this->_vars['errorMsg'] != ""): ?>
		<p><div class="errordiv"><?php echo $this->_vars['errorMsg']; ?>
</div></p>
	<?php endif; ?> 
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_login_bottom"), $this);?>
</div>