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

<script type='text/javascript' src='__PUBLIC__/JS/admin/mj.js'></script>
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
			  <a href='javascript:leftright()' id='btn-lft' style='display:<?php echo ($lftbtncls); ?>'><i class="glyphicon glyphicon-triangle-right"></i></a><i class="glyphicon glyphicon-th-list"></i> <?php echo ($theme); ?>
			</div>
			<div class="panel-body">
				<form>
				<input type='hidden' name='mjid' value="<?php echo ($mo['mjid']); ?>" />
				<table class='tb'>
				
				<tr><td>年级名称</td>
				<td>
				<select name='f_mj_grdid'>
					<?php if(is_array($grdls)): $i = 0; $__LIST__ = $grdls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['grdid']); ?>"><?php echo ($vo['grdnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<script>$('select[name=f_mj_grdid]').val(<?php echo ($mo['f_mj_grdid']); ?>)</script>
				</td>
				</tr>
				
				<tr><td>办学形式名称</td>
				<td>
				<select name='f_mj_bxxsid'>
					<option value='0'>无</option>
					<?php if(is_array($bxxsls)): $i = 0; $__LIST__ = $bxxsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['bxxsid']); ?>"><?php echo ($vo['bxxsnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<script>$('select[name=f_mj_bxxsid]').val(<?php echo ($mo['f_mj_bxxsid']); ?>)</script>
				</td>
				</tr>
				
				<tr><td>层次</td><td>
				<select name='f_mj_ccid'>
					<option value='0'>无</option>
					<?php if(is_array($ccls)): $i = 0; $__LIST__ = $ccls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['ccid']); ?>"><?php echo ($vo['ccnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<script>$('select[name=f_mj_ccid]').val(<?php echo ($mo['f_mj_ccid']); ?>)</script>
				</td></tr>
				<tr><td>科类</td><td>
				<select name='f_mj_klid'>
					<option value='0'>无</option>
					<?php if(is_array($klls)): $i = 0; $__LIST__ = $klls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['klid']); ?>"><?php echo ($vo['klnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<script>$('select[name=f_mj_klid]').val(<?php echo ($mo['f_mj_klid']); ?>)</script>
				</td></tr>
				<tr><td>学习形式</td><td>
				<select name='f_mj_xxxsid'>
					<option value='0'>无</option>
					<?php if(is_array($xxxsls)): $i = 0; $__LIST__ = $xxxsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['xxxsid']); ?>"><?php echo ($vo['xxxsnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<script>$('select[name=f_mj_xxxsid]').val(<?php echo ($mo['f_mj_xxxsid']); ?>)</script>
				</td></tr>
				<tr><td>招生范围</td><td>
				<select name='f_mj_zsfwid'>
					<option value='0'>无</option>
					<?php if(is_array($zsfwls)): $i = 0; $__LIST__ = $zsfwls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['zsfwid']); ?>"><?php echo ($vo['zsfwnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<script>$('select[name=f_mj_zsfwid]').val(<?php echo ($mo['f_mj_zsfwid']); ?>)</script>
				</td></tr>
				<tr><td>学制：</td><td>
				<select name='f_mj_xzid'>
					<option value='0'>无</option>
					<?php if(is_array($xzls)): $i = 0; $__LIST__ = $xzls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['xzid']); ?>"><?php echo ($vo['xznm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<script>$('select[name=f_mj_xzid]').val(<?php echo ($mo['f_mj_xzid']); ?>)</script>
				</td></tr>
				<tr><td>专业代码：</td><td><input type='text' name='mjdm' value="<?php echo ($mo['mjdm']); ?>" id='mjdm'/></td></tr>
				<tr><td>专业名称：</td><td><input type='text' name='mjnm' value="<?php echo ($mo['mjnm']); ?>" id='mjnm'/></td></tr>
				<tr><td>本部今年是否招生：</td><td>
				<select name='mjbbzs'>
					<option value='0'>否</option>
					<option value="1">是</option>
					
				</select>
				<script>$('select[name=mjbbzs]').val(<?php echo ($mo['mjbbzs']); ?>)</script>
				</td></tr>
				<tr><td>开设站点</td><td>
				<input type='hidden' name='mjsttu' value="<?php echo ($mo['mjsttu']); ?>" />
				<span id='mjsttuset'>
				<?php if(is_array($sttlsub)): $i = 0; $__LIST__ = $sttlsub;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="alert alert-warning alert-dismissible col-md-6" role="alert" id="myAlert_<?php echo ($vo['sttid']); ?>">
				      <button type="button" class="close" aria-label="Close" id="cls_<?php echo ($vo['sttid']); ?>" onclick="gbmjsttu(<?php echo ($vo['sttid']); ?>)"><span aria-hidden="true">×</span></button>
				      	<?php echo ($vo['sttnm']); ?>
				    </div><?php endforeach; endif; else: echo "" ;endif; ?>
			    
			    </span>
			    <!-- Small modal -->



			   <span>
			   <a href='#' data-toggle="modal" data-target=".bs-example-modal-sm">
				   <div class="alert alert-info alert-dismissible col-md-1" role="alert">
				      <i class='glyphicon glyphicon-plus'></i>
				    </div>
			    </a>
			   
			   </span>
			   <div style="display: none;" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
			    <div class="modal-dialog modal-sm">
			      <div class="modal-content">
			
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id='mdlx'><span aria-hidden="true">×</span></button>
			          <h4 class="modal-title" id="mySmallModalLabel">选择站点</h4>
			        </div>
			        <div class="modal-body">
			          	<select id='sttnw'>
				    	<option value=''></option>
					      <?php if(is_array($sttls)): $i = 0; $__LIST__ = $sttls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['sttid']); ?>-<?php echo ($vo['sttnm']); ?>"><?php echo ($vo['sttnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					    </select>
			        </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-primary" id='addstt'>确认添加</button>
				    </div>
			      </div><!-- /.modal-content -->
			    </div><!-- /.modal-dialog -->
			  </div>
			   
				 
				</td></tr>			
				</table>
				
				<link rel="stylesheet" href="__PUBLIC__/pblc/ueditor/themes/default/ueditor.css"/>
				<script type="text/javascript" src="__PUBLIC__/pblc/ueditor/editor_config.js"></script>
				<script type="text/javascript" src="__PUBLIC__/pblc/ueditor/editor_all.js"></script>
				<p>专业描述</p>
				<div id="myEditor">
				<script type="text/javascript">
					var editor = new baidu.editor.ui.Editor({
					    initialContent: '<?php echo ($mo["mjdsc"]); ?>'
					});
					editor.render("myEditor");
				</script>
				</div>
				<textarea name='mjdsc' style='display:none'></textarea>

				<input type='button' id='updt' value="<?php echo ($btnvl); ?>" class='btn btn-primary'/>
				</form>
			</div>
		</div>
	</div>
	<div class='clearfix'></div>
	
	<div style="display: none;" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-sm">
	      <div class="modal-content">
	
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="mdlx"><span aria-hidden="true">×</span></button>
	          <h4 class="modal-title" id="mySmallModalLabel">选择站点</h4>
	        </div>
	        <div class="modal-body">
	          	<select id="sttnw">
		    	<option value=""></option>
			      <option value="1-本部">本部</option><option value="2-河北">河北</option>					    </select>
	        </div>
	        <div class="modal-footer">
		        <button type="button" class="btn btn-primary" id="addstt">确认添加</button>
		    </div>
	      </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
	  </div>
	
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