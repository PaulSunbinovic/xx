<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class UsrgrpAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Usrgrp'")->find();
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
			$usrgrpid=$_GET['usrgrpid'];
			$usrgrp=M('usrgrp');
			$mo=$usrgrp->join('tb_usr ON f_usrgrp_usrid=usrid')->join('tb_grp ON f_usrgrp_grpid=grpid')->where("usrgrpid=".$usrgrpid)->find();
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$usrgrpid=$_GET['usrgrpid'];
			$usrgrp=M('usrgrp');
			if($usrgrpid==0){
				$mo['usrgrpid']=0;
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$usrgrp->join('tb_usr ON f_usrgrp_usrid=usrid')->join('tb_grp ON f_usrgrp_grpid=grpid')->where("usrgrpid=".$usrgrpid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			$usr=M('usr');
			$this->assign('usrls',$usr->select());


			import('@.TREE.TreeAction');
			$tree = new TreeAction();
			$grp=M('grp');
			$grpls=$grp->order('grpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
			$str=$tree->unlimitedForListSLCT($grpls,0,'grpid','grpnm','grppid','grpodr');
			$this->assign('tree',$str);
			
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
		$mdo=$mdII->where("mdmk='Usrgrp'")->find();
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
		$usrgrp=M('usrgrp');
		$fldint='-usrgrpid-usrnm-grpnm-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='';
		$lmtint=20;
		$jn='tb_usr ON f_usrgrp_usrid=usrid-jn-tb_grp ON f_usrgrp_grpid=grpid';
		//$jn='tb_usr ON f_usrgrp_usrid=usrid-jn-tb_atc ON f_usrgrp_usrid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($usrgrp,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
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
		$usr=M('usr');
		$usrls=$usr->select();
		$this->assign('usrls',$usrls);
		
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
		$grp=M('grp');
		$grpls=$grp->order('grpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
		$str=$tree->unlimitedForListSLCT($grpls,0,'grpid','grpnm','grppid','grpodr');
		$this->assign('tree',$str);
		
		
		//q特殊
		$this->assign('title','浏览用户-团队列表');
		$this->assign('theme','用户-团队管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$usrgrpid=$_POST['usrgrpid'];
	
		if($usrgrpid==0){
			$usrgrp=M('usrgrp');
			//先截获数据
			$data=array(
					'f_usrgrp_usrid'=>$_POST['f_usrgrp_usrid'],
					'f_usrgrp_grpid'=>$_POST['f_usrgrp_grpid'],
					
			);
			if($usrgrp->where('f_usrgrp_usrid='.$_POST['f_usrgrp_usrid'].' AND f_usrgrp_grpid='.$_POST['f_usrgrp_grpid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				if($usrgrp->data($data)->add()){
					$data['status']=1;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}
			}
			
			
		}else{
			$usrgrp=M('usrgrp');
			//先截获数据
			$data=array(
					'f_usrgrp_usrid'=>$_POST['f_usrgrp_usrid'],
					'f_usrgrp_grpid'=>$_POST['f_usrgrp_grpid'],
					
			);
			if($usrgrp->where('f_usrgrp_usrid='.$_POST['f_usrgrp_usrid'].' AND f_usrgrp_grpid='.$_POST['f_usrgrp_grpid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				if($usrgrp->where('usrgrpid='.$usrgrpid)->setField($data)){
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
		
		$usrgrp=M('usrgrp');
		$usrgrpo=$usrgrp->where('usrgrpid='.$_POST['usrgrpid'])->find();
		$usrid=$usrgrpo['f_usrgrp_usrid'];
		$grpid=$usrgrpo['f_usrgrp_grpid'];
		
		
		//换了grp那么也要取消掉其在grp中的任职rl
		//先看这个grp里头有多少rl
		$grprl=M('grprl');
		$grprlls=$grprl->where('f_grprl_grpid='.$grpid)->select();//重点rlls
		$usrrl=M('usrrl');
		for($i=0;$i<count($grprlls);$i++){
			$usrrl->where('f_usrrl_usrid='.$usrid.' AND f_usrrl_rlid='.$grprlls[$i]['f_grprl_rlid'])->delete();
		}
		
		if($usrgrp->delete($_POST['usrgrpid'])){
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