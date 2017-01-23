$(function() {
  var userList,saveType;
  saveType = 'saveNew';
  $.ajax({
    url: 'includes/db/user.php',
    type: 'POST',
    data: {type: 'getAll'}
  }).success(function(data, status, headers, config) {
    userList = JSON.parse(data);
    saveType = 'saveOld';
  }).fail(function(error){
    var blo='ölp';
  });
  
  $('#userSearch').on('change', function(){
    var bla = '';
  });
  $('#userSav').on('click', function(){
    $.ajax({
      url: 'includes/db/user.php',
      type: 'POST',
      data: {type: saveType, login: $('#user_login').val(), passwort: $('#user_passwort').val(), nachname: $('#user_nachname').val(), vorname: $('#user_vorname').val(), email: $('#user_email').val(), telefon: $('#user_telefon').val(), sprache: $('#user_sprache').val(), rolle: $('#user_rolle').val()}
    }).success(function(data, status, headers, config) {
      location.reload();
    }).fail(function(error){
      location.reload();
    });
  });
});
