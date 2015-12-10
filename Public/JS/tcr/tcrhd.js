
$(function () {
	
	
	
	$('#tcr_loginout').click(function(){
		$.post(
			hdllgot,
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


