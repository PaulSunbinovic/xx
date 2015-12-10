<?php 

//规矩：需要display的 就m mls 不需要的 只要wxo wxls 之类，方便批量移植
class WxAction extends Action{
	
	
	
	function gtxpg(){
		
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		
			
		
			
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,qwxery he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Wx'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],$x);
		
		//NTF自带鉴权功能
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		if($x=='vw'){
			$wxid=$_GET['wxid'];
			$wx=M('wx');
			$mo=$wx->where("wxid=".$wxid)->find();
			
			if($mo['wxop']==1){
				$mo['wxop']='是';
			}else{
				$mo['wxop']='否';
			}
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->display('view');
		}else if($x=='updt'){
			$wxid=$_GET['wxid'];
			$wx=M('wx');
			if($wxid==0){
				$mo['wxid']=0;
				$mo['wxpt']=C('PUBLIC').'/IMG/dfltqr.png';
				$this->assign('title','添加');
				$this->assign('theme','添加：');
				$this->assign('btnvl','添加');
			}else{
				$mo=$wx->where("wxid=".$wxid)->find();
				$this->assign('title','修改');
				$this->assign('theme','修改：');
				$this->assign('btnvl','修改');
			}
			$this->assign('mo',$mo);
			
			$this->display('update');
		}
		
	}
	
	//------------------【】【】【】【】以上是微信部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Wx'")->find();
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
		$wx=M('wx');
		$fldint='-wxid-wxappid-wxscrt-wxip-wxop-';
		$cdtint="-sp-";
		$spccdtint='-sp-';////
		$odrint='-';
		$lmtint=20;
		$jn='';
		//$jn='tb_ath ON f_wx_athid=athid-jn-tb_atc ON f_wx_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($wx,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($wx,$fldint,$cdtint,$odrint,$lmtint,$jn);

		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			
			if($v['wxop']==1){
				$v['wxop']='是';
			}else{
				$v['wxop']='否';
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
		$this->assign('title','浏览微信列表');
		$this->assign('theme','微信管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$wxid=$_POST['wxid'];
	
		if($wxid==0){
			$wx=M('wx');
			//先截获数据
			$data=array(
				'wxnm'=>$_POST['wxnm'],
				'wxappid'=>$_POST['wxappid'],
				'wxscrt'=>$_POST['wxscrt'],
				'wxip'=>$_POST['wxip'],
				'wxqr'=>$_POST['wxqr'],
				'wxps'=>$_POST['wxps'],
					'wxop'=>$_POST['wxop']
			);
			if($wx->data($data)->add()){

				
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$wx=M('wx');
			//先截获数据
			$wxo=$wx->where('wxid='.$wxid)->find();
			$data=array(
				'wxnm'=>$_POST['wxnm'],
				'wxappid'=>$_POST['wxappid'],
				'wxscrt'=>$_POST['wxscrt'],
				'wxip'=>$_POST['wxip'],
				'wxqr'=>$_POST['wxqr'],
				'wxps'=>$_POST['wxps'],
					'wxop'=>$_POST['wxop']
			);
			
			
			if($wx->where('wxid='.$wxid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function delete(){
		
				
		$wx=M('wx');
		if($wx->delete($_POST['wxid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($wx->getLastSql());
		}
	}
	
	
}



?>