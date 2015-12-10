<?php 

//规矩：需要display的 就m mls 不需要的 只要tcro tcrls 之类，方便批量移植
class TcrAction extends Action{
	
	
	
	function gtxpg(){
		
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		
			
		
			
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,qtcrery he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Tcr'")->find();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		
		
		
		//鉴权II
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],$x);
		
		//NTF自带鉴权功能
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		if($x=='vw'){
			$tcrid=$_GET['tcrid'];
			$tcr=M('tcr');
			$mo=$tcr->join('tb_stt ON f_tcr_sttid=sttid')->where("tcrid=".$tcrid)->find();
			
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->assign('btnvl','设置');
			$this->display('view');
		}else if($x=='updt'){
			$tcrid=$_GET['tcrid'];
			$tcr=M('tcr');
			if($tcrid==0){
				$mo['tcrid']=0;
				$mo['tcrps']=0;
				$mo['tcrpt']=C('PUBLIC').'/IMG/default.jpg';
				
				$stt=M('stt');
				$sttls=$stt->where('sttactvt=1')->select();
				$this->assign('sttls',$sttls);
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$tcr->where("tcrid=".$tcrid)->find();
				//$this->assign('nmrdol','readonly');
				
				$stt=M('stt');
				$sttls=$stt->where('sttactvt=1')->select();
				$this->assign('sttls',$sttls);
				
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			$this->display('update');
		}
		
	
	}
	
	//------------------【】【】【】【】以上是教师部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Tcr'")->find();
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
		$tcr=M('tcr');
		$fldint='-tcrid-tcrnm-tcrnn-sttnm-tcrads-tcrtlp-tcrcp-tcrml-tcrps-';
		if($athofn['aths']==1){
			$cdtint="-sp-";
		}else{
			$cdtint='-sp-tcrps-eq-1-sp-';
		}
		$spccdtint='-sp-';////
		$odrint='-tcraddtm DESC-';
		$lmtint=20;
		$jn='tb_stt ON f_tcr_sttid=sttid';
		//$jn='tb_ath ON f_tcr_athid=athid-jn-tb_atc ON f_tcr_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($tcr,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($tcr,$fldint,$cdtint,$odrint,$lmtint,$jn);

		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['tcrps']==1){
				$v['tcrps']='是';
			}else{
				$v['tcrps']='否';
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
		
		$stt=M('stt');
		$sttls=$stt->where('sttactvt=1')->select();
		$this->assign('sttls',$sttls);
		
		//q特殊
		$this->assign('title','浏览教师列表');
		$this->assign('theme','教师管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$tcrid=$_POST['tcrid'];
	
		if($tcrid==0){
			$tcr=M('tcr');
			//先截获数据
			$data=array(
				'tcrnm'=>$_POST['tcrnm'],
				'tcrnn'=>$_POST['tcrnn'],
					'f_tcr_sttid'=>$_POST['f_tcr_sttid'],
				'tcrpw'=>md5($_POST['tcrpw']),
				'tcrpt'=>$_POST['tcrpt'],
				'tcraddtm'=>date("Y-m-d H:i:s",time()),
				'tcrmdftm'=>date("Y-m-d H:i:s",time()),
					'tcrads'=>$_POST['tcrads'],
					'tcrtlp'=>$_POST['tcrtlp'],
				'tcrcp'=>$_POST['tcrcp'],
				'tcrml'=>$_POST['tcrml'],
					'tcrintr'=>stripslashes($_POST['tcrintr']),
				'tcrps'=>$_POST['tcrps'],
					
			);
			//查一查有没有同用户名教师
			if($tcr->where("tcrnm='".$data['tcrnm']."'")->find()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				if($tcr->data($data)->add()){
// 					//添加成功后给教师用上默认的分组和权限
// 					$tcro=$tcr->order('tcrid DESC')->find();
// 					$tcrgrp=M('tcrgrp');
// 					$dt=array('f_tcrgrp_tcrid'=>$tcro['tcrid'],'f_tcrgrp_grpid'=>2);
// 					$tcrgrp->data($dt)->add();
// 					//----------
// 					$tcrrl=M('tcrrl');
// 					$dt=array('f_tcrrl_tcrid'=>$tcro['tcrid'],'f_tcrrl_grpid'=>2);
// 					$tcrrl->data($dt)->add();
					
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=3;
					$this->ajaxReturn($data,'json');
				}
			}
		}else{
			$tcr=M('tcr');
			//先截获数据
			$tcro=$tcr->where('tcrid='.$tcrid)->find();
			$data=array(
				'tcrnm'=>$_POST['tcrnm'],
				'tcrnn'=>$_POST['tcrnn'],
					'f_tcr_sttid'=>$_POST['f_tcr_sttid'],
				'tcrpw'=>md5($_POST['tcrpw']),
				'tcrpt'=>$_POST['tcrpt'],
				'tcraddtm'=>date("Y-m-d H:i:s",time()),
				'tcrmdftm'=>date("Y-m-d H:i:s",time()),
					'tcrads'=>$_POST['tcrads'],
					'tcrtlp'=>$_POST['tcrtlp'],
				'tcrcp'=>$_POST['tcrcp'],
				'tcrml'=>$_POST['tcrml'],
					'tcrintr'=>stripslashes($_POST['tcrintr']),
				'tcrps'=>$_POST['tcrps'],
					'tcrvw'=>$_POST['tcrvw'],
					'tcrodr'=>$_POST['tcrodr'],
			);
			//查一查有没有同名教师
			if($tcr->where("tcrnm='".$data['tcrnm']."' AND tcrnm <>'".$tcro['tcrnm']."'")->find()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				if($tcr->where('tcrid='.$tcrid)->setField($data)){
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
		$tcrid=$_POST['tcrid'];
		
		$tcrgrp=M('tcrgrp');
		$tcrgrp->where('f_tcrgrp_tcrid='.$tcrid)->delete();
		
		$tcrrl=M('tcrrl');
		$tcrrl->where('f_tcrrl_tcrid='.$tcrid)->delete();
		
		$atcclct=M('atcclct');
		$atcclct->where('f_atcclct_tcrid='.$tcrid)->delete();
		
		$cmt=M('cmt');
		$cmt->where('f_cmt_tcrid='.$tcrid)->delete();
		
		$btn=M('btn');
		$btn->where('f_btn_tcrid='.$tcrid)->delete();
				
		$tcr=M('tcr');
		if($tcr->delete($_POST['tcrid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($tcr->getLastSql());
		}
	}
	
	function set(){
		header("Content-Type:text/html; charset=utf-8");
		$tcrid=$_POST['tcrid'];
	
	
		$tcr=M('tcr');
		//先截获数据
			
		$data=array(
				'tcrps'=>$_POST['tcrps'],
				
		);
			
		if($tcr->where('tcrid='.$tcrid)->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
		}
	
	
	}
	
	function setview(){
	
		$tcr=M('tcr');
		$data=array(
				'tcrvw'=>$_POST['tcrvw']
		);
		if($tcr->where('tcrid='.$_POST['tcrid'])->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function setpass(){
	
		$tcr=M('tcr');
		$data=array(
				'tcrps'=>$_POST['tcrps']
		);
		if($tcr->where('tcrid='.$_POST['tcrid'])->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function resetpassword(){
	
		$tcr=M('tcr');
		$data=array(
				'tcrpw'=>md5('11111111')
		);
		if($tcr->where('tcrid='.$_POST['tcrid'])->setField($data)){
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
		$mdo=$mdII->where("mdmk='Tcr'")->find();
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
		$tcr=M('tcr');
		$fldint='-tcrid-tcrnm-tcrnn-tcraddtm-tcrmdftm-tcrcp-tcrml-tcrps-tcrvw-';
		$cdtint="-sp-tcrvw-eq-0-sp-";
		
		$spccdtint='-sp-';////
		$odrint='-tcraddtm DESC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_ath ON f_tcr_athid=athid-jn-tb_atc ON f_tcr_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($tcr,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($tcr,$fldint,$cdtint,$odrint,$lmtint,$jn);

		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['tcrps']==1){
				$v['tcrps']='是';
			}else{
				$v['tcrps']='否';
			}
			if($v['tcrvw']==1){
				$v['tcrvw']='是';
			}else{
				$v['tcrvw']='否';
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
		$this->assign('title','浏览教师列表');
		$this->assign('theme','未查看教师');
	
		$this->display('notify');
	}
}



?>