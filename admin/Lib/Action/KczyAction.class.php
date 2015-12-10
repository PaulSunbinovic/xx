<?php 

//规矩：需要display的 就m mls 不需要的 只要kczyo kczyls 之类，方便批量移植
class KczyAction extends Action{
	
	
	
	function gtxpg(){
		
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
			
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,qkczyery he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Kczy'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],$x);
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		
		//NTF自带鉴权功能
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		if($x=='vw'){
			$kczyid=$_GET['kczyid'];
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$kczy=M($grdo['grdnm'].'_kczy');
			$mo=$kczy->join('tb_grd ON f_kczy_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_kc ON f_kczy_kcid=kcid')->join('tb_'.$grdo['grdnm'].'_zy ON f_kczy_zyid=zyid')->where("kczyid=".$kczyid)->find();
			
			if($mo['kcsfts']==1){
				$mo['kcsfts']='【通识课】';
			}else{
				$mo['kcsfts']='【选修课】';
			}
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->assign('btnvl','设置');
			$this->display('view');
		}else if($x=='updt'){
			$kczyid=$_GET['kczyid'];
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$kczy=M($grdo['grdnm'].'_kczy');
			if($kczyid==0){
				
				//重定义
				$grdo=$grd->order('grdnm DESC')->find();
				$mo['f_kczy_grdid']=$grdo['grdid'];
				$mo['kczyid']=0;
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$kczy->where("kczyid=".$kczyid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			
			//q特殊
			$grd=M('grd');
			$grdls=$grd->order('grdnm DESC')->select();
			$this->assign('grdls',$grdls);
			
			$kc=M($grdo['grdnm'].'_kc');
			$kcls=$kc->select();
			$kclsfn=array();
			foreach($kcls as $v){
				if($v['kcsfts']==1){
					$v['kcsfts']='【通识课】';
				}else{
					$v['kcsfts']='【选修课】';
				}
				array_push($kclsfn, $v);
			}
			$this->assign('kcls',$kclsfn);
				
			
			$zy=M($grdo['grdnm'].'_zy');
			$zyls=$zy->select();
			$this->assign('zyls',$zyls);
			
			
			
			$this->display('update');
		}
		
	
	}
	
	//------------------【】【】【】【】以上是站点首学期设置部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Kczy'")->find();
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
		if(preg_match('/f_kczy_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_kczy_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
		}else{
			//默认grdid
			$grdo=$grd->order('grdid DESC')->find();
			$grdid=$grdo['grdid'];
		}
		$grdo=$grd->where('grdid='.$grdid)->find();
		$kczy=M($grdo['grdnm'].'_kczy');
		$fldint='-kczyid-f_kczy_grdid-grdnm-kcnm-kcsfts-zynm-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='-';
		$lmtint=20;
		$jn='tb_grd ON f_kczy_grdid=grdid-jn-tb_'.$grdo['grdnm'].'_kc ON f_kczy_kcid=kcid-jn-tb_'.$grdo['grdnm'].'_zy ON f_kczy_zyid=zyid';
		//$jn='tb_ath ON f_kczy_athid=athid-jn-tb_atc ON f_kczy_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($kczy,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($kczy,$fldint,$cdtint,$odrint,$lmtint,$jn);
		
		$mlsfn=array();
		foreach($arr['mls'] as $v){
			if($v['kcsfts']==1){
				$v['kcsfts']='【通识课】';
			}else{
				$v['kcsfts']='【选修课】';
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
		$grd=M('grd');
		$grdls=$grd->order('grdnm DESC')->select();
		$this->assign('grdls',$grdls);
		
		$kc=M($grdo['grdnm'].'_kc');
		$kcls=$kc->order('kcsfts DESC')->select();
		$kclsfn=array();
		foreach($kcls as $v){
			if($v['kcsfts']==1){
				$v['kcsfts']='【通识课】';
			}else{
				$v['kcsfts']='【选修课】';
			}
			array_push($kclsfn, $v);
		}
		$this->assign('kcls',$kclsfn);
		
		$zy=M($grdo['grdnm'].'_zy');
		$zyls=$zy->select();
		$this->assign('zyls',$zyls);
		
		//q特殊
		$this->assign('title','课程专业关系列表');
		$this->assign('theme','课程专业关系管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$kczyid=$_POST['kczyid'];
	
		if($kczyid==0){
			$grdid=$_POST['f_kczy_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$kczy=M($grdo['grdnm'].'_kczy');
			//先截获数据
			$data=array(
				'f_kczy_grdid'=>$_POST['f_kczy_grdid'],
				'f_kczy_kcid'=>$_POST['f_kczy_kcid'],
				'f_kczy_zyid'=>$_POST['f_kczy_zyid'],
				
			);
			if($kczy->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
		}else{
			$grdid=$_POST['f_kczy_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$kczy=M($grdo['grdnm'].'_kczy');
			//先截获数据
			
			$data=array(
				'f_kczy_grdid'=>$_POST['f_kczy_grdid'],
				'f_kczy_kcid'=>$_POST['f_kczy_kcid'],
				'f_kczy_zyid'=>$_POST['f_kczy_zyid'],
			);
			
			if($kczy->where('kczyid='.$kczyid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
		}
	}
	
	function delete(){
		$grdid=$_POST['grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		$kczy=M($grdo['grdnm'].'_kczy');
		
		if($kczy->delete($_POST['kczyid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function createAlways(){
		$grdid=$_POST['f_kczy_grdid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		$kc=M($grdo['grdnm'].'_kc');
		$zy=M($grdo['grdnm'].'_zy');
		
		
		
		
		$wherekc='1=1';
		$wherezy='1=1';
		
		$kcls=$kc->where($wherekc)->order('kcsfts DESC')->select();
		$kclsfn=array();
		foreach($kcls as $v){
			if($v['kcsfts']==1){
				$v['kcsfts']='【通识课】';
			}else{
				$v['kcsfts']='【选修课】';
			}
			array_push($kclsfn, $v);
		}
		
		$zyls=$zy->where($wherezy)->select();
		
		$kcoptu="<option value=''>无</option>";
		foreach ($kclsfn as $v){
			$kcoptu=$kcoptu."<option value='".$v['kcid']."'>".$v['kcsfts'].$v['kcnm']."</option>";
		}
		
		$zyoptu="<option value=''>无</option>";
		foreach ($zyls as $v){
			$zyoptu=$zyoptu."<option value='".$v['zyid']."'>".$v['zynm']."</option>";
		}
		
		
		$data['kcoptu']=$kcoptu;
		$data['zyoptu']=$zyoptu;
		
		
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	
}



?>