
$(function () {
	
	//纯微信类账户和普通账户的绑定
	$("#cbcnt").click(function(){
		var cstmusrnm=$('input[name=cstmusrnm]');
		var cstmusrpw=$('input[name=cstmusrpw]');
		
		
		
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
		
		var prmts=$("#cbcnt").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
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
					alert('绑定成功！')
					window.location=app_path;
				}else if(data.status==4){
					$('#errCtn').html("<div class='alert alert-warning alert-dismissible'>" +
							"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
							"<strong>对不起，你的帐号被冻结，请联系管理员</strong>" +
							"</div>");
				}else if(data.status==4){
					$('#errCtn').html("<div class='alert alert-warning alert-dismissible'>" +
							"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
							"<strong>对不起，该用户已经被绑定，请联系管理员</strong>" +
							"</div>");
				}
			
			
			},
			'json'
		);
		
		
	})
	
	
	
	$("#cstmusr_regist").click(function(){
		var cstmusrnm=$('#cstmusrnm');
		var cstmusrnn=$('#cstmusrnn');
		var cstmusrpw=$('#cstmusrpw');
		
		var cstmusrcp=$('#cstmusrcp');
		var cstmusrml=$('#cstmusrml');
		
		if($.trim(cstmusrnn.val())==''){
			alert('真实姓名不能为空！');
			cstmusrnn.focus();
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
	
//		if($.trim(cstmusrml.val())==''){
//			alert('密保邮箱不能为空！');
//			cstmusrml.focus();
//			return false;
//		}
//		var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
//		if(!pttneml.test($.trim(cstmusrml.val()))){
//			alert('邮箱格式不对！');
//			cstmusrml.focus();
//			return false;
//		}
		
		
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
					alert('完善成功，您可以使用所有功能');
					window.location=root_index;
				}else if(data.status==3){
					alert('完善失败');
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