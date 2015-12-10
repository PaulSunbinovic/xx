
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
	
	var stdid=$('select[name=stdid]');
	
	
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
					stdid.html(data.stdoptu);
					
					
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
					stdid.html(data.stdoptu);
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
					stdid.html(data.stdoptu);
					
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
					stdid.html(data.stdoptu);
					
					
				}
			},
			'json'
		);
	});
	
	
		
	
	//------------------------接下来是通用部分
	$("#updt").click(function(){
			
		

		var f_cjzx_pkid=$('select[name=f_cjzx_pkid]');


		//防止输入空
		
		if(f_cjzx_pkid.val()==0){
			alert('请选择课程');
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
					alert('选课成功');
					window.location.href=document.referrer;
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

function rstpw(cjzxid,grdid){
	
	$.post(
		hdlrstpw,
		{cjzxid:cjzxid,grdid:grdid},
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

function szf(obj){
	var id=$(obj).attr('id').split('-')[1];
	var zf=$('#cjzxzf-'+id);var qmf=$('#cjzxqmf-'+id);var psf=$('#cjzxpsf-'+id);var xtf=$('#cjzxxtf-'+id);
	var qmfII=0; var psfII=0; var xtfII=0;
	if(qmf.val()=='限考'||psf.val()=='限考'||xtf.val()=='限考'){
		zf.val('限考');
	}else if(qmf.val()==''&&psf.val()==''&&xtf.val()==''){
		zf.val('');
	}else{
		if(qmf.val()==''){qmfII=0;}else{qmfII=qmf.val();}
		if(psf.val()==''){psfII=0;}else{psfII=psf.val();}
		if(xtf.val()==''){xtfII=0;}else{xtfII=xtf.val();}
		//zf.val((qmfII*wqm+psfII*wps+xtfII*wxt).toFixed(1));
		zf.val(Math.ceil(qmfII*wqm+psfII*wps+xtfII*wxt));
	}
}

function qxxk(grdid,clsid,pkid,xqid){
	if(confirm("真的要取消这批选课吗？")){
		$('#lay').css('top',document.documentElement.scrollTop);
		$('#lay').show();
		$('#ts').css('top',document.documentElement.scrollTop+window.screen.height/3);
		$('#ts').html('正在取消选课，请稍等');
		$('#ts').show();
		
		$.post(
			hdlqxxk,
			{grdid:grdid,clsid:clsid,pkid:pkid,xqid:xqid},
			function(data){
				
				if(data.status==1){
					$('#lay').hide();
					$('#ts').html('');
					$('#ts').hide();
					alert('共'+data.jishu+'条取消成功');
					$('#myAlert-'+grdid+'-'+clsid+'-'+pkid+'-'+xqid).alert('close');
//					window.location.reload();
				}else{
					alert('取消选课失败');
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