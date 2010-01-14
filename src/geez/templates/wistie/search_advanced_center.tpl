<div class="pagewrap">
<fieldset>
<form method="get" action="{$URL_search}">
<div style="float:left;width:260px;padding-right:20px;text-align:right;">
<br />
<label>{#PLIGG_Visual_Search_Keywords#}:</label><br />
<small>{#PLIGG_Visual_Search_Keywords_Instructions#}</small><br />
<input name="search" type="text" size="40"/>
<br />

<label>{#PLIGG_Visual_Search_Story#}:</label><br />
	<select name="slink">
		<option value="3" selected="selected">{#PLIGG_Visual_Search_Story_Title_and_Description#}</option>
		<option value="1">{#PLIGG_Visual_Search_Story_Title#}</option>
		<option value="2">{#PLIGG_Visual_Search_Story_Description#}</option>												
	</select>

<br /><br />
	
<label>{#PLIGG_Visual_Search_Category#}:</label><br />
	<select name="scategory" >
		{$category_option}
	</select>

</div>
<div style="float:left;width:210px;text-align:right;">
<br />
	<label>{#PLIGG_Visual_Search_Comments#}:</label>
		<input type="radio" name="scomments" value="1" checked="checked" /> {#PLIGG_Visual_Search_Advanced_Yes#} &nbsp;&nbsp;<input type="radio" name="scomments" value="0" /> {#PLIGG_Visual_Search_Advanced_No#}
	<br />
	<label>{#PLIGG_Visual_Search_Tags#}:</label>
		<input type="radio" name="stags" value="1" checked="checked" /> {#PLIGG_Visual_Search_Advanced_Yes#} &nbsp;&nbsp;<input type="radio" name="stags" value="0" /> {#PLIGG_Visual_Search_Advanced_No#}
	<br />

	<label>{#PLIGG_Visual_Search_User#}:</label>
		<input type="radio" name="suser" value="1" /> {#PLIGG_Visual_Search_Advanced_Yes#} &nbsp;&nbsp;<input type="radio" name="suser" value="0" checked="checked" /> {#PLIGG_Visual_Search_Advanced_No#}
	
<br /><br />
<label>{#PLIGG_Visual_Search_Group#}:</label>
	<select name="sgroup">
		<option value="3" selected="selected">{#PLIGG_Visual_Search_Group_Named_and_Description#}</option>
		<option value="1">{#PLIGG_Visual_Search_Group_Name#}</option>
		<option value="2">{#PLIGG_Visual_Search_Group_Description#}</option>												
	</select>
	
</div><br style="clear:both;" /><br />
	<input name="adv" type="hidden" value="1" />		
	<input name="advancesearch" value="&nbsp;Search&nbsp; " type="submit" class="log2" />


</form>
</fieldset>
</div>