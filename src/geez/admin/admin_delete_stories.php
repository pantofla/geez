<?php
include_once('../Smarty.class.php');
$main_smarty = new Smarty;

include('../config.php');
include(mnminclude.'html1.php');
include(mnminclude.'link.php');
include(mnminclude.'user.php');
include(mnminclude.'smartyvariables.php');

// require user to log in
force_authentication();

// restrict access to god only
$canIhaveAccess = 0;
$canIhaveAccess = $canIhaveAccess + checklevel('god');


function delete_storylink($linkid) {
    if (!is_numeric($linkid)) return;
   

    $query="SELECT * FROM " . table_links . " WHERE link_id = '$linkid'";
    if (! $result=mysql_query($query)) {error_page(mysql_error());}
    else {$sql_array = mysql_fetch_object($result); }

    # delete the story link
    $query="DELETE FROM " . table_links . " WHERE link_id = '$linkid'";
    if (! $result=mysql_query($query)) {error_page(mysql_error());}

    # delete the story comments
    $query="DELETE FROM " . table_comments . " WHERE comment_link_id = '$linkid'";
    if (! $result=mysql_query($query)) {error_page(mysql_error());}

    # delete the saved links
    $query="DELETE FROM " . table_saved_links . " WHERE saved_link_id = '$linkid'";
    if (! $result=mysql_query($query)) {error_page(mysql_error());}

    # delete the story tags
    $query="DELETE FROM " . table_tags . " WHERE tag_link_id = '$linkid'";
    if (! $result=mysql_query($query)) {error_page(mysql_error());}

    # delete the story trackbacks
    $query="DELETE FROM " . table_trackbacks . " WHERE trackback_link_id = '$linkid'";
    if (! $result=mysql_query($query)) {error_page(mysql_error());}

    # delete the story votes
    $query="DELETE FROM " . table_votes . " WHERE vote_link_id = '$linkid'";
    if (! $result=mysql_query($query)) {error_page(mysql_error());}

        }


$sql_query = "SELECT * FROM " . table_links . " WHERE link_status = 'discard'";

$result_storylinks = mysql_query($sql_query);
$num_rows = mysql_num_rows($result_storylinks);
                while($storylink = mysql_fetch_object($result_storylinks))
                {
                        delete_storylink($storylink->link_id);
                }

# set discards total to zero
$query="UPDATE " . table_totals . " SET total = '0' WHERE name = 'discard'";
if (!mysql_query($query)) error_page(mysql_error());


echo $num_rows. " discarded stories deleted";

?>
<p><a href="admin_optimize_database.php">Click here</a> to optimize database</p>