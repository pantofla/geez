<?php require_once('/home/pantofla/public_html/geez/plugins/function.checkActionsTpl.php'); $this->register_function("checkActionsTpl", "tpl_function_checkActionsTpl");  /* V2.10 Template Lite 4 January 2007  (c) 2005-2007 Mark Dickenson. All rights reserved. Released LGPL. 2009-08-10 20:07:13 CDT */ ?>

	<?php if ($this->_vars['pagename'] != "story" && $this->_vars['pagename'] != "submit" && $this->_vars['pagename'] != "user"): ?>
		<div class="stories" id="xnews-<?php echo $this->_vars['link_shakebox_index']; ?>
" <?php if ($this->_vars['link_shakebox_currentuser_reports'] > 0): ?> style="opacity:0.3;filter:alpha(opacity = 30)"<?php endif; ?>>
	<?php else: ?>
		<div class="stories-wide" id="xnews-<?php echo $this->_vars['link_shakebox_index']; ?>
" <?php if ($this->_vars['link_shakebox_currentuser_reports'] > 0): ?> style="opacity:0.3;filter:alpha(opacity = 30)"<?php endif; ?>>
	<?php endif;  echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_start"), $this);?>
	<?php if ($this->_vars['Voting_Method'] == 1): ?>
		<div class="headline">
			<?php if ($this->_vars['story_status'] == "published"): ?>
			<div class="votebox-published">
			<?php else: ?>
			<div class="votebox-upcoming">
			<?php endif; ?>			
				<div class="vote">
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_votebox_start"), $this);?>
					<span class="votenumber">
						<a id="xvotes-<?php echo $this->_vars['link_shakebox_index']; ?>
" href="javascript:<?php echo $this->_vars['link_shakebox_javascript_vote']; ?>
"><?php echo $this->_vars['link_shakebox_votes']; ?>
</a>
					</span><br />
					<span class="subtext">
						<?php if ($this->_vars['link_shakebox_currentuser_votes'] == 0 && $this->_vars['link_shakebox_currentuser_reports'] == 0): ?>
							<a href="javascript:<?php echo $this->_vars['link_shakebox_javascript_vote']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Vote_For_It']; ?>
</a>
						<?php else: ?>
							<?php if ($this->_vars['link_shakebox_currentuser_reports'] != 0): ?>
								<span><?php echo $this->_confs['PLIGG_Visual_Vote_Report']; ?>
</span>
							<?php else: ?>
								<?php if ($this->_vars['pagename'] == "user" && $this->_vars['user_logged_in'] != $this->_vars['link_submitter']): ?>
									<a href="javascript:<?php echo $this->_vars['link_shakebox_javascript_unvote']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Unvote_For_It']; ?>
</a>
								<?php else: ?>
									<span><?php echo $this->_confs['PLIGG_Visual_Vote_Cast']; ?>
</span>
								<?php endif; ?>	
							<?php endif; ?>
						<?php endif; ?>
					</span>
				<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_votebox_end"), $this);?>
				</div>
			</div>
	<?php endif; ?>	

	<?php if ($this->_vars['Voting_Method'] == 2): ?>
	<div class="headline">
		<h4 id="ls_title-<?php echo $this->_vars['link_shakebox_index']; ?>
">
			<ul class='star-rating<?php echo $this->_vars['star_class']; ?>
' id="xvotes-<?php echo $this->_vars['link_shakebox_index']; ?>
">
				<li class="current-rating" style="width: <?php echo $this->_vars['link_rating_width']; ?>
px;" id="xvote-<?php echo $this->_vars['link_shakebox_index']; ?>
"></li>
				<span id="mnmc-<?php echo $this->_vars['link_shakebox_index']; ?>
">
					<?php if ($this->_vars['link_shakebox_currentuser_votes'] == 0): ?>
						<li><a href="javascript:<?php echo $this->_vars['link_shakebox_javascript_vote_1star']; ?>
