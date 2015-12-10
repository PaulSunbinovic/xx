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
	<a id='home' href='javascript:history.go(-1)'><i class='glyphicon glyphicon-menu-left' style='font-size:22px;top:5px'></i></a>
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
		
		<div>
		    <?php echo ($bdo['bdnm']); ?>
		</div>
		
		<div id='mainarea'>
		<?php if(is_array($atcls)): $i = 0; $__LIST__ = $atcls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="panel panel-default" onclick="javascript:top.location='__APP__/Atc/view/atcid/<?php echo ($vo['atcid']); ?>';">
				<div>
				  <div class="panel-body">
				  	
				    <div class='pull-left col-xs-5'  style='padding-left:0px'>
				    	<img src="<?php echo ($vo['atccv']); ?>" style='width:120px;height:90px' />
				    </div>
				    <div class='pull-left col-xs-7' style='padding-right:0px'>
				    	<div>
				    		<span><a href="__APP__/Atc/view/atcid/<?php echo ($vo['atcid']); ?>" class='pull-left' style="color:#000; <?php echo ($vo['atcstyle']); ?>"><i class="<?php echo ($vo['atcflag']); ?>"></i> <?php echo ($vo['atctpcsrk']); ?></a></span>
				    	</div>
				    	<div>
				    		<span class='tag' style='color:#ccc'><i class='glyphicon glyphicon-comment'></i> <?php echo ($vo['cstmcmtcnt']); ?>&nbsp;&nbsp;<i class='glyphicon glyphicon-thumbs-up'></i> <?php echo ($vo['atczn']); ?>&nbsp;&nbsp;<i class='glyphicon glyphicon-thumbs-down'></i> <?php echo ($vo['atctc']); ?>&nbsp;&nbsp;<i class='glyphicon glyphicon-eye-open'></i> <?php echo ($vo['atccnt']); ?></span>
				    	</div>
				    	<div>
				    		<span class='tag' style='color:#ccc'><?php echo ($vo['atcmdftm']); ?></span>
				    	</div>
				    </div>
				  </div>
			  </div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		
		<!-- 下拉加载评论模块 -->
        <script>var hdlpldnld="<?php echo ($hdlpldnld); ?>";</script>
		<!-- AUTOCOMPLETE 保证了刷新后，原来的数据不会留下，那么query来的数据就不会被清洗，而js中的executing保证了不会在各种情况下不会触发js中的if -->
		<input type='hidden' id='executing' value='<?php echo ($executing); ?>' AUTOCOMPLETE="off" />
		<input type='hidden' id='hsnxt' value='<?php echo ($hsnxt); ?>' AUTOCOMPLETE="off" />
		<input type='hidden' id='pg' value='<?php echo ($pg); ?>' AUTOCOMPLETE="off" />
		<script src="__PUBLIC__/JS/wap/pldnld.js"></script>
		<div class='clearfix'></div>
		<div id='loading'><img src="__PUBLIC__/IMG/loading.gif" /></div>
		
       	
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
	<li><a href='__APP__'><i class='glyphicon glyphicon-home'></i> 首页</a></li>
	</ul>
</nav>
	
</div>
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

</body>
</html>