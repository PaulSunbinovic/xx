
$(function () {
	
	
	$("#std_logininIdx").click(function(){
		var stdnm=$('input[name=stdnm]');
		var allnm=$('input[name=allnm]');
		
		var rmb=$('#rmb');
		if(rmb.is(":checked")==true){
			$('input[name=rmb]').val('y');
		}else{
			$('input[name=rmb]').val('n');
		}
		
		//防止输入空
		if($.trim(stdnm.val())==''){
			alert('姓名不能为空！');
			stdnm.focus();
			return false;
		}
		if($.trim(allnm.val())==''){
			alert('学号或者身份证号码不能为空！');
			allnm.focus();
			return false;
		}
		
		var prmts=$("#std_logininIdx").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					$('#errCtn').html("<div class='alert alert-warning alert-dismissible'>" +
							"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
							"<strong>姓名不正确</strong>" +
							"</div>");
				}else if(data.status==2){
					$('#errCtn').html("<div class='alert alert-warning alert-dismissible'>" +
							"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
							"<strong>学号或者身份证号码不正确</strong>" +
							"</div>");
				}else if(data.status==3){
					
					window.location=app_path;
				}
			
			
			},
			'json'
		);
		
		
	})
	
	
		
	
	$("#std_regist").click(function(){
		var stdnm=$('#stdnm');
		var stdnn=$('#stdnn');
		var stdpw=$('#stdpw');
		var stdpwag=$('#stdpwag');
		var stdcp=$('#stdcp');
		var stdml=$('#stdml');
		var stdintr=$('textarea[name=stdintr]');
		//防止输入空
		if($.trim(stdnm.val())==''){
			alert('用户名不能为空！');
			stdnm.focus();
			return false;
		}
		//alert(checkifenglish($.trim(stdnm.val()));
		if(checkifenglish($.trim(stdnm.val()))==false){
			alert('用户名不能使用英文字母以及_@以外的文字');
			stdnm.focus();
			return false;
		}
		if($.trim(stdnn.val())==''){
			alert('真实姓名不能为空！');
			stdnn.focus();
			return false;
		}
		if($.trim(stdpw.val())==''){
			alert('密码不能为空！');
			stdpw.focus();
			return false;
		}
		if($.trim(stdpw.val()).length<8){
			alert('密码不能小于8位！');
			stdpw.focus();
			return false;
		}
		if($.trim(stdpwag.val())==''){
			alert('请再次输入密码！');
			stdpwag.focus();
			return false;
		}
		if($.trim(stdpw.val())!=$.trim(stdpwag.val())){
			alert('两次输入的密码不一致');
			stdpw.val('');
			stdpwag.val('');
			stdpw.focus;
			return false;//
			
		}
//		if($.trim(stdcp.val())==''){
//			alert('手机号码不能为空！');
//			stdcp.focus();
//			return false;
//		}
		if($.trim(stdcp.val())!=''){
			var pttnmbl=/^1[3458][0-9]{9}$/;
			if(!pttnmbl.test($.trim(stdcp.val()))){
				alert('手机号码格式不正确！');
				stdcp.focus();
				return false;
			}
		}
//		if($.trim(stdml.val())==''){
//			alert('密保邮箱不能为空！');
//			stdml.focus();
//			return false;
//		}
		if($.trim(stdml.val())!=''){
			var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
			if(!pttneml.test($.trim(stdml.val()))){
				alert('邮箱格式不对！');
				stdml.focus();
				return false;
			}
		}
		
		stdintr.val(editor.getContent());
		
		var prmts=$("#std_regist").parent().parent().parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					$('#errCtn').html("<div class='alert alert-warning alert-dismissible'>" +
							"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
							"<strong>已存在该用户名，请更换</strong>" +
							"</div>");
				}else if(data.status==2){
					alert('注册成功，请登录');
					window.location=root_index;
				}else if(data.status==3){
					alert('注册失败');
				}
			
			
			},
			'json'
		);
	})
	
	
	$("#std_modify").click(function(){
		var stdnn=$('#stdnn');
		var stdcp=$('#stdcp');
		var stdml=$('#stdml');
		var stdintr=$('textarea[name=stdintr]');
		//防止输入空
		if($.trim(stdnn.val())==''){
			alert('真是姓名不能为空！');
			stdnm.focus();
			return false;
		}
//		if($.trim(stdcp.val())==''){
//			alert('手机号码不能为空！');
//			stdcp.focus();
//			return false;
//		}
		if($.trim(stdcp.val())!=''){
			var pttnmbl=/^1[3458][0-9]{9}$/;
			if(!pttnmbl.test($.trim(stdcp.val()))){
				alert('手机号码格式不正确！');
				stdcp.focus();
				return false;
			}
		}
//		if($.trim(stdml.val())==''){
//			alert('密保邮箱不能为空！');
//			stdml.focus();
//			return false;
//		}
		if($.trim(stdml.val())!=''){
			var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
			if(!pttneml.test($.trim(stdml.val()))){
				alert('邮箱格式不对！');
				stdml.focus();
				return false;
			}
		}
		stdintr.val(editor.getContent());
		var prmts=$("#std_modify").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					alert('已经存在该用户名，请更换');
				}else if(data.status==2){
					alert('修改信息成功');//由于更新了信息需要更新下
					window.location.href=document.referrer;
				}else if(data.status==3){
					alert('修改信息失败');
				}
			
			
			},
			'json'
		);
	})
	
	$("#std_modifypw").click(function(){
		var stdpworg=$('input[name=stdpworg]');
		var stdpwnew=$('input[name=stdpwnew]');
		var stdpwnewag=$('input[name=stdpwnewag]');
		//防止输入空
		if($.trim(stdpworg.val())==''){
			alert('原密码不能为空！');
			stdpworg.val('');stdpwnew.val('');stdpwnewag.val('');
			stdpworg.focus();
			return false;
		}
		if($.trim(stdpwnew.val())==''){
			alert('新密码不能为空！');
			stdpworg.val('');stdpwnew.val('');stdpwnewag.val('');
			stdpwnew.focus();
			return false;
		}
		if($.trim(stdpwnew.val()).length<8){
			alert('新密码不能小于8位！');
			stdpwnew.focus();
			return false;
		}
		if($.trim(stdpwnewag.val())==''){
			alert('再输一遍的新密码不能为空！');
			stdpworg.val('');stdpwnew.val('');stdpwnewag.val('');
			stdpwnewag.focus();
			return false;
		}
		if($.trim(stdpwnew.val())!=$.trim(stdpwnewag.val())){
			alert('两次密码不一致');
			stdpworg.val('');stdpwnew.val('');stdpwnewag.val('');
			stdpworg.focus();
			return false;
		}
		var prmts=$("#std_modifypw").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					alert('原始密码输入错误');
					stdpworg.val('');stdpwnew.val('');stdpwnewag.val('');
					stdpworg.focus();
				}else if(data.status==2){
					alert('密码修改成功');//由于更新了信息需要更新下
					window.location.href=document.referrer;
				}else if(data.status==3){
					alert('修改密码失败');
					stdpworg.val('');stdpwnew.val('');stdpwnewag.val('');
					stdpworg.focus();
				}
			
			
			},
			'json'
		);
	})
	
	$("#std_forget").click(function(){
		var stdnm=$('#stdnm');
		var stdml=$('#stdml');
		
		//防止输入空
		if($.trim(stdnm.val())==''){
			alert('用户名不能为空！');
			stdnm.focus();
			return false;
		}
		if($.trim(stdml.val())==''){
			alert('密保邮箱不能为空！');
			stdml.focus();
			return false;
		}
		var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
		if(!pttneml.test($.trim(stdml.val()))){
			alert('邮箱格式不对！');
			stdml.focus();
			return false;
		}
		var prmts=$("#std_forget").parent().serialize();//parameters
		
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					alert('发送密保邮件成功');//由于更新了信息需要更新下
					
				}else if(data.status==2){
					alert('发送密保邮件失败');
					
				}else if(data.status==3){
					alert('无此用户');
					
				}else if(data.status==4){
					alert('此用户名下的邮箱不正确');
				}
			
			
			},
			'json'
		);
	})
	
	$("#std_modifypwml").click(function(){
		var stdpwnew=$('input[name=stdpwnew]');
		var stdpwnewag=$('input[name=stdpwnewag]');
		//防止输入空
		
		if($.trim(stdpwnew.val())==''){
			alert('新密码不能为空！');
			stdpwnew.val('');stdpwnewag.val('');
			stdpwnew.focus();
			return false;
		}
		if($.trim(stdpwnew.val()).length<8){
			alert('新密码不能小于8位！');
			stdpwnew.focus();
			return false;
		}
		if($.trim(stdpwnewag.val())==''){
			alert('再输一遍的新密码不能为空！');
			stdpwnew.val('');stdpwnewag.val('');
			stdpwnewag.focus();
			return false;
		}
		if($.trim(stdpwnew.val())!=$.trim(stdpwnewag.val())){
			alert('两次密码不一致');
			stdpwnew.val('');stdpwnewag.val('');
			stdpwnew.focus();
			return false;
		}
		var prmts=$("#std_modifypwml").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					alert('密码修改成功');//由于更新了信息需要更新下
					window.location.href=root_index;
				}else if(data.status==2){
					alert('修改密码失败');
					stdpwnew.val('');stdpwnewag.val('');
					stdpwnew.focus();
				}
			
			
			},
			'json'
		);
	})
	
	
	
});




