/**
 *	Zoki Poll js engine functions
 *
 *	This file provides js functions that makes poll work
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

			aPollDoubleItem = new Array();

// =========================================================================
// Display==================================================================
// =========================================================================
	    	function pollVariantList( variant )
	    	{

				var ID = variant.getElementsByTagName('id')[0].firstChild.data;
				
// make question -------------------
	    		var aQuestion = variant.getElementsByTagName('question');

	    		var container = document.getElementById('dpol_caption_' + ID );

				var newDiv = document.createElement("div");
				newDiv.id = "dpol_caption_text_" + ID;
				newDiv.className = "pollTextBox";
				newDiv.onmouseover = function() { scrollStart(this,'horizontal'); };
				newDiv.onmouseout = function() { scrollStop(); };

				var newText = document.createTextNode(aQuestion[0].firstChild.data);

				newDiv.appendChild( newText );
				container.appendChild( newDiv );
// -----------------------------------------
// make variant lists ----------------------
	    		var aVariantList = variant.getElementsByTagName('variant');

	    		container = document.getElementById('dpol_content_' + ID );

				var newInput = document.createElement("input");
				newInput.type = "hidden";
				newInput.id = "current_vote_" + ID;
				newInput.value = '';

				container.appendChild( newInput );

	    		for ( var i = 0; i < aVariantList.length; i++ )
	    		{

				    sText = aVariantList[i].getElementsByTagName('text')[0].firstChild.data;
				    newText = document.createTextNode(sText);

				    newDiv = document.createElement("div");
				    newDiv.id = 'var_' + ID + '_' + i;
				    newDiv.className = "pollTextBox";
				    newDiv.onmouseover = function(){ scrollStart(this,'horizontal'); };
				    newDiv.onmouseout = function(){ scrollStop(); };
				    newDiv.appendChild( newText );

				    var newDiv2 = document.createElement("div");
					newDiv2.className = "pollTextBoxWrapper";
				    newDiv2.appendChild( newDiv );


				    var newDiv3 = document.createElement("div");
				    newDiv3.className = "pollTextContainer";

				    newInput = createNamedElement( "input", "vote_" + ID );
				    newInput.type = "radio";
				    newInput.value = i;
				    newInput.className = "pollRadioButton";
				    newInput.onclick = function(){ setVote( 'current_vote_' + ID, this.value ); };

/*
				    var newDiv2 = document.createElement("div");
				    newDiv2.style.styleFloat = "left"; // IE
				    newDiv2.style.cssFloat = "left"; // Mazilla
					newDiv2.appendChild( newInput );
*/

				    newDiv3.appendChild( newInput );
				    newDiv3.appendChild( newDiv2 );

				    container.appendChild( newDiv3 );

				}
// ---------------------------------
				scrollDisplay(container, ID);

				return true;

	    	}


	    	function pollResultList( variant, cVote )
	    	{

				var ID = variant.getElementsByTagName('id')[0].firstChild.data;

// hide actions block --------------
				document.getElementById('dpol_actions_' + ID ).style.display = 'none';
				
// -------------------------------------				
// make question -------------------
				if ( null === document.getElementById('dpol_caption_text_' + ID) )
				{
		    		var aQuestion = variant.getElementsByTagName('question');

		    		var container = document.getElementById('dpol_caption_' + ID );

					var newDiv = document.createElement("div");
					newDiv.id = "dpol_caption_text_" + ID;
					newDiv.className = "pollTextBox";
					newDiv.onmouseover = function() { scrollStart(this,'horizontal'); };
					newDiv.onmouseout = function() { scrollStop(); };

					var newText = document.createTextNode(aQuestion[0].firstChild.data);

					newDiv.appendChild( newText );
					container.appendChild( newDiv );
				}
// -------------------------------------
// make result list

	    		var aVariantList = variant.getElementsByTagName('variant');

				// get total votes num
				var iTotalVotes = 0;
				var aVoteList = new Array();
				for ( var i = 0; i < aVariantList.length; i++ )
    			{
    			 	// if vote set
    				if ( '' != cVote && i == cVote )
    				{
						aVariantList[i].getElementsByTagName('votes')[0].firstChild.data++;
					}

					aVoteList[i] = aVariantList[i].getElementsByTagName('votes')[0].firstChild.data;
					iTotalVotes += (+aVoteList[i]);
				}

				// generate percent values
				var aPercentList = new Array();
				for ( var i = 0; i < aVoteList.length; i++ )
    			{
    				if ( 0 == iTotalVotes )
    					aPercentList[i] = 0;
    				else
						aPercentList[i] = Math.round((aVoteList[i]/iTotalVotes*100)*10)/10;
    			}


				container = document.getElementById('dpol_content_' + ID );
				container.innerHTML = '';

// =======================================================
// sort result list by votes num desc
/*
				var aSVoteList = new Array();
				var j = 0;
				for(i in aVoteList)
				{
					aSVoteList[j] = new Array(i,parseInt(aVoteList[i]));
					j++;
				}
				aSVoteList.sort(function(a,b){return b[1] - a[1]});
				var i=0;
				for ( var j=0; j < aSVoteList.length; j++ )
	    		{
					i = aSVoteList[j][0];
*/
// =======================================================
				for ( var i = 0; i < aVariantList.length; i++ )
	    		{

					sText = aVariantList[i].getElementsByTagName('text')[0].firstChild.data;
//					sVotes = aVariantList[i].getElementsByTagName('votes')[0].firstChild.data;
//					sPercent = aVariantList[i].getElementsByTagName('percent')[0].firstChild.data;

					var newText = document.createTextNode(sText + ' ( ' + aVoteList[i] + ' votes ): ');

					var newDiv = document.createElement("div");
					newDiv.className = "pollTextBox";

					newDiv.id = 'r_' + ID + "_" + i;
					newDiv.onmouseover = function(){ scrollStart(this,'horizontal'); };
					newDiv.onmouseout = function(){ scrollStop(); };
					newDiv.appendChild(newText);

					var newDiv2 = document.createElement("div");
					newDiv2.className = "pollTextBoxWrapperRes";
					newDiv2.appendChild(newDiv);

					var newDiv3 = document.createElement("div");
					newDiv3.className = "pollTextContainerRes";
					newDiv3.appendChild(newDiv2);

					var newDiv4 = document.createElement("div");
					newDiv4.id='p_' + ID + '_' + i;
					newDiv4.className = "pollProgressBar";

					newText = document.createTextNode('0');
//					newText = document.createTextNode(aPercentList[i] + '%');
					newDiv4.appendChild( newText );
					
					container.appendChild( newDiv3 );
					container.appendChild( newDiv4 );

					drawBar(newDiv4.id,aPercentList[i]);

	    		}

				scrollDisplay(container, ID);

	    		return true;
	    	}
