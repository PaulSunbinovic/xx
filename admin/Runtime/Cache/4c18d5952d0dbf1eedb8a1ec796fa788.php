<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
</head>
<script type='text/javascript' src='__PUBLIC__/JS/jquery.js'></script>
<script type='text/javascript' src='__PUBLIC__/JS/admin/u.js'></script>
<script type='text/javascript'>
var hdlgin='__APP__/U/loginin';
var app_path='__APP__';
var url_path='__URL__';
</script> 
<body>
<p><?php echo ($theme); ?></p>
<p id='errIfmt'></p>
<form>
<table>
<tr><td>用户名：</td><td><input type='text' name='unm'/></td></tr>
<tr><td>密     码：</td><td><input type='password' name='upw'/></td></tr>
</table>
<input type='button' id='u_logininIdx' value='登录'/>
<a href='__APP__/U/gtxpg/uwt/regist'>新用户注册</a>
</form>

</body>
</html>