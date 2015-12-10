<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class CstmathAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cstmath'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$cstmathofn=$Idtath->identify($mdo['mdid'],$x);
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		if($x=='vw'){
			$cstmathid=$_GET['cstmathid'];
			$cstmath=M('cstmath');
			$mo=$cstmath->join('tb_cstmrl ON f_cstmath_cstmrlid=cstmrlid')->join('tb_md ON f_cstmath_mdid=mdid')->where("cstmathid=".$cstmathid)->find();
			//01是否话
			if($mo['cstmatha']==1){
				$mo['cstmatha']='是';
			}else{
				$mo['cstmatha']='否';
			}
			if($mo['cstmathd']==1){
				$mo['cstmathd']='是';
			}else{
				$mo['cstmathd']='否';
			}
			if($mo['cstmathm']==1){
				$mo['cstmathm']='是';
			}else{
				$mo['cstmathm']='否';
			}
			if($mo['cstmathv']==1){
				$mo['cstmathv']='是';
			}else{
				$mo['cstmathv']='否';
			}
			if($mo['cstmaths']==1){
				$mo['cstmaths']='是';
			}else{
				$mo['cstmaths']='否';
			}
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$cstmathid=$_GET['cstmathid'];
			$cstmath=M('cstmath');
			if($cstmathid==0){
				$mo['cstmathid']=0;
				$mo['cstmatha']=0;
				$mo['cstmathd']=0;
				$mo['cstmathm']=0;
				$mo['cstmathv']=0;
				$mo['cstmaths']=0;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$cstmath->join('tb_cstmrl ON f_cstmath_cstmrlid=cstmrlid')->join('tb_md ON f_cstmath_mdid=mdid')->where("cstmathid=".$cstmathid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			$cstmrl=M('cstmrl');
			$this->assign('cstmrlls',$cstmrl->select());
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
		$mdo=$mdII->where("mdmk='Cstmath'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$cstmathofn=$Idtath->identify($mdo['mdid'],'qry');
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		//NB初始化，开始
		$cstmath=M('cstmath');
		$fldint='-cstmathid-cstmrlnm-mdnm-cstmatha-cstmathd-cstmathm-cstmathv-cstmaths-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='';
		$lmtint=20;
		$jn='tb_cstmrl ON f_cstmath_cstmrlid=cstmrlid-jn-tb_md ON f_cstmath_mdid=mdid';
		//$jn='tb_cstmrl ON f_cstmath_cstmrlid=cstmrlid-jn-tb_atc ON f_cstmath_cstmrlid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($cstmath,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($u,$fldint,$cdtint,$odrint,$lmtint,$jn);
		
		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['cstmatha']==1){
				$v['cstmatha']='是';
			}else{
				$v['cstmatha']='否';
			}
			if($v['cstmathd']==1){
				$v['cstmathd']='是';
			}else{
				$v['cstmathd']='否';
			}
			if($v['cstmathm']==1){
				$v['cstmathm']='是';
			}else{
				$v['cstmathm']='否';
			}
			if($v['cstmathv']==1){
				$v['cstmathv']='是';
			}else{
				$v['cstmathv']='否';
			}
			if($v['cstmaths']==1){
				$v['cstmaths']='是';
			}else{
				$v['cstmaths']='否';
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
		$cstmrl=M('cstmrl');
		$cstmrlls=$cstmrl->select();
		$this->assign('cstmrlls',$cstmrlls);
		
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
		$cstmathid=$_POST['cstmathid'];
	
		if($cstmathid==0){
			$cstmath=M('cstmath');
			//先截获数据
			$data=array(
					'f_cstmath_cstmrlid'=>$_POST['f_cstmath_cstmrlid'],
					'f_cstmath_mdid'=>$_POST['f_cstmath_mdid'],
					'cstmatha'=>$_POST['cstmatha'],
					'cstmathd'=>$_POST['cstmathd'],
					'cstmathm'=>$_POST['cstmathm'],
					'cstmathv'=>$_POST['cstmathv'],
					'cstmaths'=>$_POST['cstmaths'],
			);
			
			if($cstmath->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$cstmath=M('cstmath');
			//先截获数据
			$data=array(
					'f_cstmath_cstmrlid'=>$_POST['f_cstmath_cstmrlid'],
					'f_cstmath_mdid'=>$_POST['f_cstmath_mdid'],
					'cstmatha'=>$_POST['cstmatha'],
					'cstmathd'=>$_POST['cstmathd'],
					'cstmathm'=>$_POST['cstmathm'],
					'cstmathv'=>$_POST['cstmathv'],
					'cstmaths'=>$_POST['cstmaths'],
			);
			
			if($cstmath->where('cstmathid='.$cstmathid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		
		$cstmath=M('cstmath');
		if($cstmath->delete($_POST['cstmathid'])){
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