var string='';
function checkifenglish(string)
{
    var letters = "ABCDEFGHIJKLMNOPQRSTUVWSYabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz1234567890_.@";
     var i;
     var c;
     for( i = 0; i < string.length; i ++ )
     {
          c = string.charAt( i );
		   if (letters.indexOf( c ) < 0)
		      return false;
     }
     return true;
}

var prmts='';var str='';var ch='';
function rmvblk(prmts){//remove blank 去空格
	var prmtsnw='';//parameters new
	prmtsun=prmts.split('&');//parameters union
	for(var i=0;i<prmtsun.length;i++){
		if(i!=prmtsun.length-1){
			prmtsnw=prmtsnw+prmtsun[i].split('=')[0]+'='+superTrim(prmtsun[i].split('=')[1],'+')+'&';
		}else{
			prmtsnw=prmtsnw+prmtsun[i].split('=')[0]+'='+superTrim(prmtsun[i].split('=')[1],'+');
		}
	}
	return prmtsnw;
}

function superTrim(str,ch) {  
	if(str.length>0 && str.indexOf(ch)!=-1){ //it is a string and have ch
	while(str.substring(0,1)==ch)  
			  str  =  str.substring(1,str.length);  
	while(str.substring(str.length-1,str.length)==ch)  
		str   =   str.substring(0,str.length-1);  
   }
   return   str;  
 }