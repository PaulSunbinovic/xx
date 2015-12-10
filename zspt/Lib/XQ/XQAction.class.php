<?php
class XQAction extends Action{
	
	function getxqnm($grdid,$sttid,$dqxqid){
		$dftxqsum=10;
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		
		$xq=M('xq');
		$sttintxq=M($grdo['grdnm'].'_sttintxq');
		$sttintxqo=$sttintxq->where('f_sttintxq_sttid='.$sttid)->find();
		$intxqid=$sttintxqo['f_sttintxq_xqid'];
		$xqyes=$sttintxqo['sttintxqyes'];
		if($xqyes==0){
			$xqls=$xq->where('xqid>='.$intxqid)->order('xqid ASC')->limit(0,$dftxqsum)->select();
		}else{
			$xqlsorg=$xq->where('xqid>='.$intxqid)->order('xqid ASC')->limit(0,$dftxqsum)->select();
			$xqlsnw=array();
			for($i=0;$i<count($xqlsorg);$i++){
				$xqlsorg[$i]['xqnm']='第'.($i+1).'学期';
				array_push($xqlsnw, $xqlsorg[$i]);
			}
			$xqls=$xqlsnw;
		
				
		}
		$xqnm='';
		foreach($xqls as $v){
			if($v['xqid']==$dqxqid){
				$xqnm=$v['xqnm'];
				break;
			}
		}
		return $xqnm;
	}
	
	function getxqls($grdid,$sttid,$odr){
		$dftxqsum=10;
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		
		$xq=M('xq');
		$sttintxq=M($grdo['grdnm'].'_sttintxq');
		$sttintxqo=$sttintxq->where('f_sttintxq_sttid='.$sttid)->find();
		$intxqid=$sttintxqo['f_sttintxq_xqid'];
		$xqyes=$sttintxqo['sttintxqyes'];
		if($xqyes==0){
			$xqls=$xq->where('xqid>='.$intxqid)->order('xqid '.$odr)->limit(0,$dftxqsum)->select();
		}else{
			$xqlsorg=$xq->where('xqid>='.$intxqid)->order('xqid ASC')->limit(0,$dftxqsum)->select();
			if($odr=='DESC'){
				$xqlsnw=array();
				for($i=count($xqlsorg)-1;$i>-1;$i--){
					$xqlsorg[$i]['xqnm']='第'.($i+1).'学期';
					array_push($xqlsnw, $xqlsorg[$i]);
				}
				$xqls=$xqlsnw;
			}else{
				$xqlsnw=array();
				for($i=0;$i<count($xqlsorg);$i++){
					$xqlsorg[$i]['xqnm']='第'.($i+1).'学期';
					array_push($xqlsnw, $xqlsorg[$i]);
				}
				$xqls=$xqlsnw;
				
			}
			
		}
		return $xqls;
	}
}
?>