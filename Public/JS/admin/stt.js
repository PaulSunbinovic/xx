
$(function () {
	
	
	
	
	
	
	//------------------------接下来是通用部分
	$("#updt").click(function(){
		
		var sttnm=$('input[name=sttnm]');
		var sttcprt=$('input[name=sttcprt]');
		var sttads=$('input[name=sttads]');
		var sttrspnm=$('input[name=sttrspnm]');
		var sttrsptlp=$('input[name=sttrsptlp]');
		var sttrspcp=$('input[name=sttrspcp]');
		var sttdsc=$('textarea[name=sttdsc]')

		//
		
		if($.trim(sttnm.val())==''){
			alert('站点名不能为空！');
			return false;
		}
		if($.trim(sttcprt.val())==''){
			alert('站点单位不能为空！');
			return false;
		}
		if($.trim(sttrspnm.val())==''){
			alert('站点负责人姓名不能为空！');
			return false;
		}
		if($.trim(sttrsptlp.val())==''){
			alert('站点负责人固话不能为空！');
			return false;
		}
		if($.trim(sttrspcp.val())==''){
			alert('站点负责人手机号不能为空！');
			return false;
		}
		var pttnmbl=/^1[3458][0-9]{9}$/;
		if(!pttnmbl.test($.trim(sttrspcp.val()))){
			alert('手机号码格式不正确！');
			sttrspcp.focus();
			return false;
		}

		sttdsc.val(editor.getContent());
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

function dlt(sttid){
	if(confirm("确定要删除此条记录？")){
		$.post(
			hdldlt,
			{sttid:sttid},
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