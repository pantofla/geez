<div class="pagewrap">
<div style="margin: 0px 0px 10px; padding: 10px 0px" align="center">
{literal}

<script type="text/javascript"><!--
google_ad_client = "pub-5074133216375147";
/* 468x60, created 4/27/09 */
google_ad_slot = "3227571204";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
{/literal}
</div>
{checkActionsTpl location="tpl_pligg_topusers_start"}
<table>
	<tr>

		{foreach from=$headers item=header key=number}
			<th>
				{ if $number eq $templatelite.GET.sortby }
					<span>{$header}</span>
				{ else }
					<a href="?sortby={$number}">{$header}</a>
				{ /if }
			</th>
		{/foreach}

		<th>
			{#PLIGG_Visual_TopUsers_TH_Karma#}
		</th>
	</tr>

	{$users_table}

</table>
{checkActionsTpl location="tpl_pligg_topusers_end"}
</div>

<br />
{checkActionsTpl location="tpl_pligg_pagination_start"}
{$topusers_pagination}
{checkActionsTpl location="tpl_pligg_pagination_end"}
<div style="margin: 0px 0px 10px; padding: 10px 0px" align="center">
{literal}

<script type="text/javascript"><!--
google_ad_client = "pub-5074133216375147";
/* 468x60, created 4/27/09 */
google_ad_slot = "9734887712";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
{/literal}
</div>