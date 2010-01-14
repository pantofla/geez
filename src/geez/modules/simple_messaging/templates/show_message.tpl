{config_load file=simple_messaging_lang_conf}

{literal}
	<style type="text/css">
		table td { background:none }
	</style>
{/literal}

<p>
	<table style="border:none;" cellspacing="5">
		<tr>
			<td align="right" style="color:#999999">{#PLIGG_MESSAGING_From#}:</td><td><b> {$msg_array.sender_name}</b></td>
		</tr>

		<tr>
			<td align="right" style="color:#999999">{#PLIGG_MESSAGING_Sent#}:</td><td><b>{$msg_array.date}</b></td>
		</tr>
		
		<tr>
			<td align="right" style="color:#999999">{#PLIGG_MESSAGING_Subject#}:</td><td><b> {$msg_array.title}</b></td>
		</tr>
		
		<tr>
			<td align="right" style="color:#999999">{#PLIGG_MESSAGING_Message#}:</td><td><b> {$msg_array.body}</b></td>
		</tr>
	</table>
	
	<br /><br />

	<hr />
	<br />
	<center>
		<a href="{$URL_simple_messaging_reply}{$msg_id}">{#PLIGG_MESSAGING_Reply#}</a> <a href="{$URL_simple_messaging_reply}{$msg_id}"><img src="{$simple_messaging_path}images/reply.png" align="absmiddle" /></a> | 
		<a href="{$URL_simple_messaging_delmsg}{$msg_id}">{#PLIGG_MESSAGING_Delete#}</a> <a href="{$URL_simple_messaging_delmsg}{$msg_id}"><img src="{$simple_messaging_path}images/delete.png" align="absmiddle" /></a> | 
		<a href="{$URL_simple_messaging_inbox}">{#PLIGG_MESSAGING_Close#}</a> <a href="{$URL_simple_messaging_inbox}"><img src="{$simple_messaging_path}images/cross.png" align="absmiddle" /></a>
	</center>
</p>

{config_load file=simple_messaging_pligg_lang_conf}
