function create(type) {
  var amount = document.getElementsByClassName('draggable').length + 1;
  $('#main-window').append('<div class="draggable '+type+'" id="drag-'+amount+'" data-x="0" data-y="0" style="transform: translate(0px,0px);"></div>');
  if($('#main-info h2').length <= 0){
    $('#main-info').append('<h2>Tisch '+type+' wurde hinzugefügt</h2>');
    setTimeout(function(){ $('#main-info').empty(); }, 5000);
  }
}

$(document).on('click','.draggable',function(){
  $('#input-x').val($(this)[0]['dataset']['x']);
  $('#input-y').val($(this)[0]['dataset']['y']);
  $('#input-id').val($(this)[0]['id']);

  $('.dp-3').css('display','block');
  $('#dp-3').attr('class','fas fa-arrow-up');
});

$(document).on('change','#input-x',function(){
  var x = $(this).val(); var y = $('#input-y').val(); var id = $('#input-id').val();
  $('#'+id).attr('data-x',x); $('#'+id).attr('data-y',y);
  $('#'+id).css({"-webkit-transform":"translate("+x+"px,"+y+"px)"});
});

$(document).on('change','#input-y',function(){
  var y = $(this).val(); var x = $('#input-x').val(); var id = $('#input-id').val();
  $('#'+id).attr('data-x',x); $('#'+id).attr('data-y',y);
  $('#'+id).css({"-webkit-transform":"translate("+x+"px,"+y+"px)"});
});

$(document).on('click','#bt-delete',function(){
  var id = $('#input-id').val();
  $('#'+id).remove();
});
