<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class MdAction extends Action{
	function gtxpg(){
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Md'")->find();
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
			$mdid=$_GET['mdid'];
			$md=M('md');
			$mo=$md->where("mdid=".$mdid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$mdid=$_GET['mdid'];
			$md=M('md');
			if($mdid==0){
				$mo['mdid']=0;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$md->where("mdid=".$mdid)->find();
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
		$mdo=$mdII->where("mdmk='Md'")->find();
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
		$md=M('md');
		$fldint='-mdid-mdmk-mdnm-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='-mdid ASC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_md ON f_mdid=mdid-jn-tb_atc ON f_mdid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($md,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////

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
		$this->assign('title','浏览模块列表');
		$this->assign('theme','模块管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$mdid=$_POST['mdid'];
	
		if($mdid==0){
			$md=M('md');
			//先截获数据
			$data=array(
				'mdmk'=>$_POST['mdmk'],
				'mdnm'=>$_POST['mdnm'],
			);
				
			if($md->data($data)->add()){
				
				//特殊部分，每次新建权限的时候 权限-模块 也要添加默认//即添加权限和模块都要想到ath
				//选择列表最后的一个，那个就是刚加上去的那个傻逼
				$mdo=$md->order('mdid DESC')->find();//FIND 最上面的一个
				$rl=M('rl');
				$ath=M('ath');
				$rlls=$rl->select();
				foreach ($rlls as $v){
					if($v['rlid']==1){
						$data=array(
								'f_ath_rlid'=>$v['rlid'],
								'f_ath_mdid'=>$mdo['mdid'],
								'atha'=>1,
								'athd'=>1,
								'athm'=>1,
								'athv'=>1,
								'aths'=>1
						);
					}else{
						$data=array(
								'f_ath_rlid'=>$v['rlid'],
								'f_ath_mdid'=>$mdo['mdid'],
								'atha'=>0,
								'athd'=>0,
								'athm'=>0,
								'athv'=>0,
								'aths'=>0
						);
					}
						
					$ath->data($data)->add();
				}
				
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$md=M('md');
			//先截获数据
			$data=array(
				'mdmk'=>$_POST['mdmk'],
				'mdnm'=>$_POST['mdnm'],
			);
					
			if($md->where('mdid='.$mdid)->setField($data)){
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
		$ath=M('ath');
		$ath->where('f_ath_mdid='.$_POST['mdid'])->delete();
	
		$md=M('md');
		if($md->delete($_POST['mdid'])){
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