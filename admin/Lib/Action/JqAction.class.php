<?php 

//规矩：需要display的 就m mls 不需要的 只要jqo jqls 之类，方便批量移植
class JqAction extends Action{
	
	
	
	function gtxpg(){
		
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		
			
		
			
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,qjqery he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Jq'")->find();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		
		
		
		//鉴权II
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],$x);
		
		//NTF自带鉴权功能
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		if($x=='vw'){
			$jqid=$_GET['jqid'];
			$jq=M('jq');
			$mo=$jq->join('tb_stt ON f_jq_sttid=sttid')->join('tb_xq ON f_jq_xqid=xqid')->where("jqid=".$jqid)->find();
			
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->assign('btnvl','设置');
			$this->display('view');
		}else if($x=='updt'){
			$jqid=$_GET['jqid'];
			$jq=M('jq');
			if($jqid==0){
				$mo['jqid']=0;
								
				$stt=M('stt');
				$sttls=$stt->where('sttactvt=1')->select();
				$this->assign('sttls',$sttls);
				
				$xq=M('xq');
				$xqls=$xq->order('xqnm DESC')->select();
				$this->assign('xqls',$xqls);
				
				
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$jq->where("jqid=".$jqid)->find();
				//$this->assign('nmrdol','readonly');
				
				$stt=M('stt');
				$sttls=$stt->where('sttactvt=1')->select();
				$this->assign('sttls',$sttls);
				
				$xq=M('xq');
				$xqls=$xq->order('xqnm DESC')->select();
				$this->assign('xqls',$xqls);
				
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			$this->display('update');
		}
		
	
	}
	
	//------------------【】【】【】【】以上是教师部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Jq'")->find();
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
		$jq=M('jq');
		$fldint='-jqid-sttnm-xqnm-jqqs-jqjs-jqljc-';
		$spccdtint='-sp-';////
		$odrint='-xqnm DESC-';
		$lmtint=20;
		$jn='tb_stt ON f_jq_sttid=sttid-jn-tb_xq ON f_jq_xqid=xqid';
		//$jn='tb_ath ON f_jq_athid=athid-jn-tb_atc ON f_jq_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($jq,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($jq,$fldint,$cdtint,$odrint,$lmtint,$jn);

		
		
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
		
		$stt=M('stt');
		$sttls=$stt->where('sttactvt=1')->select();
		$this->assign('sttls',$sttls);
		
		$xq=M('xq');
		$xqls=$xq->order('xqnm DESC')->select();
		$this->assign('xqls',$xqls);
		
		//q特殊
		$this->assign('title','浏览假期列表');
		$this->assign('theme','假期管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$jqid=$_POST['jqid'];
	
		if($jqid==0){
			$jq=M('jq');
			//先截获数据
			$data=array(
					'f_jq_sttid'=>$_POST['f_jq_sttid'],
					'f_jq_xqid'=>$_POST['f_jq_xqid'],
					'jqqs'=>$_POST['jqqs'],
					'jqjs'=>$_POST['jqjs'],
					'jqljc'=>$_POST['jqljc'],
					
			);
			if($jq->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$jq=M('jq');
			//先截获数据
			$jqo=$jq->where('jqid='.$jqid)->find();
			$data=array(
					'f_jq_sttid'=>$_POST['f_jq_sttid'],
					'f_jq_xqid'=>$_POST['f_jq_xqid'],
					'jqqs'=>$_POST['jqqs'],
					'jqjs'=>$_POST['jqjs'],
					'jqljc'=>$_POST['jqljc'],
					
			);
			if($jq->where('jqid='.$jqid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		$jqid=$_POST['jqid'];
		
		$jqgrp=M('jqgrp');
		$jqgrp->where('f_jqgrp_jqid='.$jqid)->delete();
		
		$jqrl=M('jqrl');
		$jqrl->where('f_jqrl_jqid='.$jqid)->delete();
		
		$atcclct=M('atcclct');
		$atcclct->where('f_atcclct_jqid='.$jqid)->delete();
		
		$cmt=M('cmt');
		$cmt->where('f_cmt_jqid='.$jqid)->delete();
		
		$btn=M('btn');
		$btn->where('f_btn_jqid='.$jqid)->delete();
				
		$jq=M('jq');
		if($jq->delete($_POST['jqid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($jq->getLastSql());
		}
	}
	
	
	
	
}



?>