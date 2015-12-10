<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class XfAction extends Action{
	
	
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Xf'")->find();
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
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
				
			$xfid=$_GET['xfid'];
			$xf=M($grdo['grdnm'].'_xf');
			$mo=$xf->join('tb_grd ON f_xf_grdid=grdid')->join('tb_stt ON f_xf_sttid=sttid')->join('tb_bxxs ON f_xf_bxxsid=bxxsid')->join('tb_cc ON f_xf_ccid=ccid')->join('tb_kl ON f_xf_klid=klid')->where("xfid=".$xfid)->find();
			
			$this->assign('mo',$mo);
			
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
				
			$xfid=$_GET['xfid'];
			$xf=M($grdo['grdnm'].'_xf');
			if($xfid==0){
				//默认年级是当前年级
				$grd=M('grd');
				$grdo=$grd->order('grdnm DESC')->find();
				$grdid=$grdo['grdid'];
				$mo['f_xf_grdid']=$grdid;
				
				$mo['f_xf_sttid']=1;
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$xf->join('tb_grd ON f_xf_grdid=grdid')->join('tb_stt ON f_xf_sttid=sttid')->join('tb_bxxs ON f_xf_bxxsid=bxxsid')->join('tb_cc ON f_xf_ccid=ccid')->join('tb_kl ON f_xf_klid=klid')->where("xfid=".$xfid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
		
				
			
			//q特殊
			$grd=M('grd');
			$grdls=$grd->order('grdnm DESC')->select();
			$this->assign('grdls',$grdls);
			
			//q特殊
			$stt=M('stt');
			$sttls=$stt->select();
			$this->assign('sttls',$sttls);
			
			//q特殊
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
			
			
			$this->display('update');
		}
		
	
	}
	
	//------------------【】【】【】【】以上是学费部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Xf'")->find();
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
		if(preg_match('/f_xf_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_xf_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
		}else{
			//默认grdid
			$grdo=$grd->order('grdid DESC')->find();
			$grdid=$grdo['grdid'];
		}
		$grdo=$grd->where('grdid='.$grdid)->find();
		$xf=M($grdo['grdnm'].'_xf');
		$fldint='-xfid-grdnm-sttnm-bxxsnm-ccnm-klnm-xfsm-jckwfsm-';
		
		$cdtint="-sp-f_xf_grdid-eq-".$grdo['grdid']."-sp-f_xf_sttid-eq-1-sp-";
		$spccdtint='-sp-';////
		$odrint='-';
		$lmtint=20;
		$jn='tb_grd ON f_xf_grdid=grdid-jn-tb_stt ON f_xf_sttid=sttid-jn-tb_bxxs ON f_xf_bxxsid=bxxsid-jn-tb_cc ON f_xf_ccid=ccid-jn-tb_kl ON f_xf_klid=klid';
		//$jn='tb_ath ON f_xf_athid=athid-jn-tb_atc ON f_xf_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($xf,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		
		
		
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
		//p($arr['mls']);die;
		
		//q特殊
		$grd=M('grd');
		$grdls=$grd->order('grdnm DESC')->select();
		$this->assign('grdls',$grdls);
		
		//q特殊
		$stt=M('stt');
		$sttls=$stt->select();
		$this->assign('sttls',$sttls);
		
		//q特殊
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
		$this->assign('title','浏览学费列表');
		$this->assign('theme','学费管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$xfid=$_POST['xfid'];
	
		if($xfid==0){
			
			$grdid=$_POST['f_xf_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$xf=M($grdo['grdnm'].'_xf');
							
			
			//先截获数据
			$data=array(
					'f_xf_grdid'=>$_POST['f_xf_grdid'],
					'f_xf_sttid'=>$_POST['f_xf_sttid'],
					'f_xf_bxxsid'=>$_POST['f_xf_bxxsid'],
					'f_xf_ccid'=>$_POST['f_xf_ccid'],
					'f_xf_klid'=>$_POST['f_xf_klid'],
					'xfsm'=>$_POST['xfsm'],
					'jckwfsm'=>$_POST['jckwfsm'],
			);
			
			if($xf->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$grdid=$_POST['f_xf_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$xf=M($grdo['grdnm'].'_xf');
			
			//先截获数据
			$data=array(
					'f_xf_grdid'=>$_POST['f_xf_grdid'],
					'f_xf_sttid'=>$_POST['f_xf_sttid'],
					'f_xf_bxxsid'=>$_POST['f_xf_bxxsid'],
					'f_xf_ccid'=>$_POST['f_xf_ccid'],
					'f_xf_klid'=>$_POST['f_xf_klid'],
					'xfsm'=>$_POST['xfsm'],
					'jckwfsm'=>$_POST['jckwfsm'],
			);
			if($xf->where('xfid='.$xfid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		
				
		$xf=M('xf');
		if($xf->delete($_POST['xfid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($xf->getLastSql());
		}
	}
	
	
	
}



?>