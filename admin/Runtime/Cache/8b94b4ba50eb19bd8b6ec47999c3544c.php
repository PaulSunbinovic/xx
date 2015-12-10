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
<div  id='divbd'>
<p><?php echo ($theme); ?></p>

<!-- NB 开始 -->
	<script type="text/javascript">var hdlNB='__URL__/query'</script>
	<?php  if($uoss['f_u_athid']==1){ ?>
	<div id='NBsrcMpart'>
		<form>
		SELECT * FROM tb_u LEFT JOIN tb_ath ON f_u_athid=athid WHERE unm LIKE '%sb%' AND f_u_athid=1 ORDER BY uaddtm DESC LIMIT 0,10
		<br/>SELECT * FROM tb_u LEFT JOIN tb_ath ON f_u_athid=athid WHERE f_u_athid<>1 ORDER BY uaddtm DESC LIMIT 0,10
			<input id='NBsqlstc' name='NBsqlstc' style='width:1000px' value="<?php echo ($sqlstc); ?>"/>
			<br/><input type='button' id='NBsrcM' value='管理员查询'/>
		</form>
	</div>
	<?php } ?>
	
	<div id='NBsrcUpart'>
		<div id='flddv'>
			字段：<!-- uid必须有且不用看见 -->
			<input type="checkbox" id='uidfld' value='uid' style='display:none' checked=checked/>
			<input type="checkbox" id='unmfld' value='unm'/>用户名&nbsp;&nbsp;
			<input type="checkbox" id='athnmfld' value='athnm'/>权限名称&nbsp;&nbsp;
			<input type="checkbox" id='uaddtmfld' value='uaddtm'/>用户添加时间&nbsp;&nbsp;
			<input type="checkbox" id='umdftmfld' value='umdftm'/>用户修改时间&nbsp;&nbsp;
		</div>
		<div id='cdtdv'>
			条件：
			用户名<input type="text" name='unm' id='unmcdt'/>&nbsp;&nbsp;
			权限名称
			<select name='f_u_athid' id='f_u_athidcdt'>
			<option value=''>无</option>
			<?php if(is_array($athls)): $i = 0; $__LIST__ = $athls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol['athid']); ?>"><?php echo ($vol['athnm']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
			&nbsp;&nbsp;
			<script language="javascript" type="text/javascript" src="__PUBLIC__/pblc/DatePicker/My97DatePicker/WdatePicker.js"></script>
			用户添加时间<input type="text" name='uaddtm' id='uaddtmcdt' onclick="WdatePicker()"/>&nbsp;&nbsp;
			用户修改时间<input type="text" name='umdftm' id='umdftmcdt' onclick="WdatePicker()"/>&nbsp;&nbsp;
			
		</div>
		<div id='spccdtdv'>
		特殊条件：
		<a class='spccdtoff' href='#' rel='(uaddtm<NOW())'>添加日期小于当前时间</a>
		</div>
		<div id='odrdv'>
			顺序：
			<select>
			<option value=''>无</option>
			<option value='uaddtm DESC'>用户添加时间降序</option>
			<option value='uaddtm ASC'>用户添加时间升序</option>
			<option value='umdftm DESC'>用户修改时间降序</option>
			<option value='umdftm ASC'>用户修改时间升序</option>
			</select>
			<select>
			<option value=''>无</option>
			<option value='uaddtm DESC'>用户添加时间降序</option>
			<option value='uaddtm ASC'>用户添加时间升序</option>
			<option value='umdftm DESC'>用户修改时间降序</option>
			<option value='umdftm ASC'>用户修改时间升序</option>
			</select>
			<select>
			<option value=''>无</option>
			<option value='uaddtm DESC'>用户添加时间降序</option>
			<option value='uaddtm ASC'>用户添加时间升序</option>
			<option value='umdftm DESC'>用户修改时间降序</option>
			<option value='umdftm ASC'>用户修改时间升序</option>
			</select>
		</div>
		<div>
			<form>
			<input type='hidden' name='fld' id='fld' value='<?php echo ($fld); ?>'/>
			<input type='hidden' name='cdt' value='<?php echo ($cdt); ?>'/>
			<input type='hidden' name='spccdt' value='<?php echo ($spccdt); ?>'/>
			<input type='hidden' name='odr' value='<?php echo ($odr); ?>'/>
			<!-- 每页：<input type='text' name='lmt' value='<?php echo ($lmt); ?>'/>  -->
			每页：<select id='lmt' name='lmt'>
				<option value='10'>10</option><option value='20'>20</option><option value='30'>30</option><option value='40'>40</option><option value='50'>50</option>
				</select>
				<script>$('#lmt').val('<?php echo ($lmt); ?>')</script>
			<input type='button' value='查询' id='NBsrcU'/>
			</form>
		</div>
	</div>

<!-- NB 结束-->

