{if $amIgod eq 1}
 <fieldset>
	<table width="500">
			<tr><th>{#PLIGG_Visual_AdminPanel_Main#}</th><th colspan="2">{#PLIGG_Visual_AdminPanel_Stats#}</th></tr>
			<tr><td valign="top" rowspan="2">
				<div class="admintitle">{#PLIGG_Visual_AdminPanel#} Tools</div>
				<img src="{$my_pligg_base}/templates/admin/images/manage_config.gif" align="absmiddle"/> <a href="{$my_pligg_base}/admin/admin_config.php">{#PLIGG_Visual_AdminPanel_Configure#}</a><br/>
				<img src="{$my_pligg_base}/templates/admin/images/manage_user.gif" align="absmiddle"/> <a href="{$my_pligg_base}/admin/admin_users.php">{#PLIGG_Visual_AdminPanel_User_Manage#}</a><br/>
				<img src="{$my_pligg_base}/templates/admin/images/manage_cat.gif" align="absmiddle"/> <a href="{$my_pligg_base}/admin/admin_categories.php">{#PLIGG_Visual_AdminPanel_Category_Manage#}</a><br/>
				<img src="{$my_pligg_base}/templates/admin/images/news_manage.gif" align="absmiddle"/> <a href="{$my_pligg_base}/admin/admin_links.php">{#PLIGG_Visual_AdminPanel_Links#}</a><br/>
				<img src="{$my_pligg_base}/templates/admin/images/user_comments.gif" align="absmiddle"/> <a href="{$my_pligg_base}/admin/admin_comments.php">{#PLIGG_Visual_AdminPanel_Comments#}</a><br/>
				<img src="{$my_pligg_base}/templates/admin/images/page.gif" align="absmiddle"/> <a href="{$my_pligg_base}/admin/admin_page.php">{#PLIGG_Visual_AdminPanel_Manage_Pages#}</a><br />
				<img src="{$my_pligg_base}/templates/admin/images/manage_backup.gif" align="absmiddle"/> <a href="{$my_pligg_base}/admin/admin_backup.php">{#PLIGG_Visual_AdminPanel_Backup#}</a><br/>
				<img src="{$my_pligg_base}/templates/admin/images/icon_raten.gif" align="absmiddle" /> <a href="{$my_pligg_base}/admin/admin_delete_cache.php" rel="width:350,height:100" class="mb" title="{#PLIGG_Visual_AdminPanel_Delete_Cache#}">{#PLIGG_Visual_AdminPanel_Delete_Cache#}</a><br />
				<br />
				<div class="admintitle">Pligg</div>
				<img src="{$my_pligg_base}/templates/admin/images/cart.gif" align="absmiddle"/> <a href="http://www.pligg.com/pro/" target="_blank">{#PLIGG_Visual_AdminPanel_Shop#}</a><br/>
				<img src="{$my_pligg_base}/templates/admin/images/forum.gif" align="absmiddle"/> <a href="http://forums.pligg.com/" target="_blank">Pligg Forum</a><br/>
				<img src="{$my_pligg_base}/templates/admin/images/bug.gif" align="absmiddle"/> <a href="http://forums.pligg.com/projects.html" target="_blank">Report a Bug</a><br/>
				<img src="{$my_pligg_base}/templates/admin/images/paypal.gif" align="absmiddle"/> <a href="http://forums.pligg.com/donate/" target="_blank">{#PLIGG_Visual_AdminPanel_Donate#}</a><br />
				<br />
				<div class="admintitle">Modules</div>
				<img src="{$my_pligg_base}/templates/admin/images/manage_mods.gif" align="absmiddle"/> <a href="{$my_pligg_base}/admin/admin_modules.php">{#PLIGG_Visual_AdminPanel_Module_Management#}</a><br/>
				{checkActionsTpl location="tpl_header_admin_main_links"}
			</td>
			<td valign="top">
				<strong>
				{#PLIGG_Visual_AdminPanel_Version#}:<br/>
				{#PLIGG_Visual_AdminPanel_Total_Members#}:<br/>
				{#PLIGG_Visual_AdminPanel_Total_Groups#}:<br/>
				{#PLIGG_Visual_AdminPanel_Total_Links#}:<br/>
				{#PLIGG_Visual_Published_News#}:<br/>
				{#PLIGG_Visual_Pligg_Queued#}:<br/>
				{#PLIGG_Visual_Votes#}:<br/>
				{#PLIGG_Visual_AdminPanel_Comments#}:
				<hr/>
				{#PLIGG_Visual_AdminPanel_Latest_Submission#}: <br/>
				{#PLIGG_Visual_AdminPanel_Latest_Comment#}: <br/>
				{#PLIGG_Visual_AdminPanel_Latest_User#}:
				</strong>
			</td>
			<td valign="top">
				{$version_number}<br/>
				{$members}<br/>
				{$grouptotal}<br/>
				{$total}<br/>
				{$published}<br/>
				{$queued}<br/>
				{$votes}<br/>
				{$comments}
				<hr/>
				<a href="{$URL_story, $link_id}" rel="width:800,height:700" class="mb" title="{#PLIGG_Visual_AdminPanel_Latest_Submission#}">{$link_date}</a> <br/>
				<a href="{$URL_story, $link_id}#c{$comment_id}" rel="width:800,height:700" class="mb"  title="{#PLIGG_Visual_AdminPanel_Latest_Comment#}">{if isset($comment_date)}{$comment_date}{/if}</a> <br/>
				<a href="{$URL_user, $last_user}" rel="width:800,height:700" class="mb" title="{#PLIGG_Visual_AdminPanel_Latest_User#}">{$last_user}</a>
			</td>	
			</tr>
            <tr><td valign="top">{checkActionsTpl location="tpl_admin_after_stats"}</td>
            </tr>
	</table>
</fieldset>

{else}
	{#PLIGG_Visual_AdminPanel_NoAccess#}
{/if}
