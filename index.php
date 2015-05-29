<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

$ranks_qry = "SELECT ranking.score, user.user_name,
															user.user_id, game.game_name,
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
								AND ranking.score = (
                                    SELECT DISTINCT MAX(inn.score) FROM ranking AS `inn`
                                    	JOIN user_region AS us
                                    		ON us.user_id = inn.user_id
                                    	WHERE inn.game_id = game.game_id
                                    	AND us.region_id = regions.region_id)
							ORDER BY regions.region_name, game.game_name ASC";

$ranks_res = $db->query($ranks_qry);
?>
<!DOCTYPE html>
<html>

<head>
<?php require_once($path.'/include/head.inc.php'); ?>
<script src="/js/_page-index.js"></script>
<title>SmashTracker - Everything Smash</title>

</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content' class='container-fluid'>

		<h2>Welcome to SmashTracker</h2>
		<h4>We're still getting things together.</h4>
		<p>
			SmashTracker will be the go-to source for everything Super Smash Bros, tracking everything from social media, to news and events, as well as stream and VOD channels. Regions can even organize their own tier rankings.
		</p>
		<p>
			Stick around and make sure to keep checking things out. We add a little something new every day. Or you can be like the cool kids and follow us on Twitter, we'll make sure to update things there too.
		</p>

		<div id='index-main' class='row'>

			<div class='index-column col-md-8'>
				<h4>Articles</h4>
				<div class='bannerBar'></div>

				<div class='index-article row'>

					<div class='article-image col-md-4'>
						<a href='/interviews/interview-ripple-may-26-2015.php'><img align="left" alt='Interview with Ripple' src='./images/microphone_icon.png'></a>
					</div>
					<div class='col-md-8'>
						<h5><a href='/interviews/interview-ripple-may-26-2015.php'>Ripple Interview - 3D's Reign of Supremacy</a></h5>
						<div class='article-date'>
							May 26, 2015
						</div>
						<p class='article-content'>
							PlayingOnSunday interviews Ripple about his underrepresented main, tournement success, and regions to watch for in PMDB's first ever interview!
						</p>
					</div>

				</div>
				<hr />

				<div class='index-article row'>
					<div class='article-image col-md-4'>
						<a href='/mom/mom20.php'><img src='/images/MoM1.png'></a>
					</div>

					<div class='col-md-8'>
						<h5><a href='/mom/mom20.php'>Mind Over Meta 20 - Staying Positive</a></h5>
						<div class='article-date'>
							May 25, 2015
						</div>
						<p class='article-content'>
							Beyond the mind games and the hard reads, each player is impacted by the state of mind they bring to each set. By extension, members of the Project M community can help create a successful future for the game with positive mindsets and actions.
						</p>
					</div>

				</div>
				<hr />

				<div class='index-article row'>
					<div class='article-image col-md-4'>
						<a href='#'><img align="left" src='./images/placeholder-article.jpg'></a>
					</div>

					<div class='col-md-8'>
						<h5>Article Title - Subtitle</h5>
						<div class='article-date'>
							May 26, 2015
						</div>
						<p class='article-content'>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation...
						</p>
					</div>

				</div>

			</div>


			<div class='index-column col-md-4'>

				<div id='index-leaders'>
					<h4>Community</h4>
					<div class='bannerBar'></div>
					<h5>The top tiers for randomly selected regions.</h5>

				<?php
					$pass = 0;
					$curRegion;
					$prevRegion;
					echo "<table>";
					while($row = $ranks_res->fetch_assoc()){
						$curRegion = $row['region_name'];

						if (isset($prevRegion) && $curRegion === $prevRegion){
							$pass = 1;
						}
						else{
							$pass = 0;
						}
						if ($pass === 0){
							echo "<tr class='table-head'><td>".$curRegion."</td></tr>";
							$pass = 1;
						}
						else{}
				?>

						<tr class='table-row'>
							<td><?php echo $row['user_name']; ?></td>
							<td><?php echo $row['score']; ?></td>
							<td><?php echo $row['game_name']; ?></td>
						</tr>

				<?php
					$prevRegion = $curRegion;
						}
						echo "</table>";
				?>

				</div>


				<h4>Media</h4>
				<div class='bannerBar'></div>
				<h5>Streams, VODs, and pretty pictures.</h5>
				<p>
					<a href="http://thesaltmines.podomatic.com/" target="_blank">
						<img src='./images/media/salt-mines.jpg' alt='The Salt Mines - Project M Podcast' class='media-link' />
					</a>
				</p>
				<p>
					<a href="https://www.youtube.com/user/PMDepot" target="_blank">
						<img src='./images/media/pmdepot.jpg' alt='PMDepot on YouTube' class='media-link' />
					</a>
				</p>
        <p>
					<a href="http://www.twitch.tv/southernutahsmash" target="_blank">
						<img src='./images/media/sus-media-twitch.jpg' alt='Southern Utah Smash on Twitch' class='media-link' />
					</a>
				</p>



			</div>



			<div class='clear'></div>

		</div> <!-- end INDEX-MAIN div -->
	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
