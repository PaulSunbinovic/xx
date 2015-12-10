<?php
class SSAction extends Action{
	function setss(){
		
		$usr=M('usr');
		if(cookie('usridck')){
			if($usr->where('usrid='.cookie('usridck').' AND usrps=1')->find()){
				session('usridss',cookie('usridck'));
			}
		}
		$usrid=session('usridss');
		$usross=$usr->where('usrid='.$usrid)->find();
		$usrrlls=$usrrl=M('usrrl')->join('tb_usr ON f_usrrl_usrid=usrid')->join('tb_rl ON f_usrrl_rlid=rlid')->where('f_usrrl_usrid='.$usrid)->select();
		$rlnmu='';
		$i=0;
		foreach ($usrrlls as $v){
			if($i==0){
				$rlnmu=$runmu.$v['rlnm'];
			}else{
				$rlnmu=$runmu.'&'.$v['rlnm'];
			}
			$i++;
		}
		$usross['rlnmu']=$rlnmu;
		$this->assign('usross',$usross);
		return $usross;
	}
}
?>