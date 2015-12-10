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
url_path='__URL__';
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
					
					<?php if($bmcg=='y'){ ?>
					<div class="col-lg-12">
			            <h1 class="page-header" style='color:#3c763d'>
			                	报名成功
			            </h1>
			        </div>
			        <?php } ?>
			        <div class='clearfix'></div>
					<div class='mingxi'>
					<table>
					<tr>
					<td>报名号：</td><td><?php echo ($mo['stdaplno']); ?></td>
					<!-- <td>学号：</td><td><?php echo ($mo['stdno']); ?></td> -->
					</tr>
					</table>
					</div>
					
					
					<div class='mingxi'>
					专业信息：
					<table>
					<tr>
					<td>
					<input type='hidden' name='stdid' value="<?php echo ($mo['stdid']); ?>" />
					办学形式：
					</td>
					<td>
					<?php echo ($mo['bxxsnm']); ?>
					</td>
					<!-- 
					<td>班级：</td>
					<td colspan=9>
					<?php echo ($mo['clsnm']); ?></td>
					 -->
					<td><p style='color:#3c763d'>*专业：</p></td>
					<td colspan=9>
					<?php echo ($mo['mjnm']); ?>（<?php echo ($mo['mjdsc']); ?>）</td>
					</tr>
					</table>
					</div>
					
					<div class='mingxi'>
					基本信息：
					<table>
					<tr>
					<td><p style='color:#3c763d'>*姓名：</p></td><td><?php echo ($mo['stdnm']); ?></td>
					<td>
					<p style='color:#3c763d'>*性别：</p>
					</td>
					<td>
					<?php echo ($mo['sexnm']); ?></td>
					<td>
					<p style='color:#3c763d'>*民族</p>
					</td>
					<td>
					<?php echo ($mo['rcnm']); ?></td>
					<td>
					<p style='color:#3c763d'>*政治面貌</p>
					</td>
					<td>
					<?php echo ($mo['zzmmnm']); ?></td>
					<td rowspan=4>
					<div>
					<div>
					<img src="<?php echo ($mo['stdpt']); ?>" alt=""  class='img-thumbnail'  style="width:100px;"  id='imgg'/>
					</div>
					</div>
					</td>
					</tr>
					<tr>
					<td><p style='color:#3c763d'>*籍贯：</p></td><td><?php echo ($mo['stdnp']); ?></td>
					<td>文理科：</td>
					<td>
					<?php echo ($mo['stdsol']); ?>
					</td>
					<td>
					学历
					</td>
					<td>
					<?php echo ($mo['xlnm']); ?>
					</td>
					<td>高考成绩：</td><td><?php echo ($mo['stdcee']); ?></td>
					</tr>
					<tr>
					<td>毕业学校：</td><td colspan=3><?php echo ($mo['stdsog']); ?></td>
					<td><p style='color:#3c763d'>*手机号码：</p></td><td colspan=3><?php echo ($mo['stdcp']); ?></td>
					</tr>
					<tr>
					<td><p style='color:#3c763d'>*身份证号码：</p></td><td><?php echo ($mo['stdidcd']); ?></td>
					<td>固话：</td><td><?php echo ($mo['stdtlp']); ?></td>
					<td><p style='color:#3c763d'>*出生日期：</p></td><td><?php echo ($mo['stdbtd']); ?></td>
					<td>QQ：</td><td><?php echo ($mo['stdqq']); ?></td>
					</tr>
					<tr>
					<td><p style='color:#3c763d'>*家长一关系：</p></td><td><?php echo ($mo['stdrlta']); ?></td>
					<td><p style='color:#3c763d'>*家长一姓名：</p></td><td><?php echo ($mo['stdrltanm']); ?></td>
					<td><p style='color:#3c763d'>*家长一单位：</p></td><td><?php echo ($mo['stdrltaocpt']); ?></td>
					<td><p style='color:#3c763d'>*家长一手机号：</p></td><td colspan=2><?php echo ($mo['stdrltacp']); ?></td>
					</tr>
					<tr>
					<td>家长二关系：</td><td><?php echo ($mo['stdrltb']); ?></td>
					<td>家长二姓名：</td><td><?php echo ($mo['stdrltbnm']); ?></td>
					<td>家长二单位：</td><td><?php echo ($mo['stdrltbocpt']); ?></td>
					<td>家长二手机号：</td><td colspan=2><?php echo ($mo['stdrltbcp']); ?></td>
					</tr>
					<tr>
					<td>爱好：</td><td><?php echo ($mo['stdhb']); ?></td>
					<td>家庭地址：</td><td colspan=3><?php echo ($mo['stdads']); ?></td>
					<td>邮件：</td><td colspan=2><?php echo ($mo['stdpst']); ?></td>
					</tr>
					<tr>
					<td>是否有推荐人：</td>
					<td>
					<?php echo ($ifrcmd); ?>
					</td>
					<td>推荐人姓名：</td><td colspan=2><?php echo ($mo['stdrcmdnm']); ?></td>
					<td>推荐人手机号：</td><td colspan=3><?php echo ($mo['stdrcmdcp']); ?></td>
					</tr>
					<tr>
					<td>状态：</td>
					<td colspan=8>
					<?php echo ($mo['statnm']); ?>
					</td>
					</tr>
					</table>
					</div>
					
					
					<div class='clearfix'></div>
					
					<!-- 
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
					 -->
					<!-- <?php if($mo['stdid']!=0&&$aths==1){ ?><input type='button' id='updtjb' value='改基本信息' class='btn btn-success' /><?php } ?> -->
					<div class='clearfix'></div>
					<div class='clearfix'></div>
					<br/>
					<!--  
					特殊情况:
					<div class='clearfix'></div>
					<table class="table table-striped">
						<tr><th>时间</th><th>具体情况</th></tr>
						<?php if(is_array($tsqkls)): $i = 0; $__LIST__ = $tsqkls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($vo['tsqktm']); ?></td><td><?php echo ($vo['tsqknr']); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</table>
					<a href="#"  class='btn btn-success'>前往特殊情况中心</a>
					<div class='clearfix'></div>
					-->	
								
					<a href="__APP__/Cw/gtxpg/x/center" class='btn btn-success btn-lg' role='button'>查看缴费信息</a>
				 		
					
				
			</div>
		</div>
	</div>
	<div class='clearfix'></div>
	
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