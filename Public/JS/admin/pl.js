
$(function () {
	
	
	
	var f_stdxqcls_clsid=$('select[name=f_stdxqcls_clsid]');
	var f_std_sttid=$('select[name=f_std_sttid]');
	var f_std_grdid=$('select[name=f_std_grdid]');
	var f_stdxqcls_xqid=$('select[name=f_stdxqcls_xqid]');
	var f_stdxqmj_xqid=$('select[name=f_stdxqmj_xqid]');
	
	
	
	
	f_std_grdid.change(function(){
		jsn={f_std_sttid:f_std_sttid.val(),f_std_grdid:f_std_grdid.val(),f_stdxqcls_xqid:f_stdxqcls_xqid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqcls_clsid.html(data.clsoptu);
					f_stdxqcls_xqid.html(data.xqoptu);
					f_stdxqmj_xqid.html(data.xqoptu);
					
				}
			},
			'json'
		);
	});
	f_std_sttid.change(function(){
		jsn={f_std_sttid:f_std_sttid.val(),f_std_grdid:f_std_grdid.val(),f_stdxqcls_xqid:f_stdxqcls_xqid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqcls_clsid.html(data.clsoptu);
					f_stdxqcls_xqid.html(data.xqoptu);
					f_stdxqmj_xqid.html(data.xqoptu);
				}
			},
			'json'
		);
	});
	f_stdxqcls_xqid.change(function(){
		f_stdxqmj_xqid.val(f_stdxqcls_xqid.val());
		
	});
	
	
$("#updt").click(function(){
		
		
		//var plctt=$('textarea[name=plctt]')

		

		//plctt.val(editor.getContent());
		var prmts=$("#updt").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		//prmts=rmvblk(prmts);
		

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
function dlt(stdid,grdid){
	if(confirm("确定要删除此条记录？")){
		$.post(
			hdldlt,
			{stdid:stdid,grdid:grdid},
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

function rstpw(stdid,grdid){
	
	$.post(
		hdlrstpw,
		{stdid:stdid,grdid:grdid},
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