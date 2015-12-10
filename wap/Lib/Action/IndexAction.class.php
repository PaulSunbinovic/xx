<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	public function index(){
    	
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
    	
    	
    	//获得焦点图
    	$atcfcsls=$atc->join('tb_bd ON f_atc_bdid=bdid')->where("atcps=1 AND atcvw=1 AND atcnw=0 AND atcdnmc=1 AND atccv<>'dflt'")->order('atctp DESC,atcmdftm DESC')->limit(0,5)->select();
   		for($i=0;$i<count($atcfcsls);$i++){
    		if(mb_strlen($atcfcsls[$i]['atctpc'],'utf-8')>10){
    			$atcfcsls[$i]['atctpcsrk']=mb_substr($atcfcsls[$i]['atctpc'], 0,10,'utf-8').'...';
    		}else{
   			$atcfcsls[$i]['atctpcsrk']=$atcfcsls[$i]['atctpc'];
   		}
   			if($i==0){$atcfcsls[$i]['class']='active';}else{$atcfcsls[$i]['class']='';}
      	}
    	$this->assign('atcfcsls',$atcfcsls);
    	
    	//左侧部分的文章
    	//首先找出所有第一级的bd
       	$bd=M('bd');
       	$bdls=$bd->order('bdodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
    	$bdlsnog=$bd->where('bdpid=0')->order('bdodr ASC')->select();//NO 1 generation
    	for($i=0;$i<count($bdlsnog);$i++){
    		$bdidall=$tree->unlimitedForListID($bdls,$bdlsnog[$i]['bdid'],'bdid','bdnm','bdpid','bdodr');
    		//设置搜索条件
    		$sccdt='f_atc_bdid='.$bdlsnog[$i]['bdid'];
    		$tmp=explode('-', $bdidall);
    		for($j=0;$j<count($tmp);$j++){
    			if($tmp[$j]!='')
    			$sccdt=$sccdt.' OR f_atc_bdid='.$tmp[$j];
    		}
    		$atcls=$atc->field('atcid,atctpc,atcmdftm,atctp')->where("atcps=1 AND atcvw=1 AND atcnw='n' AND (".$sccdt.")")->order('atctp DESC,atcmdftm DESC')->limit(0,6)->select();
    		for($j=0;$j<count($atcls);$j++){
    			if(mb_strlen($atcls[$j]['atctpc'],'utf-8')>15){
    				$atcls[$j]['atctpcsrk']=mb_substr($atcls[$j]['atctpc'], 0,15,'utf-8').'...';
    			}else{
    				$atcls[$j]['atctpcsrk']=$atcls[$j]['atctpc'];
    			}
    			$time=strtotime($atcls[$j]['atcmdftm']);
    			$atcls[$j]['atcmdftm']=date("Y/m/d",$time);
    			if($atcls[$j]['atctp']==1){
    				$atcls[$j]['atcstyle']='font-weight:bold';
    				$atcls[$j]['atcflag']='glyphicon glyphicon-equalizer';
    			}
     		}
     		//$this->assign('atcls'.$bdlsnog[$i]['bdid'],$atcls);
     		$bdlsnog[$i]['atcls']=$atcls;
     	}
      	$this->assign('bdlsnog',$bdlsnog);
     	
     	//获得通知公告
     	$atcls=$atc->field('atcid,atctpc,atcmdftm,atctp')->where("atcps=1 AND atcvw=1 AND atcnw=0 AND atcanc=1")->order('atctp DESC,atcmdftm DESC')->limit(0,6)->select();
     	for($j=0;$j<count($atcls);$j++){
     		$time=strtotime($atcls[$j]['atcmdftm']);
     		$atcls[$j]['atcmdftm']=date("Y/m/d",$time);
     		if($atcls[$j]['atctp']==1){
     			$atcls[$j]['atcstyle']='font-weight:bold';
    			$atcls[$j]['atcflag']='glyphicon glyphicon-equalizer';
     		}
     	}
		$this->assign('atclsanc',$atcls);
     	
     	//获得院校动态
     	$atcls=$atc->field('atcid,atctpc,atcmdftm,atctp')->where("atcps=1 AND atcvw=1 AND atcnw=0 AND atcdnmc=1")->order('atctp DESC,atcmdftm DESC')->limit(0,6)->select();
     	for($j=0;$j<count($atcls);$j++){
     		$time=strtotime($atcls[$j]['atcmdftm']);
     		$atcls[$j]['atcmdftm']=date("Y/m/d",$time);
     		if($atcls[$j]['atctp']==1){
     			$atcls[$j]['atcstyle']='font-weight:bold';
    			$atcls[$j]['atcflag']='glyphicon glyphicon-equalizer';
     		}
     	}
     	$this->assign('atclsdnmc',$atcls);
     	
     	//获得二维码
		//首先获得服务器的广域网域名
		$sys=M('sys');
		$syso=$sys->find();
		$url='http://'.$syso['sysip'].'/'.$syso['sysnm'].'/wap.php';
		$this->assign('url',$url);
		import('@.QR.QRAction');
		$qr = new QRAction();
		$qrimgurl=$qr->getQR($url);
		$qr=$qrimgurl;
		$this->assign('qr',$qr);
     	
     	
    	//通用部分
    	$this->assign('title','Geek标准');
    	$this->assign('theme','Geek主题');
		$this->display('index');
    }
    
    
}

?>