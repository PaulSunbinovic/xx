<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class BtnAction extends Action{
	
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$btn=M('btn');
		$usridss=session('usridss');
		$btnnm=$_POST['btnnm'];
		if($btn->where('f_btn_usrid='.$usridss." AND btnnm='".$btnnm."'")->find()){
			$btno=$btn->where('f_btn_usrid='.$usridss." AND btnnm='".$btnnm."'")->find();
			$data=array(
					'btnvl'=>$_POST['btnvl']
			);
			
			
			$btn->where('btnid='.$btno['btnid'])->setField($data);
				
			$data['status']=1;
			$this->ajaxReturn($data,'json');
			
			
		}else{
			$data=array(
					'f_btn_usrid'=>$usridss,
					'btnnm'=>$btnnm,
					'btnvl'=>$_POST['btnvl']
			);
			$btn->data($data)->add();
			$data['status']=2;
			$this->ajaxReturn($data,'json');
		}
	}
	
	

}



?>