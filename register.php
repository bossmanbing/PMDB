<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require($path.'/include/init.inc.php');

if (isset($_SESSION['logged']) && $_SESSION['logged'] === 1){
	header('location:'.$path = $_SERVER['DOCUMENT_ROOT'].'/index.php');
}
else{}

?>
<!DOCTYPE html>
<html>

<head>
<?php require_once($path.'/include/head.inc.php'); ?>
<script src="/js/_register.js"></script>
<title><?php echo $title; ?> - Register or Log In</title>

</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content'>

		<div class='row'>
			<div class='col-md-6'>
				<h2>Sign up for the closed Beta.</h2>

				Apply for early access to DBPM.
				<br /><br />
				<div class='bannerBar'></div>

				<iframe src="https://docs.google.com/forms/d/1hIpQAE_CVFmzXwcfZGH1XdTzwfnvIEqU8IlH6DLTFlI/viewform?embedded=true" width="100%" height="500" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>

				<p>
					<strong>Do you need an account?</strong>
				</p>
				<p>
					Short answer? Probably not.
				</p>
				<p>
					You only need to worry about an account if you consider yourself a TO or other sort of organizer in your local Smash scene. You'll need an approved account if you'll be adding players, updating bios, uploading match information, or managing regional media.
				</p>
				<p>
					If this sounds like you, you'll need an account. Sign up now to get started!
				</p>

			</div>

		<div class="col-md-6">
			<h2>Welcome back.</h2>

			Log in to your SmashTracker account to get back to business.
			<br /><br />
			<div class='bannerBar'></div>
			<br />

			<form id='reg-signin' action='./php/signin.php' method='post'>
		    <div class='form-row'>
		      <label for='username'>
		        Username :
		      </label>
		      <input type='text' maxlength=24 name='username' required />
		    </div>

		    <div class='form-row'>
		      <label for='password'>
		        Password :
		      </label>
		      <input type='password' maxlength=24 name='password' required />
		    </div>

		    <input type='submit' value='Sign In' name='signIn' />

		  </form>

		</div>

	</div>

	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
