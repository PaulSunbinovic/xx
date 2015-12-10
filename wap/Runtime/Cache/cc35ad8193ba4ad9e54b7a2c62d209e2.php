<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit">
<!-- 避免IE使用兼容模式 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo ($title); ?></title>
<script src="__PUBLIC__/pblc/btstp3/js/jquery.js"></script>
<script src="__PUBLIC__/pblc/btstp3/js/jquery-migrate-1.1.0.min.js"></script>
<script type='text/javascript' src='__PUBLIC__/JS/wap/cm.js'></script>
<link href="__PUBLIC__/CSS/wap/cm.css" rel="stylesheet">
<!-- 移动设备 -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<!-- bootstrap -->
<link href="__PUBLIC__/pblc/btstp3/css/bootstrap.css" rel="stylesheet">
<link href="data:text/css;charset=utf-8," data-href="__PUBLIC__/pblc/btstp3/css/bootstrap-theme.min.css" rel="stylesheet">
<link href="__PUBLIC__/pblc/btstp3/css/patch.css" rel="stylesheet">
<link href="__PUBLIC__/pblc/btstp3/css/docs.css" rel="stylesheet">
<script src="__PUBLIC__/pblc/btstp3/js/ie-emulation-modes-warning.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- Favicons -->
<link rel="apple-touch-icon" href="__PUBLIC__/ICON/apple-touch-icon.png">
<link rel="icon" href="__PUBLIC__/ICON/favicon.ico">

<script type='text/javascript' src='__PUBLIC__/JS/wap/cstmusr.js'></script>
<script type='text/javascript' src='__PUBLIC__/JS/wap/atc.js'></script>
<link rel="stylesheet" href="__PUBLIC__/CSS/wap/atc.css"/>
<script type='text/javascript'>
var app_path='__APP__';
</script>



<link type="text/css" rel="stylesheet" href="__PUBLIC__/CSS/wap/demo.css" />

<!--必要样式-->
<link type="text/css" rel="stylesheet" href="__PUBLIC__/CSS/wap/jquery.mmenu.css" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/CSS/wap/jquery.mmenu.dragopen.css" />


<script type="text/javascript" src="__PUBLIC__/JS/wap/jquery.mmenu.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/JS/wap/jquery.mmenu.dragopen.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/JS/wap/jquery.mmenu.fixedelements.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/JS/wap/mn.js"></script>
</head>
<body>
<div id="page">
	<!-- head包cstmusr.js -->

<div class="header FixedTop" id='header'>
	<a href='#menu' id='menu'></a>
	<?php echo ($cprtnm); ?>
	<a id='home' href='__APP__'><i class='glyphicon glyphicon-home' style='font-size:20px;top:5px'></i></a>
