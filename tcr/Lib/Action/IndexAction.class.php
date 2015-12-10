<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
    	
		if(cookie('tcridck')||session('tcridss')){
			
			
			//先给hd设置好些东西，他自身是无法提取的
			import('@.SS.SSAction');
			$ss = new SSAction();
			$ss->setss();
			
			//获取用户的信息查看用户是否被禁了
			$tcrid=session('tcridss');
			$tcr=M('tcr');
			$tcross=$tcr->where('tcrid='.$tcrid)->find();
			if($tcross['tcrps']==0){
				$this->error('你的账户被冻结，请联系管理员');
			}
			
			
// 			import('@.NTF.NTFAction');
// 			$ntf = new NTFAction();
// 			$ntf->setntf();
			
			import('@.KZMB.KZMBAction');
			$kzmb = new KZMBAction();
			$kzmb->setkzmb();
			
			$atc=M('atc');
			$atcls=$atc->where('atcid=21')->select();
			$this->assign('atcls',$atcls);
			
			$this->assign('title','教师端后台主页');
			$this->assign('theme','欢迎进入教师端后台：');
			$this->display('adm');
		}else{
			$this->assign('title','教师登录页面');
			$this->assign('theme','教师登录：');
			$this->display('login');
		}
    }
    
    
   
}