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
<script type='text/javascript' src='__PUBLIC__/JS/index/cm.js'></script>
<link href="__PUBLIC__/CSS/index/cm.css" rel="stylesheet">

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

<script type='text/javascript' src='__PUBLIC__/JS/index/cstmusr.js'></script>
<script type='text/javascript'>
var app_path='__APP__';
</script>
</head>

<body>
<!-- head包cstmusr.js -->
<script type="text/javascript" src='__PUBLIC__/JS/index/cstmusrhd.js'></script>

<script type="text/javascript">
var hdllgin='__ROOT__/cstm.php/Cstmusr/loginin';
var hdllgot='__ROOT__/cstm.php/Cstmusr/loginout';
var app_path='__APP__';
</script>
<div class="page-header" style='border-bottom:none' id='slg'>
	<div class='container'>
  		<h1>Geek  <small>极致简单就是美</small></h1>
  	</div>
</div>
<header class="navbar navbar-inverse" id='myAffix' style='z-index:1000;width:100%;border-radius:0'>
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="__ROOT__/admin.php" class="navbar-brand">Geek</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/DDSMOOTHMENU/ddsmoothmenu.css" />
<script>var img_path='__PUBLIC__/pblc/DDSMOOTHMENU/img'</script>
<script type="text/javascript" src="__PUBLIC__/pblc/DDSMOOTHMENU/ddsmoothmenu.js">
/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
* Resources from http://down.liehuo.net
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
</script>
        <div id="smoothmenu1" class="ddsmoothmenu">
            <?php echo ($tree); ?>
            
        </div>
      
      <div>
	      <ul class='nav navbar-nav navbar-right'>
	      <li><?php echo ($ntfa); ?></li>
	      <li>
			<script>var hdlatcsrc='__APP__/Atc/query/atckw/';</script>
			<script type="text/javascript" src='__PUBLIC__/JS/index/atchd.js'></script>
			    <form class="navbar-form navbar-left">
				  <div class="input-group">
				      <input type="text" class="form-control" placeholder="搜索相应的内容" id='atckw'>
				      <span class="input-group-btn">
				        <button class="btn btn-primary" type="button" id='atc_search'>Search</button>
				      </span>
				    </div><!-- /input-group -->
				</form>
			    
			</li>
	      <?php echo ($lgstt); ?>
	      
	      </ul>
      
      </div>
    </nav>
  </div>
</header>
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
		    <label for="cstmusrnm">用户名</label>
		    <input type="text" class="form-control" name='cstmusrnm' id="cstmusrnm" placeholder="请输入用户名">
		  </div>
		  <div class="form-group">
		    <label for="cstmusrpw">密码</label>
		    <input type="password" class="form-control" name='cstmusrpw' id="cstmusrpw" placeholder="请输入密码">
		  </div>
		  <div class="checkbox">
		    <label>
		      <input type="checkbox" id='rmb'><input type='hidden' name='rmb'> 下次自动登录
		    </label>
		  </div>
		  <div id='errCtn'></div>
		  <input type="button" class="btn btn-primary" value='登录' id='cstmusr_logininIdx'>
		  <p>还没有帐号 <a href="__ROOT__/cstm.php/Cstmusr/gtxpg/x/regist">注册</a>&nbsp;&nbsp;&nbsp;&nbsp;忘记密码 <a href="__ROOT__/cstm.php/Cstmusr/gtxpg/x/forget">获取密码</a></p>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
	  </div>
    </div>
  </div>
</div>


    <!-- Docs page layout -->
    
    <div class="container bs-docs-container">
		
    
    
      <div>
      	
        <div class="col-md-12" role="main">
	        <div>
			    <?php echo ($bdo['bdnm']); ?>
			</div>
			
			<div>
				<ul class="list-unstyled col-md-10">
				<?php if(is_array($atcls)): $i = 0; $__LIST__ = $atcls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span><a href="__APP__/Atc/view/atcid/<?php echo ($vo['atcid']); ?>" class='pull-left' style="color:#000; <?php echo ($vo['atcstyle']); ?>"><i class="<?php echo ($vo['atcflag']); ?>"></i> <?php echo ($vo['atctpcsrk']); ?></a></span><span class='tag pull-right' style='color:#ccc'><?php echo ($vo['atcmdftm']); ?></span></li>
				<li class='clearfix' style='border-bottom:1px dashed #eee;margin:20px 0px;'></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
	         
	        </div>
        	
        	<div class='clearfix'></div>
          	<div><?php echo ($show); ?></div>
        </div>
        
        
        
     </div>
	<div class='clearfix'></div>
    <footer class="bs-docs-footer">
  <div class="container">				
		<p>Designed by <a href="__ROOT__/admin.php" target="_blank">sunbinovic@163.com</a></p>&copy; 2012-<?php echo date('Y',time()); ?> GEEK footer </p>
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