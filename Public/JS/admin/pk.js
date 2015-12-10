
$(function () {
	
	
	var pkid=$('input[name=pkid]');
	
	var f_pk_sttid=$('select[name=f_pk_sttid]');
	var f_pk_grdid=$('select[name=f_pk_grdid]');
	var f_pk_xqid=$('select[name=f_pk_xqid]');
	var f_pk_kcid=$('select[name=f_pk_kcid]');
	var f_pk_tcrid=$('select[name=f_pk_tcrid]');
	
	
	f_pk_grdid.change(function(){
		jsn={f_pk_sttid:f_pk_sttid.val(),f_pk_grdid:f_pk_grdid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_pk_tcrid.html(data.tcroptu);
					f_pk_kcid.html(data.kcoptu);
					f_pk_xqid.html(data.xqoptu);
					
				}
			},
			'json'
		);
	});
	f_pk_sttid.change(function(){
		jsn={f_pk_sttid:f_pk_sttid.val(),f_pk_grdid:f_pk_grdid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_pk_tcrid.html(data.tcroptu);
					f_pk_kcid.html(data.kcoptu);
					f_pk_xqid.html(data.xqoptu);
					
				}
			},
			'json'
		);
	});
	
//	
	//------------------------接下来是通用部分
	$("#updt").click(function(){
			
		

		var f_pk_tcrid=$('select[name=f_pk_tcrid]');
		var f_pk_kcid=$('select[name=f_pk_kcid]');
		var pkwqm=$('input[name=pkwqm]');
		var pkwps=$('input[name=pkwps]');
		var pkwxt=$('input[name=pkwxt]');
		
		
		

		//防止输入空
		
		if(f_pk_kcid.val()==0||f_pk_kcid.val()==''){
			alert('请选择课程');
			return false;
		}
		if(f_pk_tcrid.val()==0||f_pk_tcrid.val()==''){
			alert('请选择教师');
			return false;
		}
		
		if($.trim(pkwqm.val())==''){
			alert('期末成绩权重不能为空！');
			return false;
		}
		if($.trim(pkwps.val())==''){
			alert('平时成绩权重不能为空！');
			return false;
		}
		if($.trim(pkwxt.val())==''){
			alert('习题成绩权重不能为空！');
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
//
function dlt(pkid,grdid){
	if(confirm("确定要删除此条记录？")){
		$.post(
			hdldlt,
			{pkid:pkid,grdid:grdid},
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

function rstpw(pkid,grdid){
	
	$.post(
		hdlrstpw,
		{pkid:pkid,grdid:grdid},
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