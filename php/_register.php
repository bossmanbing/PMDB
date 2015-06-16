<?php
require('../include/init.inc.php');
$_SESSION['error'] = "";
$error = $_SESSION['error'];

$username = mysqli_real_escape_string($db, $_POST['username']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$remail = mysqli_real_escape_string($db, $_POST['remail']);
$password = mysqli_real_escape_string($db, $_POST['password']);
$repass = mysqli_real_escape_string($db, $_POST['repassword']);

if (!isset($username) || !isset($email) || !isset($remail) || !isset($password) ||
		!isset($repass)){
			$error = "You left a field blank. Please try again.";
			header('location:../register.php');
		}
if ($email !== $remail || $password !== $repass){
			$error = "You did not enter matching email addresses or passwords. Please try again.";
			header('location:../register.php');
		}

		else{}

$qry = "SELECT user_name
				FROM user
					WHERE user_name = '$username'
					LIMIT 1";
$qry_res = $db->query($qry);
$usr_cnt = $qry_res->num_rows;

if ($usr_cnt >= 1){
	$error = "This username already exists.";
	header('location:../register.php');
}
else{
	$date = date("Y-m-d");
	$new_pass = MD5($password.$date);

	$ins_qry = "INSERT INTO user
								(user_name, user_email, user_password, user_activated, user_dateJoined, user_level)
							VALUES
								('$username', '$email', '$new_pass', 1, '$date', 1)";

	$db->query($ins_qry);
	$user = $db->insert_id;

	// INSERT a blank user_region region for the user
	$reg_qry = "INSERT INTO user_region
								(user_id, region_id)
							VALUES
								($user,0)";
	$db->query($reg_qry);

	$c_name = 'user';
	$c_value = $username;
	setcookie($c_name,$c_value,time()+(86400 * 30), "/"); // 30 day cookie
	$_SESSION['logged'] = 1;
	$_SESSION['user'] = $user;
	$_SESSION['user_level'] = 1;

	header('Location:../reg2.php');
}
?>
