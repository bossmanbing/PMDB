<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

if (isset($_GET['id'])){
	$artID = $_GET['id'];
}
else{
	header('location:/index.php');
}

$art_qry = "SELECT sub_id, DATE_FORMAT(sub_date,'%b %d, %Y') AS 'sub_date', sub_content, sub_author, sub_title, sub_type
 							FROM submissions
							WHERE sub_id = $artID LIMIT 1";
$art_res = $db->query($art_qry);

$art_cnt = $art_res->num_rows;

if ( $art_cnt != 1 ){
	header('location:/index.php');
}

$article = mysqli_fetch_assoc($art_res);
$title = stripcslashes($article['sub_title']);
$author = stripslashes($article['sub_author']);
$articleDate = stripslashes($article['sub_date']);
$content = stripslashes($article['sub_content']);


$headline = '';
if ($article['sub_type'] == 'mom'){
	$headline = "<img class='headline-img' align='center' src='../images/MindOverMeta.png' alt='Mind Over Meta' />";
}

?>
<!DOCTYPE html>
<html>

<head>
<?php require_once($path.'/include/head.inc.php'); ?>
<script src="/js/_page-article.js"></script>
<title>SmashTracker - Mind Over Meta - Staying Positive</title>

</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content'>

		<img class='headline-img' align="center" src="../images/MindOverMeta.png" alt="Mind Over Meta" />
		<h2><?php echo $title ?></h2>
		<div class='article-tag-line'>
			<span class='article-page-date'><?php echo $articleDate; ?>,</span><span class='article-page-author'>by <?php echo $author; ?></span>
		</div>

		<div class='article-content'>
			<?php echo $content; ?>
		</div>
<p class='article-sig'>-<?php echo $author; ?></p>



	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
