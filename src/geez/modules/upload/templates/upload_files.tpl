{config_load file=upload_lang_conf}

<h3>{#PLIGG_Upload_Attach#}</h3>
({$upload_extensions} {#PLIGG_Upload_Extensions_Allowed#})<br>

{section name=files start=0 loop=$upload_maxnumber step=1}
    {#PLIGG_Upload_Upload#}: <input size='10' type='file' name='upload_files[]'>
    {if $upload_external}
	{#PLIGG_Upload_OR#} {#PLIGG_Upload_Link#}: <input type='text' name='upload_urls[]' value='http://'>
    {/if}
    <br>
{/section}

{config_load file=upload_pligg_lang_conf}