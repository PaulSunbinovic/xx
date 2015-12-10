<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class CstmgrpcstmrlAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cstmgrpcstmrl'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],$x);
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		if($x=='vw'){
			$cstmgrpcstmrlid=$_GET['cstmgrpcstmrlid'];
			$cstmgrpcstmrl=M('cstmgrpcstmrl');
			$mo=$cstmgrpcstmrl->join('tb_cstmgrp ON f_cstmgrpcstmrl_cstmgrpid=cstmgrpid')->join('tb_cstmrl ON f_cstmgrpcstmrl_cstmrlid=cstmrlid')->where("cstmgrpcstmrlid=".$cstmgrpcstmrlid)->find();
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$cstmgrpcstmrlid=$_GET['cstmgrpcstmrlid'];
			$cstmgrpcstmrl=M('cstmgrpcstmrl');
			if($cstmgrpcstmrlid==0){
				$mo['cstmgrpcstmrlid']=0;
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$cstmgrpcstmrl->join('tb_cstmgrp ON f_cstmgrpcstmrl_cstmgrpid=cstmgrpid')->join('tb_cstmrl ON f_cstmgrpcstmrl_cstmrlid=cstmrlid')->where("cstmgrpcstmrlid=".$cstmgrpcstmrlid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			import('@.TREE.TreeAction');
			$tree = new TreeAction();
			$cstmgrp=M('cstmgrp');
			$cstmgrpls=$cstmgrp->order('cstmgrpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
			$str=$tree->unlimitedForListSLCT($cstmgrpls,0,'cstmgrpid','cstmgrpnm','cstmgrppid','cstmgrpodr');
			$this->assign('tree',$str);
			
			$cstmrl=M('cstmrl');
			$this->assign('cstmrlls',$cstmrl->select());
			$this->display('update');
		}
	
	
	}
	
	//------------------【】【】【】【】以上是用户部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cstmgrpcstmrl'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],'qry');
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		//NB初始化，开始
		$cstmgrpcstmrl=M('cstmgrpcstmrl');
		$fldint='-cstmgrpcstmrlid-cstmgrpnm-cstmrlnm-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='';
		$lmtint=20;
		$jn='tb_cstmgrp ON f_cstmgrpcstmrl_cstmgrpid=cstmgrpid-jn-tb_cstmrl ON f_cstmgrpcstmrl_cstmrlid=cstmrlid';
		//$jn='tb_cstmgrp ON f_cstmgrpcstmrl_cstmgrpid=cstmgrpid-jn-tb_atc ON f_cstmgrpcstmrl_cstmgrpid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($cstmgrpcstmrl,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($u,$fldint,$cdtint,$odrint,$lmtint,$jn);
		
		$this->assign('fstrw',$arr['fstrw']);
		$this->assign('sqlstc',$arr['sqlstc']);
		$this->assign('fld',$arr['fld']);
		$this->assign('cdt',$arr['cdt']);
		$this->assign('spccdt',$arr['spccdt']);////
		$this->assign('odr',$arr['odr']);
		$this->assign('lmt',$arr['lmt']);
		$this->assign('count',$arr['count']);
		$this->assign('mls',$arr['mls']);
		$this->assign('page_method',$arr['page_method']);
		//NB初始化，结束
		
		
		
		
		//q特殊
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
		$cstmgrp=M('cstmgrp');
		$cstmgrpls=$cstmgrp->order('cstmgrpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
		$str=$tree->unlimitedForListSLCT($cstmgrpls,0,'cstmgrpid','cstmgrpnm','cstmgrppid','cstmgrpodr');
		$this->assign('tree',$str);
		
		$cstmrl=M('cstmrl');
		$cstmrlls=$cstmrl->select();
		$this->assign('cstmrlls',$cstmrlls);
		
		//q特殊
		$this->assign('title','浏览团队-客户角色列表');
		$this->assign('theme','团队-客户角色管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmgrpcstmrlid=$_POST['cstmgrpcstmrlid'];
	
		if($cstmgrpcstmrlid==0){
			$cstmgrpcstmrl=M('cstmgrpcstmrl');
			//先截获数据
			$data=array(
					'f_cstmgrpcstmrl_cstmgrpid'=>$_POST['f_cstmgrpcstmrl_cstmgrpid'],
					'f_cstmgrpcstmrl_cstmrlid'=>$_POST['f_cstmgrpcstmrl_cstmrlid'],
					
			);
			if($cstmgrpcstmrl->where('f_cstmgrpcstmrl_cstmrlid='.$_POST['f_cstmgrpcstmrl_cstmrlid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				if($cstmgrpcstmrl->data($data)->add()){
					$data['status']=1;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}
			}
			
			
		}else{
			$cstmgrpcstmrl=M('cstmgrpcstmrl');
			//先截获数据
			$data=array(
					'f_cstmgrpcstmrl_cstmgrpid'=>$_POST['f_cstmgrpcstmrl_cstmgrpid'],
					'f_cstmgrpcstmrl_cstmrlid'=>$_POST['f_cstmgrpcstmrl_cstmrlid'],
					
			);
			//新建立的关系必须之前没有//至于老的关系么换掉也就没有了，不用想了
			if($cstmgrpcstmrl->where('f_cstmgrpcstmrl_cstmgrpid='.$_POST['f_cstmgrpcstmrl_cstmgrpid'].' AND f_cstmgrpcstmrl_cstmrlid='.$_POST['f_cstmgrpcstmrl_cstmrlid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				$cstmrlid=$_POST['f_cstmgrpcstmrl_cstmrlid'];
				//那么原来的关系就断掉了，那么属于cstmgrp 中 职位 cstmrl的usr何去何从
				//避免用户在cstmgrp里面挂空cstmrl，
				//cstmgrp 和 cstmrl 关系 1对多因此任这个cstmrl 必然在特定的cstmgrp下面
				//1、任职cstmrl哪些用户
				$usrcstmrl=M('usrcstmrl');
				$usrcstmrlls=$usrcstmrl->where('f_usrcstmrl_cstmrlid='.$cstmrlid)->select();
				//2、这个cstmrl职位属于哪个cstmgrp
				$cstmgrpcstmrl=M('cstmgrpcstmrl');
				$cstmgrpcstmrlo=$cstmgrpcstmrl->where('f_cstmgrpcstmrl_cstmrlid='.$cstmrlid)->find();
				//3、看看这些用户在此cstmgrp里头是否担任其他职务，若没有的话，离开这个职务同时也意味着和这个cstmgrp解约
				$cstmgrpcstmrllsot=$cstmgrpcstmrl->where('f_cstmgrpcstmrl_cstmgrpid='.$cstmgrpcstmrlo['f_cstmgrpcstmrl_cstmgrpid'].' AND f_cstmgrpcstmrl_cstmrlid<>'.$cstmrlid)->select();//得到此cstmgrp还有啥cstmrl
				$usrcstmgrp=M('usrcstmgrp');
				for($i=0;$i<count($usrcstmrlls);$i++){//重点是usr
					$hsot=0;//初始假定用户在这个cstmgrp里头没有cstmrl了
					for($j=0;$j<count($cstmgrpcstmrllsot);$j++){//重点cstmrl
						if($usrcstmrl->where('f_usrcstmrl_usrid='.$usrcstmrlls[$i]['f_usrcstmrl_usrid'].' AND f_usrcstmrl_cstmrlid='.$cstmgrpcstmrllsot[$j]['f_cstmgrpcstmrl_cstmrlid'])->find()){
							$hsot=1;
							break;
						}
					}
					if($hsot==0){
						//说明无其他任职，退出cstmgrp
						$usrcstmgrp->where('f_usrcstmgrp_usrid='.$usrcstmrlls[$i]['f_usrcstmrl_usrid'].' AND f_usrcstmgrp_cstmgrpid='.$cstmgrpcstmrlo['f_cstmgrpcstmrl_cstmgrpid'])->delete();
					}
				}
				
				if($cstmgrpcstmrl->where('cstmgrpcstmrlid='.$cstmgrpcstmrlid)->setField($data)){
					$data['status']=1;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}
			}
			
			
		}
	}
	
	function delete(){
		
		$cstmgrpcstmrl=M('cstmgrpcstmrl');
		
		$cstmgrpcstmrlo=$cstmgrpcstmrl->where('cstmgrpcstmrlid='.$_POST['cstmgrpcstmrlid'])->find();
		$cstmgrpid=$cstmgrpcstmrlo['f_cstmgrpcstmrl_cstmgrpid'];
		$cstmrlid=$cstmgrpcstmrlo['f_cstmgrpcstmrl_cstmrlid'];
		
		//避免用户在cstmgrp里面挂空cstmrl，
		//cstmgrp 和 cstmrl 关系 1对多因此任这个cstmrl 必然在特定的cstmgrp下面
		//1、任职cstmrl哪些用户
		$usrcstmrl=M('usrcstmrl');
		$usrcstmrlls=$usrcstmrl->where('f_usrcstmrl_cstmrlid='.$cstmrlid)->select();
		//2、看看这些用户在此cstmgrp里头是否担任其他职务，若没有的话，离开这个职务同时也意味着和这个cstmgrp解约
		$cstmgrpcstmrllsot=$cstmgrpcstmrl->where('f_cstmgrpcstmrl_cstmgrpid='.$cstmgrpid.' AND f_cstmgrpcstmrl_cstmrlid<>'.$cstmrlid)->select();//得到此cstmgrp还有啥cstmrl
		$usrcstmgrp=M('usrcstmgrp');
		for($i=0;$i<count($usrcstmrlls);$i++){//重点是usr
			$hsot=0;//初始假定用户在这个cstmgrp里头没有cstmrl了
			for($j=0;$j<count($cstmgrpcstmrllsot);$j++){//重点cstmrl
				if($usrcstmrl->where('f_usrcstmrl_usrid='.$usrcstmrlls[$i]['f_usrcstmrl_usrid'].' AND f_usrcstmrl_cstmrlid='.$cstmgrpcstmrllsot[$j]['f_cstmgrpcstmrl_cstmrlid'])->find()){
					$hsot=1;
					break;
				}
			}
			if($hsot==0){
				//说明无其他任职，退出cstmgrp
				$usrcstmgrp->where('f_usrcstmgrp_usrid='.$usrcstmrlls[$i]['f_usrcstmrl_usrid'].' AND f_usrcstmgrp_cstmgrpid='.$cstmgrpid)->delete();
			}
		}
		
		if($cstmgrpcstmrl->delete($_POST['cstmgrpcstmrlid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			
		}
	}

}



?>