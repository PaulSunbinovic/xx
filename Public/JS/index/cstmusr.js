
$(function () {
	
	
	$("#cstmusr_logininIdx").click(function(){
		var cstmusrnm=$('input[name=cstmusrnm]');
		var cstmusrpw=$('input[name=cstmusrpw]');
		
		var rmb=$('#rmb');
		if(rmb.is(":checked")==true){
			$('input[name=rmb]').val('y');
		}else{
			$('input[name=rmb]').val('n');
		}
		
		//防止输入空
		if($.trim(cstmusrnm.val())==''){
			alert('客户用户名不能为空！');
			cstmusrnm.focus();
			return false;
		}
		if($.trim(cstmusrpw.val())==''){
			alert('密码不能为空！');
			cstmusrpw.focus();
			return false;
		}
		
		var prmts=$("#cstmusr_logininIdx").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdllgin,
			prmts,
			function(data){
				
				if(data.status==1){
					$('#errCtn').html("<div class='alert alert-warning alert-dismissible'>" +
							"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
							"<strong>客户用户名不正确</strong>" +
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
	})
	
	
	
	
	
	$("#cstmusr_regist").click(function(){
		var cstmusrnm=$('#cstmusrnm');
		var cstmusrnn=$('#cstmusrnn');
		var cstmusrpw=$('#cstmusrpw');
		var cstmusrpwag=$('#cstmusrpwag');
		var cstmusrcp=$('#cstmusrcp');
		var cstmusrml=$('#cstmusrml');
		//防止输入空
		if($.trim(cstmusrnm.val())==''){
			alert('客户用户名不能为空！');
			cstmusrnm.focus();
			return false;
		}
		//alert(checkifenglish($.trim(cstmusrnm.val()));
		if(checkifenglish($.trim(cstmusrnm.val()))==false){
			alert('客户用户名不能使用英文字母以及_@以外的文字');
			cstmusrnm.focus();
			return false;
		}
		if($.trim(cstmusrnn.val())==''){
			alert('真实姓名不能为空！');
			cstmusrnn.focus();
			return false;
		}
		if($.trim(cstmusrpw.val())==''){
			alert('密码不能为空！');
			cstmusrpw.focus();
			return false;
		}
		if($.trim(cstmusrpw.val()).length<8){
			alert('密码不能小于8位！');
			cstmusrpw.focus();
			return false;
		}
		if($.trim(cstmusrpwag.val())==''){
			alert('请再次输入密码！');
			cstmusrpwag.focus();
			return false;
		}
		if($.trim(cstmusrpw.val())!=$.trim(cstmusrpwag.val())){
			alert('两次输入的密码不一致');
			cstmusrpw.val('');
			cstmusrpwag.val('');
			cstmusrpw.focus;
			return false;//
			
		}
		if($.trim(cstmusrcp.val())==''){
			alert('手机号码不能为空！');
			cstmusrcp.focus();
			return false;
		}
		var pttnmbl=/^1[3458][0-9]{9}$/;
		if(!pttnmbl.test($.trim(cstmusrcp.val()))){
			alert('手机号码格式不正确！');
			cstmusrcp.focus();
			return false;
		}
	
		if($.trim(cstmusrml.val())==''){
			alert('密保邮箱不能为空！');
			cstmusrml.focus();
			return false;
		}
		var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
		if(!pttneml.test($.trim(cstmusrml.val()))){
			alert('邮箱格式不对！');
			cstmusrml.focus();
			return false;
		}
		
		
		var prmts=$("#cstmusr_regist").parent().parent().parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					$('#errCtn').html("<div class='alert alert-warning alert-dismissible'>" +
							"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
							"<strong>已存在该客户用户名，请更换</strong>" +
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
	
	
	$("#cstmusr_modify").click(function(){
		var cstmusrnn=$('#cstmusrnn');
		var cstmusrcp=$('#cstmusrcp');
		var cstmusrml=$('#cstmusrml');
		
		//防止输入空
		if($.trim(cstmusrnn.val())==''){
			alert('真是姓名不能为空！');
			cstmusrnm.focus();
			return false;
		}
		if($.trim(cstmusrcp.val())==''){
			alert('手机号码不能为空！');
			cstmusrcp.focus();
			return false;
		}
		var pttnmbl=/^1[3458][0-9]{9}$/;
		if(!pttnmbl.test($.trim(cstmusrcp.val()))){
			alert('手机号码格式不正确！');
			cstmusrcp.focus();
			return false;
		}
	
		if($.trim(cstmusrml.val())==''){
			alert('密保邮箱不能为空！');
			cstmusrml.focus();
			return false;
		}
		var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
		if(!pttneml.test($.trim(cstmusrml.val()))){
			alert('邮箱格式不对！');
			cstmusrml.focus();
			return false;
		}
		
		
		var prmts=$("#cstmusr_modify").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					alert('已经存在该客户用户名，请更换');
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
	
	$("#cstmusr_modifypw").click(function(){
		var cstmusrpworg=$('input[name=cstmusrpworg]');
		var cstmusrpwnew=$('input[name=cstmusrpwnew]');
		var cstmusrpwnewag=$('input[name=cstmusrpwnewag]');
		//防止输入空
		if($.trim(cstmusrpworg.val())==''){
			alert('原密码不能为空！');
			cstmusrpworg.val('');cstmusrpwnew.val('');cstmusrpwnewag.val('');
			cstmusrpworg.focus();
			return false;
		}
		if($.trim(cstmusrpwnew.val())==''){
			alert('新密码不能为空！');
			cstmusrpworg.val('');cstmusrpwnew.val('');cstmusrpwnewag.val('');
			cstmusrpwnew.focus();
			return false;
		}
		if($.trim(cstmusrpwnew.val()).length<8){
			alert('新密码不能小于8位！');
			cstmusrpwnew.focus();
			return false;
		}
		if($.trim(cstmusrpwnewag.val())==''){
			alert('再输一遍的新密码不能为空！');
			cstmusrpworg.val('');cstmusrpwnew.val('');cstmusrpwnewag.val('');
			cstmusrpwnewag.focus();
			return false;
		}
		if($.trim(cstmusrpwnew.val())!=$.trim(cstmusrpwnewag.val())){
			alert('两次密码不一致');
			cstmusrpworg.val('');cstmusrpwnew.val('');cstmusrpwnewag.val('');
			cstmusrpworg.focus();
			return false;
		}
		var prmts=$("#cstmusr_modifypw").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					alert('原始密码输入错误');
					cstmusrpworg.val('');cstmusrpwnew.val('');cstmusrpwnewag.val('');
					cstmusrpworg.focus();
				}else if(data.status==2){
					alert('密码修改成功');//由于更新了信息需要更新下
					window.location.href=document.referrer;
				}else if(data.status==3){
					alert('修改密码失败');
					cstmusrpworg.val('');cstmusrpwnew.val('');cstmusrpwnewag.val('');
					cstmusrpworg.focus();
				}
			
			
			},
			'json'
		);
	})
	
	$("#cstmusr_forget").click(function(){
		var cstmusrnm=$('#cstmusrnm');
		var cstmusrml=$('#cstmusrml');
		
		//防止输入空
		if($.trim(cstmusrnm.val())==''){
			alert('客户用户名不能为空！');
			cstmusrnm.focus();
			return false;
		}
		if($.trim(cstmusrml.val())==''){
			alert('密保邮箱不能为空！');
			cstmusrml.focus();
			return false;
		}
		var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
		if(!pttneml.test($.trim(cstmusrml.val()))){
			alert('邮箱格式不对！');
			cstmusrml.focus();
			return false;
		}
		var prmts=$("#cstmusr_forget").parent().serialize();//parameters
		
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
					alert('无此客户用户');
					
				}else if(data.status==4){
					alert('此客户用户名下的邮箱不正确');
				}
			
			
			},
			'json'
		);
	})
	
	$("#cstmusr_modifypwml").click(function(){
		var cstmusrpwnew=$('input[name=cstmusrpwnew]');
		var cstmusrpwnewag=$('input[name=cstmusrpwnewag]');
		//防止输入空
		
		if($.trim(cstmusrpwnew.val())==''){
			alert('新密码不能为空！');
			cstmusrpwnew.val('');cstmusrpwnewag.val('');
			cstmusrpwnew.focus();
			return false;
		}
		if($.trim(cstmusrpwnew.val()).length<8){
			alert('新密码不能小于8位！');
			cstmusrpwnew.focus();
			return false;
		}
		if($.trim(cstmusrpwnewag.val())==''){
			alert('再输一遍的新密码不能为空！');
			cstmusrpwnew.val('');cstmusrpwnewag.val('');
			cstmusrpwnewag.focus();
			return false;
		}
		if($.trim(cstmusrpwnew.val())!=$.trim(cstmusrpwnewag.val())){
			alert('两次密码不一致');
			cstmusrpwnew.val('');cstmusrpwnewag.val('');
			cstmusrpwnew.focus();
			return false;
		}
		var prmts=$("#cstmusr_modifypwml").parent().serialize();//parameters
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
					cstmusrpwnew.val('');cstmusrpwnewag.val('');
					cstmusrpwnew.focus();
				}
			
			
			},
			'json'
		);
	})
	
	//------------------------接下来是通用部分
	$("#updt").click(function(){
		var cstmusrnm=$('#cstmusrnm');
		var cstmusrnn=$('#cstmusrnn');
		var cstmusrpw=$('#cstmusrpw');
		var cstmusrpwag=$('#cstmusrpwag');
		var cstmusrcp=$('#cstmusrcp');
		var cstmusrml=$('#cstmusrml');
		
		//防止输入空
		if($.trim(cstmusrnm.val())==''){
			alert('客户用户名不能为空！');
			cstmusrnm.focus();
			return false;
		}
		//防止输入空
		if($.trim(cstmusrnn.val())==''){
			alert('真是姓名不能为空！');
			cstmusrnm.focus();
			return false;
		}
		if($.trim(cstmusrpw.val())==''){
			alert('密码不能为空！');
			cstmusrpw.focus();
			return false;
		}
		if($.trim(cstmusrpw.val()).length<8){
			alert('密码不能小于8位！');
			cstmusrpw.focus();
			return false;
		}
		if($.trim(cstmusrpwag.val())==''){
			alert('请再次输入密码！');
			cstmusrpwag.focus();
			return false;
		}
		if($.trim(cstmusrpw.val())!=$.trim(cstmusrpwag.val())){
			alert('两次输入的密码不一致');
			cstmusrpw.val('');
			cstmusrpwag.val('');
			cstmusrpw.focus;
			return false;//
		}
		if($.trim(cstmusrcp.val())==''){
			alert('手机号码不能为空！');
			cstmusrcp.focus();
			return false;
		}
		var pttnmbl=/^1[3458][0-9]{9}$/;
		if(!pttnmbl.test($.trim(cstmusrcp.val()))){
			alert('手机号码格式不正确！');
			cstmusrcp.focus();
			return false;
		}
	
		if($.trim(cstmusrml.val())==''){
			alert('密保邮箱不能为空！');
			cstmusrml.focus();
			return false;
		}
		var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
		if(!pttneml.test($.trim(cstmusrml.val()))){
			alert('邮箱格式不对！');
			cstmusrml.focus();
			return false;
		}
		
		var prmts=$("#updt").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					alert('已经存在该客户用户名，请更换');
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


function stvw(cstmusrid,cstmusrvw){
	
	$.post(
		hdlstvw,
		{cstmusrid:cstmusrid,cstmusrvw:cstmusrvw},
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

function stps(cstmusrid,cstmusrps){
	
	$.post(
		hdlstps,
		{cstmusrid:cstmusrid,cstmusrps:cstmusrps},
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



function dlt(cstmusrid){
	if(confirm("确定要删除此条记录，其其他依赖关系也要被删除？")){
		$.post(
			hdldlt,
			{cstmusrid:cstmusrid},
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