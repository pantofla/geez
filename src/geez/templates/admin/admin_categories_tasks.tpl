<fieldset><table>
	<form id="catcheckboxform" name="catcheckboxform" action="admin_categories_tasks.php" method="post">
	<th>#</th><th><input name="allbox" type="checkbox" id="allbox" onClick="checkAll()"></th><th>{#PLIGG_Visual_AdminPanel_Category_Categories#}</th><th>{#PLIGG_Visual_AdminPanel_Category_Add_Sub#}</th><th>{#PLIGG_Visual_AdminPanel_Category_Order#}</th><th>{#PLIGG_Visual_AdminPanel_Category_Parent#}</th><th>{#PLIGG_Visual_AdminPanel_Category_Edit#}</th><th>{#PLIGG_Visual_AdminPanel_Category_Delete#}</th>
		<span id="nav-secondary">
			<span>
				{assign var=parent_cat_name value='all'}
				{section name=thecat loop=$cat_array}
					{assign var=my_var value=0}
					{if $cat_array[thecat].id neq 0}
						<tr id = "catid-{$cat_array[thecat].id}" class="{$lastspacer}">
							<td>
								{assign var=my_var_prev value=$cat_array[thecat].id}
								
								{$cat_array[thecat].id}
							</td>
							<td>
								<input type="checkbox" id="catcheckbox[{$cat_array[thecat].id}]" name="catcheckbox[{$cat_array[thecat].id}]" >
							</td>
							<td>
								{if $lastspacer eq ""}
									{assign var=lastspacer value=$cat_array[thecat].spacercount}
								{/if}
								{if $cat_array[thecat].spacercount lt $lastspacer}{$cat_array[thecat].spacerdiff|repeat_count:'</span>'}{/if}
								{if $cat_array[thecat].spacercount gt $lastspacer}<span>{/if}
								
								{* Store the parent name to use later *}
								{if $cat_array[thecat].parent eq 0}
									{assign var=parent_cat_name value=$cat_array[thecat].name}
								{/if}
								
								{if $cat_array[thecat].parent neq 0}&nbsp;&nbsp;&nbsp;{if $cat_array[thecat].leftrightdiff neq 1}&nbsp;&nbsp;&nbsp;{/if}<b style="font-size:20px;">L</b>{/if}
								{$cat_array[thecat].name}
								{*$lastspacer*}
								{assign var=lastspacer value=$cat_array[thecat].spacercount}
								
								<div style="display:none;" id="edit_cat-{$cat_array[thecat].id}">
									{*<form action="admin_categories_tasks.php" method="post" name="thisform" id="thisform" enctype="multipart/form-data">*}
										<input type="text" name = "cat_edit_title" id = "cat_edit_title" class="eip_editable" value="{$cat_array[thecat].safename}" />
										<input type="hidden" value="editcat" id="action" name="action"/>
										<input type="hidden" value="{$cat_array[thecat].id}" id="editcatid" name="editcatid"/>
										<input type="submit" value="save" />
									{*</form>*}
								</div>
								
							</td>
							<td>
								<span><a href="javascript://" onClick="add_subcat({$cat_array[thecat].id})">{#PLIGG_Visual_AdminPanel_Category_Add_Sub#}</a></span>
							</td>
							<td>
								{if $cat_array[thecat].order neq 0}
									<a href = "admin_categories_tasks.php?action=move_up&id_to_move={$cat_array[thecat].id}&order={$cat_array[thecat].order}"><img src="{$my_pligg_base}/templates/admin/images/uparrow.png"></a>
								{else}
									&nbsp;&nbsp;&nbsp;&nbsp;
								{/if}
								<a href = "#"><img src="{$my_pligg_base}/templates/admin/images/downarrow.png"></a>
								<input style="text-align:center;" type="text" size="5" name="catorder" id="catorder" value="{$cat_array[thecat].order}">
							</td>
							{if $cat_array[thecat].parent neq 0}
								<td>
									{$parent_cat_name}
								</td>
							{else}
								<td>
									All
								</td>
							{/if}
							<td>
								<span><a href="javascript://" onClick="edit_cat({$cat_array[thecat].id},'{$cat_array[thecat].safename}')">Edit</a></span>
							</td>
							<td>
								<span><a href="admin_categories_tasks.php?action=delete&id={$cat_array[thecat].id}"><img src="{$my_pligg_base}/templates/admin/images/delete.png"></a></span>
							</td>
						</tr>
					{/if}
				{/section}
			</span>
		</span>
	</form>
</table></fieldset>

<fieldset><table>
<a href="javascript://" onclick="var replydisplay=document.getElementById('add_maincat-1').style.display ? '' : 'none';document.getElementById('add_maincat-1').style.display = replydisplay;">{#PLIGG_Visual_AdminPanel_Category_Add_Main#}</a> &nbsp;&nbsp;|&nbsp;&nbsp;
<a href="admin_categories_tasks.php?action=deletebulk">{#PLIGG_Visual_AdminPanel_Category_Delete_Selected#}</a>
</table></fieldset>

<div id="add_maincat-1" style="display:none;">
	<fieldset><table>
		<form action="admin_categories_tasks.php" method="post" name="thisform" id="thisform" enctype="multipart/form-data">
			<label style="font-weight:bold">{#PLIGG_Visual_AdminPanel_Category_Main#} : </label>
			<input type="text" id="cat_title" class="text" name="cat_title" size="60" maxlength="120"/>
			<input type="hidden" value="add" id="action" name="action"/>
			<input type="submit" value="{#PLIGG_Visual_AdminPanel_Category_Add_Main#}" />
		</form>
	</table></fieldset>
</div>

<div id="add_subcat-1" style="display:none;">
	<fieldset><table>
		<form action="" onmethod="post" name="thisform" id="thisform" enctype="multipart/form-data">
			<label style="font-weight:bold">{#PLIGG_Visual_AdminPanel_Category_Sub#} : </label>
			<input type="text" id="sub_cat_title" class="text" name="cat_title" size="60" maxlength="120"/>
			<input type="hidden" value="addsubcat" id="action" name="action"/>
			<input type="hidden" value="" id="category_id" name="category_id"/>
			<input type="submit" value="{#PLIGG_Visual_AdminPanel_Category_Add_Sub#}" /><br/>
			<span id="sub_cat_alert"></span>
		</form>
	</table></fieldset>
</div>


{literal}
<script type="text/javascript" >
	function add_subcat(cat_id){
		document.getElementById('category_id').value=cat_id;
		var replydisplay=document.getElementById('add_subcat-1').style.display ? '' : 'none';document.getElementById('add_subcat-1').style.display = replydisplay;
	}
	function edit_cat(cat_id, cat_name)
	{
		//alert(cat_id);
		//alert(cat_name);
		var idname = 'edit_cat'+cat_id;
		//alert(idname);
		var replydisplay=document.getElementById('edit_cat-'+cat_id).style.display ? '' : 'none';document.getElementById('edit_cat-'+cat_id).style.display = replydisplay;
	}
	function togglechecked(){
		for (var i = 0; i < document.catcheckboxform.elements.length; i++) {
			var e = document.catcheckboxform.elements[i];
			if ((e.checked == true) && (e.type == 'checkbox')) {
				e.checked = false;
			}
			else
			{
				e.checked = true;
				alert('clicked');
			}
		}
	}
	function toggleselect(){ 
		document.catcheckboxform.allbox.checked = !document.catcheckboxform.allbox.checked;
		togglechecked();
	}
	function checkAll(){
		for (var i=0;i<document.forms[0].elements.length;i++)
		{
			var e=document.forms[0].elements[i];
			if ((e.name != 'allbox') && (e.type=='checkbox'))
			{
				e.checked=document.forms[0].allbox.checked;
			}
		}
	}
</script>
{/literal}
<script src="{$my_pligg_base}/templates/xmlhttp.php" type="text/javascript"></script>