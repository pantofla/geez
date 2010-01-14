<a href="{$URL_akismet}">Return to the Akismet Management page</a><hr />
<form name="bulk_moderate" action="{$URL_akismet_isSpam}&action=bulkmod" method="post">
<table>
<tr>
<th>Author</th><th>Url</th><th>Status</th><th>Subject</th><th>Body</th><th>this is spam</th><th>this is NOT spam</th>
</tr>
{if count($link_data) gt 0}
	{ foreach value=link from=$link_data }
		{*<a href = "{$URL_akismet_isSpam}{$link.link_id}">Yes, this is spam</a><br />
		<a href = "{$URL_akismet_isNotSpam}{$link.link_id}">No, this is NOT spam</a><br /><br />*}
		<tr>
		<td>{$link.link_author}</td>
		<td>{$link.link_url}</td>
		<td>{$link.link_status}</td>
		<td>{$link.link_title}</td>
		<td>{$link.link_content}<br /><br /></td>
		<td><center><input type="radio" name="spam[{$link.link_id}]" id="spam-{$link.link_id}" value="spam"></center></td>
		<td><center><input type="radio" name="spam[{$link.link_id}]" id="spam-{$link.link_id}" value="notspam"></center></td>
		</tr>
	{ /foreach }
{/if}
</table>

<p align="right"><input type="submit" name="submit" value="Change Status" class="log2" /></p>
</form>
