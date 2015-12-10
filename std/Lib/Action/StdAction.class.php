<?php 

//规矩：需要display的 就m mls 不需要的 只要stdo stdls 之类，方便批量移植
class StdAction extends Action{
	
	function loginin(){
		header("Content-Type:text/html; charset=utf-8");
		$grd=M('grd');
		$grdls=$grd->order('grdnm DESC')->select();
		
		
		
		
		$stdnm=$_POST['stdnm'];
		$allnm=str_replace('x', 'X', $_POST['allnm']);//替换掉x成大X 反正学号不搞滴，只对idcd影响
		$rmb=$_POST['rmb'];
		
		$findstdls=array();
		for($i=0;$i<count($grdls);$i++){
			$std=M($grdls[$i]['grdnm'].'_std');
			$stdo=$std->join('tb_grd ON f_std_grdid=grdid')->where("stdnm='".$stdnm."'")->find();
			if($stdo){array_push($findstdls, $stdo);}
		}
		
		
		if(count($findstdls)!=0){
			foreach($findstdls as $stdv){
				$std=M($stdv['grdnm'].'_std');
				if($std->where("stdnm='".$stdnm."' AND stdno='".$allnm."' AND f_std_statid=5")->find()){
					$stdo=$std->where("stdnm='".$stdnm."' AND stdno='".$allnm."'")->find();
				
				
					if($rmb=='y'){
						$day=365;
						cookie('grdidck',$stdo['f_std_grdid'],$day*24*3600);
						cookie('stdidck',$stdo['stdid'],$day*24*3600);
					}
					session('grdidss',$stdo['f_std_grdid']);
					session('stdidss',$stdo['stdid']);
					$data['status']=3;
					break;
				
				
				}else if($std->where("stdnm='".$stdnm."' AND stdidcd='".$allnm."'")->find()){
					$stdo=$std->where("stdnm='".$stdnm."' AND stdidcd='".$allnm."'")->find();
				
				
					if($rmb=='y'){
						$day=365;
						cookie('grdidck',$stdo['f_std_grdid'],$day*24*3600);
						cookie('stdidck',$stdo['stdid'],$day*24*3600);
					}
					session('grdidss',$stdo['f_std_grdid']);
					session('stdidss',$stdo['stdid']);
					$data['status']=3;
					break;
				
				
				}else{
					$data['status']=2;
					
				}
			}
			
			
		}else{
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}
		$this->ajaxReturn($data,'json');
	}
	
