$(document).ready(function(){  
	$('#loading').hide();
	
	var dvpd="<div id='pdldmr' style='text-align:center;'>下拉加载更多...</div>";
	
    var range = 250;             //距下边界长度/单位px  
    var elemt = 500;           //插入元素高度/单位px  
    //var maxnum = 20;            //设置加载最多次数  
    //var num = 1;  
    var totalheight = 0;   
    var main = $("#cmtarea");                     //主体元素  
    
    if($('#hsnxt').val()=='y'){
		main.append(dvpd);
	}
    
    $(window).scroll(function(){
        var srollPos = $(window).scrollTop();    //滚动条距顶部距离(页面超出窗口的高度)  
          
        //console.log("滚动条到顶部的垂直高度: "+$(document).scrollTop());  
        //console.log("页面的文档高度 ："+$(document).height());  
        //console.log('浏览器的高度：'+$(window).height());  
          
        totalheight = parseFloat($(window).height()) + parseFloat(srollPos); 
        ///alert(($(document).height()-range)+' , '+totalheight+' , '+$('#hsnxt').val()+' , '+$('#pg').val());
        if($('#hsnxt').val()=='y'&&($(document).height()-range) <= totalheight&&$('#executing').val()=='n') {
        	//由于手抖或者神马客观原因，导致，鼠标下拉的时候连续的触动此函数，所以，需要用一个参数让其第一次执行
        	//的过程中不执行其他由于手抖造成的误操作
        	$('#pdldmr').remove();
        	
        	$('#executing').val('y');
        	
        	$('#loading').show();
        	setTimeout(function () {

        		$.post(
                		hdlpldnld,
            			{pg:$('#pg').val()},
            			function(data){
            				$('#loading').hide();
            				if(data.status==1){
            					$('#pg').val(data.pg);
            					$('#hsnxt').val(data.hsnxt);
            					main.append(data.htmltxt);
            					if($('#hsnxt').val()=='y'){
        							main.append(dvpd);
        						}
            					$('#executing').val('n');
            					
            				}
            			
            			
            			},
            			'json'
            		);

            }, 2000);
        	
        	
        	

            
        }  
    });  
});  