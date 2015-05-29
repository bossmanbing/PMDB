<?php
require('./include/init.inc.php');

?>
<!DOCTYPE html>
<html>

<head>
<?php require_once('./include/head.inc.php'); ?>

	<script src="./js/_insert-addPlayer.js"></script>
	<title>SmashTracker | Add a Player</title>
</head>

<body>
<?php require_once('./include/header.inc.php'); ?>
<?php require_once('./include/nav.inc.php'); ?>

	<div id='content'>

		<h2>Add a Player</h2>
		<p>
			Just type in a name and submit it! We'll make sure they end up in your region.
		</p>
		<form action='' method='post' id='add-form'>
			<div class='form-row'>
				<label for='name'>
					Name :
				</label>
				<input type='text' name='name' id='player-name' maxlength=32 required />
			</div>

			<input type='submit' value='Submit' id='add-submit' />
		</form>
		<div id='outcome'></div>

	</div><!-- end CONTENT div -->

<?php require_once('./include/footer.inc.php'); ?>
