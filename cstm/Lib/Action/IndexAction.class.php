<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
    	
		if(cookie('cstmusridck')||session('cstmusridss')){
			
			
			//先给hd设置好些东西，他自身是无法提取的
			import('@.SS.SSAction');
			$ss = new SSAction();
			$ss->setss();
			
			//获取用户的信息查看用户是否被禁了
			$cstmusrid=session('cstmusridss');
			$cstmusr=M('cstmusr');
			$cstmusross=$cstmusr->where('cstmusrid='.$cstmusrid)->find();
			if($cstmusross['cstmusrps']==0){
				$this->error('你的账户被冻结，请联系管理员');
			}
			
			
// 			import('@.NTF.NTFAction');
// 			$ntf = new NTFAction();
// 			$ntf->setntf();
			
			import('@.KZMB.KZMBAction');
			$kzmb = new KZMBAction();
			$kzmb->setkzmb();
			
			
			
			$this->assign('title','后台主页');
			$this->assign('theme','欢迎进入后台：');
			$this->display('adm');
		}else{
			$this->assign('title','用户登录页面');
			$this->assign('theme','用户登录：');
			$this->display('login');
		}
    }
    
    
   
}