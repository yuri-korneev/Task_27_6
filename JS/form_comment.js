$('.comment-action a').click(function(e){
    e.preventDefault();
    $.ajax({
        type:'POST',
        url: 'image/deleteComments',
        data: {data : $(this).attr("href")},
        cache: false,
        success: function(response){
            $("#" + response).empty();
        },
        error: function(response, status, error){
            alert("Вы пытаетесь удалить чужой комментарий");
         } 
    });
});

