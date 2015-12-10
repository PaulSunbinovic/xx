
$(function () {
	
	
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
	var f_stdxqcls_xqid=$('select[name=f_stdxqcls_xqid]');
	var f_stdxqmj_xqid=$('select[name=f_stdxqmj_xqid]');
	var f_stdxqdm_xqid=$('select[name=f_stdxqdm_xqid]');
	var f_mj_bxxsid=$('select[name=f_mj_bxxsid]');
	var slctstdaplno=$('select[name=slctstdaplno]');
	var slctstdno=$('select[name=slctstdno]');
	var stdaplno=$('input[name=stdaplno]');
	var stdno=$('input[name=stdno]');
	
	
	
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
					f_stdxqdm_xqid.html(data.xqoptu);
					stdaplno.val(data.stdaplno);
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
					f_stdxqdm_xqid.html(data.xqoptu);
				}
			},
			'json'
		);
	});
	f_stdxqcls_xqid.change(function(){
		f_stdxqmj_xqid.val(f_stdxqcls_xqid.val());
		f_stdxqdm_xqid.val(f_stdxqcls_xqid.val());
		jsn={stdid:stdid.val(),f_mj_ccid:f_mj_ccid.val(),f_mj_klid:f_mj_klid.val(),f_mj_xxxsid:f_mj_xxxsid.val(),f_mj_zsfwid:f_mj_zsfwid.val(),f_mj_xzid:f_mj_xzid.val(),f_std_sttid:f_std_sttid.val(),f_std_grdid:f_std_grdid.val(),f_mj_bxxsid:f_mj_bxxsid.val(),f_stdxqcls_xqid:f_stdxqcls_xqid.val()};
		$.post(
			hdlcrtu,
			jsn,
			function(data){
				if(data.status==1){
					f_stdxqcls_clsid.html(data.clsoptu);
					
				}
			},
			'json'
		);
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
//			
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
	$("#updt").click(function(){
			
		var dsbdeles=$('.mingxi').find(':disabled');
		dsbdeles.attr('disabled',false);
		
//		var f_mj_bxxsid=$('select[name=f_mj_bxxsid]');
//		var f_std_sttid=$('select[name=f_std_sttid]');
//		var f_std_grdid=$('select[name=f_std_grdid]');
//		var f_mj_ccid=$('select[name=f_mj_ccid]');
//		var f_mj_klid=$('select[name=f_mj_klid]');
//		var f_mj_xxxsid=$('select[name=f_mj_xxxsid]');
//		var f_mj_zsfwid=$('select[name=f_mj_zsfwid]');
//		var f_mj_xzid=$('select[name=f_mj_xzid]');
		var f_stdxqcls_clsid=$('select[name=f_stdxqcls_clsid]');
		var f_stdxqmj_mjid=$('select[name=f_stdxqmj_mjid]');
		var stdnm=$('input[name=stdnm]');
		var stdpw=$('input[name=stdpw]');
		var f_std_sexid=$('select[name=f_std_sexid]');
		var f_std_rcid=$('select[name=f_std_rcid]');
		var f_std_zzmmid=$('select[name=f_std_zzmmid]');
		var stdnp=$('input[name=stdnp]');
		var stdidcd=$('input[name=stdidcd]');
		var stdbtd=$('input[name=stdbtd]');
		var stdcp=$('input[name=stdcp]');
		var stdml=$('input[name=stdml]');
		var f_std_statid=$('select[name=f_std_statid]');
		
		
		if(f_mj_bxxsid.val()==0){
			alert('请选择办学形式');
			dsbdeles.attr('disabled',true);
			return false;
		}
//		if(f_std_sttid.val()==0){
//			alert('请选择站点');
//			dsbdeles.attr('disabled',true);return false;
//		}
//		if(f_std_grdid.val()==0){
//			alert('请选择年级');
//			dsbdeles.attr('disabled',true);return false;
//		}
//		if(f_mj_ccid.val()==0){
//			alert('请选择层次');
//			dsbdeles.attr('disabled',true);return false;
//		}
//		if(f_mj_klid.val()==0){
//			alert('请选择科类');
//			dsbdeles.attr('disabled',true);return false;
//		}
//		if(f_mj_xxxsid.val()==0){
//			alert('请选择学习形式');
//			dsbdeles.attr('disabled',true);return false;
//		}
//		if(f_mj_zsfwid.val()==0){
//			alert('请选择招生范围');
//			dsbdeles.attr('disabled',true);return false;
//		}
//		if(f_mj_xzid.val()==0){
//			alert('请选择学制');
//			dsbdeles.attr('disabled',true);return false;
//		}
		//防止输入空
		if($.trim(stdnm.val())==''){
			alert('姓名不能为空！');
			stdnm.focus();
			dsbdeles.attr('disabled',true);
			return false;
		}
//		if($.trim(stdpw.val())==''){
//			alert('密码不能为空！');
//			stdpw.focus();
//			return false;
//		}
//		if($.trim(stdpw.val()).length<8){
//			alert('密码不能小于8位！');
//			stdpw.focus();
//			return false;
//		}
//		if($.trim(stdpwag.val())==''){
//			alert('请再次输入密码！');
//			stdpwag.focus();
//			return false;
//		}
//		if($.trim(stdpw.val())!=$.trim(stdpwag.val())){
//			alert('两次输入的密码不一致');
//			stdpw.val('');
//			stdpwag.val('');
//			stdpw.focus;
//			return false;//
//			
//		}
		
//		if(f_stdxqcls_clsid.val()==0){
//			alert('请选择班级');
//			return false;
//		}//考虑到很多班级是很后面才分出来的，可以以后再注册班级，但是专业必须先注册掉
		
		if(f_stdxqmj_mjid.val()==0||f_stdxqmj_mjid.val()==''){
			alert('请选择专业');
			dsbdeles.attr('disabled',true);
			return false;
		}
		
		if(f_std_sexid.val()==0){
			alert('请选择性别');
			dsbdeles.attr('disabled',true);
			return false;
		}
		if(f_std_rcid.val()==0){
			alert('请选择民族');
			dsbdeles.attr('disabled',true);
			return false;
		}
		if(f_std_zzmmid.val()==0){
			alert('请选择政治面貌');
			dsbdeles.attr('disabled',true);
			return false;
		}
//		if($.trim(stdnp.val())==''){
//			alert('籍贯不能为空！');
//			dsbdeles.attr('disabled',true);
//			return false;
//		}
		if($.trim(stdidcd.val())==''){
			alert('身份证号码不能为空！');
			dsbdeles.attr('disabled',true);
			return false;
		}
		if($.trim(stdidcd.val()).length!=18){
			alert('身份证号码必须18位！');
			dsbdeles.attr('disabled',true);
			return false;
		}
		if($.trim(stdbtd.val())==''){
			alert('生日不能为空！');
			dsbdeles.attr('disabled',true);
			return false;
		}
		
		
		if($.trim(stdcp.val())==''){
			alert('电话不能为空！');
			stdcp.focus();
			dsbdeles.attr('disabled',true);
			return false;
		}
		var pttnmbl=/^1[34578][0-9]{9}$/;
		if(!pttnmbl.test($.trim(stdcp.val()))){
			alert('手机号码格式不正确！');
			stdcp.focus();
			dsbdeles.attr('disabled',true);
			return false;
		}
//		if($.trim(stdml.val())==''){
//			alert('密保邮箱不能为空！');
//			stdml.focus();
//			return false;
//		}
		if($.trim(stdml.val())!=''){
			var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
			if(!pttneml.test($.trim(stdml.val()))){
				alert('邮箱格式不对！');
				stdml.focus();
				dsbdeles.attr('disabled',true);
				return false;
			}
		}
		if(f_std_statid.val()==0){
			alert('请选择状态');
			dsbdeles.attr('disabled',true);
			return false;
		}
		
		var prmts=$("#updt").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				dsbdeles.attr('disabled',true);
				if(data.status==1){
					alert('该身份证已经注册过，请联系管理员');
				}else if(data.status==2){
					alert('更新成功');
					window.location.href=document.referrer;
				}else if(data.status==3){
					alert('更新失败');
				}else if(data.status==4){
					alert('身份证号码和生日不符合，请以身份证号码为准');
				}
			
			
			},
			'json'
		);
	})
	
	
	$("#updtxj").click(function(){
			
		var dsbdeles=$('.mingxi').find(':disabled');
		dsbdeles.attr('disabled',false);
		

		var f_stdxqcls_clsid=$('select[name=f_stdxqcls_clsid]');
		var f_stdxqmj_mjid=$('select[name=f_stdxqmj_mjid]');
		
		

		//防止输入空
		

		if(f_stdxqmj_mjid.val()==0){
			alert('请选择专业');
			return false;
		}
		
		
		
		var prmts=$("#updtxj").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurlxj,
			prmts,
			function(data){
				dsbdeles.attr('disabled',true);
				if(data.status==1){
					alert('更新学籍信息成功');
					window.location.reload();
				}
			
			
			},
			'json'
		);
	})
	
	
