//tb部分

window.onload=function(){
	//如果没有NBtb的话就不用加载下面这些了
	if($('#NBtb').length>0){
		//创建
		var cyg=$($('#NBtb').find('thead')[0]).html();//撑衣杆
		cyg = cyg.replace(/<tr/gm,"<tr id='cyg'");
		cyg = cyg.replace(/<th/gm,'<td');
		cyg = cyg.replace(/th>/gm,'td>');
		$($('#NBtb').find('tbody')[0]).prepend(cyg);
		$('#cyg').show();
		var tdu=$($('#NBtb tbody').find('tr')[0]).find('td:visible');
		var thu=$('#NBtb thead').find('th:visible');
		var arr={};
		for(var i=0;i<thu.size();i++){
			arr[i]=$(tdu[i]).width();
		}
		for(var i=0;i<thu.size();i++){
			$(thu[i]).width(arr[i]);
		}
		$('#cyg').hide();
	}
}


$.fn.smartFloat = function() {
	var position = function(element) {
		var top = element.position().top, pos = element.css("position");
		$(window).scroll(function() {
			var scrolls = $(this).scrollTop();
			if (scrolls > top) {
				if (window.XMLHttpRequest) {
					element.css({
						position: "fixed",
						top: 0
					});	
				} else {
					element.css({
						top: scrolls
					});	
				}
			}else {
				element.css({
					position: pos,
					top: top
				});	
			}
		});
	};
	return $(this).each(function() {
		position($(this));						 
	});
};

//tb专用//第一步最重要就是定位
$.fn.smartFloatTB = function() {
	var position = function(element) {
		var top = element.position().top, pos = element.css("position");
		$(window).scroll(function() {
			var scrolls = $(this).scrollTop()+$('#divhd').height();//定位在divhd下头
			if ($(window).width()>600&&scrolls > $('#NBtb').offset().top&&scrolls<$('#NBtb').offset().top+$('#NBtb').height()) {//且在可视范围内//屏幕太小表格不会很大而且触发了responsive，所以不执行
				if (window.XMLHttpRequest) {
					$('#cyg').show();
					
					
					element.css({
						position: "fixed",
						top: $('#divhd').height()
					});	
				} else {
					
					element.css({
						position: pos,
						top: scrolls
					});	
				}
			}else {
				$('#cyg').hide();
				element.css({
					position: pos,
					top: top
				});	
			}
		});
	};
	return $(this).each(function() {
		position($(this));						 
	});
};

//share专用
$.fn.smartFloatSR = function() {
	var position = function(element) {
		var top = element.position().top, pos = element.css("position");
		$(window).scroll(function() {
			var scrolls = $(this).scrollTop()+$(window).height();//定位在低点
			if ($(window).width()>600&&scrolls > 200&&scrolls<=($('#zld').offset().top+element.outerHeight())) {//且在可视范围内//屏幕太小表格不会很大而且触发了responsive，所以不执行
				if (window.XMLHttpRequest) {
					
					element.css({
						
						position: "fixed",
						top: $(window).height()-$('.share-group').height()-30
					});	
				} else {
					
					element.css({
						position: pos,
						top: scrolls
					});	
				}
			}else {
				//alert(scrolls);
				
				element.css({
					position: pos,
					top: top
				});	
			}
		});
	};
	return $(this).each(function() {
		position($(this));						 
	});
};

function updown(id){
	var xbd=$('#'+id+'bd');
	var x=$('#'+id);
	if(xbd.css('display')=='none'){
		xbd.show(200);
		x.attr('class','glyphicon glyphicon-triangle-top');
	}else{
		xbd.hide(200);
		x.attr('class','glyphicon glyphicon-triangle-bottom');
	}
	prmts={btnnm:id,btnvl:x.attr('class')};
	$.post(
		hdlstdbtn,
		prmts,
		function(data){
			
			if(data.status==1){
				
			}else if(data.status==2){
				
			}
		
		
		},
		'json'
	);
}
function leftright(){
	
	var lft=$('#lft');
	var rgt=$('#rgt');
	var btnlft=$('#stdbtn-lft');
	if(lft.css('display')=='block'){
		
		lft.hide();
		rgt.attr('class','col-md-12');
		btnlft.show();
	}else{
		lft.show();
		rgt.attr('class','col-md-10');
		btnlft.hide();
	}
	//重新计算下撑衣杆
	if($('#NBtb').length>0){
		//创建
		var cyg=$($('#NBtb').find('thead')[0]).html();//撑衣杆
		cyg = cyg.replace(/<tr/gm,"<tr id='cyg'");
		cyg = cyg.replace(/<th/gm,'<td');
		cyg = cyg.replace(/th>/gm,'td>');
		$($('#NBtb').find('tbody')[0]).prepend(cyg);
		$('#cyg').show();
		var tdu=$($('#NBtb tbody').find('tr')[0]).find('td:visible');
		var thu=$('#NBtb thead').find('th:visible');
		var arr={};
		for(var i=0;i<thu.size();i++){
			arr[i]=$(tdu[i]).width();
		}
		for(var i=0;i<thu.size();i++){
			$(thu[i]).width(arr[i]);
		}
		$('#cyg').hide();
	}
	
	//文章下面的吐槽栏
	$(".share-group").width($('#rgt').width()-30);
//	if($('#myAffix').length>0){
//		$('#myAffix').width($('#rgt').width()-40);//因为有padding
//		$('#myAffix').css('background-color','#fff');
//		$('#myAffix').affix({
//		  offset: {
//		    top: 200,//数字自定义
//		    bottom: function () {
//		    	$('#myAffix').css('top',$(window).height()-$('#myAffix').height()-40);//自定义//最后一个减多少是个补差，具体是一次次实验出来的--!//一开始下来时的高度
//		        return (this.bottom = $(scroll).height()-$('#myAffix').offset().top-$('#myAffix').height())//哪儿松开算哪儿了
//		    	//注意这里被return了，那么所有之后的初始化都没的搞，特别是$(function(){alert();})//所以有初始化的就往前面放
//		    }
//		  }
//		})
//	}
	prmts={btnnm:'lft',btnvl:lft.css('display')};
	$.post(
		hdlstdbtn,
		prmts,
		function(data){
			
			if(data.status==1){
				
			}else if(data.status==2){
				
			}
		
		
		},
		'json'
	);
}