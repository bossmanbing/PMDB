<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');
echo $_SESSION ['user_level'];

if ( !isset($_SESSION['logged']) || $_SESSION['logged'] != 1 ){
	header('location:'.$path.'/index.php');
}
if (  !isset($_SESSION['user_level']) || $_SESSION['user_level'] != 2 ){
	//header('location:'.$path.'/index.php');
	echo "IT BROKE!";
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
<title><?php echo $title; ?> - Almost Done</title>

</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content' class='container'>

		<div class='col-md-6'>
			<h2>Almost done...</h2>
			<p>
				First, select your region. We'll set this as your primary region, and any players you add will be placed in the same region.
			</p>

			<form action='/php/_reg2.php' method='post' class='form-inline'>

				<div class='form-group'>
					<label for='region'>Region </label>
					<select name='region' class='form-control' required>
						<option>Select a Region...</option>
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
		</div>

		<div class='col-md-6'>

			<h2>Your region isn't listed?</h2>
			<p>
				We're still building our regions, so there's a chance we're missing you Just fill out the form below and a PMDB admin will review your request.
			</p>
			<iframe class='overflow-auto' src="https://docs.google.com/forms/d/1OXc_1kLqot_vm0I7sFh5_i-eyaiu02z9p-p20McWjrA/viewform?embedded=true" width="100%" height="600px" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
		</div>

	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
