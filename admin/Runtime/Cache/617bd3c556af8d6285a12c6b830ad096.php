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
						<a href="__APP__/Atc/neiwang"><i class='glyphicon glyphicon-file'></i> 查看内网文章 </a>
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



<div class='container'>
	<div class="panel panel-default col-md-12" style='float:none;margin:70px auto 0;padding:0;'>
		<div class="panel-heading">
		  <i class="glyphicon glyphicon-th-list"></i> <?php echo ($theme); ?>
		</div>
		<div class="panel-body">	

				<!-- NB 开始 -->
					<script type="text/javascript">var hdlNB='__URL__/query'</script>
					<?php  if($usross['f_usr_athid']==1){ ?>
					<div id='NBsrcMpart'>
						<form>
						SELECT * FROM tb_athmd LEFT JOIN tb_ath ON f_athmd_athid=athid LEFT JOIN tb_md ON f_athmd_mdid=mdid WHERE ahnm LIKE '%Ad%' AND f_athmd_athid=1 ORDER BY athmdid ASC LIMIT 0,10
							<input id='NBsqlstc' name='NBsqlstc' class='col-md-12' value="<?php echo ($sqlstc); ?>"/>
							<br/><input type='button' id='NBsrcM' value='管理员查询' class='btn btn-primary btn-sm'/>
						</form>
					</div>
					<?php } ?>
					
					<div id='NBsrcUpart'>
						<div id='flddv'>
							字段：<!-- uid必须有且不用看见 -->
							<input type="checkbox" id='athmdidfld' value='athmdid' style='display:none' checked=checked/>
							<input type="checkbox" id='athnmfld' value='athnm'/>权限名称&nbsp;&nbsp;
							<input type="checkbox" id='mdnmfld' value='mdnm'/>板块名称名称&nbsp;&nbsp;
							<input type="checkbox" id='athqfld' value='athq'/>浏览权限&nbsp;&nbsp;
							<input type="checkbox" id='athvfld' value='athv'/>查看权限&nbsp;&nbsp;
							<input type="checkbox" id='athmfld' value='athm'/>更新权限&nbsp;&nbsp;
							<input type="checkbox" id='athdfld' value='athd'/>删除权限&nbsp;&nbsp;
							<input type="checkbox" id='athafld' value='atha'/>添加权限&nbsp;&nbsp;
						</div>
						<div id='cdtdv'>
							条件：
							权限名称
							<select name='f_athmd_athid' id='f_athmd_athidcdt'  class='input-small'>
							<option value=''>无</option>
							<?php if(is_array($athls)): $i = 0; $__LIST__ = $athls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['athid']); ?>"><?php echo ($vol['athnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							&nbsp;&nbsp;
							模块名称
							<select name='f_athmd_mdid' id='f_athmd_mdidcdt'  class='input-small'>
							<option value=''>无</option>
							<?php if(is_array($mdls)): $i = 0; $__LIST__ = $mdls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$volII): $mod = ($i % 2 );++$i;?><option value="<?php echo ($volII['mdid']); ?>"><?php echo ($volII['mdnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
							&nbsp;&nbsp;
							
						</div>
						<div id='spccdtdv'>
						</div>
						<div id='odrdv'>
							顺序：
							<select  class='input-small'>
							<option value=''>无</option>
							</select>
							<select  class='input-small'>
							<option value=''>无</option>
							</select>
							<select  class='input-small'>
							<option value=''>无</option>
							</select>
						</div>
						<div>
							<form>
							<input type='hidden' name='fld' id='fld' value='<?php echo ($fld); ?>'/>
							<input type='hidden' name='cdt' value='<?php echo ($cdt); ?>'/>
							<input type='hidden' name='spccdt' value='<?php echo ($spccdt); ?>'/>
							<input type='hidden' name='odr' value='<?php echo ($odr); ?>'/>
							<!-- 每页：<input type='text' name='lmt' value='<?php echo ($lmt); ?>'/>  -->
							每页：<select id='lmt' name='lmt'  class='input-mini'>
								<option value='10'>10</option><option value='20'>20</option><option value='30'>30</option><option value='40'>40</option><option value='50'>50</option>
								</select>
								<script>$('#lmt').val('<?php echo ($lmt); ?>')</script>
							<input type='button' value='查询' id='NBsrcU' class='btn btn-primary btn-sm' />
							</form>
						</div>
					</div>
				
				<!-- NB 结束-->
				
				<!-- 注意NB 的class 都要设置  开始-->
				<script type="text/javascript">var hdldlt='__URL__/delete'</script>
				<div>
				<div class="table-responsive">
					<table id='NBtb'  class='table table-striped table-bordered table-hover'>
					<thead>
					  <tr class='info'>
					    <th class='odr'>序号</th>
					    <th class='athnm'>权限名称</th>
					    <th class='mdnm'>模块名称</th>
					    <th class='athq'>浏览权限</th>
					    <th class='athv'>查看权限</th>
					    <th class='athm'>更新权限</th>
					    <th class='athd'>删除权限</th>
					    <th class='atha'>添加权限</th>
					    <th class='oprt'>操作</th>
					</tr>
					</thead>
					
					<tbody>
					  
					  <tr>
					  <?php if(is_array($mls)): $i = 0; $__LIST__ = $mls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td class='odr'><?php echo ($fstrw+$i); ?></td>
					    <td class='athnm'><?php echo ($vo['athnm']); ?></td>
					    <td class='mdnm'><?php echo ($vo['mdnm']); ?></td>
					    <td class='athq'><?php echo ($vo['athq']); ?></td>
					    <td class='athv'><?php echo ($vo['athv']); ?></td>
					    <td class='athm'><?php echo ($vo['athm']); ?></td>
					    <td class='athd'><?php echo ($vo['athd']); ?></td>
					    <td class='atha'><?php echo ($vo['atha']); ?></td>
					    <td class='oprt'>
					      <!-- Icons -->
					      <?php if($athv=='y'){ ?><a href="__URL__/gtxpg/x/vw/athmdid/<?php echo ($vo['athmdid']); ?>">查看</a><?php } ?>
					      <?php if($athm=='y'){ ?><a href="__URL__/gtxpg/x/updt/athmdid/<?php echo ($vo['athmdid']); ?>">修改</a><?php } ?>
					      <!-- <?php if($athd=='y'){ ?><a href="javascript:dlt(<?php echo ($vo['athmdid']); ?>)">删除</a><?php } ?> -->
					    </td>
					    
					    
					  </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
					</tbody>
					</table>
				</div>
				<script type="text/javascript">$("#NBtb thead").smartFloatTB();</script>
				<!-- 注意NB 的class 都要设置  结束-->
				<?php echo ($page_method); ?>&nbsp;&nbsp;
				
				<!--<?php if($atha=='y'){ ?><p><a href="__URL__/gtxpg/x/updt/athmdid/0" class='btn btn-primary'>添加</a></p><?php } ?>-->
				
				
				
				<!-- NBjs 初始化 -->
				<script type="text/javascript">
				var fld="<?php echo ($fld); ?>";var cdt="<?php echo ($cdt); ?>";var spccdt="<?php echo ($spccdt); ?>";var odr="<?php echo ($odr); ?>";
				</script>
				<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/NB/NBSearch.css" media="all"/>
				<script type='text/javascript' src='__PUBLIC__/pblc/NB/NBSearch.js'></script>
				<!-- NBjs 结束 -->
				
				
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