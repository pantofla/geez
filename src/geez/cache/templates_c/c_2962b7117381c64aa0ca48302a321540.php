<?php /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 11:31:45 CDT */ ?>

<?php echo '
<script type="text/javascript">
  function SetState(obj_checkbox, obj_textarea)
  {  if(obj_checkbox.checked)
     { obj_textarea.disabled = false;
     }
     else
     { obj_textarea.disabled = true;
     }
  }
        function textCounter(field, countfield, maxlimit) {
                if (field.value.length > maxlimit) // if too long...trim it!
                        field.value = field.value.substring(0, maxlimit);
                        // otherwise, update \'characters left\' counter
                else
                        countfield.value = maxlimit - field.value.length;
        }
</script>
'; ?>







<h1><?php echo $this->_confs['PLIGG_Visual_Submit2_Header']; ?>
</h1>
<div id="leftcol-superwide"><div id="submit"><div id="submit_content">
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_submit_step2_start"), $this);?>
	<?php if ($this->_vars['Submit_Show_URL_Input'] == 1): ?>
		<h2><?php echo $this->_confs['PLIGG_Visual_Submit2_Source']; ?>
</h2>
			<label><?php echo $this->_confs['PLIGG_Visual_Submit2_NewsURL']; ?>
: </label>
			<a href="<?php echo $this->_vars['submit_url']; ?>
" class="simple"><?php echo $this->_vars['submit_url']; ?>
</a><br /><br/>
			<?php if ($this->_vars['submit_url_title'] != "1"): ?>
				<label><?php echo $this->_confs['PLIGG_Visual_Submit2_URLTitle']; ?>
: </label><?php echo $this->_vars['submit_url_title']; ?>

			<?php endif; ?>
		</fieldset>
	<?php endif; ?>
<br /><br />





<h2><?php echo $this->_confs['PLIGG_Visual_Submit2_Details']; ?>
</h2>
	<form action="<?php echo $this->_vars['URL_submit']; ?>
" method="post" name="thisform" id="thisform" enctype="multipart/form-data" onSubmit="return checkForm()">
		<label><?php echo $this->_confs['PLIGG_Visual_Submit2_Title']; ?>
: </label><?php echo $this->_confs['PLIGG_Visual_Submit2_TitleInstruct']; ?>
<br/>
		<input type="text" id="title" class="text" name="title" value="<?php echo $this->_vars['submit_url_title']; ?>
" size="60" maxlength="120" />

		<br /><br/>

		<label><?php echo $this->_confs['PLIGG_Visual_Submit2_Category']; ?>
: </label><?php echo $this->_confs['PLIGG_Visual_Submit2_CatInstruct']; ?>
<br/>
		<select name="category">
			<option value = ""><?php echo $this->_confs['PLIGG_Visual_Submit2_CatInstructSelect']; ?>

			<?php if (isset($this->_sections['thecat'])) unset($this->_sections['thecat']);
$this->_sections['thecat']['name'] = 'thecat';
$this->_sections['thecat']['loop'] = is_array($this->_vars['submit_cat_array']) ? count($this->_vars['submit_cat_array']) : max(0, (int)$this->_vars['submit_cat_array']);
$this->_sections['thecat']['show'] = true;
$this->_sections['thecat']['max'] = $this->_sections['thecat']['loop'];
$this->_sections['thecat']['step'] = 1;
$this->_sections['thecat']['start'] = $this->_sections['thecat']['step'] > 0 ? 0 : $this->_sections['thecat']['loop']-1;
if ($this->_sections['thecat']['show']) {
	$this->_sections['thecat']['total'] = $this->_sections['thecat']['loop'];
	if ($this->_sections['thecat']['total'] == 0)
		$this->_sections['thecat']['show'] = false;
} else
	$this->_sections['thecat']['total'] = 0;
if ($this->_sections['thecat']['show']):

		for ($this->_sections['thecat']['index'] = $this->_sections['thecat']['start'], $this->_sections['thecat']['iteration'] = 1;
			 $this->_sections['thecat']['iteration'] <= $this->_sections['thecat']['total'];
			 $this->_sections['thecat']['index'] += $this->_sections['thecat']['step'], $this->_sections['thecat']['iteration']++):
