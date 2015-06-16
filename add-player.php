<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

/*if (!isset($_SESSION['logged']) || $_SESSION['logged'] != 1){
	header('location:'.$path.'/index.php');

	// NEED TO CHECK FOR TO/MOD STATUS
}*/

$char_qry = "SELECT char_id, char_displayName, char_fileName FROM characters";
$char_res = $db->query($char_qry);

?>
<!DOCTYPE html>
<html>

<head>
<?php require_once($path.'/include/head.inc.php'); ?>

	<script src="./js/_insert-addPlayer.js"></script>
	<title><?php echo $title; ?> | Add a Player</title>
</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content'>

		<h2>Add a Player</h2>
		<p>
			Just type in a name and submit it! We'll make sure they end up in your region.
		</p>
		<form class='' action='' method='post' id='add-form'>
			<div class='row'>

				<div class='col-md-4'>
					<div class='form-group'>
						<label for='name'>
							Name :
						</label>
						<input type='text' class='form-control' name='name' id='player-name' maxlength=32 required />
					</div>

					<div class='form-group'>
						<label for="affiliate">Sponsor/Affiliation: </label>
						<input type='text' class='form-control' name='affiliate' maxlength="5" />
					</div>

					<div class='form-group'>
						<label for='bio'>Bio: </label>
						<textarea rows='7' cols='40' maxlenght="2400" class='form-control'></textarea>
					</div>
				</div>

				<div class='col-md-8'>

					<div class='form-group'>
						<label for='characters' class='characters-label'>
							<strong>Select player's main:</strong>
						</label>


						<input type='hidden' value='' class='char-main char-1' name='char-main' />
						<input type='hidden' value='' class='char-2' name='char-2' />
						<input type='hidden' value='' class='char-3' name='char-3' />
					</div>

					<div class='form-group characters-selected'>
						<img class='selected-1 img-thumbnail char-selected' src='' alt='' />
						<img class='selected-2 img-thumbnail char-selected' src='' alt=''/>
						<img class='selected-3 img-thumbnail char-selected' src='' alt=''/>
					</div>

					<div class='form-group characters-list'>
						<?php
							while($row = $char_res->fetch_assoc()){

								$divImg = "<a href='#'><img class='char-select img-thumbnail' attr-id='".$row['char_id']."' alt='".$row['char_displayName']."' src='/images/pm/chars/".$row['char_fileName']."' /> </a>";
								echo $divImg;

							}
						?>
					</div>

				</div>


			<!--<input type='submit' value='Submit' id='add-submit'  />-->

		</form>
		<div id='outcome'></div>

	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
