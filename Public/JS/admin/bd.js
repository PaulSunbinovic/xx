
$(function () {

	//------------------------接下来是通用部分
	$("#updt").click(function(){
		var bdnm=$('#bdnm');
		
		
		//防止输入空
		if($.trim(bdnm.val())==''){
			alert('板块名不能为空！');
			bdnm.focus();
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
function mvhr(pid,pos){
	if(confirm('确定移至此位，其子嗣节点也会相应移位')){
		var mvid=$('input[name=mvid]');
		var id=mvid.val();
		$.post(
			hdlmv,
			{pid:pid,pos:pos,id:id},
			function(data){
				
				if(data.status==1){
					alert('转移成功');
					window.location.reload();
				}
			},
			'json'
		);
	}

}
function dlt(bdid){
	if(confirm("确定要删除此节点，其子嗣节点也会相应删除？")){
		$.post(
			hdldlt,
			{bdid:bdid},
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