<!-- 注意NB 的class 都要设置  开始-->
<script type="text/javascript">var hdldlt='__URL__/delete'</script>
<div>
	<table id='NBtb'>
	<thead>
	  <tr>
	    <th class='odr'>序号</th>
	    <th class='unm'>用户名</th>
	    <th class='athnm'>用户权限</th>
	    <th class='uaddtm'>用户创建时间</th>
	    <th class='umdftm'>用户修改时间</th>
	    <th class='oprt'>操作</th>
	  </tr>
	</thead>
	
	<tbody>
	  <?php if(is_array($mls)): $i = 0; $__LIST__ = $mls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
	    <td class='odr'><?php echo ($fstrw+$i); ?></td>
	    <td class='unm'><?php echo ($vo['unm']); ?></td>
	    <td class='athnm'><?php echo ($vo['athnm']); ?></td>
	    <td class='uaddtm'><?php echo ($vo['uaddtm']); ?></td>
	    <td class='umdftm'><?php echo ($vo['umdftm']); ?></td>
	    <td class='oprt'>
	      <!-- Icons -->
	      <?php if($v=='y'){ ?><a href="__URL__/gtxpg/x/vw/uid/<?php echo ($vo['uid']); ?>">查看</a><?php } ?>
	      <?php if($u=='y'){ ?><a href="__URL__/gtxpg/x/updt/uid/<?php echo ($vo['uid']); ?>">修改</a><?php } ?> 
	      <?php if($d=='y'){ ?><a href="javascript:dlt(<?php echo ($vo['uid']); ?>)">删除</a><?php } ?>
	    </td>
	  </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
	</tbody>
	</table>
<script type="text/javascript">$("#NBtb thead").smartFloatTB();</script>
<!-- 注意NB 的class 都要设置  结束-->
<?php echo ($page_method); ?>&nbsp;&nbsp;

<?php if($u=='y'){ ?><p><a href="__URL__/gtxpg/x/updt/uid/0">添加</a></p><?php } ?>

<!--EXCEL开始-->
<script type="text/javascript" src='__PUBLIC__/pblc/XLS/xls.js'></script>
<form action='__APP__/Xls/output' method='post'>
<input type='hidden' name='mk' value='u'/>
<input type='hidden' name='fld' id='fld' value='<?php echo ($fld); ?>'/>
<input type='hidden' name='cdt' value='<?php echo ($cdt); ?>'/>
<input type='hidden' name='spccdt' value='<?php echo ($spccdt); ?>'/>
<input type='hidden' name='odr' value='<?php echo ($odr); ?>'/>
<input type='hidden' name='NBsqlstc' value="<?php echo ($sqlstc); ?>"/>
请命名表的名称<input type='text' name='xlsnm' value='XX表'/>
<br/><input type='button' id='export' value='导出数据'  /><input type='submit' id='exporttrue' style='display:none' value='导出数据' />
</form>

<?php if($u=='y'){ ?>
<!-- xls file start -->
<a href='__ROOT__/XFile/u.xls'>模版</a><input type='hidden' id='mk' value='u'/>
 <link rel="stylesheet" href="__PUBLIC__/pblc/XlsUpload/uploadify/uploadify.css"/>
 <script type="text/javascript" src='__PUBLIC__/pblc/XlsUpload/uploadify/uploadify.js'></script>
 <link rel="stylesheet" type="text/css"  href="__PUBLIC__/pblc/XlsUpload/uploadify/uploadify.css" />
<script type="text/javascript" src="__PUBLIC__/pblc/XlsUpload/uploadify/swfobject.js"></script>
<script type="text/javascript">
var file_path='__PUBLIC__/pblc/XlsUpload';
var hdlupload='__APP__/XlsUpload/upload';
var upload_path='__ROOT__/XlsUploads';
var hdlxlstosql='__APP__/Xls/import'
</script>
<script type="text/javascript" src='__PUBLIC__/pblc/XlsUpload/int.js'></script>
<div id="status"></div>
<div style="width:80px; height:26px; overflow:hidden; " id='cf'><input  type="file"  name="xls1" id="uploadify"/></div>
<!-- xls file over -->
<?php } ?>
<!--EXCEL结束-->

<!-- NBjs 初始化 -->
<script type="text/javascript">
var fld="<?php echo ($fld); ?>";var cdt="<?php echo ($cdt); ?>";var spccdt="<?php echo ($spccdt); ?>";var odr="<?php echo ($odr); ?>";
</script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/NB/NBSearch.css" media="all"/>
<script type='text/javascript' src='__PUBLIC__/pblc/NB/NBSearch.js'></script>

<!-- NBjs 结束 -->


</div>
</div>
<div id='divft'>@copyright:sunbinovic@163.com</div>

<script  type="text/javascript" src="__PUBLIC__/pblc/gotop/gotop.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/pblc/gotop/gotop.css" media="all"/>
</body>
</html>