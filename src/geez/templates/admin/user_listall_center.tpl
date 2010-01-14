<fieldset><legend><img src="{$my_pligg_base}/templates/admin/images/manage_user.gif" align="absmiddle" /> {#PLIGG_Visual_AdminPanel_User_Manage#}</legend>

<form action="{$my_base_url}{$my_pligg_base}/admin/admin_users.php" method="get">
<input type="hidden" name="mode" value="search">
	{if isset($templatelite.get.keyword)}
			{assign var=searchboxtext value=$templatelite.get.keyword|sanitize:2}
	{else}
			{assign var=searchboxtext value=#PLIGG_Visual_Search_SearchDefaultText#}			
	{/if}
<input type="text" name="keyword" value="{$searchboxtext}" onfocus="if(this.value == '{$searchboxtext}') {ldelim}this.value = '';{rdelim}" onblur="if (this.value == '') {ldelim}this.value = '{$searchboxtext}';{rdelim}">
<input type="submit" value="{#PLIGG_Visual_Search_Go#}">

&nbsp;&nbsp;

  <a href="{$my_pligg_base}/admin/admin_users.php?mode=create" rel="width:400,height:300" class="mb" title="Create User" id="create">{#PLIGG_Visual_AdminPanel_New_User#}</a>
  <div class="multiBoxDesc create">{#PLIGG_Visual_AdminPanel_New_User_Desc#}</div>
  
</form>

{if isset($usererror)} <span class="error">{$usererror}</span><br/><br/>{/if}

<table cellpadding="1" border="0" width="90%">
<tr><th>{#PLIGG_Visual_Login_Username#}</th><th>{#PLIGG_Visual_View_User_Level#}</th><th>{#PLIGG_Visual_View_User_Email#}</th><th>{#PLIGG_Visual_User_Profile_Joined#}</th><th>{#PLIGG_Visual_AdminPanel_Validate#}</th></tr>
	{section name=nr loop=$userlist}
	<tr>
	<td><img src="{$userlist[nr].Avatar}" align="absmiddle"/> <a href = "?mode=view&user={$userlist[nr].user_login}">{$userlist[nr].user_login}</a></td>	
	<td>{$userlist[nr].user_level}</td>
	<td>{$userlist[nr].user_email}</td>
	<td>{$userlist[nr].user_date}</td>
	<td>{if $userlist[nr].user_lastlogin neq "0000-00-00 00:00:00"}{#PLIGG_Visual_AdminPanel_Validated#}{else}<a href="{$my_base_url}{$my_pligg_base}/admin/admin_user_validate.php?id={$userlist[nr].user_id}" rel="width:280,height:150" class="mb" title="Validate Confirmation" style="text-decoration:none;">{#PLIGG_Visual_AdminPanel_Validate#}</a>{/if}</td>
	</tr>
	{/section}
</table>

</fieldset>