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
 <style>
.cj{width:30px;}
.cj1{width:30px;}
#lay{
	z-index:1;position:absolute;left:0;top:0;width:100%;height:100%;background:#000;opacity:0.5;filter:alpha(opacity=50);-moz-opacity:0.5;display:none;
}
#ts{
	z-index:2;position:absolute;left:50%;top:50%;width:200px;height:100px;background-color:#1064BE;color:#fff;font-size:20px;text-align:center;line-height:100px;
	margin-left:-100px;margin-top:-50px;display:none;
}
</style>
<script type='text/javascript' src='__PUBLIC__/JS/admin/bkcjzx.js'></script>
<script type='text/javascript'>
var app_path='__APP__';
var hdlcrtu='__URL__/createAlways';
var hdlbc='__URL__/bc';
var hdltj='__URL__/tj';
var hdldlt='__URL__/delete';
var hdlstxk='__URL__/stxk';
var hdlsthk='__URL__/sthk';
</script>
<script>var wqm='<?php echo ($wqm); ?>';var wps='<?php echo ($wps); ?>';var wxt='<?php echo ($wxt); ?>';var rfr='<?php echo ($rfr); ?>';</script>
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
							<div role="tabpanel">
							<!-- Nav tabs -->
							  <ul class="nav nav-tabs" role="tablist">
							    <li role="presentation" style='display:none'><a href="#home" aria-controls="home" role="tab" data-toggle="tab">字段</a></li>
							    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">条件</a></li>
							    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">顺序</a></li>
							  </ul>
							<!-- Tab panes -->
							  <div class="tab-content">
							    <div role="tabpanel" class="tab-pane" id="home" style='display:none'>
							    	<div id='flddv'>
										<input type="checkbox" id='cjzxidfld' value='cjzxid' style='display:none' checked=checked/>
										<input type="checkbox" id='f_cjzx_grdidfld' value='f_cjzx_grdid' style='display:none' checked=checked/>
										<input type="checkbox" id='stdnofld' value='stdno'/>学号&nbsp;&nbsp;
										<input type="checkbox" id='stdnmfld' value='stdnm'/>姓名&nbsp;&nbsp;
										<input type="checkbox" id='sexnmfld' value='sexnm'/>性别&nbsp;&nbsp;
										<input type="checkbox" id='cjzxzffld' value='cjzxzf'/>总分&nbsp;&nbsp;
										<input type="checkbox" id='cjzxqmffld' value='cjzxqmf'/>卷面成绩&nbsp;&nbsp;
										<input type="checkbox" id='cjzxpsffld' value='cjzxpsf'/>平时成绩&nbsp;&nbsp;
										<input type="checkbox" id='cjzxxtffld' value='cjzxxtf'/>习题成绩&nbsp;&nbsp;
										<input type="checkbox" id='cjzxbkffld' value='cjzxbkf'/>补考成绩&nbsp;&nbsp;
										<input type="checkbox" id='cjzxsftjfld' value='cjzxsftj'/>成绩是否提交&nbsp;&nbsp;
										<input type="checkbox" id='cjzxxkfld' value='cjzxxk'/>是否限考&nbsp;&nbsp;
										<input type="checkbox" id='cjzxqkfld' value='cjzxqk'/>是否缺考&nbsp;&nbsp;
										<input type="checkbox" id='cjzxhkfld' value='cjzxhk'/>是否缓考&nbsp;&nbsp;
										<input type="checkbox" id='f_stdxqcls_clsidfld' value='f_stdxqcls_clsid' style='display:none' checked=checked/>
										
									</div>
								</div>
							    <div role="tabpanel" class="tab-pane active" id="profile">
									<div id='cdtdv'>
										年级
										<select name='f_cjzx_grdid' id='f_cjzx_grdidcdt'>
										<?php if(is_array($grdls)): $i = 0; $__LIST__ = $grdls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['grdid']); ?>"><?php echo ($vol['grdnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<select name='f_pk_grdid' id='f_pk_grdidcdt' style='display:none'>
										<?php if(is_array($grdls)): $i = 0; $__LIST__ = $grdls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['grdid']); ?>"><?php echo ($vol['grdnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<select name='f_std_grdid' id='f_std_grdidcdt' style='display:none'>
										<?php if(is_array($grdls)): $i = 0; $__LIST__ = $grdls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['grdid']); ?>"><?php echo ($vol['grdnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										
										
										站点
										<select name='f_cjzx_sttid' id='f_cjzx_sttidcdt'>
										<?php if(is_array($sttls)): $i = 0; $__LIST__ = $sttls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['sttid']); ?>"><?php echo ($vol['sttnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<select name='f_pk_sttid' id='f_pk_sttidcdt' style='display:none'>
										<?php if(is_array($sttls)): $i = 0; $__LIST__ = $sttls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['sttid']); ?>"><?php echo ($vol['sttnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<select name='f_std_sttid' id='f_std_sttidcdt' style='display:none'>
										<?php if(is_array($sttls)): $i = 0; $__LIST__ = $sttls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['sttid']); ?>"><?php echo ($vol['sttnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										
										
										
										
										<br/>
										
										学期
										<select name='f_cjzx_xqid' id='f_cjzx_xqidcdt'>
										<?php if(is_array($xqls)): $i = 0; $__LIST__ = $xqls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['xqid']); ?>"><?php echo ($vol['xqnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<select name='f_pk_xqid' id='f_pk_xqidcdt' style='display:none'>
										<?php if(is_array($xqls)): $i = 0; $__LIST__ = $xqls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['xqid']); ?>"><?php echo ($vol['xqnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<select name='f_stdxqcls_xqid' id='f_stdxqcls_xqidcdt' style='display:none'>
										<?php if(is_array($xqls)): $i = 0; $__LIST__ = $xqls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['xqid']); ?>"><?php echo ($vol['xqnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<select name='f_stdxqmj_xqid' id='f_stdxqmj_xqidcdt' style='display:none'>
										<?php if(is_array($xqls)): $i = 0; $__LIST__ = $xqls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['xqid']); ?>"><?php echo ($vol['xqnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										
										<br/>
										班级
										<select name='f_stdxqcls_clsid' id='f_stdxqcls_clsidcdt'>
										<option value=''>无</option>
										<?php if(is_array($clsls)): $i = 0; $__LIST__ = $clsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['clsid']); ?>">[<?php echo ($vol['sttnm']); ?>]<?php echo ($vol['clsnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										
										<br/>
										课程
										<select name='f_cjzx_pkid' id='f_cjzx_pkidcdt'>
										<option value=''>无</option>
										<?php if(is_array($pkls)): $i = 0; $__LIST__ = $pkls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['pkid']); ?>"><?php echo ($vol['kcnm']); ?>-<?php echo ($vol['tcrnn']); echo ($vol['pkzkkm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										
										<select name='f_std_statid' id='f_std_statidcdt' style='display:none'>
										<option value='5'>在校</option>
										</select>
										
									</div>
									<div id='spccdtdv' style='display:none'>
										<a class='spccdtoff' href='#' rel='(cjzxhk=1 OR (cjzxzf>30 AND cjzxzf<60))'>允许补考条件</a>
									</div>
								</div>
							    <div role="tabpanel" class="tab-pane" id="messages">
									<div id='odrdv'>
										顺序：
										<select  class='input-small' >
										<option value=''>无</option>
										<option value='f_mj_bxxsid DESC'>办学形式降序</option>
										<option value='f_mj_bxxsid ASC'>办学形式升序</option>
										<option value='clsid DESC'>班级降序</option>
										<option value='clsid ASC'>班级升序</option>
										<option value='mjid DESC'>专业降序</option>
										<option value='mjid ASC'>专业升序</option>
										<option value='stdno DESC'>学号降序</option>
										<option value='stdno ASC'>学号升序</option>
										</select>
										<select  class='input-small' >
										<option value=''>无</option>
										<option value='f_mj_bxxsid DESC'>办学形式降序</option>
										<option value='f_mj_bxxsid ASC'>办学形式升序</option>
										<option value='clsid DESC'>班级降序</option>
										<option value='clsid ASC'>班级升序</option>
										<option value='mjid DESC'>专业降序</option>
										<option value='mjid ASC'>专业升序</option>
										<option value='stdno DESC'>学号降序</option>
										<option value='stdno ASC'>学号升序</option>
										</select>
										<select  class='input-small' >
										<option value=''>无</option>
										<option value='f_mj_bxxsid DESC'>办学形式降序</option>
										<option value='f_mj_bxxsid ASC'>办学形式升序</option>
										<option value='clsid DESC'>班级降序</option>
										<option value='clsid ASC'>班级升序</option>
										<option value='mjid DESC'>专业降序</option>
										<option value='mjid ASC'>专业升序</option>
										<option value='stdno DESC'>学号降序</option>
										<option value='stdno ASC'>学号升序</option>
										</select>
										<select  class='input-small' >
										<option value=''>无</option>
										<option value='f_mj_bxxsid DESC'>办学形式降序</option>
										<option value='f_mj_bxxsid ASC'>办学形式升序</option>
										<option value='clsid DESC'>班级降序</option>
										<option value='clsid ASC'>班级升序</option>
										<option value='mjid DESC'>专业降序</option>
										<option value='mjid ASC'>专业升序</option>
										<option value='stdno DESC'>学号降序</option>
										<option value='stdno ASC'>学号升序</option>
										</select>
									</div>
								</div>
							  </div>
							</div>
							
						</div>
						
						
						
						<div>
							<form>
							<input type='hidden' name='fld' id='fld' value='<?php echo ($fld); ?>'/>
							<input type='hidden' name='cdt' value='<?php echo ($cdt); ?>'/>
							<input type='hidden' name='spccdt' value='<?php echo ($spccdt); ?>'/>
							<input type='hidden' name='odr' value='<?php echo ($odr); ?>'/>
							<!-- 每页：<input type='text' name='lmt' value='<?php echo ($lmt); ?>'/>  -->
								<select id='lmt' name='lmt'  class='input-mini' style='display:none'>
								<option value='100'>100</option>
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
				<div>
				<p><?php echo ($pknm); ?>&nbsp;&nbsp;&nbsp;<?php echo ($clsnm); ?></p>
				<p>总分是由系统根据所打的各项成绩根据一定的权重自动计算的</p>
				<p>本科目权重为：卷面成绩占<?php echo ($wqm*100).'%' ?>，平时成绩占<?php echo ($wps*100).'%' ?>，习题成绩占<?php echo ($wxt*100).'%' ?></p>
				<form>
				<input type='hidden' name='rfr' value='<?php echo ($rfr); ?>' />
				<input type='hidden' name='wqm' value='<?php echo ($wqm); ?>' />
				<input type='hidden' name='wps' value='<?php echo ($wps); ?>' />
				<input type='hidden' name='wxt' value='<?php echo ($wxt); ?>' />
				<?php  $tmp=explode('f_cjzx_grdid', $cdt); $tmp=explode('-eq-',$tmp[1]); $tmp=explode('-sp-',$tmp[1]); $grdid=$tmp[0]; ?>
				<input type='hidden' name='f_cjzx_grdid' value='<?php echo ($grdid); ?>'/>
				<div class="table-responsive">
					<table id='NBtb'  class='table table-striped table-bordered table-hover'>
					<thead>
					  <tr class='info'>
					    <th class='odr'>序号</th>
					    <th class='stdno'>学号</th>
					    <th class='stdnm'>姓名</th>
					    <th class='sexnm'>性别</th>
					    <th class='cjzxzf'>总分</th>
					    
					    
					    <th class='cjzxsftj'>成绩是否提交</th>
					    <th class='cjzxxk'>是否限考</th>
					    <th class='cjzxqk'>是否缺考</th>
					    <th class='cjzxhk'>是否缓考</th>
					    <th class='cjzxbkf'>补考成绩</th>
					   
					  </tr>
					</thead>
					
					<tbody>
					  <?php if(is_array($mls)): $i = 0; $__LIST__ = $mls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					    	<td class='odr'><?php echo ($fstrw+$i); ?></td>
					    	<td class='stdno'><?php echo ($vo['stdno']); ?></td>
						    <td class='stdnm'><?php echo ($vo['stdnm']); ?></td>
						    <td class='sexnm'><?php echo ($vo['sexnm']); ?></td>
						    <td class='cjzxzf'><input class='cj1' name="cjzxzf-<?php echo ($vo['cjzxid']); ?>" id="cjzxzf-<?php echo ($vo['cjzxid']); ?>" value="<?php echo ($vo['cjzxzf']); ?>" readonly style='background-color:#ddd;border:1px solid #ccc;'/>
						  
						    
						    <td class='cjzxsftj'><?php echo ($vo['cjzxsftj']); ?></td>
						    <td class='cjzxxk'><?php echo ($vo['cjzxxk']); ?><input type='hidden' id="cjzxxk-<?php echo ($vo['cjzxid']); ?>" value="<?php echo ($vo['cjzxxk']); ?>"></td>
						    <td class='cjzxqk'><?php echo ($vo['cjzxqk']); ?><input type='hidden' id="cjzxqk-<?php echo ($vo['cjzxid']); ?>" value="<?php echo ($vo['cjzxqk']); ?>"></td>
						    <td class='cjzxhk'><?php echo ($vo['cjzxhk']); ?><input type='hidden' id="cjzxhk-<?php echo ($vo['cjzxid']); ?>" value="<?php echo ($vo['cjzxhk']); ?>"></td>
						    <td class='cjzxbkf'><?php if($athm==1&&$vo['cjzxxk']=='否'&&$vo['cjzxhk']=='否'){ ?><input class='cj' name="cjzxbkf-<?php echo ($vo['cjzxid']); ?>" id="cjzxbkf-<?php echo ($vo['cjzxid']); ?>" value="<?php echo ($vo['cjzxbkf']); ?>" /><?php }else{ ?><input class='cj' name="cjzxbkf-<?php echo ($vo['cjzxid']); ?>" id="cjzxbkf-<?php echo ($vo['cjzxid']); ?>" value="<?php echo ($vo['cjzxbkf']); ?>" readonly  style='background-color:#ddd;border:1px solid #ccc;' /><?php } ?></td>
						    
					  </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
					</tbody>
					</table>
				</div>
				<script type="text/javascript">$("#NBtb thead").smartFloatTB();</script>
				<!-- 注意NB 的class 都要设置  结束-->
				<?php echo ($page_method); ?>&nbsp;&nbsp;
				<!-- 
				<?php if($atha==1){ ?><p><a href="__URL__/gtxpg/x/updt/grdid/0/cjzxid/0" class='btn btn-primary'>添加</a></p><?php } ?>
				 -->
				 <br/>
				<?php if($athm==1||$tijiao==0){ ?>
				<?php if($athm==1||$czps==1){ ?><input type='button' class='btn btn-success btn-lg' id='bc' value='保存'/><?php } if($athm==1){ ?><input type='button' style='margin-left:50px;' class='btn btn-danger btn-lg' id='tj' value='提交'/><?php } ?>
				<?php } ?>
				 <br/>
				 </form>
				<!--EXCEL开始-->
				<script type="text/javascript" src='__PUBLIC__/pblc/XLS/xls.js'></script>
				<form action='__APP__/Xls/outputcjzx' method='post'>
				<input type='hidden' name='mk' value='cjzx'/>
				<input type='hidden' name='fld' id='fld' value='<?php echo ($fld); ?>'/>
				<input type='hidden' name='cdt' value='<?php echo ($cdt); ?>'/>
				<input type='hidden' name='spccdt' value='<?php echo ($spccdt); ?>'/>
				<input type='hidden' name='odr' value='<?php echo ($odr); ?>'/>
				<input type='hidden' name='NBsqlstc' value="<?php echo ($sqlstc); ?>"/>
				<input type='hidden' name='xlsnm' value='XX表' class='form-control input-sm' style='width:200px;display:inline'/>
				<input type='hidden' name='biaoji'>
				<br/><br/><input type='button' id='exportbjbkcj' value='生成成绩单' class='btn btn-primary btn-lg' /><input type='submit' id='exporttrue' style='display:none' value='导出数据' />
				<br/><br/><input type='button' id='exportbjbkqd' value='生成签到单' class='btn btn-success btn-lg' />
				<br/><br/><input type='button' id='exportbjbkkb' value='生成空白单' class='btn btn-warning btn-lg' />
				</form>
				
				
				
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
	<div id='lay'></div>
	<div id='ts'></div>
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