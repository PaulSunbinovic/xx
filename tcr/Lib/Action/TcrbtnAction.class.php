<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class TcrbtnAction extends Action{
	
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$tcrbtn=M('tcrbtn');
		$tcridss=session('tcridss');
		$tcrbtnnm=$_POST['btnnm'];
		if($tcrbtn->where('f_tcrbtn_tcrid='.$tcridss." AND tcrbtnnm='".$tcrbtnnm."'")->find()){
			$tcrbtno=$tcrbtn->where('f_tcrbtn_tcrid='.$tcridss." AND tcrbtnnm='".$tcrbtnnm."'")->find();
			$data=array(
					'tcrbtnvl'=>$_POST['btnvl']
			);
			
			
			$tcrbtn->where('tcrbtnid='.$tcrbtno['tcrbtnid'])->setField($data);
				
			$data['status']=1;
			$this->ajaxReturn($data,'json');
			
			
		}else{
			$data=array(
					'f_tcrbtn_tcrid'=>$tcridss,
					'tcrbtnnm'=>$tcrbtnnm,
					'tcrbtnvl'=>$_POST['btnvl']
			);
			$tcrbtn->data($data)->add();
			$data['status']=2;
			$this->ajaxReturn($data,'json');
		}
	}
	
	

}



?>