$this->_sections['thecat']['rownum'] = $this->_sections['thecat']['iteration'];
$this->_sections['thecat']['index_prev'] = $this->_sections['thecat']['index'] - $this->_sections['thecat']['step'];
$this->_sections['thecat']['index_next'] = $this->_sections['thecat']['index'] + $this->_sections['thecat']['step'];
$this->_sections['thecat']['first']	  = ($this->_sections['thecat']['iteration'] == 1);
$this->_sections['thecat']['last']	   = ($this->_sections['thecat']['iteration'] == $this->_sections['thecat']['total']);
?>
			   <option value = "<?php echo $this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['auto_id']; ?>
">
					  <?php if ($this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['spacercount'] < $this->_vars['submit_lastspacer']):  echo $this->_run_modifier($this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['spacerdiff'], 'repeat_count', 'plugin', 1, '');  endif; ?>
					  <?php if ($this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['spacercount'] > $this->_vars['submit_lastspacer']):  endif; ?>
					  <?php echo $this->_run_modifier($this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['spacercount'], 'repeat_count', 'plugin', 1, '&nbsp;&nbsp;&nbsp;'); ?>

					  <?php echo $this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['name']; ?>

					  &nbsp;&nbsp;&nbsp;
					  <?php $this->assign('submit_lastspacer', $this->_vars['submit_cat_array'][$this->_sections['thecat']['index']]['spacercount']); ?>
			  </option>
			<?php endfor; endif; ?>
		</select>

		<br/><br/>













		<?php if ($this->_vars['enable_group'] == 'true' && $this->_vars['output'] != ''): ?>
			<label><?php echo $this->_confs['PLIGG_Visual_Group_Submit_story']; ?>
: </label><br/>
			<?php echo $this->_vars['output']; ?>

			<br/><br/>
		<?php endif; ?>
		
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_header_admin_main_comment_subscription"), $this);?>
		
		
		
		<?php if ($this->_vars['enable_tags'] == 'true'): ?>
			<label><?php echo $this->_confs['PLIGG_Visual_Submit2_Tags']; ?>
: </label>
			<strong><?php echo $this->_confs['PLIGG_Visual_Submit2_Tags_Inst1']; ?>
</strong> <?php echo $this->_confs['PLIGG_Visual_Submit2_Tags_Example']; ?>
 <em><?php echo $this->_confs['PLIGG_Visual_Submit2_Tags_Inst2']; ?>
</em><br/>
			<input type="text" id="tags" class="wickEnabled" name="tags" value="<?php echo $this->_vars['tags_words']; ?>
" size="60" maxlength="40" /><br /><br />
			<?php echo '
				<script type="text/javascript" language="JavaScript" src="./templates/wistie/js/tag_data.js"></script> 
				<script type="text/javascript" language="JavaScript" src="./templates/wistie/js/wick.js"></script> 
			'; ?>

			<br />
		<?php endif; ?>

		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_submit_step2_middle"), $this);?>

		<label><?php echo $this->_confs['PLIGG_Visual_Submit2_Description']; ?>
: </label><?php echo $this->_confs['PLIGG_Visual_Submit2_DescInstruct']; ?>

		<?php if ($this->_vars['Story_Content_Tags_To_Allow'] == ""): ?>
			<br/><strong><?php echo $this->_confs['PLIGG_Visual_Submit2_No_HTMLTagsAllowed']; ?>
 </strong><?php echo $this->_confs['PLIGG_Visual_Submit2_HTMLTagsAllowed']; ?>

		<?php else: ?>
			<br/><?php echo $this->_confs['PLIGG_Visual_Submit2_HTMLTagsAllowed']; ?>