	function loginout(){
		header("Content-Type:text/html; charset=utf-8");
		
// 		//清空btn表中的数据
// 		$btn=M('btn');
// 		$btn->where('f_btn_stdid='.session('stdidss'))->delete();
		
		session('stdidss',null);
		cookie('stdidck',null);
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	
	
	

	
	function regist(){
		header("Content-Type:text/html; charset=utf-8");
		$stdid=$_GET['stdid'];
	
		
		$std=M('std');
		//先截获数据
		$data=array(
			'stdnm'=>$_POST['stdnm'],
			'stdnn'=>$_POST['stdnn'],
				'f_std_sttid'=>$_POST['f_std_sttid'],
			'stdpw'=>md5($_POST['stdpw']),
			'stdpt'=>$_POST['stdpt'],
			'stdaddtm'=>date("Y-m-d H:i:s",time()),
			'stdmdftm'=>date("Y-m-d H:i:s",time()),
				'stdads'=>$_POST['stdads'],
				'stdtlp'=>$_POST['stdtlp'],
			'stdcp'=>$_POST['stdcp'],
			'stdml'=>$_POST['stdml'],
				'stdintr'=>stripslashes($_POST['stdintr']),
			'stdps'=>$_POST['stdps'],
				'stdvw'=>$_POST['stdvw'],
				'stdodr'=>0,
		);
		//查一查有没有同名学生
		if($std->where("stdnm='".$data['stdnm']."'")->find()){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			if($std->data($data)->add()){
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
		$stdid=$_POST['stdid'];
		
		$std=M('std');
		$stdo=$std->where('stdid='.$stdid)->find();
		//先截获数据
		$data=array(
			'stdnm'=>$_POST['stdnm'],
			'stdnn'=>$_POST['stdnn'],
				'f_std_sttid'=>$_POST['f_std_sttid'],
			'stdpt'=>$_POST['stdpt'],
			'stdmdftm'=>date("Y-m-d H:i:s",time()),
				'stdads'=>$_POST['stdads'],
				'stdtlp'=>$_POST['stdtlp'],
			'stdcp'=>$_POST['stdcp'],
			'stdml'=>$_POST['stdml'],
			'stdintr'=>stripslashes($_POST['stdintr']),
				
		);
		//查一查有没有同名学生
		if($std->where("stdnm='".$data['stdnm']."' AND stdnm<>'".$stdo['stdnm']."'")->find()){
			$data['status']=1;
			$this->ajaxReturn($data,'json');
		}else{
			if($std->where('stdid='.$stdid)->setField($data)){
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
		$stdid=$_POST['stdid'];
		$stdpworg=md5($_POST['stdpworg']);
		$stdpwnew=md5($_POST['stdpwnew']);
		
		$std=M('std');
		//先截获数据
		$data=array(
			'stdpw'=>$stdpwnew
		);
		
		if($std->where("stdid=".$stdid." AND stdpw='".$stdpworg."'")->find()){
			if($std->where('stdid='.$stdid)->setField($data)){
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
	
		$stdnm=$_POST['stdnm'];
		$stdml=$_POST['stdml'];
		$std=M('std');
		if($std->where("stdnm='".$stdnm."'")->find()){
			if($std->where("stdnm='".$stdnm."' AND stdml='".$stdml."'")->find()){
				
				$stdo=$std->where("stdnm='".$stdnm."'")->find();
				
				//由于从邮箱进行点击链接是无法获取session的，所以存sql sql存一个是key 一个是时间戳
				$tm=time();//一样可以保证是同一个tm
				$vrf=md5($stdnm.$tm);
				$ss=M('ss');
				$dt=array(
						ssvrf=>$vrf,
						sstm=>$tm,
						ssstdnm=>$stdnm
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
	
				$address = $stdml;//收件人email
				$mail->AddAddress($address, $stdo['stdnn']);//添加收件人（地址，昵称）
	
				//$mail->AddAttachment('xx.xls','我的附件.xls'); // 添加附件,并指定名称
				//$mail->IsHTML(true); //支持html格式内容
				//$mail->AddEmbeddedImage("logo.jpg", "my-attach", "logo.jpg"); //设置邮件中的图片
				$mail->Body = '你好, 请点击以下链接 http://'.$syso['sysip'].'/'.$syso['sysnm'].'/admin.php/Std/gtxpg/x/modifypwml/ssid/'.$ssid.'/vrf/'.$vrf.' 如果您的邮箱不支持点击链接，那么请您将此链接粘贴至浏览器地址栏进行访问，此邮件30分钟内有效'; //邮件主体内容
	
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
		$stdid=$_POST['stdid'];
	
	
		$stdpwnew=$_POST['stdpwnew'];
	
		$std=M('std');
		$stdo=$std->where('stdid='.$stdid)->find();
		//先截获数据
		$data=array(
				'stdpw'=>$_POST['stdpwnew'],
		);
	
	
		if($std->where('stdid='.$stdid)->setField($data)){
			//搞定的话，就把之前她所有为申请新密码搞来的ss去掉
			$ss=M('ss');
			$ss->where("ssstdnm='".$stdo['stdnm']."'")->delete();
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
		
		
			
		
			
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,qstdery he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Std'")->find();
		
		import('@.KZMB.KZMBAction');
		$kzmb = new KZMBAction();
		$kzmb->setkzmb($mdo['mdid']);
		
		
		//个人行为不参与鉴权
		if($x=='regist'){
			//配置页面显示内容
			$mo['stdid']=0;
			$mo['stdpt']=C('PUBLIC').'/IMG/default.jpg';
			$this->assign('mo',$mo);
			
			$stt=M('stt');
			$sttls=$stt->where('sttactvt=1')->select();
			$this->assign('sttls',$sttls);
			
			$this->assign('title','学生注册页面');
			$this->assign('theme','注册：');
			$this->assign('btnvl','添加');
			$this->display('regist');
		
		}else if($x=='center'){
						
			$grd=M('grd');
			$stdid=session('stdidss');
			$grdid=session('grdidss');
			$grdo=$grd->where('grdid='.$grdid)->find();
			
			$xq=M('xq');
			$xqo=$xq->where('xqdq=1')->find();
			$xqid=$xqo['xqid'];
			
			$std=M($grdo['grdnm'].'_std')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
			$mo=$std
			->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')
			->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND stdid=".$stdid)
			->find();
			
			
			
			$this->assign('title','学生中心');
			$this->assign('theme','学生中心：');
			$this->assign('mo',$mo);
			$this->display('center');
		}else if($x=='modify'){
			$std=M('std');
			$stdid=session('stdidss');
			$mo=$std->where('stdid='.$stdid)->find();
			$this->assign('mo',$mo);
			
			$stt=M('stt');
			$sttls=$stt->where('sttactvt=1')->select();
			$this->assign('sttls',$sttls);
			
			$this->assign('title','学生修改页面');
			$this->assign('theme','修改：');
			$this->assign('btnvl','修改');
			$this->display('modify');
		}else if($x=='modifypw'){
			$std=M('std');
			$stdid=session('stdidss');
			$mo=$std->where('stdid='.$stdid)->find();
			$this->assign('mo',$mo);
			$this->assign('title','学生修改密码页面');
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
			
			$std=M('std');
			
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
				$mo=$std->where("stdnm='".$sso['ssstdnm']."'")->find();
				$this->assign('mo',$mo);
				$this->assign('title','学生通过密保修改密码页面');
				$this->assign('theme','修改密码：');
				$this->assign('btnvl','修改');
				$this->display('modifypwml');
			}
			
			
		}
	
	}
	
	
}



?>