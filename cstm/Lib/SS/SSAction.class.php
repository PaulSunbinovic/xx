<?php
class SSAction extends Action{
	function setss(){
		
		$cstmusr=M('cstmusr');
		if(cookie('cstmusridck')){
			if($cstmusr->where('cstmusrid='.cookie('cstmusridck').' AND cstmusrps=1')->find()){
				session('cstmusridss',cookie('cstmusridck'));
			}
		}
		$cstmusrid=session('cstmusridss');
		$cstmusross=$cstmusr->where('cstmusrid='.$cstmusrid)->find();
		$this->assign('cstmusross',$cstmusross);
	}
}
?>