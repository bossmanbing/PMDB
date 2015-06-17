<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

if ( !isset($_SESSION['logged']) || $_SESSION['logged'] != 1
			||  !isset($_SESSION['user_level']) || $_SESSION['user_level'] <= 2
	){
	header('location:/index.php');

}

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
			Tell us about your new player. Remember to include links to their sets as well as who they play as!
		</p>
		<form class='' action='/php/add-submit.php' method='post' id='add-form'>
			<div class='row'>

				<div class='col-md-4'>
					<div class='form-group'>
						<label for='name'>
							Tag Name :
						</label>
						<input type='text' class='form-control' name='name' id='player-name' maxlength=32 required />
					</div>

					<div class='form-group'>
						<label for="affiliate">Sponsor/Affiliation: </label>
						<input type='text' class='form-control' name='affiliate' maxlength="24" />
					</div>

					<div class='form-group'>
						<label for='bio'>Bio: </label>
						<textarea name='bio' rows='7' cols='40' maxlenght="2048" class='form-control'></textarea>
					</div>

					<div class='form-group'>
						<label for='placings'>Victories and Placings: </label>
						<textarea name='placings' rows='7' cols='40' maxlenght="1024" class='form-control'></textarea>
					</div>

					<div class='form-group youtube-helper'>
						<label for='sets'>Videos of Notable sets: </label>
						<br />
						<small>Only paste the "key" part of the YouTube URL.</small>
						<img src='/images/youtube-helper.png' alt='Only use the 11 character key from the YouTube URL'/>
						<input type='text' name='set1' />
						<input type='text' name='set2' />
						<input type='text' name='set3' />
						<div class='clear'></div>
					</div>

					<div class='form-group'>
						<input type='submit' value='Add Player' id='add-submit' class='btn' />
					</div>


				</div>

				<div class='col-md-8'>

					<div class='form-group'>
						<label for='characters' class='characters-label'>
							Select player's main:
						</label>
					</div>

					<!-- SELECTED CHARACTERS -->
					<input type='hidden' value='' class='char-main char-1' name='charMain' />
					<input type='hidden' value='' class='char-2' name='char2' />
					<input type='hidden' value='' class='char-3' name='char3' />

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
			</div>

		</form>
		<div id='outcome'></div>

	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
