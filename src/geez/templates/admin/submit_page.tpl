<fieldset><legend><img src="{$my_pligg_base}/templates/admin/images/page.gif" align="absmiddle" /> {#PLIGG_Visual_AdminPanel_Page_Submit#}</legend>	
	<form action="" method="POST" id="thisform">
		<label>{#PLIGG_Visual_AdminPanel_Page_Submit_Title#} : </label><input type="text" name="page_title" id="page_title" size="66"/>
		<br />
		<textarea id="textarea-1" name="page_content" class="page_content" rows="30" style="width:800px">{$page_content}</textarea>	
		<br style="clear:both" /><br />
		<input type="submit" name="submit" value="{#PLIGG_Visual_AdminPanel_Page_Submit#}" class="log2 bigbutton" />
		<input type="hidden" name="process" value="new_page" />
		<input type="hidden" name="randkey" value="{$randkey}" />
	</form>
	<br />
	<hr />
		<p>{#PLIGG_Visual_AdminPanel_Page_HTML#}</p>
		<p>{#PLIGG_Visual_AdminPanel_Page_Smarty#}</p>
</fieldset>