// =========================================================================
// Utils====================================================================
// =========================================================================

		// create element with name ( this is problem with IE )
			function createNamedElement( type, name )
			{
				var element;
				try
				{
					element = document.createElement('<'+type+' name="'+name+'">');
				}catch(e){}
				if (!element || !element.name) // Cool, this is not IE !!
				{
					element = document.createElement(type)
					element.name = name;
				}
				return element;
			}


		    function scrollDisplay(container, ID)
		    {
				// jump to top position
				container.style.top = '0px';

				if ( ( container.offsetTop + container.offsetHeight ) <= container.parentNode.offsetHeight )
				{
				    document.getElementById( 'dpol_arr_up_' + ID ).style.display='none';
				    document.getElementById( 'dpol_arr_down_' + ID ).style.display='none';
				}
				else
				{
				    document.getElementById( 'dpol_arr_up_' + ID ).style.display='block';
				    document.getElementById( 'dpol_arr_down_' + ID ).style.display='block';
				}

				return true;
	    	}


    		function scrollStart( item, direction )
    		{

				currentItem = item;

				if ( 'horizontal' == direction )
				{

					if ( currentItem.offsetWidth <= currentItem.parentNode.offsetWidth)
						return false;

					if ( 1 != aPollDoubleItem[currentItem.id] )
					{
						currentItem.innerHTML = currentItem.innerHTML + "  " +  currentItem.innerHTML;
						aPollDoubleItem[currentItem.id] = 1;
				    }

					currentMiddle = currentItem.offsetWidth / 2;
		    		scrollStop();
		    		iter = window.setInterval( 'moveLeft()', 10 );
				}


				if ( 'up' == direction )
				{
				    scrollStop();
				    iter = window.setInterval( 'moveUp()', 10 );
				}


				if ( 'down' == direction )
				{
				    scrollStop();
				    iter = window.setInterval( 'moveDown()', 10 );
				}

				return true;

    		}


    		function scrollStop()
    		{
				if ( undefined != window.iter )
				{
	    			window.clearInterval(iter);
				}
    		}


    		function moveLeft()
    		{
				if (currentItem.offsetLeft + currentMiddle > 0)
				{
	    			currentItem.style.left = (currentItem.offsetLeft-1) + 'px';
				}
				else
				{
	    			currentItem.style.left = '0px';
				}
		    }


		    function moveUp()
    		{
				if ( (currentItem.offsetTop + currentItem.offsetHeight) > currentItem.parentNode.offsetHeight )
				{
	    			currentItem.style.top = (currentItem.offsetTop-2) + 'px';
				}
		    }


    		function moveDown()
    		{
				if ( currentItem.offsetTop < 0 )
				{
	    			currentItem.style.top = (currentItem.offsetTop+2) + 'px';
				}
			}


		    function setVote( item, val )
			{
    			document.getElementById( item ).value = val;
			}


// This function devoted to all spamers that make me feel not so along in this world
			function drawBar( item, size )
	        {
				var bar = document.getElementById(item);
			    var widthLim = Math.floor( size * (bar.parentNode.offsetWidth / 100) );

				if ( widthLim > bar.offsetWidth )
			    {

					bar.style.width = bar.offsetWidth + 2 + 'px';
// for correct final percent value,  offsetWidth mast be equal to widthLim
					if ( widthLim < bar.offsetWidth )
						bar.style.width = widthLim + 'px';

					var percentStep = Math.round(((size*bar.offsetWidth)/widthLim)*100)/100;
					bar.innerHTML = percentStep;

					setTimeout("drawBar('"+item+"',"+size+")", 50 );
				}
				else
				{
					//bar.innerHTML += '%';
					bar.innerHTML = size + '%';					
				}
		    }
