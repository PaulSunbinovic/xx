<?php
// 本类由系统自动生成，仅供测试用途
class XlsAction extends Action {
    public function output(){
    	//先去数据库找出你要让哪些数据出来
    	header("Content-Type:text/html; charset=utf-8");
    	$mk=$_POST['mk'];
    	if($mk=='usr'){
    		$jn='';
    		$fldint='-usrid-usrnm-usrnn-usraddtm-usrmdftm-usrcp-usrml-usrps-usrvw-';
    		$jsn=array(
    				'usrnm'=>'用户名',
    				'usrnn'=>'用户昵称',
    				'usraddtm'=>'添加时间',
    				'usrmdftm'=>'修改时间',
    				'usrcp'=>'用户手机',
    				'usrml'=>'用户邮箱',
    				'usrps'=>'是否通过',
    				'usrvw'=>'是否查看'
    		);
    	}
    	if($mk=='cstmusr'){
    		$jn='';
    		$fldint='-cstmusrid-cstmusrnm-cstmusrnn-cstmusraddtm-cstmusrmdftm-cstmusrcp-cstmusrml-cstmusrps-cstmusrvw-';
    		$jsn=array(
    				'usrnm'=>'客户用户名',
    				'usrnn'=>'客户用户昵称',
    				'usraddtm'=>'客户添加时间',
    				'usrmdftm'=>'客户修改时间',
    				'usrcp'=>'客户用户手机',
    				'usrml'=>'客户用户邮箱',
    				'usrps'=>'客户是否通过',
    				'usrps'=>'客户是否查看'
    		);
    	}
    	
    	
    	
    	
    	if(preg_match('/std/',$mk)){
    		$tmp=explode('_', $mk);
    		$grdnm=$tmp[0];
    		$jn='tb_stt ON f_std_sttid=sttid-jn-tb_grd ON f_std_grdid=grdid-jn-tb_'.$grdnm.'_mj ON f_stdxqmj_mjid=mjid-jn-tb_bxxs ON f_mj_bxxsid=bxxsid-jn-tb_cc ON f_mj_ccid=ccid-jn-tb_kl ON f_mj_klid=klid-jn-tb_xxxs ON f_mj_xxxsid=xxxsid-jn-tb_zsfw ON f_mj_zsfwid=zsfwid-jn-tb_xz ON f_mj_xzid=xzid-jn-tb_'.$grdnm.'_cls ON f_stdxqcls_clsid=clsid-jn-tb_dm ON f_stdxqdm_dmid=dmid-jn-tb_sex ON f_std_sexid=sexid-jn-tb_rc ON f_std_rcid=rcid-jn-tb_zzmm ON f_std_zzmmid=zzmmid-jn-tb_xl ON f_std_xlid=xlid-jn-tb_stat ON f_std_statid=statid-jn-tb_xq ON f_stdxqcls_xqid=xqid';
    		$fldint='-stdid-bxxsnm-sttnm-grdnm-clsnm-stdaplno-stdno-stdnm-sexnm-mjnm-statnm-';
    		$jsn=array(
    				'bxxsnm'=>'办学形式',
    				'sttnm'=>'站点',
    				'grdnm'=>'年级',
    				'stdaplno'=>'报名号',
    				'stdno'=>'学号',
    				'stdupfnctm'=>'上传财务时间',
    				'stdnm'=>'姓名',
    				'clsnm'=>'班级',
    				'dmnm'=>'寝室',
    				'sexnm'=>'性别',
    				'rcnm'=>'民族',
    				'zzmmnm'=>'政治面貌',
    				'stdnp'=>'籍贯',
    				'stdbtd'=>'出生日期',
    				'stdsol'=>'文理科',
    				'stdcee'=>'高考成绩',
    				'stdsog'=>'毕业学校',
    				'stdqq'=>'QQ',
    				'xlnm'=>'最高学历',
    				'stdidcd'=>'身份证号码',
    				'stdcp'=>'手机号码',
    				'stdrlta'=>'家长一',
    				'stdrltanm'=>'家长一姓名',
    				'stdrltaocpt'=>'家长一职业',
    				'stdrltacp'=>'家长一手机号',
    				'stdrltb'=>'家长二',
    				'stdrltbnm'=>'家长二姓名',
    				'stdrltbocpt'=>'家长二职业',
    				'stdrltbcp'=>'家长二手机号',
    				'stdhb'=>'爱好',
    				'mjnm'=>'专业',
    				'statnm'=>'状态',
    				'stdpst'=>'邮编',
    				'stdads'=>'家庭地址',
    				'stdmdftm'=>'修改时间',
    				'stdaddtm'=>'添加时间',
    				'stdtlp'=>'固话',
    				'stdpertm'=>'预录取时间',
    				'stdertm'=>'录取时间',
    				'stdicbc'=>'工行卡号',
    				'stdrcmdnm'=>'推荐人姓名',
    				'stdrcmdcp'=>'推荐人手机号',
    				'stdpnttm'=>'信息打印时间',
    		);
    		$spcjn='std';
    	}
    	//NB初始化，开始
    	$m=M($mk);
    	if($spcjn){
    		if($spcjn=='std'){
    			$m->join('inner join tb_'.$grdnm.'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdnm.'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdnm.'_stdxqmj ON stdid=f_stdxqmj_stdid');
    		}
    	}
    	
    	$cdtint="-sp-";
    	$spccdtint='-sp-';
    	$odrint='-';
    	$lmtint=20;
    	//$jn='tb_ath ON f_athid=athid-jn-tb_atc ON f_athid=atcid';//若出现多个join
    	import('@.NB.NBAction');
    	$NB = new NBAction();
    	$arr=$NB->NB($m,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn,'y');
    	$fld=$arr['fld'];
    	$mlsall=$arr['mlsforcount'];
    	for($i=0;$i<count($mlsall);$i++){
    		$mlsall[$i]['usrps']=$mlsall[$i]['usrps']==1?'是':'否';
    	}
    	
    	
    	
    	import('@.ORG.PHPExcel');
    	// Create new PHPExcel object
    	$objPHPExcel = new PHPExcel();
    	// Set properties
    	$objPHPExcel->getProperties()->setCreator("ctos")
    	->setLastModifiedBy("ctos")
    	->setTitle("Office 2007 XLSX Test Document")
    	->setSubject("Office 2007 XLSX Test Document")
    	->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    	->setKeywords("office 2007 openxml php")
    	->setCategory("Test result file");
    	
//     	//set width
//     	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
//     	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
//     	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
//     	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
//     	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
//     	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
//     	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
//     	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
//     	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
//     	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
    	
//     	//设置行高度
//     	$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);
    	
//     	$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
    	
//     	//set font size bold
//     	$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
//     	$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getFont()->setBold(true);
    	
//     	$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//     	$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	
//     	//设置水平居中
//     	$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
//     	$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//     	$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//     	$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//     	$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//     	$objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//     	$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//     	$objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    	
//     	//合并cell
//     	$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
    	
    	// set table header content列是从0开始，行是从1开始
    	$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
    	$sheet=$objPHPExcel->setActiveSheetIndex(0);
    	$sheet=$sheet->setCellValueByColumnAndRow(0,1,'序号');
    	$fldu=explode('-', $fld);
    	for($i=2;$i<count($fldu)-1;$i++){
    		$sheet=$sheet->setCellValueByColumnAndRow($i-1,1,$jsn[$fldu[$i]]);
    	}
    	
    	
    	//Miscellaneous glyphs, UTF-8
    	for($j=0;$j<count($mlsall);$j++){
    		$m=$mlsall[$j];
    		$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
    		for($i=2;$i<count($fldu)-1;$i++){
    			$sheet=$sheet->setCellValueByColumnAndRow($i-1,$j+2,$m[$fldu[$i]].' ');
    		}
 	   	}
    	
    	
    	//  sheet命名
    	//$objPHPExcel->getActiveSheet()->setTitle('订单汇总表');
    	
    	
    	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    	$objPHPExcel->setActiveSheetIndex(0);
    	
    	
    	// excel头参数
    	header('Content-Type: application/vnd.ms-excel');
    	header("Content-Disposition: attachment;filename=".$_POST['xlsnm'].date("Ymd-His").".xls");  //日期为文件名后缀
    	header('Cache-Control: max-age=0');
    	
    	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式
    	$objWriter->save('php://output');
    }
    
    
    public function outputchengheng(){
    	//先去数据库找出你要让哪些数据出来
    	header("Content-Type:text/html; charset=utf-8");
    	
    	$zssz=M('zssz');
    	$zsszo=$zssz->find();
    	$grdid=$zsszo['f_zssz_grdid'];
    	$xqid=$zsszo['f_zssz_xqid'];
    	
    	$grd=M('grd');
    	$grdo=$grd->where('grdid='.$grdid)->find();
    	
    	$xn=M('xn');
    	$xno=$xn->where("xnnm='".$grdo['grdnm']."'")->find();
    	
    	$bxxsu=explode('-', $zsszo['zsszbxxsu']);
    	$bxxs=M('bxxs');
    	
    	import('@.ORG.PHPExcel');
    	// Create new PHPExcel object
    	$objPHPExcel = new PHPExcel();
    	// Set properties
    	$objPHPExcel->getProperties()->setCreator("ctos")
    	->setLastModifiedBy("ctos")
    	->setTitle("Office 2007 XLSX Test Document")
    	->setSubject("Office 2007 XLSX Test Document")
    	->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    	->setKeywords("office 2007 openxml php")
    	->setCategory("Test result file");
    	
    	for($z=1;$z<count($bxxsu)-1;$z++){
    		$bxxso=$bxxs->where('bxxsid='.$bxxsu[$z])->find();
    		
    		//sheet1开始
    		$fldint='-cwid-stdid-bxxsnm-stdaplno-stdnm-sexnm-stdidcd-mjnm-cwyjxfsm-cwyjjckwfsm-cwyjzsfsm-';//记着等下补总额//第一个必须是id要出来，统一节奏
    		$jsn=array(
    					'bxxsnm'=>'办学形式',
    					'stdaplno'=>'报名号',
    					'stdnm'=>'姓名',
    					'sexnm'=>'性别',
    					'stdidcd'=>'身份证号码',
    					'mjnm'=>'专业',
    					'cwyjxfsm'=>'应缴学费(含报名费)',
    					'cwyjjckwfsm'=>'应缴教材考务费',
    					'cwyjzsfsm'=>'应缴住宿费',
    					 
    		);
    			
    		//NB初始化，开始
    		$m=clone M($grdo['grdnm'].'_cw');//避免本次循环中对相应对象的改变带入下一个循环中，造成各种各样的问题//一般对一个对象带入到下一个循环要慎重，最好clone
    		$m->join('tb_'.$grdo['grdnm'].'_std ON f_cw_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
    			 
    		$cdtint="-sp-f_std_grdid-eq-".$grdid."-sp-f_cw_xnid-eq-".$xno['xnid']."-sp-f_std_sttid-eq-1-sp-f_stdxqcls_xqid-eq-".$xqid."-sp-f_stdxqmj_xqid-eq-".$xqid."-sp-f_stdxqdm_xqid-eq-".$xqid.'-sp-f_mj_bxxsid-eq-'.$bxxso['bxxsid'].'-sp-';
    			
    		$spccdtint="-sp-stdupfnctm=''-sp-";
    		$odrint='-';
    		$jn='tb_xn ON f_cw_xnid=xnid-jn-tb_stt ON f_std_sttid=sttid-jn-tb_grd ON f_std_grdid=grdid-jn-tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid-jn-tb_bxxs ON f_mj_bxxsid=bxxsid-jn-tb_cc ON f_mj_ccid=ccid-jn-tb_kl ON f_mj_klid=klid-jn-tb_xxxs ON f_mj_xxxsid=xxxsid-jn-tb_zsfw ON f_mj_zsfwid=zsfwid-jn-tb_xz ON f_mj_xzid=xzid-jn-tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid-jn-tb_dm ON f_stdxqdm_dmid=dmid-jn-tb_sex ON f_std_sexid=sexid-jn-tb_rc ON f_std_rcid=rcid-jn-tb_zzmm ON f_std_zzmmid=zzmmid-jn-tb_xl ON f_std_xlid=xlid-jn-tb_stat ON f_std_statid=statid-jn-tb_xq ON f_stdxqcls_xqid=xqid';
    		import('@.NB.NBAction');
    		$NB = new NBAction();
    		$arr=$NB->NB($m,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn,'y');
    		$fld=$arr['fld'];
    		$mlsall=array();
    		$flgzsf=0;
    		
    		$stdupfnctm=date("Y-m-d H:i:s",time());
    		$std=clone M($grdo['grdnm'].'_std');
    		foreach($arr['mlsforcount'] as $v){
    			//顺便给学生的上传财务时间赋值
    			
    			$dt=array(
    					'stdupfnctm'=>$stdupfnctm,
    			);
    			$std->where('stdid='.$v['stdid'])->setField($dt);	
    	
    			if($v['cwyjzsfsm']>0){
    				$flgzsf=1;
    			}
    		}
    		if($flgzsf==0){
    			$fldint='-cwid-stdid-bxxsnm-stdaplno-stdnm-sexnm-stdidcd-mjnm-cwyjxfsm-cwyjjckwfsm-';//记着等下补总额//第一个必须是id要出来，统一节奏
    			$jsn=array(
    					'bxxsnm'=>'办学形式',
    					'stdaplno'=>'报名号',
    					'stdnm'=>'姓名',
    					'sexnm'=>'性别',
    					'stdidcd'=>'身份证号码',
    					'mjnm'=>'专业',
    					'cwyjxfsm'=>'应缴学费(含报名费)',
    					'cwyjjckwfsm'=>'应缴教材考务费',
    					
    			
    			);
    			$fld='-cwid-stdid-bxxsnm-stdaplno-stdnm-sexnm-stdidcd-mjnm-cwyjxfsm-cwyjjckwfsm-';
	    		foreach($arr['mlsforcount'] as $v){
	    			$dt=array(
	    					'bxxsnm'=>$v['bxxsnm'],
	    					'stdaplno'=>$v['stdaplno'],
	    					'stdnm'=>$v['stdnm'],
	    					'sexnm'=>$v['sexnm'],
	    					'stdidcd'=>$v['stdidcd'],
	    					'mjnm'=>$v['mjnm'],
	    					'cwyjxfsm'=>$v['cwyjxfsm'],
	    					'cwyjjckwfsm'=>$v['cwyjjckwfsm'],
	    			);
	    			array_push($mlsall, $dt);
	    		}
	    		
    		}else{
    			$mlsall=$arr['mlsforcount'];
    		}
    		
    			
    			
    			 
    		$zm=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    		
    		 
    		//添加一个新的worksheet
    		if($z!=1){
    			$objPHPExcel->createSheet();
    		}
    		
    		$objPHPExcel->getSheet($z-1)->setTitle($bxxso['bxxsnm']);
    		//设置宽度
    		//$objActSheet = $objPHPExcel->getActiveSheet();
    		$objActSheet = $objPHPExcel->getSheet($z-1);//指定sheet
    		//$objActSheet->getColumnDimension('A')->setAutoSize();
    		if($flgzsf==0){
    			$objActSheet->getColumnDimension('A')->setWidth(4.77);
	    		$objActSheet->getColumnDimension('B')->setWidth(18.99);
	    		$objActSheet->getColumnDimension('C')->setWidth(10.2);
	    		$objActSheet->getColumnDimension('D')->setWidth(7.7);
	    		$objActSheet->getColumnDimension('E')->setWidth(4.63);
	    		$objActSheet->getColumnDimension('F')->setWidth(19.7);
	    		$objActSheet->getColumnDimension('G')->setWidth(15.4);
	    		$objActSheet->getColumnDimension('H')->setWidth(16.27);
	    		$objActSheet->getColumnDimension('I')->setWidth(13.13);
	    		$objActSheet->getColumnDimension('J')->setWidth(9.56);
	    		
    		}else{
    			$objActSheet->getColumnDimension('A')->setWidth(4.07);
	    		$objActSheet->getColumnDimension('B')->setWidth(18.29);
	    		$objActSheet->getColumnDimension('C')->setWidth(9.5);
	    		$objActSheet->getColumnDimension('D')->setWidth(7);
	    		$objActSheet->getColumnDimension('E')->setWidth(3.93);
	    		$objActSheet->getColumnDimension('F')->setWidth(19);
	    		$objActSheet->getColumnDimension('G')->setWidth(14.7);
	    		$objActSheet->getColumnDimension('H')->setWidth(15.57);
	    		$objActSheet->getColumnDimension('I')->setWidth(12.43);
	    		$objActSheet->getColumnDimension('J')->setWidth(8.86);
	    		$objActSheet->getColumnDimension('K')->setWidth(6.57);
    		}
    		
    		
    		$objActSheet->getRowDimension('1')->setRowHeight(16);
    		$objActSheet->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objActSheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		
    		// set table header content列是从0开始，行是从1开始
    		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
    		$sheet=$objPHPExcel->setActiveSheetIndex($z-1);
    		if($flgzsf==0){
    			$sheet->mergeCells("A1:J1");
    		}else{
    			$sheet->mergeCells("A1:K1");
    		}
    		
    		$sheet=$sheet->setCellValueByColumnAndRow(0,1,'中国计量学院成教学院'.$grdo['grdnm'].'年'.$bxxso['bxxsnm'].'招生学生名单');
    		$sheet=$sheet->setCellValueByColumnAndRow(0,2,'序号');
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('A2')->getBorders();
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$fldu=explode('-', $fld);
    		for($i=3;$i<count($fldu)-1;$i++){
    			$sheet=$sheet->setCellValueByColumnAndRow($i-2,2,$jsn[$fldu[$i]]);
    			 
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].'2')->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		}
    		//添加一个应缴总额
    		$sheet=$sheet->setCellValueByColumnAndRow(count($fldu)-3,2,'应缴总额');//可以画一个excel直观的用规律总结出来
    		
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[count($fldu)-3].'2')->getBorders();
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		 
    		//Miscellaneous glyphs, UTF-8
    		for($j=0;$j<count($mlsall);$j++){
    			$m=$mlsall[$j];
    			$sheet=$sheet->setCellValueByColumnAndRow(0,$j+3,($j+1).' ');//序号值
    			 
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('A'.($j+3))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			 
    			//$objActSheet->getStyle('A'.($j+3))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    			for($i=3;$i<count($fldu)-1;$i++){
    				$sheet=$sheet->setCellValueByColumnAndRow($i-2,$j+3,$m[$fldu[$i]].' ');
    		
    				//$objActSheet->getStyle($zm[$i-2].''.($j+3))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		
    				$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].''.($j+3))->getBorders();
    				$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			}
    			 
    			//添加一个应缴总额
    			$sheet=$sheet->setCellValueByColumnAndRow(count($fldu)-3,$j+3,($m['cwyjxfsm']+$m['cwyjjckwfsm']).' ');//这里必须定制了
    				
    			//$objActSheet->getStyle($zm[$i-2].''.($j+3))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    				
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[count($fldu)-3].''.($j+3))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			 
    			//$objActSheet->getStyle($zm[count($fldu)-1-1].($j+3))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    			 
    		}
    		//sheet1结束
    	}
    	
    	
    	
    	 
    	 
    	//  sheet命名
    	//$objPHPExcel->getActiveSheet()->setTitle('订单汇总表');
    	 
    	 
    	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    	$objPHPExcel->setActiveSheetIndex(0);
    	 
    	 
    	// excel头参数
    	header('Content-Type: application/vnd.ms-excel');
    	header("Content-Disposition: attachment;filename=".$_POST['xlsnm'].date("Ymd-His").".xls");  //日期为文件名后缀
    	header('Cache-Control: max-age=0');
    	 
    	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式
    	$objWriter->save('php://output');
    }
    
    
    public function outputcjzx(){
    	//先去数据库找出你要让哪些数据出来
    	header("Content-Type:text/html; charset=utf-8");
    	
    	$biaoji=$_POST['biaoji'];
    		
    	if($biaoji=='cj'){
    		$mk=$_POST['mk'];
    		if($mk=='cjzx'){
    			$tmp=explode('f_cjzx_grdid', $_POST['cdt']);
    			$tmp=explode('-eq-',$tmp[1]);
    			$tmp=explode('-sp-',$tmp[1]);
    			$grdid=$tmp[0];
    			$grd=M('grd');
    			$grdo=$grd->where('grdid='.$grdid)->find();
    			$jn='tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid-jn-tb_stt ON f_cjzx_sttid=sttid-jn-tb_grd ON f_cjzx_grdid=grdid-jn-tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid-jn-tb_tcr ON f_pk_tcrid=tcrid-jn-tb_xq ON f_cjzx_xqid=xqid'.'-jn-tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid-jn-tb_bxxs ON f_mj_bxxsid=bxxsid-jn-tb_cc ON f_mj_ccid=ccid-jn-tb_kl ON f_mj_klid=klid-jn-tb_xxxs ON f_mj_xxxsid=xxxsid-jn-tb_zsfw ON f_mj_zsfwid=zsfwid-jn-tb_xz ON f_mj_xzid=xzid-jn-tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid-jn-tb_sex ON f_std_sexid=sexid-jn-tb_rc ON f_std_rcid=rcid-jn-tb_zzmm ON f_std_zzmmid=zzmmid-jn-tb_xl ON f_std_xlid=xlid-jn-tb_stat ON f_std_statid=statid';
    			$fldint='-cjzxid-stdno-stdnm-sexnm-cjzxzf-cjzxqmf-cjzxpsf-cjzxxtf-';
    			$jsn=array(
    		
    					'stdno'=>'学号',
    					'stdnm'=>'姓名',
    					'sexnm'=>'性别',
    					'cjzxzf'=>'总成绩',
    					'cjzxqmf'=>'卷面',
    					'cjzxpsf'=>'平时',
    					'cjzxxtf'=>'习题',
    			);
    		}
    		//NB初始化，开始
    		$m=M($grdo['grdnm'].'_cjzx')->join('tb_'.$grdo['grdnm'].'_std ON f_cjzx_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');;
    		
    		$cdtint="-sp-";
    		$spccdtint='-sp-';
    		$odrint='-';
    		$lmtint=100;
    		//$jn='tb_ath ON f_athid=athid-jn-tb_atc ON f_athid=atcid';//若出现多个join
    		import('@.NB.NBAction');
    		$NB = new NBAction();
    		$arr=$NB->NB($m,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn,'y');
    		 
    		$fld='-cjzxid-stdno-stdnm-sexnm-cjzxzf-cjzxqmf-cjzxpsf-cjzxxtf-';
    		$mlsall=$arr['mlsforcount'];
    		$mo=$mlsall[0];
    		$bxxnm=$mo['bxxsnm'];
    		$clsnm=$mo['clsnm'];
    		$kcnm=$mo['kcnm'];
    		$xqnm=$mo['xqnm'];
    		$mjnm=$mo['mjnm'];
    		foreach($mlsall as $v){
    			if(!preg_match('/'.$v['mjnm'].'/', $mjnm)){
    				$mjnm=$mjnm.'  '.$v['mjnm'];
    			}
    		}
    		 
    		$zm=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    		import('@.ORG.PHPExcel');
    		// Create new PHPExcel object
    		$objPHPExcel = new PHPExcel();
    		// Set properties
    		$objPHPExcel->getProperties()->setCreator("ctos")
    		->setLastModifiedBy("ctos")
    		->setTitle("Office 2007 XLSX Test Document")
    		->setSubject("Office 2007 XLSX Test Document")
    		->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    		->setKeywords("office 2007 openxml php")
    		->setCategory("Test result file");
    		
    		//设置边框
    		//     	$objExcel = new PHPExcel();
    		//     	//$objExcel->setActiveSheetIndex(0);
    		//     	$objActSheet = $objExcel->getActiveSheet();
    		//     	$objStyleA5 = $objActSheet->getStyle('A5');
    		//     	$objBorderA5 = $objStyleA5->getBorders();
    		//     	$objBorderA5->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA5->getTop()->getColor()->setARGB('FFFF0000'); // color
    		//     	$objBorderA5->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA5->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA5->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		
    		//设置宽度
    		$objActSheet = $objPHPExcel->getActiveSheet();
    		//$objActSheet->getColumnDimension('A')->setAutoSize();
    		$objActSheet->getColumnDimension('A')->setWidth(12);
    		$objActSheet->getColumnDimension('B')->setWidth(7);
    		$objActSheet->getColumnDimension('C')->setWidth(5);
    		$objActSheet->getColumnDimension('D')->setWidth(6);
    		$objActSheet->getColumnDimension('E')->setWidth(5);
    		$objActSheet->getColumnDimension('F')->setWidth(5);
    		$objActSheet->getColumnDimension('G')->setWidth(5);
    		
    		$objActSheet->getColumnDimension('H')->setWidth(2);
    		
    		$objActSheet->getColumnDimension('I')->setWidth(12);
    		$objActSheet->getColumnDimension('J')->setWidth(7);
    		$objActSheet->getColumnDimension('K')->setWidth(5);
    		$objActSheet->getColumnDimension('L')->setWidth(6);
    		$objActSheet->getColumnDimension('M')->setWidth(5);
    		$objActSheet->getColumnDimension('N')->setWidth(5);
    		$objActSheet->getColumnDimension('O')->setWidth(5);
    		
    		for($i=5;$i<=38;$i++){
    			$objActSheet->getRowDimension(''.$i)->setRowHeight(15.55);
    		
    		}
    		
    		
    		
    		// set table header content列是从0开始，行是从1开始
    		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
    		
    		//     	$objBorderA1=$objPHPExcel->getActiveSheet()->getStyle('B8')->getBorders();
    		//     	$objBorderA1->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA1->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA1->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA1->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA1->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		
    		$sheet=$objPHPExcel->setActiveSheetIndex(0);
    		$sheet->mergeCells("A1:O1");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,1,'中国计量学院'.$bxxsnm.'考试成绩登记表');
    		$sheet->mergeCells("A2:O2");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,2,$mjnm.' 专业  '.$clsnm.' 课程名称 '.$kcnm);
    		$sheet->mergeCells("A3:O3");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,3,'（'.$xqnm.'）');
    		//$sheet=$sheet->setCellValueByColumnAndRow(0,1,'序号');
    		$fldu=explode('-', $fld);
    		for($i=2;$i<count($fldu)-1;$i++){
    		
    			$sheet=$sheet->setCellValueByColumnAndRow($i-2,5,$jsn[$fldu[$i]]);
    		
    			$objActSheet->getStyle($zm[$i-2].'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].'5')->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		}
    		for($i=2;$i<count($fldu)-1;$i++){
    			 
    			$sheet=$sheet->setCellValueByColumnAndRow($i+6,5,$jsn[$fldu[$i]]);
    		
    			$objActSheet->getStyle($zm[$i+6].'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i+6].'5')->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		}
    		
    		if(count($mlsall)>33){
    			//Miscellaneous glyphs, UTF-8
    			for($j=0;$j<33;$j++){
    				$m=$mlsall[$j];
    				//$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
    				for($i=2;$i<count($fldu)-1;$i++){
    					$sheet=$sheet->setCellValueByColumnAndRow($i-2,$j+6,$m[$fldu[$i]].' ');
    		
    					$objActSheet->getStyle($zm[$i-2].''.($j+6))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		
    					$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].''.($j+6))->getBorders();
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				}
    			}
    			for($j=33;$j<count($mlsall);$j++){
    				$m=$mlsall[$j];
    				//$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
    				for($i=2;$i<count($fldu)-1;$i++){
    					$sheet=$sheet->setCellValueByColumnAndRow($i+6,$j+6-33,$m[$fldu[$i]].' ');
    		
    					$objActSheet->getStyle($zm[$i+6].''.($j+6-33))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		
    					$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i+6].''.($j+6-33))->getBorders();
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				}
    			}
    		}else{
    			//Miscellaneous glyphs, UTF-8
    			for($j=0;$j<count($mlsall);$j++){
    				$m=$mlsall[$j];
    				//$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
    				for($i=2;$i<count($fldu)-1;$i++){
    					$sheet=$sheet->setCellValueByColumnAndRow($i-2,$j+6,$m[$fldu[$i]].' ');
    		
    					$objActSheet->getStyle($zm[$i-2].''.($j+6))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		
    					$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].''.($j+6))->getBorders();
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				}
    			}
    		}
    		
    		
    		$sheet->mergeCells("A39:O39");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,39,'批卷老师签字：                                              班主任签字：');
    		$sheet->mergeCells("A40:O40");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,40,'说明：  1、任课教师应于考试后三天内，登陆http://cjxy.cjlu.edu.cn录入成绩，');
    		$sheet->mergeCells("A41:O41");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,41,'                 并将本表卷面成绩、习题分两项认真填写，一式两份，交格致北楼302办公室');
    		$sheet->mergeCells("A42:O42");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,42,'            2、卷面成绩占总成绩的70%，平时成绩占总成绩的20%（由班主任评定），习题成绩占总成绩的10%。');
    		$sheet->mergeCells("A43:O43");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,43,'                 总成绩=卷面成绩*0.7+平时成绩*0.2+习题成绩*0.1');
    		$sheet->mergeCells("A44:O44");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,44,'            3、班主任请在收到此表后三天，将本表平时分项认真填写，一式两份。');
    		
    		
    		//设置居中
    		
    		//$objActSheet->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objActSheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		
    		
    		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    		$objPHPExcel->setActiveSheetIndex(0);
    		
    		
    		
    		
    		// excel头参数
    		header('Content-Type: application/vnd.ms-excel');
    		header("Content-Disposition: attachment;filename=".$clsnm.'-'.$kcnm.'成绩单'.date("Ymd-His").".xls");  //日期为文件名后缀
    		header('Cache-Control: max-age=0');
    		
    		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式
    		$objWriter->save('php://output');
    	}

        if($biaoji=='bkcj'){
            $mk=$_POST['mk'];
            if($mk=='cjzx'){
                $tmp=explode('f_cjzx_grdid', $_POST['cdt']);
                $tmp=explode('-eq-',$tmp[1]);
                $tmp=explode('-sp-',$tmp[1]);
                $grdid=$tmp[0];
                $grd=M('grd');
                $grdo=$grd->where('grdid='.$grdid)->find();
                $jn='tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid-jn-tb_stt ON f_cjzx_sttid=sttid-jn-tb_grd ON f_cjzx_grdid=grdid-jn-tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid-jn-tb_tcr ON f_pk_tcrid=tcrid-jn-tb_xq ON f_cjzx_xqid=xqid'.'-jn-tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid-jn-tb_bxxs ON f_mj_bxxsid=bxxsid-jn-tb_cc ON f_mj_ccid=ccid-jn-tb_kl ON f_mj_klid=klid-jn-tb_xxxs ON f_mj_xxxsid=xxxsid-jn-tb_zsfw ON f_mj_zsfwid=zsfwid-jn-tb_xz ON f_mj_xzid=xzid-jn-tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid-jn-tb_sex ON f_std_sexid=sexid-jn-tb_rc ON f_std_rcid=rcid-jn-tb_zzmm ON f_std_zzmmid=zzmmid-jn-tb_xl ON f_std_xlid=xlid-jn-tb_stat ON f_std_statid=statid';
                $fldint='-cjzxid-stdno-stdnm-sexnm-cjzxzf-cjzxqmf-cjzxpsf-cjzxxtf-cjzxbkf-';
                $jsn=array(
            
                        'stdno'=>'学号',
                        'stdnm'=>'姓名',
                        'sexnm'=>'性别',
                        'cjzxzf'=>'总成绩',
                        'cjzxqmf'=>'卷面',
                        'cjzxpsf'=>'平时',
                        'cjzxxtf'=>'习题',
                        'cjzxbkf'=>'补考成绩',
                );
            }
            //NB初始化，开始
            $m=M($grdo['grdnm'].'_cjzx')->join('tb_'.$grdo['grdnm'].'_std ON f_cjzx_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');;
            
            $cdtint="-sp-";
            $spccdtint='-sp-';
            $odrint='-';
            $lmtint=100;
            //$jn='tb_ath ON f_athid=athid-jn-tb_atc ON f_athid=atcid';//若出现多个join
            import('@.NB.NBAction');
            $NB = new NBAction();
            $arr=$NB->NB($m,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn,'y');
             
            $fld='-cjzxid-stdno-stdnm-sexnm-cjzxbkf-';
            $mlsall=$arr['mlsforcount'];
            $mo=$mlsall[0];
            $bxxnm=$mo['bxxsnm'];
            $clsnm=$mo['clsnm'];
            $kcnm=$mo['kcnm'];
            $xqnm=$mo['xqnm'];
            $mjnm=$mo['mjnm'];
            foreach($mlsall as $v){
                if(!preg_match('/'.$v['mjnm'].'/', $mjnm)){
                    $mjnm=$mjnm.'  '.$v['mjnm'];
                }
            }
             
            $zm=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            import('@.ORG.PHPExcel');
            // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("ctos")
            ->setLastModifiedBy("ctos")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
            
            //设置边框
            //      $objExcel = new PHPExcel();
            //      //$objExcel->setActiveSheetIndex(0);
            //      $objActSheet = $objExcel->getActiveSheet();
            //      $objStyleA5 = $objActSheet->getStyle('A5');
            //      $objBorderA5 = $objStyleA5->getBorders();
            //      $objBorderA5->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            //      $objBorderA5->getTop()->getColor()->setARGB('FFFF0000'); // color
            //      $objBorderA5->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            //      $objBorderA5->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            //      $objBorderA5->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            
            //设置宽度
            $objActSheet = $objPHPExcel->getActiveSheet();
            //$objActSheet->getColumnDimension('A')->setAutoSize();
            $objActSheet->getColumnDimension('A')->setWidth(12);
            $objActSheet->getColumnDimension('B')->setWidth(7);
            $objActSheet->getColumnDimension('C')->setWidth(5);
            $objActSheet->getColumnDimension('D')->setWidth(10);
            $objActSheet->getColumnDimension('E')->setWidth(1);
            $objActSheet->getColumnDimension('F')->setWidth(5);
            $objActSheet->getColumnDimension('G')->setWidth(5);
            
            $objActSheet->getColumnDimension('H')->setWidth(2);
            
            $objActSheet->getColumnDimension('I')->setWidth(12);
            $objActSheet->getColumnDimension('J')->setWidth(7);
            $objActSheet->getColumnDimension('K')->setWidth(5);
            $objActSheet->getColumnDimension('L')->setWidth(10);
            $objActSheet->getColumnDimension('M')->setWidth(1);
            $objActSheet->getColumnDimension('N')->setWidth(5);
            $objActSheet->getColumnDimension('O')->setWidth(5);
            
            for($i=5;$i<=38;$i++){
                $objActSheet->getRowDimension(''.$i)->setRowHeight(15.55);
            
            }
            
            
            
            // set table header content列是从0开始，行是从1开始
            $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
            
            //      $objBorderA1=$objPHPExcel->getActiveSheet()->getStyle('B8')->getBorders();
            //      $objBorderA1->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            //      $objBorderA1->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            //      $objBorderA1->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            //      $objBorderA1->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            //      $objBorderA1->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            
            $sheet=$objPHPExcel->setActiveSheetIndex(0);
            $sheet->mergeCells("A1:O1");
            $sheet=$sheet->setCellValueByColumnAndRow(0,1,'中国计量学院'.$bxxsnm.'补考考试成绩登记表');
            $sheet->mergeCells("A2:O2");
            $sheet=$sheet->setCellValueByColumnAndRow(0,2,$mjnm.' 专业  '.$clsnm.' 课程名称 '.$kcnm);
            $sheet->mergeCells("A3:O3");
            $sheet=$sheet->setCellValueByColumnAndRow(0,3,'（'.$xqnm.'）');
            //$sheet=$sheet->setCellValueByColumnAndRow(0,1,'序号');
            $fldu=explode('-', $fld);
            for($i=2;$i<count($fldu)-1;$i++){
            
                $sheet=$sheet->setCellValueByColumnAndRow($i-2,5,$jsn[$fldu[$i]]);
            
                $objActSheet->getStyle($zm[$i-2].'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
                $objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].'5')->getBorders();
                $objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            }
            for($i=2;$i<count($fldu)-1;$i++){
                 
                $sheet=$sheet->setCellValueByColumnAndRow($i+6,5,$jsn[$fldu[$i]]);
            
                $objActSheet->getStyle($zm[$i+6].'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
                $objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i+6].'5')->getBorders();
                $objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            }
            
            if(count($mlsall)>33){
                //Miscellaneous glyphs, UTF-8
                for($j=0;$j<33;$j++){
                    $m=$mlsall[$j];
                    //$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
                    for($i=2;$i<count($fldu)-1;$i++){
                        $sheet=$sheet->setCellValueByColumnAndRow($i-2,$j+6,$m[$fldu[$i]].' ');
            
                        $objActSheet->getStyle($zm[$i-2].''.($j+6))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
                        $objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].''.($j+6))->getBorders();
                        $objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                        $objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                        $objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                        $objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                        $objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    }
                }
                for($j=33;$j<count($mlsall);$j++){
                    $m=$mlsall[$j];
                    //$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
                    for($i=2;$i<count($fldu)-1;$i++){
                        $sheet=$sheet->setCellValueByColumnAndRow($i+6,$j+6-33,$m[$fldu[$i]].' ');
            
                        $objActSheet->getStyle($zm[$i+6].''.($j+6-33))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
                        $objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i+6].''.($j+6-33))->getBorders();
                        $objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                        $objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                        $objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                        $objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                        $objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    }
                }
            }else{
                //Miscellaneous glyphs, UTF-8
                for($j=0;$j<count($mlsall);$j++){
                    $m=$mlsall[$j];
                    //$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
                    for($i=2;$i<count($fldu)-1;$i++){
                        $sheet=$sheet->setCellValueByColumnAndRow($i-2,$j+6,$m[$fldu[$i]].' ');
            
                        $objActSheet->getStyle($zm[$i-2].''.($j+6))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
                        $objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].''.($j+6))->getBorders();
                        $objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                        $objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                        $objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                        $objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                        $objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    }
                }
            }
            
            
            $sheet->mergeCells("A39:O39");
            $sheet=$sheet->setCellValueByColumnAndRow(0,39,'批卷老师签字：                                              ');
            $sheet->mergeCells("A40:O40");
            $sheet=$sheet->setCellValueByColumnAndRow(0,40,'说明：  任课教师应于考试后三天内，登陆http://cjxy.cjlu.edu.cn录入成绩，一式两份，');
            $sheet->mergeCells("A41:O41");
            $sheet=$sheet->setCellValueByColumnAndRow(0,41,'                 交格致北楼302办公室');
           
            
            //设置居中
            
            //$objActSheet->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objActSheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objActSheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objActSheet->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            
            
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);
            
            
            
            
            // excel头参数
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;filename=".$clsnm.'-'.$kcnm.'补考成绩单'.date("Ymd-His").".xls");  //日期为文件名后缀
            header('Cache-Control: max-age=0');
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式
            $objWriter->save('php://output');
        }
    	
    	if($biaoji=='qd'){
    		$mk=$_POST['mk'];
    		if($mk=='cjzx'){
    			$tmp=explode('f_cjzx_grdid', $_POST['cdt']);
    			$tmp=explode('-eq-',$tmp[1]);
    			$tmp=explode('-sp-',$tmp[1]);
    			$grdid=$tmp[0];
    			$grd=M('grd');
    			$grdo=$grd->where('grdid='.$grdid)->find();
    			$jn='tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid-jn-tb_stt ON f_cjzx_sttid=sttid-jn-tb_grd ON f_cjzx_grdid=grdid-jn-tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid-jn-tb_tcr ON f_pk_tcrid=tcrid-jn-tb_xq ON f_cjzx_xqid=xqid'.'-jn-tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid-jn-tb_bxxs ON f_mj_bxxsid=bxxsid-jn-tb_cc ON f_mj_ccid=ccid-jn-tb_kl ON f_mj_klid=klid-jn-tb_xxxs ON f_mj_xxxsid=xxxsid-jn-tb_zsfw ON f_mj_zsfwid=zsfwid-jn-tb_xz ON f_mj_xzid=xzid-jn-tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid-jn-tb_sex ON f_std_sexid=sexid-jn-tb_rc ON f_std_rcid=rcid-jn-tb_zzmm ON f_std_zzmmid=zzmmid-jn-tb_xl ON f_std_xlid=xlid-jn-tb_stat ON f_std_statid=statid';
    			$fldint='-cjzxid-stdno-stdnm-sexnm-cjzxzf-cjzxqmf-cjzxpsf-cjzxxtf-';
    			$jsn=array(
    	
    					'stdno'=>'学号',
    					'stdnm'=>'姓名',
    					'sexnm'=>'性别',
    					'cjzxzf'=>'总成绩',
    					'cjzxqmf'=>'卷面',
    					'cjzxpsf'=>'平时',
    					'cjzxxtf'=>'习题',
    			);
    		}
    		//NB初始化，开始
    		$m=M($grdo['grdnm'].'_cjzx')->join('tb_'.$grdo['grdnm'].'_std ON f_cjzx_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');;
    	
    		$cdtint="-sp-";
    		$spccdtint='-sp-';
    		$odrint='-';
    		$lmtint=100;
    		//$jn='tb_ath ON f_athid=athid-jn-tb_atc ON f_athid=atcid';//若出现多个join
    		import('@.NB.NBAction');
    		$NB = new NBAction();
    		$arr=$NB->NB($m,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn,'y');
    		 
    		$fld='-cjzxid-stdno-stdnm-sexnm-cjzxzf-cjzxqmf-cjzxpsf-cjzxxtf-';
    		$mlsall=$arr['mlsforcount'];
    		$mo=$mlsall[0];
    		$bxxnm=$mo['bxxsnm'];
    		$clsnm=$mo['clsnm'];
    		$kcnm=$mo['kcnm'];
    		$xqnm=$mo['xqnm'];
    		$mjnm=$mo['mjnm'];
    		$mlsallfn=array();
    		foreach($mlsall as $v){
    			if(!preg_match('/'.$v['mjnm'].'/', $mjnm)){
    				$mjnm=$mjnm.'  '.$v['mjnm'];
    			}
    		}
    		
    		$zm=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    		import('@.ORG.PHPExcel');
    		// Create new PHPExcel object
    		$objPHPExcel = new PHPExcel();
    		// Set properties
    		$objPHPExcel->getProperties()->setCreator("ctos")
    		->setLastModifiedBy("ctos")
    		->setTitle("Office 2007 XLSX Test Document")
    		->setSubject("Office 2007 XLSX Test Document")
    		->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    		->setKeywords("office 2007 openxml php")
    		->setCategory("Test result file");
    	
    		//设置边框
    		//     	$objExcel = new PHPExcel();
    		//     	//$objExcel->setActiveSheetIndex(0);
    		//     	$objActSheet = $objExcel->getActiveSheet();
    		//     	$objStyleA5 = $objActSheet->getStyle('A5');
    		//     	$objBorderA5 = $objStyleA5->getBorders();
    		//     	$objBorderA5->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA5->getTop()->getColor()->setARGB('FFFF0000'); // color
    		//     	$objBorderA5->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA5->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA5->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	
    		//设置宽度
    		$objActSheet = $objPHPExcel->getActiveSheet();
    		//$objActSheet->getColumnDimension('A')->setAutoSize();
    		$objActSheet->getColumnDimension('A')->setWidth(12);
    		$objActSheet->getColumnDimension('B')->setWidth(7);
    		$objActSheet->getColumnDimension('C')->setWidth(5);
    		$objActSheet->getColumnDimension('D')->setWidth(18);
    		$objActSheet->getColumnDimension('E')->setWidth(1);
    		$objActSheet->getColumnDimension('F')->setWidth(1);
    		$objActSheet->getColumnDimension('G')->setWidth(1);
    	
    		$objActSheet->getColumnDimension('H')->setWidth(2);
    	
    		$objActSheet->getColumnDimension('I')->setWidth(12);
    		$objActSheet->getColumnDimension('J')->setWidth(7);
    		$objActSheet->getColumnDimension('K')->setWidth(5);
    		$objActSheet->getColumnDimension('L')->setWidth(18);
    		$objActSheet->getColumnDimension('M')->setWidth(1);
    		$objActSheet->getColumnDimension('N')->setWidth(1);
    		$objActSheet->getColumnDimension('O')->setWidth(1);
    	
    		for($i=5;$i<=38;$i++){
    			$objActSheet->getRowDimension(''.$i)->setRowHeight(15.55);
    	
    		}
    	
    	
    	
    		// set table header content列是从0开始，行是从1开始
    		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
    	
    		//     	$objBorderA1=$objPHPExcel->getActiveSheet()->getStyle('B8')->getBorders();
    		//     	$objBorderA1->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA1->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA1->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA1->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA1->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	
    		$sheet=$objPHPExcel->setActiveSheetIndex(0);
    		$sheet->mergeCells("A1:O1");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,1,'中国计量学院'.$bxxsnm.'考试签到表');
    		$sheet->mergeCells("A2:O2");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,2,$mjnm.' 专业  '.$clsnm.' 课程名称 '.$kcnm);
    		$sheet->mergeCells("A3:O3");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,3,'（'.$xqnm.'）');
    		//$sheet=$sheet->setCellValueByColumnAndRow(0,1,'序号');
    		$fldu=explode('-', $fld);
    		for($i=2;$i<count($fldu)-1-4;$i++){
    	
    			$sheet=$sheet->setCellValueByColumnAndRow($i-2,5,$jsn[$fldu[$i]]);
    	
    			$objActSheet->getStyle($zm[$i-2].'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].'5')->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		}
    		$sheet=$sheet->setCellValueByColumnAndRow($i-2,5,'签名处');
    		 
    		$objActSheet->getStyle($zm[$i-2].'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		 
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].'5')->getBorders();
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		
    		for($i=2;$i<count($fldu)-1-4;$i++){
    	
    			$sheet=$sheet->setCellValueByColumnAndRow($i+6,5,$jsn[$fldu[$i]]);
    	
    			$objActSheet->getStyle($zm[$i+6].'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i+6].'5')->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		}
    		$sheet=$sheet->setCellValueByColumnAndRow($i+6,5,'签名处');
    		 
    		$objActSheet->getStyle($zm[$i+6].'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		 
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i+6].'5')->getBorders();
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	
    		if(count($mlsall)>33){
    			//Miscellaneous glyphs, UTF-8
    			for($j=0;$j<33;$j++){
    				$m=$mlsall[$j];
    				//$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
    				for($i=2;$i<count($fldu)-1-4;$i++){
    					$sheet=$sheet->setCellValueByColumnAndRow($i-2,$j+6,$m[$fldu[$i]].' ');
    	
    					$objActSheet->getStyle($zm[$i-2].''.($j+6))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	
    					$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].''.($j+6))->getBorders();
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				}
    				$sheet=$sheet->setCellValueByColumnAndRow($i-2,$j+6,' ');
    				 
    				$objActSheet->getStyle($zm[$i-2].''.($j+6))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    				 
    				$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].''.($j+6))->getBorders();
    				$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			}
    			for($j=33;$j<count($mlsall);$j++){
    				$m=$mlsall[$j];
    				//$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
    				for($i=2;$i<count($fldu)-1-4;$i++){
    					$sheet=$sheet->setCellValueByColumnAndRow($i+6,$j+6-33,$m[$fldu[$i]].' ');
    	
    					$objActSheet->getStyle($zm[$i+6].''.($j+6-33))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	
    					$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i+6].''.($j+6-33))->getBorders();
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				}
    				$sheet=$sheet->setCellValueByColumnAndRow($i+6,$j+6-33,' ');
    				 
    				$objActSheet->getStyle($zm[$i+6].''.($j+6-33))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    				 
    				$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i+6].''.($j+6-33))->getBorders();
    				$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			}
    		}else{
    			//Miscellaneous glyphs, UTF-8
    			for($j=0;$j<count($mlsall);$j++){
    				$m=$mlsall[$j];
    				//$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
    				for($i=2;$i<count($fldu)-1-4;$i++){
    					$sheet=$sheet->setCellValueByColumnAndRow($i-2,$j+6,$m[$fldu[$i]].' ');
    	
    					$objActSheet->getStyle($zm[$i-2].''.($j+6))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	
    					$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].''.($j+6))->getBorders();
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				}
    				$sheet=$sheet->setCellValueByColumnAndRow($i-2,$j+6,' ');
    				 
    				$objActSheet->getStyle($zm[$i-2].''.($j+6))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    				 
    				$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].''.($j+6))->getBorders();
    				$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			}
    		}
    	
    	
