<div id="space2"></div>


{if $pagename neq "login"}
	<div class="sectiontitle test"><a href="{$URL_login}">{#PLIGG_Visual_Login_Title#}</a>	</div>



<div class="boxcontent testsection">	





{checkActionsTpl location="tpl_widget_login_start"}

	<form action="{$URL_login}" method="post"> 
			{#PLIGG_Visual_Login_Username#}:<br /><input type="text" name="username" class="login" value="{if isset($login_username)}{$login_username}{/if}" tabindex="40" /><br />
			{#PLIGG_Visual_Login_Password#}:<br /><input type="password" name="password" class="login" tabindex="41" /><br />
			<input type="hidden" name="processlogin" value="1"/>
			<input type="hidden" name="return" value="{$templatelite.get.return|sanitize:3}"/>
			{#PLIGG_Visual_Login_Remember#}: <input type="checkbox" name="persistent" tabindex="42" />
			
			


<br>


			<input type="submit" value="{#PLIGG_Visual_Login_LoginButton#}" class="submit-s searchbutton" tabindex="43" />
		<input type="button" value="Register"  tabindex="44" class="searchbutton" onClick="window.location='{$my_base_url}{$my_pligg_base}/register'" /><br/>
	
	</form>

	{checkActionsTpl location="tpl_widget_login_end"}
</div>
{/if}