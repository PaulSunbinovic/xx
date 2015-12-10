
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
			hdlurl,
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
				}else if(data.status==4){
					$('#errCtn').html("<div class='alert alert-warning alert-dismissible'>" +
							"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
							"<strong>对不起，你的帐号被冻结，请联系管理员</strong>" +
							"</div>");
				}
			
			
			},
			'json'
		);
		
		
	})
	
	
	$("#st").click(function(){
			
		var prmts=$("#st").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					alert('设置成功');
				}else if(data.status==2){
					alert('设置失败');
				}
			
			
			},
			'json'
		);
	})
	
	
	$("#usr_regist").click(function(){
		var usrnm=$('#usrnm');
		var usrnn=$('#usrnn');
		var usrpw=$('#usrpw');
		var usrpwag=$('#usrpwag');
		var usrcp=$('#usrcp');
		var usrml=$('#usrml');
		var usrintr=$('textarea[name=usrintr]');
		//防止输入空
		if($.trim(usrnm.val())==''){
			alert('用户名不能为空！');
			usrnm.focus();
			return false;
		}
		//alert(checkifenglish($.trim(usrnm.val()));
		if(checkifenglish($.trim(usrnm.val()))==false){
			alert('用户名不能使用英文字母以及_@以外的文字');
			usrnm.focus();
			return false;
		}
		if($.trim(usrnn.val())==''){
			alert('真实姓名不能为空！');
			usrnn.focus();
			return false;
		}
		if($.trim(usrpw.val())==''){
			alert('密码不能为空！');
			usrpw.focus();
			return false;
		}
		if($.trim(usrpw.val()).length<8){
			alert('密码不能小于8位！');
			usrpw.focus();
			return false;
		}
		if($.trim(usrpwag.val())==''){
			alert('请再次输入密码！');
			usrpwag.focus();
			return false;
		}
		if($.trim(usrpw.val())!=$.trim(usrpwag.val())){
			alert('两次输入的密码不一致');
			usrpw.val('');
			usrpwag.val('');
			usrpw.focus;
			return false;//
			
		}
//		if($.trim(usrcp.val())==''){
//			alert('手机号码不能为空！');
//			usrcp.focus();
//			return false;
//		}
		if($.trim(usrcp.val())!=''){
			var pttnmbl=/^1[3458][0-9]{9}$/;
			if(!pttnmbl.test($.trim(usrcp.val()))){
				alert('手机号码格式不正确！');
				usrcp.focus();
				return false;
			}
		}
//		if($.trim(usrml.val())==''){
//			alert('密保邮箱不能为空！');
//			usrml.focus();
//			return false;
//		}
		if($.trim(usrml.val())!=''){
			var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
			if(!pttneml.test($.trim(usrml.val()))){
				alert('邮箱格式不对！');
				usrml.focus();
				return false;
			}
		}
		
		usrintr.val(editor.getContent());
		
		var prmts=$("#usr_regist").parent().parent().parent().serialize();//parameters
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
	
	
	$("#usr_modify").click(function(){
		var usrnn=$('#usrnn');
		var usrcp=$('#usrcp');
		var usrml=$('#usrml');
		var usrintr=$('textarea[name=usrintr]');
		//防止输入空
		if($.trim(usrnn.val())==''){
			alert('真是姓名不能为空！');
			usrnm.focus();
			return false;
		}
//		if($.trim(usrcp.val())==''){
//			alert('手机号码不能为空！');
//			usrcp.focus();
//			return false;
//		}
		if($.trim(usrcp.val())!=''){
			var pttnmbl=/^1[3458][0-9]{9}$/;
			if(!pttnmbl.test($.trim(usrcp.val()))){
				alert('手机号码格式不正确！');
				usrcp.focus();
				return false;
			}
		}
//		if($.trim(usrml.val())==''){
//			alert('密保邮箱不能为空！');
//			usrml.focus();
//			return false;
//		}
		if($.trim(usrml.val())!=''){
			var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
			if(!pttneml.test($.trim(usrml.val()))){
				alert('邮箱格式不对！');
				usrml.focus();
				return false;
			}
		}
		usrintr.val(editor.getContent());
		var prmts=$("#usr_modify").parent().serialize();//parameters
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
	
	$("#usr_modifypw").click(function(){
		var usrpworg=$('input[name=usrpworg]');
		var usrpwnew=$('input[name=usrpwnew]');
		var usrpwnewag=$('input[name=usrpwnewag]');
		//防止输入空
		if($.trim(usrpworg.val())==''){
			alert('原密码不能为空！');
			usrpworg.val('');usrpwnew.val('');usrpwnewag.val('');
			usrpworg.focus();
			return false;
		}
		if($.trim(usrpwnew.val())==''){
			alert('新密码不能为空！');
			usrpworg.val('');usrpwnew.val('');usrpwnewag.val('');
			usrpwnew.focus();
			return false;
		}
		if($.trim(usrpwnew.val()).length<8){
			alert('新密码不能小于8位！');
			usrpwnew.focus();
			return false;
		}
		if($.trim(usrpwnewag.val())==''){
			alert('再输一遍的新密码不能为空！');
			usrpworg.val('');usrpwnew.val('');usrpwnewag.val('');
			usrpwnewag.focus();
			return false;
		}
		if($.trim(usrpwnew.val())!=$.trim(usrpwnewag.val())){
			alert('两次密码不一致');
			usrpworg.val('');usrpwnew.val('');usrpwnewag.val('');
			usrpworg.focus();
			return false;
		}
		var prmts=$("#usr_modifypw").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					alert('原始密码输入错误');
					usrpworg.val('');usrpwnew.val('');usrpwnewag.val('');
					usrpworg.focus();
				}else if(data.status==2){
					alert('密码修改成功');//由于更新了信息需要更新下
					window.location.href=document.referrer;
				}else if(data.status==3){
					alert('修改密码失败');
					usrpworg.val('');usrpwnew.val('');usrpwnewag.val('');
					usrpworg.focus();
				}
			
			
			},
			'json'
		);
	})
	
	$("#usr_forget").click(function(){
		var usrnm=$('#usrnm');
		var usrml=$('#usrml');
		
		//防止输入空
		if($.trim(usrnm.val())==''){
			alert('用户名不能为空！');
			usrnm.focus();
			return false;
		}
		if($.trim(usrml.val())==''){
			alert('密保邮箱不能为空！');
			usrml.focus();
			return false;
		}
		var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
		if(!pttneml.test($.trim(usrml.val()))){
			alert('邮箱格式不对！');
			usrml.focus();
			return false;
		}
		var prmts=$("#usr_forget").parent().serialize();//parameters
		
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
	
	$("#usr_modifypwml").click(function(){
		var usrpwnew=$('input[name=usrpwnew]');
		var usrpwnewag=$('input[name=usrpwnewag]');
		//防止输入空
		
		if($.trim(usrpwnew.val())==''){
			alert('新密码不能为空！');
			usrpwnew.val('');usrpwnewag.val('');
			usrpwnew.focus();
			return false;
		}
		if($.trim(usrpwnew.val()).length<8){
			alert('新密码不能小于8位！');
			usrpwnew.focus();
			return false;
		}
		if($.trim(usrpwnewag.val())==''){
			alert('再输一遍的新密码不能为空！');
			usrpwnew.val('');usrpwnewag.val('');
			usrpwnewag.focus();
			return false;
		}
		if($.trim(usrpwnew.val())!=$.trim(usrpwnewag.val())){
			alert('两次密码不一致');
			usrpwnew.val('');usrpwnewag.val('');
			usrpwnew.focus();
			return false;
		}
		var prmts=$("#usr_modifypwml").parent().serialize();//parameters
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
					usrpwnew.val('');usrpwnewag.val('');
					usrpwnew.focus();
				}
			
			
			},
			'json'
		);
	})
	
	//------------------------接下来是通用部分
	$("#updt").click(function(){
		var usrnm=$('#usrnm');
		var usrnn=$('#usrnn');
		var usrpw=$('#usrpw');
		var usrpwag=$('#usrpwag');
		var usrcp=$('#usrcp');
		var usrml=$('#usrml');
		var usrintr=$('textarea[name=usrintr]');
		//防止输入空
		if($.trim(usrnm.val())==''){
			alert('用户名不能为空！');
			usrnm.focus();
			return false;
		}
		//防止输入空
		if($.trim(usrnn.val())==''){
			alert('真是姓名不能为空！');
			usrnm.focus();
			return false;
		}
		if($('#usrid').val()==0){
			if($.trim(usrpw.val())==''){
				alert('密码不能为空！');
				usrpw.focus();
				return false;
			}
		
			if($.trim(usrpw.val()).length<8){
				alert('密码不能小于8位！');
				usrpw.focus();
				return false;
			}
			if($.trim(usrpwag.val())==''){
				alert('请再次输入密码！');
				usrpwag.focus();
				return false;
			}
			if($.trim(usrpw.val())!=$.trim(usrpwag.val())){
				alert('两次输入的密码不一致');
				usrpw.val('');
				usrpwag.val('');
				usrpw.focus;
				return false;//
			}
		}
//		if($.trim(usrcp.val())==''){
//			alert('手机号码不能为空！');
//			usrcp.focus();
//			return false;
//		}
		if($.trim(usrcp.val())!=''){
			var pttnmbl=/^1[3458][0-9]{9}$/;
			if(!pttnmbl.test($.trim(usrcp.val()))){
				alert('手机号码格式不正确！');
				usrcp.focus();
				return false;
			}
		}
//		if($.trim(usrml.val())==''){
//			alert('密保邮箱不能为空！');
//			usrml.focus();
//			return false;
//		}
		if($.trim(usrml.val())!=''){
			var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
			if(!pttneml.test($.trim(usrml.val()))){
				alert('邮箱格式不对！');
				usrml.focus();
				return false;
			}
		}
		
		usrintr.val(editor.getContent());
		
		var prmts=$("#updt").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					alert('已经存在该用户名，请更换');
				}else if(data.status==2){
					alert('更新成功');
					window.location.href=document.referrer;
				}else if(data.status==3){
					alert('更新失败');
				}
			
			
			},
			'json'
		);
	})
	
});


