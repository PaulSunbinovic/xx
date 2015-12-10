
$(function () {
	
	
	
	
	
	
	//------------------------接下来是通用部分
	$("#updt").click(function(){
		
		var f_grprl_grpid=$('select[name=f_grprl_grpid]');
		var f_grprl_rlid=$('select[name=f_grprl_rlid]');
//		//先去disabled
//		f_grprl_usrid.removeAttr('disabled');
//		f_grprl_rlid.removeAttr('disabled');
		
		//
		if(f_grprl_grpid.val()==0){
			alert('请选择团队！');
			return false;
		}
		if(f_grprl_rlid.val()==0){
			alert('请选择角色！');
			return false;
		}
		
		var prmts=$("#updt").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		
		prmts=rmvblk(prmts);
		
		
		$.post(
			hdlurl,
			prmts,
			function(data){
//				//归还disabled
//				f_grprl_usrid.attr('disabled','disabled');
//				f_grprl_rlid.attr('disabled','disabled');
				
				if(data.status==1){
					alert('更新成功');
					window.location.href=document.referrer;
				}else if(data.status==2){
					alert('更新失败');
				}else if(data.status==3){
					alert('已有此关系');
				}
			
			
			},
			'json'
		);
	})
	
});

function dlt(grprlid){
	if(confirm("确定要删除此条记录？")){
		$.post(
			hdldlt,
			{grprlid:grprlid},
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

function   superTrim(str,ch) {  
	if(str.length>0 && str.indexOf(ch)!=-1){ //it is a string and have ch
	while(str.substring(0,1)==ch)  
			  str  =  str.substring(1,str.length);  
	while(str.substring(str.length-1,str.length)==ch)  
		str   =   str.substring(0,str.length-1);  
   }
   return   str;  
 }