<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

// Select 10 most recent articles.
$art_qry = "SELECT sub_id, sub_category, sub_type, sub_title,
									DATE_FORMAT(sub_date,'%b %d, %Y')  AS 'sub_date',
									sub_author, sub_description, sub_content
							FROM submissions
							ORDER BY sub_id DESC";
$art_res = $db->query($art_qry);

$momContent = '';
$intContent = '';
$wpmContent = '';

while ($row = $art_res->fetch_assoc()){

	if ($row['sub_category'] == 'video'){
		$link = "<a href='https://www.youtube.com/watch?v=".$row['sub_content']."' target='_blank' />";
	}
	else{
		$link = "<a href='/article.php?id=".$row['sub_id']."'>";
	}

	$line = "<li><span class='article-page-date tagline'>".$row['sub_date']."</span><br />".$link.$row['sub_title']."</a></li>";

	if ( $row['sub_type'] == 'mom'){
		$momContent = $momContent.$line;
	}
	elseif ( $row['sub_type'] == 'interview'){
		$intContent = $intContent.$line;
	}
	elseif ( $row['sub_type'] == 'weekPM'){
		$wpmContent = $wpmContent.$line;
	}
}
$momImg = "<img class='article-image' src='/images/MoM1.png' alt='Mind Over Meta' />";
$intImg = "<img class='article-image' alt='Interview' src='./images/microphone_icon.png'>";
$weekImg = "<img class='article-image' alt='This Week in PM' src='./images/weekpm.jpg'>";

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

			<div class='col-md-2'>
				<img class='article-image' src='/images/MoM1.png' alt='Mind Over Meta' />
				<div class='clear'></div>

				<ul class='archive'>
					<?php echo $momContent; ?>
				</ul>
			</div>

			<div class='col-md-2'>
				<img class='article-image' align="left" alt='Interviews' src='./images/microphone_icon.png'>
				<div class='clear'></div>

				<ul class='archive'>
					<?php echo $intContent; ?>
				</ul>
			</div>

			<div class='col-md-2'>
				<img class='article-image' align="left" alt='This Week in PM' src='./images/weekpm.jpg'>
				<div class='clear'></div>

				<ul class='archive'>
					<?php echo $wpmContent; ?>
				</ul>
			</div>



		</div>

	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
