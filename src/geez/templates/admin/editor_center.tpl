<fieldset><legend><img src="{$my_pligg_base}/templates/admin/images/template_edit.gif" align="absmiddle"/> {#PLIGG_Visual_AdminPanel_Editor#}</legend>
<a href="./admin_config.php?page=Template">{#PLIGG_Visual_AdminPanel_Editor_Change#}</a><br />
{php}

$filedir = "../templates/".The_Template;
echo $filedir;

$valid_ext[1] = "css";
$valid_ext[2] = "tpl";

if ($_SERVER['REQUEST_METHOD'] != 'POST'){
	if (is_readable($filedir)) {
{/php}

	<form action="" method="post">
	<br />
	<h3>{#PLIGG_Visual_AdminPanel_Editor_Choose#}</h3>
	{#PLIGG_Visual_AdminPanel_Editor_Choose_Chmod#}<br />

	<select name="the_file">
	{php}
	
	function directoryToArray($directory, $recursive) {
	$me = basename($_SERVER['PHP_SELF']);	
	$array_items = array();
		if ($handle = opendir($directory)) {
	  	while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != ".." && $file != $me && substr($file,0,1) != '.') {
	        if (is_dir($directory. "/" . $file)) {
						if($recursive) {
							$array_items = array_merge($array_items, directoryToArray($directory. "/" . $file, $recursive));
	          }						 
					}
					else {
	            $file = $directory . "/" . $file;
	            $array_items[] = preg_replace("/\/\//si", "/", $file);
					}
	      }
	    }
	    closedir($handle);
			asort($array_items);
	  }
	  return $array_items;
	}
	
	$filelist = directoryToArray($filedir, true);

	foreach ($filelist as $file) {
		$ext = substr(strrchr($file, '.'), 1);
			if (in_array($ext,$valid_ext) && is_writable($file)) {
				echo "<option value=\"$file\">$file</option>";
			}
	}
	{/php}

	</select>
  <br/>
	<input type="submit" name="open" value="Open" class="log2" />	
	
	</form>

	
	{php}
	}
	else {	
	echo "<h3>ERROR!</h3><p>Could not open directory! <br />Check your CHMOD settings in case it is a file/folder permissions problem.</p>";
	}
}
	
	///////////////////////////////////////////////////////////////////
	//If the open button has been pressed
	////////////////////////////////////////////////////////////////////
	else if (isset($_POST['open'])){
		if (is_writable($_POST["the_file"])) {
   
		{/php}
		
		<h3>File Opened</h3>

		<form action="" method="post">	
		<input type="hidden" name="the_file2" value="{php} echo $_POST["the_file"]; {/php}" />
		{php}
		echo "<p><strong>Currently open: ". sanitize($_POST["the_file"],3) ."</strong></p>";
		{/php}
		
		<textarea rows="30" id="editor" style="border: 1px solid #666666;" name="updatedfile">{php}
	
		$file2open = fopen($_POST["the_file"], "r");
	
		$current_data = @fread($file2open, filesize($_POST["the_file"]));
		$current_data = eregi_replace("</textarea>", "<END-TA-DO-NOT-EDIT>", $current_data);
	
		echo htmlspecialchars($current_data);
	
		fclose($file2open);
	
		{/php}</textarea>
		<br/>
		<input type="button" value="Cancel" onClick="javascript:location.href='{$my_base_url}{$my_pligg_base}/admin/admin_editor.php'" class="log2" />
		<input type="reset" value="Reset" class="log2">
		<input type="submit" name="save" value="Save Changes" class="log2" />
		
		</form>
		
		{php}
		}
		else {
		echo "<h3>ERROR!</h3><p>Could not open file! <br /> Check your CHMOD settings in case it is a file/folder permissions problem.</p>";
		}
	}
	
	///////////////////////////////////////////////////////
	//If save button has been pushed....
	//////////////////////////////////////////////////////
	else if (isset($_POST['save'])){
		if (is_writable($_POST["the_file2"])) {

		$file2ed = fopen($_POST["the_file2"], "w+");
		
		$data_to_save = $_POST["updatedfile"];
		$data_to_save = eregi_replace("<END-TA-DO-NOT-EDIT>", "</textarea>", $data_to_save);
		$data_to_save = stripslashes($data_to_save);

			if (fwrite($file2ed,$data_to_save)) { 
				echo "<h3>File Saved</h3><p><a href=\"\">Click here to go back to the editor.</a></p>";	
				fclose($file2ed);
			}
			else {	
				echo "<h3>ERROR!</h3><p>File NOT saved! <br /> Check your CHMOD settings in case it is a file/folder permissions problem. <br />  <a href=\"\">Click here to go back to the editor.</a></p>";
				fclose($file2ed);
			}
		}
		else {
			echo "<h3>ERROR!</h3><p>File NOT saved! <br />Check your CHMOD settings in case it is a file/folder permissions problem.</p>";
		}
	}
	
	{/php}
</fieldset>