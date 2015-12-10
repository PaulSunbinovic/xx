<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class PlAction extends Action{
	
	
	function gtxpg(){
	
	
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
	
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Pl'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],$x);
	
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
	
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
	
	
	
		if($x=='updt'){
				
			$grdid=$_GET['grdid'];
			$sttid=$_GET['sttid'];
			$xqid=$_GET['xqid'];
			$stdid=$_GET['stdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$std=M($grdo['grdnm'].'_std')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
			$stdo=$std->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND stdid=".$stdid)->find();
				
			//给专业多点修饰
			if(preg_match('/技能/',$stdo['bxxsnm'])){
				$stdo['bxxsnmst']='技能';
			}else if(preg_match('/自考/',$stdo['bxxsnm'])){
				$stdo['bxxsnmst']='自考';
			}else{
				$stdo['bxxsnmst']='普通';
			}
			//需要看下如果是其他函授站的可以能要第一学期，第二学期，第三学期之类的很BT的东西
				
			//适应一些站点用一二三
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqnm=$xqw->getxqnm($grdid, $stdo['f_std_sttid'], $xqid);
			$stdo['xqnm']=$xqnm;
				
			$this->assign('stdo',$stdo);
				
			$pl=M($grdo['grdnm'].'_pl');
			if($_GET['plid']==0){
				$mo['plid']=0;
				$mo['f_pl_grdid']=$grdid;
				$mo['f_pl_sttid']=$sttid;
				$mo['f_pl_xqid']=$xqid;
				$mo['f_pl_stdid']=$stdo['stdid'];
				$this->assign('btnvl','添加');
			}else{
				$mo=$pl->where('plid='.$_GET['plid'])->find();
				$this->assign('btnvl','修改');
			}
				
			$this->assign('mo',$mo);
				
				
			$this->assign('title','评语');
			$this->assign('theme','评语');
			$this->display('update');
		}
	
	}
	//------------------【】【】【】【】以上是学生部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Pl'")->find();
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
		//因为grd无法定下来，所以stdxqcls stdxqmj_xqid 定下来也没有意义，干脆就不定了，等搜索时候自由分晓
		
		//NB初始化，开始
		$cdt=$_GET['cdt'];
		$grd=M('grd');
		if(preg_match('/f_std_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_std_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
		}else{
			//默认grdid
			$grdo=$grd->order('grdid DESC')->find();
			$grdid=$grdo['grdid'];
		}
		$grdo=$grd->where('grdid='.$grdid)->find();
		$this->assign('grdid',$grdid);
		
		$std=M($grdo['grdnm'].'_std')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');


		
		
		$fldint='-stdid-f_std_grdid-grdnm-f_std_sttid-sttnm-f_stdxqcls_xqid-xqnm-f_stdxqcls_clsid-bxxsnm-clsnm-stdno-stdnm-sexnm-';
		
		//默认学期，
		$xq=M('xq');
		$xqo=$xq->where('xqdq=1')->find();
		$xqid=$xqo['xqid'];
		
		if($athofnstt['aths']==1){
			$f_usr_sttid=1;
			$sttintxq=M($grdo['grdnm'].'_sttintxq');
			$sttintxqo=$sttintxq->where('f_sttintxq_grdid='.$grdo['grdid'].' AND f_sttintxq_sttid='.$f_usr_sttid)->find();
			if($xqid<$sttintxqo['f_sttintxq_xqid']){$xqid=$sttintxqo['f_sttintxq_xqid'];}//①如果激活的学期在初始学期后范围内的那么就选激活的学期②如果...在范围外的话呢就选择第初始学期为默认学期
			$cdtint="-sp-f_std_grdid-eq-".$grdid."-sp-f_std_sttid-eq-".$f_usr_sttid."-sp-f_std_statid-eq-5-sp-f_stdxqcls_xqid-eq-".$xqid."-sp-f_stdxqmj_xqid-eq-".$xqid.'-sp-';
			//接下来产生学期
			
		}else{
			$f_usr_sttid=$usro['f_usr_sttid'];
			$sttintxq=M($grdo['grdnm'].'_sttintxq');
			$sttintxqo=$sttintxq->where('f_sttintxq_grdid='.$grdo['grdid'].' AND f_sttintxq_sttid='.$f_usr_sttid)->find();
			if($xqid<$sttintxqo['f_sttintxq_xqid']){$xqid=$sttintxqo['f_sttintxq_xqid'];}//①如果激活的学期在初始学期后范围内的那么就选激活的学期②如果...在范围外的话呢就选择第初始学期为默认学期
			$cdtint="-sp-f_std_grdid-eq-".$grdid."-sp-f_std_sttid-eq-".$f_usr_sttid."-sp-f_std_statid-eq-5-sp-f_stdxqcls_xqid-eq-".$xqid."-sp-f_stdxqmj_xqid-eq-".$xqid.'-sp-';
			//接下来产生学期
		}
		
		if(preg_match('/f_stdxqcls_xqid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_stdxqcls_xqid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$xqid=$tmp[0];
		}
		$this->assign('xqid',$xqid);
		
		if(preg_match('/f_std_sttid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_std_sttid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$sttid=$tmp[0];
		}
		$this->assign('sttid',$sttid);
		
		if(preg_match('/f_stdxqcls_clsid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_stdxqcls_clsid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$clsid=$tmp[0];
		}
		$this->assign('clsid',$clsid);
		
		import('@.XQ.XQAction');
		$xqw = new XQAction();//外来的学期
		$xqnm=$xqw->getxqnm($grdid, $sttid, $xqid);
		$this->assign('xqnmsx',$xqnm);//sx 筛选
		$stt=M('stt');
		$stto=$stt->where('sttid='.$sttid)->find();
		$this->assign('sttnmsx',$stto['sttnm']);
		$cls=M($grdo['grdnm'].'_cls');
		$clso=$cls->where('clsid='.$clsid)->find();
		$this->assign('clsnmsx',$clso['clsnm']);
		
		
		$spccdtint='-sp-';////
		$odrint='-f_mj_bxxsid ASC-clsid ASC-mjid ASC-stdno ASC-';
		$lmtint=100;
		$jn='tb_stt ON f_std_sttid=sttid-jn-tb_grd ON f_std_grdid=grdid-jn-tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid-jn-tb_bxxs ON f_mj_bxxsid=bxxsid-jn-tb_cc ON f_mj_ccid=ccid-jn-tb_kl ON f_mj_klid=klid-jn-tb_xxxs ON f_mj_xxxsid=xxxsid-jn-tb_zsfw ON f_mj_zsfwid=zsfwid-jn-tb_xz ON f_mj_xzid=xzid-jn-tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid-jn-tb_sex ON f_std_sexid=sexid-jn-tb_rc ON f_std_rcid=rcid-jn-tb_zzmm ON f_std_zzmmid=zzmmid-jn-tb_xl ON f_std_xlid=xlid-jn-tb_stat ON f_std_statid=statid-jn-tb_xq ON f_stdxqcls_xqid=xqid';
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($std,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		if(preg_match('/f_stdxqcls_clsid/',$arr['cdt'])){
			
			$tmp=explode('f_stdxqcls_clsid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$clsid=$tmp[0];
			
			//判断std所在的班级，当前人员能否修改。。。其实就是看他是教务的还是管理员还是他亲生班主任
			$mls=$arr['mls'];
			$bzr=M($grdo['grdnm'].'_bzr');
			$mlsfn=array();
			$cjzx=M($grdo['grdnm'].'_cjzx');
			//获取有多少该班最多有多少门课
			
			$pkidls=$cjzx->Distinct(true)->field('pkid')->join('tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid')->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->join('tb_'.$grdo['grdnm'].'_std ON f_cjzx_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid')->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_cjzx_xqid=".$xqid." AND f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_std_statid=5 AND  f_stdxqcls_clsid=".$clsid)->select();
			
			$where='1=2';
			foreach ($pkidls as $vI){
				$where=$where.' OR pkid='.$vI['pkid'];
			}
			$pk=m($grdo['grdnm'].'_pk');
			$pkls=$pk->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->where($where)->order('pkzkkm ASC,kcnm ASC')->select();
			
			
			$iforcnt=0;
			foreach($mls as $v){
				$iforcnt++;
				$v['xh']=$iforcnt;
				
				$bzro=$bzr->where('f_bzr_clsid='.$v['f_stdxqcls_clsid'])->find();
				if($athofn['aths']==1||session('usridss')==$bzro['f_bzr_usrid']){//aths==1说明是教务的人或者是管理员
					$v['mdf']=1;
				}else{
					$v['mdf']=0;
				}
				$cjzxls=array();
				foreach ($pkls as $vI){
					$cjzxo=$cjzx->join('tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid')->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->where('f_cjzx_grdid='.$grdid.' AND f_cjzx_sttid='.$sttid.' AND f_cjzx_xqid='.$xqid.' AND f_cjzx_stdid='.$v['stdid'].' AND f_cjzx_pkid='.$vI['pkid'])->find();
					
					if($cjzxo){
						if($cjzxo['cjzxsftj']==0){
							if($cjzxo['cjzxxk']==0&&$cjzxo['cjzxqk']==0&&$cjzxo['cjzxhk']==0){
								$cjzxo['cjzxzf']='';
							}
						}
					}else{
						$cjzxo['cjzxzf']='未选该课';
					}
					array_push($cjzxls, $cjzxo);
				}
				

				$v['cjzxls']=$cjzxls;
				
				//查看是否有评论过
				$pl=M($grdo['grdnm'].'_pl');
				if($pl->where('f_pl_grdid='.$grdid.' AND f_pl_sttid='.$sttid.' AND f_pl_xqid='.$xqid.' AND f_pl_stdid='.$v['stdid'])->find()){
					$plo=$pl->where('f_pl_grdid='.$grdid.' AND f_pl_sttid='.$sttid.' AND f_pl_xqid='.$xqid.' AND f_pl_stdid='.$v['stdid'])->find();
					$v['plid']=$plo['plid'];
				}else{
					$v['plid']=0;
				}
				
				array_push($mlsfn, $v);
			}
			//已最后一个学生选课为例
			$this->assign('pkls',$pkls);
			
			
			$this->assign('mls',$mlsfn);
			$this->assign('page_method',$arr['page_method']);
		}
		$this->assign('fstrw',$arr['fstrw']);
		$this->assign('sqlstc',$arr['sqlstc']);
		$this->assign('fld',$arr['fld']);
		$this->assign('cdt',$arr['cdt']);
		$this->assign('spccdt',$arr['spccdt']);////
		$this->assign('odr',$arr['odr']);
		$this->assign('lmt',$arr['lmt']);
		$this->assign('count',$arr['count']);
		
		//NB初始化，结束
				
		//q特殊
		$grd=M('grd');
		$grdls=$grd->order('grdnm DESC')->select();
		$this->assign('grdls',$grdls);
		
		
		$stt=M('stt');//因为你站点可能木有了，但是站点已经招的学生阔能还在，因此要保留站点
		if($athofnstt['aths']==1){
			$sttls=$stt->select();
		}else{
			$sttls=$stt->where('sttid='.$usro['f_usr_sttid'])->select();
		}
		$this->assign('sttls',$sttls);
		
		
		
		//q特殊
		$xq=M('xq');
		if(preg_match('/f_std_sttid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_std_sttid', $cdt);
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
		$cdt=$arr['cdt'];
		$where='1=1';
		if(preg_match('/f_std_sttid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_std_sttid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$where=$where.' AND f_cls_sttid='.$tmp[0];
		}else{
			if($athofnstt['aths']==1){
				$where=$where.' AND f_cls_sttid=1';
			}else{
				$where=$where.' AND f_cls_sttid='.$usro['f_usr_sttid'];
			}
		}
		//之前已经确定过到底是看哪个年级
		$where=$where.' AND f_cls_grdid='.$grdid;
		$cls=M($grdo['grdnm'].'_cls');
		$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where($where)->order('clsnm ASC')->select();
		$this->assign('clsls',$clsls);

		
		
		//用于生成xls
		$this->assign('grdnm',$grdo['grdnm']);
		
		//q特殊
		$this->assign('title','浏览成绩单列表');
		$this->assign('theme','成绩管理');
		
		$this->display('query');
	}
	
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$plid=$_POST['plid'];
		
		$grdid=$_POST['f_pl_grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		$pl=M($grdo['grdnm'].'_pl');
		
		
		if($plid==0){
			
			//先截获数据
			$data=array(
					'f_pl_grdid'=>$_POST['f_pl_grdid'],
					'f_pl_sttid'=>$_POST['f_pl_sttid'],
					'f_pl_xqid'=>$_POST['f_pl_xqid'],
					'f_pl_stdid'=>$_POST['f_pl_stdid'],
					'plctt'=>stripslashes($_POST['plctt']),
					
			);
			
			if($pl->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
				
		}else{
			
			//先截获数据
				
			$data=array(
					'f_pl_grdid'=>$_POST['f_pl_grdid'],
					'f_pl_sttid'=>$_POST['f_pl_sttid'],
					'f_pl_xqid'=>$_POST['f_pl_xqid'],
					'f_pl_stdid'=>$_POST['f_pl_stdid'],
					'plctt'=>stripslashes($_POST['plctt']),
					
			);
				
			if($pl->where('plid='.$plid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
				
		}
	}
	
	function createAlways(){
		$grdid=$_POST['f_std_grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		$cls=M($grdo['grdnm'].'_cls');
		
		$xq=M('xq');
		$xqodq=$xq->where('xqdq=1')->find();
	
	
	
		$wherecls='1=1';
		if($_POST['f_std_sttid']){
			$wherecls=$wherecls.' AND f_cls_sttid='.$_POST['f_std_sttid'];
			
		}
		if($_POST['f_std_grdid']){
			$wherecls=$wherecls.' AND f_cls_grdid='.$_POST['f_std_grdid'];
			
		}
		$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where($wherecls)->order('clsnm ASC')->select();
		$clsoptu="<option value=''>无</option>";
		foreach ($clsls as $v){
			$clsoptu=$clsoptu."<option value='".$v['clsid']."'>[".$v['sttnm'].']'.$v['clsnm']."</option>";
		}
		
	
	
		$data['clsoptu']=$clsoptu;
		
	
		if($_POST['f_std_sttid']){
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqls=$xqw->getxqls($grdo['grdid'], $_POST['f_std_sttid'], 'DESC');
		}else{
			$xq=M('xq');
			$xqls=$xq->order('xqnm DESC')->select();
		}
		$xqoptu='';
		foreach ($xqls as $v){
			if($v['xqid']==$xqodq['xqid']){
				$xqoptu=$xqoptu."<option value='".$v['xqid']."' selected>".$v['xqnm']."</option>";
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