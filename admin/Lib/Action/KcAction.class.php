<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class KcAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Kc'")->find();
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
			$kcid=$_GET['kcid'];
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$kc=M($grdo['grdnm'].'_kc');
			$mo=$kc->join('tb_grd ON f_kc_grdid=grdid')->where("kcid=".$kcid)->find();
			
			//1、0是否化
			if($mo['kcsfts']==1){
				$mo['kcsfts']='是';
			}else{
				$mo['kcsfts']='否';
			}
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$kcid=$_GET['kcid'];
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$kc=M($grdo['grdnm'].'_kc');
			if($kcid==0){
				$mo['kcid']=0;
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$kc->join('tb_grd ON f_kc_grdid=grdid')->where("kcid=".$kcid)->find();
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
		$mdo=$mdII->where("mdmk='Kc'")->find();
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
		if(preg_match('/f_kc_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_kc_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
		}else{
			//默认grdid
			$grdo=$grd->order('grdid DESC')->find();
			$grdid=$grdo['grdid'];
		}
		
		$grdo=$grd->where('grdid='.$grdid)->find();
		$kc=M($grdo['grdnm'].'_kc');
		$fldint='-kcid-f_kc_grdid-grdnm-kcnm-kcsfts-';
		$cdtint="-sp-f_kc_grdid-eq-".$grdid.'-sp-';
		
		
		$spccdtint='-sp-';////
		$odrint='-kcid ASC-';
		$lmtint=20;
		$jn='tb_grd ON f_kc_grdid=grdid';
		//$jn='tb_stt ON f_kc_sttid=sttid-jn-tb_atc ON f_kc_sttid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($kc,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($u,$fldint,$cdtint,$odrint,$lmtint,$jn);
		
		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['kcsfts']==1){
				$v['kcsfts']='是';
			}else{
				$v['kcsfts']='否';
			}
			array_push($mlsfn, $v);
		}
		
		$this->assign('fstrw',$arr['fstrw']);
		$this->assign('sqlstc',$arr['sqlstc']);
		$this->assign('fld',$arr['fld']);
		$this->assign('cdt',$arr['cdt']);
		$this->assign('spccdt',$arr['spccdt']);////
		$this->assign('odr',$arr['odr']);
		$this->assign('lmt',$arr['lmt']);
		$this->assign('count',$arr['count']);
		$this->assign('mls',$mlsfn);
		$this->assign('page_method',$arr['page_method']);
		//NB初始化，结束
		
		//q特殊
		$grd=M('grd');
		$grdls=$grd->select();
		$this->assign('grdls',$grdls);
		
		//q特殊
		$this->assign('title','浏览课程列表');
		$this->assign('theme','课程管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$kcid=$_POST['kcid'];
	
		if($kcid==0){
			$grdid=$_POST['f_kc_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$kc=M($grdo['grdnm'].'_kc');
			//先截获数据
			$data=array(
				'f_kc_grdid'=>$_POST['f_kc_grdid'],
				'kcnm'=>$_POST['kcnm'],
				'kcsfts'=>$_POST['kcsfts'],
			);
			
			if($kc->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$grdid=$_POST['f_kc_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$kc=M($grdo['grdnm'].'_kc');
			//先截获数据
			
			$data=array(
				'f_kc_grdid'=>$_POST['f_kc_grdid'],
				'kcnm'=>$_POST['kcnm'],
				'kcsfts'=>$_POST['kcsfts'],
			);
			
			if($kc->where('kcid='.$kcid)->setField($data)){
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
		$kc=M($grdo['grdnm'].'_kc');
		
		$stdxqkc=M($grdo['grdnm'].'_stdxqkc');
		$stdxqkc->where('f_stdxqkc_kcid='.$_POST['kcid'])->delete();
		
		if($kc->delete($_POST['kcid'])){
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