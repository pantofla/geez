<?php
// this came from jspath.php
// this is so .js files will have access to some of the pligg variables
$include_login = false; // used in config.php
include_once('../config.php');
header("content-type: application/x-javascript");
?>

var my_base_url='<?php echo my_base_url ?>';
var my_pligg_base='<?php echo my_pligg_base ?>';


<?php
header("content-type: application/x-javascript");
$include_login = false; // used in config.php
include_once('../config.php');
include_once('../Smarty.class.php');

$smarty = new Smarty;
$smarty->config_dir= '';
$smarty->compile_dir = "../cache/templates_c";
$smarty->template_dir = "../templates";
$smarty->config_dir = "..";
$smarty->config_load("/languages/lang_" . pligg_language . ".conf");

$PLIGG_Visual_Vote_Cast = $smarty->get_config_vars('PLIGG_Visual_Vote_Cast');
$PLIGG_Visual_Vote_Report = $smarty->get_config_vars('PLIGG_Visual_Vote_Report');
$PLIGG_Visual_Vote_For_It = $smarty->get_config_vars('PLIGG_Visual_Vote_For_It');
$PLIGG_Visual_Comment_ThankYou_Rating = $smarty->get_config_vars('PLIGG_Visual_Comment_ThankYou_Rating');


?>
dochref = document.location.href.substr(document.location.href.search('/')+2, 1000);
if(dochref.search('/') == -1){
	$thisurl = document.location.href.substr(0,document.location.href.search('/')+2) + dochref;
} else {
	$thisurl = document.location.href.substr(0,document.location.href.search('/')+2) + dochref.substr(0, dochref.search('/'));
}
$thisurl = $thisurl + '<?php echo my_pligg_base; ?>';

var xmlhttp
/*@cc_on @*/
/*@if (@_jscript_version >= 5)
  try {
  xmlhttp=new ActiveXObject("Msxml2.XMLHTTP")
 } catch (e) {
  try {
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")
  } catch (E) {
   xmlhttp=false
  }
 }
@else
 xmlhttp=false
@end @*/

if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
{
  try {
	xmlhttp = new XMLHttpRequest ();
  }
  catch (e) {
  xmlhttp = false}
}

function myXMLHttpRequest ()
{
  var xmlhttplocal;
  try {
  	xmlhttplocal = new ActiveXObject ("Msxml2.XMLHTTP")}
  catch (e) {
	try {
	xmlhttplocal = new ActiveXObject ("Microsoft.XMLHTTP")}
	catch (E) {
	  xmlhttplocal = false;
	}
  }

  if (!xmlhttplocal && typeof XMLHttpRequest != 'undefined') {
	try {
	  var xmlhttplocal = new XMLHttpRequest ();
	}
	catch (e) {
	  var xmlhttplocal = false;
	}
  }
  return (xmlhttplocal);
}

var mnmxmlhttp = Array ();
var xvotesString = Array ();
var mnmPrevColor = Array ();
var responsestring = Array ();
var myxmlhttp = Array ();
var responseString = new String;