" class='one-star'>1</a></li>
						<li><a href="javascript:<?php echo $this->_vars['link_shakebox_javascript_vote_2star']; ?>
" class='two-stars'>2</a></li>
						<li><a href="javascript:<?php echo $this->_vars['link_shakebox_javascript_vote_3star']; ?>
" class='three-stars'>3</a></li>
						<li><a href="javascript:<?php echo $this->_vars['link_shakebox_javascript_vote_4star']; ?>
" class='four-stars'>4</a></li>
						<li><a href="javascript:<?php echo $this->_vars['link_shakebox_javascript_vote_5star']; ?>
" class='five-stars'>5</a></li>
					<?php else: ?>
						<li class='one-star-noh'>1</li>
						<li class='two-stars-noh'>2</li>
						<li class='three-stars-noh'>3</li>
						<li class='four-stars-noh'>4</li>
						<li class='five-stars-noh'>5</li>
					<?php endif; ?>
				</span>
			</ul>
		</h4>
	<?php endif; ?>
	

		<div class="title" id="title-<?php echo $this->_vars['link_shakebox_index']; ?>
">
			<h2>
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_title_start"), $this);?>
			<?php if ($this->_vars['use_title_as_link'] == true): ?>
				<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"): ?>
					<a href="<?php echo $this->_vars['url']; ?>
" <?php if ($this->_vars['open_in_new_window'] == true): ?> target="_blank"<?php endif; ?> <?php if ($this->_vars['story_status'] != "published"): ?>rel="nofollow"<?php endif; ?>><?php echo $this->_vars['title_short']; ?>
</a>
				<?php else: ?>
					<a href="<?php echo $this->_vars['story_url']; ?>
