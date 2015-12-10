<?php
class KZMBAction extends Action{
	function setkzmb($mdidactv){
		$btn=M('btn');
		

		
		$usrid=session('usridss');
		
		//控制面板给lft rgt来搞
		if($btn->where('f_btn_usrid='.$usrid." AND btnnm='lft'")->find()){
			$btno=$btn->where('f_btn_usrid='.$usrid." AND btnnm='lft'")->find();
			$lftcls=$btno['btnvl'];
			if($lftcls=='none'){
				$rgtcls='col-md-12';
				$lftbtncls='inline';
			}else{
				$rgtcls='col-md-10';
				$lftbtncls='none';
			}
		}else{
			$lftcls='block';
			$rgtcls='col-md-10';
			$lftbtncls='none';
		}
		$this->assign('lftcls',$lftcls);
		$this->assign('rgtcls',$rgtcls);
		$this->assign('lftbtncls',$lftbtncls);
		
		
		
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
		}
		$cdt=$cdt.')';
		$lb=M('lb');$lbmd=M('lbmd');
		$lbls=$lb->select();
		$lblsfn=array();
		for($i=0;$i<count($lbls);$i++){
			$mdls=$lbmd->join('tb_md ON f_lbmd_mdid=mdid')->where('f_lbmd_lbid='.$lbls[$i]['lbid'])->select();//重点是md
			//统计对一个列表中的模块有查看权限的模块个数，如果是0，这块列表就没有必要存在了
			$jlmkgs=0;//记录模块个数
			for($k=0;$k<count($mdls);$k++){
				$mdid=$mdls[$k]['mdid'];
				$ath=M('ath');
				$athls=$ath->where('f_ath_mdid='.$mdid.$cdt)->select();
				$atha=0;$athd=0;$athm=0;$athv=0;
				foreach($athls as $v){
					if($atha||$v['atha']){
						$atha=1;
					}else{
						$atha=0;
					}
					$athofn[$mdid]['atha']=$atha;
					if($athd||$v['athd']){
						$athd=1;
					}else{
						$athd=0;
					}
					$athofn[$mdid]['athd']=$athd;
					if($athm||$v['athm']){
						$athm=1;
					}else{
						$athm=0;
					}
					$athofn[$mdid]['athm']=$athm;
					if($athv||$v['athv']){
						$athv=1;
					}else{
						$athv=0;
					}
					$athofn[$mdid]['athv']=$athv;
				}
					
			}
			//鉴权完毕该用户在某个模块下的综合权限出来了
			//得到可以查看的md集合
			$mdlsfn=array();
			foreach ($mdls as $v){
				if($athofn[$v['mdid']]['athv']==1){
					if($v['mdid']==$mdidactv){$v['actvcls']='active';}else{$v['actvcls']='';}
					//确定激活
					array_push($mdlsfn, $v);
					$jlmkgs++;
				}
			}
			if($jlmkgs!=0){
				$lbls[$i]['mdlskzmb']=$mdlsfn;
					
				if($btn->where('f_btn_usrid='.$usrid." AND btnnm='bs".$lbls[$i]['lbid']."'")->find()){
					$btno=$btn->where('f_btn_usrid='.$usrid." AND btnnm='bs".$lbls[$i]['lbid']."'")->find();
					$bscls=$btno['btnvl'];
					if($bscls=='glyphicon glyphicon-triangle-bottom'){
						$bsbdcls='none';
					}else{
						$bsbdcls='block';
					}
						
				}else{
					$bscls='glyphicon glyphicon-triangle-bottom';
					$bsbdcls='none';
				}
				$lbls[$i]['bscls']=$bscls;
				$lbls[$i]['bsbdcls']=$bsbdcls;
				array_push($lblsfn, $lbls[$i]);
			}
			
			
		}
		
		$this->assign('lblskzmb',$lblsfn);//p($lbls);die;
		
		
		
		
		
		
		
		
		
		
		
		
	}
}
?>