<?php
$db_server = 'localhost';
	$db_name = 'smashtracker';
	$db_pass = 'SM@$HD8';
	$db_user = 'smash_db';

$db = new mysqli($db_server,$db_user,$db_pass,$db_name);
if($db->connect_errno > 0){
 die('Unable to connect to database [' . $db->connect_error . ']');
}
?>