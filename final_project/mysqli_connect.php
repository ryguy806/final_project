<?php

//The database connection for the website.

// Set the database access information as constants:
define('DB_USER', 'ryanguel_ryguy8806');
define('DB_PASSWORD', 'L1ghtSab3r1!');
define('DB_HOST', 'localhost');
define('DB_NAME', 'ryanguel_final_project');

// Make the connection:
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error() );

mysqli_set_charset($dbc, 'utf8');

?>