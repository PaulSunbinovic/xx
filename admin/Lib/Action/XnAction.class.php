<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class XnAction extends Action{
	function gtxpg(){
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Xn'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$Idtath->identify($mdo['mdid'],$x);
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		if($x=='vw'){
			$xnid=$_GET['xnid'];
			$xn=M('xn');
			$mo=$xn->where("xnid=".$xnid)->find();
			if($mo['xndq']==1){
				$mo['xndq']='是';
			}else{
				$mo['xndq']='否';
			}
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$xnid=$_GET['xnid'];
			$xn=M('xn');
			if($xnid==0){
				$mo['xnid']=0;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$xn->where("xnid=".$xnid)->find();
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
		$mdo=$mdII->where("mdmk='Xn'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$Idtath->identify($mdo['mdid'],'qry');
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		//NB初始化，开始
		$xn=M('xn');
		$fldint='-xnid-xnnm-xndq-';
		$cdtint="-sp-";
		$spxndtint='-sp-';////
		$odrint='-xnid ASC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_xn ON f_xnid=xnid-jn-tb_atc ON f_xnid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($xn,$fldint,$cdtint,$spxndtint,$odrint,$lmtint,$jn);////
		
		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['xndq']==1){
				$v['xndq']='是';
			}else{
				$v['xndq']='否';
			}
			array_push($mlsfn, $v);
		}

		$this->assign('fstrw',$arr['fstrw']);
		$this->assign('sqlstc',$arr['sqlstc']);
		$this->assign('fld',$arr['fld']);
		$this->assign('cdt',$arr['cdt']);
		$this->assign('spxndt',$arr['spxndt']);////
		$this->assign('odr',$arr['odr']);
		$this->assign('lmt',$arr['lmt']);
		$this->assign('count',$arr['count']);
		$this->assign('mls',$mlsfn);
		$this->assign('page_method',$arr['page_method']);
		//NB初始化，结束
		
		
		
		
		//q特殊
		$this->assign('title','浏览学年列表');
		$this->assign('theme','学年管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$xnid=$_POST['xnid'];
	
		if($xnid==0){
			$xn=M('xn');
			//先截获数据
			$data=array(
					'xnnm'=>$_POST['xnnm'],
					'xndq'=>$_POST['xndq'],
			);
				
			if($xn->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$xn=M('xn');
			//先截获数据
			$data=array(
					'xnnm'=>$_POST['xnnm'],
					'xndq'=>$_POST['xndq'],
			);
					
			if($xn->where('xnid='.$xnid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
			
// 		$std=M('std');
// 		$std->where('f_xnid='.$_POST['xnid'])->setField(array('f_xnid'=>0));
		
		$mj=M('mj');
		$mj->where('f_xnid='.$_POST['xnid'])->delete();
		
		$xn=M('xn');
		if($xn->delete($_POST['xnid'])){
			//$this->suxness('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($xn->getLastSql());
		}
		
	}

}



?>