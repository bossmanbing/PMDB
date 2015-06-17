
$(function() {

  $('.char-selected').show();

  $('.reset-btn').click(function(){
    $('.char-selected').attr('src','');
    $('.char-selected').attr('alt','');
    $('.char-form').val('');

    $(this).hide();
    $('.char-selected').hide();
    $('.select-main').show();
    $('.characters-list').show();
    return fale;
  })

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
      $('.hidden').show();
    } else{}
    return false;
  });

});


function FunctionName(e) {

}
