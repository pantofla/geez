<?php
$username = "pantofla_pantofl";
$password = "ntouzos21";
$hostname = "localhost";	
$dbh = mysql_connect($hostname, $username, $password) 
	or die("Unable to connect to mysql");
print "connected to mysql<br>";
$selected = mysql_select_db("pantofla_geez",$dbh) 
	or die("Could not select pantofla_geez");



 $result = mysql_query("update pligg_links set link_votes=link_votes+1 where link_votes < 3");

mysql_close($dbh);
?>