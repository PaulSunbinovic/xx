<?php
class CkModel extends Action{
	//test
	//
	//############test
	public function adddata($stdo,$bmo,$grd){
		$ck=M($grd.'_ck');
		$data=array(
				'f_ck_stdid'=>$stdo['stdid'],
				'ckyear'=>'2015',
				'cklqzy'=>$bmo[9],
			);
		$ck->data($data)->add();
	}
	//############test ///1 李思怡是什么回事 2 录取在树人大学的人我也要加进去 ///3 357 332527199609200026
	public function mdfdata($stdo,$ckcjo,$grd){
		$ck=M($grd.'_ck');
		$cko=$ck->where('f_ck_stdid='.$stdo['stdid'])->find();
		$data=array(
				'ckksh'=>$ckcjo[1],
				'ckkszf'=>$ckcjo[5],
				'cktdzysx'=>$ckcjo[6],
				'cklqzy'=>$ckcjo[7],
			);
		$ck->where('ckid='.$cko['ckid'])->setField($data);
	}
	##############
	public function getckcj($stdid,$grd,$yr){
		$ck=M($grd.'_ck');
		$cko=$ck->where('f_ck_stdid='.$stdid." AND ckyear='".$yr."'")->find();
		if($cko){
			if($cko['ckkszf']){$cj=$cko['ckkszf'].'（已通过）';}else{$cj='未通过';}
		}else{
			$cj='notkaoshi';
		}
		return $cj;
	}

} 
?>