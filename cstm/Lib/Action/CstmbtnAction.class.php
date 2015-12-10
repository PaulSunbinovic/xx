<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class CstmbtnAction extends Action{
	
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmbtn=M('cstmbtn');
		$cstmusridss=session('cstmusridss');
		$cstmbtnnm=$_POST['cstmbtnnm'];
		if($cstmbtn->where('f_cstmbtn_cstmusrid='.$cstmusridss." AND cstmbtnnm='".$cstmbtnnm."'")->find()){
			$cstmbtno=$cstmbtn->where('f_cstmbtn_cstmusrid='.$cstmusridss." AND cstmbtnnm='".$cstmbtnnm."'")->find();
			$data=array(
					'cstmbtnvl'=>$_POST['cstmbtnvl']
			);
			
			
			$cstmbtn->where('cstmbtnid='.$cstmbtno['cstmbtnid'])->setField($data);
				
			$data['status']=1;
			$this->ajaxReturn($data,'json');
			
			
		}else{
			$data=array(
					'f_cstmbtn_cstmusrid'=>$cstmusridss,
					'cstmbtnnm'=>$cstmbtnnm,
					'cstmbtnvl'=>$_POST['cstmbtnvl']
			);
			$cstmbtn->data($data)->add();
			$data['status']=2;
			$this->ajaxReturn($data,'json');
		}
	}
	
	

}



?>