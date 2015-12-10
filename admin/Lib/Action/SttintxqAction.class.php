<?php 

//规矩：需要display的 就m mls 不需要的 只要sttintxqo sttintxqls 之类，方便批量移植
class SttintxqAction extends Action{
	
	
	
	function gtxpg(){
		
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
			
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,qsttintxqery he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Sttintxq'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],$x);
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		
		//NTF自带鉴权功能
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		if($x=='vw'){
			$sttintxqid=$_GET['sttintxqid'];
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$sttintxq=M($grdo['grdnm'].'_sttintxq');
			$mo=$sttintxq->join('tb_grd ON f_sttintxq_grdid=grdid')->join('tb_stt ON f_sttintxq_sttid=sttid')->join('tb_xq ON f_sttintxq_xqid=xqid')->where("sttintxqid=".$sttintxqid)->find();
			
			if($mo['sttintxqyes']==1){
				$mo['sttintxqyes']='是';
			}else{
				$mo['sttintxqyes']='否';
			}
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->assign('btnvl','设置');
			$this->display('view');
		}else if($x=='updt'){
			$sttintxqid=$_GET['sttintxqid'];
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$sttintxq=M($grdo['grdnm'].'_sttintxq');
			if($sttintxqid==0){
				$mo['sttintxqid']=0;
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$sttintxq->where("sttintxqid=".$sttintxqid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			$stt=M('stt');
			$sttls=$stt->where('sttactvt=1')->select();
			$this->assign('sttls',$sttls);
			
			$xq=M('xq');
			$xqls=$xq->order('xqnm DESC')->select();
			$this->assign('xqls',$xqls);
			
			//q特殊
			$grd=M('grd');
			$grdls=$grd->order('grdnm DESC')->select();
			$this->assign('grdls',$grdls);
			
			$this->display('update');
		}
		
	
	}
	
	//------------------【】【】【】【】以上是站点首学期设置部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Sttintxq'")->find();
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
		$cdt=$_GET['cdt'];
		$grd=M('grd');
		if(preg_match('/f_sttintxq_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_sttintxq_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
		}else{
			//默认grdid
			$grdo=$grd->order('grdid DESC')->find();
			$grdid=$grdo['grdid'];
		}
		$grdo=$grd->where('grdid='.$grdid)->find();
		$sttintxq=M($grdo['grdnm'].'_sttintxq');
		$fldint='-sttintxqid-f_sttintxq_grdid-grdnm-sttnm-xqnm-sttintxqyes-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='-';
		$lmtint=20;
		$jn='tb_grd ON f_sttintxq_grdid=grdid-jn-tb_stt ON f_sttintxq_sttid=sttid-jn-tb_xq ON f_sttintxq_xqid=xqid';
		//$jn='tb_ath ON f_sttintxq_athid=athid-jn-tb_atc ON f_sttintxq_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($sttintxq,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($sttintxq,$fldint,$cdtint,$odrint,$lmtint,$jn);
		
		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['sttintxqyes']==1){
				$v['sttintxqyes']='是';
			}else{
				$v['sttintxqyes']='否';
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
		
		$stt=M('stt');
		$sttls=$stt->where('sttactvt=1')->select();
		$this->assign('sttls',$sttls);
		
		$xq=M('xq');
		$xqls=$xq->order('xqnm DESC')->select();
		$this->assign('xqls',$xqls);
		
		//q特殊
		$grd=M('grd');
		$grdls=$grd->order('grdnm DESC')->select();
		$this->assign('grdls',$grdls);
		
		//q特殊
		$this->assign('title','浏览站点首学期设置列表');
		$this->assign('theme','站点首学期设置管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$sttintxqid=$_POST['sttintxqid'];
	
		if($sttintxqid==0){
			$grdid=$_POST['f_sttintxq_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$sttintxq=M($grdo['grdnm'].'_sttintxq');
			//先截获数据
			$data=array(
				'f_sttintxq_grdid'=>$_POST['f_sttintxq_grdid'],
				'f_sttintxq_sttid'=>$_POST['f_sttintxq_sttid'],
				'f_sttintxq_xqid'=>$_POST['f_sttintxq_xqid'],
				'sttintxqyes'=>$_POST['sttintxqyes']
			);
			if($sttintxq->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
		}else{
			$grdid=$_POST['f_sttintxq_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$sttintxq=M($grdo['grdnm'].'_sttintxq');
			//先截获数据
			
			$data=array(
				'f_sttintxq_grdid'=>$_POST['f_sttintxq_grdid'],
				'f_sttintxq_sttid'=>$_POST['f_sttintxq_sttid'],
				'f_sttintxq_xqid'=>$_POST['f_sttintxq_xqid'],
				'sttintxqyes'=>$_POST['sttintxqyes']
			);
			
			if($sttintxq->where('sttintxqid='.$sttintxqid)->setField($data)){
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
		$sttintxq=M($grdo['grdnm'].'_sttintxq');
		
		if($sttintxq->delete($_POST['sttintxqid'])){
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