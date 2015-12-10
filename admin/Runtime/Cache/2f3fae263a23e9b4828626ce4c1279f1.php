<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
<script type='text/javascript' src='__PUBLIC__/JS/jquery.js'></script>
<script type='text/javascript' src='__PUBLIC__/JS/cm.js'></script>
<link rel="stylesheet" href="__PUBLIC__/CSS/cm.css"/>

<script type='text/javascript' src='__PUBLIC__/JS/admin/u.js'></script>
<script type='text/javascript'>
var app_path='__APP__';
var hdlurl='__URL__/regist';
</script>
</head>


<body>

<div id='divhd'>
<!-- head包u.js -->
<script type="text/javascript" src='__PUBLIC__/JS/admin/uhd.js'></script>
<script type="text/javascript">
var hdllgin='__APP__/U/loginin';
var hdllgot='__APP__/U/loginout';
var app_path='__APP__';
</script>

<?php if(session('uidss')){ ?>
<a href='__APP__'>回到后台首页</a>&nbsp;&nbsp;<?php echo ($uoss['unm']); ?>，你好，欢迎回来。<a href='__APP__/U/gtxpg/x/center' id='u_center'>个人中心</a>&nbsp;&nbsp;<a href='#' id='u_loginout'>注销</a>
<?php }else{ ?>
<form>
用户名：<input type='text' name='unm' id='unmhd'/>
密     码：<input type='password' name='upw' id='upwhd'/>
<input type='button' id='u_loginin' value='登录'/>
<a href='__APP__/U/gtxpg/x/regist'>新用户注册</a>
</form>
<?php } ?>
</div>
<script type="text/javascript">$("#divhd").smartFloat();</script>
<div id='divbd'>
<p><?php echo ($theme); ?></p>
<form>
<input type='hidden' name='uid' value="<?php echo ($m['uid']); ?>" />
<table>
<tr><td>用户名：</td><td><input type='text' name='unm' value="<?php echo ($m['unm']); ?>" id='unm'/></td></tr>
<tr><td>密码：</td><td><input type='password' name='upw' value="<?php echo ($m['upw']); ?>" id='upw'/></td></tr>
<tr><td>再输入一次密码：</td><td><input type='password' name='upwag' value="<?php echo ($m['upw']); ?>" id='upwag'/></td></tr>
<tr><td>用户头像：</td><td>

<!-- file start -->
 <link rel="stylesheet" href="__PUBLIC__/pblc/FileUpload/uploadify/uploadify.css">
 <script type="text/javascript" src='__PUBLIC__/pblc/FileUpload/uploadify/uploadify.js'></script>
 <link rel="stylesheet" type="text/css"  href="__PUBLIC__/pblc/FileUpload/uploadify/uploadify.css" />
<script type="text/javascript" src="__PUBLIC__/pblc/FileUpload/uploadify/swfobject.js"></script>
<script type="text/javascript">
var file_path='__PUBLIC__/pblc/FileUpload';
var hdlupload='__APP__/FileUpload/upload';
var upload_path='__ROOT__/Uploads';
</script>
<script type="text/javascript" src='__PUBLIC__/pblc/FileUpload/int.js'></script>
<div id="imgg">
<img src="<?php echo ($m['upt']); ?>" alt="" style="width:100px" />
</div>
<div style="width:80px; height:26px; overflow:hidden;"><input type="file"  name="photo1" id="uploadify"/></div>
<!-- 隐藏系统所需的用户upt -->
<input type='hidden' name='upt' value="<?php echo ($m['upt']); ?>"/>
<!-- file over -->
    
    
</td></tr>

</table>
<input type='hidden' name='f_athid' value="<?php echo ($m['upt']); ?>" />
<input type='button' id='u_regist' value=<?php echo ($btnvl); ?> />
</form>
</div>
<div id='divft'>@copyright:sunbinovic@163.com</div>

<script  type="text/javascript" src="__PUBLIC__/pblc/gotop/gotop.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/gotop/gotop.css" media="all"/>
</body>
</html>