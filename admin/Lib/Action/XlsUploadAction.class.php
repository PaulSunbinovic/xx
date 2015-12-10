<?php
// 本类由系统自动生成，仅供测试用途
class XlsUploadAction extends Action {
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
        $upload->maxSize            = 32922000;
        //设置上传文件类型
        $upload->allowExts          = explode(',', 'xls,xlsx,XLS,XLSX');
        //设置附件上传目录
        $upload->savePath           = './XlsUploads/';
        //设置需要生成缩略图，仅对图像文件有效
        $upload->thumb              = true;
        // 设置引用图片类库包路径
        $upload->imageClassPath     = '@.ORG.PHPExcel';
        //设置需要生成缩略图的文件后缀
       // $upload->thumbPrefix        = 'm_,s_';  //生产2张缩略图
        //设置缩略图最大宽度
        //$upload->thumbMaxWidth      = '400,100';
        //设置缩略图最大高度
        //$upload->thumbMaxHeight     = '400,100';
        //设置上传文件规则
        //$upload->saveRule           = 'uniqid';
        //删除原图
        $upload->thumbRemoveOrigin  = false;
        if (!$upload->upload()) {
            //捕获上传异常
            //$this->error($upload->getErrorMsg());
			echo '0';
        } else {
            //取得成功上传的文件信息
            $uploadList = $upload->getUploadFileInfo();//p($uploadList);die;
            //import('@.ORG.Image');
            //给m_缩略图添加水印, Image::water('原文件名','水印图片地址')
            //Image::water($uploadList[0]['savepath'] . 'm_' . $uploadList[0]['savename'], APP_PATH.'Tpl/Public/Image/water.png');
            $_POST['file'] = $uploadList[0]['savename'];

			//$info=$upload->getUploadFileInfo();
            //$src=$uploadList[0]['savepath'].'s_'.$uploadList[0]['savename'];
            $src=$uploadList[0]['savepath'].''.$uploadList[0]['savename'];
            //$src=$uploadList[0]['savename'];//原图名称
            
            echo $src;			
           
			//$this->success('上传图片成功！');
        }
    }
}