function vote (user, id, htmlid, md5, value)
{
  	if (xmlhttp) {
		url = $thisurl + "/vote.php";
		var mycontent = "id=" + id + "&user=" + user + "&md5=" + md5 + "&value=" + value;
		anonymous_vote = <?php echo anonymous_vote; ?>;
        if (anonymous_vote == false && user == '0') {
            window.location="<?php echo $my_base_url.$my_pligg_base; ?>/login.php?return="+location.href;
        } else {
    		mnmxmlhttp[htmlid] = new myXMLHttpRequest ();
    		if (mnmxmlhttp) {
    			mnmxmlhttp[htmlid].open ("POST", url, true);
    			mnmxmlhttp[htmlid].setRequestHeader ('Content-Type',
    					   'application/x-www-form-urlencoded');
    
    			mnmxmlhttp[htmlid].send (mycontent);
    			errormatch = new RegExp ("^ERROR:");    
    			target1 = document.getElementById ('xvotes-' + htmlid);    
    			mnmPrevColor[htmlid] = target1.style.backgroundColor;
    			mnmxmlhttp[htmlid].onreadystatechange = function () {
    				if (mnmxmlhttp[htmlid].readyState == 4) {
    					xvotesString[htmlid] = mnmxmlhttp[htmlid].responseText;
    					if (xvotesString[htmlid].match (errormatch)) {
    						xvotesString[htmlid] = xvotesString[htmlid].substring (6, xvotesString[htmlid].length);
							<?php if(Voting_Method == 1){
								echo "changemnmvalues (htmlid, value, true);";
							}?>
    					} else {
							<?php if(Voting_Method == 2){
								echo "var mySplitResult = xvotesString[htmlid].split('~');\n";
								echo "target3 = document.getElementById ('xvote-' + htmlid);\n";
								echo "target3.style.width = mySplitResult[0] + 'px';\n";
								echo "target4 = document.getElementById ('mnma-' + htmlid);\n";
								echo "target4.innerHTML = mySplitResult[1];\n";
								echo "target5 = document.getElementById ('mnmb-' + htmlid);\n";
								echo "target5.innerHTML = mySplitResult[2];\n";
								echo "target7 = document.getElementById ('xvotes-' + htmlid);\n";
								echo "target7.className = 'star-rating-noh';\n";
							}?>
							<?php if(Voting_Method == 1){
								echo 'if (xvotesString[htmlid].substring (1, 6) == "ERROR") { ';
								echo "alert(xvotesString[htmlid]);  } else {";
								echo "changemnmvalues (htmlid, value, false); } ";
							}?>
    					}
    				}
    			}
    		}
    	}
	}
}


function unvote (user, id, htmlid, md5, value)
{
  	if (xmlhttp) {
		url = $thisurl + "/vote.php";
		var mycontent = "unvote=true&id=" + id + "&user=" + user + "&md5=" + md5 + "&value=" + value;
		anonymous_vote = <?php echo anonymous_vote; ?>;
        if (anonymous_vote == false && user == '0') {
            window.location="<?php echo $my_base_url.$my_pligg_base; ?>/login.php?return="+location.href;
        } else {
    		mnmxmlhttp[htmlid] = new myXMLHttpRequest ();
    		if (mnmxmlhttp) {
    			mnmxmlhttp[htmlid].open ("POST", url, true);
    			mnmxmlhttp[htmlid].setRequestHeader ('Content-Type',
    					   'application/x-www-form-urlencoded');
    
    			mnmxmlhttp[htmlid].send (mycontent);
    			errormatch = new RegExp ("^ERROR:");    
				target1 = document.getElementById ('xvotes-' + htmlid);
  				target2 = document.getElementById ('xvote-' + htmlid);    
    			mnmPrevColor[htmlid] = target1.style.backgroundColor;
    			mnmxmlhttp[htmlid].onreadystatechange = function () {
    				if (mnmxmlhttp[htmlid].readyState == 4) {
    					xvotesString[htmlid] = mnmxmlhttp[htmlid].responseText;
    					if (xvotesString[htmlid].match (errormatch)) {
    						 xvotesString[htmlid] = xvotesString[htmlid].substring (6, xvotesString[htmlid].length);
							<?php if(Voting_Method == 1){
								echo "changemnmvalues (htmlid, value, true);";
								echo 'target2.innerHTML = "<span>' . $PLIGG_Visual_Vote_For_It . '</span>";';
							}?>
						} else {
							<?php if(Voting_Method == 1){
								echo 'if (xvotesString[htmlid].substring (1, 6) == "ERROR") { ';
								echo "alert(xvotesString[htmlid]);  } else {";
								echo 'target2.innerHTML = "<span>' . $PLIGG_Visual_Vote_For_It . '</span>";';
								echo "changemnmvalues (htmlid, value, false); ";
								echo "}";
							}?>							
    					}
    				}
    			}
    		}
    	}
	}
}