: <?php echo $this->_vars['Story_Content_Tags_To_Allow']; ?>

		<?php endif; ?>
		<br/><textarea name="bodytext" class="bodytext" rows="40" cols="80" id="bodytext" WRAP=SOFT onkeyup="if(this.form.summarycheckbox.checked == false) {this.form.summarytext.value = this.form.bodytext.value.substring(0, <?php echo $this->_vars['StorySummary_ContentTruncate']; ?>
);}textCounter(this.form.summarytext,this.form.remLen, <?php echo $this->_vars['StorySummary_ContentTruncate']; ?>
);"><?php echo $this->_vars['submit_content']; ?>
</textarea><br />
		<?php if ($this->_vars['Spell_Checker'] == 1): ?><input type="button" name="spelling" value="<?php echo $this->_confs['PLIGG_Visual_Check_Spelling']; ?>
" class="submit" onClick="openSpellChecker('bodytext');"/><?php endif; ?>

		<br />
		<br />

		<div id="sumtrack">
		<?php if ($this->_vars['SubmitSummary_Allow_Edit'] == 1): ?>
		<label><?php echo $this->_confs['PLIGG_Visual_Submit2_Summary']; ?>
: </label><?php echo $this->_confs['PLIGG_Visual_Submit2_SummaryInstruct'];  echo $this->_confs['PLIGG_Visual_Submit2_SummaryLimit'];  echo $this->_vars['StorySummary_ContentTruncate'];  echo $this->_confs['PLIGG_Visual_Submit2_SummaryLimitCharacters']; ?>
<br />
			<input type="checkbox" name="summarycheckbox" id="summarycheckbox" onclick="SetState(this, this.form.summarytext)"> <?php echo $this->_confs['PLIGG_Visual_Submit2_SummaryCheckBox']; ?>

			<?php if ($this->_vars['Story_Content_Tags_To_Allow'] == ""): ?>
				<br /><strong><?php echo $this->_confs['PLIGG_Visual_Submit2_No_HTMLTagsAllowed']; ?>
 </strong><?php echo $this->_confs['PLIGG_Visual_Submit2_HTMLTagsAllowed']; ?>

			<?php else: ?>
				<br /><?php echo $this->_confs['PLIGG_Visual_Submit2_HTMLTagsAllowed']; ?>
: <?php echo $this->_vars['Story_Content_Tags_To_Allow']; ?>

			<?php endif; ?>
			<br/><textarea disabled="true" name="summarytext" class="summarytext" rows="5" cols="60" id="summarytext" WRAP=SOFT onKeyDown="textCounter(this.form.summarytext,this.form.remLen, <?php echo $this->_vars['StorySummary_ContentTruncate']; ?>
);"><?php echo $this->_vars['submit_summary']; ?>
</textarea><br />
			<input readonly type=text name=remLen size=3 maxlength=3 value="400"><?php echo $this->_confs['PLIGG_Visual_Submit2_SummaryCharactersLeft']; ?>

			<?php if ($this->_vars['Spell_Checker'] == 1): ?><input type="button" name="spelling" value="<?php echo $this->_confs['PLIGG_Visual_Check_Spelling']; ?>
" class="submit" onClick="openSpellChecker('summarytext');"/><?php endif; ?>
			<br /><br />
		<?php endif; ?>


		
		</div>
		
		<?php if (isset ( $this->_vars['register_step_1_extra'] )): ?>
			<br />
			<?php echo $this->_vars['register_step_1_extra']; ?>

		<?php endif; ?>
		
		<?php echo tpl_function_checkActionsTpl(array('location' => "submit_step_2_pre_extrafields"), $this);?>

		<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['tpl_extra_fields'].".tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?><br />

		<input class="button_max" type="submit" value="<?php echo $this->_confs['PLIGG_Visual_Submit2_Continue']; ?>
" />
		
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_submit_step2_end"), $this);?>
		
		<input type="hidden" name="url" id="url" value="<?php echo $this->_vars['submit_url']; ?>
" />
		<input type="hidden" name="phase" value="2" />
		<input type="hidden" name="randkey" value="<?php echo $this->_vars['randkey']; ?>
" />
		<input type="hidden" name="id" value="<?php echo $this->_vars['submit_id']; ?>
" />
	</form>
</fieldset>




</div></div>


 <div class="contact1">

<?php echo '

<script type="text/javascript"><!--
google_ad_client = "pub-5074133216375147";
/* 468x60, created 4/26/09 submit2 */
google_ad_slot = "8818087098";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
'; ?>

</div>