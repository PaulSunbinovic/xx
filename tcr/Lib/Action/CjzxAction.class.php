<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class CjzxAction extends Action{
	
	
	
	function gtxpg(){
		header("Content-Type:text/html; charset=utf-8");

		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
// 		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
// 		$mdII=M('md');
// 		$mdo=$mdII->where("mdmk='Cjzx'")->find();
// 		import('@.IDTATH.IdtathAction');
// 		$Idtath = new IdtathAction();
// 		$athofn=$Idtath->identify($mdo['mdid'],$x);
		
// 		import('@.NTF.NTFAction');
// 		$ntf = new NTFAction();
// 		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		
		
		if($x=='vw'){
			
			$grdid=$_GET['grdid'];
			
			$cjzxid=$_GET['cjzxid'];;
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$cjzx=M($grdo['grdnm'].'_cjzx');
			$mo=$cjzx->join('tb_stt ON f_cjzx_sttid=sttid')->join('tb_grd ON f_cjzx_grdid=grdid')->join('tb_xq ON f_cjzx_xqid=xqid')->join('tb_'.$grdo['grdnm'].'_kc ON f_cjzx_kcid=kcid')->join('tb_tcr ON f_cjzx_tcrid=tcrid')->where("cjzxid=".$cjzxid)->find();
			
			
			//需要看下如果是其他函授站的可以能要第一学期，第二学期，第三学期之类的很BT的东西
			
			//适应一些站点用一二三
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqnm=$xqw->getxqnm($grdid, $mo['f_cjzx_sttid'], $mo['f_cjzx_xqid']);
			$mo['xqnm']=$xqnm;
			
			$this->assign('mo',$mo);
			
			
			
			
			
			
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){

			$grdid=$_GET['grdid'];
			$cjzxid=$_GET['cjzxid'];;
			
			
				
			$usr=M('usr');
			$usro=$usr->where('usrid='.session('usridss'))->find();
			//鉴权对用户对stt的权限，若为设置权限，说明是教务的人，可以全管，否则只能管自己函授站的 ntf为不用this assign的
			$mdII=M('md');
			$mdo=$mdII->where("mdmk='Stt'")->find();
			import('@.IDTATH.IdtathAction');
			$Idtath = new IdtathAction();
			$athofnstt=$Idtath->identify($mdo['mdid'],'ntf');
			
			if($cjzxid==0){
				$mo['cjzxid']=0;
				
				
				
				//默认年级是当前年级
				$grd=M('grd');
				$grdo=$grd->order('grdnm DESC')->find();
				$grdid=$grdo['grdid'];
				$mo['f_cjzx_grdid']=$grdid;
				
				
				//默认站点，有主的找有主的，没主的找本部
				if($athofnstt['aths']!=1){
					$mo['f_cjzx_sttid']=$usro['f_usr_sttid'];
				}else{
					$mo['f_cjzx_sttid']=1;
				}
				
				//默认学期 为XX年级XX站点的起始学期
				$xq=M('xq');
				$xqo=$xq->where('xqdq=1')->find();
				$xqid=$xqo['xqid'];
				$sttintxq=M($grdo['grdnm'].'_sttintxq');
				$sttintxqo=$sttintxq->where('f_sttintxq_grdid='.$grdo['grdid'].' AND f_sttintxq_sttid='.$mo['f_cjzx_sttid'])->find();
				if($xqid<$sttintxqo['f_sttintxq_xqid']){$xqid=$sttintxqo['f_sttintxq_xqid'];}//①如果激活的学期在初始学期后范围内的那么就选激活的学期②如果...在范围外的话呢就选择第初始学期为默认学期
				$mo['f_cjzx_xqid']=$xqid;
				
				
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
				
				
				
				
				
			}else{
				
				$grd=M('grd');
				$grdo=$grd->where('grdid='.$grdid)->find();
				
				$cjzx=M($grdo['grdnm'].'_cjzx');
				$mo=$cjzx->join('tb_stt ON f_cjzx_sttid=sttid')->join('tb_grd ON f_cjzx_grdid=grdid')->join('tb_xq ON f_cjzx_xqid=xqid')->join('tb_'.$grdo['grdnm'].'_kc ON f_cjzx_kcid=kcid')->join('tb_tcr ON f_cjzx_tcrid=tcrid')->where("cjzxid=".$cjzxid)->find();
					
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
			$xqls=$xqw->getxqls($grdo['grdid'], $mo['f_cjzx_sttid'], 'DESC');
			$this->assign('xqls',$xqls);
			
			//课程
			//q特殊
			
			$kc=M($grdo['grdnm'].'_kc');
			$kcls=$kc->where('f_kc_grdid='.$grdo['grdid'])->select();
			$this->assign('kcls',$kcls);
			
			//教师
			//q特殊
			$tcr=M('tcr');
			$tcrls=$tcr->where('f_tcr_sttid='.$mo['f_cjzx_sttid'])->select();
			$this->assign('tcrls',$tcrls);
			
			
			$this->display('update');
		}else if($x='skxx'){//授课信息
			//获得这个人id
			$tcrid=session('tcridss');
			$tcr=M('tcr');
			$tcro=$tcr->where('tcrid='.$tcrid)->find();//sttid tcrid
			
			
			$xq=M('xq');
			$xqo=$xq->where('xqdq=1')->find();//xqid
			
			$grd=M('grd');
			$grdls=$grd->order('grdnm DESC')->select();
			
			
			$grdlsfn=array();
			
			foreach($grdls as $v){//grdid
				
				$pk=M($v['grdnm'].'_pk');
				$pkls=$pk->join('tb_'.$v['grdnm'].'_kc ON f_pk_kcid=kcid')->where('f_pk_grdid='.$v['grdid'].' AND f_pk_sttid='.$tcro['f_tcr_sttid'].' AND f_pk_xqid='.$xqo['xqid'].' AND f_pk_tcrid='.$tcro['tcrid'])->select();
				p($pkls);die;
				if(!$pkls){continue;}
				$pklsfn=array();
				foreach($pkls as $u){
					$cjzx=M($v['grdnm'].'_cjzx');
					$cjzx->join('tb_'.$v['grdnm'].'_std ON f_cjzx_stdid=stdid')->join('inner join tb_'.$v['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$v['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
					$cjzx->join('tb_'.$v['grdnm'].'_pk ON f_cjzx_pkid=pkid')->join('tb_stt ON f_cjzx_sttid=sttid')->join('tb_grd ON f_cjzx_grdid=grdid')
					->join('tb_'.$v['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->join('tb_xq ON f_cjzx_xqid=xqid')
					->join('tb_'.$v['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')
					->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$v['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_sex ON f_std_sexid=sexid')
					->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid');
					
					$cjzxls=$cjzx->Distinct(true)->field('clsid,clsnm,cjzxsftj')->where('f_stdxqcls_xqid='.$xqo['xqid'].' AND f_stdxqmj_xqid='.$xqo['xqid'].' AND f_cjzx_pkid='.$u['pkid'].' AND f_std_statid=5')->select();
					$u['clsls']=$cjzxls;
					array_push($pklsfn, $u);
				}	
				$v['pkls']=$pklsfn;
				array_push($grdlsfn, $v);
			}
			
			$this->assign('grdls',$grdlsfn);
			
			$this->assign('title','授课信息');
			$this->assign('theme','授课信息：');
			$this->assign('btnvl','');
			$this->display('skxx');
		}
		
	
	}
	
	//------------------【】【】【】【】以上是成绩中心部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
// 		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
// 		$mdII=M('md');
// 		$mdo=$mdII->where("mdmk='Cjzx'")->find();
// 		import('@.IDTATH.IdtathAction');
// 		$Idtath = new IdtathAction();
// 		$athofn=$Idtath->identify($mdo['mdid'],'qry');
		
				
// 		import('@.NTF.NTFAction');
// 		$ntf = new NTFAction();
// 		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
// 		//鉴权对用户对stt的权限，若为设置权限，说明是教务的人，可以全管，否则只能管自己函授站的 ntf为不用this assign的
// 		$mdII=M('md');
// 		$mdo=$mdII->where("mdmk='Stt'")->find();
// 		import('@.IDTATH.IdtathAction');
// 		$Idtath = new IdtathAction();
// 		$athofnstt=$Idtath->identify($mdo['mdid'],'ntf');
		
// 		$usr=M('usr');
// 		$usro=$usr->where('usrid='.session('usridss'))->find();
		//第几学年 第几学期的班级 第几学年 第几学期的专业 ...
		//因为grd无法定下来，所以cjzxxqcls cjzxxqmj_xqid 定下来也没有意义，干脆就不定了，等搜索时候自由分晓
		
		//NB初始化，开始
		$cdt=$_GET['cdt'];
		$grd=M('grd');
		$grdid=$_GET['grdid'];
		$grdo=$grd->where('grdid='.$grdid)->find();
		$cjzx=clone M($grdo['grdnm'].'_cjzx');
		$cjzx->join('tb_'.$grdo['grdnm'].'_std ON f_cjzx_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
// 		$cjzxls=$cjzx->select();

		$fldint='-cjzxid-f_cjzx_grdid-stdno-stdnm-sexnm-cjzxzf-cjzxqmf-cjzxpsf-cjzxxtf-cjzxbkf-cjzxsftj-cjzxxk-cjzxqk-';
		
		//默认学期，
		$xq=M('xq');
		$xqo=$xq->where('xqdq=1')->find();
		$xqid=$xqo['xqid'];
		
		
		$sttid=$_GET['sttid'];
		$sttintxq=M($grdo['grdnm'].'_sttintxq');
		$sttintxqo=$sttintxq->where('f_sttintxq_grdid='.$grdo['grdid'].' AND f_sttintxq_sttid='.$sttid)->find();
		if($xqid<$sttintxqo['f_sttintxq_xqid']){$xqid=$sttintxqo['f_sttintxq_xqid'];}//①如果激活的学期在初始学期后范围内的那么就选激活的学期②如果...在范围外的话呢就选择第初始学期为默认学期
		$cdtint="-sp-f_cjzx_grdid-eq-".$grdid."-sp-f_cjzx_sttid-eq-".$sttid."-sp-f_cjzx_xqid-eq-".$xqid.'-sp-'."f_pk_grdid-eq-".$grdid."-sp-f_pk_sttid-eq-".$sttid."-sp-f_pk_xqid-eq-".$xqid.'-sp-'."f_std_grdid-eq-".$grdid."-sp-f_std_sttid-eq-".$sttid."-sp-f_std_statid-eq-5-sp-f_stdxqcls_xqid-eq-".$xqid."-sp-f_stdxqmj_xqid-eq-".$xqid.'-sp-f_stdxqcls_clsid-eq-'.$_GET['clsid'].'-sp-f_cjzx_pkid-eq-'.$_GET['pkid'].'-sp-';
		//接下来产生学期
			
		
		$spccdtint='-sp-';////
		$odrint='-f_mj_bxxsid ASC-clsid ASC-mjid ASC-stdno ASC-';
		$lmtint=100;
		$jn='tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid-jn-tb_stt ON f_cjzx_sttid=sttid-jn-tb_grd ON f_cjzx_grdid=grdid-jn-tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid-jn-tb_tcr ON f_pk_tcrid=tcrid-jn-tb_xq ON f_cjzx_xqid=xqid'.'-jn-tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid-jn-tb_bxxs ON f_mj_bxxsid=bxxsid-jn-tb_cc ON f_mj_ccid=ccid-jn-tb_kl ON f_mj_klid=klid-jn-tb_xxxs ON f_mj_xxxsid=xxxsid-jn-tb_zsfw ON f_mj_zsfwid=zsfwid-jn-tb_xz ON f_mj_xzid=xzid-jn-tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid-jn-tb_sex ON f_std_sexid=sexid-jn-tb_rc ON f_std_rcid=rcid-jn-tb_zzmm ON f_std_zzmmid=zzmmid-jn-tb_xl ON f_std_xlid=xlid-jn-tb_stat ON f_std_statid=statid';
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($cjzx,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		
				
		
		$this->assign('fstrw',$arr['fstrw']);
		$this->assign('sqlstc',$arr['sqlstc']);
		$this->assign('fld',$arr['fld']);
		$this->assign('cdt',$arr['cdt']);
		$this->assign('spccdt',$arr['spccdt']);////
		$this->assign('odr',$arr['odr']);
		$this->assign('lmt',$arr['lmt']);
		$this->assign('count',$arr['count']);
		
		
		$mls=$arr['mls'];
		$pkid=$_GET['pkid'];
			
		//取出权重//顺便给query页给出参考
		$rfr='-';
			
		$pk=M($grdo['grdnm'].'_pk');
		$pko=$pk->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->where('pkid='.$pkid)->find();
		//通过学生得到现在是哪个班,在上哪个课
		$this->assign('pknm',$pko['kcnm'].'-'.$pko['tcrnn']);
		
		for($i=0;$i<count($mls);$i++){
		
			$rfr=$rfr.$mls[$i]['cjzxid'].'-';
		
		}
		$this->assign('wqm',$pko['pkwqm']);$this->assign('wps',$pko['pkwps']);$this->assign('wxt',$pko['pkwxt']);
		$this->assign('rfr',$rfr);
		$this->assign('mls',$mls);
		$this->assign('page_method',$arr['page_method']);
		
		
		$cdt=$arr['cdt'];
		//设定条件
		if(preg_match('/f_cjzx_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_cjzx_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
			$grdo=$grd->where('grdid='.$grdid)->find();
		}else{
			$grdo=$grd->order('grdnm DESC')->find();
		
		}
		
		if(preg_match('/f_cjzx_xqid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_cjzx_xqid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$xqid=$tmp[0];
				
		}else{
				
		
		}
		
		//q特殊
		$grd=M('grd');
		$grdls=$grd->order('grdnm DESC')->select();
		$this->assign('grdls',$grdls);
		
		//q特殊
		
		$stt=M('stt');//因为你站点可能木有了，但是站点已经招的成绩中心阔能还在，因此要保留站点
		$sttls=$stt->where('sttid='.$sttid)->select();
		$this->assign('sttls',$sttls);
		
		
		
		$xq=M('xq');
		if(preg_match('/f_cjzx_sttid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_cjzx_sttid', $cdt);
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
		
		
		
		
		//q特殊
		$where='1=1';
		//获取该键的值
		$tmp=explode('f_std_sttid', $cdt);
		$tmp=explode('-eq-',$tmp[1]);
		$tmp=explode('-sp-',$tmp[1]);
		$where=$where.' AND f_cls_sttid='.$sttid;
		
		//之前已经确定过到底是看哪个年级
		$where=$where.' AND f_cls_grdid='.$grdid;
		$cls=M($grdo['grdnm'].'_cls');
		$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where($where.' AND clsactvt=1')->order('clsnm ASC')->select();
		$this->assign('clsls',$clsls);
		
		if(preg_match('/f_stdxqcls_clsid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_stdxqcls_clsid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$clsid=$tmp[0];
			//找那个班的学生代表看看他选了那些成绩中心
			$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
			$stdxqclso=$stdxqcls->join('tb_'.$grdo['grdnm'].'_std ON f_stdxqcls_stdid=stdid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->where('f_stdxqcls_xqid='.$xqid.' AND f_stdxqcls_clsid='.$clsid.' AND f_std_statid=5')->find();
			$cjzx=clone M($grdo['grdnm'].'_cjzx');
			$pkls=$cjzx->join('tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid')->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->where('f_cjzx_sttid='.$sttid.' AND f_cjzx_xqid='.$xqid.' AND f_cjzx_stdid='.$stdxqclso['f_stdxqcls_stdid'])->select();
				
		}else{
				
		}
		$this->assign('pkls',$pkls);
		//结束设定条件
			
		

		$cls=M($grdo['grdnm'].'_cls');
		$clso=$cls->where('clsid='.$_GET['clsid'])->find();
		$this->assign('clsnm',$clso['clsnm']);
		
		if($mls[0]['cjzxsftj']==1){
			$this->assign('tijiao',1);
		}else{
			$this->assign('tijiao',0);
		}
		
		
		//q特殊
		$this->assign('title','成绩中心');
		$this->assign('theme','成绩录入');
		
		$this->display('query');
	}
	
	
	function bc(){
		header("Content-Type:text/html; charset=utf-8");
		$grdid=$_POST['f_cjzx_grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		$cjzx=M($grdo['grdnm'].'_cjzx');
		$rfr=$_POST['rfr'];
		$rfru=explode('-', $rfr);
		for($i=1;$i<count($rfru)-1;$i++){
			if($_POST['cjzxqmf-'.$rfru[$i]]==''&&$_POST['cjzxpsf-'.$rfru[$i]]==''&&$_POST['cjzxxtf-'.$rfru[$i]]==''){
				$data=array(
						'cjzxqmf'=>$_POST['cjzxqmf-'.$rfru[$i]],
						'cjzxpsf'=>$_POST['cjzxpsf-'.$rfru[$i]],
						'cjzxxtf'=>$_POST['cjzxxtf-'.$rfru[$i]],
						'cjzxzf'=>'',
						
				);
			}else if($_POST['cjzxqmf-'.$rfru[$i]]=='限考'||$_POST['cjzxpsf-'.$rfru[$i]]=='限考'||$_POST['cjzxxtf-'.$rfru[$i]]=='限考'){
				$data=array(
						'cjzxqmf'=>$_POST['cjzxqmf-'.$rfru[$i]],
						'cjzxpsf'=>$_POST['cjzxpsf-'.$rfru[$i]],
						'cjzxxtf'=>$_POST['cjzxxtf-'.$rfru[$i]],
						'cjzxzf'=>'限考',
						
				);
			}else if($_POST['cjzxqmf-'.$rfru[$i]]=='缓考'||$_POST['cjzxpsf-'.$rfru[$i]]=='缓考'||$_POST['cjzxxtf-'.$rfru[$i]]=='缓考'){
				$data=array(
						'cjzxqmf'=>$_POST['cjzxqmf-'.$rfru[$i]],
						'cjzxpsf'=>$_POST['cjzxpsf-'.$rfru[$i]],
						'cjzxxtf'=>$_POST['cjzxxtf-'.$rfru[$i]],
						'cjzxzf'=>'缓考',
						
				);
			}else{
				$data=array(
						'cjzxqmf'=>$_POST['cjzxqmf-'.$rfru[$i]],
						'cjzxpsf'=>$_POST['cjzxpsf-'.$rfru[$i]],
						'cjzxxtf'=>$_POST['cjzxxtf-'.$rfru[$i]],
						'cjzxzf'=>ceil($_POST['cjzxqmf-'.$rfru[$i]]*$_POST['wqm']+$_POST['cjzxpsf-'.$rfru[$i]]*$_POST['wps']+$_POST['cjzxxtf-'.$rfru[$i]]*$_POST['wxt']),
						
				);
			}
			$cjzx->where('cjzxid='.$rfru[$i])->setField($data);
		}
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	function tj(){
		header("Content-Type:text/html; charset=utf-8");
		$grdid=$_POST['f_cjzx_grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		$cjzx=M($grdo['grdnm'].'_cjzx');
		$rfr=$_POST['rfr'];
		$rfru=explode('-', $rfr);
		for($i=1;$i<count($rfru)-1;$i++){
			if($_POST['cjzxqmf-'.$rfru[$i]]=='限考'||$_POST['cjzxpsf-'.$rfru[$i]]=='限考'||$_POST['cjzxxtf-'.$rfru[$i]]=='限考'){
				$data=array(
						'cjzxqmf'=>$_POST['cjzxqmf-'.$rfru[$i]],
						'cjzxpsf'=>$_POST['cjzxpsf-'.$rfru[$i]],
						'cjzxxtf'=>$_POST['cjzxxtf-'.$rfru[$i]],
						'cjzxzf'=>'限考',
						'cjzxbkf'=>$_POST['cjzxbkf-'.$rfru[$i]],
						'cjzxsftj'=>1,
				);
			}else if(trim($_POST['cjzxqmf-'.$rfru[$i]])==''||$_POST['cjzxqmf-'.$rfru[$i]]=='0'||$_POST['cjzxqmf-'.$rfru[$i]]=='缺考'){
				$data=array(
						'cjzxqmf'=>$_POST['cjzxqmf-'.$rfru[$i]],
						'cjzxpsf'=>$_POST['cjzxpsf-'.$rfru[$i]],
						'cjzxxtf'=>$_POST['cjzxxtf-'.$rfru[$i]],
						'cjzxzf'=>'缺考',
						'cjzxbkf'=>$_POST['cjzxbkf-'.$rfru[$i]],
						'cjzxsftj'=>1,
						'cjzxqk'=>1,
				);
			}else if($_POST['cjzxqmf-'.$rfru[$i]]=='缓考'||$_POST['cjzxpsf-'.$rfru[$i]]=='缓考'||$_POST['cjzxxtf-'.$rfru[$i]]=='缓考'){
				$data=array(
						'cjzxqmf'=>$_POST['cjzxqmf-'.$rfru[$i]],
						'cjzxpsf'=>$_POST['cjzxpsf-'.$rfru[$i]],
						'cjzxxtf'=>$_POST['cjzxxtf-'.$rfru[$i]],
						'cjzxzf'=>'缓考',
						'cjzxbkf'=>$_POST['cjzxbkf-'.$rfru[$i]],
						'cjzxsftj'=>1,
				);
			}else{
				$data=array(
						'cjzxqmf'=>$_POST['cjzxqmf-'.$rfru[$i]],
						'cjzxpsf'=>$_POST['cjzxpsf-'.$rfru[$i]],
						'cjzxxtf'=>$_POST['cjzxxtf-'.$rfru[$i]],
						'cjzxzf'=>ceil($_POST['cjzxqmf-'.$rfru[$i]]*$_POST['wqm']+$_POST['cjzxpsf-'.$rfru[$i]]*$_POST['wps']+$_POST['cjzxxtf-'.$rfru[$i]]*$_POST['wxt']),
						'cjzxbkf'=>$_POST['cjzxbkf-'.$rfru[$i]],
						'cjzxsftj'=>1,
				);
			}
			$cjzx->where('cjzxid='.$rfru[$i])->setField($data);
		}
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$cjzxid=$_POST['cjzxid'];
	
		if($cjzxid==0){
			
			$f_cjzx_grdid=$_POST['f_cjzx_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$f_cjzx_grdid)->find();
			$cjzx=M($grdo['grdnm'].'_cjzx');
			
			$data=array(
					
					'f_cjzx_grdid'=>$_POST['f_cjzx_grdid'],
					'f_cjzx_sttid'=>$_POST['f_cjzx_sttid'],
					'f_cjzx_xqid'=>$_POST['f_cjzx_xqid'],
					
					'f_cjzx_kcid'=>$_POST['f_cjzx_kcid'],
					'f_cjzx_tcrid'=>$_POST['f_cjzx_tcrid'],
					
					'cjzxwqm'=>$_POST['cjzxwqm'],
					'cjzxwps'=>$_POST['cjzxwps'],
					'cjzxwxt'=>$_POST['cjzxwxt'],
					
				
			);
			//查一查有没有同名成绩中心网名
			
			if($cjzx->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$f_cjzx_grdid=$_POST['f_cjzx_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$f_cjzx_grdid)->find();
			$cjzx=M($grdo['grdnm'].'_cjzx');
			
			
			
			//先截获数据//成绩中心基本部分
			$data=array(
					
					'f_cjzx_grdid'=>$_POST['f_cjzx_grdid'],
					'f_cjzx_sttid'=>$_POST['f_cjzx_sttid'],
					'f_cjzx_xqid'=>$_POST['f_cjzx_xqid'],
					
					'f_cjzx_kcid'=>$_POST['f_cjzx_kcid'],
					'f_cjzx_tcrid'=>$_POST['f_cjzx_tcrid'],
					
					'cjzxwqm'=>$_POST['cjzxwqm'],
					'cjzxwps'=>$_POST['cjzxwps'],
					'cjzxwxt'=>$_POST['cjzxwxt'],
					
				
			);
			
			
			if($cjzx->where('cjzxid='.$_POST['cjzxid'])->setField($data)){
				
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
		$cjzxxqcls=M($grdo['grdnm'].'_cjzxxqcls');	
		$cjzxxqmj=M($grdo['grdnm'].'_cjzxxqmj');
		$cjzx=M($grdo['grdnm'].'_cjzx');
		if($cjzx->delete($_POST['cjzxid'])){
			$cjzxxqcls->where('f_cjzxxqcls_cjzxid='.$_POST['cjzxid'])->delete();
			$cjzxxqmj->where('f_cjzxxqmj_cjzxid='.$_POST['cjzxid'])->delete();
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($cjzx->getLastSql());
		}
	}
	
	
	
	function createAlways(){
		$grdid=$_POST['f_cjzx_grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		//改变的是学期 是课程 是老师
		$cls=M($grdo['grdnm'].'_cls');
// 		$pk=M($grdo['grdnm'].'_pk');
		
		
		
		
		$wherecls='1=1';
// 		$wherepk='1=1';
		
		if($_POST['f_cjzx_sttid']){
			$wherecls=$wherecls.' AND f_cls_sttid='.$_POST['f_cjzx_sttid'];
// 			$wherepk=$wherepk.' AND f_pk_sttid='.$_POST['f_cjzx_sttid'];
			
			
		}
		if($_POST['f_cjzx_grdid']){
			$wherecls=$wherecls.' AND f_cls_grdid='.$_POST['f_cjzx_grdid'];
// 			$wherepk=$wherepk.' AND f_pk_grdid='.$_POST['f_cjzx_grdid'];
			
		}
		
// 		if($_POST['f_cjzx_xqid']){
// 			$wherepk=$wherepk.' AND f_pk_xqid='.$_POST['f_cjzx_xqid'];
				
// 		}
		
		$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where($wherecls.' AND clsactvt=1')->order('clsnm DESC')->select();
		$clsoptu="<option value=''>无</option>";
		foreach ($clsls as $v){
			$clsoptu=$clsoptu."<option value='".$v['clsid']."'>[".$v['sttnm'].']'.$v['clsnm']."</option>";
		}
		
		
// 		$pkls=$pk->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->where($wherepk)->select();
		
// 		$pkoptu="<option value=''>无</option>";
// 		foreach ($pkls as $v){
// 			$pkoptu=$pkoptu."<option value='".$v['pkid']."'>".$v['kcnm'].'-'.$v['tcrnn']."</option>";
// 		}
		
		
		$data['clsoptu']=$clsoptu;
// 		$data['pkoptu']=$pkoptu;
		
		
		if($_POST['f_cjzx_sttid']){
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqls=$xqw->getxqls($grdo['grdid'], $_POST['f_cjzx_sttid'], 'DESC');
		}else{
			$xq=M('xq');
			$xqls=$xq->order('xqnm DESC')->select();
		}
		$xqoptu='';
		foreach ($xqls as $v){
			$xqoptu=$xqoptu."<option value='".$v['xqid']."'>".$v['xqnm']."</option>";
		}
		$data['xqoptu']=$xqoptu;
		
		
		
		if($_POST['f_stdxqcls_clsid']){
			//找那个班的学生代表看看他选了那些成绩中心
			$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
			$stdxqclso=$stdxqcls->join('tb_'.$grdo['grdnm'].'_std ON f_stdxqcls_stdid=stdid')->where('f_stdxqcls_xqid='.$_POST['f_cjzx_xqid'].' AND f_stdxqcls_clsid='.$_POST['f_stdxqcls_clsid'].' AND f_std_statid=5')->find();
			$cjzx=M($grdo['grdnm'].'_cjzx');
			$pkls=$cjzx->join('tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid')->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->where('f_cjzx_sttid='.$_POST['f_cjzx_sttid'].' AND f_cjzx_xqid='.$_POST['f_cjzx_xqid'].' AND f_cjzx_stdid='.$stdxqclso['f_stdxqcls_stdid'])->select();
			$pkoptu="<option value=''>无</option>";
			foreach ($pkls as $v){
				$pkoptu=$pkoptu."<option value='".$v['pkid']."'>".$v['kcnm'].'-'.$v['tcrnn']."</option>";
			}
		}else{
			$pkoptu="<option value=''>无</option>";
		}
		$data['pkoptu']=$pkoptu;
		
		
		
		
		
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	
}



?>