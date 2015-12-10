<?php 

//规矩：需要display的 就mo mls 不需要的 只要uo uls 之类，方便批量移植
class MjAction extends Action{
	
	function gtxpg(){
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Mj'")->find();
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
			$mjid=$_GET['mjid'];
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$mj=M($grdo['grdnm'].'_mj');
			$mo=$mj->join('tb_grd ON f_mj_grdid=grdid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->where("mjid=".$mjid)->find();
			
			if($mo['mjbbzs']==1){
				$mo['mjbbzs']='是';
			}else{
				$mo['mjbbzs']='否';
			}
			//改变sttu的具体值
			$stt=M('stt');
			$tmp=explode('-', $mo['mjsttu']);
			$str='';
			for($i=1;$i<count($tmp)-1;$i++){
				$stto=$stt->where('sttid='.$tmp[$i])->find();
				$str=$str.$stto['sttnm'].' ';
			}
			$mo['mjsttu']=$str;		
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			
			$mjid=$_GET['mjid'];
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$mj=M($grdo['grdnm'].'_mj');
			if($mjid==0){
				$mo['mjid']=0;
				$mo['mjsttu']='-';
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				//专业的更新时间
				
				$mo=$mj->join('tb_grd ON f_mj_grdid=grdid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->where("mjid=".$mjid)->find();
				//改变sttu的具体值
				$stt=M('stt');
				$tmp=explode('-', $mo['mjsttu']);
				$ary=array();
				for($i=1;$i<count($tmp)-1;$i++){
					$stto=$stt->where('sttid='.$tmp[$i])->find();
					array_push($ary, $stto);
				}
				
				$this->assign('sttlsub',$ary);//U版本
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			
			//鉴权对用户对stt的权限，若为设置权限，说明是教务的人，可以全管，否则只能管自己函授站的 ntf为不用this assign的
			$mdII=M('md');
			$mdo=$mdII->where("mdmk='Stt'")->find();
			import('@.IDTATH.IdtathAction');
			$Idtath = new IdtathAction();
			$athofnstt=$Idtath->identify($mdo['mdid'],'ntf');
			
			$usr=M('usr');
			$usro=$usr->where('usrid='.session('usridss'))->find();
			//如果管教务和管理员
			$stt=M('stt');//新的专业必须依托在有激活的站点上
			if($athofnstt['aths']==1){
				$sttls=$stt->where('sttactvt=1')->select();
			}else{
				$sttls=$stt->where('sttid='.$usro['f_usr_sttid'])->select();
			}
			$this->assign('sttls',$sttls);
			
			//q特殊
			$grd=M('grd');
			$grdls=$grd->select();
			$this->assign('grdls',$grdls);
			
			$bxxs=M('bxxs');
			$bxxsls=$bxxs->select();
			$this->assign('bxxsls',$bxxsls);
			
			//q特殊
			$cc=M('cc');
			$ccls=$cc->select();
			$this->assign('ccls',$ccls);
				
			//q特殊
			$kl=M('kl');
			$klls=$kl->select();
			$this->assign('klls',$klls);
			//q特殊
			$xxxs=M('xxxs');
			$xxxsls=$xxxs->select();
			$this->assign('xxxsls',$xxxsls);
			//q特殊
			$zsfw=M('zsfw');
			$zsfwls=$zsfw->select();
			$this->assign('zsfwls',$zsfwls);
			//q特殊
			$xz=M('xz');
			$xzls=$xz->select();
			$this->assign('xzls',$xzls);
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
		$mdo=$mdII->where("mdmk='Mj'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$Idtath->identify($mdo['mdid'],'qry');
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		
		
		$usr=M('usr');
		$usro=$usr->where('usrid='.session('usridss'))->find();
		
		//NB初始化，开始
		$cdt=$_GET['cdt'];
		$grd=M('grd');
		if(preg_match('/f_mj_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_mj_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
		}else{
			//默认grdid
			$grdo=$grd->order('grdid DESC')->find();
			$grdid=$grdo['grdid'];
		}
		$grdo=$grd->where('grdid='.$grdid)->find();
		$mj=M($grdo['grdnm'].'_mj');
		
		$fldint='-mjid-f_mj_grdid-grdnm-bxxsnm-ccnm-klnm-xxxsnm-zsfwnm-xznm-mjdm-mjnm-mjbbzs-mjsttu-';
		
		$cdtint="-sp-f_mj_grdid-eq-".$grdid.'-sp-';
		
		$spccdtint='-sp-';////
		$odrint='-f_mj_ccid ASC-f_mj_zsfwid DESC-mjdm ASC-';
		$lmtint=20;
		$jn='tb_grd ON f_mj_grdid=grdid-jn-tb_bxxs ON f_mj_bxxsid=bxxsid-jn-tb_cc ON f_mj_ccid=ccid-jn-tb_kl ON f_mj_klid=klid-jn-tb_xxxs ON f_mj_xxxsid=xxxsid-jn-tb_zsfw ON f_mj_zsfwid=zsfwid-jn-tb_xz ON f_mj_xzid=xzid';
		
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($mj,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		
		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['mjbbzs']==1){
				$v['mjbbzs']='是';
			}else{
				$v['mjbbzs']='否';
			}
			//改变sttu的具体值
			$stt=M('stt');
			$tmp=explode('-', $v['mjsttu']);
			$str='';
			for($i=1;$i<count($tmp)-1;$i++){
				$stto=$stt->where('sttid='.$tmp[$i])->find();
				$str=$str.$stto['sttnm'].' ';
			}
			$v['mjsttu']=$str;
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
		
		$bxxs=M('bxxs');
		$bxxsls=$bxxs->select();
		$this->assign('bxxsls',$bxxsls);
		
		$cc=M('cc');
		$ccls=$cc->select();
		$this->assign('ccls',$ccls);
		
		//q特殊
		$kl=M('kl');
		$klls=$kl->select();
		$this->assign('klls',$klls);
		//q特殊
		$xxxs=M('xxxs');
		$xxxsls=$xxxs->select();
		$this->assign('xxxsls',$xxxsls);
		//q特殊
		$zsfw=M('zsfw');
		$zsfwls=$zsfw->select();
		$this->assign('zsfwls',$zsfwls);
		//q特殊
		$xz=M('xz');
		$xzls=$xz->select();
		$this->assign('xzls',$xzls);
		
		//q特殊
		$this->assign('title','浏览专业列表');
		$this->assign('theme','专业管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$mjid=$_POST['mjid'];
	
		if($mjid==0){
			$grdid=$_POST['f_mj_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$mj=M($grdo['grdnm'].'_mj');
			//先截获数据
			$data=array(
					'f_mj_grdid'=>$_POST['f_mj_grdid'],
					'f_mj_bxxsid'=>$_POST['f_mj_bxxsid'],
				'f_mj_ccid'=>$_POST['f_mj_ccid'],
				'f_mj_klid'=>$_POST['f_mj_klid'],
				'f_mj_xxxsid'=>$_POST['f_mj_xxxsid'],
				'f_mj_zsfwid'=>$_POST['f_mj_zsfwid'],
				'f_mj_xzid'=>$_POST['f_mj_xzid'],
				'mjdm'=>$_POST['mjdm'],
				'mjnm'=>$_POST['mjnm'],
				'mjdsc'=>stripslashes($_POST['mjdsc']),
					'mjbbzs'=>$_POST['mjbbzs'],
					'mjsttu'=>$_POST['mjsttu'],
			);
			
			if($mj->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$grdid=$_POST['f_mj_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$mj=M($grdo['grdnm'].'_mj');
			//先截获数据
			
			$data=array(
					'f_mj_grdid'=>$_POST['f_mj_grdid'],
					'f_mj_bxxsid'=>$_POST['f_mj_bxxsid'],
				'f_mj_ccid'=>$_POST['f_mj_ccid'],
				'f_mj_klid'=>$_POST['f_mj_klid'],
				'f_mj_xxxsid'=>$_POST['f_mj_xxxsid'],
				'f_mj_zsfwid'=>$_POST['f_mj_zsfwid'],
				'f_mj_xzid'=>$_POST['f_mj_xzid'],
				'mjdm'=>$_POST['mjdm'],
				'mjnm'=>$_POST['mjnm'],
				'mjdsc'=>stripslashes($_POST['mjdsc']),
					'mjbbzs'=>$_POST['mjbbzs'],
					'mjsttu'=>$_POST['mjsttu'],
			);
			
			if($mj->where('mjid='.$mjid)->setField($data)){
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
		$mj=M($grdo['grdnm'].'_mj');
		
		$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
		$stdxqmj->where('f_stdxqmj_mjid='.$_POST['mjid'])->delete();
		if($mj->delete($_POST['mjid'])){
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