//     		$sheet->mergeCells("A39:O39");
//     		$sheet=$sheet->setCellValueByColumnAndRow(0,39,'批卷老师：                                              班主任签字：');
//     		$sheet->mergeCells("A40:O40");
//     		$sheet=$sheet->setCellValueByColumnAndRow(0,40,'说明：  1、任课教师应于考试后三天内，登陆http://cjxy.cjlu.edu.cn录入成绩，');
//     		$sheet->mergeCells("A41:O41");
//     		$sheet=$sheet->setCellValueByColumnAndRow(0,41,'                 并将本表卷面成绩、习题分两项认真填写，一式两份，交格致北楼302办公室');
//     		$sheet->mergeCells("A42:O42");
//     		$sheet=$sheet->setCellValueByColumnAndRow(0,42,'            2、卷面成绩占总成绩的70%，平时成绩占总成绩的20%（由班主任评定），习题成绩占总成绩的10%。');
//     		$sheet->mergeCells("A43:O43");
//     		$sheet=$sheet->setCellValueByColumnAndRow(0,43,'                 总成绩=卷面成绩*0.7+平时成绩*0.2+习题成绩*0.1');
//     		$sheet->mergeCells("A44:O44");
//     		$sheet=$sheet->setCellValueByColumnAndRow(0,44,'            3、班主任请在收到此表后三天，将本表平时分项认真填写，一式两份。');
    	
    	
    		//设置居中
    	
    		//$objActSheet->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objActSheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    	
    	
    		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    		$objPHPExcel->setActiveSheetIndex(0);
    	
    	
    	
    	
    		// excel头参数
    		header('Content-Type: application/vnd.ms-excel');
    		header("Content-Disposition: attachment;filename=".$clsnm.'-'.$kcnm.'成绩单'.date("Ymd-His").".xls");  //日期为文件名后缀
    		header('Cache-Control: max-age=0');
    	
    		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式
    		$objWriter->save('php://output');
    	}
    	
    	if($biaoji=='kb'){
    		$mk=$_POST['mk'];
    		if($mk=='cjzx'){
    			$tmp=explode('f_cjzx_grdid', $_POST['cdt']);
    			$tmp=explode('-eq-',$tmp[1]);
    			$tmp=explode('-sp-',$tmp[1]);
    			$grdid=$tmp[0];
    			$grd=M('grd');
    			$grdo=$grd->where('grdid='.$grdid)->find();
    			$jn='tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid-jn-tb_stt ON f_cjzx_sttid=sttid-jn-tb_grd ON f_cjzx_grdid=grdid-jn-tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid-jn-tb_tcr ON f_pk_tcrid=tcrid-jn-tb_xq ON f_cjzx_xqid=xqid'.'-jn-tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid-jn-tb_bxxs ON f_mj_bxxsid=bxxsid-jn-tb_cc ON f_mj_ccid=ccid-jn-tb_kl ON f_mj_klid=klid-jn-tb_xxxs ON f_mj_xxxsid=xxxsid-jn-tb_zsfw ON f_mj_zsfwid=zsfwid-jn-tb_xz ON f_mj_xzid=xzid-jn-tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid-jn-tb_sex ON f_std_sexid=sexid-jn-tb_rc ON f_std_rcid=rcid-jn-tb_zzmm ON f_std_zzmmid=zzmmid-jn-tb_xl ON f_std_xlid=xlid-jn-tb_stat ON f_std_statid=statid';
    			$fldint='-cjzxid-stdno-stdnm-sexnm-cjzxzf-cjzxqmf-cjzxpsf-cjzxxtf-';
    			$jsn=array(
    	
    					'stdno'=>'学号',
    					'stdnm'=>'姓名',
    					'sexnm'=>'性别',
    					'cjzxzf'=>'总成绩',
    					'cjzxqmf'=>'卷面',
    					'cjzxpsf'=>'平时',
    					'cjzxxtf'=>'习题',
    			);
    		}
    		//NB初始化，开始
    		$m=M($grdo['grdnm'].'_cjzx')->join('tb_'.$grdo['grdnm'].'_std ON f_cjzx_stdid=stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');;
    	
    		$cdtint="-sp-";
    		$spccdtint='-sp-';
    		$odrint='-';
    		$lmtint=100;
    		//$jn='tb_ath ON f_athid=athid-jn-tb_atc ON f_athid=atcid';//若出现多个join
    		import('@.NB.NBAction');
    		$NB = new NBAction();
    		$arr=$NB->NB($m,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn,'y');
    		 
    		$fld='-cjzxid-stdno-stdnm-sexnm-cjzxzf-cjzxqmf-cjzxpsf-cjzxxtf-';
    		$mlsall=$arr['mlsforcount'];
    		$mo=$mlsall[0];
    		$bxxnm=$mo['bxxsnm'];
    		$clsnm=$mo['clsnm'];
    		$kcnm=$mo['kcnm'];
    		$xqnm=$mo['xqnm'];
    		$mjnm=$mo['mjnm'];
    		$mlsallfn=array();
    		foreach($mlsall as $v){
    			if(!preg_match('/'.$v['mjnm'].'/', $mjnm)){
    				$mjnm=$mjnm.'  '.$v['mjnm'];
    			}
    			$v['cjzxzf']='';
    			$v['cjzxqmf']='';
    			$v['cjzxpsf']='';
    			$v['cjzxxtf']='';
    			array_push($mlsallfn, $v);
    		}
    		$mlsall=$mlsallfn;
    		$zm=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    		import('@.ORG.PHPExcel');
    		// Create new PHPExcel object
    		$objPHPExcel = new PHPExcel();
    		// Set properties
    		$objPHPExcel->getProperties()->setCreator("ctos")
    		->setLastModifiedBy("ctos")
    		->setTitle("Office 2007 XLSX Test Document")
    		->setSubject("Office 2007 XLSX Test Document")
    		->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    		->setKeywords("office 2007 openxml php")
    		->setCategory("Test result file");
    	
    		//设置边框
    		//     	$objExcel = new PHPExcel();
    		//     	//$objExcel->setActiveSheetIndex(0);
    		//     	$objActSheet = $objExcel->getActiveSheet();
    		//     	$objStyleA5 = $objActSheet->getStyle('A5');
    		//     	$objBorderA5 = $objStyleA5->getBorders();
    		//     	$objBorderA5->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA5->getTop()->getColor()->setARGB('FFFF0000'); // color
    		//     	$objBorderA5->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA5->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA5->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	
    		//设置宽度
    		$objActSheet = $objPHPExcel->getActiveSheet();
    		//$objActSheet->getColumnDimension('A')->setAutoSize();
    		$objActSheet->getColumnDimension('A')->setWidth(12);
    		$objActSheet->getColumnDimension('B')->setWidth(7);
    		$objActSheet->getColumnDimension('C')->setWidth(5);
    		$objActSheet->getColumnDimension('D')->setWidth(6);
    		$objActSheet->getColumnDimension('E')->setWidth(5);
    		$objActSheet->getColumnDimension('F')->setWidth(5);
    		$objActSheet->getColumnDimension('G')->setWidth(5);
    	
    		$objActSheet->getColumnDimension('H')->setWidth(2);
    	
    		$objActSheet->getColumnDimension('I')->setWidth(12);
    		$objActSheet->getColumnDimension('J')->setWidth(7);
    		$objActSheet->getColumnDimension('K')->setWidth(5);
    		$objActSheet->getColumnDimension('L')->setWidth(6);
    		$objActSheet->getColumnDimension('M')->setWidth(5);
    		$objActSheet->getColumnDimension('N')->setWidth(5);
    		$objActSheet->getColumnDimension('O')->setWidth(5);
    	
    		for($i=5;$i<=38;$i++){
    			$objActSheet->getRowDimension(''.$i)->setRowHeight(15.55);
    	
    		}
    	
    	
    	
    		// set table header content列是从0开始，行是从1开始
    		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
    	
    		//     	$objBorderA1=$objPHPExcel->getActiveSheet()->getStyle('B8')->getBorders();
    		//     	$objBorderA1->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA1->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA1->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA1->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		//     	$objBorderA1->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	
    		$sheet=$objPHPExcel->setActiveSheetIndex(0);
    		$sheet->mergeCells("A1:O1");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,1,'中国计量学院'.$bxxsnm.'考试成绩登记表');
    		$sheet->mergeCells("A2:O2");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,2,$mjnm.' 专业  '.$clsnm.' 课程名称 '.'              ');
    		$sheet->mergeCells("A3:O3");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,3,'（'.$xqnm.'）');
    		//$sheet=$sheet->setCellValueByColumnAndRow(0,1,'序号');
    		$fldu=explode('-', $fld);
    		for($i=2;$i<count($fldu)-1;$i++){
    	
    			$sheet=$sheet->setCellValueByColumnAndRow($i-2,5,$jsn[$fldu[$i]]);
    	
    			$objActSheet->getStyle($zm[$i-2].'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].'5')->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		}
    		for($i=2;$i<count($fldu)-1;$i++){
    	
    			$sheet=$sheet->setCellValueByColumnAndRow($i+6,5,$jsn[$fldu[$i]]);
    	
    			$objActSheet->getStyle($zm[$i+6].'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i+6].'5')->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		}
    	
    		if(count($mlsall)>33){
    			//Miscellaneous glyphs, UTF-8
    			for($j=0;$j<33;$j++){
    				$m=$mlsall[$j];
    				//$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
    				for($i=2;$i<count($fldu)-1;$i++){
    					$sheet=$sheet->setCellValueByColumnAndRow($i-2,$j+6,$m[$fldu[$i]].' ');
    	
    					$objActSheet->getStyle($zm[$i-2].''.($j+6))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	
    					$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].''.($j+6))->getBorders();
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				}
    			}
    			for($j=33;$j<count($mlsall);$j++){
    				$m=$mlsall[$j];
    				//$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
    				for($i=2;$i<count($fldu)-1;$i++){
    					$sheet=$sheet->setCellValueByColumnAndRow($i+6,$j+6-33,$m[$fldu[$i]].' ');
    	
    					$objActSheet->getStyle($zm[$i+6].''.($j+6-33))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	
    					$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i+6].''.($j+6-33))->getBorders();
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				}
    			}
    		}else{
    			//Miscellaneous glyphs, UTF-8
    			for($j=0;$j<count($mlsall);$j++){
    				$m=$mlsall[$j];
    				//$sheet=$sheet->setCellValueByColumnAndRow(0,$j+2,$j+1);
    				for($i=2;$i<count($fldu)-1;$i++){
    					$sheet=$sheet->setCellValueByColumnAndRow($i-2,$j+6,$m[$fldu[$i]].' ');
    	
    					$objActSheet->getStyle($zm[$i-2].''.($j+6))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	
    					$objBorder=$objPHPExcel->getActiveSheet()->getStyle($zm[$i-2].''.($j+6))->getBorders();
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    					$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    				}
    			}
    		}
    	
    	
    		$sheet->mergeCells("A39:O39");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,39,'批卷老师：                                              班主任签字：');
    		$sheet->mergeCells("A40:O40");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,40,'说明：  1、任课教师应于考试后三天内，登陆http://cjxy.cjlu.edu.cn录入成绩，');
    		$sheet->mergeCells("A41:O41");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,41,'                 并将本表卷面成绩、习题分两项认真填写，一式两份，交格致北楼302办公室');
    		$sheet->mergeCells("A42:O42");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,42,'            2、卷面成绩占总成绩的70%，平时成绩占总成绩的20%（由班主任评定），习题成绩占总成绩的10%。');
    		$sheet->mergeCells("A43:O43");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,43,'                 总成绩=卷面成绩*0.7+平时成绩*0.2+习题成绩*0.1');
    		$sheet->mergeCells("A44:O44");
    		$sheet=$sheet->setCellValueByColumnAndRow(0,44,'            3、班主任请在收到此表后三天，将本表平时分项认真填写，一式两份。');
    	
    	
    		//设置居中
    	
    		//$objActSheet->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objActSheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    	
    	
    		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    		$objPHPExcel->setActiveSheetIndex(0);
    	
    	
    	
    	
    		// excel头参数
    		header('Content-Type: application/vnd.ms-excel');
    		header("Content-Disposition: attachment;filename=".$clsnm.'-'.$kcnm.'成绩单'.date("Ymd-His").".xls");  //日期为文件名后缀
    		header('Cache-Control: max-age=0');
    	
    		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式
    		$objWriter->save('php://output');
    	}
    }
    
    function import(){
    	//include "PHPExcel/Classes/phpExcel/Writer/IWriter.php";
    	//include "PHPExcel/Classes/phpExcel/Writer/Excel5.php";
    	//require_once 'PHPExcel/Classes/phpExcel/Writer/Excel2007.php';
    	//require_once 'PHPExcel/Classes/PHPExcel.php';
    	//include 'PHPExcel/Classes/phpExcel/IOFactory.php';
    	import('@.ORG.PHPExcel');
    	//设定缓存模式为经gzip压缩后存入cache（PHPExcel导入导出及大量数据导入缓存方式的修改 ）
    	$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
    	$cacheSettings = array();
    	PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);
    	
    	$objPHPExcel = new PHPExcel();
    	// $con = mysql_connect("localhost","root","123456");
    	// mysql_select_db('bms');
    	//读入上传文件
    	if($_POST){
    		//$objPHPExcel = PHPExcel_IOFactory::load($_FILES["inputExcel"]["tmp_name"]);
    		$objPHPExcel = PHPExcel_IOFactory::load($_POST['inputExcel']);
//     		$reader = PHPExcel_IOFactory::createReader('Excel2007'); // 读取 excel 文件
    		
//     		$PHPExcel = PHPExcel_IOFactory::load("test.xls");
    		//内容转换为数组
    		$indata = $objPHPExcel->getSheet(0)->toArray();
    		//p($indata);die;
    		//    print_r($indata );die;
    		//excel  sheet个数
    		//echo $objPHPExcel->getSheetCount();die;
    		 
    		//把数据新增到mysql数据库中
//     		foreach($indata as $item){
//     			$sql = "insert into field(value,parent_id) values('$item[1]','$item[2]')";
//     			mysql_query($sql);
//     		}
//-----------------------------处理得到的数据，一般原则都是有则改之，无则加冕
if($_POST['mk']=='usr'){
	import('@.XLS.UsrXLSAction');
	$usrxa = new UsrXLSAction();
	$usrxa->update($indata);
	$data['status']=1;
	$this->ajaxReturn($data,'json');
	
}
//---------------------------   		
    	}
    	//查看是否导入成功
//     	$sql1="select * from field";
//     	$query = mysql_query($sql1);
//     	while($data = mysql_fetch_array($query)){
//     		echo $data['value'];
//     	}
    }
   
}