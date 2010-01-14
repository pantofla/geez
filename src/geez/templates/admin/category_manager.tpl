<div id = "catmanager" >
<fieldset><legend><img src="{$my_pligg_base}/templates/admin/images/manage_cat.gif" align="absmiddle" /> {#PLIGG_Visual_AdminPanel_Category_Manage#}</legend>
<br />
<table dir="{#PLIGG_Visual_Language_Direction#}" style="border:none; width:auto;">
	{section name=thecat loop=$cat_array start=1}
	{if $cat_array[thecat].auto_id neq 0}
		{* show the grey box above the category *}
			<tr style="border:none">	
				{$cat_array[thecat].spacercount|repeat_count:'<td></td>'}
				<td style="border:1px solid #ccc; background:#eee">
					<div id = "above_{$cat_array[thecat].auto_id}">
						&nbsp;
					</div>
				</td>
			</tr>
		{* show the grey box above the category *}

		<tr style="border:none;">	
			{$cat_array[thecat].spacercount|repeat_count:'<td></td>'}
			<td>
				<div id = "cat_drop_{$cat_array[thecat].auto_id}">
				<div id = "cat_drag_{$cat_array[thecat].auto_id}">
					{*$cat_array[thecat].name*}
						
					<a href = "javascript://" onclick="var replydisplay=document.getElementById('{$cat_array[thecat].auto_id}').style.display ? '' : 'none'; document.getElementById('{$cat_array[thecat].auto_id}').style.display = replydisplay;">{#PLIGG_Visual_View_Category_Name#}</a>:
					<span id="catname_{$cat_array[thecat].auto_id}" style="color: #{$cat_array[thecat].color}"><b>{eipItem item="qeip_CatName" unique=$cat_array[thecat].auto_id ShowJS=TRUE}</b></span>
						
					<div id="{$cat_array[thecat].auto_id}" style="display:none">
						ID: {$cat_array[thecat].auto_id}<br />
						{*
							Parent: {eipItem item=qeip_CatParent unique=$cat_array[thecat].auto_id ShowJS=TRUE} -- {$cat_array[thecat].parent_name}<br />
							Sort Order: {eipItem item=qeip_CatOrder unique=$cat_array[thecat].auto_id ShowJS=TRUE}<br />
							Items in this category: -coming soon- <br />
						*}
						{#PLIGG_Visual_AdminPanel_Category_Meta_Desc#}: {eipItem item=qeip_CatDesc unique=$cat_array[thecat].auto_id ShowJS=TRUE}<br />
						{#PLIGG_Visual_AdminPanel_Category_Meta_Keywords#}: {eipItem item=qeip_CatMeta unique=$cat_array[thecat].auto_id ShowJS=TRUE}<br />
						{#PLIGG_Visual_AdminPanel_Category_Author_Level#}: {eipItem item=qeip_CatAuthor unique=$cat_array[thecat].auto_id ShowJS=TRUE}<br />
						{#PLIGG_Visual_AdminPanel_Category_Author_Group#}: {eipItem item=qeip_CatGroup unique=$cat_array[thecat].auto_id ShowJS=TRUE}<br />
						<a href = "admin_categories.php?action=remove&id={$cat_array[thecat].auto_id}"  onclick="return confirm('{#PLIGG_Visual_View_User_Reset_Pass_Confirm#}')">{#PLIGG_Visual_View_Category_Delete#}</a><br />
					</div>

				</div>
				</div>
			</td>
		</tr>

		{* show the grey box below the category *}
			<tr>	
				{$cat_array[thecat].spacercount|repeat_count:'<td></td>'}
				<td style="border:1px solid #ccc; background:#eee">
					<div id = "below_{$cat_array[thecat].auto_id}">
						&nbsp;
					</div>
				</td>
			</tr>
		{* show the grey box below the category *}

		{* setup the drag/drop *}
		<script language="javascript" type="text/javascript">
			var drag_{$cat_array[thecat].auto_id} = new Draggable('cat_drag_{$cat_array[thecat].auto_id}',{ldelim}revert:true{rdelim});

			Droppables.add('cat_drop_{$cat_array[thecat].auto_id}', {ldelim}
	   		onDrop: function(element, droppableElement) 
		     		{ldelim} document.getElementById('catmanager').innerHTML = '<br />Please Wait...'; window.location='admin_categories.php?action=changeparent&id=' + element.id + '&parent=' + droppableElement.id; {rdelim}{rdelim});			

			Droppables.add('above_{$cat_array[thecat].auto_id}', {ldelim}
	   		onDrop: function(element, droppableElement) 
		     		{ldelim} document.getElementById('catmanager').innerHTML = '<br />Please Wait...'; window.location='admin_categories.php?action=move_above&moveabove_id=' + droppableElement.id + '&id_to_move=' + element.id; {rdelim}{rdelim});			

			Droppables.add('below_{$cat_array[thecat].auto_id}', {ldelim}
	   		onDrop: function(element, droppableElement) 
		     		{ldelim} document.getElementById('catmanager').innerHTML = '<br />Please Wait...'; window.location='admin_categories.php?action=move_below&movebelow_id=' + droppableElement.id + '&id_to_move=' + element.id; {rdelim}{rdelim});			
		</script>
		{* setup the drag/drop *}
	{/if}
	{/section}
</table>

<br /><br />
<img src="{$my_pligg_base}/templates/admin/images/new_cat.gif" align="absmiddle" /> <a href = "?action=add">{#PLIGG_Visual_View_Category_Add#}</a>
<hr/>
<h2>URL Method 2</h2>
<a href="admin_categories.php?action=htaccess" rel="width:250,height:250" class="mb" target="_blank">{#PLIGG_Visual_AdminPanel_URL_Method_2_Click#}</a> {#PLIGG_Visual_AdminPanel_URL_Method_2_Rename#}
<br />
{#PLIGG_Visual_AdminPanel_Rewrite_Desc_1#} <a href="{$my_pligg_base}/admin/admin_config.php?page=UrlMethod">{#PLIGG_Visual_AdminPanel_URL_Method_2#}</a>{#PLIGG_Visual_AdminPanel_Rewrite_Desc_2#}</b><br /><br/>
RewriteRule ^({section name=thecat loop=$cat_array}{$cat_array[thecat].safename}{if $templatelite.section.thecat.iteration neq $cat_count}|{/if}{/section})/([^/]+)/?$ story.php?title=$2 [L]<br />
RewriteRule ^({section name=thecat loop=$cat_array}{$cat_array[thecat].safename}{if $templatelite.section.thecat.iteration neq $cat_count}|{/if}{/section})/?$ ?category=$1 [L]
<br/><br />

{php}echo "<span><a onclick=\"new Effect.toggle('help','appear', {queue: 'end'}); \"><img src=\"".my_pligg_base."/templates/admin/images/help.gif\" align=\"absmiddle\" /> </a></span>";{/php}
	<div id="help" style="display:none;padding:4px 4px 4px 4px">	
	<hr />
		<ul>
			<li>{#PLIGG_Visual_AdminPanel_Cat_Help_1#}</li>
			<li>{#PLIGG_Visual_AdminPanel_Cat_Help_2#}</li>
			<li>{#PLIGG_Visual_AdminPanel_Cat_Help_3#}</li>
			<li>{#PLIGG_Visual_AdminPanel_Cat_Help_4#}</li>
			<li>{#PLIGG_Visual_AdminPanel_Cat_Help_5#}</li>
		<ul>
	</div>
	
<br />
</fieldset>
</div>

{*
			       drag_{$cat_array[thecat].auto_id}.destroy();
*}
