<?php 

//规矩：需要display的 就m mls 不需要的 只要cstmusro cstmusrls 之类，方便批量移植
class CstmusrAction extends Action{
	

	
	function gtxpg(){
		
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,qcstmusrery he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cstmusr'")->find();
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
			$cstmusrid=$_GET['cstmusrid'];
			$cstmusr=M('cstmusr');
			$mo=$cstmusr->where("cstmusrid=".$cstmusrid)->find();
			
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->assign('btnvl','设置');
			$this->display('view');
		}else if($x=='updt'){
			$cstmusrid=$_GET['cstmusrid'];
			$cstmusr=M('cstmusr');
			if($cstmusrid==0){
				$mo['cstmusrvw']=1;
				$mo['cstmusrps']=1;
				$mo['cstmusrid']=0;
				$mo['cstmusrpt']=C('PUBLIC').'/IMG/default.jpg';
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$cstmusr->where("cstmusrid=".$cstmusrid)->find();
				$this->assign('nmrdol','readonly');
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
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
		$mdo=$mdII->where("mdmk='Cstmusr'")->find();
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
		$cstmusr=M('cstmusr');
		$fldint='-cstmusrid-cstmusrnm-cstmusrnn-cstmusraddtm-cstmusrmdftm-cstmusrcp-cstmusrml-cstmusrps-cstmusrvw-';
		if($athofn['aths']==1){
			$cdtint="-sp-";
		}else{
			$cdtint='-sp-cstmusrps-eq-1-sp-cstmusrvw-eq-1-sp-';
		}
		$spccdtint='-sp-';////
		$odrint='-cstmusraddtm DESC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_ath ON f_cstmusr_athid=athid-jn-tb_atc ON f_cstmusr_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($cstmusr,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($cstmusr,$fldint,$cdtint,$odrint,$lmtint,$jn);

		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['cstmusrps']==1){
				$v['cstmusrps']='是';
			}else{
				$v['cstmusrps']='否';
			}
			if($v['cstmusrvw']==1){
				$v['cstmusrvw']='是';
			}else{
				$v['cstmusrvw']='否';
			}
			array_push($mlsfn, $v);
		}
		
		$this->assign('fstrw',$arr['fstrw']);
		$this->assign('sqlstc',$arr['sqlstc']);
		$this->assign('fld',$arr['fld']);
		$this->assign('cdt',$arr['cdt']);
		$this->assign('spccdt',$arr['spccdt']);////
		$this->assign('odr',$arr['odr']);
		$this->assign('lmt',$arr['lmt']);
		$this->assign('count',$arr['count']);
		$this->assign('mls',$mlsfn);
		$this->assign('page_method',$arr['page_method']);
		//NB初始化，结束
		
			
		
		//q特殊
		$this->assign('title','浏览客户用户列表');
		$this->assign('theme','客户用户管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmusrid=$_POST['cstmusrid'];
	
		if($cstmusrid==0){
			$cstmusr=M('cstmusr');
			//先截获数据
			$data=array(
				'cstmusrnm'=>$_POST['cstmusrnm'],
				'cstmusrnn'=>$_POST['cstmusrnn'],
				'cstmusrpw'=>md5($_POST['cstmusrpw']),
				'cstmusrpt'=>$_POST['cstmusrpt'],
				'cstmusraddtm'=>date("Y-m-d H:i:s",time()),
				'cstmusrmdftm'=>date("Y-m-d H:i:s",time()),
				'cstmusrcp'=>$_POST['cstmusrcp'],
				'cstmusrml'=>$_POST['cstmusrml'],
				'cstmusrps'=>$_POST['cstmusrps'],
					'cstmusrvw'=>$_POST['cstmusrvw']
			);
			//查一查有没有同名客户用户
			if($cstmusr->where("cstmusrnm='".$data['cstmusrnm']."'")->find()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				if($cstmusr->data($data)->add()){
				//给他和cstmgrp关系加一条和cstmrl关系也加一条
				$cstmusro=$cstmusr->order('cstmusrid DESC')->find();
				
				$cstmusrcstmgrp=M('cstmusrcstmgrp');
				$dt=array('f_cstmusrcstmgrp_cstmusrid'=>$cstmusro['cstmusrid'],'f_cstmusrcstmgrp_cstmgrpid'=>1);
				$cstmusrcstmgrp->data($dt)->add();
				
				$cstmusrcstmrl=M('cstmusrcstmrl');
				$dt=array('f_cstmusrcstmrl_cstmusrid'=>$cstmusro['cstmusrid'],'f_cstmusrcstmrl_cstmrlid'=>1);
				$cstmusrcstmrl->data($dt)->add();
					
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=3;
					$this->ajaxReturn($data,'json');
				}
			}
		}else{
			$cstmusr=M('cstmusr');
			//先截获数据
			$cstmusro=$cstmusr->where('cstmusrid='.$cstmusrid)->find();
			$data=array(
				'cstmusrnm'=>$_POST['cstmusrnm'],
				'cstmusrnn'=>$_POST['cstmusrnn'],
				
				'cstmusrpt'=>$_POST['cstmusrpt'],
				'cstmusrmdftm'=>date("Y-m-d H:i:s",time()),
				'cstmusrcp'=>$_POST['cstmusrcp'],
				'cstmusrml'=>$_POST['cstmusrml'],
				'cstmusrps'=>$_POST['cstmusrps'],
					'cstmusrvw'=>$_POST['cstmusrvw']
			);
			//查一查有没有同名客户用户
			if($cstmusr->where("cstmusrnm='".$data['cstmusrnm']."' AND cstmusrnm <>'".$cstmusro['cstmusrnm']."'")->find()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				if($cstmusr->where('cstmusrid='.$cstmusrid)->setField($data)){
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=3;
					$this->ajaxReturn($data,'json');
				}
			}
		}
	}
	
