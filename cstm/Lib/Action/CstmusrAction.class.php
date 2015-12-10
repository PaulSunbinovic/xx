<?php 

//规矩：需要display的 就m mls 不需要的 只要cstmusro cstmusrls 之类，方便批量移植
class CstmusrAction extends Action{
	
	function loginin(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmusr=M('cstmusr');
		$cstmusrnm=$_POST['cstmusrnm'];
		$cstmusrpw=md5($_POST['cstmusrpw']);
		$rmb=$_POST['rmb'];
		
		if($cstmusr->where("cstmusrnm='".$cstmusrnm."'")->find()){
			
			if($cstmusr->where("cstmusrnm='".$cstmusrnm."' AND cstmusrpw='".$cstmusrpw."'")->find()){
				$cstmusro=$cstmusr->where("cstmusrnm='".$cstmusrnm."' AND cstmusrpw='".$cstmusrpw."'")->find();
				
				if($cstmusro['cstmusrps']==1){
					if($rmb=='y'){
						$day=365;
						cookie('cstmusridck',$cstmusro['cstmusrid'],$day*24*3600);
					}
					
					session('cstmusridss',$cstmusro['cstmusrid']);
					$data['status']=3;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=4;
					$this->ajaxReturn($data,'json');
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
		
// 		//清空btn表中的数据
// 		$btn=M('btn');
// 		$btn->where('f_btn_cstmusrid='.session('cstmusridss'))->delete();
		
		session('cstmusridss',null);
		cookie('cstmusridck',null);
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
				
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}
		}

	}
	
	function modify(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmusrid=$_POST['cstmusrid'];
		
		$cstmusr=M('cstmusr');
		$cstmusro=$cstmusr->where('cstmusrid='.$cstmusrid)->find();
		//先截获数据
		$data=array(
			'cstmusrnm'=>$_POST['cstmusrnm'],
			'cstmusrnn'=>$_POST['cstmusrnn'],
			'cstmusrpt'=>$_POST['cstmusrpt'],
			'f_cstmusr_athid'=>$_POST['f_cstmusr_athid'],
			'cstmusrmdftm'=>date("Y-m-d H:i:s",time()),
			'cstmusrcp'=>$_POST['cstmusrcp'],
			'cstmusrml'=>$_POST['cstmusrml'],
			'cstmusrps'=>$_POST['cstmusrps'],
				
		);
		//查一查有没有同名客户用户
		if($cstmusr->where("cstmusrnm='".$data['cstmusrnm']."' AND cstmusrnm<>'".$cstmusro['cstmusrnm']."'")->find()){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			if($cstmusr->where('cstmusrid='.$cstmusrid)->setField($data)){
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}
		}
	}
	function modifypw(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmusrid=$_POST['cstmusrid'];
		$cstmusrpworg=md5($_POST['cstmusrpworg']);
		$cstmusrpwnew=md5($_POST['cstmusrpwnew']);
		
		$cstmusr=M('cstmusr');
		//先截获数据
		$data=array(
			'cstmusrpw'=>$cstmusrpwnew,
		);
		
		if($cstmusr->where("cstmusrid=".$cstmusrid." AND cstmusrpw='".$cstmusrpworg."'")->find()){
			if($cstmusr->where('cstmusrid='.$cstmusrid)->setField($data)){
				$data['status']=2;
				$this->ajaxReturn($data,'json');
			}else{
				$data['status']=3;
				$this->ajaxReturn($data,'json');
			}
		}else{
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}
	}
	function forget(){
		header("Content-Type:text/html; charset=utf-8");
	
		$cstmusrnm=$_POST['cstmusrnm'];
		$cstmusrml=$_POST['cstmusrml'];
		$cstmusr=M('cstmusr');
		if($cstmusr->where("cstmusrnm='".$cstmusrnm."'")->find()){
			if($cstmusr->where("cstmusrnm='".$cstmusrnm."' AND cstmusrml='".$cstmusrml."'")->find()){
				
				$cstmusro=$cstmusr->where("cstmusrnm='".$cstmusrnm."'")->find();
				
				//由于从邮箱进行点击链接是无法获取session的，所以存sql sql存一个是key 一个是时间戳
				$tm=time();//一样可以保证是同一个tm
				$vrf=md5($cstmusrnm.$tm);
				$cstmss=M('cstmss');
				$dt=array(
						cstmssvrf=>$vrf,
						cstmsstm=>$tm,
						cstmsscstmusrnm=>$cstmusrnm
				);
				//刚刚创建好了立马用
				$cstmss->data($dt)->add();
				$cnt=$cstmss->count();
				$cstmssls=$cstmss->limit($cnt-1,1)->select();
				$cstmssid=$cstmssls[0]['cstmssid'];
	
	
	
				//得到公网地址
				$sys=M('sys');
				$syso=$sys->find();
	
				//发送邮件
				import('@.MAIL.MailAction');
				//$mail = new PHPMailer(); //实例化
				$mail=new MailAction();
				$mail->IsSMTP(); // 启用SMTP
				$mail->Host = "smtp.163.com"; //SMTP服务器 以163邮箱为例子
				$mail->Port = 25;  //邮件发送端口
				$mail->SMTPAuth   = true;  //启用SMTP认证
	
				$mail->CharSet  = "UTF-8"; //字符集
				$mail->Encoding = "base64"; //编码方式
	
				$mail->Username = "sunbinovic@163.com";  //你的邮箱
				$mail->Password = "burning2009";  //你的密码
				$mail->Subject = "密码找回"; //邮件标题
	
				$mail->From = "sunbinovic@163.com";  //发件人地址（也就是你的邮箱）
				$mail->FromName = "管理员";  //发件人姓名
	
				$address = $cstmusrml;//收件人email
				$mail->AddAddress($address, $cstmusro['cstmusrnn']);//添加收件人（地址，昵称）
	
				//$mail->AddAttachment('xx.xls','我的附件.xls'); // 添加附件,并指定名称
				//$mail->IsHTML(true); //支持html格式内容
				//$mail->AddEmbeddedImage("logo.jpg", "my-attach", "logo.jpg"); //设置邮件中的图片
				$mail->Body = '你好, 请点击以下链接 http://'.$syso['sysip'].'/'.$syso['sysnm'].'/cstm.php/Cstmusr/gtxpg/x/modifypwml/ssid/'.$cstmssid.'/vrf/'.$vrf.' 如果您的邮箱不支持点击链接，那么请您将此链接粘贴至浏览器地址栏进行访问，此邮件30分钟内有效'; //邮件主体内容
	
				//发送
				// 		if(!$mail->Send()) {
				// 			echo "Mailer Error: " . $mail->ErrorInfo;
				// 		} else {
				// 			echo "Message sent!";
				// 		}
					
				if($mail->Send()){
					$data['status']=1;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}
			}else{
				$data['status']=4;
				$this->ajaxReturn($data,'json');
			}
		}else{
			$data['status']=3;
			$this->ajaxReturn($data,'json');
		}
	
	}
	
	function modifypwml(){
		header("Content-Type:text/html; charset=utf-8");
		$cstmusrid=$_POST['cstmusrid'];
	
	
		$cstmusrpwnew=$_POST['cstmusrpwnew'];
	
		$cstmusr=M('cstmusr');
		$cstmusro=$cstmusr->where('cstmusrid='.$cstmusrid)->find();
		//先截获数据
		$data=array(
				'cstmusrpw'=>$_POST['cstmusrpwnew'],
		);
	
	
		if($cstmusr->where('cstmusrid='.$cstmusrid)->setField($data)){
			//搞定的话，就把之前她所有为申请新密码搞来的ss去掉
			$cstmss=M('cstmss');
			$cstmss->where("cstmsscstmusrnm='".$cstmusro['cstmusrnm']."'")->delete();
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
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
			
// 		import('@.NTF.NTFAction');
// 		$ntf = new NTFAction();
// 		$ntf->setntf();
			
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		
		//个人行为不参与鉴权
		if($x=='regist'){
			//配置页面显示内容
			$mo['cstmusrid']=0;
			$mo['cstmusrpt']=C('PUBLIC').'/IMG/default.jpg';
			$this->assign('mo',$mo);
			$this->assign('title','客户用户注册页面');
			$this->assign('theme','注册：');
			$this->assign('btnvl','添加');
			$this->display('regist');
		
		}else if($x=='center'){
			$cstmusrid=session('cstmusridss');
			$cstmusr=M('cstmusr');
			
			$mo=$cstmusr->where('cstmusrid='.$cstmusrid)->find();
			//以后扩展看是在哪个grp哪个角色
			//$mo=$cstmusr->join('tb_ath ON f_cstmusr_athid=athid')->where('cstmusrid='.$cstmusrid)->find();
		
// 			if($mo['f_cstmusr_athid']==0){
// 				$mo['athnm']='无权限';
// 			}

			if($mo['cstmusrps']==1){
				$mo['cstmusrps']='客户用户状态正常';
			}else{
				$mo['cstmusrps']='客户用户状态冻结';
			}
			
			
			$this->assign('title','客户用户中心');
			$this->assign('theme','客户用户中心：');
			$this->assign('mo',$mo);
			$this->display('center');
		}else if($x=='modify'){
			$cstmusr=M('cstmusr');
			$cstmusrid=session('cstmusridss');
			$mo=$cstmusr->where('cstmusrid='.$cstmusrid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','客户用户修改页面');
			$this->assign('theme','修改：');
			$this->assign('btnvl','修改');
			$this->display('modify');
		}else if($x=='modifypw'){
			$cstmusr=M('cstmusr');
			$cstmusrid=session('cstmusridss');
			$mo=$cstmusr->where('cstmusrid='.$cstmusrid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','客户用户修改密码页面');
			$this->assign('theme','修改密码：');
			$this->assign('btnvl','修改');
			$this->display('modifypw');
		}else if($x=='forget'){
			$this->assign('title','忘记密码');
			$this->assign('theme','忘记密码：');
			$this->assign('btnvl','发送至邮箱');
			$this->display('forget');
		}else if($x=='modifypwml'){
			
			$vrf=$_GET['vrf'];
			$ssid=$_GET['ssid'];
			
			$cstmss=M('cstmss');
			$cstmsso=$cstmss->where('cstmssid='.$ssid)->find();
			
			$cstmusr=M('cstmusr');
			
			if($vrf!=$cstmsso['cstmssvrf']){
				//验证码过期
				$errmsg='验证码已过期';
				$this->assign('theme','结果：');
				$this->assign('errmsg',$errmsg);
				$this->display('vrferror');
			}else if(time()-$cstmsso['cstmsstm']>1800){
				//超过30分钟了
				$errmsg='已经超过30分钟，请重新认证';
				$this->assign('theme','结果：');
				$this->assign('errmsg',$errmsg);
				$this->display('vrferror');
			}else{
				$mo=$cstmusr->where("cstmusrnm='".$cstmsso['cstmsscstmusrnm']."'")->find();
				$this->assign('mo',$mo);
				$this->assign('title','客户用户通过密保修改密码页面');
				$this->assign('theme','修改密码：');
				$this->assign('btnvl','修改');
				$this->display('modifypwml');
			}
			
			
		}else{
		
			//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,qcstmusrery he gtxpg两处
			//鉴权分立PARTB
			import('@.IDTATH.IdtathAction');
			$Idtath = new IdtathAction();
			$athofn=$Idtath->identify($mdo['mdid'],$x);
			
			if($x=='vw'){
				$cstmusrid=$_GET['cstmusrid'];
				$cstmusr=M('cstmusr');
				$mo=$cstmusr->where("cstmusrid=".$cstmusrid)->find();
				
				if($mo['cstmusrps']==1){
					$mo['cstmusrps']='客户用户状态正常';
				}else{
					$mo['cstmusrps']='客户用户状态冻结';
				}
				if($mo['cstmusrvw']==1){
					$mo['cstmusrvw']='是';
				}else{
					$mo['cstmusrvw']='否';
				}
				$this->assign('mo',$mo);
				$this->assign('title','查看');
				$this->assign('theme','查看详细');
				$this->display('view');
			}else if($x=='updt'){
				$cstmusrid=$_GET['cstmusrid'];
				$cstmusr=M('cstmusr');
				if($cstmusrid==0){
					$mo['cstmusrvw']=1;
					$mo['cstmusrps']=1;
					$mo['cstmusrid']=0;
					$mo['cstmusrpt']=C('PUBLIC').'/IMG/default.jpg';
					$this->assign('title','添加');
					$this->assign('theme','添加：');
					$this->assign('btnvl','添加');
				}else{
					$mo=$cstmusr->where("cstmusrid=".$cstmusrid)->find();
					$this->assign('title','修改');
					$this->assign('theme','修改：');
					$this->assign('btnvl','修改');
				}
				$this->assign('mo',$mo);
				
				$this->display('update');
			}
		}
	
	}
	

}



?>