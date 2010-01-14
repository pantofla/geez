{section name=nr loop=$userdata}
<fieldset><legend><img src="{$my_pligg_base}/templates/admin/images/user_edit.gif" align="absmiddle" /> {#PLIGG_Visual_Breadcrumb_Edit_User#}: {$userdata[nr].user_login}</legend>
	<form id="form1" name="form1" method="get" action="">
		<input type=hidden name=user value="{$userdata[nr].user_login}">
		{$hidden_token_admin_users_edit}

		<label>{#PLIGG_Visual_View_User_Login#}:</label>
		<input name=login value="{$userdata[nr].user_login}"><br/>
		
		{if $userdata[nr].user_id neq 1}
			<label>{#PLIGG_Visual_View_User_Level#}:</label>
			<SELECT NAME="level">{html_options values=$levels output=$levels selected=$userdata[nr].user_level}</SELECT><br/>
		{else}
			<input name="level" type="hidden" value="{$userdata[nr].user_level}" />
		{/if}

		<label>{#PLIGG_Visual_View_User_Email#}:</label>
		<input name=email value="{$userdata[nr].user_email}">
		{checkActionsTpl location="tpl_admin_user_edit_center_fields"}
		<br/><input type=submit name=mode value="{#PLIGG_Visual_Profile_Save#}" class="log2">&nbsp;&nbsp;&nbsp;<input type=button onclick="window.history.go(-1)" value="{#PLIGG_Visual_View_User_Edit_Cancel#}" class="log2">
	</form>	
{sectionelse}
	{include file="{$my_pligg_base}/templates/admin/user_doesnt_exist_center.tpl"}
{/section}
</fieldset>
