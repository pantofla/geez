<?php
/**
 *	Zoki Poll config file
 *
 *	This file provides site url and database access info
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

	$pollConfig = array();

	// Your site url, Take attention at 'www'.
	// if your site have 'www' in it's name, you SHOULD specifiy it here
	// and vice versa.
	$pollConfig['site']['url'] = 'http://www.geez.gr/poll';

	// configuration of style pathes
	$pollConfig['style']['name']		= 'simple_grey';
	$pollConfig['style']['path']		= $pollConfig['site']['url'] . '/style/' . $pollConfig['style']['name'] . '/';
	$pollConfig['style']['css']			= $pollConfig['style']['path'] . 'css/';
	$pollConfig['style']['img']			= $pollConfig['style']['path'] . 'images/';

	// turn on check for uniq user
	// only one vote from particular user accepted in 24hr
	// available values is '0' - off and '1' - on
	$pollConfig['poll']['uniqcheck'] = '1';

	// data source for polls
	// available values is 'base' or 'file'
	$pollConfig['poll']['datasource'] = 'file';

	// used only if 'datasource' value set to 'file'
	$pollConfig['poll']['datapath'] = './xml';

	// database access data ( used only if 'datasource' value set to 'base' )
	$pollConfig['database']['host'] = 'localhost';
	$pollConfig['database']['user'] = 'root';
	$pollConfig['database']['pass'] = '';
	$pollConfig['database']['dbname'] = 'dpoll';

	$pollConfig['database']['tables'] = array(
		'poll_data' 		=> 'poll'
	);



?>