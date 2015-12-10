<?php
class IdtathAction extends Action{
	// 1.action中要改 gtx 和query 2.网页中query中的 添加 和VW UPDT DLT 要改3.view 中进入修改要改
	
	function identify($mdid,$x){
		if(session('cstmusridss')){
			$cstmusrid=session('cstmusridss');
			//鉴别用户是否被冻结了
			$cstmusr=M('cstmusr');
			if($cstmusr->where('cstmusrid='.$cstmusrid.' AND cstmusrps=1')->find()){
				
			}else{
				$this->error('您的帐号已经被冻结，请联系管理员');
			}
			
					
			//1、确定用户有多少cstmrl
			$cstmusrcstmrl=M('cstmusrcstmrl');
			$cstmusrcstmrlls=$cstmusrcstmrl->where('f_cstmusrcstmrl_cstmusrid='.$cstmusrid)->select();
			
			
			
			
			//2、在md一定情况下，用户的这些cstmrl对应的oprt具体值多少
			$cdt=' AND (';
			if(count($cstmusrcstmrlls)!=1){
				$cdt=$cdt.'1=2';
				foreach ($cstmusrcstmrlls as $v){
					//只要有一个权限是超级管理员，那么就告诉别人我是超级管理员
					if($v['f_cstmusrcstmrl_cstmrlid']==1){
						$this->assign('spadm',1);
					}
					$cdt=$cdt.' OR f_cstmath_cstmrlid='.$v['f_cstmusrcstmrl_cstmrlid'];
				}
			}else{
				$cdt=$cdt.'f_cstmath_cstmrlid='.$cstmusrcstmrlls[0]['f_cstmusrcstmrl_cstmrlid'];
			}
				
			$cdt=$cdt.')';
			
			$cstmath=M('cstmath');
			$cstmathls=$cstmath->where('f_cstmath_mdid='.$mdid.$cdt)->select();
			$cstmatha=0;$cstmathd=0;$cstmathm=0;$cstmathv=0;$cstmaths=0;
			foreach($cstmathls as $v){
				if($cstmatha||$v['cstmatha']){
					$cstmatha=1;
				}else{
					$cstmatha=0;
				}
				$cstmathofn['cstmatha']=$cstmatha;
				if($cstmathd||$v['cstmathd']){
					$cstmathd=1;
				}else{
					$cstmathd=0;
				}
				$cstmathofn['cstmathd']=$cstmathd;
				if($cstmathm||$v['cstmathm']){
					$cstmathm=1;
				}else{
					$cstmathm=0;
				}
				$cstmathofn['cstmathm']=$cstmathm;
				if($cstmathv||$v['cstmathv']){
					$cstmathv=1;
				}else{
					$cstmathv=0;
				}
				$cstmathofn['cstmathv']=$cstmathv;
				if($cstmaths||$v['cstmaths']){
					$cstmaths=1;
				}else{
					$cstmaths=0;
				}
				$cstmathofn['cstmaths']=$cstmaths;
			}
			if($x=='ntf'){
				if($cstmathofn['cstmathv']==1){
					$this->assign('cstmathv',1);
				}else if($x=='vw'){
					$this->error('您无此模块的查看权限，请联系管理员');
				}else if($x=='qry'){
					$this->error('您无此模块的浏览权限，请联系管理员');
				}
				if($cstmathofn['cstmathm']==1){
					$this->assign('cstmathm',1);
				}else if($x=='updt'){
					$this->error('您无此模块的修改权限，请联系管理员');
				}
				if($cstmathofn['cstmatha']==1){
					$this->assign('cstmatha',1);
				}else if($x=='updt'){
					$this->error('您无此模块的添加权限，请联系管理员');
				}
				if($cstmathofn['cstmathd']==1){
					$this->assign('cstmathd',1);
				}
				if($cstmathofn['cstmaths']==1){
					$this->assign('cstmaths',1);
				}
			}
			return($cstmathofn);
			
			
			
			
			
		}else{
			$this->error('会话超时，请重新登录');
		}
	
		
	}
}
?>