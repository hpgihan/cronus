<?php

$config = array(

	// This is a authentication source which handles admin authentication.
	'admin' => array(
		// The default is to use core:AdminPassword, but it can be replaced with
		// any authentication source.

		'core:AdminPassword',
	),
    
    // IDP UserStore
    'user-store' => array(
    'sqlauth:SQL',
    'dsn' => 'mysql:host=localhost;dbname=UserStore',
    'username' => 'root',
    'password' => 'thinkcube',
    'query' => 'SELECT users.username FROM users WHERE users.username = :username AND password = md5(:password)',
    ),
);
