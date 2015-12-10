<?php 

//规矩：需要display的 就mo mls 不需要的 只要uo uls 之类，方便批量移植
class ZsszAction extends Action{
	
	function gtxpg(){
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Zssz'")->find();
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
			$zsszid=$_GET['zsszid'];
			
			$zssz=M('zssz');
			$mo=$zssz->join('tb_grd ON f_zssz_grdid=grdid')->join('tb_xq ON f_zssz_xqid=xqid')->where("zsszid=".$zsszid)->find();
			
			if($mo['zsszop']==1){
				$mo['zsszop']='是';
			}else{
				$mo['zsszop']='否';
			}
			//改变sttu的具体值
			$bxxs=M('bxxs');
			$tmp=explode('-', $mo['zsszbxxsu']);
			$str='';
			for($i=1;$i<count($tmp)-1;$i++){
				$bxxso=$bxxs->where('bxxsid='.$tmp[$i])->find();
				$str=$str.$bxxso['bxxsnm'].' ';
			}
			$mo['zsszbxxsu']=$str;		
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			
			$zsszid=$_GET['zsszid'];
			
			$zssz=M('zssz');
			if($zsszid==0){
				$mo['zsszid']=0;
				$mo['zsszbxxsu']='-';
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				//招生设置的更新时间
				
				$mo=$zssz->join('tb_grd ON f_zssz_grdid=grdid')->join('tb_xq ON f_zssz_xqid=xqid')->where("zsszid=".$zsszid)->find();
				//改变sttu的具体值
				$bxxs=M('bxxs');
				$tmp=explode('-', $mo['zsszbxxsu']);
				$ary=array();
				for($i=1;$i<count($tmp)-1;$i++){
					$bxxso=$bxxs->where('bxxsid='.$tmp[$i])->find();
					array_push($ary, $bxxso);
				}
				
				$this->assign('bxxslsub',$ary);//u版本
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			
			
			
			
			
			//q特殊
			$grd=M('grd');
			$grdls=$grd->select();
			$this->assign('grdls',$grdls);
			
			$xq=M('xq');
			$xqls=$xq->select();
			$this->assign('xqls',$xqls);
			
			//
			$bxxs=M('bxxs');
			$bxxsls=$bxxs->select();
			$this->assign('bxxsls',$bxxsls);
			
			$this->display('update');
		}
	
	
	}
	
	//------------------【】【】【】【】以上是用户部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Zssz'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$Idtath->identify($mdo['mdid'],'qry');
		
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		
		
		$zssz=M('zssz');
		
		$fldint='-zsszid-grdnm-xqnm-zsszbxxsu-zsszop-zsszjztm-zsszxnltm-';
		
		$cdtint="-sp-";
		
		$spccdtint='-sp-';////
		$odrint='-';
		$lmtint=20;
		$jn='tb_grd ON f_zssz_grdid=grdid-jn-tb_xq ON f_zssz_xqid=xqid';
		
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($zssz,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		
		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['zsszop']==1){
				$v['zsszop']='是';
			}else{
				$v['zsszop']='否';
			}
			//改变bxxsu的具体值
			$bxxs=M('bxxs');
			$tmp=explode('-', $v['zsszbxxsu']);
			$str='';
			for($i=1;$i<count($tmp)-1;$i++){
				$bxxso=$bxxs->where('bxxsid='.$tmp[$i])->find();
				$str=$str.$bxxso['bxxsnm'].' ';
			}
			$v['zsszbxxsu']=$str;
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
		$this->assign('title','浏览招生设置列表');
		$this->assign('theme','招生设置管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$zsszid=$_POST['zsszid'];
	
		if($zsszid==0){
// 			$grdid=$_POST['f_zssz_grdid'];
// 			$grd=M('grd');
// 			$grdo=$grd->where('grdid='.$grdid)->find();
// 			$zssz=M($grdo['grdnm'].'_zssz');
// 			//先截获数据
// 			$data=array(
// 					'f_zssz_grdid'=>$_POST['f_zssz_grdid'],
// 					'f_zssz_bxxsid'=>$_POST['f_zssz_bxxsid'],
// 				'f_zssz_ccid'=>$_POST['f_zssz_ccid'],
// 				'f_zssz_klid'=>$_POST['f_zssz_klid'],
// 				'f_zssz_xxxsid'=>$_POST['f_zssz_xxxsid'],
// 				'f_zssz_zsfwid'=>$_POST['f_zssz_zsfwid'],
// 				'f_zssz_xzid'=>$_POST['f_zssz_xzid'],
// 				'zsszdm'=>$_POST['zsszdm'],
// 				'zssznm'=>$_POST['zssznm'],
// 				'zsszdsc'=>stripslashes($_POST['zsszdsc']),
// 			);
			
// 			if($zssz->data($data)->add()){
// 				$data['status']=1;
// 				$this->ajaxReturn($data,'json');
// 			}else{
// 				$data['status']=2;
// 				$this->ajaxReturn($data,'json');
// 			}
			
		}else{
			$zssz=M('zssz');
			//先截获数据
			
			$data=array(
					'f_zssz_grdid'=>$_POST['f_zssz_grdid'],
					'f_zssz_xqid'=>$_POST['f_zssz_xqid'],
					'zsszbxxsu'=>$_POST['zsszbxxsu'],
					'zsszop'=>$_POST['zsszop'],
					'zsszjztm'=>$_POST['zsszjztm'],
					'zsszxnltm'=>$_POST['zsszxnltm'],
			);
			
			if($zssz->where('zsszid='.$zsszid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		$zssz=M('zssz');
		if($zssz->delete($_POST['zsszid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	

}



?>