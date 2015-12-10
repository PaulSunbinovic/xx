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
<script type='text/javascript' src='__PUBLIC__/JS/admin/std.js'></script>
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
				
					<ul id="myTab" class="nav nav-tabs" role="tablist">
				      <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">饼状图模式</a></li>
				      <li class="" role="presentation"><a aria-expanded="false" href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">表格模式</a></li>
				    </ul>
				    <div id="myTabContent" class="tab-content">
				      	<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
				        	<script type="text/javascript" src="__PUBLIC__/pblc/PIE/jsapi.js"></script>
							<script type="text/javascript" src="__PUBLIC__/pblc/PIE/corechart.js"></script>		
							<script type="text/javascript" src="__PUBLIC__/pblc/PIE/jquery.gvChart-1.0.1.min.js"></script>
							<script type="text/javascript" src="__PUBLIC__/pblc/PIE/jquery.ba-resize.min.js"></script>	
							
							<?php if(is_array($grdls)): $i = 0; $__LIST__ = $grdls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$grdv): $mod = ($i % 2 );++$i;?><div class="page-header">
								  <h1><?php echo ($grdv['grdnm']); ?>级 <small>共<?php echo ($grdv['zl']['zongnb']); ?>人</small></h1>
								</div>
								<script type="text/javascript">
								gvChartInit();
								$(document).ready(function(){
									$("#sex<?php echo ($grdv['grdnm']); ?>").gvChart({
										chartType: 'PieChart',
										/*gvSettings: {
											vAxis: {title: 'No of players'},
											hAxis: {title: 'Month'},
											width: 400,
											height: 350
										}*/
									});
								});
								</script>
								<div class='col-md-6'>
								<table id="sex<?php echo ($grdv['grdnm']); ?>">
									<caption>性别分布</caption>
									<thead>
										<tr>
											<th></th>
											<th>男</th>
											<th>女</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th><?php echo ($grdv['zl']['zongnb']); ?></th>
											<td><?php echo ($grdv['zl']['bynb']); ?></td>
											<td><?php echo ($grdv['zl']['glnb']); ?></td>
										</tr>
									</tbody>
								</table>
								</div>
								<script type="text/javascript">
								gvChartInit();
								$(document).ready(function(){
									$("#bxxs<?php echo ($grdv['grdnm']); ?>").gvChart({
										chartType: 'PieChart',
										/*gvSettings: {
											vAxis: {title: 'No of players'},
											hAxis: {title: 'Month'},
											width: 400,
											height: 350
										}*/
									});
								});
								</script>
								<div class='col-md-6'>
								<table id="bxxs<?php echo ($grdv['grdnm']); ?>">
									<caption>办学形式分布</caption>
									<thead>
										<tr>
											<th></th>
											<?php if(is_array($grdv['zl']['bxxs'])): $i = 0; $__LIST__ = $grdv['zl']['bxxs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bxxsv): $mod = ($i % 2 );++$i;?><th><?php echo ($bxxsv['bxxsnm']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th><?php echo ($grdv['zl']['zongnb']); ?></th>
											<?php if(is_array($grdv['zl']['bxxs'])): $i = 0; $__LIST__ = $grdv['zl']['bxxs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bxxsv): $mod = ($i % 2 );++$i;?><td><?php echo ($bxxsv['bxxscnt']); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
											
										</tr>
									</tbody>
								</table>
								</div>
								<script type="text/javascript">
								gvChartInit();
								$(document).ready(function(){
									$("#dm<?php echo ($grdv['grdnm']); ?>").gvChart({
										chartType: 'PieChart',
										/*gvSettings: {
											vAxis: {title: 'No of players'},
											hAxis: {title: 'Month'},
											width: 400,
											height: 350
										}*/
									});
								});
								</script>
								<div class='col-md-6'>
								<table id="dm<?php echo ($grdv['grdnm']); ?>">
									<caption>住宿分布</caption>
									<thead>
										<tr>
											<th></th>
											<?php if(is_array($grdv['zl']['dm'])): $i = 0; $__LIST__ = $grdv['zl']['dm'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dmv): $mod = ($i % 2 );++$i;?><th><?php echo ($dmv['dmnm']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th><?php echo ($grdv['zl']['zongnb']); ?></th>
											<?php if(is_array($grdv['zl']['dm'])): $i = 0; $__LIST__ = $grdv['zl']['dm'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dmv): $mod = ($i % 2 );++$i;?><td><?php echo ($dmv['dmcnt']); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
											
										</tr>
									</tbody>
								</table>
								</div>
								<script type="text/javascript">
								gvChartInit();
								$(document).ready(function(){
									$("#gatxo<?php echo ($grdv['grdnm']); ?>").gvChart({
										chartType: 'PieChart',
										/*gvSettings: {
											vAxis: {title: 'No of players'},
											hAxis: {title: 'Month'},
											width: 400,
											height: 350
										}*/
									});
								});
								</script>
								<div class='col-md-6'>
								<table id="gatxo<?php echo ($grdv['grdnm']); ?>">
									<caption>港澳台西藏及其他学生分布</caption>
									<thead>
										<tr>
											<th></th>
											<th>香港</th>
											<th>澳门</th>
											<th>台湾</th>
											<th>西藏</th>
											<th>其他</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th><?php echo ($grdv['zl']['zongnb']); ?></th>
											<td><?php echo ($grdv['zl']['hknb']); ?></td>
											<td><?php echo ($grdv['zl']['mcnb']); ?></td>
											<td><?php echo ($grdv['zl']['twnb']); ?></td>
											<td><?php echo ($grdv['zl']['tbnb']); ?></td>
											<td><?php echo ($grdv['zl']['otnb']); ?></td>
										</tr>
									</tbody>
								</table>
								</div>
								<script type="text/javascript">
								gvChartInit();
								$(document).ready(function(){
									$("#cls<?php echo ($grdv['grdnm']); ?>").gvChart({
										chartType: 'PieChart',
										/*gvSettings: {
											vAxis: {title: 'No of players'},
											hAxis: {title: 'Month'},
											width: 400,
											height: 350
										}*/
									});
								});
								</script>
								<div class='col-md-6'>
								<table id="cls<?php echo ($grdv['grdnm']); ?>">
									<caption>班级分布</caption>
									<thead>
										<tr>
											<th></th>
											<?php if(is_array($grdv['zl']['cls'])): $i = 0; $__LIST__ = $grdv['zl']['cls'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$clsv): $mod = ($i % 2 );++$i;?><th><?php echo ($clsv['clsnm']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th><?php echo ($grdv['zl']['zongnb']); ?></th>
											<?php if(is_array($grdv['zl']['cls'])): $i = 0; $__LIST__ = $grdv['zl']['cls'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$clsv): $mod = ($i % 2 );++$i;?><td><?php echo ($clsv['clscnt']); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
											
										</tr>
									</tbody>
								</table>
								</div>
								<script type="text/javascript">
								gvChartInit();
								$(document).ready(function(){
									$("#mj<?php echo ($grdv['grdnm']); ?>").gvChart({
										chartType: 'PieChart',
										/*gvSettings: {
											vAxis: {title: 'No of players'},
											hAxis: {title: 'Month'},
											width: 400,
											height: 350
										}*/
									});
								});
								</script>
								<div class='col-md-6'>
								<table id="mj<?php echo ($grdv['grdnm']); ?>">
									<caption>专业分布</caption>
									<thead>
										<tr>
											<th></th>
											<?php if(is_array($grdv['zl']['mj'])): $i = 0; $__LIST__ = $grdv['zl']['mj'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mjv): $mod = ($i % 2 );++$i;?><th><?php echo ($mjv['mjnm']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th><?php echo ($grdv['zl']['zongnb']); ?></th>
											<?php if(is_array($grdv['zl']['mj'])): $i = 0; $__LIST__ = $grdv['zl']['mj'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mjv): $mod = ($i % 2 );++$i;?><td><?php echo ($mjv['clscnt']); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
											
										</tr>
									</tbody>
								</table>
								</div>
								<div class='clearfix'></div><?php endforeach; endif; else: echo "" ;endif; ?>
				      	</div>
				      	<div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
					        <?php if(is_array($grdls)): $i = 0; $__LIST__ = $grdls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$grdv): $mod = ($i % 2 );++$i;?><div class="page-header">
								  <h1><?php echo ($grdv['grdnm']); ?>级 <small>共<?php echo ($grdv['zl']['zongnb']); ?>人</small></h1>
								</div>
								
								<div class='col-md-12'>
								<table class='table table-striped table-bordered table-hover'>
									<caption>性别分布</caption>
									<thead>
										<tr>
											<th>总数</th>
											<th>男</th>
											<th>女</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo ($grdv['zl']['zongnb']); ?></td>
											<td><?php echo ($grdv['zl']['bynb']); ?></td>
											<td><?php echo ($grdv['zl']['glnb']); ?></td>
										</tr>
									</tbody>
								</table>
								</div>
								
								<div class='col-md-12'>
								<table class='table table-striped table-bordered table-hover'>
									<caption>办学形式分布</caption>
									<thead>
										<tr>
											<th>总数</th>
											<?php if(is_array($grdv['zl']['bxxs'])): $i = 0; $__LIST__ = $grdv['zl']['bxxs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bxxsv): $mod = ($i % 2 );++$i;?><th><?php echo ($bxxsv['bxxsnm']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo ($grdv['zl']['zongnb']); ?></td>
											<?php if(is_array($grdv['zl']['bxxs'])): $i = 0; $__LIST__ = $grdv['zl']['bxxs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bxxsv): $mod = ($i % 2 );++$i;?><td><?php echo ($bxxsv['bxxscnt']); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
											
										</tr>
									</tbody>
								</table>
								</div>
								
								<div class='col-md-12'>
								<table class='table table-striped table-bordered table-hover'>
									<caption>住宿分布</caption>
									<thead>
										<tr>
											<th>总数</th>
											<?php if(is_array($grdv['zl']['dm'])): $i = 0; $__LIST__ = $grdv['zl']['dm'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dmv): $mod = ($i % 2 );++$i;?><th><?php echo ($dmv['dmnm']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo ($grdv['zl']['zongnb']); ?></td>
											<?php if(is_array($grdv['zl']['dm'])): $i = 0; $__LIST__ = $grdv['zl']['dm'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dmv): $mod = ($i % 2 );++$i;?><td><?php echo ($dmv['dmcnt']); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
											
										</tr>
									</tbody>
								</table>
								</div>
								
								<div class='col-md-12'>
								<table class='table table-striped table-bordered table-hover'>
									<caption>港澳台西藏及其他学生分布</caption>
									<thead>
										<tr>
											<th>总数</th>
											<th>香港</th>
											<th>澳门</th>
											<th>台湾</th>
											<th>西藏</th>
											<th>其他</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo ($grdv['zl']['zongnb']); ?></td>
											<td><?php echo ($grdv['zl']['hknb']); ?></td>
											<td><?php echo ($grdv['zl']['mcnb']); ?></td>
											<td><?php echo ($grdv['zl']['twnb']); ?></td>
											<td><?php echo ($grdv['zl']['tbnb']); ?></td>
											<td><?php echo ($grdv['zl']['otnb']); ?></td>
										</tr>
									</tbody>
								</table>
								</div>
								
								<div class='col-md-12'>
								<table class='table table-striped table-bordered table-hover'>
									<caption>班级分布</caption>
									<thead>
										<tr>
											<th>总数</th>
											<?php if(is_array($grdv['zl']['cls'])): $i = 0; $__LIST__ = $grdv['zl']['cls'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$clsv): $mod = ($i % 2 );++$i;?><th><?php echo ($clsv['clsnm']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo ($grdv['zl']['zongnb']); ?></td>
											<?php if(is_array($grdv['zl']['cls'])): $i = 0; $__LIST__ = $grdv['zl']['cls'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$clsv): $mod = ($i % 2 );++$i;?><td><?php echo ($clsv['clscnt']); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
											
										</tr>
									</tbody>
								</table>
								</div>
								
								<div class='col-md-12'>
								<table class='table table-striped table-bordered table-hover'>
									<caption>专业分布</caption>
									<thead>
										<tr>
											<th>总数</th>
											<?php if(is_array($grdv['zl']['mj'])): $i = 0; $__LIST__ = $grdv['zl']['mj'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mjv): $mod = ($i % 2 );++$i;?><th><?php echo ($mjv['mjnm']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo ($grdv['zl']['zongnb']); ?></td>
											<?php if(is_array($grdv['zl']['mj'])): $i = 0; $__LIST__ = $grdv['zl']['mj'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mjv): $mod = ($i % 2 );++$i;?><td><?php echo ($mjv['clscnt']); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
											
										</tr>
									</tbody>
								</table>
								</div>
								<div class='clearfix'></div><?php endforeach; endif; else: echo "" ;endif; ?>
				     	</div>
				      	
				     </div>
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