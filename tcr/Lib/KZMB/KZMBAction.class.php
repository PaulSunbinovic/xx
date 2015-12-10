<?php
class KZMBAction extends Action{
	function setkzmb($mdidactv){
		$tcrbtn=M('tcrbtn');
		

		
		$tcrid=session('tcridss');
		
		//控制面板给lft rgt来搞
		if($tcrbtn->where('f_tcrbtn_tcrid='.$tcrid." AND tcrbtnnm='lft'")->find()){
			$tcrbtno=$tcrbtn->where('f_tcrbtn_tcrid='.$tcrid." AND tcrbtnnm='lft'")->find();
			$lftcls=$tcrbtno['tcrbtnvl'];
			if($lftcls=='none'){
				$rgtcls='col-md-12';
				$lfttcrbtncls='inline';
			}else{
				$rgtcls='col-md-10';
				$lfttcrbtncls='none';
			}
		}else{
			$lftcls='block';
			$rgtcls='col-md-10';
			$lfttcrbtncls='none';
		}
		$this->assign('lftcls',$lftcls);
		$this->assign('rgtcls',$rgtcls);
		$this->assign('lfttcrbtncls',$lfttcrbtncls);
		
		if($tcrbtn->where('f_tcrbtn_tcrid='.$tcrid." AND tcrbtnnm='bs'")->find()){
			$tcrbtno=$tcrbtn->where('f_tcrbtn_tcrid='.$tcrid." AND tcrbtnnm='bs'")->find();
			$bscls=$tcrbtno['tcrbtnvl'];
			if($bscls=='glyphicon glyphicon-triangle-bottom'){
				$bsbdcls='none';
			}else{
				$bsbdcls='block';
			}

		}else{
			$bscls='glyphicon glyphicon-triangle-top';
			$bsbdcls='block';
		}
		$this->assign('bscls',$bscls);
		$this->assign('bsbdcls',$bsbdcls);
		
		
	}
}
?>