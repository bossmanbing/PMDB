
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
});
//URL Params
function FunctionName(e) {

}
