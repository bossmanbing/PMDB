<?php
require('./include/init.inc.php');

if (isset($_GET['player'])){
	$playerID = $_GET['player'];
}
else{
	header('location:./index.php');
}

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

									ORDER BY match_id, game_name ASC";

$scores_res = $db->query($scores_qry);

	$data64[] = array(0,1500);
	$ct64 = 1;
	$dataMelee[] = array(0,1500);
	$ctMelee = 1;
	$dataBrawl[] = array(0,1500);
	$ctBrawl = 1;
	$dataPM[] = array(0,1500);
	$ctPM = 1;
	$data3DS[] = array(0,1500);
	$ct3DS = 1;
	$dataSm4[] = array(0,1500);
	$ctSm4 = 1;

	$curGame;
	$prevGame;
	$pass = 0;
	while ($row = $scores_res->fetch_assoc()){
		$curGame = $row['game_name'];

		if ($curGame === 'Project M'){
			$dataPM[] = array($ctPM, $row['player_score']);
			$ctPM++;
		}
		else if ($curGame === 'Melee'){
			$dataMelee[] = array($ctMelee, $row['player_score']);
			$ctMelee++;
		}
		else if ($curGame === 'Smash Wii U'){
			$dataSm4[] = array($ctSm4, $row['player_score']);
			$ctSm4++;
		}
		$prevGame = $curGame;
}


$user_qry = "SELECT user_name FROM user WHERE user_id = '$playerID' LIMIT 1";
$user_res = $db->query($user_qry);
$user_row = mysqli_fetch_assoc($user_res);
$username = $user_row['user_name'];

?>
<!DOCTYPE html>
<html>

<head>
<?php require_once('./include/head.inc.php'); ?>
<script src='./flot/jquery.flot.js'></script>
<script src='./flot/jquery.flot.js'></script>

<script>
	//put array into javascript variable
  var dataPM = <?php echo json_encode($dataPM); ?>;
	var dataMelee = <?php echo json_encode($dataMelee); ?>;
	var dataSm4 = <?php echo json_encode($dataSm4); ?>;
	var datasets = {
		"pm":{label:"Project M", data: dataPM },
		"sm4sh":{label:"Smash Wii U", data: dataSm4 },
		"melee":{label:"Melee", data: dataMelee }
	}
  //plot
  $(function () {
		var i = 0;
		$.each(datasets, function(key, val) {
			val.color = i;
			++i;
		});

		// insert checkboxes
		var choiceContainer = $("#choices");
		$.each(datasets, function(key, val) {
			choiceContainer.append("<br/><input type='checkbox' name='" + key +
				"' checked='checked' id='id" + key + "'></input>" +
				"<label for='id" + key + "'>"
				+ val.label + "</label>");
		});

		choiceContainer.find("input").click(plotAccordingToChoices);

		function plotAccordingToChoices() {

			var data = [];

			choiceContainer.find("input:checked").each(function () {
				var key = $(this).attr("name");
				if (key && datasets[key]) {
					data.push(datasets[key]);
				}
			});

			if (data.length > 0) {
				$.plot("#placeholder", data, {
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
			}
		}

		plotAccordingToChoices();
	});
</script>


<title>SmashTracker | <?php echo $username; ?>'s Games</title>

</head>

<body>
<?php require_once('./include/header.inc.php'); ?>
<?php require_once('./include/nav.inc.php'); ?>

	<div id='content'>

		<h2>Match History for <?php echo $username; ?></h2>

		<div id='chart-container'>
			<div id="placeholder" style="width:60%;height:300px"></div>
			<span id="choices" style="width:25%px;"></span>
		</div>

	</div><!-- end CONTENT div -->

<?php require_once('./include/footer.inc.php'); ?>