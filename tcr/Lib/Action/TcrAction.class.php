<?php 

//规矩：需要display的 就m mls 不需要的 只要tcro tcrls 之类，方便批量移植
class TcrAction extends Action{
	
	function loginin(){
		header("Content-Type:text/html; charset=utf-8");
		$tcr=M('tcr');
		$tcrnm=$_POST['tcrnm'];
		$tcrpw=md5($_POST['tcrpw']);
		$rmb=$_POST['rmb'];
		
		if($tcr->where("tcrnm='".$tcrnm."'")->find()){
			
			if($tcr->where("tcrnm='".$tcrnm."' AND tcrpw='".$tcrpw."'")->find()){
				$tcro=$tcr->where("tcrnm='".$tcrnm."' AND tcrpw='".$tcrpw."'")->find();
				
				if($tcro['tcrps']==1){
					if($rmb=='y'){
						$day=365;
						cookie('tcridck',$tcro['tcrid'],$day*24*3600);
					}
					
					session('tcridss',$tcro['tcrid']);
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
// 		$btn->where('f_btn_tcrid='.session('tcridss'))->delete();
		
		session('tcridss',null);
		cookie('tcridck',null);
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	
	
	

	
	function regist(){
		header("Content-Type:text/html; charset=utf-8");
		$tcrid=$_GET['tcrid'];
	
		
		$tcr=M('tcr');
		//先截获数据
		$data=array(
			'tcrnm'=>$_POST['tcrnm'],
			'tcrnn'=>$_POST['tcrnn'],
				'f_tcr_sttid'=>$_POST['f_tcr_sttid'],
			'tcrpw'=>md5($_POST['tcrpw']),
			'tcrpt'=>$_POST['tcrpt'],
			'tcraddtm'=>date("Y-m-d H:i:s",time()),
			'tcrmdftm'=>date("Y-m-d H:i:s",time()),
				'tcrads'=>$_POST['tcrads'],
				'tcrtlp'=>$_POST['tcrtlp'],
			'tcrcp'=>$_POST['tcrcp'],
			'tcrml'=>$_POST['tcrml'],
				'tcrintr'=>stripslashes($_POST['tcrintr']),
			'tcrps'=>$_POST['tcrps'],
				'tcrvw'=>$_POST['tcrvw'],
				'tcrodr'=>0,
		);
		//查一查有没有同名教师
		if($tcr->where("tcrnm='".$data['tcrnm']."'")->find()){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			if($tcr->data($data)->add()){
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
		$tcrid=$_POST['tcrid'];
		
		$tcr=M('tcr');
		$tcro=$tcr->where('tcrid='.$tcrid)->find();
		//先截获数据
		$data=array(
			'tcrnm'=>$_POST['tcrnm'],
			'tcrnn'=>$_POST['tcrnn'],
				//'f_tcr_sttid'=>$_POST['f_tcr_sttid'],
			'tcrpt'=>$_POST['tcrpt'],
			'tcrmdftm'=>date("Y-m-d H:i:s",time()),
				'tcrads'=>$_POST['tcrads'],
				'tcrtlp'=>$_POST['tcrtlp'],
			'tcrcp'=>$_POST['tcrcp'],
			'tcrml'=>$_POST['tcrml'],
			'tcrintr'=>stripslashes($_POST['tcrintr']),
				
		);
		//查一查有没有同名教师
		if($tcr->where("tcrnm='".$data['tcrnm']."' AND tcrnm<>'".$tcro['tcrnm']."'")->find()){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			if($tcr->where('tcrid='.$tcrid)->setField($data)){
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
		$tcrid=$_POST['tcrid'];
		$tcrpworg=md5($_POST['tcrpworg']);
		$tcrpwnew=md5($_POST['tcrpwnew']);
		
		$tcr=M('tcr');
		//先截获数据
		$data=array(
			'tcrpw'=>$tcrpwnew
		);
		
		if($tcr->where("tcrid=".$tcrid." AND tcrpw='".$tcrpworg."'")->find()){
			if($tcr->where('tcrid='.$tcrid)->setField($data)){
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
	
		$tcrnm=$_POST['tcrnm'];
		$tcrml=$_POST['tcrml'];
		$tcr=M('tcr');
		if($tcr->where("tcrnm='".$tcrnm."'")->find()){
			if($tcr->where("tcrnm='".$tcrnm."' AND tcrml='".$tcrml."'")->find()){
				
				$tcro=$tcr->where("tcrnm='".$tcrnm."'")->find();
				
				//由于从邮箱进行点击链接是无法获取session的，所以存sql sql存一个是key 一个是时间戳
				$tm=time();//一样可以保证是同一个tm
				$vrf=md5($tcrnm.$tm);
				$ss=M('ss');
				$dt=array(
						ssvrf=>$vrf,
						sstm=>$tm,
						sstcrnm=>$tcrnm
				);
				//刚刚创建好了立马用
				$ss->data($dt)->add();
				$cnt=$ss->count();
				$ssls=$ss->limit($cnt-1,1)->select();
				$ssid=$ssls[0]['ssid'];
	
	
	
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
				$mail->Subject = "Geek密码找回"; //邮件标题
	
				$mail->From = "sunbinovic@163.com";  //发件人地址（也就是你的邮箱）
				$mail->FromName = "管理员";  //发件人姓名
	
				$address = $tcrml;//收件人email
				$mail->AddAddress($address, $tcro['tcrnn']);//添加收件人（地址，昵称）
	
				//$mail->AddAttachment('xx.xls','我的附件.xls'); // 添加附件,并指定名称
				//$mail->IsHTML(true); //支持html格式内容
				//$mail->AddEmbeddedImage("logo.jpg", "my-attach", "logo.jpg"); //设置邮件中的图片
				$mail->Body = '你好, 请点击以下链接 http://'.$syso['sysip'].'/'.$syso['sysnm'].'/admin.php/Tcr/gtxpg/x/modifypwml/ssid/'.$ssid.'/vrf/'.$vrf.' 如果您的邮箱不支持点击链接，那么请您将此链接粘贴至浏览器地址栏进行访问，此邮件30分钟内有效'; //邮件主体内容
	
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
		$tcrid=$_POST['tcrid'];
	
	
		$tcrpwnew=$_POST['tcrpwnew'];
	
		$tcr=M('tcr');
		$tcro=$tcr->where('tcrid='.$tcrid)->find();
		//先截获数据
		$data=array(
				'tcrpw'=>$_POST['tcrpwnew'],
		);
	
	
		if($tcr->where('tcrid='.$tcrid)->setField($data)){
			//搞定的话，就把之前她所有为申请新密码搞来的ss去掉
			$ss=M('ss');
			$ss->where("sstcrnm='".$tcro['tcrnm']."'")->delete();
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
		
		
			
		
			
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,qtcrery he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Tcr'")->find();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		
		//个人行为不参与鉴权
		if($x=='regist'){
			//配置页面显示内容
			$mo['tcrid']=0;
			$mo['tcrpt']=C('PUBLIC').'/IMG/default.jpg';
			$this->assign('mo',$mo);
			
			$stt=M('stt');
			$sttls=$stt->where('sttactvt=1')->select();
			$this->assign('sttls',$sttls);
			
			$this->assign('title','教师注册页面');
			$this->assign('theme','注册：');
			$this->assign('btnvl','添加');
			$this->display('regist');
		
		}else if($x=='center'){
			$tcrid=session('tcridss');
			$tcr=M('tcr');
			
			$mo=$tcr->join('tb_stt ON f_tcr_sttid=sttid')->where('tcrid='.$tcrid)->find();
			//以后扩展看是在哪个grp哪个角色
			//$mo=$tcr->join('tb_ath ON f_tcr_athid=athid')->where('tcrid='.$tcrid)->find();
		
// 			if($mo['f_tcr_athid']==0){
// 				$mo['athnm']='无权限';
// 			}

			if($mo['tcrps']==1){
				$mo['tcrps']='教师状态正常';
			}else{
				$mo['tcrps']='教师状态冻结';
			}
			
			
			$this->assign('title','教师中心');
			$this->assign('theme','教师中心：');
			$this->assign('mo',$mo);
			$this->display('center');
		}else if($x=='modify'){
			$tcr=M('tcr');
			$tcrid=session('tcridss');
			$mo=$tcr->where('tcrid='.$tcrid)->find();
			$this->assign('mo',$mo);
			
			$stt=M('stt');
			$sttls=$stt->where('sttactvt=1')->select();
			$this->assign('sttls',$sttls);
			
			$this->assign('title','教师修改页面');
			$this->assign('theme','修改：');
			$this->assign('btnvl','修改');
			$this->display('modify');
		}else if($x=='modifypw'){
			$tcr=M('tcr');
			$tcrid=session('tcridss');
			$mo=$tcr->where('tcrid='.$tcrid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','教师修改密码页面');
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
			
			$ss=M('ss');
			$sso=$ss->where('ssid='.$ssid)->find();
			
			$tcr=M('tcr');
			
			if($vrf!=$sso['ssvrf']){
				//验证码过期
				$errmsg='验证码已过期';
				$this->assign('theme','结果：');
				$this->assign('errmsg',$errmsg);
				$this->display('vrferror');
			}else if(time()-$sso['sstm']>1800){
				//超过30分钟了
				$errmsg='已经超过30分钟，请重新认证';
				$this->assign('theme','结果：');
				$this->assign('errmsg',$errmsg);
				$this->display('vrferror');
			}else{
				$mo=$tcr->where("tcrnm='".$sso['sstcrnm']."'")->find();
				$this->assign('mo',$mo);
				$this->assign('title','教师通过密保修改密码页面');
				$this->assign('theme','修改密码：');
				$this->assign('btnvl','修改');
				$this->display('modifypwml');
			}
			
			
		}
	
	}
	
	
}



?>