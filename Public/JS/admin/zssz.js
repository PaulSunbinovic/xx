
$(function () {
	
	
	
	
	
	
	//------------------------接下来是通用部分
	$("#updt").click(function(){
		
		
		
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
	
	$("#addbxxs").click(function(){
		var bxxsnw=$('#bxxsnw');
		var bxxsidnw=bxxsnw.val().split('-')[0];
		var bxxsnmnw=bxxsnw.val().split('-')[1];
		var zsszbxxsu=$('input[name=zsszbxxsu]');
		var mdlx=$('#mdlx');
		var zsszbxxsuset=$('#zsszbxxsuset');
		if(zsszbxxsu.val().indexOf('-'+bxxsidnw+'-')!=-1){
			alert('开设站点已经有此办学形式了');return false;
		}else{
			zsszbxxsu.val(zsszbxxsu.val()+bxxsidnw+'-');
			mdlx.trigger('click');
			zsszbxxsuset.append("<div class='alert alert-warning alert-dismissible col-md-6' role='alert' id='myAlert_"+bxxsidnw+"'><button type='button' class='close' aria-label='Close' id='cls_"+bxxsidnw+"' onclick='gbzsszbxxsu("+bxxsidnw+")'><span aria-hidden='true'>×</span></button>"+bxxsnmnw+"</div>");
		}
	})
	
});

function dlt(zsszid,grdid){
	if(confirm("确定要删除此条记录？")){
		$.post(
			hdldlt,
			{zsszid:zsszid,grdid,grdid},
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
function gbzsszbxxsu(bxxsid){
	$('#myAlert_'+bxxsid).alert('close');
	var zsszbxxsu=$('input[name=zsszbxxsu]');
	var set=zsszbxxsu.val().split("-"+bxxsid+"-");
	zsszbxxsu.val(set[0]+'-'+set[1]);
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