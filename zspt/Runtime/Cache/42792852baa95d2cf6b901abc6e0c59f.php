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
<script type='text/javascript' src='__PUBLIC__/JS/zspt/cm.js'></script>
<link href="__PUBLIC__/CSS/zspt/cm.css" rel="stylesheet">

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
<link rel="stylesheet" href="__PUBLIC__/CSS/zspt/std.css"/>
<script type='text/javascript' src='__PUBLIC__/JS/zspt/std.js'></script>
<script type='text/javascript'>
var hdlurl='__URL__/update';
var hdlcrtu='__URL__/createAlways';
</script>
</head>


<body style='padding-top:70px;background-color:#eee;'>

<!-- head包std.js -->
<script type="text/javascript" src='__PUBLIC__/JS/zspt/stdhd.js'></script>

<script type="text/javascript">
var hdllgin='__APP__/Std/loginin';
var hdllgot='__APP__/Std/loginout';
var app_path='__ROOT__/zspt.php';
</script>
<header class="navbar navbar-fixed-top" id='divhd' style='background-color:#44b549'>
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="#" class="navbar-brand" style='line-height:50px;padding:0px'><img style='width:50px;height:50px' alt="Brand" src="__PUBLIC__/IMG/cjlulg.png"></a>
      <a href="#" class="navbar-brand">&nbsp;&nbsp;&nbsp;&nbsp;中国计量学院继续教育学院招生平台</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
					
					
			<?php if(session('stdidss')){ ?>
					
					
					
					<li class="dropdown">
						
						<a data-toggle="dropdown" class="dropdown-toggle " href="#">
							<img class='img-circle' src="<?php echo ($stdoss['stdpt']); ?>" style='width:20px;height:20px'/> <?php echo ($stdoss['stdnm']); ?> <b class="caret"></b>							
						</a>
						
						<ul class="dropdown-menu">
							 
							<li>
								<a href="__APP__/Std/gtxpg/x/center" id='std_center'><i class="glyphicon glyphicon-user"></i> 个人信息  </a>
								
							</li>
							 
							
							<li class="divider"></li>
							
							<li>
								<a href="#" id='std_loginout'><i class="glyphicon glyphicon-off"></i> 注销 </a>
							</li>
						</ul>
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
<style>
header a{color:#fff}
</style>


<div class='container' >
	
		<div class='col-md-12'>
			<div class="panel panel-success">
				<div class="panel-heading">
				  <i class="glyphicon glyphicon-th-list"></i> <?php echo ($theme); ?>
				</div>
				<div class="panel-body">
					<form>
						<input type='hidden' name='stdid' id='stdid' value="<?php echo ($mo['stdid']); ?>" />
						
						<div class='clearfix'></div>
						
						<?php if($mo['stdid']!=0){ ?>
						<div class='mingxi'>
						<table>
						<tr>
						<td>报名号：</td><td><input type='text' name='stdaplno' value="<?php echo ($mo['stdaplno']); ?>" /></td>
						<td>学号：</td><td><input type='text' name='stdno' value="<?php echo ($mo['stdno']); ?>" /></td>
						</tr>
						</table>
						</div>
						<?php } ?>
						
						<div class='mingxi'>
						专业信息：
						<table>
						<tr>
						<td>
						办学形式：
						</td>
						<td>
						<select name='f_mj_bxxsid' >
							<?php if($bxxssg=='n'){ ?><option value='0'>无</option><?php } ?>
							<?php if(is_array($bxxsls)): $i = 0; $__LIST__ = $bxxsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['bxxsid']); ?>"><?php echo ($vo['bxxsnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_mj_bxxsid]').val(<?php echo ($mo['f_mj_bxxsid']); ?>)</script>
						</td>
						<?php if($mo['stdid']!=0){ ?>					
						<td>班级：</td>
						<td colspan=9>
						<select name='f_stdxqcls_clsid'>
							<option value='0'>无</option>
							<?php if(is_array($clsls)): $i = 0; $__LIST__ = $clsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['clsid']); ?>">[<?php echo ($vo['sttnm']); ?>]<?php echo ($vo['clsnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_stdxqcls_clsid]').val(<?php echo ($mo['f_stdxqcls_clsid']); ?>)</script>
						</td>
						<?php }else{ ?>
						<td><input type='hidden' name='f_stdxqcls_clsid' value='0' /></td>
						<?php } ?>
						<td><p style='color:#3c763d'>*专业：</p></td>
						<td colspan=9>
						<select name='f_stdxqmj_mjid'>
							<option value='0'>无</option>
							<?php if(is_array($mjls)): $i = 0; $__LIST__ = $mjls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['mjid']); ?>"><?php echo ($vo['mjnm']); ?>（<?php echo ($vo['mjdsc']); ?>）</option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_stdxqmj_mjid]').val(<?php echo ($mo['f_stdxqmj_mjid']); ?>)</script>
						</td>
						</tr>
						</table>
						</div>
						
						<div class='mingxi'>
						基本信息：
						<table>
						<tr>
						<td><p style='color:#3c763d'>*姓名：</p></td><td><input type='text' name='stdnm' value="<?php echo ($mo['stdnm']); ?>" id='stdnm'/></td>
						<td>
						<p style='color:#3c763d'>*性别：</p>
						</td>
						<td>
						<select name='f_std_sexid'>
							<option value='0'>无</option>
							<?php if(is_array($sexls)): $i = 0; $__LIST__ = $sexls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['sexid']); ?>"><?php echo ($vo['sexnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_std_sexid]').val(<?php echo ($mo['f_std_sexid']); ?>)</script>
						</td>
						<td>
						<p style='color:#3c763d'>*民族</p>
						</td>
						<td>
						<select name='f_std_rcid'>
							<option value='0'>无</option>
							<?php if(is_array($rcls)): $i = 0; $__LIST__ = $rcls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['rcid']); ?>"><?php echo ($vo['rcnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_std_rcid]').val(<?php echo ($mo['f_std_rcid']); ?>)</script>
						</td>
						<td>
						<p style='color:#3c763d'>*政治面貌</p>
						</td>
						<td>
						<select name='f_std_zzmmid'>
							<option value='0'>无</option>
							<?php if(is_array($zzmmls)): $i = 0; $__LIST__ = $zzmmls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['zzmmid']); ?>"><?php echo ($vo['zzmmnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_std_zzmmid]').val(<?php echo ($mo['f_std_zzmmid']); ?>)</script>
						</td>
						<td rowspan=4>
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
						</td>
						</tr>
						<tr>
						<td><p style='color:#3c763d'>*籍贯：</p></td><td><input type='text' name='stdnp' value="<?php echo ($mo['stdnp']); ?>" id='stdnp'/></td>
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
						<td>毕业学校：</td><td colspan=3><input  type='text' name='stdsog' value="<?php echo ($mo['stdsog']); ?>" id='stdsog' style='width:330px'/></td>
						<td><p style='color:#3c763d'>*手机号码：</p></td><td colspan=3><input  type='text' name='stdcp' value="<?php echo ($mo['stdcp']); ?>" id='stdcp'/></td>
						</tr>
						<tr>
						<td><p style='color:#3c763d'>*身份证号码：</p></td><td><input  type='text' name='stdidcd' value="<?php echo ($mo['stdidcd']); ?>" id='stdidcd'/></td>
						<td>固话：</td><td><input  type='text' name='stdtlp' value="<?php echo ($mo['stdtlp']); ?>" /></td>
						<td><p style='color:#3c763d'>*出生日期：</p></td><td><script type="text/javascript" src="__PUBLIC__/pblc/DTPK/jddate/adddate.js"></script><input type='text' name='stdbtd' value="<?php echo ($mo['stdbtd']); ?>" id='stdbtd' onclick="SelectDate(this,'yyyy-MM-dd')" readonly /></td>
						<td>QQ：</td><td><input type='text' name='stdqq' value="<?php echo ($mo['stdqq']); ?>" id='stdqq'/></td>
						</tr>
						<tr>
						<td><p style='color:#3c763d'>*家长一关系：</p></td><td><input type='text' name='stdrlta' value="<?php echo ($mo['stdrlta']); ?>" id='stdrlta' placeholder='例如：父子，母子，爷爷等'/></td>
						<td><p style='color:#3c763d'>*家长一姓名：</p></td><td><input type='text' name='stdrltanm' value="<?php echo ($mo['stdrltanm']); ?>" id='stdrltanm'/></td>
						<td><p style='color:#3c763d'>*家长一单位：</p></td><td><input type='text' name='stdrltaocpt' value="<?php echo ($mo['stdrltaocpt']); ?>" id='stdrltaocpt'/></td>
						<td><p style='color:#3c763d'>*家长一手机号：</p></td><td colspan=2><input type='text' name='stdrltacp' value="<?php echo ($mo['stdrltacp']); ?>" id='stdrltacp'/></td>
						</tr>
						<tr>
						<td>家长二关系：</td><td><input type='text' name='stdrltb' value="<?php echo ($mo['stdrltb']); ?>" id='stdrltb' placeholder='例如：父子，母子，爷爷等'/></td>
						<td>家长二姓名：</td><td><input type='text' name='stdrltbnm' value="<?php echo ($mo['stdrltbnm']); ?>" id='stdrltbnm'/></td>
						<td>家长二单位：</td><td><input type='text' name='stdrltbocpt' value="<?php echo ($mo['stdrltbocpt']); ?>" id='stdrltbocpt'/></td>
						<td>家长二手机号：</td><td colspan=2><input type='text' name='stdrltbcp' value="<?php echo ($mo['stdrltbcp']); ?>" id='stdrltbcp'/></td>
						</tr>
						<tr>
						<td>爱好：</td><td><input type='text' name='stdhb' value="<?php echo ($mo['stdhb']); ?>" id='stdhb'/></td>
						<td><p style='color:#3c763d'>*家庭地址：</p></td><td colspan=3><input type='text' name='stdads' value="<?php echo ($mo['stdads']); ?>" id='stdads' style='width:330px'/></td>
						<td>邮政编码：</td><td colspan=2><input type='text' name='stdpst' value="<?php echo ($mo['stdpst']); ?>" id='stdpst'/></td>
						</tr>
						<tr>
						<td>是否有推荐人：</td>
						<td>
						<select name='ifrcmd'>
							<option value='否'>否</option>
							<option value="是">是</option>
						</select>
						<script>$('select[name=ifrcmd]').val("<?php echo ($ifrcmd); ?>")</script>
						</td>
						<td>推荐人姓名：</td><td colspan=2><input type='text' name='stdrcmdnm' value="<?php echo ($mo['stdrcmdnm']); ?>" id='stdrcmdnm' <?php echo ($rcmdcls); ?>/></td>
						<td>推荐人手机号：</td><td colspan=3><input type='text' name='stdrcmdcp' value="<?php echo ($mo['stdrcmdcp']); ?>" id='stdrcmdcp' <?php echo ($rcmdcls); ?>/></td>
						</tr>
						<?php if($mo['stdid']!=0){ ?>
						<tr>
						<td>状态：</td>
						<td colspan=8>
						<select name='f_std_statid'>
							<option value='0'>无</option>
							<?php if(is_array($statls)): $i = 0; $__LIST__ = $statls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['statid']); ?>"><?php echo ($vo['statnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						<script>$('select[name=f_std_statid]').val(<?php echo ($mo['f_std_statid']); ?>)</script>
						</td>
						</tr>
						<?php } ?>
						</table>
						<p style='color:#f00'>注：*号标记的必须填写</p>
						</div>
						
						
						<script>var hdlurlxj='__URL__/updatexj';</script>
						<!-- <?php if($mo['stdid']!=0&&$athm==1){ ?><input type='button' id='updtxj' value='改学籍信息' class='btn btn-success' /><?php } ?> -->
						<div class='clearfix'></div>
						
						
						<?php if($mo['stdid']!=0){ ?>						
						<div class='mingxi'>
						<table>
						<tr>
						<td>工行卡号：</td><td><input type="text" name='stdicbc' value="<?php echo ($mo['stdicbc']); ?>" /></td>
						<td>上传财务时间：</td><td><script type="text/javascript" src="__PUBLIC__/pblc/DatePicker/My97DatePickerHHmmss/WdatePicker.js"></script><input type="text" name='stdupfnctm' value="<?php echo ($mo['stdupfnctm']); ?>" onclick="WdatePicker()" readonly/></td>
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
						<td>信息打印时间：</td><td><input type="text" name='stdpnttm' value="<?php echo ($mo['stdpnttm']); ?>" onclick="WdatePicker()" readonly/></td>
						</tr>
						<tr>
						<td>添加时间：</td><td><input type="text" name='stdaddtm' value="<?php echo ($mo['stdaddtm']); ?>" onclick="WdatePicker()" readonly/></td>
						<td>修改时间：</td><td><input type="text" name='stdmdftm' value="<?php echo ($mo['stdmdftm']); ?>" onclick="WdatePicker()" readonly/></td>
						<td>预录取时间：</td><td><input type="text" name='stdpertm' value="<?php echo ($mo['stdpertm']); ?>" onclick="WdatePicker()" readonly/></td>
						<td>录取时间：</td><td><input type="text" name='stdertm' value="<?php echo ($mo['stdertm']); ?>" onclick="WdatePicker()" readonly/></td>
						</tr>
						</table>
						</div>
						<?php } ?>	
						
						<script>var hdlurljb='__URL__/updatejb'</script>
						<!-- <?php if($mo['stdid']!=0&&$aths==1){ ?><input type='button' id='updtjb' value='改基本信息' class='btn btn-success' /><?php } ?> -->
						<div class='clearfix'></div>
						<input type='button' id='panduan' value=<?php echo ($btnvl); ?> class='btn btn-lg btn-primary' />
						<input type='button' id='updt' value=<?php echo ($btnvl); ?> class='btn btn-lg btn-primary' style='display:none' />
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
	

	
	<div id='myModal' style="display: none;" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	      <div class="modal-content">
	
	        <div class="modal-header">
	        <button type="button" class="close"  id='mdlxfake'><span aria-hidden="true">×</span></button>
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id='mdlx' style='display:none'><span aria-hidden="true">×</span></button>
	          <h4 class="modal-title" id="mySmallModalLabel">提示</h4>
	        </div>
	        <div class="modal-body">
	          	<p id='rslt'>aaa</p>
	        </div>
	        <div class="modal-footer">
	        <button type="button" class="btn btn-success" id='gttj' style='display:none'>没有问题，提交信息</button>
	        <button type="button" class="btn btn-danger" id='sureII' style='display:none'>再检查下，暂不提交</button>
		        <button type="button" class="btn btn-primary" id='sure'>关闭</button>
		    </div>
	      </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	  </div>
	
	<footer class="bs-docs-footer" style='margin-top:10px'>
  <div class="container">				
		<p>Designed by <a href="#" target="_blank">sunbinovic@163.com</a>   管理员<a href='__ROOT__/admin.php'>点此登录</a></p><p>&copy; 2012-<?php echo date('Y',time()); ?> 中国计量学院成教学院 </p>
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