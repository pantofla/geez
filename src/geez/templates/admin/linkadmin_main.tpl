<fieldset><legend>{#PLIGG_Visual_Change_Link_Status#}</legend>
<b>{#PLIGG_Visual_Change_Link_Title#}:</b> {$link_title} <br /><br />
<b>{#PLIGG_Visual_Change_Link_URL#}:</b> {$link_url} <a href = "{$my_base_url}{$my_pligg_base}/admin/manage_banned_domains.php?id={$link_id}&add={$banned_domain_url}">{#PLIGG_Visual_Ban_This_URL#}</a><br /><br />
<b>{#PLIGG_Visual_Change_Link_Content#}:</b> {$link_content}<br /><br />
<b>{#PLIGG_Visual_Change_Link_Status2#}:</b> {$link_status}<br /><br />
<b>{#PLIGG_Visual_Change_Link_Submitted_By#}:</b> {$user_login} <a href ="{$my_base_url}{$my_pligg_base}/admin/admin_users.php?mode=disable&user={$user_login}">{#PLIGG_Visual_Disable_This_USer#}</a><br />

<hr />
				
<a href = "{$admin_discard_url}">Set to "discard"</a> - {#PLIGG_Visual_Change_Link_Discard#}<br /><br />
<a href = "{$admin_queued_url}">Set to "queued"</a> - {#PLIGG_Visual_Change_Link_Queued#}<br /><br />
<a href = "{$admin_published_url}">Set to "published"</a> - {#PLIGG_Visual_Change_Link_Published#}
<br /><br />
</fieldset>