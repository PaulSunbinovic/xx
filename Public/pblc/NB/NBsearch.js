//三部分，一部分是NBsearch.js 一部分是NB中的Action  一部分是页面中的嵌入js
//query里面必须1,NB上面部分2.NBtb 3class设置好 4导入js
//阉割的话 只需要把 query页面中的 NB部分 去掉即可
$(function () {
	
	
	
	$("#NBsrcU").click(function(){
		var NBfld='-';
		var NBfldu=$('#flddv').find('input');
		for(var i=0;i<NBfldu.size();i++){
			if(NBfldu[i].checked==true){
				NBfld=NBfld+NBfldu[i].value+'-';
			}
		}
		$('input[name=fld]').val(NBfld);
		var NBcdt='-sp-';
		var NBcdtiptu=$('#cdtdv').find('input');
		for(var i=0;i<NBcdtiptu.size();i++){
			if($.trim(NBcdtiptu[i].value)!=''){
				NBcdt=NBcdt+NBcdtiptu[i].name+'-lk-'+NBcdtiptu[i].value+'-sp-';
			}
		}
		var NBcdtslctu=$('#cdtdv').find('select');
		for(var i=0;i<NBcdtslctu.size();i++){
			if($.trim(NBcdtslctu[i].value)!=''){
				NBcdt=NBcdt+NBcdtslctu[i].name+'-eq-'+NBcdtslctu[i].value+'-sp-';
			}
		}
		$('input[name=cdt]').val(NBcdt);
		var NBspccdt='-sp-';
		var NBspccdtu=$('#spccdtdv').find('.spccdton');
		for(var i=0;i<NBspccdtu.size();i++){
			NBspccdt=NBspccdt+$(NBspccdtu[i]).attr('rel')+'-sp-';
		}
		NBspccdt=NBspccdt.replace(/%/gm,'-pct-').replace(/</gm,'-ls-').replace(/>/gm,'-mr-').replace(/ /gm,'-kb-');
		$('input[name=spccdt]').val(NBspccdt);
		var NBodr='-';
		var NBodru=$('#odrdv').find('select');
		for(var i=0;i<NBodru.size();i++){
			if(NBodru[i].value!=''){
				NBodr=NBodr+NBodru[i].value+'-';
			}
		}
		$('input[name=odr]').val(NBodr);
		//尝试把post改成get形式传送，防止，以后问是否重新提交这么尴尬
		var url=hdlNB+'/fld/'+NBfld+'/cdt/'+NBcdt+'/spccdt/'+NBspccdt+'/odr/'+NBodr+'/lmt/'+$('select[name=lmt]').val();
		window.location=url;

	})
	
	$("#NBsrcM").click(function(){
		
		//尝试把post改成get形式传送，防止，以后问是否重新提交这么尴尬
		//因为有百分号就不正常，所以要加密-pct-
		var url=hdlNB+'/NBsqlstc/'+$('#NBsqlstc').val().replace(/%/gm,'-pct-').replace(/</gm,'-ls-').replace(/>/gm,'-mr-').replace(/ /gm,'-kb-');//'/'表示全部都要该，否则就改第一个
		window.location=url;

	})
	
	var fldu=fld.split('-');
	for(var i=1;i<fldu.length-1;i++){
		$('#'+fldu[i]+'fld').attr("checked",'checked');
	}


	var cdtu=cdt.split('-sp-');
	for(var i=1;i<cdtu.length-1;i++){
		if(cdtu[i].indexOf('-lk-')!=-1){
			$('#'+cdtu[i].split('-lk-')[0]+'cdt').val(cdtu[i].split('-lk-')[1]);
		}else if(cdtu[i].indexOf('-eq-')!=-1){
			$('#'+cdtu[i].split('-eq-')[0]+'cdt').val(cdtu[i].split('-eq-')[1]);
		}
	}

	$('#spccdtdv a').each(function(){
		var spccdtu=spccdt.split('-sp-');
		for(var i=0;i<spccdtu.length;i++){
			if(spccdtu[i]==$(this).attr('rel')){
				$(this).attr('class','spccdton');
			}
		}
		
	})
	
	
	var odru=odr.split('-');
	var slctu=$('#odrdv').find('select');
	var osmin=0;
	if(odru.length-2>slctu.length){osmin=slctu.length;}else{osmin=odru.length-2;}
	for(var i=0;i<osmin;i++){
		$(slctu[i]).val(odru[i+1]);
	}
	$('#NBtb').find('th').hide();
	$('#NBtb').find('td').hide();
	for(var i=1;i<fldu.length-1;i++){
		$('.'+fldu[i]).show();
	}
	$('.odr').show();
	$('.oprt').show();
	//尝试把post改成get形式传送，防止，以后问是否重新提交这么尴尬
	

	
	$('#spccdtdv a').click(function(){
		if($(this).attr('class')=='spccdtoff'){
			$(this).attr('class','spccdton');
		}else{
			$(this).attr('class','spccdtoff');
		}
		
	})
	
	
	
	
});



