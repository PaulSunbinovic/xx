
$(function () {
	
	
	var stdid=$('input[name=stdid]');
	
	var f_stdxqmj_mjid=$('select[name=f_stdxqmj_mjid]');
	var f_stdxqcls_clsid=$('select[name=f_stdxqcls_clsid]');
	var f_mj_bxxsid=$('select[name=f_mj_bxxsid]');
	
	var stdaplno=$('input[name=stdaplno]');
	var stdno=$('input[name=stdno]');
	
	
	
	
	f_mj_bxxsid.change(function(){
		jsn={stdid:stdid.val(),f_mj_bxxsid:f_mj_bxxsid.val()};
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

	f_stdxqcls_clsid.change(function(){
		if(stdid.val()==0){//如果是修改学生信息的时候stdno就定了不能动了，只能添加的时候可以让他随便动
			jsn={stdid:stdid.val(),f_mj_bxxsid:f_mj_bxxsid.val(),f_stdxqcls_clsid:f_stdxqcls_clsid.val(),f_stdxqcls_xqid:f_stdxqcls_xqid.val()};//特殊放最后一个
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

	//------------------------接下来是通用部分
	
	$('#panduan').click(function(){
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
//		var f_std_statid=$('select[name=f_std_statid]');
		var rslt=$('#rslt');
		var ifrcmd=$('select[name=ifrcmd]');
		var stdrcmdnm=$('input[name=stdrcmdnm]');
		var stdrcmdcp=$('input[name=stdrcmdcp]');
		var stdrlta=$('input[name=stdrlta]');
		var stdrltanm=$('input[name=stdrltanm]');
		var stdrltaocpt=$('input[name=stdrltaocpt]');
		var stdrltacp=$('input[name=stdrltacp]');
		
		var stdads=$('input[name=stdads]');
		var stdpst=$('input[name=stdpst]');
		//防止输入空
		if($.trim(stdnm.val())==''){
			rslt.html('姓名不能为空！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}

		
		
		
		if(f_std_sexid.val()==0){
			rslt.html('请选择性别！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		if(f_std_rcid.val()==0){
			rslt.html('请选择民族！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		if(f_std_zzmmid.val()==0){
			rslt.html('请选择政治面貌！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		if($.trim(stdnp.val())==''){
			rslt.html('籍贯不能为空！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		
		if($.trim(stdcp.val())==''){
			rslt.html('手机号不能为空！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		
		var pttnmbl=/^1[34578][0-9]{9}$/;
		if(!pttnmbl.test($.trim(stdcp.val()))){
			rslt.html('手机号码格式不正确！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		
		if($.trim(stdidcd.val())==''){
			rslt.html('身份证号码不能为空！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		if($.trim(stdidcd.val()).length!=18){
			rslt.html('身份证号码必须18位！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		if($.trim(stdbtd.val())==''){
			rslt.html('出生日期不能为空！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		
		if($.trim(stdrlta.val())==''){
			rslt.html('家长一关系不能为空！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		
		if($.trim(stdrltanm.val())==''){
			rslt.html('家长一姓名不能为空！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		
		if($.trim(stdrltaocpt.val())==''){
			rslt.html('家长一职业不能为空！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		
		if($.trim(stdrltacp.val())==''){
			rslt.html('家长一手机号不能为空！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		
		//var pttnmbl=/^1[34578][0-9]{9}$/;
		if(!pttnmbl.test($.trim(stdrltacp.val()))){
			rslt.html('家长一手机号码格式不正确！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}

		if($.trim(stdml.val())!=''){
			var pttneml=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
			if(!pttneml.test($.trim(stdml.val()))){
				alert('邮箱格式不对！');
				stdml.focus();
				return false;
			}
		}
//		if(f_std_statid.val()==0){
//			alert('请选择状态');
//			return false;
//		}
		
		if(ifrcmd.val()=='是'){
			if($.trim(stdrcmdnm.val())==''){
				rslt.html('介绍人姓名不能为空，否则在是否有介绍人中选择否！');
				$('#myModal').modal({
	    	    	  //keyboard: false
	    	    })
				return false;
			}
		}
		
		if(f_stdxqmj_mjid.val()==0||f_stdxqmj_mjid.val()==''){
			rslt.html('请选择专业！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		
		if($.trim(stdads.val())==''){
			rslt.html('家庭地址不能为空！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		
		if($.trim(stdpst.val())!=''&&(!(!isNaN($.trim(stdpst.val()))&&$.trim(stdpst.val()).length==6))){//非空情况下 是数字且6位之外的情况都是耍流氓
			rslt.html('邮编格式不正确！');
			$('#myModal').modal({
    	    	  //keyboard: false
    	    })
			return false;
		}
		
		$('#gttj').show();
		$('#sureII').show();
		$('#sure').hide();
		rslt.html('本系统不支持修改信息，请确定是否信息无误？（如果提交后发现有信息需要修改，请联系0571-86835789）');
		$('#myModal').modal({
	    	  //keyboard: false
	    })
	})
	$('#sure').click(function(){
		$('#mdlxfake').trigger('click');
	});
	$('#sureII').click(function(){
		$('#mdlxfake').trigger('click');
	});
	$('#mdlxfake').click(function(){
		$('#mdlx').trigger('click');
		$('#gttj').hide();
		$('#sureII').hide();
		$('#sure').show();
		
	});
	$('#gttj').click(function(){
		$("#updt").trigger('click');
		
	});
	$("#updt").click(function(){
			
		
		

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
//		var f_std_statid=$('select[name=f_std_statid]');
		var rslt=$('#rslt');
		var ifrcmd=$('select[name=ifrcmd]');
		var stdrcmdnm=$('input[name=stdrcmdnm]');
		var stdrcmdcp=$('input[name=stdrcmdcp]');
		var stdrlta=$('input[name=stdrlta]');
		var stdrltanm=$('input[name=stdrltanm]');
		var stdrltaocpt=$('input[name=stdrltaocpt]');
		var stdrltacp=$('input[name=stdrltacp]');
		
		//给原来的判断占位置
		
		
		
		var prmts=$("#updt").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				if(data.status==1){
					rslt.html('该身份证已经注册过，请联系管理员！');
					$('#gttj').hide();
					$('#sureII').hide();
					$('#sure').show();
					$('#myModal').modal({
		    	    	  //keyboard: false
		    	    })
				}else if(data.status==2){
					window.location.href=data.tzurl;
				}else if(data.status==3){
					rslt.html('报名失败！');
					$('#gttj').hide();
					$('#sureII').hide();
					$('#sure').show();
					$('#myModal').modal({
		    	    	  //keyboard: false
		    	    })
				}else if(data.status==4){
					rslt.html('身份证号码和出生日期不符合，请以身份证号码为准！');
					$('#gttj').hide();
					$('#sureII').hide();
					$('#sure').show();
					$('#myModal').modal({
		    	    	  //keyboard: false
		    	    })
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
	
	$("#std_logininIdx").click(function(){
		var stdnm=$('input[name=stdnm]');
		var stdidcd=$('input[name=stdidcd]');
		
//		var rmb=$('#rmb');
//		if(rmb.is(":checked")==true){
//			$('input[name=rmb]').val('y');
//		}else{
//			$('input[name=rmb]').val('n');
//		}
		
		//防止输入空
		if($.trim(stdnm.val())==''){
			alert('用户名不能为空！');
			stdnm.focus();
			return false;
		}
		if($.trim(stdidcd.val())==''){
			alert('身份证号码不能为空！');
			stdidcd.focus();
			return false;
		}
		if($.trim(stdidcd.val()).length!=18){
			alert('身份证号码必须为18位！');
			stdidcd.focus();
			return false;
		}
		
		var prmts=$("#std_logininIdx").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					$('#errCtn').html("<div class='alert alert-warning alert-dismissible'>" +
							"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
							"<strong>学生姓名不正确</strong>" +
							"</div>");
				}else if(data.status==2){
					$('#errCtn').html("<div class='alert alert-warning alert-dismissible'>" +
							"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
							"<strong>身份证号码不正确</strong>" +
							"</div>");
				}else if(data.status==3){
					
					window.location=app_path;
				}
			
			
			},
			'json'
		);
		
		
	})


});

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