<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
    	
		if(cookie('stdidck')||session('stdidss')){
			
			
			//先给hd设置好些东西，他自身是无法提取的
			import('@.SS.SSAction');
			$ss = new SSAction();
			$ss->setss();
			
			
			
			
// 			import('@.NTF.NTFAction');
// 			$ntf = new NTFAction();
// 			$ntf->setntf();
			
			import('@.KZMB.KZMBAction');
			$kzmb = new KZMBAction();
			$kzmb->setkzmb();
			
			
			
			$this->assign('title','学生端后台主页');
			$this->assign('theme','欢迎进入学生端后台：');
			$this->display('adm');
		}else{
			$this->assign('title','学生登录页面');
			$this->assign('theme','学生登录：');
			$this->display('login');
		}
    }
    
    
   
}