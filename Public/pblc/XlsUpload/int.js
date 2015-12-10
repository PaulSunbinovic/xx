$(function(){
	
	$("#uploadify").uploadify({
		'uploader'	: file_path+'/uploadify/uploadify.swf',//所需要的flash文件
		'cancelImg'	: file_path+'/uploadify/cancel.gif',//单个取消上传的图片
		//'script'	: '__PUBLIC__/js/uploadify/uploadify.php',//实现上传的程序
		'script'	: hdlupload,//实现上传的程序
		'method'	: 'get',
		//'folder'	: 'uploads',//服务端的上传目录
		'auto'		: true,//自动上传
		'multi'		: false,//是否多文件上传
		'fileDesc': 'Excel(*.xls;*.xlsx;*.XLS;*.XLSX)',//对话框的文件类型描述
		'fileExt': '*.xls;*.xlsx;*.XLS;*.XLSX',//可上传的文件类型
		'sizeLimit': 10100000,//限制上传文件的大小10m(比特b)
		//'simUploadLimit' :3, //并发上传数据 
		'queueSizeLimit' :5, //可上传的文件个数
		'buttonImg'	: file_path+'/uploadify/add.gif',//替换上传钮扣
		'width'		: 80,//buttonImg的大小
		'height'	: 26,
		onComplete	: function (evt, queueID, fileObj, response, data) {
			
			$('#status').html('文件处理中，请稍后...');
			$.post(
				hdlxlstosql,
				{inputExcel:response,mk:$('#mk').val()},
				function(data){
					$('#status').html('');
					if(data.status==1){
						alert('更新成功');
						window.location.reload();
					}else{
						alert('更新失败');
					}
				
				
				},
				'json'
			);
			
		}
	});
	
	
	
});