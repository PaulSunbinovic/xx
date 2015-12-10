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
url_path='__URL__';
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
		
		<div class="col-md-12" >
		
		
            <br/>
			<p style="TEXT-ALIGN: center; LINE-HEIGHT: 25px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;华文新魏&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 29px; FONT-WEIGHT: bold">中国计量学院</span><span style="FONT-FAMILY: &#39;华文新魏&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 29px; FONT-WEIGHT: bold">继续教育</span><span style="FONT-FAMILY: &#39;华文新魏&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 29px; FONT-WEIGHT: bold">学院</span>
			</p>
			<p style="TEXT-ALIGN: center; LINE-HEIGHT: 25px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;宋体&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 16px">&nbsp;</span>
			</p>
			<p style="TEXT-ALIGN: center; LINE-HEIGHT: 25px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 24px"><?php echo ($mo['xnnm']); ?></span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 24px">年<?php echo ($mo['bxxsnm']); ?>缴费通知书
			    <?php if(preg_match('/理工/',$mo['klnm'])){ ?>（理工类）<?php }else if(preg_match('/艺术/',$mo['klnm'])){ ?>（艺术类）<?php } ?>
			    </span>
			</p>
			<p style="TEXT-ALIGN: center; LINE-HEIGHT: 125%; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;宋体&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 16px">&nbsp;</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 40px; MARGIN-TOP: 0px; TEXT-INDENT: 40px; MARGIN-BOTTOM: 10px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold"><?php echo ($mo['stdnm']); ?>&nbsp;&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">同学：</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; TEXT-INDENT: 37px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">经你本人报名申请，学校初审，同意预录取你为我院<?php echo ($mo['bxxsnm']); ?>&nbsp;<a style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold"><?php echo ($mo['mjnm']); ?></a>&nbsp;专业学生，报名号</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">&nbsp;<?php echo ($mo['stdaplno']); ?>&nbsp;</span><span style="BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; TEXT-DECORATION: none">。</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; TEXT-INDENT: 37px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; TEXT-DECORATION: underline"></span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">我们的录取流程中规定。报名学生在收到</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">继续教育</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">学院的预录取及缴费通知书后，须将学费、<?php if($mo['dmid']!=3&&$mo['dmid']!=4){ ?>住宿费、<?php } ?>教材考务费及报名费等（以下统称学费）交到学校财务缴费系统。</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; TEXT-INDENT: 37px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">学校学生收费实行“银行代收、单位开票、财政代管”的方法。请认真阅读以下条例，并严格按照该条例操作。</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">一、缴费查询网址：</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">&nbsp;</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; TEXT-INDENT: 37px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">收到预录取通知后，先登录学费系统查询</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px"><?php echo ($mo['xnnm']); ?></span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">学年应缴费用，直接在网页上输入以下网址登录，用户名为报名号，密码为报名号后4位，网址：</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(0,0,255); FONT-SIZE: 19px; FONT-WEIGHT: bold">http://jcc.cjlu.edu.cn:8080/EducationManager</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">二、收费标准</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">(全额)</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;单位：元</span>
			</p>
			<table offsetval="0" uetable="null">
			    <tbody>
			        <tr style="HEIGHT: 31px">
			            <td style="BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(0,0,0) 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 7px; PADDING-RIGHT: 7px; BACKGROUND: rgb(255,255,255); BORDER-TOP: rgb(0,0,0) 1px solid; BORDER-RIGHT: rgb(0,0,0) 1px solid; PADDING-TOP: 0px" valign="center" width="280">
			                <p style="TEXT-ALIGN: center; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			                    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">年级</span>
			                </p>
			            </td>
			            <td style="BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(255,255,255) 43px; PADDING-BOTTOM: 0px; PADDING-LEFT: 7px; PADDING-RIGHT: 7px; BACKGROUND: rgb(255,255,255); BORDER-TOP: rgb(0,0,0) 1px solid; BORDER-RIGHT: rgb(0,0,0) 1px solid; PADDING-TOP: 0px" valign="center" width="107">
			                <p style="TEXT-ALIGN: center; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			                    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">学费</span>
			                </p>
			            </td>
			            <?php if($mo['dmid']!=3&&$mo['dmid']!=4){ ?>
			            <td style="BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(255,255,255) 43px; PADDING-BOTTOM: 0px; PADDING-LEFT: 7px; PADDING-RIGHT: 7px; BACKGROUND: rgb(255,255,255); BORDER-TOP: rgb(0,0,0) 1px solid; BORDER-RIGHT: rgb(0,0,0) 1px solid; PADDING-TOP: 0px" valign="center" width="152">
			                <p style="TEXT-ALIGN: center; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			                    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">住宿费</span>
			                </p>
			            </td>
			            <?php } ?>
			            <td style="BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(255,255,255) 43px; PADDING-BOTTOM: 0px; PADDING-LEFT: 7px; PADDING-RIGHT: 7px; BACKGROUND: rgb(255,255,255); BORDER-TOP: rgb(0,0,0) 1px solid; BORDER-RIGHT: rgb(0,0,0) 1px solid; PADDING-TOP: 0px" valign="center" width="144">
			                <p style="TEXT-ALIGN: center; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			                    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">教材考务费</span>
			                </p>
			            </td>
			            <td style="BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(255,255,255) 43px; PADDING-BOTTOM: 0px; PADDING-LEFT: 7px; PADDING-RIGHT: 7px; BACKGROUND: rgb(255,255,255); BORDER-TOP: rgb(0,0,0) 1px solid; BORDER-RIGHT: rgb(0,0,0) 1px solid; PADDING-TOP: 0px" valign="center" width="114">
			                <p style="TEXT-ALIGN: center; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			                    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">报名费</span>
			                </p>
			            </td>
			        </tr>
			        <tr style="HEIGHT: 51px">
			            <td style="BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(0,0,0) 1px solid; PADDING-BOTTOM: 0px; PADDING-LEFT: 7px; PADDING-RIGHT: 7px; BACKGROUND: rgb(255,255,255); BORDER-TOP: medium none; BORDER-RIGHT: rgb(0,0,0) 1px solid; PADDING-TOP: 0px" valign="center" width="285">
			                <p style="TEXT-ALIGN: center; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			                    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px"><?php echo ($mo['xnnm']); ?></span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">级</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px"><?php echo ($mo['bxxsnm']); ?></span>
			                </p>
			            </td>
			            <td style="BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(255,255,255) 43px; PADDING-BOTTOM: 0px; PADDING-LEFT: 7px; PADDING-RIGHT: 7px; BACKGROUND: rgb(255,255,255); BORDER-TOP: medium none; BORDER-RIGHT: rgb(0,0,0) 1px solid; PADDING-TOP: 0px" valign="center" width="107">
			                <p style="TEXT-ALIGN: center; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			                    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px"><?php echo ($xfo['xfsm']); ?></span>
			                </p>
			            </td>
			            <?php if($mo['dmid']!=3&&$mo['dmid']!=4){ ?>
			            <td style="BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(255,255,255) 43px; PADDING-BOTTOM: 0px; PADDING-LEFT: 7px; PADDING-RIGHT: 7px; BACKGROUND: rgb(255,255,255); BORDER-TOP: medium none; BORDER-RIGHT: rgb(0,0,0) 1px solid; PADDING-TOP: 0px" valign="center" width="152">
			                <p style="TEXT-ALIGN: center; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			                    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px"><?php echo ($zsfo['zsfsm']); ?></span>
			                </p>
			                
			            </td>
			            <?php } ?>
			            <td style="BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(255,255,255) 43px; PADDING-BOTTOM: 0px; PADDING-LEFT: 7px; PADDING-RIGHT: 7px; BACKGROUND: rgb(255,255,255); BORDER-TOP: medium none; BORDER-RIGHT: rgb(0,0,0) 1px solid; PADDING-TOP: 0px" valign="center" width="144">
			                <p style="TEXT-ALIGN: center; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			                    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px"><?php echo ($xfo['jckwfsm']); ?></span>
			                </p>
			            </td>
			            <td style="BORDER-BOTTOM: rgb(0,0,0) 1px solid; BORDER-LEFT: rgb(255,255,255) 43px; PADDING-BOTTOM: 0px; PADDING-LEFT: 7px; PADDING-RIGHT: 7px; BACKGROUND: rgb(255,255,255); BORDER-TOP: medium none; BORDER-RIGHT: rgb(0,0,0) 1px solid; PADDING-TOP: 0px" valign="center" width="114">
			                <p style="TEXT-ALIGN: center; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			                    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">100</span>
			                </p>
			            </td>
			        </tr>
			    </tbody>
			</table>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; TEXT-INDENT: 28px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">注意：</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">由于已预缴学费</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">款1</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">0</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">00元</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">，</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">学生</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">只</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">需再补缴学费<?php echo ($xfo['xfsm']-1000); ?>元，<?php if($mo['dmid']!=3&&$mo['dmid']!=4){ ?>住宿费<?php echo ($zsfo['zsfsm']); ?>元，<?php } ?>教材考务费<?php echo ($xfo['jckwfsm']); ?>元</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">。</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">三、交费方式：&nbsp;&nbsp;&nbsp;&nbsp;</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; TEXT-INDENT: 37px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">银行柜台缴学费。学生可到在浙江省内任何工商银行网点缴费，填写“中国工商银行浙江省分行现金收费凭条”，参照下表，“收费单位”必须注明学校代码12020707，否则缴不进学费。</span>
			</p>
			<p style="TEXT-ALIGN: left; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <img  title="缴费.png" src="__PUBLIC__/IMG/yinhangjiaofeidan.png" />
			</p>
			<p style="TEXT-ALIGN: left; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">四、缴费时间</span>
			</p>
			<?php $time = $mo['stdaddtm']; $nyr= date('Y 年 m 月 d 日', strtotime($time)); $zssz=M('zssz');$zsszo=$zssz->find(); $jztm = $zsszo['zsszjztm']; $jztm= date(' m 月 d 日', strtotime($jztm)); ?>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 33px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;&nbsp; </span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px"><?php echo $nyr ?>--<?php echo $jztm ?></span>
			</p>
			
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">五、注意事项</span>
			</p>
			<!-- 
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255); MARGIN-LEFT: 28px">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">1．因自考助学班报名人数已超过校内住宿额定招生人数，为了满足考生的求学愿望，我们在校外学生公寓安排了自考生的宿舍（有免费校车接送）。</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">学校将按考生学费全额缴费时间先后安排校内学生住宿（额满为止），后缴费考生安排住校外学生公寓</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">。</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255); MARGIN-LEFT: 28px">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">2．学生交费后，当场核对交费回单（学号、姓名、金额）正确</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">与否并</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">妥善保管</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">，凭回单、入学通知书等到中国计量学院</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">继续教</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">育</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">学院报到入学。</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255); MARGIN-LEFT: 28px">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">3．如考生还未提供</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">身份证复印件和一寸正面免冠照片2张</span>，<span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">请尽快寄往学校继续教育学院，以方便学校提前给考生制作<span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">“校园一卡通”</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">。</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255); MARGIN-LEFT: 28px">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">4．若对如何交费尚有疑问，可电话咨询</span>
			</p>
			
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">0571-87676122（计财处），</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">0571-86835789（</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">继续教育</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">学院），&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">0571-&nbsp;89961266</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">0571-</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">89961303（银行）。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			</p>
			 -->
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255); MARGIN-LEFT: 28px">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">1．学生缴费后，当场核对交费回单（学号、姓名、金额）正确</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">与否并</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px; FONT-WEIGHT: bold">妥善保管</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">，凭回单、入学通知书等到中国计量学院</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">继续教</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">育</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">学院报到入学。</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255); MARGIN-LEFT: 28px">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">2．若对通知书内容有不解之处，可致电0571-86835789咨询，也可登陆学院官网http://cjxy.cjlu.edu.cn进入招生平台，阅读招生简章，查看录取状态。</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255); MARGIN-LEFT: 28px">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">3．若对如何交费尚有疑问，可电话咨询</span>
			</p>
			
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">0571-87676122（计财处），</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">0571-86835789（</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">继续教育</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">学院），&nbsp;</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 31px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">0571-89961266</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">0571-</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">89961303（银行）。&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 33px; MARGIN-TOP: 0px; TEXT-INDENT: 19px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;</span><span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 33px; MARGIN-TOP: 0px; TEXT-INDENT: 187px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;</span>
			</p>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 33px; MARGIN-TOP: 0px; TEXT-INDENT: 187px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)">
			    <span style="FONT-FAMILY: &#39;仿宋_GB2312&#39;; BACKGROUND: rgb(255,255,255); COLOR: rgb(68,68,68); FONT-SIZE: 19px">&nbsp;</span>
			</p><br /><p style="TEXT-ALIGN: left; LINE-HEIGHT: 33px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)"> 
			    <span style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; font-family: '宋体'; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; color: rgb(68, 68, 68); font-size: 19px; clear:both; float:right;margin-right:40px">中国计量学院继续教育学院</span> 
			</p>
			<?php $jt=date("Y 年 m 月 d 日",time()); ?>
			<p style="TEXT-ALIGN: left; LINE-HEIGHT: 33px; MARGIN-TOP: 0px; MARGIN-BOTTOM: 0px; BACKGROUND: rgb(255,255,255)"> 
			    <span style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; font-family: '宋体'; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; color: rgb(68, 68, 68); font-size: 19px; clear:both; float:right;margin-right:40px"><?php echo $jt ?></span> 
			</p>
			
			<p>
			    &nbsp;
			</p>




			<div align="center" style="clear:both"> 
        </div>
       
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