function stvw(usrid,usrvw){
	
	$.post(
		hdlstvw,
		{usrid:usrid,usrvw:usrvw},
		function(data){
			
			if(data.status==1){
				alert('设置成功');
				window.location.reload();
			}else if(data.status==2){
				alert('设置失败');
			}
		
		
		},
		'json'
	);
	
}

function stps(usrid,usrps){
	
	$.post(
		hdlstps,
		{usrid:usrid,usrps:usrps},
		function(data){
			
			if(data.status==1){
				alert('设置成功');
				window.location.reload();
			}else if(data.status==2){
				alert('设置失败');
			}
		
		
		},
		'json'
	);
	
}	

function rstpw(usrid){
	
	$.post(
		hdlrstpw,
		{usrid:usrid},
		function(data){
			
			if(data.status==1){
				alert('重置成功');
				window.location.reload();
			}else if(data.status==2){
				alert('重置失败');
			}
		
		
		},
		'json'
	);
	
}	

function dlt(usrid){
	if(confirm("确定要删除此条记录，其其他依赖关系也要被删除？")){
		$.post(
			hdldlt,
			{usrid:usrid},
			function(data){
				
				if(data.status==1){
					alert('删除成功');
					window.location.reload();
				}else if(data.status==2){
					alert('删除失败');
				}
			
			
			},
			'json'
		);
	}
}

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