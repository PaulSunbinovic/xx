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
 
<script type='text/javascript' src='__PUBLIC__/JS/admin/zsjx.js'></script>
<script type='text/javascript'>
var app_path='__APP__';
var hdlcrtu='__URL__/createAlways';
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
										<input type="checkbox" id='stdptfld' value='stdpt'/>学生照片&nbsp;&nbsp;
										<input type="checkbox" id='zsjxsgfld' value='zsjxsg'/>身高&nbsp;&nbsp;
										<input type="checkbox" id='zsjxtzfld' value='zsjxtz'/>体重&nbsp;&nbsp;
										<input type="checkbox" id='zsjxxmfld' value='zsjxxm'/>鞋码&nbsp;&nbsp;
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
										
										性别
										<select name='f_std_sexid' id='f_std_sexidcdt'>
										<option value=''>无</option>
										<?php if(is_array($sexls)): $i = 0; $__LIST__ = $sexls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['sexid']); ?>"><?php echo ($vol['sexnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
										<br/>
										
										<hr></hr>
										
										
										
									</div>
									<div id='spccdtdv'>
									特殊条件：
									<br><a class='spccdtoff' style='cursor:pointer' rel="(stdbtd<'<?php echo ($zsszo[zsszxnltm]); ?>')">筛选出大年龄（暂定标准<?php echo ($zsszo['zsszxnltm']); ?>以后出生为小年龄）</a>
									<br><br><a class='spccdtoff' style='cursor:pointer' rel="(stdbtd>='<?php echo ($zsszo[zsszxnltm]); ?>')">筛选出小年龄（暂定标准<?php echo ($zsszo['zsszxnltm']); ?>以后出生为小年龄）</a>
									<br><br><a class='spccdtoff' style='cursor:pointer' rel="(stdupfnctm<>'' AND f_std_statid=1)">筛选出拟录取学生（用于打印缴费通知书）</a>
									<br><br><a class='spccdtoff' style='cursor:pointer' rel="(f_std_statid<>9)">可以编学号的学生（排除了不来的学生）</a>
									<br><br><a class='spccdtoff' style='cursor:pointer' rel="(stdpt LIKE '%default%')">没有上传照片的学生</a>
									<br><br><a class='spccdtoff' style='cursor:pointer' rel="(stdpt NOT LIKE '%default%')">已上传照片的学生</a>
									<br><br><a class='spccdtoff' style='cursor:pointer' rel="((cwyjxfsm+cwyjjckwfsm+cwyjzsfsm=cwsjxfsm+cwsjjckwfsm+cwsjzsfsm) AND (zsjxsg='' OR zsjxsg IS NULL))">完全缴清的学生（不含已经回访得到信息的）</a>
									&nbsp;&nbsp;<a class='spccdtoff' style='cursor:pointer' rel="((cwyjxfsm+cwyjjckwfsm+cwyjzsfsm>=cwsjxfsm+cwsjjckwfsm+cwsjzsfsm AND cwsjxfsm+cwsjjckwfsm+cwsjzsfsm>0) AND (zsjxsg='' OR zsjxsg IS NULL))">缴清+缴部分的学生（不含已经回访得到信息的）</a>
									&nbsp;&nbsp;<a class='spccdtoff' style='cursor:pointer' rel="(zsjxsg='' OR zsjxsg IS NULL)">全部的学生（不含已经回访得到信息的）</a>
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
					    <th class='stdaplno'>报名号</th>
					    <th class='stdno'>学号</th>
						<th class='stdnm'>姓名</th>
						<th class='stdcp'>手机</th>
						<th class='stdrltacp'>家长一手机</th>
						<th class='stdrltbcp'>家长二手机</th>
						<th class='stdrltccp'>家长三手机</th>
					    <th class='zsjxsg'>身高(cm)</th>
					    <th class='zsjxtz'>体重(kg)</th>
					    <th class='zsjxxm'>鞋码(码)</th>
					    <th class='clsnm'>班级</th>
					    <th class='sexnm'>性别</th>
					    <th class='mjnm'>专业</th>
					    <th class='statnm'>状态</th>
					    
					    <th class='stdpt'>照片</th>
					  </tr>
					</thead>
					<script>var hdlswdt='__URL__/showdetail'</script>
					<tbody>
					  <?php if(is_array($mls)): $i = 0; $__LIST__ = $mls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
					    	<td class='odr'><?php echo ($fstrw+$i); ?></td>
						    <td class='bxxsnm'><?php echo ($vo['bxxsnm']); ?></td>
						    <td class='stdaplno'><?php echo ($vo['stdaplno']); ?></td>
						    <td class='stdno'><?php echo ($vo['stdno']); ?></td>
						    <td class='stdnm'><a class='btn btn-default' style='width:70px' href="javascript:showdetail(<?php echo ($vo['stdid']); ?>)"><?php echo ($vo['stdnm']); ?></a></td>
						    <td class='stdcp'><?php echo ($vo['stdcp']); ?></td>
						    <td class='stdrltacp'><?php echo ($vo['stdrltacp']); ?></td>
						    <td class='stdrltbcp'><?php echo ($vo['stdrltbcp']); ?></td>
						    <td class='zsjxsg'><?php echo ($vo['zsjxsg']); ?></td>
						    <td class='zsjxtz'><?php echo ($vo['zsjxtz']); ?></td>
						    <td class='zsjxxm'><?php echo ($vo['zsjxxm']); ?></td>
						    <td class='clsnm'><?php echo ($vo['clsnm']); ?></td>
						    <td class='sexnm'><?php echo ($vo['sexnm']); ?></td>
						    <td class='stdhb'><?php echo ($vo['stdhb']); ?></td>
						    <td class='mjnm'><?php echo ($vo['mjnm']); ?></td>
						    <td class='statnm'><?php echo ($vo['statnm']); ?></td>
						    <td class='stdpt'><img class='img-thumbnail' style='width:50px;height:50px' src="<?php echo ($vo['stdpt']); ?>" /></td>
					  </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
					</tbody>
					</table>
				</div>
				<script type="text/javascript">$("#NBtb thead").smartFloatTB();</script>
				<!-- 注意NB 的class 都要设置  结束-->
				<?php echo ($page_method); ?>&nbsp;&nbsp;


				<!--EXCEL开始-->
				<script type="text/javascript" src='__PUBLIC__/pblc/XLS/xls.js'></script>
				<form action='__URL__/output' method='post'>
				<input type='hidden' name='mk' value='<?php echo ($grdnm); ?>_std'/>
				<input type='hidden' name='fld' id='fld' value='<?php echo ($fld); ?>'/>
				<input type='hidden' name='cdt' value='<?php echo ($cdt); ?>'/>
				<input type='hidden' name='spccdt' value='<?php echo ($spccdt); ?>'/>
				<input type='hidden' name='odr' value='<?php echo ($odr); ?>'/>
				<input type='hidden' name='NBsqlstc' value="<?php echo ($sqlstc); ?>"/>
				<input type='hidden' name='zsmk' value='y'>
				<input type='text' name='xlsnm' value='军训服装数据导出' class='form-control input-sm' style='width:200px;display:none'/>
				<br/><input type='button' id='export' value='导出数据' class='btn btn-primary'/><input type='submit' id='exporttrue' style='display:none' value='导出数据' />
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
	
	<footer class="bs-docs-footer">
  <div class="container">				
		<p>Designed by <a href="#" target="_blank">sunbinovic@163.com</a></p><p>&copy; 2012-<?php echo date('Y',time()); ?> 中国计量学院成人教育学院、继续教育学院 </p>
	</div> <!-- /container -->
</footer>
<script  type="text/javascript" src="__PUBLIC__/pblc/gotop/gotop.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/gotop/gotop.css" media="all"/>
</div>

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style='display:none'>
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">学生军训信息</h4>
      </div>
      <div class="modal-body">
        	<div class="page-header">
		 	 <h1><small id='stdnm_md'></small></h1>
			</div>
			<script>var hdlstzsjx='__URL__/setzsjx'</script>
			<form>
				<div class='form-group'>
				<a id='std_detail'></a><input type='hidden' name='zsjxid' /><input type='hidden' name='stdid' />
				</div>
				<div class='form-group'>
				身高（单位：cm）：<input class='form-control'  name='zsjxsg' />
				</div>
				<div class='form-group'>
				体重（单位：kg）：<input class='form-control' name='zsjxtz' />
				</div>
				<div class='form-group'>
				鞋码（单位：码）：<input class='form-control' name='zsjxxm' />
				</div>
				<br>
				<input type='button' class='btn btn-success btn-lg' value='提交' id='stzsjx' />
				
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