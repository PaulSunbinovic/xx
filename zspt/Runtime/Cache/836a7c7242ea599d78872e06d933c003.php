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
<script type='text/javascript' src='__PUBLIC__/JS/zspt/cm.js'></script>
<link href="__PUBLIC__/CSS/zspt/cm.css" rel="stylesheet">

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
<link rel="stylesheet" href="__PUBLIC__/CSS/zspt/std.css"/>
<script type='text/javascript' src='__PUBLIC__/JS/zspt/cw.js'></script>
<script type='text/javascript'>
url_path='__URL__';
</script>
</head>


<body style='padding-top:70px;background-color:#eee;'>

<!-- head包std.js -->
<script type="text/javascript" src='__PUBLIC__/JS/zspt/stdhd.js'></script>

<script type="text/javascript">
var hdllgin='__APP__/Std/loginin';
var hdllgot='__APP__/Std/loginout';
var app_path='__ROOT__/zspt.php';
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
      <a href="#" class="navbar-brand" style='line-height:50px;padding:0px'><img style='width:50px;height:50px' alt="Brand" src="__PUBLIC__/IMG/cjlulg.png"></a>
      <a href="#" class="navbar-brand">&nbsp;&nbsp;&nbsp;&nbsp;中国计量学院继续教育学院招生平台</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
					
					
			<?php if(session('stdidss')){ ?>
					
					
					
					<li class="dropdown">
						
						<a data-toggle="dropdown" class="dropdown-toggle " href="#">
							<img class='img-circle' src="<?php echo ($stdoss['stdpt']); ?>" style='width:20px;height:20px'/> <?php echo ($stdoss['stdnm']); ?> <b class="caret"></b>							
						</a>
						
						<ul class="dropdown-menu">
							 
							<li>
								<a href="__APP__/Std/gtxpg/x/center" id='std_center'><i class="glyphicon glyphicon-user"></i> 个人信息  </a>
								
							</li>
							 
							
							<li class="divider"></li>
							
							<li>
								<a href="#" id='std_loginout'><i class="glyphicon glyphicon-off"></i> 注销 </a>
							</li>
						</ul>
					</li>
					
					
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
	
		<div class='col-md-12'>
			<div class="panel panel-success">
				<div class="panel-heading">
				  <i class="glyphicon glyphicon-th-list"></i> <?php echo ($theme); ?>
				</div>
				<div class="panel-body">
					<div><span class='pull-left' style='margin-left:50px'><img src="<?php echo ($mo['stdpt']); ?>"  class='img-circle' style='height:80px;width:80px'/></span><span class='pull-left' style='line-height:80px'>&nbsp;&nbsp;&nbsp;<?php echo ($mo['stdnm']); ?>&nbsp;&nbsp;&nbsp;<?php echo ($mo['stdno']); ?>&nbsp;&nbsp;&nbsp;<?php echo ($mo['xnnm']); ?>学年</div>
					<div class='clearfix'></div>
					<div class='mingxi'>
					基本信息
					<table>
					<tr>
					<td>
					<input type='hidden' name='stdid' value="<?php echo ($mo['stdid']); ?>" />
					办学形式：
					</td>
					<td>
					<?php echo ($mo['bxxsnm']); ?>
					</td>
					<td>
					年级：
					</td>
					<td>
					<?php echo ($mo['grdnm']); ?>级
					</td>
					<td>专业：</td>
					<td>
					<?php echo ($mo['mjnm']); ?>（<?php echo ($mo['mjdsc']); ?>）
					</td>
					</tr>
					<tr>
					<td>姓名</td><td><?php echo ($mo['stdnm']); ?></td>
					<td>报名号</td><td><?php echo ($mo['stdaplno']); ?></td>
					<td>
					性别
					</td>
					<td>
					<?php echo ($mo['sexnm']); ?>
					</td>
					</tr>
					
					</table>
					</div>
					
					
					
					<div class='mingxi'>
					缴费情况（单位：元）
					<table>
					
					<tr>
					<td>应缴学费（含报名费）：</td><td><?php echo ($mo['cwyjxfsm']); ?></td><td>实缴学费（含报名费）：</td><td><?php echo ($mo['cwsjxfsm']); ?></td>
					</tr>
					<tr>
					<td>应缴教材考务费：</td><td><?php echo ($mo['cwyjjckwfsm']); ?></td><td>实缴教材考务费：</td><td><?php echo ($mo['cwsjjckwfsm']); ?></td>
					</tr>
					<?php if($mo['bxxsnmst']=='自考'){ ?>
					<tr>
					<td>应缴住宿费：</td><td><?php echo ($mo['cwyjzsfsm']); ?></td><td>实缴住宿费：</td><td><?php echo ($mo['cwsjzsfsm']); ?></td>
					</tr>
					<?php } ?>
					<tr>
					<td>应缴总额：</td><td><?php echo ($mo['cwyjze']); ?></td><td>实缴总额：</td><td><?php echo ($mo['cwsjze']); ?></td>
					</tr>
					
					</table>
					<?php if($mo['bxxsnmst']=='技能'){ ?>
					<p style='color:#44B549'>住宿费在开学报到时缴费</p>
					<?php } ?>
					</div>
					
					<a href="__APP__/Std/gtxpg/x/vw/stdid/<?php echo ($mo['stdid']); ?>" class='btn btn-primary btn-lg' role='button'>查看报名信息</a>
					
					
					
					
				
			</div>
		</div>
	</div>
	<div class='clearfix'></div>
	
	<footer class="bs-docs-footer" style='margin-top:10px'>
  <div class="container">				
		<p>Designed by <a href="#" target="_blank">sunbinovic@163.com</a>   管理员<a href='__ROOT__/admin.php'>点此登录</a></p><p>&copy; 2012-<?php echo date('Y',time()); ?> 中国计量学院成教学院 </p>
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