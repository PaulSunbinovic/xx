<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class RlAction extends Action{
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Rl'")->find();
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
			$rlid=$_GET['rlid'];
			$rl=M('rl');
			$mo=$rl->where("rlid=".$rlid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$rlid=$_GET['rlid'];
			$rl=M('rl');
			if($rlid==0){
				$mo['rlid']=0;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$rl->where("rlid=".$rlid)->find();
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
		$mdo=$mdII->where("mdmk='Rl'")->find();
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
		$rl=M('rl');
		$fldint='-rlid-rlnm-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='-rlid ASC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_rl ON f_rlid=rlid-jn-tb_atc ON f_rlid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($rl,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////

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
		$this->assign('title','浏览权限列表');
		$this->assign('theme','权限管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$rlid=$_POST['rlid'];
	
		if($rlid==0){
			$rl=M('rl');
			//先截获数据
			$data=array(
				'rlnm'=>$_POST['rlnm'],
			);
				
			if($rl->data($data)->add()){
				

				//特殊部分，每次新建权限的时候 权限-模块 也要添加默认//即添加权限和模块都要想到ath
				//选择列表最后的一个，那个就是刚加上去的那个傻逼
				$rlo=$rl->order('rlid DESC')->find();//FIND 最上面的一个
				$ath=M('ath');
				$md=M('md');
				$mdls=$md->select();
				foreach ($mdls as $v){
					if($rlo['rlid']==1){
						$data=array(
								'f_ath_rlid'=>$rlo['rlid'],
								'f_ath_mdid'=>$v['mdid'],
								'atha'=>1,
								'athd'=>1,
								'athm'=>1,
								'athv'=>1,
								'aths'=>1
						
						);
					}else{
						$data=array(
								'f_ath_rlid'=>$rlo['rlid'],
								'f_ath_mdid'=>$v['mdid'],
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
			$rl=M('rl');
			//先截获数据
			$data=array(
				'rlnm'=>$_POST['rlnm'],
			);
					
			if($rl->where('rlid='.$rlid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		
		$rlid=$_POST['rlid'];
		
		//避免用户在grp里面挂空rl，
		//grp 和 rl 关系 1对多因此任这个rl 必然在特定的grp下面
		//1、任职rl哪些用户
		$usrrl=M('usrrl');
		$usrrlls=$usrrl->where('f_usrrl_rlid='.$rlid)->select();
		//2、这个rl职位属于哪个grp
		$grprl=M('grprl');
		$grprlo=$grprl->where('f_grprl_rlid='.$rlid)->find();
		//3、看看这些用户在此grp里头是否担任其他职务，若没有的话，离开这个职务同时也意味着和这个grp解约
		$grprllsot=$grprl->where('f_grprl_grpid='.$grprlo['f_grprl_grpid'].' AND f_grprl_rlid<>'.$rlid)->select();//得到此grp还有啥rl
		$usrgrp=M('usrgrp');
		for($i=0;$i<count($usrrlls);$i++){//重点是usr
			$hsot=0;//初始假定用户在这个grp里头没有rl了
			for($j=0;$j<count($grprllsot);$j++){//重点rl
				if($usrrl->where('f_usrrl_usrid='.$usrrlls[$i]['f_usrrl_usrid'].' AND f_usrrl_rlid='.$grprllsot[$j]['f_grprl_rlid'])->find()){
					$hsot=1;
					break;
				}
			}
			if($hsot==0){
				//说明无其他任职，退出grp
				$usrgrp->where('f_usrgrp_usrid='.$usrrlls[$i]['f_usrrl_usrid'].' AND f_usrgrp_grpid='.$grprlo['f_grprl_grpid'])->delete();
			}
		}
		
		
		$ath=M('ath');
		$ath->where('f_ath_rlid='.$rlid)->delete();
		
		$usrrl=M('usrrl');
		$usrrl->where('f_usrrl_rlid='.$rlid)->delete();
		
		$grprl=M('grprl');
		$grprl->where('f_grprl_rlid='.$rlid)->delete();
		
		$rl=M('rl');
		if($rl->delete($_POST['rlid'])){
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