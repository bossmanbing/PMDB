<?php
require('./include/init.inc.php');

$user_qry = "SELECT * FROM user ORDER BY user_name ASC";
$user_res = $db->query($user_qry);

$game_qry = "SELECT * FROM game ORDER BY game_name ASC";
$game_res = $db->query($game_qry);
?>

<!DOCTYPE html>
<html>
<head>
<?php require_once('./include/head.inc.php'); ?>

	<script src="./js/_update-rank.js"></script>
	<title>SmashTracker | Add a Match</title>
</head>

<body>
<?php require_once('./include/header.inc.php'); ?>
<?php require_once('./include/nav.inc.php'); ?>

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

			<input type='button' value='Next' id='nextStep' />

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
				<input type='submit' value='Submit' id='rank-submit' />

			</div>

		</form>
		<div id='outcome'></div>

	</div><!-- end CONTENT div -->

<?php require_once('./include/footer.inc.php'); ?>