//	$("#updtjb").click(function(){
//			
//		var dsbdeles=$('.mingxi').find(':disabled');
//		dsbdeles.attr('disabled',false);
//		
//
//		var f_stdxqcls_clsid=$('select[name=f_stdxqcls_clsid]');
//		var f_stdxqmj_mjid=$('select[name=f_stdxqmj_mjid]');
//		var stdnm=$('input[name=stdnm]');
//		var stdpw=$('input[name=stdpw]');
//		var f_std_sexid=$('select[name=f_std_sexid]');
//		var f_std_rcid=$('select[name=f_std_rcid]');
//		var f_std_zzmmid=$('select[name=f_std_zzmmid]');
//		var stdnp=$('input[name=stdnp]');
//		var stdidcd=$('input[name=stdidcd]');
//		var stdbtd=$('input[name=stdbtd]');
//		var stdcp=$('input[name=stdcp]');
//		var stdml=$('input[name=stdml]');
//		var f_std_statid=$('select[name=f_std_statid]');
//		
//		
//
//		//防止输入空
//		if($.trim(stdnm.val())==''){
//			alert('姓名不能为空！');
//			stdnm.focus();
//			return false;
//		}
//
//		if(f_stdxqmj_mjid.val()==0){
//			alert('请选择专业');
//			return false;
//		}
//		
//		if(f_std_sexid.val()==0){
//			alert('请选择性别');
//			return false;
//		}
//		if(f_std_rcid.val()==0){
//			alert('请选择民族');
//			return false;
//		}
//		if(f_std_zzmmid.val()==0){
//			alert('请选择政治面貌');
//			return false;
//		}
//		if($.trim(stdnp.val())==''){
//			alert('籍贯不能为空！');
//			return false;
//		}
//		if($.trim(stdidcd.val())==''){
//			alert('身份证号码不能为空！');
//			return false;
//		}
//		if($.trim(stdidcd.val()).length!=18){
//			alert('身份证号码必须18位！');
//			return false;
//		}
//		if($.trim(stdbtd.val())==''){
//			alert('生日不能为空！');
//			return false;
//		}
//		
//		
//		if($.trim(stdcp.val())==''){
//			alert('电话不能为空！');
//			stdcp.focus();
//			return false;
//		}
//		var pttnmbl=/^1[34578][0-9]{9}$/;
//		if(!pttnmbl.test($.trim(stdcp.val()))){
//			alert('手机号码格式不正确！');
//			stdcp.focus();
//			return false;
//		}
//
//		if($.trim(stdml.val())!=''){
//			var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
//			if(!pttneml.test($.trim(stdml.val()))){
//				alert('邮箱格式不对！');
//				stdml.focus();
//				return false;
//			}
//		}
//		if(f_std_statid.val()==0){
//			alert('请选择状态');
//			return false;
//		}
//		
//		var prmts=$("#updt").parent().serialize();//parameters
//		//防止既输入空又输入了有效值
//		prmts=rmvblk(prmts);
//		
//
//		$.post(
//			hdlurl,
//			prmts,
//			function(data){
//				dsbdeles.attr('disabled',true);
//				if(data.status==1){
//					alert('该身份证已经注册过，请联系管理员');
//				}else if(data.status==2){
//					alert('更新成功');
//					window.location.href=document.referrer;
//				}else if(data.status==3){
//					alert('更新失败');
//				}else if(data.status==4){
//					alert('身份证号码和生日不符合，请以身份证号码为准');
//				}
//			
//			
//			},
//			'json'
//		);
//	})

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