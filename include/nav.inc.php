<?php
  $signIn;
  if (isset($_SESSION['logged']) && $_SESSION['logged'] === 1){
    $signIn = "<!-- <a href='/profile.php'>My Profile</a> | --><a href='/php/logout.php'>Log Out</a>";
  }
  else{
    $signIn = "<a href='/register.php'>Sign Up</a>  <a id='sign-in' href='/register.php'>Log In</a>";
  }
?>

<div class='bannerBar'></div>

<div id='sign-in-box'>
  <button id='sign-in-close'>X</button>
  <form id='sign-in-form' action='/php/signin.php' method='post'>
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

<div id='nav'>
  <ul>
    <li>
      <a href='/'>Home</a>
    </li>
    <li>
      <a href='/ranks.php'>Rankings</a>
    </li>
    <li id='signin'>
<?php echo $signIn; ?>
    </li>
  </ul>
</div>
<div class='bannerBar'></div>
