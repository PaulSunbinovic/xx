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
		'fileDesc': 'Image(*.jpg;*.gif;*.png;*.bmp;*.jpeg;*.JPG;*.GIF;*.PNG;*.BMP;*.JPEG)',//对话框的文件类型描述
		'fileExt': '*.jpg;*.gif;*.png;*.bmp;*.jpeg;*.JPG;*.GIF;*.PNG;*.BMP;*.JPEG',//可上传的文件类型
		'sizeLimit': 2100000,//限制上传文件的大小2m(比特b)
		//'simUploadLimit' :3, //并发上传数据 
		'queueSizeLimit' :5, //可上传的文件个数
		'buttonImg'	: file_path+'/uploadify/add.gif',//替换上传钮扣
		'width'		: 80,//buttonImg的大小
		'height'	: 26,
		onComplete	: function (evt, queueID, fileObj, response, data) {
			//alert(response);
			getResult(response);//获得上传的文件路径
		}
	});
	
	var imgg = $("#imgg");
	
	function getResult(content){
			
		imgg.attr('src',upload_path+'/'+content);
		//隐藏系统所需的用户upt
		$('#pt').val(upload_path+'/'+content);
		
	}
	
});