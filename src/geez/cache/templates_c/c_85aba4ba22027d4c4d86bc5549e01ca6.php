<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 07:14:11 CDT */ ?>


<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_comments_submit_start"), $this);?>
	
<h3><a name="discuss" style="color:#11A3AC"><?php echo $this->_confs['PLIGG_Visual_Comment_Send']; ?>
</a></h3>	
	<form action="" method="POST" id="thisform">

		<label><?php echo $this->_confs['PLIGG_Visual_Comment_NoHTML']; ?>
</label><br />
		<textarea name="comment_content" class="comment-form" rows="6" cols="96"/><?php if (isset ( $this->_vars['TheComment'] )):  echo $this->_vars['TheComment'];  endif; ?></textarea><br />
		<?php if ($this->_vars['Spell_Checker'] == 1): ?><input type="button" name="spelling" value="<?php echo $this->_confs['PLIGG_Visual_Check_Spelling']; ?>
" class="log2 searchbutton" onClick="openSpellChecker('comment');"/><?php endif; ?>
		<input type="submit" name="submit" value="<?php echo $this->_confs['PLIGG_Visual_Comment_Submit']; ?>
" class="log2 searchbutton" />
		<input type="hidden" name="process" value="newcomment" />
		<input type="hidden" name="randkey" value="<?php echo $this->_vars['randkey']; ?>
" />
		<input type="hidden" name="link_id" value="<?php echo $this->_vars['link_id']; ?>
" />
		<input type="hidden" name="user_id" value="<?php echo $this->_vars['user_id']; ?>
" />
	</form>	
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_comments_submit_end"), $this);?>
<br />