<?php require_once('/home/pantofla/public_html/geez/plugins/function.eipItem.php'); $this->register_function("eipItem", "tpl_function_eipItem");  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-09 20:50:00 CDT */ ?>

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

<br />
<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_add.gif" align="absmiddle"/> 
<a href="<?php echo $this->_vars['my_pligg_base']; ?>
/module.php?module=rss_import">Back to Feeds Lists</a>

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


<?php if (count((array)$this->_vars['FeedList'])): foreach ((array)$this->_vars['FeedList'] as $this->_vars['feed_id']):  global $main_smarty; $main_smarty->assign('fid', $_GET['feed_id']);  if ($this->_vars['feed_id'] == $this->_vars['fid']): ?> 

<h2>Edit the feed</h2>	
  <b><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_bullet.gif" align="absmiddle"/> Feed Name: </b> <span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedName,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span><br>
	<div style="margin-left:30px">
	<b>Feed URL: </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedURL,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span><br>

	<img src= "<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_delete.gif" align="absmiddle"/> 
	<a href = "module.php?module=rss_import&action=dropfeed&feed_id=<?php echo $this->_vars['feed_id']; ?>
" onClick="return verify()">
	Delete this feed</a>

	<br />
	<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_go.gif" align="absmiddle"/> <a href = "module.php?module=rss_import&action=exportfeed&feed_id=<?php echo $this->_vars['feed_id']; ?>
">Export this feed</a>
	<br />
	<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_go.gif" align="absmiddle"/> <a href = "module.php?module=rss_import&action=examinefeed&feed_id=<?php echo $this->_vars['feed_id']; ?>
">Examine this feed</a>
	<br>
	<img src="<?php echo $this->_vars['my_pligg_base']; ?>
/modules/rss_import/images/feed_go.gif" align="absmiddle"/> <a href = "module.php?module=rss_import_do_import&override=<?php echo $this->_vars['feed_id']; ?>
">Import this feed</a>
	<br><br>
	- <b>Feed Frequency (hours): </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedFreqHours,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span> -- how often to check for new items.<br>
	<br />
	- <b>Feed Order: </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedLastItemFirst,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span> -- Do we start with the last items first? 0 = no, 1 = yes<br>
	<br />	
	- <b>Feed Random Votes: </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedRandomVoteEnable,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span> -- Do we use a random number of votes? 0 = no, 1 = yes<br>
	<br />	
	- <b>Feed Votes (if not random): </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedVotes,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span> -- how many votes new items recieve (limit 200)<br>
	<br />
	- <b>Feed Votes Minimum (if random): </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedRandomVotesMin,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span> -- how many votes new items recieve (limit 200)<br>
	- <b>Feed Votes Maximum (if random): </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedRandomVotesMax,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span> -- how many votes new items recieve (limit 200)<br>
	<br />
	- <b>Feed Items Limit: </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedItemLimit,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span> -- how many new items to take from the feed when it's checked<br>
	- <b>Feed URL Dupes: </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedURLDupe,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span> -- Allow duplicate URL's 0=No, 1=Yes, Allow<br>
	- <b>Feed Title Dupes: </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedTitleDupe,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span> -- Allow duplicate Title's 0=No, 1=Yes, Allow<br>
	- <b>Feed Submitter Id (number): </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedSubmitter,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span></p> -- The ID of the person who will be listed as the submitter<br>
	- <b>Feed Category Id (number): </b><span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedCategory,'unique' => $this->_vars['feed_id'],'ShowJS' => TRUE), $this);?></span> -- The ID of the category to place these items into<br>
	
	<br>
	
		<?php echo smarty_function_feedsListFeedLinks(array('varname' => FeedLinks,'feedid' => $this->_vars['feed_id']), $this);?>
		
	<?php if (count((array)$this->_vars['FeedLinks'])): foreach ((array)$this->_vars['FeedLinks'] as $this->_vars['feed_link_id']): ?>
		
			<?php echo smarty_function_feedsListFeedFields(array('feed_id' => $this->_vars['feed_id']), $this);?>
	
		-- <b>feed field name</b>: <span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedLink_FeedField,'unique' => $this->_vars['feed_link_id'],'ShowJS' => TRUE), $this);?></span>

		
			<?php echo smarty_function_feedsListPliggLinkFields(array(), $this);?>
			
		--- <b>pligg field name</b>: <span class="emptytext"><?php echo tpl_function_eipItem(array('item' => qeip_FeedLink_PliggField,'unique' => $this->_vars['feed_link_id'],'ShowJS' => TRUE), $this);?></span>

		--- <a href = "module.php?module=rss_import&action=dropfieldlink&FeedLinkId=<?php echo $this->_vars['feed_link_id']; ?>
">Remove this link</a>
 		<br>

	<?php endforeach; endif; ?>
	
	-- <a href = "module.php?module=rss_import&action=addnewfieldlink&FeedLinkId=<?php echo $this->_vars['feed_id']; ?>
">Add a new field link</a>
	</div>
	<hr>
	
<?php endif;  endforeach; endif; ?>
<br/>
</fieldset>
<?php $this->config_load(rss_import_pligg_lang_conf, null, null); ?>