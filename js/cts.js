$(function() {
  var setHeight = function setHeight() {
    var height = $(document).height();
    if($(window).height() > height) {
      height = $(window).height();
    }
    $('body').height(height + 21);  
    $('#menu').height(height - 45);
    $('#content').height(height - 45);
  }
  window.setHeight = setHeight;
  setHeight();
  $('#menu .return-btn').on('click', function() {
    window.location = $(this).attr('href');
  });
  $('a[role=tab]').on('click', function(){
    setTimeout(function(){setHeight();},500);
  });
})
