

$('#form-comments').on('submit', function (e) {

  e.preventDefault();

  var data = $(this).serialize();
  var action = $(this).attr('action');

  var request = $.ajax({
    data: data,
    method: 'POST',
    url: action,
    dataType: 'JSON'
  });

  request.done(function(response) {
    if (response.status == true) {
      alert(response.message);
      window.location.href = response.redirect;
    }
  });

  request.fail(function(jqXHR, textStatus) {
    alert( "Request failed: " + textStatus );
  });
});

$('.delete-post').on('submit', function (e) {
    
    if (! confirm('Excluir post?')) {
      e.preventDefault();
    }

});