
$(function () {
	
	
	$("#tcr_logininIdx").click(function(){
		var tcrnm=$('input[name=tcrnm]');
		var tcrpw=$('input[name=tcrpw]');
		
		var rmb=$('#rmb');
		if(rmb.is(":checked")==true){
			$('input[name=rmb]').val('y');
		}else{
			$('input[name=rmb]').val('n');
		}
		
		//防止输入空
		if($.trim(tcrnm.val())==''){
			alert('用户名不能为空！');
			tcrnm.focus();
			return false;
		}
		if($.trim(tcrpw.val())==''){
			alert('密码不能为空！');
			tcrpw.focus();
			return false;
		}
		
		var prmts=$("#tcr_logininIdx").parent().serialize();//parameters
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
	
	
		
	
	$("#tcr_regist").click(function(){
		var tcrnm=$('#tcrnm');
		var tcrnn=$('#tcrnn');
		var tcrpw=$('#tcrpw');
		var tcrpwag=$('#tcrpwag');
		var tcrcp=$('#tcrcp');
		var tcrml=$('#tcrml');
		var tcrintr=$('textarea[name=tcrintr]');
		//防止输入空
		if($.trim(tcrnm.val())==''){
			alert('用户名不能为空！');
			tcrnm.focus();
			return false;
		}
		//alert(checkifenglish($.trim(tcrnm.val()));
		if(checkifenglish($.trim(tcrnm.val()))==false){
			alert('用户名不能使用英文字母以及_@以外的文字');
			tcrnm.focus();
			return false;
		}
		if($.trim(tcrnn.val())==''){
			alert('真实姓名不能为空！');
			tcrnn.focus();
			return false;
		}
		if($.trim(tcrpw.val())==''){
			alert('密码不能为空！');
			tcrpw.focus();
			return false;
		}
		if($.trim(tcrpw.val()).length<8){
			alert('密码不能小于8位！');
			tcrpw.focus();
			return false;
		}
		if($.trim(tcrpwag.val())==''){
			alert('请再次输入密码！');
			tcrpwag.focus();
			return false;
		}
		if($.trim(tcrpw.val())!=$.trim(tcrpwag.val())){
			alert('两次输入的密码不一致');
			tcrpw.val('');
			tcrpwag.val('');
			tcrpw.focus;
			return false;//
			
		}
//		if($.trim(tcrcp.val())==''){
//			alert('手机号码不能为空！');
//			tcrcp.focus();
//			return false;
//		}
		if($.trim(tcrcp.val())!=''){
			var pttnmbl=/^1[3458][0-9]{9}$/;
			if(!pttnmbl.test($.trim(tcrcp.val()))){
				alert('手机号码格式不正确！');
				tcrcp.focus();
				return false;
			}
		}
//		if($.trim(tcrml.val())==''){
//			alert('密保邮箱不能为空！');
//			tcrml.focus();
//			return false;
//		}
		if($.trim(tcrml.val())!=''){
			var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
			if(!pttneml.test($.trim(tcrml.val()))){
				alert('邮箱格式不对！');
				tcrml.focus();
				return false;
			}
		}
		
		tcrintr.val(editor.getContent());
		
		var prmts=$("#tcr_regist").parent().parent().parent().serialize();//parameters
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
	
	
	$("#tcr_modify").click(function(){
		var tcrnn=$('#tcrnn');
		var tcrcp=$('#tcrcp');
		var tcrml=$('#tcrml');
		var tcrintr=$('textarea[name=tcrintr]');
		//防止输入空
		if($.trim(tcrnn.val())==''){
			alert('真是姓名不能为空！');
			tcrnm.focus();
			return false;
		}
//		if($.trim(tcrcp.val())==''){
//			alert('手机号码不能为空！');
//			tcrcp.focus();
//			return false;
//		}
		if($.trim(tcrcp.val())!=''){
			var pttnmbl=/^1[3458][0-9]{9}$/;
			if(!pttnmbl.test($.trim(tcrcp.val()))){
				alert('手机号码格式不正确！');
				tcrcp.focus();
				return false;
			}
		}
//		if($.trim(tcrml.val())==''){
//			alert('密保邮箱不能为空！');
//			tcrml.focus();
//			return false;
//		}
		if($.trim(tcrml.val())!=''){
			var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
			if(!pttneml.test($.trim(tcrml.val()))){
				alert('邮箱格式不对！');
				tcrml.focus();
				return false;
			}
		}
		tcrintr.val(editor.getContent());
		var prmts=$("#tcr_modify").parent().serialize();//parameters
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
	
	$("#tcr_modifypw").click(function(){
		var tcrpworg=$('input[name=tcrpworg]');
		var tcrpwnew=$('input[name=tcrpwnew]');
		var tcrpwnewag=$('input[name=tcrpwnewag]');
		//防止输入空
		if($.trim(tcrpworg.val())==''){
			alert('原密码不能为空！');
			tcrpworg.val('');tcrpwnew.val('');tcrpwnewag.val('');
			tcrpworg.focus();
			return false;
		}
		if($.trim(tcrpwnew.val())==''){
			alert('新密码不能为空！');
			tcrpworg.val('');tcrpwnew.val('');tcrpwnewag.val('');
			tcrpwnew.focus();
			return false;
		}
		if($.trim(tcrpwnew.val()).length<8){
			alert('新密码不能小于8位！');
			tcrpwnew.focus();
			return false;
		}
		if($.trim(tcrpwnewag.val())==''){
			alert('再输一遍的新密码不能为空！');
			tcrpworg.val('');tcrpwnew.val('');tcrpwnewag.val('');
			tcrpwnewag.focus();
			return false;
		}
		if($.trim(tcrpwnew.val())!=$.trim(tcrpwnewag.val())){
			alert('两次密码不一致');
			tcrpworg.val('');tcrpwnew.val('');tcrpwnewag.val('');
			tcrpworg.focus();
			return false;
		}
		var prmts=$("#tcr_modifypw").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					alert('原始密码输入错误');
					tcrpworg.val('');tcrpwnew.val('');tcrpwnewag.val('');
					tcrpworg.focus();
				}else if(data.status==2){
					alert('密码修改成功');//由于更新了信息需要更新下
					window.location.href=document.referrer;
				}else if(data.status==3){
					alert('修改密码失败');
					tcrpworg.val('');tcrpwnew.val('');tcrpwnewag.val('');
					tcrpworg.focus();
				}
			
			
			},
			'json'
		);
	})
	
	$("#tcr_forget").click(function(){
		var tcrnm=$('#tcrnm');
		var tcrml=$('#tcrml');
		
		//防止输入空
		if($.trim(tcrnm.val())==''){
			alert('用户名不能为空！');
			tcrnm.focus();
			return false;
		}
		if($.trim(tcrml.val())==''){
			alert('密保邮箱不能为空！');
			tcrml.focus();
			return false;
		}
		var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
		if(!pttneml.test($.trim(tcrml.val()))){
			alert('邮箱格式不对！');
			tcrml.focus();
			return false;
		}
		var prmts=$("#tcr_forget").parent().serialize();//parameters
		
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
	
	$("#tcr_modifypwml").click(function(){
		var tcrpwnew=$('input[name=tcrpwnew]');
		var tcrpwnewag=$('input[name=tcrpwnewag]');
		//防止输入空
		
		if($.trim(tcrpwnew.val())==''){
			alert('新密码不能为空！');
			tcrpwnew.val('');tcrpwnewag.val('');
			tcrpwnew.focus();
			return false;
		}
		if($.trim(tcrpwnew.val()).length<8){
			alert('新密码不能小于8位！');
			tcrpwnew.focus();
			return false;
		}
		if($.trim(tcrpwnewag.val())==''){
			alert('再输一遍的新密码不能为空！');
			tcrpwnew.val('');tcrpwnewag.val('');
			tcrpwnewag.focus();
			return false;
		}
		if($.trim(tcrpwnew.val())!=$.trim(tcrpwnewag.val())){
			alert('两次密码不一致');
			tcrpwnew.val('');tcrpwnewag.val('');
			tcrpwnew.focus();
			return false;
		}
		var prmts=$("#tcr_modifypwml").parent().serialize();//parameters
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
					tcrpwnew.val('');tcrpwnewag.val('');
					tcrpwnew.focus();
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