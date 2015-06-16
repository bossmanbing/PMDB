
$(function() {

  var addForm = $('#add-form');

  addForm.submit(function(){
    $.post('./php/add-submit.php', $(this).serialize(),
			function(data){
				if (data){
          $('#outcome').html('');
          $('#outcome').show();
					$('#outcome').append(data);
				}
				else{}
		});
    return false;
  });

  var chars = 1;
  var rem = 3;
  $('.char-select').click(function(){
    rem --;
    var name = $(this).attr('alt');
    var src = $(this).attr('src');
    var charID = $(this).attr('attr-id');
    var player = $('#player-name').val();
    $(this).hide();

    $('.char-'+chars).val(name);
    console.log(name, chars, charID);
    if ( chars === 1 ){
      $('.characters-label').text("Select "+rem+" alts for "+player);
    }
    if ( chars <= 3 ){
      $('.char-'+chars).val(charID);
      $('.characters-label').text("Select "+rem+" alt for "+player);
      $('.selected-'+chars).attr('src',src);
      $('.selected-'+chars).attr('alt',name);
      $('.selected-'+chars).show();
    } else{}

    chars ++;

    if ( chars > 3 ){
      $('.characters-label').text('Characters have been selected');
      $('.characters-list').hide();
    } else{}
    return false;
  });

});


function FunctionName(e) {

}
