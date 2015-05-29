<?php
require('./include/init.inc.php');

$user_qry = "SELECT DISTINCT user.user_name, user.user_id,
															ranking.score, game.game_name,
															regions.region_name
							FROM user
							JOIN ranking
								ON user.user_id = ranking.user_id
							JOIN game
								ON ranking.game_id = game.game_id
							JOIN user_region
										ON user.user_id = user_region.user_id
									JOIN regions
										ON user_region.region_id = regions.region_id
							WHERE game.game_id IN (
									SELECT matches.game_id FROM matches
										WHERE matches.user_id_1 = user.user_id
											OR matches.user_id_2 = user.user_id)
							AND user.user_name NOT LIKE 'Test%'
							ORDER BY game.game_name, ranking.score DESC";

$user_res = $db->query($user_qry);

if (isset($regLog)){
	$playersMod = "<ul id='rank-nav'>
<li><a href='./add-player.php'>Add a User</a></li>
<li><a href='./add-match.php'>Update Ranks</a></li>
<li><a href='./edit-player.php'>Update Ranks</a></li></ul>";
}
else{
	$playersMod;
}
?>
<!DOCTYPE html>
<html>

<head>
<?php require_once('./include/head.inc.php'); ?>
  <link href="./styles/footable.core.css" rel="stylesheet" type="text/css" />
	<link href="./styles/footable.standalone.css" rel="stylesheet" type="text/css" />

	<script src="./js/footable.min.js" type="text/javascript"></script>
	<script src="./js/footable.sort.js" type="text/javascript"></script>
	<script src="./js/footable.striping.js" type="text/javascript"></script>
	<script src="./js/footable.filter.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function () {
			$('.footable').footable();
		});
	</script>

	<title>SmashTracker | Regional Rankings</title>
</head>

<body>
<?php require_once('./include/header.inc.php'); ?>
<?php require_once('./include/nav.inc.php'); ?>

	<div id='content'>

		<h2>Tier Rankings</h2>

		<p>
			<label for='footable-search'>
				Filter by Game:
			</label>
			<input type='text' name='footable-search' id='foot-filter' />

		</p>
		<table class='footable table' data-filter="#foot-filter">
			<thead>
				<tr>
					<th class='footable-first-column'>Player</th>
					<th>Game</th>
					<th>Score</th>
					<th class='footable-last-column'>Region</th>
				</tr>
			</thead>
	<?php
  while($row = $user_res->fetch_assoc()){


				echo "<tr>";
				echo "<td><a href='./player-view.php?player=".$row['user_id']."'>".$row['user_name']."</a></td> <td>".$row['game_name']."</td> <td>".$row['score']."</td><td>".$row['region_name']."</td>";
				echo "</tr>";
			}
  ?>
		</table>

	</div><!-- end CONTENT div -->

	<?php require_once('./include/footer.inc.php'); ?>
