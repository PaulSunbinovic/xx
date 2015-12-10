
$(function () {
	
	
	
	
	
	$('#wxusr_loginout').click(function(){
		$.post(
			hdlwxlgot,
			{},
			//alert(),
			function(data){
				if(data.status==1){
					alert('注销成功');
					window.location=app_path;
				}
			},
			'json'
		);
		
	})
	

});


