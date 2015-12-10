<?php
class NBAction extends Action{
	function NBsrc($fld,$cdt,$spccdt,$odr){
		$fldpcd=array();
		$epldfld=explode('-', $fld);
		for($i=1;$i<count($epldfld)-1;$i++){
			array_push($fldpcd, $epldfld[$i]);
		}
	
		$cdtpcd='1=1';
		$epldcdt=explode('-sp-', $cdt);
		for($i=1;$i<count($epldcdt)-1;$i++){
				
			if(preg_match("/-lk-/", $epldcdt[$i])){
				$epldlk=explode('-lk-', $epldcdt[$i]);
				//$epldrpl=str_replace(trim($epldlk[1]),"'%".trim($epldlk[1])."%'",$epldcdt[$i]);
				$cdtpcd=$cdtpcd.' AND '.$epldlk[0].' '.'LIKE'." '%".$epldlk[1]."%'";
			}else if(preg_match("/-eq-/", $epldcdt[$i])){
				$epldeq=explode('-eq-', $epldcdt[$i]);
				$cdtpcd=$cdtpcd.' AND '.$epldeq[0].'='.$epldeq[1];
			}
				
		}
		$spccdtpcd='';
		$epldspccdt=explode('-sp-', $spccdt);
		for($i=1;$i<count($epldspccdt)-1;$i++){
			$spccdtpcd=$spccdtpcd.' AND '.$epldspccdt[$i];
		}
		
		$epldodr=explode('-', $odr);
		for($i=1;$i<count($epldodr)-1;$i++){
			if($i==count($epldodr)-2){
				$odrpcd=$odrpcd.$epldodr[$i];
			}else{
				$odrpcd=$odrpcd.$epldodr[$i].',';
			}
		}
		$arr['fldpcd']=$fldpcd;
		$arr['cdtpcd']=$cdtpcd;
		$arr['spccdtpcd']=$spccdtpcd;
		$arr['odrpcd']=$odrpcd;
	
		return $arr;
	}
	
