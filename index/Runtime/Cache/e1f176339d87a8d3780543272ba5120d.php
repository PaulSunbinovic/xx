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
<script type='text/javascript' src='__PUBLIC__/JS/index/atc.js'></script>
<link rel="stylesheet" href="__PUBLIC__/CSS/index/atc.css"/>
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
	        <script type="text/javascript">var hdlclct='__URL__/clct';var hdlzn='__URL__/zan';var hdltc='__URL__/tucao'</script>
				
				<ol class="breadcrumb">
		        <li><a href="#">首页</a> </li>
		        <?php echo ($brd); ?>
		        </ol>		
				
				<div class='detail'>
					<h1><?php echo ($mo['atctpc']); ?></h1>
					<div class="intro"><?php echo ($mo['atcsmr']); ?></div>
					<div class="info">
                    
                   		 <div class="tag pull-right">
	                        <span><?php echo ($mo['atcath']); ?></span>
	                        <span><?php echo ($mo['atcmdftm']); ?></span>
	                        <span><i class="glyphicon glyphicon-eye-open"></i> <?php echo ($mo['atccnt']); ?></span>
	                    </div>
	                </div>
					<div class='clearfix'></div>
					<hr style='margin-top:0px'></hr>
					<div class='front-cover'><img src="<?php echo ($mo['atccv']); ?>"  data-src="holder.js/300x200" alt="<?php echo ($alt); ?>" class='img-rounded'/></div>
					
					
					<link rel="stylesheet" href="__PUBLIC__/pblc/baguettebox/baguettebox.min.css">
					<script src="__PUBLIC__/pblc/baguettebox/baguettebox.min.js"></script>
					<div class="baguetteBoxOne gallery">
					<?php echo ($mo['atcctt']); ?>
					</div>
					<script type="text/javascript">
					baguetteBox.run('.baguetteBoxOne', {
					    animation: 'fadeIn',
					});
					</script>
					
					<!-- 自留地 -->
					<div id='zld'>
					<!-- <div class='share-group bs-docs-sidebar' id='myAffix'> -->
						<div class='share-group'>
							<div class='pull-left'>
								<div class='pull-left' style='margin-left:30px;padding-top:10px' id='schzysc'><?php echo ($schzysc); ?></div>
								<div class='pull-left <?php echo ($clctcss); ?>'  style='margin-left:5px;' id='clctdv'><a href="javascript:clct(<?php echo ($mo['atcid']); ?>)" class="share <?php echo ($heartcss); ?>" id='clcta'></a></div>
								<div class='btn btn-success btn-lg pull-left' style='margin-left:30px' onclick="zn(<?php echo ($mo['atcid']); ?>)" id='dvzn'><i class='glyphicon glyphicon-thumbs-up'></i> <a style='color:#fff' id='zn'><?php echo ($mo['atczn']); ?></a></div>
								<div  class='btn btn-warning btn-lg pull-left' style='margin-left:30px'  onclick="tc(<?php echo ($mo['atcid']); ?>)" id='dvtc'><i class='glyphicon glyphicon-thumbs-down'></i> <a style='color:#fff' id='tc'><?php echo ($mo['atctc']); ?></a></div>
					        </div>
					        <div class='pull-right'>
					        	<div class='pull-left' style='margin-right:30px;padding-top:10px'>分享到：</div>
					        	<div class='pull-left'  style='margin-right:30px'><a href="http://v.t.sina.com.cn/share/share.php?title=<?php echo ($mo['atctpc']); ?>&amp;url=<?php echo ($url); ?>" class="share share-weibo" target="_blank"></a></div>
					        	<div class='pull-left'  style='margin-right:30px'><a href="#" class="share share-wechat" target="_blank" id='ppov' data-container="body" data-toggle="popover" data-placement="top" data-content="<img src='<?php echo ($qr); ?>' />"></a></div>
					        </div>
					       
					        <div class='clearfix'></div>
					    </div>
				   </div>
				   <script type="text/javascript">$(".share-group").width($('#zld').width());$(".share-group").smartFloatSR();</script>
				</div>
				<div class='clearfix'></div>
				<div class='section detail'>
					<script>var hdlcstmcmt='__URL__/comment';</script>
					<div class='section'>
						<textarea style='resize: none' class='form-control' placeholder="不能超过200个字符" id='cstmcmtctt'></textarea>
					</div>
					<div class='section'>
						<a href="javascript:cstmcmt(<?php echo ($mo['atcid']); ?>)" class='btn btn-primary pull-right'>提交评论</a>
					</div>
					<div class='clearfix'></div>
					<div class='section'><script>var cstmcmtcnt=<?php echo ($cstmcmtcnt); ?>;var hdlcstmcmtzn='__URL__/commentzan';var hdlcstmcmttc='__URL__/commenttucao'</script>
						<div class="page-header">
		                	<a href='#' class='btn btn-primary' id='vwcstmcmt'><i class='glyphicon glyphicon-comment'></i> <?php echo ($cstmcmtcnt); ?></a>
		            	</div>
					</div>
					<div class='section  info' id='cstmcmtarea'>
						<?php if(is_array($cstmcmtls)): $i = 0; $__LIST__ = $cstmcmtls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="page-header">
			                	<div><div class='pull-left mglft'><div><img src="<?php echo ($vo['cstmusrpt']); ?>" class='img-circle' style='width:40px;' /></div><div class='tag'><span><?php echo ($vo['cstmusrnn']); ?></span></div></div><div class='pull-left mglft' ><?php echo ($vo['cstmcmtctt']); ?></div></div>
			                	<div class='clearfix'></div>
			                	<div class='pull-right tag'><span onclick="cstmcmtzn(<?php echo ($vo['cstmcmtid']); ?>)" style='cursor:pointer' id="cstmcmtzn<?php echo ($vo['cstmcmtid']); ?>"><i class='glyphicon glyphicon-thumbs-up'></i><?php echo ($vo['cstmcmtzn']); ?></span><span onclick="cstmcmttc(<?php echo ($vo['cstmcmtid']); ?>)" style='cursor:pointer' id="cstmcmttc<?php echo ($vo['cstmcmtid']); ?>"><i class='glyphicon glyphicon-thumbs-down' ></i><?php echo ($vo['cstmcmttc']); ?></span><span><?php echo ($vo['cstmcmttm']); ?></span></div>
			            		<div class='clearfix'></div>
			            	</div><?php endforeach; endif; else: echo "" ;endif; ?>
		    		</div>
					
					 <!-- 下拉加载评论模块 -->
	                 <script>var hdlpldnld="__URL__/append/atcid/<?php echo ($mo['atcid']); ?>";</script>
					<!-- AUTOCOMPLETE 保证了刷新后，原来的数据不会留下，那么query来的数据就不会被清洗，而js中的executing保证了不会在各种情况下不会触发js中的if -->
					<input type='hidden' id='executing' value='<?php echo ($executing); ?>' AUTOCOMPLETE="off" />
					<input type='hidden' id='hsnxt' value='<?php echo ($hsnxt); ?>' AUTOCOMPLETE="off" />
					<input type='hidden' id='pg' value='<?php echo ($pg); ?>' AUTOCOMPLETE="off" />
					<script src="__PUBLIC__/JS/index/pldnld.js"></script>
					<div class='clearfix'></div>
					<div id='loading'><img src="__PUBLIC__/IMG/loading.gif" /></div>
				</div>
        	
        	<div class='clearfix'></div>
          	
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
<!-- popover -->
<script>
$(function(){
	$('#ppov').mouseenter(function(){
		$('#ppov').popover('show');
	})
	$('#ppov').mouseleave(function(){
		$('#ppov').popover('hide');
	})
})
</script>


<!-- share -->
<div id='bds'></div>
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