{checkActionsTpl location="tpl_pligg_profile_start"}

{checkActionsTpl location="tpl_user_center_just_below_header"}

{if $user_view eq 'search'}
	<div id="navbar">
		{if $Allow_Friends neq "0"}	
			<div id="search_users">
				<form action="{$my_pligg_base}/user.php" method="get">
				<input type="hidden" name="view" value="search">
					{if $templatelite.get.keyword neq ""}
						{assign var=searchboxtext value=$templatelite.get.keyword|sanitize:2}
					{else}
						{assign var=searchboxtext value=#PLIGG_Visual_Search_SearchDefaultText#}			
					{/if}
				<input type="text" name="keyword" class="field" value="{$searchboxtext}" onfocus="if(this.value == '{$searchboxtext}') {ldelim}this.value = '';{rdelim}" onblur="if (this.value == '') {ldelim}this.value = '{$searchboxtext}';{rdelim}">
				<input type="submit" value="{#PLIGG_Visual_User_Search_Users#}" class="button">
				</form>
			</div>
			{if $user_login neq $user_logged_in}
	  			{if $is_friend gt 0}
					<img src="{$my_pligg_base}/templates/{$the_template}/images/user_delete.png" align="absmiddle"/>
					<a href="{$user_url_remove}">{#PLIGG_Visual_User_Profile_Remove_Friend#} {$user_login} {#PLIGG_Visual_User_Profile_Remove_Friend_2#}</a>

		   			{if $user_authenticated eq true}
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						{checkActionsTpl location="tpl_user_center"}
					{/if} 			
				{else}
	  				
	   				{if $user_authenticated eq true}
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						<img src="{$my_pligg_base}/templates/{$the_template}/images/user_add.gif" align="absmiddle"/>
						<a href="{$user_url_add}">	{#PLIGG_Visual_User_Profile_Add_Friend#} {$user_login} {#PLIGG_Visual_User_Profile_Add_Friend_2#}</a>
				    {/if}   
				{/if}      		
			{else}  
				<img src="{$my_pligg_base}/templates/{$the_template}/images/friends.png" align="absmiddle"/>
				<a href="{$user_url_friends}">{#PLIGG_Visual_User_Profile_View_Friends#}</a> 
		  
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  
				<img src="{$my_pligg_base}/templates/{$the_template}/images/friends2.png" align="absmiddle"/>
				<a href="{$user_url_friends2}">{#PLIGG_Visual_User_Profile_View_Friends_2#}</a> 
			<div class="userborderbottom">&nbsp;</div>
				
			{/if} 
		{/if}
	</div>

	<h2>{#PLIGG_Visual_Search_SearchResults#} {$search}</h2>

	<table cellpadding="1" border="0">
		<tr><th>{#PLIGG_Visual_Login_Username#}</th><th>{#PLIGG_Visual_User_Profile_Joined#}</th><th>{#PLIGG_Visual_User_Profile_Homepage#}</th><th>Add/Remove</th></tr>
		{section name=nr loop=$userlist}
			<tr>
			<td width="240px"><img src="{$userlist[nr].Avatar}" align="absmiddle"/> <a href = "{$URL_user, $userlist[nr].user_login}">{$userlist[nr].user_login}</a></td>
			<td width="120px">{$userlist[nr].user_date}</td>
			<td width="300px">{$userlist[nr].user_url}</td>
			<td width="80px">{if $userlist[nr].status eq 0}	
					<center><a href="{$userlist[nr].add_friend}"><img src="{$my_pligg_base}/templates/{$the_template}/images/user_add.gif" align="absmiddle" border="0" /></a></center>
				{else}
					<center><a href="{$userlist[nr].remove_friend}"><img src="{$my_pligg_base}/templates/{$the_template}/images/user_delete.png" align="absmiddle" border="0"/></a></center>
				{/if}
			</td>	
			</tr>
		{/section}
	</table>
	
{/if}


{if $user_view eq 'viewfriends'}
	<div id="navbar">
		{if $Allow_Friends neq "0"}
			{if $user_authenticated eq true} 
				<div id="search_users">
					<form action="{$my_pligg_base}/user.php" method="get">
					<input type="hidden" name="view" value="search">
					<input type="text" name="keyword" class="field">
					<input type="submit" value="{#PLIGG_Visual_User_Search_Users#}" class="button">
					</form>
				</div>
			{/if}
			
			<img src="{$my_pligg_base}/templates/{$the_template}/images/friends2.png" align="absmiddle"/> 
			<a href="{$user_url_friends2}">{#PLIGG_Visual_User_Profile_View_Friends_2#}</a> 
			<div class="userborderbottom">&nbsp;</div>
		{/if}
	</div>
{/if}

{if $user_view eq 'setting'}
	<div id="navbar" style="margin-bottom:-10px;"></div>
	{checkActionsTpl location="tpl_pligg_profile_settings_start"}
	<form action="{$my_pligg_base}/user_settings.php?login={$user_username}" method="post">
		
		<div style="float:left;margin:20px 20px 0 20px;">
			{if $Allow_User_Change_Templates}
			<strong>{#PLIGG_Visual_User_Setting_Template#}</strong>
			<select name='template'>
			{foreach from=$templates item=template}
			<option {if $template==$current_template}selected{/if}>{$template}</option>
			{/foreach}
			</select>
			{/if}
			<br /><br />
			<strong>{#PLIGG_Visual_User_Setting_Categories#}</strong>
			<br /><br />
			{foreach from=$category item=cat name="cate"}
				<!--{if $smarty.foreach.cate.iteration % 5 == 0}<br style="clear:both;">{/if}-->
				<div style="width:145px;margin:0 20px;border:1px solid #E9DDAB;float:left;background-color:#FBF7E5;">
					<div style="width:20px;padding:2px;border:0px solid red;float:left;text-align:center;">
						<input type="checkbox" name="chack[]" value="{$cat.category__auto_id}" {foreach from=$user_category item=u_cat} {if $u_cat eq $cat.category__auto_id} checked="checked"{/if}{/foreach}>
					</div>
					<div style="width:90px;padding:3px;border:0px solid red;float:left;text-align:center;">
						{$cat.category_name}<br/>
					</div>
				</div>
				
			{/foreach}
		</div>
		<br style="clear:both;" />
		<div style="float:left;margin:20px 0px 0px 20px;">
		<input type="submit" name="submit" value="update">
		</div>
	</form>
	{checkActionsTpl location="tpl_pligg_profile_settings_end"}
{/if}

{if $user_view eq 'viewfriends2'}
	<div id="navbar">
		{if $Allow_Friends neq "0"}	 
			{if $user_authenticated eq true} 
				<div id="search_users">
					<form action="{$my_pligg_base}/user.php" method="get">
					<input type="hidden" name="view" value="search">
					<input type="text" name="keyword" class="field">
					<input type="submit" value="{#PLIGG_Visual_User_Search_Users#}" class="button">
					</form>
				</div>
			{/if}		
			<img src="{$my_pligg_base}/templates/{$the_template}/images/friends.png" align="absmiddle"/>
			<a href="{$user_url_friends}">{#PLIGG_Visual_User_Profile_View_Friends#}</a>
			<div class="userborderbottom">&nbsp;</div>
		{/if}
	</div>
{/if}


{if $user_view eq 'removefriend'}
	<div id="navbar">
		{if $Allow_Friends neq "0"}		
			{if $user_authenticated eq true} 
				<div id="search_users">
					<form action="{$my_pligg_base}/user.php" method="get">
					<input type="hidden" name="view" value="search">
					<input type="text" name="keyword" class="field">
					<input type="submit" value="{#PLIGG_Visual_User_Search_Users#}" class="button">
					</form>
				</div>
			{/if}
			{if $user_login neq $user_logged_in}	  
				<img src="{$my_pligg_base}/templates/{$the_template}/images/friends.png" align="absmiddle"/>
				<a href="{$user_url_friends}">{#PLIGG_Visual_User_Profile_View_Friends#}</a>

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  
				<img src="{$my_pligg_base}/templates/{$the_template}/images/friends2.png" align="absmiddle"/>
				<a href="{$user_url_friends2}">{#PLIGG_Visual_User_Profile_View_Friends_2#}</a>	  
			{/if}
			<div class="userborderbottom">&nbsp;</div>
		{/if}
	</div>
{/if}


{if $user_view eq 'addfriend'}
	<div id="navbar">
		{if $Allow_Friends neq "0"}	 
			{if $user_authenticated eq true} 
				<div id="search_users">
					<form action="{$my_pligg_base}/user.php" method="get">
					<input type="hidden" name="view" value="search">
					<input type="text" name="keyword" class="field">
					<input type="submit" value="{#PLIGG_Visual_User_Search_Users#}" class="button">
					</form>
				</div>
			{/if}
			
			<img src="{$my_pligg_base}/templates/{$the_template}/images/friends.png" align="absmiddle"/>
			<a href="{$user_url_friends}">{#PLIGG_Visual_User_Profile_View_Friends#}</a>

		  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  
			<img src="{$my_pligg_base}/templates/{$the_template}/images/friends2.png" align="absmiddle"/>
			<a href="{$user_url_friends2}">{#PLIGG_Visual_User_Profile_View_Friends_2#}</a>
			<div class="userborderbottom">&nbsp;</div>
		{/if}
	</div>
{/if}


{if $user_view eq 'profile'}
	<div id="navbar">	
		{if $Allow_Friends neq "0"}	
			{if $user_authenticated eq true} 
				<div id="search_users">
					<form action="{$my_pligg_base}/user.php" method="get">
					<input type="hidden" name="view" value="search">
					<input type="text" name="keyword" class="field">
					<input type="submit" value="{#PLIGG_Visual_User_Search_Users#}" class="button">
					</form>
				</div>
			{/if}
			{if $user_login neq $user_logged_in}
				{if $is_friend gt 0}
					<img src="{$my_pligg_base}/templates/{$the_template}/images/user_delete.png" align="absmiddle"/>
					<a href="{$user_url_remove}">{#PLIGG_Visual_User_Profile_Remove_Friend#} {$user_login} {#PLIGG_Visual_User_Profile_Remove_Friend_2#}</a>

			   		{if $user_authenticated eq true}
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			
						{checkActionsTpl location="tpl_user_center"}
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					{/if}
		 			
				{else}
		  				
		   			{if $user_authenticated eq true} 					
						<img src="{$my_pligg_base}/templates/{$the_template}/images/user_add.gif" align="absmiddle"/>
						<a href="{$user_url_add}">	{#PLIGG_Visual_User_Profile_Add_Friend#} {$user_login} {#PLIGG_Visual_User_Profile_Add_Friend_2#}</a>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;					
					{/if}   
		   
				{/if}   
		   		
			{else}
		  
				<img src="{$my_pligg_base}/templates/{$the_template}/images/friends.png" align="absmiddle"/>
				<a href="{$user_url_friends}">{#PLIGG_Visual_User_Profile_View_Friends#}</a> 
		  
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  
				<img src="{$my_pligg_base}/templates/{$the_template}/images/friends2.png" align="absmiddle"/>
				<a href="{$user_url_friends2}">{#PLIGG_Visual_User_Profile_View_Friends_2#}</a> 

				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  
			{/if} 
			{if $user_authenticated eq true} 
				<div class="userborderbottom">&nbsp;</div>
			{/if}
			{checkActionsTpl location="tpl_user_center"}
		{/if}
	</div>	

	<div id="wrapper">
		{checkActionsTpl location="tpl_pligg_profile_info_start"}
		
		<div id="personal_info">
			<fieldset><legend>{#PLIGG_Visual_User_PersonalData#}</legend>
				<table style="border:none">
				<tr>
				<td style="background:none"><strong>{#PLIGG_Visual_Login_Username#}:</strong></td>
				<td style="background:none">{if $UseAvatars neq "0"}<span id="ls_avatar"><img src="{$Avatar_ImgSrc}" alt="Avatar" align="absmiddle"/></span>{/if} {$user_username}</td>
				</tr>
				
				{if $user_names ne ""}
				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_User#}:</strong></td>
				<td>{$user_names}</td>
				</tr>
				{/if}

				{if $user_url ne ""}
				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_Homepage#}:</strong></td>
				<td><a href="{$user_url}" target="_blank">{$user_url}</a></td>
				</tr>
				{/if}

				{if $user_publicemail ne ""}
				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_PublicEmail#}:</strong></td>
				<td>{$user_publicemail}</td>
				</tr>
				{/if}

				{if $user_location ne ""}
				<tr>
				<td><strong>{#PLIGG_Visual_Profile_Location#}:</strong></td>
				<td>{$user_location}</td>
				</tr>
				{/if}

				{if $user_occupation ne ""}
				<tr>
				<td><strong>{#PLIGG_Visual_Profile_Occupation#}:</strong></td>
				<td>{$user_occupation}</td>
				</tr>
				{/if}

				{if $user_aim ne ""}
				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_AIM#}:</strong></td>
				<td>{$user_aim}</td>
				</tr>
				{/if}

				{if $user_msn ne ""}
				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_MSN#}:</strong></td>
				<td>{$user_msn}</td>
				</tr>
				{/if}

				{if $user_yahoo ne ""}
				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_Yahoo#}:</strong></td>
				<td>{$user_yahoo}</td>
				</tr>
				{/if}

				{if $user_gtalk ne ""}
				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_GTalk#}:</strong></td>
				<td>{$user_gtalk}</td>
				</tr>
				{/if}

				{if $user_skype ne ""}
				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_Skype#}:</strong></td>
				<td>{$user_skype}</td>
				</tr>
				{/if}

				{if $user_irc ne ""}
				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_IRC#}:</strong></td>
				<td><a href="{$user_irc}" target="_blank">{$user_irc}</a></td>
				</tr>
				{/if}

				{if $user_login eq $user_logged_in}
				<tr><td><input type="button" value="{#PLIGG_Visual_User_Profile_Modify#}" onclick="location='{$URL_Profile}'"></td></tr>
				{/if}
				</table>
				{checkActionsTpl location=”tpl_show_extra_profile”}

			</fieldset>
		</div>
		
		{checkActionsTpl location="tpl_pligg_profile_info_middle"}
		
		<div id="stats">
			<fieldset><legend>{#PLIGG_Visual_User_Profile_User_Stats#}</legend>
				<table style="border:none;">
				<tr>
				<td style="background:none"><strong>{#PLIGG_Visual_User_Profile_Joined#}:</strong></td>
				<td style="background:none">{$user_joined}</td>
				</tr>

				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_Total_Links#}:</strong></td>
				<td>{$user_total_links}</td>
				</tr>

				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_Published_Links#}:</strong></td>
				<td>{$user_published_links}</td>
				</tr>

				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_Total_Comments#}:</strong></td>
				<td>{$user_total_comments}</td>
				</tr>

				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_Total_Votes#}:</strong></td>
				<td>{$user_total_votes}</td>
				</tr>

				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_Published_Votes#}:</strong></td>
				<td>{$user_published_votes}</td>
				</tr>

				{if $user_karma ne ""}
				<tr>
				<td><strong>{#PLIGG_Visual_User_Profile_KarmaPoints#}:</strong></td>
				<td>{$user_karma}</td>
				</tr>
				{/if}

				</table>
			</fieldset>
		</div>
		
		<div id="groups">
			<fieldset><legend>{#PLIGG_Visual_User_Profile_User_Groups#}</legend>
				<table style="border:none;">
{$group_display}
				</table>
			</fieldset>
		</div>

		{checkActionsTpl location="tpl_pligg_profile_info_end"}
		
		{if $user_login eq $user_logged_in}
			<div id="bookmarklet">
				<fieldset><legend>{#PLIGG_Visual_User_Profile_Bookmarklet_Title#}</legend>
					<br />{#PLIGG_Visual_User_Profile_Bookmarklet_Title_1#} {#PLIGG_Visual_Name#}.{#PLIGG_Visual_User_Profile_Bookmarklet_Title_2#}<br />
					<br /><b>{#PLIGG_Visual_User_Profile_IE#}:</b> {#PLIGG_Visual_User_Profile_IE_1#}
					<br /><b>{#PLIGG_Visual_User_Profile_Firefox#}:</b> {#PLIGG_Visual_User_Profile_Firefox_1#}
					<br /><b>{#PLIGG_Visual_User_Profile_Opera#}:</b> {#PLIGG_Visual_User_Profile_Opera_1#}
					<br /><br /><b>{#PLIGG_Visual_User_Profile_The_Bookmarklet#}: { include file="bookmarklet.tpl" }</b>
				</fieldset>
			</div>
		{/if}
		
		
	</div>	
{/if}

{if isset($user_page)}{$user_page}{/if}
{if isset($user_pagination)}{checkActionsTpl location="tpl_pligg_pagination_start"}{$user_pagination}{checkActionsTpl location="tpl_pligg_pagination_end"}{/if}
{checkActionsTpl location="tpl_pligg_profile_end"}