<?php 

//规矩：需要display的 就mo mls 不需要的 只要uo uls 之类，方便批量移植
class AtcAction extends Action{
	
	function gtxpg(){
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		$x=$_GET['x'];
		
				
		if($x=='vw'){
			$atcid=$_GET['atcid'];
			$atc=M('atc');
			$mo=$atc->join('tb_bd ON f_atc_bdid=bdid')->where("atcid=".$atcid)->find();
			
			import('@.TREE.TreeAction');
			$tree = new TreeAction();
			$bd=M('bd');
			$bdls=$bd->order('bdodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
			$str=$tree->findF($bdls, $mo['f_atc_bdid'], 'bdid','bdnm','bdpid');
			$this->assign('tree',$str);
			
			//对文章内容进行小调整
			$imgrule='/<img.*src=(\"|\')(.+)\1.*>/U';//图片规则
			if (preg_match_all($imgrule,$mo['atcctt'],$quote)){
				//p($quote);die;//$quote平时可以随意查看，有帮助，特别是$quoto[1]代表了啥，2代表了啥，0代表了啥
				for($i=0;$i<count($quote[0]);$i++){
					if(!preg_match("/icon_/", $quote[2][$i]))
					$mo['atcctt']=str_replace($quote[0][$i], "<a href='".$quote[2][$i]."'>".$quote[0][$i].'</a>', $mo['atcctt']);
				}
			}
			
			$data=array(
					'atccnt'=>($mo['atccnt']+1),
			);
			$atc->where('atcid='.$mo['atcid'])->setField($data);
			$mo['atccnt']=$mo['atccnt']+1;
			
			
			if($mo['atccv']!='dflt'){
				$alt=$mo['atccv'];
			}
			$this->assign('alt',$alt);
			if($mo['atccv']=='dflt'){
				$mo['atccv']='';
			}
			
			//获得二维码
			//首先获得服务器的广域网域名
			$sys=M('sys');
			$syso=$sys->find();
			$url='http://'.$syso['sysip'].'/'.$syso['sysnm'].'/zsptwap.php/Atc/view/atcid/'.$atcid;
			$this->assign('url',$url);
			import('@.QR.QRAction');
			$qr = new QRAction();
			$qrimgurl=$qr->getQR($url);
			$qr=$qrimgurl;
			$this->assign('qr',$qr);
			
// 			//查看是否收藏过
// 			$atcclct=M('atcclct');
// 			if(session('usridss')){					
// 				$usrid=session('usridss');
// 				if($atcclct->where('f_atcclct_usrid='.$usrid.' AND f_atcclct_atcid='.$atcid)->find()){
// 					//已经收藏
// 					$this->assign('schzysc','已收藏：');
// 					$this->assign('clctcss','collected');
// 					$this->assign('heartcss','hearted');
// 				}else{
// 					//将要收藏
// 					$this->assign('schzysc','收藏本文：');
// 					$this->assign('clctcss','collecting');
// 					$this->assign('heartcss','hearting');
// 				}
			
					
// 			}else{
// 				$this->assign('clctcss','collecting');
// 				$this->assign('heartcss','hearting');
// 			}
			
// 			//添加评论
// 			$cmt=M('cmt');
// 			$cmtls=$cmt->join('tb_usr ON f_cmt_usrid=usrid')->join('tb_atc ON f_cmt_atcid=atcid')->where('atcid='.$atcid)->order('cmttm DESC')->limit(0,5)->select();
// 			$this->assign('cmtls',$cmtls);
// 			$this->assign('cmtcnt',$cmt->join('tb_usr ON f_cmt_usrid=usrid')->join('tb_atc ON f_cmt_atcid=atcid')->where('atcid='.$atcid)->order('cmttm DESC')->count());
			
// 			//下拉评论
// 			//查看是否后继有人，即是否存在第11人///别用find 会出现bug 永远选第一条，很脑残
// 			if($cmt->join('tb_usr ON f_cmt_usrid=usrid')->where('f_cmt_atcid='.$atcid)->order('cmttm ASC')->limit(5,1)->select()){
// 				$hsnxt='y';
// 			}else{
// 				$hsnxt='n';
// 			}
// 			$this->assign('hsnxt',$hsnxt);
// 			//记录当前页
// 			$this->assign('pg',1);
// 			//给活动浏览页面赋值，使其和新的一样，不会因为刷新残留参数而没用//之前已经有hsnxt 和 pg搞定了
// 			$this->assign('executing','n');
			
			$this->assign('mo',$mo);
			$this->assign('title','查看');
			$this->assign('theme','查看详细');
			$this->assign('btnvl','设置');
			$this->display('view');
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
		$mdo=$mdII->where("mdmk='Atc'")->find();
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
		$atc=M('atc');
		$fldint='-atcid-bdnm-atctpc-atcath-atcaddtm-atcmdftm-atctp-atcps-atcanc-atcdnmc-atccnt-atcnw-atczn-atctc-atcvw-';
		if($athofn['athm']==1||$athofn['aths']==1){
			$cdtint="-sp-";
		}else{
			$cdtint='-sp-atcps-eq-1-sp-atcvw-eq-1-sp-';
		}
		
		$spccdtint='-sp-';////
		$odrint='-atctp DESC-atcmdftm DESC-';
		$lmtint=20;
		$jn='tb_bd ON f_atc_bdid=bdid';
		//$jn='tb_ath ON f_atc_athid=athid-jn-tb_atc ON f_atc_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($atc,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($u,$fldint,$cdtint,$odrint,$lmtint,$jn);

		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['atctp']==1){
				$v['atctp']='是';
			}else{
				$v['atctp']='否';
			}
			if($v['atcps']==1){
				$v['atcps']='是';
			}else{
				$v['atcps']='否';
			}
			if($v['atcanc']==1){
				$v['atcanc']='是';
			}else{
				$v['atcanc']='否';
			}
			if($v['atcdnmc']==1){
				$v['atcdnmc']='是';
			}else{
				$v['atcdnmc']='否';
			}
			if($v['atcnw']==1){
				$v['atcnw']='是';
			}else{
				$v['atcnw']='否';
			}
			if($v['atcvw']==1){
				$v['atcvw']='是';
			}else{
				$v['atcvw']='否';
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
		$bd=M('bd');
		$bdls=$bd->select();
		$this->assign('bdls',$bdls);
		
		//
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
		$bd=M('bd');
		$bdls=$bd->order('bdodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
		$str=$tree->unlimitedForListSLCT($bdls,0,'bdid','bdnm','bdpid','bdodr');
		$this->assign('tree',$str);
		
		//q特殊
		$this->assign('title','浏览文章列表');
		$this->assign('theme','文章管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$atcid=$_POST['atcid'];
	
		if($atcid==0){
			$atc=M('atc');
			//先截获数据
			$data=array(
				'f_atc_bdid'=>$_POST['f_atc_bdid'],
				'atctpc'=>$_POST['atctpc'],
				'atcath'=>$_POST['atcath'],
				'atcaddtm'=>$_POST['atcaddtm'],
				'atcmdftm'=>$_POST['atcmdftm'],
				'atctp'=>$_POST['atctp'],
				'atcps'=>$_POST['atcps'],
				'atcanc'=>$_POST['atcanc'],
				'atcdnmc'=>$_POST['atcdnmc'],
				'atcctt'=>stripslashes($_POST['atcctt']),
				'atccnt'=>$_POST['atccnt'],
				'atcnw'=>$_POST['atcnw'],
				'atczn'=>$_POST['atczn'],
				'atctc'=>$_POST['atctc'],
				'atcvw'=>$_POST['atcvw'],
				'atccv'=>$_POST['atccv'],
				'atcsmr'=>$_POST['atcsmr']
			);
			
			if($atc->data($data)->add()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}else{
			$atc=M('atc');
			//先截获数据
			
			$data=array(
				'f_atc_bdid'=>$_POST['f_atc_bdid'],
				'atctpc'=>$_POST['atctpc'],
				'atcath'=>$_POST['atcath'],
				'atcaddtm'=>$_POST['atcaddtm'],
				'atcmdftm'=>$_POST['atcmdftm'],
				'atctp'=>$_POST['atctp'],
				'atcps'=>$_POST['atcps'],
				'atcanc'=>$_POST['atcanc'],
				'atcdnmc'=>$_POST['atcdnmc'],
				'atcctt'=>stripslashes($_POST['atcctt']),
				'atccnt'=>$_POST['atccnt'],
				'atcnw'=>$_POST['atcnw'],
				'atczn'=>$_POST['atczn'],
				'atctc'=>$_POST['atctc'],
				'atcvw'=>$_POST['atcvw'],
				'atccv'=>$_POST['atccv'],
				'atcsmr'=>$_POST['atcsmr']
			);
			
			if($atc->where('atcid='.$atcid)->setField($data)){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
			
		}
	}
	
	function set(){
		header("Content-Type:text/html; charset=utf-8");
		$atcid=$_POST['atcid'];
	
		
		$atc=M('atc');
		//先截获数据
			
		$data=array(
				'atcps'=>$_POST['atcps'],
				'atcvw'=>$_POST['atcvw'],
		);
			
		if($atc->where('atcid='.$atcid)->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
		}
				
		
	}
	
	function delete(){
		
		$atcid=$_POST['atcid'];
		
		//用户评论//cstm评论//用户收藏//cstm收藏
		$cmt=M('cmt');
		$cmt->where('f_cmt_atcid='.$atcid)->delete();
		$cstmcmt=M('cstmcmt');
		$cstmcmt->where('f_cstmcmt_atcid='.$atcid)->delete();
		$atcclct=M('atcclct');
		$atcclct->where('f_atcclct_atcid='.$atcid)->delete();
		$cstmatcclct=M('cstmatcclct');
		$cstmatcclct->where('f_cstmatcclct_atcid='.$atcid)->delete();
		
		$atc=M('atc');
		if($atc->delete($atcid)){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function setview(){
	
		$atc=M('atc');
		$data=array(
			'atcvw'=>$_POST['atcvw']
		);
		if($atc->where('atcid='.$_POST['atcid'])->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function setpass(){
	
		$atc=M('atc');
		$data=array(
				'atcps'=>$_POST['atcps']
		);
		if($atc->where('atcid='.$_POST['atcid'])->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function zan(){
	
		$atc=M('atc');
		
		$atco=$atc->where('atcid='.$_POST['atcid'])->find();
		$data=array(
				'atczn'=>$atco['atczn']+1
		);
		if(session('usridss')){
			if(cookie('usrznatc'.$_POST['atcid'])){
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}else{
				cookie('usrznatc'.$_POST['atcid'],session('usridss'),3600);
				$atc->where('atcid='.$_POST['atcid'])->setField($data);
				$data['status']=1;
				$this->ajaxReturn($data,'json');
					
			}
		}else{
			$data['status']=3;
			$this->ajaxReturn($data,'json');
		}
		
	}
	
	function tucao(){
	
		$atc=M('atc');
	
		$atco=$atc->where('atcid='.$_POST['atcid'])->find();
		$data=array(
				'atctc'=>$atco['atctc']+1
		);
		if(session('usridss')){
			
			if(cookie('usrtcatc'.$_POST['atcid'])){
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}else{
				cookie('usrtcatc'.$_POST['atcid'],session('usridss'),3600);
				$atc->where('atcid='.$_POST['atcid'])->setField($data);
				$data['status']=1;
				$this->ajaxReturn($data,'json');
					
			}
		}else{
			$data['status']=3;
			$this->ajaxReturn($data,'json');
		}
	
	}
	
	function clct(){
	
		$atc=M('atc');
		$atcclct=M('atcclct');
		
	
		$atcid=$_POST['atcid'];
		
		if(session('usridss')){
			
			$usrid=session('usridss');
			if($atcclct->where('f_atcclct_usrid='.$usrid.' AND f_atcclct_atcid='.$atcid)->find()){
				//解除收藏
				$atcclcto=$atcclct->where('f_atcclct_usrid='.$usrid.' AND f_atcclct_atcid='.$atcid)->find();
				$atcclct->delete($atcclcto['atcclctid']);
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				//产生收藏关系
				$data=array(
						f_atcclct_usrid=>$usrid,
						f_atcclct_atcid=>$atcid
				);
				$atcclct->data($data)->add();
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
				
			
		}else{
			$data['status']=3;
			$this->ajaxReturn($data,'json');
		}
	
	}
	
	function comment(){
	
		$atc=M('atc');
		$cmt=M('cmt');
	
	
		$atcid=$_POST['atcid'];
		$cmtctt=$_POST['cmtctt'];
	
		if(session('usridss')){
				
			$usrid=session('usridss');
			$data=array(
					'f_cmt_usrid'=>$usrid,
					'f_cmt_atcid'=>$atcid,
					'cmttm'=>date("Y-m-d H:i:s",time()),
					'cmtctt'=>$cmtctt,
					'cmtzn'=>0,
					'cmttc'=>0
			);
			$cmt->data($data)->add();
			$cmto=$cmt->join('tb_usr ON f_cmt_usrid=usrid')->join('tb_atc ON f_cmt_atcid=atcid')->order('cmtid DESC')->find();
			$str="<div class='page-header'>
		                	<div><div class='pull-left mglft'><div><img src='".$cmto['usrpt']."' class='img-circle' style='width:40px;' /></div><div class='tag'><span>".$cmto['usrnn']."</span></div></div><div class='pull-left mglft' >".$cmto['cmtctt']."</div></div>
		                	<div class='clearfix'></div>
		                	<div class='pull-right tag'><span style='cursor:pointer;' onclick='cmtzn(".$cmto['cmtid'].")' id='cmtzn".$cmto['cmtid']."'><i class='glyphicon glyphicon-thumbs-up'></i>".$cmto['cmtzn']."</span><span style='cursor:pointer;' onclick='cmttc(".$cmto['cmtid'].")'  id='cmttc".$cmto['cmtid']."'><i class='glyphicon glyphicon-thumbs-down' onclick='alert()'></i>".$cmto['cmttc']."</span><span>".$cmto['cmttm']."</span></div>
		            		<div class='clearfix'></div>
		            	</div>";
			$data['str']=$str;
			$data['status']=1;
			$this->ajaxReturn($data,'json');
				
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
		}
	
	}
	
	function commentzan(){
	
		$cmt=M('cmt');
	
		$cmto=$cmt->where('cmtid='.$_POST['cmtid'])->find();
		$data=array(
				'cmtzn'=>$cmto['cmtzn']+1
		);
		if(session('usridss')){
			if(cookie('usrzncmt'.$_POST['cmtid'])){
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}else{
				cookie('usrzncmt'.$_POST['cmtid'],session('usridss'),3600);
				$cmt->where('cmtid='.$_POST['cmtid'])->setField($data);
				$data['status']=1;
				$this->ajaxReturn($data,'json');
					
			}
		}else{
			$data['status']=3;
			$this->ajaxReturn($data,'json');
		}
	
	}
	
	function commenttucao(){
	
		$cmt=M('cmt');
	
		$cmto=$cmt->where('cmtid='.$_POST['cmtid'])->find();
		$data=array(
				'cmttc'=>$cmto['cmttc']+1
		);
		if(session('usridss')){
			if(cookie('usrtccmt'.$_POST['cmtid'])){
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}else{
				cookie('usrtccmt'.$_POST['cmtid'],session('usridss'),3600);
				$cmt->where('cmtid='.$_POST['cmtid'])->setField($data);
				$data['status']=1;
				$this->ajaxReturn($data,'json');
					
			}
		}else{
			$data['status']=3;
			$this->ajaxReturn($data,'json');
		}
	
	}
	
	function search(){
		header("Content-Type:text/html; charset=utf-8");
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Atc'")->find();
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
		$atc=M('atc');
		$fldint='-atcid-bdnm-atctpc-atcath-atcmdftm-atccnt-atczn-atctc-';
		$cdtint="-sp-atcps-eq-1-sp-atcvw-eq-1-sp-";
		//对带空格的关键词进行梳理
		if(trim($_GET['atckw'])==''){
			$tmpcdt='1=1';
		}else{
			$tmp=explode(' ', trim($_GET['atckw']));
			$tmpcdt='1=2';
			foreach ($tmp as $v){
				if(trim($v)){
					$tmpcdt=$tmpcdt." OR atctpc LIKE '%".trim($v)."%' OR atcctt LIKE '%".trim($v)."%'";
				}
			}
		}
		
		
		$spccdtint="-sp-".$tmpcdt."-sp-";////
		$odrint='-atctp DESC-atcmdftm DESC-';
		$lmtint=20;
		$jn='tb_bd ON f_atc_bdid=bdid';
		//$jn='tb_ath ON f_atc_athid=athid-jn-tb_atc ON f_atc_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($atc,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($u,$fldint,$cdtint,$odrint,$lmtint,$jn);
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
		$this->assign('title','搜索结果');
		$this->assign('theme','文章管理');
		
		$this->display('search');
	}
	
	function neiwang(){
		header("Content-Type:text/html; charset=utf-8");
	
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Atc'")->find();
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
		$atc=M('atc');
		$fldint='-atcid-bdnm-atctpc-atcath-atcmdftm-atccnt-atczn-atctc-';
		$cdtint="-sp-atcps-eq-1-sp-atcvw-eq-1-sp-atcnw-eq-1-sp-";
		$spccdtint="-sp-";////
		$odrint='-atctp DESC-atcmdftm DESC-';
		$lmtint=20;
		$jn='tb_bd ON f_atc_bdid=bdid';
		//$jn='tb_ath ON f_atc_athid=athid-jn-tb_atc ON f_atc_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($atc,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		// 		$arr=NB($u,$fldint,$cdtint,$odrint,$lmtint,$jn);
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
		$this->assign('title','浏览文章列表');
		$this->assign('theme','内网文章');
	
		$this->display('neiwang');
	}
	
	function notify(){
		header("Content-Type:text/html; charset=utf-8");
	
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Atc'")->find();
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
		$atc=M('atc');
		$fldint='-atcid-bdnm-atctpc-atcath-atcmdftm-atccnt-atczn-atctc-atcps-atcvw-';
		$cdtint="-sp-atcvw-eq-0-sp-";
		$spccdtint="-sp-";////
		$odrint='-atctp DESC-atcmdftm DESC-';
		$lmtint=20;
		$jn='tb_bd ON f_atc_bdid=bdid';
		//$jn='tb_ath ON f_atc_athid=athid-jn-tb_atc ON f_atc_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($atc,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		// 		$arr=NB($u,$fldint,$cdtint,$odrint,$lmtint,$jn);
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['atcps']==1){
				$v['atcps']='是';
			}else{
				$v['atcps']='否';
			}
			if($v['atcvw']==1){
				$v['atcvw']='是';
			}else{
				$v['atcvw']='否';
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
		$this->assign('title','浏览文章列表');
		$this->assign('theme','未查看文章');
	
		$this->display('notify');
	}
	
	function collect(){
		header("Content-Type:text/html; charset=utf-8");
	
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Atc'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athofn=$Idtath->identify($mdo['mdid'],'qry');
	
		import('@.NTF.NTFAction');
		$ntf = new NTFAction();
		$ntf->setntf();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		$usrid=session('usridss');$atcclct=M('atcclct');
		//$bbb=$atcclct->select();p($bbb);die;
// 	$aaaa=$atcclct->join('tb_atc ON f_atcclct_atcid=atcid')->join('tb_usr ON f_atcclct_usrid=usrid')->join('tb_bd ON f_atc_bdid=bdid')
// 	->where("atcps='y' AND atcvw='y' AND usrid=".$usrid)->select();p($aaaa);die;
		//NB初始化，开始
		$usrid=session('usridss');
		$atcclct=M('atcclct');
		$atc=M('atc');
		$fldint='-atcid-bdnm-atctpc-atcath-atcmdftm-atccnt-atczn-atctc-';
		$cdtint="-sp-atcps-eq-1-sp-atcvw-eq-1-sp-usrid-eq-".$usrid."-sp-";
		$spccdtint="-sp-";////
		$odrint='-atctp DESC-atcmdftm DESC-';
		$lmtint=20;
		$jn='tb_atc ON f_atcclct_atcid=atcid-jn-tb_usr ON f_atcclct_usrid=usrid-jn-tb_bd ON f_atc_bdid=bdid';
		//$jn='tb_ath ON f_atc_athid=athid-jn-tb_atc ON f_atc_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($atcclct,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
		// 		$arr=NB($u,$fldint,$cdtint,$odrint,$lmtint,$jn);
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
		$this->assign('title','浏览文章列表');
		$this->assign('theme','收藏文章');
	
		$this->display('collect');
	}
	
	
	function append(){
		header("Content-Type:text/html; charset=utf-8");
	
		$pg=$_POST['pg'];
		
		$pg=(int)$pg+1;
		
		$data['pg']=$pg;
		
		$cmt=M('cmt');
		//先把活动全部选出来
	
		$atcid=$_GET['atcid'];
		$cmtls=$cmt->join('tb_usr ON f_cmt_usrid=usrid')->where('f_cmt_atcid='.$atcid)->order('cmttm DESC')->limit((($pg-1)*5).',5')->select();
		
		if($cmt->where('f_cmt_atcid='.$atcid)->order('cmttm DESC')->limit(($pg*5).',1')->select()){
			$hsnxt='y';
		}else{
			$hsnxt='n';
		}
		$data['hsnxt']=$hsnxt;
		$imax=count($cmtls);
		 
		for($i=0;$i<$imax;$i++){
			
			//书写html
			
			$htmltxt=$htmltxt."<div class='page-header'>
		                	<div><div class='pull-left mglft'><div><img src='".$cmtls[$i]['usrpt']."' class='img-circle' style='width:40px;' /></div><div class='tag'><span>".$cmtls[$i]['col-md']."</span></div></div><div class='pull-left mglft' >".$cmtls[$i]['cmtctt']."</div></div>
		                	<div class='clearfix'></div>
		                	<div class='pull-right tag'><span style='cursor:pointer;' onclick='cmtzn(".$cmtls[$i]['cmtid'].")' id='cmtzn".$cmtls[$i]['cmtid']."'><i class='glyphicon glyphicon-thumbs-up'></i>".$cmtls[$i]['cmtzn']."</span><span style='cursor:pointer;' onclick='cmttc(".$cmtls[$i]['cmtid'].")'  id='cmttc".$cmtls[$i]['cmtid']."'><i class='glyphicon glyphicon-thumbs-down' onclick='alert()'></i>".$cmtls[$i]['cmttc']."</span><span>".$cmtls[$i]['cmttm']."</span></div>
		            		<div class='clearfix'></div>
		            	</div>";
						
		}
	
		 
		$data['htmltxt']=$htmltxt;
		
		$data['status']=1;

		
		$this->ajaxReturn($data,'json');
	}

}



?>