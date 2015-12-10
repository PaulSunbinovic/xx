
$(function () {
	
	
	
	
	
	
	
	
	
	
	//------------------------接下来是通用部分
	$("#updt").click(function(){
		var jqqs=$('#jqqs');
		var jqjs=$('#jqjs');
		var jqljc=$('#jqljc');
		
		//防止输入空
		if($.trim(jqqs.val())==''){
			alert('起始时间不能为空！');
			tcrnm.focus();
			return false;
		}
		//防止输入空
		if($.trim(jqjs.val())==''){
			alert('结束时间不能为空！');
			tcrnm.focus();
			return false;
		}//防止输入空
		if($.trim(jqljc.val())==''){
			alert('领教材时间不能为空！');
			tcrnm.focus();
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
					alert('更新成功');
					window.location.href=document.referrer;
				}else if(data.status==2){
					alert('更新失败');
				}
			
			
			},
			'json'
		);
	})
	
});


function stps(tcrid,tcrps){
	
	$.post(
		hdlstps,
		{tcrid:tcrid,tcrps:tcrps},
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

function rstpw(tcrid){
	
	$.post(
		hdlrstpw,
		{tcrid:tcrid},
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

function dlt(tcrid){
	if(confirm("确定要删除此条记录，其其他依赖关系也要被删除？")){
		$.post(
			hdldlt,
			{tcrid:tcrid},
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