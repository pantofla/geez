<?php require_once('/home/pantofla/public_html/geez/plugins/function.eipItem.php'); $this->register_function("eipItem", "tpl_function_eipItem");  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 20:49:24 CDT */ ?>

<?php $this->config_load(rss_import_lang_conf, null, null); ?>


<?php echo smarty_function_feedsListFeeds(array('varname' => FeedList), $this);?>

<?php echo '
	<style type="text/css">
		.eip_editable { background-color: #ff9;border-left:0px;border-bottom:1px solid #828177;border-right:1px solid #828177; }
		.eip_savebutton { background-color: #36f; color: #fff; }
		.eip_cancelbutton { background-color: #000; color: #fff; }
		.eip_saving { background-color: #903; color: #fff; padding: 3px; }
		.eip_empty { color: #afafaf; }	
		.emptytext {padding:0px 4px;border-top:2px solid #828177;border-left:2px solid #828177;border-bottom:1px solid #B0B0B0;border-right:1px solid #B0B0B0;background:#F5F5F5;}
	</style>
'; ?>


<fieldset><legend><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/manage_rss.gif" align="absmiddle"/> <?php echo $this->_confs['PLIGG_RSS_Import']; ?>
</legend>

<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_go.gif" align="absmiddle"/><a href="module.php?module=rss_import_do_import"><strong>Import all feeds</strong></a>
<hr>
<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_add.gif" align="absmiddle"/> <a href="module.php?module=rss_import&action=addnewfeed"><strong>Add a new feed</strong></a>
<br />
<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_add.gif" align="absmiddle"/> 
<?php  echo "<a href=\"#\" onclick=\"new Effect.toggle('import','appear', {queue: 'end'});\"><strong>Import pre-built feed</strong></a>"; ?>

<div id="import" style="display:none">
	<br/>
	<form>
		<textarea rows=10 cols=70 name="prebuiltfeed"></textarea>
		<input type = "hidden" name="module" value="rss_import">
		<input type = "hidden" name="action" value="importprebuiltfeed_go">
		<br /><input type = "submit" value="Import Feed" class="log2">
	</form>
</div>

<hr/>

<?php echo '
<script>
function verify(){
    msg = "Are you absolutely sure that you want to delete this feed?";
    //all we have to do is return the return value of the confirm() method
    return confirm(msg);
    }
</script>
'; ?>


<?php if (count((array)$this->_vars['FeedList'])): foreach ((array)$this->_vars['FeedList'] as $this->_vars['feed_id']): ?>
	
  <b><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_bullet.gif" align="absmiddle"/> Feed Name: </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedName,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span><br>
	<div style="margin-left:30px">
	<b>Feed URL: </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedURL,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span><br>

	<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_go.gif" align="absmiddle"/> <a href = 
"module.php?module=rss_import&action=editfeed&feed_id=<?php echo $this->_vars['feed_id']; ?>
">Edit</a> &nbsp;

	<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_delete.gif" align="absmiddle"/> <a href = 
"module.php?module=rss_import&action=dropfeed&feed_id=<?php echo $this->_vars['feed_id']; ?>
" onClick="return verify()">Delete</a> &nbsp;
	
	<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_go.gif" align="absmiddle"/> <a href = 
"module.php?module=rss_import&action=exportfeed&feed_id=<?php echo $this->_vars['feed_id']; ?>
">Export</a> &nbsp;

	<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_go.gif" align="absmiddle"/> <a href = 
"module.php?module=rss_import&action=examinefeed&feed_id=<?php echo $this->_vars['feed_id']; ?>
">Examine</a> &nbsp;

	<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_go.gif" align="absmiddle"/> <a href = 
"module.php?module=rss_import_do_import&override=<?php echo $this->_vars['feed_id']; ?>
">Import</a> &nbsp;

	<br>
	</div>
	<hr>
	
<?php endforeach; endif; ?>
<br/>
</fieldset>
<?php $this->config_load(rss_import_pligg_lang_conf, null, null); ?>