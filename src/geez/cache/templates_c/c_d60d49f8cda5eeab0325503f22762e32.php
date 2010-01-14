<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:12:32 CDT */ ?>

<?php echo '
<script type="text/javascript">
	function validate(form_id,email) {
		var reg = /^([A-Za-z0-9_\\-\\.])+\\@([A-Za-z0-9_\\-\\.])+\\.([A-Za-z]{2,4})$/;
		var address = document.forms[form_id].elements[email].value;
		if(reg.test(address) == false) {
			alert(\'Invalid Email Address\');
			return false;
		}
	}
</script>
'; ?>


<fieldset><legend><?php echo $this->_confs['PLIGG_Visual_Comment_Send']; ?>
</legend>	
	<form action="" method="POST" id="thisform" onsubmit="javascript:return validate('thisform','a_email');">
		<span><b>&nbsp;User Name :&nbsp;</b></span><br/><input  type ="text" name = "a_username" /><?php echo $this->_vars['a_username']; ?>
<br clear="all" />

		<label><?php echo $this->_confs['PLIGG_Visual_Comment_NoHTML']; ?>
</label><br clear="all" />
		<textarea name="comment_content" id="comment" rows="6" cols="60"/><?php if (isset ( $this->_vars['TheComment'] )):  echo $this->_vars['TheComment'];  endif; ?></textarea><br />
		<?php if ($this->_vars['Spell_Checker'] == 1): ?><input type="button" name="spelling" value="<?php echo $this->_confs['PLIGG_Visual_Check_Spelling']; ?>
" class="log2" onClick="openSpellChecker('comment');"/><?php endif; ?>
		<br/>
		<?php if (isset ( $this->_vars['register_step_1_extra'] )): ?>
			<br />
			<?php echo $this->_vars['register_step_1_extra']; ?>

		<?php endif; ?>
		<input type="submit" name="submit" value="<?php echo $this->_confs['PLIGG_Visual_Comment_Submit']; ?>
" class="log2" />
		<input type="hidden" name="process" value="newcomment" />
		<input type="hidden" name="randkey" value="<?php echo $this->_vars['randkey']; ?>
" />
		<input type="hidden" name="link_id" value="<?php echo $this->_vars['link_id']; ?>
" />
		<input type="hidden" name="user_id" value="<?php echo $this->_vars['anonymous_user_id']; ?>
" />
		<input type="hidden" name="anon" value="1" />
	</form>
</fieldset>
<?php $this->config_load("/languages/lang_english.conf", null, null); ?>