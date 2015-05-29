
$(function() {

  var email = $('#email');
  var remail = $('#remail');
  var pass = $('#password');
  var repass = $('#repassword');

  //
  // Check if entered emails match up
  remail.focusout(function(){
    var emailVal = email.val();
    var remailVal = $(this).val();
    if ( remailVal != emailVal ){
      console.log("emails don't match");
      $(this).parent().removeClass('has-success');
      $(this).removeClass('has-success');

      $(this).parent().addClass('has-error');
      $(this).addClass('has-error');
      $('#email-valid').html("<img src='/images/x.png' alt='Email addresses do not match.' />")
    }
    else{
      console.log('emails match');
      $(this).parent().removeClass('has-error');
      $(this).removeClass('has-error');

      $(this).parent().addClass('has-success');
      $(this).addClass('has-success');
      $('#email-valid').html("<img src='/images/check.png' alt='Email addresses match.' />")
    }

  });

  //
  // Check if entered passwords match up
  repass.focusout(function(){
    var passVal = pass.val();
    var repassVal = $(this).val();
    if ( repassVal != passVal ){
      console.log("passwords don't match");
      $(this).parent().removeClass('has-success');
      $(this).removeClass('has-success');

      $(this).parent().addClass('has-error');
      $(this).addClass('has-error');
      $('#pass-valid').html("<img src='/images/x.png' alt='Passwords do not match.' />")
    }
    else {
      console.log('passwords match');
      $(this).parent().removeClass('has-error');
      $(this).removeClass('has-error');

      $(this).parent().addClass('has-success');
      $(this).addClass('has-success');
      $('#pass-valid').html("<img src='/images/check.png' alt='Passwords match.' />")

    }

  });

});
//URL Params
function FunctionName(e) {

}
