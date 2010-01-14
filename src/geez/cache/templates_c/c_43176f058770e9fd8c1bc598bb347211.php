<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-12 05:38:45 CDT */ ?>



<fieldset>

<?php if ($this->_vars['submit_error'] == 'invalidurl'): ?>
	<p class="error"><?php echo $this->_confs['PLIGG_Visual_Submit2Errors_InvalidURL']; ?>
: (<?php echo $this->_vars['submit_url']; ?>
)</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="<?php echo $this->_confs['PLIGG_Visual_Submit2Errors_Back']; ?>
" class="submit">
	</form>
<?php endif; ?>

<?php if ($this->_vars['submit_error'] == 'dupeurl'): ?>
	<p class="error"><?php echo $this->_confs['PLIGG_Visual_Submit2Errors_DupeArticleURL']; ?>
: <?php echo $this->_vars['submit_url']; ?>
</p>
	<p><?php echo $this->_confs['PLIGG_Visual_Submit2Errors_DupeArticleURL_Instruct']; ?>
</p>
	<p><a href="<?php echo $this->_vars['submit_search']; ?>
"><strong><?php echo $this->_confs['PLIGG_Visual_Submit2Errors_DupeArticleURL_Instruct2']; ?>
:</strong></a></p>
	<br style="clear: both;" /><br style="clear: both;" />
	<form id="thisform">
		<input type=button onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="<?php echo $this->_confs['PLIGG_Visual_Submit2Errors_Back']; ?>
" class="submit" />
	</form>
<?php endif; ?>



<?php if ($this->_vars['submit_error'] == 'badkey'): ?>
	<p class="error"><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_BadKey']; ?>
</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="submit" />
	</form>
<?php endif; ?>

<?php if ($this->_vars['submit_error'] == 'hashistory'): ?>
	<p class="error"><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_HasHistory']; ?>
: <?php echo $this->_vars['submit_error_history']; ?>
</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="submit" />
	</form>
<?php endif; ?>

<?php if ($this->_vars['submit_error'] == 'urlintitle'): ?>
	<p class="error"><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_URLInTitle']; ?>
</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="submit" />
	</form>
<?php endif; ?>

<?php if ($this->_vars['submit_error'] == 'incomplete'): ?>
	<p class="error"><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Incomplete']; ?>
</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="submit" />
	</form>
<?php endif; ?>

<?php if ($this->_vars['submit_error'] == 'nocategory'): ?>
	<p class="error"><?php echo $this->_confs['PLIGG_Visual_Submit3Errors_NoCategory']; ?>
</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="submit" />
	</form>
<?php endif; ?>
<?php if ($this->_vars['submit_error'] == 'register_captcha_error'): ?>
	<p class="error">The answer provided is not correct. Please try again.</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="<?php echo $this->_confs['PLIGG_Visual_Submit3Errors_Back']; ?>
" class="submit" />
	</form>
<?php endif; ?>
</fieldset>