function cvote (user, id, htmlid, md5, value)
{
	if (xmlhttp) {
		url = $thisurl + "/cvote.php";
		mycontent = "id=" + id + "&user=" + user + "&md5=" + md5 + "&value=" + value;
		anonymous_vote = <?php echo anonymous_vote; ?>;

        if (anonymous_vote == false && user == '0') {
            window.location="<?php echo $my_base_url.$my_pligg_base; ?>/login.php?return="+location.href;
        } else {
    		mnmxmlhttp[htmlid] = new myXMLHttpRequest ();
    		if (mnmxmlhttp) {
    			mnmxmlhttp[htmlid].open ("POST", url, true);
    			mnmxmlhttp[htmlid].setRequestHeader ('Content-Type', 'application/x-www-form-urlencoded');    
    			mnmxmlhttp[htmlid].send (mycontent);
    			errormatch = new RegExp ("^ERROR:");
    			target1 = document.getElementById ('cvote-' + htmlid);        
    			mnmPrevColor[htmlid] = target1.style.backgroundColor;
    			target1.style.backgroundColor = '#FFFFFF';
    			mnmxmlhttp[htmlid].onreadystatechange = function () {
    				if (mnmxmlhttp[htmlid].readyState == 4) {
    					xvotesString[htmlid] = mnmxmlhttp[htmlid].responseText;
    					if (xvotesString[htmlid].match (errormatch)) {
    						xvotesString[htmlid] = xvotesString[htmlid].substring (6, xvotesString[htmlid].length);						
    						changecvotevalues (htmlid, true);							
    					} else {
							target1 = document.getElementById ('ratebuttons-' + id);
							target1.style.display = "none";
							target2 = document.getElementById ('ratetext-' + id);
							target2.innerHTML = "<?php echo $PLIGG_Visual_Comment_ThankYou_Rating;?>";
							changecvotevalues (htmlid, false);
    					}
    				}
    			}
    		}
    	}
	}
}

function changemnmvalues (id, value, error)
{
	split = new RegExp ("~--~");
	b = xvotesString[id].split (split);
	//alert(id);
	target1 = document.getElementById ('xvotes-' + id);
	target2 = document.getElementById ('xvote-' + id);
	target3 = document.getElementById ('xreport-' + id);
	target4 = document.getElementById ('xnews-' + id);
	if (error) {
		if (value > 0) { target2.innerHTML = "<span><?php echo $PLIGG_Visual_Vote_Cast;?></span> "; }
		else if (value < 0) { target2.innerHTML = "<span><?php echo $PLIGG_Visual_Vote_Report;?></span> "; }
		return false;
	}
	if (b.length <= 3) {
		target1.innerHTML = b[0];
		target1.style.backgroundColor = mnmPrevColor[id];
		new Effect.Fade(target3);
		if (value > 0) { target2.innerHTML = "<span><?php echo $PLIGG_Visual_Vote_Cast;?></span> "; }
		else if (value < 0 ) { target2.innerHTML = "<span><?php echo $PLIGG_Visual_Vote_Report;?></span> ";
													new Effect.Opacity(target4, {duration:0.8, from:1.0, to:0.3}); }
	}
	return false;
}

function changecvotevalues (id, error)
{
	split = new RegExp ("~--~");
	b = xvotesString[id].split (split);
	target1 = document.getElementById ('cvote-' + id);
	if (error) {
		return false;
	}
	if (b.length <= 3) {
		target1.innerHTML = b[0];
		target1.style.backgroundColor = mnmPrevColor[id];
	}
	return false;
}


function enablebutton (button, button2, target)
{
	var string = target.value;
	button2.disabled = false;
	if (string.length > 0) {
		button.disabled = false;
	} else {
		button.disabled = true;
	}
}

function checkfield (type, form, field)
{
	url = $thisurl + '/checkfield.php?type='+type+'&name=' + field.value;
	checkitxmlhttp = new myXMLHttpRequest ();
	checkitxmlhttp.open ("GET", url, true);
	checkitxmlhttp.onreadystatechange = function () {
		if (checkitxmlhttp.readyState == 4) {
		responsestring = checkitxmlhttp.responseText;
			if (responsestring == 'OK') {
				document.getElementById (field.name+'checkitvalue').innerHTML = '<span style="color:black">"' + field.value + 
						'": ' + responsestring + '</span>';
				form.submit.disabled = '';
			} else {
				document.getElementById (field.name+'checkitvalue').innerHTML = '<span style="color:red">"' + field.value + '": ' +
				responsestring + '</span>';
				form.submit.disabled = '';
			}
		}
	}
  checkitxmlhttp.send (null);
  return false;
}

