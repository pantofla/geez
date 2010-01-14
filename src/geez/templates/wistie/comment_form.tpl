
{checkActionsTpl location="tpl_pligg_story_comments_submit_start"}
	
<h3><a name="discuss" style="color:#11A3AC">{#PLIGG_Visual_Comment_Send#}</a></h3>	
	<form action="" method="POST" id="thisform">

		<label>{#PLIGG_Visual_Comment_NoHTML#}</label><br />
		<textarea name="comment_content" class="comment-form" rows="6" cols="96"/>{if isset($TheComment)}{$TheComment}{/if}</textarea><br />
		{if $Spell_Checker eq 1}<input type="button" name="spelling" value="{#PLIGG_Visual_Check_Spelling#}" class="log2 searchbutton" onClick="openSpellChecker('comment');"/>{/if}
		<input type="submit" name="submit" value="{#PLIGG_Visual_Comment_Submit#}" class="log2 searchbutton" />
		<input type="hidden" name="process" value="newcomment" />
		<input type="hidden" name="randkey" value="{$randkey}" />
		<input type="hidden" name="link_id" value="{$link_id}" />
		<input type="hidden" name="user_id" value="{$user_id}" />
	</form>	
{checkActionsTpl location="tpl_pligg_story_comments_submit_end"}
<br />