" <?php if ($this->_vars['open_in_new_window'] == true): ?> target="_blank"<?php endif; ?>><?php echo $this->_vars['title_short']; ?>
</a>
				<?php endif; ?>
			 <?php else: ?>
				<?php if ($this->_vars['pagename'] == "story" && $this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"): ?>
					<a href="<?php echo $this->_vars['url']; ?>
" <?php if ($this->_vars['open_in_new_window'] == true): ?> target="_blank"<?php endif; ?> <?php if ($this->_vars['story_status'] != "published"): ?>rel="nofollow"<?php endif; ?>><?php echo $this->_vars['title_short']; ?>
</a>
				<?php else: ?> 
				  <a href="<?php echo $this->_vars['story_url']; ?>
"><?php echo $this->_vars['title_short']; ?>
</a>
				<?php endif; ?>
			<?php endif; ?>
			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_title_end"), $this);?>
			</h2>
				
			<span class="subtext">
				<?php echo $this->_confs['PLIGG_Visual_LS_Posted_By']; ?>
 
				
				<a href="<?php echo $this->_vars['submitter_profile_url']; ?>
"><?php echo $this->_vars['link_submitter']; ?>
</a> <?php echo $this->_vars['link_submit_timeago']; ?>
 <?php echo $this->_confs['PLIGG_Visual_Comment_Ago']; ?>

				
				<?php if ($this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"): ?>
					(<a href="<?php echo $this->_vars['url']; ?>
" <?php if ($this->_vars['open_in_new_window'] == true): ?> target="_blank"<?php endif; ?>  <?php if ($this->_vars['story_status'] != "published"): ?>rel="nofollow"<?php endif; ?>><?php echo $this->_vars['url_short']; ?>
</a>)
				<?php else: ?>
					(<?php echo $this->_vars['No_URL_Name']; ?>
)
				<?php endif; ?>
			
				<?php if ($this->_vars['link_group_id'] == 0): ?>
					<?php if ($this->_vars['isadmin'] == "yes" || $this->_vars['user_logged_in'] == $this->_vars['link_submitter']): ?>
						<span id="adminlinksbuttom"> | <a href="javascript://" onclick="var replydisplay=document.getElementById('ls_adminlinks-<?php echo $this->_vars['link_shakebox_index']; ?>
').style.display ? '' : 'none';document.getElementById('ls_adminlinks-<?php echo $this->_vars['link_shakebox_index']; ?>
').style.display = replydisplay;"><?php echo $this->_confs['PLIGG_Visual_Admin_Links']; ?>
</a></span>
					<?php endif; ?>	
					<?php if ($this->_vars['isadmin'] == "yes"): ?>
							| <a href="<?php echo $this->_vars['my_pligg_base']; ?>
/delete.php?link_id=<?php echo $this->_vars['link_id']; ?>
"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Discard']; ?>
</a>
					<?php endif; ?> 
				<?php endif; ?>	
				<?php if ($this->_vars['link_group_id'] != 0): ?>
					<?php if ($this->_vars['isadmin'] == "yes" || $this->_vars['user_logged_in'] == $this->_vars['link_submitter']): ?>	
					<iframe height="0px;" width="0px;" frameborder="0" name="story_status"></iframe>
						<span id="groupstorystatus"><a style='text-decoration:none;padding:2px 0 0 20px;' target="story_status" href="javascript://" onclick="show_hide_user_links(document.getElementById('stories_status-<?php echo $this->_vars['link_shakebox_index']; ?>
'));"><?php echo $this->_confs['PLIGG_Visual_Group_Story_Status']; ?>
</a>&nbsp;
						<span id="stories_status-<?php echo $this->_vars['link_shakebox_index']; ?>
" style="display:none;">
							<a  href="<?php echo $this->_vars['group_story_links_publish']; ?>
" "><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Published']; ?>
</a>
							<a target="story_status" href="<?php echo $this->_vars['group_story_links_queued']; ?>
" onclick="show_hide_user_links(document.getElementById('story_status_success-<?php echo $this->_vars['link_shakebox_index']; ?>
'))"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Upcoming']; ?>
</a>
							<a target="story_status" href="<?php echo $this->_vars['group_story_links_discard']; ?>
" onclick="show_hide_user_links(document.getElementById('story_status_success-<?php echo $this->_vars['link_shakebox_index']; ?>
'))"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Discard']; ?>
</a>
						</span> &nbsp;
						<span id="story_status_success-<?php echo $this->_vars['link_shakebox_index']; ?>
" style="display:none;">
							&raquo; <?php echo $this->_confs['PLIGG_MiscWords_Save_Links_Success']; ?>

						</span>
					<?php endif; ?>
				<?php endif; ?>
			
				<span id="ls_adminlinks-<?php echo $this->_vars['link_shakebox_index']; ?>
" style="display:none">
					<?php if ($this->_vars['isadmin'] == "yes"): ?>
						<span id="ls_admin_links-<?php echo $this->_vars['link_shakebox_index']; ?>
" class="adminlinks">
							<br /><a href="<?php echo $this->_vars['story_edit_url']; ?>
"><?php echo $this->_confs['PLIGG_Visual_LS_Admin_Edit']; ?>
</a>
							<br /><a href="<?php echo $this->_vars['story_admin_url']; ?>
"><?php echo $this->_confs['PLIGG_Visual_LS_Admin_Status']; ?>
</a>
                                                        <br /><a href="<?php echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base']; ?>
/admin/admin_users.php?mode=view&user=<?php echo $this->_vars['link_submitter']; ?>
"><?php echo $this->_confs['PLIGG_Visual_AdminPanel_Manage_Nav']; ?>
-<?php echo $this->_vars['link_submitter']; ?>
</a>
							<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_link_summary_admin_links"), $this);?>
						</span>
					<?php else: ?>
						<?php if ($this->_vars['user_logged_in'] == $this->_vars['link_submitter']): ?>
							<span id="ls_user_edit_links-<?php echo $this->_vars['link_shakebox_index']; ?>
"><br /><a href="<?php echo $this->_vars['story_edit_url']; ?>
"><?php echo $this->_confs['PLIGG_Visual_LS_Admin_Edit']; ?>
</a></span>
						<?php endif; ?>
					<?php endif; ?>
				</span>
				
			</div>
		</div>

		<div class="storycontent">
					<?php if ($this->_vars['use_thumbnails'] == "true" && $this->_vars['url_short'] != "http://" && $this->_vars['url_short'] != "://"): ?>

			




<b><a href="<?php echo $this->_vars['story_url']; ?>
"><img src="http://www.shrinktheweb.com/xino.php?embed=1&STWAccessKeyId=796f85f56cc0ed4&Size=lg&stwUrl=<?php echo $this->_vars['url_short']; ?>
" border="0" alt="A preview image" style="float:left; width:100px; height:50px; padding:0px 10px 10px 0px"></a></b>



<?php endif; ?>




		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_link_summary_pre_story_content"), $this);?>
		<?php if ($this->_vars['pagename'] == "story"): ?>
		
		
		
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_body_start_full"), $this); else:  echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_body_start"), $this); endif; ?>

	

		<?php if ($this->_vars['viewtype'] != "short"): ?>
			<span class="news-body-text">
				<span id="ls_contents-<?php echo $this->_vars['link_shakebox_index']; ?>
">
					<?php if ($this->_vars['show_content'] != 'FALSE'): ?>
						<?php echo $this->_vars['story_content']; ?>

					<?php endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_1'] == 1):  if ($this->_vars['link_field1'] != ""): ?><br/><b><?php echo $this->_vars['Field_1_Title']; ?>
:</b> <?php echo $this->_vars['link_field1'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_2'] == 1):  if ($this->_vars['link_field2'] != ""): ?><br/><b><?php echo $this->_vars['Field_2_Title']; ?>
:</b> <?php echo $this->_vars['link_field2'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_3'] == 1):  if ($this->_vars['link_field3'] != ""): ?><br/><b><?php echo $this->_vars['Field_3_Title']; ?>
:</b> <?php echo $this->_vars['link_field3'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_4'] == 1):  if ($this->_vars['link_field4'] != ""): ?><br/><b><?php echo $this->_vars['Field_4_Title']; ?>
:</b> <?php echo $this->_vars['link_field4'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_5'] == 1):  if ($this->_vars['link_field5'] != ""): ?><br/><b><?php echo $this->_vars['Field_5_Title']; ?>
:</b> <?php echo $this->_vars['link_field5'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_6'] == 1):  if ($this->_vars['link_field6'] != ""): ?><br/><b><?php echo $this->_vars['Field_6_Title']; ?>
:</b> <?php echo $this->_vars['link_field6'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_7'] == 1):  if ($this->_vars['link_field7'] != ""): ?><br/><b><?php echo $this->_vars['Field_7_Title']; ?>
:</b> <?php echo $this->_vars['link_field7'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_8'] == 1):  if ($this->_vars['link_field8'] != ""): ?><br/><b><?php echo $this->_vars['Field_8_Title']; ?>
:</b> <?php echo $this->_vars['link_field8'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_9'] == 1):  if ($this->_vars['link_field9'] != ""): ?><br/><b><?php echo $this->_vars['Field_9_Title']; ?>
:</b> <?php echo $this->_vars['link_field9'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_10'] == 1):  if ($this->_vars['link_field10'] != ""): ?><br/><b><?php echo $this->_vars['Field_10_Title']; ?>
:</b> <?php echo $this->_vars['link_field10'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_11'] == 1):  if ($this->_vars['link_field11'] != ""): ?><br/><b><?php echo $this->_vars['Field_11_Title']; ?>
:</b> <?php echo $this->_vars['link_field11'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_12'] == 1):  if ($this->_vars['link_field12'] != ""): ?><br/><b><?php echo $this->_vars['Field_12_Title']; ?>
:</b> <?php echo $this->_vars['link_field12'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_13'] == 1):  if ($this->_vars['link_field13'] != ""): ?><br/><b><?php echo $this->_vars['Field_13_Title']; ?>
:</b> <?php echo $this->_vars['link_field13'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_14'] == 1):  if ($this->_vars['link_field14'] != ""): ?><br/><b><?php echo $this->_vars['Field_14_Title']; ?>
:</b> <?php echo $this->_vars['link_field14'];  endif;  endif; ?>
					<?php if ($this->_vars['Enable_Extra_Field_15'] == 1):  if ($this->_vars['link_field15'] != ""): ?><br/><b><?php echo $this->_vars['Field_15_Title']; ?>
:</b> <?php echo $this->_vars['link_field15'];  endif;  endif; ?> 		  			
					<?php if ($this->_vars['pagename'] != "story" && $this->_vars['pagename'] != "submit"): ?><a href="<?php echo $this->_vars['story_url']; ?>
"><br /><?php echo $this->_confs['PLIGG_Visual_Read_More']; ?>
</a>&raquo;<?php endif; ?>
				</span>
			</span>

			<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_body_end"), $this);?>
		<?php endif; ?>
		</div>
	<div class="storyfooter">
	
		<div class="floatleft subtext">
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_tools_start"), $this);?>

		<span id="ls_comments_url-<?php echo $this->_vars['link_shakebox_index']; ?>
">
			<?php if ($this->_vars['story_comment_count'] == 0): ?>
				<span id="linksummaryDiscuss"><a href="<?php echo $this->_vars['story_url']; ?>
#discuss" class="comments"><img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/comment.png"width=10 height=10 border="0";/><?php echo $this->_confs['PLIGG_MiscWords_Discuss']; ?>
</a>&nbsp;</span>
			<?php endif; ?>
			<?php if ($this->_vars['story_comment_count'] == 1): ?>
				<span id="linksummaryHasComment"><a href="<?php echo $this->_vars['story_url']; ?>
#comments" class="comments2"><?php echo $this->_vars['story_comment_count']; ?>
 <?php echo $this->_confs['PLIGG_MiscWords_Comment']; ?>
</a>&nbsp;</span>
			<?php endif; ?>
			<?php if ($this->_vars['story_comment_count'] > 1): ?>
				<span id="linksummaryHasComment"><a href="<?php echo $this->_vars['story_url']; ?>
#comments" class="comments2"><?php echo $this->_vars['story_comment_count']; ?>
 <?php echo $this->_confs['PLIGG_MiscWords_Comments']; ?>
</a>&nbsp;</span>
			<?php endif; ?>
		</span> 
		
		<?php if ($this->_vars['user_logged_in'] != "" && $this->_vars['user_logged_in'] != $this->_vars['link_submitter']): ?>  
			|&nbsp;
			<iframe height="0px;" width="0px;" frameborder="0" name="add_stories"></iframe>
			<?php if ($this->_vars['link_mine'] == 0): ?>
				<span id="linksummarySaveLink"><a target="add_stories" href="<?php echo $this->_vars['user_url_add_links']; ?>
" onclick="show_hide_user_links(document.getElementById('stories-<?php echo $this->_vars['link_shakebox_index']; ?>
'));"><?php echo $this->_confs['PLIGG_MiscWords_Save_Links_Save']; ?>
</a>
			<?php else: ?>
				<span id="linksummaryRemoveLink"><a target="add_stories" href="<?php echo $this->_vars['user_url_remove_links']; ?>
" onclick="show_hide_user_links(document.getElementById('stories-<?php echo $this->_vars['link_shakebox_index']; ?>
'));"><?php echo $this->_confs['PLIGG_MiscWords_Save_Links_Remove']; ?>
</a>
			<?php endif; ?>
			</span>&nbsp;
			<span id="stories-<?php echo $this->_vars['link_shakebox_index']; ?>
" style="display:none;"> &raquo; <?php echo $this->_confs['PLIGG_MiscWords_Save_Links_Success']; ?>
 <a href="<?php echo $this->_vars['user_url_saved']; ?>
"><?php echo $this->_confs['PLIGG_MiscWords_Save_Links_Go_To_Saved']; ?>
</a></span>
		<?php endif; ?>	
	
	                          
		
		<?php if ($this->_vars['link_shakebox_currentuser_votes'] == 0 && $this->_vars['link_shakebox_currentuser_reports'] == 0): ?>
			|&nbsp;
			<span id="xreport-<?php echo $this->_vars['link_shakebox_index']; ?>
"><span id="linksummaryBury"><a href="javascript:<?php echo $this->_vars['link_shakebox_javascript_report']; ?>
"><?php echo $this->_confs['PLIGG_Visual_Vote_Bury']; ?>
</a></span></span>
		<?php endif; ?>
		 
		<?php if ($this->_vars['Enable_Recommend'] == 1 && $this->_vars['user_logged_in'] != ""): ?>
			|&nbsp;
			<span id="ls_recommend-<?php echo $this->_vars['link_shakebox_index']; ?>
">
				<span id="linksummaryTellFriend">
					<a href="javascript://" onclick="show_recommend(<?php echo $this->_vars['link_shakebox_index']; ?>
, <?php echo $this->_vars['link_id']; ?>
, '<?php echo $this->_vars['instpath']; ?>
');"> <img src="<?php echo $this->_vars['my_pligg_base']; ?>
/templates/<?php echo $this->_vars['the_template']; ?>
/images/email.png"width=10 height=10 border="0";/><?php echo $this->_confs['PLIGG_Visual_Recommend_Link_Text']; ?>
</a>&nbsp;
				</span>
			</span> 
		<?php endif; ?>		






		<?php if ($this->_vars['enable_group'] == "true"): ?>
			<?php if ($this->_vars['user_logged_in'] != ""): ?>
			|&nbsp;
				<span class="group_sharing"><a href="javascript://" onclick="<?php if ($this->_vars['get_group_membered']): ?>var replydisplay=document.getElementById('group_share-<?php echo $this->_vars['link_shakebox_index']; ?>
').style.display ? '' : 'none';document.getElementById('group_share-<?php echo $this->_vars['link_shakebox_index']; ?>
').style.display = replydisplay;<?php else: ?>alert('<?php echo $this->_confs['PLIGG_Visual_No_Groups']; ?>
');<?php endif; ?>"><?php echo $this->_confs['PLIGG_Visual_Group_Share']; ?>
</a>
				<span id = "group_share-<?php echo $this->_vars['link_shakebox_index']; ?>
" style="display:none;">
					<div style="position:absolute;display:block;background:#fff;padding:10px;margin:10px 0 0 150px;font-size:12px;border:2px solid #000;"><?php echo $this->_vars['get_group_membered']; ?>
</div>
				</span>
			<?php endif; ?>
		<?php endif; ?>
			
		<?php if ($this->_vars['Enable_Recommend'] == 1): ?>
			|&nbsp;
			<?php if ($this->_vars['Recommend_Type'] == 1): ?>
				<span id="emailto-<?php echo $this->_vars['link_shakebox_index']; ?>
" style="display:none"></span>
			<?php endif; ?>
		<?php endif; ?>
		<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_tools_end"), $this);?>
		</div>
<span>	
			
<?php echo '		

 <script type="text/javascript">
var addthis_brand = "geez";
var addthis_header_color = "#ffffff";
var addthis_header_background = "#ee9a19";
var addthis_pub="arxidia";</script>
<a href="http://www.addthis.com/bookmark.php?v=20" onmouseover="return addthis_open(this, \'\', \'';  echo $this->_vars['my_base_url'];  echo $this->_vars['my_pligg_base'];  echo $this->_vars['story_url'];  echo '\', \'';  echo $this->_vars['title_short'];  echo '\')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img src="http://s7.addthis.com/static/btn/sm-plus.gif" width="16" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/200/addthis_widget.js"></script>
<!-- AddThis Button END -->

'; ?>

	</span>	




		
		<div class="floatright subtext">
		<a href="<?php echo $this->_vars['category_url']; ?>
"><?php echo $this->_vars['link_category']; ?>
</a>
		<?php if ($this->_vars['enable_tags'] == 'true'): ?>
			<?php if ($this->_vars['tags'] != ''): ?>
                | 
				<?php if (isset($this->_sections['thistag'])) unset($this->_sections['thistag']);
$this->_sections['thistag']['name'] = 'thistag';
$this->_sections['thistag']['loop'] = is_array($this->_vars['tag_array']) ? count($this->_vars['tag_array']) : max(0, (int)$this->_vars['tag_array']);
$this->_sections['thistag']['show'] = true;
$this->_sections['thistag']['max'] = $this->_sections['thistag']['loop'];
$this->_sections['thistag']['step'] = 1;
$this->_sections['thistag']['start'] = $this->_sections['thistag']['step'] > 0 ? 0 : $this->_sections['thistag']['loop']-1;
if ($this->_sections['thistag']['show']) {
	$this->_sections['thistag']['total'] = $this->_sections['thistag']['loop'];
	if ($this->_sections['thistag']['total'] == 0)
		$this->_sections['thistag']['show'] = false;
} else
	$this->_sections['thistag']['total'] = 0;
if ($this->_sections['thistag']['show']):

		for ($this->_sections['thistag']['index'] = $this->_sections['thistag']['start'], $this->_sections['thistag']['iteration'] = 1;
			 $this->_sections['thistag']['iteration'] <= $this->_sections['thistag']['total'];
			 $this->_sections['thistag']['index'] += $this->_sections['thistag']['step'], $this->_sections['thistag']['iteration']++):
$this->_sections['thistag']['rownum'] = $this->_sections['thistag']['iteration'];
$this->_sections['thistag']['index_prev'] = $this->_sections['thistag']['index'] - $this->_sections['thistag']['step'];
$this->_sections['thistag']['index_next'] = $this->_sections['thistag']['index'] + $this->_sections['thistag']['step'];
$this->_sections['thistag']['first']	  = ($this->_sections['thistag']['iteration'] == 1);
$this->_sections['thistag']['last']	   = ($this->_sections['thistag']['iteration'] == $this->_sections['thistag']['total']);
?>
					<a href="<?php echo $this->_vars['tags_url_array'][$this->_sections['thistag']['index']]; ?>
"><?php echo $this->_vars['tag_array'][$this->_sections['thistag']['index']]; ?>
</a>
				<?php endfor; endif; ?>
				</span> 
			<?php endif; ?>
		<?php endif; ?>	
		 </div>
	</div>
	<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_link_summary_end"), $this);?>
</div>
<?php echo tpl_function_checkActionsTpl(array('location' => "tpl_pligg_story_end"), $this);?>

<?php $_templatelite_tpl_vars = $this->_vars;
echo $this->_fetch_compile_include($this->_vars['the_template']."/adsense/adstest.tpl", array());
$this->_vars = $_templatelite_tpl_vars;
unset($_templatelite_tpl_vars);
 ?>


 <div class="contact1">
<?php if ($this->_vars['pagename'] == "story"): ?>

<div style="margin: 0px 0px 10px; padding: 10px 0px" align="center">
<?php echo '
<script type="text/javascript"><!--
google_ad_client = "pub-5074133216375147";
/* 728x90, &#948;&#951;&#956;&#953;&#959;&#965;&#961;&#947;&#942;&#952;&#951;&#954;&#949; 10/8/2009 */
google_ad_slot = "9126660742";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
'; ?>

</div>
<?php endif; ?>

</div>