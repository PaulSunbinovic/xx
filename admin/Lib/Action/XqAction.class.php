<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class XqAction extends Action{
	function gtxpg(){
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Xq'")->find();
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
			$xqid=$_GET['xqid'];
			$xq=M('xq');
			$mo=$xq->where("xqid=".$xqid)->find();
			if($mo['xqdq']==1){
				$mo['xqdq']='是';
			}else{
				$mo['xqdq']='否';
			}
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$xqid=$_GET['xqid'];
			$xq=M('xq');
			if($xqid==0){
				$mo['xqid']=0;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$xq->where("xqid=".$xqid)->find();
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
		$mdo=$mdII->where("mdmk='Xq'")->find();
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
		$xq=M('xq');
		$fldint='-xqid-xqnm-xqdq-';
		$cdtint="-sp-";
		$spxqdtint='-sp-';////
		$odrint='-xqid ASC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_xq ON f_xqid=xqid-jn-tb_atc ON f_xqid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($xq,$fldint,$cdtint,$spxqdtint,$odrint,$lmtint,$jn);////
		
		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['xqdq']==1){
				$v['xqdq']='是';
			}else{
				$v['xqdq']='否';
			}
			array_push($mlsfn, $v);
		}

		$this->assign('fstrw',$arr['fstrw']);
		$this->assign('sqlstc',$arr['sqlstc']);
		$this->assign('fld',$arr['fld']);
		$this->assign('cdt',$arr['cdt']);
		$this->assign('spxqdt',$arr['spxqdt']);////
		$this->assign('odr',$arr['odr']);
		$this->assign('lmt',$arr['lmt']);
		$this->assign('count',$arr['count']);
		$this->assign('mls',$mlsfn);
		$this->assign('page_method',$arr['page_method']);
		//NB初始化，结束
		
		
		
		
		//q特殊
		$this->assign('title','浏览学期列表');
		$this->assign('theme','学期管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$xqid=$_POST['xqid'];
	
		if($xqid==0){
			$xq=M('xq');
			//先截获数据
			$data=array(
					'xqnm'=>$_POST['xqnm'],
					'xqdq'=>$_POST['xqdq'],
			);
				
			if($xq->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$xq=M('xq');
			//先截获数据
			$data=array(
					'xqnm'=>$_POST['xqnm'],
					'xqdq'=>$_POST['xqdq'],
			);
					
			if($xq->where('xqid='.$xqid)->setField($data)){
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
// 		$std->where('f_xqid='.$_POST['xqid'])->setField(array('f_xqid'=>0));
		
		$mj=M('mj');
		$mj->where('f_xqid='.$_POST['xqid'])->delete();
		
		$xq=M('xq');
		if($xq->delete($_POST['xqid'])){
			//$this->suxqess('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($xq->getLastSql());
		}
		
	}

}



?>