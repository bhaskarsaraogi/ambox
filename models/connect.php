<?php 
require 'config/config.php';
$conn = connect($config);
if (!$conn) 	die("could not connect to database");
