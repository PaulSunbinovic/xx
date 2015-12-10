<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class CstmcmtAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cstmcmt'")->find();
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
			$cstmcmtid=$_GET['cstmcmtid'];
			$cstmcmt=M('cstmcmt');
			$mo=$cstmcmt->join('tb_cstmusr ON f_cstmcmt_cstmusrid=cstmusrid')->join('tb_atc ON f_cstmcmt_atcid=atcid')->where("cstmcmtid=".$cstmcmtid)->find();
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$cstmcmtid=$_GET['cstmcmtid'];
			$cstmcmt=M('cstmcmt');
			if($cstmcmtid==0){
				$mo['cstmcmttm']=date("Y-m-d H:i:s",time());
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$cstmcmt->join('tb_cstmusr ON f_cstmcmt_cstmusrid=cstmusrid')->join('tb_atc ON f_cstmcmt_atcid=atcid')->where("cstmcmtid=".$cstmcmtid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			$cstmusr=M('cstmusr');
			$this->assign('cstmusrls',$cstmusr->select());
			$atc=M('atc');
			$this->assign('atcls',$atc->select());
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
		$mdo=$mdII->where("mdmk='Cstmcmt'")->find();
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
		$cstmcmt=M('cstmcmt');
		$fldint='-cstmcmtid-cstmusrnn-atctpc-cstmcmttm-cstmcmtctt-cstmcmtzn-cstmcmttc-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='-cstmcmttm DESC-';
		$lmtint=20;
		$jn='tb_cstmusr ON f_cstmcmt_cstmusrid=cstmusrid-jn-tb_atc ON f_cstmcmt_atcid=atcid';
		//$jn='tb_cstmusr ON f_cstmcmt_cstmusrid=cstmusrid-jn-tb_atc ON f_cstmcmt_cstmusrid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($cstmcmt,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
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
		
		$atc=M('atc');
		$atcls=$atc->select();
		$this->assign('atcls',$atcls);
		
		//q特殊
		$this->assign('title','浏览权限列表');
		$this->assign('theme','权限管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmcmtid=$_POST['cstmcmtid'];
	
		if($cstmcmtid==0){
			$cstmcmt=M('cstmcmt');
			//先截获数据
			$data=array(
				'f_cstmcmt_cstmusrid'=>$_POST['f_cstmcmt_cstmusrid'],
				'f_cstmcmt_atcid'=>$_POST['f_cstmcmt_atcid'],
				'cstmcmttm'=>$_POST['cstmcmttm'],
				'cstmcmtctt'=>$_POST['cstmcmtctt'],
				'cstmcmtzn'=>$_POST['cstmcmtzn'],
				'cstmcmttc'=>$_POST['cstmcmttc'],
			);
			
			if($cstmcmt->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$cstmcmt=M('cstmcmt');
			//先截获数据
			$data=array(
				'f_cstmcmt_cstmusrid'=>$_POST['f_cstmcmt_cstmusrid'],
				'f_cstmcmt_atcid'=>$_POST['f_cstmcmt_atcid'],
				'cstmcmttm'=>$_POST['cstmcmttm'],
				'cstmcmtctt'=>$_POST['cstmcmtctt'],
				'cstmcmtzn'=>$_POST['cstmcmtzn'],
				'cstmcmttc'=>$_POST['cstmcmttc'],
			);
			
			if($cstmcmt->where('cstmcmtid='.$cstmcmtid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		
		$cstmcmt=M('cstmcmt');
		if($cstmcmt->delete($_POST['cstmcmtid'])){
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