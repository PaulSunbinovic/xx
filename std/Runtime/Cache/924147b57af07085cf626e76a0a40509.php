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
<script type='text/javascript' src='__PUBLIC__/JS/std/cm.js'></script>
<link href="__PUBLIC__/CSS/std/cm.css" rel="stylesheet">

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
 
<script type='text/javascript' src='__PUBLIC__/JS/std/cjzx.js'></script>
<script type='text/javascript'>
var app_path='__APP__';
</script>
</head>

<body>

<!-- head包std.js -->
<script type="text/javascript" src='__PUBLIC__/JS/std/stdhd.js'></script>

<script type="text/javascript">
var hdllgin='__APP__/Std/loginin';
var hdllgot='__APP__/Std/loginout';
var app_path='__APP__';
</script>
<header class="navbar navbar-fixed-top" id='divhd' style='background-color:#31b0d5'>
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="__ROOT__/std.php" class="navbar-brand">学生管理系统后台</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
					
					
			<?php if(session('stdidss')){ ?>
					<?php echo ($ntfstr); ?>
					<!-- 
					<li>
					<script>var hdlatcsrc='__APP__/Atc/search/atckw/';</script>
					<script type="text/javascript" src='__PUBLIC__/JS/std/atchd.js'></script>
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
							<img class='img-circle' src="<?php echo ($stdoss['stdpt']); ?>" style='width:20px;height:20px'/> <?php echo ($stdoss['stdnn']); ?> <b class="caret"></b>							
						</a>
						
						<ul class="dropdown-menu">
							<li>
								<a href='__APP__/Std/gtxpg/x/center' id='std_center'><i class="glyphicon glyphicon-user"></i> 个人中心  </a>
							</li>
							<!-- 
							<li>
								<a href="__APP__/Std/gtxpg/x/modifypw"><i class="glyphicon glyphicon-lock"></i> 更改密码</a>
							</li>
							 -->
							<li class="divider"></li>
							
							<li>
								<a href="#" id='std_loginout'><i class="glyphicon glyphicon-off"></i> 注销 </a>
							</li>
						</ul>
					</li>
					<!-- 
					<li>
						<?php if($stdoss['stdid']==1||$stdoss['f_std_sttid']==1){ ?><a href="__APP__/Atc/neiwang"><i class='glyphicon glyphicon-file'></i> 查看内网文章 </a><?php } ?>
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
		var hdlstdbtn='__APP__/Stdbtn/update';
		</script>
		<div class="panel panel-info">
			  <div class="panel-heading">
				    <div class='pull-left'><i class="glyphicon glyphicon-cog"></i> 控制面板</div>
				    <div class='pull-right'><a href="javascript:leftright()"><i class="glyphicon glyphicon-triangle-left"></i></a></div>
				    <div class='clearfix'></div>
			  </div>
			 <div class="panel-body"'>
			 
			 <div class="panel panel-info">
				  <!-- Default panel contents -->
				  <div class="panel-heading">
				  	<div class='pull-left'><i class="glyphicon glyphicon-signal"></i> 后台管理</div>
					<div class='pull-right'><a href="javascript:updown('bs')"><i class="<?php echo ($bscls); ?>" id="bs"></i></a></div>
					<div class='clearfix'></div>
				  </div>
				<!-- List group -->
				  <ul class="nav nav-pills nav-stacked" style="display:<?php echo ($bsbdcls); ?>" id="bsbd">
				    
						<li class='<?php echo ($cxcjcls); ?>'><a href="__APP__/Cjzx/cxcj" >查询成绩</a></li>
					
				  </ul>
				</div>
			  
			  
		    </div>
		</div>
	</div>
	<div class='<?php echo ($rgtcls); ?>' id='rgt' >
		<div class="panel panel-info">
		  <div class="panel-heading">
		    <a href='javascript:leftright()' id='stdbtn-lft' style='display:<?php echo ($lftstdbtncls); ?>'><i class="glyphicon glyphicon-triangle-right"></i></a><i class="glyphicon glyphicon-th-list"></i> <?php echo ($theme); ?>
		  </div>
		  <div class="panel-body" style='min-height:500px'>				
					<div>
						<div class='col-md-2 pull-left'><img class='img-circle' src="<?php echo ($stdoss['stdpt']); ?>" style='width:110px;height:110px'></div>
						<div class='col-md-10 pull-left'>
							<p>姓名：<?php echo ($stdoss['stdnm']); ?></p>
							<p>年级：<?php echo ($stdoss['grdnm']); ?>级</p>
							<p>班级：<?php echo ($stdoss['clsnm']); ?></p>
							<p>专业：<?php echo ($stdoss['mjnm']); ?></p>
						</div>
						
					</div>
					<div>
					<script>var hdlcjcx='__URL__/cxcj'</script>
					<form>
						选择学期：
						<select name='xqid'>
							<option value='0'>所有学期</option>
							<?php if(is_array($xqls)): $i = 0; $__LIST__ = $xqls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$xqv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($xqv['xqid']); ?>"><?php echo ($xqv['xqnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=xqid]').val("<?php echo ($xqid); ?>")</script>
						<input type='button' class='btn btn-info' value='查询' id='cjcx' />
					</form>
					</div>
					
					<div><br/></div>
					<div class="table-responsive">
						<table class='table table-striped table-bordered table-hover'>
							<tr>
								<th>学期</th><th>课程名称</th><th>任课教师</th><th>成绩</th><th>补考成绩</th>
							</tr>
							<?php if(is_array($cjzxls)): $i = 0; $__LIST__ = $cjzxls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cjzxv): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($cjzxv['xqnm']); ?></td><td><?php echo ($cjzxv['kcnm']); ?></td><td><?php echo ($cjzxv['tcrnn']); ?></td><td><?php echo ($cjzxv['cjzxzf']); ?></td><td><?php echo ($cjzxv['cjzxbkf']); ?></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</table>
					</div>
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