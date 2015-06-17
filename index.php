<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

// Select player info for right column features
$players_qry = "SELECT user.user_id, user_name, user_bio, user_affiliation,
												char_displayName, char_fileName, region_name
									FROM user
									JOIN user_region
										ON user_region.user_id = user.user_id
									JOIN regions
										ON regions.region_id = user_region.region_id
									JOIN user_characters
										ON user_characters.user_id = user.user_id
									JOIN characters
										ON characters.char_id = user_characters.char_id
								WHERE LENGTH(user_bio) > 5
									AND is_main = 1
									ORDER BY RAND ()
									LIMIT 5";

$players_res = $db->query($players_qry);

// Select 10 most recent articles.
$art_qry = "SELECT sub_id, sub_category, sub_type, sub_title,
									DATE_FORMAT(sub_date,'%b %d, %Y')  AS 'sub_date',
									sub_author, sub_description, sub_content
							FROM submissions
							ORDER BY sub_date ASC LIMIT 10";
$art_res = $db->query($art_qry);
$momImg = "<img class='article-image' src='/images/MoM1.png' alt='Mind Over Meta' />";
$intImg = "<img class='article-image' alt='Interview' src='./images/microphone_icon.png'>";
$weekImg = "<img class='article-image' alt='This Week in PM' src='./images/weekpm.jpg'>";
?>
<!DOCTYPE html>
<html>

<head>
<?php require_once($path.'/include/head.inc.php'); ?>
<script src="/js/_page-index.js"></script>
<title><?php echo $title; ?> - Everything Smash</title>

</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content' class='container-fluid'>
		<h2>Welcome to Database Project M</h2>
		<div class='bannerBar'></div>
		<h4>We're still getting things together.</h4>
		<div class='index-body'>

			<p>
				Welcome to the launch of Database:PM, or DBPM, a webpage devoted to integrating the Super Smash Brothers: Project M community on multiple scales through multiple means.
			</p>

			<p>
				Here you can expect to find the latest information and discussion about Project M, akin to what you might see on the <a href='http://reddit.com/r/ssbpm' target='_blank'>Project M subreddit</a> and on <a href='http://smashboards.com/categories/project-m.465/' target='_blank'>Smashboards’s Project M subforum</a>. Additionally, you can expect articles and media about Project M, including articles, podcasts, videos, and more. We will work to bring you the latest on Project M, from metagame advice to interviews with top players to a variety of other topics. But we’re not just a web blog.
			</p>
			<p>
				In the face of challenges for the future of Project M, we are looking to unite the community of Project M into a single cohesive unit on the largest scales. That means connecting local, regional, and national communities online. We are looking to work in conjunction with other already-existing avenues of community integration, including the subreddit and Smashboards subforum we mentioned earlier. But we are making efforts to integrate the community in a more extensive way, one that could potentially put YOU and YOUR SCENE into the spotlight and give you new motivations to reach your true potential. While we can’t reveal information on this quite yet, stay tuned in the coming weeks for more information from Database:PM!
			</p>
			<p>
				Stick with us and stay up-to-date and connected to the rest of the Project M scenes around the world.
			</p>
			<p class='index-disclaimer'>
				<em>(DBPM is not in any way affiliated with the Project M Development Team. This project is by the fans, for the fans, and we have immense respect for the PMDT’s hard work and dedication.)</em>
			</p>
		</div>

		<p>
			<a href='/about.php' class='article-sig'>Learn more about DBPM...</a>
		</p>
		<div class='clear'></div>

		<div id='index-main' class='row'>

			<div class='index-column col-md-8'>
				<h4>Articles</h4>
				<div class='bannerBar'></div>


	<?php
		while ($row = $art_res->fetch_assoc()){
			$img = '';
			if ($row['sub_type'] == 'mom'){
				$img = $momImg;
			}
			elseif ($row['sub_type'] == 'interview'){
				$img = $intImg;
			}
			elseif ($row['sub_type'] == 'weekPM'){
				$img = $weekImg;
			} else{}

			if ($row['sub_category'] == 'video'){
				$link = "<a href='https://www.youtube.com/watch?v=".$row['sub_content']."' target='_blank' />";
			}
			else{
				$link = "<a href='article.php?id=".$row['sub_id']."'>";
			}

			echo "<div class='index-article row'>";
			echo "<div class='col-md-4'>".$link.$img."</a></div>";
			echo "<div class='col-md-8'><h5>".$link.$row['sub_title']."</a></h5>";
			echo "<span class='article-page-date tagline'>".$row['sub_date']."</span><span class='article-page-author tagline'> -".$row['sub_author']."</span>";
			echo "<p class='article-content'>".$row['sub_description']."</p></div>";
			echo "</div><hr />";

		}
		?>
			</div>


			<div class='index-column col-md-4'>

				<div class='index-players'>
					<h4>Community</h4>
					<div class='bannerBar'></div>

					<h5>Meet PM Players</h5>

				<?php
					while($row = $players_res->fetch_assoc()){
						echo "<div class='row'>";
						echo "<div class='col-md-3'><strong>".$row['region_name']."</strong></div>";
						echo "<div class='col-md-6'><a href='/player-view.php?player=".$row['user_id']."'>".$row['user_affiliation']." | ".$row['user_name']."</a></div>";
						echo "<div class='col-md-3'><img src='/images/pm/chars/".$row['char_fileName']."' alt='".$row['char_displayName']."' class='featured-character' /></div>";
						echo "</div>";
						}
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
