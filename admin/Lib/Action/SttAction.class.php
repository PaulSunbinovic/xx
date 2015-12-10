<?php 

//规矩：需要display的 就mo mls 不需要的 只要uo uls 之类，方便批量移植
class SttAction extends Action{
	
	function gtxpg(){
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Stt'")->find();
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
			$sttid=$_GET['sttid'];
			$stt=M('stt');
			$mo=$stt->where("sttid=".$sttid)->find();
			
					
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			
			$sttid=$_GET['sttid'];
			$stt=M('stt');
			if($sttid==0){
				$mo['sttid']=0;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				//站点的更新时间
				
				$mo=$stt->where("sttid=".$sttid)->find();
				
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
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
		$mdo=$mdII->where("mdmk='Stt'")->find();
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
		$stt=M('stt');
		$fldint='-sttid-sttnm-sttcprt-sttads-sttrspnm-sttrsptlp-sttrspcp-sttactvt-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='-sttid ASC-';
		$lmtint=20;
		$jn='';
		
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($stt,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////

		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['sttactvt']==1){
				$v['sttactvt']='是';
			}else{
				$v['sttactvt']='否';
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
		$this->assign('title','浏览站点列表');
		$this->assign('theme','站点管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$sttid=$_POST['sttid'];
	
		if($sttid==0){
			$stt=M('stt');
			//先截获数据
			$data=array(
				'sttnm'=>$_POST['sttnm'],
				'sttcprt'=>$_POST['sttcprt'],
				'sttads'=>$_POST['sttads'],
				'sttrspnm'=>$_POST['sttrspnm'],
				'sttrsptlp'=>$_POST['sttrsptlp'],
				'sttrspcp'=>$_POST['sttrspcp'],
				'sttdsc'=>stripslashes($_POST['sttdsc']),
				'sttactvt'=>$_POST['sttactvt']
			);
			
			if($stt->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$stt=M('stt');
			//先截获数据
			
			$data=array(
				'sttnm'=>$_POST['sttnm'],
				'sttcprt'=>$_POST['sttcprt'],
				'sttads'=>$_POST['sttads'],
				'sttrspnm'=>$_POST['sttrspnm'],
				'sttrsptlp'=>$_POST['sttrsptlp'],
				'sttrspcp'=>$_POST['sttrspcp'],
				'sttdsc'=>stripslashes($_POST['sttdsc']),
				'sttactvt'=>$_POST['sttactvt']
			);
			
			if($stt->where('sttid='.$sttid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		
		$u=M('u');
		$u->where('f_sttid='.$_POST['sttid'])->setField(array('f_sttid'=>0));
		
		$zszy=M('zszy');
		$zszy->where('f_sttid='.$_POST['sttid'])->delete();
		
		$stt=M('stt');
		if($stt->delete($_POST['sttid'])){
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