	function NB($m,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn,$lsyon,$tkpg){//默认$lsyon为n，即不需要全ls tkpg考虑POST或者GET，如果不考虑，适合用int来管控
		
	
		if($_POST['NBsqlstc']||$_GET['NBsqlstc']){
			if($_POST['NBsqlstc']){
				$sqlstc=stripcslashes($_POST['NBsqlstc']);
			}else{
				$sqlstc=stripcslashes($_GET['NBsqlstc']);
					
				//反解密
				$sqlstc=str_replace('-pct-', '%', $sqlstc);
				$sqlstc=str_replace('-ls-', '<', $sqlstc);
				$sqlstc=str_replace('-mr-', '>', $sqlstc);
				$sqlstc=str_replace('-kb-', ' ', $sqlstc);
			}
			
			
	
			//先处理fld
			$epldtmp=explode('SELECT', $sqlstc);
			$epldtmp=explode('FROM', $epldtmp[1]);
			if(trim($epldtmp[0])=='*'){
				$fld=$fldint;
			}else{
				$epldtmp=explode(',', trim($epldtmp[0]));
				$fld='-';
				for($i=0;$i<count($epldtmp);$i++){
					$fld=$fld.$epldtmp[$i].'-';
				}
			}
			
		
		
			//处理cdt和spccdt
			$epldtmp=explode('WHERE', $sqlstc);
			$epldtmp=explode('ORDER', $epldtmp[1]);
			$epldtmp=explode('AND', trim($epldtmp[0]));
			$cdt='-sp-';$spccdt='-sp-';
			for($i=0;$i<count($epldtmp);$i++){
				$tmpA=trim($epldtmp[$i]);
				if($tmpA!='1=1'){
					if(preg_match("/\\(/", $tmpA)){//特殊优先被截获 正则匹配
						$spccdt=$spccdt.$tmpA.'-sp-';
					}else{
						if(preg_match("/LIKE/", $tmpA)){
							$tmpB=explode('LIKE', $tmpA);
							$cdt=$cdt.trim($tmpB[0]).'-lk-';
							$tmpC=explode('%', trim($tmpB[1]));
							$tmpC=explode('%', $tmpC[1]);
							$cdt=$cdt.$tmpC[0].'-sp-';
						}
						if(preg_match("/=/", $tmpA)){
							$tmpB=explode('=', $tmpA);
							$cdt=$cdt.$tmpB[0].'-eq-'.$tmpB[1].'-sp-';
						}
					}
				}
			}
			//处理odr
			$epldtmp=explode('ORDER BY', $sqlstc);
			$epldtmp=explode('LIMIT', $epldtmp[1]);
			$epldtmp=explode(',', trim($epldtmp[0]));
			$odr='-';
			for($i=0;$i<count($epldtmp);$i++){
				$odr=$odr.$epldtmp[$i].'-';
			}
			
			//最后处理LIMIT
	
			$epldtmp=explode('LIMIT', $sqlstc);
			if($lsyon=='y'){
				$mlsforcount=$m->query(trim($epldtmp[0]));
			}
			$epldtmp=str_replace('SELECT *', 'SELECT COUNT(*) AS cnt', $epldtmp);
			$mrslt=$m->query(trim($epldtmp[0]));
			$cnt=$mrslt[0]['cnt'];
			
			
			if(trim($epldtmp[1])){
				$epldtmp=explode(',', trim($epldtmp[1]));
				$lmt=$epldtmp[1];
			}else{
				$lmt=$lmtint;
			}
	
	
	
		}else{
			//---------NB start
			$fld=$fldint;
			$cdt=$cdtint;
			$spccdt=$spccdtint;
			$odr=$odrint;
			$lmt=$lmtint;
			if($tkpg!='n'){
				if($_POST['fld']){
					$fld=$_POST['fld'];
				}else if($_GET['fld']){
					$fld=$_GET['fld'];
				}
				if($_POST['cdt']){
					$cdt=$_POST['cdt'];
				}else if($_GET['cdt']){
					$cdt=$_GET['cdt'];
				}
				if($_POST['spccdt']){
					$spccdt=$_POST['spccdt'];
				}else if($_GET['spccdt']){
					$spccdt=$_GET['spccdt'];
				}
				if($_POST['odr']){
					$odr=$_POST['odr'];
				}else if($_GET['odr']){
					$odr=$_GET['odr'];//p($odr);
				}
				if($_POST['lmt']){
					$lmt=$_POST['lmt'];
				}else if($_GET['lmt']){
					$lmt=$_GET['lmt'];//p($lmt);
				}
					
				//反解密
				$spccdt=str_replace('-pct-', '%', $spccdt);
				$spccdt=str_replace('-ls-', '<', $spccdt);
				$spccdt=str_replace('-mr-', '>', $spccdt);
				$spccdt=str_replace('-kb-', ' ', $spccdt);
			}
			
			
			$NBarr=$this->NBsrc($fld, $cdt,$spccdt, $odr);
			$fldpcd=$NBarr['fldpcd'];
			$cdtpcd=$NBarr['cdtpcd'];
			$spccdtpcd=$NBarr['spccdtpcd'];
			$odrpcd=$NBarr['odrpcd'];
			//---------NB over
			//如果出现多个join
			$jnu=explode('-jn-', $jn);
			$mtmp=clone $m;
			for($i=0;$i<count($jnu);$i++){
				$mtmp=$mtmp->join($jnu[$i]);
			}
			if($lsyon=='y'){
				$mlsforcount=$mtmp->field($fldpcd)->where($cdtpcd.$spccdtpcd)->order($odrpcd)->select();
				$cnt=count($mlsforcount);
			}else{
				$cnt=$mtmp->field($fldpcd)->where($cdtpcd.$spccdtpcd)->order($odrpcd)->count();
			}
			
			
		}
		$count=$cnt;
		
		//分页显示列表，每页8条
		import('ORG.Util.Page');
		$page=new Page($count,$lmt);//后台管理页面默认一页显示N条记录
		$page->setConfig('prev', "&laquo; 上一页");//上一页
		$page->setConfig('next', '下一页 &raquo;');//下一页
		$page->setConfig('first', '&laquo; 首页');//第一页
		$page->setConfig('last', '末页 &raquo;');//最后一页
		$page->setConfig('theme','共%totalPage%页/%totalRow%%header% %first% %upPage%  %linkPage%  %downPage% %end%');
		//设置分页回调方法
		$show=$page->show();
	
		if($sqlstc){
			$epldtmp=explode('LIMIT', $sqlstc);
			if(trim($epldtmp[1])){//如果有LIMIT,那就替换
				$sqlstc=str_replace('LIMIT '.trim($epldtmp[1]), 'LIMIT '.$page->firstRow.','.$lmt, $sqlstc);
			}else{//没有LIMIT 就加上
				$sqlstc=$sqlstc.' LIMIT 0,'.$lmtint;
			}
	
			$mls=$m->query($sqlstc);
		}else{
			//如果出现多个join
			$jnu=explode('-jn-', $jn);
			$mtmp=clone $m;
			for($i=0;$i<count($jnu);$i++){
				$mtmp=$mtmp->join($jnu[$i]);
			}
			$mls=$mtmp->field($fldpcd)->where($cdtpcd.$spccdtpcd)->order($odrpcd)->limit($page->firstRow.','.$page->listRows)->select();
		}
		
		//给show去掉转义的东西
		if(preg_match("/cdt/",$show)){
			$epldtmp=explode("/cdt/", $show);
			$epldtmp=explode('/spccdt/', $epldtmp[1]);
			$show=str_replace($epldtmp[0], $cdt, $show);
			//然后把odr里面的+去掉吧
			if(preg_match("/odr/",$show)){
				$epldtmp=explode("/odr/", $show);
				$epldtmp=explode('/lmt/', $epldtmp[1]);
				$show=str_replace($epldtmp[0], $odr, $show);
			}
		}else if(preg_match("/NBsqlstc/",$show)){
			//先把show里面滴单引号都变成双引号
			$show=str_replace("'", "\"", $show);
			$epldtmp=explode("/NBsqlstc/", $show);
			$epldtmp=explode('/p/', $epldtmp[1]);//p($epldtmp[0]);p($sqlstc);p($show);die;
			$show=str_replace($epldtmp[0], $sqlstc, $show);
			//由于双引号里面%<>php无法理解，所以给%加密
			$show=str_replace("%", "-pct-", $show);
			//拆分$show 把 href中的提取出来
			$tmp=explode('href', $show);
			for($i=1;$i<count($tmp);$i++){
				$tmpII=explode('html', $tmp[$i]);
				$org=$tmpII[0];
				$nw=str_replace("<", "-ls-", $org);
				$nw=str_replace(">", "-mr-", $nw);
				$nw=str_replace(" ", "-kb-", $nw);
				$show=str_replace($org, $nw, $show);
			}
			//$show=str_replace("<", "-ls-", $show);
			//$show=str_replace(">", "-mr-", $show);
		}
		
		$show=str_replace("<a>", "&nbsp;<a>", $show);
		$show=str_replace("</a>", "</a>&nbsp;", $show);
		$show=str_replace("<span>", "&nbsp;<span>", $show);
		$show=str_replace("</span>", "</span>&nbsp;", $show);
		
		$arr['fstrw']=$page->firstRow;
		$arr['sqlstc']=$sqlstc;
		$arr['fld']=$fld;
		$arr['cdt']=$cdt;
		$arr['spccdt']=$spccdt;
		$arr['odr']=$odr;
		$arr['lmt']=$lmt;
		$arr['count']=$count;
		$arr['mls']=$mls;
		$arr['page_method']=$show;
		$arr['mlsforcount']=$mlsforcount;
		return $arr;
	}
}
?>