
$(function() {
  var player1val;
  var player1text;

  var player2val;
  var player2text;

  var game;

  var winner1;
  var winner2;
  var winner;

  var nextStep  = $('#nextStep');
  var rankForm = $('#rank-form');
  var selectWinner = $('#select-winner');

  nextStep.click(function(){
    if ($(this).val() == "Reset"){
      $(this).val('Next');
      $('#outcome').hide();
      selectWinner.hide();
      $("#player1 option:selected").removeAttr("selected");
      $("#player2 option:selected").removeAttr("selected");

      $("#player1 option:selected").text("Select a player.");
      $("#player2 option:selected").text("Select a player.");

    }else{
      $(this).val('Reset');
      selectWinner.show();
    }

    player1val = $('#player1 option:selected').val();
    player1text = $('#player1 option:selected').text();

    player2val = $('#player2 option:selected').val();
    player2text = $('#player2 option:selected').text();

    game = $('#game option:selected').val();

    winner1 = $('#winner1');
    winner2 = $('#winner2');

    winner1.val(player1val);
    winner1.text(player1text);
    winner2.val(player2val);
    winner2.text(player2text);

    return false;
  });

  rankForm.submit(function(){
    $.post('./php/rank-submit.php', $(this).serialize(),
			function(data){
				if (data){
          $('#outcome').html('');
          $('#outcome').show();
					$('#outcome').append(data);
				}
				else{}
		});
    nextStep.click();
    return false;
  });
});
//URL Params
function FunctionName(e) {

}
