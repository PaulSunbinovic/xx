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
<script type='text/javascript' src='__PUBLIC__/JS/zsptwap/cm.js'></script>
<link href="__PUBLIC__/CSS/zsptwap/cm.css" rel="stylesheet">
<!-- 移动设备 -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

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

<script type='text/javascript' src='__PUBLIC__/JS/zsptwap/std.js'></script>
<script type='text/javascript'>
var hdlurl='__URL__/update';
var hdlcrtu='__URL__/createAlways';
</script>



<link type="text/css" rel="stylesheet" href="__PUBLIC__/CSS/zsptwap/demo.css" />

<!--必要样式-->
<link type="text/css" rel="stylesheet" href="__PUBLIC__/CSS/zsptwap/jquery.mmenu.css" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/CSS/zsptwap/jquery.mmenu.dragopen.css" />


<script type="text/javascript" src="__PUBLIC__/JS/zsptwap/jquery.mmenu.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/JS/zsptwap/jquery.mmenu.dragopen.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/JS/zsptwap/jquery.mmenu.fixedelements.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/JS/zsptwap/mn.js"></script>
</head>
<body>
<div id="page">
	<!-- head包cstmusr.js -->

<div class="header FixedTop" id='header'>
	<a href='#menu' id='menu'></a>
	<?php echo ($cprtnm); ?>
	<a id='home' href='javascript:history.go(-1)'><i class='glyphicon glyphicon-menu-left' style='font-size:22px;top:5px'></i></a>
