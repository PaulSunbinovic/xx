
$(function () {
	
	
	var cjzxid=$('input[name=cjzxid]');
	
	var f_cjzx_sttid=$('select[name=f_cjzx_sttid]');
	var f_pk_sttid=$('select[name=f_pk_sttid]');
	var f_std_sttid=$('select[name=f_std_sttid]');
	
	var f_cjzx_grdid=$('select[name=f_cjzx_grdid]');
	var f_pk_grdid=$('select[name=f_pk_grdid]');
	var f_std_grdid=$('select[name=f_std_grdid]');
	
	var f_cjzx_xqid=$('select[name=f_cjzx_xqid]');
	var f_pk_xqid=$('select[name=f_pk_xqid]');
	var f_stdxqcls_xqid=$('select[name=f_stdxqcls_xqid]');
	var f_stdxqmj_xqid=$('select[name=f_stdxqmj_xqid]');
	
	var f_stdxqcls_clsid=$('select[name=f_stdxqcls_clsid]');
	var f_cjzx_pkid=$('select[name=f_cjzx_pkid]');
	
	f_cjzx_sttid.change(function(){
		f_pk_sttid.val(f_cjzx_sttid.val());
		f_std_sttid.val(f_cjzx_sttid.val());
		
	});
	
	f_cjzx_grdid.change(function(){
		f_pk_grdid.val(f_cjzx_grdid.val());
		f_std_grdid.val(f_cjzx_grdid.val());
		
	});
	
	
	f_cjzx_xqid.change(function(){
		f_pk_xqid.val(f_cjzx_xqid.val());
		f_stdxqcls_xqid.val(f_cjzx_xqid.val());
		f_stdxqmj_xqid.val(f_cjzx_xqid.val());
		
	});
	
	f_cjzx_grdid.change(function(){
		jsn={f_cjzx_sttid:f_cjzx_sttid.val(),f_cjzx_grdid:f_cjzx_grdid.val(),f_cjzx_xqid:f_cjzx_xqid.val(),f_stdxqcls_clsid:f_stdxqcls_clsid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqcls_clsid.html(data.clsoptu);
					f_cjzx_pkid.html(data.pkoptu);
					f_cjzx_xqid.html(data.xqoptu);
					f_pk_xqid.html(data.xqoptu);
					f_stdxqcls_xqid.html(data.xqoptu);
					f_stdxqmj_xqid.html(data.xqoptu);
					
					
					
				}
			},
			'json'
		);
	});
	f_cjzx_sttid.change(function(){
		jsn={f_cjzx_sttid:f_cjzx_sttid.val(),f_cjzx_grdid:f_cjzx_grdid.val(),f_cjzx_xqid:f_cjzx_xqid.val(),f_stdxqcls_clsid:f_stdxqcls_clsid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqcls_clsid.html(data.clsoptu);
					f_cjzx_pkid.html(data.pkoptu);
					f_cjzx_xqid.html(data.xqoptu);
					f_stdxqcls_xqid.html(data.xqoptu);
					f_stdxqmj_xqid.html(data.xqoptu);
				}
			},
			'json'
		);
	});
	f_cjzx_xqid.change(function(){
		jsn={f_cjzx_sttid:f_cjzx_sttid.val(),f_cjzx_grdid:f_cjzx_grdid.val(),f_cjzx_xqid:f_cjzx_xqid.val(),f_stdxqcls_clsid:f_stdxqcls_clsid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_cjzx_pkid.html(data.pkoptu);
					
					
				}
			},
			'json'
		);
	});
	f_stdxqcls_clsid.change(function(){
		jsn={f_cjzx_sttid:f_cjzx_sttid.val(),f_cjzx_grdid:f_cjzx_grdid.val(),f_cjzx_xqid:f_cjzx_xqid.val(),f_stdxqcls_clsid:f_stdxqcls_clsid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_cjzx_pkid.html(data.pkoptu);
					
					
				}
			},
			'json'
		);
	});
	
	
	$('.cj').keypress(function(event){  
	    var keycode = (event.keyCode ? event.keyCode : event.which);  
	    if(keycode == '13'){
	    	var jsfou=1;//默认计算否都是1允许计算
	    	//先获得ID
			var id=$(this).attr('id');
			id=id.split('-')[1];
			
	    	//判断是不是个数字
			if($(this).val()!=''&&isNaN($(this).val())){
				alert('请输入数字');
				$(this).val('');
				if(jsfou!=0){szf(this);}
				$(this).focus();
				return false;
			}
			//判断是否超标
			if($(this).val()<0||$(this).val()>100){
				alert('请填写的数字在1至100的范围内');
				$(this).val('');
				if(jsfou!=0){szf(this);}
				$(this).focus();
				return false;
			}
			//得到本身的哪个id
			
	    	var prix=$(this).attr('id').split('-')[0];
	    	var id=$(this).attr('id').split('-')[1];
	    	var idu=rfr.split('-');
	    	var i=0;
	    	for(i=1;i<idu.length-1;i++){
	    		if(idu[i]==id){
	    			break;
	    		}
	    	}
	    	$('#'+prix+'-'+idu[i+1]).focus();
	    	
	    }  
	});
	$('.cj').keyup(function(){//blur
		var jsfou=1;//默认计算否都是1允许计算
		//先获得ID
		var id=$(this).attr('id');
		id=id.split('-')[1];
		
		//判断是不是个数字
		if($(this).val()!=''&&isNaN($(this).val())){
			alert('请输入数字');
			$(this).val('');
			if(jsfou!=0){szf(this);}
			$(this).focus();
			return false;
		}
		//判断是否超标
		if($(this).val()<0||$(this).val()>100){
			alert('请填写的数字在1至100的范围内');
			$(this).val('');
			if(jsfou!=0){szf(this);}
			$(this).focus();
			return false;
		}
		//得到本身的哪个id
		
		
	})
	$('.cj1').keyup(function(){//blur
		var jsfou=1;
		//先获得ID
		var id=$(this).attr('id');
		id=id.split('-')[1];
		
		//判断是不是个数字
		if($(this).val()!=''&&isNaN($(this).val())){
			alert('请输入数字');
			$(this).val('');
			if(jsfou!=0){szf(this);}
			$(this).focus();
			return false;
		}
		//判断是否超标
		if($(this).val()<0||$(this).val()>100){
			alert('请填写的数字在1至100的范围内');
			$(this).val('');
			if(jsfou!=0){szf(this);}
			$(this).focus();
			return false;
		}
		//得到本身的哪个id
		
	})
