{config_load file=upload_lang_conf}

<fieldset><legend> {#PLIGG_Upload#}</legend>
<p>{#PLIGG_Upload_Instructions_1#}</p>
<p>{#PLIGG_Upload_Instructions_2#}</p>
<br />


	<form action="" method="POST" id="thisform">
		<table border="0" cellspacing="8">
		<tr>
		<td width="250" colspan="2"><h2>{#PLIGG_Upload_Image#}: </h2></td>
		</tr>
		<tr>
		<td width="250" style="text-align:right"><label>{#PLIGG_Upload_Generate_Thumbnails#}:</label></td><td>
			<select name="upload_thumb">
			<option value='1' {if $settings.thumb}selected{/if}>On</option>
			<option value='0' {if !$settings.thumb}selected{/if}>Off</option>
			</select>
		</td>
		</tr>
		<tr>
		<td width="250" style="text-align:right"><label>{#PLIGG_Upload_Thumbnail_Sizes#}:</label></td><td>
			<table border=1 style='width: 200px;'>
			<tr><th>{#PLIGG_Upload_Max_Size#}</th><th>{#PLIGG_Upload_Delete#}</th></tr>
			{foreach from=$settings.sizes item=size}
			<tr><td>{$size}</td><td><input type='checkbox' name='delsize[]' value='{$size}'></td></tr>
			{/foreach}
			</table>
		</td>
		</tr>
		<tr>
		<td width="250" style="text-align:right"><label>{#PLIGG_Upload_Add_Size#}: </label></td><td>
			{#PLIGG_Upload_Width#} : <input type='text' name='upload_width' size=3>&nbsp;&nbsp;&nbsp;
			{#PLIGG_Upload_Height#}: <input type='text' name='upload_height' size=3><br>
		</td>
		</tr>
		<tr>
		<td width="250" style="text-align:right"><label>{#PLIGG_Upload_Thumbnail_Place#}:</label></td><td>
			<select name="upload_place">
				<option>{#PLIGG_Upload_Nowhere#}</option>
			{foreach from=$upload_places item=place}
				<option {if $settings.place==$place}selected{/if}>{$place}</option>
			{/foreach}
			</select>
		</td>
		</tr>
		<tr>
		<td width="250" style="text-align:right"><label>{#PLIGG_Upload_Thumbnail_Defsize#}:</label></td><td>
			<select name="upload_defsize">
				<option value='orig' {if $settings.defsize=='orig'}selected{/if}>{#PLIGG_Upload_Original_Image#}</option>
			{foreach from=$settings.sizes item=size}
				<option {if $settings.defsize==$size}selected{/if}>{$size}</option>
			{/foreach}
			</select>
		</td>
		</tr>
		<tr>
		<td width="250" style="text-align:right"><label>{#PLIGG_Upload_Allow_External#}:</label></td><td>
			<select name="upload_external">
			<option value='1' {if $settings.external}selected{/if}>Yes</option>
			<option value='0' {if !$settings.external}selected{/if}>No</option>
			</select>
		</td>
		</tr>
		<tr>
		<td width="250" style="text-align:right"><label>{#PLIGG_Upload_Thumbnail_Link#}: </label></td><td>
			<select name="upload_link">
			<option value='story' {if $settings.link=='story'}selected{/if}>{#PLIGG_Upload_Story_Page#}</option>
			<option value='orig' {if $settings.link=='orig'}selected{/if}>{#PLIGG_Upload_Original_Image#}</option>
			{foreach from=$settings.sizes item=size}
				<option value='{$size}' {if $settings.link==$size}selected{/if}>{#PLIGG_Upload_Another_Thumbnail#} ({$size})</option>
			{/foreach}
			</select>
		</td>
		</tr>

		<tr>
		<td width="250" colspan="2"><br /><br /><h2>{#PLIGG_Upload_General#}: </h2></td>
		</tr>
		<tr>
			<td width="250" style="text-align:right"><label>{#PLIGG_Upload_Storage_Directory#}:</label></td>
			<td><input type="text" name="upload_directory" id="upload_directory" size="66" value="{$settings.directory}" style="width: 420px;"/></td>
		</tr>
		<tr>
			<td width="250" style="text-align:right"><label>{#PLIGG_Upload_Thumbnail_Directory#}:</label></td>
			<td><input type="text" name="upload_thdirectory" id="upload_thdirectory" size="66" value="{$settings.thdirectory}" style="width: 420px;"/></td>
		</tr>
		<tr>
			<td width="250" style="text-align:right"><label>{#PLIGG_Upload_File_Size#}:</label></td>
			<td><input type="text" name="upload_filesize" id="upload_filesize" size="66" value="{$settings.filesize}" style="width: 50px;"/> Kb</td>
		</tr>
		<tr>
			<td width="250" style="text-align:right"><label>{#PLIGG_Upload_Max_Number#}:</label></td>
			<td><input type="text" name="upload_maxnumber" id="upload_maxnumber" size="66" value="{$settings.maxnumber}" style="width: 50px;"/></td>
		</tr>
		<tr>
			<td width="250" style="text-align:right"><label>{#PLIGG_Upload_File_Extensions#}:</label></td>
			<td><input type="text" name="upload_extensions" id="upload_extensions" size="66" value="{$settings.extensions}" style="width: 420px;"/></td>
		</tr>
		<tr>
		<td width="250" style="text-align:right"><label>{#PLIGG_Upload_Files_Place#}:</label></td><td>
			<select name="upload_fileplace">
				<option>{#PLIGG_Upload_Nowhere#}</option>
			{foreach from=$upload_places item=place}
				<option {if $settings.fileplace==$place}selected{/if}>{$place}</option>
			{/foreach}
			</select>
		</td>
		</tr>

		<tr><td width="250"></td><td><Br /><input type="submit" name="submit" value="{#PLIGG_Upload_Submit#}" class="log2" style="font-weight:bold;padding:2px 15px 2px 15px"/><br /><br /></td></tr>

		</table>
	</form>
</fieldset>

{config_load file=upload_pligg_lang_conf}
