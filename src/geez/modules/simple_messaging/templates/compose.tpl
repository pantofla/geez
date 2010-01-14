{config_load file=simple_messaging_lang_conf}

<table border="0" width="536" height="424">
	<tr>
		<td height="20" width="536" colspan="2" align="left" valign="top">	<form method="get" action="module.php">
		<input type = "hidden" name="module" value="simple_messaging">
		<input type = "hidden" name="return" value="{$return}">
	
		<label><b>*{#PLIGG_MESSAGING_Subject#}:</b></label>
		<label><input id="msg_subject" name="msg_subject" type="text" value="{$msg_subject}" class="f-name" tabindex="1" required="yes"></label>
</td>
	</tr>
	<tr>
		<td height="20" width="345" align="left" valign="top">		<label><b>*{#PLIGG_MESSAGING_Message#}:</b></label>
		</td>
		<td height="20" width="175" align="left" valign="top" rowspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td height="250" width="345" align="left" valign="top"><label><textarea id="msg_body" name="msg_body" tabindex="2" rows="8" cols="44" requied="yes" /></textarea></label>

		<input type = "submit" name="view" value="{#PLIGG_MESSAGING_Send#}" tabindex="3">
		<input type = "hidden" name="msg_to" id="msg_to" value="{$msgToName}">
	</form></td>
	</tr>
</table>

{config_load file=simple_messaging_pligg_lang_conf}