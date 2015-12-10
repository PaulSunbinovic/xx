
$(function () {
	
	$("#netpic").keyup(function(){
		
		$('#atccvdip').attr('src',$("#netpic").val());
		$('#pt').attr('src',$("#netpic").val());
	})
	
	
	
	
	
	//------------------------接下来是通用部分
	$("#updt").click(function(){
		var f_atc_bdid=$('select[name=f_atc_bdid]');
		var atctpc=$('input[name=atctpc]');
		var atcath=$('input[name=atcath]');
		var atcaddtm=$('input[name=atcaddtm]');
		var atcmdftm=$('input[name=atcmdftm]');
		var atcctt=$('textarea[name=atcctt]');
		var atccnt=$('input[name=atccnt]');
		//
		if(f_atc_bdid.val()==0){
			alert('请选择板块！');
			return false;
		}
		if($.trim(atctpc.val())==''){
			alert('标题不能为空！');
			return false;
		}
		if($.trim(atcath.val())==''){
			alert('作者不能为空！');
			return false;
		}
		if($.trim(atcaddtm.val())==''){
			alert('添加时间不能为空！');
			return false;
		}
		if($.trim(atcmdftm.val())==''){
			alert('修改时间不能为空！');
			return false;
		}
		
		var ex = /^\d+$/;
		if (ex.test(atccnt.val())) {
		   // 则为整数
		} else{
			alert('浏览计数必须是整数！');
			return false;
		}
		
		atcctt.val(editor.getContent());
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
	
	$("#st").click(function(){
		
		var prmts=$("#st").parent().serialize();//parameters
		//防止既输入空又输入了有效值
		prmts=rmvblk(prmts);
		

		$.post(
			hdlurl,
			prmts,
			function(data){
				
				if(data.status==1){
					alert('设置成功');
				}else if(data.status==2){
					alert('设置失败');
				}
			
			
			},
			'json'
		);
	})
	
});

function stvw(atcid,atcvw){
	
	$.post(
		hdlstvw,
		{atcid:atcid,atcvw:atcvw},
		function(data){
			
			if(data.status==1){
				alert('设置成功');
				window.location.reload();
			}else if(data.status==2){
				alert('设置失败');
			}
		
		
		},
		'json'
	);
	
}

function stps(atcid,atcps){
	
	$.post(
		hdlstps,
		{atcid:atcid,atcps:atcps},
		function(data){
			
			if(data.status==1){
				alert('设置成功');
				window.location.reload();
			}else if(data.status==2){
				alert('设置失败');
			}
		
		
		},
		'json'
	);
	
}

function stzs(atcid,atczs){
	
	$.post(
		hdlstzs,
		{atcid:atcid,atczs:atczs},
		function(data){
			
			if(data.status==1){
				alert('设置成功');
				window.location.reload();
			}else if(data.status==2){
				alert('设置失败');
			}
		
		
		},
		'json'
	);
	
}

function zn(atcid){
	
	$.post(
		hdlzn,
		{atcid:atcid},
		function(data){
			
			if(data.status==1){
				$('#zn').html(data.atczn);
			}else if(data.status==2){
				alert('你已经赞过了，1小时内不能再赞');
			}else if(data.status==3){
				alert('登录后方可点赞');
			}
		
		
		},
		'json'
	);
	
}

function tc(atcid){
	
	$.post(
		hdltc,
		{atcid:atcid},
		function(data){
			
			if(data.status==1){
				$('#tc').html(data.atctc);
			}else if(data.status==2){
				alert('你已经吐槽过了，1小时内不能再吐槽');
			}else if(data.status==3){
				alert('登录后方可吐槽');
			}
		
		
		},
		'json'
	);
	
}

function clct(atcid){
	
	$.post(
		hdlclct,
		{atcid:atcid},
		function(data){
			
			if(data.status==1){
				alert('取消成功');
				$('#schzysc').html('收藏本文：');
				$('#clctdv').attr('class','pull-left collecting');
				$('#clcta').attr('class','share hearting');
			}else if(data.status==2){
				alert('收藏成功');
				$('#schzysc').html('已收藏：');
				$('#clctdv').attr('class','pull-left collected');
				$('#clcta').attr('class','share hearted');
			}else if(data.status==3){
				alert('登录后方可收藏');
			}
		
		
		},
		'json'
	);
	
}


function cmt(atcid){
	
	$.post(
		hdlcmt,
		{atcid:atcid,cmtctt:$.trim($('#cmtctt').val())},
		function(data){
			
			if(data.status==1){
				cmtcnt=cmtcnt+1;
				$('#vwcmt').html("查看所有评论（"+cmtcnt+"）");
				$('#cmtarea').prepend(data.str);
				alert('评论成功');
				
			}else if(data.status==2){
				alert('登录后方可评论');
			}
		
		
		},
		'json'
	);
	
}


function cmtzn(cmtid){
	
	$.post(
		hdlcmtzn,
		{cmtid:cmtid},
		function(data){
			
			if(data.status==1){
				$('#cmtzn'+cmtid).html("<i class='glyphicon glyphicon-thumbs-up' ></i>"+data.cmtzn);
			}else if(data.status==2){
				alert('你已经赞过了，1小时内不能再赞');
			}else if(data.status==3){
				alert('登录后方可点赞');
			}
		
		
		},
		'json'
	);
	
}

function cmttc(cmtid){
	
	$.post(
		hdlcmttc,
		{cmtid:cmtid},
		function(data){
			
			if(data.status==1){
				$('#cmttc'+cmtid).html("<i class='glyphicon glyphicon-thumbs-down' ></i>"+data.cmttc);
			}else if(data.status==2){
				alert('你已经吐槽过了，1小时内不能再吐槽');
			}else if(data.status==3){
				alert('登录后方可吐槽');
			}
		
		
		},
		'json'
	);
	
}

function dlt(atcid){
	
	if(confirm("确定要删除此条记录？")){
		$.post(
			hdldlt,
			{atcid:atcid},
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
var prmts='';var str='';var ch='';
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



