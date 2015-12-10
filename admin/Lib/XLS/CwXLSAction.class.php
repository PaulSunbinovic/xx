<?php 


class CwXLSAction extends Action{
	
	function update($indata){
		header("Content-Type:text/html; charset=utf-8");
		
		for($i=1;$i<count($indata);$i++){//第一行是标题行不去管
			$usrnm=trim($indata[$i][1]);
			if($usrnm<>''){
				$usro=$usr->where("usrnm='".$usrnm."'")->find();
				if($usro){
					$usrid=$usro['usrid'];
					$usrpw=$usro['usrpw'];
					$usrpt=$usro['usrpt'];
					$usraddtm=$usro['usraddtm'];
				}else{
					$usrid=0;
					$usrpw='111';
					$usrpt=C('PUBLIC').'/IMG/default.jpg';
					$usraddtm=date("Y-m-d H:i:s",time());
				}
				$athnm=trim($indata[$i][2]);
				$atho=$ath->where("athnm='".$athnm."'")->find();
				if($atho){
					$athid=$atho['athid'];
				}else{
					$athid=0;
				}
				$data=array(
					'usrnm'=>$usrnm,
					'usrpw'=>$usrpw,
					'usrpt'=>$usrpt,
					'f_usr_athid'=>$athid,
					'usraddtm'=>$usraddtm,
					'usrmdftm'=>date("Y-m-d H:i:s",time()),
				);
				if($usrid==0){
					//添加
					$usr->data($data)->add();
				}else{
					//修改
					$usr->where('usrid='.$usrid)->setField($data);
				}
			}
		}
	}
	
	

}



?>