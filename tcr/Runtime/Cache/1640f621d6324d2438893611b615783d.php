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
<script type='text/javascript' src='__PUBLIC__/JS/tcr/cm.js'></script>
<link href="__PUBLIC__/CSS/tcr/cm.css" rel="stylesheet">

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
 
<script type='text/javascript' src='__PUBLIC__/JS/tcr/tcr.js'></script>
<script type='text/javascript'>
var app_path='__APP__';
</script>
</head>

<body>

<!-- head包tcr.js -->
<script type="text/javascript" src='__PUBLIC__/JS/tcr/tcrhd.js'></script>

<script type="text/javascript">
var hdllgin='__APP__/Tcr/loginin';
var hdllgot='__APP__/Tcr/loginout';
var app_path='__APP__';
</script>
<header class="navbar navbar-fixed-top" id='divhd' style='background-color:#44b549'>
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="__ROOT__/tcr.php" class="navbar-brand">教师管理系统后台</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
					
					
			<?php if(session('tcridss')){ ?>
					<?php echo ($ntfstr); ?>
					<!-- 
					<li>
					<script>var hdlatcsrc='__APP__/Atc/search/atckw/';</script>
					<script type="text/javascript" src='__PUBLIC__/JS/tcr/atchd.js'></script>
					    <form class="navbar-form navbar-left">
						  <div class="input-group">
						      <input type="text" class="form-control" placeholder="搜索相应的内容" id='atckw'>
						      <span class="input-group-btn">
						        <button class="btn btn-primary" type="button" id='atc_search'>Search</button>
						      </span>
						    </div>
						</form>
					    
					</li>
					 -->
					
					
					
					
					<li class="dropdown">
						
						<a data-toggle="dropdown" class="dropdown-toggle " href="#">
							<img class='img-circle' src="<?php echo ($tcross['tcrpt']); ?>" style='width:20px;height:20px'/> <?php echo ($tcross['tcrnn']); ?> <b class="caret"></b>							
						</a>
						
						<ul class="dropdown-menu">
							<li>
								<a href='__APP__/Tcr/gtxpg/x/center' id='tcr_center'><i class="glyphicon glyphicon-user"></i> 个人中心  </a>
							</li>
							
							<li>
								<a href="__APP__/Tcr/gtxpg/x/modifypw"><i class="glyphicon glyphicon-lock"></i> 更改密码</a>
							</li>
							
							<li class="divider"></li>
							
							<li>
								<a href="#" id='tcr_loginout'><i class="glyphicon glyphicon-off"></i> 注销 </a>
							</li>
						</ul>
					</li>
					<!-- 
					<li>
						<?php if($tcross['tcrid']==1||$tcross['f_tcr_sttid']==1){ ?><a href="__APP__/Atc/neiwang"><i class='glyphicon glyphicon-file'></i> 查看内网文章 </a><?php } ?>
					</li>
					<li>
						<a href="__APP__/Atc/collect"><i class='glyphicon glyphicon-heart'></i> 我的收藏 </a>
					</li>
					 -->
					<li>
						<a href="__APP__"><i class='glyphicon glyphicon-home'></i> 主页 </a>
					</li>
					
			<?php }else{ ?>
			
				<li>
					<a href="__APP__"> 主页  </a>
				</li>
		
			<?php } ?>
				
			
		</ul>
    </nav>
  </div>
