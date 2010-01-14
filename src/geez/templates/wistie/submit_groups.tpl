{literal}
<script type="text/javascript">
function letternumber(e)
{
	var key;
	var keychar;

	if (window.event)
	   key = window.event.keyCode;
	else if (e)
	   key = e.which;
	else
	   return true;
	keychar = String.fromCharCode(key);
	keychar = keychar.toLowerCase();

	// control keys
	if ((key==null) || (key==0) || (key==8) || 
	    (key==9) || (key==13) || (key==27) || (key==32))
	   return true;

	// alphas and numbers
	else if ((("abcdefghijklmnopqrstuvwxyz0123456789'- ").indexOf(keychar) > -1))
	   return true;
	else
	   return false;
}

</script>
{/literal}
{if $enable_group eq "true" && $group_allow eq 1}
	{if $error}
		<div class="error">{$error}</div>
		<br />
	{/if}
	<form action="{$URL_submit_groups}" method="post" name="thisform" id="thisform" enctype="multipart/form-data">
		<label>{#PLIGG_Visual_Submit_Group_Title#}:</label><br/>{#PLIGG_Visual_Group_Submit_TitleInstruction#}<br/>
		<input type="text" id="group_title" class="text" name="group_title" size="60" maxlength="120" onKeyPress="return letternumber(event)"/>
		<br /><br/>
		<label>{#PLIGG_Visual_Submit_Group_Description#}:</label><br/>{#PLIGG_Visual_Group_Submit_DescriptionInstruction#}<br/>
		<textarea name="group_description" rows="10" cols="60" maxlength="600" id="group_description" ></textarea><br />
		<br />
		<label>{#PLIGG_Visual_Submit_Group_Privacy#}: &nbsp;</label>
			<select name="group_privacy">
				<option value = "pubic">{#PLIGG_Visual_Submit_Group_Public#}</option>
				<option value = "private">{#PLIGG_Visual_Submit_Group_Private#}</option>
				<option value = "restricted">{#PLIGG_Visual_Submit_Group_Restricted#}</option>
			</select>
			<br/>{#PLIGG_Visual_Group_Submit_PrivacyInstruction#}<br/>
		<label>{#PLIGG_Visual_Submit_Group_Mail_Friends#}:</label><br />
		{#PLIGG_Visual_Group_Submit_Mail_Friends_Desc#}<br/>
		<textarea type="text" id="group_mailer" rows="4" cols="60" name="group_mailer" ></textarea><br />
		<label>{#PLIGG_Visual_Submit_Group_vote_to_publish#}:</label><br/>{#PLIGG_Visual_Group_Submit_NoOfVoteInstruction#}<br/>
		<input type="text" id="group_vote_to_publish" size="4" name="group_vote_to_publish" ><br /><br />
		<input type="submit" value="{#PLIGG_Visual_Submit_Group_create#}" class="submit" />
	</form>
	
{else}
	{#PLIGG_Visual_Group_Disabled#}
{/if}
