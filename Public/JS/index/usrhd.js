
$(function () {
	
	
	
	$("#usr_logininIdx").click(function(){
		var usrnm=$('input[name=usrnm]');
		var usrpw=$('input[name=usrpw]');
		
		var rmb=$('#rmb');
		if(rmb.is(":checked")==true){
			$('input[name=rmb]').val('y');
		}else{
			$('input[name=rmb]').val('n');
		}
		
		//防止输入空
		if($.trim(usrnm.val())==''){
			alert('用户名不能为空！');
			usrnm.focus();
			return false;
		}
		if($.trim(usrpw.val())==''){
			alert('密码不能为空！');
			usrpw.focus();
			return false;
		}
		
		var prmts=$("#usr_logininIdx").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdllgin,
			prmts,
			function(data){
				
				if(data.status==1){
					$('#errCtn').html("<div class='alert alert-warning alert-dismissible'>" +
							"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
							"<strong>用户名不正确</strong>" +
							"</div>");
				}else if(data.status==2){
					$('#errCtn').html("<div class='alert alert-warning alert-dismissible'>" +
							"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
							"<strong>密码不正确</strong>" +
							"</div>");
				}else if(data.status==3){
					
					window.location=app_path;
				}
			
			
			},
			'json'
		);
	})
	
	
	
	
	$('#usr_loginout').click(function(){
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


//var prmts=''; var str=''; var ch='';
//function rmvblk(prmts){//remove blank 去空格
//	var prmtsnw='';//parameters new
//	prmtsun=prmts.split('&');//parameters union
//	for(var i=0;i<prmtsun.length;i++){
//		if(i!=prmtsun.length-1){
//			prmtsnw=prmtsnw+prmtsun[i].split('=')[0]+'='+superTrim(prmtsun[i].split('=')[1],'+')+'&';
//		}else{
//			prmtsnw=prmtsnw+prmtsun[i].split('=')[0]+'='+superTrim(prmtsun[i].split('=')[1],'+');
//		}
//	}
//	return prmtsnw;
//}
//
//function   superTrim(str,ch) { 
//	if(str.length>0 && str.indexOf(ch)!=-1){ //it is a string and have ch
//	while(str.substring(0,1)==ch)  
//			  str  =  str.substring(1,str.length);  
//	while(str.substring(str.length-1,str.length)==ch)  
//		str   =   str.substring(0,str.length-1);  
//   }
//   return   str;  
// }