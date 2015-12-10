<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
<script src="__PUBLIC__/pblc/btstp3/js/jquery.js"></script>
<script src="__PUBLIC__/pblc/btstp3/js/jquery-migrate-1.1.0.min.js"></script>
<script type='text/javascript' src='__PUBLIC__/JS/cm.js'></script>
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

<script type='text/javascript' src='__PUBLIC__/JS/admin/usrgrp.js'></script>
<script type='text/javascript'>
var hdlurl='__URL__/update';
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
<header class="navbar navbar-fixed-top navbar-inverse" id='divhd'>
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
					<?php echo ($ntfstr); ?>
					<li>
					<script>var hdlatcsrc='__APP__/Atc/search/atckw/';</script>
					<script type="text/javascript" src='__PUBLIC__/JS/admin/atchd.js'></script>
					    <form class="navbar-form navbar-left">
						  <div class="input-group">
						      <input type="text" class="form-control" placeholder="搜索相应的内容" id='atckw'>
						      <span class="input-group-btn">
						        <button class="btn btn-primary" type="button" id='atc_search'>Search</button>
						      </span>
						    </div><!-- /input-group -->
						</form>
					    
					</li>
					
					
					
					
					
					<li class="dropdown">
						
						<a data-toggle="dropdown" class="dropdown-toggle " href="#">
							<img class='img-circle' src="<?php echo ($usross['usrpt']); ?>" style='width:20px'/> <?php echo ($usross['usrnn']); ?> <b class="caret"></b>							
						</a>
						
						<ul class="dropdown-menu">
							<li>
								<a href='__APP__/Usr/gtxpg/x/center' id='usr_center'><i class="glyphicon glyphicon-user"></i> 个人中心  </a>
							</li>
							
							<li>
								<a href="__APP__/Usr/gtxpg/x/modifypw"><i class="glyphicon glyphicon-lock"></i> 更改密码</a>
							</li>
							
							<li class="divider"></li>
							
							<li>
								<a href="#" id='usr_loginout'><i class="glyphicon glyphicon-off"></i> 注销 </a>
							</li>
						</ul>
					</li>
					
					<li>
						<a href="__APP__/Atc/neiwang"><i class='glyphicon glyphicon-file'></i> 查看内网文章 </a>
					</li>
					<li>
						<a href="__APP__/Atc/collect"><i class='glyphicon glyphicon-heart'></i> 我的收藏 </a>
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



<div class='container' >
	<div class='col-md-2' id='lft' class='pull-left' style='display:<?php echo ($lftcls); ?>;'>
		<script>
		var hdlbtn='__APP__/Btn/update';
		</script>
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <div class='pull-left'><i class="glyphicon glyphicon-cog"></i> 控制面板</div>
		    <div class='pull-right'><a href="javascript:leftright()"><i class="glyphicon glyphicon-triangle-left"></i></a></div>
		    <div class='clearfix'></div>
		  </div>
		  <div class="panel-body">
		  
	  	<div class="panel panel-info">
		  <!-- Default panel contents -->
		  <div class="panel-heading">
		  	<div class='pull-left'><i class="glyphicon glyphicon-signal"></i> 基础设置</div>
			<div class='pull-right'><a href="javascript:updown('bs')"><i class="<?php echo ($bscls); ?>" id="bs"></i></a></div>
			<div class='clearfix'></div>
		  </div>
		<!-- List group -->
		  <ul class="nav nav-pills nav-stacked" style="display:<?php echo ($bsbdcls); ?>" id="bsbd">
		    <?php if(is_array($mdlsfn)): $i = 0; $__LIST__ = $mdlsfn;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($vo['actvcls']); ?>"><a href="__APP__/<?php echo ($vo['mdmk']); ?>/query"><?php echo ($vo['mdnm']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		  </ul>
		</div>
	    </div>
		</div>
	</div>
	<div class='<?php echo ($rgtcls); ?>' id='rgt' >
		<div class="panel panel-default">
			<div class="panel-heading">
			  <a href='javascript:leftright()' id='btn-lft' style='display:<?php echo ($lftbtncls); ?>'><i class="glyphicon glyphicon-triangle-right"></i></a><i class="glyphicon glyphicon-th-list"></i> <?php echo ($theme); ?>
			</div>
			<div class="panel-body">
				<form>
				<input type='hidden' name='usrgrpid' value="<?php echo ($mo['usrgrpid']); ?>" />
				<table class='tb'>
				
				<tr><td>用户名</td>
				<td>
				<select name='f_usrgrp_usrid' class='form-control input-sm'>
					<option value='0'>无</option>
					<?php if(is_array($usrls)): $i = 0; $__LIST__ = $usrls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['usrid']); ?>"><?php echo ($vo['usrnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<script>$('select[name=f_usrgrp_usrid]').val(<?php echo ($mo['f_usrgrp_usrid']); ?>)</script>
				</td>
				</tr>
				
				<tr><td>团队名称</td>
				<td>
				<select name='f_usrgrp_grpid' class='form-control input-sm'>
					<option value='0'>无</option>
					<?php echo ($tree); ?>
				</select>
				<script>$('select[name=f_usrgrp_grpid]').val(<?php echo ($mo['f_usrgrp_grpid']); ?>)</script>
				</td>
				</tr>
				
								
				</table>
				<input type='button' id='updt' value="<?php echo ($btnvl); ?>" class='btn btn-primary'/>
				</form>
			</div>
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