<?php

DEFINE ('DB_USER', 'u261783350_liam9061');
DEFINE ('DB_PASSWORD', 'OwLm@n009');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'u261783350_traderater');

// Create connection
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($dbc->connect_error) {
	die("Connection failed: " . $dbc->connect_error);
}

$dbc -> set_charset("utf8");
?>