//	
	
	$("#bc").click(function(){
		
		$('#lay').css('top',document.documentElement.scrollTop);
		$('#lay').show();
		$('#ts').css('top',document.documentElement.scrollTop+window.screen.height/3);
		$('#ts').html('正在保存，请稍等');
		$('#ts').show();
				
		var prmts=$("#bc").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlbc,
			prmts,
			function(data){
				
				if(data.status==1){
					$('#lay').hide();
					$('#ts').html('');
					$('#ts').hide();
					alert('保存成功');
					//$('#NBsrcU').trigger('click');
					//window.location.href=document.referrer;
				}
			
			
			},
			'json'
		);
	})
	
	$("#tj").click(function(){
		if(confirm('提交后成绩将无法更改，是否确定要提交')){
			//验证是否都已经正确填写了
			var rfru=rfr.split('-');

			
			$('#lay').css('top',document.documentElement.scrollTop);
			$('#lay').show();
			$('#ts').css('top',document.documentElement.scrollTop+window.screen.height/3);
			$('#ts').html('正在提交，请稍等');
			$('#ts').show();
					
			var prmts=$("#tj").parent().serialize();//parameters
			//防止既输入空又输入了有效值
			prmts=rmvblk(prmts);
			
	
			$.post(
				hdltj,
				prmts,
				function(data){
					
					if(data.status==1){
						$('#lay').hide();
						$('#ts').html('');
						$('#ts').hide();
						alert('提交成功');
						$('#NBsrcU').trigger('click');
						//window.location.reload();
						//window.location.href=document.referrer;
					}
				
				
				},
				'json'
			);
		}
	})
	
	
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
	
	
	

});
//
function dlt(cjzxid,grdid){
	if(confirm("确定要删除此条记录？")){
		$.post(
			hdldlt,
			{cjzxid:cjzxid,grdid:grdid},
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