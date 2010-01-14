<fieldset>
	<legend><img src="{$akismet_img_path}shield.png" align="absmiddle"/> Akismet</legend>

	<h2>Akismet Anti-Spam Management Console</h2>

	<img src="{$akismet_img_path}key.png" align="absmiddle"/> <a href = "{$URL_akismet}&view=manageKey">Manage WordPress Key</a><br />
	<img src="{$akismet_img_path}wrench.png" align="absmiddle"/> <a href = "{$URL_akismet}&view=manageSettings">Change Akismet Settings</a><br /><br />

	{if $spam_links_count eq 0}
		<img src="{$akismet_img_path}tick.png" align="absmiddle"/> Yay! No Spam.
	{else}
		<img src="{$akismet_img_path}exclamation.png" align="absmiddle"/> <a href = "{$URL_akismet}&view=manageSpam">{$spam_links_count} Spam Item(s) need to be reviewed!</a>
		<img src="{$akismet_img_path}exclamation.png" align="absmiddle"/> <a href = "{$URL_akismet}&view=manageSpamcomments">{$spam_comments_count} Spam Comments need to be reviewed!</a>
	{/if}
	<br />
	{if $spam_comments_count eq 0}
		<img src="{$akismet_img_path}tick.png" align="absmiddle"/> Yay! No Spam Comments.
	{else}
		<img src="{$akismet_img_path}exclamation.png" align="absmiddle"/> <a href = "{$URL_akismet}&view=manageSpamcomments">{$spam_comments_count} Spam Comments need to be reviewed!</a>
	{/if}

</fieldset>
