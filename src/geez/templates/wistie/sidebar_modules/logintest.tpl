{if $user_authenticated neq "true"}	

<div id="yoatest">
{checkActionsTpl location="tpl_widget_login_start"}

	<form action="{$URL_login}" method="post"> 
					<span class="boxcontent3"><input type="checkbox" name="persistent" tabindex="42" />{#PLIGG_Visual_Login_Remember#} </span><a href="{$URL_login}" class="boxcontent3" >{#PLIGG_Visual_Login_ForgottenPassword#}</a><br />		
			<input type="text" name="username" class="login " size="8" value="username" onfocus="if(this.value == 'username') {ldelim}this.value = '';{rdelim}" onblur="if (this.value == '') {ldelim}this.value = 'username';{rdelim}" "{if isset($login_username)}{/if}" tabindex="1" />
			<input type="password" name="password" size="8" class="login" tabindex="2"  value="password" onfocus="if(this.value == 'password') {ldelim}this.value = '';{rdelim}" onblur="if (this.value == '') {ldelim}this.value = 'password';{rdelim}" />
			<span class="boxcontent3"><input type="image"  src="{$my_pligg_base}/templates/{$the_template}/images/button/but.png"  width=50 height=20 value="submit" class="submit-s loginbutton" tabindex="3" /></span>
			<input type="hidden" name="processlogin" value="1"/>
			<input type="hidden" name="return" value="{$templatelite.get.return|sanitize:3}"/>

<br />


   	 <a href="{$URL_register}" class="boxcontent3" >{#PLIGG_Visual_Register#}</a> 
	</form>
</div>


	{checkActionsTpl location="tpl_widget_login_end"}   

	
{elseif $user_authenticated eq "true"}

<div class="boxcontent2">
				{#PLIGG_Visual_Welcome_Back#}<a href="{$URL_userNoVar}">{$user_logged_in}</a> | <a href="{$URL_logout}"> {#PLIGG_Visual_Logout#}</a>

				</div>		
{/if}