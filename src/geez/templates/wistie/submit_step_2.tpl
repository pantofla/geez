{literal}
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
                        // otherwise, update 'characters left' counter
                else
                        countfield.value = maxlimit - field.value.length;
        }
</script>
{/literal}






<h1>{#PLIGG_Visual_Submit2_Header#}</h1>
<div id="leftcol-superwide"><div id="submit"><div id="submit_content">
{checkActionsTpl location="tpl_pligg_submit_step2_start"}
	{if $Submit_Show_URL_Input eq 1}
		<h2>{#PLIGG_Visual_Submit2_Source#}</h2>
			<label>{#PLIGG_Visual_Submit2_NewsURL#}: </label>
			<a href="{$submit_url}" class="simple">{$submit_url}</a><br /><br/>
			{if $submit_url_title neq "1"}
				<label>{#PLIGG_Visual_Submit2_URLTitle#}: </label>{$submit_url_title}
			{/if}
		</fieldset>
	{/if}
<br /><br />





<h2>{#PLIGG_Visual_Submit2_Details#}</h2>
	<form action="{$URL_submit}" method="post" name="thisform" id="thisform" enctype="multipart/form-data" onSubmit="return checkForm()">
		<label>{#PLIGG_Visual_Submit2_Title#}: </label>{#PLIGG_Visual_Submit2_TitleInstruct#}<br/>
		<input type="text" id="title" class="text" name="title" value="{$submit_url_title}" size="60" maxlength="120" />

		<br /><br/>

		<label>{#PLIGG_Visual_Submit2_Category#}: </label>{#PLIGG_Visual_Submit2_CatInstruct#}<br/>
		<select name="category">
			<option value = "">{#PLIGG_Visual_Submit2_CatInstructSelect#}
			{section name=thecat loop=$submit_cat_array}
			   <option value = "{$submit_cat_array[thecat].auto_id}">
					  {if $submit_cat_array[thecat].spacercount lt $submit_lastspacer}{$submit_cat_array[thecat].spacerdiff|repeat_count:''}{/if}
					  {if $submit_cat_array[thecat].spacercount gt $submit_lastspacer}{/if}
					  {$submit_cat_array[thecat].spacercount|repeat_count:'&nbsp;&nbsp;&nbsp;'}
					  {$submit_cat_array[thecat].name}
					  &nbsp;&nbsp;&nbsp;
					  {assign var=submit_lastspacer value=$submit_cat_array[thecat].spacercount}
			  </option>
			{/section}
		</select>

		<br/><br/>













		{if $enable_group eq 'true' && $output neq ''}
			<label>{#PLIGG_Visual_Group_Submit_story#}: </label><br/>
			{$output}
			<br/><br/>
		{/if}
		
		{checkActionsTpl location="tpl_header_admin_main_comment_subscription"}
		
		{*{checkActionsTpl location="tpl_timestamp_stories"}*}
		
		{if $enable_tags eq 'true'}
			<label>{#PLIGG_Visual_Submit2_Tags#}: </label>
			<strong>{#PLIGG_Visual_Submit2_Tags_Inst1#}</strong> {#PLIGG_Visual_Submit2_Tags_Example#} <em>{#PLIGG_Visual_Submit2_Tags_Inst2#}</em><br/>
			<input type="text" id="tags" class="wickEnabled" name="tags" value="{$tags_words}" size="60" maxlength="40" /><br /><br />
			{literal}
				<script type="text/javascript" language="JavaScript" src="./templates/wistie/js/tag_data.js"></script> 
				<script type="text/javascript" language="JavaScript" src="./templates/wistie/js/wick.js"></script> 
			{/literal}
			<br />
		{/if}

		{checkActionsTpl location="tpl_pligg_submit_step2_middle"}

		<label>{#PLIGG_Visual_Submit2_Description#}: </label>{#PLIGG_Visual_Submit2_DescInstruct#}
		{if $Story_Content_Tags_To_Allow eq ""}
			<br/><strong>{#PLIGG_Visual_Submit2_No_HTMLTagsAllowed#} </strong>{#PLIGG_Visual_Submit2_HTMLTagsAllowed#}
		{else}
			<br/>{#PLIGG_Visual_Submit2_HTMLTagsAllowed#}: {$Story_Content_Tags_To_Allow}
		{/if}
		<br/><textarea name="bodytext" class="bodytext" rows="40" cols="80" id="bodytext" WRAP=SOFT onkeyup="if(this.form.summarycheckbox.checked == false) {ldelim}this.form.summarytext.value = this.form.bodytext.value.substring(0, {$StorySummary_ContentTruncate});{rdelim}textCounter(this.form.summarytext,this.form.remLen, {$StorySummary_ContentTruncate});">{$submit_content}</textarea><br />
		{if $Spell_Checker eq 1}<input type="button" name="spelling" value="{#PLIGG_Visual_Check_Spelling#}" class="submit" onClick="openSpellChecker('bodytext');"/>{/if}

		<br />
		<br />

		<div id="sumtrack">
		{if $SubmitSummary_Allow_Edit eq 1}
		<label>{#PLIGG_Visual_Submit2_Summary#}: </label>{#PLIGG_Visual_Submit2_SummaryInstruct#}{#PLIGG_Visual_Submit2_SummaryLimit#}{$StorySummary_ContentTruncate}{#PLIGG_Visual_Submit2_SummaryLimitCharacters#}<br />
			<input type="checkbox" name="summarycheckbox" id="summarycheckbox" onclick="SetState(this, this.form.summarytext)"> {#PLIGG_Visual_Submit2_SummaryCheckBox#}
			{if $Story_Content_Tags_To_Allow eq ""}
				<br /><strong>{#PLIGG_Visual_Submit2_No_HTMLTagsAllowed#} </strong>{#PLIGG_Visual_Submit2_HTMLTagsAllowed#}
			{else}
				<br />{#PLIGG_Visual_Submit2_HTMLTagsAllowed#}: {$Story_Content_Tags_To_Allow}
			{/if}
			<br/><textarea disabled="true" name="summarytext" class="summarytext" rows="5" cols="60" id="summarytext" WRAP=SOFT onKeyDown="textCounter(this.form.summarytext,this.form.remLen, {$StorySummary_ContentTruncate});">{$submit_summary}</textarea><br />
			<input readonly type=text name=remLen size=3 maxlength=3 value="400">{#PLIGG_Visual_Submit2_SummaryCharactersLeft#}
			{if $Spell_Checker eq 1}<input type="button" name="spelling" value="{#PLIGG_Visual_Check_Spelling#}" class="submit" onClick="openSpellChecker('summarytext');"/>{/if}
			<br /><br />
		{/if}


		
		</div>
		
		{if isset($register_step_1_extra)}
			<br />
			{$register_step_1_extra}
		{/if}
		
		{checkActionsTpl location="submit_step_2_pre_extrafields"}

		{include file=$tpl_extra_fields.".tpl"}<br />

		<input class="button_max" type="submit" value="{#PLIGG_Visual_Submit2_Continue#}" />
		
		{checkActionsTpl location="tpl_pligg_submit_step2_end"}
		
		<input type="hidden" name="url" id="url" value="{$submit_url}" />
		<input type="hidden" name="phase" value="2" />
		<input type="hidden" name="randkey" value="{$randkey}" />
		<input type="hidden" name="id" value="{$submit_id}" />
	</form>
</fieldset>




</div></div>


 <div class="contact1">

{literal}

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
{/literal}
</div>