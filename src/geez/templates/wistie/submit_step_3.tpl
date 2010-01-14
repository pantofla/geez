<h1>{#PLIGG_Visual_Submit3_Header#}</h1>

<div id="leftcol-superwide"><div id="submit"><div id="submit_content">
<h2>{#PLIGG_Visual_Submit3_Details#}</h2><br />

 <div class="contact1" style=" float:right">
{literal}

<script type="text/javascript"><!--
google_ad_client = "pub-5074133216375147";
/* 120x240, created 4/26/09 */
google_ad_slot = "6014709868";
google_ad_width = 120;
google_ad_height = 240;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
{/literal}

</div>






	{checkActionsTpl location="tpl_pligg_submit_step3_start"}
	{* javascript that protects people from clicking away from the story before submitting it *}
	{literal}
	<SCRIPT>
		// Variable toggles exit confirmation on and foff.
		var gPageIsOkToExit = false;

		function submitEdgeStory()
		{
			// Set a variable so that our "before unload" exit handler knows not to verify
			// the page exit operation.
			gPageIsOkToExit = true;

			// Do the submission.
			// var frm = document.getElementById("thisform");
			frms = document.getElementsByName("ATISUBMIT");
			
			if (frms)
			{
				if (frms[0])
					frms[0].submit();
			}
		}

		window.onbeforeunload = function (event) 
		{
			// See if this is a safe exit.
			if (gPageIsOkToExit)
				return;

			if (!event && window.event) 
	          		event = window.event;
	          		
	   		event.returnValue = "You have not hit the Submit Button to submit your story yet.";
		}
	</SCRIPT>
	{/literal}


	{php}
		Global $db, $main_smarty, $dblang, $the_template, $linkres, $current_user;

		$linkres=new Link;
		$linkres->id=$link_id = $_POST['id'];
		if (!is_numeric($link_id)) die();
		$linkres->read(FALSE);
        $linkres->related_category = $_POST['category_related'];    
         
		if($linkres->votes($current_user->user_id) == 0 && auto_vote == true) {
			$linkres->insert_vote($current_user->user_id, '10');
			$linkres->store_basic();
			$linkres->read(FALSE); 
        }
        
if (checklevel('god'))
    $Story_Content_Tags_To_Allow = Story_Content_Tags_To_Allow_God;
elseif (checklevel('admin'))
    $Story_Content_Tags_To_Allow = Story_Content_Tags_To_Allow_Admin;
else
    $Story_Content_Tags_To_Allow = Story_Content_Tags_To_Allow_Normal;

		$linkres->category=strip_tags($_POST['category']);
		$linkres->title = strip_tags(trim($_POST['title']));
		$linkres->title_url = makeUrlFriendly($linkres->title);
		$linkres->tags = tags_normalize_string(strip_tags(trim($_POST['tags'])));
		$linkres->content = strip_tags(trim($_POST['bodytext']), $Story_Content_Tags_To_Allow);
		$linkres->content = str_replace("\n", "<br />", $linkres->content);
	    // Steef 2k7-07 security fix start ----------------------------------------------------------
	  	$linkres->link_field1 = strip_tags(trim($_POST['link_field1']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field2 = strip_tags(trim($_POST['link_field2']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field3 = strip_tags(trim($_POST['link_field3']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field4 = strip_tags(trim($_POST['link_field4']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field5 = strip_tags(trim($_POST['link_field5']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field6 = strip_tags(trim($_POST['link_field6']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field7 = strip_tags(trim($_POST['link_field7']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field8 = strip_tags(trim($_POST['link_field8']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field9 = strip_tags(trim($_POST['link_field9']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field10 = strip_tags(trim($_POST['link_field10']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field11 = strip_tags(trim($_POST['link_field11']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field12 = strip_tags(trim($_POST['link_field12']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field13 = strip_tags(trim($_POST['link_field13']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field14 = strip_tags(trim($_POST['link_field14']), $Story_Content_Tags_To_Allow);
	  	$linkres->link_field15 = strip_tags(trim($_POST['link_field15']), $Story_Content_Tags_To_Allow);
	    // Steef 2k7-07 security fix end --------------------------------------------------------------
	    
		
		if (link_errors($linkres)) {
			return;
		}

		$linkres->store();
		tags_insert_string($linkres->id, $dblang, $linkres->tags);
		$linkres->read(FALSE);
		$edit = true;
		$link_title = $linkres->title;
		$link_content = $linkres->content;
		$link_title = stripslashes(strip_tags(trim($_POST['title'])));
		$linkres->print_summary();
		
		$main_smarty->assign('tags', $linkres->tags);
		if (!empty($linkres->tags)) {
			$tags_words = str_replace(",", ", ", $linkres->tags);
			$tags_url = urlencode($linkres->tags);
			$main_smarty->assign('tags_words', $tags_words);
			$main_smarty->assign('tags_url', $tags_url);
		}

		$main_smarty->assign('submit_url', $url);
		$main_smarty->assign('submit_url_title', $linkres->url_title);
		$main_smarty->assign('submit_id', $linkres->id);
		$main_smarty->assign('submit_type', $linkres->type());
		$main_smarty->assign('submit_title', $link_title);
		$main_smarty->assign('submit_content', $link_content);
		$main_smarty->assign('submit_trackback', $trackback);
	{/php}

	<form action="{$URL_submit}" method="post" id="thisform" name="ATISUBMIT" >
		<input type="hidden" name="phase" value="3" />
		<input type="hidden" name="randkey" value="{$templatelite.post.randkey}" />
		<input type="hidden" name="id" value="{$submit_id}" />
		<input type="hidden" name="trackback" value="{$templatelite.post.trackback|escape:"html"}" />
		
		<br style="clear: both;" /><hr />
		<center>
		<input type=button onclick="javascript:gPageIsOkToExit=true;window.history.go(-1);" value="{#PLIGG_Visual_Submit3_Modify#}" class="log2">&nbsp;&nbsp;
		<input type="button" onclick="javascript:submitEdgeStory();" value="{#PLIGG_Visual_Submit3_SubmitStory#}" class="submit" />
		</center>
	{checkActionsTpl location="tpl_pligg_submit_step3_end"} 
	</form>
</fieldset>
{checkActionsTpl location="tpl_submit_step_3_end"}




</div></div>