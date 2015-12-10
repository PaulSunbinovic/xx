<?php
class IdtathAction extends Action{
	// 1.action中要改 gtx 和query 2.网页中query中的 添加 和VW UPDT DLT 要改3.view 中进入修改要改
	
	function identify($mdid,$x){
		if(session('usridss')){
			$usr=M('usr');
			$usro=$usr->where('usrid='.session('usridss'))->find();
			$athmd=M('athmd');
			$athmdo=$athmd->where('f_athmd_athid='.$usro['f_usr_athid'].' AND f_athmd_mdid='.$mdid)->find();
			
			if($athmdo['athq']=='n'){
				$this->error('您无此模块的浏览权限，请联系管理员');
			}
			if($athmdo['athv']=='y'){
				$this->assign('athv','y');
			}else if($x=='vw'){
				$this->error('您无此模块的查看权限，请联系管理员');
			}
			if($athmdo['athm']=='y'){
				$this->assign('athm','y');
			}else if($x=='updt'){
				$this->error('您无此模块的修改权限，请联系管理员');
			}
			if($athmdo['atha']=='y'){
				$this->assign('atha','y');
			}else if($x=='updt'){
				$this->error('您无此模块的添加权限，请联系管理员');
			}
			if($athmdo['athd']=='y'){
				$this->assign('athd','y');
			}
			
			
			
		}else{
			$this->error('会话超时，请重新登录');
		}
	
		
	}
}
?>