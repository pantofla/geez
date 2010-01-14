<div id="categories">
{checkActionsTpl location="tpl_widget_categories_start"}
	<ul class="dropdown dropdown-horizontal">
		{section name=thecat loop=$cat_array start=$start}
				{if $lastspacer eq ""}
					{assign var=lastspacer value=$cat_array[thecat].spacercount}
				{/if}
			{if $cat_array[thecat].spacercount lt $lastspacer}{$cat_array[thecat].spacerdiff|repeat_count:'</ul>'}{/if}
			<li{if $cat_array[thecat].principlecat neq 0} class="dir"{/if}>			
			<a href="{if $pagename eq "upcoming"}{$URL_queuedcategory, $cat_array[thecat].safename}{else}{$URL_maincategory, $cat_array[thecat].safename}{/if}">{$cat_array[thecat].name}</a>
			{if $cat_array[thecat].principlecat eq 0}</li>{else}<ul>{/if}						
			{assign var=lastspacer value=$cat_array[thecat].spacercount}
		{/section}
		</ul>
{checkActionsTpl location="tpl_widget_categories_end"}
	</ul>
</div>