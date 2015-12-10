<?php
// 本类由系统自动生成，仅供测试用途
class FileUploadAction extends Action {
	public function upload() {
		
        if (!empty($_FILES)) {
            //如果有文件上传 上传附件
            $this->_upload();
        }
    }

    // 文件上传
    protected function _upload() {
		//$tempFile = $_FILES['Filedata']['tmp_name'];
		//$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
		//$name = date('YmdHis')."_".rand(1000,9999).'.'.getExt($_FILES['Filedata']['name']);
		//$targetFile =  str_replace('//','/',$targetPath) . $name;
		//move_uploaded_file($tempFile,$targetFile);
		//$_REQUEST['folder']."/$name ";
		
		
        import('@.FILE.UploadFile');
        //导入上传类
        $upload = new UploadFile();
        //设置上传文件大小
        $upload->maxSize            = 3292200;
        //设置上传文件类型
        $upload->allowExts          = explode(',', 'jpg,gif,png,jpeg,bmp,JPG,GIF,PNG,JPEG,BMP');
        //设置附件上传目录
        $upload->savePath           = './Uploads/'.$_GET['wjj'].'/';
        //设置需要生成缩略图，仅对图像文件有效
        $upload->thumb              = true;
        // 设置引用图片类库包路径
        $upload->imageClassPath     = '@.ORG.Image';
        //设置需要生成缩略图的文件后缀
        $upload->thumbPrefix        = 'm_,s_';  //生产2张缩略图
        //设置缩略图最大宽度
        $upload->thumbMaxWidth      = '400,100';
        //设置缩略图最大高度
        $upload->thumbMaxHeight     = '400,100';
        //设置上传文件规则
        $upload->saveRule           = 'uniqid';
        //删除原图
        $upload->thumbRemoveOrigin  = false;
        if (!$upload->upload()) {
            //捕获上传异常
            //$this->error($upload->getErrorMsg());
			echo '0';
        } else {
            //取得成功上传的文件信息
            $uploadList = $upload->getUploadFileInfo();
            import('@.ORG.Image');
            //给m_缩略图添加水印, Image::water('原文件名','水印图片地址')
            //Image::water($uploadList[0]['savepath'] . 'm_'.$uploadList[0]['savename'], C('PUBLIC').'/IMG/water.png');
            //水印必须在本项目里找
            //要去掉水印，你懂的//Image::water($uploadList[0]['savepath'] . 'm_'.$uploadList[0]['savename'], APP_PATH.'lib/ORG/logo.png');
            $_POST['image'] = $uploadList[0]['savename'];

			//$info=$upload->getUploadFileInfo();
            //$src=$uploadList[0]['savepath'].'s_'.$uploadList[0]['savename'];
            //$src=$uploadList[0]['savepath'].''.$uploadList[0]['savename'];//原图
            //$src='m_'.$uploadList[0]['savename'];//原图名称
            if($_GET['issml']=='y'){
            	$src='m_'.$uploadList[0]['savename'];//原图名称
            }else{
            	$src=$uploadList[0]['savename'];//原图名称
            }
            
            echo $src;			
			//$this->success('上传图片成功！');
        }
    }
}