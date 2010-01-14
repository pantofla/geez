<fieldset><legend><img src="{$my_pligg_base}/templates/admin/images/user_links.gif" align="absmiddle" /> {$user}'s {#PLIGG_Visual_TopUsers_TH_News#}</legend>

<form action="{$my_pligg_base}/admin/admin_users.php?mode=viewlinks&user={$user}" method="post">
	<select name="filter">
		<option value="All"{if $templatelite.post.filter eq "All"} selected="selected" {/if}>All</option>
		<option value="Published" {if $templatelite.post.filter eq "Published"} selected="selected" {/if}>Published</option>
		<option value="Upcoming" {if $templatelite.post.filter eq "Upcoming"} selected="selected" {/if}>Queued</option>
		<option value="Discard" {if $templatelite.post.filter eq "Discard"} selected="selected" {/if}>Discard</option>
	</select>
	<input type="hidden" name="process" value="1">
	<input type="submit" value="Filter" class="log2">
</form>

<form action="{$my_pligg_base}/admin/admin_users.php?mode=viewlinks&user={$user}" method="post">
	{if $templatelite.post.keyword neq ""}
			{assign var=searchboxtext value=$templatelite.post.keyword|sanitize:2}
	{else}
			{assign var=searchboxtext value=#PLIGG_Visual_Search_SearchDefaultText#}			
	{/if}	
	<input type="text" name="keyword" value="{$searchboxtext}" onfocus="if(this.value == '{$searchboxtext}') {ldelim}this.value = '';{rdelim}" onblur="if (this.value == '') {ldelim}this.value = '{$searchboxtext}';{rdelim}">
	<input type="hidden" name="filter" value="Search">
	<input type="hidden" name="process" value="1">
	<input type="submit" value="{#PLIGG_Visual_Search_Go#}" class="log2">
</form>

<form name="bulk_moderate" action="{$my_pligg_base}/admin/admin_users.php?mode=viewlinks&action=bulkmod" method="post">
<table cellpadding="1" cellspacing="2" border="0">
<tr><th>{#PLIGG_Visual_View_Links_Status#}</th><th>{#PLIGG_Visual_View_Links_New_Window#}</th><th><center>Publish</center></th><th><center>Queued</center></th><th><center>Discard</center></th></tr>
	{section name=nr loop=$links}    
	<tr>
		<td>{$links[nr].link_status}</td>
		<td><a href = "{$my_pligg_base}/story.php?title={$links[nr].link_title_url}" target="_blank">{$links[nr].link_title}</a></td>
		<td><center><input type="radio" name="link[{$links[nr].link_id}]" id="link-{$links[nr].link_id}" value="publish"></center></td>
		<td><center><input type="radio" name="link[{$links[nr].link_id}]" id="link-{$links[nr].link_id}" value="queued"></center></td>
		<td><center><input type="radio" name="link[{$links[nr].link_id}]" id="link-{$links[nr].link_id}" value="discard"></center></td>
	</tr>	
	{/section}
</table>
<br/>
<p align="right"><input type="submit" name="submit" value="Change Status" class="log2" /></p>
<input type="hidden" name="user" value="{$user}">
</form>

<center><a href="javascript:mark_all_publish()">Mark all for Published</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:mark_all_queued()">Mark all for Queued</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:mark_all_discard()">Mark all for Discarded</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:uncheck_all()">Uncheck All</a></center>

<br/>
{php} 
Global $db, $main_smarty, $rows, $offset;
do_pages($rows, 25, $the_page); 
{/php}

<br/>
</fieldset>


{literal}
<SCRIPT>
function mark_all_publish() {
	for (var i=0; i< document.bulk_moderate.length; i++) {
		if (document.bulk_moderate[i].value == "publish") {
			document.bulk_moderate[i].checked = true;
		}
	}
}
function mark_all_discard() {
	for (var i=0; i< document.bulk_moderate.length; i++) {
		if (document.bulk_moderate[i].value == "discard") {
			document.bulk_moderate[i].checked = true;
		}
	}
}
function mark_all_queued() {
	for (var i=0; i< document.bulk_moderate.length; i++) {
		if (document.bulk_moderate[i].value == "queued") {
			document.bulk_moderate[i].checked = true;
		}
	}
}
function uncheck_all() {
	for (var i=0; i< document.bulk_moderate.length; i++) {
		if ((document.bulk_moderate[i].value == "queued")||(document.bulk_moderate[i].value == "discard")|| (document.bulk_moderate[i].value == "publish")){
			document.bulk_moderate[i].checked = false;
		}
	}
}
</SCRIPT>
{/literal}