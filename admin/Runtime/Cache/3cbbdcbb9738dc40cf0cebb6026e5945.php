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
 
<script type='text/javascript' src='__PUBLIC__/JS/admin/zspxh.js'></script>
<script type='text/javascript'>
var app_path='__APP__';
var hdlcrtu='__URL__/createAlways';
</script>
</head>

<body>

<div class='container' >
	<div class='col-md-12' >
		<script>
		var hdlbtn='__APP__/Btn/update';
		</script>
		<?php if(is_array($mjls)): $i = 0; $__LIST__ = $mjls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mjv): $mod = ($i % 2 );++$i;?><div class="page-header">
			  <h1><small><?php echo ($mjv['mjnm']); ?></small></h1>
			</div>
			<?php if(is_array($mjv['stdls'])): $i = 0; $__LIST__ = $mjv['stdls'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$stdv): $mod = ($i % 2 );++$i;?><img class='img-thumbnail' src="<?php echo ($stdv['stdpt']); ?>" style='width:72px;height:96px;' /><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
		<br><br><br>
		<form action='__URL__/outputschq/mk/<?php echo ($mk); ?>' method='post'>
		<input id='fadeschq' type='button'  class='btn btn-success btn-lg'  value='生成上传给后勤制作饭卡的学生EXCEL' />
		<input id='trueschq' type='submit' style='display:none' class='btn btn-success btn-lg'  value='生成上传给后勤制作饭卡的学生EXCEL' />
		</form>
	</div>
		
	<div class='clearfix'></div>
	
	
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