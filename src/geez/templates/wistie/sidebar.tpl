    

	        	



{if $pagename eq "topusers" ||  $pagename eq "tagcloud" || $pagename eq "live"}
 <div class="contact1">
		{literal}
<script type="text/javascript"><!--
google_ad_client = "pub-5074133216375147";
/* 160x600, created 4/27/09 */
google_ad_slot = "5481091797";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

{/literal}

</div>
 <div id="space">	            	</div>
{/if}

{if $pagename neq "submit"}
	{checkActionsTpl location="tpl_pligg_sidebar2_start"}
		{if $pagename eq "user"}
			<div class="headline">
				<div class="sectiontitle"><a href="{$user_url_personal_data}">Profile Links</a></div>
			</div>

			<div id="navcontainer">
				<ul id="navlist">
					{checkActionsTpl location="tpl_pligg_profile_sort_start"}
					<li><a href="{$user_url_personal_data}" class="navbut{$nav_pd}"><span>{#PLIGG_Visual_User_PersonalData#}</span></a></li>
					{if $user_login eq $user_logged_in}
					<li><a href="{$user_url_setting}" class="navbut{$nav_set}"><span>{#PLIGG_Visual_User_Setting#}</span></a></li>
					{/if}
					<li><a href="{$user_url_news_sent}" class="navbut{$nav_ns}"><span>{#PLIGG_Visual_User_NewsSent#}</span></a></li>
					<li><a href="{$user_url_news_published}" class="navbut{$nav_np}"><span>{#PLIGG_Visual_User_NewsPublished#}</span></a></li>
					<li><a href="{$user_url_news_unpublished}" class="navbut{$nav_nu}"><span>{#PLIGG_Visual_User_NewsUnPublished#}</span></a></li>
					<li><a href="{$user_url_commented}" class="navbut{$nav_c}"><span>{#PLIGG_Visual_User_NewsCommented#}</span></a></li>
					<li><a href="{$user_url_news_voted}" class="navbut{$nav_nv}"><span>{#PLIGG_Visual_User_NewsVoted#}</span></a></li>
					<li><a href="{$user_url_saved}" class="navbut{$nav_s}"><span>{#PLIGG_Visual_User_NewsSaved#}</span></a></li>
					{checkActionsTpl location="tpl_pligg_profile_sort_end"}
				</ul>
			</div>
		{/if}
                 {checkActionsTpl location="tpl_pligg_sidebar_middle"}
                 

	<!-- START ABOUT -->

	
	
	
 		{assign var=sidebar_module value="about_box"}{include file=$the_template_sidebar_modules."/wrapper.tpl"}
 		
 		
 		   
  
   
	<!-- END ABOUT -->
	



   <!-- START LINKS -->
   

 <div id="space">	            	</div>
   
   
     <div class="roundedcornr_box_699543">
   <div class="roundedcornr_top_699543"><div></div></div>
      <div class="roundedcornr_content_699543">

	
       
	
	
	        	<div class="links">
	            	<div class="sectiontitle1"><a href='{$URL_topusers}'> {#PLIGG_Visual_Top_Users#}</a></div>
	            </div>
	            <div class="links">
	            	<div class="sectiontitle1">{if $Enable_Tags eq 'true'}<a href="{$URL_tagcloud}">{#PLIGG_Visual_Tags#}</a>{/if}</div>
	            </div>
	            <div class="links">
	            	<div class="sectiontitle1">{if $Enable_Live eq 'false'} <a href='{$URL_live}'> {#PLIGG_Visual_Live#}</a>{/if}</div>
	            </div>


  
	<!-- END LINKS -->

	{checkActionsTpl location="tpl_pligg_sidebar2_end"}
   </div>
   <div class="roundedcornr_bottom_699543"><div></div></div>
</div>      
      

	
{/if}

  <div id="space">	            	</div>
	        	


 <div class="contact1">
{if $pagename eq "story"}
	

{/if}

</div>
    
		
 


	
 	        
		
		