function emailto (original_id, htmlid, instpath, address_count)
{
	email_message = document.getElementById('email_message' + htmlid).value;
	email_address = document.getElementById('email_address_1_' + htmlid).value;
	if (address_count > 1){ 
		for ($i = 2; $i <= address_count; $i++) {
			if(document.getElementById('email_address_' + $i + '_' + htmlid).value != "") {
				email_address = email_address + ', ' + document.getElementById('email_address_' + $i + '_' + htmlid).value;
			}
		}
	}
	
	if (xmlhttp) {
		url = $thisurl + "/recommend.php";
		mycontent = "email_address=" + escape(email_address) + "&email_to_submit=submit&email_message=" + escape(email_message) + "&original_id=" + original_id + "&backup=0";
		target2 = document.getElementById ('emailto-' + htmlid);
		target2.innerHTML = "<br>Sending, please wait....";
		
		mnmxmlhttp[htmlid] = new myXMLHttpRequest ();
		if (mnmxmlhttp) {
			mnmxmlhttp[htmlid].open ("POST", url, true);
			mnmxmlhttp[htmlid].setRequestHeader ('Content-Type',
					   'application/x-www-form-urlencoded');

			mnmxmlhttp[htmlid].send (mycontent);
			errormatch = new RegExp ("^ERROR:");
			target1 = document.getElementById ('emailto-' + htmlid);
			mnmxmlhttp[htmlid].onreadystatechange = function () {
				if (mnmxmlhttp[htmlid].readyState == 4) {
					xvotesString[htmlid] = mnmxmlhttp[htmlid].responseText;
			
					if (xvotesString[htmlid].match (errormatch)) {
						xvotesString[htmlid] = xvotesString[htmlid].substring (6, xvotesString[htmlid].length);						
						target2 = document.getElementById ('emailto-' + htmlid);
						target2.innerHTML = xvotesString[htmlid];						
					} else {
						target2 = document.getElementById ('emailto-' + htmlid);
						target2.innerHTML = xvotesString[htmlid];
					}
				}
			}
		}
	}
}

function show_recommend(htmlid, linkid, instpath)
{
	var emailtodisplay=document.getElementById('emailto-' + htmlid).style.display ? '' : 'none';
	document.getElementById('emailto-' + htmlid).style.display = emailtodisplay;

	if (xmlhttp) {
		url = $thisurl + "/recommend.php";
		mycontent = "draw=small&htmlid=" + htmlid + "&linkid=" + linkid;
		target2 = document.getElementById ('emailto-' + htmlid);
		target2.innerHTML = "<br>Loading, please wait....";		
		mnmxmlhttp[htmlid] = new myXMLHttpRequest ();
		
		if (mnmxmlhttp) {
			mnmxmlhttp[htmlid].open ("POST", url, true);
			mnmxmlhttp[htmlid].setRequestHeader ('Content-Type',
					   'application/x-www-form-urlencoded');

			mnmxmlhttp[htmlid].send (mycontent);
			errormatch = new RegExp ("^ERROR:");
			target1 = document.getElementById ('emailto-' + htmlid);
			mnmxmlhttp[htmlid].onreadystatechange = function () {
				if (mnmxmlhttp[htmlid].readyState == 4) {
					xvotesString[htmlid] = mnmxmlhttp[htmlid].responseText;			
					if (xvotesString[htmlid].match (errormatch)) {
						xvotesString[htmlid] = xvotesString[htmlid].substring (6, xvotesString[htmlid].length);						
						target2 = document.getElementById ('emailto-' + htmlid);
						target2.innerHTML = xvotesString[htmlid];						
					} else {
						target2 = document.getElementById ('emailto-' + htmlid);
						target2.innerHTML = xvotesString[htmlid];
					}
				}
			}
		}
	}
}
