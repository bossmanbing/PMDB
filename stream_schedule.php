<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

?>
<!DOCTYPE html>
<html>

<head>
<?php require_once($path.'/include/head.inc.php'); ?>
<script src="/js/_stream_schedule.js"></script>
<title>SmashTracker - Project M Stream Schedule</title>

</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content' class='container-fluid'>


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

	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
