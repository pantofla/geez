<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:28:27 CDT */ ?>

<div class="linetop">&nbsp;</div>
<div class="leftwrapper">

<div class="register-left">
<form action="<?php echo $this->_vars['URL_register']; ?>
" method="post" id="thisform">

	<h2><?php echo $this->_confs['PLIGG_Visual_Register_Username']; ?>
:</h2>
	<?php if (isset ( $this->_vars['form_username_error'] )):  if (count((array)$this->_vars['form_username_error'])): foreach ((array)$this->_vars['form_username_error'] as $this->_vars['error']): ?><br /><span class="error"><?php echo $this->_vars['error']; ?>
</span><br /><?php endforeach; endif; ?><br /><?php endif; ?>
	<input type="text" name="reg_username" id="reg_username" value="<?php if (isset ( $this->_vars['reg_username'] )):  echo $this->_vars['reg_username'];  endif; ?>" size="25" tabindex="10" maxlength="32"/>
	<span id="checkit-reg-username"><input type="button" name="reg-checkbutton1" id="reg-checkbutton1" value="<?php echo $this->_confs['PLIGG_Visual_Register_Verify']; ?>
" onclick="checkfield('username', this.form, this.form.reg_username)" class="submit-s searchbutton" tabindex="11" /></span><br/><span id="reg_usernamecheckitvalue"></span>

	<br />
	
	<h2><?php echo $this->_confs['PLIGG_Visual_Register_Email']; ?>
:</h2>
	<?php if (isset ( $this->_vars['form_email_error'] )):  if (count((array)$this->_vars['form_email_error'])): foreach ((array)$this->_vars['form_email_error'] as $this->_vars['error']): ?><br /><span class="error"><?php echo $this->_vars['error']; ?>
</span><br /><?php endforeach; endif; ?><br /><?php endif; ?>
	<?php echo $this->_confs['PLIGG_Visual_Register_Lowercase']; ?>
<br />
	<input type="text" id="reg_email" name="reg_email" value="<?php if (isset ( $this->_vars['reg_email'] )):  echo $this->_vars['reg_email'];  endif; ?>" size="25" tabindex="12" maxlength="128"/>
	<span id="checkit-reg-pass"><input type="button" name="reg-checkbutton2" id="reg-checkbutton2" value="<?php echo $this->_confs['PLIGG_Visual_Register_Verify']; ?>
" onclick="checkfield('email', this.form, this.form.reg_email)" class="submit-s searchbutton" tabindex="13" /></span><br/><span id="reg_emailcheckitvalue"></span>
	
	<br />
	
	<h2><?php echo $this->_confs['PLIGG_Visual_Register_Password']; ?>
:</h2>
	<?php if (isset ( $this->_vars['form_password_error'] )):  if (count((array)$this->_vars['form_password_error'])): foreach ((array)$this->_vars['form_password_error'] as $this->_vars['error']): ?><br /><span class="error"><?php echo $this->_vars['error']; ?>
</span><br /><?php endforeach; endif; ?><br /><?php endif; ?>

	<?php echo $this->_confs['PLIGG_Visual_Register_FiveChar']; ?>
<br />
	<input type="password" id="reg_password" name="reg_password" value="<?php if (isset ( $this->_vars['reg_password'] )):  echo $this->_vars['reg_password'];  endif; ?>" size="25" tabindex="14"/>

	<br /><br />

	<h2><?php echo $this->_confs['PLIGG_Visual_Register_Verify_Password']; ?>
: </h2>
	<input type="password" id="reg_verify" name="reg_password2" value="<?php if (isset ( $this->_vars['reg_password2'] )):  echo $this->_vars['reg_password2'];  endif; ?>" size="25" tabindex="15"/>

	<?php if (isset ( $this->_vars['register_step_1_extra'] )): ?>
		<br /><br />
		<?php echo $this->_vars['register_step_1_extra']; ?>

	<?php endif; ?>
	
	<input type="submit" name="submit" value="<?php echo $this->_confs['PLIGG_Visual_Register_Create_User']; ?>
" class="log2 searchbutton" tabindex="16" />
	<input type="hidden" name="regfrom" value="full"/>
</form>
</div>

<div class="register-right">
	<h2><?php echo $this->_confs['PLIGG_Visual_Register_Description_Title']; ?>
</h2>
	<p><?php echo $this->_confs['PLIGG_Visual_Register_Description_Paragraph']; ?>
</p>
	<ul>
		<?php echo $this->_confs['PLIGG_Visual_Register_Description_Points']; ?>

	</ul>
	</p>
</div>

</div>