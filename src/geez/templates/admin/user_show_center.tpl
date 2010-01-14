{section name=nr loop=$userdata}
<fieldset><legend>View User: {$userdata[nr].user_login} <img src="{$userdata[nr].Avatar}" align="absmiddle"/></legend>
	<table style="border:none">
		<tr><td><b>{#PLIGG_Visual_View_User_Login#}: </b></td><td>{$userdata[nr].user_login}</td></tr>
		<tr><td><b>{#PLIGG_Visual_View_User_Level#}: </b></td><td>{$userdata[nr].user_level}</td></tr>
		<tr><td><b>{#PLIGG_Visual_View_User_Email#}: </b></td><td>{$userdata[nr].user_email}</td></tr>
		<tr><td><b>{#PLIGG_Visual_View_User_LL_Date#}: </b></td><td>{$userdata[nr].user_lastlogin}</td></tr>
		<tr><td><b>{#PLIGG_Visual_View_User_LL_Address#}: </b></td><td> {$userdata[nr].user_lastip}</td></tr>
		{if $userdata[nr].user_login neq "god"}<tr><td><strong>{#PLIGG_Visual_View_User_IP_Address#}:</strong></td><td> {$userdata[nr].user_ip}</td></tr>{/if}
		{checkActionsTpl location="tpl_admin_user_show_center_fields"}
		<tr><td><img src="{$my_pligg_base}/templates/admin/images/user_links.gif" align="absmiddle"/> <a href="?mode=viewlinks&user={$userdata[nr].user_login}">{#PLIGG_Visual_View_User_Sub_Links#}</a></td><td>{$linkcount} Total</td></tr>
		<tr><td><img src="{$my_pligg_base}/templates/admin/images/user_comments.gif" align="absmiddle"/> <a href="?mode=viewcomments&user={$userdata[nr].user_login}">{#PLIGG_Visual_View_User_Sub_Comments#}</a></td><td>{$commentcount} Total</td></tr>
	</table>	
<hr/>
		
{if $amIgod}		

	<table style="border:none">
		<tr><td><img src="{$my_pligg_base}/templates/admin/images/user_edit.gif" align="absmiddle"/> <a href="?mode=edit&user={$userdata[nr].user_login}">{#PLIGG_Visual_View_User_Edit_Data#}</a></td></tr>
		{if $user_logged_in neq $userdata[nr].user_login && $userdata[nr].user_id neq '1'}
			<tr><td><img src="{$my_pligg_base}/templates/admin/images/user_reset.gif" align="absmiddle"/> <a href="?mode=resetpass&user={$userdata[nr].user_login}{$uri_token_admin_users_resetpass}" onclick="return confirm('{#PLIGG_Visual_View_User_Reset_Pass_Confirm#}')">{#PLIGG_Visual_View_User_Reset_Pass#}</a></td></tr>
			<tr><td><img src="{$my_pligg_base}/templates/admin/images/user_disable.gif" align="absmiddle"/> <a href="?mode=disable&user={$userdata[nr].user_login}">{#PLIGG_Visual_View_User_Disable#}</a></td></tr>
			<tr><td><img src="{$my_pligg_base}/templates/admin/images/user_killspam.gif" align="absmiddle"/> <a href="?mode=killspam&user={$userdata[nr].user_login}&id={$userdata[nr].user_id}">{#PLIGG_Visual_View_User_Killspam#}</a></td></tr>
		{/if}
	</table>
</fieldset>

{/if}

{sectionelse}
	{include file="/templates/admin/user_doesnt_exist_center.tpl"}
{/section}
