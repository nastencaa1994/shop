<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function debug($str) {
	echo '<pre>';
	print_r($str,1);
	echo '</pre>';
	exit;
}