</div>
	<div class="content" id="content" style='margin-top:20px'>
		
		<form>
			<input type='hidden' name='stdid' id='stdid' value="<?php echo ($mo['stdid']); ?>" />
			
			<div class='clearfix'></div>
			
			
			专业信息：
			<div class="form-group">
			    <label class='col-md-2  control-label' for="f_mj_bxxsid">办学形式</label>
			    <div class="col-md-4">
			    	<select name='f_mj_bxxsid' class='form-control input-sm'>
						<?php if($bxxssg=='n'){ ?><option value='0'>无</option><?php } ?>
						<?php if(is_array($bxxsls)): $i = 0; $__LIST__ = $bxxsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['bxxsid']); ?>"><?php echo ($vo['bxxsnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<script>$('select[name=f_mj_bxxsid]').val(<?php echo ($mo['f_mj_bxxsid']); ?>)</script>
		   		</div>
		   	</div>
			
			
			
			<div class="form-group">
			    <label class='col-md-2  control-label' for="f_stdxqmj_mjid">专业</label>
			    <div class="col-md-4">
			    	<select name='f_stdxqmj_mjid' class='form-control input-sm'>
						<option value='0'>无</option>
						<?php if(is_array($mjls)): $i = 0; $__LIST__ = $mjls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['mjid']); ?>"><?php echo ($vo['mjnm']); ?>（<?php echo ($vo['mjdsc']); ?>）</option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<script>$('select[name=f_stdxqmj_mjid]').val(<?php echo ($mo['f_stdxqmj_mjid']); ?>)</script>
		   		</div>
		   	</div>		
			
			
			
			基本信息：
			<div class="form-group">
			    <label class='col-md-2  control-label' for="stdnm">姓名</label>
			    <div class="col-md-4">
			    	<input type="text" class="form-control"  id="stdnm" name='stdnm'   value="<?php echo ($mo['stdnm']); ?>" >
		    	</div>
		    </div>
		    <div class="form-group">
			    <label class='col-md-2  control-label' for="f_std_sexid">性别</label>
			    <div class="col-md-4">
			    	<select name='f_std_sexid' class='form-control input-sm'>
						<option value='0'>无</option>
						<?php if(is_array($sexls)): $i = 0; $__LIST__ = $sexls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['sexid']); ?>"><?php echo ($vo['sexnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<script>$('select[name=f_std_sexid]').val(<?php echo ($mo['f_std_sexid']); ?>)</script>
		   		</div>
		   	</div>	
			<div class="form-group">
			    <label class='col-md-2  control-label' for="f_std_rcid">民族</label>
			    <div class="col-md-4">
			    	<select name='f_std_rcid' class='form-control input-sm'>
						<option value='0'>无</option>
						<?php if(is_array($rcls)): $i = 0; $__LIST__ = $rcls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['rcid']); ?>"><?php echo ($vo['rcnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<script>$('select[name=f_std_rcid]').val(<?php echo ($mo['f_std_rcid']); ?>)</script>
		   		</div>
		   	</div>	
			
			<div class="form-group">
			    <label class='col-md-2  control-label' for="stdsol">文理科</label>
			    <div class="col-md-4">
			    	<select name='stdsol' class='form-control input-sm'>
						<option value='无'>无</option>
						<option value='文科'>文科</option>
						<option value='理科'>理科</option>
					</select>
					<script>$('select[name=stdsol]').val("<?php echo ($mo['stdsol']); ?>")</script>
		   		</div>
		   	</div>	
			
			<input type='hidden' name='stdpt' value="<?php echo ($mo['stdpt']); ?>" id='pt'/>
			
			<div class="form-group">
			    <label class='col-md-2  control-label' for="stdcp">手机号码</label>
			    <div class="col-md-4">
			    	<input type="text" class="form-control"  id="stdcp" name='stdcp'   value="<?php echo ($mo['stdcp']); ?>" >
		    	</div>
		    </div>
		    
		    <div class="form-group">
			    <label class='col-md-2  control-label' for="stdidcd">身份证号码</label>
			    <div class="col-md-4">
			    	<input type="text" class="form-control"  id="stdidcd" name='stdidcd'   value="<?php echo ($mo['stdidcd']); ?>" >
		    	</div>
		    </div>
		    
		    <div class="form-group">
			    <label class='col-md-2  control-label' for="stdrlta">家长关系</label>
			    <div class="col-md-4">
			    	<input type="text" class="form-control"  id="stdrlta" name='stdrlta' placeholder='例如：父子，母子，爷爷等'  value="<?php echo ($mo['stdrlta']); ?>" >
		    	</div>
		    </div>
		     <div class="form-group">
			    <label class='col-md-2  control-label' for="stdrltanm">家长姓名</label>
			    <div class="col-md-4">
			    	<input type="text" class="form-control"  id="stdrltanm" name='stdrltanm'   value="<?php echo ($mo['stdrltanm']); ?>" >
		    	</div>
		    </div>
		    
		    <div class="form-group">
			    <label class='col-md-2  control-label' for="stdrltacp">家长手机号码</label>
			    <div class="col-md-4">
			    	<input type="text" class="form-control"  id="stdrltacp" name='stdrltacp'   value="<?php echo ($mo['stdrltacp']); ?>" >
		    	</div>
		    </div>
			
			<div class="form-group">
			    <label class='col-md-2  control-label' for="ifrcmd">是否有推荐人</label>
			    <div class="col-md-4">
			    	<select name='ifrcmd' class='form-control input-sm'>
						<option value='否'>否</option>
						<option value="是">是</option>
					</select>
					<script>$('select[name=ifrcmd]').val("<?php echo ($ifrcmd); ?>")</script>
		   		</div>
		   	</div>	
			
			<div class="form-group">
			    <label class='col-md-2  control-label' for="stdrcmdnm">推荐人姓名</label>
			    <div class="col-md-4">
			    	<input type="text" class="form-control"  id="stdrcmdnm" name='stdrcmdnm'   value="<?php echo ($mo['stdrcmdnm']); ?>" <?php echo ($rcmdcls); ?> />
		    	</div>
		    </div>
			
			
			
			
			<input type='button' id='panduan' value=<?php echo ($btnvl); ?> class='btn btn-lg btn-primary' />
			<input type='button' id='updt' value=<?php echo ($btnvl); ?> class='btn btn-lg btn-primary' style='display:none' />
			
		</form>
       
	</div>
	
	
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
	
	
<script  type="text/javascript" src="__PUBLIC__/pblc/gotop/gotop.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/gotop/gotop.css" media="all"/>
	 <script type='text/javascript' src='__PUBLIC__/JS/zsptwap/stdhd.js'></script>
