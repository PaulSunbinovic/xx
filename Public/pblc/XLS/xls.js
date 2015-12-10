
$(function () {
	
	
	
	$("#export").click(function(){
		var XLSfld='-';
		var XLSfldu=$('#flddv').find('input');
		for(var i=0;i<XLSfldu.size();i++){
			if(XLSfldu[i].checked==true){
				XLSfld=XLSfld+XLSfldu[i].value+'-';
			}
		}
		$('input[name=fld]').val(XLSfld);
		var XLScdt='-sp-';
		var XLScdtiptu=$('#cdtdv').find('input');
		for(var i=0;i<XLScdtiptu.size();i++){
			if($.trim(XLScdtiptu[i].value)!=''){
				XLScdt=XLScdt+XLScdtiptu[i].name+'-lk-'+XLScdtiptu[i].value+'-sp-';
			}
		}
		var XLScdtslctu=$('#cdtdv').find('select');
		for(var i=0;i<XLScdtslctu.size();i++){
			if($.trim(XLScdtslctu[i].value)!=''){
				XLScdt=XLScdt+XLScdtslctu[i].name+'-eq-'+XLScdtslctu[i].value+'-sp-';
			}
		}
		$('input[name=cdt]').val(XLScdt);
		var XLSspccdt='-sp-';
		var XLSspccdtu=$('#spccdtdv').find('.spccdton');
		for(var i=0;i<XLSspccdtu.size();i++){
			XLSspccdt=XLSspccdt+$(XLSspccdtu[i]).attr('rel')+'-sp-';
		}
		$('input[name=spccdt]').val(XLSspccdt);
		var XLSodr='-';
		var XLSodru=$('#odrdv').find('select');
		for(var i=0;i<XLSodru.size();i++){
			if(XLSodru[i].value!=''){
				XLSodr=XLSodr+XLSodru[i].value+'-';
			}
		}
		$('input[name=odr]').val(XLSodr);
		$('#exporttrue').trigger('click');
	})
	
	$("#exportbjcj").click(function(){
		$('input[name=biaoji]').val('cj');
		
		$('input[name=fld]').val('-cjzxid-stdno-stdnm-sexnm-cjzxzf-cjzxqmf-cjzxpsf-cjzxxtf-bxxsnm-mjnm-clsnm-kcnm-xqnm-');
		var XLScdt='-sp-';
		var XLScdtiptu=$('#cdtdv').find('input');
		for(var i=0;i<XLScdtiptu.size();i++){
			if($.trim(XLScdtiptu[i].value)!=''){
				XLScdt=XLScdt+XLScdtiptu[i].name+'-lk-'+XLScdtiptu[i].value+'-sp-';
			}
		}
		var XLScdtslctu=$('#cdtdv').find('select');
		for(var i=0;i<XLScdtslctu.size();i++){
			if($.trim(XLScdtslctu[i].value)!=''){
				XLScdt=XLScdt+XLScdtslctu[i].name+'-eq-'+XLScdtslctu[i].value+'-sp-';
			}
		}
		$('input[name=cdt]').val(XLScdt);
		var XLSspccdt='-sp-';
		var XLSspccdtu=$('#spccdtdv').find('.spccdton');
		for(var i=0;i<XLSspccdtu.size();i++){
			XLSspccdt=XLSspccdt+$(XLSspccdtu[i]).attr('rel')+'-sp-';
		}
		$('input[name=spccdt]').val(XLSspccdt);
		var XLSodr='-';
		var XLSodru=$('#odrdv').find('select');
		for(var i=0;i<XLSodru.size();i++){
			if(XLSodru[i].value!=''){
				XLSodr=XLSodr+XLSodru[i].value+'-';
			}
		}
		$('input[name=odr]').val(XLSodr);
		$('#exporttrue').trigger('click');
	})

	$("#exportbjbkcj").click(function(){
		$('input[name=biaoji]').val('bkcj');
		
		$('input[name=fld]').val('-cjzxid-stdno-stdnm-sexnm-cjzxbkf-bxxsnm-mjnm-clsnm-kcnm-xqnm-');
		var XLScdt='-sp-';
		var XLScdtiptu=$('#cdtdv').find('input');
		for(var i=0;i<XLScdtiptu.size();i++){
			if($.trim(XLScdtiptu[i].value)!=''){
				XLScdt=XLScdt+XLScdtiptu[i].name+'-lk-'+XLScdtiptu[i].value+'-sp-';
			}
		}
		var XLScdtslctu=$('#cdtdv').find('select');
		for(var i=0;i<XLScdtslctu.size();i++){
			if($.trim(XLScdtslctu[i].value)!=''){
				XLScdt=XLScdt+XLScdtslctu[i].name+'-eq-'+XLScdtslctu[i].value+'-sp-';
			}
		}
		$('input[name=cdt]').val(XLScdt);
		var XLSspccdt='-sp-';
		var XLSspccdtu=$('#spccdtdv').find('.spccdton');
		for(var i=0;i<XLSspccdtu.size();i++){
			XLSspccdt=XLSspccdt+$(XLSspccdtu[i]).attr('rel')+'-sp-';
		}
		$('input[name=spccdt]').val(XLSspccdt);
		var XLSodr='-';
		var XLSodru=$('#odrdv').find('select');
		for(var i=0;i<XLSodru.size();i++){
			if(XLSodru[i].value!=''){
				XLSodr=XLSodr+XLSodru[i].value+'-';
			}
		}
		$('input[name=odr]').val(XLSodr);
		$('#exporttrue').trigger('click');
	})
	
	$("#exportbjqd").click(function(){
		$('input[name=biaoji]').val('qd');
		$('input[name=fld]').val('-cjzxid-stdno-stdnm-sexnm-cjzxzf-cjzxqmf-cjzxpsf-cjzxxtf-bxxsnm-mjnm-clsnm-kcnm-xqnm-');
		var XLScdt='-sp-';
		var XLScdtiptu=$('#cdtdv').find('input');
		for(var i=0;i<XLScdtiptu.size();i++){
			if($.trim(XLScdtiptu[i].value)!=''){
				XLScdt=XLScdt+XLScdtiptu[i].name+'-lk-'+XLScdtiptu[i].value+'-sp-';
			}
		}
		var XLScdtslctu=$('#cdtdv').find('select');
		for(var i=0;i<XLScdtslctu.size();i++){
			if($.trim(XLScdtslctu[i].value)!=''){
				XLScdt=XLScdt+XLScdtslctu[i].name+'-eq-'+XLScdtslctu[i].value+'-sp-';
			}
		}
		$('input[name=cdt]').val(XLScdt);
		var XLSspccdt='-sp-';
		var XLSspccdtu=$('#spccdtdv').find('.spccdton');
		for(var i=0;i<XLSspccdtu.size();i++){
			XLSspccdt=XLSspccdt+$(XLSspccdtu[i]).attr('rel')+'-sp-';
		}
		$('input[name=spccdt]').val(XLSspccdt);
		var XLSodr='-';
		var XLSodru=$('#odrdv').find('select');
		for(var i=0;i<XLSodru.size();i++){
			if(XLSodru[i].value!=''){
				XLSodr=XLSodr+XLSodru[i].value+'-';
			}
		}
		$('input[name=odr]').val(XLSodr);
		$('#exporttrue').trigger('click');
	})

	$("#exportbjbkqd").click(function(){
		$('input[name=biaoji]').val('bkqd');
		$('input[name=fld]').val('-cjzxid-stdno-stdnm-sexnm-cjzxzf-cjzxqmf-cjzxpsf-cjzxxtf-bxxsnm-mjnm-clsnm-kcnm-xqnm-');
		var XLScdt='-sp-';
		var XLScdtiptu=$('#cdtdv').find('input');
		for(var i=0;i<XLScdtiptu.size();i++){
			if($.trim(XLScdtiptu[i].value)!=''){
				XLScdt=XLScdt+XLScdtiptu[i].name+'-lk-'+XLScdtiptu[i].value+'-sp-';
			}
		}
		var XLScdtslctu=$('#cdtdv').find('select');
		for(var i=0;i<XLScdtslctu.size();i++){
			if($.trim(XLScdtslctu[i].value)!=''){
				XLScdt=XLScdt+XLScdtslctu[i].name+'-eq-'+XLScdtslctu[i].value+'-sp-';
			}
		}
		$('input[name=cdt]').val(XLScdt);
		var XLSspccdt='-sp-';
		var XLSspccdtu=$('#spccdtdv').find('.spccdton');
		for(var i=0;i<XLSspccdtu.size();i++){
			XLSspccdt=XLSspccdt+$(XLSspccdtu[i]).attr('rel')+'-sp-';
		}
		$('input[name=spccdt]').val(XLSspccdt);
		var XLSodr='-';
		var XLSodru=$('#odrdv').find('select');
		for(var i=0;i<XLSodru.size();i++){
			if(XLSodru[i].value!=''){
				XLSodr=XLSodr+XLSodru[i].value+'-';
			}
		}
		$('input[name=odr]').val(XLSodr);
		$('#exporttrue').trigger('click');
	})
	
	$("#exportbjkb").click(function(){
		$('input[name=biaoji]').val('kb');
		$('input[name=fld]').val('-cjzxid-stdno-stdnm-sexnm-cjzxzf-cjzxqmf-cjzxpsf-cjzxxtf-bxxsnm-mjnm-clsnm-kcnm-xqnm-');
		var XLScdt='-sp-';
		var XLScdtiptu=$('#cdtdv').find('input');
		for(var i=0;i<XLScdtiptu.size();i++){
			if($.trim(XLScdtiptu[i].value)!=''){
				XLScdt=XLScdt+XLScdtiptu[i].name+'-lk-'+XLScdtiptu[i].value+'-sp-';
			}
		}
		var XLScdtslctu=$('#cdtdv').find('select');
		for(var i=0;i<XLScdtslctu.size();i++){
			if($.trim(XLScdtslctu[i].value)!=''){
				XLScdt=XLScdt+XLScdtslctu[i].name+'-eq-'+XLScdtslctu[i].value+'-sp-';
			}
		}
		$('input[name=cdt]').val(XLScdt);
		var XLSspccdt='-sp-';
		var XLSspccdtu=$('#spccdtdv').find('.spccdton');
		for(var i=0;i<XLSspccdtu.size();i++){
			XLSspccdt=XLSspccdt+$(XLSspccdtu[i]).attr('rel')+'-sp-';
		}
		$('input[name=spccdt]').val(XLSspccdt);
		var XLSodr='-';
		var XLSodru=$('#odrdv').find('select');
		for(var i=0;i<XLSodru.size();i++){
			if(XLSodru[i].value!=''){
				XLSodr=XLSodr+XLSodru[i].value+'-';
			}
		}
		$('input[name=odr]').val(XLSodr);
		$('#exporttrue').trigger('click');
	})

	$("#exportbjbkkb").click(function(){
		$('input[name=biaoji]').val('bkkb');
		$('input[name=fld]').val('-cjzxid-stdno-stdnm-sexnm-cjzxzf-cjzxqmf-cjzxpsf-cjzxxtf-bxxsnm-mjnm-clsnm-kcnm-xqnm-');
		var XLScdt='-sp-';
		var XLScdtiptu=$('#cdtdv').find('input');
		for(var i=0;i<XLScdtiptu.size();i++){
			if($.trim(XLScdtiptu[i].value)!=''){
				XLScdt=XLScdt+XLScdtiptu[i].name+'-lk-'+XLScdtiptu[i].value+'-sp-';
			}
		}
		var XLScdtslctu=$('#cdtdv').find('select');
		for(var i=0;i<XLScdtslctu.size();i++){
			if($.trim(XLScdtslctu[i].value)!=''){
				XLScdt=XLScdt+XLScdtslctu[i].name+'-eq-'+XLScdtslctu[i].value+'-sp-';
			}
		}
		$('input[name=cdt]').val(XLScdt);
		var XLSspccdt='-sp-';
		var XLSspccdtu=$('#spccdtdv').find('.spccdton');
		for(var i=0;i<XLSspccdtu.size();i++){
			XLSspccdt=XLSspccdt+$(XLSspccdtu[i]).attr('rel')+'-sp-';
		}
		$('input[name=spccdt]').val(XLSspccdt);
		var XLSodr='-';
		var XLSodru=$('#odrdv').find('select');
		for(var i=0;i<XLSodru.size();i++){
			if(XLSodru[i].value!=''){
				XLSodr=XLSodr+XLSodru[i].value+'-';
			}
		}
		$('input[name=odr]').val(XLSodr);
		$('#exporttrue').trigger('click');
	})
	
	
});



