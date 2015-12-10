<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class TsqkAction extends Action{
	
	
	
	function gtxpg(){
		

		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$usross=$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Std'")->find();
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
			$xqid=$_GET['xqid'];
			$stdid=$_GET['stdid'];;
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$std=M($grdo['grdnm'].'_std')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
			$mo=$std
			->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')
			->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')
			->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')
			->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')
			->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND stdid=".$stdid)->find();
			
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
			
			$this->assign('mo',$mo);
			
			
			
			//搞推荐人
			if($mo['stdrcmdnm']||$mo['stdrcmdcp']){
				$this->assign('ifrcmd','是');
			}else{
				$this->assign('ifrcmd','否');
			}
			
			//所有的注册信息，哪个学期哪个班哪个专业
			//应该具备哪些注册信息
			//学期
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqls=$xqw->getxqls($grdid, $mo['f_std_sttid'], 'ASC');//年级确定开始，学制确定过程
			$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
			$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
			$stdxqdm=M($grdo['grdnm'].'_stdxqdm');
			for($i=0;$i<count($xqls);$i++){
				$xqid=$xqls[$i]['xqid'];
				
				if($stdxqcls->where('f_stdxqcls_stdid='.$stdid.' AND f_stdxqcls_xqid='.$xqid)->find()&&$stdxqmj->where('f_stdxqmj_stdid='.$stdid.' AND f_stdxqmj_xqid='.$xqid)->find()){
					$xqls[$i]['zcf']='active';//注册否？
					$xqls[$i]['zczt']='已注册';
				}else{
					$xqls[$i]['zcf']='disabled';
					$xqls[$i]['zczt']='未注册';
				}
				$stdxqclso=$stdxqcls->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->where('f_stdxqcls_stdid='.$stdid.' AND f_stdxqcls_xqid='.$xqid)->find();
				$stdxqmjo=$stdxqmj->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->where('f_stdxqmj_stdid='.$stdid.' AND f_stdxqmj_xqid='.$xqid)->find();
				$stdxqdmo=$stdxqdm->join('tb_dm ON f_stdxqdm_dmid=dmid')->where('f_stdxqdm_stdid='.$stdid.' AND f_stdxqdm_xqid='.$xqid)->find();
				$xqls[$i]['clsnm']=$stdxqclso['clsnm'];
				$xqls[$i]['mjnm']=$stdxqmjo['mjnm'];
				$xqls[$i]['dmnm']=$stdxqdmo['dmnm'];
			}
			$this->assign('zcls',$xqls);//注册列表
			
			//特殊情况
			$tsqk=M($grdo['grdnm'].'_tsqk');
			$tsqkls=$tsqk->where('f_tsqk_stdid='.$stdid)->order('tsqktm DESC')->select();
			$tsqklsnw=array();
			foreach ($tsqkls as $tsqkv) {

				if($tsqkv['tsqknr']==1){
					$tsqkv['tsqknr']='换状态';
					$stat=M('stat');
					//原状态
					$stato=$stat->where('statid='.$tsqkv['tsqkorgid'])->find();
					$tsqkv['tsqkorgid']=$stato['statnm'];
					//现状态
					$stato=$stat->where('statid='.$tsqkv['tsqknwid'])->find();
					$tsqkv['tsqknwid']=$stato['statnm'];
				}else if($tsqkv['tsqknr']==2){
					$tsqkv['tsqknr']='换专业';
					$mj=M($grdo['grdnm'].'_mj');
					//原专业
					$mjo=$mj->where('mjid='.$tsqkv['tsqkorgid'])->find();
					$tsqkv['tsqkorgid']=$stato['mjnm'];
					//现专业
					$mjo=$mj->where('mjid='.$tsqkv['tsqknwid'])->find();
					$tsqkv['tsqknwid']=$stato['mjnm'];
				}else if($tsqkv['tsqknr']==3){
					$tsqkv['tsqknr']='换班级';
					$cls=M($grdo['grdnm'].'_cls');
					//原班级
					$clso=$cls->where('clsid='.$tsqkv['tsqkorgid'])->find();
					$tsqkv['tsqkorgid']=$stato['clsnm'];
					//现班级
					$clso=$cls->where('clsid='.$tsqkv['tsqknwid'])->find();
					$tsqkv['tsqknwid']=$stato['clsnm'];
				}else if($tsqkv['tsqknr']==4){
					$tsqkv['tsqknr']='换寝室';
					$dm=M('dm');
					//原状态
					$dmo=$dm->where('dmid='.$tsqkv['tsqkorgid'])->find();
					$tsqkv['tsqkorgid']=$dmo['dmnm'];
					//现状态
					$dmo=$dm->where('dmid='.$tsqkv['tsqknwid'])->find();
					$tsqkv['tsqknwid']=$dmo['dmnm'];
				}
				array_push($tsqklsnw, $tsqkv);
			}
			$this->assign('tsqkls',$tsqklsnw);
			
			
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){

			$grdid=$_GET['grdid'];
			$xqid=$_GET['xqid'];
			$stdid=$_GET['stdid'];;
			
			
				
			$usr=M('usr');
			$usro=$usr->where('usrid='.session('usridss'))->find();
			//鉴权对用户对stt的权限，若为设置权限，说明是教务的人，可以全管，否则只能管自己函授站的 ntf为不用this assign的
			$mdII=M('md');
			$mdo=$mdII->where("mdmk='Stt'")->find();
			import('@.IDTATH.IdtathAction');
			$Idtath = new IdtathAction();
			$athofnstt=$Idtath->identify($mdo['mdid'],'ntf');
			
			if($stdid==0){
				$mo['stdid']=0;
				
				$mo['stdsol']='无';
				
				$mo['stdpt']=C('PUBLIC').'/IMG/default.jpg';
				//第几学年 第几学期的班级 第几学年 第几学期的专业 ...
				//因为grd无法定下来，所以stdxqcls stdxqmj_xqid 定下来也没有意义，干脆就不定了，等搜索时候自由分晓
				
				//默认年级是当前年级
				$grd=M('grd');
				$grdo=$grd->order('grdnm DESC')->find();
				$grdid=$grdo['grdid'];
				$mo['f_std_grdid']=$grdid;
				$mo['grdnm']=$grdo['grdnm'];
				
				//默认站点，有主的找有主的，没主的找本部
				if($athofnstt['aths']!=1){
					$mo['f_std_sttid']=$usro['f_usr_sttid'];
				}else{
					$mo['f_std_sttid']=1;
				}
				
				//默认学期 为XX年级XX站点的起始学期
				$sttintxq=M($grdo['grdnm'].'_sttintxq');
				$sttintxqo=$sttintxq->where('f_sttintxq_grdid='.$grdo['grdid'].' AND f_sttintxq_sttid='.$mo['f_std_sttid'])->find();
				$xqid=$sttintxqo['f_sttintxq_xqid'];
				$mo['f_stdxqcls_xqid']=$xqid;
				$mo['f_stdxqmj_xqid']=$xqid;
				
				
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
				
				
				//q特殊
				$xq=M('xq');
				$xqls=$xq->where('xqid='.$xqid)->select();//我TMD就为了一个置顶的xq来了
				$this->assign('xqls',$xqls);
				
				$where='1=1';
				if($athofnstt['aths']!=1){
					$where=$where.' AND f_cls_sttid='.$usro['f_usr_sttid'];
				}
				//之前已经确定过到底是看哪个年级
				$where=$where.' AND f_cls_grdid='.$grdid;
				$cls=M($grdo['grdnm'].'_cls');
				$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where($where)->order('clsnm ASC')->select();
				$this->assign('clsls',$clsls);
					
					
				$where='1=1';
				if($athofnstt['aths']!=1){
					$where=$where." AND mjsttu LIKE '%-".$usro['f_usr_sttid']."-%'";
				}
				//之前已经确定过到底是看哪个年级
				$where=$where.' AND f_mj_grdid='.$grdid;
				$mj=M($grdo['grdnm'].'_mj');
				$mjls=$mj->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->where($where)->order('f_mj_bxxsid ASC,mjdm ASC')->select();
				$mjlsnw=array();
				foreach($mjls as $v){
					//给专业多点修饰
					if(preg_match('/技能/',$v['bxxsnm'])){
						$v['bxxsnmst']='技能';
					}else if(preg_match('/自考/',$v['bxxsnm'])){
						$v['bxxsnmst']='自考';
					}else{
						$v['bxxsnmst']='普通';
					}
					array_push($mjlsnw, $v);
				}
				$this->assign('mjls',$mjlsnw);
				
			}else{
				
				$grd=M('grd');
				$grdo=$grd->where('grdid='.$grdid)->find();
				
				$std=M($grdo['grdnm'].'_std')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
				
				$mo=$std
				->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')
				->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')
				->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')
				->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')
				->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND stdid=".$stdid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
				
				
				//q特殊
				import('@.XQ.XQAction');
				$xqw = new XQAction();//外来的学期
				$xqls=$xqw->getxqls($grdo['grdid'], $mo['f_std_sttid'], 'DESC');
				$this->assign('xqls',$xqls);
				
				$where='1=1';
				$where=$where.' AND f_cls_sttid='.$mo['f_std_sttid'];
				//之前已经确定过到底是看哪个年级
				$where=$where.' AND f_cls_grdid='.$grdid;
				$cls=M($grdo['grdnm'].'_cls');
				$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where($where)->order('clsnm ASC')->select();
				$this->assign('clsls',$clsls);
					
					
				$where='1=1';
				$where=$where." AND mjsttu LIKE '%-".$mo['f_std_sttid']."-%' AND f_mj_bxxsid=".$mo['f_mj_bxxsid'];
				//之前已经确定过到底是看哪个年级
				$where=$where.' AND f_mj_grdid='.$grdid;
				$mj=M($grdo['grdnm'].'_mj');
				$mjls=$mj->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->where($where)->order('f_mj_bxxsid ASC,mjdm ASC')->select();
				$mjlsnw=array();
				foreach($mjls as $v){
					//给专业多点修饰
					if(preg_match('/技能/',$v['bxxsnm'])){
						$v['bxxsnmst']='技能';
					}else if(preg_match('/自考/',$v['bxxsnm'])){
						$v['bxxsnmst']='自考';
					}else{
						$v['bxxsnmst']='普通';
					}
					array_push($mjlsnw, $v);
				}
				$this->assign('mjls',$mjlsnw);
				
				//所有的注册信息，哪个学期哪个班哪个专业
				//应该具备哪些注册信息
				//学期
				import('@.XQ.XQAction');
				$xqw = new XQAction();//外来的学期
				$xqls=$xqw->getxqls($grdid, $mo['f_std_sttid'], 'ASC');//年级确定开始，学制确定过程
				$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
				$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
				$stdxqdm=M($grdo['grdnm'].'_stdxqdm');
				for($i=0;$i<count($xqls);$i++){
					$xqid=$xqls[$i]['xqid'];
					if($stdxqcls->where('f_stdxqcls_stdid='.$stdid.' AND f_stdxqcls_xqid='.$xqid)->find()&&$stdxqmj->where('f_stdxqmj_stdid='.$stdid.' AND f_stdxqmj_xqid='.$xqid)->find()){
						$xqls[$i]['zcf']='active';//注册否？
						$xqls[$i]['zczt']='已注册';
					}else{
						$xqls[$i]['zcf']='disabled';
						$xqls[$i]['zczt']='未注册';
					}
					$stdxqclso=$stdxqcls->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->where('f_stdxqcls_stdid='.$stdid.' AND f_stdxqcls_xqid='.$xqid)->find();
					$stdxqmjo=$stdxqmj->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->where('f_stdxqmj_stdid='.$stdid.' AND f_stdxqmj_xqid='.$xqid)->find();
					$stdxqdmo=$stdxqdm->join('tb_dm ON f_stdxqdm_dmid=dmid')->where('f_stdxqdm_stdid='.$stdid.' AND f_stdxqdm_xqid='.$xqid)->find();
					$xqls[$i]['clsnm']=$stdxqclso['clsnm'];
					$xqls[$i]['mjnm']=$stdxqmjo['mjnm'];
					$xqls[$i]['dmnm']=$stdxqdmo['dmnm'];
				}
				$this->assign('zcls',$xqls);//注册列表
				
				//特殊情况
				$tsqk=M($grdo['grdnm'].'_tsqk');
				$tsqkls=$tsqk->where('f_tsqk_stdid='.$stdid)->order('tsqktm DESC')->select();
				$tsqklsnw=array();
				foreach ($tsqkls as $tsqkv) {

					if($tsqkv['tsqknr']==1){
						$tsqkv['tsqknr']='换状态';
						$stat=M('stat');
						//原状态
						$stato=$stat->where('statid='.$tsqkv['tsqkorgid'])->find();
						$tsqkv['tsqkorgid']=$stato['statnm'];
						//现状态
						$stato=$stat->where('statid='.$tsqkv['tsqknwid'])->find();
						$tsqkv['tsqknwid']=$stato['statnm'];
					}else if($tsqkv['tsqknr']==2){
						$tsqkv['tsqknr']='换专业';
						$mj=M($grdo['grdnm'].'_mj');
						//原专业
						$mjo=$mj->where('mjid='.$tsqkv['tsqkorgid'])->find();
						$tsqkv['tsqkorgid']=$stato['mjnm'];
						//现专业
						$mjo=$mj->where('mjid='.$tsqkv['tsqknwid'])->find();
						$tsqkv['tsqknwid']=$stato['mjnm'];
					}else if($tsqkv['tsqknr']==3){
						$tsqkv['tsqknr']='换班级';
						$cls=M($grdo['grdnm'].'_cls');
						//原班级
						$clso=$cls->where('clsid='.$tsqkv['tsqkorgid'])->find();
						$tsqkv['tsqkorgid']=$stato['clsnm'];
						//现班级
						$clso=$cls->where('clsid='.$tsqkv['tsqknwid'])->find();
						$tsqkv['tsqknwid']=$stato['clsnm'];
					}else if($tsqkv['tsqknr']==4){
						$tsqkv['tsqknr']='换寝室';
						$dm=M('dm');
						//原状态
						$dmo=$dm->where('dmid='.$tsqkv['tsqkorgid'])->find();
						$tsqkv['tsqkorgid']=$dmo['dmnm'];
						//现状态
						$dmo=$dm->where('dmid='.$tsqkv['tsqknwid'])->find();
						$tsqkv['tsqknwid']=$dmo['dmnm'];
					}
					array_push($tsqklsnw, $tsqkv);
				}
				$this->assign('tsqkls',$tsqklsnw);
			}
			
			
// 			//搞学生照片
// 			if(file_exists('./Uploads/std/'.$grdo['grdnm'].'/'.$mo['f_std_sttid'].'/'.$mo['stdno'].'.jpg')){
// 				$mo['stdpt']=__ROOT__.'/Uploads/std/'.$grdo['grdnm'].'/'.$mo['f_std_sttid'].'/'.$mo['stdno'].'.jpg';
// 			}else{
// 				$mo['stdpt']=C('PUBLIC').'/IMG/default.jpg';
// 			}
			
			$this->assign('mo',$mo);
			
			
			//q特殊
			$bxxs=M('bxxs');
			$bxxsls=$bxxs->select();
			$this->assign('bxxsls',$bxxsls);
			
			//q特殊
			$where='1=1';
			if($athofnstt['aths']!=1){
				$where=$where.' AND sttid='.$usro['f_usr_sttid'];
			}
			$stt=M('stt');
			$sttls=$stt->where($where)->select();
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
			$stat=M('stat');
			$statls=$stat->where("statactvt=1 AND statmk='jw'")->select();
			$this->assign('statls',$statls);
			
			
			//搞介绍人
			if($mo['stdrcmdnm']||$mo['stdrcmdcp']){
				$this->assign('ifrcmd','是');
				$this->assign('rcmdcls','');
			}else{
				$this->assign('ifrcmd','否');
				$this->assign('rcmdcls','readonly');
			}
			
			$this->display('update');
		}else if($x=='mdf'){

			$grdid=$_GET['grdid'];
			$xqid=$_GET['xqid'];
			$stdid=$_GET['stdid'];;
			
			
				
			$usr=M('usr');
			$usro=$usr->where('usrid='.session('usridss'))->find();
			//鉴权对用户对stt的权限，若为设置权限，说明是教务的人，可以全管，否则只能管自己函授站的 ntf为不用this assign的
			$mdII=M('md');
			$mdo=$mdII->where("mdmk='Stt'")->find();
			import('@.IDTATH.IdtathAction');
			$Idtath = new IdtathAction();
			$athofnstt=$Idtath->identify($mdo['mdid'],'ntf');
			
			
				
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			
			$std=M($grdo['grdnm'].'_std')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
			
			$mo=$std
			->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')
			->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')
			->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')
			->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')
			->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND stdid=".$stdid)->find();
			$this->assign('title','修改');
			$this->assign('theme','修改：');
			$this->assign('btnvl','修改');
			
			
			//q特殊
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqls=$xqw->getxqls($grdo['grdid'], $mo['f_std_sttid'], 'DESC');
			$this->assign('xqls',$xqls);
			
			$where='1=1';
			$where=$where.' AND f_cls_sttid='.$mo['f_std_sttid'];
			//之前已经确定过到底是看哪个年级
			$where=$where.' AND f_cls_grdid='.$grdid;
			$cls=M($grdo['grdnm'].'_cls');
			$clsls=$cls->join('tb_stt ON f_cls_sttid=sttid')->where($where)->order('clsnm ASC')->select();
			$this->assign('clsls',$clsls);
				
				
			$where='1=1';
			$where=$where." AND mjsttu LIKE '%-".$mo['f_std_sttid']."-%' AND f_mj_bxxsid=".$mo['f_mj_bxxsid'];
			//之前已经确定过到底是看哪个年级
			$where=$where.' AND f_mj_grdid='.$grdid;
			$mj=M($grdo['grdnm'].'_mj');
			$mjls=$mj->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->where($where)->order('f_mj_bxxsid ASC,mjdm ASC')->select();
			$mjlsnw=array();
			foreach($mjls as $v){
				//给专业多点修饰
				if(preg_match('/技能/',$v['bxxsnm'])){
					$v['bxxsnmst']='技能';
				}else if(preg_match('/自考/',$v['bxxsnm'])){
					$v['bxxsnmst']='自考';
				}else{
					$v['bxxsnmst']='普通';
				}
				array_push($mjlsnw, $v);
			}
			$this->assign('mjls',$mjlsnw);
			
			//所有的注册信息，哪个学期哪个班哪个专业
			//应该具备哪些注册信息
			//学期
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			$xqls=$xqw->getxqls($grdid, $mo['f_std_sttid'], 'ASC');//年级确定开始，学制确定过程
			$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
			$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
			$stdxqdm=M($grdo['grdnm'].'_stdxqdm');
			for($i=0;$i<count($xqls);$i++){
				$xqid=$xqls[$i]['xqid'];
				if($stdxqcls->where('f_stdxqcls_stdid='.$stdid.' AND f_stdxqcls_xqid='.$xqid)->find()&&$stdxqmj->where('f_stdxqmj_stdid='.$stdid.' AND f_stdxqmj_xqid='.$xqid)->find()){
					$xqls[$i]['zcf']='active';//注册否？
					$xqls[$i]['zczt']='已注册';
				}else{
					$xqls[$i]['zcf']='disabled';
					$xqls[$i]['zczt']='未注册';
				}
				$stdxqclso=$stdxqcls->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->where('f_stdxqcls_stdid='.$stdid.' AND f_stdxqcls_xqid='.$xqid)->find();
				$stdxqmjo=$stdxqmj->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->where('f_stdxqmj_stdid='.$stdid.' AND f_stdxqmj_xqid='.$xqid)->find();
				$stdxqdmo=$stdxqdm->join('tb_dm ON f_stdxqdm_dmid=dmid')->where('f_stdxqdm_stdid='.$stdid.' AND f_stdxqdm_xqid='.$xqid)->find();
				$xqls[$i]['clsnm']=$stdxqclso['clsnm'];
				$xqls[$i]['mjnm']=$stdxqmjo['mjnm'];
				$xqls[$i]['dmnm']=$stdxqdmo['dmnm'];
			}
			$this->assign('zcls',$xqls);//注册列表
			
			//特殊情况
			$tsqk=M($grdo['grdnm'].'_tsqk');
			$tsqkls=$tsqk->where('f_tsqk_stdid='.$stdid)->order('tsqktm DESC')->select();
			$tsqklsnw=array();
			foreach ($tsqkls as $tsqkv) {

				if($tsqkv['tsqknr']==1){
					$tsqkv['tsqknr']='换状态';
					$stat=M('stat');
					//原状态
					$stato=$stat->where('statid='.$tsqkv['tsqkorgid'])->find();
					$tsqkv['tsqkorgid']=$stato['statnm'];
					//现状态
					$stato=$stat->where('statid='.$tsqkv['tsqknwid'])->find();
					$tsqkv['tsqknwid']=$stato['statnm'];
				}else if($tsqkv['tsqknr']==2){
					$tsqkv['tsqknr']='换专业';
					$mj=M($grdo['grdnm'].'_mj');
					//原专业
					$mjo=$mj->where('mjid='.$tsqkv['tsqkorgid'])->find();
					$tsqkv['tsqkorgid']=$stato['mjnm'];
					//现专业
					$mjo=$mj->where('mjid='.$tsqkv['tsqknwid'])->find();
					$tsqkv['tsqknwid']=$stato['mjnm'];
				}else if($tsqkv['tsqknr']==3){
					$tsqkv['tsqknr']='换班级';
					$cls=M($grdo['grdnm'].'_cls');
					//原班级
					$clso=$cls->where('clsid='.$tsqkv['tsqkorgid'])->find();
					$tsqkv['tsqkorgid']=$stato['clsnm'];
					//现班级
					$clso=$cls->where('clsid='.$tsqkv['tsqknwid'])->find();
					$tsqkv['tsqknwid']=$stato['clsnm'];
				}else if($tsqkv['tsqknr']==4){
					$tsqkv['tsqknr']='换寝室';
					$dm=M('dm');
					//原状态
					$dmo=$dm->where('dmid='.$tsqkv['tsqkorgid'])->find();
					$tsqkv['tsqkorgid']=$dmo['dmnm'];
					//现状态
					$dmo=$dm->where('dmid='.$tsqkv['tsqknwid'])->find();
					$tsqkv['tsqknwid']=$dmo['dmnm'];
				}
				array_push($tsqklsnw, $tsqkv);
			}
			$this->assign('tsqkls',$tsqklsnw);
			
			
			
// 			//搞学生照片
// 			if(file_exists('./Uploads/std/'.$grdo['grdnm'].'/'.$mo['f_std_sttid'].'/'.$mo['stdno'].'.jpg')){
// 				$mo['stdpt']=__ROOT__.'/Uploads/std/'.$grdo['grdnm'].'/'.$mo['f_std_sttid'].'/'.$mo['stdno'].'.jpg';
// 			}else{
// 				$mo['stdpt']=C('PUBLIC').'/IMG/default.jpg';
// 			}
			
			$this->assign('mo',$mo);
			
			
			//q特殊
			$bxxs=M('bxxs');
			$bxxsls=$bxxs->select();
			$this->assign('bxxsls',$bxxsls);
			
			//q特殊
			$where='1=1';
			if($athofnstt['aths']!=1){
				$where=$where.' AND sttid='.$usro['f_usr_sttid'];
			}
			$stt=M('stt');
			$sttls=$stt->where($where)->select();
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
			$stat=M('stat');
			$statls=$stat->where("statactvt=1 AND statmk='jw'")->select();
			$this->assign('statls',$statls);
			
			
			//搞介绍人
			if($mo['stdrcmdnm']||$mo['stdrcmdcp']){
				$this->assign('ifrcmd','是');
				$this->assign('rcmdcls','');
			}else{
				$this->assign('ifrcmd','否');
				$this->assign('rcmdcls','readonly');
			}
			
			$this->display('update');
		}else if($x='stddtfx'){
			$xq=M('xq');
			$xqodq=$xq->where('xqdq=1')->find();
			$xqiddq=$xqodq['xqid'];
			$sttid=1;
			$bxxs=M('bxxs');
			$bxxsls=$bxxs->select();
			$dm=M('dm');
			$dmls=$dm->select();
			//先分开算再合起来
			$grd=M('grd');
			$grdls=$grd->order('grdnm DESC')->select();
			$grdlsfn=array();
			foreach ($grdls as $grdv){
				$zl=array();//资料
				
				
				$cls=M($grdv['grdnm'].'_cls');
				$clsls=$cls->where('clsactvt=1 AND f_cls_sttid='.$sttid)->order('clsnm ASC')->select();
				$mj=M($grdv['grdnm'].'_mj');
				$mjls=$mj->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->where("mjsttu LIKE '%-".$sttid."-%'")->order('bxxsid ASC,mjnm ASC')->select();
				
				$std=M($grdv['grdnm'].'_std');
				if($std->where('f_std_statid=5')->count()==0){
					continue;
				}
				$zongnb=$std->where('f_std_statid=5')->count();$zl['zongnb']=$zongnb;
				$bynb=$std->where('f_std_statid=5 AND f_std_sexid=1')->count();$zl['bynb']=$bynb;
				$glnb=$std->where('f_std_statid=5 AND f_std_sexid=2')->count();$zl['glnb']=$glnb;
				//查看办学形式
				$bxxsarr=array();
				foreach ($bxxsls as $bxxsv){
					$bxxscnt=$std->join('inner join tb_'.$grdv['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdv['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid')->join('tb_'.$grdv['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->where("f_stdxqcls_xqid=".$xqiddq." AND f_stdxqmj_xqid=".$xqiddq.' AND f_mj_bxxsid='.$bxxsv['bxxsid'].' AND f_std_statid=5')->count();
					if($bxxscnt==0){
						continue;
					}
					$bxxsv['bxxscnt']=$bxxscnt;
					array_push($bxxsarr, $bxxsv);
				}
				$zl['bxxs']=$bxxsarr;
				//查看住宿
				$dmarr=array();
				foreach ($dmls as $dmv){
					$dmcnt=$std->join('inner join tb_'.$grdv['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->where("f_stdxqdm_xqid=".$xqiddq.' AND f_stdxqdm_dmid='.$dmv['dmid'].' AND f_std_statid=5')->count();
					if($dmcnt==0){
						continue;
					}
					$dmv['dmcnt']=$dmcnt;
					array_push($dmarr, $dmv);
				}
				$zl['dm']=$dmarr;
				//查看港澳台西藏
				$hknb=$std->where("stdnp LIKE '%香港%' AND f_std_statid=5")->count();$zl['hknb']=$hknb;
				$mcnb=$std->where("stdnp LIKE '%澳门%' AND f_std_statid=5")->count();$zl['mcnb']=$mcnb;
				$twnb=$std->where("stdnp LIKE '%台湾%' AND f_std_statid=5")->count();$zl['twnb']=$twnb;
				$tbnb=$std->where("stdnp LIKE '%西藏%' AND f_std_statid=5")->count();$zl['tbnb']=$tbnb;
				$otnb=$std->where("stdnp NOT LIKE '%香港%' AND stdnp NOT LIKE '%澳门%' AND stdnp NOT LIKE '%台湾%' AND stdnp NOT LIKE '%西藏%' AND f_std_statid=5")->count();$zl['otnb']=$otnb;
				//查看班级
				$clsarr=array();
				foreach ($clsls as $clsv){
					$clscnt=$std->join('inner join tb_'.$grdv['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdv['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid')->join('tb_'.$grdv['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->where("f_stdxqcls_xqid=".$xqiddq." AND f_stdxqmj_xqid=".$xqiddq.' AND f_stdxqcls_clsid='.$clsv['clsid'].' AND f_std_statid=5')->count();
					if($clscnt==0){
						continue;
					}
					$clsv['clscnt']=$clscnt;
					array_push($clsarr, $clsv);
				}
				$zl['cls']=$clsarr;
				//查看专业
				$mjarr=array();
				foreach ($mjls as $mjv){
					$mjcnt=$std->join('inner join tb_'.$grdv['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdv['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid')->join('tb_'.$grdv['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->where("f_stdxqcls_xqid=".$xqiddq." AND f_stdxqmj_xqid=".$xqiddq.' AND f_stdxqmj_mjid='.$mjv['mjid'].' AND f_std_statid=5')->count();
					if($mjcnt==0){
						continue;
					}
					$mjv['clscnt']=$mjcnt;
					array_push($mjarr, $mjv);
				}
				$zl['mj']=$mjarr;
				$grdv['zl']=$zl;
				array_push($grdlsfn, $grdv);
			}
			$this->assign('grdls',$grdlsfn);
			
			$this->assign('title','学生数据分析');
			$this->assign('theme','学生数据分析详细');
			$this->display('stddtfx');
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
		$mdo=$mdII->where("mdmk='Tsqk'")->find();
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
		if(preg_match('/f_tsqk_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_tsqk_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
		}else{
			//默认grdid
			$grdo=$grd->order('grdid DESC')->find();
			$grdid=$grdo['grdid'];
		}
		$grdo=$grd->where('grdid='.$grdid)->find();
		$tsqk=M($grdo['grdnm'].'_tsqk');
// 		$stdls=$std->select();

		$fldint='-tsqkid-sttnm-f_tsqk_grdid-grdnm-stdno-stdnm-tsqktm-tsqknr-tsqkorgid-tsqknwid-tsqkjbr-';
		//$cdtint="-sp-f_std_ccid-eq-3-sp-f_std_xxxsid-eq-2-sp-f_std_zsfwid-eq-2-sp-f_std_xzid-eq-2-sp-f_std_sttid-eq-1-sp-f_std_statid-eq-5-sp-";
		
		
		
		if($athofnstt['aths']==1){
			$f_usr_sttid=1;
			// ①如果激活的学期在初始学期后范围内的那么就选激活的学期②如果...在范围外的话呢就选择第初始学期为默认学期
			$cdtint="-sp-f_tsqk_grdid-eq-".$grdid."-sp-f_std_sttid-eq-".$f_usr_sttid."-sp-";
			//接下来产生学期
			
		}else{
			$f_usr_sttid=$usro['f_usr_sttid'];
			// ①如果激活的学期在初始学期后范围内的那么就选激活的学期②如果...在范围外的话呢就选择第初始学期为默认学期
			$cdtint="-sp-f_tsqk_grdid-eq-".$grdid."-sp-f_std_sttid-eq-".$f_usr_sttid."-sp-";
			//接下来产生学期
		}
		$spccdtint='-sp-';////
		$odrint='-tsqktm DESC-';
		$lmtint=20;
		$jn='tb_'.$grdo['grdnm'].'_std ON f_tsqk_stdid=stdid-jn-tb_stt ON f_std_sttid=sttid-jn-tb_grd ON f_std_grdid=grdid-jn-tb_sex ON f_std_sexid=sexid-jn-tb_rc ON f_std_rcid=rcid-jn-tb_zzmm ON f_std_zzmmid=zzmmid-jn-tb_xl ON f_std_xlid=xlid-jn-tb_stat ON f_std_statid=statid';
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($tsqk,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		
		//判断std所在的班级，当前人员能否修改。。。其实就是看他是教务的还是管理员还是他亲生班主任
		$mls=$arr['mls'];
		$bzr=M($grdo['grdnm'].'_bzr');
		$mlsfn=array();
		foreach($mls as $mv){
			//处理异动
			if($mv['tsqknr']==1){
				$mv['tsqknr']='换状态';
				$stat=M('stat');
				//原状态
				$stato=$stat->where('statid='.$mv['tsqkorgid'])->find();
				$mv['tsqkorgid']=$stato['statnm'];
				//现状态
				$stato=$stat->where('statid='.$mv['tsqknwid'])->find();
				$mv['tsqknwid']=$stato['statnm'];
			}else if($mv['tsqknr']==2){
				$mv['tsqknr']='换专业';
				$mj=M($grdo['grdnm'].'_mj');
				//原专业
				$mjo=$mj->where('mjid='.$mv['tsqkorgid'])->find();
				$mv['tsqkorgid']=$stato['mjnm'];
				//现专业
				$mjo=$mj->where('mjid='.$mv['tsqknwid'])->find();
				$mv['tsqknwid']=$stato['mjnm'];
			}else if($mv['tsqknr']==3){
				$mv['tsqknr']='换班级';
				$cls=M($grdo['grdnm'].'_cls');
				//原班级
				$clso=$cls->where('clsid='.$mv['tsqkorgid'])->find();
				$mv['tsqkorgid']=$stato['clsnm'];
				//现班级
				$clso=$cls->where('clsid='.$mv['tsqknwid'])->find();
				$mv['tsqknwid']=$stato['clsnm'];
			}else if($mv['tsqknr']==4){
				$mv['tsqknr']='换寝室';
				$dm=M('dm');
				//原状态
				$dmo=$dm->where('dmid='.$mv['tsqkorgid'])->find();
				$mv['tsqkorgid']=$dmo['dmnm'];
				//现状态
				$dmo=$dm->where('dmid='.$mv['tsqknwid'])->find();
				$mv['tsqknwid']=$dmo['dmnm'];
			}
			//设置该生最近的mj
			$stdxqmj=M($grdo['grdnm'].'_stdxqmj');
			$stdxqmjo=$stdxqmj->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->where('f_stdxqmj_stdid='.$mv['f_tsqk_stdid'])->order('f_stdxqmj_xqid DESC')->find();
			$mv['mjnm']=$stdxqmjo['mjnm'];
			//设置该生最近的cls
			$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
			$stdxqclso=$stdxqcls->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->where('f_stdxqcls_stdid='.$mv['f_tsqk_stdid'])->order('f_stdxqcls_xqid DESC')->find();
			$mv['clsnm']=$stdxqclso['clsnm'];
			//设置该生最近的dm
			$stdxqdm=M($grdo['grdnm'].'_stdxqdm');
			$stdxqdmo=$stdxqdm->join('tb_'.'dm ON f_stdxqdm_dmid=dmid')->where('f_stdxqdm_stdid='.$mv['f_tsqk_stdid'])->order('f_stdxqdm_xqid DESC')->find();
			$mv['dmnm']=$stdxqdmo['dmnm'];
			array_push($mlsfn, $mv);
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
		
		$stt=M('stt');//因为你站点可能木有了，但是站点已经招的学生阔能还在，因此要保留站点
		if($athofnstt['aths']==1){
			$sttls=$stt->select();
		}else{
			$sttls=$stt->where('sttid='.$usro['f_usr_sttid'])->select();
		}
		$this->assign('sttls',$sttls);
		
		
		$grd=M('grd');
		$grdls=$grd->order('grdnm DESC')->select();
		$this->assign('grdls',$grdls);
		
		
		//用于生成xls
		$this->assign('grdnm',$grdo['grdnm']);
		
		//q特殊
		$this->assign('title','学籍异动（特殊情况）列表');
		$this->assign('theme','学籍异动（特殊情况）管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");

		//获取经办人的信息
		$usr=M('usr');
		$usross=$usr->where('usrid='.session('usridss'))->find();
		

		$stdid=$_POST['stdid'];
		
		$xqid=$_POST['f_stdxqcls_xqid'];
		
	
		if($stdid==0){
			
			$f_mj_bxxsid=$_POST['f_mj_bxxsid'];
			$f_std_grdid=$_POST['f_std_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$f_std_grdid)->find();
			$std=M($grdo['grdnm'].'_std');
			$bxxs=M('bxxs');
			$bxxso=$bxxs->where('bxxsid='.$f_mj_bxxsid)->find();
			
			
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
					$xfo=$xf->where('f_xf_sttid='.$_POST['f_std_sttid'].' AND f_xf_bxxsid='.$mjo['f_mj_bxxsid'].' AND f_xf_ccid='.$mjo['f_mj_ccid'].' AND f_xf_klid='.$mjo['f_mj_klid'])->find();
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
					if($_POST['f_std_sttid']==1){
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
					}else{
						$dt=array(
								'f_cw_grdid'=>$grdo['grdid'],
								'f_cw_xnid'=>$xno['xnid'],
								'cwzcxqid'=>$xqid,
								'f_cw_stdid'=>$stdo['stdid'],
								'cwyjxfsm'=>$xfo['xfsm'],
								'cwyjjckwfsm'=>$xfo['jckwfsm'],
								'cwyjzsfsm'=>$zsfo['zsfsm'],
								'cwsjxfsm'=>0,
								'cwsjjckwfsm'=>0,
								'cwsjzsfsm'=>0,
						);
					}
					
					
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
								'tsqknr'=>3,
								'tsqkorgid'=>$stdxqclso['f_stdxqcls_clsid'],
								'tsqknwid'=>$_POST['f_stdxqcls_clsid'],
								'tsqkjbr'=>$usross['usrnn'],
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
									'tsqknr'=>2,
									'tsqkorgid'=>$stdxqmjo['f_stdxqmj_mjid'],
									'tsqknwid'=>$_POST['f_stdxqmj_mjid'],
									'tsqkjbr'=>$usross['usrnn'],
							);
							$tsqk->data($dt)->add();
							
							//比如本部的2014-15 2 学期 换专业，我们要换的是以第一学期为注册学期的费用，规律是如果减去起始是奇数那么就要把他前一个学期就是注册学期，比如2014-15 2和2014-15 1差1 所以用2014-15 1 作为注册学期获取学年
							//修改缴费信息1、学费教材考务费2、住宿费
							$mj=M($grdo['grdnm'].'_mj');
							$mjo=$mj->where('mjid='.$_POST['f_stdxqmj_mjid'])->find();
							$xf=M($grdo['grdnm'].'_xf');
							$xfo=$xf->where('f_xf_sttid='.$_POST['f_std_sttid'].' AND f_xf_bxxsid='.$mjo['f_mj_bxxsid'].' AND f_xf_ccid='.$mjo['f_mj_ccid'].' AND f_xf_klid='.$mjo['f_mj_klid'])->find();
							$zsf=M($grdo['grdnm'].'_zsf');
							$zsfo=$zsf->where('f_zsf_dmid='.$_POST['f_stdxqdm_dmid'])->find();
							$cw=M($grdo['grdnm'].'_cw');
							
							$sttintxq=M($grdo['grdnm'].'_sttintxq');
							$sttintxqo=$sttintxq->where('f_sttintxq_sttid='.$_POST['f_std_sttid'])->find();
							$xqidint=$sttintxqo['f_sttintxq_xqid'];
							
							if(($xqid-$xqidint)%2==1){$xqidzc=$xqid-1;}else{$xqidzc=$xqid;}
								
							//根据学期获得学年
							$xq=M('xq');
							$xqo=$xq->where('xqid='.$xqidzc)->find();
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
							if($_POST['f_std_sttid']==1&&$xqidint==$xqidzc){
								$dt=array(
								
										'cwyjxfsm'=>$xfo['xfsm']+100,//因为是第一个学期所以要加100的报名费
										'cwyjjckwfsm'=>$xfo['jckwfsm'],
										'cwyjzsfsm'=>$zsfo['zsfsm'],
								
								);
							}else{
								$dt=array(
								
										'cwyjxfsm'=>$xfo['xfsm'],
										'cwyjjckwfsm'=>$xfo['jckwfsm'],
										'cwyjzsfsm'=>$zsfo['zsfsm'],
								
								);
							}
							
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
							//改住宿算是特殊情况
							$dm=M($grdo['grdnm'].'_dm');
							$dmoorg=$dm->where('dmid='.$stdxqdmo['f_stdxqdm_dmid'])->find();
							$dmonw=$dm->where('dmid='.$_POST['f_stdxqdm_dmid'])->find();
							$tsqk=M($grdo['grdnm'].'_tsqk');
							$dt=array(
									'f_tsqk_grdid'=>$grdo['grdid'],
									'f_tsqk_stdid'=>$_POST['stdid'],
									'tsqktm'=>date("Y-m-d H:i:s",time()),
									'tsqknr'=>4,
									'tsqkorgid'=>$stdxqdmo['f_stdxqdm_dmid'],
									'tsqknwid'=>$_POST['f_stdxqdm_dmid'],
									'tsqkjbr'=>$usross['usrnn'],
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
								'tsqknr'=>1,
								'tsqkorgid'=>$stdoforstat['f_std_statid'],
								'tsqknwid'=>$_POST['f_std_statid'],
								'tsqkjbr'=>$usross['usrnn'],
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
		$cjzx=M($grdo['grdnm'].'_cjzx');
		$std=M($grdo['grdnm'].'_std');
		if($std->delete($_POST['stdid'])){
			$stdxqcls->where('f_stdxqcls_stdid='.$_POST['stdid'])->delete();
			$stdxqmj->where('f_stdxqmj_stdid='.$_POST['stdid'])->delete();
			$stdxqdm->where('f_stdxqdm_stdid='.$_POST['stdid'])->delete();
			$cw->where('f_cw_stdid='.$_POST['stdid'])->delete();
			$cjzx->where('f_cjzx_stdid='.$_POST['stdid'])->delete();
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($std->getLastSql());
		}
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
	
	function createAlways(){
		$grdid=$_POST['f_std_grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		
		
		$xq=M('xq');$xqodq=$xq->where('xqdq=1')->find();
		
		
		
	
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