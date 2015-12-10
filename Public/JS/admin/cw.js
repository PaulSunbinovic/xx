
$(function () {
	
	var cwid=$('input[name=cwid]');
	var stdid=$('input[name=stdid]');
	var f_mj_ccid=$('select[name=f_mj_ccid]');
	var f_mj_klid=$('select[name=f_mj_klid]');
	var f_mj_xxxsid=$('select[name=f_mj_xxxsid]');
	var f_mj_zsfwid=$('select[name=f_mj_zsfwid]');
	var f_mj_xzid=$('select[name=f_mj_xzid]');
	var f_stdxqmj_mjid=$('select[name=f_stdxqmj_mjid]');
	var f_stdxqcls_clsid=$('select[name=f_stdxqcls_clsid]');
	var f_std_sttid=$('select[name=f_std_sttid]');
	var f_std_grdid=$('select[name=f_std_grdid]');
	var f_cw_xnid=$('select[name=f_cw_xnid]');
	var f_stdxqcls_xqid=$('select[name=f_stdxqcls_xqid]');
	var f_stdxqmj_xqid=$('select[name=f_stdxqmj_xqid]');
	var f_mj_bxxsid=$('select[name=f_mj_bxxsid]');
	var stdaplno=$('input[name=stdaplno]');
	var stdno=$('input[name=stdno]');
	
	
	f_cw_xnid.change(function(){
		jsn={f_std_grdid:f_std_grdid.val(),f_cw_xnid:f_cw_xnid.val(),f_std_sttid:f_std_sttid.val()};
		$.post(
			hdlcrtxq,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqcls_xqid.val(data.xqid);
					f_stdxqmj_xqid.val(data.xqid);
				}
			},
			'json'
		);
	});
	f_mj_ccid.change(function(){
		jsn={stdid:stdid.val(),f_mj_ccid:f_mj_ccid.val(),f_mj_klid:f_mj_klid.val(),f_mj_xxxsid:f_mj_xxxsid.val(),f_mj_zsfwid:f_mj_zsfwid.val(),f_mj_xzid:f_mj_xzid.val(),f_std_sttid:f_std_sttid.val(),f_std_grdid:f_std_grdid.val(),f_mj_bxxsid:f_mj_bxxsid.val(),f_stdxqcls_xqid:f_stdxqcls_xqid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqmj_mjid.html(data.mjoptu);
				}
			},
			'json'
		);
	});
	f_mj_klid.change(function(){
		jsn={stdid:stdid.val(),f_mj_ccid:f_mj_ccid.val(),f_mj_klid:f_mj_klid.val(),f_mj_xxxsid:f_mj_xxxsid.val(),f_mj_zsfwid:f_mj_zsfwid.val(),f_mj_xzid:f_mj_xzid.val(),f_std_sttid:f_std_sttid.val(),f_std_grdid:f_std_grdid.val(),f_mj_bxxsid:f_mj_bxxsid.val(),f_stdxqcls_xqid:f_stdxqcls_xqid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqmj_mjid.html(data.mjoptu);
				}
			},
			'json'
		);
	});
	f_mj_xxxsid.change(function(){
		jsn={stdid:stdid.val(),f_mj_ccid:f_mj_ccid.val(),f_mj_klid:f_mj_klid.val(),f_mj_xxxsid:f_mj_xxxsid.val(),f_mj_zsfwid:f_mj_zsfwid.val(),f_mj_xzid:f_mj_xzid.val(),f_std_sttid:f_std_sttid.val(),f_std_grdid:f_std_grdid.val(),f_mj_bxxsid:f_mj_bxxsid.val(),f_stdxqcls_xqid:f_stdxqcls_xqid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqmj_mjid.html(data.mjoptu);
				}
			},
			'json'
		);
	});
	f_mj_zsfwid.change(function(){
		jsn={stdid:stdid.val(),f_mj_ccid:f_mj_ccid.val(),f_mj_klid:f_mj_klid.val(),f_mj_xxxsid:f_mj_xxxsid.val(),f_mj_zsfwid:f_mj_zsfwid.val(),f_mj_xzid:f_mj_xzid.val(),f_std_sttid:f_std_sttid.val(),f_std_grdid:f_std_grdid.val(),f_mj_bxxsid:f_mj_bxxsid.val(),f_stdxqcls_xqid:f_stdxqcls_xqid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqmj_mjid.html(data.mjoptu);
				}
			},
			'json'
		);
	});
	f_mj_xzid.change(function(){
		jsn={stdid:stdid.val(),f_mj_ccid:f_mj_ccid.val(),f_mj_klid:f_mj_klid.val(),f_mj_xxxsid:f_mj_xxxsid.val(),f_mj_zsfwid:f_mj_zsfwid.val(),f_mj_xzid:f_mj_xzid.val(),f_std_sttid:f_std_sttid.val(),f_std_grdid:f_std_grdid.val(),f_mj_bxxsid:f_mj_bxxsid.val(),f_stdxqcls_xqid:f_stdxqcls_xqid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqmj_mjid.html(data.mjoptu);
				}
			},
			'json'
		);
	});
	
	f_std_grdid.change(function(){
		jsn={stdid:stdid.val(),f_mj_ccid:f_mj_ccid.val(),f_mj_klid:f_mj_klid.val(),f_mj_xxxsid:f_mj_xxxsid.val(),f_mj_zsfwid:f_mj_zsfwid.val(),f_mj_xzid:f_mj_xzid.val(),f_std_sttid:f_std_sttid.val(),f_std_grdid:f_std_grdid.val(),f_mj_bxxsid:f_mj_bxxsid.val(),f_stdxqcls_xqid:f_stdxqcls_xqid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqcls_clsid.html(data.clsoptu);
					f_stdxqmj_mjid.html(data.mjoptu);
					f_stdxqcls_xqid.html(data.xqoptu);
					f_stdxqmj_xqid.html(data.xqoptu);
					stdaplno.val(data.stdaplno);
					f_cw_xnid.html(data.xnoptu);
					f_stdxqcls_xqid.val(data.xqid);
					f_stdxqmj_xqid.val(data.xqid);
				}
			},
			'json'
		);
	});
	f_std_sttid.change(function(){
		jsn={stdid:stdid.val(),f_mj_ccid:f_mj_ccid.val(),f_mj_klid:f_mj_klid.val(),f_mj_xxxsid:f_mj_xxxsid.val(),f_mj_zsfwid:f_mj_zsfwid.val(),f_mj_xzid:f_mj_xzid.val(),f_std_sttid:f_std_sttid.val(),f_std_grdid:f_std_grdid.val(),f_mj_bxxsid:f_mj_bxxsid.val(),f_stdxqcls_xqid:f_stdxqcls_xqid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqcls_clsid.html(data.clsoptu);
					f_stdxqmj_mjid.html(data.mjoptu);
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
	
	
	f_mj_bxxsid.change(function(){
		jsn={stdid:stdid.val(),f_mj_ccid:f_mj_ccid.val(),f_mj_klid:f_mj_klid.val(),f_mj_xxxsid:f_mj_xxxsid.val(),f_mj_zsfwid:f_mj_zsfwid.val(),f_mj_xzid:f_mj_xzid.val(),f_std_sttid:f_std_sttid.val(),f_std_grdid:f_std_grdid.val(),f_mj_bxxsid:f_mj_bxxsid.val(),f_stdxqcls_xqid:f_stdxqcls_xqid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqmj_mjid.html(data.mjoptu);
					stdaplno.val(data.stdaplno);
				}
			},
			'json'
		);
	});
//	slctstdaplno.change(function(){
//		jsn={slctstdaplno:slctstdaplno.val(),f_std_grdid:f_std_grdid.val(),f_mj_bxxsid:f_mj_bxxsid.val()};
//		$.post(
//				hdlcrtu,
//				jsn,
//				function(data){
//					if(data.status==1){
//						stdaplno.val(data.stdaplno);
//					}
//				},
//				'json'
//			);
//	});
//	slctstdno.change(function(){
//		jsn={slctstdno:slctstdno.val(),f_std_clsid:f_std_clsid.val()};
//		$.post(
//				hdlcrtu,
//				jsn,
//				function(data){
//					if(data.status==1){
//						stdno.val(data.stdno);
//					}else if(data.status==2){
//						
//					}
//				},
//				'json'
//			);
//	});
	f_stdxqcls_clsid.change(function(){
		if(stdid.val()==0){//如果是修改学生信息的时候stdno就定了不能动了，只能添加的时候可以让他随便动
			jsn={stdid:stdid.val(),f_mj_ccid:f_mj_ccid.val(),f_mj_klid:f_mj_klid.val(),f_mj_xxxsid:f_mj_xxxsid.val(),f_mj_zsfwid:f_mj_zsfwid.val(),f_mj_xzid:f_mj_xzid.val(),f_std_sttid:f_std_sttid.val(),f_std_grdid:f_std_grdid.val(),f_mj_bxxsid:f_mj_bxxsid.val(),f_stdxqcls_clsid:f_stdxqcls_clsid.val(),f_stdxqcls_xqid:f_stdxqcls_xqid.val()};//特殊放最后一个
			$.post(
				hdlcrtu,
				jsn,
				function(data){
					if(data.status==1){
						stdno.val(data.stdno);
					}
				},
				'json'
			);
		}
		
	});

	var ifrcmd=$('select[name=ifrcmd]');
	
	ifrcmd.change(function(){
		if(ifrcmd.val()=='否'){
			$('input[name=stdrcmdnm]').attr('readonly',true);
			$('input[name=stdrcmdnm]').val('');
			$('input[name=stdrcmdcp]').attr('readonly',true);
			$('input[name=stdrcmdcp]').val('');
		}else{
			$('input[name=stdrcmdnm]').attr('readonly',false);
			$('input[name=stdrcmdcp]').attr('readonly',false);
		}
	});
//	
//	var slctstdaplno=$('select[name=slctstdaplno]');
//	
//	slctstdaplno.change(function(){
//		if(slctstdaplno.val()=='auto'){
//			$('input[name=stdaplno]').attr('disabled',true);
//			$('input[name=stdaplno]').val('');
//		}else{
//			$('input[name=stdaplno]').attr('disabled',false);
//		}
//	});
//	
//	var slctstdno=$('select[name=slctstdno]');
//	
//	slctstdno.change(function(){
//		if(slctstdno.val()=='auto'){
//			$('input[name=stdno]').attr('disabled',true);
//			$('input[name=stdno]').val('');
//		}else{
//			$('input[name=stdno]').attr('disabled',false);
//		}
//	});
//	
	//------------------------接下来是通用部分
	
	var cwyjxfsm=$('input[name=cwyjxfsm]');
	var cwyjjckwfsm=$('input[name=cwyjjckwfsm]');
	var cwyjzsfsm=$('input[name=cwyjzsfsm]');
	var cwyjze=$('input[name=cwyjze]');
	var cwsjxfsm=$('input[name=cwsjxfsm]');
	var cwsjjckwfsm=$('input[name=cwsjjckwfsm]');
	var cwsjzsfsm=$('input[name=cwsjzsfsm]');
	var cwsjze=$('input[name=cwsjze]');
	cwyjxfsm.blur(function(){
		if(isNaN($(this).val())){
			alert('请输入数字！');
			$(this).val($(this).attr('alt'));
			cwyjze.val(parseInt(cwyjxfsm.val())+parseInt(cwyjjckwfsm.val())+parseInt(cwyjzsfsm.val()));
			cwsjze.val(parseInt(cwsjxfsm.val())+parseInt(cwsjjckwfsm.val())+parseInt(cwsjzsfsm.val()));
			return;
		}
		cwyjze.val(parseInt(cwyjxfsm.val())+parseInt(cwyjjckwfsm.val())+parseInt(cwyjzsfsm.val()));
		cwsjze.val(parseInt(cwsjxfsm.val())+parseInt(cwsjjckwfsm.val())+parseInt(cwsjzsfsm.val()));
	});
	cwyjjckwfsm.blur(function(){
		if(isNaN($(this).val())){
			alert('请输入数字！');
			$(this).val($(this).attr('alt'));
			cwyjze.val(parseInt(cwyjxfsm.val())+parseInt(cwyjjckwfsm.val())+parseInt(cwyjzsfsm.val()));
			cwsjze.val(parseInt(cwsjxfsm.val())+parseInt(cwsjjckwfsm.val())+parseInt(cwsjzsfsm.val()));
			return;
		}
		cwyjze.val(parseInt(cwyjxfsm.val())+parseInt(cwyjjckwfsm.val())+parseInt(cwyjzsfsm.val()));
		cwsjze.val(parseInt(cwsjxfsm.val())+parseInt(cwsjjckwfsm.val())+parseInt(cwsjzsfsm.val()));
	});
	cwyjzsfsm.blur(function(){
		if(isNaN($(this).val())){
			alert('请输入数字！');
			$(this).val($(this).attr('alt'));
			cwyjze.val(parseInt(cwyjxfsm.val())+parseInt(cwyjjckwfsm.val())+parseInt(cwyjzsfsm.val()));
			cwsjze.val(parseInt(cwsjxfsm.val())+parseInt(cwsjjckwfsm.val())+parseInt(cwsjzsfsm.val()));
			return;
		}
		cwyjze.val(parseInt(cwyjxfsm.val())+parseInt(cwyjjckwfsm.val())+parseInt(cwyjzsfsm.val()));
		cwsjze.val(parseInt(cwsjxfsm.val())+parseInt(cwsjjckwfsm.val())+parseInt(cwsjzsfsm.val()));
	});
	cwsjxfsm.blur(function(){
		if(isNaN($(this).val())){
			alert('请输入数字！');
			$(this).val($(this).attr('alt'));
			cwyjze.val(parseInt(cwyjxfsm.val())+parseInt(cwyjjckwfsm.val())+parseInt(cwyjzsfsm.val()));
			cwsjze.val(parseInt(cwsjxfsm.val())+parseInt(cwsjjckwfsm.val())+parseInt(cwsjzsfsm.val()));
			return;
		}
		cwyjze.val(parseInt(cwyjxfsm.val())+parseInt(cwyjjckwfsm.val())+parseInt(cwyjzsfsm.val()));
		cwsjze.val(parseInt(cwsjxfsm.val())+parseInt(cwsjjckwfsm.val())+parseInt(cwsjzsfsm.val()));
	});
	cwsjjckwfsm.blur(function(){
		if(isNaN($(this).val())){
			alert('请输入数字！');
			$(this).val($(this).attr('alt'));
			cwyjze.val(parseInt(cwyjxfsm.val())+parseInt(cwyjjckwfsm.val())+parseInt(cwyjzsfsm.val()));
			cwsjze.val(parseInt(cwsjxfsm.val())+parseInt(cwsjjckwfsm.val())+parseInt(cwsjzsfsm.val()));
			return;
		}
		cwyjze.val(parseInt(cwyjxfsm.val())+parseInt(cwyjjckwfsm.val())+parseInt(cwyjzsfsm.val()));
		cwsjze.val(parseInt(cwsjxfsm.val())+parseInt(cwsjjckwfsm.val())+parseInt(cwsjzsfsm.val()));
	});
	cwsjzsfsm.blur(function(){
		if(isNaN($(this).val())){
			alert('请输入数字！');
			$(this).val($(this).attr('alt'));
			cwyjze.val(parseInt(cwyjxfsm.val())+parseInt(cwyjjckwfsm.val())+parseInt(cwyjzsfsm.val()));
			cwsjze.val(parseInt(cwsjxfsm.val())+parseInt(cwsjjckwfsm.val())+parseInt(cwsjzsfsm.val()));
			return;
		}
		cwyjze.val(parseInt(cwyjxfsm.val())+parseInt(cwyjjckwfsm.val())+parseInt(cwyjzsfsm.val()));
		cwsjze.val(parseInt(cwsjxfsm.val())+parseInt(cwsjjckwfsm.val())+parseInt(cwsjzsfsm.val()));
	});
	
	$("#updt").click(function(){
		
		var cwyjxfsm=$('input[name=cwyjxfsm]');
		var cwyjjckwfsm=$('input[name=cwyjjckwfsm]');
		var cwyjzsfsm=$('input[name=cwyjzsfsm]');
		var cwyjze=$('input[name=cwyjze]');
		var cwsjxfsm=$('input[name=cwsjxfsm]');
		var cwsjjckwfsm=$('input[name=cwsjjckwfsm]');
		var cwsjzsfsm=$('input[name=cwsjzsfsm]');
		var cwsjze=$('input[name=cwsjze]');
		
		

		
		var prmts=$("#updt").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				if(data.status==1){
					alert('更新成功');
					window.location.reload();
				}else if(data.status==2){
					alert('更新失败');
					
				}
			
			
			},
			'json'
		);
	})
	
	
	
	$("#bbcwdr").click(function(){
		
		hdlxlstosql=app_path+'/Xls/importcw'+'/bb/y';
		$('#uploadfilebtn').trigger('click');
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