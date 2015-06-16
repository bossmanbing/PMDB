<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

if (isset($_GET['player'])){
	$playerID = $_GET['player'];
}
else{
	header('location:./index.php');
}

$char_qry = "SELECT char_displayName, char_fileName, is_main

								FROM characters
								JOIN user_characters
									ON user_characters.char_id = characters.char_id
								WHERE user_characters.user_id = $playerID
								ORDER BY is_main DESC LIMIT 5";
$char_res = $db->query($char_qry);

$scores_qry = "SELECT CASE
										WHEN matches.user_id_1 = $playerID
											THEN matches.user_1_score
										WHEN matches.user_id_2 = $playerID
											THEN matches.user_2_score
									END AS player_score, game.game_name
									FROM matches
									JOIN game
										ON matches.game_id = game.game_id
									WHERE
										(user_id_1 = $playerID OR user_id_2 = $playerID)
									AND matches.game_id = 3

									ORDER BY match_id, game_name ASC";

$scores_res = $db->query($scores_qry);

	$dataPM[] = array(0,1500);
	$ctPM = 1;


	$pass = 0;
	while ($row = $scores_res->fetch_assoc()){
		$dataPM[] = array($ctPM, $row['player_score']);
		$ctPM++;
}


$user_qry = "SELECT user_name, user_affiliation, user_sets, user_placings, user_victories, user_bio, region_name
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
$sets = $user_row['user_sets'];
$placings = nl2br($user_row['user_placings']);
$victories = nl2br($user_row['user_victories']);
$bio = nl2br($user_row['user_bio']);
$region = $user_row['region_name'];

if ( strlen($aff) > 0 ){
	$aff = $user_row['user_affiliation']." | ";
} else{}

if ( strlen($sets) > 0 ){
	$sets = "<div class='embed-responsive embed-responsive-16by9'><iframe class='embed-responsive-item' src='https://www.youtube.com/embed/".$user_row['user_sets']."' allowfullscreen></iframe></div>";
}
else{
	$sets = "N/A";
}

?>
<!DOCTYPE html>
<html>

<head>
<?php require_once($path.'/include/head.inc.php'); ?>
<script src='./flot/jquery.flot.js'></script>
<script src='./flot/jquery.flot.js'></script>

<script>
	//put array into javascript variable
  var dataPM = <?php echo json_encode($dataPM); ?>;
	var datasets = {
		"pm":{label:"Project M", data: dataPM }
	}
	console.log(dataPM);
  //plot
  $(function () {
		$.plot("#placeholder", [ dataPM ], {
			yaxis: {
			        tickFormatter: function(val, axis) { return val < axis.max ? val.toFixed(0) : "<strong>Score</strong>";}
			},
			xaxis: {
				tickDecimals: 0,
				tickFormatter: function(val, axis) { return val < axis.max ? val.toFixed(0) : "<strong>Games</strong>";}
			},

		      legend: {
		        position: "se"
		      }
		});
	});
</script>


<title><?php echo $title; ?> | <?php echo $username; ?>'s Games</title>

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

				<h4>About <?php echo $username; ?></h4>

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

				<h4>Match History</h4>
				<div id='chart-container'>
					<div id="placeholder" style='width:95%; height:300px;'></div>
					<span id="choices" style="width:25%px; display:none;"></span>
				</div>
			</div>

			<div class='col-md-6'>
				<h4>Notable Placings</h4>

				<p class='victories'><?php echo $victories; ?> - Won</p>

				<p class='placings'><?php echo $placings; ?></p>

				<hr />

				<h4>Highlights</h4>
				<p class='sets'><?php echo $sets; ?></p>
			</div>

		</div>


	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
