<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class PkAction extends Action{
	
	
	
	function gtxpg(){
		

		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Pk'")->find();
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
			
			$pkid=$_GET['pkid'];;
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$pk=M($grdo['grdnm'].'_pk');
			$mo=$pk->join('tb_stt ON f_pk_sttid=sttid')->join('tb_grd ON f_pk_grdid=grdid')->join('tb_xq ON f_pk_xqid=xqid')->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->where("pkid=".$pkid)->find();
			
			if($mo['pkzkkm']==1){
				$mo['pkzkkm']='是';
			}else{
				$mo['pkzkkm']='否';
			}
			
			//需要看下如果是其他函授站的可以能要第一学期，第二学期，第三学期之类的很BT的东西
			
			//适应一些站点用一二三
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqnm=$xqw->getxqnm($grdid, $mo['f_pk_sttid'], $mo['f_pk_xqid']);
			$mo['xqnm']=$xqnm;
			
			$this->assign('mo',$mo);
			
			
			
			
			
			
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){

			$grdid=$_GET['grdid'];
			$pkid=$_GET['pkid'];;
			
			
				
			$usr=M('usr');
			$usro=$usr->where('usrid='.session('usridss'))->find();
			//鉴权对用户对stt的权限，若为设置权限，说明是教务的人，可以全管，否则只能管自己函授站的 ntf为不用this assign的
			$mdII=M('md');
			$mdo=$mdII->where("mdmk='Stt'")->find();
			import('@.IDTATH.IdtathAction');
			$Idtath = new IdtathAction();
			$athofnstt=$Idtath->identify($mdo['mdid'],'ntf');
			
			if($pkid==0){
				$mo['pkid']=0;
				
				
				
				//默认年级是当前年级
				$grd=M('grd');
				$grdo=$grd->order('grdnm DESC')->find();
				$grdid=$grdo['grdid'];
				$mo['f_pk_grdid']=$grdid;
				
				
				//默认站点，有主的找有主的，没主的找本部
				if($athofnstt['aths']!=1){
					$mo['f_pk_sttid']=$usro['f_usr_sttid'];
				}else{
					$mo['f_pk_sttid']=1;
				}
				
				//默认学期 为XX年级XX站点的起始学期
				$xq=M('xq');
				$xqo=$xq->where('xqdq=1')->find();
				$xqid=$xqo['xqid'];
				$sttintxq=M($grdo['grdnm'].'_sttintxq');
				$sttintxqo=$sttintxq->where('f_sttintxq_grdid='.$grdo['grdid'].' AND f_sttintxq_sttid='.$mo['f_pk_sttid'])->find();
				if($xqid<$sttintxqo['f_sttintxq_xqid']){$xqid=$sttintxqo['f_sttintxq_xqid'];}//①如果激活的学期在初始学期后范围内的那么就选激活的学期②如果...在范围外的话呢就选择第初始学期为默认学期
				$mo['f_pk_xqid']=$xqid;
				
				$mo['pkwqm']='0.7';$mo['pkwps']='0.2';$mo['pkwxt']='0.1';
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
				
				
				
				
				
			}else{
				
				$grd=M('grd');
				$grdo=$grd->where('grdid='.$grdid)->find();
				
				$pk=M($grdo['grdnm'].'_pk');
				$mo=$pk->join('tb_stt ON f_pk_sttid=sttid')->join('tb_grd ON f_pk_grdid=grdid')->join('tb_xq ON f_pk_xqid=xqid')->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->where("pkid=".$pkid)->find();
					
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
				
				
				
			}
			
			
			$this->assign('mo',$mo);
			
			
			
			//q特殊
			$where='1=1';
			if($athofnstt['aths']!=1){
				$where=$where.' AND sttid='.$usro['f_usr_sttid'];
			}
			$stt=M('stt');
			$sttls=$stt->where($where)->select();
			$this->assign('sttls',$sttls);
			
			
			//q特殊
			$grd=M('grd');
			$grdls=$grd->order('grdnm DESC')->select();
			$this->assign('grdls',$grdls);
			
			
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqls=$xqw->getxqls($grdo['grdid'], $mo['f_pk_sttid'], 'DESC');
			$this->assign('xqls',$xqls);
			
			//课程
			//q特殊
			
			$kc=M($grdo['grdnm'].'_kc');
			$kcls=$kc->where('f_kc_grdid='.$grdo['grdid'])->select();
			$this->assign('kcls',$kcls);
			
			//教师
			//q特殊
			$tcr=M('tcr');
			$tcrls=$tcr->where('f_tcr_sttid='.$mo['f_pk_sttid'])->select();
			$this->assign('tcrls',$tcrls);
			
			
			$this->display('update');
		}
		
	
	}
	
	//------------------【】【】【】【】以上是排课部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Pk'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],'qry');
		
				
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		//鉴权对用户对stt的权限，若为设置权限，说明是教务的人，可以全管，否则只能管自己函授站的 ntf为不用this assign的
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Stt'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofnstt=$Idtath->identify($mdo['mdid'],'ntf');
		
		$usr=M('usr');
		$usro=$usr->where('usrid='.session('usridss'))->find();
		//第几学年 第几学期的班级 第几学年 第几学期的专业 ...
		//因为grd无法定下来，所以pkxqcls pkxqmj_xqid 定下来也没有意义，干脆就不定了，等搜索时候自由分晓
		
		//NB初始化，开始
		$cdt=$_GET['cdt'];
		$grd=M('grd');
		if(preg_match('/f_pk_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_pk_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
		}else{
			//默认grdid
			$grdo=$grd->order('grdid DESC')->find();
			$grdid=$grdo['grdid'];
		}
		$grdo=$grd->where('grdid='.$grdid)->find();
		$pk=M($grdo['grdnm'].'_pk');
// 		$pkls=$pk->select();

		$fldint='-pkid-f_pk_grdid-grdnm-sttnm-xqnm-kcnm-tcrnn-pkwqm-pkwps-pkwxt-pkzkkm-';
		//$cdtint="-sp-f_pk_ccid-eq-3-sp-f_pk_xxxsid-eq-2-sp-f_pk_zsfwid-eq-2-sp-f_pk_xzid-eq-2-sp-f_pk_sttid-eq-1-sp-f_pk_statid-eq-5-sp-";
		
		//默认学期，
		$xq=M('xq');
		$xqo=$xq->where('xqdq=1')->find();
		$xqid=$xqo['xqid'];
		
		if($athofnstt['aths']==1){
			$f_usr_sttid=1;
			$sttintxq=M($grdo['grdnm'].'_sttintxq');
			$sttintxqo=$sttintxq->where('f_sttintxq_grdid='.$grdo['grdid'].' AND f_sttintxq_sttid='.$f_usr_sttid)->find();
			if($xqid<$sttintxqo['f_sttintxq_xqid']){$xqid=$sttintxqo['f_sttintxq_xqid'];}//①如果激活的学期在初始学期后范围内的那么就选激活的学期②如果...在范围外的话呢就选择第初始学期为默认学期
			$cdtint="-sp-f_pk_grdid-eq-".$grdid."-sp-f_pk_sttid-eq-".$f_usr_sttid."-sp-f_pk_xqid-eq-".$xqid.'-sp-';
			//接下来产生学期
			
		}else{
			$f_usr_sttid=$usro['f_usr_sttid'];
			$sttintxq=M($grdo['grdnm'].'_sttintxq');
			$sttintxqo=$sttintxq->where('f_sttintxq_grdid='.$grdo['grdid'].' AND f_sttintxq_sttid='.$f_usr_sttid)->find();
			if($xqid<$sttintxqo['f_sttintxq_xqid']){$xqid=$sttintxqo['f_sttintxq_xqid'];}//①如果激活的学期在初始学期后范围内的那么就选激活的学期②如果...在范围外的话呢就选择第初始学期为默认学期
			$cdtint="-sp-f_pk_grdid-eq-".$grdid."-sp-f_pk_sttid-eq-".$f_usr_sttid."-sp-f_pk_xqid-eq-".$xqid.'-sp-';
			//接下来产生学期
		}
		$spccdtint='-sp-';////
		$odrint='-';
		$lmtint=20;
		$jn='tb_stt ON f_pk_sttid=sttid-jn-tb_grd ON f_pk_grdid=grdid-jn-tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid-jn-tb_tcr ON f_pk_tcrid=tcrid-jn-tb_xq ON f_pk_xqid=xqid';
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($pk,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach ($mls as $v){
			if($v['pkzkkm']==1){
				$v['pkzkkm']='是';
			}else{
				$v['pkzkkm']='否';
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
				
		if(preg_match('/f_pk_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_pk_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
			$grdo=$grd->where('grdid='.$grdid)->find();
		}else{
			$grdo=$grd->order('grdnm DESC')->find();
				
		}
		
		//q特殊
		$grd=M('grd');
		$grdls=$grd->order('grdnm DESC')->select();
		$this->assign('grdls',$grdls);
		
		//q特殊
		
		$stt=M('stt');//因为你站点可能木有了，但是站点已经招的排课阔能还在，因此要保留站点
		if($athofnstt['aths']==1){
			$sttls=$stt->select();
		}else{
			$sttls=$stt->where('sttid='.$usro['f_usr_sttid'])->select();
		}
		$this->assign('sttls',$sttls);
		
		
		
		$cdt=$arr['cdt'];
		//q特殊
		$xq=M('xq');
		if(preg_match('/f_pk_sttid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_pk_sttid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$sttid=$tmp[0];
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqls=$xqw->getxqls($grdo['grdid'], $sttid, 'DESC');
		}else{
			$xqls=$xq->order('xqnm DESC')->select();
		}
		$this->assign('xqls',$xqls);
		
		//课程
		//q特殊
		
		$kc=M($grdo['grdnm'].'_kc');
		$kcls=$kc->where('f_kc_grdid='.$grdo['grdid'])->select();
		$this->assign('kcls',$kcls);
		
		//教师
		//q特殊
		$tcr=M('tcr');
		if(preg_match('/f_pk_sttid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_pk_sttid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$sttid=$tmp[0];
			$tcr = M('tcr');
			$tcrls=$tcr->where('f_tcr_sttid='.$sttid)->select();
		}else{
			$tcrls=$tcr->where('f_tcr_sttid=1')->select();
		}
		$this->assign('tcrls',$tcrls);
		
		//用于生成xls
		$this->assign('grdnm',$grdo['grdnm']);
		
		//q特殊
		$this->assign('title','浏览排课列表');
		$this->assign('theme','排课管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$pkid=$_POST['pkid'];
	
		if($pkid==0){
			
			$f_pk_grdid=$_POST['f_pk_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$f_pk_grdid)->find();
			$pk=M($grdo['grdnm'].'_pk');
			
			$data=array(
					
					'f_pk_grdid'=>$_POST['f_pk_grdid'],
					'f_pk_sttid'=>$_POST['f_pk_sttid'],
					'f_pk_xqid'=>$_POST['f_pk_xqid'],
					
					'f_pk_kcid'=>$_POST['f_pk_kcid'],
					'f_pk_tcrid'=>$_POST['f_pk_tcrid'],
					
					'pkwqm'=>$_POST['pkwqm'],
					'pkwps'=>$_POST['pkwps'],
					'pkwxt'=>$_POST['pkwxt'],
					
					'pkzkkm'=>$_POST['pkzkkm'],
			);
			//查一查有没有同名排课网名
			
			if($pk->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$f_pk_grdid=$_POST['f_pk_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$f_pk_grdid)->find();
			$pk=M($grdo['grdnm'].'_pk');
			
			
			
			//先截获数据//排课基本部分
			$data=array(
					
					'f_pk_grdid'=>$_POST['f_pk_grdid'],
					'f_pk_sttid'=>$_POST['f_pk_sttid'],
					'f_pk_xqid'=>$_POST['f_pk_xqid'],
					
					'f_pk_kcid'=>$_POST['f_pk_kcid'],
					'f_pk_tcrid'=>$_POST['f_pk_tcrid'],
					
					'pkwqm'=>$_POST['pkwqm'],
					'pkwps'=>$_POST['pkwps'],
					'pkwxt'=>$_POST['pkwxt'],
					
					'pkzkkm'=>$_POST['pkzkkm'],
			);
			
			
			if($pk->where('pkid='.$_POST['pkid'])->setField($data)){
				
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	
	function delete(){
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$_POST['grdid'])->find();
		$pkxqcls=M($grdo['grdnm'].'_pkxqcls');	
		$pkxqmj=M($grdo['grdnm'].'_pkxqmj');
		$pk=M($grdo['grdnm'].'_pk');
		if($pk->delete($_POST['pkid'])){
			$pkxqcls->where('f_pkxqcls_pkid='.$_POST['pkid'])->delete();
			$pkxqmj->where('f_pkxqmj_pkid='.$_POST['pkid'])->delete();
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($pk->getLastSql());
		}
	}
	
	
	
	function createAlways(){
		$grdid=$_POST['f_pk_grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		//改变的是学期 是课程 是老师
		$kc=M($grdo['grdnm'].'_kc');
		$tcr=M('tcr');
		
		$xq=M('xq');
		$xqodq=$xq->where('xqdq=1')->find();
		
		
		$wherekc='1=1';
		$wheretcr='1=1';
		if($_POST['f_pk_sttid']){
			$wheretcr=$wheretcr.' AND f_tcr_sttid='.$_POST['f_pk_sttid'];
			
		}
		if($_POST['f_pk_grdid']){
			$wherekc=$wherekc.' AND f_kc_grdid='.$_POST['f_pk_grdid'];
			
		}
		$tcrls=$tcr->where($wheretcr)->select();
		$kcls=$kc->where($wherekc)->select();
		
		$tcroptu="<option value=''>无</option>";
		foreach ($tcrls as $v){
			$tcroptu=$tcroptu."<option value='".$v['tcrid']."'>".$v['tcrnn']."</option>";
		}
		$kcoptu="<option value=''>无</option>";
		foreach ($kcls as $v){
			$kcoptu=$kcoptu."<option value='".$v['kcid']."'>".$v['kcnm']."</option>";
		}
		
		
		$data['tcroptu']=$tcroptu;
		$data['kcoptu']=$kcoptu;
		
		
		if($_POST['f_pk_sttid']){
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqls=$xqw->getxqls($grdo['grdid'], $_POST['f_pk_sttid'], 'DESC');
		}else{
			$xq=M('xq');
			$xqls=$xq->order('xqnm DESC')->select();
		}
		$xqoptu='';
		foreach ($xqls as $v){
			if($v['xqid']==$xqodq['xqid']){
				$xqoptu=$xqoptu."<option value='".$v['xqid']."' selected >".$v['xqnm']."</option>";
			}else{
				$xqoptu=$xqoptu."<option value='".$v['xqid']."'>".$v['xqnm']."</option>";
			}
		}
			
		
		$data['xqoptu']=$xqoptu;
		
		
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	
}



?>