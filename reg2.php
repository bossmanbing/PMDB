<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

if (!isset($_SESSION['logged']) && $_SESSION['logged'] != 1){
	header('location:'.$path = $_SERVER['DOCUMENT_ROOT'].'/index.php');
}
else{}

$region_query = "SELECT region_id, region_name, region_state FROM regions ORDER BY region_state";
$region_res = $db->query($region_query);


?>
<!DOCTYPE html>
<html>

<head>
<?php require_once($path.'/include/head.inc.php'); ?>
<script src="/js/_reg2.js"></script>
<title>SmashTracker - Almost Done</title>

</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content' class='container'>

		<h2>Almost done...</h2>
		<p>
			First, select your region. We'll set this as your primary region, and any players you add will be placed in the same region.
		</p>

		<form action='/php/_reg2.php' method='post' class='form-inline'>

			<div class='form-group'>
				<label for='region'>Region </label>
				<select name='region' class='form-control'>
		<?php
			// Echo STATE - REGION NAME as select options.
			while ($row = $region_res->fetch_assoc()){
				echo "<option value='".$row['region_id']."'>".$row['region_state']." - ".$row['region_name']."</option>";
			}
		 ?>
				</select>
			</div>
			<button type='submit' class='btn btn-default'>Submit</button>
		</form>
		<br />

		<h4>Your region isn't listed?</h4>
		<p>
			We're still building our database. Contant an administrator and we'll work on getting you set up.
		</p>

	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
