$('#comments').submit(function(e){
    e.preventDefault();
    var data = new FormData(this);
    $.ajax({
        type:'POST',
        url: 'image/uploadComments',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
            swal({
                title: "Отлично!",
                text: "Ваш комментарий добавлен к картинке!",
                icon: "success",
            }).then(() => {
              
                $.ajax({
                    type:'POST',
                    url: 'image',
                    data: {data : response},
                    cache: false,
                    success: function(response){
                    $("#img_big").empty();
                    $("#img_big").append(response);
                    },
                    error: function(response, status, error){
                        alert(response);
                     }
                });

            });
        },
        error: function(response, status, error){
           alert(response);
        }
    });
});