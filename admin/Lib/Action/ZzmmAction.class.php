<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class ZzmmAction extends Action{
	function gtxpg(){
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Zzmm'")->find();
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
			$zzmmid=$_GET['zzmmid'];
			$zzmm=M('zzmm');
			$mo=$zzmm->where("zzmmid=".$zzmmid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$zzmmid=$_GET['zzmmid'];
			$zzmm=M('zzmm');
			if($zzmmid==0){
				$mo['zzmmid']=0;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$zzmm->where("zzmmid=".$zzmmid)->find();
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
		$mdo=$mdII->where("mdmk='Zzmm'")->find();
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
		$zzmm=M('zzmm');
		$fldint='-zzmmid-zzmmnm-';
		$cdtint="-sp-";
		$spzzmmdtint='-sp-';////
		$odrint='-zzmmid ASC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_zzmm ON f_zzmmid=zzmmid-jn-tb_atc ON f_zzmmid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($zzmm,$fldint,$cdtint,$spzzmmdtint,$odrint,$lmtint,$jn);////

		$this->assign('fstrw',$arr['fstrw']);
		$this->assign('sqlstc',$arr['sqlstc']);
		$this->assign('fld',$arr['fld']);
		$this->assign('cdt',$arr['cdt']);
		$this->assign('spzzmmdt',$arr['spzzmmdt']);////
		$this->assign('odr',$arr['odr']);
		$this->assign('lmt',$arr['lmt']);
		$this->assign('count',$arr['count']);
		$this->assign('mls',$arr['mls']);
		$this->assign('page_method',$arr['page_method']);
		//NB初始化，结束
		
		
		
		
		//q特殊
		$this->assign('title','浏览微信列表');
		$this->assign('theme','政治面貌管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$zzmmid=$_POST['zzmmid'];
	
		if($zzmmid==0){
			$zzmm=M('zzmm');
			//先截获数据
			$data=array(
				'zzmmnm'=>$_POST['zzmmnm'],
				
			);
				
			if($zzmm->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$zzmm=M('zzmm');
			//先截获数据
			$data=array(
				'zzmmnm'=>$_POST['zzmmnm'],
				
			);
					
			if($zzmm->where('zzmmid='.$zzmmid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
			
		$std=M('std');
		$std->where('f_zzmmid='.$_POST['zzmmid'])->setField(array('f_zzmmid'=>0));
		
		$zzmm=M('zzmm');
		if($zzmm->delete($_POST['zzmmid'])){
			//$this->suzzmmess('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($zzmm->getLastSql());
		}
		
	}

}



?>