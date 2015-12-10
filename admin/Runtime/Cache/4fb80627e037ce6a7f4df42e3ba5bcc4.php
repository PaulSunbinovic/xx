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
<script type='text/javascript' src='__PUBLIC__/JS/admin/cm.js'></script>
<link href="__PUBLIC__/CSS/admin/cm.css" rel="stylesheet">

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
var app_path='__APP__';
var root_index='__ROOT__/index.php';
var hdlurl='__URL__/regist';
</script>
</head>


<body style='padding-top:70px;background-color:#eee;'>

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
      <a href="__ROOT__/index.php" class="navbar-brand">管理系统后台</a>
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
							<img class='img-circle' src="<?php echo ($usross['usrpt']); ?>" style='width:20px;height:20px'/> <?php echo ($usross['usrnn']); ?>【<?php echo ($usross['rlnmu']); ?>】 <b class="caret"></b>							
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
						<?php if($usross['usrid']==1||$usross['f_usr_sttid']==1){ ?><a href="__APP__/Atc/neiwang"><i class='glyphicon glyphicon-file'></i> 查看内网文章 </a><?php } ?>
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
	<div class='col-md-12' style='float:none;margin:0px auto 0;padding:0;' >
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <i class="glyphicon glyphicon-user"></i> <?php echo ($theme); ?>
		  </div>
		  <div class="panel-body">
		  
		 
				<form class='form-horizontal'>
				<div class="form-group">
				    <label class='col-md-2  control-label' for="usrnm">用户名</label>
				    <div class="col-md-4">
				    	<input type="text" class="form-control"  id="usrnm" name='usrnm' placeholder="用户名（不允许中文）"  value="<?php echo ($mo['usrnm']); ?>" >
			    	</div>
			    </div>
			    <script type="text/javascript" src="__PUBLIC__/pblc/password_strength/password_strength_plugin.js"></script> 
				<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/password_strength/password_streng.css"> 
				<script> 
				$(document).ready( function() { 
				//BASIC 验证用户名密码重复
				/*$(".password_test").passStrength({ 
				userid: "#uid" 
				});*/ 
				//ADVANCED 
				$("input[name=usrpw]").passStrength({ 
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
			    <div class="form-group">
				    <label class='col-md-2  control-label' for="usrpw">输入密码</label>
				     <div class="col-md-4">
				    	<input type="password" class="form-control" id="usrpw" name='usrpw' placeholder="请输入密码" value="<?php echo ($mo['usrpw']); ?>"/>
			    	</div>
			    </div>
			    <div class="form-group">
			    	<label class='col-md-2  control-label' for="usrpwag">再次输入密码</label>
			    	<div class="col-md-4">
			    		<input type="password" class="form-control" id="usrpwag" name='usrpwag' placeholder="再次输入密码" value="<?php echo ($mo['usrpw']); ?>"/>
			      	</div>
			    </div>
			    <div class="form-group">
				    <label class='col-md-2  control-label' for="usrnn">真实姓名</label>
				    <div class="col-md-4">
				    	<input type="text" class="form-control" id="usrnn" name='usrnn' placeholder="真实姓名"  value="<?php echo ($mo['usrnn']); ?>" />
			   		</div>
			   	</div>
			   	 <div class="form-group">
				    <label class='col-md-2  control-label' for="f_usr_sttid">站点名称</label>
				    <div class="col-md-4">
				    	<select name='f_usr_sttid' class='form-control input-sm'>
							<option value='0'>无</option>
							<?php if(is_array($sttls)): $i = 0; $__LIST__ = $sttls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['sttid']); ?>"><?php echo ($vo['sttnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_usr_sttid]').val(<?php echo ($mo['f_usr_sttid']); ?>)</script>
			   		</div>
			   	</div>
			     <div class="form-group">
			    	<label class='col-md-2  control-label' for="usrpt">用户头像</label>
			   		<div class="col-md-4">
				    <!-- file start -->
					 <link rel="stylesheet" href="__PUBLIC__/pblc/FileUpload/uploadify/uploadify.css" />
					 <script type="text/javascript" src='__PUBLIC__/pblc/FileUpload/uploadify/uploadify.js'></script>
					<script type="text/javascript" src="__PUBLIC__/pblc/FileUpload/uploadify/swfobject.js"></script>
					<script type="text/javascript">
					var file_path='__PUBLIC__/pblc/FileUpload';
					var hdlupload='__APP__/FileUpload/upload/issml/y/wjj/usr';
					var upload_path='__ROOT__/Uploads/usr';
					</script>
					<script type="text/javascript" src='__PUBLIC__/pblc/FileUpload/int.js'></script>
					<div>
					<img src="<?php echo ($mo['usrpt']); ?>" alt=""  class='img-thumbnail'  style="width:100px;"  id='imgg'/>
					</div>
					<div style="width:80px; height:26px; overflow:hidden;"><input type="file" name="photo1" id="uploadify"/></div>
					<!-- 隐藏系统所需的用户upt -->
					<input type='hidden' name='usrpt' value="<?php echo ($mo['usrpt']); ?>" id='pt'/>
					<!-- file over -->
			   		</div>
			    </div>
			     <div class="form-group">
				    <label class='col-md-2  control-label' for="usrads">用户办公地址</label>
				    <div class="col-md-4">
				    	<input type="text" class="form-control" id="usrads" name='usrads' placeholder="用户办公地址"  value="<?php echo ($mo['usrads']); ?>" />
			    	</div>
			    </div>
			     <div class="form-group">
				    <label class='col-md-2  control-label' for="usrtlp">用户固话</label>
				    <div class="col-md-4">
				    	<input type="text" class="form-control" id="usrtlp" name='usrtlp' placeholder="用户固话"  value="<?php echo ($mo['usrtlp']); ?>" />
			    	</div>
			    </div>
			    <div class="form-group">
				    <label class='col-md-2  control-label' for="usrcp">用户手机号</label>
				    <div class="col-md-4">
				    	<input type="text" class="form-control" id="usrcp" name='usrcp' placeholder="用户手机号"  value="<?php echo ($mo['usrcp']); ?>" />
			    	</div>
			    </div>
			    <div class="form-group">
				    <label class='col-md-2  control-label'  for="usrml">用户密保邮箱</label>
				    <div class="col-md-4">
				    	<input type="text" class="form-control" id="usrml" name='usrml' placeholder="用户密保邮箱"  value="<?php echo ($mo['usrml']); ?>" />
			    	</div>
			    </div>
			    <div class='form-group'>
			    	<link rel="stylesheet" href="__PUBLIC__/pblc/ueditor/themes/default/ueditor.css"/>
					<script type="text/javascript" src="__PUBLIC__/pblc/ueditor/editor_config.js"></script>
					<script type="text/javascript" src="__PUBLIC__/pblc/ueditor/editor_all.js"></script>
					<label class='col-md-2  control-label'  for="usrml">用户简介</label>
					<div class="col-md-10">
					  <div id="myEditor">
						<script type="text/javascript">
							var editor = new baidu.editor.ui.Editor({
							    initialContent: '<?php echo ($mo["usrintr"]); ?>'
							});
							editor.render("myEditor");
						</script>
						</div>
					
					<textarea name='usrintr' style='display:none'></textarea>
					</div>
			    </div>
			    <div id='errCtn'></div>
			    <input type='hidden' name='usrps' value="0" />
			    <input type='hidden' name='usrvw' value="0" />
			    <input type='hidden' name='usrodr' value="0" />
			    <div class="form-group">
				    <label class='col-md-2  control-label'></label>
					<div class="col-md-4">
						<input type="button" class="btn btn-primary" id='usr_regist' value='注册'/>
				   	</div>
			   	</div>
				</form>
				
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