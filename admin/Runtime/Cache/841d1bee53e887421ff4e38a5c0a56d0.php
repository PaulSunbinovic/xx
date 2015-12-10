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

<script type='text/javascript' src='__PUBLIC__/JS/admin/athmd.js'></script>
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
			
					<li>
						<?php echo ($ntfa); ?>
					</li>
					
					
					
					<li>
					<script>var hdlatcsrc='__APP__/Atc/research/atckw/';</script>
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
						<a href="__APP__/Atc/neiwang"> 查看内网文章 </a>
					</li>
					<li>
						<a href="__APP__/Atc/collect"> 我的收藏 </a>
					</li>
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
	<div class="panel panel-default col-md-12" style='float:none;margin:70px auto 0;padding:0;'>
		<div class="panel-heading">
		  <i class="glyphicon glyphicon-th-list"></i> <?php echo ($theme); ?>
		</div>
		<div class="panel-body">
				<form>
				<input type='hidden' name='athmdid' value="<?php echo ($mo['athmdid']); ?>" />
				<table class='tb'>
				
				<tr><td>权限名称</td>
				<td>
				<select name='f_athmd_athid' disabled class='form-control input-sm'>
					<option value='0'>无</option>
					<?php if(is_array($athls)): $i = 0; $__LIST__ = $athls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['athid']); ?>"><?php echo ($vo['athnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<script>$('select[name=f_athmd_athid]').val(<?php echo ($mo['f_athmd_athid']); ?>)</script>
				</td>
				</tr>
				
				<tr><td>模块名称</td>
				<td>
				<select name='f_athmd_mdid' disabled class='form-control input-sm'>
					<option value='0'>无</option>
					<?php if(is_array($mdls)): $i = 0; $__LIST__ = $mdls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['mdid']); ?>"><?php echo ($vo['mdnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<script>$('select[name=f_athmd_mdid]').val(<?php echo ($mo['f_athmd_mdid']); ?>)</script>
				</td>
				</tr>
				
				<tr><td>浏览权限</td>
				<td>
				<select name='athq' class='form-control input-sm'>
					<option value='n'>禁</option>
					<option value='y'>有</option>
				</select>
				<script>$('select[name=athq]').val("<?php echo ($mo['athq']); ?>")</script>
				</td>
				</tr>
				
				<tr><td>查看权限</td>
				<td>
				<select name='athv' class='form-control input-sm'>
					<option value='n'>禁</option>
					<option value='y'>有</option>
				</select>
				<script>$('select[name=athv]').val("<?php echo ($mo['athv']); ?>")</script>
				</td>
				</tr>
				
				<tr><td>修改权限</td>
				<td>
				<select name='athm' class='form-control input-sm'>
					<option value='n'>禁</option>
					<option value='y'>有</option>
				</select>
				<script>$('select[name=athm]').val("<?php echo ($mo['athm']); ?>")</script>
				</td>
				</tr>
				
				<tr><td>删除权限</td>
				<td>
				<select name='athd' class='form-control input-sm'>
					<option value='n'>禁</option>
					<option value='y'>有</option>
				</select>
				<script>$('select[name=athd]').val("<?php echo ($mo['athd']); ?>")</script>
				</td>
				</tr>
				
				<tr><td>添加权限</td>
				<td>
				<select name='atha' class='form-control input-sm'>
					<option value='n'>禁</option>
					<option value='y'>有</option>
				</select>
				<script>$('select[name=atha]').val("<?php echo ($mo['atha']); ?>")</script>
				</td>
				</tr>
				
				</table>
				<input type='button' id='updt' value="<?php echo ($btnvl); ?>" class='btn btn-primary'/>
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