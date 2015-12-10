
$(function () {
	
	var f_kczy_grdid=$('select[name=f_kczy_grdid]');
	var f_kczy_kcid=$('select[name=f_kczy_kcid]');
	var f_kczy_zyid=$('select[name=f_kczy_zyid]');
	
	f_kczy_grdid.change(function(){
		jsn={f_kczy_grdid:f_kczy_grdid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_kczy_kcid.html(data.kcoptu);
					f_kczy_zyid.html(data.zyoptu);
				}
			},
			'json'
		);
	});
	
	
	//------------------------接下来是通用部分
	$("#updt").click(function(){
		
		
		var f_kczy_grdid=$('select[name=f_kczy_grdid]');
		var f_kczy_kcid=$('select[name=f_kczy_kcid]');
		var f_kczy_zyid=$('select[name=f_kczy_zyid]');
		

		//
		if(f_kczy_grdid.val()==0){
			alert('请选择年级！');
			return false;
		}
		if(f_kczy_kcid.val()==0||$.trim(f_kczy_kcid.val())==''){
			alert('请选择课程！');
			return false;
		}
		if(f_kczy_zyid.val()==0||$.trim(f_kczy_zyid.val())==''){
			alert('请选择专业！');
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

function dlt(kczyid,grdid){
	if(confirm("确定要删除此条记录？")){
		$.post(
			hdldlt,
			{kczyid:kczyid,grdid,grdid},
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