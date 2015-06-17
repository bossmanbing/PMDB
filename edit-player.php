<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

$regionID = mysqli_real_escape_string($db, $_POST['region']);
$playerID = mysqli_real_escape_string($db, $_POST['player']);

$userRegion = $_SESSION['region'];
$userID = $_SESSION['user'];

// Check if user is logged in and a valid level to operate this page.
if ( !isset($_SESSION['logged']) || $_SESSION['logged'] != 1
			||  !isset($_SESSION['user_level']) || $_SESSION['user_level'] <= 2
	){
	header('location:/index.php');

}

// Validate POST data exists in database. Do we have a single entry for this player in the user_region table?
$valid_qry = "SELECT region_id FROM user_region
							WHERE region_id = $regionID AND user_id = $playerID";
$valid_res = $db->query($valid_qry);
$valid_cnt = $valid_res->num_rows;

if ($valid_cnt != 1){
	header('location:/index.php');
}

// If this mod is not in the players's region, kick them out
if ($regionID != $userRegion){
	header('location:/index.php');
}else{}

// Select all of the characters and portraits
$charList_qry = "SELECT char_id, char_displayName, char_fileName FROM characters";
$charList_res = $db->query($charList_qry);

// Select this player's characters
$char_qry = "SELECT char_displayName, char_fileName, is_main, characters.char_id

								FROM characters
								JOIN user_characters
									ON user_characters.char_id = characters.char_id
								WHERE user_characters.user_id = $playerID
								ORDER BY is_main DESC LIMIT 5";
$char_res = $db->query($char_qry);

// Select profile information for this player
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

$placings = $user_row['user_placings'];
$bio = $user_row['user_bio'];
$region = $user_row['region_name'];
$regionID = $user_row['region_id'];

// Select the sets for this player
$setQry = "SELECT set_id, set_key FROM sets
						WHERE user_id = $playerID LIMIT 3";
$set_res = $db->query($setQry);

$sID = [];
$sKey = [];

	while ($row = $set_res->fetch_assoc()){
		array_push($sID,$row['set_id']);
		array_push($sKey,$row['set_key']);
	}
?>

<!DOCTYPE html>
<html>

<head>
<?php require_once($path.'/include/head.inc.php'); ?>

	<script src="./js/_edit-player.js"></script>
	<title><?php echo $title; ?> | Add a Player</title>
</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content'>
		<h2>Edit <?php echo $username; ?>'s Profile</h2>
		<div class='bannerBar'></div>
		<p>
			Update your player's profile. Make sure to include hype new videos or tourney placings!
		</p>
		<form class='' action='/php/edit-player.php' method='post' id='add-form'>
			<div class='row'>

				<div class='col-md-4'>
					<div class='form-group'>
						<label for='name'>
							Tag Name :
						</label>
						<input type='text' class='form-control' value='<?php echo $username; ?>' name='name' id='player-name' maxlength=32 required />
					</div>

					<div class='form-group'>
						<label for="affiliate">Sponsor/Affiliation: </label>
						<input type='text' class='form-control' value='<?php echo $aff; ?>' name='affiliate' maxlength="24" />
					</div>

					<div class='form-group'>
						<label for='bio'>Bio: </label>
						<textarea name='bio' rows='7' cols='40' maxlenght="2048" class='form-control'><?php echo $bio; ?></textarea>
					</div>

					<div class='form-group'>
						<label for='placings'>Victories and Placings: </label>
						<textarea name='placings' rows='7' cols='40' maxlenght="1024" class='form-control'><?php echo $placings; ?></textarea>
					</div>

					<div class='form-group youtube-helper'>
						<label for='sets'>Videos of Notable sets: </label>
						<br />
						<small>Only paste the "key" part of the YouTube URL.</small>
						<img src='/images/youtube-helper.png' alt='Only use the 11 character key from the YouTube URL'/>
						<input type='text' name='set1' value='<?php echo (isset($sKey[0]) ?$sKey[0] : ''); ?>'/>
						<input type='text' name='set2' value='<?php echo (isset($sKey[1]) ?$sKey[1] : ''); ?>'/>
						<input type='text' name='set3' value='<?php echo (isset($sKey[2]) ?$sKey[2] : ''); ?>'/>
						<div class='clear'></div>
					</div>

					<div class='form-group'>
						<input type='hidden' value='<?php echo $playerID; ?>' name='playerID' required />
						<input type='submit' value='Edit Player' id='add-submit' class='btn' />
					</div>


				</div>

				<div class='col-md-8'>

					<div class='form-group'>
						<label for='characters' class='characters-label'>
							<span class='btn reset-btn'>Reset Characters</span><span class='select-main'>Select player's main:</span>
						</label>
					</div>

					<!-- SELECTED CHARACTERS -->
					<div class='form-group characters-selected'>
			<?php
				$i = 1;
				while($row = $char_res->fetch_assoc()){
					if ($i == 1){
						$hidden = "<input type='hidden' value='".$row['char_id']."' class='char-form char-main char-1' name='charMain' />";
					}
					else{
						$hidden = "<input type='hidden' value='".$row['char_id']."' class='char-form char-".$i."' name='char".$i."' />";
					}
					$visible = "<img class='selected-".$i." img-thumbnail char-selected' src='/images/pm/chars/".$row['char_fileName']."' alt='".$row['char_displayName']."' />";
					echo $hidden;
					echo $visible;
					$i++;
				}
			?>
				</div>

					<div class='form-group characters-list edit-characters-list'>

						<?php
							while($row = $charList_res->fetch_assoc()){

								$divImg = "<a href='#'><img class='char-select img-thumbnail' attr-id='".$row['char_id']."' alt='".$row['char_displayName']."' src='/images/pm/chars/".$row['char_fileName']."' /> </a>";
								echo $divImg;

							}
						?>

					</div>

				</div>
			</div>

		</form>
		<div id='outcome'></div>

	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
