<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class CstmrlAction extends Action{
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cstmrl'")->find();
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
			$cstmrlid=$_GET['cstmrlid'];
			$cstmrl=M('cstmrl');
			$mo=$cstmrl->where("cstmrlid=".$cstmrlid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$cstmrlid=$_GET['cstmrlid'];
			$cstmrl=M('cstmrl');
			if($cstmrlid==0){
				$mo['cstmrlid']=0;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$cstmrl->where("cstmrlid=".$cstmrlid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			$this->display('update');
		}
	
	
	}
	
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cstmrl'")->find();
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
		$cstmrl=M('cstmrl');
		$fldint='-cstmrlid-cstmrlnm-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='-cstmrlid ASC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_cstmrl ON f_cstmrlid=cstmrlid-jn-tb_atc ON f_cstmrlid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($cstmrl,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////

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
		$this->assign('title','浏览权限列表');
		$this->assign('theme','权限管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmrlid=$_POST['cstmrlid'];
	
		if($cstmrlid==0){
			$cstmrl=M('cstmrl');
			//先截获数据
			$data=array(
				'cstmrlnm'=>$_POST['cstmrlnm'],
			);
				
			if($cstmrl->data($data)->add()){
			
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
			
			
		}else{
			$cstmrl=M('cstmrl');
			//先截获数据
			$data=array(
				'cstmrlnm'=>$_POST['cstmrlnm'],
			);
					
			if($cstmrl->where('cstmrlid='.$cstmrlid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		
		$cstmrlid=$_POST['cstmrlid'];
		
		//避免用户在grp里面挂空cstmrl，
		//grp 和 cstmrl 关系 1对多因此任这个cstmrl 必然在特定的grp下面
		//1、任职cstmrl哪些用户
		$usrcstmrl=M('usrcstmrl');
		$usrcstmrlls=$usrcstmrl->where('f_usrcstmrl_cstmrlid='.$cstmrlid)->select();
		//2、这个cstmrl职位属于哪个grp
		$grpcstmrl=M('grpcstmrl');
		$grpcstmrlo=$grpcstmrl->where('f_grpcstmrl_cstmrlid='.$cstmrlid)->find();
		//3、看看这些用户在此grp里头是否担任其他职务，若没有的话，离开这个职务同时也意味着和这个grp解约
		$grpcstmrllsot=$grpcstmrl->where('f_grpcstmrl_grpid='.$grpcstmrlo['f_grpcstmrl_grpid'].' AND f_grpcstmrl_cstmrlid<>'.$cstmrlid)->select();//得到此grp还有啥cstmrl
		$usrgrp=M('usrgrp');
		for($i=0;$i<count($usrcstmrlls);$i++){//重点是usr
			$hsot=0;//初始假定用户在这个grp里头没有cstmrl了
			for($j=0;$j<count($grpcstmrllsot);$j++){//重点cstmrl
				if($usrcstmrl->where('f_usrcstmrl_usrid='.$usrcstmrlls[$i]['f_usrcstmrl_usrid'].' AND f_usrcstmrl_cstmrlid='.$grpcstmrllsot[$j]['f_grpcstmrl_cstmrlid'])->find()){
					$hsot=1;
					break;
				}
			}
			if($hsot==0){
				//说明无其他任职，退出grp
				$usrgrp->where('f_usrgrp_usrid='.$usrcstmrlls[$i]['f_usrcstmrl_usrid'].' AND f_usrgrp_grpid='.$grpcstmrlo['f_grpcstmrl_grpid'])->delete();
			}
		}
		
		
		$ath=M('ath');
		$ath->where('f_ath_cstmrlid='.$cstmrlid)->delete();
		
		$usrcstmrl=M('usrcstmrl');
		$usrcstmrl->where('f_usrcstmrl_cstmrlid='.$cstmrlid)->delete();
		
		$grpcstmrl=M('grpcstmrl');
		$grpcstmrl->where('f_grpcstmrl_cstmrlid='.$cstmrlid)->delete();
		
		$cstmrl=M('cstmrl');
		if($cstmrl->delete($_POST['cstmrlid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
		
		
	}

}



?>