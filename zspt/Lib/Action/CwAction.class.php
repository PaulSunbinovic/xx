<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class CwAction extends Action{
	
	
	
	function gtxpg(){
		

		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		if($x=='vw'){
			
			$zssz=M('zssz');
			$zsszo=$zssz->find();
			
			$grdid=$zsszo['f_zssz_grdid'];
			$xqid=$zsszo['f_zssz_xqid'];
			
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
			
			
			$stdid=$_GET['stdid'];
			
			
			
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$cwo=M($grdo['grdnm'].'_cw')->where('f_cw_stdid='.$stdid.' AND f_cw_xnid='.$xno['xnid'])->find();
			$cwid=$cwo['cwid'];
			$xqid=$cwo['cwzcxqid'];
				
			$cw=M($grdo['grdnm'].'_cw')->join('tb_'.$grdo['grdnm'].'_std ON f_cw_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
			$mo=$cw->join('tb_xn ON f_cw_xnid=xnid')->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND cwid=".$cwid)->find();
			
			//给专业多点修饰
			if(preg_match('/技能/',$mo['bxxsnm'])){
				$mo['bxxsnmst']='技能';
			}else if(preg_match('/自考/',$mo['bxxsnm'])){
				$mo['bxxsnmst']='自考';
			}else{
				$mo['bxxsnmst']='普通';
			}
			//需要看下如果是其他函授站的可以能要第一学期，第二学期，第三学期之类的很BT的东西
			
			//适应一些站点用一二三
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqnm=$xqw->getxqnm($grdid, $mo['f_std_sttid'], $xqid);
			$mo['xqnm']=$xqnm;
			$mo['cwyjze']=$mo['cwyjxfsm']+$mo['cwyjjckwfsm']+$mo['cwyjzsfsm'];
			$mo['cwsjze']=$mo['cwsjxfsm']+$mo['cwsjjckwfsm']+$mo['cwsjzsfsm'];
			
			$this->assign('mo',$mo);
			
			
			
			
			
			
			$this->assign('title','查看');
			$this->assign('theme','查看缴费信息');
			$this->display('view');
		}else if($x=='updt'){
			$cwid=$_GET['cwid'];
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$cwo=M($grdo['grdnm'].'_cw')->where('cwid='.$cwid)->find();
			$xqid=$cwo['cwzcxqid'];
						
			
				
			$usr=M('usr');
			$usro=$usr->where('usrid='.session('usridss'))->find();
			//鉴权对用户对stt的权限，若为设置权限，说明是教务的人，可以全管，否则只能管自己函授站的 ntf为不用this assign的
			$mdII=M('md');
			$mdo=$mdII->where("mdmk='Stt'")->find();
			import('@.IDTATH.IdtathAction');
			$Idtath = new IdtathAction();
			$athofnstt=$Idtath->identify($mdo['mdid'],'ntf');
			
			if($cwid==0){
// 				$mo['stdid']=0;
				
// 				$mo['stdsol']='无';
				
// 				$mo['stdpt']=C('PUBLIC').'/IMG/default.jpg';
// 				//第几学年 第几学期的班级 第几学年 第几学期的专业 ...
// 				//因为grd无法定下来，所以stdxqcls stdxqmj_xqid 定下来也没有意义，干脆就不定了，等搜索时候自由分晓
				
// 				//默认年级是当前年级
// 				$grd=M('grd');
// 				$grdo=$grd->order('grdnm DESC')->find();
// 				$grdid=$grdo['grdid'];
// 				$mo['f_std_grdid']=$grdid;
// 				$mo['grdnm']=$grdo['grdnm'];
				
// 				//默认站点，有主的找有主的，没主的找本部
// 				if($athofnstt['aths']!=1){
// 					$mo['f_std_sttid']=$usro['f_usr_sttid'];
// 				}else{
// 					$mo['f_std_sttid']=1;
// 				}
				
// 				//默认学期 为XX年级XX站点的起始学期
// 				$sttintxq=M($grdo['grdnm'].'_sttintxq');
// 				$sttintxqo=$sttintxq->where('f_sttintxq_grdid='.$grdo['grdid'].' AND f_sttintxq_sttid='.$mo['f_std_sttid'])->find();
// 				$xqid=$sttintxqo['f_sttintxq_xqid'];
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
// 				if($athofnstt['aths']!=1){
// 					$where=$where.' AND f_cls_sttid='.$usro['f_usr_sttid'];
// 				}
// 				//之前已经确定过到底是看哪个年级
// 				$where=$where.' AND f_cls_grdid='.$grdid;
// 				$cls=M($grdo['grdnm'].'_cls');
// 				$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where($where)->order('clsnm ASC')->select();
// 				$this->assign('clsls',$clsls);
					
					
// 				$where='1=1';
// 				if($athofnstt['aths']!=1){
// 					$where=$where." AND mjsttu LIKE '%-".$usro['f_usr_sttid']."-%'";
// 				}
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
				
			}else{
				
				$grd=M('grd');
				
				$cw=M($grdo['grdnm'].'_cw')->join('tb_'.$grdo['grdnm'].'_std ON f_cw_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
				
				$mo=$cw->join('tb_xn ON f_cw_xnid=xnid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND cwid=".$cwid)->find();
				
				if(preg_match('/技能/',$mo['bxxsnm'])){
					$mo['bxxsnmst']='技能';
				}else if(preg_match('/自考/',$mo['bxxsnm'])){
					$mo['bxxsnmst']='自考';
				}else{
					$mo['bxxsnmst']='普通';
				}
				
				$mo['cwyjze']=$mo['cwyjxfsm']+$mo['cwyjjckwfsm']+$mo['cwyjzsfsm'];
				$mo['cwsjze']=$mo['cwsjxfsm']+$mo['cwsjjckwfsm']+$mo['cwsjzsfsm'];
				
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
				
				

				
				//所有的注册信息，哪个学期哪个班哪个专业
				//应该具备哪些注册信息
				//学期
				import('@.XQ.XQAction');
				$xqw = new XQAction();//外来的学期
				$xqls=$xqw->getxqls($grdid, $mo['f_std_sttid'], 'ASC');//年级确定开始，学制确定过程
				$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
				$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
				for($i=0;$i<count($xqls);$i++){
					$xqid=$xqls[$i]['xqid'];
					if($stdxqcls->where('f_stdxqcls_stdid='.$mo['f_cw_stdid'].' AND f_stdxqcls_xqid='.$xqid)->find()&&$stdxqmj->where('f_stdxqmj_stdid='.$mo['f_cw_stdid'].' AND f_stdxqmj_xqid='.$xqid)->find()){
						$xqls[$i]['zcf']='active';//注册否？
						$xqls[$i]['zczt']='已注册';
					}else{
						$xqls[$i]['zcf']='disabled';
						$xqls[$i]['zczt']='未注册';
					}
					$stdxqclso=$stdxqcls->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->where('f_stdxqcls_stdid='.$mo['f_cw_stdid'].' AND f_stdxqcls_xqid='.$xqid)->find();
					$stdxqmjo=$stdxqmj->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->where('f_stdxqmj_stdid='.$mo['f_cw_stdid'].' AND f_stdxqmj_xqid='.$xqid)->find();
					$xqls[$i]['clsnm']=$stdxqclso['clsnm'];
					$xqls[$i]['mjnm']=$stdxqmjo['mjnm'];
				}
				$this->assign('zcls',$xqls);//注册列表
				
				//特殊情况
				$tsqk=M($grdo['grdnm'].'_tsqk');
				$tsqkls=$tsqk->where('f_tsqk_stdid='.$mo['f_cw_stdid'])->order('tsqktm DESC')->select();
				$this->assign('tsqkls',$tsqkls);
			}
			
			

			
			$this->assign('mo',$mo);
			
			

			
			$this->display('update');
		}else if($x=='center'){
			
			$zssz=M('zssz');
			$zsszo=$zssz->find();
			
			$grdid=$zsszo['f_zssz_grdid'];
			$xqid=$zsszo['f_zssz_xqid'];
			
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
			
			
			$stdid=session('stdidss');
			
			
			
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$cwo=M($grdo['grdnm'].'_cw')->where('f_cw_stdid='.$stdid.' AND f_cw_xnid='.$xno['xnid'])->find();
			$cwid=$cwo['cwid'];
			$xqid=$cwo['cwzcxqid'];
				
			$cw=M($grdo['grdnm'].'_cw')->join('tb_'.$grdo['grdnm'].'_std ON f_cw_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
			$mo=$cw->join('tb_xn ON f_cw_xnid=xnid')->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND cwid=".$cwid)->find();
			
			//给专业多点修饰
			if(preg_match('/技能/',$mo['bxxsnm'])){
				$mo['bxxsnmst']='技能';
			}else if(preg_match('/自考/',$mo['bxxsnm'])){
				$mo['bxxsnmst']='自考';
			}else{
				$mo['bxxsnmst']='普通';
			}
			//需要看下如果是其他函授站的可以能要第一学期，第二学期，第三学期之类的很BT的东西
			
			//适应一些站点用一二三
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqnm=$xqw->getxqnm($grdid, $mo['f_std_sttid'], $xqid);
			$mo['xqnm']=$xqnm;
			$mo['cwyjze']=$mo['cwyjxfsm']+$mo['cwyjjckwfsm']+$mo['cwyjzsfsm'];
			$mo['cwsjze']=$mo['cwsjxfsm']+$mo['cwsjjckwfsm']+$mo['cwsjzsfsm'];
			
			$this->assign('mo',$mo);
			
			
			
			
			
			
			$this->assign('title','个人财务中心');
			$this->assign('theme','个人财务中心');
			$this->display('center');
		}
		
	
	}
	
	//------------------【】【】【】【】以上是财务部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		

		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cw'")->find();
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
		$cw=M($grdo['grdnm'].'_cw')->join('tb_'.$grdo['grdnm'].'_std ON f_cw_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
		
// 		$stdls=$std->select();
		
		$fldint='-cwid-bxxsnm-sttnm-f_std_grdid-grdnm-f_cw_xnid-xnnm-f_stdxqcls_clsid-clsnm-stdno-stdnm-sexnm-dmnm-mjnm-statnm-cwyjxfsm-cwyjjckwfsm-cwyjzsfsm-cwsjxfsm-cwsjjckwfsm-cwsjzsfsm-';
		//$cdtint="-sp-f_std_ccid-eq-3-sp-f_std_xxxsid-eq-2-sp-f_std_zsfwid-eq-2-sp-f_std_xzid-eq-2-sp-f_std_sttid-eq-1-sp-f_std_statid-eq-5-sp-";
		
		//说明：每年的收学费都是 比如 2014-2015学年，那么收费就是2014-2015学年 第1学期 进行注册初始化 注册时候为第1学期 财务的年级、站点 专业的办学形式 层次 科类 决定该学年的收费标准执行
		////而显示的专业则为，如果他是2014-2015学年第1学期注册的，那么就是顺延到下面一个学期，这两个学期他的最终专业班级为准，毕竟我们看的时候他那一年的终极版本。如果偶尔有人转专业，呵呵，就手动改哈~~ 因此这里需要引入一个学年的概念
		//默认学年 就是 所选的的学年
		//通过学年=》涉及的两个学期，通过站点=》可能注册的学期节点，通过相交，可以找出那个学年的注册学期
		//然后通过当前学期进行判断 显示财务当年最终专业班级的最终学期的学期ID，从而获得学期ID
		//由于和stt有关系，因此，我们xqid的产生也将在下面的stt判断中一并产生，见谅
		
		$xn=M('xn');
		$xno=$xn->where('xndq=1')->find();
		
		if($athofnstt['aths']==1){
			
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqid=$xqw->getcwxqid($grdid, $xno['xnid'], 1);
			
			$f_usr_sttid=1;
			$sttintxq=M($grdo['grdnm'].'_sttintxq');
			$sttintxqo=$sttintxq->where('f_sttintxq_grdid='.$grdo['grdid'].' AND f_sttintxq_sttid='.$f_usr_sttid)->find();
			//if($xqid<$sttintxqo['f_sttintxq_xqid']){$xqid=$sttintxqo['f_sttintxq_xqid'];}//①如果激活的学期在初始学期后范围内的那么就选激活的学期②如果...在范围外的话呢就选择第初始学期为默认学期
			$cdtint="-sp-f_std_grdid-eq-".$grdid."-sp-f_cw_xnid-eq-".$xno['xnid']."-sp-f_std_sttid-eq-".$f_usr_sttid."-sp-f_std_statid-eq-5-sp-f_stdxqcls_xqid-eq-".$xqid."-sp-f_stdxqmj_xqid-eq-".$xqid."-sp-f_stdxqdm_xqid-eq-".$xqid.'-sp-';
			//接下来产生学期
			
		}else{
			$f_usr_sttid=$usro['f_usr_sttid'];
			$xqid=$xqw->getcwxqid($grdid, $xno['xnid'], $f_usr_sttid);
			$sttintxq=M($grdo['grdnm'].'_sttintxq');
			$sttintxqo=$sttintxq->where('f_sttintxq_grdid='.$grdo['grdid'].' AND f_sttintxq_sttid='.$f_usr_sttid)->find();
			//if($xqid<$sttintxqo['f_sttintxq_xqid']){$xqid=$sttintxqo['f_sttintxq_xqid'];}//①如果激活的学期在初始学期后范围内的那么就选激活的学期②如果...在范围外的话呢就选择第初始学期为默认学期
			$cdtint="-sp-f_std_grdid-eq-".$grdid."-sp-f_std_sttid-eq-".$f_usr_sttid."-sp-f_std_statid-eq-5-sp-f_stdxqcls_xqid-eq-".$xqid."-sp-f_stdxqmj_xqid-eq-".$xqid."-sp-f_stdxqdm_xqid-eq-".$xqid.'-sp-';
			//接下来产生学期
		}
		
		$spccdtint='-sp-';////
		$odrint='-f_mj_bxxsid ASC-clsid ASC-mjid ASC-stdno ASC-';
		$lmtint=20;
		$jn='tb_xn ON f_cw_xnid=xnid-jn-tb_stt ON f_std_sttid=sttid-jn-tb_grd ON f_std_grdid=grdid-jn-tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid-jn-tb_bxxs ON f_mj_bxxsid=bxxsid-jn-tb_cc ON f_mj_ccid=ccid-jn-tb_kl ON f_mj_klid=klid-jn-tb_xxxs ON f_mj_xxxsid=xxxsid-jn-tb_zsfw ON f_mj_zsfwid=zsfwid-jn-tb_xz ON f_mj_xzid=xzid-jn-tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid-jn-tb_dm ON f_stdxqdm_dmid=dmid-jn-tb_sex ON f_std_sexid=sexid-jn-tb_rc ON f_std_rcid=rcid-jn-tb_zzmm ON f_std_zzmmid=zzmmid-jn-tb_xl ON f_std_xlid=xlid-jn-tb_stat ON f_std_statid=statid-jn-tb_xq ON f_stdxqcls_xqid=xqid';
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($cw,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		
		//判断std所在的班级，当前人员能否修改。。。其实就是看他是教务的还是管理员还是他亲生班主任
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			//设置对相应的该生是否具有修改权限
			//计算应缴总额和实缴总额
			$v['cwyjze']=$v['cwyjxfsm']+$v['cwyjjckwfsm']+$v['cwyjzsfsm'];
			$v['cwsjze']=$v['cwsjxfsm']+$v['cwsjjckwfsm']+$v['cwsjzsfsm'];
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
		$bxxs=M('bxxs');
		$bxxsls=$bxxs->select();
		$this->assign('bxxsls',$bxxsls);
		
		//q特殊
		
		$stt=M('stt');//因为你站点可能木有了，但是站点已经招的财务阔能还在，因此要保留站点
		if($athofnstt['aths']==1){
			$sttls=$stt->select();
		}else{
			$sttls=$stt->where('sttid='.$usro['f_usr_sttid'])->select();
		}
		$this->assign('sttls',$sttls);
		
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
		//q特殊
		$grd=M('grd');
		$grdls=$grd->order('grdnm DESC')->select();
		$this->assign('grdls',$grdls);
		
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
		array_push($clsls, array('clsid'=>0,'clsnm'=>'未分班'));
		$this->assign('clsls',$clsls);

		
		//q特殊
		$xn=M('xn');
		$xnls=$xn->where('xnnm>='.$grdo['grdnm'])->order('xnid DESC')->select();
		$this->assign('xnls',$xnls);
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
		$statls=$stat->select();
		$this->assign('statls',$statls);
		
		//用于生成xls
		$this->assign('grdnm',$grdo['grdnm']);
		
		//q特殊
		$this->assign('title','浏览财务列表');
		$this->assign('theme','财务管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$cwid=$_POST['cwid'];
		$grdid=$_POST['f_std_grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		
		$cw=M($grdo['grdnm'].'_cw');
		
		if($cwid==0){
			

		}else{
			
			
			//先截获数据//财务基本部分
			$data=array(
					'cwyjxfsm'=>$_POST['cwyjxfsm'],
					'cwyjjckwfsm'=>$_POST['cwyjjckwfsm'],
					'cwyjzsfsm'=>$_POST['cwyjzsfsm'],
					'cwsjxfsm'=>$_POST['cwsjxfsm'],
					'cwsjjckwfsm'=>$_POST['cwsjjckwfsm'],
					'cwsjzsfsm'=>$_POST['cwsjzsfsm'],
					
			);
			
				
			
			if($cw->where('cwid='.$cwid)->setField($data)){
				
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
		$stdxqcls=M($grdo['grdnm'].'_stdxqcls');	
		$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
		$std=M($grdo['grdnm'].'_std');
		if($std->delete($_POST['stdid'])){
			$stdxqcls->where('f_stdxqcls_stdid='.$_POST['stdid'])->delete();
			$stdxqmj->where('f_stdxqmj_stdid='.$_POST['stdid'])->delete();
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($std->getLastSql());
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
		
		//学年要保证比学期大
		$xn=M('xn');
		$xnls=$xn->where('xnnm>='.$grdo['grdnm'])->order('xnid DESC')->select();
		$xnoptu='';
		foreach($xnls as $v){
			$xnoptu=$xnoptu."<option value='".$v['xnid']."'>".$v['xnnm']."</option>";
		}
		$data['xnoptu']=$xnoptu;
		//连带学年的变化影响到了学期的取值
		$xnid=$xnls[0]['xnid'];
		$sttid=$_POST['f_std_sttid'];//p($xnid);p($sttid);die;
		import('@.XQ.XQAction');
		$xqw = new XQAction();//外来的学期
		$xqid=$xqw->getcwxqid($grdid, $xnid, $sttid);
		$data['xqid']=$xqid;
		
		
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
							if($stdo){//有财务
								$xhzjdtx=(int)substr($stdo['stdno'], -2);//学号最近的同学
								$xhzjdtx=$xhzjdtx+1;
								$data['stdno']=$clso['clsxhprx'].$xhzjdtx;
							}else{//之前木有财务的话捏
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
	
	
	function createXq(){
		$grdid=$_POST['f_std_grdid'];
		$xnid=$_POST['f_cw_xnid'];
		$sttid=$_POST['f_std_sttid'];
	
		import('@.XQ.XQAction');
		$xqw = new XQAction();//外来的学期
		$xqid=$xqw->getcwxqid($grdid, $xnid, $sttid);
	
		$data['xqid']=$xqid;
		
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	
}



?>