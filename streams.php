<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

?>
<!DOCTYPE html>
<html>

<head>
<?php require_once($path.'/include/head.inc.php'); ?>
<script src="/js/_streams.js"></script>
<title><?php echo $title; ?> - Project M Streams</title>

</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content' class='container-fluid'>

		<div id='streams' class='row-fluid'>
			<div id='now-playing' class='col-md-8'>
				<h4>Now Streaming</h4>
				<div class='bannerBar'></div>
				<br />
				<div id='player'></div>
			</div>

			<div id='stream-chat' class='col-md-4'>
				<h4></h4>
				<div class='bannerBar'></div>
			</div>
		</div>

		<div class='clear'><br /></div>

		<div id='live-streams' class='row-fluid'>
			<h4>Live Streams <span class='float-right'><a href='/stream_schedule.php'>Full Stream Schedule >></a></span></h4>
			<div class='bannerBar'></div>
			<br />
		</div>

		<div id='channels'>
			<div class='row-fluid'>
				<div class='col-md-12'>
						<h4>Project M Stream Schedules</h4>
						<div class='bannerBar'></div>

						<div class='row-fluid'>

							<div class='col-md-3 chan-col'>
								<h4>Monday</h4>
								<ul id='mon'>
								</ul>
							</div>

							<div class='col-md-3 chan-col'>
								<h4>Tuesday</h4>
								<ul id='tue'>
								</ul>
							</div>

							<div class='col-md-3 chan-col'>
								<h4>Wednesday</h4>
								<ul id='wed'>
								</ul>
							</div>

							<div class='col-md-3 chan-col'>
								<h4>Thursday</h4>
								<ul id='thu'>
								</ul>
							</div>
						</div>

						<div class='row-fluid'>
							<div class='col-md-3 chan-col'>
								<h4>Friday</h4>
								<ul id='fri'>
								</ul>
							</div>

							<div class='col-md-3 chan-col'>
								<h4>Saturday</h4>
								<ul id='sat'>
								</ul>
							</div>

							<div class='col-md-3 chan-col'>
								<h4>Sunday</h4>
								<ul id='sun'>
								</ul>
							</div>

							<div class='col-md-3 chan-col'>
								<h4>Misc. Channels</h4>
								<ul id='misc'>
								</ul>
							</div>

						</div>

					</div>

			</div>

		</div>


		</div>

	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
