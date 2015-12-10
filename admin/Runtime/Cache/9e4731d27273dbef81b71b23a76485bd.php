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
<script type='text/javascript' src='__PUBLIC__/JS/admin/zsstd.js'></script>
<script type='text/javascript'>
var hdlurl='__URL__/update';
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
					<form>
						<input type='hidden' name='stdid' id='stdid' value="<?php echo ($mo['stdid']); ?>" />
						<div>
						<!-- file start -->
						 <link rel="stylesheet" href="__PUBLIC__/pblc/FileUpload/uploadify/uploadify.css">
						 <script type="text/javascript" src='__PUBLIC__/pblc/FileUpload/uploadify/uploadify.js'></script>
						 <script type="text/javascript" src="__PUBLIC__/pblc/FileUpload/uploadify/swfobject.js"></script>
						<script type="text/javascript">
						var file_path='__PUBLIC__/pblc/FileUpload';
						var hdlupload="__APP__/FileUpload/upload/issml/y/wjj/std-jn-tmp";////注意
						var upload_path="__ROOT__/Uploads/std/tmp";
						</script>
						<script type="text/javascript" src='__PUBLIC__/pblc/FileUpload/int.js'></script>
						<div>
						<img src="<?php echo ($mo['stdpt']); ?>" alt=""  class='img-thumbnail'  style="width:100px;"  id='imgg'/>
						</div>
						<div style="width:80px; height:26px; overflow:hidden;"><input type="file"  name="photo1" id="uploadify"/></div>
						<!-- 隐藏系统所需的用户upt -->
						<input type='hidden' name='stdpt' value="<?php echo ($mo['stdpt']); ?>" id='pt'/>
						<!-- file over -->
						</div>
						<div class='clearfix'></div>
						<?php if($mo['stdid']==0){ ?>
						<!-- 
						<div class='mingxi'>
						<?php if($mo['stdid']==0){ ?>
						<script type="text/javascript" src="__PUBLIC__/pblc/password_strength/password_strength_plugin.js"></script> 
						<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/password_strength/password_streng.css"/> 
						<table>
						<tr><td>密码：</td><td><input type='text' name='stdpw' value="<?php echo ($mo['stdpw']); ?>" id='stdpw' /></td></tr>
						<tr><td>再输入一次密码：</td><td><input type='text' name='stdpwag' value="<?php echo ($mo['stdpw']); ?>" id='stdpwag'/></td></tr>
						</table>
						<script> 
						$(document).ready( function() { 
						//BASIC 验证用户名密码重复
						/*$(".password_test").passStrength({ 
						userid: "#stdid" 
						});*/ 
						//ADVANCED 
						$("#stdpw").passStrength({ 
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
						<?php }else{ ?>
						<script>var hdlrstpw='__URL__/resetpassword';</script>
						<input type='button' class='btn btn-warning' onclick="rstpw(<?php echo ($mo['stdid']); ?>)" value="重置密码" />
						<?php } ?>
						</div>
						<div class='clearfix'></div>
						 -->
						 <?php }else if($aths==1){ ?>
						<script>var hdlrstpw='__URL__/resetpassword';</script>
						<!-- <tr><td></td><td><input type='button' class='btn btn-warning' onclick="rstpw(<?php echo ($mo['stdid']); ?>,<?php echo ($mo['f_std_grdid']); ?>)" value="重置密码" /></td></tr> -->
						<?php } ?>
						<div class='mingxi'>
						学籍信息：
						<table>
						<tr>
						<td>
						办学形式：
						</td>
						<td colspan=3>
						<select name='f_mj_bxxsid'>
							<option value='0'>无</option>
							<?php if(is_array($bxxsls)): $i = 0; $__LIST__ = $bxxsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['bxxsid']); ?>"><?php echo ($vo['bxxsnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_mj_bxxsid]').val(<?php echo ($mo['f_mj_bxxsid']); ?>)</script>
						</td>
						<td>
						站点：
						</td>
						<td>
						<?php if($athm!=1){ ?><select name='f_std_sttid' disabled ><?php }else{ ?><select name='f_std_sttid' ><?php } ?>
							<?php if(is_array($sttls)): $i = 0; $__LIST__ = $sttls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['sttid']); ?>"><?php echo ($vo['sttnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_std_sttid]').val(<?php echo ($mo['f_std_sttid']); ?>)</script>
						</td>
						<td>
						年级：
						</td>
						<td>
						<?php if($athm!=1){ ?><select name='f_std_grdid' disabled ><?php }else{ ?><select name='f_std_grdid' ><?php } ?>
							<?php if(is_array($grdls)): $i = 0; $__LIST__ = $grdls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['grdid']); ?>"><?php echo ($vo['grdnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_std_grdid]').val(<?php echo ($mo['f_std_grdid']); ?>)</script>
						</td>
						<td>
						学期
						</td>
						<td>
						<?php if($athm!=1){ ?><select name='f_stdxqcls_xqid' id='f_stdxqcls_xqidcdt' disabled><?php }else{ ?><select name='f_stdxqcls_xqid' id='f_stdxqcls_xqidcdt'><?php } ?>
						<?php if(is_array($xqls)): $i = 0; $__LIST__ = $xqls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['xqid']); ?>"><?php echo ($vol['xqnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_stdxqcls_xqid]').val(<?php echo ($mo['f_stdxqcls_xqid']); ?>)</script>
						<select name='f_stdxqmj_xqid' id='f_stdxqmj_xqidcdt' style='display:none'>
						<?php if(is_array($xqls)): $i = 0; $__LIST__ = $xqls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['xqid']); ?>"><?php echo ($vol['xqnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_stdxqmj_xqid]').val(<?php echo ($mo['f_stdxqmj_xqid']); ?>)</script>
						</td>
						
						</tr>
						<tr style='display:none'>
						<td>
						层次：
						</td>
						<td>
						<?php if($athm!=1){ ?><select name='f_mj_ccid' disabled><?php }else{ ?><select name='f_mj_ccid'><?php } ?>
							<option value='0'>无</option>
							<?php if(is_array($ccls)): $i = 0; $__LIST__ = $ccls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['ccid']); ?>"><?php echo ($vo['ccnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_mj_ccid]').val(<?php echo ($mo['f_mj_ccid']); ?>)</script>
						</td>
						<td>
						科类：
						</td>
						<td>
						<?php if($athm!=1){ ?><select name='f_mj_klid' disabled><?php }else{ ?><select name='f_mj_klid'><?php } ?>
							<option value='0'>无</option>
							<?php if(is_array($klls)): $i = 0; $__LIST__ = $klls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['klid']); ?>"><?php echo ($vo['klnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_mj_klid]').val(<?php echo ($mo['f_mj_klid']); ?>)</script>
						</td>
						<td>
						学习形式：
						</td>
						<td>
						<?php if($athm!=1){ ?><select name='f_mj_xxxsid' disabled><?php }else{ ?><select name='f_mj_xxxsid'><?php } ?>
							<option value='0'>无</option>
							<?php if(is_array($xxxsls)): $i = 0; $__LIST__ = $xxxsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['xxxsid']); ?>"><?php echo ($vo['xxxsnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_mj_xxxsid]').val(<?php echo ($mo['f_mj_xxxsid']); ?>)</script></td>
						<td>
						招生范围：
						</td>
						<td>
						<?php if($athm!=1){ ?><select name='f_mj_zsfwid' disabled><?php }else{ ?><select name='f_mj_zsfwid'><?php } ?>
							<option value='0'>无</option>
							<?php if(is_array($zsfwls)): $i = 0; $__LIST__ = $zsfwls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['zsfwid']); ?>"><?php echo ($vo['zsfwnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_mj_zsfwid]').val(<?php echo ($mo['f_mj_zsfwid']); ?>)</script>
						</td>
						<td>
						学制：
						</td>
						<td>
						<?php if($athm!=1){ ?><select name='f_mj_xzid' disabled><?php }else{ ?><select name='f_mj_xzid'><?php } ?>
							<option value='0'>无</option>
							<?php if(is_array($xzls)): $i = 0; $__LIST__ = $xzls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['xzid']); ?>"><?php echo ($vo['xznm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_mj_xzid]').val(<?php echo ($mo['f_mj_xzid']); ?>)</script>
						</td>
						</tr>
						<tr>
						<script type="text/javascript">
						var hdlclswithstdno='__URL__/hdlclswithstdno'
						</script>
						<td>班级：</td>
						<td colspan=9>
						<?php if($athm!=1){ ?><select name='f_stdxqcls_clsid' disabled><?php }else{ ?><select name='f_stdxqcls_clsid'><?php } ?>
							<option value='0'>无</option>
							<?php if(is_array($clsls)): $i = 0; $__LIST__ = $clsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['clsid']); ?>">[<?php echo ($vo['sttnm']); ?>]<?php echo ($vo['clsnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_stdxqcls_clsid]').val(<?php echo ($mo['f_stdxqcls_clsid']); ?>)</script>
						</td>
						</tr>
						<tr>
						<td>专业：</td>
						<td colspan=9>
						<select name='f_stdxqmj_mjid'>
							<option value='0'>无</option>
							<?php if(is_array($mjls)): $i = 0; $__LIST__ = $mjls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['mjid']); ?>">[<?php echo ($vo['bxxsnmst']); ?>]<?php echo ($vo['mjdm']); echo ($vo['mjnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_stdxqmj_mjid]').val(<?php echo ($mo['f_stdxqmj_mjid']); ?>)</script>
						</td>
						</tr>
						</table>
						</div>
						<script>var hdlurlxj='__URL__/updatexj';</script>
						<!-- <?php if($mo['stdid']!=0&&$athm==1){ ?><input type='button' id='updtxj' value='改学籍信息' class='btn btn-success' /><?php } ?> -->
						<div class='clearfix'></div>
						<div class='mingxi'>
						基本信息：
						<table>
						
						<tr>
						<td>报名号：</td><td><?php if($athm!=1){ ?><input type='text' name='stdaplno' value="<?php echo ($mo['stdaplno']); ?>" disabled /><?php }else{ ?><input type='text' name='stdaplno' value="<?php echo ($mo['stdaplno']); ?>" /><?php } ?></td>
						<td>学号：</td><td><?php if($athm!=1){ ?><input type='text' name='stdno' value="<?php echo ($mo['stdno']); ?>" disabled/><?php }else{ ?><input type='text' name='stdno' value="<?php echo ($mo['stdno']); ?>" /><?php } ?><input type='hidden' value="<?php echo ($mo['stdno']); ?>" id='stdnomk'></td>
						<td>上传财务时间：</td><td><?php if($athm==1){ ?><script type="text/javascript" src="__PUBLIC__/pblc/DatePicker/My97DatePickerHHmmss/WdatePicker.js"></script><?php } ?><input type="text" name='stdupfnctm' value="<?php echo ($mo['stdupfnctm']); ?>" onclick="WdatePicker()" readonly/></td>
						<td>
						寝室：
						</td>
						<td>
						<select name='f_stdxqdm_dmid'>
							<option value='0'>无</option>
							<?php if(is_array($dmls)): $i = 0; $__LIST__ = $dmls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['dmid']); ?>"><?php echo ($vo['dmnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_stdxqdm_dmid]').val(<?php echo ($mo['f_stdxqdm_dmid']); ?>)</script>
						</td>
						</tr>
											
						<tr>
						<td>姓名：</td><td><input type='text' name='stdnm' value="<?php echo ($mo['stdnm']); ?>" id='stdnm'/></td>
						<td>
						性别：
						</td>
						<td>
						<select name='f_std_sexid'>
							<option value='0'>无</option>
							<?php if(is_array($sexls)): $i = 0; $__LIST__ = $sexls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['sexid']); ?>"><?php echo ($vo['sexnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_std_sexid]').val(<?php echo ($mo['f_std_sexid']); ?>)</script>
						</td>
						<td>
						民族
						</td>
						<td>
						<select name='f_std_rcid'>
							<option value='0'>无</option>
							<?php if(is_array($rcls)): $i = 0; $__LIST__ = $rcls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['rcid']); ?>"><?php echo ($vo['rcnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_std_rcid]').val(<?php echo ($mo['f_std_rcid']); ?>)</script>
						</td>
						<td>
						政治面貌
						</td>
						<td>
						<select name='f_std_zzmmid'>
							<option value='0'>无</option>
							<?php if(is_array($zzmmls)): $i = 0; $__LIST__ = $zzmmls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['zzmmid']); ?>"><?php echo ($vo['zzmmnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_std_zzmmid]').val(<?php echo ($mo['f_std_zzmmid']); ?>)</script>
						</td>
						</tr>
						<tr>
						<td>籍贯：</td><td><input type='text' name='stdnp' value="<?php echo ($mo['stdnp']); ?>" id='stdnp'/></td>
						<td>文理科：</td>
						<td>
						<select name='stdsol'>
						<option value='无'>无</option>
						<option value='文科'>文科</option>
						<option value='理科'>理科</option>
						</select>
						<script>$('select[name=stdsol]').val("<?php echo ($mo['stdsol']); ?>")</script>
						</td>
						<td>
						学历
						</td>
						<td>
						<select name='f_std_xlid'>
							<option value='0'>无</option>
							<?php if(is_array($xlls)): $i = 0; $__LIST__ = $xlls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['xlid']); ?>"><?php echo ($vo['xlnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_std_xlid]').val(<?php echo ($mo['f_std_xlid']); ?>)</script>
						</td>
						<td>高考成绩：</td><td><input type='text' name='stdcee' value="<?php echo ($mo['stdcee']); ?>" id='stdcee'/></td>
						</tr>
						<tr>
						<td>毕业学校：</td><td colspan=3><input  type='text' name='stdsog' value="<?php echo ($mo['stdsog']); ?>" id='stdsog'/></td>
						<td>手机号码：</td><td colspan=3><input  type='text' name='stdcp' value="<?php echo ($mo['stdcp']); ?>" id='stdcp'/></td>
						</tr>
						<tr>
						<td>身份证号码：</td><td><input  type='text' name='stdidcd' value="<?php echo ($mo['stdidcd']); ?>" id='stdidcd'/></td>
						<td>固话：</td><td><input  type='text' name='stdtlp' value="<?php echo ($mo['stdtlp']); ?>" /></td>
						<td>出生日期：</td><td><?php if($aths==1){ ?><script type="text/javascript" src="__PUBLIC__/pblc/DTPK/jddate/adddate.js"></script><?php } ?><input type='text' name='stdbtd' value="<?php echo ($mo['stdbtd']); ?>" id='stdbtd' onclick="SelectDate(this,'yyyy-MM-dd')" readonly /></td>
						<td>QQ：</td><td><input type='text' name='stdqq' value="<?php echo ($mo['stdqq']); ?>" id='stdqq'/></td>
						</tr>
						<tr>
						<td>家长一：</td><td><input type='text' name='stdrlta' value="<?php echo ($mo['stdrlta']); ?>" id='stdrlta'/></td>
						<td>家长一姓名：</td><td><input type='text' name='stdrltanm' value="<?php echo ($mo['stdrltanm']); ?>" id='stdrltanm'/></td>
						<td>家长一单位：</td><td><input type='text' name='stdrltaocpt' value="<?php echo ($mo['stdrltaocpt']); ?>" id='stdrltaocpt'/></td>
						<td>家长一手机号：</td><td><input type='text' name='stdrltacp' value="<?php echo ($mo['stdrltacp']); ?>" id='stdrltacp'/></td>
						</tr>
						<tr>
						<td>家长二：</td><td><input type='text' name='stdrltb' value="<?php echo ($mo['stdrltb']); ?>" id='stdrltb'/></td>
						<td>家长二姓名：</td><td><input type='text' name='stdrltbnm' value="<?php echo ($mo['stdrltbnm']); ?>" id='stdrltbnm'/></td>
						<td>家长二单位：</td><td><input type='text' name='stdrltbocpt' value="<?php echo ($mo['stdrltbocpt']); ?>" id='stdrltbocpt'/></td>
						<td>家长二手机号：</td><td><input type='text' name='stdrltbcp' value="<?php echo ($mo['stdrltbcp']); ?>" id='stdrltbcp'/></td>
						</tr>
						<tr>
						<td>爱好：</td><td><input type='text' name='stdhb' value="<?php echo ($mo['stdhb']); ?>" id='stdhb'/></td>
						<td>家庭地址：</td><td colspan=3><input type='text' name='stdads' value="<?php echo ($mo['stdads']); ?>" id='stdads'/></td>
						<td>邮件：</td><td><input type='text' name='stdpst' value="<?php echo ($mo['stdpst']); ?>" id='stdpst'/></td>
						</tr>
						<tr>
						<td>是否有推荐人：</td>
						<td>
						<?php if($athm!=1){ ?><select name='ifrcmd' disabled><?php }else{ ?><select name='ifrcmd'><?php } ?>
							<option value='否'>否</option>
							<option value="是">是</option>
						</select>
						<script>$('select[name=ifrcmd]').val("<?php echo ($ifrcmd); ?>")</script>
						</td>
						<td>推荐人姓名：</td><td colspan=2><?php if($athm!=1){ ?><input type='text' name='stdrcmdnm' value="<?php echo ($mo['stdrcmdnm']); ?>" id='stdrcmdnm' <?php echo ($rcmdcls); ?> disabled/><?php }else{ ?><input type='text' name='stdrcmdnm' value="<?php echo ($mo['stdrcmdnm']); ?>" id='stdrcmdnm' <?php echo ($rcmdcls); ?>/><?php } ?></td>
						<td>推荐人手机号：</td><td colspan=2><?php if($athm!=1){ ?><input type='text' name='stdrcmdcp' value="<?php echo ($mo['stdrcmdcp']); ?>" id='stdrcmdcp' <?php echo ($rcmdcls); ?> disabled/><?php }else{ ?><input type='text' name='stdrcmdcp' value="<?php echo ($mo['stdrcmdcp']); ?>" id='stdrcmdcp' <?php echo ($rcmdcls); ?>/><?php } ?></td>
						</tr>
						
						<tr>
						<td>状态：</td>
						<td colspan=7>
						<select name='f_std_statid'>
							<option value='0'>无</option>
							<?php if(is_array($statls)): $i = 0; $__LIST__ = $statls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['statid']); ?>"><?php echo ($vo['statnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_std_statid]').val(<?php echo ($mo['f_std_statid']); ?>)</script>
						</td>
						</tr>
						
						<tr>
						<td>工行卡号：</td><td colspan=4><input type="text" name='stdicbc' value="<?php echo ($mo['stdicbc']); ?>" /></td>
						<td>信息打印时间：</td><td colspan=2><input type="text" name='stdpnttm' value="<?php echo ($mo['stdpnttm']); ?>" onclick="WdatePicker()" readonly/></td>
						</tr>
						<tr>
						<td>添加时间：</td><td><input type="text" name='stdaddtm' value="<?php echo ($mo['stdaddtm']); ?>" onclick="WdatePicker()" readonly/></td>
						<td>修改时间：</td><td><input type="text" name='stdmdftm' value="<?php echo ($mo['stdmdftm']); ?>" onclick="WdatePicker()" readonly/></td>
						<td>预录取时间：</td><td><input type="text" name='stdpertm' value="<?php echo ($mo['stdpertm']); ?>" onclick="WdatePicker()" readonly/></td>
						<td>录取时间：</td><td><input type="text" name='stdertm' value="<?php echo ($mo['stdertm']); ?>" onclick="WdatePicker()" readonly/></td>
						</tr>
						</table>
						</div>
						<script>var hdlurljb='__URL__/updatejb'</script>
						<!-- <?php if($mo['stdid']!=0&&$aths==1){ ?><input type='button' id='updtjb' value='改基本信息' class='btn btn-success' /><?php } ?> -->
						<div class='clearfix'></div>
						<input type='button' id='updt' value=<?php echo ($btnvl); ?> class='btn btn-danger' />
						<div class='clearfix'></div>
						<br/>
						<?php if($mo['stdid']!=0){ ?>
						
						特殊情况:
						<div class='clearfix'></div>
						<table class="table table-striped">
							<tr><th>时间</th><th>具体情况</th></tr>
							<?php if(is_array($tsqkls)): $i = 0; $__LIST__ = $tsqkls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($vo['tsqktm']); ?></td><td><?php echo ($vo['tsqknr']); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</table>
						<a href="#"  class='btn btn-success'>前往特殊情况中心</a>
						<div class='clearfix'></div>
						<?php } ?>
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