<?php
	require_once 'libs/Database.class.php';
	$params		= array(
			'server' 	=> 'localhost',
			'username'	=> 'root',
			'password'	=> '',
			'database'	=> 'manager_rss',
			'table'		=> 'rss',
	);
	$database = new Database($params);