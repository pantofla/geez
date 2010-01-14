<div style="padding-left:10px;">
<h2>Create New User</h2>
<form action="" method="post" onsubmit="validate();" onsubmit="self.close ();">
  <div style="padding-left:20px;font-weight:bold;">
	<form action="" method="post" onsubmit="validate();" class="form">
	
	  <label for="username">{#PLIGG_Visual_Register_Username#}:</label>
	    <div class="div_texbox">
	    <input name="username" type="text" class="textbox" id="username" value="" />
		</div>
		<div style="clear:both;"></div>
		<label for="email">{#PLIGG_Visual_Register_Email#}:</label>
		<div class="div_texbox">
	    <input name="email" type="text" class="textbox" id="city" value="" />
		</div>
		<div style="clear:both;"></div>
		<label>{#PLIGG_Visual_View_User_Level#}:</label>
		<div class="div_texbox">
		<select name="level">
		<option value="normal">Normal</option>
		<option value="admin">Admin</option>
		<option value="god">God</option>	
		</select>
		</div>
		<div style="clear:both;"></div>
		<label for="password">{#PLIGG_Visual_Register_Password#}:</label>
	    <div class="div_texbox">
	    <input name="password" type="text" class="textbox" id="password" value="" />
		</div>
		<div style="clear:both;"></div>
		<div class="buton_div">
		<input type="hidden" name="mode" value="newuser">
		<input type="submit" value="Create User" class="log2 buttons buttonright" onclick="parent.box.close()" />
		</div>
		
	</form>
	</div>
</form>
</div>