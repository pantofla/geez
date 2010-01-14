<fieldset><legend>{#PLIGG_Visual_Ban_This_URL#}</legend>
	{if $errorText neq ""}
		<br /><center><span class="error">{$errorText}</span></center><br/><br/>
	{else}	
		<h3>{#PLIGG_Visual_This_Will_Ban#}"{$domain_to_ban}." {#PLIGG_Visual_Are_You_Sure#}</h3>
		<br/>&nbsp;<a href = "?id={$story_id}&doban={$domain_to_ban}">{#PLIGG_Visual_Ban_Link_Yes#}</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="javascript:history.back()">{#PLIGG_Visual_Ban_Link_No#}</a>
	{/if}
</fieldset>