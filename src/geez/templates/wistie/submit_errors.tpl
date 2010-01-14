{*Step 2 Errors*}

<fieldset>

{if $submit_error eq 'invalidurl'}
	<p class="error">{#PLIGG_Visual_Submit2Errors_InvalidURL#}: ({$submit_url})</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="{#PLIGG_Visual_Submit2Errors_Back#}" class="submit">
	</form>
{/if}

{if $submit_error eq 'dupeurl'}
	<p class="error">{#PLIGG_Visual_Submit2Errors_DupeArticleURL#}: {$submit_url}</p>
	<p>{#PLIGG_Visual_Submit2Errors_DupeArticleURL_Instruct#}</p>
	<p><a href="{$submit_search}"><strong>{#PLIGG_Visual_Submit2Errors_DupeArticleURL_Instruct2#}:</strong></a></p>
	<br style="clear: both;" /><br style="clear: both;" />
	<form id="thisform">
		<input type=button onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="{#PLIGG_Visual_Submit2Errors_Back#}" class="submit" />
	</form>
{/if}

{*Step 3 Errors*}

{if $submit_error eq 'badkey'}
	<p class="error">{#PLIGG_Visual_Submit3Errors_BadKey#}</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="submit" />
	</form>
{/if}

{if $submit_error eq 'hashistory'}
	<p class="error">{#PLIGG_Visual_Submit3Errors_HasHistory#}: {$submit_error_history}</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="submit" />
	</form>
{/if}

{if $submit_error eq 'urlintitle'}
	<p class="error">{#PLIGG_Visual_Submit3Errors_URLInTitle#}</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="submit" />
	</form>
{/if}

{if $submit_error eq 'incomplete'}
	<p class="error">{#PLIGG_Visual_Submit3Errors_Incomplete#}</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="submit" />
	</form>
{/if}

{if $submit_error eq 'nocategory'}
	<p class="error">{#PLIGG_Visual_Submit3Errors_NoCategory#}</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="submit" />
	</form>
{/if}
{if $submit_error eq 'register_captcha_error'}
	<p class="error">The answer provided is not correct. Please try again.</p>
	<br/>
	<form id="thisform">
		<input type="button" onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="{#PLIGG_Visual_Submit3Errors_Back#}" class="submit" />
	</form>
{/if}
</fieldset>
