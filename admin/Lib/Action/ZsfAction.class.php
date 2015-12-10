<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class ZsfAction extends Action{
	
	
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Zsf'")->find();
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
				
			$zsfid=$_GET['zsfid'];
			$zsf=M($grdo['grdnm'].'_zsf');
			$mo=$zsf->join('tb_grd ON f_zsf_grdid=grdid')->join('tb_dm ON f_zsf_dmid=dmid')->where("zsfid=".$zsfid)->find();
			
			
			$this->assign('mo',$mo);
			
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
				
			$zsfid=$_GET['zsfid'];
			$zsf=M($grdo['grdnm'].'_zsf');
			if($zsfid==0){
				//默认年级是当前年级
				$grd=M('grd');
				$grdo=$grd->order('grdnm DESC')->find();
				$grdid=$grdo['grdid'];
				$mo['f_zsf_grdid']=$grdid;
				
								
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$zsf->join('tb_grd ON f_zsf_grdid=grdid')->join('tb_dm ON f_zsf_dmid=dmid')->where("zsfid=".$zsfid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
		
				
			
			//q特殊
			$grd=M('grd');
			$grdls=$grd->order('grdnm DESC')->select();
			$this->assign('grdls',$grdls);
			
			//q特殊
			$dm=M('dm');
			$dmls=$dm->select();
			$this->assign('dmls',$dmls);
			
			
			$this->display('update');
		}
		
	
	}
	
	//------------------【】【】【】【】以上是住宿费部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Zsf'")->find();
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
		if(preg_match('/f_zsf_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_zsf_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
		}else{
			//默认grdid
			$grdo=$grd->order('grdid DESC')->find();
			$grdid=$grdo['grdid'];
		}
		$grdo=$grd->where('grdid='.$grdid)->find();
		$zsf=M($grdo['grdnm'].'_zsf');
		$fldint='-zsfid-grdnm-dmnm-zsfsm-';
		
		$cdtint="-sp-f_zsf_grdid-eq-".$grdo['grdid']."-sp-";
		$spccdtint='-sp-';////
		$odrint='-';
		$lmtint=20;
		$jn='tb_grd ON f_zsf_grdid=grdid-jn-tb_dm ON f_zsf_dmid=dmid';
		//$jn='tb_ath ON f_zsf_athid=athid-jn-tb_atc ON f_zsf_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($zsf,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		
		
		
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
		//p($arr['mls']);die;
		
		//q特殊
		$grd=M('grd');
		$grdls=$grd->order('grdnm DESC')->select();
		$this->assign('grdls',$grdls);
		
		$dm=M('dm');
		$dmls=$dm->order('dmnm DESC')->select();
		$this->assign('dmls',$dmls);
		
		//q特殊
		$this->assign('title','浏览住宿费列表');
		$this->assign('theme','住宿费管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$zsfid=$_POST['zsfid'];
	
		if($zsfid==0){
			
			$grdid=$_POST['f_zsf_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$zsf=M($grdo['grdnm'].'_zsf');
							
			
			//先截获数据
			$data=array(
					'f_zsf_grdid'=>$_POST['f_zsf_grdid'],
					'f_zsf_dmid'=>$_POST['f_zsf_dmid'],
					'zsfsm'=>$_POST['zsfsm'],
			);
			
			if($zsf->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$grdid=$_POST['f_zsf_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$zsf=M($grdo['grdnm'].'_zsf');
			
			//先截获数据
			$data=array(
					'f_zsf_grdid'=>$_POST['f_zsf_grdid'],
					'f_zsf_dmid'=>$_POST['f_zsf_dmid'],
					'zsfsm'=>$_POST['zsfsm'],
			);
			if($zsf->where('zsfid='.$zsfid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		
				
		$zsf=M('zsf');
		if($zsf->delete($_POST['zsfid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($zsf->getLastSql());
		}
	}
	
	
	
}



?>