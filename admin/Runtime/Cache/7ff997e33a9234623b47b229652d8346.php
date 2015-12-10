<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
<script src="__PUBLIC__/pblc/btstp3/js/jquery.js"></script>
<script src="__PUBLIC__/pblc/btstp3/js/jquery-migrate-1.1.0.min.js"></script>
<link href="__PUBLIC__/CSS/cm.css" rel="stylesheet">

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

<script type='text/javascript' src='__PUBLIC__/JS/admin/usr.js'></script>
<script type='text/javascript'>
var txpg='__ROOT__/index.php';
var hdlurl='__URL__/modifypwml';
</script>
</head>


<body>

<!-- head包usr.js -->
<script type="text/javascript" src='__PUBLIC__/JS/admin/usrhd.js'></script>

<script type="text/javascript">
var hdllgin='__APP__/Usr/loginin';
var hdllgot='__APP__/Usr/loginout';
var app_path='__APP__';
</script>
<header class="navbar navbar-fixed-top navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="__ROOT__/index.php" class="navbar-brand">Geek</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
					
					
			<?php if(session('usridss')){ ?>
			
					<li>
						<?php echo ($ntfa); ?>
					</li>
					
					<li class="divider-vertical"></li>
					
					<li>
					<script>var hdlatcsrc='__APP__/Atc/research/atckw/';</script>
					<script type="text/javascript" src='__PUBLIC__/JS/admin/atchd.js'></script>
					    <form class="navbar-search form-search">
				        <div class="input-append">
				        <input type="text" class="span2 search-query"  placeholder="搜索相应的内容" id='atckw'>
				        <button type="button" class="btn btn-primary" id='atc_search'>Search</button>
				        </div>
				        </form>
					</li>
					
					
					
					<li class="divider-vertical"></li>
					
					<li class="dropdown">
						
						<a data-toggle="dropdown" class="dropdown-toggle " href="#">
							<?php echo ($usross['usrnn']); ?> <b class="caret"></b>							
						</a>
						
						<ul class="dropdown-menu">
							<li>
								<a href='__APP__/Usr/gtxpg/x/center' id='usr_center'><i class="icon-user"></i> 个人中心  </a>
							</li>
							
							<li>
								<a href="__APP__/Usr/gtxpg/x/modifypw"><i class="icon-lock"></i> 更改密码</a>
							</li>
							
							<li class="divider"></li>
							
							<li>
								<a href="#" id='usr_loginout'><i class="icon-off"></i> 注销 </a>
							</li>
						</ul>
					</li>
					<li class="divider-vertical"></li>
					<li>
						<a href="__APP__/Atc/neiwang"> 查看内网文章 </a>
					</li>
					<li class="divider-vertical"></li>
					<li>
						<a href="__APP__"> 主页 </a>
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



<div class='container' >
	<div class="panel panel-primary col-md-12" style='float:none;margin:120px auto 0;padding:0;'>
	  <div class="panel-heading">
	    <i class="glyphicon glyphicon-user"></i> <?php echo ($theme); ?>
	  </div>
	  <div class="panel-body">
				<form>
				<input type='hidden' name='usrid' value="<?php echo ($mo['usrid']); ?>" />
				<table class='tb'>
				<script type="text/javascript" src="__PUBLIC__/pblc/password_strength/password_strength_plugin.js"></script> 
				<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/password_strength/password_streng.css"> 
				<script> 
				$(document).ready( function() { 
				//BASIC 验证用户名密码重复
				/*$(".password_test").passStrength({ 
				userid: "#uid" 
				});*/ 
				//ADVANCED 
				$("input[name=usrpwnew]").passStrength({ 
				//download by http://down.liehuo.net
				shortPass: "top_shortPass", 
				badPass: "top_badPass", 
				goodPass: "top_goodPass", 
				strongPass: "top_strongPass", 
				baseStyle: "top_testresult", 
				userid: "#user_id_adv", 
				messageloc: 0 
				}); 
				}); 
				</script> 
				<tr><td>新密码：</td><td><input type='password' name='usrpwnew' class="form-control input-sm" /></td></tr>
				<tr><td>再输入一次新密码：</td><td><input type='password' name='usrpwnewag' class="form-control input-sm"/></td></tr>
				</table>
				<br/>
				<input type='button' id='usr_modifypwml' value=<?php echo ($btnvl); ?> class='btn btn-primary'/>
				</form>
			 </div>
	</div>
	<div class='clearfix'></div>
	<footer class="bs-docs-footer">
  <div class="container">				
		<p>Designed by <a href="#" target="_blank">sunbinovic@163.com</a></p>&copy; 2012-<?php echo date('Y',time()); ?> GEEK footer </p>
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