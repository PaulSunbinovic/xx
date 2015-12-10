<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class StdbtnAction extends Action{
	
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		
		$grdidss=session('grdidss');
		$stdidss=session('stdidss');
		
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdidss)->find();
		
		
		$stdbtn=M($grdo['grdnm'].'_stdbtn');
		
		$stdbtnnm=$_POST['btnnm'];
		if($stdbtn->where('f_stdbtn_grdid='.$grdidss.' AND f_stdbtn_stdid='.$stdidss." AND stdbtnnm='".$stdbtnnm."'")->find()){
			$stdbtno=$stdbtn->where('f_stdbtn_grdid='.$grdidss.' AND f_stdbtn_stdid='.$stdidss." AND stdbtnnm='".$stdbtnnm."'")->find();
			$data=array(
					'stdbtnvl'=>$_POST['btnvl']
			);
			
			
			$stdbtn->where('stdbtnid='.$stdbtno['stdbtnid'])->setField($data);
				
			$data['status']=1;
			$this->ajaxReturn($data,'json');
			
			
		}else{
			$data=array(
					'f_stdbtn_grdid'=>$grdidss,
					'f_stdbtn_stdid'=>$stdidss,
					'stdbtnnm'=>$stdbtnnm,
					'stdbtnvl'=>$_POST['btnvl']
			);
			$stdbtn->data($data)->add();
			$data['status']=2;
			$this->ajaxReturn($data,'json');
		}
	}
	
	

}



?>