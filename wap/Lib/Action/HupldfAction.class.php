<?php 

//规矩：需要display的 就m mls 不需要的 只要cstmusro cstmusrls 之类，方便批量移植
class HupldfAction extends Action{
	
	function upload(){
		header('Content-type: application/octet-stream;charset=UTF-8');
	
		$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
	
		if ($fn) {
			//生成一个临时的session存放他送来的照片地址，再后来可以销毁
			$tm=time();
			$tmp=explode('.',$fn);
			$nwflnm=$tm.'.'.$tmp[1];
				
			file_put_contents(
			'./Uploads/cstmusr/' . $nwflnm,
			file_get_contents('php://input')
			);
			//设置图片信息到数据库
				
			$sys=M('sys');
			$syso=$sys->find();
			session('myfl','/'.$syso['sysnm'].'/Uploads/cstmusr/'.$nwflnm);
			
			
			exit();
		}
		
	}
	
	function showphoto(){
		$data['myfl']=session('myfl');
		session('myfl',null);
		
		$data['status']=1;
		$this->ajaxReturn($data,'json');
		
	}
	

}



?>