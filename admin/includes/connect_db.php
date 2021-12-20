<?php

DEFINE ('DB_USER', 'b1004066');
DEFINE ('DB_PASSWORD', 'owlman09');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'b1004066_db1');

// Create connection
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($dbc->connect_error) {
	die("Connection failed: " . $dbc->connect_error);
}

$dbc -> set_charset("utf8");
?>

