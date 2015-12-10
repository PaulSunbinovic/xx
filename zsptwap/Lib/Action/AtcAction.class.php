<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class AtcAction extends Action{
	
	function view(){
		
		header("Content-Type:text/html; charset=utf-8");
	
	
		//处理ss
    	import('@.SS.SSAction');
    	$ss = new SSAction();
    	$ss->setss();
    	
    	//设置 导航 bd
    	import('@.TREE.TreeAction');
    	$tree = new TreeAction();
    	
		
// 		import('@.NTF.NTFAction');
// 		$ntf = new NTFAction();
// 		$ntf->setntf();
		
		import('@.NV.NVAction');
		$nv = new NVAction();
		$nv->setnv();
		
		
		
		$atcid=$_GET['atcid'];
		$atc=M('atc');
		$mo=$atc->join('tb_bd ON f_atc_bdid=bdid')->where("atcid=".$atcid)->find();
		
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
		$bd=M('bd');
		$bdls=$bd->order('bdodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
		$str=$tree->findF($bdls, $mo['f_atc_bdid'], 'bdid','bdnm','bdpid');
		$this->assign('brd',$str);
		
		$bdo=$bd->where('bdid='.$mo['f_atc_bdid'])->find();
		$bdlsxd=$bd->where('bdpid='.$bdo['bdpid'])->order('bdodr ASC')->select();
		$this->assign('bdlsxd',$bdlsxd);
		
		//对文章内容进行小调整
		$imgrule='/<img.*src=(\"|\')(.+)\1.*>/U';//图片规则
		if (preg_match_all($imgrule,$mo['atcctt'],$quote)){
			//p($quote);die;//$quote平时可以随意查看，有帮助，特别是$quoto[1]代表了啥，2代表了啥，0代表了啥
			for($i=0;$i<count($quote[0]);$i++){
				if(!preg_match("/icon_/", $quote[2][$i]))
				$newimg=str_replace("<img ","<img style='width:100%' ",$quote[0][$i]);
				$mo['atcctt']=str_replace($quote[0][$i], "<a href='".$quote[2][$i]."'>".$newimg.'</a>', $mo['atcctt']);
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
		$url='http://'.$syso['sysip'].'/'.$syso['sysnm'].'/admin.php/Atc/view/atcid/'.$atcid;
		$this->assign('url',$url);
		import('@.QR.QRAction');
		$qr = new QRAction();
		$qrimgurl=$qr->getQR($url);
		$qr=$qrimgurl;
		$this->assign('qr',$qr);
		
		
		
		$this->assign('mo',$mo);
		$this->assign('title','查看');
		$this->assign('theme','查看详细');
		
		$this->display('view');
	}
	
	//------------------【】【】【】【】以上是用户部分除了gotoX-----------------
	function query(){
		header("Content-Type:text/html; charset=utf-8");
		
		
//处理ss
    	import('@.SS.SSAction');
    	$ss = new SSAction();
    	$ss->setss();
    	
    	//设置 导航 bd
    	import('@.TREE.TreeAction');
    	$tree = new TreeAction();
    	
		
// 		import('@.NTF.NTFAction');
// 		$ntf = new NTFAction();
// 		$ntf->setntf();
		
		import('@.NV.NVAction');
		$nv = new NVAction();
		$nv->setnv();
		
		
		
		$atc=M('atc');
		$bd=M('bd');
		//设置每页多少条//由于采用下拉方案，因此无法享受show方案的参数值续传，得自己来设置
		$lmt=10;
		if($_GET['atcanc']){
			$sccdt="atcanc=1";
			$bdo['bdnm']="<ol class='breadcrumb'><li><a href='".__APP__."'>首页</a></li><li><a href='#'>通知公告</a></li></ol>";
			$this->assign('bdo',$bdo);
			$csm='atcanc';$csz=$_GET['atcanc'];
			//加上兄弟bd
			$bdlsxd=$bd->where('bdpid=0')->order('bdodr ASC')->select();
			$this->assign('bdlsxd',$bdlsxd);
		}else if($_GET['atcdnmc']){
			$sccdt="atcdnmc=1";
			$bdo['bdnm']="<ol class='breadcrumb'><li><a href='".__APP__."'>首页</a></li><li><a href='#'>动态</a></li></ol>";
			$this->assign('bdo',$bdo);
			$csm='atcdnmc';$csz=$_GET['atcdnmc'];
			//加上兄弟bd
			$bdlsxd=$bd->where('bdpid=0')->order('bdodr ASC')->select();
			$this->assign('bdlsxd',$bdlsxd);
		}else if($_GET['atckw']){//考虑到show里面会有get现象
			$atckw=$_GET['atckw'];
			$tmp=explode(' ', $atckw);
			$sccdt='1=2';
			foreach($tmp as $v){
				$ctt=trim($v);
				if($ctt!=''){
					$sccdt=$sccdt." OR atcctt LIKE '%".$ctt."%'";
					$sccdt=$sccdt." OR atctpc LIKE '%".$ctt."%'";
				}
			}
			$bdo['bdnm']="<ol class='breadcrumb'><li><a href='".__APP__."'>首页</a></li><li><a href='#'>“".$atckw."”&nbsp;&nbsp;的搜索结果</a></li></ol>";
			$this->assign('bdo',$bdo);
			$csm='atckw';$csz=$_GET['atckw'];
			$bdlsxd=$bd->where('bdpid=0')->order('bdodr ASC')->select();
			$this->assign('bdlsxd',$bdlsxd);
		}else{
			if($_GET['bdid']){
				$bdid=$_GET['bdid'];
				$bdo=$bd->where('bdid='.$bdid)->find();
				$bdls=$bd->order('bdodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
				$str=$tree->findF($bdls, $bdid, 'bdid','bdnm','bdpid');
				$bdo['bdnm']="<ol class='breadcrumb'><li><a href='".__APP__."'>首页</a></li>".$str."</ol>";
				$this->assign('bdo',$bdo);
				$bdidall=$tree->unlimitedForListID($bdls,$bdid,'bdid','bdnm','bdpid','bdodr');
				//设置搜索条件
				$sccdt='f_atc_bdid='.$bdid;
				$tmp=explode('-', $bdidall);
				for($j=0;$j<count($tmp);$j++){
					if($tmp[$j]!='')
						$sccdt=$sccdt.' OR f_atc_bdid='.$tmp[$j];
				}
				$csm='bdid';$csz=$_GET['bdid'];
				$bdlsxd=$bd->where('bdpid='.$bdo['bdid'])->order('bdodr ASC')->select();
				if(count($bdlsxd)==0){//没儿子就显示老子
					$bdlsxd=$bd->where('bdpid='.$bdo['bdpid'])->order('bdodr ASC')->select();
				}
				$this->assign('bdlsxd',$bdlsxd);
				
				
			}else{
				$bdo['bdnm']="<ol class='breadcrumb'><li><a href='".__APP__."'>首页</a></li><li><a href='#'>所有文章</a></li></ol>";
				$this->assign('bdo',$bdo);
				$sccdt='1=1';
				//加上兄弟bd
				$bdlsxd=$bd->where('bdpid=0')->order('bdodr ASC')->select();
				$this->assign('bdlsxd',$bdlsxd);
			}
			
		}
		$this->assign('hdlpldnld',__URL__.'/appendatc/'.$csm.'/'.$csz);
					
// 		$count=$atc->field('atctpc,atcmdftm,atctp')->where("atcps=1 AND atcvw=1 AND atcnw=0  AND (".$sccdt.")")->order('atctp DESC,atcmdftm DESC')->count();
// 		//分页显示列表，每页10条
// 		import('ORG.Util.Page');
// 		$page=new Page($count,$lmt);//后台管理页面默认一页显示N条记录
// 		$page->rollPage = $count;
// 		$page->setConfig('prev', "&laquo; 上一页");//上一页
// 		$page->setConfig('next', '下一页 &raquo;');//下一页
// 		$page->setConfig('first', '&laquo; 首页');//第一页
// 		$page->setConfig('last', '末页 &raquo;');//最后一页
// 		$page->setConfig('theme','共%totalPage%页/%totalRow%%header% %first% %upPage%  %linkPage%  %downPage% ');
// 		//设置分页回调方法
// 		$show=$page->show();
// 		$show=str_replace("<a>", "&nbsp;<a>", $show);
// 		$show=str_replace("</a>", "</a>&nbsp;", $show);
// 		$show=str_replace("<span>", "&nbsp;<span>", $show);
// 		$show=str_replace("</span>", "</span>&nbsp;", $show);
// 		$show=$show.'&nbsp;&nbsp;每页'.$lmt.'条';
// 		$this->assign('show',$show);
		
		$atcls=$atc->field('atcid,atctpc,atcmdftm,atctp,atccv,atczn,atctc,atccnt')->where("atcps=1 AND atcvw=1 AND atcnw=0 AND (".$sccdt.")")->order('atctp DESC,atcmdftm DESC')->limit(0,$lmt)->select();
		for($j=0;$j<count($atcls);$j++){
			//处理封面
			if($atcls[$j]['atccv']=='dflt'){
				$atcls[$j]['atccv']=C('PUBLIC').'/IMG/atcdflt.png';
			}
			//处理题目长度
			if(mb_strlen($atcls[$j]['atctpc'],'utf-8')>30){
				$atcls[$j]['atctpcsrk']=mb_substr($atcls[$j]['atctpc'], 0,30,'utf-8').'...';
			}else{
				$atcls[$j]['atctpcsrk']=$atcls[$j]['atctpc'];
			}
			$time=strtotime($atcls[$j]['atcmdftm']);
			$atcls[$j]['atcmdftm']=date("Y/m/d",$time);
			if($atcls[$j]['atctp']==1){
				$atcls[$j]['atcstyle']='font-weight:bold';
    			$atcls[$j]['atcflag']='glyphicon glyphicon-equalizer';
			}
			//获得评论数
			$cstmcmt=M('cstmcmt');
			$cstmcmtcnt=$cstmcmt->where('f_cstmcmt_atcid='.$atcls[$j]['atcid'])->count();
			$atcls[$j]['cstmcmtcnt']=$cstmcmtcnt;
		}
		$this->assign('atcls',$atcls);
		
		if($atc->field('atcid,atctpc,atcmdftm,atctp,atccv')->where("atcps=1 AND atcvw=1 AND atcnw=0 AND (".$sccdt.")")->order('atctp DESC,atcmdftm DESC')->limit($lmt,1)->select()){
			$hsnxt='y';
		}else{
			$hsnxt='n';
		}
		$this->assign('hsnxt',$hsnxt);
		//记录当前页
		$this->assign('pg',1);
		//给活动浏览页面赋值，使其和新的一样，不会因为刷新残留参数而没用//之前已经有hsnxt 和 pg搞定了
		$this->assign('executing','n');

		//通用部分
		$this->assign('title','文章浏览');
		$this->assign('theme','Geek主题');
		$this->display('query');
	}
	
	function zan(){
	
		$atc=M('atc');
	
		$atco=$atc->where('atcid='.$_POST['atcid'])->find();
		$data=array(
				'atczn'=>$atco['atczn']+1
		);
		if(session('cstmusridss')){
			if(cookie('cstmusrznatc'.$_POST['atcid'])){
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}else{
				cookie('cstmusrznatc'.$_POST['atcid'],session('cstmusridss'),3600);
				$atc->where('atcid='.$_POST['atcid'])->setField($data);
				$data['status']=1;
				$this->ajaxReturn($data,'json');
					
			}
		}else if(session('wxusross')){
			$data['status']=4;
			$this->ajaxReturn($data,'json');
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
		if(session('cstmusridss')){
				
			if(cookie('cstmusrtcatc'.$_POST['atcid'])){
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}else{
				cookie('cstmusrtcatc'.$_POST['atcid'],session('cstmusridss'),3600);
				$atc->where('atcid='.$_POST['atcid'])->setField($data);
				$data['status']=1;
				$this->ajaxReturn($data,'json');
					
			}
		}else if(session('wxusross')){
			$data['status']=4;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=3;
			$this->ajaxReturn($data,'json');
		}
	
	}
	
	function clct(){
	
		$atc=M('atc');
		$cstmatcclct=M('cstmatcclct');
	
	
		$atcid=$_POST['atcid'];
	
		if(session('cstmusridss')){
				
			$cstmusrid=session('cstmusridss');
			if($cstmatcclct->where('f_cstmatcclct_cstmusrid='.$cstmusrid.' AND f_cstmatcclct_atcid='.$atcid)->find()){
				//解除收藏
				$cstmatcclcto=$cstmatcclct->where('f_cstmatcclct_cstmusrid='.$cstmusrid.' AND f_cstmatcclct_atcid='.$atcid)->find();
				$cstmatcclct->delete($cstmatcclcto['cstmatcclctid']);
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				//产生收藏关系
				$data=array(
						f_cstmatcclct_cstmusrid=>$cstmusrid,
						f_cstmatcclct_atcid=>$atcid
				);
				$cstmatcclct->data($data)->add();
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
	
				
		}else if(session('wxusross')){
			$data['status']=4;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=3;
			$this->ajaxReturn($data,'json');
		}
	
	}
	
	function comment(){
	
		$atc=M('atc');
		$cstmcmt=M('cstmcmt');
	
	
		$atcid=$_POST['atcid'];
		$cstmcmtctt=$_POST['cstmcmtctt'];
	
		if(session('cstmusridss')){
	
			$cstmusrid=session('cstmusridss');
			$data=array(
					'f_cstmcmt_cstmusrid'=>$cstmusrid,
					'f_cstmcmt_atcid'=>$atcid,
					'cstmcmttm'=>date("Y-m-d H:i:s",time()),
					'cstmcmtctt'=>$cstmcmtctt,
					'cstmcmtzn'=>0,
					'cstmcmttc'=>0
			);
			$cstmcmt->data($data)->add();
			$cstmcmto=$cstmcmt->join('tb_cstmusr ON f_cstmcmt_cstmusrid=cstmusrid')->join('tb_atc ON f_cstmcmt_atcid=atcid')->order('cstmcmtid DESC')->find();
			$str="<div class='page-header'>
		                	<div><div class='pull-left mglft'><div><img src='".$cstmcmto['cstmusrpt']."' class='img-circle' style='width:40px;' /></div><div class='tag'><span>".$cstmcmto['cstmusrnn']."</span></div></div><div class='pull-left mglft' >".$cstmcmto['cstmcmtctt']."</div></div>
		                	<div class='clearfix'></div>
		                	<div class='pull-right tag'><span style='cursor:pointer;' onclick='cstmcmtzn(".$cstmcmto['cstmcmtid'].")' id='cstmcmtzn".$cstmcmto['cstmcmtid']."'><i class='glyphicon glyphicon-thumbs-up'></i>".$cstmcmto['cstmcmtzn']."</span><span style='cursor:pointer;' onclick='cstmcmttc(".$cstmcmto['cstmcmtid'].")'  id='cstmcmttc".$cstmcmto['cstmcmtid']."'><i class='glyphicon glyphicon-thumbs-down' onclick='alert()'></i>".$cstmcmto['cstmcmttc']."</span><span>".$cstmcmto['cstmcmttm']."</span></div>
		            		<div class='clearfix'></div>
		            	</div>";
			$data['str']=$str;
			$data['status']=1;
			$this->ajaxReturn($data,'json');
	
		}else if(session('wxusross')){
			$data['status']=3;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
		}
	
	}
	
	function commentzan(){
	
		$cstmcmt=M('cstmcmt');
	
		$cstmcmto=$cstmcmt->where('cstmcmtid='.$_POST['cstmcmtid'])->find();
		$data=array(
				'cstmcmtzn'=>$cstmcmto['cstmcmtzn']+1
		);
		if(session('cstmusridss')){
			if(cookie('cstmusrzncstmcmt'.$_POST['cstmcmtid'])){
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}else{
				cookie('cstmusrzncstmcmt'.$_POST['cstmcmtid'],session('cstmusridss'),3600);
				$cstmcmt->where('cstmcmtid='.$_POST['cstmcmtid'])->setField($data);
				$data['status']=1;
				$this->ajaxReturn($data,'json');
					
			}
		}else if(session('wxusross')){
			$data['status']=4;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=3;
			$this->ajaxReturn($data,'json');
		}
	
	}
	
	function commenttucao(){
	
		$cstmcmt=M('cstmcmt');
	
		$cstmcmto=$cstmcmt->where('cstmcmtid='.$_POST['cstmcmtid'])->find();
		$data=array(
				'cstmcmttc'=>$cstmcmto['cstmcmttc']+1
		);
		if(session('cstmusridss')){
			if(cookie('cstmusrtccstmcmt'.$_POST['cstmcmtid'])){
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}else{
				cookie('cstmusrtccstmcmt'.$_POST['cstmcmtid'],session('cstmusridss'),3600);
				$cstmcmt->where('cstmcmtid='.$_POST['cstmcmtid'])->setField($data);
				$data['status']=1;
				$this->ajaxReturn($data,'json');
					
			}
		}else if(session('wxusross')){
			$data['status']=4;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=3;
			$this->ajaxReturn($data,'json');
		}
	
	}
	
	
	
	function collect(){
		header("Content-Type:text/html; charset=utf-8");
	
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		
	
		import('@.NV.NVAction');
		$nv = new NVAction();
		$nv->setnv();
		
		
	
		$cstmusrid=session('cstmusridss');$atcclct=M('atcclct');
		//$bbb=$atcclct->select();p($bbb);die;
		// 	$aaaa=$atcclct->join('tb_atc ON f_atcclct_atcid=atcid')->join('tb_cstmusr ON f_atcclct_cstmusrid=cstmusrid')->join('tb_bd ON f_atc_bdid=bdid')
		// 	->where("atcps='y' AND atcvw='y' AND cstmusrid=".$cstmusrid)->select();p($aaaa);die;
		//NB初始化，开始
		$cstmusrid=session('cstmusridss');
		$cstmatcclct=M('cstmatcclct');
		
		
		$atc=M('atc');
		$bd=M('bd');
		//设置每页多少条//由于采用下拉方案，因此无法享受show方案的参数值续传，得自己来设置
		$lmt=10;
		
		$bdo['bdnm']="<ol class='breadcrumb'><li><a href='".__APP__."'>首页</a></li><li><a href='#'>我的收藏</a></li></ol>";
		$this->assign('bdo',$bdo);
		
		$bdlsxd=$bd->where('bdpid=0')->order('bdodr ASC')->select();
		$this->assign('bdlsxd',$bdlsxd);
		
		$this->assign('hdlpldnld',__URL__.'/appendatcclct');
		$atcls=$cstmatcclct->join('tb_cstmusr ON f_cstmatcclct_cstmusrid=cstmusrid')->join('tb_atc ON f_cstmatcclct_atcid=atcid')->field('atcid,atctpc,atcmdftm,atctp,atccv,atczn,atctc,atccnt')->where("atcps=1 AND atcvw=1 AND atcnw=0 AND cstmusrid=".$cstmusrid)->order('atctp DESC,atcmdftm DESC')->limit(0,$lmt)->select();
		for($j=0;$j<count($atcls);$j++){
			//处理封面
			if($atcls[$j]['atccv']=='dflt'){
				$atcls[$j]['atccv']=C('PUBLIC').'/IMG/atcdflt.png';
			}
			//处理题目长度
			if(mb_strlen($atcls[$j]['atctpc'],'utf-8')>30){
				$atcls[$j]['atctpcsrk']=mb_substr($atcls[$j]['atctpc'], 0,30,'utf-8').'...';
			}else{
				$atcls[$j]['atctpcsrk']=$atcls[$j]['atctpc'];
			}
			$time=strtotime($atcls[$j]['atcmdftm']);
			$atcls[$j]['atcmdftm']=date("Y/m/d",$time);
			if($atcls[$j]['atctp']==1){
				$atcls[$j]['atcstyle']='font-weight:bold';
    			$atcls[$j]['atcflag']='glyphicon glyphicon-equalizer';
			}
			//获得评论数
			$cstmcmt=M('cstmcmt');
			$cstmcmtcnt=$cstmcmt->where('f_cstmcmt_atcid='.$atcls[$j]['atcid'])->count();
			$atcls[$j]['cstmcmtcnt']=$cstmcmtcnt;
		}
		$this->assign('atcls',$atcls);
		
		if($cstmatcclct->join('tb_cstmusr ON f_cstmatcclct_cstmusrid=cstmusrid')->join('tb_atc ON f_cstmatcclct_atcid=atcid')->field('atcid,atctpc,atcmdftm,atctp,atccv,atczn,atctc,atccnt')->where("atcps=1 AND atcvw=1 AND atcnw=0 AND cstmusrid=".$cstmusrid)->order('atctp DESC,atcmdftm DESC')->limit($lmt,1)->select()){
			$hsnxt='y';
		}else{
			$hsnxt='n';
		}
		$this->assign('hsnxt',$hsnxt);
		//记录当前页
		$this->assign('pg',1);
		//给活动浏览页面赋值，使其和新的一样，不会因为刷新残留参数而没用//之前已经有hsnxt 和 pg搞定了
		$this->assign('executing','n');

		//通用部分
		$this->assign('title','文章浏览');
		$this->assign('theme','Geek主题');
		$this->display('query');
	}
	
	
	function appendatc(){
		header("Content-Type:text/html; charset=utf-8");
		
		//设置 导航 bd
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
	
		$pg=$_POST['pg'];
	
		$pg=(int)$pg+1;
	
		$data['pg']=$pg;
	
		$atc=M('atc');
		
		$bd=M('bd');
		//设置每页多少条//由于采用下拉方案，因此无法享受show方案的参数值续传，得自己来设置
		$lmt=10;
		if($_GET['atcanc']){
			$sccdt="atcanc=1";
// 			$bdo['bdnm']="<h1 class='page-header' style='font-size:30px'>通知公告</h1>";
// 			$this->assign('bdo',$bdo);
// 			$csm='atcanc';$csz=$_GET['atcanc'];
		}else if($_GET['atcdnmc']){
			$sccdt="atcdnmc=1";
// 			$bdo['bdnm']="<h1 class='page-header' style='font-size:30px'>动态</h1>";
// 			$this->assign('bdo',$bdo);
// 			$csm='atcdnmc';$csz=$_GET['atcdnmc'];
		}else if($_GET['atckw']){//考虑到show里面会有get现象
			$atckw=$_GET['atckw'];
			$tmp=explode(' ', $atckw);
			$sccdt='1=2';
			foreach($tmp as $v){
				$ctt=trim($v);
				if($ctt!=''){
					$sccdt=$sccdt." OR atcctt LIKE '%".$ctt."%'";
					$sccdt=$sccdt." OR atctpc LIKE '%".$ctt."%'";
				}
			}
// 			$bdo['bdnm']="<h1 class='page-header' style='font-size:30px'>“".$atckw."”&nbsp;&nbsp;的搜索结果</h1>";
// 			$this->assign('bdo',$bdo);
// 			$csm='atckw';$csz=$_GET['atckw'];
		}else{
			if($_GET['bdid']){
				$bdid=$_GET['bdid'];
				$bdo=$bd->where('bdid='.$bdid)->find();
				$bdls=$bd->order('bdodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
// 				$str=$tree->findF($bdls, $bdid, 'bdid','bdnm','bdpid');
// 				$bdo['bdnm']="<ol class='breadcrumb'><li><a href='".__APP__."'>首页</a></li>".$str."</ol>";
// 				$this->assign('bdo',$bdo);
				$bdidall=$tree->unlimitedForListID($bdls,$bdid,'bdid','bdnm','bdpid','bdodr');
				//设置搜索条件
				$sccdt='f_atc_bdid='.$bdid;
				$tmp=explode('-', $bdidall);
				for($j=0;$j<count($tmp);$j++){
					if($tmp[$j]!='')
						$sccdt=$sccdt.' OR f_atc_bdid='.$tmp[$j];
				}
// 				$csm='bdid';$csz=$_GET['bdid'];
			}else{
// 				$bdo['bdnm']="<ol class='breadcrumb'><li><a href='".__APP__."'>首页</a></li><li><a href='#'>所有文章</a></li></ol>";
// 				$this->assign('bdo',$bdo);
				$sccdt='1=1';
			}
				
		}
		
		$atcls=$atc->field('atcid,atctpc,atcmdftm,atctp,atccv,atczn,atctc,atccnt')->where("atcps=1 AND atcvw=1 AND atcnw=0 AND (".$sccdt.")")->order('atctp DESC,atcmdftm DESC')->limit((($pg-1)*$lmt).','.$lmt)->select();
		for($j=0;$j<count($atcls);$j++){
			//处理封面
			if($atcls[$j]['atccv']=='dflt'){
				$atcls[$j]['atccv']=C('PUBLIC').'/IMG/atcdflt.png';
			}
			//处理题目长度
			if(mb_strlen($atcls[$j]['atctpc'],'utf-8')>30){
				$atcls[$j]['atctpcsrk']=mb_substr($atcls[$j]['atctpc'], 0,30,'utf-8').'...';
			}else{
				$atcls[$j]['atctpcsrk']=$atcls[$j]['atctpc'];
			}
			$time=strtotime($atcls[$j]['atcmdftm']);
			$atcls[$j]['atcmdftm']=date("Y/m/d",$time);
			if($atcls[$j]['atctp']==1){
				$atcls[$j]['atcstyle']='font-weight:bold';
				$atcls[$j]['atcflag']='glyphicon glyphicon-equalizer';
			}
			//获得评论数
			$cstmcmt=M('cstmcmt');
			$cstmcmtcnt=$cstmcmt->where('f_cstmcmt_atcid='.$atcls[$j]['atcid'])->count();
			$atcls[$j]['cstmcmtcnt']=$cstmcmtcnt;
		}

		if($atc->where("atcps=1 AND atcvw=1 AND atcnw=0 AND (".$sccdt.")")->order('atctp DESC,atcmdftm DESC')->limit((($pg)*$lmt).',1')->select()){
			$hsnxt='y';
		}else{
			$hsnxt='n';
		}
		$data['hsnxt']=$hsnxt;
		$imax=count($atcls);
			
		for($i=0;$i<$imax;$i++){
				
			//书写html
				
			$htmltxt=$htmltxt
			."<div class='panel panel-default'>"
				."<div>"
				  ."<div class='panel-body'>"
				  	
				    ."<div class='pull-left col-xs-5' style='padding-left:0px'>"
				    	."<img src='".$atcls[$i]['atccv']."' style='width:120px;height:90px' />"
				    ."</div>"
				    ."<div class='pull-left col-xs-7' style='padding-right:0px'>"
				    	."<div>"
				    		."<span><a href='".__APP__."/Atc/view/atcid/".$atcls[$i]['atcid']."' class='pull-left' style='color:#000; ".$atcls[$i]['atcstyle']."'><i class='".$atcls[$i]['atcflag']."'></i> ".$atcls[$i]['atctpcsrk']."</a></span>"
				    	."</div>"
				    	."<div>"
				    		."<span class='tag' style='color:#ccc'><i class='glyphicon glyphicon-comment'></i> ".$atcls[$i]['cstmcmtcnt']."&nbsp;&nbsp;<i class='glyphicon glyphicon-thumbs-up'></i> ".$atcls[$i]['atczn']."&nbsp;&nbsp;<i class='glyphicon glyphicon-thumbs-down'></i> ".$atcls[$i]['atctc']."&nbsp;&nbsp;<i class='glyphicon glyphicon-eye-open'></i> ".$atcls[$i]['atccnt']."</span>"
				    	."</div>"
				    	."<div>"
				    		."<span class='tag' style='color:#ccc'>".$atcls[$i]['atcmdftm']."</span>"
				    	."</div>"
				    ."</div>"
				  ."</div>"
			  ."</div>"
			."</div>";
	
		}
	
			
		$data['htmltxt']=$htmltxt;
	
		$data['status']=1;
	
	
		$this->ajaxReturn($data,'json');
	}
	
	function appendatcclct(){
		header("Content-Type:text/html; charset=utf-8");
	
		//设置 导航 bd
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
	
		$pg=$_POST['pg'];
	
		$pg=(int)$pg+1;
	
		$data['pg']=$pg;
		

		$cstmusrid=session('cstmusridss');$atcclct=M('atcclct');
		//$bbb=$atcclct->select();p($bbb);die;
		// 	$aaaa=$atcclct->join('tb_atc ON f_atcclct_atcid=atcid')->join('tb_cstmusr ON f_atcclct_cstmusrid=cstmusrid')->join('tb_bd ON f_atc_bdid=bdid')
		// 	->where("atcps='y' AND atcvw='y' AND cstmusrid=".$cstmusrid)->select();p($aaaa);die;
		//NB初始化，开始
		$cstmusrid=session('cstmusridss');
		$cstmatcclct=M('cstmatcclct');
	
		$atc=M('atc');
	
		$bd=M('bd');
		//设置每页多少条//由于采用下拉方案，因此无法享受show方案的参数值续传，得自己来设置
		$lmt=10;
		$atcls=$cstmatcclct->join('tb_cstmusr ON f_cstmatcclct_cstmusrid=cstmusrid')->join('tb_atc ON f_cstmatcclct_atcid=atcid')->field('atcid,atctpc,atcmdftm,atctp,atccv,atczn,atctc,atccnt')->where("atcps=1 AND atcvw=1 AND atcnw=0 AND cstmusrid=".$cstmusrid)->order('atctp DESC,atcmdftm DESC')->limit((($pg-1)*$lmt).','.$lmt)->select();
	
		for($j=0;$j<count($atcls);$j++){
			//处理封面
			if($atcls[$j]['atccv']=='dflt'){
				$atcls[$j]['atccv']=C('PUBLIC').'/IMG/atcdflt.png';
			}
			//处理题目长度
			if(mb_strlen($atcls[$j]['atctpc'],'utf-8')>30){
				$atcls[$j]['atctpcsrk']=mb_substr($atcls[$j]['atctpc'], 0,30,'utf-8').'...';
			}else{
				$atcls[$j]['atctpcsrk']=$atcls[$j]['atctpc'];
			}
			$time=strtotime($atcls[$j]['atcmdftm']);
			$atcls[$j]['atcmdftm']=date("Y/m/d",$time);
			if($atcls[$j]['atctp']==1){
				$atcls[$j]['atcstyle']='font-weight:bold';
    			$atcls[$j]['atcflag']='glyphicon glyphicon-equalizer';
			}
			//获得评论数
			$cstmcmt=M('cstmcmt');
			$cstmcmtcnt=$cstmcmt->where('f_cstmcmt_atcid='.$atcls[$j]['atcid'])->count();
			$atcls[$j]['cstmcmtcnt']=$cstmcmtcnt;
		}
		
	
		if($cstmatcclct->join('tb_cstmusr ON f_cstmatcclct_cstmusrid=cstmusrid')->join('tb_atc ON f_cstmatcclct_atcid=atcid')->field('atcid,atctpc,atcmdftm,atctp,atccv,atczn,atctc,atccnt')->where("atcps=1 AND atcvw=1 AND atcnw=0 AND cstmusrid=".$cstmusrid)->order('atctp DESC,atcmdftm DESC')->limit($lmt*$pg,1)->select()){
			$hsnxt='y';
		}else{
			$hsnxt='n';
		}
		$data['hsnxt']=$hsnxt;
		$imax=count($atcls);
			
		for($i=0;$i<$imax;$i++){
	
			//书写html
	
			$htmltxt=$htmltxt
			."<div class='panel panel-default'>"
				."<div>"
					."<div class='panel-body'>"
				
					    ."<div class='pull-left col-xs-5' style='padding-left:0px'>"
					    		."<img src='".$atcls[$i]['atccv']."' style='width:120px;height:90px' />"
					    ."</div>"
					    ."<div class='pull-left col-xs-7' style='padding-right:0px'>"
					    		."<div>"
					    				."<span><a href='".__APP__."/Atc/view/atcid/".$atcls[$i]['atcid']."' class='pull-left' style='color:#000; ".$atcls[$i]['atcstyle']."'><i class='".$atcls[$i]['atcflag']."'></i> ".$atcls[$i]['atctpcsrk']."</a></span>"
					    		."</div>"
					    		."<div>"
					    				."<span class='tag' style='color:#ccc'><i class='glyphicon glyphicon-comment'></i> ".$atcls[$i]['cstmcmtcnt']."&nbsp;&nbsp;<i class='glyphicon glyphicon-thumbs-up'></i> ".$atcls[$i]['atczn']."&nbsp;&nbsp;<i class='glyphicon glyphicon-thumbs-down'></i> ".$atcls[$i]['atctc']."&nbsp;&nbsp;<i class='glyphicon glyphicon-eye-open'></i> ".$atcls[$i]['atccnt']."</span>"
					    		."</div>"
					    		."<div>"
					    				."<span class='tag' style='color:#ccc'>".$atcls[$i]['atcmdftm']."</span>"
					    		."</div>"
					    ."</div>"
					."</div>"
		    	."</div>"
		    ."</div>";
	
		}
	
			
		$data['htmltxt']=$htmltxt;
	
		$data['status']=1;
	
	
		$this->ajaxReturn($data,'json');
	}
	
	function append(){
		header("Content-Type:text/html; charset=utf-8");
	
		$pg=$_POST['pg'];
	
		$pg=(int)$pg+1;
	
		$data['pg']=$pg;
	
		$cstmcmt=M('cstmcmt');
		//先把活动全部选出来
	
		$atcid=$_GET['atcid'];
		$cstmcmtls=$cstmcmt->join('tb_cstmusr ON f_cstmcmt_cstmusrid=cstmusrid')->where('f_cstmcmt_atcid='.$atcid)->order('cstmcmttm DESC')->limit((($pg-1)*5).',5')->select();
	
		if($cstmcmt->where('f_cstmcmt_atcid='.$atcid)->order('cstmcmttm DESC')->limit(($pg*5).',1')->select()){
			$hsnxt='y';
		}else{
			$hsnxt='n';
		}
		$data['hsnxt']=$hsnxt;
		$imax=count($cstmcmtls);
			
		for($i=0;$i<$imax;$i++){
	
			//书写html
	
			$htmltxt=$htmltxt."<div class='page-header'>
		                	<div><div class='pull-left mglft'><div><img src='".$cstmcmtls[$i]['cstmusrpt']."' class='img-circle' style='width:40px;' /></div><div class='tag'><span>".$cstmcmtls[$i]['col-md']."</span></div></div><div class='pull-left mglft' >".$cstmcmtls[$i]['cstmcmtctt']."</div></div>
		                	<div class='clearfix'></div>
		                	<div class='pull-right tag'><span style='cursor:pointer;' onclick='cstmcmtzn(".$cstmcmtls[$i]['cstmcmtid'].")' id='cstmcmtzn".$cstmcmtls[$i]['cstmcmtid']."'><i class='glyphicon glyphicon-thumbs-up'></i>".$cstmcmtls[$i]['cstmcmtzn']."</span><span style='cursor:pointer;' onclick='cstmcmttc(".$cstmcmtls[$i]['cstmcmtid'].")'  id='cstmcmttc".$cstmcmtls[$i]['cstmcmtid']."'><i class='glyphicon glyphicon-thumbs-down' onclick='alert()'></i>".$cstmcmtls[$i]['cstmcmttc']."</span><span>".$cstmcmtls[$i]['cstmcmttm']."</span></div>
		            		<div class='clearfix'></div>
		            	</div>";
	
		}
	
			
		$data['htmltxt']=$htmltxt;
	
		$data['status']=1;
	
	
		$this->ajaxReturn($data,'json');
	}

}



?>