<?php
class KZMBAction extends Action{
	function setkzmb($mdidactv){
		
		$grdid=session('grdidss');
		$stdid=session('stdidss');
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		
		
		$stdbtn=M($grdo['grdnm'].'_stdbtn');
		

		
		//控制面板给lft rgt来搞
		if($stdbtn->where('f_stdbtn_stdid='.$stdid." AND stdbtnnm='lft'")->find()){
			$stdbtno=$stdbtn->where('f_stdbtn_stdid='.$stdid." AND stdbtnnm='lft'")->find();
			$lftcls=$stdbtno['stdbtnvl'];
			if($lftcls=='none'){
				$rgtcls='col-md-12';
				$lftstdbtncls='inline';
			}else{
				$rgtcls='col-md-10';
				$lftstdbtncls='none';
			}
		}else{
			$lftcls='block';
			$rgtcls='col-md-10';
			$lftstdbtncls='none';
		}
		$this->assign('lftcls',$lftcls);
		$this->assign('rgtcls',$rgtcls);
		$this->assign('lftstdbtncls',$lftstdbtncls);
		
		if($stdbtn->where('f_stdbtn_stdid='.$stdid." AND stdbtnnm='bs'")->find()){
			$stdbtno=$stdbtn->where('f_stdbtn_stdid='.$stdid." AND stdbtnnm='bs'")->find();
			$bscls=$stdbtno['stdbtnvl'];
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