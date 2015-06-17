<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

if (isset($_GET['player'])){
	$playerID = $_GET['player'];
}
else{
	header('location:/index.php');
}

$char_qry = "SELECT char_displayName, char_fileName, is_main

								FROM characters
								JOIN user_characters
									ON user_characters.char_id = characters.char_id
								WHERE user_characters.user_id = $playerID
								ORDER BY is_main DESC LIMIT 5";
$char_res = $db->query($char_qry);



$user_qry = "SELECT user_name, user_affiliation, user_placings,
										user_bio, region_name, regions.region_id
 							FROM user
							JOIN user_region
								ON user_region.user_id = user.user_id
							JOIN regions
								ON user_region.region_id = regions.region_id
							WHERE user.user_id = $playerID LIMIT 1";
$user_res = $db->query($user_qry);

$user_row = mysqli_fetch_assoc($user_res);
$username = $user_row['user_name'];
$aff = $user_row['user_affiliation'];

$placings = nl2br($user_row['user_placings']);
$bio = nl2br($user_row['user_bio']);
$region = $user_row['region_name'];
$regionID = $user_row['region_id'];

$setQry = "SELECT set_id, set_key FROM sets
						WHERE user_id = $playerID LIMIT 3";
$set_res = $db->query($setQry);

if ( strlen($aff) > 0 ){
	$aff = $user_row['user_affiliation']." | ";
} else{}

	if ( isset($_SESSION['user_level']) && $_SESSION['user_level'] >= 3 && $regionID == $_SESSION['region']){
		$formStart = "<form action='/edit-player.php' method='post'>";
		$formContent = "<input type='hidden' name='region' value='".$regionID."' required /><input type='hidden' name='player' value='".$playerID."' required />";
		$formClose = "<input type='submit' value='Edit Player' class='btn edit-btn' /></form>";
		$form = $formStart.$formContent.$formClose;
	}
	else{
		$form = '';
	}

?>
<!DOCTYPE html>
<html>

<head>
<?php require_once($path.'/include/head.inc.php'); ?>


<title><?php echo $title; ?> | <?php echo $username; ?></title>

</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content' class='container-fluid'>

		<h2><?php echo $aff.$username; ?> -  <?php echo $region; ?></h2>
		<div class='bannerBar'></div>
		<br />
		<div class='row' style='width:100%;'>

			<div class='col-md-6'>

				<h4>About <?php echo $username." ".$form; ?></h4>

				<div class='chars'>
	<?php
		while ($row = $char_res->fetch_assoc()){
			$class = '';
			if ( $row['is_main'] == 1 ){
				$class='isMain';
			}
			else{
				$class='subChar';
			}
			echo "<div class='".$class."'><img class='img-thumbnail' src='/images/pm/chars/".$row['char_fileName']."' alt='".$row['char_displayName']."' /></div>";
		}
	?>
				</div>
				<div class='clear'></div>

				<p class='bio'><?php echo $bio; ?></p>

				<hr />

			</div>

			<div class='col-md-6'>
				<h4>Notable Placings</h4>

				<p class='placings'><?php echo $placings; ?></p>

				<hr />

				<h4>Highlights</h4>
				<div class='sets'>
	<?php
		while ($row = $set_res->fetch_assoc()){

			echo "<div class='embed-responsive embed-responsive-16by9'><iframe class='embed-responsive-item' src='https://www.youtube.com/embed/".$row['set_key']."' allowfullscreen></iframe></div>";

		}
	?>
			</div>
			</div>

		</div>


	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
