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
<link rel="stylesheet" href="__PUBLIC__/CSS/admin/atc.css"/>
<script type='text/javascript'>
url_path='__URL__';
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
				
				<script type="text/javascript">var hdlclct='__URL__/clct';var hdlzn='__URL__/zan';var hdltc='__URL__/tucao'</script>
				
				<ol class="breadcrumb">
		        <li><a href="#">首页</a> </li>
		        <?php echo ($tree); ?>
		        </ol>		
				<!-- 
				<table class='tb'>
				<tr><td>标题：</td><td><?php echo ($mo['atctpc']); ?></td></tr>
				<tr><td>作者：</td><td><?php echo ($mo['atcath']); ?></td></tr>
				<tr><td>添加时间：</td><td><?php echo ($mo['atcaddtm']); ?></td></tr>
				<tr><td>修改时间：</td><td><?php echo ($mo['atcmdftm']); ?></td></tr>
				<tr><td>置顶情况：</td><td><?php echo ($mo['atctp']); ?></td></tr>
				<tr style='display:none'><td>审核情况：</td><td><?php echo ($mo['atcps']); ?></td></tr>
				<tr><td>是否通知：</td><td><?php echo ($mo['atcanc']); ?></td></tr>
				<tr><td>是否动态：</td><td><?php echo ($mo['atcdnmc']); ?></td></tr>
				<tr><td>浏览计数</td><td><?php echo ($mo['atccnt']); ?></td></tr>
				<tr><td>是否内网</td><td><?php echo ($mo['atcnw']); ?></td></tr>
				<tr><td>赞</td><td><?php echo ($mo['atczn']); ?></td></tr>
				<tr><td>吐槽</td><td><?php echo ($mo['atctc']); ?></td></tr>
				<tr><td>是否查看</td><td><?php echo ($mo['atcvw']); ?></td></tr>
				</table>
				 -->
				 <?php if($aths==1){ ?>
				 <script>var hdlurl='__URL__/set';</script>
				 <form>
				<input type='hidden' name='atcid' value="<?php echo ($mo['atcid']); ?>" />
				 审核情况：
				<select name='atcps' class='form-control input-sm' style='display:inline;width:100px'>
					<option value='0'>未通过</option>
					<option value='1'>通过</option>
				</select>
				<script>$('select[name=atcps]').val("<?php echo ($mo['atcps']); ?>")</script>
				是否浏览
				<select name='atcvw' class='form-control input-sm' style='display:inline;width:100px'>
					<option value='0'>否</option>
					<option value='1'>是</option>
				</select>
				<script>$('select[name=atcvw]').val("<?php echo ($mo['atcvw']); ?>")</script>
				<input type='button' id='st' value=<?php echo ($btnvl); ?> class='btn btn-primary'/>
				</form>
				<?php } ?>
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
					<!-- 公办学校不需要评论，暂时隐藏起来
					自留地 -->
					<div id='zld'>
					
						<div class='share-group'>
							<div class='pull-left'>
								<div class='pull-left' style='margin-left:30px;padding-top:10px' id='schzysc'><?php echo ($schzysc); ?></div>
								<div class='pull-left <?php echo ($clctcss); ?>'  style='margin-left:5px;' id='clctdv'><a href="javascript:clct(<?php echo ($mo['atcid']); ?>)" class="share <?php echo ($heartcss); ?>" id='clcta'></a></div>
								<!-- 
								<div class='btn btn-success btn-lg pull-left' style='margin-left:30px' onclick="zn(<?php echo ($mo['atcid']); ?>)" id='dvzn'><i class='glyphicon glyphicon-thumbs-up'></i> <a style='color:#fff' id='zn'><?php echo ($mo['atczn']); ?></a></div>
								<div  class='btn btn-warning btn-lg pull-left' style='margin-left:30px'  onclick="tc(<?php echo ($mo['atcid']); ?>)" id='dvtc'><i class='glyphicon glyphicon-thumbs-down'></i> <a style='color:#fff' id='tc'><?php echo ($mo['atctc']); ?></a></div>
					        	 -->
					        </div>
					        <div class='pull-right'>
					        	<div class='pull-left' style='margin-right:30px;padding-top:10px'>分享到：</div>
					        	<div class='pull-left'  style='margin-right:30px'><a href="http://v.t.sina.com.cn/share/share.php?title=<?php echo ($mo['atctpc']); ?>&amp;url=<?php echo ($url); ?>" class="share share-weibo" target="_blank"></a></div>
					        	<div class='pull-left'  style='margin-right:30px'><a href="#" class="share share-wechat" target="_blank" id='ppov' data-container="body" data-toggle="popover" data-placement="top" data-content="<img src='<?php echo ($qr); ?>' />"></a></div>
					        </div>
					       
					        <div class='clearfix'></div>
					    </div>
				   </div>
				   <script type="text/javascript">$(".share-group").width($('#rgt').width()-30);$(".share-group").smartFloatSR();</script>
					
				</div>
				<div class='clearfix'></div>
				<?php if($athm==1){ ?><a href="__URL__/gtxpg/x/updt/atcid/<?php echo ($mo['atcid']); ?>" class='btn btn-primary'>前往修改信息</a><?php } ?>
				<!-- 
				<div class='section detail'>
					<script>var hdlcmt='__URL__/comment';</script>
					<div class='section'>
						<textarea style='resize: none' class='form-control' placeholder="不能超过200个字符" id='cmtctt'></textarea>
					</div>
					<div class='section'>
						<a href="javascript:cmt(<?php echo ($mo['atcid']); ?>)" class='btn btn-primary pull-right'>提交评论</a>
					</div>
					<div class='clearfix'></div>
					<div class='section'><script>var cmtcnt=<?php echo ($cmtcnt); ?>;var hdlcmtzn='__URL__/commentzan';var hdlcmttc='__URL__/commenttucao'</script>
						<div class="page-header">
		                	<a href='__APP__/Cmt/query' class='btn btn-primary' id='vwcmt'>查看所有评论（<?php echo ($cmtcnt); ?>）</a>
		            	</div>
					</div>
					<div class='section  info' id='cmtarea'>
						<?php if(is_array($cmtls)): $i = 0; $__LIST__ = $cmtls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="page-header">
			                	<div><div class='pull-left mglft'><div><img src="<?php echo ($vo['usrpt']); ?>" class='img-circle' style='width:40px;' /></div><div class='tag'><span><?php echo ($vo['usrnn']); ?></span></div></div><div class='pull-left mglft' ><?php echo ($vo['cmtctt']); ?></div></div>
			                	<div class='clearfix'></div>
			                	<div class='pull-right tag'><span onclick="cmtzn(<?php echo ($vo['cmtid']); ?>)" style='cursor:pointer' id="cmtzn<?php echo ($vo['cmtid']); ?>"><i class='glyphicon glyphicon-thumbs-up'></i><?php echo ($vo['cmtzn']); ?></span><span onclick="cmttc(<?php echo ($vo['cmtid']); ?>)" style='cursor:pointer' id="cmttc<?php echo ($vo['cmtid']); ?>"><i class='glyphicon glyphicon-thumbs-down' ></i><?php echo ($vo['cmttc']); ?></span><span><?php echo ($vo['cmttm']); ?></span></div>
			            		<div class='clearfix'></div>
			            	</div><?php endforeach; endif; else: echo "" ;endif; ?>
		    		</div>
					
					下拉加载评论模块 
	                 <script>var hdlpldnld="__URL__/append/atcid/<?php echo ($mo['atcid']); ?>";</script>
					AUTOCOMPLETE 保证了刷新后，原来的数据不会留下，那么query来的数据就不会被清洗，而js中的executing保证了不会在各种情况下不会触发js中的if
					<input type='hidden' id='executing' value='<?php echo ($executing); ?>' AUTOCOMPLETE="off" />
					<input type='hidden' id='hsnxt' value='<?php echo ($hsnxt); ?>' AUTOCOMPLETE="off" />
					<input type='hidden' id='pg' value='<?php echo ($pg); ?>' AUTOCOMPLETE="off" />
					<script src="__PUBLIC__/JS/admin/pldnld.js"></script>
					<div class='clearfix'></div>
					<div id='loading'><img src="__PUBLIC__/IMG/loading.gif" /></div>
				</div>
				-->
				
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
//$('#zld').height(150);//测出来的--!
//alert($(scroll).height());
//$('#bds').parent().append("<style>.bs-docs-sidebar.affix {position: fixed;top:"+($(window).height()-$('#myAffix').height()-40)+"px;}</style>");//重写样式//日后维持的高度
</script>
<script>
/*
$('#myAffix').width($('#rgt').width()-40);//因为有两个padding15 左右一加就是60了
$('#myAffix').css('background-color','#fff');
$('#myAffix').affix({
  offset: {
    top: 200,//数字自定义
    bottom: function () {
    	$('#myAffix').css('top',$(window).height()-$('#myAffix').height()-40);//自定义//最后一个减多少是个补差，具体是一次次实验出来的--!//一开始下来时的高度
        return (this.bottom = $(scroll).height()-$('#zld').offset().top)//哪儿松开算哪儿了
    	//注意这里被return了，那么所有之后的初始化都没的搞，特别是$(function(){alert();})//所以有初始化的就往前面放
    }
  }
})
*/
</script>


</body>
</html>