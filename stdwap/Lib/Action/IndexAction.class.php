<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	public function index(){
    	
    	//处理ss
    	import('@.SS.SSAction');
    	$ss = new SSAction();
    	$ss->setss();
    	
    	//设置 导航 bd
    	import('@.TREE.TreeAction');
    	$tree = new TreeAction();
    	
		
// 		import('@.NTF.NTFAction');
// 		$ntf = new NTFAction();
// 		$ntf->setntf();
		
		import('@.NV.NVAction');
		$nv = new NVAction();
		$nv->setnv();
		
		
    	
     	
    	//通用部分
    	$this->assign('title','学生后台');
    	$this->assign('theme','学生后台');
		$this->display('index');
    }
    
    
}

?>