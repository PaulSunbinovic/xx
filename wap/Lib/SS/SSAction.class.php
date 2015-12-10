<?php
class SSAction extends Action{
	function setss(){
		
		$cstmusr=M('cstmusr');
		if(cookie('cstmusridck')){
			if($cstmusr->where('cstmusrid='.cookie('cstmusridck').' AND cstmusrps=1')->find()){
				session('cstmusridss',cookie('cstmusridck'));
			}
		}
		if(session('wxusross')&&!session('cstmusridss')){//第一种组合
			$wxusrosstmp=session('wxusross');
			//给wx登记，没有要登记，有的话就要验证绑定情况
			$wxusr=M('wxusr');
			$wxusro=$wxusr->where("wxusropid='".$wxusrosstmp['wxusropid']."'")->find();
			if($wxusro){
				$wxusrcstmusr=M('wxusrcstmusr');
				$wxusrcstmusro=$wxusrcstmusr->where('f_wxusrcstmusr_wxusrid='.$wxusro['wxusrid'])->find();
				if($wxusrcstmusro){
					//绑定
					$cstmusr=M('cstmusr');
					$cstmusro=$cstmusr->where('cstmusrid='.$wxusrcstmusro['f_wxusrcstmusr_cstmusrid'])->find();
					if(strpos($cstmusro['cstmusrpt'],'default')!=false){
						$cstmusro['cstmusrpt']=$wxusro['wxusrpt'];
					}
					$this->assign('cstmusross',$cstmusro);
					session('cstmusridss',$cstmusro['cstmusrid']);//由于绑定产生的cstmusridss
				}else{
					$this->assign('wxusross',$wxusro);
				}
			}else{
				$dt=array(
						'wxusropid'=>$wxusrosstmp['wxusropid'],
						'wxusrnm'=>$wxusrosstmp['wxusrnm'],
						'wxusrpt'=>$wxusrosstmp['wxusrpt']
				);
				$wxusr->data($dt)->add();
				$this->assign('wxusross',session('wxusross'));
			}
			
		}else if(session('wxusross')&&session('cstmusridss')){//第二种情况
			$wxusross=session('wxusross');
			//这时候必然是两者绑定的
			$cstmusr=M('cstmusr');
			$cstmusro=$cstmusr->where('cstmusrid='.session('cstmusridss'))->find();
			if(strpos($cstmusro['cstmusrpt'],'default')!=false){
				$cstmusro['cstmusrpt']=$wxusross['wxusrpt'];
			}
			$this->assign('cstmusross',$cstmusro);
		}else if(!session('wxusross')&&session('cstmusridss')){//第三种情况
			$cstmusrid=session('cstmusridss');
			$cstmusross=$cstmusr->where('cstmusrid='.$cstmusrid)->find();
			$this->assign('cstmusross',$cstmusross);
		}//第四种情况就是啥都没也就没必要了
		
		
	}
}
?>