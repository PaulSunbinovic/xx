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

<script type='text/javascript' src='__PUBLIC__/JS/admin/atc.js'></script>
<script type='text/javascript'>
var hdlurl='__URL__/update';
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
	<div class='col-md-2' id='lft' class='pull-left' style='display:<?php echo ($lftcls); ?>;'>
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
		<div class='<?php echo ($rgtcls); ?>' id='rgt' >
		<div class="panel panel-default">
			<div class="panel-heading">
			  <i class="glyphicon glyphicon-th-list"></i> <?php echo ($theme); ?>
			</div>
			<div class="panel-body">	
				<form>
				<input type='hidden' name='atcid' value="<?php echo ($mo['atcid']); ?>" />
				<table class='tb'>
				
				<tr><td>板块名称</td>
				<td>
				<select name='f_atc_bdid' class='form-control input-sm'>
					<option value='0'>无</option>
					<?php echo ($tree); ?>
				</select>
				<script>$('select[name=f_atc_bdid]').val(<?php echo ($mo['f_atc_bdid']); ?>)</script>
				</td>
				</tr>
				<tr><td>标题：</td><td><input type='text' name='atctpc' value="<?php echo ($mo['atctpc']); ?>" id='atctpc' class='form-control input-sm'/></td></tr>
				<tr><td>作者：</td><td><input type='text' name='atcath' value="<?php echo ($mo['atcath']); ?>" id='atcath' class='form-control input-sm'/></td></tr>
				<script type="text/javascript" src="__PUBLIC__/pblc/DatePicker/My97DatePickerHHmmss/WdatePicker.js"></script>
				<tr><td>添加时间：</td><td><input type="text" name='atcaddtm' value="<?php echo ($mo['atcaddtm']); ?>" onclick="WdatePicker()" readonly style='cursor:auto' class='form-control input-sm'/></td></tr>
				<tr><td>修改时间：</td><td><input type="text" name='atcmdftm' value="<?php echo ($mo['atcmdftm']); ?>" onclick="WdatePicker()" readonly style='cursor:auto' class='form-control input-sm'/><?php echo ($mo['atcmdftmorg']); ?></td></tr>
				<tr><td>置顶情况</td>
				<td>
				<select name='atctp' class='form-control input-sm'>
					<option value='0'>未置顶</option>
					<option value='1'>置顶</option>
				</select>
				<script>$('select[name=atctp]').val(<?php echo ($mo['atctp']); ?>)</script>
				</td>
				</tr>
				
				<tr><td>审核情况</td>
				<td>
				<select name='atcps' class='form-control input-sm'>
					<option value='0'>未通过</option>
					<option value='1'>通过</option>
				</select>
				<script>$('select[name=atcps]').val(<?php echo ($mo['atcps']); ?>)</script>
				</td>
				</tr>
				
				<tr><td>是否通知</td>
				<td>
				<select name='atcanc' class='form-control input-sm'>
					<option value='0'>否</option>
					<option value='1'>是</option>
					
				</select>
				<script>$('select[name=atcanc]').val(<?php echo ($mo['atcanc']); ?>)</script>
				</td>
				</tr>
				
				<tr><td>是否动态</td>
				<td>
				<select name='atcdnmc' class='form-control input-sm'>
					<option value='0'>否</option>
					<option value='1'>是</option>
					
				</select>
				<script>$('select[name=atcdnmc]').val(<?php echo ($mo['atcdnmc']); ?>)</script>
				</td>
				</tr>
				
				<tr><td>浏览计数：</td><td><input type='text' name='atccnt' value="<?php echo ($mo['atccnt']); ?>" id='atccnt' class='form-control input-sm'/></td></tr>
				
				<tr><td>是否内网</td>
				<td>
				<select name='atcnw' class='form-control input-sm'>
					<option value='0'>否</option>
					<option value='1'>是</option>
					
				</select>
				<script>$('select[name=atcnw]').val(<?php echo ($mo['atcnw']); ?>)</script>
				</td>
				</tr>
				
				<tr><td>赞：</td><td><input type='text' name='atczn' value="<?php echo ($mo['atczn']); ?>" id='atczn' class='form-control input-sm'/></td></tr>
				<tr><td>吐槽：</td><td><input type='text' name='atctc' value="<?php echo ($mo['atctc']); ?>" id='atctc' class='form-control input-sm'/></td></tr>
				
				<tr><td>是否查看</td>
				<td>
				<select name='atcvw' class='form-control input-sm'>
					<option value='0'>否</option>
					<option value='1'>是</option>
					
				</select>
				<script>$('select[name=atcvw]').val(<?php echo ($mo['atcvw']); ?>)</script>
				</td>
				</tr>
				
				<tr><td>是否招生</td>
				<td>
				<select name='atczs' class='form-control input-sm'>
					<option value='0'>否</option>
					<option value='1'>是</option>
					
				</select>
				<script>$('select[name=atczs]').val(<?php echo ($mo['atczs']); ?>)</script>
				</td>
				</tr>
				
				</table>
				<div>封面：</div>
				<div>
		            <ul id="myTab" class="nav nav-tabs">
		              <li class="active"><a href="#ntv" data-toggle="tab">本地上传</a></li>
		              <li class=""><a href="#net" data-toggle="tab">网络图片</a></li>
		             
		            </ul>
		            <div id="myTabContent" class="tab-content">
		              <div class="tab-pane fade active in" id="ntv">
		                <!-- file start -->
						 <link rel="stylesheet" href="__PUBLIC__/pblc/FileUpload/uploadify/uploadify.css">
						 <script type="text/javascript" src='__PUBLIC__/pblc/FileUpload/uploadify/uploadify.js'></script>
						<script type="text/javascript" src="__PUBLIC__/pblc/FileUpload/uploadify/swfobject.js"></script>
						<script type="text/javascript">
						var file_path='__PUBLIC__/pblc/FileUpload';
						var hdlupload='__APP__/FileUpload/upload/issml/n/wjj/atc';////注意
						var upload_path='__ROOT__/Uploads/atc';
						
						</script>
						<script type="text/javascript" src='__PUBLIC__/pblc/FileUpload/int.js'></script>
						<div>
						<img src="<?php echo ($mo['atccvII']); ?>" alt="<?php echo ($alt); ?>"  class='img-polaroid' id='imgg'/>
						</div>
						<div style="width:80px; height:26px; overflow:hidden;"><input type="file"  name="photo1" id="uploadify"/></div>
						<!-- 隐藏系统所需的用户upt -->
						<input type='hidden' name='atccv' value="<?php echo ($mo['atccv']); ?>" id='pt'/>
						<!-- file over -->
		              </div>
		              <div class="tab-pane fade" id="net">
		              	  <img src="<?php echo ($mo['atccvII']); ?>" alt="<?php echo ($alt); ?>"  class='img-polaroid'  id='atccvdip'/><br/>
		              	  向对话框里贴入URL：<input  type='text' id='netpic' value='' class='span6' class='form-control input-sm'/>
		              </div>
		              
		            </div>
		        </div>
				<div>摘要：<br/><textarea name='atcsmr' class='col-md-10' class='form-control'><?php echo ($mo['atcsmr']); ?></textarea></div>
				<div class='clearfix'></div>
				<link rel="stylesheet" href="__PUBLIC__/pblc/ueditor/themes/default/ueditor.css"/>
				<script type="text/javascript" src="__PUBLIC__/pblc/ueditor/editor_config.js"></script>
				<script type="text/javascript" src="__PUBLIC__/pblc/ueditor/editor_all.js"></script>
				<div>
				<p>文章内容</p>
				  <div id="myEditor">
					<script type="text/javascript">
						var editor = new baidu.editor.ui.Editor({
						    initialContent: '<?php echo ($mo["atcctt"]); ?>'
						});
						editor.render("myEditor");
					</script>
					</div>
				</div>
				<textarea name='atcctt' style='display:none'></textarea>
				<input type='button' id='updt' value=<?php echo ($btnvl); ?> class='btn btn-primary'/>
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