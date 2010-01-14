{*Eval here*}
{foreach from=$snippet_actions_tpl item=snippet}
{*$snippet.snippet_location*}
    {if $snippet.snippet_location == $location}
{*$snippet.snippet_content*}
	{eval var=$snippet.snippet_content}
    {/if}
{/foreach}