</header>
<style>
header a{color:#fff}
</style>


<div class='container' >
	<div class='col-md-2' id='lft' class='pull-left' style='display:<?php echo ($lftcls); ?>'>
		<script>
		var hdltcrbtn='__APP__/Tcrbtn/update';
		</script>
		<div class="panel panel-success">
			  <div class="panel-heading">
				    <div class='pull-left'><i class="glyphicon glyphicon-cog"></i> 控制面板</div>
				    <div class='pull-right'><a href="javascript:leftright()"><i class="glyphicon glyphicon-triangle-left"></i></a></div>
				    <div class='clearfix'></div>
			  </div>
			 <div class="panel-body"'>
			 
			 <div class="panel panel-success">
				  <!-- Default panel contents -->
				  <div class="panel-heading">
				  	<div class='pull-left'><i class="glyphicon glyphicon-signal"></i> 后台管理</div>
					<div class='pull-right'><a href="javascript:updown('bs')"><i class="<?php echo ($bscls); ?>" id="bs"></i></a></div>
					<div class='clearfix'></div>
				  </div>
				<!-- List group -->
				  <ul class="nav nav-pills nav-stacked" style="display:<?php echo ($bsbdcls); ?>" id="bsbd">
				    
						<li class=""><a href="#" class='btn  btn-success'>录入成绩</a></li>
					
				  </ul>
				</div>
			  
			  
		    </div>
		</div>
	</div>
	<div class='<?php echo ($rgtcls); ?>' id='rgt' >
		<div class="panel panel-success">
		  <div class="panel-heading">
		    <a href='javascript:leftright()' id='tcrbtn-lft' style='display:<?php echo ($lfttcrbtncls); ?>'><i class="glyphicon glyphicon-triangle-right"></i></a><i class="glyphicon glyphicon-th-list"></i> <?php echo ($theme); ?>
		  </div>
		  <div class="panel-body" style='min-height:500px'>				
				<table class='tb'>
				<tr><td>帐号：</td><td><?php echo ($mo['tcrnm']); ?></td></tr>
				<tr><td>姓名：</td><td><?php echo ($mo['tcrnn']); ?></td></tr>
				<tr><td>站点名称：</td><td><?php echo ($mo['sttnm']); ?></td></tr>
				<tr><td>用户头像：</td><td>
				<img src="<?php echo ($mo['tcrpt']); ?>" alt="" class='img-thumbnail'  style="width:100px;" />
				</td></tr>
				<!-- <tr><td>权限：</td><td><?php echo ($mo['athnm']); ?></td></tr> -->
				<tr><td>创建时间：</td><td><?php echo ($mo['tcraddtm']); ?></td></tr>
				<tr><td>修改时间：</td><td><?php echo ($mo['tcrmdftm']); ?></td></tr>
				<tr><td>用户地址：</td><td><?php echo ($mo['tcrads']); ?></td></tr>
				<tr><td>用户座机：</td><td><?php echo ($mo['tcrtlp']); ?></td></tr>
				<tr><td>手机号：</td><td><?php echo ($mo['tcrcp']); ?></td></tr>
				<tr><td>密保邮箱：</td><td><?php echo ($mo['tcrml']); ?></td></tr>
				<tr><td>审核情况：</td><td><?php echo ($mo['tcrps']); ?></td></tr>
				<tr><td>用户简介：</td><td><div style='width:700px'><?php echo ($mo['tcrintr']); ?></div></td></tr>
				</table>
				
				<a href='__URL__/gtxpg/x/modify' class='btn btn-success'>前往修改个人信息</a>
				<a href='__URL__/gtxpg/x/modifypw' class='btn btn-success'>前往修改密码</a>
		  </div>
		</div>
	</div>
	
	<div class='clearfix'></div>
	<footer class="bs-docs-footer">
  <div class="container">				
		<p>Designed by <a href="#" target="_blank">sunbinovic@163.com</a></p><p>&copy; 2012-<?php echo date('Y',time()); ?> 中国计量学院成人教育学院、继续教育学院 </p>
	</div> <!-- /container -->
</footer>
<script  type="text/javascript" src="__PUBLIC__/pblc/gotop/gotop.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/gotop/gotop.css" media="all"/>
</div>

<!-- bootstrap -->
<script src="__PUBLIC__/pblc/btstp3/js/bootstrap.js"></script>
<script src="__PUBLIC__/pblc/btstp3/js/docs.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="__PUBLIC__/pblc/btstp3/js/ie10-viewport-bug-workaround.js"></script>
<script>
$('#myAffix').affix({
  offset: {
    top: 100,//数字自定义
    bottom: function () {
		$('#myAffix').css('top','0');//自定义
      return (this.bottom = $('.footer').outerHeight(true))
    }
  }
})
</script>

</body>
</html>