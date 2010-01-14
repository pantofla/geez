<?php
/**
 *
 *	Zoki Poll html code
 *
 *	This is main poll file. It provides html container for poll,
 *	and initiates js functions
 *
 *	Copyright (c) 2007, Zoki Soft <info@zokisoft.com>.
 *
 *	This file is part of ZokiPoll.
 *
 *	Zoki Poll is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Lesser General Public License as published by
 *	the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	Zoki Poll is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Lesser General Public License for more details.
 *
 *	You should have received a copy of the GNU Lesser General Public License
 *	along with Zoki Poll.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
	// include config file
	include("poll_config.php");

	// site url
	$sSiteUrl = $pollConfig['site']['url'];

	// this is id of poll in database you want to load
	// this is place where you would probably play with id numbers in your
	// original script.
	$Id = 1;

?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="en-bg" lang="en-gb">
<head>
	<title>dynamic poll</title>

	<!-- include js with ajax functionality -->
	<script type="text/javascript" src="<?=$pollConfig['site']['url']?>/js/_async.js"></script>

	<!-- include js with poll functionality -->
	<script type="text/javascript" src="<?=$pollConfig['site']['url']?>/js/_poll.js"></script>

	<!-- include css styles for poll -->
	<link rel="stylesheet" type="text/css" href="<?=$pollConfig['style']['css']?>_poll.css" />
	<link rel="stylesheet" type="text/css" href="<?=$pollConfig['style']['css']?>_poll_v2.css" />


</head>
<body>
<!-- end of html header --->





	<div class="pollBox">

		<div class="clearBoth"></div>

		<div id="dpol_<?=$Id?>"  class="pollContainer">

			<div id="dpol_caption_<?=$Id?>" class="pollCaption"></div>

			<div id="dpol_question_<?=$Id?>" class="pollBodyBlock">

				<div id="dpol_arr_up_<?=$Id?>" class="pollUp" onmouseover="javascript: scrollStart(document.getElementById('dpol_content_<?=$Id?>'), 'down');" onmouseout="javascript: scrollStop();">
					<img src="<?=$pollConfig['style']['img']?>pollUp.gif" alt="up" />
				</div>

				<div id="dpol_arr_down_<?=$Id?>" class="pollDown" onmouseover="javascript: scrollStart(document.getElementById('dpol_content_<?=$Id?>'), 'up');" onmouseout="javascript: scrollStop();">
					<img src="<?=$pollConfig['style']['img']?>pollDown.gif" alt="down" />
				</div>

				<div id="dpol_content_<?=$Id?>" class="pollContentBlock"></div>

			</div>

			<div id="dpol_actions_<?=$Id?>" class="pollSubmitBlock">
				<a href="#" onclick="javascript: if ( document.getElementById('current_vote_<?=$Id?>') && '' != (cVote=document.getElementById('current_vote_<?=$Id?>').value) ){ serverQuery( '', '<?=$sSiteUrl . '/' . 'async.php?action=set_poll_vote&pollid=' . $Id?>' + '&voteid=' + cVote); }else{ cVote=''; } aPollDoubleItem = new Array(); pollResultList(pollData_<?=$Id?>, cVote); return false;">
					<img src="<?=$pollConfig['style']['img']?>pollSubmit.gif" alt="rez" border="0">
				</a>
			</div>

		</div>

	    <script type="text/javascript">

			<?
			$sFuncName = 'pollVariantList';
			// if unicheck enabled and cookie set - show results, otherwise - show question
			if ( '1' == $pollConfig['poll']['uniqcheck'] )
				if (isset($_COOKIE['poll']))
    				foreach ($_COOKIE['poll'] as $name => $value)
        				if ( $Id == $value )
							$sFuncName = 'pollResultList';
			?>

			function createVar( pollData )
			{
				self['pollData_' + <?=$Id?>] = pollData;
				<?=$sFuncName?>(pollData_<?=$Id?>);
			}

			// load question
			serverQuery(createVar, '<?=$sSiteUrl . '/' . 'async.php?action=get_xml_poll_data&pollid=' . $Id?>', 'xml' );

	    </script>

		<div class="clearBoth"></div>

	</div>

<!-- html footer -->
</body>
</html>