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
<script type='text/javascript' src='__PUBLIC__/JS/stdwap/cm.js'></script>
<link href="__PUBLIC__/CSS/stdwap/cm.css" rel="stylesheet">
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

<script type='text/javascript' src='__PUBLIC__/JS/stdwap/std.js'></script>
<script type='text/javascript'>
var hdlurl='__APP__/Std/loginin';
var url_path='__URL__';
var app_path='__APP__';
</script>



<link type="text/css" rel="stylesheet" href="__PUBLIC__/CSS/stdwap/demo.css" />

<!--必要样式-->
<link type="text/css" rel="stylesheet" href="__PUBLIC__/CSS/stdwap/jquery.mmenu.css" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/CSS/stdwap/jquery.mmenu.dragopen.css" />


<script type="text/javascript" src="__PUBLIC__/JS/stdwap/jquery.mmenu.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/JS/stdwap/jquery.mmenu.dragopen.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/JS/stdwap/jquery.mmenu.fixedelements.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/JS/stdwap/mn.js"></script>
</head>
<body>
<div id="page">
	<!-- head包cstmusr.js -->

<div class="header FixedTop" id='header'>
	<a href='#menu' id='menu'></a>
	<?php echo ($cprtnm); ?>
	<a id='home' href='javascript:history.go(-1)'><i class='glyphicon glyphicon-menu-left' style='font-size:22px;top:5px'></i></a>
</div>
	<div class="content" id="content" style='margin-top:20px'>
		
		<div class="col-md-12" >
            
            
            <div class='col-md-4' style='float:none;margin:0px auto 0;padding:0;' >
				<div class="panel panel-info">
				  <div class="panel-heading">
				    <i class="glyphicon glyphicon-user"></i> <?php echo ($theme); ?>
				  </div>
				  <div class="panel-body">
						<div>
							<div class='col-md-2 pull-left'><img class='img-circle' src="<?php echo ($stdoss['stdpt']); ?>" style='width:110px;height:110px'></div>
							<div class='col-md-5 pull-right'>
								<p>姓名：<?php echo ($stdoss['stdnm']); ?></p>
								<p>年级：<?php echo ($stdoss['grdnm']); ?>级</p>
								<p>班级：<?php echo ($stdoss['clsnm']); ?></p>
								<p>专业：<?php echo ($stdoss['mjnm']); ?></p>
							</div>
							
						</div>
						<div class='clearfix'></div>
						<div><p><?php echo ($xqnm); ?></p></div>
						<div>
							<table class='table table-striped table-bordered table-hover'>
								<tr>
									<th>课程名称</th><th>任课教师</th><th>成绩</th><th>补考成绩</th>
								</tr>
								<?php if(is_array($cjzxls)): $i = 0; $__LIST__ = $cjzxls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cjzxv): $mod = ($i % 2 );++$i;?><tr>
									<td><?php echo ($cjzxv['kcnm']); ?></td><td><?php echo ($cjzxv['tcrnn']); ?></td><td><?php echo ($cjzxv['cjzxzf']); ?></td><td><?php echo ($cjzxv['cjzxbkf']); ?></td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							</table>
						</div>
						
				  </div>
				</div>
			</div>
			
        </div>
       
	</div>
	
	
	
<script  type="text/javascript" src="__PUBLIC__/pblc/gotop/gotop.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/gotop/gotop.css" media="all"/>
	 <script type='text/javascript' src='__PUBLIC__/JS/zsptwap/stdhd.js'></script>
<script type='text/javascript' src='__PUBLIC__/JS/zsptwap/wxusrhd.js'></script>
<script>var hdlstdlgot='__APP__/Std/loginout';</script>
<script>var hdlwxlgot='__APP__/Wxusr/loginout';</script>
<script>var app_path='__APP__';</script>
<script>var hdlstdlgin='__APP__/Std/loginin';</script>
<nav id="menu" style='z-index:2000'>
	<ul>
	<?php if($stdoss){ ?>
		<li>
		<a href="__APP__/Std/gtxpg/x/vw"><img src="<?php echo ($stdoss['stdpt']); ?>" class='img-circle' style='width:30px;height:30px' />&nbsp;&nbsp;<?php echo ($stdoss['stdnm']); ?>&nbsp;&nbsp;的个人中心</a>&nbsp;&nbsp;
		</li>
		<li id='std_loginout'>
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
		<a href='#' data-toggle='modal' data-target='#myModal'><i class='glyphicon glyphicon-user'></i> 登录</a>
		</li>
	<?php } ?>	
	<script>var hdlatcsrc='__APP__/Atc/query/atckw/';</script>
	<script type="text/javascript" src='__PUBLIC__/JS/zsptwap/atchd.js'></script>
	<li><a><input style='background-color:#333;border:1px;border-bottom-style:solid;border-top-style:none;border-left-style:none;border-right-style:none;' id='atckw' /> <i class='glyphicon glyphicon-search' id='atc_search'></i></a></li>
	<li><a href='__APP__'><i class='glyphicon glyphicon-home'></i> 首页</a></li>
	</ul>
</nav>


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
			    <input type="text" class="form-control" name='stdidcd' id="stdidcd" placeholder="请输入身份证号码">
			  </div>
			  <!-- 
			  <div class="checkbox">
			    <label>
			      <input type="checkbox" id='rmb'><input type='hidden' name='rmb'> 下次自动登录
			    </label>
			  </div>
			   -->
			  <div id='errCtn'></div>
			  <input type="button" class="btn btn-success btn-lg btn-block" value='登录' id='std_logininIdx'>
			  
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