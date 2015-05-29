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
<title>SmashTracker - Register or Log In</title>

</head>

<body>
<?php require_once($path.'/include/header.inc.php'); ?>
<?php require_once($path.'/include/nav.inc.php'); ?>

	<div id='content'>

		<div class='reg-col'>
			<h2>Create an account.</h2>

			Sign up to start promoting your region.
			<br /><br />
			<div class='bannerBar'></div>
			<br />

			<form action='./php/_register.php' method='post' id='reg-register'>

				<div class='form-row'>
					<label for='username'>
						Username:
					</label>
					<input type='text' name='username' maxlength=32 required />
				</div>

				<div class='form-row'>
					<label for='password'>
						Password:
					</label>
					<input type='password' id='password' name='password' maxlength='48' required />
				</div>

				<div class='form-row'>
					<label class='control-label' for='repassword'>
						Re-Enter Password:
					</label>
					<input class='form-label' type='password' id='repassword' name='repassword' maxlength='48' required /><span id='pass-valid'></span>
				</div>

				<div class='form-row'>
					<label for='email'>
						Email Address:
					</label>
					<input type='text' id='email' name='email' maxlength='48' email required />
				</div>

				<div class='form-row'>
					<label class='control-label' for='reemail'>
						Re-Enter Email:
					</label>
					<input class='form-label' type='text' id = 'remail' name='remail' maxlength='48' email required /><span id='email-valid'></span>
				</div>
				<div class='form-helper'>*We won't send you emails unless you need help with your password</div>

				<div class='form-row'>
					<input type='submit' value='Sign Up!' />
				</div>

			</form>

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

		<div class="reg-col">
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

		<div class='clear'></div>

	</div><!-- end CONTENT div -->

<?php require_once($path.'/include/footer.inc.php'); ?>
