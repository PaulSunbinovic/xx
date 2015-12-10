<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class GrprlAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Grprl'")->find();
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
			$grprlid=$_GET['grprlid'];
			$grprl=M('grprl');
			$mo=$grprl->join('tb_grp ON f_grprl_grpid=grpid')->join('tb_rl ON f_grprl_rlid=rlid')->where("grprlid=".$grprlid)->find();
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$grprlid=$_GET['grprlid'];
			$grprl=M('grprl');
			if($grprlid==0){
				$mo['grprlid']=0;
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$grprl->join('tb_grp ON f_grprl_grpid=grpid')->join('tb_rl ON f_grprl_rlid=rlid')->where("grprlid=".$grprlid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			import('@.TREE.TreeAction');
			$tree = new TreeAction();
			$grp=M('grp');
			$grpls=$grp->order('grpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
			$str=$tree->unlimitedForListSLCT($grpls,0,'grpid','grpnm','grppid','grpodr');
			$this->assign('tree',$str);
			
			$rl=M('rl');
			$this->assign('rlls',$rl->select());
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
		$mdo=$mdII->where("mdmk='Grprl'")->find();
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
		$grprl=M('grprl');
		$fldint='-grprlid-grpnm-rlnm-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='';
		$lmtint=20;
		$jn='tb_grp ON f_grprl_grpid=grpid-jn-tb_rl ON f_grprl_rlid=rlid';
		//$jn='tb_grp ON f_grprl_grpid=grpid-jn-tb_atc ON f_grprl_grpid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($grprl,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
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
		$grp=M('grp');
		$grpls=$grp->order('grpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
		$str=$tree->unlimitedForListSLCT($grpls,0,'grpid','grpnm','grppid','grpodr');
		$this->assign('tree',$str);
		
		$rl=M('rl');
		$rlls=$rl->select();
		$this->assign('rlls',$rlls);
		
		//q特殊
		$this->assign('title','浏览团队-角色列表');
		$this->assign('theme','团队-角色管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$grprlid=$_POST['grprlid'];
	
		if($grprlid==0){
			$grprl=M('grprl');
			//先截获数据
			$data=array(
					'f_grprl_grpid'=>$_POST['f_grprl_grpid'],
					'f_grprl_rlid'=>$_POST['f_grprl_rlid'],
					
			);
			if($grprl->where('f_grprl_rlid='.$_POST['f_grprl_rlid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				if($grprl->data($data)->add()){
					$data['status']=1;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}
			}
			
			
		}else{
			$grprl=M('grprl');
			//先截获数据
			$data=array(
					'f_grprl_grpid'=>$_POST['f_grprl_grpid'],
					'f_grprl_rlid'=>$_POST['f_grprl_rlid'],
					
			);
			//新建立的关系必须之前没有//至于老的关系么换掉也就没有了，不用想了
			if($grprl->where('f_grprl_grpid='.$_POST['f_grprl_grpid'].' AND f_grprl_rlid='.$_POST['f_grprl_rlid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				$rlid=$_POST['f_grprl_rlid'];
				//那么原来的关系就断掉了，那么属于grp 中 职位 rl的usr何去何从
				//避免用户在grp里面挂空rl，
				//grp 和 rl 关系 1对多因此任这个rl 必然在特定的grp下面
				//1、任职rl哪些用户
				$usrrl=M('usrrl');
				$usrrlls=$usrrl->where('f_usrrl_rlid='.$rlid)->select();
				//2、这个rl职位属于哪个grp
				$grprl=M('grprl');
				$grprlo=$grprl->where('f_grprl_rlid='.$rlid)->find();
				//3、看看这些用户在此grp里头是否担任其他职务，若没有的话，离开这个职务同时也意味着和这个grp解约
				$grprllsot=$grprl->where('f_grprl_grpid='.$grprlo['f_grprl_grpid'].' AND f_grprl_rlid<>'.$rlid)->select();//得到此grp还有啥rl
				$usrgrp=M('usrgrp');
				for($i=0;$i<count($usrrlls);$i++){//重点是usr
					$hsot=0;//初始假定用户在这个grp里头没有rl了
					for($j=0;$j<count($grprllsot);$j++){//重点rl
						if($usrrl->where('f_usrrl_usrid='.$usrrlls[$i]['f_usrrl_usrid'].' AND f_usrrl_rlid='.$grprllsot[$j]['f_grprl_rlid'])->find()){
							$hsot=1;
							break;
						}
					}
					if($hsot==0){
						//说明无其他任职，退出grp
						$usrgrp->where('f_usrgrp_usrid='.$usrrlls[$i]['f_usrrl_usrid'].' AND f_usrgrp_grpid='.$grprlo['f_grprl_grpid'])->delete();
					}
				}
				
				if($grprl->where('grprlid='.$grprlid)->setField($data)){
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
		
		$grprl=M('grprl');
		
		$grprlo=$grprl->where('grprlid='.$_POST['grprlid'])->find();
		$grpid=$grprlo['f_grprl_grpid'];
		$rlid=$grprlo['f_grprl_rlid'];
		
		//避免用户在grp里面挂空rl，
		//grp 和 rl 关系 1对多因此任这个rl 必然在特定的grp下面
		//1、任职rl哪些用户
		$usrrl=M('usrrl');
		$usrrlls=$usrrl->where('f_usrrl_rlid='.$rlid)->select();
		//2、看看这些用户在此grp里头是否担任其他职务，若没有的话，离开这个职务同时也意味着和这个grp解约
		$grprllsot=$grprl->where('f_grprl_grpid='.$grpid.' AND f_grprl_rlid<>'.$rlid)->select();//得到此grp还有啥rl
		$usrgrp=M('usrgrp');
		for($i=0;$i<count($usrrlls);$i++){//重点是usr
			$hsot=0;//初始假定用户在这个grp里头没有rl了
			for($j=0;$j<count($grprllsot);$j++){//重点rl
				if($usrrl->where('f_usrrl_usrid='.$usrrlls[$i]['f_usrrl_usrid'].' AND f_usrrl_rlid='.$grprllsot[$j]['f_grprl_rlid'])->find()){
					$hsot=1;
					break;
				}
			}
			if($hsot==0){
				//说明无其他任职，退出grp
				$usrgrp->where('f_usrgrp_usrid='.$usrrlls[$i]['f_usrrl_usrid'].' AND f_usrgrp_grpid='.$grpid)->delete();
			}
		}
		
		if($grprl->delete($_POST['grprlid'])){
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