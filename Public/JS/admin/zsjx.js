
$(function () {

	$('#stzsjx').click(function(){

		var zsjxsg=$('input[name=zsjxsg]');
		var zsjxtz=$('input[name=zsjxtz]');
		var zsjxxm=$('input[name=zsjxxm]');
		if($.trim(zsjxsg.val())==''){
			alert('身高不能为空');return;
		}
		if(isNaN(zsjxsg.val())==true){
			alert('身高必须是数字');return;
		}
		if($.trim(zsjxtz.val())==''){
			alert('体重不能为空');return;
		}
		if(isNaN(zsjxtz.val())==true){
			alert('体重必须是数字');return;
		}
		if($.trim(zsjxxm.val())==''){
			alert('鞋码不能为空');return;
		}
		if(isNaN(zsjxxm.val())==true){
			alert('鞋码必须是数字');return;
		}

		var prmts=$("#stzsjx").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlstzsjx,
			prmts,
			function(data){
				alert('添加成功！');
				window.location.reload();
			
			
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

function showdetail(stdid){
	
	$.post(
		hdlswdt,
		{stdid:stdid},
		function(data){
			
			//提交学生信息
			$('#stdnm_md').html(data.zsjxo.stdo.stdnm);
			$('#std_detail').html('报名号：'+data.zsjxo.stdo.stdaplno+'&nbsp;&nbsp;'+'专业：'+data.zsjxo.stdo.mjnm+'&nbsp;&nbsp;');
			$('input[name=zsjxid]').val(data.zsjxo.zsjxid);
			$('input[name=stdid]').val(data.zsjxo.f_zsjx_stdid);
			$('input[name=zsjxsg]').val(data.zsjxo.zsjxsg);
			$('input[name=zsjxtz]').val(data.zsjxo.zsjxtz);
			$('input[name=zsjxxm]').val(data.zsjxo.zsjxxm);
			$('#myModal').modal('show');
		
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