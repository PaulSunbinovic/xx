<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class UsrrlAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Usrrl'")->find();
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
			$usrrlid=$_GET['usrrlid'];
			$usrrl=M('usrrl');
			$mo=$usrrl->join('tb_usr ON f_usrrl_usrid=usrid')->join('tb_rl ON f_usrrl_rlid=rlid')->where("usrrlid=".$usrrlid)->find();
			
			$grprl=M('grprl');
			$grprlo=$grprl->join('tb_grp ON f_grprl_grpid=grpid')->where('f_grprl_rlid='.$mo['rlid'])->find();
			$mo['grpnm']=$grprlo['grpnm'];
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$usrrlid=$_GET['usrrlid'];
			$usrrl=M('usrrl');
			if($usrrlid==0){
				
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$usrrl->join('tb_usr ON f_usrrl_usrid=usrid')->join('tb_rl ON f_usrrl_rlid=rlid')->where("usrrlid=".$usrrlid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			
			
			
			import('@.TREE.TreeAction');
			$tree = new TreeAction();
			$grp=M('grp');
			$grpls=$grp->order('grpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
			$str=$tree->unlimitedForListSLCT($grpls,0,'grpid','grpnm','grppid','grpodr');
			$this->assign('tree',$str);
			
			//若grpid 有限制的话，那么rl必须是要 该相应的grp下面
			//q特殊
			$grprl=M('grprl');
			if($_GET['grpid']){
				$grpid=$_GET['grpid'];
				$grprlls=$grprl->join('tb_grp ON f_grprl_grpid=grpid')->join('tb_rl ON f_grprl_rlid=rlid')->where('grpid='.$grpid)->select();
				$this->assign('rlls',$grprlls);
			}else{
				$this->assign('rlls','');
			}
			$mo['grpid']=$grpid;
			
			$this->assign('mo',$mo);
			//q特殊
			$usrgrp=M('usrgrp');
			$usrgrpls=$usrgrp->Distinct(true)->field('usrid,usrnm')->join('tb_usr ON f_usrgrp_usrid=usrid')->join('tb_grp ON f_usrgrp_grpid=grpid')->select();
			$this->assign('usrls',$usrgrpls);
			
			$usr=M('usr');
			$usrls=$usr->join('tb_usrgrp ON usrid=f_usrgrp_usrid')->select();
			$this->assign('usrls',$usrls);
			
			$this->display('update');
		}else if($x=='add'){
			$usrrlid=$_GET['usrrlid'];
			$usrrl=M('usrrl');
			
			$this->assign('title','添加');
			$this->assign('theme','添加：');
			$this->assign('btnvl','添加');
						
			
			
			import('@.TREE.TreeAction');
			$tree = new TreeAction();
			$grp=M('grp');
			$grpls=$grp->order('grpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
			$str=$tree->unlimitedForListSLCT($grpls,0,'grpid','grpnm','grppid','grpodr');
			$this->assign('tree',$str);
			
			
			$this->assign('rlls','');
			
			
			$this->assign('mo',$mo);
			//q特殊
			$usr=M('usr');
			$usrls=$usr->join('tb_usrgrp ON usrid=f_usrgrp_usrid')->where("usrgrpid IS NULL")->select();
			$this->assign('usrls',$usrls);
			
			$this->display('add');
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
		$mdo=$mdII->where("mdmk='Usrrl'")->find();
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
		$usrrl=M('usrrl');
		$fldint='-usrrlid-usrnm-usrnn-grpid-grpnm-rlnm-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='';
		$lmtint=20;
		$jn='tb_usr ON f_usrrl_usrid=usrid-jn-tb_rl ON f_usrrl_rlid=rlid-jn-tb_grprl ON f_usrrl_rlid=f_grprl_rlid-jn-tb_grp ON f_grprl_grpid=grpid';
		//$jn='tb_usr ON f_usrrl_usrid=usrid-jn-tb_atc ON f_usrrl_usrid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($usrrl,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
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
		$usrgrp=M('usrgrp');
		$usrgrpls=$usrgrp->Distinct(true)->field('usrid,usrnm')->join('tb_usr ON f_usrgrp_usrid=usrid')->join('tb_grp ON f_usrgrp_grpid=grpid')->select();
		$this->assign('usrls',$usrgrpls);
		
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
		$grp=M('grp');
		$grpls=$grp->order('grpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
		$str=$tree->unlimitedForListSLCT($grpls,0,'grpid','grpnm','grppid','grpodr');
		$this->assign('tree',$str);
		
		
		//若grpid 有限制的话，那么rl必须是要 该相应的grp下面
		//q特殊
		$cdt=$arr['cdt'];
		$grp=M('grp');
		$where='1=1';
		if(preg_match('/grpid/',$cdt)){
			//获取该键的值
			$tmp=explode('grpid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$where=$where.' AND grpid='.$tmp[0];
		}
		$grpo=$grp->where($where)->find();
		$grprl=M('grprl');
		$grprlls=$grprl->join('tb_grp ON f_grprl_grpid=grpid')->join('tb_rl ON f_grprl_rlid=rlid')->where($where)->select();
		$this->assign('rlls',$grprlls);
		
		//q特殊
		$this->assign('title','浏览用户-角色列表');
		$this->assign('theme','用户-角色管理');
		
		$usr=M('usr');
		$usrls=$usr->join('tb_usrgrp ON usrid=f_usrgrp_usrid')->select();
		$this->assign('usrls',$usrls);
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$usrrlid=$_POST['usrrlid'];
	
		if($usrrlid==0){
			$usrrl=M('usrrl');
			//先截获数据
			$data=array(
					'f_usrrl_usrid'=>$_POST['f_usrrl_usrid'],
					'f_usrrl_rlid'=>$_POST['f_usrrl_rlid'],
					
			);
			if($usrrl->where('f_usrrl_usrid='.$_POST['f_usrrl_usrid'].' AND f_usrrl_rlid='.$_POST['f_usrrl_rlid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				//理论上可以搞，确定后，看看grp是否更换
				//添加情况下,如果之前没有就加
				$usrgrp=M('usrgrp');
				if($usrgrp->where('f_usrgrp_usrid='.$_POST['f_usrrl_usrid'].' AND f_usrgrp_grpid='.$_POST['grpid'])->find()){
					
				}else{
					$dt=array(
							'f_usrgrp_usrid'=>$_POST['f_usrrl_usrid'],
							'f_usrgrp_grpid'=>$_POST['grpid'],
					);
					$usrgrp->data($dt)->add();
				}
				
				
				if($usrrl->data($data)->add()){
					$data['status']=1;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}
			}
		}else{
			$usrrl=M('usrrl');
			//先截获数据
			$data=array(
					'f_usrrl_usrid'=>$_POST['f_usrrl_usrid'],
					'f_usrrl_rlid'=>$_POST['f_usrrl_rlid'],
					
			);
			if($usrrl->where('f_usrrl_usrid='.$_POST['f_usrrl_usrid'].' AND f_usrrl_rlid='.$_POST['f_usrrl_rlid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				
				//理论上可以搞，确定后，看看grp是否更换
				//修改//先关跳到的新地方是否已经在其grp担任神马rl了
				$usrgrp=M('usrgrp');
				if($usrgrp->where('f_usrgrp_usrid='.$_POST['f_usrrl_usrid'].' AND f_usrgrp_grpid='.$_POST['grpid'])->find()){
						
				}else{
					$dt=array(
							'f_usrgrp_usrid'=>$_POST['f_usrrl_usrid'],
							'f_usrgrp_grpid'=>$_POST['grpid'],
					);
					$usrgrp->data($dt)->add();
				}
				//再处理老东家
				//1、那这个usr是否在相应grp担任其他的rl呢？
				$usrid=$_POST['f_usrrl_usrid'];
				$rlid=$_POST['f_usrrl_rlid'];
				$grprl=M('grprl');
				$grprlo=$grprl->where('f_grprl_rlid='.$rlid)->find();//老东家grp
				//2、看看这个用户usr在此grp里头是否担任其他职务，若没有的话，离开这个职务同时也意味着和这个grp解约
				$grprllsot=$grprl->where('f_grprl_grpid='.$grprlo['f_grprl_grpid'].' AND f_grprl_rlid<>'.$rlid)->select();//得到此grp还有啥rl
				$usrgrp=M('usrgrp');
				
				$hsot=0;//初始假定用户在这个grp里头没有rl了
				for($j=0;$j<count($grprllsot);$j++){//重点rl
					if($usrrl->where('f_usrrl_usrid='.$usrid.' AND f_usrrl_rlid='.$grprllsot[$j]['f_grprl_rlid'])->find()){
						$hsot=1;
						break;
					}
				}
				if($hsot==0){
					//说明无其他任职，退出grp
					$usrgrp->where('f_usrgrp_usrid='.$usrid.' AND f_usrgrp_grpid='.$grprlo['f_grprl_grpid'])->delete();
				}
				
				
				
				$usrgrp=M('usrgrp');
				$dt=array(
						'f_usrgrp_usrid'=>$_POST['f_usrrl_usrid'],
						'f_usrgrp_grpid'=>$_POST['grpid'],
				);
				$usrgrp->data($dt)->add();
				
				if($usrrl->where('usrrlid='.$usrrlid)->setField($data)){
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
		
		$usrrl=M('usrrl');
		
		$usrrlid=$_POST['usrrlid'];
		$usrrlo=$usrrl->where('usrrlid='.$usrrlid)->find();
		$rlid=$usrrlo['f_usrrl_rlid'];
		$usrid=$usrrlo['f_usrrl_usrid'];
		
		//避免用户在grp里面挂空rl，
		
		//1、那这个usr是否在相应grp担任其他的rl呢？
		$grprl=M('grprl');
		$grprlo=$grprl->where('f_grprl_rlid='.$rlid)->find();
		//2、看看这个用户usr在此grp里头是否担任其他职务，若没有的话，离开这个职务同时也意味着和这个grp解约
		$grprllsot=$grprl->where('f_grprl_grpid='.$grprlo['f_grprl_grpid'].' AND f_grprl_rlid<>'.$rlid)->select();//得到此grp还有啥rl
		$usrgrp=M('usrgrp');
		
		$hsot=0;//初始假定用户在这个grp里头没有rl了
		for($j=0;$j<count($grprllsot);$j++){//重点rl
			if($usrrl->where('f_usrrl_usrid='.$usrid.' AND f_usrrl_rlid='.$grprllsot[$j]['f_grprl_rlid'])->find()){
				$hsot=1;
				break;
			}
		}
		if($hsot==0){
			//说明无其他任职，退出grp
			$usrgrp->where('f_usrgrp_usrid='.$usrid.' AND f_usrgrp_grpid='.$grprlo['f_grprl_grpid'])->delete();
		}
		
		
		
		if($usrrl->delete($_POST['usrrlid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function grptorl(){
		$grpid=$_POST['grpid'];
		$where='1=1';
		if($grpid!=0){
			$where=$where.' AND grpid='.$grpid;
		}
		$grprl=M('grprl');
		$grprlls=$grprl->join('tb_grp ON f_grprl_grpid=grpid')->join('tb_rl ON f_grprl_rlid=rlid')->where($where)->select();
		$str="<option value=''>无</option>";
		foreach ($grprlls as $v){
			$str=$str."<option value='".$v['rlid']."'>".$v['rlnm']."</option>";
		}
		$data['rlstr']=$str;
		
		$usrgrp=M('usrgrp');
		$usrgrpls=$usrgrp->Distinct(true)->field('usrid,usrnm')->join('tb_usr ON f_usrgrp_usrid=usrid')->join('tb_grp ON f_usrgrp_grpid=grpid')->where($where)->select();
		$str="<option value=''>无</option>";
		foreach ($usrgrpls as $v){
			$str=$str."<option value='".$v['usrid']."'>".$v['usrnm']."</option>";
		}
		$data['usrstr']=$str;
		
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}

}



?>