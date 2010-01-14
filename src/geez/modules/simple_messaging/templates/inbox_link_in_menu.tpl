	              {if $user_authenticated eq true}
                	<div class="links">
	            	<div class="sectiontitle">

{config_load file=$simple_messaging_lang_conf}
{* note: currently the "new" count only appears on index because thats the only page that checks to see if there are new messages *}
{* so it will have to be re-worked *}

	<a href="{$URL_simple_messaging_inbox}" class="main">
		<span>{#PLIGG_MESSAGING_Inbox#} {if $msg_new_count gt 0}({$msg_new_count} {#PLIGG_MESSAGING_New#}){/if} </span>
	</a>

{* this is a temporary fix. When you load a new config file the existing config gets dropped. *}
{config_load file="/languages/lang_".$pligg_language.".conf"}


</div>
	            </div>
	            {/if}