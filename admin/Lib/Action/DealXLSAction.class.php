<?php
// 本类由系统自动生成，仅供测试用途
class DealXLSAction extends Action {
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
    	//NB初始化，开始
    	$m=M($mk);
    	
    	$cdtint="-sp-";
    	$spccdtint='-sp-';
    	$odrint='-';
    	$lmtint=20;
    	//$jn='tb_ath ON f_athid=athid-jn-tb_atc ON f_athid=atcid';//若出现多个join
    	import('@.NB.NBAction');
    	$NB = new NBAction();
    	$arr=$NB->NB($m,$fldint,$cdtint,$spccdtint,$odrint,$lmtint,$jn,'y');
    	$fld=$arr['fld'];
    	//去 f_...//先拆开，后结合的方式
    	$fldu=explode('-', $fld);
    	$fldnw='-';
    	for($i=1;$i<count($fldu)-1;$i++){
    		if(!preg_match('/f_/', $fldu[$i])){
    			$fldnw=$fldnw.$fldu[$i].'-';
    		}
    	}
    	$fld=$fldnw;
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
    
    function import(){
    	//显示为utf8
    	header("Content-Type: text/html;charset=utf-8");

    	$std=D('Std');
    	
    	import('@.ORG.PHPExcel');
    	//设定缓存模式为经gzip压缩后存入cache（PHPExcel导入导出及大量数据导入缓存方式的修改 ）
    	$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
    	$cacheSettings = array();
    	PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);
    	
    	$objPHPExcel = new PHPExcel();
    	
    	//读入上传文件
    	$inputXLS='XFile/zhishuban.xls';
    	
		//$objPHPExcel = PHPExcel_IOFactory::load($_FILES["inputExcel"]["tmp_name"]);
		$objPHPExcel = PHPExcel_IOFactory::load($inputXLS);
//     		$reader = PHPExcel_IOFactory::createReader('Excel2007'); // 读取 excel 文件
		
//     		$PHPExcel = PHPExcel_IOFactory::load("test.xls");
		//内容转换为数组
		$indata = $objPHPExcel->getSheet(0)->toArray();



		//处理数据
		for($i=0;$i<count($indata);$i++){
			$ckcjo=$indata[$i];
			
			
			//给xls写入
			
	    	// Set properties
	    	$objPHPExcel->getProperties()->setCreator("ctos")
	    	->setLastModifiedBy("ctos")
	    	->setTitle("Office 2007 XLSX Test Document")
	    	->setSubject("Office 2007 XLSX Test Document")
	    	->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
	    	->setKeywords("office 2007 openxml php")
	    	->setCategory("Test result file");
	    	
	    	$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
	    	$sheet=$objPHPExcel->setActiveSheetIndex(0);
	    	//设置表头
	    	if($i===0){
	    		for($j=0;$j<count($ckcjo);$j++){
	    			$sheet=$sheet->setCellValueByColumnAndRow($j,1,$ckcjo[$j].' ');
	    		}
	    		$sheet=$sheet->setCellValueByColumnAndRow(13,1,'班级');
	    	}else{
	    		
	    		for($j=0;$j<count($ckcjo);$j++){
	    			$sheet=$sheet->setCellValueByColumnAndRow($j,$i+1,$ckcjo[$j].' ');
	    		}
	    		//根据身份证查询班级信息
	    		$clsnm=$std->giveclsnmfromckxls($ckcjo['8']);
	    		$sheet=$sheet->setCellValueByColumnAndRow(13,$i+1,$clsnm);
	    	}
	    	
	    	
	    	
	    	
	    	//  sheet命名
	    	//$objPHPExcel->getActiveSheet()->setTitle('订单汇总表');
	    	
	    	
	    	
		}
	
    	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    	$objPHPExcel->setActiveSheetIndex(0);
    	
    	
    	// excel头参数
    	header('Content-Type: application/vnd.ms-excel');
    	header("Content-Disposition: attachment;filename=zhishubanS.xls");  //日期为文件名后缀
    	header('Cache-Control: max-age=0');
    	
    	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式
    	$objWriter->save('php://output');

    }
    ####
    function importck(){
        //显示为utf8
        header("Content-Type: text/html;charset=utf-8");

        $std=D('Std');
        
        import('@.ORG.PHPExcel');
        //设定缓存模式为经gzip压缩后存入cache（PHPExcel导入导出及大量数据导入缓存方式的修改 ）
        $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
        $cacheSettings = array();
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);
        
        $objPHPExcel = new PHPExcel();

        #####################################
         //读入上传文件
        $inputXLS='XFile/kszmd.xls';
        
        //$objPHPExcel = PHPExcel_IOFactory::load($_FILES["inputExcel"]["tmp_name"]);
        $objPHPExcel = PHPExcel_IOFactory::load($inputXLS);
//          $reader = PHPExcel_IOFactory::createReader('Excel2007'); // 读取 excel 文件
        
//          $PHPExcel = PHPExcel_IOFactory::load("test.xls");
        //内容转换为数组
        $indata = $objPHPExcel->getSheet(0)->toArray();
       //处理数据
        for($i=1;$i<count($indata);$i++){
            $bmo=$indata[$i];
            $std->adddbtbck($bmo);
           
        }
        #######################
        p('#########################');
        ###########################################
        //读入上传文件
        $inputXLS='XFile/zhishuban.xls';
        
        //$objPHPExcel = PHPExcel_IOFactory::load($_FILES["inputExcel"]["tmp_name"]);
        $objPHPExcel = PHPExcel_IOFactory::load($inputXLS);
//          $reader = PHPExcel_IOFactory::createReader('Excel2007'); // 读取 excel 文件
        
//          $PHPExcel = PHPExcel_IOFactory::load("test.xls");
        //内容转换为数组
        $indata = $objPHPExcel->getSheet(0)->toArray();
        //处理数据
        for($i=1;$i<count($indata);$i++){
            $ckcjo=$indata[$i];
            $std->mdfdbtbck($ckcjo);
           
        }
    }
   

}