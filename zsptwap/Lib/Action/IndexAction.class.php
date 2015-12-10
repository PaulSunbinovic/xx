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
    	
    	
    	
     	$atc=M('atc');
    	$atcls=$atc->join('tb_bd ON f_atc_bdid=bdid')->where("atcps=1 AND atcvw=1 AND atczs=1")->order('atctp DESC,atcmdftm DESC')->limit(0,10)->select();
    	for($i=0;$i<count($atcls);$i++){
    		 if(mb_strlen($atcls[$i]['atctpc'],'utf-8')>30){
    		    $atcls[$i]['atctpcsrk']=mb_substr($atcls[$i]['atctpc'], 0,30,'utf-8').'...';
    		 }else{
    		   	$atcls[$i]['atctpcsrk']=$atcls[$i]['atctpc'];
    		 }
    		 $tmp=explode(' ', $atcls[$i]['atcmdftm']);
    		 $atcls[$i]['atcmdftmst']=$tmp[0];
    		
    	}
    	$this->assign('atcls',$atcls);
     	
     	
     	
     	
     	
    	//通用部分
    	$this->assign('title','招生平台');
    	$this->assign('theme','招生平台');
		$this->display('index');
    }
    
    
}

?>