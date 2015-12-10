<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
		////
// 		$std=M('2013_std');
// 		$stdxqcls=M('2013_stdxqcls');
// 		$stdls=$std->where('f_std_statid=5 AND stdFinalZhuanye=11')->select();
// 		foreach ($stdls as $v){
			
// 			$dt=array(
// 					'f_stdxqcls_stdid'=>$v['stdid'],
// 					'f_stdxqcls_xqid'=>2,
// 					'f_stdxqcls_clsid'=>3,
// 			);
// 			$stdxqcls->data($dt)->add();
// 		}
// 		p('搞定！');die;
    	////
		if(cookie('usridck')||session('usridss')){
			
			
			//先给hd设置好些东西，他自身是无法提取的
			import('@.SS.SSAction');
			$ss = new SSAction();
			$ss->setss();
			
			//获取用户的信息查看用户是否被禁了
			$usrid=session('usridss');
			$usr=M('usr');
			$usross=$usr->where('usrid='.$usrid)->find();
			if($usross['usrps']==0){
				$this->error('你的账户被冻结，请联系管理员');
			}
			
			
			import('@.NTF.NTFAction');
			$ntf = new NTFAction();
			$ntf->setntf();
			
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