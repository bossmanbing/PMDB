<?php
require('../include/init.inc.php');

$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);

$qry = "SELECT user_id, user_name, user_password
				FROM user
					WHERE user_name = '$username'
					AND user_password = MD5(CONCAT('$password',user_dateJoined))
					LIMIT 1";
$qry_res = $db->query($qry);
$usr_cnt = $qry_res->num_rows;

if ($usr_cnt === 1){
	// user is logged in.
	$user = $qry_res->fetch_assoc();
	$id = $user['user_id'];

	$c_name = 'user';
	$c_value = $username;
	setcookie($c_name,$c_value,time()+(86400 * 30), "/"); // 30 day cookie
	$_SESSION['logged'] = 1;
	$_SESSION['user'] = $id;
	
	header('Location:../add-player.php');
}
else{
	$_SESSION['logged'] = 0;
	header('Location:../index.php');
}
?>
