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

</head>
<script type="text/javascript" src="JS/jquery.js"></script>
<body style='padding-top:30px'>
<style>
.stdtb table{
	BORDER-BOTTOM: #000000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000000 1px solid; BACKGROUND-COLOR: #fff; WIDTH: 810px; COLOR: #000; FONT-SIZE: 14px; BORDER-TOP: #000000 1px solid; BORDER-RIGHT: #000000 1px solid
}
.stdtb td {
	BORDER-BOTTOM: #000000 1px solid; BORDER-LEFT: #000000 1px solid; HEIGHT: 30px; BORDER-TOP: #000000 1px solid; BORDER-RIGHT: #000000 1px solid
}

</style>

<div class="stdtb"  align=center>
专业信息
<table>
<tr>
<td>报名号：</td><td><?php echo ($mo['stdaplno']); ?></td>
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

<div class="stdtb"  align=center>
基本信息
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
<style>
#tabDayin td{
	
	border:1px #000000 solid;
	height:30px;
	
}

#tabDayin input{
	width:80%;
	height:60%;
}
</style>
<div align=center>
报名步骤及签名
<div id="tabDayin">
<table  cellspacing="0" cellpadding="0"  bgcolor="#ffffff">
<tr><td  width="80%" style="text-align:left">第一步：考生报名，现场、网上咨询<br/><br/></td><td width="20%" style="text-align:left"><br/>接待人签名: <br/><br/> <a style="float:right">月&nbsp;&nbsp;&nbsp; 日</a></td></tr>
<tr><td style="text-align:left">第二步：验证身份证、毕业证复印件及照片<br/><br/></td><td style="text-align:left"><br/>审核人签名:<br/> <br/><a style="float:right">月&nbsp;&nbsp;&nbsp; 日</a></td></tr>
<tr><td style="text-align:left">第三步：查看预付款,报送审核通过的学生名单及照片一张<br/><br/></td><td  style="text-align:left"><br/>审核人签名: <br/><br/><a style="float:right">月&nbsp;&nbsp;&nbsp; 日</a></td></tr>
<tr><td style="text-align:left"><br/>第四步：给通过审核的学生寄发入学通知书、入学须知和缴费通知单<br/><br/></td><td  style="text-align:left"><br/>发放人签名: <br/><br/><a style="float:right">月&nbsp;&nbsp;&nbsp; 日</a></td></tr>
<tr><td style="text-align:left">第五步：回访记录（每次回访的内容简要记录）<br/>
第一次回访记录：
<br/><br/><br/><br/>
第二次回访记录：
<br/><br/><br/><br/>
第三次回访记录
<br/><br/><br/><br/>
</td>
<td  style="text-align:left">
第一次回访人员签名: 
<br/><br/><a style="float:right">月&nbsp;&nbsp;&nbsp; 日</a>
<br/><br/>第二次回访人员签名: 
<br/><br/><a style="float:right">月&nbsp;&nbsp;&nbsp; 日</a>
<br/><br/>第三次回访人员签名: 
<br/><br/><a style="float:right">月&nbsp;&nbsp;&nbsp; 日</a>
<br/><br/></td>
</tr>
<tr><td style="text-align:left">第六步：学生缴费查询<br/><br/></td><td  style="text-align:left"><br/>审核人签名: <br/><br/> <a style="float:right">月&nbsp;&nbsp;&nbsp; 日</a></td></tr>

</table>
</div>
</div>


<div class='clearfix'></div>
<br>
<div align="center" style="clear:both" id='dymk'><!-- 打印模块 -->
<input type="button" id="printButton" class='btn btn-info btn-lg' value="打印" /> 
</div> 
<br>
<script type="text/javascript">
var hdlurl="__URL__/stylq/stdid/<?php echo ($mo['stdid']); ?>";
$(function(){
	
	$("#printButton").click(function(){
		$("#dymk").hide();
		window.print();
	});
});

</script>
</body>
</html>