<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class LbAction extends Action{
	function gtxpg(){
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Lb'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$lbmdofn=$Idtath->identify($mdo['mdid'],$x);
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		if($x=='vw'){
			$lbid=$_GET['lbid'];
			$lb=M('lb');
			$mo=$lb->where("lbid=".$lbid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$lbid=$_GET['lbid'];
			$lb=M('lb');
			if($lbid==0){
				$mo['lbid']=0;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$lb->where("lbid=".$lbid)->find();
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
		$mdo=$mdII->where("mdmk='Lb'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$lbmdofn=$Idtath->identify($mdo['mdid'],'qry');
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		//NB初始化，开始
		$lb=M('lb');
		$fldint='-lbid-lbnm-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='-lbid ASC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_lb ON f_lbid=lbid-jn-tb_atc ON f_lbid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($lb,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////

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
		$this->assign('title','浏览类别列表');
		$this->assign('theme','类别管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$lbid=$_POST['lbid'];
	
		if($lbid==0){
			$lb=M('lb');
			//先截获数据
			$data=array(
				'lbnm'=>$_POST['lbnm'],
			);
				
			if($lb->data($data)->add()){
				
				
				
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$lb=M('lb');
			//先截获数据
			$data=array(
				'lbnm'=>$_POST['lbnm'],
			);
					
			if($lb->where('lbid='.$lbid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		//关系逻辑表中 删除了这个那么所有相关的都要删  主题逻辑表里删除了这个其他都要置零
		$lbmd=M('lbmd');
		$lbmd->where('f_lbmd_lbid='.$_POST['lbid'])->delete();
		
		$btn=M('btn');
		$btn->where("btnnm='bs".$_POST['lbid']."'")->delete();
		
		$lb=M('lb');
		if($lb->delete($_POST['lbid'])){
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