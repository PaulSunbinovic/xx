<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class ClsAction extends Action{
	
	function gtxpg(){
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		$x=$_GET['x'];
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cls'")->find();
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
			$clsid=$_GET['clsid'];
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$cls=M($grdo['grdnm'].'_cls');
			$mo=$cls->join('tb_stt ON f_cls_sttid=sttid')->join('tb_grd ON f_cls_grdid=grdid')->where("clsid=".$clsid)->find();
			

			//适应一些站点用一二三
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			
			//1、0是否化
			if($mo['clsactvt']==1){
				$mo['clsactvt']='是';
			}else if($mo['clsactvt']==0){
				$mo['clsactvt']='否';
			}
			if($mo['clsxqu']){
				$clsxqu=explode('-', $mo['clsxqu']);
				$xqnmu='';
				for($i=1;$i<count($clsxqu)-1;$i++){
					$xqid=$clsxqu[$i];p($grdid);die;
					$xqnm=$xqw->getxqnm($grdid, $mo['f_cls_sttid'], $xqid);
					$xqnmu=$xqnmu.$xqnm.'<br>';
				}
			}
			$mo['clsxqu']=$xqnmu;
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$clsid=$_GET['clsid'];
			$grdid=$_GET['grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$cls=M($grdo['grdnm'].'_cls');
			import('@.XQ.XQAction');
			$xqw = new XQAction();//外来的学期
			if($clsid==0){
				
				//鉴权对用户对stt的权限，若为设置权限，说明是教务的人，可以全管，否则只能管自己函授站的 ntf为不用this assign的
				$mdII=M('md');
				$mdo=$mdII->where("mdmk='Stt'")->find();
				import('@.IDTATH.IdtathAction');
				$Idtath = new IdtathAction();
				$athofnstt=$Idtath->identify($mdo['mdid'],'ntf');
				
				$usr=M('usr');
				$usro=$usr->where('usrid='.session('usridss'))->find();
				
				if($athofnstt['aths']==1){
					$mo['f_cls_sttid']=1;
				}else{
					$mo['f_cls_sttid']=$usro['f_usr_sttid'];
				}
				
				$mo['clsid']=0;
				$mo['clsxqu']='-';
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$cls->join('tb_stt ON f_cls_sttid=sttid')->join('tb_grd ON f_cls_grdid=grdid')->where("clsid=".$clsid)->find();
				//改变xqu的具体值
				//适应一些站点用一二三
				
				$tmp=explode('-', $mo['clsxqu']);
				$ary=array();
				for($i=1;$i<count($tmp)-1;$i++){
					$xqo=$xqw->getxqo($grdid, $mo['f_cls_sttid'], $tmp[$i]);
					array_push($ary, $xqo);
				}
				$this->assign('xqlsub',$ary);//U版本
				
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			$stt=M('stt');
			$this->assign('sttls',$stt->select());
			
			$xqidls=explode('-', $mo['clsxqu']);
			$xqidlsnw=array();
			for($i=1;$i<count($xqidls)-1;$i++){
				array_push($xqidlsnw, $xqidls[$i]);
			}
			$xqls=$xqw->getxqls($grdid, $mo['f_cls_sttid'], 'ASC');
// 			$xqlsnw=array();
// 			foreach ($xqls as $xqv){
// 				$flg=0;//假设没一个相等的
// 				foreach($xqidlsnw as $xqid){
// 					if($xqv['xqid']==$xqid){
// 						$flg=1;
// 						break;
// 					}
					
// 				}
// 				if($flg==0){
// 					array_push($xqlsnw, $xqv);
// 				}
// 			}
			$this->assign('xqls',$xqls);
			
			$grd=M('grd');
			$this->assign('grdls',$grd->select());
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
		$mdo=$mdII->where("mdmk='Cls'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$Idtath->identify($mdo['mdid'],'qry');
		
		
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
		if(preg_match('/f_cls_grdid/',$cdt)){
			//获取该键的值
			$tmp=explode('f_cls_grdid', $cdt);
			$tmp=explode('-eq-',$tmp[1]);
			$tmp=explode('-sp-',$tmp[1]);
			$grdid=$tmp[0];
		}else{
			//默认grdid
			$grdo=$grd->order('grdid DESC')->find();
			$grdid=$grdo['grdid'];
		}
		
		$grdo=$grd->where('grdid='.$grdid)->find();
		$cls=M($grdo['grdnm'].'_cls');
		$fldint='-clsid-sttnm-f_cls_grdid-grdnm-clsnm-clsxhprx-clsactvt-clsxqu-';
		if($athofnstt['aths']==1){
			$sttidforxq=1;//默认以本部站点为例
			$cdtint="-sp-f_cls_grdid-eq-".$grdid.'-sp-';
		}else{
			$sttidforxq=$usro['f_usr_sttid'];//默认以用户所在站点为例
			$cdtint="-sp-f_cls_sttid-eq-".$usro['f_usr_sttid']."-sp-f_cls_grdid-eq-".$grdid.'-sp-';
		}
		
		$spccdtint='-sp-';////
		$odrint='-clsid ASC-';
		$lmtint=20;
		$jn='tb_stt ON f_cls_sttid=sttid-jn-tb_grd ON f_cls_grdid=grdid';
		//$jn='tb_stt ON f_cls_sttid=sttid-jn-tb_atc ON f_cls_sttid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($cls,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($u,$fldint,$cdtint,$odrint,$lmtint,$jn);
		
		//适应一些站点用一二三
		import('@.XQ.XQAction');
		$xqw = new XQAction();//外来的学期
		
		
		
		
		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['clsactvt']==1){
				$v['clsactvt']='是';
			}else if($v['clsactvt']==0){
				$v['clsactvt']='否';
			}
			if($v['clsxqu']){
				$clsxqu=explode('-', $v['clsxqu']);
				$xqnmu='';
				for($i=1;$i<count($clsxqu)-1;$i++){
					$xqid=$clsxqu[$i];
					$xqnm=$xqw->getxqnm($grdid, $sttidforxq, $xqid);
					$xqnmu=$xqnmu.$xqnm.'<br>';
				}
			}
			$v['clsxqu']=$xqnmu;
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
		$stt=M('stt');
		$sttls=$stt->select();
		$this->assign('sttls',$sttls);
		
		$grd=M('grd');
		$grdls=$grd->select();
		$this->assign('grdls',$grdls);
		
		//q特殊
		$this->assign('title','浏览班级列表');
		$this->assign('theme','班级管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$clsid=$_POST['clsid'];
	
		if($clsid==0){
			$grdid=$_POST['f_cls_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$cls=M($grdo['grdnm'].'_cls');
			//先截获数据
			$data=array(
				'f_cls_sttid'=>$_POST['f_cls_sttid'],
				'f_cls_grdid'=>$_POST['f_cls_grdid'],
				'clsnm'=>$_POST['clsnm'],
				'clsxhprx'=>$_POST['clsxhprx'],
				'clsactvt'=>$_POST['clsactvt'],
					'clsxqu'=>$_POST['clsxqu'],
			);
			
			if($cls->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$grdid=$_POST['f_cls_grdid'];
			$grd=M('grd');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$cls=M($grdo['grdnm'].'_cls');
			//先截获数据
			
			$data=array(
				'f_cls_sttid'=>$_POST['f_cls_sttid'],
				'f_cls_grdid'=>$_POST['f_cls_grdid'],
				'clsnm'=>$_POST['clsnm'],
				'clsxhprx'=>$_POST['clsxhprx'],
				'clsactvt'=>$_POST['clsactvt'],
					'clsxqu'=>$_POST['clsxqu'],
			);
			
			if($cls->where('clsid='.$clsid)->setField($data)){
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
		$cls=M($grdo['grdnm'].'_cls');
		
		$stdxqcls=M($grdo['grdnm'].'_stdxqcls');
		$stdxqcls->where('f_stdxqcls_clsid='.$_POST['clsid'])->delete();
		
		if($cls->delete($_POST['clsid'])){
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
		$grdid=$_POST['f_cls_grdid'];
		$sttid=$_POST['f_cls_sttid'];
		$grd=M('grd');
		$grdo=$grd->where('grdid='.$grdid)->find();
		//适应一些站点用一二三
		import('@.XQ.XQAction');
		$xqw = new XQAction();//外来的学期
		$xqls=$xqw->getxqls($grdid, $sttid, 'ASC');
		$str="<option value=''></option>";
		foreach ($xqls as $xqv){
			$str=$str."<option value='".$xqv['xqid'].'_'.$xqv['xqnm']."'>".$xqv['xqnm']."</option>";
		}
		$data['str']=$str;
		$data['status']=1;
		$this->ajaxReturn($data,'json');
		
	}

}



?>