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
<link rel="stylesheet" href="__PUBLIC__/CSS/zspt/atc.css"/>
<script type='text/javascript' src='__PUBLIC__/JS/zspt/atc.js'></script>
<script type='text/javascript'>
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
	
		<div class='col-md-12' id='rgt'>
			<div class="panel panel-success">
				<div class="panel-heading">
				  <i class="glyphicon glyphicon-th-list"></i> <?php echo ($theme); ?>
				</div>
				<div class="panel-body">
				<ol class="breadcrumb">
		        <li><a href="#">首页</a> </li>
		        <?php echo ($tree); ?>
		        </ol>		
				<div class='detail'>
					<h1><?php echo ($mo['atctpc']); ?></h1>
					<div class="intro"><?php echo ($mo['atcsmr']); ?></div>
					<div class="info">
                    
                   		 <div class="tag pull-right">
	                        <span><?php echo ($mo['atcath']); ?></span>
	                        <span><?php echo ($mo['atcmdftm']); ?></span>
	                        <span><i class="glyphicon glyphicon-eye-open"></i> <?php echo ($mo['atccnt']); ?></span>
	                    </div>
	                </div>
					<div class='clearfix'></div>
					<hr style='margin-top:0px'></hr>
					<div class='front-cover'><img src="<?php echo ($mo['atccv']); ?>"  data-src="holder.js/300x200" alt="<?php echo ($alt); ?>" class='img-rounded'/></div>
					
					
					<link rel="stylesheet" href="__PUBLIC__/pblc/baguettebox/baguettebox.min.css">
					<script src="__PUBLIC__/pblc/baguettebox/baguettebox.min.js"></script>
					<div class="baguetteBoxOne gallery">
					<?php echo ($mo['atcctt']); ?>
					</div>
					<script type="text/javascript">
					baguetteBox.run('.baguetteBoxOne', {
					    animation: 'fadeIn',
					});
					</script>
					<div id='zld'>
					
						<div class='share-group'>
							<div class='pull-left'>
								<!-- 
								<div class='pull-left' style='margin-left:30px;padding-top:10px' id='schzysc'><?php echo ($schzysc); ?></div>
								<div class='pull-left <?php echo ($clctcss); ?>'  style='margin-left:5px;' id='clctdv'><a href="javascript:clct(<?php echo ($mo['atcid']); ?>)" class="share <?php echo ($heartcss); ?>" id='clcta'></a></div>
								
								<div class='btn btn-success btn-lg pull-left' style='margin-left:30px' onclick="zn(<?php echo ($mo['atcid']); ?>)" id='dvzn'><i class='glyphicon glyphicon-thumbs-up'></i> <a style='color:#fff' id='zn'><?php echo ($mo['atczn']); ?></a></div>
								<div  class='btn btn-warning btn-lg pull-left' style='margin-left:30px'  onclick="tc(<?php echo ($mo['atcid']); ?>)" id='dvtc'><i class='glyphicon glyphicon-thumbs-down'></i> <a style='color:#fff' id='tc'><?php echo ($mo['atctc']); ?></a></div>
					        	 -->
					        </div>
					        <div class='pull-right'>
					        	<div class='pull-left' style='margin-right:30px;padding-top:10px'>本文分享到：</div>
					        	<div class='pull-left'  style='margin-right:30px'><a href="http://v.t.sina.com.cn/share/share.php?title=<?php echo ($mo['atctpc']); ?>&amp;url=<?php echo ($url); ?>" class="share share-weibo" target="_blank"></a></div>
					        	<div class='pull-left'  style='margin-right:30px'><a href="#" class="share share-wechat" target="_blank" id='ppov' data-container="body" data-toggle="popover" data-placement="top" data-content="<img src='<?php echo ($qr); ?>' />"></a></div>
					        </div>
					       
					        <div class='clearfix'></div>
					    </div>
				   </div>
				   <script type="text/javascript">$(".share-group").width($('#rgt').width()-30);$(".share-group").smartFloatSR();</script>
					
					
				</div>
				<div class='clearfix'></div>
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
<!-- popover -->
<script>
$(function(){
	$('#ppov').mouseenter(function(){
		$('#ppov').popover('show');
	})
	$('#ppov').mouseleave(function(){
		$('#ppov').popover('hide');
	})
})
</script>


<!-- share -->

</body>
</html>