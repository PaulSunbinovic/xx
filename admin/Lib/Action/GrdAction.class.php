<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class GrdAction extends Action{
	function gtxpg(){
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Grd'")->find();
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
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$mo=$grd->where("grdid=".$grdid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			if($grdid==0){
				$mo['grdid']=0;
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$grd->where("grdid=".$grdid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			$this->display('update');
		}
	
	
	}
	
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Grd'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$Idtath->identify($mdo['mdid'],'qry');
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		//NB初始化，开始
		$grd=M('grd');
		$fldint='-grdid-grdnm-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='-grdnm DESC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_grd ON f_grdid=grdid-jn-tb_atc ON f_grdid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($grd,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////

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
		
		
		
		
		//q特殊
		$this->assign('title','浏览微信列表');
		$this->assign('theme','年级管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$grdid=$_POST['grdid'];
		
		
		if($grdid==0){
			$grd=M('grd');
			//先截获数据
			$data=array(
				'grdnm'=>$_POST['grdnm'],
				
			);
				
			if($grd->data($data)->add()){
				$grdo=$grd->order('grdid DESC')->find();
				//首先要添加该年级对应的学期
				//先增加第1学期，再增加第2学期
				$xq=M('xq');
				$grdnmnxt=(int)$_POST['grdnm']+1;
				$dt=array(
						'xqnm'=>$_POST['grdnm'].'-'.$grdnmnxt.'学年 第1学期',
						'xqdq'=>0,
				);
				$xq->data($dt)->add();
				$dt=array(
						'xqnm'=>$_POST['grdnm'].'-'.$grdnmnxt.'学年 第2学期',
						'xqdq'=>0,
				);
				$xq->data($dt)->add();
				//再增加该年级对应的学年
				$xn=M('xn');
				$dt=array(
						'xnnm'=>$_POST['grdnm'].'-'.$grdnmnxt.'学年',
						'xndq'=>0,
				);
				$xn->data($dt)->add();
				
				$sys=M('sys');
				$syso=$sys->find();
				$m=M();
				$grdnmold=(int)$_POST['grdnm']-1;
				//先占坑除了mj可能要相关的值，其他都是占坑
				//1、班主任tb_20xx_bzr
				$sqlyj="SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'db_'".$syso['sysnm']." AND table_name = 'tb_".$_POST['grdnm']."_bzr'";
				$mrslt=$m->query($sqlyj);
				if($mrslt==0){
					$sqlyj="CREATE TABLE tb_".$_POST['grdnm']."_bzr ENGINE=INNODB  COLLATE = utf8_general_ci COMMENT = '' SELECT bzrid, f_bzr_grdid, f_bzr_usrid, f_bzr_clsid FROM tb_".$grdnmold."_bzr WHERE 1 = 0";
					$m->query($sqlyj);
					$sqlyj="ALTER TABLE tb_".$_POST['grdnm']."_bzr   CHANGE bzrid bzrid INT(3) NOT NULL AUTO_INCREMENT,    ADD PRIMARY KEY(bzrid)";
					$m->query($sqlyj);
				}
				//2、班级tb_20xx_cls
				$sqlyj="SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'db_'".$syso['sysnm']." AND table_name = 'tb_".$_POST['grdnm']."_cls'";
				$mrslt=$m->query($sqlyj);
				if($mrslt==0){
					$sqlyj="CREATE TABLE tb_".$_POST['grdnm']."_cls ENGINE=INNODB  COLLATE = utf8_general_ci COMMENT = '' SELECT clsid, f_cls_sttid, f_cls_grdid, clsnm, clsxhprx, clsactvt FROM tb_".$grdnmold."_cls WHERE 1 = 1";
					$m->query($sqlyj);
					$sqlyj="ALTER TABLE tb_".$_POST['grdnm']."_cls   CHANGE clsid clsid INT(4) NOT NULL AUTO_INCREMENT,    ADD PRIMARY KEY(clsid)";
					$m->query($sqlyj);
					$cls=M($_POST['grdnm'].'_cls');
					$dt=array(
							'f_cls_grdid'=>$grdo['grdid'],
					);
					$cls->setField($dt);
				}
				//3、专业tb_20xx_mj
				$sqlyj="SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'db_'".$syso['sysnm']." AND table_name = 'tb_".$_POST['grdnm']."_mj'";
				$mrslt=$m->query($sqlyj);
				if($mrslt==0){
					$sqlyj="CREATE TABLE tb_".$_POST['grdnm']."_mj ENGINE=INNODB  COLLATE = utf8_general_ci COMMENT = '' SELECT mjid, f_mj_grdid, f_mj_bxxsid, f_mj_ccid, f_mj_klid, f_mj_xxxsid, f_mj_zsfwid, f_mj_xzid, mjdm, mjnm, mjdsc, mjbbzs, mjsttu FROM tb_".$grdnmold."_mj";
					$m->query($sqlyj);
					$sqlyj="ALTER TABLE tb_".$_POST['grdnm']."_mj   CHANGE mjid mjid INT(3) NOT NULL AUTO_INCREMENT,    ADD PRIMARY KEY(mjid)";
					$m->query($sqlyj);
					$mj=M($_POST['grdnm'].'_mj');
					$dt=array(
							'f_mj_grdid'=>$grdo['grdid'],
					);
					$mj->setField($dt);
				}
				//4、学生tb_20xx_std
				$sqlyj="SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'db_'".$syso['sysnm']." AND table_name = 'tb_".$_POST['grdnm']."_std'";
				$mrslt=$m->query($sqlyj);
				if($mrslt==0){
					$sqlyj="CREATE TABLE tb_".$_POST['grdnm']."_std ENGINE=INNODB  COLLATE = utf8_general_ci COMMENT = '' SELECT stdid, f_std_sttid, f_std_grdid, stdaplno, stdno, stdupfnctm, stdnm, stdpw, stdpt, f_std_sexid, f_std_rcid, f_std_zzmmid, stdnp, stdbtd, stdsol, stdcee, stdsog, stdqq, f_std_xlid, stdidcd, stdcp, stdrlta, stdrltanm, stdrltaocpt, stdrltacp, stdrltb, stdrltbnm, stdrltbocpt, stdrltbcp, stdhb, f_std_statid, stdpst, stdads, stdmdftm, stdaddtm, stdtlp, stdpertm, stdertm, stdicbc, stdrcmdnm, stdrcmdcp, stdpnttm FROM tb_".$grdnmold."_std WHERE 1 = 0";
					$m->query($sqlyj);
					$sqlyj="ALTER TABLE tb_".$_POST['grdnm']."_std   CHANGE stdid stdid INT(6) NOT NULL AUTO_INCREMENT,    ADD PRIMARY KEY(stdid)";
					$m->query($sqlyj);
				}
				//5、学生某学期注册班级tb_20xx_stdxqcls
				$sqlyj="SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'db_'".$syso['sysnm']." AND table_name = 'tb_".$_POST['grdnm']."_stdxqcls'";
				$mrslt=$m->query($sqlyj);
				if($mrslt==0){
					$sqlyj="CREATE TABLE tb_".$_POST['grdnm']."_stdxqcls ENGINE=INNODB  COLLATE = utf8_general_ci COMMENT = '' SELECT stdxqclsid, f_stdxqcls_stdid, f_stdxqcls_xqid, f_stdxqcls_clsid FROM tb_".$grdnmold."_stdxqcls WHERE 1 = 0";
					$m->query($sqlyj);
					$sqlyj="ALTER TABLE tb_".$_POST['grdnm']."_stdxqcls   CHANGE stdxqclsid stdxqclsid INT(5) NOT NULL AUTO_INCREMENT,    ADD PRIMARY KEY(stdxqclsid)";
					$m->query($sqlyj);
				}
				//6、学生某学期注册专业tb_20xx_stdxqmj
				$sqlyj="SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'db_'".$syso['sysnm']." AND table_name = 'tb_".$_POST['grdnm']."_stdxqmj'";
				$mrslt=$m->query($sqlyj);
				if($mrslt==0){
					$sqlyj="CREATE TABLE tb_".$_POST['grdnm']."_stdxqmj ENGINE=INNODB  COLLATE = utf8_general_ci COMMENT = '' SELECT stdxqmjid, f_stdxqmj_stdid, f_stdxqmj_xqid, f_stdxqmj_mjid FROM tb_".$grdnmold."_stdxqmj WHERE 1 = 0";
					$m->query($sqlyj);
					$sqlyj="ALTER TABLE tb_".$_POST['grdnm']."_stdxqmj   CHANGE stdxqmjid stdxqmjid INT(5) NOT NULL AUTO_INCREMENT,    ADD PRIMARY KEY(stdxqmjid)";
					$m->query($sqlyj);
				}
				//7、站点初始学期tb_20xx_sttintxq
				$sqlyj="SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'db_'".$syso['sysnm']." AND table_name = 'tb_".$_POST['grdnm']."_sttintxq'";
				$mrslt=$m->query($sqlyj);
				if($mrslt==0){
					$sqlyj="CREATE TABLE tb_".$_POST['grdnm']."_sttintxq ENGINE=INNODB  COLLATE = utf8_general_ci COMMENT = '' SELECT sttintxqid, f_sttintxq_grdid, f_sttintxq_sttid, f_sttintxq_xqid, sttintxqyes FROM tb_".$grdnmold."_sttintxq WHERE 1=0";
					$m->query($sqlyj);//先空架子搭好，然后老数据逐步迁移到新数据
					$sqlyj="ALTER TABLE tb_".$_POST['grdnm']."_sttintxq   CHANGE sttintxqid sttintxqid INT(3) NOT NULL AUTO_INCREMENT,    ADD PRIMARY KEY(sttintxqid)";
					$m->query($sqlyj);
					$sttintxqold=M($grdnmold.'_sttintxq');
					$sttintxqoldls=$sttintxqold->join('tb_xq ON f_sttintxq_xqid=xqid')->select();
					//根据原来的名称来处理 比如2014-2015学年 第1学期 晚两个学期变成2015-2016学年 第1学期
					$sttintxq=M($_POST['grdnm'].'_sttintxq');
					foreach ($sttintxqoldls as $v){
						$xqnm=$v['xqnm'];
						$tmp=explode('-', $xqnm);
						$tou=$tmp[0];
						$tmp=explode(' ', $xqnm);
						$wei=$tmp[1];
						$inttou=(int)$tou;
						$wanzheng=($inttou+1).'-'.($inttou+2).' '.$wei;
						$xqo=$xq->where("xqnm='".$wanzheng."'")->find();
						$dt=array(
								'f_sttintxq_grdid'=>$grdo['grdid'],
								'f_sttintxq_sttid'=>$v['f_sttintxq_sttid'],
								'f_sttintxq_xqid='=>$xqo['xqid'],
								'sttintxqyes'=>$v['sttintxqyes'],
						);
						$sttintxq->data($dt)->add();
	
					}
					
					
					
					$sttintxq->setField($dt);
				}
				//8、特殊情况tb_20xx_tsqk
				$sqlyj="SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'db_'".$syso['sysnm']." AND table_name = 'tb_".$_POST['grdnm']."_tsqk'";
				$mrslt=$m->query($sqlyj);
				if($mrslt==0){
					$sqlyj="CREATE TABLE tb_".$_POST['grdnm']."_tsqk ENGINE=INNODB  COLLATE = utf8_general_ci COMMENT = '' SELECT tsqkid, f_tsqk_grdid, f_tsqk_stdid, tsqktm, tsqknr FROM tb_".$grdnmold."_tsqk WHERE 1 = 0";
					$m->query($sqlyj);
					$sqlyj="ALTER TABLE tb_".$_POST['grdnm']."_tsqk   CHANGE tsqkid tsqkid INT(3) NOT NULL AUTO_INCREMENT,    ADD PRIMARY KEY(tsqkid)";
					$m->query($sqlyj);
						
				}
				
				//9、特殊情况tb_20xx_xf
				$sqlyj="SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'db_'".$syso['sysnm']." AND table_name = 'tb_".$_POST['grdnm']."_xf'";
				$mrslt=$m->query($sqlyj);
				if($mrslt==0){
					$sqlyj="CREATE TABLE tb_".$_POST['grdnm']."_xf ENGINE=INNODB  COLLATE = utf8_general_ci COMMENT = '' SELECT xfid, f_xf_grdid, f_xf_sttid, f_xf_bxxsid, f_xf_ccid, f_xf_klid, xfsm ,jckwfsm FROM tb_".$grdnmold."_xf WHERE 1 = 0";
					$m->query($sqlyj);
					$sqlyj="ALTER TABLE tb_".$_POST['grdnm']."_xf   CHANGE xfid xfid INT(3) NOT NULL AUTO_INCREMENT,    ADD PRIMARY KEY(xfid)";
					$m->query($sqlyj);
				
				}
				
				//10、特殊情况tb_20xx_zsf
				$sqlyj="SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'db_'".$syso['sysnm']." AND table_name = 'tb_".$_POST['grdnm']."_zsf'";
				$mrslt=$m->query($sqlyj);
				if($mrslt==0){
					$sqlyj="CREATE TABLE tb_".$_POST['grdnm']."_zsf ENGINE=INNODB  COLLATE = utf8_general_ci COMMENT = '' SELECT zsfid, f_zsf_grdid, f_zsf_dmid, zsfsm FROM tb_".$grdnmold."_zsf WHERE 1 = 0";
					$m->query($sqlyj);
					$sqlyj="ALTER TABLE tb_".$_POST['grdnm']."_zsf   CHANGE zsfid zsfid INT(3) NOT NULL AUTO_INCREMENT,    ADD PRIMARY KEY(zsfid)";
					$m->query($sqlyj);
				
				}
				
				//11、特殊情况tb_20xx_cw
				$sqlyj="SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = 'db_'".$syso['sysnm']." AND table_name = 'tb_".$_POST['grdnm']."_cw'";
				$mrslt=$m->query($sqlyj);
				if($mrslt==0){
					$sqlyj="CREATE TABLE tb_".$_POST['grdnm']."_cw ENGINE=INNODB  COLLATE = utf8_general_ci COMMENT = '' SELECT cwid, f_cw_stdid, cwyjxfsm, cwyjjckwfsm, cwyjzsfsm, cwsjxfsm, cwsjjckwfsm, cwsjzsfsm FROM tb_".$grdnmold."_cw WHERE 1 = 0";
					$m->query($sqlyj);
					$sqlyj="ALTER TABLE tb_".$_POST['grdnm']."_cw   CHANGE cwid cwid INT(3) NOT NULL AUTO_INCREMENT,    ADD PRIMARY KEY(cwid)";
					$m->query($sqlyj);
				
				}
				
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$grd=M('grd');
			//先截获数据
			$data=array(
				'grdnm'=>$_POST['grdnm'],
				
			);
					
			if($grd->where('grdid='.$grdid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		
		$std=M('std');
		$std->where('f_grdid='.$_POST['grdid'])->setField(array('f_grdid'=>0));
	
		$zszy=M('zszy');
		$zszy->where('f_grdid='.$_POST['grdid'])->delete();
		
		$grd=M('grd');
		if($grd->delete($_POST['grdid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($grd->getLastSql());
		}
		
	}

}



?>