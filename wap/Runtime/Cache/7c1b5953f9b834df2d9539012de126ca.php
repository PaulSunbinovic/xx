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
url_path='__URL__';
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
		<div style='margin-bottom:5px'>
			<div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
		      <ol class="carousel-indicators">
		      	<?php if(is_array($atcfcsls)): $i = 0; $__LIST__ = $atcfcsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($vo['class']); ?>" data-target="#carousel-example-captions" data-slide-to="<?php echo ($i-1); ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
		      </ol>
		      <div class="carousel-inner" role="listbox">
		      	<?php if(is_array($atcfcsls)): $i = 0; $__LIST__ = $atcfcsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item <?php echo ($vo['class']); ?>">
				        <a href="__APP__/Atc/view/atcid/<?php echo ($vo['atcid']); ?>"><img  src="<?php echo ($vo['atccv']); ?>" style='width:100%' data-src="holder.js/900x500/auto/#777:#777" alt="<?php echo ($vo['atctpc']); ?>"></a>
				        <div class="carousel-caption">
					        <h3></h3>
					        <p><a href="__APP__/Atc/view/atcid/<?php echo ($vo['atcid']); ?>" style='font-size:18px;color:#fff;text-decoration:none'><?php echo ($vo['atctpcsrk']); ?></a></p>
				        </div>
			        </div><?php endforeach; endif; else: echo "" ;endif; ?>
		      </div>
		      <a class="left carousel-control" href="#carousel-example-captions" role="button" data-slide="prev">
		        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		        <span class="sr-only">Previous</span>
		      </a>
		      <a class="right carousel-control" href="#carousel-example-captions" role="button" data-slide="next">
		        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		        <span class="sr-only">Next</span>
		      </a>
			</div>
		</div>
		<div style='margin-bottom:5px'>
			<div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
		      <a href="__APP__/Atc/query" class="btn btn-primary" role="button">全部文章</a>
		      <a href="#" class="btn btn-success" role="button">其他东东</a>
		      
		    </div>
		</div>
		<div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class='pull-left'><i class='glyphicon glyphicon-volume-up'></i> 通知公告</h4>
                    <a class='pull-right' href="__APP__/Atc/query/atcanc/1" style='margin:10px 0px;color:#aaa'>更多</a>
	                <div class='clearfix'></div>
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
					<?php if(is_array($atclsanc)): $i = 0; $__LIST__ = $atclsanc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span><a href="__APP__/Atc/view/atcid/<?php echo ($vo['atcid']); ?>" class='pull-left' style="color:#000; <?php echo ($vo['atcstyle']); ?>"><i class="<?php echo ($vo['atcflag']); ?>"></i> <?php echo ($vo['atctpc']); ?></a></span><span class='tag pull-right' style='color:#ccc'><?php echo ($vo['atcmdftm']); ?></span></li>
					<li class='clearfix' style='border-bottom:1px dashed #eee;margin:20px 0px;'></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class='pull-left'><i class='glyphicon glyphicon-align-left'></i> 动态</h4>
                    <a class='pull-right' href="__APP__/Atc/query/atcdnmc/1" style='margin:10px 0px;color:#aaa'>更多</a>
	                <div class='clearfix'></div>
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
					<?php if(is_array($atclsdnmc)): $i = 0; $__LIST__ = $atclsdnmc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span><a href="__APP__/Atc/view/atcid/<?php echo ($vo['atcid']); ?>" class='pull-left' style="color:#000; <?php echo ($vo['atcstyle']); ?>"><i class="<?php echo ($vo['atcflag']); ?>"></i> <?php echo ($vo['atctpc']); ?></a></span><span class='tag pull-right' style='color:#ccc'><?php echo ($vo['atcmdftm']); ?></span></li>
					<li class='clearfix' style='border-bottom:1px dashed #eee;margin:20px 0px;'></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
                </div>
            </div>
        </div>
        <?php if(is_array($bdlsnog)): $i = 0; $__LIST__ = $bdlsnog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class='pull-left'><?php echo ($vo['bdnm']); ?></h4>
                    <a class='tag pull-right' href="__APP__/Atc/query/bdid/<?php echo ($vo['bdid']); ?>" style='margin:10px 0px;color:#aaa'>更多</a>
                    <div class='clearfix'></div>
                </div>
                <div class="panel-body" style='height:300px'>
                    <ul class="list-unstyled">
					<?php if(is_array($vo['atcls'])): $i = 0; $__LIST__ = $vo['atcls'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voII): $mod = ($i % 2 );++$i;?><li><span><a href="__APP__/Atc/view/atcid/<?php echo ($voII['atcid']); ?>" class='pull-left' style="color:#000; <?php echo ($voII['atcstyle']); ?>"><i class="<?php echo ($voII['atcflag']); ?>"></i> <?php echo ($voII['atctpcsrk']); ?></a></span><span class='tag pull-right' style='color:#ccc'><?php echo ($voII['atcmdftm']); ?></span></li>
					<li class='clearfix' style='border-bottom:1px dashed #eee;margin:20px 0px;'></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
                </div>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?> 
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