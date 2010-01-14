{checkActionsTpl location="tpl_admin_modules_top"} 
{php}

		global $db, $main_smarty;	
		
		if(isset($_REQUEST['action'])){
			$action = sanitize($_REQUEST['action'],3);
		}else{
			$action = 'main';
		}	
		
		if($action == 'main'){
		
		echo '<fieldset><legend><img src="'.my_pligg_base.'/templates/admin/images/manage_mods.gif" align="absmiddle"/> '.$main_smarty->get_config_vars('PLIGG_Visual_AdminPanel_Module_Management').' </legend>';
		echo '<h2>'.$main_smarty->get_config_vars('PLIGG_Visual_Modules_Installed').'</h2><hr/>';
		$modules = $db->get_results('SELECT * from ' . table_modules . ' order by id desc;');
		if($modules){
			echo "<style type='text/css'>table.modules th,table.modules td {padding:4px 2px;border:0px;border:1px solid #bbb;text-align:center;}table.modules h3 {text-align:left;font-size:14px;padding:0 10px;}table.modules p {text-align:left;padding:0 10px;}</style>";
			foreach($modules as $module) {
					echo '<table class="modules"><tr><td width="33%"><h3><a href = "?action=readme&module=' . $module->folder . '">' . $module->name . '</a></h3></td><td width="12%"><strong>Version: </strong>' . $module->version .'</td>';
				if($module->enabled == 1){
					echo '<td width="10%"><a style="color:#95010A" href = "?action=disable&module=' . $module->name . '">'.$main_smarty->get_config_vars('PLIGG_Visual_AdminPanel_Module_Disable').'</a></td><td width="10%"><span style="color:#bbb;">'.$main_smarty->get_config_vars('PLIGG_Visual_AdminPanel_Module_Remove').'</span></td>';
				} else {
					echo '<td width="10%"><a style="color:#098602" href = "?action=enable&module=' . $module->name . '">'.$main_smarty->get_config_vars('PLIGG_Visual_AdminPanel_Module_Enable').'</a></td width="10%"> <td width="10%"><a style="color:#95010A" href = "?action=remove&module=' . $module->name . '">'.$main_smarty->get_config_vars('PLIGG_Visual_AdminPanel_Module_Remove').'</a> </td>';
				}	
				 
				echo '</tr><tr>';
				if($module_info = include_module_settings($module->folder)){
				
				echo '<td colspan="1"><p><strong>Description: </strong>' . $module_info['desc'] . '</p>';
				if(isset($module_info['requires'])){
					$requires = $module_info['requires'];
					if(is_array($requires)){
						foreach($requires as $requirement){
							echo '<p><strong>Requires: </strong> ' . $requirement[0] . ' Version ' . $requirement[1];
							if(check_for_enabled_module($requirement[0], $requirement[1])){
								echo ' - <span style="font-weight:bold;color:#098602;">Pass</span>';
							} else {
								echo ' - <span style="font-weight:bold;color:#95010A;">Fail</span>';
							}
							echo '</p>';
						}
					}
				}
				echo '</td>';
					
				$versionupdate = '';
				if(isset($module_info['update_url']))	
				{
					
					$updateurl  = $module_info['update_url'];					   
					$versionupdate = safe_file_get_contents($updateurl);
				}
				if (preg_match('/(\d+[\d\.]+)/',$versionupdate,$m) && $m[1] != $module->latest_version)
				{
					$versionupdate = $m[1];
					$db->query($sql="UPDATE `". table_modules . "` SET `latest_version`='$versionupdate' WHERE `id`='{$module->id}'");
				}
				else
					$versionupdate = $module->latest_version;
				if ($versionupdate > 0)
					echo "<td width=\"15%\"><strong>Latest Version: </strong>$versionupdate</td>";
				else
					echo "<td width=\"15%\">Unavailable</td>";
				
				if(isset($module_info['homepage_url'])){
					$homepage_url = $module_info['homepage_url'];
						echo '<td colspan="2" width="10%"><a href="' . $homepage_url . '" target=_blank">Homepage</a></td>';
					} else {
						echo '<td colspan="2" width="10%">No Homepage</td>';
					}
				}
				echo '</tr></table><br />';
			}
		} else {
			echo '<h3>There are no modules installed</h3>';
		}
		
		echo '<hr /><h2>'.$main_smarty->get_config_vars('PLIGG_Visual_Modules_Not_Installed').'</h2><hr />';	
		
		// find all the folders in the modules folder
		$dir = '../modules/';
		if (is_dir($dir)) {
		   if ($dh = opendir($dir)) {
		       while (($file = readdir($dh)) !== false) {
		       		if(is_dir($dir . $file)){
		       			if($file != '.' && $file != '..'){
		       				$foundfolders[] = $file;
		           	}
		          }
		       }
		       closedir($dh);
		   }
		}
		
	
		// for each of the folders found, make sure they're not already in the database
		$modules = $db->get_results('SELECT * from ' . table_modules . ';');
		if($modules){
			foreach($modules as $module) {
				if(isset($foundfolders) && is_array($foundfolders)){
					foreach($foundfolders as $key => $value){
						if ($module->folder == $value){
							unset($foundfolders[$key]);
						}
					}
				}
			}		
		}		
		
		if(isset($foundfolders) && is_array($foundfolders)){		
		foreach($foundfolders as $key => $value){
			$text = '';
			if($module_info = include_module_settings($value)){
				$text[] = '<td><p><strong>Description:</strong> ' . $module_info['desc'] . '';
				$version = $module_info['version'];
				$name = $module_info['name'];
				if(isset($module_info['requires'])){
					$requires = $module_info['requires'];
					if(is_array($requires)){
						foreach($requires as $requirement){
							$text[] = '<br /><strong>Requires:</strong> ' . $requirement[0] . ' version ' . $requirement[1];
							if(check_for_enabled_module($requirement[0], $requirement[1])){
								$text[] = ' - <span style="font-weight:bold;color:#098602;">Pass</span>';
							} else {
								$text[] = ' - <span style="font-weight:bold;color:#95010A;">Fail</span>';
							}
						}
					}
				}
				echo '</p></td>';
				
				$thename = $name . ' v ' . $version;
				
				if(file_exists('../modules/' . $value . '/' . $value . '_readme.htm')){
					echo '<table class="modules"><tr><td width="10%"><a href = "?action=install&module=' . $value . '">Install</a></td><td width="30%"><p><a href = "?action=readme&module=' . $value . '">' . $thename . '</a></p></td>';
				} else {
					echo $thename;
				}
				
	
				if(is_array($text)){foreach($text as $tex){echo $tex;}}

			} else {
				// this is where folders are found but don't have the install file.
				}
			}
		}
	}
	
	if($action == 'install'){
		$module = $db->escape(sanitize($_REQUEST['module'],3));

		if($module_info = include_module_settings($module))
		{
			$version = $module_info['version'];
			$name = $module_info['name'];
			$requires = $module_info['requires'];
			check_module_requirements($requires);
			
			process_db_requirements($module_info);
			
		} else {
			die('no install file exists');
		}
			
		$db->query("INSERT INTO " . table_modules . " (`name`, `version`, `folder`, `enabled`) values ('".$name."', '" . $version . "', '".$module."', 1);");

		clear_module_cache();

		header('Location: admin_modules.php');
	}	
	

	if($action == 'disable'){
		$module = $db->escape(sanitize($_REQUEST['module'],3));
		$sql = "UPDATE " . table_modules . " set enabled = 0 where `name` = '" . $module . "';";
		//echo $sql;
		$db->query($sql);

		clear_module_cache();

		header('Location: admin_modules.php');
	}	
	

	if($action == 'enable'){
		$module = $db->escape(sanitize($_REQUEST['module'],3));
		$sql = "UPDATE " . table_modules . " set enabled = 1 where `name` = '" . $module . "';";
		//echo $sql;
		$db->query($sql);

		clear_module_cache();

		header('Location: admin_modules.php');
	}
	
	if($action == 'remove'){
		$module = $db->escape(sanitize($_REQUEST['module'],3));
		$sql = "Delete from " . table_modules . " where `name` = '" . $module . "';";
		//echo $sql;
		$db->query($sql);

		clear_module_cache();

		header('Location: admin_modules.php');
	}	
	
	
	if($action == 'readme'){
		$module = sanitize($_REQUEST['module'],3);
		echo '<fieldset><legend><img src="'.my_pligg_base.'/templates/admin/images/manage_mods.gif" align="absmiddle"/> '.$main_smarty->get_config_vars('PLIGG_Visual_AdminPanel_Module_Management').'</legend>';
		echo '<a href="'.my_pligg_base.'/admin/admin_modules.php">'.$main_smarty->get_config_vars('PLIGG_Visual_AdminPanel_Module_Return').'</a><br />';
		include_once('../modules/' . $module . '/' . $module . '_readme.htm');	
		echo '</fieldset>';		
		
	}	
	
		echo '</fieldset>';

	function clear_module_cache () {
		global $db;
		if(caching == 1){
			// this is to clear the cache and reload it for settings_from_db.php
			$db->cache_dir = mnmpath.'cache';
			$db->use_disk_cache = true;
			$db->cache_queries = true;
			$db->cache_timeout = 0;
			// if this query is changed, be sure to also change it in modules_init.php
			$modules = $db->get_results('SELECT * from ' . table_modules . ' where enabled=1;');
			$db->cache_queries = false;
		}
	}

	function safe_file_get_contents($url,$redirect=0)
	{
   	    $parts = parse_url($url);
	    $site  = $parts['host'];
	    $port  = $parts['port'] ? $parts['port'] : 80;
	    $path  = $parts['path'] . ($parts['query'] ? "?".$parts['query'] : "") . ($parts['fragment'] ? "#".$parts['fragment'] : "");
	    $sock = @fsockopen( $site, $port, $errnum, $errstr);
	    if (!$sock) {
		return "Cannot connect to $site:$port: $errstr($errno)";
	    } else {
		$dump = "GET ".$path." HTTP/1.0\r\n";
		$dump .= "User-Agent: Mozilla/4.0 (compatible; MSIE 5.01; Windows NT)\r\n";
		$dump .= "Host: ".$site."\r\n";
		$dump .= "Connection: close\r\n\r\n";
	
		$res = "";
		// Send HTTP query
        	fputs( $sock, $dump );
	
		// Read all
		$header = true;
		while( $str = fgets( $sock, 1024 ) ) 
		{
		    if ($header)
		    {
			if (preg_match("/^Location: ([^\\s]+)\\s*$/",$str,$m) && ++$redirect<10)
				return safe_file_get_contents($m[1],$redirect);
			if ($str == "\r\n")
			    $header = false;
		    }
		    else
        		$res .= $str;
		}
		fclose( $sock );
	    }
	    return $res;
	}
	
		
{/php}