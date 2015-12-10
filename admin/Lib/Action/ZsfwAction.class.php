<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class ZsfwAction extends Action{
	function gtxpg(){
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Zsfw'")->find();
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
			$zsfwid=$_GET['zsfwid'];
			$zsfw=M('zsfw');
			$mo=$zsfw->where("zsfwid=".$zsfwid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$zsfwid=$_GET['zsfwid'];
			$zsfw=M('zsfw');
			if($zsfwid==0){
				$mo['zsfwid']=0;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$zsfw->where("zsfwid=".$zsfwid)->find();
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
		$mdo=$mdII->where("mdmk='Zsfw'")->find();
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
		$zsfw=M('zsfw');
		$fldint='-zsfwid-zsfwnm-';
		$cdtint="-sp-";
		$spzsfwdtint='-sp-';////
		$odrint='-zsfwid ASC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_zsfw ON f_zsfwid=zsfwid-jn-tb_atc ON f_zsfwid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($zsfw,$fldint,$cdtint,$spzsfwdtint,$odrint,$lmtint,$jn);////

		$this->assign('fstrw',$arr['fstrw']);
		$this->assign('sqlstc',$arr['sqlstc']);
		$this->assign('fld',$arr['fld']);
		$this->assign('cdt',$arr['cdt']);
		$this->assign('spzsfwdt',$arr['spzsfwdt']);////
		$this->assign('odr',$arr['odr']);
		$this->assign('lmt',$arr['lmt']);
		$this->assign('count',$arr['count']);
		$this->assign('mls',$arr['mls']);
		$this->assign('page_method',$arr['page_method']);
		//NB初始化，结束
		
		
		
		
		//q特殊
		$this->assign('title','浏览招生范围列表');
		$this->assign('theme','招生范围管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$zsfwid=$_POST['zsfwid'];
	
		if($zsfwid==0){
			$zsfw=M('zsfw');
			//先截获数据
			$data=array(
				'zsfwnm'=>$_POST['zsfwnm'],
				
			);
				
			if($zsfw->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$zsfw=M('zsfw');
			//先截获数据
			$data=array(
				'zsfwnm'=>$_POST['zsfwnm'],
				
			);
					
			if($zsfw->where('zsfwid='.$zsfwid)->setField($data)){
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
// 		$std->where('f_zsfwid='.$_POST['zsfwid'])->setField(array('f_zsfwid'=>0));
		
		$mj=M('mj');
		$mj->where('f_zsfwid='.$_POST['zsfwid'])->delete();
		
		$zsfw=M('zsfw');
		if($zsfw->delete($_POST['zsfwid'])){
			//$this->suzsfwess('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($zsfw->getLastSql());
		}
		
	}

}



?>