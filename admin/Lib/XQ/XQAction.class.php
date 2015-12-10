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
	
	function getxqo($grdid,$sttid,$dqxqid){
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
		
		foreach($xqls as $v){
			if($v['xqid']==$dqxqid){
				$xqo=$v;
				break;
			}
		}
		return $xqo;
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
	
	function getcwxqid($grdid,$xnid,$sttid){
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		
		$xn=M('xn');
		$xno=$xn->where('xnid='.$xnid)->find();
		
		$xqidstfrmxn=array();
		$xq=M('xq');
		$xqls=$xq->where("xqnm LIKE '%".$xno['xnnm']."%'")->select();
		if(count($xqls)<3){
			array_push($xqidstfrmxn, $xqls[0]['xqid']);
		}else{
			array_push($xqidstfrmxn, $xqls[1]['xqid']);
			array_push($xqidstfrmxn, $xqls[2]['xqid']);
		}
		
		$sttintxq=M($grdo['grdnm'].'_sttintxq');
		$sttintxqo=$sttintxq->where('f_sttintxq_sttid='.$sttid)->find();
		$xqidstfrmsttintxq=array();
		array_push($xqidstfrmsttintxq, $sttintxqo['f_sttintxq_xqid']);
		$xqidint=(int)$sttintxqo['f_sttintxq_xqid'];
		for($i=0;$i<4;$i++){
			$xqidint=$xqidint+2;
			array_push($xqidstfrmsttintxq, $xqidint);
		}
		
		$jiaoji=array_intersect($xqidstfrmxn,$xqidstfrmsttintxq);//以第一个为基准第二个里头有就留下，否则滚蛋
		
		foreach($jiaoji as $v){
			$shijixqid=$v;
		}
		
		return $shijixqid;
		
	}
}
?>