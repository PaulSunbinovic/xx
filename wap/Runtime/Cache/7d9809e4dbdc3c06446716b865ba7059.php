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
<script type='text/javascript' src='__PUBLIC__/JS/wap/cstmusrhd.js'></script>
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

	<!-- head包cstmusr.js -->

<div class="header FixedTop" id='header'>
	<a href='#menu' id='menu'></a>
	<?php echo ($cprtnm); ?>
	<a id='home' href='javascript:history.go(-1)'><i class='glyphicon glyphicon-menu-left' style='font-size:22px;top:5px'></i></a>
</div>
	<div class="content col-md-12" id="content">
		<div class='col-xs-12 slct'><a class='btn btn-primary btn-lg btn-block' href='__URL__/gtxpg/x/login'>帐号密码登录</a></div>
		<div class='col-xs-12 slct'><a class='btn btn-success btn-lg btn-block' href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx08c69e5ad5cc1a5e&redirect_uri=http://192.168.1.111/geek/oauth2_openid.php&response_type=code&scope=snsapi_base&state=wx08c69e5ad5cc1a5eWXWC95c2d97c3557a65b5f6f7e962b363256#wechat_redirect'>微信登录</a></div>
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
</body>
</html>