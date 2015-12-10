<?php 

//规矩：需要display的 就m mls 不需要的 只要cstmusro cstmusrls 之类，方便批量移植
class WxusrAction extends Action{
	
	function combine(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmusr=M('cstmusr');
		$cstmusrnm=$_POST['cstmusrnm'];
		$cstmusrpw=md5($_POST['cstmusrpw']);
		
		if($cstmusr->where("cstmusrnm='".$cstmusrnm."'")->find()){
				
			if($cstmusr->where("cstmusrnm='".$cstmusrnm."' AND cstmusrpw='".$cstmusrpw."'")->find()){
				$cstmusro=$cstmusr->where("cstmusrnm='".$cstmusrnm."' AND cstmusrpw='".$cstmusrpw."'")->find();
				$wxusrcstmusr=M('wxusrcstmusr');
				if($wxusrcstmusr->where('f_wxusrcstmusr_cstmusrid='.$cstmusro['cstmusrid'])->find()){
					$data['status']=5;
					$this->ajaxReturn($data,'json');
				}else{
					if($cstmusro['cstmusrps']==1){
						$wxusross=session('wxusross');
						$wxusr=M('wxusr');
						$wxusro=$wxusr->where("wxusropid='".$wxusross['wxusropid']."'")->find();
						$wxusrcstmusr=M('wxusrcstmusr');
						$dt=array(
								'f_wxusrcstmusr_wxusrid'=>$wxusro['wxusrid'],
								'f_wxusrcstmusr_cstmusrid'=>$cstmusro['cstmusrid'],
								'wxusrcstmusriswx'=>0
						);
						$wxusrcstmusr->data($dt)->add();
						session('cstmusridss',$cstmusro['cstmusrid']);
						$data['status']=3;
						$this->ajaxReturn($data,'json');
					}else{
						$data['status']=4;
						$this->ajaxReturn($data,'json');
					}
				}
			}else{
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}
				
		}else{
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}
	}
	
	function loginout(){
		header("Content-Type:text/html; charset=utf-8");
	
		session('wxusross',null);
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	
	function regist(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmusrid=$_GET['cstmusrid'];
	
	
		$cstmusr=M('cstmusr');
		//先截获数据
		$data=array(
				'cstmusrnm'=>$_POST['cstmusrnm'],
				'cstmusrnn'=>$_POST['cstmusrnn'],
				'cstmusrpw'=>md5($_POST['cstmusrpw']),
				'cstmusrpt'=>$_POST['cstmusrpt'],
				'cstmusraddtm'=>date("Y-m-d H:i:s",time()),
				'cstmusrmdftm'=>date("Y-m-d H:i:s",time()),
				'cstmusrcp'=>$_POST['cstmusrcp'],
				'cstmusrml'=>$_POST['cstmusrml'],
				'cstmusrps'=>$_POST['cstmusrps'],
				'cstmusrvw'=>$_POST['cstmusrvw'],
		);
		//查一查有没有同名客户用户
		if($cstmusr->where("cstmusrnm='".$data['cstmusrnm']."'")->find()){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			if($cstmusr->data($data)->add()){
	
				//给他和cstmgrp关系加一条和cstmrl关系也加一条
				$cstmusro=$cstmusr->order('cstmusrid DESC')->find();
	
				$cstmusrcstmgrp=M('cstmusrcstmgrp');
				$dt=array('f_cstmusrcstmgrp_cstmusrid'=>$cstmusro['cstmusrid'],'f_cstmusrcstmgrp_cstmgrpid'=>1);
				$cstmusrcstmgrp->data($dt)->add();
	
				$cstmusrcstmrl=M('cstmusrcstmrl');
				$dt=array('f_cstmusrcstmrl_cstmusrid'=>$cstmusro['cstmusrid'],'f_cstmusrcstmrl_cstmrlid'=>1);
				$cstmusrcstmrl->data($dt)->add();
				
				$cstmusro=$cstmusr->order('cstmusrid DESC')->find();
				
				$wxusross=session('wxusross');
				$wxusr=M('wxusr');
				$wxusro=$wxusr->where("wxusropid='".$wxusross['wxusropid']."'")->find();
	
				//顺便带绑定
				$wxusrcstmusr=M('wxusrcstmusr');
				$dt=array(
						'f_wxusrcstmusr_wxusrid'=>$wxusro['wxusrid'],
						'f_wxusrcstmusr_cstmusrid'=>$cstmusro['cstmusrid'],
						'wxusrcstmusriswx'=>1
				);
				$wxusrcstmusr->data($dt)->add();
				
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}
		}
	
	}
	
	function gtxpg(){
		
		$x=$_GET['x'];
		
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
		//鉴权分立partA
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cstmusr'")->find();
		
		import('@.NV.NVAction');
		$nv = new NVAction();
		$nv->setnv();
			
// 		import('@.NTF.NTFAction');
// 		$ntf = new NTFAction();
// 		$ntf->setntf();
			
// 		import('@.KZMB.KZMBAction');
// 		$kzmb = new KZMBAction();
// 		$kzmb->setkzmb($mdo['mdid']);
		
		
		//个人行为不参与鉴权
		if($x=='center'){
			$wxusross=session('wxusross');
			$wxusr=M('wxusr');
			
			$mo=$wxusr->where("wxusropid='".$wxusross['wxusropid']."'")->find();
			
			
			
			
			$this->assign('title','微信用户中心');
			$this->assign('theme','微信用户中心：');
			$this->assign('mo',$mo);
			$this->display('center');
		}else if($x=='combine'){
			$wxusross=session('wxusross');
			$wxusr=M('wxusr');
				
			$mo=$wxusr->where("wxusropid='".$wxusross['wxusropid']."'")->find();
			
			
			
			
			$this->assign('title','微信用户绑定');
			$this->assign('theme','微信用户绑定：');
			$this->assign('mo',$mo);
			$this->display('combine');
		}else if($x=='regist'){
			$wxusross=session('wxusross');
			$wxusr=M('wxusr');
				
			$mo=$wxusr->where("wxusropid='".$wxusross['wxusropid']."'")->find();
			$mo['cstmusrpt']=C('PUBLIC').'/IMG/default.jpg';
			
			
			
			$this->assign('title','微信用户信息完善');
			$this->assign('theme','微信用户信息完善：');
			$this->assign('mo',$mo);
			$this->display('regist');
		}
	
	}
	

}



?>