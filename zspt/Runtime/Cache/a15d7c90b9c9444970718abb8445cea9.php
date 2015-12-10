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
<script type='text/javascript' src='__PUBLIC__/JS/cstm/cm.js'></script>
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


<script src='__PUBLIC__/JS/zspt/std.js'></script>
<script>
var hdlurl='__APP__/Std/loginin';
var app_path='__APP__';
var url_path='__URL__';
</script> 
</head>

<body  style='background-color:#eee;'>

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
	
	<div>
		<div class="panel panel-success">
		  <div class="panel-heading">
		    <i class="glyphicon glyphicon-th-list"></i> <?php echo ($theme); ?>
		  </div>
		  <div class="panel-body" style='min-height:500px'>	
			 <div class='col-md-12'>
			 	<div class='col-md-8'>
				 	<div>
						<div class="col-lg-12">
				            <h3 class="page-header">
				                	文件
				            </h3>
				        </div>
				        
				        <div class="col-md-12">
				            <ul class="list-unstyled">
								<?php if(is_array($atcls)): $i = 0; $__LIST__ = $atcls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voII): $mod = ($i % 2 );++$i;?><li><span><a href="__APP__/Atc/gtxpg/x/vw/atcid/<?php echo ($voII['atcid']); ?>" class='pull-left' style='color:#666;font-size:16px;'> <?php echo ($voII['atctpcsrk']); ?></a></span><span class='tag pull-right' style='color:#ccc'><?php echo ($voII['atcmdftm']); ?></span></li>
								<li class='clearfix' style='border-bottom:1px dashed #eee;margin:20px 0px;'></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
				                
				            
				        </div>
				        
			        </div>
			 	</div>
			 	<div class='col-md-4'>
			 		<?php if(!session('stdidss')){ ?>
				 		<div class="col-lg-12">
				            <h3 class="page-header">
				                	报名入口
				            </h3>
				        </div>
				 		<div class='col-md-12' style='margin-top:20px'>
				 		<a href='__APP__/Std/gtxpg/x/updt/stdid/0' class='btn btn-primary btn-lg btn-block' role='button'>点击进入报名页面</a>
				 		</div>
				 		<div class='col-md-12' style='margin-top:20px'>
				 		<a href='#' data-toggle='modal' data-target='#myModal' class='btn btn-success btn-lg btn-block' role='button'>已报名学生登录</a>
				 		</div>
				 	<?php }else{ ?>
				 		<div class="col-lg-12">
			            <h3 class="page-header">
			                	查看明细
			            </h3>
				        </div>
				 		<div class='col-md-12' style='margin-top:20px'>
				 		<a href="__APP__/Std/gtxpg/x/center" class='btn btn-primary btn-lg btn-block' role='button'>查看报名信息</a>
				 		</div>
				 		<div class='col-md-12' style='margin-top:20px'>
				 		<a href="__APP__/Std/gtxpg/x/ylqtz" class='btn btn-warning btn-lg btn-block' role='button'>查看预录取通知书电子版</a>
				 		</div>
				 		<div class='col-md-12' style='margin-top:20px'>
				 		<a href="__APP__/Cw/gtxpg/x/center" class='btn btn-success btn-lg btn-block' role='button'>查看缴费信息</a>
				 		</div>
				 	<?php } ?>
			 	</div>
			 </div>
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
                
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">登录</h4>
      </div>
      <div class="modal-body">
        <form>
		  <div class="form-group">
		    <label for="stdnm">姓名</label>
		    <input type="text" class="form-control" name='stdnm' id="stdnm" placeholder="请输入姓名">
		  </div>
		  <div class="form-group">
		    <label for="stdidcd">身份证号码</label>
		    <input type="password" class="form-control" name='stdidcd' id="stdidcd" placeholder="请输入身份证号码">
		  </div>
		  <div class="checkbox">
		    <label>
		      <input type="checkbox" id='rmb'><input type='hidden' name='rmb'> 下次自动登录
		    </label>
		  </div>
		  <div id='errCtn'></div>
		  <input type="button" class="btn btn-primary" value='登录' id='std_logininIdx'>
		  
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
	  </div>
    </div>
  </div>
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