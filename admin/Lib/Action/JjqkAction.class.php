<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class JjqkAction extends Action{
	
	
	
	function gtxpg(){
		

		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Jjqk'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],$x);
		
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
		
		if($x=='vw'){
			
			$grdid=$_GET['grdid'];
			
			$xkid=$_GET['xkid'];;
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$xk=M($grdo['grdnm'].'_xk');
			$mo=$xk->join('tb_stt ON f_xk_sttid=sttid')->join('tb_grd ON f_xk_grdid=grdid')->join('tb_xq ON f_xk_xqid=xqid')->join('tb_'.$grdo['grdnm'].'_kc ON f_xk_kcid=kcid')->join('tb_tcr ON f_xk_tcrid=tcrid')->where("xkid=".$xkid)->find();
			
			
			//需要看下如果是其他函授站的可以能要第一学期，第二学期，第三学期之类的很BT的东西
			
			//适应一些站点用一二三
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqnm=$xqw->getxqnm($grdid, $mo['f_xk_sttid'], $mo['f_xk_xqid']);
			$mo['xqnm']=$xqnm;
			
			$this->assign('mo',$mo);
			
			
			
			
			
			
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){

			$grdid=$_GET['grdid'];
			$xkid=$_GET['xkid'];;
			
			
				
			$usr=M('usr');
			$usro=$usr->where('usrid='.session('usridss'))->find();
			//鉴权对用户对stt的权限，若为设置权限，说明是教务的人，可以全管，否则只能管自己函授站的 ntf为不用this assign的
			$mdII=M('md');
			$mdo=$mdII->where("mdmk='Stt'")->find();
			import('@.IDTATH.IdtathAction');
			$Idtath = new IdtathAction();
			$athofnstt=$Idtath->identify($mdo['mdid'],'ntf');
			
			if($xkid==0){
				$mo['xkid']=0;
				
				
				
				//默认年级是当前年级
				$grd=M('grd');
				$grdo=$grd->order('grdnm DESC')->find();
				$grdid=$grdo['grdid'];
				$mo['f_xk_grdid']=$grdid;
				
				
				//默认站点，有主的找有主的，没主的找本部
				if($athofnstt['aths']!=1){
					$mo['f_xk_sttid']=$usro['f_usr_sttid'];
				}else{
					$mo['f_xk_sttid']=1;
				}
				
				//默认学期 为XX年级XX站点的起始学期
				$xq=M('xq');
				$xqo=$xq->where('xqdq=1')->find();
				$xqid=$xqo['xqid'];
				$sttintxq=M($grdo['grdnm'].'_sttintxq');
				$sttintxqo=$sttintxq->where('f_sttintxq_grdid='.$grdo['grdid'].' AND f_sttintxq_sttid='.$mo['f_xk_sttid'])->find();
				if($xqid<$sttintxqo['f_sttintxq_xqid']){$xqid=$sttintxqo['f_sttintxq_xqid'];}//①如果激活的学期在初始学期后范围内的那么就选激活的学期②如果...在范围外的话呢就选择第初始学期为默认学期
				$mo['f_xk_xqid']=$xqid;
				
				
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
				
				
				
				
				
			}else{
				
				$grd=M('grd');
				$grdo=$grd->where('grdid='.$grdid)->find();
				
				$xk=M($grdo['grdnm'].'_xk');
				$mo=$xk->join('tb_stt ON f_xk_sttid=sttid')->join('tb_grd ON f_xk_grdid=grdid')->join('tb_xq ON f_xk_xqid=xqid')->join('tb_'.$grdo['grdnm'].'_kc ON f_xk_kcid=kcid')->join('tb_tcr ON f_xk_tcrid=tcrid')->where("xkid=".$xkid)->find();
					
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
			$xqls=$xqw->getxqls($grdo['grdid'], $mo['f_xk_sttid'], 'DESC');
			$this->assign('xqls',$xqls);
			
			//课程
			//q特殊
			
			$kc=M($grdo['grdnm'].'_kc');
			$kcls=$kc->where('f_kc_grdid='.$grdo['grdid'])->select();
			$this->assign('kcls',$kcls);
			
			//教师
			//q特殊
			$tcr=M('tcr');
			$tcrls=$tcr->where('f_tcr_sttid='.$mo['f_xk_sttid'])->select();
			$this->assign('tcrls',$tcrls);
			
			
			$this->display('update');
		}
		
	
	}
	
	
	
	
	//------------------【】【】【】【】以上是选课部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");

		
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Jjqk'")->find();
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
		
		//NB初始化，开始
		$cdt=$_GET['cdt'];
		$grd=M('grd');
		if(preg_match('/f_cjzx_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_cjzx_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
		}else{
			//默认grdid
			$grdo=$grd->order('grdid DESC')->find();
			$grdid=$grdo['grdid'];
		}
		$this->assign('grdiddft',$grdid);
			
		$grdo=$grd->where('grdid='.$grdid)->find();
		$cjzx=clone M($grdo['grdnm'].'_cjzx');
		$cjzxys=clone M($grdo['grdnm'].'_cjzx');//原生成绩中心
		$cjzxforcls=clone M($grdo['grdnm'].'_cjzx');
		$cjzx->join('tb_'.$grdo['grdnm'].'_std ON f_cjzx_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
		// 		$cjzxls=$cjzx->select();
			
		$fldint='-cjzxid-f_cjzx_grdid-stdno-stdnm-sexnm-pkzkkm-cjzxpsf-cjzxsftj-cjzxxk-cjzxqk-xqnm-f_cjzx_pkid-f_cjzx_xqid-kcnm-tcrnn-';
			
		if(preg_match('/f_cjzx_sttid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_cjzx_sttid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$sttid=$tmp[0];
		}else{
			//默认sttid
			if($athofnstt['aths']==1){
				$sttid=1;
			}else{
				$sttid=$usro['f_usr_sttid'];
			}
		}
		$this->assign('sttiddft',$sttid);
			
		if(preg_match('/f_cjzx_xqid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_cjzx_xqid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$xqid=$tmp[0];
		}else{
			$xq=M('xq');
			$xqo=$xq->where('xqdq=1')->find();
			$xqid=$xqo['xqid'];
			$sttintxq=M($grdo['grdnm'].'_sttintxq');
			$sttintxqo=$sttintxq->where('f_sttintxq_grdid='.$grdo['grdid'].' AND f_sttintxq_sttid='.$sttid)->find();
			if($xqid<$sttintxqo['f_sttintxq_xqid']){$xqid=$sttintxqo['f_sttintxq_xqid'];}//①如果激活的学期在初始学期后范围内的那么就选激活的学期②如果...在范围外的话呢就选择第初始学期为默认学期
		
		}
		$this->assign('xqiddft',$xqid);
			
		$cdtint="-sp-f_cjzx_grdid-eq-".$grdid."-sp-f_cjzx_sttid-eq-".$sttid."-sp-f_cjzx_xqid-eq-".$xqid.'-sp-'."f_pk_grdid-eq-".$grdid."-sp-f_pk_sttid-eq-".$sttid."-sp-f_pk_xqid-eq-".$xqid.'-sp-'."f_std_grdid-eq-".$grdid."-sp-f_std_sttid-eq-".$sttid."-sp-f_std_statid-eq-5-sp-f_stdxqcls_xqid-eq-".$xqid."-sp-f_stdxqmj_xqid-eq-".$xqid.'-sp-';
		$spccdtint='-sp-';////
		$odrint='-f_mj_bxxsid ASC-clsid ASC-mjid ASC-stdno ASC-pkzkkm ASC-kcnm ASC-';
			
		$lmtint=100;
		$jn='tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid-jn-tb_stt ON f_cjzx_sttid=sttid-jn-tb_grd ON f_cjzx_grdid=grdid-jn-tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid-jn-tb_tcr ON f_pk_tcrid=tcrid-jn-tb_xq ON f_cjzx_xqid=xqid'.'-jn-tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid-jn-tb_bxxs ON f_mj_bxxsid=bxxsid-jn-tb_cc ON f_mj_ccid=ccid-jn-tb_kl ON f_mj_klid=klid-jn-tb_xxxs ON f_mj_xxxsid=xxxsid-jn-tb_zsfw ON f_mj_zsfwid=zsfwid-jn-tb_xz ON f_mj_xzid=xzid-jn-tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid-jn-tb_sex ON f_std_sexid=sexid-jn-tb_rc ON f_std_rcid=rcid-jn-tb_zzmm ON f_std_zzmmid=zzmmid-jn-tb_xl ON f_std_xlid=xlid-jn-tb_stat ON f_std_statid=statid';
		import('@.NB.NBAction');
		$NB = new NBAction();
			
		$cls=M($grdo['grdnm'].'_cls');
		$clsls=$cls->where('clsactvt=1 AND f_cls_sttid='.$sttid)->order('clsnm ASC')->select();
		
		$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
		$clslsfn=array();
		
		//不管你filed啊JOIN啊，多少东西，一旦搞上了，脱不掉的，但是一旦查询一次后，这些搞上的就统统没了，要查询重新搞
		//简称 搞上 查询掉
		foreach ($clsls as $v){
			
			$clsid=$v['clsid'];//找学生代表
			
			//JOIN只能JOIN一次//但是实践发现 for第二轮循环的时候join部分被剥离了。
			
			$stdls=$stdxqcls->join('tb_'.$grdo['grdnm'].'_std ON f_stdxqcls_stdid=stdid')->where('f_stdxqcls_xqid='.$xqid.' AND f_stdxqcls_clsid='.$clsid.' AND f_std_statid=5')->order('stdno ASC')->select();
			//默认第一个学生为学生代表
			$pkidls=$cjzxforcls->Distinct(true)->field('pkid')->join('tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid')->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->join('tb_'.$grdo['grdnm'].'_std ON f_cjzx_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid')->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_cjzx_xqid=".$xqid." AND f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_std_statid=5 AND  f_stdxqcls_clsid=".$v['clsid'])->select();
			
			$where='1=2';
			foreach ($pkidls as $vI){
				$where=$where.' OR pkid='.$vI['pkid'];
			}
			$pk=m($grdo['grdnm'].'_pk');
			$pkls=$pk->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->where($where)->order('pkzkkm ASC,kcnm ASC')->select();
			//只需要判断这门课选了的相关学生有一个人被提交了，那么整个班都提交了
			

			//针对每一个pk，我们要查看教师是否已经提交了//PS：这里的PK实质是cjzx
			$pklsfn=array();
			foreach($pkls as $vI){
				//先看任课老师交卷是否妥
				$jjflg=0;$jjyiflg=0;$jjlingflg=0;//看看sftj全是在0这还是全是在1这，还是0这里有几个，1这里也有几个
				/*由于全部都要内啥太慢了，而且老师那个是批量提交的所以一个代表也够
				foreach($stdls as $vII){
					$cjzxoys=$cjzxys->where('f_cjzx_grdid='.$grdid.' AND f_cjzx_sttid='.$sttid.' AND f_cjzx_xqid='.$xqid.' AND f_cjzx_pkid='.$vI['f_cjzx_pkid'].' AND f_cjzx_stdid='.$vII['f_stdxqcls_stdid'])->find();
					//交卷而言每一个学生都是有效学生
					$jjyxstd=1;
					if($cjzxoys['cjzxsftj']==1){
						$jjyiflg=1;
					}
					if($cjzxoys['cjzxsftj']==0){
						$jjlingflg=1;
					}
					
					
				}
				if($jjyiflg==1&&$jjlingflg==0){
					$jjflg=1;//提交全
				}
				if($jjyiflg==1&&$jjlingflg==1){
					$jjflg=2;//没提交全
				}
				$vI['jjflg']=$jjflg;//分三种情况：有效学生中，大伙要么无1，要么全1，要么部分1
				*/
				
				$cjzxoys=$cjzxys->join('tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid')->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->join('tb_'.$grdo['grdnm'].'_std ON f_cjzx_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid')->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_cjzx_xqid=".$xqid." AND f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_std_statid=5 AND  f_stdxqcls_clsid=".$v['clsid'].' AND f_cjzx_pkid='.$vI['pkid'])->find();
				if($cjzxoys['cjzxsftj']==1){
					$jjflg=1;
				}
				$vI['jjflg']=$jjflg;
				
				
				//再看班主任老师平时分是否批完
				$psflg=0;$psyouflg=0;$pswuflg=0;//看看sftj全是在0这还是全是在1这，还是0这里有几个，1这里也有几个
				//①只考虑班里面选了这门课的学生，再考虑有效学生。
				foreach($stdls as $vII){
					$cjzxoys=$cjzxys->where('f_cjzx_grdid='.$grdid.' AND f_cjzx_sttid='.$sttid.' AND f_cjzx_xqid='.$xqid.' AND f_cjzx_pkid='.$vI['pkid'].' AND f_cjzx_stdid='.$vII['f_stdxqcls_stdid'])->find();
					//交卷而言每一个学生都是有效学生
					if($cjzxoys){//可能某些学生没选，就没数据，没数据就不考虑，只考虑有数据的
						if($cjzxoys['cjzxpsf']!='限考'&&$cjzxoys['cjzxpsf']!='缺考'){//有效学生才有数
							$psyxstd=1;
						}else{
							$psyxstd=0;
						}
						if($psyxstd==1){
							if($cjzxoys['cjzxpsf']!=''){
								$psyouflg=1;
							}
							if($cjzxoys['cjzxpsf']==''){
								$pswuflg=1;
							}
						}
					}
					
				}
				if($psyouflg==1&&$pswuflg==0){
					$psflg=1;//提交全
				}
				if($psyouflg==1&&$pswuflg==1){
					$psflg=2;//没提交全
				}
				$vI['psflg']=$psflg;//分三种情况：有效学生中，大伙要么无1，要么全1，要么部分1
				
				array_push($pklsfn, $vI);
			}
			$v['pkls']=$pklsfn;
			array_push($clslsfn, $v);
		}
		//为了确保有NB过程，所以我们不管是有没有班级，统一NB一次，反正得到的ARR也不用，且却得到很多必要参数
		$arr=$NB->NB($cjzx,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn,'n','n');////
			
		$this->assign('fstrw',$arr['fstrw']);
		$this->assign('sqlstc',$arr['sqlstc']);
		$this->assign('fld',$arr['fld']);
		$this->assign('cdt',$arr['cdt']);
		$this->assign('spccdt',$arr['spccdt']);////
		$this->assign('odr',$arr['odr']);
		$this->assign('lmt',$arr['lmt']);
		$this->assign('count',$arr['count']);
			
		$this->assign('clsls',$clslsfn);
			
		$grdls=$grd->order('grdnm DESC')->select();
		$this->assign('grdls',$grdls);
			
		$stt=M('stt');
		$sttls=$stt->order('sttid ASC')->select();
		$this->assign('sttls',$sttls);
			
		import('@.XQ.XQAction');
		$xqw = new XQAction();//外来的学期
		$xqls=$xqw->getxqls($grdo['grdid'], $sttid, 'DESC');
		$this->assign('xqls',$xqls);
			
		
		
		
		//q特殊
		$this->assign('title','交卷情况列表');
		$this->assign('theme','交卷情况管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$xkid=$_POST['xkid'];
	
		if($xkid==0){
			
			$f_xk_grdid=$_POST['f_xk_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$f_xk_grdid)->find();
			$xk=M($grdo['grdnm'].'_xk');
			
			$data=array(
					
					'f_xk_grdid'=>$_POST['f_xk_grdid'],
					'f_xk_sttid'=>$_POST['f_xk_sttid'],
					'f_xk_xqid'=>$_POST['f_xk_xqid'],
					
					'f_xk_kcid'=>$_POST['f_xk_kcid'],
					'f_xk_tcrid'=>$_POST['f_xk_tcrid'],
					
					'xkwqm'=>$_POST['xkwqm'],
					'xkwps'=>$_POST['xkwps'],
					'xkwxt'=>$_POST['xkwxt'],
					
				
			);
			//查一查有没有同名选课网名
			
			if($xk->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$f_xk_grdid=$_POST['f_xk_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$f_xk_grdid)->find();
			$xk=M($grdo['grdnm'].'_xk');
			
			
			
			//先截获数据//选课基本部分
			$data=array(
					
					'f_xk_grdid'=>$_POST['f_xk_grdid'],
					'f_xk_sttid'=>$_POST['f_xk_sttid'],
					'f_xk_xqid'=>$_POST['f_xk_xqid'],
					
					'f_xk_kcid'=>$_POST['f_xk_kcid'],
					'f_xk_tcrid'=>$_POST['f_xk_tcrid'],
					
					'xkwqm'=>$_POST['xkwqm'],
					'xkwps'=>$_POST['xkwps'],
					'xkwxt'=>$_POST['xkwxt'],
					
				
			);
			
			
			if($xk->where('xkid='.$_POST['xkid'])->setField($data)){
				
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
		$xkxqcls=M($grdo['grdnm'].'_xkxqcls');	
		$xkxqmj=M($grdo['grdnm'].'_xkxqmj');
		$xk=M($grdo['grdnm'].'_xk');
		if($xk->delete($_POST['xkid'])){
			$xkxqcls->where('f_xkxqcls_xkid='.$_POST['xkid'])->delete();
			$xkxqmj->where('f_xkxqmj_xkid='.$_POST['xkid'])->delete();
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($xk->getLastSql());
		}
	}
	
	
	
	function createAlways(){
		$grdid=$_POST['f_cjzx_grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		//改变的是学期 是课程 是老师
		$cls=M($grdo['grdnm'].'_cls');
// 		$pk=M($grdo['grdnm'].'_pk');
		
		$xq=M('xq');
		$xqodq=$xq->where('xqdq=1')->find();
		
		if($_POST['f_stdxqcls_clsid']!='bkl'){
			$wherecls='1=1';
			// 		$wherepk='1=1';
			
			if($_POST['f_cjzx_sttid']){
				$wherecls=$wherecls.' AND f_cls_sttid='.$_POST['f_cjzx_sttid'];
				// 			$wherepk=$wherepk.' AND f_pk_sttid='.$_POST['f_xk_sttid'];
					
					
			}
			if($_POST['f_xk_grdid']){
				$wherecls=$wherecls.' AND f_cls_grdid='.$_POST['f_xk_grdid'];
				// 			$wherepk=$wherepk.' AND f_pk_grdid='.$_POST['f_xk_grdid'];
					
			}
			
			// 		if($_POST['f_xk_xqid']){
			// 			$wherepk=$wherepk.' AND f_pk_xqid='.$_POST['f_xk_xqid'];
			
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
		}
		
		
		
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
			if($v['xqid']==$xqodq['xqid']){
				$xqoptu=$xqoptu."<option value='".$v['xqid']."' selected >".$v['xqnm']."</option>";
			}else{
				$xqoptu=$xqoptu."<option value='".$v['xqid']."'>".$v['xqnm']."</option>";
			}
		}
		$data['xqoptu']=$xqoptu;
		
		
		
		if($_POST['f_stdxqcls_clsid']){
			//找那个班的学生代表看看他选了那些选课
			$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
			$stdxqclso=$stdxqcls->join('tb_'.$grdo['grdnm'].'_std ON f_stdxqcls_stdid=stdid')->where('f_stdxqcls_xqid='.$_POST['f_xk_xqid'].' AND f_stdxqcls_clsid='.$_POST['f_stdxqcls_clsid'].' AND f_std_statid=5')->find();
			$xk=M($grdo['grdnm'].'_xk');
			$pkls=$xk->join('tb_'.$grdo['grdnm'].'_pk ON f_xk_pkid=pkid')->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->join('tb_tcr ON f_pk_tcrid=tcrid')->where('f_xk_sttid='.$_POST['f_xk_sttid'].' AND f_xk_xqid='.$_POST['f_xk_xqid'].' AND f_xk_stdid='.$stdxqclso['f_stdxqcls_stdid'])->select();
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