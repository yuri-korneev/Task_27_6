$('#login').submit(function(e){
    e.preventDefault();
    var data = new FormData(this);
    $.ajax({
        type:'POST',
        url: 'login/checkLogin',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
            location.replace('/');
        },
        error: function(response, status, error){
           var errors = response.responseJSON;
           $('.form-control-feedback').text('');
           if (errors.errors) {
               errors.errors.forEach(function(data, index) {
                   var field = Object.getOwnPropertyNames (data);
                   var value = data[field];
                   var div = $("#"+field[0]).closest('div');
                   div.addClass('has-danger');
                   div.children('.form-control-feedback').text(value);
               });
           }
        }
    });
});

$('#loginVK').submit(function(e){
    e.preventDefault();
    var data = new FormData(this);
    $.ajax({
        type:'POST',
        url: 'login/loginVK',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
            location.replace('/');
        },
        error: function(response, status, error){
           var errors = response.responseJSON;
           $('.form-control-feedback').text('');
           if (errors.errors) {
               errors.errors.forEach(function(data, index) {
                   var field = Object.getOwnPropertyNames (data);
                   var value = data[field];
                   var div = $("#"+field[0]).closest('div');
                   div.addClass('has-danger');
                   div.children('.form-control-feedback').text(value);
               });
           }
        }
    });
});