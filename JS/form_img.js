$('.card-action a').click(function(e){
    e.preventDefault();
    $.ajax({
        type:'POST',
        url: 'image',
        data: {data : $(this).attr("href")},
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

$('.card-delete a').click(function(e){
    e.preventDefault();
    $.ajax({
        type:'POST',
        url: 'image/deleteImg',
        data: {data : $(this).attr("href")},
        cache: false,
        success: function(response){
            swal({
                title: "Отлично!",
                text: "Ваша картинка удалена!",
                icon: "success",
            }).then(() => {
              location.reload();
            });
        },
        error: function(response, status, error){
            alert("Вы пытаетесь удалить чужую картинку");
         } 
    });
});