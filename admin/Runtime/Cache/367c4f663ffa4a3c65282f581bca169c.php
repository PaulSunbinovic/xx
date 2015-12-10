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
<link rel="stylesheet" href="__PUBLIC__/CSS/admin/std.css"/>
<script type='text/javascript' src='__PUBLIC__/JS/admin/cw.js'></script>
<script type='text/javascript'>
url_path='__URL__';
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
	<div class='col-md-2' id='lft' class='pull-left' style='display:<?php echo ($lftcls); ?>'>
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
			  
		  	<?php if(is_array($lblskzmb)): $i = 0; $__LIST__ = $lblskzmb;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="panel panel-info">
				  <!-- Default panel contents -->
				  <div class="panel-heading">
				  	<div class='pull-left'><i class="glyphicon glyphicon-signal"></i> <?php echo ($vo['lbnm']); ?></div>
					<div class='pull-right'><a href="javascript:updown('bs<?php echo ($vo[lbid]); ?>')"><i class="<?php echo ($vo['bscls']); ?>" id="bs<?php echo ($vo['lbid']); ?>"></i></a></div>
					<div class='clearfix'></div>
				  </div>
				<!-- List group -->
				  <ul class="nav nav-pills nav-stacked" style="display:<?php echo ($vo['bsbdcls']); ?>" id="bs<?php echo ($vo['lbid']); ?>bd">
				    <?php if(is_array($vo['mdlskzmb'])): $i = 0; $__LIST__ = $vo['mdlskzmb'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voII): $mod = ($i % 2 );++$i;?><li class="<?php echo ($voII['actvcls']); ?>"><a href="__APP__/<?php echo ($voII['mdmk']); ?>/query"><?php echo ($voII['mdnm']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				  </ul>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		    </div>
			</div>
		</div>
		<div class='<?php echo ($rgtcls); ?>' id='rgt'>
			<div class="panel panel-default">
				<div class="panel-heading">
				  <a href='javascript:leftright()' id='btn-lft' style='display:<?php echo ($lftbtncls); ?>'><i class="glyphicon glyphicon-triangle-right"></i></a><i class="glyphicon glyphicon-th-list"></i> <?php echo ($theme); ?>
				</div>
				<div class="panel-body">
					<div><span class='pull-left' style='margin-left:50px'><img src="<?php echo ($mo['stdpt']); ?>"  class='img-circle' style='height:80px;width:80px'/></span><span class='pull-left' style='line-height:80px'>&nbsp;&nbsp;&nbsp;<?php echo ($mo['stdnm']); ?>&nbsp;&nbsp;&nbsp;<?php echo ($mo['stdno']); ?>&nbsp;&nbsp;&nbsp;<?php echo ($mo['xnnm']); ?>学年</div>
					<div class='clearfix'></div>
					<div class='mingxi'>
					学籍信息：
					<table>
					<tr>
					<td>
					<input type='hidden' name='stdid' value="<?php echo ($mo['stdid']); ?>" />
					办学形式：
					</td>
					<td colspan=3>
					<?php echo ($mo['bxxsnm']); ?>
					</td>
					<td>
					站点：
					</td>
					<td>
					<?php echo ($mo['sttnm']); ?>
					</td>
					<td>
					年级：
					</td>
					<td>
					<?php echo ($mo['grdnm']); ?>
					</td>
					<td>
					学期：
					</td>
					<td>
					<?php echo ($mo['xqnm']); ?>
					</td>
					</tr>
					<tr>
					<td>
					层次：
					</td>
					<td>
					<?php echo ($mo['ccnm']); ?>
					</td>
					<td>
					科类：
					</td>
					<td>
					<?php echo ($mo['klnm']); ?>
					</td>
					<td>
					学习形式：
					</td>
					<td>
					<?php echo ($mo['xxxsnm']); ?>
					</td>
					<td>
					招生范围：
					</td>
					<td>
					<?php echo ($mo['zsfwnm']); ?>
					</td>
					<td>
					注册学制：
					</td>
					<td>
					<?php echo ($mo['xznm']); ?>
					</td>
					</tr>
					<tr>
					<td>班级：</td>
					<td colspan=9>
					<?php echo ($mo['clsnm']); ?>
					</td>
					</tr>
					<tr>
					<td>专业：</td>
					<td colspan=9>
					[<?php echo ($mo['bxxsnmst']); ?>]<?php echo ($mo['mjdm']); echo ($mo['mjnm']); ?>
					</td>
					</tr>
					</table>
					</div>
					<div class='mingxi'>
					基本信息
					<table>
					
					<tr>
					<td>姓名</td><td><?php echo ($mo['stdnm']); ?></td>
					<td>报名号</td><td><?php echo ($mo['stdaplno']); ?></td>
					
					<td>
					性别
					</td>
					<td>
					<?php echo ($mo['sexnm']); ?>
					</td>
					<td>
					寝室
					</td>
					<td>
					<?php echo ($mo['dmnm']); ?>
					</td>
					</tr>
					
					</table>
					
					</div>
					
					
					<div class='mingxi'>
					缴费情况：
					<table>
					
					<tr>
					<td>应缴学费（含报名费）：</td><td><?php echo ($mo['cwyjxfsm']); ?></td><td>实缴学费（含报名费）：</td><td><?php echo ($mo['cwsjxfsm']); ?></td>
					</tr>
					<tr>
					<td>应缴教材考务费：</td><td><?php echo ($mo['cwyjjckwfsm']); ?></td><td>实缴教材考务费：</td><td><?php echo ($mo['cwsjjckwfsm']); ?></td>
					</tr>
					<tr>
					<td>应缴住宿费：</td><td><?php echo ($mo['cwyjzsfsm']); ?></td><td>实缴住宿费：</td><td><?php echo ($mo['cwsjzsfsm']); ?></td>
					</tr>
					<tr>
					<td>应缴总额：</td><td><?php echo ($mo['cwyjze']); ?></td><td>实缴总额：</td><td><?php echo ($mo['cwsjze']); ?></td>
					</tr>
					
					</table>
					
					</div>
					
					
					<?php if($athm==1){ ?><a href="__URL__/gtxpg/x/updt/cwid/<?php echo ($mo['cwid']); ?>"  class='btn btn-warning'>前往修改信息</a><?php } ?>
					<div class='clearfix'></div>
					<br/>
					
					特殊情况:
					<div class='clearfix'></div>
					<table class="table table-striped">
						<tr><th>时间</th><th>具体情况</th></tr>
						<?php if(is_array($tsqkls)): $i = 0; $__LIST__ = $tsqkls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($vo['tsqktm']); ?></td><td><?php echo ($vo['tsqknr']); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</table>
					<a href="#"  class='btn btn-success'>前往特殊情况中心</a>
					<div class='clearfix'></div>		
								
					
					
				
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