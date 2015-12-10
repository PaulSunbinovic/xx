<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class AthAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Ath'")->find();
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
			$athid=$_GET['athid'];
			$ath=M('ath');
			$mo=$ath->join('tb_rl ON f_ath_rlid=rlid')->join('tb_md ON f_ath_mdid=mdid')->where("athid=".$athid)->find();
			//01是否话
			if($mo['atha']==1){
				$mo['atha']='是';
			}else{
				$mo['atha']='否';
			}
			if($mo['athd']==1){
				$mo['athd']='是';
			}else{
				$mo['athd']='否';
			}
			if($mo['athm']==1){
				$mo['athm']='是';
			}else{
				$mo['athm']='否';
			}
			if($mo['athv']==1){
				$mo['athv']='是';
			}else{
				$mo['athv']='否';
			}
			if($mo['aths']==1){
				$mo['aths']='是';
			}else{
				$mo['aths']='否';
			}
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$athid=$_GET['athid'];
			$ath=M('ath');
			if($athid==0){
				$mo['athid']=0;
				$mo['atha']=0;
				$mo['athd']=0;
				$mo['athm']=0;
				$mo['athv']=0;
				$mo['aths']=0;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$ath->join('tb_rl ON f_ath_rlid=rlid')->join('tb_md ON f_ath_mdid=mdid')->where("athid=".$athid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			$rl=M('rl');
			$this->assign('rlls',$rl->select());
			$md=M('md');
			$this->assign('mdls',$md->select());
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
		$mdo=$mdII->where("mdmk='Ath'")->find();
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
		$ath=M('ath');
		$fldint='-athid-rlnm-mdnm-atha-athd-athm-athv-aths-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='';
		$lmtint=20;
		$jn='tb_rl ON f_ath_rlid=rlid-jn-tb_md ON f_ath_mdid=mdid';
		//$jn='tb_rl ON f_ath_rlid=rlid-jn-tb_atc ON f_ath_rlid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($ath,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($u,$fldint,$cdtint,$odrint,$lmtint,$jn);
		
		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['atha']==1){
				$v['atha']='是';
			}else{
				$v['atha']='否';
			}
			if($v['athd']==1){
				$v['athd']='是';
			}else{
				$v['athd']='否';
			}
			if($v['athm']==1){
				$v['athm']='是';
			}else{
				$v['athm']='否';
			}
			if($v['athv']==1){
				$v['athv']='是';
			}else{
				$v['athv']='否';
			}
			if($v['aths']==1){
				$v['aths']='是';
			}else{
				$v['aths']='否';
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
		$rl=M('rl');
		$rlls=$rl->select();
		$this->assign('rlls',$rlls);
		
		$md=M('md');
		$mdls=$md->select();
		$this->assign('mdls',$mdls);
		
		//q特殊
		$this->assign('title','浏览权限列表');
		$this->assign('theme','权限管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$athid=$_POST['athid'];
	
		if($athid==0){
			$ath=M('ath');
			//先截获数据
			$data=array(
					'f_ath_rlid'=>$_POST['f_ath_rlid'],
					'f_ath_mdid'=>$_POST['f_ath_mdid'],
					'atha'=>$_POST['atha'],
					'athd'=>$_POST['athd'],
					'athm'=>$_POST['athm'],
					'athv'=>$_POST['athv'],
					'aths'=>$_POST['aths'],
			);
			
			if($ath->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$ath=M('ath');
			//先截获数据
			$data=array(
					'f_ath_rlid'=>$_POST['f_ath_rlid'],
					'f_ath_mdid'=>$_POST['f_ath_mdid'],
					'atha'=>$_POST['atha'],
					'athd'=>$_POST['athd'],
					'athm'=>$_POST['athm'],
					'athv'=>$_POST['athv'],
					'aths'=>$_POST['aths'],
			);
			
			if($ath->where('athid='.$athid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		
		$ath=M('ath');
		if($ath->delete($_POST['athid'])){
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