	function delete(){
		$cstmusrid=$_POST['cstmusrid'];
		
		$cstmusrcstmgrp=M('cstmusrcstmgrp');
		$cstmusrcstmgrp->where('f_cstmusrcstmgrp_cstmusrid='.$cstmusrid)->delete();
		
		$cstmusrcstmrl=M('cstmusrcstmrl');
		$cstmusrcstmrl->where('f_cstmusrcstmrl_cstmusrid='.$cstmusrid)->delete();
		
		$cstmatcclct=M('cstmatcclct');
		$cstmatcclct->where('f_cstmatcclct_cstmusrid='.$cstmusrid)->delete();
		
		$cstmcmt=M('cstmcmt');
		$cstmcmt->where('f_cstmcmt_cstmusrid='.$cstmusrid)->delete();
		
		$cstmbtn=M('cstmbtn');
		$cstmbtn->where('f_cstmbtn_cstmusrid='.$cstmusrid)->delete();
		
		$cstmusr=M('cstmusr');
		if($cstmusr->delete($_POST['cstmusrid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($cstmusr->getLastSql());
		}
	}
	
	function set(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmusrid=$_POST['cstmusrid'];
	
	
		$cstmusr=M('cstmusr');
		//先截获数据
			
		$data=array(
				'cstmusrps'=>$_POST['cstmusrps'],
				'cstmusrvw'=>$_POST['cstmusrvw'],
		);
			
		if($cstmusr->where('cstmusrid='.$cstmusrid)->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
		}
	
	
	}
	
	function setview(){
	
		$cstmusr=M('cstmusr');
		$data=array(
				'cstmusrvw'=>$_POST['cstmusrvw']
		);
		if($cstmusr->where('cstmusrid='.$_POST['cstmusrid'])->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function setpass(){
	
		$cstmusr=M('cstmusr');
		$data=array(
				'cstmusrps'=>$_POST['cstmusrps']
		);
		if($cstmusr->where('cstmusrid='.$_POST['cstmusrid'])->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	

	function resetpassword(){
	
		$cstmusr=M('cstmusr');
		$data=array(
				'cstmusrpw'=>md5('11111111')
		);
		if($cstmusr->where('cstmusrid='.$_POST['cstmusrid'])->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function notify(){
		header("Content-Type:text/html; charset=utf-8");
	
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cstmusr'")->find();
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
		$cstmusr=M('cstmusr');
		$fldint='-cstmusrid-cstmusrnm-cstmusrnn-cstmusraddtm-cstmusrmdftm-cstmusrcp-cstmusrml-cstmusrps-cstmusrvw-';
		$cdtint="-sp-cstmusrvw-eq-0-sp-";
		
		$spccdtint='-sp-';////
		$odrint='-cstmusraddtm DESC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_ath ON f_cstmusr_athid=athid-jn-tb_atc ON f_cstmusr_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($cstmusr,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($cstmusr,$fldint,$cdtint,$odrint,$lmtint,$jn);

		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['cstmusrps']==1){
				$v['cstmusrps']='是';
			}else{
				$v['cstmusrps']='否';
			}
			if($v['cstmusrvw']==1){
				$v['cstmusrvw']='是';
			}else{
				$v['cstmusrvw']='否';
			}
			array_push($mlsfn, $v);
		}
		$this->assign('fstrw',$arr['fstrw']);
		$this->assign('sqlstc',$arr['sqlstc']);
		$this->assign('fld',$arr['fld']);
		$this->assign('cdt',$arr['cdt']);
		$this->assign('spccdt',$arr['spccdt']);////
		$this->assign('odr',$arr['odr']);
		$this->assign('lmt',$arr['lmt']);
		$this->assign('count',$arr['count']);
		$this->assign('mls',$mlsfn);
		$this->assign('page_method',$arr['page_method']);
		//NB初始化，结束
	
	
	
		//q特殊
		$this->assign('title','浏览客户用户列表');
		$this->assign('theme','未查看客户用户');
	
		$this->display('notify');
	}
}



?>