<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit">
<!-- 避免IE使用兼容模式 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
      	
        <div class="col-md-8" role="main">
	        <div>
			    <div id="carousel-example-captions" class="carousel slide" data-ride="carousel">
			      <ol class="carousel-indicators">
			      	<?php if(is_array($atcfcsls)): $i = 0; $__LIST__ = $atcfcsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($vo['class']); ?>" data-target="#carousel-example-captions" data-slide-to="<?php echo ($i-1); ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
			      </ol>
			      <div class="carousel-inner" role="listbox">
			      	<?php if(is_array($atcfcsls)): $i = 0; $__LIST__ = $atcfcsls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item <?php echo ($vo['class']); ?>">
					        <a href="__APP__/Atc/view/atcid/<?php echo ($vo['atcid']); ?>"><img  src="<?php echo ($vo['atccv']); ?>" style='width:100%' data-src="holder.js/900x500/auto/#777:#777" alt="<?php echo ($vo['atctpc']); ?>"></a>
					        <div class="carousel-caption">
						        <h3></h3>
						        <p><a href="__APP__/Atc/view/atcid/<?php echo ($vo['atcid']); ?>" style='font-size:18px;color:#fff;text-decoration:none'><?php echo ($vo['atctpc']); ?></a></p>
					        </div>
				        </div><?php endforeach; endif; else: echo "" ;endif; ?>
			      </div>
			      <a class="left carousel-control" href="#carousel-example-captions" role="button" data-slide="prev">
			        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			        <span class="sr-only">Previous</span>
			      </a>
			      <a class="right carousel-control" href="#carousel-example-captions" role="button" data-slide="next">
			        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			        <span class="sr-only">Next</span>
			      </a>
				</div>
			</div>
			
			<div>
				<div class="col-lg-12">
		            <h1 class="page-header">
		                	文章
		            </h1>
		        </div>
		        
		        <?php if(is_array($bdlsnog)): $i = 0; $__LIST__ = $bdlsnog;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-md-12">
		            <div class="panel panel-default">
		                <div class="panel-heading">
		                    <h4 class='pull-left'><?php echo ($vo['bdnm']); ?></h4>
		                    <a class='tag pull-right' href="__APP__/Atc/query/bdid/<?php echo ($vo['bdid']); ?>" style='margin:10px 0px;color:#aaa'>更多</a>
		                    <div class='clearfix'></div>
		                </div>
		                <div class="panel-body" style='height:300px'>
		                    <ul class="list-unstyled">
							<?php if(is_array($vo['atcls'])): $i = 0; $__LIST__ = $vo['atcls'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voII): $mod = ($i % 2 );++$i;?><li><span><a href="__APP__/Atc/view/atcid/<?php echo ($voII['atcid']); ?>" class='pull-left' style="color:#000; <?php echo ($voII['atcstyle']); ?>"><i class="<?php echo ($voII['atcflag']); ?>"></i> <?php echo ($voII['atctpcsrk']); ?></a></span><span class='tag pull-right' style='color:#ccc'><?php echo ($voII['atcmdftm']); ?></span></li>
							<li class='clearfix' style='border-bottom:1px dashed #eee;margin:20px 0px;'></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
		                </div>
		            </div>
		        </div><?php endforeach; endif; else: echo "" ;endif; ?> 
	         
	        </div>
        	
          
        </div>
        
        <div class='col-md-4'>
        	<div class="col-md-12">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h4 class='pull-left'><i class='glyphicon glyphicon-volume-up'></i> 通知公告</h4>
	                    <a class='pull-right' href="__APP__/Atc/query/atcanc/1" style='margin:10px 0px;color:#aaa'>更多</a>
		                <div class='clearfix'></div>
	                </div>
	                <div class="panel-body">
	                    <ul class="list-unstyled">
						<?php if(is_array($atclsanc)): $i = 0; $__LIST__ = $atclsanc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span><a href="__APP__/Atc/view/atcid/<?php echo ($vo['atcid']); ?>" class='pull-left' style="color:#000; <?php echo ($vo['atcstyle']); ?>"><i class="<?php echo ($vo['atcflag']); ?>"></i> <?php echo ($vo['atctpc']); ?></a></span><span class='tag pull-right' style='color:#ccc'><?php echo ($vo['atcmdftm']); ?></span></li>
						<li class='clearfix' style='border-bottom:1px dashed #eee;margin:20px 0px;'></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
	                </div>
	            </div>
	        </div>
	        <div class="col-md-12">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h4 class='pull-left'><i class='glyphicon glyphicon-align-left'></i> 动态</h4>
	                    <a class='pull-right' href="__APP__/Atc/query/atcdnmc/1" style='margin:10px 0px;color:#aaa'>更多</a>
		                <div class='clearfix'></div>
	                </div>
	                <div class="panel-body">
	                    <ul class="list-unstyled">
						<?php if(is_array($atclsdnmc)): $i = 0; $__LIST__ = $atclsdnmc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><span><a href="__APP__/Atc/view/atcid/<?php echo ($vo['atcid']); ?>" class='pull-left' style="color:#000; <?php echo ($vo['atcstyle']); ?>"><i class="<?php echo ($vo['atcflag']); ?>"></i> <?php echo ($vo['atctpc']); ?></a></span><span class='tag pull-right' style='color:#ccc'><?php echo ($vo['atcmdftm']); ?></span></li>
						<li class='clearfix' style='border-bottom:1px dashed #eee;margin:20px 0px;'></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
	                </div>
	            </div>
	        </div>
	       
	       <!-- 自留地 -->
			<div id='zld' class='col-md-12'>
	        <div  id='QR'>
	            <h1 class='page-header' style='font-size:20px;'>
	                	扫描二维码查看手机版
	            </h1>
	            
	            <div><img src='<?php echo ($qr); ?>' /></div>
	            
		        
	        </div>
	        </div>
	       <script type="text/javascript">$("#QR").smartFloatQR();</script>
	        
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
    top: $('#slg').height()+$('header').height(),//数字自定义
    bottom: function () {
		$('#myAffix').css('top','0');//自定义
      return (this.bottom = $('.footer').outerHeight(true))
    }
  }
})
/*
var pos=$('#sideAffix').offset().top;
$('#sideAffix').affix({
  offset: {
    top: pos+$('#sideAffix').height(),//数字自定义//起始
   	bottom: function () {
		$('#sideAffix').css('top',$('header').height());//自定义
		
	    return (this.bottom = $('footer').outerHeight(true)+300)//终止，比如 this.bottom='600' $('footer').outerHeight(true)
    }

  }
})
*/
</script>

<!-- share -->
<div id='bds'></div>
<script>
/*$('#zld').height(500);//测出来的--!
$('#bds').parent().append("<style>.bs-docs-sidebar.affix {position: fixed;top:"+$('header').height()+"px;}</style>");//重写样式//日后维持的高度
*/
</script>
<script>/*
$('#sideAffix').width($('#sideAffix').width());
$('#sideAffix').css('background-color','#fff');
$('#sideAffix').affix({
  offset: {
    top: $('#sideAffix').offset().top+$('#sideAffix').height(),//数字自定义
    bottom: function () {
    	$('#sideAffix').css('top',$('header').height());//自定义//最后一个减多少是个补差，具体是一次次实验出来的--!//一开始下来时的高度
        return (this.bottom = $('footer').outerHeight(true)+300 )//哪儿松开算哪儿了//如果还有内容可以早点松，具体怎么松要计算下下面的高度
    }
  }
})*/
</script>

</body>
</html>