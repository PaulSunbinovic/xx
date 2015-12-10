<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class BzrAction extends Action{
	
	
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Bzr'")->find();
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
				
			$bzrid=$_GET['bzrid'];
			$bzr=M($grdo['grdnm'].'_bzr');
			$mo=$bzr->join('tb_grd ON f_bzr_grdid=grdid')->join('tb_usr ON f_bzr_usrid=usrid')->join('tb_stt ON f_usr_sttid=sttid')->join('tb_'.$grdo['grdnm'].'_cls ON f_bzr_clsid=clsid')->where("bzrid=".$bzrid)->find();
			if($mo['clsactvt']==1){
				$mo['clsactvt']='是';
			}else{
				$mo['clsactvt']='否';
			}
			
			$this->assign('mo',$mo);
			
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
				
			$bzrid=$_GET['bzrid'];
			$bzr=M($grdo['grdnm'].'_bzr');
			if($bzrid==0){
				//默认年级是当前年级
				$grd=M('grd');
				$grdo=$grd->order('grdnm DESC')->find();
				$grdid=$grdo['grdid'];
				$mo['f_bzr_grdid']=$grdid;
				
				$mo['f_usr_sttid']=1;
				
				$mo['clsactvt']=1;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$bzr->join('tb_grd ON f_bzr_grdid=grdid')->join('tb_usr ON f_bzr_usrid=usrid')->join('tb_stt ON f_usr_sttid=sttid')->join('tb_'.$grdo['grdnm'].'_cls ON f_bzr_clsid=clsid')->where("bzrid=".$bzrid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			//q特殊
			$grd=M('grd');
			$grdls=$grd->select();
			$this->assign('grdls',$grdls);
				
			
			//q特殊
			$stt=M('stt');
			$sttls=$stt->select();
			$this->assign('sttls',$sttls);
			
			
			//q特殊
			$rl=M('rl');
			$rlo=$rl->where("rlnm LIKE '%班主任%'")->find();
			$usrrl=M('usrrl');
			$usrrlls=$usrrl->join('tb_usr ON f_usrrl_usrid=usrid')->join('tb_stt ON f_usr_sttid=sttid')->where('f_usr_sttid='.$mo['f_usr_sttid'].' AND f_usrrl_rlid='.$rlo['rlid'])->order('usrnm ASC')->select();
			$this->assign('usrls',$usrrlls);
				
			
			//q特殊
			$cls=M($grdo['grdnm'].'_cls');
			$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where('f_cls_sttid='.$mo['f_usr_sttid'])->order('clsnm ASC')->select();
			$this->assign('clsls',$clsls);
			
			
			$this->display('update');
		}
		
	
	}
	
	//------------------【】【】【】【】以上是班主任部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Bzr'")->find();
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
		if(preg_match('/f_bzr_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_bzr_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
		}else{
			//默认grdid
			$grdo=$grd->order('grdid DESC')->find();
			$grdid=$grdo['grdid'];
		}
		$grdo=$grd->where('grdid='.$grdid)->find();
		$bzr=M($grdo['grdnm'].'_bzr');
		$fldint='-bzrid-f_bzr_grdid-grdnm-sttnm-usrnn-clsnm-clsactvt-';
		
		$cdtint="-sp-f_bzr_grdid-eq-".$grdo['grdid']."-sp-f_usr_sttid-eq-1-sp-f_cls_sttid-eq-1-sp-clsactvt-eq-1-sp-";
		$spccdtint='-sp-';////
		$odrint='-';
		$lmtint=20;
		$jn='tb_grd ON f_bzr_grdid=grdid-jn-tb_usr ON f_bzr_usrid=usrid-jn-tb_'.$grdo['grdnm'].'_cls ON f_bzr_clsid=clsid-jn-tb_stt ON f_cls_sttid=sttid';
		//$jn='tb_ath ON f_bzr_athid=athid-jn-tb_atc ON f_bzr_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($bzr,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		
		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['clsactvt']==1){
				$v['clsactvt']='是';
			}else{
				$v['clsactvt']='否';
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
		$usr=M('usr');
		$cdt=$arr['cdt'];
		$where='1=1';
		if(preg_match('/f_usr_sttid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_usr_sttid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$where=$where.' AND f_usr_sttid='.$tmp[0];
		}
		$rl=M('rl');
		$rlo=$rl->where("rlnm LIKE '%班主任%'")->find();
		$usrrl=M('usrrl');
		$usrrlls=$usrrl->join('tb_usr ON f_usrrl_usrid=usrid')->join('tb_stt ON f_usr_sttid=sttid')->where($where.' AND f_usrrl_rlid='.$rlo['rlid'])->order('usrnm ASC')->select();
		$this->assign('usrls',$usrrlls);
		
		//q特殊
		$cdt=$arr['cdt'];
		$cls=M($grdo['grdnm'].'_cls');
		$where='1=1';
		if(preg_match('/f_cls_sttid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_cls_sttid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$where=$where.' AND f_cls_sttid='.$tmp[0];
		}
		if(preg_match('/clsactvt/',$cdt)){
			//获取该键的值
			$tmp=explode('clsactvt', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$where=$where." AND clsactvt=".$tmp[0];
		}
		$clsls=$cls->where($where)->order('clsnm ASC')->select();
		$this->assign('clsls',$clsls);
		
		//q特殊
		$this->assign('title','浏览班主任列表');
		$this->assign('theme','班主任管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$bzrid=$_POST['bzrid'];
	
		if($bzrid==0){
			
			$grdid=$_POST['f_bzr_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$bzr=M($grdo['grdnm'].'_bzr');
							
			
			//先截获数据
			$data=array(
					'f_bzr_grdid'=>$_POST['f_bzr_grdid'],
					'f_bzr_clsid'=>$_POST['f_bzr_clsid'],
					'f_bzr_usrid'=>$_POST['f_bzr_usrid'],
			);
			
			if($bzr->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$grdid=$_POST['f_bzr_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$bzr=M($grdo['grdnm'].'_bzr');
			
			//先截获数据
			$data=array(
					'f_bzr_grdid'=>$_POST['f_bzr_grdid'],
					'f_bzr_clsid'=>$_POST['f_bzr_clsid'],
					'f_bzr_usrid'=>$_POST['f_bzr_usrid'],
			);
			if($bzr->where('bzrid='.$bzrid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		
				
		$bzr=M('bzr');
		if($bzr->delete($_POST['bzrid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($bzr->getLastSql());
		}
	}
	
	function createAlways(){
		$grdid=$_POST['f_bzr_grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		$cls=M($grdo['grdnm'].'_cls');
		
		$rl=M('rl');
		$rlo=$rl->where("rlnm LIKE '%班主任%'")->find();
		$usrrl=M('usrrl');
		
		$wherecls='1=1';
		$whereusr='1=1';
		
		if($_POST['f_cls_sttid']){
			$wherecls=$wherecls.' AND f_cls_sttid='.$_POST['f_cls_sttid'];
		}
		if($_POST['f_usr_sttid']){
			$whereusr=$whereusr.' AND f_usr_sttid='.$_POST['f_usr_sttid'];
		}
		if($_POST['clsactvt']!==''){
			//$clsactvt=str_replace('\\', '', $_POST['clsactvt']);
			$wherecls=$wherecls.' AND clsactvt='.$_POST['clsactvt'];
		}
		$clsls=$cls->where($wherecls)->select();
		$usrls=$usrrl->join('tb_usr ON f_usrrl_usrid=usrid')->join('tb_stt ON f_usr_sttid=sttid')->where('f_usr_sttid='.$_POST['f_usr_sttid'].' AND f_usrrl_rlid='.$rlo['rlid'])->order('usrnm ASC')->select();
		$clsoptu="<option value=''>无</option>";
		foreach ($clsls as $v){
			$clsoptu=$clsoptu."<option value='".$v['clsid']."'>".$v['clsnm']."</option>";
		}
		$usroptu="<option value=''>无</option>";
		foreach ($usrls as $v){
			$usroptu=$usroptu."<option value='".$v['usrid']."'>[".$v['sttnm']."]".$v['usrnm'].'  '.$v['usrnn']."</option>";
		}
		$data['clsoptu']=$clsoptu;
		$data['usroptu']=$usroptu;
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	
}



?>