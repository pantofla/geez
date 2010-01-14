<fieldset><legend><img src="{$my_pligg_base}/templates/admin/images/news_manage.gif" align="absmiddle" /> {#PLIGG_Visual_AdminPanel_Links#}</legend>

<form action="{$my_pligg_base}/admin/admin_links.php" method="get">
	<select name="filter">
                <option value="all" {if isset($templatelite.get.filter) && $templatelite.get.filter eq "all"} selected="selected" {/if}>{#PLIGG_Visual_AdminPanel_All#}</option>
                <option value="published" {if isset($templatelite.get.filter) && $templatelite.get.filter eq "published"} selected="selected" {/if}>{#PLIGG_Visual_AdminPanel_Published#}</option>
                <option value="upcoming" {if isset($templatelite.get.filter) && $templatelite.get.filter eq "upcoming"} selected="selected" {/if}>{#PLIGG_Visual_AdminPanel_Upcoming#}</option>
                <option value="discard" {if isset($templatelite.get.filter) && $templatelite.get.filter eq "discard"} selected="selected" {/if}>{#PLIGG_Visual_AdminPanel_Discarded#}</option>
		<option>   ---   </option>
                <option value="today" {if isset($templatelite.get.filter) && $templatelite.get.filter eq "today"} selected="selected" {/if}>{#PLIGG_Visual_AdminPanel_Today#}</option>
                <option value="yesterday" {if isset($templatelite.get.filter) && $templatelite.get.filter eq "yesterday"} selected="selected" {/if}>{#PLIGG_Visual_AdminPanel_Yesterday#}</option>
                <option value="week" {if isset($templatelite.get.filter) && $templatelite.get.filter eq "week"} selected="selected" {/if}>{#PLIGG_Visual_AdminPanel_Week#}</option>
	</select>
	<input type="submit" value="Filter" class="log2">
</form>

<form action="{$my_pligg_base}/admin/admin_links.php" method="get">
	<input type="hidden" name="mode" value="search">
                {if isset($templatelite.get.keyword) && $templatelite.get.keyword neq ""}
			{assign var=searchboxtext value=$templatelite.get.keyword|sanitize:2}
	{else}
			{assign var=searchboxtext value=#PLIGG_Visual_Search_SearchDefaultText#}			
	{/if}	
	<input type="text" name="keyword" value="{$searchboxtext}" onfocus="if(this.value == '{$searchboxtext}') {ldelim}this.value = '';{rdelim}" onblur="if (this.value == '') {ldelim}this.value = '{$searchboxtext}';{rdelim}">
	<input type="submit" value="{#PLIGG_Visual_Search_Go#}" class="log2">
</form>

<form action="{$my_pligg_base}/admin/admin_links.php" method="get">
	{#PLIGG_Visual_AdminPanel_Pagination_Items#}
	<select name="pagesize">
		<option {if isset($pagesize) && $pagesize == 15}selected{/if}>15</option>
		<option {if isset($pagesize) && $pagesize == 30}selected{/if}>30</option>
		<option {if isset($pagesize) && $pagesize == 50}selected{/if}>50</option>
		<option {if isset($pagesize) && $pagesize == 100}selected{/if}>100</option>
		<option {if isset($pagesize) && $pagesize == 150}selected{/if}>150</option>
		<option {if isset($pagesize) && $pagesize == 200}selected{/if}>200</option>
	</select>
	<input type="submit" value="Go" class="log2">
</form>

<form name="bulk_moderate" action="{$my_pligg_base}/admin/admin_links.php?action=bulkmod" method="post">
<table cellpadding="1" cellspacing="2" border="0">
	<tr><th>{#PLIGG_Visual_View_Links_Status#}</th><th>{#PLIGG_Visual_View_Links_Author#}</th><th>{#PLIGG_Visual_View_Links_New_Window#}</th><th><center>{#PLIGG_Visual_AdminPanel_Publish#}</center></th><th><center>{#PLIGG_Visual_AdminPanel_Upcoming#}</center></th><th><center>{#PLIGG_Visual_AdminPanel_Discard#}</center></th><th></th></tr>
	{section name=id loop=$template_stories}
	<tr>
		<td>{$template_stories[id].link_status}</td>
		<td><a href="{$my_pligg_base}/admin/admin_users.php?mode=viewlinks&user={$template_stories[id].link_author}" title="{$template_stories[id].link_author}'s Articles">{$template_stories[id].link_author}</a></td>
		<td><a href="{$my_pligg_base}/story.php?title={$template_stories[id].link_title_url}" rel="width:800,height:700" class="mb" title="{$template_stories[id].link_title}" >{$template_stories[id].link_title}</a></td>
		<td><center><input type="radio" name="link[{$template_stories[id].link_id}]" id="link-{$template_stories[id].link_id}" value="publish"></center></td>
		<td><center><input type="radio" name="link[{$template_stories[id].link_id}]" id="link-{$template_stories[id].link_id}" value="queued"></center></td>
		<td><center><input type="radio" name="link[{$template_stories[id].link_id}]" id="link-{$template_stories[id].link_id}" value="discard"></center></td>
		<td><center><a href='{$my_pligg_base}/editlink.php?id={$template_stories[id].link_id}' rel="width:800,height:700" class="mb">{#PLIGG_Visual_AdminPanel_Page_Edit#}</center></td>
	</tr>	
	{/section}		
</table>
<hr/>
<center>
<a href="javascript:mark_all_publish()">{#PLIGG_Visual_AdminPanel_Mark_Published#}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:mark_all_queued()">{#PLIGG_Visual_AdminPanel_Mark_Upcoming#}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:mark_all_discard()">{#PLIGG_Visual_AdminPanel_Mark_Discarded#}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:uncheck_all()">{#PLIGG_Visual_AdminPanel_Mark_Uncheck#}</a><br />
<a href="admin_delete_stories.php" rel="width:250,height:150" class="mb" title="{#PLIGG_Visual_AdminPanel_Delete_Stories#}" >{#PLIGG_Visual_AdminPanel_Delete_Stories#}</a>
</center>

<p align="right"><input type="submit" name="submit" value="Change Status" class="log2" /></p>
</form>


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