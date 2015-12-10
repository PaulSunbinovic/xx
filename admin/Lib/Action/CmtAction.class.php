<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class CmtAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cmt'")->find();
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
			$cmtid=$_GET['cmtid'];
			$cmt=M('cmt');
			$mo=$cmt->join('tb_usr ON f_cmt_usrid=usrid')->join('tb_atc ON f_cmt_atcid=atcid')->where("cmtid=".$cmtid)->find();
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$cmtid=$_GET['cmtid'];
			$cmt=M('cmt');
			if($cmtid==0){
				$mo['cmttm']=date("Y-m-d H:i:s",time());
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$cmt->join('tb_usr ON f_cmt_usrid=usrid')->join('tb_atc ON f_cmt_atcid=atcid')->where("cmtid=".$cmtid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			$usr=M('usr');
			$this->assign('usrls',$usr->select());
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
		$mdo=$mdII->where("mdmk='Cmt'")->find();
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
		$cmt=M('cmt');
		$fldint='-cmtid-usrnn-atctpc-cmttm-cmtctt-cmtzn-cmttc-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='-cmttm DESC-';
		$lmtint=20;
		$jn='tb_usr ON f_cmt_usrid=usrid-jn-tb_atc ON f_cmt_atcid=atcid';
		//$jn='tb_usr ON f_cmt_usrid=usrid-jn-tb_atc ON f_cmt_usrid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($cmt,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
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
		$cmtid=$_POST['cmtid'];
	
		if($cmtid==0){
			$cmt=M('cmt');
			//先截获数据
			$data=array(
				'f_cmt_usrid'=>$_POST['f_cmt_usrid'],
				'f_cmt_atcid'=>$_POST['f_cmt_atcid'],
				'cmttm'=>$_POST['cmttm'],
				'cmtctt'=>$_POST['cmtctt'],
				'cmtzn'=>$_POST['cmtzn'],
				'cmttc'=>$_POST['cmttc'],
			);
			
			if($cmt->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$cmt=M('cmt');
			//先截获数据
			$data=array(
				'f_cmt_usrid'=>$_POST['f_cmt_usrid'],
				'f_cmt_atcid'=>$_POST['f_cmt_atcid'],
				'cmttm'=>$_POST['cmttm'],
				'cmtctt'=>$_POST['cmtctt'],
				'cmtzn'=>$_POST['cmtzn'],
				'cmttc'=>$_POST['cmttc'],
			);
			
			if($cmt->where('cmtid='.$cmtid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		
		$cmt=M('cmt');
		if($cmt->delete($_POST['cmtid'])){
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