<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

// Check if user is logged in and a valid level to operate this page.
if ( !isset($_SESSION['logged']) || $_SESSION['logged'] != 1
			||  !isset($_SESSION['user_level']) || $_SESSION['user_level'] <= 2
	){
	header('location:/index.php');

}
else{
	$region = $_SESSION['region'];
	$user_level = $_SESSION['user_level'];
	$userID = $_SESSION ['user'];
}

$user_qry = "SELECT user.user_id, user_name
							FROM user
							JOIN user_region
								ON user.user_id = user_region.user_id
							WHERE region_id = $region
							ORDER BY user_name ASC";
$user_res = $db->query($user_qry);

$game_qry = "SELECT * FROM game ORDER BY game_name ASC";
$game_res = $db->query($game_qry);

?>

<!DOCTYPE html>
<html>
<head>
<?php require_once($path.'/include/head.inc.php'); ?>

	<script src="./js/_update-rank.js"></script>
	<title>SmashTracker | Add a Match</title>
</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content'>

		<h2>Update Rankings</h2>
		<p>
			Select the players, the game, then click "Next".
		</p>
		<p>
			Pick the winner <em>of the set</em> and submit the form to update each player's rank.
		</p>
		<form action='' method='post' id='rank-form'>

			<div class='form-row'>
				<label for='player1'>
					Player 1:
				</label>
				<select name='player1' id='player1' required>
			    <option value='' default>Select a player</option>
	  <?php
	  while($row = $user_res->fetch_assoc()){
					echo "<option value='".$row['user_id']."'>".$row['user_name']."</option>";
				}
	  ?>
				</select>
			</div>

			<div class='form-row'>
				<label for='player2'>
					Player 2:
				</label>
				<select name='player2' id='player2' required>
			    <option value='' default>Select a player</option>
  <?php
  mysqli_data_seek($user_res,0);
  while($row = $user_res->fetch_assoc()){
				echo "<option value='".$row['user_id']."'>".$row['user_name']."</option>";
			}
  ?>
				</select>
			</div>

			<div class='form-row'>
<?php
if (isset($_SESSION['region']) && $_SESSION['region'] == 1){ ?>

			<div class='form-row'>
				<label for='game'>
					Game:
			  </label>
				<select name='game' id='game' required>
			    <option value='' default>Select a game</option>
<?php
while($row = $game_res->fetch_assoc()){
			echo "<option value='".$row['game_id']."'>".$row['game_name']."</option>";
		}
?>
				</select>
			</div>

<?php } // END CHECK FOR SOUTHERN UTAH region
 else{
?>
			<input type='hidden' name='game' id='game' value='3' required />
<?php } ?>

			<input type='button' class='btn' value='Next' id='nextStep' />

			<div id='select-winner'>

				<div class='form-row'>
					<label for='winner'>
						Winner:
					</label>
					<select name='winner' id='winner'>
						<option id='winner1'></option>
						<option id='winner2'></option>
					</select>
				</div>
				<input type='submit' class='btn' value='Submit' id='rank-submit' />

			</div>
		</div>
		</form>
		<div id='outcome'></div>

	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
