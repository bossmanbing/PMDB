<?php
require('../include/init.inc.php');
$_SESSION['error'] = "";
$error = $_SESSION['error'];

$user = $_SESSION['user'];

$region = mysqli_real_escape_string($db, $_POST['region']);


if (!isset($user) || !isset($region)){
			$error = "You need to select a region to continue.";
			//header('location:../reg2.php');
		}
		else{}

$qry = "SELECT region_id
				FROM regions
					WHERE region_id = '$region'
					LIMIT 1";
$qry_res = $db->query($qry);
$reg_cnt = $qry_res->num_rows;

if ($reg_cnt !== 1){
	$error = "This region does not exist.";
	//header('location:../reg2.php');
}
else{
	$upd_qry = "UPDATE user_region
								SET region_id = $region
								WHERE user_id = $user
								LIMIT 1";
	$db->query($upd_qry);

	if ($_SESSION['user_level'] == 2){
		$upd_qry = "UPDATE user
									SET user_level = 3
									WHERE user_id = $user
									LIMIT 1"
		$db->query($upd_qry);
	}

	$_SESSION['region'] = $region;
	header('Location:../index.php');
}
echo $error;
?>
