<?php
/**
 *	Zoki Poll backend functions
 *
 *	This file provides functions that interacts with js ajax calls
 *	and returns data to poll in xml format
 *
 * 	This file optionally requires Database Connection.
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


	// handle values from $_GET array
	// if action defined
	if ( !empty($_GET['action']) )
	{

		// check action names
		if ( 'get_xml_poll_data' == $_GET['action'] )
		{
			// if poll id specified - call function
			$iPollId = !empty($_GET['pollid']) ? (int)$_GET['pollid'] : 0;
			if ( 0 < $iPollId )
				if ( 'base' == $pollConfig['poll']['datasource'] )
					get_xml_poll_data_db( $iPollId );
				else
					get_xml_poll_data_file( $iPollId );

		}
		elseif ( 'set_poll_vote' == $_GET['action'] )
		{

			$iPollId = !empty($_GET['pollid']) ? (int)$_GET['pollid'] : 0;
			$iVoteId = @$_GET['voteid'];

			// if unicheck enabled - check for uniq user
			if ( '1' == $pollConfig['poll']['uniqcheck'] )
				if (isset($_COOKIE['poll']))
    				foreach ($_COOKIE['poll'] as $name => $value)
        				if ( $iPollId == $value )
        					exit;


			if ( 0 < $iPollId && isset($iVoteId) )
				if ( 'base' == $pollConfig['poll']['datasource'] )
					$bRes = set_poll_vote_db( $iPollId, $iVoteId );
				else
					$bRes = set_poll_vote_file( $iPollId, $iVoteId );

			// if unicheck enabled - set cookie to user mashine
			if ( '1' == $pollConfig['poll']['uniqcheck'] && $bRes )
				setcookie("poll[{$iPollId}]", $iPollId, time()+60*60*24, '/');


		}


	}

// ========================================================================
// ========================================================================


	/**
	 * Establish database connection according data in config file
	 *
	 * @return	boolean	if connection has been established correctly
	 */
	function mySqlConnect()
	{

		global $pollConfig;

		$rLink = mysql_connect( $pollConfig['database']['host'], $pollConfig['database']['user'], $pollConfig['database']['pass'] );
		if (!$rLink)
		{
			return false;
		    //die('Not connected : ' . mysql_error());
		}

		$bDbSelected = mysql_select_db($pollConfig['database']['dbname'], $rLink);
		if (!$bDbSelected)
		{
			return false;
		    //die ('Can\'t use foo : ' . mysql_error());
		}

		return true;

	}


	/**
	 * update&savee poll vote data
	 *
	 * @param	int poll id
	 * @param	int vote that user selected
	 *
	 * @return	bool
	 *
	 */
	function set_poll_vote_db( $iPollId, $iVoteId )
	{

		global $pollConfig;

		$iPollId = (int)$iPollId;

		// connect to database
		if ( !mySqlConnect() )
			return false;

		// select poll with specified id from database
		$sSql = "SELECT * FROM `" . $pollConfig['database']['tables']['poll_data'] . "` WHERE `Id` = '" . $iPollId . "'";
		$rRes = mysql_query($sSql);
		if ( 0 >= mysql_num_rows($rRes) )
			return false;
		$aPoll = mysql_fetch_array($rRes, MYSQL_ASSOC);

		$aResultList = explode( ';', $aPoll['ResultList'] );
		$aResultList[$iVoteId]++;

		$iTotalVotes = array_sum($aResultList);
		$sResultList = implode(';', $aResultList);

		$aPoll['ResultList'] = $sResultList;
		$aPoll['TotalVotes'] = $iTotalVotes;

		$sSql = "UPDATE `" . $pollConfig['database']['tables']['poll_data'] . "`
				SET `ResultList` = '{$sResultList}', `TotalVotes` = '{$iTotalVotes}'
				WHERE `Id` = '{$iPollId}'";

		$rRes = mysql_query($sSql);

		return true;

	}



	/**
	 * Get poll data from DB and format it in xml style
	 *
	 * @param	int poll id
	 *
	 * @return	poll results data in xml format
	 */
	function get_xml_poll_data_db( $iPollId = 0 )
	{

		global $pollConfig;

		$iPollId = (int)$iPollId;

		// connect to database
		if ( !mySqlConnect() )
			return false;

		// select poll with specified id from database
		$sSql = "SELECT * FROM `" . $pollConfig['database']['tables']['poll_data'] . "` WHERE `Id` = '" . $iPollId . "'";
		$rRes = mysql_query($sSql);
		if ( 0 >= mysql_num_rows($rRes) )
			return false;
		$aPoll = mysql_fetch_array($rRes, MYSQL_ASSOC);

		// generte output
		header('Content-Type: application/xml');

		$sContent = '<root><poll>';

		$sContent .= '<id>' . $iPollId . '</id>';

		$sContent .= '<question>' . htmlspecialchars($aPoll['Question']) . '</question>';

		$iIndex = 0;
		$aResultList = explode( ';', $aPoll['ResultList'] );
   		preg_match_all( '/<var>(.+?)<\/var>/', $aPoll['VariantList'], $aOption );
		$aVariantList = $aOption[1];
        foreach ($aVariantList as $sVariant)
        {
		    if ( '' != $sVariant )
		    {
				$sContent .= '<variant><text>' . htmlspecialchars ($sVariant) . '</text>';
				$sContent .= '<votes>' . (!empty($aResultList[$iIndex]) ? $aResultList[$iIndex] : '0') . '</votes>';
				$sContent .= '</variant>';
			}

			$iIndex++;
		}

		$sContent .= '</poll></root>';

		echo $sContent;

	}



	/**
	 * update&savee poll vote data
	 *
	 * @param	int poll id
	 * @param	int vote that user selected
	 *
	 * @return	bool
	 *
	 */
	function set_poll_vote_file( $iPollId, $iVoteId )
	{

		global $pollConfig;

		$f = @fopen($pollConfig['poll']['datapath'] . '/poll_' . $iPollId . '.xml', 'r+');
		if ( !$f )
			return false;

		$sContent = '';
		while (!feof($f))
	  		$sContent .= fread($f, 4086);
		fclose($f);

		$aPoll = array();

		// gather data from content to update it
   		preg_match( '/<id>(.+?)<\/id>/s', $sContent, $aData );
		$aPoll['id'] = $aData[1];

		preg_match( '/<question>(.+?)<\/question>/s', $sContent, $aData );
		$aPoll['question'] = $aData[1];

		preg_match_all( '/<variant>(.+?)<\/variant>/s', $sContent, $aData );
		$aVariant = $aData[1];

		$i = 0;
		foreach ( $aVariant as $aV )
		{
			preg_match( '/<text>(.+?)<\/text>/s', $aV, $aData );
			$aPoll[$i]['text'] = $aData[1];

			preg_match( '/<votes>(.+?)<\/votes>/s', $aV, $aData );
			$aPoll[$i]['votes'] = $aData[1];
			// update votes value
			if ( $i == $iVoteId )
				$aPoll[$i]['votes']++;

			$i++;
		}

		// now aPoll have all data from xml
		// generate new xml
		$sContent = '<root><poll>' . "\n";

		$sContent .= '<id>' . $aPoll['id'] . '</id>' . "\n";

		$sContent .= '<question>' . $aPoll['question'] . '</question>' . "\n";

        for( $j=0; $j < $i; $j++)
        {
			$sContent .= '<variant><text>' . $aPoll[$j]['text'] . '</text>';
			$sContent .= '<votes>' . (!empty($aPoll[$j]['votes']) ? $aPoll[$j]['votes'] : '0') . '</votes>';
			$sContent .= '</variant>' . "\n";
		}

		$sContent .= '</poll></root>';

		// write xml to file
		$f = @fopen($pollConfig['poll']['datapath'] . '/poll_' . $iPollId . '.xml', 'w');
		if ( !$f )
			return false;

		fwrite($f, $sContent);
		fclose($f);

		return true;

	}



	/**
	 * Get poll data from file
	 *
	 * @param	int poll id
	 *
	 * @return	poll results data in xml format
	 */
	function get_xml_poll_data_file( $iPollId = 0 )
	{

		global $pollConfig;

		$iPollId = (int)$iPollId;

		$f = @fopen($pollConfig['poll']['datapath'] . '/poll_' . $iPollId . '.xml', 'r');

		if ( !$f )
			return false;

		$sContent = '';
		while (!feof($f))
	  		$sContent .= fread($f, 4086);
		fclose($f);


		// generte output
		header('Content-Type: application/xml');

		echo $sContent;

	}

?>