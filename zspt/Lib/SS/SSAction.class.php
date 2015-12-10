<?php
class SSAction extends Action{
	function setss(){
		$zssz=M('zssz');
		$zsszo=$zssz->find();
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$zsszo['f_zssz_grdid'])->find();
		$std=M($grdo['grdnm'].'_std');
		if(cookie('stdidck')){
			if($std->where('stdid='.cookie('stdidck'))->find()){
				session('stdidss',cookie('stdidck'));
			}
		}
		$stdid=session('stdidss');
		$stdoss=$std->where('stdid='.$stdid)->find();
		$this->assign('stdoss',$stdoss);
	}
}
?>