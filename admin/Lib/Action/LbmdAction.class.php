<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class LbmdAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Lbmd'")->find();
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
			$lbmdid=$_GET['lbmdid'];
			$lbmd=M('lbmd');
			$mo=$lbmd->join('tb_lb ON f_lbmd_lbid=lbid')->join('tb_md ON f_lbmd_mdid=mdid')->where("lbmdid=".$lbmdid)->find();
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$lbmdid=$_GET['lbmdid'];
			$lbmd=M('lbmd');
			if($lbmdid==0){
				$mo['lbmdid']=0;
				//只提供游离的md
				$md=M('md');
				$mdlsyl=$md->join('tb_lbmd ON f_lbmd_mdid=mdid')->where('lbmdid IS NULL')->select();
				$this->assign('mdls',$mdlsyl);//游离
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$lbmd->join('tb_lb ON f_lbmd_lbid=lbid')->join('tb_md ON f_lbmd_mdid=mdid')->where("lbmdid=".$lbmdid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			$lb=M('lb');
			$this->assign('lbls',$lb->select());


			
			
			$this->display('update');
		}
	
	
	}
	
	//------------------【】【】【】【】以上是类别部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Lbmd'")->find();
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
		$lbmd=M('lbmd');
		$fldint='-lbmdid-lbnm-mdnm-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='';
		$lmtint=20;
		$jn='tb_lb ON f_lbmd_lbid=lbid-jn-tb_md ON f_lbmd_mdid=mdid';
		//$jn='tb_lb ON f_lbmd_lbid=lbid-jn-tb_atc ON f_lbmd_lbid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($lbmd,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
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
		$lb=M('lb');
		$lbls=$lb->select();
		$this->assign('lbls',$lbls);
		
		//q特殊
		$md=M('md');
		$mdls=$md->select();
		$this->assign('mdls',$mdls);
		
		
		//q特殊
		$this->assign('title','浏览类别-模块列表');
		$this->assign('theme','类别-模块管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$lbmdid=$_POST['lbmdid'];
	
		if($lbmdid==0){
			$lbmd=M('lbmd');
			//先截获数据
			$data=array(
					'f_lbmd_lbid'=>$_POST['f_lbmd_lbid'],
					'f_lbmd_mdid'=>$_POST['f_lbmd_mdid'],
					
			);
			if($lbmd->where('f_lbmd_lbid='.$_POST['f_lbmd_lbid'].' AND f_lbmd_mdid='.$_POST['f_lbmd_mdid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				if($lbmd->data($data)->add()){
					$data['status']=1;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}
			}
			
			
		}else{
			$lbmd=M('lbmd');
			//先截获数据
			$data=array(
					'f_lbmd_lbid'=>$_POST['f_lbmd_lbid'],
					'f_lbmd_mdid'=>$_POST['f_lbmd_mdid'],
					
			);
			if($lbmd->where('f_lbmd_lbid='.$_POST['f_lbmd_lbid'].' AND f_lbmd_mdid='.$_POST['f_lbmd_mdid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				if($lbmd->where('lbmdid='.$lbmdid)->setField($data)){
					$data['status']=1;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}
			}
			
		}
	}
	
	function delete(){
		
		$lbmd=M('lbmd');
		
		
		if($lbmd->delete($_POST['lbmdid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			
		}
	}

}



?>