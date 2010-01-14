{literal}
<style type="text/css">
table	{border:0;border-collapse:collapse;}
td		{padding:4px;border:1px solid #efefef;}
th		{font-weight:bold;}
</style>
{/literal}

<fieldset><legend><img src="{$my_pligg_base}/templates/admin/images/page.gif" align="absmiddle" /> {#PLIGG_Visual_AdminPanel_Manage_Pages#}</legend>
	<table id="sortable" class="tablesort">
		<thead>
			<tr>
				<th width="65%">{#PLIGG_Visual_AdminPanel_Page_Submit_Title#}</th>
				<th width="15%">{#PLIGG_Visual_AdminPanel_Page_Edit#}</th>
				<th width="20%">{#PLIGG_Visual_AdminPanel_Page_Delete#}</th>
			</tr>
		</thead>
		<tbody>
		{$page_title}
		</tbody>
	</table>

	{literal}
	<script type="text/javascript">
		window.addEvent( 'domready', function(){
		  new SortingTable( 'sortable' );
		});
	</script>
	{/literal}

{$page_text}

<br />
<br />


{literal}
<script language="javascript">
<!--

function NewPage() {
  document.location.href= "{/literal}{$my_base_url}{$my_pligg_base}/admin/submit_page.php{literal}"
}

//-->
</script>
{/literal}


<input type="button" class="bigbutton" value="{#PLIGG_Visual_AdminPanel_Page_Submit_New#}" onClick="NewPage()">

</fieldset>