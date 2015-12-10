
$(function () {
	
	var f_cls_grdid=$('select[name=f_cls_grdid]');
	var f_cls_sttid=$('select[name=f_cls_sttid]');
	
	f_cls_grdid.change(function(){
		
		$.post(
			hdlcreateAlways,
			{f_cls_grdid:f_cls_grdid.val(),f_cls_sttid:f_cls_sttid.val()},
			function(data){
				$('#xqnw').html(data.str);
		
			},
			'json'
		);
	})
	
	
	
	//------------------------接下来是通用部分
	$("#updt").click(function(){
		
		var f_cls_sttid=$('select[name=f_cls_sttid]');
		var f_cls_grdid=$('select[name=f_cls_grdid]');
		
		
		//
		if(f_cls_sttid.val()==0){
			alert('请选择站点！');
			return false;
		}
		if(f_cls_grdid.val()==0){
			alert('请选择年级！');
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
	
	$("#addxq").click(function(){
		var xqnw=$('#xqnw');
		var xqidnw=xqnw.val().split('_')[0];
		var xqnmnw=xqnw.val().split('_')[1];
		var clsxqu=$('input[name=clsxqu]');
		var mdlx=$('#mdlx');
		var clsxquset=$('#clsxquset');
		if(clsxqu.val().indexOf('-'+xqidnw+'-')!=-1){
			alert('有效学期已经有该学期了');return false;
		}else{
			clsxqu.val(clsxqu.val()+xqidnw+'-');
			mdlx.trigger('click');
			clsxquset.append("<div class='alert alert-warning alert-dismissible col-md-6' role='alert' id='myAlert_"+xqidnw+"'><button type='button' class='close' aria-label='Close' id='cls_"+xqidnw+"' onclick='gbclsxqu("+xqidnw+")'><span aria-hidden='true'>×</span></button>"+xqnmnw+"</div>");
		}
	})
	
});

function dlt(clsid,grdid){
	if(confirm("确定要删除此条记录？")){
		$.post(
			hdldlt,
			{clsid:clsid,grdid:grdid},
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

function gbclsxqu(xqid){
	$('#myAlert_'+xqid).alert('close');
	var clsxqu=$('input[name=clsxqu]');
	var set=clsxqu.val().split("-"+xqid+"-");
	clsxqu.val(set[0]+'-'+set[1]);
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