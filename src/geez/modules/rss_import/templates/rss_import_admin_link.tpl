{config_load file=rss_import_lang_conf}
<li><a href="{$URL_admin_language}">{#PLIGG_RSS_Import#}</a></li>
{* this is a temporary fix. When you load a new config file the existing config gets dropped. *}
{config_load file=rss_import_pligg_lang_conf}