<script type='text/javascript' src='__PUBLIC__/JS/zsptwap/wxusrhd.js'></script>
<script>var hdlstdlgot='__APP__/Std/loginout';</script>
<script>var hdlwxlgot='__APP__/Wxusr/loginout';</script>
<script>var app_path='__APP__';</script>
<script>var hdlstdlgin='__APP__/Std/loginin';</script>
<nav id="menu" style='z-index:2000'>
	<ul>
	<?php if($stdoss){ ?>
		<li>
		<a href="__APP__/Std/gtxpg/x/center"><img src="<?php echo ($stdoss['stdpt']); ?>" class='img-circle' style='width:30px;height:30px' />&nbsp;&nbsp;<?php echo ($stdoss['stdnm']); ?>&nbsp;&nbsp;的个人中心</a>&nbsp;&nbsp;
		</li>
		<li id='std_loginout'>
		<a style='cursor:pointer'><i class='glyphicon glyphicon-off'></i> 退出</a>
		</li>
	<?php }else if($wxusross){ ?>	
		<li>
		<a href='__APP__/Wxusr/gtxpg/x/center'><img src="<?php echo ($wxusross['wxusrpt']); ?>" class='img-circle' style='width:30px;height:30px' />&nbsp;&nbsp;<?php echo ($wxusross['wxusrnm']); ?>&nbsp;&nbsp;的个人中心</a>&nbsp;&nbsp;
		</li>
		
		<li id='wxusr_loginout'>
		<a style='cursor:pointer'><i class='glyphicon glyphicon-off'></i> 退出</a>
		</li>
	<?php }else{ ?>	
		<li>
		<a href='#' data-toggle='modal' data-target='#myModal'><i class='glyphicon glyphicon-user'></i> 登录</a>
		</li>
	<?php } ?>	
	<script>var hdlatcsrc='__APP__/Atc/query/atckw/';</script>
	<script type="text/javascript" src='__PUBLIC__/JS/zsptwap/atchd.js'></script>
	<li><a><input style='background-color:#333;border:1px;border-bottom-style:solid;border-top-style:none;border-left-style:none;border-right-style:none;' id='atckw' /> <i class='glyphicon glyphicon-search' id='atc_search'></i></a></li>
	<li><a href='__APP__'><i class='glyphicon glyphicon-home'></i> 首页</a></li>
	</ul>
</nav>


<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">登录</h4>
	      </div>
	      <div class="modal-body">
	        <form>
			  <div class="form-group">
			    <label for="stdnm">姓名</label>
			    <input type="text" class="form-control" name='stdnm' id="stdnm" placeholder="请输入姓名">
			  </div>
			  <div class="form-group">
			    <label for="stdidcd">身份证号码</label>
			    <input type="text" class="form-control" name='stdidcd' id="stdidcd" placeholder="请输入身份证号码">
			  </div>
			  <!-- 
			  <div class="checkbox">
			    <label>
			      <input type="checkbox" id='rmb'><input type='hidden' name='rmb'> 下次自动登录
			    </label>
			  </div>
			   -->
			  <div id='errCtn'></div>
			  <input type="button" class="btn btn-success btn-lg btn-block" value='登录' id='std_logininIdx'>
			  
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
    top: $('#slg').height()+$('header').height(),//数字自定义
    bottom: function () {
		$('#myAffix').css('top','0');//自定义
      return (this.bottom = $('.footer').outerHeight(true))
    }
  }
})

</script>
</div>
</body>
</html>