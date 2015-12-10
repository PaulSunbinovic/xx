<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class XxxsAction extends Action{
	function gtxpg(){
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Xxxs'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$Idtath->identify($mdo['mdid'],$x);
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		if($x=='vw'){
			$xxxsid=$_GET['xxxsid'];
			$xxxs=M('xxxs');
			$mo=$xxxs->where("xxxsid=".$xxxsid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$xxxsid=$_GET['xxxsid'];
			$xxxs=M('xxxs');
			if($xxxsid==0){
				$mo['xxxsid']=0;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$xxxs->where("xxxsid=".$xxxsid)->find();
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
		$mdo=$mdII->where("mdmk='Xxxs'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$Idtath->identify($mdo['mdid'],'qry');
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		//NB初始化，开始
		$xxxs=M('xxxs');
		$fldint='-xxxsid-xxxsnm-';
		$cdtint="-sp-";
		$spxxxsdtint='-sp-';////
		$odrint='-xxxsid ASC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_xxxs ON f_xxxsid=xxxsid-jn-tb_atc ON f_xxxsid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($xxxs,$fldint,$cdtint,$spxxxsdtint,$odrint,$lmtint,$jn);////

		$this->assign('fstrw',$arr['fstrw']);
		$this->assign('sqlstc',$arr['sqlstc']);
		$this->assign('fld',$arr['fld']);
		$this->assign('cdt',$arr['cdt']);
		$this->assign('spxxxsdt',$arr['spxxxsdt']);////
		$this->assign('odr',$arr['odr']);
		$this->assign('lmt',$arr['lmt']);
		$this->assign('count',$arr['count']);
		$this->assign('mls',$arr['mls']);
		$this->assign('page_method',$arr['page_method']);
		//NB初始化，结束
		
		
		
		
		//q特殊
		$this->assign('title','浏览学习形式列表');
		$this->assign('theme','学习形式管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$xxxsid=$_POST['xxxsid'];
	
		if($xxxsid==0){
			$xxxs=M('xxxs');
			//先截获数据
			$data=array(
				'xxxsnm'=>$_POST['xxxsnm'],
				
			);
				
			if($xxxs->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$xxxs=M('xxxs');
			//先截获数据
			$data=array(
				'xxxsnm'=>$_POST['xxxsnm'],
				
			);
					
			if($xxxs->where('xxxsid='.$xxxsid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
			
// 		$std=M('std');
// 		$std->where('f_xxxsid='.$_POST['xxxsid'])->setField(array('f_xxxsid'=>0));
		
		$mj=M('mj');
		$mj->where('f_xxxsid='.$_POST['xxxsid'])->delete();
		
		$xxxs=M('xxxs');
		if($xxxs->delete($_POST['xxxsid'])){
			//$this->suxxxsess('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($xxxs->getLastSql());
		}
		
	}

}



?>