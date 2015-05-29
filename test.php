<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

$char_qry = "SELECT char_displayName, char_fileName FROM characters";

$char_res = $db->query($char_qry);

$username = 'rocky';
$qry = "SELECT user_id, user_name
				FROM user
					WHERE user_name = '$username'
					LIMIT 1";
$qry_res = $db->query($qry);

$user = $qry_res->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
<?php require_once($path.'/include/head.inc.php'); ?>
<script src="/js/_page-index.js"></script>
<title>SmashTracker - Everything Smash</title>

</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content' class='container-fluid'>

				<div id='index-leaders'>
					<h4>List</h4>
					<br /><?php echo $user['user_id']; ?>
					<div class='bannerBar'></div>

				<?php

					while($row = $char_res->fetch_assoc()){
						echo " <img style='height:75px; border-radius: 5px;' src='/images/pm/chars/".$row['char_fileName']."' /> ";
						}
				?>

				</div>


		</div> <!-- end INDEX-MAIN div -->
	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
