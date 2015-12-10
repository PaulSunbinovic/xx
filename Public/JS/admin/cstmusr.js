
$(function () {
	
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
		if($('#cstmusrid').val()==0){
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

function rstpw(cstmusrid){
	
	$.post(
		hdlrstpw,
		{cstmusrid:cstmusrid},
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