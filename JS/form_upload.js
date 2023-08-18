$("#upload").change(function(){
	if (window.FormData === undefined){
		alert('В вашем браузере FormData не поддерживается')
	} else {
		var formData = new FormData();
		$.each($("#upload")[0].files,function(key, input){
			formData.append('file[]', input);
		});
 
		$.ajax({
			type: "POST",
			url: 'main/upload',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType : 'json',
			success: function(data){
				alert("Добро пожаловать Admin");
				data.forEach(function(msg) {
					$('#result').append(msg);
				});
			}
		});
	}
});