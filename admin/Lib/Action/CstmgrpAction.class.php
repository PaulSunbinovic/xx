<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class CstmgrpAction extends Action{
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cstmgrp'")->find();
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
			$cstmgrpid=$_GET['cstmgrpid'];
			$cstmgrp=M('cstmgrp');
			$mo=$cstmgrp->where("cstmgrpid=".$cstmgrpid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$cstmgrpid=$_GET['id'];
			$cstmgrp=M('cstmgrp');
			if($cstmgrpid==0){
				$mo['cstmgrpid']=0;
				$mo['cstmgrppid']=$_GET['pid'];
				$mo['cstmgrpodr']=$_GET['odr'];
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$cstmgrp->where("cstmgrpid=".$cstmgrpid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			$this->display('update');
		}else if($x=='edit'){
			header("Content-Type:text/html; charset=utf-8");
			
			import('@.TREE.TreeAction');
			$tree = new TreeAction();
			$cstmgrp=M('cstmgrp');
			$cstmgrpls=$cstmgrp->order('cstmgrpodr ASC')->select();//在按照这个顺序前提下，总体永远是1在上2在下
			
			$str=$tree->unlimitedForListPlus($cstmgrpls,0,'cstmgrpid','cstmgrpnm','cstmgrppid','cstmgrpodr',__URL__,'Cstmgrp');
			$strpos=$tree->unlimitedForListMv($cstmgrpls,0,'cstmgrpid','cstmgrpnm','cstmgrppid','cstmgrpodr');
			//p($str);die;
			//q特殊
			$this->assign('tree',$str);
			$this->assign('treepos',$strpos);
			$this->assign('title','浏览客户团队列表（编辑模式）');
			$this->assign('theme','客户团队管理（编辑模式）');
			
			$this->display('edit');
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
		$mdo=$mdII->where("mdmk='Cstmgrp'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],'qry');
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();

		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
		$cstmgrp=M('cstmgrp');
		$cstmgrpls=$cstmgrp->order('cstmgrpodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
		
		$str=$tree->unlimitedForList($cstmgrpls,0,'cstmgrpid','cstmgrpnm','cstmgrppid','cstmgrpodr');
		$this->assign('tree',$str);
		
		$this->assign('title','浏览客户团队列表');
		$this->assign('theme','客户团队管理');

		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmgrpid=$_POST['cstmgrpid'];
	
		if($cstmgrpid==0){
			$cstmgrp=M('cstmgrp');
			//先截获数据
			$data=array(
				'cstmgrpnm'=>$_POST['cstmgrpnm'],
				'cstmgrppid'=>$_POST['cstmgrppid'],
				'cstmgrpodr'=>$_POST['cstmgrpodr'],
			);
					
			if($cstmgrp->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$cstmgrp=M('cstmgrp');
			//先截获数据
			
			$data=array(
				'cstmgrpnm'=>$_POST['cstmgrpnm'],
				'cstmgrppid'=>$_POST['cstmgrppid'],
				'cstmgrpodr'=>$_POST['cstmgrpodr'],
			);
			
			
			if($cstmgrp->where('cstmgrpid='.$cstmgrpid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function move(){
		$pid=$_POST['pid'];
		$pos=$_POST['pos'];
		$id=$_POST['id'];
		$cstmgrp=M('cstmgrp');
		$cstmgrpim=$cstmgrp->where('cstmgrpid='.$id)->find();
		
		//先排序新家
		$newcstmgrphm=$cstmgrp->where('cstmgrppid='.$pid)->order('cstmgrpodr ASC')->select();//新家
		//先确定原著从哪个位置开始往下挪动一位，给新人留下控件
		$postrue=$pos+1;
		//先让原著居民相关的居民移位
		for($i=$postrue;$i<=count($newcstmgrphm);$i++){//18115806374 15722796181
			$cstmgrpid=$newcstmgrphm[$i-1]['cstmgrpid'];
			$dataorg=array(
				'cstmgrpodr'=>$newcstmgrphm[$i-1]['cstmgrpodr']+1
			);
			$cstmgrp->where('cstmgrpid='.$cstmgrpid)->setField($dataorg);
		}
		//迁入移民
		$dataim=array(
			'cstmgrppid'=>$pid,
			'cstmgrpodr'=>$postrue,
		);
		$cstmgrp->where('cstmgrpid='.$id)->setField($dataim);
		
		
		//再排序老家
		$cstmgrpold=$cstmgrp->where('cstmgrppid='.$cstmgrpim['cstmgrppid'])->order('cstmgrpodr ASC')->select();
		for($i=0;$i<count($cstmgrpold);$i++){
			$dataold=array(
				'cstmgrpodr'=>$i+1
			);
			$cstmgrp->where('cstmgrpid='.$cstmgrpold[$i]['cstmgrpid'])->setField($dataold);
		}
		$data['status']=1;
		$this->ajaxReturn($data,'json');
		
	}
	
	function delete(){
		//先找出要删除的所有ID，然后一个个删
		$cstmgrpid=$_POST['cstmgrpid'];
		
		$cstmgrp=M('cstmgrp');
		$cstmgrpls=$cstmgrp->order('cstmgrpodr ASC')->select();
		
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
		//找他的子嗣
		$sons=$tree->unlimitedForListID($cstmgrpls, $cstmgrpid, 'cstmgrpid', 'cstmgrpnm', 'cstmgrppid', 'cstmgrpodr');
		$cstmgrpidu='-'.$cstmgrpid.'-'.$sons;
		$epldcstmgrpidu=explode('-', $cstmgrpidu);
		for($i=1;$i<count($epldcstmgrpidu)-1;$i++){
			
			//通过cstmgrp建立的usr-rl 关系也应该不复存在
			//有多少员工usrs
			$usrcstmgrp=M('usrcstmgrp');
			$usrcstmgrpls=$usrcstmgrp->where('f_usrcstmgrp_cstmgrpid='.$epldcstmgrpidu[$i])->select();//重点在usrs
			//下头有多少岗位rl
			$cstmgrprl=M('cstmgrprl');
			$cstmgrprlls=$cstmgrprl->where('f_cstmgrprl_cstmgrpid='.$epldcstmgrpidu[$i])->select();//重点在rls
			//管他三七二十一删删删
			$usrrl=M('usrrl');
			for($i=0;$i<count($usrcstmgrpls);$i++){
				for($j=0;$j<count($cstmgrprlls);$j++){
					$usrrl->where('f_usrrl_usrid='.$usrcstmgrpls[$i]['f_usrcstmgrp_usrid'].' AND f_usrrl_rlid='.$cstmgrprlls[$j]['f_cstmgrprl_rlid'])->delete();
				}
			}
			
			
			$usrcstmgrp=M('usrcstmgrp');
			$usrcstmgrp->where('f_usrcstmgrp_cstmgrpid='.$epldcstmgrpidu[$i])->delete();
			
			$cstmgrprl=M('cstmgrprl');
			$cstmgrprl->where('f_cstmgrprl_cstmgrpid='.$epldcstmgrpidu[$i])->delete();
			
			if($cstmgrp->delete($epldcstmgrpidu[$i])){
				//$this->success('删除成功');
				$data['status']=1;
			}else{
				$data['status']=2;
				//$this->error($u->getLastSql());
			}
			
		}
		$this->ajaxReturn($data,'json');
		
	}

}



?>