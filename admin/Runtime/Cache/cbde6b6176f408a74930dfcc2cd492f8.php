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
 
<script type='text/javascript' src='__PUBLIC__/JS/admin/cstmusr.js'></script>
<script type='text/javascript'>
var app_path='__APP__';
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
      <a href="__ROOT__/index.php" class="navbar-brand">Geek</a>
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
							<img class='img-circle' src="<?php echo ($usross['usrpt']); ?>" style='width:20px;height:20px'/> <?php echo ($usross['usrnn']); ?> <b class="caret"></b>							
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
			  <div class="panel-body"'>
			  
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

				<!-- NB 开始 -->
					<script type="text/javascript">var hdlNB='__URL__/query'</script>
					
					
					<div id='NBsrcUpart'>
					<!-- 起始 -->
					<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
				      <h4 class="panel-title">
				        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
				          条件筛选
				        </a>
				      </h4>
				    </div>
				    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
				      <div class="panel-body">
				      	<?php  if($spadm==1){ ?>
						<div id='NBsrcMpart'>
							<form>
							SELECT * FROM tb_u LEFT JOIN tb_ath ON f_u_athid=athid WHERE unm LIKE '%sb%' AND f_u_athid=1 ORDER BY uaddtm DESC LIMIT 0,10
							<br/>SELECT * FROM tb_u LEFT JOIN tb_ath ON f_u_athid=athid WHERE f_u_athid<>1 ORDER BY uaddtm DESC LIMIT 0,10
								<input id='NBsqlstc' name='NBsqlstc' style='width:700px' value="<?php echo ($sqlstc); ?>"/>
								<br/><input type='button' id='NBsrcM' value='管理员查询' class='btn btn-primary btn-sm' />
							</form>
						</div>
						<?php } ?>
				      <!-- 暂时结束 -->
						<div id='flddv'>
							字段：<!-- uid必须有且不用看见 -->
							<input type="checkbox" id='cstmusridfld' value='cstmusrid' style='display:none' checked=checked/>
							<input type="checkbox" id='cstmusrnmfld' value='cstmusrnm'/>客户用户名&nbsp;&nbsp;
							<input type="checkbox" id='cstmusrnnfld' value='cstmusrnn'/>真实姓名&nbsp;&nbsp;
							<input type="checkbox" id='cstmusraddtmfld' value='cstmusraddtm'/>客户用户添加时间&nbsp;&nbsp;
							<input type="checkbox" id='cstmusrmdftmfld' value='cstmusrmdftm'/>客户用户修改时间&nbsp;&nbsp;
							<input type="checkbox" id='cstmusrcpfld' value='cstmusrcp'/>客户用户手机号&nbsp;&nbsp;
							<input type="checkbox" id='cstmusrmlfld' value='cstmusrml'/>客户用户密保邮箱&nbsp;&nbsp;
							<input type="checkbox" id='cstmusrpsfld' value='cstmusrps' style='display:none'/>&nbsp;&nbsp;
							<input type="checkbox" id='cstmusrvwfld' value='cstmusrvw' style='display:none'/>&nbsp;&nbsp;
						</div>
						<div id='cdtdv'>
							条件：
							客户用户名<input type="text" name='cstmusrnm' id='cstmusrnmcdt' class='input-small' />&nbsp;&nbsp;
							真实姓名<input type="text" name='cstmusrnn' id='cstmusrnncdt' class='input-small' />&nbsp;&nbsp;
							<script language="javascript" type="text/javascript" src="__PUBLIC__/pblc/DatePicker/My97DatePicker/WdatePicker.js"></script>
							客户用户添加时间<input type="text" name='cstmusraddtm' id='cstmusraddtmcdt' onclick="WdatePicker()"  class='input-small' />&nbsp;&nbsp;
							客户用户修改时间<input type="text" name='cstmusrmdftm' id='cstmusrmdftmcdt' onclick="WdatePicker()"  class='input-small' />&nbsp;&nbsp;
							客户用户手机号<input type="text" name='cstmusrcp' id='cstmusrcpcdt' class='input-small'/>&nbsp;&nbsp;
							客户用户密保邮箱<input type="text" name='cstmusrml' id='cstmusrmlcdt' class='input-small'/>&nbsp;&nbsp;
							<?php if($aths==1){ ?>
								审核情况
								<select name='cstmusrps' id='cstmusrpscdt' >
								<option value=''>无</option>
								<option value="1">通过</option>
								<option value="0">不通过</option>
								</select>
								&nbsp;&nbsp;
								是否查看
								<select name='cstmusrvw' id='cstmusrvwcdt' >
								<option value=''>无</option>
								<option value="1">是</option>
								<option value="0">否</option>
								</select>
								&nbsp;&nbsp;
							<?php }else{ ?>
								<input type='hidden' name='cstmusrps' id='cstmusrpscdt' />
								<input type='hidden' name='cstmusrvw' id='cstmusrvwcdt' />
							<?php } ?>
							&nbsp;&nbsp;
						</div>
						<div id='spccdtdv'>
						特殊条件：
						<a class='spccdtoff' href='#' rel='(cstmusraddtm<NOW())'>添加日期小于当前时间</a>
						</div>
						<div id='odrdv'>
							顺序：
							<select  class='input-small' >
							<option value=''>无</option>
							<option value='cstmusraddtm DESC'>客户用户添加时间降序</option>
							<option value='cstmusraddtm ASC'>客户用户添加时间升序</option>
							<option value='cstmusrmdftm DESC'>客户用户修改时间降序</option>
							<option value='cstmusrmdftm ASC'>客户用户修改时间升序</option>
							</select>
							<select  class='input-small' >
							<option value=''>无</option>
							<option value='cstmusraddtm DESC'>客户用户添加时间降序</option>
							<option value='cstmusraddtm ASC'>客户用户添加时间升序</option>
							<option value='cstmusrmdftm DESC'>客户用户修改时间降序</option>
							<option value='cstmusrmdftm ASC'>客户用户修改时间升序</option>
							</select>
							<select  class='input-small' >
							<option value=''>无</option>
							<option value='cstmusraddtm DESC'>客户用户添加时间降序</option>
							<option value='cstmusraddtm ASC'>客户用户添加时间升序</option>
							<option value='cstmusrmdftm DESC'>客户用户修改时间降序</option>
							<option value='cstmusrmdftm ASC'>客户用户修改时间升序</option>
							</select>
						</div>
						<div>
							<form>
							<input type='hidden' name='fld' id='fld' value='<?php echo ($fld); ?>'/>
							<input type='hidden' name='cdt' value='<?php echo ($cdt); ?>'/>
							<input type='hidden' name='spccdt' value='<?php echo ($spccdt); ?>'/>
							<input type='hidden' name='odr' value='<?php echo ($odr); ?>'/>
							<!-- 每页：<input type='text' name='lmt' value='<?php echo ($lmt); ?>'/>  -->
							每页：<select id='lmt' name='lmt'  class='input-mini' >
								<option value='10'>10</option><option value='20'>20</option><option value='30'>30</option><option value='40'>40</option><option value='50'>50</option>
								</select>
								<script>$('#lmt').val('<?php echo ($lmt); ?>')</script>
							<input type='button' value='查询' id='NBsrcU' class='btn btn-primary btn-sm'/>
							</form>
						</div>
						
						<!-- 暂时开启 -->
				       </div>
				    </div>
				  </div>
					<!-- 完全结束 -->	
						
					</div>
				
				<!-- NB 结束-->
				
				<!-- 注意NB 的class 都要设置  开始-->
				<script type="text/javascript">var hdldlt='__URL__/delete';var hdlstvw='__URL__/setview';var hdlstps='__URL__/setpass'</script>
				<div>
				<div class="table-responsive">
					<table id='NBtb'  class='table table-striped table-bordered table-hover'>
					<thead>
					  <tr class='info'>
					    <th class='odr'>序号</th>
					    <th class='cstmusrnm'>客户用户名</th>
					    <th class='cstmusrnn'>真实姓名</th>
					    <th class='cstmusraddtm'>客户用户创建时间</th>
					    <th class='cstmusrmdftm'>客户用户修改时间</th>
					    <th class='cstmusrcp'>客户用户手机号</th>
					    <th class='cstmusrml'>客户用户密保邮箱</th>
					    <th class='cstmusrps'>审核情况</th>
					    <th class='cstmusrvw'>是否查看</th>
					    <th class='oprt'>操作</th>
					  </tr>
					</thead>
					
					<tbody>
					  <?php if(is_array($mls)): $i = 0; $__LIST__ = $mls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					    <td class='odr'><?php echo ($fstrw+$i); ?></td>
					    <td class='cstmusrnm'><?php echo ($vo['cstmusrnm']); ?></td>
					    <td class='cstmusrnn'><?php echo ($vo['cstmusrnn']); ?></td>
					    <td class='cstmusraddtm'><?php echo ($vo['cstmusraddtm']); ?></td>
					    <td class='cstmusrmdftm'><?php echo ($vo['cstmusrmdftm']); ?></td>
					    <td class='cstmusrcp'><?php echo ($vo['cstmusrcp']); ?></td>
					    <td class='cstmusrml'><?php echo ($vo['cstmusrml']); ?></td>
					    <td class='cstmusrps'><?php echo ($vo['cstmusrps']); ?></td>
					    <td class='cstmusrvw'><?php echo ($vo['cstmusrvw']); ?></td>
					    <td class='oprt'>
					      <!-- Icons -->
					      <?php if($athv==1){ ?><a href="__URL__/gtxpg/x/vw/cstmusrid/<?php echo ($vo['cstmusrid']); ?>">查看</a><?php } ?>
					      <?php if($athm==1){ ?><a href="__URL__/gtxpg/x/updt/cstmusrid/<?php echo ($vo['cstmusrid']); ?>">修改</a><?php } ?> 
					      <?php if($athd==1){ ?><a href="javascript:dlt(<?php echo ($vo['cstmusrid']); ?>)">删除</a><?php } ?>
					      <?php if($aths==1){ if($vo['cstmusrps']=='是'){ ?><a href="javascript:stps(<?php echo ($vo['cstmusrid']); ?>,0)">设未通过</a><?php }else{ ?><a href="javascript:stps(<?php echo ($vo['cstmusrid']); ?>,1)">设已通过</a><?php } } ?>
					      <?php if($aths==1){ if($vo['cstmusrvw']=='是'){ ?><a href="javascript:stvw(<?php echo ($vo['cstmusrid']); ?>,0)">设未查看</a><?php }else{ ?><a href="javascript:stvw(<?php echo ($vo['cstmusrid']); ?>,1)">设已查看</a><?php } } ?>
					    </td>
					  </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
					</tbody>
					</table>
				</div>
				<script type="text/javascript">$("#NBtb thead").smartFloatTB();</script>
				<!-- 注意NB 的class 都要设置  结束-->
				<?php echo ($page_method); ?>&nbsp;&nbsp;
				
				<?php if($atha==1){ ?><p><a href="__URL__/gtxpg/x/updt/cstmusrid/0" class='btn btn-primary'>添加</a></p><?php } ?>
				
				<!--EXCEL开始-->
				<script type="text/javascript" src='__PUBLIC__/pblc/XLS/xls.js'></script>
				<form action='__APP__/Xls/output' method='post'>
				<input type='hidden' name='mk' value='cstmusr'/>
				<input type='hidden' name='fld' id='fld' value='<?php echo ($fld); ?>'/>
				<input type='hidden' name='cdt' value='<?php echo ($cdt); ?>'/>
				<input type='hidden' name='spccdt' value='<?php echo ($spccdt); ?>'/>
				<input type='hidden' name='odr' value='<?php echo ($odr); ?>'/>
				<input type='hidden' name='NBsqlstc' value="<?php echo ($sqlstc); ?>"/>
				请命名表的名称:<input type='text' name='xlsnm' value='XX表' class='form-control input-sm' style='width:200px;display:inline'/>
				<br/><input type='button' id='export' value='导出数据' class='btn btn-primary'/><input type='submit' id='exporttrue' style='display:none' value='导出数据' />
				</form>
				
				<?php if($athm==1){ ?>
				<!-- xls file start -->
				<a href='__ROOT__/XFile/cstmusr.xls' class='btn btn-warning'>模版</a><input type='hidden' id='mk' value='cstmusr'/>
				 <link rel="stylesheet" href="__PUBLIC__/pblc/XlsUpload/uploadify/uploadify.css"/>
				 <script type="text/javascript" src='__PUBLIC__/pblc/XlsUpload/uploadify/uploadify.js'></script>
				 <link rel="stylesheet" type="text/css"  href="__PUBLIC__/pblc/XlsUpload/uploadify/uploadify.css" />
				<script type="text/javascript" src="__PUBLIC__/pblc/XlsUpload/uploadify/swfobject.js"></script>
				<script type="text/javascript">
				var file_path='__PUBLIC__/pblc/XlsUpload';
				var hdlupload='__APP__/XlsUpload/upload';
				var upload_path='__ROOT__/XlsUploads';
				var hdlxlstosql='__APP__/Xls/import'
				</script>
				<script type="text/javascript" src='__PUBLIC__/pblc/XlsUpload/int.js'></script>
				<div id="status"></div>
				<div style="width:80px; height:26px; overflow:hidden; " id='cf'><input  type="file"  name="xls1" id="uploadify"/></div>
				<!-- xls file over -->
				<?php } ?>
				<!--EXCEL结束-->
				
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