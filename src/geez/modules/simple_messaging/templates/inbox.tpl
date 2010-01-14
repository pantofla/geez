{config_load file=simple_messaging_lang_conf}

<br>

{* table to display messages *}
<form name="bulk_moderate" action="{$my_pligg_base}/user.php?view=inbox&action=bulkmod" method="post">
<table class="listing">
	<tr><th>{#PLIGG_MESSAGING_From#}</th><th>{#PLIGG_MESSAGING_Subject#}</th><th>{#PLIGG_MESSAGING_Sent#}</th>{*<th><center>Delete</center></th>*}</tr>
	
	{if $msg_array neq ""}

	{section name=themessage loop=$msg_array}
		<tr id="msg_row_{$msg_array[themessage].id}">
			<td>{$msg_array[themessage].sender_name}</td>
			<td>
				{if $msg_array[themessage].readed eq 0}<b> <img src="{$simple_messaging_path}images/new.png" align="absmiddle" /> </b>&nbsp;{/if}
				<a href="{$URL_simple_messaging_viewmsg}{$msg_array[themessage].id}">
					{$msg_array[themessage].title}
				</a>
			</td>
			<td>{$msg_array[themessage].date}</td>
			{*<td><center><input type="checkbox" name="message[{$msg_array[themessage].id}]" id="message-{$msg_array[themessage].id}" value="delete"></center></td>*}
		</tr>
	{/section}
	
	{else}
	
	<tr><td colspan="3"><center><b>{#PLIGG_MESSAGING_No_Messages#}</b></center></td></tr>
	
	{/if}
	
</table>
{*
	<br/>
	<p align="right"><input type="submit" name="submit" value="Delete Selected" class="log2" /></p>
*}
</form>

{config_load file=simple_messaging_pligg_lang_conf}
