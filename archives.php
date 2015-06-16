<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

?>
<!DOCTYPE html>
<html>

<head>
<?php require_once($path.'/include/head.inc.php'); ?>
<!--<script src="/js/_archives.js"></script>-->
<title><?php echo $title; ?> - Archives</title>

</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content' class='container-fluid'>
		<h2>Archives</h2>
		<div class='bannerBar'></div>
		<div class='row-fluid'>

			<div class='col-md-4'>
				<img class='article-image' src='/images/MoM1.png' alt='Mind Over Meta' />
				<div class='clear'></div>

				<ul class='archive'>
					<li><a href='/mom/mom21.php'>Mind Over Meta 21 - Embracing Your Weaknesses</a></li>
					<li><a href='/mom/mom20.php'>Mind Over Meta 20 - Staying Postive</a></li>
					<li><a href='/mom/mom1.php'>Mind Over Meta 1 - Staggered-Hit Game (Originally Published 11/18/2014)</a></li>
				</ul>
			</div>

			<div class='col-md-4'>
				<img class='article-image' align="left" alt='Interview with Ripple' src='./images/microphone_icon.png'>
				<div class='clear'></div>

				<ul class='archive'>
					<li><a href='/interviews/interview-ripple-may-26-2015.php'>Ripple Interview - 3D's Reign of Supremacy</a></li>
				</ul>
			</div>



		</div>

	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
