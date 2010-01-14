/**
 *	Zoki Poll js asynchronous functions
 *
 *	This file provides js functions that interacts with server
 *	and request data from server backend functions
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

// asinc serwer query. Gets responce text and pass it to callback function
	function serverQuery( callback_function, url, responseType )
	{//alert('cb-> ' + callback_function + ' url-> ' + url);
		var XMLHttpRequestObject = false;
	    if( window.XMLHttpRequest )
	    {
			XMLHttpRequestObject = new XMLHttpRequest();
		}
		else if( window.ActiveXObject )
		{
			XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
		}

		if( XMLHttpRequestObject )
	    {
			XMLHttpRequestObject.open( "GET", url );
//			XMLHttpRequestObject.open( "POST", url );
			XMLHttpRequestObject.onreadystatechange = function()
			{
				if ( XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200 )
		    	{

					if ( '' != callback_function )
					{
						if ( 'xml' == responseType )
							answer = XMLHttpRequestObject.responseXML;
						else
							answer = XMLHttpRequestObject.responseText;

						callback_function(answer);
					}

					delete XMLHttpRequestObject;
					XMLHttpRequestObject = null;

				}
		    }
			XMLHttpRequestObject.send( null );
		}

		return true;
	}
