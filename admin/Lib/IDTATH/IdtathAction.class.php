<?php
class IdtathAction extends Action{
	// 1.action中要改 gtx 和query 2.网页中query中的 添加 和VW UPDT DLT 要改3.view 中进入修改要改
	
	function identify($mdid,$x){
		if(session('usridss')){
			$usrid=session('usridss');
			//鉴别用户是否被冻结了
			$usr=M('usr');
			if($usr->where('usrid='.$usrid.' AND usrps=1')->find()){
				
			}else{
				$this->error('您的帐号已经被冻结，请联系管理员');
			}
			
					
			//1、确定用户有多少rl
			$usrrl=M('usrrl');
			$usrrlls=$usrrl->where('f_usrrl_usrid='.$usrid)->select();
			
			
			
			
			//2、在md一定情况下，用户的这些rl对应的oprt具体值多少
			$cdt=' AND (';
			if(count($usrrlls)!=1){
				$cdt=$cdt.'1=2';
				foreach ($usrrlls as $v){
					//只要有一个权限是超级管理员，那么就告诉别人我是超级管理员
					if($v['f_usrrl_rlid']==1){
						$this->assign('spadm',1);
					}
					$cdt=$cdt.' OR f_ath_rlid='.$v['f_usrrl_rlid'];
				}
			}else{
				$cdt=$cdt.'f_ath_rlid='.$usrrlls[0]['f_usrrl_rlid'];
				if($usrrlls[0]['f_usrrl_rlid']==1){
					$this->assign('spadm',1);
				}
			}
				
			$cdt=$cdt.')';
			
			$ath=M('ath');
			$athls=$ath->where('f_ath_mdid='.$mdid.$cdt)->select();
			$atha=0;$athd=0;$athm=0;$athv=0;$aths=0;
			foreach($athls as $v){
				if($atha||$v['atha']){
					$atha=1;
				}else{
					$atha=0;
				}
				//$athofn['atha']=$atha;
				if($athd||$v['athd']){
					$athd=1;
				}else{
					$athd=0;
				}
				//$athofn['athd']=$athd;
				if($athm||$v['athm']){
					$athm=1;
				}else{
					$athm=0;
				}
				//$athofn['athm']=$athm;
				if($athv||$v['athv']){
					$athv=1;
				}else{
					$athv=0;
				}
				//$athofn['athv']=$athv;
				if($aths||$v['aths']){
					$aths=1;
				}else{
					$aths=0;
				}
				//$athofn['aths']=$aths;
			}
			$athofn['atha']=$atha;$athofn['athd']=$athd;$athofn['athm']=$athm;$athofn['athv']=$athv;$athofn['aths']=$aths;
			
			if($x!='ntf'){//以免ntf调用的时候给了atc或者usr的东西,从而造成原来要搞的MD无法读出权限
				if($athofn['athv']==1){
					$this->assign('athv',1);
				}else if($x=='vw'){
					$this->error('您无此模块的查看权限，请联系管理员');
				}else if($x=='qry'){
					$this->error('您无此模块的浏览权限，请联系管理员');
				}
				$md=M('md');
				$mdo=$md->where('mdid='.$mdid)->find();
				$id=$_GET[strtolower($mdo['mdmk']).'id'];
				if($athofn['athm']==1){//p($athofn);die;
					$this->assign('athm',1);
				}else if($x=='updt'&&$id>0){
					$this->error('您无此模块的修改权限，请联系管理员');
				}
				if($athofn['atha']==1){
					$this->assign('atha',1);
				}else if($x=='updt'&&$id==0){
					$this->error('您无此模块的添加权限，请联系管理员');
				}
				if($athofn['athd']==1){
					$this->assign('athd',1);
				}
				if($athofn['aths']==1){//p($athofn);die;
					$this->assign('aths',1);
				}
			}
			
			return($athofn);
			
			
			
			
			
		}else{
			$this->error('会话超时，请重新登录');
		}
	
		
	}
}
?>