<?php
class KZMBAction extends Action{
	function setkzmb($mdidactv){
		$cstmbtn=M('cstmbtn');
		

		
		$cstmusrid=session('cstmusridss');
		
		//控制面板给lft rgt来搞
		if($cstmbtn->where('f_cstmbtn_cstmusrid='.$cstmusrid." AND cstmbtnnm='lft'")->find()){
			$cstmbtno=$cstmbtn->where('f_cstmbtn_cstmusrid='.$cstmusrid." AND cstmbtnnm='lft'")->find();
			$lftcls=$cstmbtno['cstmbtnvl'];
			if($lftcls=='none'){
				$rgtcls='col-md-12';
				$lftcstmbtncls='inline';
			}else{
				$rgtcls='col-md-10';
				$lftcstmbtncls='none';
			}
		}else{
			$lftcls='block';
			$rgtcls='col-md-10';
			$lftcstmbtncls='none';
		}
		$this->assign('lftcls',$lftcls);
		$this->assign('rgtcls',$rgtcls);
		$this->assign('lftcstmbtncls',$lftcstmbtncls);
		
		if($cstmbtn->where('f_cstmbtn_cstmusrid='.$cstmusrid." AND cstmbtnnm='bs'")->find()){
			$cstmbtno=$cstmbtn->where('f_cstmbtn_cstmusrid='.$cstmusrid." AND cstmbtnnm='bs'")->find();
			$bscls=$cstmbtno['cstmbtnvl'];
			if($bscls=='glyphicon glyphicon-triangle-bottom'){
				$bsbdcls='none';
			}else{
				$bsbdcls='block';
			}

		}else{
			$bscls='glyphicon glyphicon-triangle-bottom';
			$bsbdcls='none';
		}
		$this->assign('bscls',$bscls);
		$this->assign('bsbdcls',$bsbdcls);
		
		
	}
}
?>