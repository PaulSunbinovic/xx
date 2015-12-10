<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class CstmusrcstmgrpAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='cstmusrcstmgrp'")->find();
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
			$cstmusrcstmgrpid=$_GET['cstmusrcstmgrpid'];
			$cstmusrcstmgrp=M('cstmusrcstmgrp');
			$mo=$cstmusrcstmgrp->join('tb_cstmusr ON f_cstmusrcstmgrp_cstmusrid=cstmusrid')->join('tb_cstmgrp ON f_cstmusrcstmgrp_cstmgrpid=cstmgrpid')->where("cstmusrcstmgrpid=".$cstmusrcstmgrpid)->find();
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$cstmusrcstmgrpid=$_GET['cstmusrcstmgrpid'];
			$cstmusrcstmgrp=M('cstmusrcstmgrp');
			if($cstmusrcstmgrpid==0){
				$mo['cstmusrcstmgrpid']=0;
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$cstmusrcstmgrp->join('tb_cstmusr ON f_cstmusrcstmgrp_cstmusrid=cstmusrid')->join('tb_cstmgrp ON f_cstmusrcstmgrp_cstmgrpid=cstmgrpid')->where("cstmusrcstmgrpid=".$cstmusrcstmgrpid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			$cstmusr=M('cstmusr');
			$this->assign('cstmusrls',$cstmusr->select());


			import('@.TREE.TreeAction');
			$tree = new TreeAction();
			$cstmgrp=M('cstmgrp');
			$cstmgrpls=$cstmgrp->order('cstmgrpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
			$str=$tree->unlimitedForListSLCT($cstmgrpls,0,'cstmgrpid','cstmgrpnm','cstmgrppid','cstmgrpodr');
			$this->assign('tree',$str);
			
			$this->display('update');
		}
	
	
	}
	
	//------------------【】【】【】【】以上是客户用户部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='cstmusrcstmgrp'")->find();
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
		$cstmusrcstmgrp=M('cstmusrcstmgrp');
		$fldint='-cstmusrcstmgrpid-cstmusrnm-cstmgrpnm-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='';
		$lmtint=20;
		$jn='tb_cstmusr ON f_cstmusrcstmgrp_cstmusrid=cstmusrid-jn-tb_cstmgrp ON f_cstmusrcstmgrp_cstmgrpid=cstmgrpid';
		//$jn='tb_cstmusr ON f_cstmusrcstmgrp_cstmusrid=cstmusrid-jn-tb_atc ON f_cstmusrcstmgrp_cstmusrid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($cstmusrcstmgrp,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
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
		$cstmusr=M('cstmusr');
		$cstmusrls=$cstmusr->select();
		$this->assign('cstmusrls',$cstmusrls);
		
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
		$cstmgrp=M('cstmgrp');
		$cstmgrpls=$cstmgrp->order('cstmgrpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
		$str=$tree->unlimitedForListSLCT($cstmgrpls,0,'cstmgrpid','cstmgrpnm','cstmgrppid','cstmgrpodr');
		$this->assign('tree',$str);
		
		
		//q特殊
		$this->assign('title','浏览客户用户-客户团队列表');
		$this->assign('theme','客户用户-客户团队管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmusrcstmgrpid=$_POST['cstmusrcstmgrpid'];
	
		if($cstmusrcstmgrpid==0){
			$cstmusrcstmgrp=M('cstmusrcstmgrp');
			//先截获数据
			$data=array(
					'f_cstmusrcstmgrp_cstmusrid'=>$_POST['f_cstmusrcstmgrp_cstmusrid'],
					'f_cstmusrcstmgrp_cstmgrpid'=>$_POST['f_cstmusrcstmgrp_cstmgrpid'],
					
			);
			if($cstmusrcstmgrp->where('f_cstmusrcstmgrp_cstmusrid='.$_POST['f_cstmusrcstmgrp_cstmusrid'].' AND f_cstmusrcstmgrp_cstmgrpid='.$_POST['f_cstmusrcstmgrp_cstmgrpid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				if($cstmusrcstmgrp->data($data)->add()){
					$data['status']=1;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}
			}
			
			
		}else{
			$cstmusrcstmgrp=M('cstmusrcstmgrp');
			//先截获数据
			$data=array(
					'f_cstmusrcstmgrp_cstmusrid'=>$_POST['f_cstmusrcstmgrp_cstmusrid'],
					'f_cstmusrcstmgrp_cstmgrpid'=>$_POST['f_cstmusrcstmgrp_cstmgrpid'],
					
			);
			if($cstmusrcstmgrp->where('f_cstmusrcstmgrp_cstmusrid='.$_POST['f_cstmusrcstmgrp_cstmusrid'].' AND f_cstmusrcstmgrp_cstmgrpid='.$_POST['f_cstmusrcstmgrp_cstmgrpid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				if($cstmusrcstmgrp->where('cstmusrcstmgrpid='.$cstmusrcstmgrpid)->setField($data)){
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
		
		$cstmusrcstmgrp=M('cstmusrcstmgrp');
		$cstmusrcstmgrpo=$cstmusrcstmgrp->where('cstmusrcstmgrpid='.$_POST['cstmusrcstmgrpid'])->find();
		$cstmusrid=$cstmusrcstmgrpo['f_cstmusrcstmgrp_cstmusrid'];
		$cstmgrpid=$cstmusrcstmgrpo['f_cstmusrcstmgrp_cstmgrpid'];
		
		
		//换了cstmgrp那么也要取消掉其在cstmgrp中的任职rl
		//先看这个cstmgrp里头有多少rl
		$cstmgrprl=M('cstmgrprl');
		$cstmgrprlls=$cstmgrprl->where('f_cstmgrprl_cstmgrpid='.$cstmgrpid)->select();//重点rlls
		$cstmusrrl=M('cstmusrrl');
		for($i=0;$i<count($cstmgrprlls);$i++){
			$cstmusrrl->where('f_cstmusrrl_cstmusrid='.$cstmusrid.' AND f_cstmusrrl_rlid='.$cstmgrprlls[$i]['f_cstmgrprl_rlid'])->delete();
		}
		
		if($cstmusrcstmgrp->delete($_POST['cstmusrcstmgrpid'])){
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