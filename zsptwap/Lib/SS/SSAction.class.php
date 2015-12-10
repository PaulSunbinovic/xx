<?php
// class SSAction extends Action{
// 	function setss(){
		
// 		$std=M('std');
// 		if(cookie('stdidck')){
// 			if($std->where('stdid='.cookie('stdidck').' AND stdps=1')->find()){
// 				session('stdidss',cookie('stdidck'));
// 			}
// 		}
// 		if(session('wxusross')&&!session('stdidss')){//第一种组合
// 			$wxusrosstmp=session('wxusross');
// 			//给wx登记，没有要登记，有的话就要验证绑定情况
// 			$wxusr=M('wxusr');
// 			$wxusro=$wxusr->where("wxusropid='".$wxusrosstmp['wxusropid']."'")->find();
// 			if($wxusro){
// 				$wxusrstd=M('wxusrstd');
// 				$wxusrstdo=$wxusrstd->where('f_wxusrstd_wxusrid='.$wxusro['wxusrid'])->find();
// 				if($wxusrstdo){
// 					//绑定
// 					$std=M('std');
// 					$stdo=$std->where('stdid='.$wxusrstdo['f_wxusrstd_stdid'])->find();
// 					if(strpos($stdo['stdpt'],'default')!=false){
// 						$stdo['stdpt']=$wxusro['wxusrpt'];
// 					}
// 					$this->assign('stdoss',$stdo);
// 					session('stdidss',$stdo['stdid']);//由于绑定产生的stdidss
// 				}else{
// 					$this->assign('wxusross',$wxusro);
// 				}
// 			}else{
// 				$dt=array(
// 						'wxusropid'=>$wxusrosstmp['wxusropid'],
// 						'wxusrnm'=>$wxusrosstmp['wxusrnm'],
// 						'wxusrpt'=>$wxusrosstmp['wxusrpt']
// 				);
// 				$wxusr->data($dt)->add();
// 				$this->assign('wxusross',session('wxusross'));
// 			}
			
// 		}else if(session('wxusross')&&session('stdidss')){//第二种情况
// 			$wxusross=session('wxusross');
// 			//这时候必然是两者绑定的
// 			$std=M('std');
// 			$stdo=$std->where('stdid='.session('stdidss'))->find();
// 			if(strpos($stdo['stdpt'],'default')!=false){
// 				$stdo['stdpt']=$wxusross['wxusrpt'];
// 			}
// 			$this->assign('stdoss',$stdo);
// 		}else if(!session('wxusross')&&session('stdidss')){//第三种情况
// 			$stdid=session('stdidss');
// 			$stdoss=$std->where('stdid='.$stdid)->find();
// 			$this->assign('stdoss',$stdoss);
// 		}//第四种情况就是啥都没也就没必要了
		
		
// 	}
// }

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