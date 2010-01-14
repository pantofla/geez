<?php
/*
    XML Sitemaps module for Pligg
    Copyright (C) 2007-2008  Secasiu Mihai - http://patchlog.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/
	
function xml_sitemaps_show_sitemap(){
	ob_end_clean();
	header("Content-type: text/xml");
	if(isset($_GET['i'])){
		if(is_numeric($_GET['i'])) create_sitemap($_GET['i'],XmlSitemaps_Links_per_sitemap);
		else if ($_GET['i']=="pages") create_sitemap_pages();
	}else create_sitemaps_index(XmlSitemaps_Links_per_sitemap);
}

function my_file_get_contents($filename)
{
	if (false === $fh = fopen($filename, 'rb', $incpath)) {
		trigger_error('my_file_get_contents() failed to open stream: No such file or directory: '.$filename, E_USER_WARNING);
		return false;
	}
 	flock($fh,LOCK_EX);
	clearstatcache();
	if ($fsize = @filesize($filename)) {
		$data = fread($fh, $fsize);
	} else {
		$data = '';
		while (!feof($fh)) {
			$data .= fread($fh, 8192);
		}
	}
	
	fclose($fh);
	return $data;
}
function my_file_put_contents($n, $d) 
{
	$f = @fopen($n, 'w');
	if ($f === false) {
       		return 0;
	} else {
		flock($f,LOCK_EX);
       		if (is_array($d)) $d = implode($d);
	        $bytes_written = fwrite($f, $d);
       		fclose($f);
		return $bytes_written;
    	}
}

function my_format_date($mtime)
{

	$ret=date('Y-m-d\TH:i:s',$mtime);
	$ret.=preg_replace('/(\+|\-)([0-9]{2})([0-9]{2})/','$1$2:$3',date('O',$mtime));
	return $ret;
}

function create_sitemaps_index($max_rec)
{
	global $db,$my_base_url,$my_pligg_base;
	$nr=0;
	if(XmlSitemaps_use_cache){
		$icf='cache/sitemapindex.xml';
		if(file_exists($icf) && ($s=stat($icf)) && time()-$s['mtime']<XmlSitemaps_cache_ttl){
			
			echo my_file_get_contents($icf);
			return true;			
		}
		ob_start();
	}
        $sql = "SELECT count(*)  FROM ".table_links." WHERE link_status!='discard'";
        $r = $db->get_col($sql);
        $res = $r[0];
        if ($res > $max_rec)
	$nr = floor($res/$max_rec);
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	echo "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
	for($i=$nr;$i>=0;$i--){
		$sql="select max(l.link_modified) from (select link_modified from ".table_links." where link_status!='discard' order by link_modified asc limit ".$i*$max_rec.",$max_rec ) l";
		$r=$db->get_col($sql);
		echo "<sitemap>\n";
		if (XmlSitemaps_friendly_url) 
			echo "<loc>$my_base_url$my_pligg_base/sitemap-$i.xml</loc>\n";
		else 
			echo "<loc>$my_base_url$my_pligg_base/module.php?module=xml_sitemaps_show_sitemap&amp;i=$i</loc>\n";
			echo "<lastmod>";
			echo my_format_date(strtotime($r[0]));
			echo "</lastmod>";
		echo "</sitemap>";

	}		
	echo "<sitemap>\n";
	if(XmlSitemaps_friendly_url){
	        echo "<loc>$my_base_url$my_pligg_base/sitemap-pages.xml</loc>\n";
	}else{
		echo "<loc>$my_base_url$my_pligg_base/module.php?module=xml_sitemaps_show_sitemap&amp;i=pages</loc>\n";
	}
        echo "</sitemap>";

	echo "</sitemapindex>\n";
	if(XmlSitemaps_use_cache){
		$ret=ob_get_contents();
		ob_end_flush();
		my_file_put_contents($icf,$ret);
	}
	return true;
}

function create_sitemap($index,$max_rec){
	global $db,$my_base_url,$my_pligg_base;
		
	if(XmlSitemaps_use_cache){
		$icf="cache/sitemap-$index.xml";
		if(file_exists($icf) && ($s=stat($icf)) && time()-$s['mtime']<XmlSitemaps_cache_ttl){
			
			echo my_file_get_contents($icf);
			return true;			
		}
		ob_start();
	}

	echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
       	echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/09/sitemap.xsd"     xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

	$sql = "SELECT l.link_id FROM (select link_id,link_modified from ".table_links." WHERE link_status!='discard' order by link_modified asc LIMIT ".$index*$max_rec.",".$max_rec .") l  order by l.link_modified desc";
	$link = new Link;
	$links = $db->get_col($sql);
	if($index!=0)$did_mainpage=1;
	else $did_mainpage=0;
	if ($links) {
		foreach($links as $link_id) {
			$link->id=$link_id;
			$link->read();
			//print_r($link);
			//return ;
			$freq = freq_calc($link->modified);
			echo "<url>\n";
			echo "<loc>".getmyFullurl("storyURL", urlencode($link->category_safe_name($link->category)), urlencode($link->title_url), $link->id)."</loc>\n";
			//c / v  * 30   + vo /v * 10 +  ( 100 / acum-mod  ) * 60  
			$v=(time()-$link->date)/60;
			$pri=max(0.0001,(( $link->comments /$v ) * 30  + ( $link->votes * 10  / $v ) + ( 100 / max(100,time()-$link->modified) )  * 60 )/ 100 );
	
			echo "<lastmod>";
			echo my_format_date($link->modified);
			echo "</lastmod>\n";
			echo "<changefreq>$freq</changefreq>\n";
			echo "<priority>".$pri."</priority>\n";
			echo "</url>\n";
		}
	}	
	echo '</urlset>';

	if(XmlSitemaps_use_cache){
		$ret=ob_get_contents();
		ob_end_flush();
		my_file_put_contents($icf,$ret);
	}
	return true;
}

function create_sitemap_pages(){
	global $db,$my_base_url,$my_pligg_base,$URLMethod;

	if(XmlSitemaps_use_cache){
		$icf="cache/sitemap-pages.xml";
		if(file_exists($icf) && ($s=stat($icf)) && time()-$s['mtime']<XmlSitemaps_cache_ttl){
			
			echo my_file_get_contents($icf);
			return true;			
		}
		ob_start();
	}
        echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/09/sitemap.xsd"     xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
	$sql = "SELECT link_modified  FROM ".table_links." WHERE link_status!='discard' ORDER BY link_modified DESC LIMIT 1";
        $res = $db->get_col($sql);
        if (isset($res[0])){
                $path = "$my_base_url$my_pligg_base";
                create_entry(strtotime($res[0]),$path);
        }
	
	///////////////// Upcoming.............
	$sql = "SELECT UNIX_TIMESTAMP(link_date)  FROM ".table_links." WHERE link_status='queued' ORDER BY link_date DESC LIMIT 1";
	$res = $db->get_col($sql);
	if (isset($res[0])){
		if($URLMethod == 1){
			$path = "$my_base_url$my_pligg_base/upcoming.php";
		} else if($URLMethod == 2 ) {
			$path = "$my_base_url$my_pligg_base/upcoming";
		}
		create_entry($res[0],$path);
	}
	
	//////////////////////...........categories.................
	$sql = "SELECT category_id,category_name,category_safe_name FROM ".table_categories." WHERE category_enabled=1 AND category_name!='new category'";
	$cat = $db->get_results($sql);
	foreach ($cat as $i){
		$sql = "SELECT UNIX_TIMESTAMP(link_published_date),link_id FROM ".table_links." WHERE link_category=".$i->category_id." AND link_status='published' ORDER BY link_published_date DESC LIMIT 1";
		$res = $db->get_col($sql);
		if (isset($res[0])){
			$path = getmyFullurl('maincategory',urlencode($i->category_safe_name));
			create_entry($res[0],$path);
		}
			
	}
	////////////////////.............upcoming categories..........
	foreach($cat as $i){
		$sql = "SELECT UNIX_TIMESTAMP(link_date) FROM ".table_links." WHERE link_category=".$i->category_id." AND link_status='queued' ORDER BY link_date DESC LIMIT 1";	
		$res = $db->get_col($sql);
                if (isset($res[0])){
			$path = getmyFullurl('queuedcategory',urlencode($i->category_safe_name));
			create_entry($res[0],$path);
                }
	}

	if(check_for_enabled_module('extra_pages',0.1)){
	//.............Tips page...............
	$sql = "SELECT UNIX_TIMESTAMP(modified_date) FROM ".table_prefix."extra_pages  WHERE type='Tip' ORDER BY modified_date DESC LIMIT 1";
	$res = $db->get_col($sql);
	if (isset($res[0])){
		if($URLMethod == 1){
			$path = "$my_base_url$my_pligg_base/module.php?module=extra_pages&amp;action=show_tips";
		}else if($URLMethod == 2){
			$path = "$my_base_url$my_pligg_base/tips";
		}
		create_entry($res[0],$path);
	}
	//.............FAQ page................
	$sql = "SELECT UNIX_TIMESTAMP(modified_date) FROM ".table_prefix."extra_pages  WHERE type='FAQ' ORDER BY modified_date DESC LIMIT 1";
        $res = $db->get_col($sql);
        if (isset($res[0])){
		if($URLMethod == 1){
                	$path = "$my_base_url$my_pligg_base/module.php?module=extra_pages&amp;action=show_faq";
		}else if($URLMethod == 2){
			$path = "$my_base_url$my_pligg_base/faq";
		}
                create_entry($res[0],$path);
        }
	}
	//close xml
	echo '</urlset>';

	if(XmlSitemaps_use_cache){
		$ret=ob_get_contents();
		ob_end_flush();
		my_file_put_contents($icf,$ret);
	}
	return true;
}

function create_entry($m_time,$path){
	$freq = freq_calc($m_time);
        echo "<url>\n";
        echo "<loc>$path</loc>";
        echo "<lastmod>";
	echo my_format_date($m_time);
	echo "</lastmod>\n";
        echo "<changefreq>$freq</changefreq>\n";
        echo "</url>\n";
}

function freq_calc($d){
	$freq = time()-$d;
	if ($freq<3600) $freq = "Hourly";
        elseif ($freq<86400) $freq = "Daily";
        else if ($freq<604800) $freq = "Weekly";
        else if($freq<2678400) $freq = "Monthly";
        else if($freq<32140800) $freq = "Yearly";
        else $freq = "Never";
	return $freq;
}

function xml_sitemaps_sites_ping(){
	global $my_base_url,$my_pligg_base;
	$res= "";

	if (XmlSitemaps_friendly_url) 
		$Url = "$my_base_url$my_pligg_base/sitemapindex.xml";
	else {
		$Url = "$my_base_url$my_pligg_base/modules.php?module=xml_sitemaps_show_sitemap";
		$Url = urlencode($Url);
	}
	if (XmlSitemaps_use_cache && ($s=stat('cache/sitemapindex.xml')) && time()-$s['mtime']<XmlSitemaps_cache_ttl){
		return true;
	}
	if (XmlSitemaps_ping_google){
		$pingUrl="http://www.google.com/webmasters/sitemaps/ping?sitemap=".$Url;
		$pingres=fopen($pingUrl,'r');
		while ($res=fread($pingres,8192)){	
			//echo $res."\n";
		}
		fclose($pingres);
	}

	if (XmlSitemaps_ping_ask){
		$pingUrl="http://submissions.ask.com/ping?sitemap=".$Url;
        	$pingres=fopen($pingUrl,'r');
	        while ($res=fread($pingres,8192)){
        	        //echo $res;
	        }
		fclose($pingres);
	}

	if (XmlSitemaps_ping_yahoo){
		$pingUrl="http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid=".Xml_Sitemaps_yahoo_key."&url=".$Url;
        	$pingres=fopen($pingUrl,'r');
		while ($res=fread($pingres,8192)){
        	        //echo $res;
	        }
        	fclose($pingres);
	} 
}
?>