</div>
	<div class="content" id="content">
		<script type="text/javascript" src="__PUBLIC__/JS/wap/iscroll.js"></script>
		<link rel="stylesheet" href="__PUBLIC__/CSS/wap/iscroll.css"/>
		<div style='height:40px;' id='zld' >
		<div class="plist" id="plist" style='z-index:1000;background-color:#337AB7' >
			<ul class="bul" style='left:-40px'>
				<li class="bull">
					
					<div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
				      <?php if(is_array($bdlsxd)): $i = 0; $__LIST__ = $bdlsxd;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="__APP__/Atc/query/bdid/<?php echo ($vo['bdid']); ?>" class="btn btn-primary <?php echo ($vo['actvcls']); ?>" role="button" style='width:100px'><?php echo ($vo['bdnm']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
				     
				    </div>
					
				</li>
				
			</ul>
		</div>
		</div>
		<script type="text/javascript">
		var phoneScroll;
		function liresize(){
			var w = $(".plist").width();
			$(".bull").width(w);
			//phoneScroll.refresh();//启动的话会滑动后回到左边顶部
		}
		$(function(){
			phoneScroll = new iScroll("plist",{
					snap: true,
					momentum: false,
					vScroll:false,
					hScroll:true,
					hScrollbar:false,
				});
			$(window).load(function(e) {
				liresize();
		    });
			
			$(window).resize(function(e) {
		        liresize();
		    });
			
		});
		
		</script>
		<script type="text/javascript">$("#plist").smartFloatBD();</script>
		
		<script type="text/javascript">var hdlclct='__URL__/clct';var hdlzn='__URL__/zan';var hdltc='__URL__/tucao'</script>
				
		<ol class="breadcrumb">
        <li><a href="#">首页</a> </li>
        <?php echo ($brd); ?>
        </ol>
        
        <div class='detail'>
					<h4><?php echo ($mo['atctpc']); ?></h4>
					<div class="intro"><?php echo ($mo['atcsmr']); ?></div>
					<div class="info">
                    
                   		 <div class="tag pull-right">
	                        <span><?php echo ($mo['atcath']); ?></span>
	                        <span><?php echo ($mo['atcmdftm']); ?></span>
	                        <span><i class="glyphicon glyphicon-eye-open"></i> <?php echo ($mo['atccnt']); ?></span>
	                    </div>
	                </div>
					<div class='clearfix'></div>
					<hr style='margin-top:0px'></hr>
					<div class='front-cover'><img style='width:100%' src="<?php echo ($mo['atccv']); ?>"  data-src="holder.js/300x200" alt="<?php echo ($alt); ?>" class='img-rounded'/></div>
					
					
					<link rel="stylesheet" href="__PUBLIC__/pblc/baguetteboxforwap/baguettebox.min.css">
					<script src="__PUBLIC__/pblc/baguetteboxforwap/baguettebox.min.js"></script>
					<div class="baguetteBoxOne gallery">
					<?php echo ($mo['atcctt']); ?>
					</div>
					<script type="text/javascript">
					baguetteBox.run('.baguetteBoxOne', {
					    animation: 'fadeIn',
					});
					</script>
					
					<!-- 自留地 -->
					<div id='zld'>
					<!-- <div class='share-group bs-docs-sidebar' id='myAffix'> -->
						<div class='share-group'>
							<div class='pull-left'>
								<div class='pull-left' style='margin-left:2px;padding-top:10px;background: url(bgimage.gif) no-repeat' id='schzysc'><?php echo ($schzysc); ?></div>
								<div class='pull-left <?php echo ($clctcss); ?>'  style='margin-left:5px;' id='clctdv'><a href="javascript:clct(<?php echo ($mo['atcid']); ?>)" class="share <?php echo ($heartcss); ?>" id='clcta'></a></div>
								<div class='pull-left' style='margin-left:2px;margin-top:8px' onclick="zn(<?php echo ($mo['atcid']); ?>)" id='dvzn'> <a style='color:#CCC' id='zn'><i class='glyphicon glyphicon-thumbs-up'></i> <?php echo ($mo['atczn']); ?></a></div>
								<div  class='pull-left' style='margin-left:2px;margin-top:8px'  onclick="tc(<?php echo ($mo['atcid']); ?>)" id='dvtc'> <a style='color:#CCC' id='tc'><i class='glyphicon glyphicon-thumbs-down'></i> <?php echo ($mo['atctc']); ?></a></div>
					        </div>
							<script>var hdlcstmcmt='__URL__/comment';</script>
							
							<div class='pull-left' style='margin-left:2px;'>
								<input class='form-control input-sm'  placeholder="不超过50字符" style='width:100px' id='cstmcmtctt' />
							</div>
							<div class='pull-left' style='margin-left:2px;'>
								  <a href="javascript:cstmcmt(<?php echo ($mo['atcid']); ?>)" class='btn btn-primary btn-sm'>点评</a>
							</div>
					       
					        <div class='clearfix'></div>
					    </div>
				   </div>
				   <script type="text/javascript">$(".share-group").width($('#zld').width());$(".share-group").smartFloatSR();</script>
				</div>
				<div class='clearfix'></div>
				<div class='section detail'>
					
					<div class='clearfix'></div>
					<div class='section'><script>var cstmcmtcnt=<?php echo ($cstmcmtcnt); ?>;var hdlcstmcmtzn='__URL__/commentzan';var hdlcstmcmttc='__URL__/commenttucao'</script>
						<div class="page-header">
		                	<a href='#' class='btn btn-primary' id='vwcstmcmt'><i class='glyphicon glyphicon-comment'></i> <?php echo ($cstmcmtcnt); ?></a>
		            	</div>
					</div>
					<div class='section  info' id='cstmcmtarea'>
						<?php if(is_array($cstmcmtls)): $i = 0; $__LIST__ = $cstmcmtls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="page-header">
			                	<div><div class='pull-left mglft'><div><img src="<?php echo ($vo['cstmusrpt']); ?>" class='img-circle' style='width:40px;' /></div><div class='tag'><span><?php echo ($vo['cstmusrnn']); ?></span></div></div><div class='pull-left mglft' ><?php echo ($vo['cstmcmtctt']); ?></div></div>
			                	<div class='clearfix'></div>
			                	<div class='pull-right tag'><span onclick="cstmcmtzn(<?php echo ($vo['cstmcmtid']); ?>)" style='cursor:pointer' id="cstmcmtzn<?php echo ($vo['cstmcmtid']); ?>"><i class='glyphicon glyphicon-thumbs-up'></i><?php echo ($vo['cstmcmtzn']); ?></span><span onclick="cstmcmttc(<?php echo ($vo['cstmcmtid']); ?>)" style='cursor:pointer' id="cstmcmttc<?php echo ($vo['cstmcmtid']); ?>"><i class='glyphicon glyphicon-thumbs-down' ></i><?php echo ($vo['cstmcmttc']); ?></span><span><?php echo ($vo['cstmcmttm']); ?></span></div>
			            		<div class='clearfix'></div>
			            	</div><?php endforeach; endif; else: echo "" ;endif; ?>
		    		</div>
					
					 <!-- 下拉加载评论模块 -->
	                 <script>var hdlpldnld="__URL__/append/atcid/<?php echo ($mo['atcid']); ?>";</script>
					<!-- AUTOCOMPLETE 保证了刷新后，原来的数据不会留下，那么query来的数据就不会被清洗，而js中的executing保证了不会在各种情况下不会触发js中的if -->
					<input type='hidden' id='executing' value='<?php echo ($executing); ?>' AUTOCOMPLETE="off" />
					<input type='hidden' id='hsnxt' value='<?php echo ($hsnxt); ?>' AUTOCOMPLETE="off" />
					<input type='hidden' id='pg' value='<?php echo ($pg); ?>' AUTOCOMPLETE="off" />
					<script src="__PUBLIC__/JS/index/pldnld.js"></script>
					<div class='clearfix'></div>
					<div id='loading'><img src="__PUBLIC__/IMG/loading.gif" /></div>
				</div>
        	
        	<div class='clearfix'></div>		
		
	</div>
	
<script  type="text/javascript" src="__PUBLIC__/pblc/gotop/gotop.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/gotop/gotop.css" media="all"/>
	 <script type='text/javascript' src='__PUBLIC__/JS/wap/cstmusrhd.js'></script>
<script type='text/javascript' src='__PUBLIC__/JS/wap/wxusrhd.js'></script>
<script>var hdlcstmlgot='__APP__/Cstmusr/loginout';</script>
<script>var hdlwxlgot='__APP__/Wxusr/loginout';</script>
<script>var app_path='__APP__';</script>
<nav id="menu" style='z-index:2000'>
	<ul>
	<?php if($cstmusross){ ?>
		<li>
		<a href='__APP__/Cstmusr/gtxpg/x/center'><img src="<?php echo ($cstmusross['cstmusrpt']); ?>" class='img-circle' style='width:30px;height:30px' />&nbsp;&nbsp;<?php echo ($cstmusross['cstmusrnn']); ?>&nbsp;&nbsp;的个人中心</a>&nbsp;&nbsp;
		</li>
		<li>
		<a href='__APP__/Atc/collect'><i class='glyphicon glyphicon-heart'></i> 我的收藏</a>
		</li>
		<li id='cstmusr_loginout'>
		<a style='cursor:pointer'><i class='glyphicon glyphicon-off'></i> 退出</a>
		</li>
	<?php }else if($wxusross){ ?>	
		<li>
		<a href='__APP__/Wxusr/gtxpg/x/center'><img src="<?php echo ($wxusross['wxusrpt']); ?>" class='img-circle' style='width:30px;height:30px' />&nbsp;&nbsp;<?php echo ($wxusross['wxusrnm']); ?>&nbsp;&nbsp;的个人中心</a>&nbsp;&nbsp;
		</li>
		
		<li id='wxusr_loginout'>
		<a style='cursor:pointer'><i class='glyphicon glyphicon-off'></i> 退出</a>
		</li>
	<?php }else{ ?>	
		<li>
		<a href='__APP__/Cstmusr/gtxpg/x/select'><i class='glyphicon glyphicon-user'></i> 登录</a>
		</li>
	<?php } ?>	
	<script>var hdlatcsrc='__APP__/Atc/query/atckw/';</script>
	<script type="text/javascript" src='__PUBLIC__/JS/wap/atchd.js'></script>
	<li><a><input style='background-color:#333;border:1px;border-bottom-style:solid;border-top-style:none;border-left-style:none;border-right-style:none;' id='atckw' /> <i class='glyphicon glyphicon-search' id='atc_search'></i></a></li>
	</ul>
</nav>
<!-- bootstrap -->
<script src="__PUBLIC__/pblc/btstp3/js/bootstrap.js"></script>
<script src="__PUBLIC__/pblc/btstp3/js/docs.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="__PUBLIC__/pblc/btstp3/js/ie10-viewport-bug-workaround.js"></script>
<script>
$('#myAffix').affix({
  offset: {
    top: $('#slg').height()+$('header').height(),//数字自定义
    bottom: function () {
		$('#myAffix').css('top','0');//自定义
      return (this.bottom = $('.footer').outerHeight(true))
    }
  }
})

</script>
</div>
</body>
</html>