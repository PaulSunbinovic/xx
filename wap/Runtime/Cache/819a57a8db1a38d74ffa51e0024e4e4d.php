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

<script type='text/javascript' src='__PUBLIC__/JS/wap/wxusr.js'></script>
<script type='text/javascript'>
var app_path='__APP__';
var root_index='__ROOT__/wap.php';
var hdlurl='__URL__/regist';
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
<div id="page">
	<!-- head包cstmusr.js -->

<div class="header FixedTop" id='header'>
	<a href='#menu' id='menu'></a>
	<?php echo ($cprtnm); ?>
	<a id='home' href='__APP__'><i class='glyphicon glyphicon-home' style='font-size:20px;top:5px'></i></a>
</div>
	<div class="content" id="content">
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <i class="glyphicon glyphicon-user"></i> <?php echo ($theme); ?>
		  </div>
		  <div class="panel-body">
		  
		 
				<form class='form-horizontal'>
				<input type="hidden" class="form-control"  id="cstmusrnm" name='cstmusrnm' placeholder="客户用户名（不允许中文）"  value="<?php echo ($mo['wxusropid']); ?>" >
			    <script type="text/javascript" src="__PUBLIC__/pblc/password_strength/password_strength_plugin.js"></script> 
				<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/password_strength/password_streng.css"> 
				<script> 
				$(document).ready( function() { 
				//BASIC 验证客户用户名密码重复
				/*$(".password_test").passStrength({ 
				userid: "#uid" 
				});*/ 
				//ADVANCED 
				$("input[name=cstmusrpw]").passStrength({ 
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
			   
				<input type="hidden" class="form-control" id="cstmusrpw" name='cstmusrpw' placeholder="请输入密码" value=""/>
			   
			    <div class="form-group">
				    <label class='col-md-2  control-label' for="cstmusrnn">真实姓名</label>
				    <div class="col-md-4">
				    	<input type="text" class="form-control" id="cstmusrnn" name='cstmusrnn' placeholder="真实姓名"  value="<?php echo ($mo['wxusrnm']); ?>" readonly />
			   		</div>
			   	</div>
			     <div class="form-group">
			    	<label class='col-md-2  control-label' for="cstmusrpt">客户用户头像</label>
			   		<div class="col-md-4">
				    <!-- file start -->
					 <link rel="stylesheet" href="__PUBLIC__/pblc/FileUpload/uploadify/uploadify.css" />
					 <script type="text/javascript" src='__PUBLIC__/pblc/FileUpload/uploadify/uploadify.js'></script>
					 <link rel="stylesheet" type="text/css"  href="__PUBLIC__/pblc/FileUpload/uploadify/uploadify.css" />
					<script type="text/javascript" src="__PUBLIC__/pblc/FileUpload/uploadify/swfobject.js"></script>
					<script type="text/javascript">
					var file_path='__PUBLIC__/pblc/FileUpload';
					var hdlupload='__APP__/FileUpload/upload/issml/y';
					var upload_path='__ROOT__/Uploads';
					</script>
					<script type="text/javascript" src='__PUBLIC__/pblc/FileUpload/int.js'></script>
					<div>
					<img src="<?php echo ($mo['wxusrpt']); ?>" alt=""  class='img-thumbnail'  style="width:100px;"  id='imgg'/>
					</div>
					<div style="width:80px; height:26px; overflow:hidden;"><input type="file" name="photo1" id="uploadify"/></div>
					<!-- 隐藏系统所需的客户用户upt -->
					<input type='hidden' name='cstmusrpt' value="<?php echo ($mo['cstmusrpt']); ?>" id='pt'/>
					<!-- file over -->
			   		</div>
			    </div>
			    <div class="form-group">
				    <label class='col-md-2  control-label' for="cstmusrcp">客户用户手机号</label>
				    <div class="col-md-4">
				    	<input type="text" class="form-control" id="cstmusrcp" name='cstmusrcp' placeholder="客户用户手机号"  value="<?php echo ($mo['cstmusrcp']); ?>" />
			    	</div>
			    </div>
			    <div class="form-group">
				    <label class='col-md-2  control-label'  for="cstmusrml">客户用户密保邮箱</label>
				    <div class="col-md-4">
				    	<input type="text" class="form-control" id="cstmusrml" name='cstmusrml' placeholder="客户用户密保邮箱"  value="<?php echo ($mo['cstmusrml']); ?>" />
			    	</div>
			    </div>
			    <div id='errCtn'></div>
			    <input type='hidden' name='cstmusrps' value="1" />
			    <input type='hidden' name='cstmusrvw' value="1" />
			    <div class="form-group">
				    <label class='col-md-2  control-label'></label>
					<div class="col-md-4">
						<input type="button" class="btn btn-primary" id='cstmusr_regist' value='完成，体验全功能'/>
				   	</div>
			   	</div>
				</form>
				
		  </div>
	  
		
			
			
		</div>
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
</div>
</body>
</html>