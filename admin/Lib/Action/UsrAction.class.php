<?php 

//规矩：需要display的 就m mls 不需要的 只要usro usrls 之类，方便批量移植
class UsrAction extends Action{
	
	function loginin(){
		header("Content-Type:text/html; charset=utf-8");
		$usr=M('usr');
		$usrnm=$_POST['usrnm'];
		$usrpw=md5($_POST['usrpw']);
		$rmb=$_POST['rmb'];
		
		if($usr->where("usrnm='".$usrnm."'")->find()){
			
			if($usr->where("usrnm='".$usrnm."' AND usrpw='".$usrpw."'")->find()){
				$usro=$usr->where("usrnm='".$usrnm."' AND usrpw='".$usrpw."'")->find();
				
				if($usro['usrps']==1){
					if($rmb=='y'){
						$day=365;
						cookie('usridck',$usro['usrid'],$day*24*3600);
					}
					
					session('usridss',$usro['usrid']);
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
// 		$btn->where('f_btn_usrid='.session('usridss'))->delete();
		
		session('usridss',null);
		cookie('usridck',null);
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	
	
	

	
	function regist(){
		header("Content-Type:text/html; charset=utf-8");
		$usrid=$_GET['usrid'];
	
		
		$usr=M('usr');
		//先截获数据
		$data=array(
			'usrnm'=>$_POST['usrnm'],
			'usrnn'=>$_POST['usrnn'],
				'f_usr_sttid'=>$_POST['f_usr_sttid'],
			'usrpw'=>md5($_POST['usrpw']),
			'usrpt'=>$_POST['usrpt'],
			'usraddtm'=>date("Y-m-d H:i:s",time()),
			'usrmdftm'=>date("Y-m-d H:i:s",time()),
				'usrads'=>$_POST['usrads'],
				'usrtlp'=>$_POST['usrtlp'],
			'usrcp'=>$_POST['usrcp'],
			'usrml'=>$_POST['usrml'],
				'usrintr'=>stripslashes($_POST['usrintr']),
			'usrps'=>$_POST['usrps'],
				'usrvw'=>$_POST['usrvw'],
				'usrodr'=>0,
		);
		//查一查有没有同名用户
		if($usr->where("usrnm='".$data['usrnm']."'")->find()){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			if($usr->data($data)->add()){
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
		$usrid=$_POST['usrid'];
		
		$usr=M('usr');
		$usro=$usr->where('usrid='.$usrid)->find();
		//先截获数据
		$data=array(
			'usrnm'=>$_POST['usrnm'],
			'usrnn'=>$_POST['usrnn'],
				//'f_usr_sttid'=>$_POST['f_usr_sttid'],
			'usrpt'=>$_POST['usrpt'],
			'usrmdftm'=>date("Y-m-d H:i:s",time()),
				'usrads'=>$_POST['usrads'],
				'usrtlp'=>$_POST['usrtlp'],
			'usrcp'=>$_POST['usrcp'],
			'usrml'=>$_POST['usrml'],
			'usrintr'=>stripslashes($_POST['usrintr']),
				
		);
		//查一查有没有同名用户
		if($usr->where("usrnm='".$data['usrnm']."' AND usrnm<>'".$usro['usrnm']."'")->find()){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			if($usr->where('usrid='.$usrid)->setField($data)){
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
		$usrid=$_POST['usrid'];
		$usrpworg=md5($_POST['usrpworg']);
		$usrpwnew=md5($_POST['usrpwnew']);
		
		$usr=M('usr');
		//先截获数据
		$data=array(
			'usrpw'=>$usrpwnew
		);
		
		if($usr->where("usrid=".$usrid." AND usrpw='".$usrpworg."'")->find()){
			if($usr->where('usrid='.$usrid)->setField($data)){
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
	
		$usrnm=$_POST['usrnm'];
		$usrml=$_POST['usrml'];
		$usr=M('usr');
		if($usr->where("usrnm='".$usrnm."'")->find()){
			if($usr->where("usrnm='".$usrnm."' AND usrml='".$usrml."'")->find()){
				
				$usro=$usr->where("usrnm='".$usrnm."'")->find();
				
				//由于从邮箱进行点击链接是无法获取session的，所以存sql sql存一个是key 一个是时间戳
				$tm=time();//一样可以保证是同一个tm
				$vrf=md5($usrnm.$tm);
				$ss=M('ss');
				$dt=array(
						ssvrf=>$vrf,
						sstm=>$tm,
						ssusrnm=>$usrnm
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
	
				$address = $usrml;//收件人email
				$mail->AddAddress($address, $usro['usrnn']);//添加收件人（地址，昵称）
	
				//$mail->AddAttachment('xx.xls','我的附件.xls'); // 添加附件,并指定名称
				//$mail->IsHTML(true); //支持html格式内容
				//$mail->AddEmbeddedImage("logo.jpg", "my-attach", "logo.jpg"); //设置邮件中的图片
				$mail->Body = '你好, 请点击以下链接 http://'.$syso['sysip'].'/'.$syso['sysnm'].'/admin.php/Usr/gtxpg/x/modifypwml/ssid/'.$ssid.'/vrf/'.$vrf.' 如果您的邮箱不支持点击链接，那么请您将此链接粘贴至浏览器地址栏进行访问，此邮件30分钟内有效'; //邮件主体内容
	
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
		$usrid=$_POST['usrid'];
	
	
		$usrpwnew=$_POST['usrpwnew'];
	
		$usr=M('usr');
		$usro=$usr->where('usrid='.$usrid)->find();
		//先截获数据
		$data=array(
				'usrpw'=>$_POST['usrpwnew'],
		);
	
	
		if($usr->where('usrid='.$usrid)->setField($data)){
			//搞定的话，就把之前她所有为申请新密码搞来的ss去掉
			$ss=M('ss');
			$ss->where("ssusrnm='".$usro['usrnm']."'")->delete();
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
		
		
			
		
			
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,qusrery he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Usr'")->find();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		
		//个人行为不参与鉴权
		if($x=='regist'){
			//配置页面显示内容
			$mo['usrid']=0;
			$mo['usrpt']=C('PUBLIC').'/IMG/default.jpg';
			$this->assign('mo',$mo);
			
			$stt=M('stt');
			$sttls=$stt->where('sttactvt=1')->select();
			$this->assign('sttls',$sttls);
			
			$this->assign('title','用户注册页面');
			$this->assign('theme','注册：');
			$this->assign('btnvl','添加');
			$this->display('regist');
		
		}else if($x=='center'){
			$usrid=session('usridss');
			$usr=M('usr');
			
			$mo=$usr->join('tb_stt ON f_usr_sttid=sttid')->where('usrid='.$usrid)->find();
			//以后扩展看是在哪个grp哪个角色
			//$mo=$usr->join('tb_ath ON f_usr_athid=athid')->where('usrid='.$usrid)->find();
		
// 			if($mo['f_usr_athid']==0){
// 				$mo['athnm']='无权限';
// 			}

			if($mo['usrps']==1){
				$mo['usrps']='用户状态正常';
			}else{
				$mo['usrps']='用户状态冻结';
			}
			
			
			$this->assign('title','用户中心');
			$this->assign('theme','用户中心：');
			$this->assign('mo',$mo);
			$this->display('center');
		}else if($x=='modify'){
			$usr=M('usr');
			$usrid=session('usridss');
			$mo=$usr->where('usrid='.$usrid)->find();
			$this->assign('mo',$mo);
			
			$stt=M('stt');
			$sttls=$stt->where('sttactvt=1')->select();
			$this->assign('sttls',$sttls);
			
			$this->assign('title','用户修改页面');
			$this->assign('theme','修改：');
			$this->assign('btnvl','修改');
			$this->display('modify');
		}else if($x=='modifypw'){
			$usr=M('usr');
			$usrid=session('usridss');
			$mo=$usr->where('usrid='.$usrid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','用户修改密码页面');
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
			
			$usr=M('usr');
			
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
				$mo=$usr->where("usrnm='".$sso['ssusrnm']."'")->find();
				$this->assign('mo',$mo);
				$this->assign('title','用户通过密保修改密码页面');
				$this->assign('theme','修改密码：');
				$this->assign('btnvl','修改');
				$this->display('modifypwml');
			}
			
			
		}else{
		
			//鉴权II
			import('@.IDTATH.IdtathAction');
			$Idtath = new IdtathAction();
			$athofn=$Idtath->identify($mdo['mdid'],$x);
			
			//NTF自带鉴权功能
			import('@.NTF.NTFAction');
			$ntf = new NTFAction();
			$ntf->setntf();
			
			if($x=='vw'){
				$usrid=$_GET['usrid'];
				$usr=M('usr');
				$mo=$usr->join('tb_stt ON f_usr_sttid=sttid')->where("usrid=".$usrid)->find();
				
				
				$this->assign('mo',$mo);
				$this->assign('title','查看');
				$this->assign('theme','查看详细');
				$this->assign('btnvl','设置');
				$this->display('view');
			}else if($x=='updt'){
				$usrid=$_GET['usrid'];
				$usr=M('usr');
				if($usrid==0){
					$mo['usrid']=0;
					$mo['usrvw']=0;
					$mo['usrps']=0;
					$mo['usrpt']=C('PUBLIC').'/IMG/default.jpg';
					
					$stt=M('stt');
					$sttls=$stt->where('sttactvt=1')->select();
					$this->assign('sttls',$sttls);
					
					$this->assign('title','添加');
					$this->assign('theme','添加：');
					$this->assign('btnvl','添加');
				}else{
					$mo=$usr->where("usrid=".$usrid)->find();
					$this->assign('nmrdol','readonly');
					
					$stt=M('stt');
					$sttls=$stt->where('sttactvt=1')->select();
					$this->assign('sttls',$sttls);
					
					$this->assign('title','修改');
					$this->assign('theme','修改：');
					$this->assign('btnvl','修改');
				}
				$this->assign('mo',$mo);
				
				$this->display('update');
			}
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
		$mdo=$mdII->where("mdmk='Usr'")->find();
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
		$usr=M('usr');
		$fldint='-usrid-usrnm-usrnn-sttnm-usrads-usrtlp-usrcp-usrml-usrps-usrvw-';
		if($athofn['aths']==1){
			$cdtint="-sp-";
		}else{
			$cdtint='-sp-usrps-eq-1-sp-usrvw-eq-1-sp-';
		}
		$spccdtint='-sp-';////
		$odrint='-usraddtm DESC-';
		$lmtint=20;
		$jn='tb_stt ON f_usr_sttid=sttid';
		//$jn='tb_ath ON f_usr_athid=athid-jn-tb_atc ON f_usr_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($usr,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($usr,$fldint,$cdtint,$odrint,$lmtint,$jn);

		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['usrps']==1){
				$v['usrps']='是';
			}else{
				$v['usrps']='否';
			}
			if($v['usrvw']==1){
				$v['usrvw']='是';
			}else{
				$v['usrvw']='否';
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
		
		$stt=M('stt');
		$sttls=$stt->where('sttactvt=1')->select();
		$this->assign('sttls',$sttls);
		
		//q特殊
		$this->assign('title','浏览用户列表');
		$this->assign('theme','用户管理');
		
		$this->display('query');
	}
	
	function update(){
		header("Content-Type:text/html; charset=utf-8");
		$usrid=$_POST['usrid'];
	
		if($usrid==0){
			$usr=M('usr');
			//先截获数据
			$data=array(
				'usrnm'=>$_POST['usrnm'],
				'usrnn'=>$_POST['usrnn'],
					'f_usr_sttid'=>$_POST['f_usr_sttid'],
				'usrpw'=>md5($_POST['usrpw']),
				'usrpt'=>$_POST['usrpt'],
				'usraddtm'=>date("Y-m-d H:i:s",time()),
				'usrmdftm'=>date("Y-m-d H:i:s",time()),
					'usrads'=>$_POST['usrads'],
					'usrtlp'=>$_POST['usrtlp'],
				'usrcp'=>$_POST['usrcp'],
				'usrml'=>$_POST['usrml'],
					'usrintr'=>stripslashes($_POST['usrintr']),
				'usrps'=>$_POST['usrps'],
					'usrvw'=>$_POST['usrvw'],
					'usrodr'=>$_POST['usrodr'],
			);
			//查一查有没有同名用户
			if($usr->where("usrnm='".$data['usrnm']."'")->find()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				if($usr->data($data)->add()){
// 					//添加成功后给用户用上默认的分组和权限
// 					$usro=$usr->order('usrid DESC')->find();
// 					$usrgrp=M('usrgrp');
// 					$dt=array('f_usrgrp_usrid'=>$usro['usrid'],'f_usrgrp_grpid'=>2);
// 					$usrgrp->data($dt)->add();
// 					//----------
// 					$usrrl=M('usrrl');
// 					$dt=array('f_usrrl_usrid'=>$usro['usrid'],'f_usrrl_grpid'=>2);
// 					$usrrl->data($dt)->add();
					
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=3;
					$this->ajaxReturn($data,'json');
				}
			}
		}else{
			$usr=M('usr');
			//先截获数据
			$usro=$usr->where('usrid='.$usrid)->find();
			$data=array(
				'usrnm'=>$_POST['usrnm'],
				'usrnn'=>$_POST['usrnn'],
					'f_usr_sttid'=>$_POST['f_usr_sttid'],
				'usrpw'=>md5($_POST['usrpw']),
				'usrpt'=>$_POST['usrpt'],
				'usraddtm'=>date("Y-m-d H:i:s",time()),
				'usrmdftm'=>date("Y-m-d H:i:s",time()),
					'usrads'=>$_POST['usrads'],
					'usrtlp'=>$_POST['usrtlp'],
				'usrcp'=>$_POST['usrcp'],
				'usrml'=>$_POST['usrml'],
					'usrintr'=>stripslashes($_POST['usrintr']),
				'usrps'=>$_POST['usrps'],
					'usrvw'=>$_POST['usrvw'],
					'usrodr'=>$_POST['usrodr'],
			);
			//查一查有没有同名用户
			if($usr->where("usrnm='".$data['usrnm']."' AND usrnm <>'".$usro['usrnm']."'")->find()){
				$data['status']=1;
				$this->ajaxReturn($data,'json');
			}else{
				if($usr->where('usrid='.$usrid)->setField($data)){
					$data['status']=2;
					$this->ajaxReturn($data,'json');
				}else{
					$data['status']=3;
					$this->ajaxReturn($data,'json');
				}
			}
		}
	}
	
	function delete(){
		$usrid=$_POST['usrid'];
		
		$usrgrp=M('usrgrp');
		$usrgrp->where('f_usrgrp_usrid='.$usrid)->delete();
		
		$usrrl=M('usrrl');
		$usrrl->where('f_usrrl_usrid='.$usrid)->delete();
		
		$atcclct=M('atcclct');
		$atcclct->where('f_atcclct_usrid='.$usrid)->delete();
		
		$cmt=M('cmt');
		$cmt->where('f_cmt_usrid='.$usrid)->delete();
		
		$btn=M('btn');
		$btn->where('f_btn_usrid='.$usrid)->delete();
				
		$usr=M('usr');
		if($usr->delete($_POST['usrid'])){
			//$this->success('删除成功');
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($usr->getLastSql());
		}
	}
	
	function set(){
		header("Content-Type:text/html; charset=utf-8");
		$usrid=$_POST['usrid'];
	
	
		$usr=M('usr');
		//先截获数据
			
		$data=array(
				'usrps'=>$_POST['usrps'],
				'usrvw'=>$_POST['usrvw'],
		);
			
		if($usr->where('usrid='.$usrid)->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
		}
	
	
	}
	
	function setview(){
	
		$usr=M('usr');
		$data=array(
				'usrvw'=>$_POST['usrvw']
		);
		if($usr->where('usrid='.$_POST['usrid'])->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function setpass(){
	
		$usr=M('usr');
		$data=array(
				'usrps'=>$_POST['usrps']
		);
		if($usr->where('usrid='.$_POST['usrid'])->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function resetpassword(){
	
		$usr=M('usr');
		$data=array(
				'usrpw'=>md5('11111111')
		);
		if($usr->where('usrid='.$_POST['usrid'])->setField($data)){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			$data['status']=2;
			$this->ajaxReturn($data,'json');
			//$this->error($u->getLastSql());
		}
	}
	
	function notify(){
		header("Content-Type:text/html; charset=utf-8");
	
		//先给hd设置好些东西，他自身是无法提取的
		import('@.SS.SSAction');
		$ss = new SSAction();
		$ss->setss();
	
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Usr'")->find();
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
		$usr=M('usr');
		$fldint='-usrid-usrnm-usrnn-usraddtm-usrmdftm-usrcp-usrml-usrps-usrvw-';
		$cdtint="-sp-usrvw-eq-0-sp-";
		
		$spccdtint='-sp-';////
		$odrint='-usraddtm DESC-';
		$lmtint=20;
		$jn='';
		//$jn='tb_ath ON f_usr_athid=athid-jn-tb_atc ON f_usr_athid=atcid';//若出现多个join
		import('@.NB.NBAction');
		$NB = new NBAction();
		$arr=$NB->NB($usr,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn);////
// 		$arr=NB($usr,$fldint,$cdtint,$odrint,$lmtint,$jn);

		//1、0是否化
		$mls=$arr['mls'];
		$mlsfn=array();
		foreach($mls as $v){
			if($v['usrps']==1){
				$v['usrps']='是';
			}else{
				$v['usrps']='否';
			}
			if($v['usrvw']==1){
				$v['usrvw']='是';
			}else{
				$v['usrvw']='否';
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
		$this->assign('title','浏览用户列表');
		$this->assign('theme','未查看用户');
	
		$this->display('notify');
	}
}



?>