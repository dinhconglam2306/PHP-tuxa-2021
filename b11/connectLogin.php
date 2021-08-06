<?php
	require_once 'admin/libs/Database.class.php';
	$params		= array(
			'server' 	=> 'localhost',
			'username'	=> 'root',
			'password'	=> '',
			'database'	=> 'manager_rss',
			'table'		=> 'user',
	);
	$database = new Database($params);