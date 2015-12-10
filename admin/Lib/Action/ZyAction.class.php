<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class ZyAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Zy'")->find();
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
			$zyid=$_GET['zyid'];
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$zy=M($grdo['grdnm'].'_zy');
			$mo=$zy->join('tb_grd ON f_zy_grdid=grdid')->where("zyid=".$zyid)->find();
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$zyid=$_GET['zyid'];
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$zy=M($grdo['grdnm'].'_zy');
			if($zyid==0){
				$mo['zyid']=0;
						
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$zy->join('tb_grd ON f_zy_grdid=grdid')->where("zyid=".$zyid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			$grd=M('grd');
			$this->assign('grdls',$grd->select());
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
		$mdo=$mdII->where("mdmk='Zy'")->find();
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
		$cdt=$_GET['cdt'];
		$grd=M('grd');
		if(preg_match('/f_zy_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_zy_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
		}else{
			//默认grdid
			$grdo=$grd->order('grdid DESC')->find();
			$grdid=$grdo['grdid'];
		}
		
		$grdo=$grd->where('grdid='.$grdid)->find();
		$zy=M($grdo['grdnm'].'_zy');
		$fldint='-zyid-f_zy_grdid-grdnm-zynm-zydmu-';
		$cdtint="-sp-f_zy_grdid-eq-".$grdid.'-sp-';
		
		$spccdtint='-sp-';////
		$odrint='-zyid ASC-';
		$lmtint=20;
		$jn='tb_grd ON f_zy_grdid=grdid';
		//$jn='tb_stt ON f_zy_sttid=sttid-jn-tb_atc ON f_zy_sttid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($zy,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
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
		$grd=M('grd');
		$grdls=$grd->select();
		$this->assign('grdls',$grdls);
		
		//q特殊
		$this->assign('title','浏览大专业列表');
		$this->assign('theme','大专业管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$zyid=$_POST['zyid'];
	
		if($zyid==0){
			$grdid=$_POST['f_zy_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$zy=M($grdo['grdnm'].'_zy');
			//先截获数据
			$data=array(
				'f_zy_sttid'=>$_POST['f_zy_sttid'],
				'f_zy_grdid'=>$_POST['f_zy_grdid'],
				'zynm'=>$_POST['zynm'],
				'zyxhprx'=>$_POST['zyxhprx'],
				'zyactvt'=>$_POST['zyactvt'],
			);
			
			if($zy->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$grdid=$_POST['f_zy_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$zy=M($grdo['grdnm'].'_zy');
			//先截获数据
			
			$data=array(
				'f_zy_sttid'=>$_POST['f_zy_sttid'],
				'f_zy_grdid'=>$_POST['f_zy_grdid'],
				'zynm'=>$_POST['zynm'],
				'zyxhprx'=>$_POST['zyxhprx'],
				'zyactvt'=>$_POST['zyactvt'],
			);
			
			if($zy->where('zyid='.$zyid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		$grdid=$_POST['grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		$zy=M($grdo['grdnm'].'_zy');
		
		$stdxqzy=M($grdo['grdnm'].'_stdxqzy');
		$stdxqzy->where('f_stdxqzy_zyid='.$_POST['zyid'])->delete();
		
		if($zy->delete($_POST['zyid'])){
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