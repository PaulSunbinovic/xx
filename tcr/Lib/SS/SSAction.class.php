<?php
class SSAction extends Action{
	function setss(){
		
		$tcr=M('tcr');
		if(cookie('tcridck')){
			if($tcr->where('tcrid='.cookie('tcridck').' AND tcrps=1')->find()){
				session('tcridss',cookie('tcridck'));
			}
		}
		$tcrid=session('tcridss');
		$tcross=$tcr->where('tcrid='.$tcrid)->find();
		$this->assign('tcross',$tcross);
	}
}
?>