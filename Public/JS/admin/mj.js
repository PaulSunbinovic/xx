
$(function () {
	
	
	
	
	
	
	//------------------------接下来是通用部分
	$("#updt").click(function(){
		
		var f_mj_bxxsid=$('select[name=f_mj_bxxsid]');
		var f_mj_ccid=$('select[name=f_mj_ccid]');
		var f_mj_klid=$('select[name=f_mj_klid]');
		var f_mj_xxxsid=$('select[name=f_mj_xxxsid]');
		var f_mj_zsfwid=$('select[name=f_mj_zsfwid]');
		var f_mj_xzid=$('select[name=f_mj_xzid]');
		var mjdm=$('input[name=mjdm]');
		var mjnm=$('input[name=mjnm]');
		var mjdsc=$('textarea[name=mjdsc]')

		//
		if(f_mj_bxxsid.val()==0){
			alert('请选择办学形式！');
			return false;
		}
		if(f_mj_ccid.val()==0){
			alert('请选择层次！');
			return false;
		}
		if(f_mj_klid.val()==0){
			alert('请选择科类！');
			return false;
		}
		if(f_mj_xxxsid.val()==0){
			alert('请选择学习形式！');
			return false;
		}
		if(f_mj_zsfwid.val()==0){
			alert('请选择招生范围！');
			return false;
		}
		if(f_mj_xzid.val()==0){ 
			alert('请选择学制！');
			return false;
		}
		if($.trim(mjdm.val())==''){
			alert('专业代码不能为空！');
			return false;
		}
		if($.trim(mjnm.val())==''){
			alert('专业名不能为空！');
			return false;
		}
		

		mjdsc.val(editor.getContent());
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
	
	$("#addstt").click(function(){
		var sttnw=$('#sttnw');
		var sttidnw=sttnw.val().split('-')[0];
		var sttnmnw=sttnw.val().split('-')[1];
		var mjsttu=$('input[name=mjsttu]');
		var mdlx=$('#mdlx');
		var mjsttuset=$('#mjsttuset');
		if(mjsttu.val().indexOf('-'+sttidnw+'-')!=-1){
			alert('开设站点已经有此站点了');return false;
		}else{
			mjsttu.val(mjsttu.val()+sttidnw+'-');
			mdlx.trigger('click');
			mjsttuset.append("<div class='alert alert-warning alert-dismissible col-md-6' role='alert' id='myAlert_"+sttidnw+"'><button type='button' class='close' aria-label='Close' id='cls_"+sttidnw+"' onclick='gbmjsttu("+sttidnw+")'><span aria-hidden='true'>×</span></button>"+sttnmnw+"</div>");
		}
	})
	
});

function dlt(mjid,grdid){
	if(confirm("确定要删除此条记录？")){
		$.post(
			hdldlt,
			{mjid:mjid,grdid,grdid},
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
function gbmjsttu(sttid){
	$('#myAlert_'+sttid).alert('close');
	var mjsttu=$('input[name=mjsttu]');
	var set=mjsttu.val().split("-"+sttid+"-");
	mjsttu.val(set[0]+'-'+set[1]);
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