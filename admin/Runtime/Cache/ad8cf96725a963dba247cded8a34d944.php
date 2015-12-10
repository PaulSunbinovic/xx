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
 
<script type='text/javascript' src='__PUBLIC__/JS/admin/zsstd.js'></script>
<script type='text/javascript'>
var app_path='__APP__';
var hdlcrtu='__URL__/createAlways';
var hdlclswithstdno='__URL__/hdlclswithstdno';
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
				
					<?php if($usross['f_usr_sttid']==1||$usross['usrid']==1){ ?>
					<div class="panel panel-default">
					  <div class="panel-body">
					    <a class='btn btn-success' href='__URL__/gtxpg/x/stddtfx'>学生数据分析</a>
					  </div>
					</div>
					<?php } ?>
				

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
							    <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">字段</a></li>
							    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">条件</a></li>
							    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">顺序</a></li>
							  </ul>
							<!-- Tab panes -->
							  <div class="tab-content">
							    <div role="tabpanel" class="tab-pane" id="home">
							    	<div id='flddv'>
										<input type="checkbox" id='stdidfld' value='stdid' style='display:none' checked=checked/>
										<input type="checkbox" id='bxxsnmfld' value='bxxsnm'/>办学形式&nbsp;&nbsp;
										<input type="checkbox" id='sttnmfld' value='sttnm'/>站点名称&nbsp;&nbsp;
										<input type="checkbox" id='ccnmfld' value='ccnm'/>层次&nbsp;&nbsp;
										<input type="checkbox" id='klnmfld' value='klnm'/>科类&nbsp;&nbsp;
										<input type="checkbox" id='xxxsnmfld' value='xxxsnm'/>学习形式&nbsp;&nbsp;
										<input type="checkbox" id='zsfwnmfld' value='zsfwnm'/>招生范围&nbsp;&nbsp;
										<input type="checkbox" id='xznmfld' value='xznm'/>学制&nbsp;&nbsp;
										<input type="checkbox" id='f_std_grdidfld' value='f_std_grdid' style='display:none' checked=checked/>
										<input type="checkbox" id='grdnmfld' value='grdnm'/>年级&nbsp;&nbsp;
										<input type="checkbox" id='f_stdxqcls_xqidfld' value='f_stdxqcls_xqid' style='display:none' checked=checked/>
										<input type="checkbox" id='xqnmfld' value='xqnm'/>学期&nbsp;&nbsp;
										<input type="checkbox" id='stdaplnofld' value='stdaplno'/>报名号&nbsp;&nbsp;
										<input type="checkbox" id='stdnofld' value='stdno'/>学号&nbsp;&nbsp;<br/>
										<input type="checkbox" id='stdupfnctmfld' value='stdupfnctm'/>上传财务时间&nbsp;&nbsp;
										<input type="checkbox" id='stdnmfld' value='stdnm'/>姓名&nbsp;&nbsp;
										<input type="checkbox" id='f_stdxqcls_clsidfld' value='f_stdxqcls_clsid' style='display:none' checked=checked/>
										<input type="checkbox" id='clsnmfld' value='clsnm'/>班级&nbsp;&nbsp;
										<input type="checkbox" id='dmnmfld' value='dmnm'/>寝室&nbsp;&nbsp;
										<input type="checkbox" id='sexnmfld' value='sexnm'/>性别&nbsp;&nbsp;
										<input type="checkbox" id='rcnmfld' value='rcnm'/>民族&nbsp;&nbsp;
										<input type="checkbox" id='zzmmnmfld' value='zzmmnm'/>政治面貌&nbsp;&nbsp;
										<input type="checkbox" id='stdnpfld' value='stdnp'/>籍贯&nbsp;&nbsp;
										<input type="checkbox" id='stdbtdfld' value='stdbtd' style='display:none' checked=checked/>
										<input type="checkbox" id='stdsolfld' value='stdsol'/>文理科&nbsp;&nbsp;<br/>
										<input type="checkbox" id='stdceefld' value='stdcee'/>高考成绩&nbsp;&nbsp;
										<input type="checkbox" id='stdsogfld' value='stdsog'/>毕业学校&nbsp;&nbsp;
										<input type="checkbox" id='stdqqfld' value='stdqq'/>QQ&nbsp;&nbsp;
										<input type="checkbox" id='xlnmfld' value='xlnm'/>最高学历&nbsp;&nbsp;
										<input type="checkbox" id='stdidcdfld' value='stdidcd'/>身份证号码&nbsp;&nbsp;
										<input type="checkbox" id='stdcpfld' value='stdcp'/>手机号码&nbsp;&nbsp;<br/>
										<input type="checkbox" id='stdrltafld' value='stdrlta'/>家长一关系&nbsp;&nbsp;
										<input type="checkbox" id='stdrltanmfld' value='stdrltanm'/>家长一姓名&nbsp;&nbsp;
										<input type="checkbox" id='stdrltaocptfld' value='stdrltaocpt'/>家长一职业&nbsp;&nbsp;
										<input type="checkbox" id='stdrltacpfld' value='stdrltacp'/>家长一手机号码&nbsp;&nbsp;
										<input type="checkbox" id='stdrltbfld' value='stdrltb'/>家长二关系&nbsp;&nbsp;
										<input type="checkbox" id='stdrltbnmfld' value='stdrltbnm'/>家长二姓名&nbsp;&nbsp;
										<input type="checkbox" id='stdrltbocptfld' value='stdrltbocpt'/>家长二职业&nbsp;&nbsp;
										<input type="checkbox" id='stdrltbcpfld' value='stdrltbcp'/>家长二手机号码&nbsp;&nbsp;<br/>
										<input type="checkbox" id='stdhbfld' value='stdhb'/>爱好&nbsp;&nbsp;
										<input type="checkbox" id='mjnmfld' value='mjnm'/>专业&nbsp;&nbsp;
										<input type="checkbox" id='statnmfld' value='statnm'/>状态&nbsp;&nbsp;
										<input type="checkbox" id='stdpstfld' value='stdpst'/>邮箱&nbsp;&nbsp;
										<input type="checkbox" id='stdadsfld' value='stdads'/>地址&nbsp;&nbsp;
										<input type="checkbox" id='stdmdftmfld' value='stdmdftm'/>修改时间&nbsp;&nbsp;
										<input type="checkbox" id='stdaddtmfld' value='stdaddtm'/>添加时间&nbsp;&nbsp;
										<input type="checkbox" id='stdtlpfld' value='stdtlp'/>学生固话&nbsp;&nbsp;
										<input type="checkbox" id='stdpertmfld' value='stdpertm'/>发预录取通知时间&nbsp;&nbsp;
										<input type="checkbox" id='stdertmfld' value='stdertm'/>发录取通知时间&nbsp;&nbsp;
										<input type="checkbox" id='stdrcmdnmfld' value='stdrcmdnm'/>推荐人姓名&nbsp;&nbsp;
										<input type="checkbox" id='stdrcmdcpfld' value='stdrcmdcp'/>推荐人手机号码&nbsp;&nbsp;
										<input type="checkbox" id='stdpnttmfld' value='stdpnttm'/>打印时间&nbsp;&nbsp;
									</div>
								</div>
							    <div role="tabpanel" class="tab-pane active" id="profile">
									<div id='cdtdv'>
										学籍信息：<br/>
										办学形式
										<select name='f_mj_bxxsid' id='f_mj_bxxsidcdt'>
										<option value=''>无</option>
										<?php if(is_array($bxxsls)): $i = 0; $__LIST__ = $bxxsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['bxxsid']); ?>"><?php echo ($vol['bxxsnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										站点
										<select name='f_std_sttid' id='f_std_sttidcdt'>
										<?php if(is_array($sttls)): $i = 0; $__LIST__ = $sttls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['sttid']); ?>"><?php echo ($vol['sttnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										年级
										<select name='f_std_grdid' id='f_std_grdidcdt'>
										
										<?php if(is_array($grdls)): $i = 0; $__LIST__ = $grdls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['grdid']); ?>"><?php echo ($vol['grdnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										
										<select name='f_stdxqcls_xqid' id='f_stdxqcls_xqidcdt' style='display:none'>
										<?php if(is_array($xqls)): $i = 0; $__LIST__ = $xqls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['xqid']); ?>"><?php echo ($vol['xqnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<select name='f_stdxqmj_xqid' id='f_stdxqmj_xqidcdt' style='display:none'>
										<?php if(is_array($xqls)): $i = 0; $__LIST__ = $xqls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['xqid']); ?>"><?php echo ($vol['xqnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<select name='f_stdxqdm_xqid' id='f_stdxqdm_xqidcdt' style='display:none'>
										<?php if(is_array($xqls)): $i = 0; $__LIST__ = $xqls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['xqid']); ?>"><?php echo ($vol['xqnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<br/>
										层次
										<select name='f_mj_ccid' id='f_mj_ccidcdt'>
										<option value=''>无</option>
										<?php if(is_array($ccls)): $i = 0; $__LIST__ = $ccls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['ccid']); ?>"><?php echo ($vol['ccnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										科类
										<select name='f_mj_klid' id='f_mj_klidcdt'>
										<option value=''>无</option>
										<?php if(is_array($klls)): $i = 0; $__LIST__ = $klls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['klid']); ?>"><?php echo ($vol['klnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										学习形式
										<select name='f_mj_xxxsid' id='f_mj_xxxsidcdt'>
										<option value=''>无</option>
										<?php if(is_array($xxxsls)): $i = 0; $__LIST__ = $xxxsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['xxxsid']); ?>"><?php echo ($vol['xxxsnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										招生范围
										<select name='f_mj_zsfwid' id='f_mj_zsfwidcdt'>
										<option value=''>无</option>
										<?php if(is_array($zsfwls)): $i = 0; $__LIST__ = $zsfwls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['zsfwid']); ?>"><?php echo ($vol['zsfwnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										学制
										<select name='f_mj_xzid' id='f_mj_xzidcdt'>
										<option value=''>无</option>
										<?php if(is_array($xzls)): $i = 0; $__LIST__ = $xzls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['xzid']); ?>"><?php echo ($vol['xznm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<br/>
										班级
										<select name='f_stdxqcls_clsid' id='f_stdxqcls_clsidcdt'>
										<option value=''>无</option>
										<?php if(is_array($clsls)): $i = 0; $__LIST__ = $clsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['clsid']); ?>">[<?php echo ($vol['sttnm']); ?>]<?php echo ($vol['clsnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										
										专业
										<select name='f_stdxqmj_mjid' id='f_stdxqmj_mjidcdt'>
										<option value=''>无</option>
										<?php if(is_array($mjls)): $i = 0; $__LIST__ = $mjls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['mjid']); ?>">[<?php echo ($vol['bxxsnm']); ?>]<?php echo ($vol['mjdm']); echo ($vol['mjnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<hr></hr>
										基本信息（重点部分）：<br/>
										报名号<input type="text" name='stdaplno' id='stdaplnocdt'/>&nbsp;&nbsp;
										学号<input type="text" name='stdno' id='stdnocdt'/>&nbsp;&nbsp;
										<script language="javascript" type="text/javascript" src="__PUBLIC__/pblc/DatePicker/My97DatePicker/WdatePicker.js"></script>
										姓名<input type="text" name='stdnm' id='stdnmcdt'/>&nbsp;&nbsp;
										寝室
										<select name='f_stdxqdm_dmid' id='f_stdxqdm_dmidcdt'>
										<option value=''>无</option>
										<?php if(is_array($dmls)): $i = 0; $__LIST__ = $dmls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['dmid']); ?>"><?php echo ($vol['dmnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										性别
										<select name='f_std_sexid' id='f_std_sexidcdt'>
										<option value=''>无</option>
										<?php if(is_array($sexls)): $i = 0; $__LIST__ = $sexls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['sexid']); ?>"><?php echo ($vol['sexnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<br/>
										身份证号码<input type="text" name='stdidcd' id='stdidcdcdt'/>&nbsp;&nbsp;
										手机号<input type="text" name='stdcp' id='stdcpcdt'/>&nbsp;&nbsp;
										状态
										<select name='f_std_statid' id='f_std_statidcdt'>
										<option value=''>无</option>
										<?php if(is_array($statls)): $i = 0; $__LIST__ = $statls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['statid']); ?>"><?php echo ($vol['statnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<hr></hr>
										
										基本信息（普通部分）：<br/>
										上传财务时间<input type="text" name='stdupfnctm' id='stdupfnctmcdt' onclick="WdatePicker()"/>&nbsp;&nbsp;
										
										民族
										<select name='f_std_rcid' id='f_std_rcidcdt'>
										<option value=''>无</option>
										<?php if(is_array($rcls)): $i = 0; $__LIST__ = $rcls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['rcid']); ?>"><?php echo ($vol['rcnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										政治面貌
										<select name='f_std_zzmmid' id='f_std_zzmmidcdt'>
										<option value=''>无</option>
										<?php if(is_array($zzmmls)): $i = 0; $__LIST__ = $zzmmls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['zzmmid']); ?>"><?php echo ($vol['zzmmnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<br/>
										籍贯<input type="text" name='stdnp' id='stdnpcdt'/>&nbsp;&nbsp;
										生日<input type="text" name='stdbtd' id='stdbtdcdt'/>&nbsp;&nbsp;
										文理科<input type="text" name='stdsol' id='stdsolcdt'/>&nbsp;&nbsp;<br/>
										高考成绩<input type="text" name='stdcee' id='stdceecdt'/>&nbsp;&nbsp;
										毕业学校<input type="text" name='stdsog' id='stdsogcdt'/>&nbsp;&nbsp;
										QQ<input type="text" name='stdqq' id='stdqqcdt'/>&nbsp;&nbsp;
										
										最高学历
										<select name='f_std_xlid' id='f_std_xlidcdt'>
										<option value=''>无</option>
										<?php if(is_array($xlls)): $i = 0; $__LIST__ = $xlls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['xlid']); ?>"><?php echo ($vol['xlnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<br/>
										家长一关系<input type="text" name='stdrlta' id='stdrltacdt'/>&nbsp;&nbsp;
										家长一姓名<input type="text" name='stdrltanm' id='stdrltanmcdt'/>&nbsp;&nbsp;
										家长一职业<input type="text" name='stdrltacopt' id='stdrltacoptcdt'/>&nbsp;&nbsp;<br/>
										家长一手机号码<input type="text" name='stdrltacp' id='stdrltacpcdt'/>&nbsp;&nbsp;
										<br/>
										家长二关系<input type="text" name='stdrltb' id='stdrltbcdt'/>&nbsp;&nbsp;
										家长二姓名<input type="text" name='stdrltbnm' id='stdrltbnmcdt'/>&nbsp;&nbsp;
										家长二职业<input type="text" name='stdrltbcopt' id='stdrltbcoptcdt'/>&nbsp;&nbsp;<br/>
										家长二手机号码<input type="text" name='stdrltbcp' id='stdrltbcpcdt'/>&nbsp;&nbsp;<br/>
										
										爱好<input type="text" name='stdhb' id='stdhbcdt'/>&nbsp;&nbsp;
										
										
										邮箱<input type="text" name='stdpst' id='stdpstcdt'/>&nbsp;&nbsp;
										地址<input type="text" name='stdads' id='stdadscdt'/>&nbsp;&nbsp;<br/>
										<script language="javascript" type="text/javascript" src="__PUBLIC__/pblc/DatePicker/My97DatePicker/WdatePicker.js"></script>
										添加时间<input type="text" name='stdaddtm' id='stdaddtmcdt' onclick="WdatePicker()"/>&nbsp;&nbsp;
										修改时间<input type="text" name='stdmdftm' id='stdmdftmcdt' onclick="WdatePicker()"/>&nbsp;&nbsp;
										<br/>
										固话<input type="text" name='stdtlp' id='stdtlpcdt'/>&nbsp;&nbsp;
										发送预录取通知书时间<input type="text" name='stdpertm' id='stdpertmcdt' onclick="WdatePicker()"/>&nbsp;&nbsp;
										发送录取通知书时间<input type="text" name='stdertm' id='stdertmcdt' onclick="WdatePicker()"/>&nbsp;&nbsp;
										<br/>
										工行卡号<input type="text" name='stdicbc' id='stdicbccdt'/>&nbsp;&nbsp;
										<br/>
										推荐人姓名<input type="text" name='stdrcmdnm' id='stdrcmdnmcdt'/>&nbsp;&nbsp;
										推荐人手机号<input type="text" name='stdcp' id='stdcpcdt'/>&nbsp;&nbsp;
										打印时间<input type="text" name='stdpnttm' id='stdpnttmcdt' onclick="WdatePicker()"/>&nbsp;&nbsp;<br/>
										<hr></hr>
										
									</div>
									<div id='spccdtdv'>
									特殊条件：
									

									<br><a class='spccdtoff' style='cursor:pointer' rel="(stdbtd<'<?php echo ($zsszo[zsszxnltm]); ?>')">筛选出大年龄（暂定标准<?php echo ($zsszo['zsszxnltm']); ?>以后出生为小年龄）</a>
									<br><br><a class='spccdtoff' style='cursor:pointer' rel="(stdbtd>='<?php echo ($zsszo[zsszxnltm]); ?>')">筛选出小年龄（暂定标准<?php echo ($zsszo['zsszxnltm']); ?>以后出生为小年龄）</a>
									<br><br><a class='spccdtoff' style='cursor:pointer' rel="(stdupfnctm<>'' AND f_std_statid=1)">筛选出拟录取学生（用于打印缴费通知书）</a>
									<br><br><a class='spccdtoff' style='cursor:pointer' rel="(f_std_statid<>9)">（排除了不来的学生）</a>
									<br><br><a class='spccdtoff' style='cursor:pointer' rel="(stdpt LIKE '%default%')">没有上传照片的学生</a>
									<br><br><a class='spccdtoff' style='cursor:pointer' rel="(stdpt NOT LIKE '%default%')">已上传照片的学生</a>
									<br><br><a class='spccdtoff' style='cursor:pointer' rel="(stdid>=339)">未传给过医务室的名单</a>
									<br><br>
									</div>
								</div>
							    <div role="tabpanel" class="tab-pane" id="messages">
									<div id='odrdv'>
										顺序：
										<select  class='input-small' >
										<option value=''>无</option>
										<option value='stdaddtm DESC'>添加时间降序</option>
										<option value='stdaddtm ASC'>添加时间升序</option>
										<option value='f_mj_bxxsid DESC'>办学形式降序</option>
										<option value='f_mj_bxxsid ASC'>办学形式升序</option>
										<option value='clsid DESC'>班级降序</option>
										<option value='clsid ASC'>班级升序</option>
										<option value='mjid DESC'>专业降序</option>
										<option value='mjid ASC'>专业升序</option>
										<option value='stdaplno DESC'>报名号降序</option>
										<option value='stdaplno ASC'>报名号升序</option>
										<option value='stdno DESC'>学号降序</option>
										<option value='stdno ASC'>学号升序</option>
										</select>
										<select  class='input-small' >
										<option value=''>无</option>
										<option value='stdaddtm DESC'>添加时间降序</option>
										<option value='stdaddtm ASC'>添加时间升序</option>
										<option value='f_mj_bxxsid DESC'>办学形式降序</option>
										<option value='f_mj_bxxsid ASC'>办学形式升序</option>
										<option value='clsid DESC'>班级降序</option>
										<option value='clsid ASC'>班级升序</option>
										<option value='mjid DESC'>专业降序</option>
										<option value='mjid ASC'>专业升序</option>
										<option value='stdaplno DESC'>报名号降序</option>
										<option value='stdaplno ASC'>报名号升序</option>
										<option value='stdno DESC'>学号降序</option>
										<option value='stdno ASC'>学号升序</option>
										</select>
										<select  class='input-small' >
										<option value=''>无</option>
										<option value='stdaddtm DESC'>添加时间降序</option>
										<option value='stdaddtm ASC'>添加时间升序</option>
										<option value='f_mj_bxxsid DESC'>办学形式降序</option>
										<option value='f_mj_bxxsid ASC'>办学形式升序</option>
										<option value='clsid DESC'>班级降序</option>
										<option value='clsid ASC'>班级升序</option>
										<option value='mjid DESC'>专业降序</option>
										<option value='mjid ASC'>专业升序</option>
										<option value='stdaplno DESC'>报名号降序</option>
										<option value='stdaplno ASC'>报名号升序</option>
										<option value='stdno DESC'>学号降序</option>
										<option value='stdno ASC'>学号升序</option>
										</select>
										<select  class='input-small' >
										<option value=''>无</option>
										<option value='stdaddtm DESC'>添加时间降序</option>
										<option value='stdaddtm ASC'>添加时间升序</option>
										<option value='f_mj_bxxsid DESC'>办学形式降序</option>
										<option value='f_mj_bxxsid ASC'>办学形式升序</option>
										<option value='clsid DESC'>班级降序</option>
										<option value='clsid ASC'>班级升序</option>
										<option value='mjid DESC'>专业降序</option>
										<option value='mjid ASC'>专业升序</option>
										<option value='stdaplno DESC'>报名号降序</option>
										<option value='stdaplno ASC'>报名号升序</option>
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
					    <th class='bxxsnm'>办学形式</th>
					    <th class='sttnm'>站点</th>
					    <th class='ccnm'>层次</th>
					    <th class='klnm'>科类</th>
					    <th class='xxxsnm'>学习形式</th>
					    <th class='zsfwnm'>招生范围</th>
					    <th class='xznm'>学制</th>
					    <th class='grdnm'>年级</th>
					    <th class='xqnm'>学期</th>
					    <th class='stdaplno'>报名号</th>
					    <th class='stdno'>学号</th>
					    <th class='stdupfnctm'>上传财务时间</th>
					    <th class='stdnm'>姓名</th>
					    <th class='clsnm'>班级</th>
					    <th class='dmnm'>寝室</th>
					    <th class='sexnm'>性别</th>
					    <th class='rcnm'>民族</th>
					    <th class='zzmmnm'>政治面貌</th>
					    <th class='stdnp'>籍贯</th>
					    <th class='stdbtd'>生日</th>
					    <th class='oprt'>是否小年龄</th>
					    <th class='stdsol'>文理科</th>
					    <th class='stdcee'>高考成绩</th>
					    <th class='stdsog'>毕业学校</th>
					    <th class='stdqq'>QQ</th>
					    <th class='xlnm'>学历</th>
					    <th class='stdidcd'>身份证号码</th>
					    <th class='stdcp'>手机号码</th>
					    <th class='stdrlta'>家长一关系</th>
					    <th class='stdrltanm'>家长一姓名</th>
					    <th class='stdrltaocpt'>家长一单位</th>
					    <th class='stdrltacp'>家长一手机号码</th>
					    <th class='stdrltb'>家长二关系</th>
					    <th class='stdrltbnm'>家长二姓名</th>
					    <th class='stdrltbocpt'>家长二单位</th>
					    <th class='stdrltbcp'>家长二手机号码</th>
					    <th class='stdhb'>爱好</th>
					    <th class='mjnm'>专业</th>
					    <th class='statnm'>状态</th>
					    <th class='stdpst'>邮编</th>
					    <th class='stdads'>地址</th>
					    <th class='stdmdftm'>修改时间</th>
					    <th class='stdaddtm'>添加时间</th>
					    <th class='stdtlp'>固话</th>
					    <th class='stdpertm'>发送预录取通知书时间</th>
					    <th class='stdertm'>发送录取通知书时间</th>
					    <th class='stdicbc'>工行卡号</th>
					    <th class='stdrcmdnm'>推荐人姓名</th>
					    <th class='stdrcmdcp'>推荐人手机号码</th>
					    <th class='stdpnttm'>打印时间</th>
					    
					    <th class='oprt'>操作</th>
					  </tr>
					</thead>
					
					<tbody>
					  <?php if(is_array($mls)): $i = 0; $__LIST__ = $mls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					    	<td class='odr'><?php echo ($fstrw+$i); ?></td>
						    <td class='bxxsnm'><?php echo ($vo['bxxsnm']); ?></td>
						    <td class='sttnm'><?php echo ($vo['sttnm']); ?></td>
						    <td class='ccnm'><?php echo ($vo['ccnm']); ?></td>
						    <td class='klnm'><?php echo ($vo['klnm']); ?></td>
						    <td class='xxxsnm'><?php echo ($vo['xxxsnm']); ?></td>
						    <td class='zsfwnm'><?php echo ($vo['zsfwnm']); ?></td>
						    <td class='xznm'><?php echo ($vo['xznm']); ?></td>
						    <td class='grdnm'><?php echo ($vo['grdnm']); ?></td>
						    <td class='xqnm'><?php echo ($vo['xqnm']); ?></td>
						    <td class='stdaplno'><?php echo ($vo['stdaplno']); ?></td>
						    <td class='stdno'><?php echo ($vo['stdno']); ?></td>
						    <td class='stdupfnctm'><?php echo ($vo['stdupfnctm']); ?></td>
						    <td class='stdnm'><?php echo ($vo['stdnm']); ?></td>
						    <td class='clsnm'><?php echo ($vo['clsnm']); ?></td>
						    <td class='dmnm'><?php echo ($vo['dmnm']); ?></td>
						    <td class='sexnm'><?php echo ($vo['sexnm']); ?></td>
						    <td class='rcnm'><?php echo ($vo['rcnm']); ?></td>
						    <td class='zzmmnm'><?php echo ($vo['zzmmnm']); ?></td>
						    <td class='stdnp'><?php echo ($vo['stdnp']); ?></td>
						    <td class='stdbtd'><?php echo ($vo['stdbtd']); ?></td>
						    <td class='oprt'><?php echo ($vo['xnl']); ?></td>
						    <td class='stdsol'><?php echo ($vo['stdsol']); ?></td>
						    <td class='stdcee'><?php echo ($vo['stdcee']); ?></td>
						    <td class='stdsog'><?php echo ($vo['stdsog']); ?></td>
						    <td class='stdqq'><?php echo ($vo['stdqq']); ?></td>
						    <td class='xlnm'><?php echo ($vo['xlnm']); ?></td>
						    <td class='stdidcd'><?php echo ($vo['stdidcd']); ?></td>
						    <td class='stdcp'><?php echo ($vo['stdcp']); ?></td>
						    <td class='stdrlta'><?php echo ($vo['stdrlta']); ?></td>
						    <td class='stdrltanm'><?php echo ($vo['stdrltanm']); ?></td>
						    <td class='stdrltaocpt'><?php echo ($vo['stdrltaocpt']); ?></td>
						    <td class='stdrltacp'><?php echo ($vo['stdrltacp']); ?></td>
						    <td class='stdrltb'><?php echo ($vo['stdrltb']); ?></td>
						    <td class='stdrltbnm'><?php echo ($vo['stdrltbnm']); ?></td>
						    <td class='stdrltbocpt'><?php echo ($vo['stdrltbocpt']); ?></td>
						    <td class='stdrltbcp'><?php echo ($vo['stdrltbcp']); ?></td>
						    <td class='stdhb'><?php echo ($vo['stdhb']); ?></td>
						    <td class='mjnm'><?php echo ($vo['mjnm']); ?></td>
						    <td class='statnm'><?php echo ($vo['statnm']); ?></td>
						    <td class='stdpst'><?php echo ($vo['stdpst']); ?></td>
						    <td class='stdads'><?php echo ($vo['stdads']); ?></td>
						    <td class='stdmdftm'><?php echo ($vo['stdmdftm']); ?></td>
						    <td class='stdaddtm'><?php echo ($vo['stdaddtm']); ?></td>
						    <td class='stdtlp'><?php echo ($vo['stdtlp']); ?></td>
						    <td class='stdpertm'><?php echo ($vo['stdpertm']); ?></td>
						    <td class='stdertm'><?php echo ($vo['stdertm']); ?></td>
						    <td class='stdicbc'><?php echo ($vo['stdicbc']); ?></td>
						    <td class='stdrcmdnm'><?php echo ($vo['stdrcmdnm']); ?></td>
						    <td class='stdrcmdcp'><?php echo ($vo['stdrcmdcp']); ?></td>
						    <td class='stdpnttm'><?php echo ($vo['stdpnttm']); ?></td>
						    <td class='oprt'>
						      <!-- Icons -->
						      <?php if($athv==1){ ?><a href="__URL__/gtxpg/x/vw/stdid/<?php echo ($vo['stdid']); ?>">查看</a><?php } ?>
						      <?php if($athv==1){ ?><a href="__URL__/gtxpg/x/ylqtz/stdid/<?php echo ($vo['stdid']); ?>">缴费通知书</a><?php } ?>
						      <?php if($athv==1){ ?><a href="__URL__/gtxpg/x/stdda/stdid/<?php echo ($vo['stdid']); ?>">打印学生档案</a><?php } ?>
						      <?php if($vo['mdf']==1){ ?><a href="__URL__/gtxpg/x/mdf/stdid/<?php echo ($vo['stdid']); ?>">更改基本信息</a><?php } ?> 
						      <?php if($athm==1){ ?><a href="__URL__/gtxpg/x/updt/stdid/<?php echo ($vo['stdid']); ?>">修改</a><?php } ?> 
						      <?php if($athd==1){ ?><a href="javascript:dlt(<?php echo ($vo['stdid']); ?>,<?php echo ($vo['f_std_grdid']); ?>)">删除</a><?php } ?>
						     	
						    </td>
					  </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
					</tbody>
					</table>
				</div>
				<script type="text/javascript">$("#NBtb thead").smartFloatTB();</script>
				<!-- 注意NB 的class 都要设置  结束-->
				<?php echo ($page_method); ?>&nbsp;&nbsp;
				
				<?php if($atha==1){ ?><p><a href="__URL__/gtxpg/x/updt/stdid/0" class='btn btn-primary'>添加</a></p><?php } ?>
				
				<!--EXCEL开始-->
				<script type="text/javascript" src='__PUBLIC__/pblc/XLS/xls.js'></script>
				<form action='__APP__/Xls/output' method='post'>
				<input type='hidden' name='mk' value='<?php echo ($grdnm); ?>_std'/>
				<input type='hidden' name='fld' id='fld' value='<?php echo ($fld); ?>'/>
				<input type='hidden' name='cdt' value='<?php echo ($cdt); ?>'/>
				<input type='hidden' name='spccdt' value='<?php echo ($spccdt); ?>'/>
				<input type='hidden' name='odr' value='<?php echo ($odr); ?>'/>
				<input type='hidden' name='NBsqlstc' value="<?php echo ($sqlstc); ?>"/>
				<input type='hidden' name='zsmk' value='y'>
				请命名表的名称:<input type='text' name='xlsnm' value='新生报名列表' class='form-control input-sm' style='width:200px;display:inline'/>
				<br/><input type='button' id='export' value='导出数据' class='btn btn-primary'/><input type='submit' id='exporttrue' style='display:none' value='导出数据' />
				</form>
				<br><br><br>
				<form action='__APP__/Xls/outputylqmd' method='post'>
				<input type='submit' class='btn btn-success'  value='导出录取名单（已经在计财处库里且之前并没有打印邮寄过录取名单且状态为报名的学生）' />
				</form>
				<br><br><br>
				
				<?php if($athm==1){ ?>
				<!-- xls file start -->
				<a href='__ROOT__/XFile/usr.xls' class='btn btn-warning'>模版</a><input type='hidden' id='mk' value='usr'/>
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