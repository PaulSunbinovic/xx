<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class ZspxhAction extends Action{
	
	
	
// 	function gtxpg(){
		

// 		//先给hd设置好些东西，他自身是无法提取的
// 		import('@.SS.SSAction');
// 		$ss = new SSAction();
// 		$ss->setss();
	
// 		$x=$_GET['x'];
		
// 		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
// 		$mdII=M('md');
// 		$mdo=$mdII->where("mdmk='Zspxh'")->find();
// 		import('@.IDTATH.IdtathAction');
// 		$Idtath = new IdtathAction();
// 		$athofn=$Idtath->identify($mdo['mdid'],$x);
		
// 		import('@.NTF.NTFAction');
// 		$ntf = new NTFAction();
// 		$ntf->setntf();
		
// 		import('@.KZMB.KZMBAction');
// 		$kzmb = new KZMBAction();
// 		$kzmb->setkzmb($mdo['mdid']);
		
// 		$zssz=M('zssz');
// 		$zsszo=$zssz->find();
// 		$grdid=$zsszo['f_zssz_grdid'];
// 		$xqid=$zsszo['f_zssz_xqid'];
// 		$sttid=1;
		
// 		if($x=='vw'){
			
// 			$stdid=$_GET['stdid'];;
// 			$grd=M('grd');
// 			$grdo=$grd->where('grdid='.$grdid)->find();
// 			$std=M($grdo['grdnm'].'_std')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
// 			$mo=$std->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND stdid=".$stdid)->find();
			
// 			//给专业多点修饰
// 			if(preg_match('/技能/',$mo['bxxsnm'])){
// 				$mo['bxxsnmst']='技能';
// 			}else if(preg_match('/自考/',$mo['bxxsnm'])){
// 				$mo['bxxsnmst']='自考';
// 			}else{
// 				$mo['bxxsnmst']='普通';
// 			}
// 			//需要看下如果是其他函授站的可以能要第一学期，第二学期，第三学期之类的很BT的东西
			
// 			//适应一些站点用一二三
// 			import('@.XQ.XQAction');
// 			$xqw = new XQAction();//外来的学期
// 			$xqnm=$xqw->getxqnm($grdid, $mo['f_std_sttid'], $xqid);
// 			$mo['xqnm']=$xqnm;
			
// 			if($athofn['aths']==1){//aths==1说明是教务的人或者是管理员
// 				$mo['mdf']=1;
// 			}else{
// 				$mo['mdf']=0;
// 			}
			
// 			$this->assign('mo',$mo);
			
			
			
// 			//搞推荐人
// 			if($mo['stdrcmdnm']||$mo['stdrcmdcp']){
// 				$this->assign('ifrcmd','是');
// 			}else{
// 				$this->assign('ifrcmd','否');
// 			}
			
			
			
// 			//特殊情况
// 			$tsqk=M($grdo['grdnm'].'_tsqk');
// 			$tsqkls=$tsqk->where('f_tsqk_stdid='.$stdid)->order('tsqktm DESC')->select();
// 			$this->assign('tsqkls',$tsqkls);
			
			
// 			$this->assign('title','查看');
// 			$this->assign('theme','查看详细');
// 			$this->display('view');
// 		}else if($x=='updt'){

// 			$stdid=$_GET['stdid'];;
			
			
// 			if($stdid==0){
// 				$mo['stdid']=0;
				
// 				$mo['stdsol']='无';
				
// 				$mo['stdpt']=C('PUBLIC').'/IMG/default.jpg';
// 				//第几学年 第几学期的班级 第几学年 第几学期的专业 ...
// 				//因为grd无法定下来，所以stdxqcls stdxqmj_xqid 定下来也没有意义，干脆就不定了，等搜索时候自由分晓
				
// 				//默认年级是当前年级
// 				$grd=M('grd');
// 				$grdo=$grd->where('grdid='.$grdid)->find();
// 				$mo['f_std_grdid']=$grdid;
// 				$mo['grdnm']=$grdo['grdnm'];
				
// 				//默认站点，有主的找有主的，没主的找本部
// 				$mo['f_std_sttid']=1;
				
// 				//默认学期 为XX年级XX站点的起始学期
// 				$mo['f_stdxqcls_xqid']=$xqid;
// 				$mo['f_stdxqmj_xqid']=$xqid;
				
				
				
// 				$this->assign('title','添加');
// 				$this->assign('theme','添加：');
// 				$this->assign('btnvl','添加');
				
				
// 				//q特殊
// 				$xq=M('xq');
// 				$xqls=$xq->where('xqid='.$xqid)->select();//我TMD就为了一个置顶的xq来了
// 				$this->assign('xqls',$xqls);
				
// 				$where='1=1';
// 				$where=$where.' AND f_cls_sttid=1';
// 				//之前已经确定过到底是看哪个年级
// 				$where=$where.' AND f_cls_grdid='.$grdid;
// 				$cls=M($grdo['grdnm'].'_cls');
// 				$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where($where)->order('clsnm ASC')->select();
// 				$this->assign('clsls',$clsls);
					
					
// 				$where='1=1';
// 				$where=$where." AND mjsttu LIKE '%-1-%'";
// 				//之前已经确定过到底是看哪个年级
// 				$where=$where.' AND f_mj_grdid='.$grdid;
// 				$mj=M($grdo['grdnm'].'_mj');
// 				$mjls=$mj->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->where($where)->order('f_mj_bxxsid ASC,mjdm ASC')->select();
// 				$mjlsnw=array();
// 				foreach($mjls as $v){
// 					//给专业多点修饰
// 					if(preg_match('/技能/',$v['bxxsnm'])){
// 						$v['bxxsnmst']='技能';
// 					}else if(preg_match('/自考/',$v['bxxsnm'])){
// 						$v['bxxsnmst']='自考';
// 					}else{
// 						$v['bxxsnmst']='普通';
// 					}
// 					array_push($mjlsnw, $v);
// 				}
// 				$this->assign('mjls',$mjlsnw);
				
// 			}else{
				
// 				$grd=M('grd');
// 				$grdo=$grd->where('grdid='.$grdid)->find();
				
// 				$std=M($grdo['grdnm'].'_std')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
				
// 				$mo=$std->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND stdid=".$stdid)->find();
// 				$this->assign('title','修改');
// 				$this->assign('theme','修改：');
// 				$this->assign('btnvl','修改');
				
				
// 				//q特殊
// 				import('@.XQ.XQAction');
// 				$xqw = new XQAction();//外来的学期
// 				$xqls=$xqw->getxqls($grdo['grdid'], 1, 'DESC');
// 				$this->assign('xqls',$xqls);
				
// 				$where='1=1';
// 				$where=$where.' AND f_cls_sttid=1';
// 				//之前已经确定过到底是看哪个年级
// 				$where=$where.' AND f_cls_grdid='.$grdid;
// 				$cls=M($grdo['grdnm'].'_cls');
// 				$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where($where)->order('clsnm ASC')->select();
// 				$this->assign('clsls',$clsls);
					
					
// 				$where='1=1';
// 				$where=$where." AND mjsttu LIKE '%-1-%' AND f_mj_bxxsid=".$mo['f_mj_bxxsid'];
// 				//之前已经确定过到底是看哪个年级
// 				$where=$where.' AND f_mj_grdid='.$grdid;
// 				$mj=M($grdo['grdnm'].'_mj');
// 				$mjls=$mj->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->where($where)->order('f_mj_bxxsid ASC,mjdm ASC')->select();
// 				$mjlsnw=array();
// 				foreach($mjls as $v){
// 					//给专业多点修饰
// 					if(preg_match('/技能/',$v['bxxsnm'])){
// 						$v['bxxsnmst']='技能';
// 					}else if(preg_match('/自考/',$v['bxxsnm'])){
// 						$v['bxxsnmst']='自考';
// 					}else{
// 						$v['bxxsnmst']='普通';
// 					}
// 					array_push($mjlsnw, $v);
// 				}
// 				$this->assign('mjls',$mjlsnw);
				
				
				
// 				//特殊情况
// 				$tsqk=M($grdo['grdnm'].'_tsqk');
// 				$tsqkls=$tsqk->where('f_tsqk_stdid='.$stdid)->order('tsqktm DESC')->select();
// 				$this->assign('tsqkls',$tsqkls);
// 			}
			
			
// // 			//搞学生照片
// // 			if(file_exists('./Uploads/std/'.$grdo['grdnm'].'/'.$mo['f_std_sttid'].'/'.$mo['stdno'].'.jpg')){
// // 				$mo['stdpt']=__ROOT__.'/Uploads/std/'.$grdo['grdnm'].'/'.$mo['f_std_sttid'].'/'.$mo['stdno'].'.jpg';
// // 			}else{
// // 				$mo['stdpt']=C('PUBLIC').'/IMG/default.jpg';
// // 			}
			
// 			$this->assign('mo',$mo);
			
			
// 			//q特殊
// 			$tmp=explode('-', $zsszo['zsszbxxsu']);
// 			$where='1=2';
// 			for($i=1;$i<count($tmp)-1;$i++){
// 				$where=$where.' OR bxxsid='.$tmp[$i];
// 			}
// 			$bxxs=M('bxxs');
// 			$bxxsls=$bxxs->where($where)->select();
// 			$this->assign('bxxsls',$bxxsls);
			
// 			//q特殊
		
// 			$stt=M('stt');//因为你站点可能木有了，但是站点已经招的学生阔能还在，因此要保留站点
// 			$sttls=$stt->where('sttid=1')->select();
// 			$this->assign('sttls',$sttls);
			
// 			//q特殊
// 			$cc=M('cc');
// 			$ccls=$cc->where('ccid=3')->select();
// 			$this->assign('ccls',$ccls);
			
// 			//q特殊
// 			$kl=M('kl');
// 			$klls=$kl->select();
// 			$this->assign('klls',$klls);
// 			//q特殊
// 			$xxxs=M('xxxs');
// 			$xxxsls=$xxxs->where('xxxsid=2')->select();
// 			$this->assign('xxxsls',$xxxsls);
// 			//q特殊
// 			$zsfw=M('zsfw');
// 			$zsfwls=$zsfw->where('zsfwid=2')->select();
// 			$this->assign('zsfwls',$zsfwls);
// 			//q特殊
// 			$xz=M('xz');
// 			$xzls=$xz->where('xzid=2')->select();
// 			$this->assign('xzls',$xzls);
// 			//q特殊
// 			$grd=M('grd');
// 			$grdls=$grd->where('grdid='.$zsszo['f_zssz_grdid'])->order('grdnm DESC')->select();
// 			$this->assign('grdls',$grdls);
			
// 			$dm=M('dm');
// 			$dmls=$dm->select();
// 			$this->assign('dmls',$dmls);
// 			//q特殊
// 			$sex=M('sex');
// 			$sexls=$sex->select();
// 			$this->assign('sexls',$sexls);
// 			//q特殊
// 			$rc=M('rc');
// 			$rcls=$rc->select();
// 			$this->assign('rcls',$rcls);
// 			//q特殊
// 			$zzmm=M('zzmm');
// 			$zzmmls=$zzmm->select();
// 			$this->assign('zzmmls',$zzmmls);
// 			//q特殊
// 			$xl=M('xl');
// 			$xlls=$xl->select();
// 			$this->assign('xlls',$xlls);
			
			
			
			
			
			
// 			//q特殊
// 			$stat=M('stat');
// 			$statls=$stat->where("statactvt=1 AND statmk='zs'")->select();
// 			$this->assign('statls',$statls);
			
			
// 			//搞介绍人
// 			if($mo['stdrcmdnm']||$mo['stdrcmdcp']){
// 				$this->assign('ifrcmd','是');
// 				$this->assign('rcmdcls','');
// 			}else{
// 				$this->assign('ifrcmd','否');
// 				$this->assign('rcmdcls','readonly');
// 			}
			
// 			$this->display('update');
// 		}else if($x=='ylqtz'){
			
				
// 			//根据学期获得学年
// 			$xq=M('xq');
// 			$xqo=$xq->where('xqid='.$xqid)->find();
// 			if(preg_match('/第1学期/', $xqo['xqnm'])){
// 				$tmp=explode('-', $xqo[xqnm]);
// 				$xnnm=$tmp[0];
// 			}else{
// 				$tmp=explode('-', $xqo[xqnm]);
// 				$tmp=explode('学年', $tmp[1]);
// 				$xnnm=$tmp[0];
// 			}
// 			$xn=M('xn');
// 			$xno=$xn->where("xnnm='".$xnnm."'")->find();
				
				
// 			$stdid=$_GET['stdid'];
				
				
				
// 			$grd=M('grd');
// 			$grdo=$grd->where('grdid='.$grdid)->find();
// 			$cwo=M($grdo['grdnm'].'_cw')->where('f_cw_stdid='.$stdid.' AND f_cw_xnid='.$xno['xnid'])->find();
// 			$cwid=$cwo['cwid'];
// 			$xqid=$cwo['cwzcxqid'];
			
// 			$cw=M($grdo['grdnm'].'_cw')->join('tb_'.$grdo['grdnm'].'_std ON f_cw_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
// 			$mo=$cw->join('tb_xn ON f_cw_xnid=xnid')->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND cwid=".$cwid)->find();
				
// 			//给专业多点修饰
// 			if(preg_match('/技能/',$mo['bxxsnm'])){
// 				$mo['bxxsnmst']='技能';
// 			}else if(preg_match('/自考/',$mo['bxxsnm'])){
// 				$mo['bxxsnmst']='自考';
// 			}else{
// 				$mo['bxxsnmst']='普通';
// 			}
// 			//需要看下如果是其他函授站的可以能要第一学期，第二学期，第三学期之类的很BT的东西
				
// 			//适应一些站点用一二三
// 			import('@.XQ.XQAction');
// 			$xqw = new XQAction();//外来的学期
// 			$xqnm=$xqw->getxqnm($grdid, $mo['f_std_sttid'], $xqid);
// 			$mo['xqnm']=$xqnm;
// 			$mo['cwyjze']=$mo['cwyjxfsm']+$mo['cwyjjckwfsm']+$mo['cwyjzsfsm'];
// 			$mo['cwsjze']=$mo['cwsjxfsm']+$mo['cwsjjckwfsm']+$mo['cwsjzsfsm'];

			
// 			$this->assign('mo',$mo);
			
			
// 			//添加缴费信息1、学费教材考务费2、住宿费
// 			$mj=M($grdo['grdnm'].'_mj');
// 			$mjo=$mj->where('mjid='.$mo['f_stdxqmj_mjid'])->find();
// 			$xf=M($grdo['grdnm'].'_xf');
// 			$xfo=$xf->where('f_xf_sttid='.$mo['f_std_sttid'].' AND f_xf_bxxsid='.$mjo['f_mj_bxxsid'].' AND f_xf_ccid='.$mjo['f_mj_ccid'].' AND f_xf_klid='.$mjo['f_mj_klid'])->find();
// 			$zsf=M($grdo['grdnm'].'_zsf');
// 			$zsfo=$zsf->where('f_zsf_dmid='.$mo['f_stdxqdm_dmid'])->find();
// 			$this->assign('xfo',$xfo);
// 			$this->assign('zsfo',$zsfo);
				
// 			$this->assign('title','预录取通知书电子版');
// 			$this->assign('theme','预录取通知书电子版');
// 			$this->display('ylqtz');
// 		}else if($x=='stdda'){//学生档案
			
// 			$stdid=$_GET['stdid'];
			
// 			$grd=M('grd');
// 			$grdo=$grd->where('grdid='.$grdid)->find();
				
// 			$std=M($grdo['grdnm'].'_std')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
// 			$mo=$std
// 			->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')
// 			->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND stdid=".$stdid)
// 			->find();
			
// 			$this->assign('mo',$mo);
			
			
			
				
// 			$this->assign('title','学生档案流程单');
// 			$this->assign('theme','档案流程单');
// 			$this->display('stdda');
// 		}else if($x=='mdf'){

// 			$stdid=$_GET['stdid'];;
			
			
			
				
// 			$grd=M('grd');
// 			$grdo=$grd->where('grdid='.$grdid)->find();
			
// 			$std=M($grdo['grdnm'].'_std')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
			
// 			$mo=$std->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND stdid=".$stdid)->find();
// 			$this->assign('title','修改');
// 			$this->assign('theme','修改：');
// 			$this->assign('btnvl','修改');
			
			
// 			//q特殊
// 			import('@.XQ.XQAction');
// 			$xqw = new XQAction();//外来的学期
// 			$xqls=$xqw->getxqls($grdo['grdid'], 1, 'DESC');
// 			$this->assign('xqls',$xqls);
			
// 			$where='1=1';
// 			$where=$where.' AND f_cls_sttid=1';
// 			//之前已经确定过到底是看哪个年级
// 			$where=$where.' AND f_cls_grdid='.$grdid;
// 			$cls=M($grdo['grdnm'].'_cls');
// 			$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where($where)->order('clsnm ASC')->select();
// 			$this->assign('clsls',$clsls);
				
				
// 			$where='1=1';
// 			$where=$where." AND mjsttu LIKE '%-1-%' AND f_mj_bxxsid=".$mo['f_mj_bxxsid'];
// 			//之前已经确定过到底是看哪个年级
// 			$where=$where.' AND f_mj_grdid='.$grdid;
// 			$mj=M($grdo['grdnm'].'_mj');
// 			$mjls=$mj->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->where($where)->order('f_mj_bxxsid ASC,mjdm ASC')->select();
// 			$mjlsnw=array();
// 			foreach($mjls as $v){
// 				//给专业多点修饰
// 				if(preg_match('/技能/',$v['bxxsnm'])){
// 					$v['bxxsnmst']='技能';
// 				}else if(preg_match('/自考/',$v['bxxsnm'])){
// 					$v['bxxsnmst']='自考';
// 				}else{
// 					$v['bxxsnmst']='普通';
// 				}
// 				array_push($mjlsnw, $v);
// 			}
// 			$this->assign('mjls',$mjlsnw);
			
			
			
// 			//特殊情况
// 			$tsqk=M($grdo['grdnm'].'_tsqk');
// 			$tsqkls=$tsqk->where('f_tsqk_stdid='.$stdid)->order('tsqktm DESC')->select();
// 			$this->assign('tsqkls',$tsqkls);
			
			
			
// // 			//搞学生照片
// // 			if(file_exists('./Uploads/std/'.$grdo['grdnm'].'/'.$mo['f_std_sttid'].'/'.$mo['stdno'].'.jpg')){
// // 				$mo['stdpt']=__ROOT__.'/Uploads/std/'.$grdo['grdnm'].'/'.$mo['f_std_sttid'].'/'.$mo['stdno'].'.jpg';
// // 			}else{
// // 				$mo['stdpt']=C('PUBLIC').'/IMG/default.jpg';
// // 			}
			
// 			$this->assign('mo',$mo);
			
			
// 			//q特殊
// 			$tmp=explode('-', $zsszo['zsszbxxsu']);
// 			$where='1=2';
// 			for($i=1;$i<count($tmp)-1;$i++){
// 				$where=$where.' OR bxxsid='.$tmp[$i];
// 			}
// 			$bxxs=M('bxxs');
// 			$bxxsls=$bxxs->where($where)->select();
// 			$this->assign('bxxsls',$bxxsls);
			
// 			//q特殊
		
// 			$stt=M('stt');//因为你站点可能木有了，但是站点已经招的学生阔能还在，因此要保留站点
// 			$sttls=$stt->where('sttid=1')->select();
// 			$this->assign('sttls',$sttls);
			
// 			//q特殊
// 			$cc=M('cc');
// 			$ccls=$cc->where('ccid=3')->select();
// 			$this->assign('ccls',$ccls);
			
// 			//q特殊
// 			$kl=M('kl');
// 			$klls=$kl->select();
// 			$this->assign('klls',$klls);
// 			//q特殊
// 			$xxxs=M('xxxs');
// 			$xxxsls=$xxxs->where('xxxsid=2')->select();
// 			$this->assign('xxxsls',$xxxsls);
// 			//q特殊
// 			$zsfw=M('zsfw');
// 			$zsfwls=$zsfw->where('zsfwid=2')->select();
// 			$this->assign('zsfwls',$zsfwls);
// 			//q特殊
// 			$xz=M('xz');
// 			$xzls=$xz->where('xzid=2')->select();
// 			$this->assign('xzls',$xzls);
// 			//q特殊
// 			$grd=M('grd');
// 			$grdls=$grd->where('grdid='.$zsszo['f_zssz_grdid'])->order('grdnm DESC')->select();
// 			$this->assign('grdls',$grdls);
			
// 			$dm=M('dm');
// 			$dmls=$dm->select();
// 			$this->assign('dmls',$dmls);
// 			//q特殊
// 			$sex=M('sex');
// 			$sexls=$sex->select();
// 			$this->assign('sexls',$sexls);
// 			//q特殊
// 			$rc=M('rc');
// 			$rcls=$rc->select();
// 			$this->assign('rcls',$rcls);
// 			//q特殊
// 			$zzmm=M('zzmm');
// 			$zzmmls=$zzmm->select();
// 			$this->assign('zzmmls',$zzmmls);
// 			//q特殊
// 			$xl=M('xl');
// 			$xlls=$xl->select();
// 			$this->assign('xlls',$xlls);
			
			
			
			
			
			
// 			//q特殊
// 			$stat=M('stat');
// 			$statls=$stat->where("statactvt=1 AND statmk='zs'")->select();
// 			$this->assign('statls',$statls);
			
			
// 			//搞介绍人
// 			if($mo['stdrcmdnm']||$mo['stdrcmdcp']){
// 				$this->assign('ifrcmd','是');
// 				$this->assign('rcmdcls','');
// 			}else{
// 				$this->assign('ifrcmd','否');
// 				$this->assign('rcmdcls','readonly');
// 			}
			
// 			$this->display('update');
// 		}else if($x='stddtfx'){
// 			$xqiddq=$xqid;
// 			$bxxs=M('bxxs');
// 			$bxxsls=$bxxs->select();
// 			$dm=M('dm');
// 			$dmls=$dm->select();
// 			//先分开算再合起来
// 			$grd=M('grd');
// 			$grdls=$grd->where('grdid='.$grdid)->order('grdnm DESC')->select();
// 			$grdlsfn=array();
// 			foreach ($grdls as $grdv){
// 				$zl=array();//资料
				
				
// // 				$cls=M($grdv['grdnm'].'_cls');
// // 				$clsls=$cls->where('clsactvt=1 AND f_cls_sttid='.$sttid)->order('clsnm ASC')->select();
// 				$mj=M($grdv['grdnm'].'_mj');
// 				$mjls=$mj->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->where("mjsttu LIKE '%-".$sttid."-%' AND mjbbzs=1")->order('bxxsid ASC,mjnm ASC')->select();
				
// 				$std=M($grdv['grdnm'].'_std');
// 				if($std->count()==0){
// 					continue;
// 				}
// 				$zongsm=$std->count();$zl['zongsm']=$zongsm;//总大小
// 				$bulaism=$std->where('f_std_statid=9')->count();$zl['bulaism']=$bulaism;
// 				$kenenglaism=$std->where('f_std_statid<>9')->count();$zl['kenenglaism']=$kenenglaism;
// 				$zongnb=$std->where('f_std_statid<>9')->count();$zl['zongnb']=$zongnb;//
// 				$bynb=$std->where('f_std_statid<>9 AND f_std_sexid=1')->count();$zl['bynb']=$bynb;
// 				$glnb=$std->where('f_std_statid<>9 AND f_std_sexid=2')->count();$zl['glnb']=$glnb;
// 				//查看办学形式
// 				$bxxsarr=array();
// 				foreach ($bxxsls as $bxxsv){
// 					$bxxscnt=$std->join('inner join tb_'.$grdv['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdv['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid')->join('tb_'.$grdv['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->where("f_stdxqcls_xqid=".$xqiddq." AND f_stdxqmj_xqid=".$xqiddq.' AND f_mj_bxxsid='.$bxxsv['bxxsid'].' AND f_std_statid<>9')->count();
// 					if($bxxscnt==0){
// 						continue;
// 					}
// 					$bxxsv['bxxscnt']=$bxxscnt;
// 					array_push($bxxsarr, $bxxsv);
// 				}
// 				$zl['bxxs']=$bxxsarr;
// 				//查看住宿
// 				$dmarr=array();
// 				foreach ($dmls as $dmv){
// 					$dmcnt=$std->join('inner join tb_'.$grdv['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->where("f_stdxqdm_xqid=".$xqiddq.' AND f_stdxqdm_dmid='.$dmv['dmid'].' AND f_std_statid<>9')->count();
// 					if($dmcnt==0){
// 						continue;
// 					}
// 					$dmv['dmcnt']=$dmcnt;
// 					array_push($dmarr, $dmv);
// 				}
// 				$zl['dm']=$dmarr;
// 				//查看港澳台西藏
// 				$hknb=$std->where("stdnp LIKE '%香港%' AND f_std_statid<>9")->count();$zl['hknb']=$hknb;
// 				$mcnb=$std->where("stdnp LIKE '%澳门%' AND f_std_statid<>9")->count();$zl['mcnb']=$mcnb;
// 				$twnb=$std->where("stdnp LIKE '%台湾%' AND f_std_statid<>9")->count();$zl['twnb']=$twnb;
// 				$tbnb=$std->where("stdnp LIKE '%西藏%' AND f_std_statid<>9")->count();$zl['tbnb']=$tbnb;
// 				$otnb=$std->where("stdnp NOT LIKE '%香港%' AND stdnp NOT LIKE '%澳门%' AND stdnp NOT LIKE '%台湾%' AND stdnp NOT LIKE '%西藏%' AND f_std_statid<>9")->count();$zl['otnb']=$otnb;
// 				//PS:这里发现了个彩蛋，mysql在利用某个字段搜索的时候都是有个默认前提的，就是在这个字段有值的 条目中进行筛选
// // 				//查看班级
// // 				$clsarr=array();
// // 				foreach ($clsls as $clsv){
// // 					$clscnt=$std->join('inner join tb_'.$grdv['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdv['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid')->join('tb_'.$grdv['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->where("f_stdxqcls_xqid=".$xqiddq." AND f_stdxqmj_xqid=".$xqiddq.' AND f_stdxqcls_clsid='.$clsv['clsid'].' AND f_std_statid=5')->count();
// // 					if($clscnt==0){
// // 						continue;
// // 					}
// // 					$clsv['clscnt']=$clscnt;
// // 					array_push($clsarr, $clsv);
// // 				}
// // 				$zl['cls']=$clsarr;
// 				//查看专业
// 				$mjarr=array();
// 				foreach ($mjls as $mjv){
// 					$mjcnt=$std->join('inner join tb_'.$grdv['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdv['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid')->join('tb_'.$grdv['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->where("f_stdxqcls_xqid=".$xqiddq." AND f_stdxqmj_xqid=".$xqiddq.' AND f_stdxqmj_mjid='.$mjv['mjid'].' AND f_std_statid<>9')->count();
// 					if($mjcnt==0){
// 						continue;
// 					}
// 					$mjv['clscnt']=$mjcnt;
// 					array_push($mjarr, $mjv);
// 				}
// 				$zl['mj']=$mjarr;
// 				$grdv['zl']=$zl;
// 				array_push($grdlsfn, $grdv);
// 			}
// 			$this->assign('grdls',$grdlsfn);
			
// 			$begin='2015-05-01';
// 			$end=date("Y-m-d",time());
// 			import('@.TM.TMAction');
// 			$tm = new TMAction();
// 			$datels=$tm->timelist($begin, $end);
// 			$dtls=array();
// 			$rsls=array();//人数
// 			foreach($datels as $k=>$dtv){
// 				$dateo=date("m-d",$dtv);
// 				$tmp=array();//清空一下，一面造成累计
// 				$tmp['rq']=$dateo;
// 				array_push($dtls, $tmp);
// 				$cnt=$std->where("stdaddtm LIKE '%".$dateo."%'")->count();
// 				$tmp=array();//清空一下，一面造成累计
// 				$tmp['rs']=$cnt;
// 				array_push($rsls, $tmp);
// 			}
// 			$this->assign('dtls',$dtls);
// 			$this->assign('rsls',$rsls);
			
// 			$this->assign('title','招生学生数据分析');
// 			$this->assign('theme','招生学生数据分析详细');
// 			$this->display('stddtfx');
// 		}
		
	
// 	}
	
	//------------------【】【】【】【】以上是学生部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Zspxh'")->find();
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
		
		$zssz=M('zssz');
		$zsszo=$zssz->find();
		$tmp=explode(' ', $zsszo['zsszxnltm']);
		$zsszo['zsszxnltm']=$tmp[0];
		$this->assign('zsszo',$zsszo);
		
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
			$grdid=$zsszo['f_zssz_grdid'];
		}
		$grdo=$grd->where('grdid='.$grdid)->find();
		$std=M($grdo['grdnm'].'_std')->join('tb_'.$grdo['grdnm'].'_zspxh ON f_zspxh_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
// 		$stdls=$std->select();

		$fldint='-stdid-bxxsnm-f_std_grdid-f_stdxqcls_xqid-f_stdxqcls_clsid-stdaplno-stdno-stdnm-clsnm-sexnm-stdbtd-mjnm-statnm-zspxhtm-zspxhschqtm-stdpt-';
		//$cdtint="-sp-f_std_ccid-eq-3-sp-f_std_xxxsid-eq-2-sp-f_std_zsfwid-eq-2-sp-f_std_xzid-eq-2-sp-f_std_sttid-eq-1-sp-f_std_statid-eq-5-sp-";
		
		//默认学期，
		
// 		$xq=M('xq');
// 		$xqo=$xq->where('xqdq=1')->find();
// 		$xqid=$xqo['xqid'];
		$xqid=$zsszo['f_zssz_xqid'];
		
		$cdtint="-sp-f_std_grdid-eq-".$grdid."-sp-f_std_sttid-eq-1-sp-f_stdxqcls_xqid-eq-".$xqid."-sp-f_stdxqmj_xqid-eq-".$xqid."-sp-f_stdxqdm_xqid-eq-".$xqid.'-sp-';
		
		$spccdtint="-sp-(f_std_statid<>9)-sp-";///只有上传过程亨且没有退学的人才有资格排学号
		$odrint='-mjnm ASC-stdno ASC-stdaplno ASC-';
		$lmtint=20;
		$jn='tb_stt ON f_std_sttid=sttid-jn-tb_grd ON f_std_grdid=grdid-jn-tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid-jn-tb_bxxs ON f_mj_bxxsid=bxxsid-jn-tb_cc ON f_mj_ccid=ccid-jn-tb_kl ON f_mj_klid=klid-jn-tb_xxxs ON f_mj_xxxsid=xxxsid-jn-tb_zsfw ON f_mj_zsfwid=zsfwid-jn-tb_xz ON f_mj_xzid=xzid-jn-tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid-jn-tb_dm ON f_stdxqdm_dmid=dmid-jn-tb_sex ON f_std_sexid=sexid-jn-tb_rc ON f_std_rcid=rcid-jn-tb_zzmm ON f_std_zzmmid=zzmmid-jn-tb_xl ON f_std_xlid=xlid-jn-tb_stat ON f_std_statid=statid-jn-tb_xq ON f_stdxqcls_xqid=xqid';
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($std,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		
		//判断std所在的班级，当前人员能否修改。。。其实就是看他是教务的还是管理员还是他亲生班主任
		$mls=$arr['mls'];
		$bzr=M($grdo['grdnm'].'_bzr');
		$mlsfn=array();
		foreach($mls as $v){
			if($v['stdbtd']<$zsszo['zsszxnltm']){$v['xnl']='否';}else{$v['xnl']='是';}
			if($athofn['aths']==1){//aths==1说明是教务的人或者是管理员
				$v['mdf']=1;
			}else{
				$v['mdf']=0;
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
		$tmp=explode('-', $zsszo['zsszbxxsu']);
		$where='1=2';
		for($i=1;$i<count($tmp)-1;$i++){
			$where=$where.' OR bxxsid='.$tmp[$i];
		}
		$bxxs=M('bxxs');
		$bxxsls=$bxxs->where($where)->select();
		$this->assign('bxxsls',$bxxsls);
		
		//q特殊
		
		$stt=M('stt');//因为你站点可能木有了，但是站点已经招的学生阔能还在，因此要保留站点
		$sttls=$stt->where('sttid=1')->select();
		$this->assign('sttls',$sttls);
		
		//q特殊
		$cc=M('cc');
		$ccls=$cc->where('ccid=3')->select();
		$this->assign('ccls',$ccls);
		
		//q特殊
		$kl=M('kl');
		$klls=$kl->select();
		$this->assign('klls',$klls);
		//q特殊
		$xxxs=M('xxxs');
		$xxxsls=$xxxs->where('xxxsid=2')->select();
		$this->assign('xxxsls',$xxxsls);
		//q特殊
		$zsfw=M('zsfw');
		$zsfwls=$zsfw->where('zsfwid=2')->select();
		$this->assign('zsfwls',$zsfwls);
		//q特殊
		$xz=M('xz');
		$xzls=$xz->where('xzid=2')->select();
		$this->assign('xzls',$xzls);
		//q特殊
		$grd=M('grd');
		$grdls=$grd->where('grdid='.$zsszo['f_zssz_grdid'])->order('grdnm DESC')->select();
		$this->assign('grdls',$grdls);
		
		//q特殊
		$xq=M('xq');
		$xqls=$xq->where('xqid='.$zsszo['f_zssz_xqid'])->order('xqnm DESC')->select();
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
		$where=$where.' AND f_cls_grdid='.$grdid.' AND clsactvt=1';
		$cls=M($grdo['grdnm'].'_cls');
		$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where($where)->order('clsnm ASC')->select();
		array_push($clsls, array('clsid'=>0,'clsnm'=>'未分班'));
		$this->assign('clsls',$clsls);

		//q特殊
		$dm=M('dm');
		$dmls=$dm->select();
		$this->assign('dmls',$dmls);
		//q特殊
		$sex=M('sex');
		$sexls=$sex->select();
		$this->assign('sexls',$sexls);
		//q特殊
		$rc=M('rc');
		$rcls=$rc->select();
		$this->assign('rcls',$rcls);
		//q特殊
		$zzmm=M('zzmm');
		$zzmmls=$zzmm->select();
		$this->assign('zzmmls',$zzmmls);
		//q特殊
		$xl=M('xl');
		$xlls=$xl->select();
		$this->assign('xlls',$xlls);
		
		
		//q特殊
		$cdt=$arr['cdt'];
		$where='1=1';
		if(preg_match('/f_std_bxxsid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_std_bxxsid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$where=$where.' AND f_mj_bxxsid='.$tmp[0];
		}
		if(preg_match('/f_std_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_std_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$where=$where.' AND f_mj_grdid='.$tmp[0];
		}
		if(preg_match('/f_mj_ccid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_mj_ccid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$where=$where.' AND f_mj_ccid='.$tmp[0];
		}
		if(preg_match('/f_mj_klid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_mj_klid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$where=$where.' AND f_mj_klid='.$tmp[0];
		}
		if(preg_match('/f_mj_xxxsid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_mj_xxxsid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$where=$where.' AND f_mj_xxxsid='.$tmp[0];
		}
		if(preg_match('/f_mj_zsfwid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_mj_zsfwid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$where=$where.' AND f_mj_zsfwid='.$tmp[0];
		}
		if(preg_match('/f_mj_xzid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_mj_xzid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$where=$where.' AND f_mj_xzid='.$tmp[0];
		}
		$mj=M($grdo['grdnm'].'_mj');
		$mjls=$mj->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->where($where)->order('f_mj_bxxsid ASC,mjdm ASC')->select();
		$tmpls=array();
		foreach ($mjls as $v){
			if(preg_match('/技能/',$v['bxxsnm'])){
				$v['bxxsnm']='技能';
			}else if(preg_match('/自考/',$v['bxxsnm'])){
				$v['bxxsnm']='自考';
			}else{
				$v['bxxsnm']='普通';
			}
			array_push($tmpls, $v);
		}
		$this->assign('mjls',$tmpls);
		
				
		//q特殊
		$stat=M('stat');
		$statls=$stat->where("statactvt=1 AND statmk='zs'")->select();
		$this->assign('statls',$statls);
		
		$zspxh=M($grdo['grdnm'].'_zspxh');
		$zspxhtmls=$zspxh->Distinct(true)->field('zspxhtm')->select();
		$this->assign('zspxhtmls',$zspxhtmls);
		
		$zspxhschqtmls=$zspxh->Distinct(true)->field('zspxhschqtm')->select();
		$this->assign('zspxhschqtmls',$zspxhschqtmls);
		
		//用于生成xls
		$this->assign('grdnm',$grdo['grdnm']);
		
		//q特殊
		$this->assign('title','浏览学生列表');
		$this->assign('theme','学生管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$stdid=$_POST['stdid'];
	
		if($stdid==0){
			
			$f_mj_bxxsid=$_POST['f_mj_bxxsid'];
			$f_std_grdid=$_POST['f_std_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$f_std_grdid)->find();
			$std=M($grdo['grdnm'].'_std');
			$bxxs=M('bxxs');
			$bxxso=$bxxs->where('bxxsid='.$f_mj_bxxsid)->find();
			
			$xqid=$_POST['f_stdxqcls_xqid'];
			$dmid=$_POST['f_stdxqdm_dmid'];
			
			
			if(preg_match('/技能/', $bxxso['bxxsnm'])||preg_match('/自考/', $bxxso['bxxsnm'])){
				
				if($_POST['stdaplno']!=''){
					$stdaplno=$_POST['stdaplno'];
				}else{
					$bxxs=M('bxxs');
					$bxxso=$bxxs->where('bxxsid='.$f_mj_bxxsid)->find();
					$stdaplno='';
					if(preg_match('/技能/', $bxxso['bxxsnm'])||preg_match('/自考/', $bxxso['bxxsnm'])){
						if(preg_match('/技能/', $bxxso['bxxsnm'])){
							$stdaplno='J'.$grdo['grdnm'];
					
						}else if(preg_match('/自考/', $bxxso['bxxsnm'])){
							$stdaplno='Z'.$grdo['grdnm'];
					
						}
						$stdls=$std->field('stdaplno')->where("stdaplno LIKE '%".$stdaplno."%'")->order('stdaplno DESC')->select();
						if(count($stdls)>0){
							$stdo=$stdls[0];
							$hou=substr($stdo['stdaplno'],5);
							$hounew=intval($hou)+1;
							if(intval($hounew/1000)>0){
								$k=0;
							}else if(intval($hounew/100)>0){
								$k=1;
							}else if(intval($hounew/10)>0){
								$k=2;
							}else{
								$k=3;
							}
						}else{
							$k=3;
							$hounew=1;
						}
						$ling='';
						for($i=0;$i<$k;$i++){
							$ling=$ling.'0';
						}
						$stdaplno=$stdaplno.$ling.$hounew;
					}
				}
				
				
			}else{
				$stdaplno='';//一般都是空的，这里保留就是为了留个后门
			}
			
			//如果有学号就把文件名称改掉并从std/tmp/迁徙回来
			if($_POST['stdpt']&&($_POST['stdpt']!=C('PUBLIC').'/IMG/default.jpg')&&$_POST['stdno']&&!preg_match($_POST['stdno'],$_POST['stdpt'])){
				$sys=M('sys');
				$syso=$sys->find();
				$stdpt=str_replace('/'.$syso['sysnm'].'/', './', $_POST['stdpt']);
				
				import('@.FileUtil.FileUtilAction');
				$fu = new FileUtil();
				
				$fu->copyFile($stdpt,'./Uploads/std/'.$grdo['grdnm'].'/'.$_POST['f_std_sttid'].'/'.$_POST['stdno'].'.jpg');
				$stdpt='/'.$syso['sysnm'].'/Uploads/std/'.$grdo['grdnm'].'/'.$_POST['f_std_sttid'].'/'.$_POST['stdno'].'.jpg';
			}else{
				$stdpt=$_POST['stdpt'];
			}
			
			//先截获数据//学生基本部分
			$data=array(
					'f_std_sttid'=>$_POST['f_std_sttid'],
					'f_std_grdid'=>$_POST['f_std_grdid'],
					'stdaplno'=>$stdaplno,
					'stdno'=>$_POST['stdno'],
					'stdupfnctm'=>$_POST['stdupfnctm'],
					'stdnm'=>$_POST['stdnm'],
					'stdpw'=>md5('11111111'),
					'stdpt'=>$stdpt,
					
					'f_std_sexid'=>$_POST['f_std_sexid'],
					'f_std_rcid'=>$_POST['f_std_rcid'],
					'f_std_zzmmid'=>$_POST['f_std_zzmmid'],
					'stdnp'=>$_POST['stdnp'],
					'stdbtd'=>$_POST['stdbtd'],
					'stdsol'=>$_POST['stdsol'],
					'stdcee'=>$_POST['stdcee'],
					'stdsog'=>$_POST['stdsog'],
					'stdqq'=>$_POST['stdqq'],
					'f_std_xlid'=>$_POST['f_std_xlid'],
					'stdidcd'=>strtoupper($_POST['stdidcd']),
					'stdcp'=>$_POST['stdcp'],
					'stdrlta'=>$_POST['stdrlta'],
					'stdrltanm'=>$_POST['stdrltanm'],
					'stdrltaocpt'=>$_POST['stdrltaocpt'],
					'stdrltacp'=>$_POST['stdrltacp'],
					'stdrltb'=>$_POST['stdrltb'],
					'stdrltbnm'=>$_POST['stdrltbnm'],
					'stdrltbocpt'=>$_POST['stdrltbocpt'],
					'stdrltbcp'=>$_POST['stdrltbcp'],
					'stdhb'=>$_POST['stdhb'],
					'f_std_statid'=>$_POST['f_std_statid'],
					'stdpst'=>$_POST['stdpst'],
					'stdads'=>$_POST['stdads'],
					'stdmdftm'=>date("Y-m-d H:i:s",time()),
					'stdaddtm'=>date("Y-m-d H:i:s",time()),
					'stdtlp'=>$_POST['stdtlp'],
					'stdpertm'=>$_POST['stdpertm'],
					'stdertm'=>$_POST['stdertm'],
					'stdicbc'=>$_POST['stdicbc'],
					'stdrcmdnm'=>$_POST['stdrcmdnm'],
					'stdrcmdcp'=>$_POST['stdrcmdcp'],
					'stdpnttm'=>$_POST['stdpnttm'],
				
			);
			//查一查有没有同名学生网名
			if($std->where("stdidcd='".$data['stdidcd']."'")->find()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else if(substr($data['stdidcd'], 6,4).'-'.substr($data['stdidcd'], 10,2).'-'.substr($data['stdidcd'], 12,2)!=$data['stdbtd']){
				$data['status']=4;
				$this->ajaxReturn($data,'json');
			}else{
				if($std->data($data)->add()){
					$data['status']=2;
					$stdo=$std->field('stdid')->where("stdidcd='".$data['stdidcd']."'")->find();
					//注册学生到新班级新专业//班级有则注册，没有也必须占坑，这样在innerjoin的时候不至于因为木有，而导致数据无法获得，从而减小因为这个BUG造成的一系列的问题，专业必须注册
					$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
					$dt=array(
							'f_stdxqcls_stdid'=>$stdo['stdid'],
							'f_stdxqcls_xqid'=>$_POST['f_stdxqcls_xqid'],
							'f_stdxqcls_clsid'=>$_POST['f_stdxqcls_clsid'],
					);
					$stdxqcls->data($dt)->add();
					
					
					$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
					$dt=array(
							'f_stdxqmj_stdid'=>$stdo['stdid'],
							'f_stdxqmj_xqid'=>$_POST['f_stdxqmj_xqid'],
							'f_stdxqmj_mjid'=>$_POST['f_stdxqmj_mjid'],
					);
					$stdxqmj->data($dt)->add();
					
					$stdxqdm=M($grdo['grdnm'].'_stdxqdm');
					$dt=array(
							'f_stdxqdm_stdid'=>$stdo['stdid'],
							'f_stdxqdm_xqid'=>$_POST['f_stdxqdm_xqid'],
							'f_stdxqdm_dmid'=>$_POST['f_stdxqdm_dmid'],
					);
					$stdxqdm->data($dt)->add();
					
					
					//添加缴费信息1、学费教材考务费2、住宿费
					$mj=M($grdo['grdnm'].'_mj');
					$mjo=$mj->where('mjid='.$_POST['f_stdxqmj_mjid'])->find();
					$xf=M($grdo['grdnm'].'_xf');
					$xfo=$xf->where('f_xf_sttid='.$stdo['f_std_sttid'].' AND f_xf_bxxsid='.$mjo['f_mj_bxxsid'].' AND f_xf_ccid='.$mjo['f_mj_ccid'].' AND f_xf_klid='.$mjo['f_mj_klid'])->find();
					$zsf=M($grdo['grdnm'].'_zsf');
					$zsfo=$zsf->where('f_zsf_dmid='.$_POST['f_stdxqdm_dmid'])->find();
					$cw=M($grdo['grdnm'].'_cw');
					//根据学期获得学年
					$xq=M('xq');
					$xqo=$xq->where('xqid='.$xqid)->find();
					if(preg_match('/第1学期/', $xqo['xqnm'])){
						$tmp=explode('-', $xqo[xqnm]);
						$xnnm=$tmp[0];
					}else{
						$tmp=explode('-', $xqo[xqnm]);
						$tmp=explode('学年', $tmp[1]);
						$xnnm=$tmp[0];
					}
					$xn=M('xn');
					$xno=$xn->where("xnnm='".$xnnm."'")->find();
					$dt=array(
							'f_cw_grdid'=>$grdo['grdid'],
							'f_cw_xnid'=>$xno['xnid'],
							'cwzcxqid'=>$xqid,
							'f_cw_stdid'=>$stdo['stdid'],
							'cwyjxfsm'=>$xfo['xfsm']+100,//因为是第一个学期所以要加100的报名费
							'cwyjjckwfsm'=>$xfo['jckwfsm'],
							'cwyjzsfsm'=>$zsfo['zsfsm'],
							'cwsjxfsm'=>0,
							'cwsjjckwfsm'=>0,
							'cwsjzsfsm'=>0,
					);
					$cw->data($dt)->add();
					
					
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=3;
					$this->ajaxReturn($data,'json');
				}
			}
		}else{
			$f_mj_bxxsid=$_POST['f_mj_bxxsid'];
			$f_std_grdid=$_POST['f_std_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$f_std_grdid)->find();
			$std=M($grdo['grdnm'].'_std');
			
			$xqid=$_POST['f_stdxqcls_xqid'];
			$dmid=$_POST['f_stdxqdm_dmid'];
			
			$stdid=$_POST['stdid'];
			//从库里寻找原有信息
			
			//如果有学号就把文件名称改掉并从std/tmp/迁徙回来
			if($_POST['stdpt']&&($_POST['stdpt']!=C('PUBLIC').'/IMG/default.jpg')&&$_POST['stdno']&&!preg_match($_POST['stdno'],$_POST['stdpt'])){
				$sys=M('sys');
				$syso=$sys->find();
				$stdpt=str_replace('/'.$syso['sysnm'].'/', './', $_POST['stdpt']);
			
				import('@.FileUtil.FileUtilAction');
				$fu = new FileUtil();
			
				$fu->copyFile($stdpt,'./Uploads/std/'.$grdo['grdnm'].'/'.$_POST['f_std_sttid'].'/'.$_POST['stdno'].'.jpg');
				$stdpt='/'.$syso['sysnm'].'/Uploads/std/'.$grdo['grdnm'].'/'.$_POST['f_std_sttid'].'/'.$_POST['stdno'].'.jpg';
			}else{
				$stdpt=$_POST['stdpt'];
			}
			
			
			//----------------搞aplno
			//如果是当前学期就搞否则不用搞
			$xq=M('xq');
			$xqodq=$xq->where('xqdq=1')->find();
			if($_POST['f_stdxqcls_xqid']==$xqodq['xqid']){
				//获取最近学生的注册专业信息
				$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
				$stdxqmjo=$stdxqmj->where('f_stdxqmj_stdid.'.$stdid)->order('f_stdxqmj_xqid DESC')->find();
				$mjid=$stdxqmjo['f_stdxqmj_mjid'];
				$mj=M($grdo['grdnm'].'_mj');
				$mjo=$mj->where('mjid='.$mjid)->find();
				$bxxsid=$mjo['f_mj_bxxsid'];
				$bxxs=M('bxxs');
				$bxxso=$bxxs->where('bxxsid='.$bxxsid)->find();
				//处理报名号//如果和当前学期，这个属于学籍部分
				if((preg_match('/技能/', $bxxso['bxxsnm'])||preg_match('/自考/', $bxxso['bxxsnm']))&&$f_mj_bxxsid!=$bxxsid){
						
					//添加的话是 有特殊说明 按特殊说明来，否则的话就是给编一个
					//修改则不同，一般而言肯定是2和3都有aplno了的，所以重点就在于是延续保持，还是换，而且报名号也就是招生期间用之后就没有意义了
						
					$bxxs=M('bxxs');
					$bxxso=$bxxs->where('bxxsid='.$f_mj_bxxsid)->find();
					$stdaplno='';
					if(preg_match('/技能/', $bxxso['bxxsnm'])||preg_match('/自考/', $bxxso['bxxsnm'])){
						if(preg_match('/技能/', $bxxso['bxxsnm'])){
							$stdaplno='J'.$grdo['grdnm'];
								
						}else if(preg_match('/自考/', $bxxso['bxxsnm'])){
							$stdaplno='Z'.$grdo['grdnm'];
								
						}
						$stdls=$std->field('stdaplno')->where("stdaplno LIKE '%".$stdaplno."%'")->order('stdaplno DESC')->select();
						if(count($stdls)>0){
							$stdo=$stdls[0];
							$hou=substr($stdo['stdaplno'],5);
							$hounew=intval($hou)+1;
							if(intval($hounew/1000)>0){
								$k=0;
							}else if(intval($hounew/100)>0){
								$k=1;
							}else if(intval($hounew/10)>0){
								$k=2;
							}else{
								$k=3;
							}
						}else{
							$k=3;
							$hounew=1;
						}
						$ling='';
						for($i=0;$i<$k;$i++){
							$ling=$ling.'0';
						}
						$stdaplno=$stdaplno.$ling.$hounew;
					}
						
						
						
				}else{
					//照旧
					$std=M($grdo['grdnm'].'_std');
					$stdo=$std->where('stdid='.$stdid)->find();
					$stdaplno=$stdo['stdaplno'];
				}
			}else{
				//照旧
				$std=M($grdo['grdnm'].'_std');
				$stdo=$std->field('stdaplno')->where('stdid='.$stdid)->find();
				$stdaplno=$stdo['stdaplno'];
			}
			
			
			
			
			//----------------
			
			//先截获数据//学生基本部分
			$data=array(
					'f_std_sttid'=>$_POST['f_std_sttid'],
					'f_std_grdid'=>$_POST['f_std_grdid'],
					'stdaplno'=>$stdaplno,
					'stdno'=>$_POST['stdno'],
					'stdupfnctm'=>$_POST['stdupfnctm'],
					'stdnm'=>$_POST['stdnm'],
					'stdpt'=>$stdpt,
					
					'f_std_sexid'=>$_POST['f_std_sexid'],
					'f_std_rcid'=>$_POST['f_std_rcid'],
					'f_std_zzmmid'=>$_POST['f_std_zzmmid'],
					'stdnp'=>$_POST['stdnp'],
					'stdbtd'=>$_POST['stdbtd'],
					'stdsol'=>$_POST['stdsol'],
					'stdcee'=>$_POST['stdcee'],
					'stdsog'=>$_POST['stdsog'],
					'stdqq'=>$_POST['stdqq'],
					'f_std_xlid'=>$_POST['f_std_xlid'],
					'stdidcd'=>strtoupper($_POST['stdidcd']),
					'stdcp'=>$_POST['stdcp'],
					'stdrlta'=>$_POST['stdrlta'],
					'stdrltanm'=>$_POST['stdrltanm'],
					'stdrltaocpt'=>$_POST['stdrltaocpt'],
					'stdrltacp'=>$_POST['stdrltacp'],
					'stdrltb'=>$_POST['stdrltb'],
					'stdrltbnm'=>$_POST['stdrltbnm'],
					'stdrltbocpt'=>$_POST['stdrltbocpt'],
					'stdrltbcp'=>$_POST['stdrltbcp'],
					'stdhb'=>$_POST['stdhb'],
					'f_std_statid'=>$_POST['f_std_statid'],
					'stdpst'=>$_POST['stdpst'],
					'stdads'=>$_POST['stdads'],
					'stdmdftm'=>date("Y-m-d H:i:s",time()),
					'stdtlp'=>$_POST['stdtlp'],
					'stdpertm'=>$_POST['stdpertm'],
					'stdertm'=>$_POST['stdertm'],
					'stdicbc'=>$_POST['stdicbc'],
					'stdrcmdnm'=>$_POST['stdrcmdnm'],
					'stdrcmdcp'=>$_POST['stdrcmdcp'],
					'stdpnttm'=>$_POST['stdpnttm'],
			
			);
			
			//给特殊情况先存下学生状态
			$stdoforstat=$std->field('f_std_statid')->where('stdid='.$_POST['stdid'])->find();
			
			//查一查有没有同名学生网名
			if($std->where("stdidcd='".$data['stdidcd']."' AND std<>".$stdid."")->find()){//除了自己以外是否有重idcd
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else if(substr($data['stdidcd'], 6,4).'-'.substr($data['stdidcd'], 10,2).'-'.substr($data['stdidcd'], 12,2)!=$data['stdbtd']){
				$data['status']=4;
				$this->ajaxReturn($data,'json');
			}else{
				if($std->where('stdid='.$stdid)->setField($data)){
					
					$data['status']=2;
					
					//注册学生到新班级新专业//班级有则注册，没有也必须占坑，专业必须注册
					//总政策是有则改之，无则加勉//其实一般都是有的
					$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
					if($stdxqcls->where('f_stdxqcls_stdid='.$_POST['stdid'].' AND f_stdxqcls_xqid='.$_POST['f_stdxqcls_xqid'])->find()){
						$stdxqclso=$stdxqcls->where('f_stdxqcls_stdid='.$_POST['stdid'].' AND f_stdxqcls_xqid='.$_POST['f_stdxqcls_xqid'])->find();
						if($_POST['f_stdxqcls_clsid']!=$stdxqclso['f_stdxqcls_clsid']){
							$dt=array(
									'f_stdxqcls_stdid'=>$_POST['stdid'],
									'f_stdxqcls_xqid'=>$_POST['f_stdxqcls_xqid'],
									'f_stdxqcls_clsid'=>$_POST['f_stdxqcls_clsid'],
							);
							$stdxqcls->where('stdxqclsid='.$stdxqclso['stdxqclsid'])->setField($dt);
							//改班级算是特殊情况
							$cls=M($grdo['grdnm'].'_cls');
							$clsoorg=$cls->where('clsid='.$stdxqclso['f_stdxqcls_clsid'])->find();
							$clsonw=$cls->where('clsid='.$_POST['f_stdxqcls_clsid'])->find();
							$tsqk=M($grdo['grdnm'].'_tsqk');
							$dt=array(
								'f_tsqk_grdid'=>$grdo['grdid'],
								'f_tsqk_stdid'=>$_POST['stdid'],
									'tsqktm'=>date("Y-m-d H:i:s",time()),
									'tsqknr'=>'【换班级】'.$clsoorg['clsnm'].'=>'.$clsonw['clsnm'],
							);
							$tsqk->data($dt)->add();
						}
					}else{
						$dt=array(
								'f_stdxqcls_stdid'=>$_POST['stdid'],
								'f_stdxqcls_xqid'=>$_POST['f_stdxqcls_xqid'],
								'f_stdxqcls_clsid'=>$_POST['f_stdxqcls_clsid'],
						);
						$stdxqcls->data($dt)->add();
					}
					
						
					$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
					if($stdxqmj->where('f_stdxqmj_stdid='.$_POST['stdid'].' AND f_stdxqmj_xqid='.$_POST['f_stdxqmj_xqid'])->find()){
						$stdxqmjo=$stdxqmj->where('f_stdxqmj_stdid='.$_POST['stdid'].' AND f_stdxqmj_xqid='.$_POST['f_stdxqmj_xqid'])->find();
						if($_POST['f_stdxqmj_mjid']!=$stdxqmjo['f_stdxqmj_mjid']){
							$dt=array(
									'f_stdxqmj_stdid'=>$_POST['stdid'],
									'f_stdxqmj_xqid'=>$_POST['f_stdxqmj_xqid'],
									'f_stdxqmj_mjid'=>$_POST['f_stdxqmj_mjid'],
							);
							$stdxqmj->where('stdxqmjid='.$stdxqmjo['stdxqmjid'])->setField($dt);
							//改专业算是特殊情况
							$mj=M($grdo['grdnm'].'_mj');
							$mjoorg=$mj->where('mjid='.$stdxqmjo['f_stdxqmj_mjid'])->find();
							$mjonw=$mj->where('mjid='.$_POST['f_stdxqmj_mjid'])->find();
							$tsqk=M($grdo['grdnm'].'_tsqk');
							$dt=array(
									'f_tsqk_grdid'=>$grdo['grdid'],
									'f_tsqk_stdid'=>$_POST['stdid'],
									'tsqktm'=>date("Y-m-d H:i:s",time()),
									'tsqknr'=>'【换专业】'.$mjoorg['mjnm'].'=>'.$mjonw['mjnm'],
							);
							$tsqk->data($dt)->add();
							
							//修改缴费信息1、学费教材考务费2、住宿费
							$mj=M($grdo['grdnm'].'_mj');
							$mjo=$mj->where('mjid='.$_POST['f_stdxqmj_mjid'])->find();
							$xf=M($grdo['grdnm'].'_xf');
							$xfo=$xf->where('f_xf_sttid='.$_POST['f_std_sttid'].' AND f_xf_bxxsid='.$mjo['f_mj_bxxsid'].' AND f_xf_ccid='.$mjo['f_mj_ccid'].' AND f_xf_klid='.$mjo['f_mj_klid'])->find();
							$zsf=M($grdo['grdnm'].'_zsf');
							$zsfo=$zsf->where('f_zsf_dmid='.$dmid)->find();
							$cw=M($grdo['grdnm'].'_cw');
							
							//根据学期获得学年
							$xq=M('xq');
							$xqo=$xq->where('xqid='.$xqid)->find();
							if(preg_match('/第1学期/', $xqo['xqnm'])){
								$tmp=explode('-', $xqo[xqnm]);
								$xnnm=$tmp[0];
							}else{
								$tmp=explode('-', $xqo[xqnm]);
								$tmp=explode('学年', $tmp[1]);
								$xnnm=$tmp[0];
							}
							$xn=M('xn');
							$xno=$xn->where("xnnm='".$xnnm."'")->find();
							$cwo=$cw->where('f_cw_xnid='.$xno['xnid'].' AND f_cw_stdid='.$stdid)->find();
							$dt=array(
									
									'cwyjxfsm'=>$xfo['xfsm']+100,//因为是第一个学期所以要加100的报名费
									'cwyjjckwfsm'=>$xfo['jckwfsm'],
									'cwyjzsfsm'=>$zsfo['zsfsm'],
									
							);
							$cw->where('cwid='.$cwo['cwid'])->setField($dt);
						}
					}else{
						$dt=array(
								'f_stdxqmj_stdid'=>$_POST['stdid'],
								'f_stdxqmj_xqid'=>$_POST['f_stdxqmj_xqid'],
								'f_stdxqmj_mjid'=>$_POST['f_stdxqmj_mjid'],
						);
						$stdxqmj->data($dt)->add();
					}
					
					$stdxqdm=M($grdo['grdnm'].'_stdxqdm');
					if($stdxqdm->where('f_stdxqdm_stdid='.$_POST['stdid'].' AND f_stdxqdm_xqid='.$_POST['f_stdxqdm_xqid'])->find()){
						$stdxqdmo=$stdxqdm->where('f_stdxqdm_stdid='.$_POST['stdid'].' AND f_stdxqdm_xqid='.$_POST['f_stdxqdm_xqid'])->find();
						if($_POST['f_stdxqdm_dmid']!=$stdxqdmo['f_stdxqdm_dmid']){
							$dt=array(
									'f_stdxqdm_stdid'=>$_POST['stdid'],
									'f_stdxqdm_xqid'=>$_POST['f_stdxqdm_xqid'],
									'f_stdxqdm_dmid'=>$_POST['f_stdxqdm_dmid'],
							);
							$stdxqdm->where('stdxqdmid='.$stdxqdmo['stdxqdmid'])->setField($dt);
							//改专业算是特殊情况
							$dm=M($grdo['grdnm'].'_dm');
							$dmoorg=$dm->where('dmid='.$stdxqdmo['f_stdxqdm_dmid'])->find();
							$dmonw=$dm->where('dmid='.$_POST['f_stdxqdm_dmid'])->find();
							$tsqk=M($grdo['grdnm'].'_tsqk');
							$dt=array(
									'f_tsqk_grdid'=>$grdo['grdid'],
									'f_tsqk_stdid'=>$_POST['stdid'],
									'tsqktm'=>date("Y-m-d H:i:s",time()),
									'tsqknr'=>'【换寝室】'.$dmoorg['dmnm'].'=>'.$dmonw['dmnm'],
							);
							$tsqk->data($dt)->add();
						}
					}else{
						$dt=array(
								'f_stdxqdm_stdid'=>$_POST['stdid'],
								'f_stdxqdm_xqid'=>$_POST['f_stdxqdm_xqid'],
								'f_stdxqdm_dmid'=>$_POST['f_stdxqdm_dmid'],
						);
						$stdxqdm->data($dt)->add();
					}
					
					//查看是否换状态
					
					if($stdoforstat['f_std_statid']!=$_POST['f_std_statid']){
						//改状态算是特殊情况
						$stat=M('stat');
						$statoorg=$stat->where('statid='.$stdo['f_std_statid'])->find();
						$statonw=$stat->where('statid='.$_POST['f_std_statid'])->find();
						$tsqk=M($grdo['grdnm'].'_tsqk');
						$dt=array(
								'f_tsqk_grdid'=>$grdo['grdid'],
								'f_tsqk_stdid'=>$_POST['stdid'],
								'tsqktm'=>date("Y-m-d H:i:s",time()),
								'tsqknr'=>'【换状态】'.$statoorg['statnm'].'=>'.$statonw['statnm'],
						);
						$tsqk->data($dt)->add();
					}
					
					
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=3;
					$this->ajaxReturn($data,'json');
				}
			}
		}
	}
	
	function updatexj(){
		header("Content-Type:text/html; charset=utf-8");
		$stdid=$_POST['stdid'];
	
	
		$f_mj_bxxsid=$_POST['f_mj_bxxsid'];
		$f_std_grdid=$_POST['f_std_grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$f_std_grdid)->find();
		$std=M($grdo['grdnm'].'_std');
			
		$stdid=$_POST['stdid'];
		//从库里寻找原有信息
			
			
		//----------------搞aplno
		$xq=M('xq');
		$xqodq=$xq->where('xqdq=1')->find();
		if($_POST['f_stdxqcls_xqid']==$xqodq['xqid']){
			//获取最近学生的注册专业信息
			$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
			$stdxqmjo=$stdxqmj->where('f_stdxqmj_stdid='.$stdid)->order('f_stdxqmj_xqid DESC')->find();
			$mjid=$stdxqmjo['f_stdxqmj_mjid'];
			$mj=M($grdo['grdnm'].'_mj');
			$mjo=$mj->where('mjid='.$mjid)->find();
			$bxxsid=$mjo['f_mj_bxxsid'];
			$bxxs=M('bxxs');
			$bxxso=$bxxs->where('bxxsid='.$bxxsid)->find();
			//处理报名号//如果和当前学期，这个属于学籍部分
			if((preg_match('/技能/', $bxxso['bxxsnm'])||preg_match('/自考/', $bxxso['bxxsnm']))&&$f_mj_bxxsid!=$bxxsid){
					
				//添加的话是 有特殊说明 按特殊说明来，否则的话就是给编一个
				//修改则不同，一般而言肯定是2和3都有aplno了的，所以重点就在于是延续保持，还是换，而且报名号也就是招生期间用之后就没有意义了
					
				$bxxs=M('bxxs');
				$bxxso=$bxxs->where('bxxsid='.$f_mj_bxxsid)->find();
				$stdaplno='';
				if(preg_match('/技能/', $bxxso['bxxsnm'])||preg_match('/自考/', $bxxso['bxxsnm'])){
					if(preg_match('/技能/', $bxxso['bxxsnm'])){
						$stdaplno='J'.$grdo['grdnm'];
							
					}else if(preg_match('/自考/', $bxxso['bxxsnm'])){
						$stdaplno='Z'.$grdo['grdnm'];
							
					}
					$stdls=$std->field('stdaplno')->where("stdaplno LIKE '%".$stdaplno."%'")->order('stdaplno DESC')->select();
					if(count($stdls)>0){
						$stdo=$stdls[0];
						$hou=substr($stdo['stdaplno'],5);
						$hounew=intval($hou)+1;
						if(intval($hounew/1000)>0){
							$k=0;
						}else if(intval($hounew/100)>0){
							$k=1;
						}else if(intval($hounew/10)>0){
							$k=2;
						}else{
							$k=3;
						}
					}else{
						$k=3;
						$hounew=1;
					}
					$ling='';
					for($i=0;$i<$k;$i++){
						$ling=$ling.'0';
					}
					$stdaplno=$stdaplno.$ling.$hounew;
				}
					
				$data=array(
						'stdaplno'=>$stdaplno,
							
				);
				$std->where('stdid='.$stdid)->setField($data);
					
			}
		}
		//对于学号stdno
		$data=array(
				'stdno'=>$_POST['stdno'],
		
		);
		$std->where('stdid='.$stdid)->setField($data);
		
		//----------------
			
		//注册学生到新班级新专业//班级有则注册，没有就算了，专业必须注册
		//总政策是有则改之，无则加勉
		if($_POST['f_stdxqcls_clsid']){
			$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
			if($stdxqcls->where('f_stdxqcls_stdid='.$_POST['stdid'].' AND f_stdxqcls_xqid='.$_POST['f_stdxqcls_xqid'])->find()){
				$stdxqclso=$stdxqcls->where('f_stdxqcls_stdid='.$_POST['stdid'].' AND f_stdxqcls_xqid='.$_POST['f_stdxqcls_xqid'])->find();
				
				if($_POST['f_stdxqcls_clsid']!=$stdxqclso['f_stdxqcls_clsid']){
					$dt=array(
							'f_stdxqcls_stdid'=>$_POST['stdid'],
							'f_stdxqcls_xqid'=>$_POST['f_stdxqcls_xqid'],
							'f_stdxqcls_clsid'=>$_POST['f_stdxqcls_clsid'],
					);
					$stdxqcls->where('stdxqclsid='.$stdxqclso['stdxqclsid'])->setField($dt);
				}
			}else{
				$dt=array(
						'f_stdxqcls_stdid'=>$_POST['stdid'],
						'f_stdxqcls_xqid'=>$_POST['f_stdxqcls_xqid'],
						'f_stdxqcls_clsid'=>$_POST['f_stdxqcls_clsid'],
				);
				$stdxqcls->data($dt)->add();
			}
	
		}else{
			$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
			//管他有木有，删除就是，反正没法删除也不会出错
			$stdxqcls->where('f_stdxqcls_stdid='.$_POST['stdid'].' AND f_stdxqcls_xqid='.$_POST['f_stdxqcls_xqid'])->delete();
				
		}
	
	
	
		$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
		if($stdxqmj->where('f_stdxqmj_stdid='.$_POST['stdid'].' AND f_stdxqmj_xqid='.$_POST['f_stdxqmj_xqid'])->find()){
			$stdxqmjo=$stdxqmj->where('f_stdxqmj_stdid='.$_POST['stdid'].' AND f_stdxqmj_xqid='.$_POST['f_stdxqmj_xqid'])->find();
			if($_POST['f_stdxqmj_mjid']!=$stdxqmjo['f_stdxqmj_mjid']){
				$dt=array(
						'f_stdxqmj_stdid'=>$_POST['stdid'],
						'f_stdxqmj_xqid'=>$_POST['f_stdxqmj_xqid'],
						'f_stdxqmj_mjid'=>$_POST['f_stdxqmj_mjid'],
				);
				$stdxqmj->where('stdxqmjid='.$stdxqmjo['stdxqmjid'])->setField($dt);
			}
		}else{
			$dt=array(
					'f_stdxqmj_stdid'=>$_POST['stdid'],
					'f_stdxqmj_xqid'=>$_POST['f_stdxqmj_xqid'],
					'f_stdxqmj_mjid'=>$_POST['f_stdxqmj_mjid'],
			);
			$stdxqmj->data($dt)->add();
		}
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}		
	
	function delete(){
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$_POST['grdid'])->find();
		$stdxqcls=M($grdo['grdnm'].'_stdxqcls');	
		$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
		$stdxqdm=M($grdo['grdnm'].'_stdxqdm');
		$cw=M($grdo['grdnm'].'_cw');
		$std=M($grdo['grdnm'].'_std');
		if($std->delete($_POST['stdid'])){
			$stdxqcls->where('f_stdxqcls_stdid='.$_POST['stdid'])->delete();
			$stdxqmj->where('f_stdxqmj_stdid='.$_POST['stdid'])->delete();
			$stdxqdm->where('f_stdxqdm_stdid='.$_POST['stdid'])->delete();
			$cw->where('f_cw_stdid='.$_POST['stdid'])->delete();
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($std->getLastSql());
		}
	}
	
	function plpxh(){
		$mk=$_GET['mk'];
		
		$tm=date("Y-m-d H:i:s",time());
		//左 专业id 右班级id 对照表
		$dzb=array(
				'1'=>'18',//计算机//18
				'2'=>'17',//金融//17
				'3'=>'8',//会计
				'4'=>'17',//国贸//17
				'5'=>'17',//市场//17
				'6'=>'18',//电商//18
				'7'=>'17',//工商//17
				'9'=>'19',//环艺//19
				'10'=>'19',//视觉//19
				'11'=>'19',//广告//19
				'12'=>'16',//机电
		);
		
		$zssz=M('zssz');
		$zsszo=$zssz->find();
		$grdid=$zsszo['f_zssz_grdid'];
		$xqid=$zsszo['f_zssz_xqid'];
		
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		

		$cls=M($grdo['grdnm'].'_cls');
		
		$std=M($grdo['grdnm'].'_std');
		$std->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
		if($mk=='all'){
			$where="f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND f_std_statid<>9";
		}else if($mk=='zp'){
			$where="f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND f_std_statid<>9 AND stdpt NOT LIKE '%default%'";
		}
		$where=$where." AND stdno=''"; //取消了stdupfnctm 只针对学号没编的童鞋
		
		$stdls=$std->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where($where)->order('mjnm ASC,stdaplno ASC')->select();
		
		//先安排班级登记，然后获得前缀编学号，最后在pxh表里登记
		$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
		$zspxh=M($grdo['grdnm'].'_zspxh');
		foreach($stdls as $stdv){
			//通过专业-》班级
			if($stdv['stdno']==''){//如果这货还没有编学号的话
				$stdxqclso=$stdxqcls->where('f_stdxqcls_stdid='.$stdv['stdid'].' AND f_stdxqcls_xqid='.$xqid)->find();
				$dt=array(
						'f_stdxqcls_clsid'=>$dzb[$stdv['f_stdxqmj_mjid']],
				);
				$clso=$cls->where('clsid='.$dzb[$stdv['f_stdxqmj_mjid']])->find();
				$stdxqcls->where('stdxqclsid='.$stdxqclso['stdxqclsid'])->setField($dt);
				//为了防止转来的学生学号成为最大，影响整体的学号前缀，因此，我们只考虑原配的学号前缀已有的最大的那个童鞋去+1，这样就不会有重复了，不用管是否有学生转学来转学去
				$stdlsforststdno=$stdxqcls->join('tb_'.$grdo['grdnm'].'_std ON f_stdxqcls_stdid=stdid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->where("stdno LIKE '%".$clso['clsxhprx']."%'")->order('stdno DESC')->select();//查出一个班里的人，不管阿猫阿狗走了没走，只能在最大的数字上开刀
				//先搞定学号，让后转移照片到指定文件夹
				if($stdlsforststdno){
					//有班级同学的话可以看其他同学的型号//取第一个最大的
					$stdoclsmt=$stdlsforststdno[0];
					if($stdoclsmt['stdno']==''){
						$stdno=$clso['clsxhprx'].'01';
					}else{
						$tmp=explode($clso['clsxhprx'], $stdoclsmt['stdno']);
						$tmp=intval($tmp[1])+1;
						if(floor($tmp/10)==0){
							$stdno=$clso['clsxhprx'].'0'.$tmp;
						}else{
							$stdno=$clso['clsxhprx'].$tmp;
						}
						
					}
				}else{
					//没班级同学的话可以+
					$stdno=$clso['clsxhprx'].'01';
				}

				//排学号时，发现有非默认照片且没上传过，那么就给他传给指定文件夹一记，否则就照旧
				if(strpos($stdv['stdpt'],'default')==false&&strpos($stdv['stdpt'],'tmp')==true){
					$sys=M('sys');
					$syso=$sys->find();
					$stdpt=str_replace('/'.$syso['sysnm'].'/', './', $stdv['stdpt']);
					
					import('@.FileUtil.FileUtilAction');
					$fu = new FileUtil();
					
					$fu->copyFile($stdpt,'./Uploads/std/'.$grdo['grdnm'].'/1/'.$stdno.'.jpg');
					$stdpt='/'.$syso['sysnm'].'/Uploads/std/'.$grdo['grdnm'].'/1/'.$stdno.'.jpg';
					
				}else{
					$stdpt=$stdv['stdpt'];
				}
				$dt=array(
						'stdno'=>$stdno,
						'stdpt'=>$stdpt,
				);
				$std->where('stdid='.$stdv['stdid'])->setField($dt);
				$dt=array(
						'f_zspxh_grdid'=>$grdid,
						'f_zspxh_stdid'=>$stdv['stdid'],
						'zspxhtm'=>$tm,
						'zspxhschqtm'=>'',
				);
				$zspxh->data($dt)->add();
			}
			
		}
		
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	
	//做饭卡
	function zfk(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Zspxh'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],'qry');
		
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		$mk=$_GET['mk'];
		
		$zssz=M('zssz');
		$zsszo=$zssz->find();
		$grdid=$zsszo['f_zssz_grdid'];
		$xqid=$zsszo['f_zssz_xqid'];
	
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
	
	
		$mj=M($grdo['grdnm'].'_mj');
	
		$mjls=$mj->where("mjsttu LIKE '%-1-%'")->select();
		
		
		
		$mjlsnw=array();
		$zspxh=M($grdo['grdnm'].'_zspxh');
		foreach($mjls as $mjv){
			$zspxh->join('tb_'.$grdo['grdnm'].'_std ON f_zspxh_stdid=stdid')
			->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
			
			$where="f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND f_std_statid<>9 AND stdupfnctm<>'' AND f_stdxqmj_mjid=".$mjv['mjid']." AND stdno<>'' AND zspxhschqtm=''";
			
			$stdls=$zspxh->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where($where)->order('mjnm ASC,stdaplno ASC')->select();
			
			if($stdls){
				$hspt=0;
				$stdlsnw=array();
				foreach($stdls as $stdv){
					if(preg_match('/default/', $stdv['stdpt'])){
						continue;
					}else{
						array_push($stdlsnw, $stdv);
					}
				}
				
				$mjv['stdls']=$stdlsnw;
				array_push($mjlsnw, $mjv);
			}
			
		}
		
		$this->assign('mjls',$mjlsnw);
		$this->assign('mk',$mk);
		
		$this->assign('title','做饭卡');
		$this->assign('theme','做饭卡');
		$this->display('zfk');
		
		
	}
	
	public function outputschq(){
		
		$mk=$_GET['mk'];
		
		//先去数据库找出你要让哪些数据出来
		header("Content-Type:text/html; charset=utf-8");
		 
		$zssz=M('zssz');
		$zsszo=$zssz->where('zsszid=1')->find();
		$xqid=$zsszo['f_zssz_xqid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$zsszo['f_zssz_grdid'])->find();
		$grdnm=$grdo['grdnm'];
		 
		$jn='tb_stt ON f_std_sttid=sttid-jn-tb_grd ON f_std_grdid=grdid-jn-tb_'.$grdnm.'_mj ON f_stdxqmj_mjid=mjid-jn-tb_bxxs ON f_mj_bxxsid=bxxsid-jn-tb_cc ON f_mj_ccid=ccid-jn-tb_kl ON f_mj_klid=klid-jn-tb_xxxs ON f_mj_xxxsid=xxxsid-jn-tb_zsfw ON f_mj_zsfwid=zsfwid-jn-tb_xz ON f_mj_xzid=xzid-jn-tb_'.$grdnm.'_cls ON f_stdxqcls_clsid=clsid-jn-tb_dm ON f_stdxqdm_dmid=dmid-jn-tb_sex ON f_std_sexid=sexid-jn-tb_rc ON f_std_rcid=rcid-jn-tb_zzmm ON f_std_zzmmid=zzmmid-jn-tb_xl ON f_std_xlid=xlid-jn-tb_stat ON f_std_statid=statid-jn-tb_xq ON f_stdxqcls_xqid=xqid';
		$fldint='-zspxhid-bxxsnm-stdno-stdnm-sexnm-mjnm-stdidcd-';
		$jsn=array(
				'bxxsnm'=>'办学形式',
				'sttnm'=>'站点',
				'grdnm'=>'年级',
				'stdaplno'=>'报名号',
				'stdno'=>'学号',
				'stdupfnctm'=>'上传财务时间',
				'stdnm'=>'姓名',
				//'xnl'=>'是否小年龄【暂定小年龄为'.$zsszxnltm.'后出生】',
				'clsnm'=>'班级',
				'dmnm'=>'寝室',
				'sexnm'=>'性别',
				'rcnm'=>'民族',
				'zzmmnm'=>'政治面貌',
				'stdnp'=>'籍贯',
				'stdbtd'=>'出生日期',
				'xnl'=>'是否小年龄',
				'stdsol'=>'文理科',
				'stdcee'=>'高考成绩',
				'stdsog'=>'毕业学校',
				'stdqq'=>'QQ',
				'xlnm'=>'最高学历',
				'stdidcd'=>'身份证号码',
				'stdcp'=>'手机号码',
				'stdrlta'=>'家长一',
				'stdrltanm'=>'家长一姓名',
				'stdrltaocpt'=>'家长一职业',
				'stdrltacp'=>'家长一手机号',
				'stdrltb'=>'家长二',
				'stdrltbnm'=>'家长二姓名',
				'stdrltbocpt'=>'家长二职业',
				'stdrltbcp'=>'家长二手机号',
				'stdhb'=>'爱好',
				'mjnm'=>'专业',
				'statnm'=>'状态',
				'stdpst'=>'邮编',
				'stdads'=>'家庭地址',
				'stdmdftm'=>'修改时间',
				'stdaddtm'=>'添加时间',
				'stdtlp'=>'固话',
				'stdpertm'=>'预录取时间',
				'stdertm'=>'录取时间',
				'stdicbc'=>'工行卡号',
				'stdrcmdnm'=>'推荐人姓名',
				'stdrcmdcp'=>'推荐人手机号',
				'stdpnttm'=>'信息打印时间',
				'xqnm'=>'学期',
		);
		 
		//NB初始化，开始
		$m=M($grdo['grdnm'].'_zspxh');
		$m->join('tb_'.$grdo['grdnm'].'_std ON f_zspxh_stdid=stdid')->join('inner join tb_'.$grdnm.'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdnm.'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdnm.'_stdxqmj ON stdid=f_stdxqmj_stdid');
		 
	
		$cdtint="-sp-f_stdxqmj_xqid-eq-".$xqid."-sp-f_stdxqcls_xqid-eq-".$xqid."-sp-f_stdxqdm_xqid-eq-".$xqid."-sp-";
		if($mk=='all'){
			$spccdtint="-sp-f_std_statid<>9-sp-stdno<>''-sp-zspxhschqtm=''-sp-";
		}else if($mk=='zp'){
			$spccdtint="-sp-f_std_statid<>9-sp-stdno<>''-sp-zspxhschqtm=''-sp-(stdpt NOT LIKE '%-default-%')-sp-";
		}
		$odrint='-mjnm ASC-stdno ASC-';
		$lmtint=20;
		//$jn='tb_ath ON f_athid=athid-jn-tb_atc ON f_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($m,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn,'y');
		$fld=$arr['fld'];
		//去 f_...//先拆开，后结合的方式
		$fldu=explode('-', $fld);
		$fldnw='-';
		for($i=1;$i<count($fldu)-1;$i++){
			if(!preg_match('/f_/', $fldu[$i])){
				$fldnw=$fldnw.$fldu[$i].'-';
			}
		}
		$fld=$fldnw;
	
		$mlsall=$arr['mlsforcount'];
	
	
		$fld=str_replace('-stdbtd-', '-stdbtd-xnl-', $fld);
		$zssz=M('zssz');
		$zsszo=$zssz->where('zsszid=1')->find();
		$tmp=explode(' ', $zsszo['zsszxnltm']);
		$zsszxnltm=$tmp[0];
		$mlsallfn=array();
		foreach ($mlsall as $stdv){
			if($stdv['stdbtd']<$zsszxnltm){$stdv['xnl']='否';}else{$stdv['xnl']='是';}
			array_push($mlsallfn, $stdv);
		}
		$mlsall=$mlsallfn;

		//对每个学生设置上传时间
		$tm=date("Y-m-d H:i:s",time());
		$zspxh=M($grdo['grdnm'].'_zspxh');
		foreach($mlsall as $zspxhv){
			$dt=array(
					'zspxhschqtm'=>$tm,
			);
			$zspxh->where('zspxhid='.$zspxhv['zspxhid'])->setField($dt);
		}
	
		$zm=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		
		
	
	
		import('@.ORG.PHPExcel');
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("ctos")
		->setLastModifiedBy("ctos")
		->setTitle("Office 2007 XLSX Test Document")
		->setSubject("Office 2007 XLSX Test Document")
		->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
		->setKeywords("office 2007 openxml php")
		->setCategory("Test result file");
	
		$objPHPExcel->getSheet(0)->setTitle('继续教育学院饭卡制作名单');
		$objActSheet = $objPHPExcel->getSheet(0);//指定sheet
		$objActSheet->getColumnDimension('A')->setWidth(4.77);
		$objActSheet->getColumnDimension('B')->setWidth(18.99);
		$objActSheet->getColumnDimension('C')->setWidth(15.2);
		$objActSheet->getColumnDimension('D')->setWidth(7.7);
		$objActSheet->getColumnDimension('E')->setWidth(4.63);
		$objActSheet->getColumnDimension('F')->setWidth(19.7);
		$objActSheet->getColumnDimension('G')->setWidth(20.4);
		$objActSheet->getColumnDimension('H')->setWidth(10.27);
		 
	
		// set table header content列是从0开始，行是从1开始
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
		$sheet=$objPHPExcel->setActiveSheetIndex(0);
		$sheet=$sheet->setCellValueByColumnAndRow(0,1,'序号');
		
		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('A1')->getBorders();
		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		
		$fldu=explode('-', $fld);
		for($i=2;$i<count($fldu)-1;$i++){
			$sheet=$sheet->setCellValueByColumnAndRow($i-1,1,$jsn[$fldu[$i]]);
			
			$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-1].'1')->getBorders();
			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		}
	
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
		$sheet=$objPHPExcel->setActiveSheetIndex(0);
		$sheet=$sheet->setCellValueByColumnAndRow(7,1,'所在分院');
		
		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('H1')->getBorders();
		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	
		//Miscellaneous glyphs, UTF-8
		for($j=0;$j<count($mlsall);$j++){
			$m=$mlsall[$j];
			$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
			
			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('A'.($j+2))->getBorders();
			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			
			for($i=2;$i<count($fldu)-1;$i++){
				$sheet=$sheet->setCellValueByColumnAndRow($i-1,$j+2,$m[$fldu[$i]].' ');
				
				$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-1].''.($j+2))->getBorders();
				$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			}
			
			$sheet=$sheet->setCellValueByColumnAndRow(7,$j+2,'成教学院');
				
			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('H'.($j+2))->getBorders();
			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			
		}
	
	
		//  sheet命名
		//$objPHPExcel->getActiveSheet()->setTitle('订单汇总表');
	
	
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
	
	
		// excel头参数
		header('Content-Type: application/vnd.ms-excel');
		header("Content-Disposition: attachment;filename=".'上传后勤制作饭卡'.date("Ymd-His").".xls");  //日期为文件名后缀
		header('Cache-Control: max-age=0');
	
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式
		$objWriter->save('php://output');
	}
	
	function resetpassword(){
	
		$grdid=$_POST['grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		$std=M($grdo['grdnm'].'_std');$stdls=$std->select();
		$dataI=array(
				'stdpw'=>22222222
		);
		$dataII=array(
				'stdpw'=>md5('11111111')
		);
		$std->where('stdid='.$_POST['stdid'])->setField($dataI);//为了避免md5(11111111)改md5(11111111)失败的难看
		if($std->where('stdid='.$_POST['stdid'])->setField($dataII)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function stylq(){
		$zssz=M('zssz');
		$zsszo=$zssz->find();
		$grdid=$zsszo['f_zssz_grdid'];
		$xqid=$zsszo['f_zssz_xqid'];
						
		$stdid=$_GET['stdid'];;
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		
		$std=M($grdo['grdnm'].'_std');
		$stdo=$std->where('stdid='.$stdid)->find();
		if($stdo['f_std_statid']==1){
			$dt=array(
					'f_std_statid'=>3,
					'stdpnttm'=>date("Y-m-d H:i:s",time()),
			);
			if($std->where('stdid='.$stdid)->setField($dt)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
		}else{
			$data['status']=3;
			$this->ajaxReturn($data,'json');
		}
		
		
		
	}
	
	function createAlways(){
		$grdid=$_POST['f_std_grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		$cls=M($grdo['grdnm'].'_cls');
		$mj=M($grdo['grdnm'].'_mj');
		
		
		
		
		$wherecls='1=1';
		$wheremj='1=1';
		if($_POST['f_mj_ccid']){
			$wheremj=$wheremj.' AND f_mj_ccid='.$_POST['f_mj_ccid'];
		}
		if($_POST['f_mj_klid']){
			$wheremj=$wheremj.' AND f_mj_klid='.$_POST['f_mj_klid'];
		}
		if($_POST['f_mj_xxxsid']){
			$wheremj=$wheremj.' AND f_mj_xxxsid='.$_POST['f_mj_xxxsid'];
		}
		if($_POST['f_mj_zsfwid']){
			$wheremj=$wheremj.' AND f_mj_zsfwid='.$_POST['f_mj_zsfwid'];
		}
		if($_POST['f_mj_xzid']){
			$wheremj=$wheremj.' AND f_mj_xzid='.$_POST['f_mj_xzid'];
		}
		if($_POST['f_std_sttid']){
			$wherecls=$wherecls.' AND f_cls_sttid='.$_POST['f_std_sttid'];
			$wheremj=$wheremj." AND mjsttu LIKE '%-".$_POST['f_std_sttid']."-%'";
		}
		if($_POST['f_std_grdid']){
			$wherecls=$wherecls.' AND f_cls_grdid='.$_POST['f_std_grdid'];
			$wheremj=$wheremj.' AND f_mj_grdid='.$_POST['f_std_grdid'];
		}
		if($_POST['f_mj_bxxsid']){
			$wheremj=$wheremj.' AND f_mj_bxxsid='.$_POST['f_mj_bxxsid'];
		}
		$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where($wherecls)->select();
		$mjls=$mj->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->where($wheremj)->select();
		$clsoptu="<option value=''>无</option>";
		foreach ($clsls as $v){
			$clsoptu=$clsoptu."<option value='".$v['clsid']."'>[".$v['sttnm'].']'.$v['clsnm']."</option>";
		}
		$clsoptu=$clsoptu."<option value='0'>[]未分班</option>";
		$mjoptu="<option value=''>无</option>";
		foreach ($mjls as $v){
			if(preg_match('/技能/',$v['bxxsnm'])){
				$v['bxxsnmst']='技能';
			}else if(preg_match('/自考/',$v['bxxsnm'])){
				$v['bxxsnmst']='自考';
			}else{
				$v['bxxsnmst']='普通';
			}
			$mjoptu=$mjoptu."<option value='".$v['mjid']."'>[".$v['bxxsnmst'].']'.$v['mjdm'].$v['mjnm']."</option>";
		}
		
		
		$data['clsoptu']=$clsoptu;
		$data['mjoptu']=$mjoptu;
		
		if($_POST['stdid']==='0'){//就是添加的时候比较特殊
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqls=$xqw->getxqls($grdo['grdid'], $_POST['f_std_sttid'], 'ASC');
			$xqoptu="<option value='".$xqls[0]['xqid']."'>".$xqls[0]['xqnm']."</option>";
		}else{
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
				$xqoptu=$xqoptu."<option value='".$v['xqid']."'>".$v['xqnm']."</option>";
			}
			
		}
		$data['xqoptu']=$xqoptu;
		
		//看情况产生学号//看看的
		//1、如果是query中的班级变化，应该对下面的学号不产生影响
		//2、如果是add或者modify中的class的变化应该对stdno产生影响
		//本次属于传是传了，但是不知道是不是为null还是0还是其他数字，这个情况选用is_null
		if(is_null($_POST['stdid'])){// 情况1
			$data['stdno']='';
		}else{
			if($_POST['stdid']==0){
				//随便搞
				$flg='sbg';
			}else{
				$std=M($grdo['grdnm'].'_std');
				$stdo=$std->field('stdno')->where('stdid='.$_POST['stdid'])->find();
				if($stdo['stdno']){
					$flg='zj';
				}else{
					$flg='sbg';
				}
				
			}
			if($flg=='sbg'){
				//按这学期的行情来，如果他之前没有学号的话
				$xq=M('xq');
				$xqodq=$xq->where('xqdq=1')->find();
				if($_POST['f_stdxqcls_xqid']==$xqodq['xqid']){
					if($_POST['f_stdxqcls_clsid']){//有班级
						$clso=$cls->where('clsid='.$_POST['f_stdxqcls_clsid'])->find();
						if($clso['clsxhprx']){//且班级的前缀是给了的
							$std=M($grdo['grdnm'].'_std');
							$stdo=$std->field('stdno')->where("stdno LIKE '%".$clso['clsxhprx']."%'")->order('stdno DESC')->find();
							if($stdo){//有学生
								$xhzjdtx=(int)substr($stdo['stdno'], -2);//学号最近的同学
								$xhzjdtx=$xhzjdtx+1;
								$data['stdno']=$clso['clsxhprx'].$xhzjdtx;
							}else{//之前木有学生的话捏
								$data['stdno']=$clso['clsxhprx'].'01';
							}
						}else{
							$data['stdno']='';
						}
					
					}else{
						$data['stdno']='';
					}
				}else{
					$data['stdno']='';
				}
				
			}
			if($flg=='zj'){
				$stdo=$std->field('stdno')->where('stdid='.$_POST['stdid'])->find();
				$data['stdno']=$stdo['stdno'];
			}
			
			
			
		}
		
		
		//处理报名号//看看的
		if(is_null($_POST['stdid'])){// 情况1
			$data['stdaplno']='';
		}else{
			if($_POST['stdid']==0){
				$flg='sbg';
			}else{
				$xq=M('xq');
				$xqodq=$xq->where('xqdq=1')->find();
				if($_POST['f_stdxqcls_xqid']==$xqodq['xqid']){
					//在2.3之间的bxxsid 切换了则用新的，否则用旧的
					$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
					$stdxqmjo=$stdxqmj->where('f_stdxqmj_stdid='.$_POST['stdid'])->order('f_stdxqmj_xqid DESC')->find();
					$mjid=$stdxqmjo['f_stdxqmj_mjid'];
					$mj=M($grdo['grdnm'].'_mj');
					$mjo=$mj->where('mjid='.$mjid)->find();
					$bxxsid=$mjo['f_mj_bxxsid'];
					$bxxs=M('bxxs');
					$bxxso=$bxxs->where('bxxsid='.$bxxsid)->find();
						
					$f_mj_bxxsid=$_POST['f_mj_bxxsid'];
					//处理报名号//如果和当前学期，这个属于学籍部分
					if((preg_match('/技能/', $bxxso['bxxsnm'])||preg_match('/自考/', $bxxso['bxxsnm']))&&$f_mj_bxxsid!=$bxxsid){
							
						//添加的话是 有特殊说明 按特殊说明来，否则的话就是给编一个
						//修改则不同，一般而言肯定是2和3都有aplno了的，所以重点就在于是延续保持，还是换，而且报名号也就是招生期间用之后就没有意义了
						$flg='sbg';	
									
					}else{
						$flg='zj';
						
					}
				}else{
					$flg='zj';
				}
			}
			if($flg=='sbg'){
				$f_mj_bxxsid=$_POST['f_mj_bxxsid'];
				$bxxs=M('bxxs');
				$bxxso=$bxxs->where('bxxsid='.$f_mj_bxxsid)->find();
				$stdaplno='';
				if(preg_match('/技能/', $bxxso['bxxsnm'])||preg_match('/自考/', $bxxso['bxxsnm'])){
					if(preg_match('/技能/', $bxxso['bxxsnm'])){
						$stdaplno='J'.$grdo['grdnm'];
				
					}else if(preg_match('/自考/', $bxxso['bxxsnm'])){
						$stdaplno='Z'.$grdo['grdnm'];
				
					}
					$std=M($grdo['grdnm'].'_std');
					$stdls=$std->field('stdaplno')->where("stdaplno LIKE '%".$stdaplno."%'")->order('stdaplno DESC')->select();
					if(count($stdls)>0){
						$stdo=$stdls[0];
						$hou=substr($stdo['stdaplno'],5);
						$hounew=intval($hou)+1;
						if(intval($hounew/1000)>0){
							$k=0;
						}else if(intval($hounew/100)>0){
							$k=1;
						}else if(intval($hounew/10)>0){
							$k=2;
						}else{
							$k=3;
						}
					}else{
						$k=3;
						$hounew=1;
					}
					$ling='';
					for($i=0;$i<$k;$i++){
						$ling=$ling.'0';
					}
					$stdaplno=$stdaplno.$ling.$hounew;
				}
			}
			if($flg=='zj'){//照旧
				$std=M($grdo['grdnm'].'_std');
				$stdo=$std->field('stdaplno')->where('stdid='.$_POST['stdid'])->find();
				$stdaplno=$stdo['stdaplno'];
			}
			$data['stdaplno']=$stdaplno;
		}
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	
}



?>