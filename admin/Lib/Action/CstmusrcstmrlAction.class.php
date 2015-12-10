<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class CstmusrcstmrlAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cstmusrcstmrl'")->find();
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
			$cstmusrcstmrlid=$_GET['cstmusrcstmrlid'];
			$cstmusrcstmrl=M('cstmusrcstmrl');
			$mo=$cstmusrcstmrl->join('tb_cstmusr ON f_cstmusrcstmrl_cstmusrid=cstmusrid')->join('tb_cstmrl ON f_cstmusrcstmrl_cstmrlid=cstmrlid')->where("cstmusrcstmrlid=".$cstmusrcstmrlid)->find();
			
			$cstmgrpcstmrl=M('cstmgrpcstmrl');
			$cstmgrpcstmrlo=$cstmgrpcstmrl->join('tb_cstmgrp ON f_cstmgrpcstmrl_cstmgrpid=cstmgrpid')->where('f_cstmgrpcstmrl_cstmrlid='.$mo['cstmrlid'])->find();
			$mo['cstmgrpnm']=$cstmgrpcstmrlo['cstmgrpnm'];
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$cstmusrcstmrlid=$_GET['cstmusrcstmrlid'];
			$cstmusrcstmrl=M('cstmusrcstmrl');
			if($cstmusrcstmrlid==0){
				
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$cstmusrcstmrl->join('tb_cstmusr ON f_cstmusrcstmrl_cstmusrid=cstmusrid')->join('tb_cstmrl ON f_cstmusrcstmrl_cstmrlid=cstmrlid')->where("cstmusrcstmrlid=".$cstmusrcstmrlid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			
			
			
			import('@.TREE.TreeAction');
			$tree = new TreeAction();
			$cstmgrp=M('cstmgrp');
			$cstmgrpls=$cstmgrp->order('cstmgrpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
			$str=$tree->unlimitedForListSLCT($cstmgrpls,0,'cstmgrpid','cstmgrpnm','cstmgrppid','cstmgrpodr');
			$this->assign('tree',$str);
			
			//若cstmgrpid 有限制的话，那么cstmrl必须是要 该相应的cstmgrp下面
			//q特殊
			$cstmgrpcstmrl=M('cstmgrpcstmrl');
			if($_GET['cstmgrpid']){
				$cstmgrpid=$_GET['cstmgrpid'];
				$cstmgrpcstmrlls=$cstmgrpcstmrl->join('tb_cstmgrp ON f_cstmgrpcstmrl_cstmgrpid=cstmgrpid')->join('tb_cstmrl ON f_cstmgrpcstmrl_cstmrlid=cstmrlid')->where('cstmgrpid='.$cstmgrpid)->select();
				$this->assign('cstmrlls',$cstmgrpcstmrlls);
			}else{
				$this->assign('cstmrlls','');
			}
			$mo['cstmgrpid']=$cstmgrpid;
			
			$this->assign('mo',$mo);
			//q特殊
			$cstmusrcstmgrp=M('cstmusrcstmgrp');
			$cstmusrcstmgrpls=$cstmusrcstmgrp->Distinct(true)->field('cstmusrid,cstmusrnm')->join('tb_cstmusr ON f_cstmusrcstmgrp_cstmusrid=cstmusrid')->join('tb_cstmgrp ON f_cstmusrcstmgrp_cstmgrpid=cstmgrpid')->select();
			$this->assign('cstmusrls',$cstmusrcstmgrpls);
			
			$cstmusr=M('cstmusr');
			$cstmsucstmrls=$cstmusr->join('tb_cstmusrcstmgrp ON cstmusrid=f_cstmusrcstmgrp_cstmusrid')->select();
			$this->assign('cstmusrls',$cstmsucstmrls);
			
			$this->display('update');
		}else if($x=='add'){
			$cstmusrcstmrlid=$_GET['cstmusrcstmrlid'];
			$cstmusrcstmrl=M('cstmusrcstmrl');
			
			$this->assign('title','添加');
			$this->assign('theme','添加：');
			$this->assign('btnvl','添加');
						
			
			
			import('@.TREE.TreeAction');
			$tree = new TreeAction();
			$cstmgrp=M('cstmgrp');
			$cstmgrpls=$cstmgrp->order('cstmgrpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
			$str=$tree->unlimitedForListSLCT($cstmgrpls,0,'cstmgrpid','cstmgrpnm','cstmgrppid','cstmgrpodr');
			$this->assign('tree',$str);
			
			
			$this->assign('cstmrlls','');
			
			
			$this->assign('mo',$mo);
			//q特殊
			$cstmusr=M('cstmusr');
			$cstmsucstmrls=$cstmusr->join('tb_cstmusrcstmgrp ON cstmusrid=f_cstmusrcstmgrp_cstmusrid')->where("cstmusrcstmgrpid IS NULL")->select();
			$this->assign('cstmusrls',$cstmsucstmrls);
			
			$this->display('add');
		}
	
	
	}
	
	//------------------【】【】【】【】以上是客户用户部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cstmusrcstmrl'")->find();
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
		$cstmusrcstmrl=M('cstmusrcstmrl');
		$fldint='-cstmusrcstmrlid-cstmusrnm-cstmusrnn-cstmgrpid-cstmgrpnm-cstmrlnm-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='';
		$lmtint=20;
		$jn='tb_cstmusr ON f_cstmusrcstmrl_cstmusrid=cstmusrid-jn-tb_cstmrl ON f_cstmusrcstmrl_cstmrlid=cstmrlid-jn-tb_cstmgrpcstmrl ON f_cstmusrcstmrl_cstmrlid=f_cstmgrpcstmrl_cstmrlid-jn-tb_cstmgrp ON f_cstmgrpcstmrl_cstmgrpid=cstmgrpid';
		//$jn='tb_cstmusr ON f_cstmusrcstmrl_cstmusrid=cstmusrid-jn-tb_atc ON f_cstmusrcstmrl_cstmusrid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($cstmusrcstmrl,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
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
		$cstmusrcstmgrp=M('cstmusrcstmgrp');
		$cstmusrcstmgrpls=$cstmusrcstmgrp->Distinct(true)->field('cstmusrid,cstmusrnm')->join('tb_cstmusr ON f_cstmusrcstmgrp_cstmusrid=cstmusrid')->join('tb_cstmgrp ON f_cstmusrcstmgrp_cstmgrpid=cstmgrpid')->select();
		$this->assign('cstmusrls',$cstmusrcstmgrpls);
		
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
		$cstmgrp=M('cstmgrp');
		$cstmgrpls=$cstmgrp->order('cstmgrpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
		$str=$tree->unlimitedForListSLCT($cstmgrpls,0,'cstmgrpid','cstmgrpnm','cstmgrppid','cstmgrpodr');
		$this->assign('tree',$str);
		
		
		//若cstmgrpid 有限制的话，那么cstmrl必须是要 该相应的cstmgrp下面
		//q特殊
		$cdt=$arr['cdt'];
		$cstmgrp=M('cstmgrp');
		$where='1=1';
		if(preg_match('/cstmgrpid/',$cdt)){
			//获取该键的值
			$tmp=explode('cstmgrpid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$where=$where.' AND cstmgrpid='.$tmp[0];
		}
		$cstmgrpo=$cstmgrp->where($where)->find();
		$cstmgrpcstmrl=M('cstmgrpcstmrl');
		$cstmgrpcstmrlls=$cstmgrpcstmrl->join('tb_cstmgrp ON f_cstmgrpcstmrl_cstmgrpid=cstmgrpid')->join('tb_cstmrl ON f_cstmgrpcstmrl_cstmrlid=cstmrlid')->where($where)->select();
		$this->assign('cstmrlls',$cstmgrpcstmrlls);
		
		$cstmusr=M('cstmusr');
		$cstmsucstmrls=$cstmusr->join('tb_cstmusrcstmgrp ON cstmusrid=f_cstmusrcstmgrp_cstmusrid')->select();
		$this->assign('cstmusrls',$cstmsucstmrls);
		
		//q特殊
		$this->assign('title','浏览客户用户-客户角色列表');
		$this->assign('theme','客户用户-客户角色管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmusrcstmrlid=$_POST['cstmusrcstmrlid'];
	
		if($cstmusrcstmrlid==0){
			$cstmusrcstmrl=M('cstmusrcstmrl');
			//先截获数据
			$data=array(
					'f_cstmusrcstmrl_cstmusrid'=>$_POST['f_cstmusrcstmrl_cstmusrid'],
					'f_cstmusrcstmrl_cstmrlid'=>$_POST['f_cstmusrcstmrl_cstmrlid'],
					
			);
			if($cstmusrcstmrl->where('f_cstmusrcstmrl_cstmusrid='.$_POST['f_cstmusrcstmrl_cstmusrid'].' AND f_cstmusrcstmrl_cstmrlid='.$_POST['f_cstmusrcstmrl_cstmrlid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				//理论上可以搞，确定后，看看cstmgrp是否更换
				//添加情况下,如果之前没有就加
				$cstmusrcstmgrp=M('cstmusrcstmgrp');
				if($cstmusrcstmgrp->where('f_cstmusrcstmgrp_cstmusrid='.$_POST['f_cstmusrcstmrl_cstmusrid'].' AND f_cstmusrcstmgrp_cstmgrpid='.$_POST['cstmgrpid'])->find()){
					
				}else{
					$dt=array(
							'f_cstmusrcstmgrp_cstmusrid'=>$_POST['f_cstmusrcstmrl_cstmusrid'],
							'f_cstmusrcstmgrp_cstmgrpid'=>$_POST['cstmgrpid'],
					);
					$cstmusrcstmgrp->data($dt)->add();
				}
				
				
				if($cstmusrcstmrl->data($data)->add()){
					$data['status']=1;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}
			}
		}else{
			$cstmusrcstmrl=M('cstmusrcstmrl');
			//先截获数据
			$data=array(
					'f_cstmusrcstmrl_cstmusrid'=>$_POST['f_cstmusrcstmrl_cstmusrid'],
					'f_cstmusrcstmrl_cstmrlid'=>$_POST['f_cstmusrcstmrl_cstmrlid'],
					
			);
			if($cstmusrcstmrl->where('f_cstmusrcstmrl_cstmusrid='.$_POST['f_cstmusrcstmrl_cstmusrid'].' AND f_cstmusrcstmrl_cstmrlid='.$_POST['f_cstmusrcstmrl_cstmrlid'])->find()){
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}else{
				
				//理论上可以搞，确定后，看看cstmgrp是否更换
				//修改//先关跳到的新地方是否已经在其cstmgrp担任神马cstmrl了
				$cstmusrcstmgrp=M('cstmusrcstmgrp');
				if($cstmusrcstmgrp->where('f_cstmusrcstmgrp_cstmusrid='.$_POST['f_cstmusrcstmrl_cstmusrid'].' AND f_cstmusrcstmgrp_cstmgrpid='.$_POST['cstmgrpid'])->find()){
						
				}else{
					$dt=array(
							'f_cstmusrcstmgrp_cstmusrid'=>$_POST['f_cstmusrcstmrl_cstmusrid'],
							'f_cstmusrcstmgrp_cstmgrpid'=>$_POST['cstmgrpid'],
					);
					$cstmusrcstmgrp->data($dt)->add();
				}
				//再处理老东家
				//1、那这个cstmusr是否在相应cstmgrp担任其他的cstmrl呢？
				$cstmusrid=$_POST['f_cstmusrcstmrl_cstmusrid'];
				$cstmrlid=$_POST['f_cstmusrcstmrl_cstmrlid'];
				$cstmgrpcstmrl=M('cstmgrpcstmrl');
				$cstmgrpcstmrlo=$cstmgrpcstmrl->where('f_cstmgrpcstmrl_cstmrlid='.$cstmrlid)->find();//老东家cstmgrp
				//2、看看这个客户用户cstmusr在此cstmgrp里头是否担任其他职务，若没有的话，离开这个职务同时也意味着和这个cstmgrp解约
				$cstmgrpcstmrllsot=$cstmgrpcstmrl->where('f_cstmgrpcstmrl_cstmgrpid='.$cstmgrpcstmrlo['f_cstmgrpcstmrl_cstmgrpid'].' AND f_cstmgrpcstmrl_cstmrlid<>'.$cstmrlid)->select();//得到此cstmgrp还有啥cstmrl
				$cstmusrcstmgrp=M('cstmusrcstmgrp');
				
				$hsot=0;//初始假定客户用户在这个cstmgrp里头没有cstmrl了
				for($j=0;$j<count($cstmgrpcstmrllsot);$j++){//重点cstmrl
					if($cstmusrcstmrl->where('f_cstmusrcstmrl_cstmusrid='.$cstmusrid.' AND f_cstmusrcstmrl_cstmrlid='.$cstmgrpcstmrllsot[$j]['f_cstmgrpcstmrl_cstmrlid'])->find()){
						$hsot=1;
						break;
					}
				}
				if($hsot==0){
					//说明无其他任职，退出cstmgrp
					$cstmusrcstmgrp->where('f_cstmusrcstmgrp_cstmusrid='.$cstmusrid.' AND f_cstmusrcstmgrp_cstmgrpid='.$cstmgrpcstmrlo['f_cstmgrpcstmrl_cstmgrpid'])->delete();
				}
				
				
				
				$cstmusrcstmgrp=M('cstmusrcstmgrp');
				$dt=array(
						'f_cstmusrcstmgrp_cstmusrid'=>$_POST['f_cstmusrcstmrl_cstmusrid'],
						'f_cstmusrcstmgrp_cstmgrpid'=>$_POST['cstmgrpid'],
				);
				$cstmusrcstmgrp->data($dt)->add();
				
				if($cstmusrcstmrl->where('cstmusrcstmrlid='.$cstmusrcstmrlid)->setField($data)){
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
		
		$cstmusrcstmrl=M('cstmusrcstmrl');
		
		$cstmusrcstmrlid=$_POST['cstmusrcstmrlid'];
		$cstmusrcstmrlo=$cstmusrcstmrl->where('cstmusrcstmrlid='.$cstmusrcstmrlid)->find();
		$cstmrlid=$cstmusrcstmrlo['f_cstmusrcstmrl_cstmrlid'];
		$cstmusrid=$cstmusrcstmrlo['f_cstmusrcstmrl_cstmusrid'];
		
		//避免客户用户在cstmgrp里面挂空cstmrl，
		
		//1、那这个cstmusr是否在相应cstmgrp担任其他的cstmrl呢？
		$cstmgrpcstmrl=M('cstmgrpcstmrl');
		$cstmgrpcstmrlo=$cstmgrpcstmrl->where('f_cstmgrpcstmrl_cstmrlid='.$cstmrlid)->find();
		//2、看看这个客户用户cstmusr在此cstmgrp里头是否担任其他职务，若没有的话，离开这个职务同时也意味着和这个cstmgrp解约
		$cstmgrpcstmrllsot=$cstmgrpcstmrl->where('f_cstmgrpcstmrl_cstmgrpid='.$cstmgrpcstmrlo['f_cstmgrpcstmrl_cstmgrpid'].' AND f_cstmgrpcstmrl_cstmrlid<>'.$cstmrlid)->select();//得到此cstmgrp还有啥cstmrl
		$cstmusrcstmgrp=M('cstmusrcstmgrp');
		
		$hsot=0;//初始假定客户用户在这个cstmgrp里头没有cstmrl了
		for($j=0;$j<count($cstmgrpcstmrllsot);$j++){//重点cstmrl
			if($cstmusrcstmrl->where('f_cstmusrcstmrl_cstmusrid='.$cstmusrid.' AND f_cstmusrcstmrl_cstmrlid='.$cstmgrpcstmrllsot[$j]['f_cstmgrpcstmrl_cstmrlid'])->find()){
				$hsot=1;
				break;
			}
		}
		if($hsot==0){
			//说明无其他任职，退出cstmgrp
			$cstmusrcstmgrp->where('f_cstmusrcstmgrp_cstmusrid='.$cstmusrid.' AND f_cstmusrcstmgrp_cstmgrpid='.$cstmgrpcstmrlo['f_cstmgrpcstmrl_cstmgrpid'])->delete();
		}
		
		
		
		if($cstmusrcstmrl->delete($_POST['cstmusrcstmrlid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function cstmgrptocstmrl(){
		$cstmgrpid=$_POST['cstmgrpid'];
		$where='1=1';
		if($cstmgrpid!=0){
			$where=$where.' AND cstmgrpid='.$cstmgrpid;
		}
		$cstmgrpcstmrl=M('cstmgrpcstmrl');
		$cstmgrpcstmrlls=$cstmgrpcstmrl->join('tb_cstmgrp ON f_cstmgrpcstmrl_cstmgrpid=cstmgrpid')->join('tb_cstmrl ON f_cstmgrpcstmrl_cstmrlid=cstmrlid')->where($where)->select();
		$str="<option value=''>无</option>";
		foreach ($cstmgrpcstmrlls as $v){
			$str=$str."<option value='".$v['cstmrlid']."'>".$v['cstmrlnm']."</option>";
		}
		$data['cstmrlstr']=$str;
		
		$cstmusrcstmgrp=M('cstmusrcstmgrp');
		$cstmusrcstmgrpls=$cstmusrcstmgrp->Distinct(true)->field('cstmusrid,cstmusrnm')->join('tb_cstmusr ON f_cstmusrcstmgrp_cstmusrid=cstmusrid')->join('tb_cstmgrp ON f_cstmusrcstmgrp_cstmgrpid=cstmgrpid')->where($where)->select();
		$str="<option value=''>无</option>";
		foreach ($cstmusrcstmgrpls as $v){
			$str=$str."<option value='".$v['cstmusrid']."'>".$v['cstmusrnm']."</option>";
		}
		$data['cstmusrstr']=$str;
		
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}

}



?>