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

<script type='text/javascript' src='__PUBLIC__/JS/admin/atc.js'></script>
<script type='text/javascript'>
var app_path='__APP__';
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

				
				
				<!-- 注意NB 的class 都要设置  开始-->
				<script type="text/javascript">var hdldlt='__URL__/delete'</script>
				<div>
					<table id='NBtb' class='table table-striped table-bordered'>
					<thead>
					  <tr class='info'>
					    <th class='odr'>序号</th>
					    <th class='bdnm'>板块名称</th>
					    <th class='atctpc'>标题</th>
					    <th class='atcath'>作者</th>
					    <th class='atcmdftm'>修改时间</th>
					    <th class='atccnt'>浏览计数</th>
					    <th class='atczn'>赞</th>
					    <th class='atctc'>吐槽</th>
					    <th class='oprt'>操作</th>
					  </tr>
					</thead>
					
					<tbody>
					  <?php if(is_array($mls)): $i = 0; $__LIST__ = $mls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					    <td class='odr'><?php echo ($fstrw+$i); ?></td>
					    <td class='bdnm'><?php echo ($vo['bdnm']); ?></td>
					    <td class='atctpc'><?php echo ($vo['atctpc']); ?></td>
					    <td class='atcath'><?php echo ($vo['atcath']); ?></td>
					    <td class='atcmdftm'><?php echo ($vo['atcmdftm']); ?></td>
					    <td class='atccnt'><?php echo ($vo['atccnt']); ?></td>
					    <td class='atczn'><?php echo ($vo['atczn']); ?></td>
					    <td class='atctc'><?php echo ($vo['atctc']); ?></td>
					    <td class='oprt'>
					      <!-- Icons -->
					      <?php if($athv=='y'){ ?><a href="__URL__/gtxpg/x/vw/atcid/<?php echo ($vo['atcid']); ?>">查看</a><?php } ?>
					      <?php if($athm=='y'){ ?><a href="__URL__/gtxpg/x/updt/atcid/<?php echo ($vo['atcid']); ?>">修改</a><?php } ?>
					      <?php if($athd=='y'){ ?><a href="javascript:dlt(<?php echo ($vo['atcid']); ?>)">删除</a><?php } ?>
					      <?php if($athm=='y'){ if($vo['atcvw']=='y'){ ?><a href="javascript:stvw(<?php echo ($vo['atcid']); ?>,'n')">设未查看</a><?php }else{ ?><a href="javascript:stvw(<?php echo ($vo['atcid']); ?>,'y')">设已查看</a><?php } } ?>
					    </td>
					  </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
					</tbody>
					</table>
					<script type="text/javascript">$("#NBtb thead").smartFloatTB();</script>
				<!-- 注意NB 的class 都要设置  结束-->
				<?php echo ($page_method); ?>&nbsp;&nbsp;
				
				<?php if($atha=='y'){ ?><p><a href="__URL__/gtxpg/x/updt/atcid/0" class='btn btn-primary'>添加</a></p><?php } ?>
				
				
				
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