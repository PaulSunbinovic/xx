<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class BdAction extends Action{
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Bd'")->find();
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
			$bdid=$_GET['bdid'];
			$bd=M('bd');
			$mo=$bd->where("bdid=".$bdid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$bdid=$_GET['id'];
			$bd=M('bd');
			if($bdid==0){
				$mo['bdid']=0;
				$mo['bdpid']=$_GET['pid'];
				$mo['bdodr']=$_GET['odr'];
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$bd->where("bdid=".$bdid)->find();
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
			$bd=M('bd');
			$bdls=$bd->order('bdodr ASC')->select();//在按照这个顺序前提下，总体永远是1在上2在下
			
			$str=$tree->unlimitedForListPlus($bdls,0,'bdid','bdnm','bdpid','bdodr',__URL__,'Bd');
			$strpos=$tree->unlimitedForListMv($bdls,0,'bdid','bdnm','bdpid','bdodr');
			//p($str);die;
			//q特殊
			$this->assign('tree',$str);
			$this->assign('treepos',$strpos);
			$this->assign('title','浏览板块列表（编辑模式）');
			$this->assign('theme','板块管理（编辑模式）');
			
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
		$mdo=$mdII->where("mdmk='Bd'")->find();
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
		$bd=M('bd');
		$bdls=$bd->order('bdodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
		
		$str=$tree->unlimitedForList($bdls,0,'bdid','bdnm','bdpid','bdodr');
		$this->assign('tree',$str);
		
		$this->assign('title','浏览板块列表');
		$this->assign('theme','板块管理');

		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$bdid=$_POST['bdid'];
	
		if($bdid==0){
			$bd=M('bd');
			//先截获数据
			$data=array(
				'bdnm'=>$_POST['bdnm'],
				'bdpid'=>$_POST['bdpid'],
				'bdodr'=>$_POST['bdodr'],
			);
					
			if($bd->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$bd=M('bd');
			//先截获数据
			
			$data=array(
				'bdnm'=>$_POST['bdnm'],
				'bdpid'=>$_POST['bdpid'],
				'bdodr'=>$_POST['bdodr'],
			);
			
			
			if($bd->where('bdid='.$bdid)->setField($data)){
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
		$bd=M('bd');
		$bdim=$bd->where('bdid='.$id)->find();
		
		//先排序新家
		$newbdhm=$bd->where('bdpid='.$pid)->order('bdodr ASC')->select();//新家
		//先确定原著从哪个位置开始往下挪动一位，给新人留下控件
		$postrue=$pos+1;
		//先让原著居民相关的居民移位
		for($i=$postrue;$i<=count($newbdhm);$i++){//18115806374 15722796181
			$bdid=$newbdhm[$i-1]['bdid'];
			$dataorg=array(
				'bdodr'=>$newbdhm[$i-1]['bdodr']+1
			);
			$bd->where('bdid='.$bdid)->setField($dataorg);
		}
		//迁入移民
		$dataim=array(
			'bdpid'=>$pid,
			'bdodr'=>$postrue,
		);
		$bd->where('bdid='.$id)->setField($dataim);
		
		
		//再排序老家
		$bdold=$bd->where('bdpid='.$bdim['bdpid'])->order('bdodr ASC')->select();
		for($i=0;$i<count($bdold);$i++){
			$dataold=array(
				'bdodr'=>$i+1
			);
			$bd->where('bdid='.$bdold[$i]['bdid'])->setField($dataold);
		}
		$data['status']=1;
		$this->ajaxReturn($data,'json');
		
	}
	
	function delete(){
		//先找出要删除的所有ID，然后一个个删
		$bdid=$_POST['bdid'];
		
		$bd=M('bd');
		
		///
		$bdo=$bd->where('bdid='.$bdid)->find();
		$bdpid=$bdo['bdpid'];
		
		$bdls=$bd->order('bdodr ASC')->select();
		
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
		//找他的子嗣
		$sons=$tree->unlimitedForListID($bdls, $bdid, 'bdid', 'bdnm', 'bdpid', 'bdodr');
		$bdidu='-'.$bdid.'-'.$sons;
		$epldbdidu=explode('-', $bdidu);
		for($i=1;$i<count($epldbdidu)-1;$i++){
			//删除板块自然删除板块中的文章
			$atc=M('atc');
			$atcls=$atc->where('f_atc_bdid='.$epldbdidu[$i])->select();
			foreach($atcls as $v){
				$atcid=$v['atcid'];
				//用户评论//cstm评论//用户收藏//cstm收藏
				$cmt=M('cmt');
				$cmt->where('f_cmt_atcid='.$atcid)->delete();
				$cstmcmt=M('cstmcmt');
				$cstmcmt->where('f_cstmcmt_atcid='.$atcid)->delete();
				$atcclct=M('atcclct');
				$atcclct->where('f_atcclct_atcid='.$atcid)->delete();
				$cstmatcclct=M('cstmatcclct');
				$cstmatcclct->where('f_cstmatcclct_atcid='.$atcid)->delete();
			}
			
			$atc->where('f_atc_bdid='.$epldbdidu[$i])->delete();
			if($bd->delete($epldbdidu[$i])){
				//$this->success('删除成功');
				$data['status']=1;
			}else{
				$data['status']=2;
				//$this->error($u->getLastSql());
			}
			
		}
		///给剩下的进行排序//子孙们都删光光了，也只要对自己或者的弟兄排序就行了
		$bdls=$bd->where('bdpid='.$bdpid)->order('bdodr ASC')->select();
		for($i=0;$i<count($bdls);$i++){
			$dt=array('bdodr'=>$i+1);
			$bd->where('bdid='.$bdls[$i]['bdid'])->setField($dt);
		}
		$this->ajaxReturn($data,'json');
		
	}

}



?>