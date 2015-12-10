<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<script type='text/javascript'>
var hdlurl='__URL__/modifypw';
</script>
</head>


<link type="text/css" rel="stylesheet" href="__PUBLIC__/CSS/wap/demo.css" />

<!--必要样式-->
<link type="text/css" rel="stylesheet" href="__PUBLIC__/CSS/wap/jquery.mmenu.css" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/CSS/wap/jquery.mmenu.dragopen.css" />
<body>

<script type="text/javascript" src="__PUBLIC__/JS/wap/jquery.mmenu.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/JS/wap/jquery.mmenu.dragopen.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/JS/wap/jquery.mmenu.fixedelements.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/JS/wap/mn.js"></script>
</head>
<body>
<div id="page">
	<div class="header FixedTop">
		<a href="#menu"></a>
		<?php echo ($cprtnm); ?>
	</div>
	<div class="content" id="content">
		<div class="panel panel-default">
			<div class="panel-heading">
			  <i class="glyphicon glyphicon-th-list"></i> <?php echo ($theme); ?>
			</div>
			<div class="panel-body">
				<form>
				<input type='hidden' name='cstmusrid' value="<?php echo ($mo['cstmusrid']); ?>" />
				<table class='tb'>
				<tr><td>原密码：</td><td><input type='password' name='cstmusrpworg' class='form-control input-sm'/></td></tr>
				<tr><td>新密码：</td><td><input type='password' name='cstmusrpwnew' class='form-control input-sm'/></td></tr>
				<tr><td>再输入一次新密码：</td><td><input type='password' name='cstmusrpwnewag' class='form-control input-sm'/></td></tr>
				</table>
				
				<input type='button' id='cstmusr_modifypw' value=<?php echo ($btnvl); ?> class='btn btn-primary' />
				</form>
			</div>
		</div>
	</div>
	<!-- 
	<div class="footer FixedBottom">
		Fixed footer :-)
	</div>
	 -->
	<nav id="menu">
		<ul>
		<?php if(session('cstmusridss')){ ?>
			<li>
			<a href='__APP__/Cstmusr/gtxpg/x/center'><img src="<?php echo ($cstmusross['cstmusrpt']); ?>" class='img-circle' style='width:30px' />&nbsp;&nbsp;<?php echo ($cstmusross['cstmusrnm']); ?>&nbsp;&nbsp;的个人中心</a>
			</li>
			<li>
			<a href='__APP__/Cstmusr/gtxpg/x/select'><i class='glyphicon glyphicon-heart'></i> 我的收藏</a>
			</li>
		<?php }else{ ?>	
			<li>
			<a href='__APP__/Cstmusr/gtxpg/x/select'>登录</a>
			</li>
		<?php } ?>	
		<li><a><input style='background-color:#333;border:1px;border-bottom-style:solid;border-top-style:none;border-left-style:none;border-right-style:none;' /> <i class='glyphicon glyphicon-search'></i></a></li>
		</ul>
	</nav>
</div>
</body>
</html>