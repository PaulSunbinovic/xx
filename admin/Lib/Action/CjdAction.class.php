<?php 

//规矩：需要display的 就mo mls 不需要的 只要uo uls 之类，方便批量移植
class CjdAction extends Action{
	

	
	
	
	function createExctcls(){
		$cls=M('cls');
		$clsls=$cls->where('f_cls_sttid='.$_POST['f_std_sttid'].' AND f_cls_grdid='.$_POST['f_std_grdid']." AND clsactvt='y'")->select();
		
		$clsoptu="<option value='0'>无</option>";
		foreach ($clsls as $v){
			$clsoptu=$clsoptu."<option value='".$v['clsid']."'>".$v['clsnm']."</option>";
		}
		$data['clsoptu']=$clsoptu;
		$data['stdoptu']="<option value='0'>无</option>";
		$data['status']=1;
		$this->ajaxReturn($data,'json');
	}
	
	public function dycjd(){
    	//先去数据库找出你要让哪些数据出来
    	header("Content-Type:text/html; charset=utf-8");
    	
    	//首先获取基本信息
    	$grdid=$_GET['grdid'];
    	$grd=M('grd');
    	$grdo=$grd->where('grdid='.$grdid)->find();
    	$sttid=$_GET['sttid'];
    	$xqid=$_GET['xqid'];
    	$stdid=$_GET['stdid'];
    	//先获取学生信息
    	$std=M($grdo['grdnm'].'_std')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
		$stdo=$std->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND stdid=".$stdid)->find();
		$pl=M($grdo['grdnm'].'_pl');
		$plo=$pl->where("f_pl_grdid=".$grdid." AND f_pl_sttid=".$sttid." AND f_pl_xqid=".$xqid." AND f_pl_stdid=".$stdid)->find();
				
		$cjzx=M($grdo['grdnm'].'_cjzx');
    	$cjzxlsfzk=$cjzx->join('tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid')->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->where("f_cjzx_grdid=".$grdid." AND f_cjzx_sttid=".$sttid." AND f_cjzx_xqid=".$xqid." AND f_cjzx_stdid=".$stdid.' AND pkzkkm=0')->order('kcnm ASC')->select();//非自考
    	$cjzxlszk=$cjzx->join('tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid')->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->where("f_cjzx_grdid=".$grdid." AND f_cjzx_sttid=".$sttid." AND f_cjzx_xqid=".$xqid." AND f_cjzx_stdid=".$stdid.' AND pkzkkm=1')->order('kcnm ASC')->select();//自考
    	
    	$clsid=$stdo['f_stdxqcls_clsid'];
    	$bzr=M($grdo['grdnm'].'_bzr');
    	$bzro=$bzr->join('tb_usr ON f_bzr_usrid=usrid')->where('f_bzr_clsid='.$clsid)->find();
    	
    	$jintian=date("Y年m月d日",time());
    	
    	$jq=M('jq');
    	$jqo=$jq->join('tb_stt ON f_jq_sttid=sttid')->join('tb_xq ON f_jq_xqid=xqid')->where('f_jq_sttid='.$stdo['f_std_sttid'].' AND f_jq_xqid='.$stdo['f_stdxqcls_xqid'])->find();
    	$time = strtotime($jqo['jqqs']);
    	$jqo['jqqs']=date('n月j日',$time);
    	$time = strtotime($jqo['jqjs']);
    	$jqo['jqjs']=date('n月j日',$time);
    	$time = strtotime($jqo['jqljc']);
    	$jqo['jqljc']=date('n月j日',$time);
    	$smj='';//什么假
    	if(preg_match('/第2学期/',$jqo['xqnm'])){
    		$smj='暑假';
    	}else{
    		$smj='寒假';
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
    	 


    	//设置宽度
    	$objActSheet = $objPHPExcel->getActiveSheet();
    	//$objActSheet->getColumnDimension('A')->setAutoSize();
    	$objActSheet->getColumnDimension('A')->setWidth(0);
    	$objActSheet->getColumnDimension('B')->setWidth(5);
    	$objActSheet->getColumnDimension('C')->setWidth(26);
    	$objActSheet->getColumnDimension('D')->setWidth(13);
    	
    	$objActSheet->getColumnDimension('E')->setWidth(12);
    	$objActSheet->getColumnDimension('F')->setWidth(12);
    	 
    	$objActSheet->getColumnDimension('G')->setWidth(5);
    	$objActSheet->getColumnDimension('H')->setWidth(26);
    	$objActSheet->getColumnDimension('I')->setWidth(13);

    	
    	
    	
    	//-------------下半部分为必填
    	$sheet=$objPHPExcel->setActiveSheetIndex(0);
    	
    	
    	//左半页
    	$qsh=1;$hg=19;$zh=12;$bthg=25;$btzh=14;//起始行 行高 字号 标题行高 标题字号
    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'中国计量学院继续教育学院');
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
    	$objFont->setBold(true);
    	$objFont->setName('黑体');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
    	
    	$qsh=2;$hg=19;$zh=12;$bthg=16;$btzh=12;
    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,$stdo['bxxsnm']);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
    	
    	$qsh=3;$hg=19;$zh=12;$bthg=16;$btzh=12;
    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,$stdo['xqnm'].' 学生成绩报告单');
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
    	
    	$qsh=4;$hg=19;$zh=12;$bthg=16;$btzh=12;
    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'');
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
    	
    	$qsh=5;$hg=19;$zh=12;$bthg=16;$btzh=12;
    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'姓名:  '.$stdo['stdnm'].'   学号:  '.$stdo['stdno']);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
    	
    	
    	
    	$qsh=6;$hg=19;$zh=12;$bthg=16;$btzh=12;
    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'班级:  '.$stdo['clsnm']);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
    	
    	$qsh=7;$hg=19;$zh=12;$bthg=20;$btzh=12;
    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'专业:  '.$stdo['mjnm']);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
    	
    	
    	if(preg_match('/技能/',$stdo['bxxsnm'])){
    		
    		//期末成绩
    		$qsh=8;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=11;//最大行数
    		if($zdhs<count($cjzxlsfzk)){
    			$zdhs=count($cjzxlsfzk);
    		}
    		$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
    		$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'学生期末考试成绩');
    		$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    		$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
    		$objFont->setBold(true);
    		$objFont->setName('楷体_GB2312');
    		$objFont->setSize($btzh);
    		$objFont->getColor()->setARGB('FF000000');
    		$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
    		 
    		$sheet->setCellValueByColumnAndRow(1,($qsh+1),'序号');
    		$objActSheet->getStyle('B'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('B'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+1))->getBorders();
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objFont = $objActSheet->getStyle('B'.($qsh+1))->getFont();
    		$objFont->setName('楷体_GB2312');
    		$objFont->setSize($zh);
    		$objFont->getColor()->setARGB('FF000000');
    		 
    		$sheet->setCellValueByColumnAndRow(2,($qsh+1),'课程名称');
    		$objActSheet->getStyle('C'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('C'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+1))->getBorders();
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objFont = $objActSheet->getStyle('C'.($qsh+1))->getFont();
    		$objFont->setName('楷体_GB2312');
    		$objFont->setSize($zh);
    		$objFont->getColor()->setARGB('FF000000');
    		 
    		$sheet->setCellValueByColumnAndRow(3,($qsh+1),'考试成绩');
    		$objActSheet->getStyle('D'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('D'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+1))->getBorders();
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objFont = $objActSheet->getStyle('D'.($qsh+1))->getFont();
    		$objFont->setName('楷体_GB2312');
    		$objFont->setSize($zh);
    		$objFont->getColor()->setARGB('FF000000');
    		 
    		$objActSheet->getRowDimension(''.($qsh+1))->setRowHeight($hg);
    		 
    		 
    		 
    		for($i=0;$i<count($cjzxlsfzk);$i++){
    		
    			$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh+$i+2,$i+1);
    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objFont = $objActSheet->getStyle('B'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    		
    			$sheet=$sheet->setCellValueByColumnAndRow(2,$qsh+$i+2,$cjzxlsfzk[$i]['kcnm']);
    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objFont = $objActSheet->getStyle('C'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			if(mb_strlen($cjzxlsfzk[$i]['kcnm'],'utf-8')<11){
	    				$objFont->setSize($zh);
	    			}else{
	    				$objFont->setSize('10');
	    			}
    			$objFont->getColor()->setARGB('FF000000');
    		
    			$sheet=$sheet->setCellValueByColumnAndRow(3,$qsh+$i+2,$cjzxlsfzk[$i]['cjzxzf']);
    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			$objFont = $objActSheet->getStyle('D'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    		
    			$objActSheet->getRowDimension(''.$qsh+$i+2)->setRowHeight($hg);
    			 
    		}
    		$k=$i;
    		for($i=$k;$i<$zdhs;$i++){
    			 
    			$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh+$i+2,$i+1);
    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			if($i==$zdhs-1){
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			}else{
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			}
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objFont = $objActSheet->getStyle('B'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    			 
    			$sheet=$sheet->setCellValueByColumnAndRow(2,$qsh+$i+2,'');
    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			if($i==$zdhs-1){
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			}else{
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			}
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objFont = $objActSheet->getStyle('C'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    			 
    			$sheet=$sheet->setCellValueByColumnAndRow(3,$qsh+$i+2,'');
    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			if($i==$zdhs-1){
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			}else{
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			}
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			$objFont = $objActSheet->getStyle('D'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    			 
    			$objActSheet->getRowDimension(''.$qsh+$i+2)->setRowHeight($hg);
    			 
    		}
    		
    	}else if(preg_match('/自考/', $stdo['bxxsnm'])){
    		//期末成绩
    		$qsh=8;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=6;//最大行数
    		if($zdhs<count($cjzxlsfzk)){
    			$zdhs=count($cjzxlsfzk);
    		}
    		$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
    		$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'学生期末考试成绩');
    		$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    		$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
    		$objFont->setBold(true);
    		$objFont->setName('楷体_GB2312');
    		$objFont->setSize($btzh);
    		$objFont->getColor()->setARGB('FF000000');
    		$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
    		 
    		$sheet->setCellValueByColumnAndRow(1,($qsh+1),'序号');
    		$objActSheet->getStyle('B'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('B'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+1))->getBorders();
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objFont = $objActSheet->getStyle('B'.($qsh+1))->getFont();
    		$objFont->setName('楷体_GB2312');
    		$objFont->setSize($zh);
    		$objFont->getColor()->setARGB('FF000000');
    		 
    		$sheet->setCellValueByColumnAndRow(2,($qsh+1),'课程名称');
    		$objActSheet->getStyle('C'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('C'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+1))->getBorders();
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objFont = $objActSheet->getStyle('C'.($qsh+1))->getFont();
    		$objFont->setName('楷体_GB2312');
    		$objFont->setSize($zh);
    		$objFont->getColor()->setARGB('FF000000');
    		 
    		$sheet->setCellValueByColumnAndRow(3,($qsh+1),'考试成绩');
    		$objActSheet->getStyle('D'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('D'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+1))->getBorders();
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objFont = $objActSheet->getStyle('D'.($qsh+1))->getFont();
    		$objFont->setName('楷体_GB2312');
    		$objFont->setSize($zh);
    		$objFont->getColor()->setARGB('FF000000');
    		 
    		$objActSheet->getRowDimension(''.($qsh+1))->setRowHeight($hg);
    		 
    		 
    		 
    		for($i=0;$i<count($cjzxlsfzk);$i++){
    		
    			$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh+$i+2,$i+1);
    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objFont = $objActSheet->getStyle('B'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    		
    			$sheet=$sheet->setCellValueByColumnAndRow(2,$qsh+$i+2,$cjzxlsfzk[$i]['kcnm']);
    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objFont = $objActSheet->getStyle('C'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			if(mb_strlen($cjzxlsfzk[$i]['kcnm'],'utf-8')<11){
    				$objFont->setSize($zh);
    			}else{
    				$objFont->setSize('10');
    			}
    			$objFont->getColor()->setARGB('FF000000');
    		
    			$sheet=$sheet->setCellValueByColumnAndRow(3,$qsh+$i+2,$cjzxlsfzk[$i]['cjzxzf']);
    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			$objFont = $objActSheet->getStyle('D'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    		
    			$objActSheet->getRowDimension(''.$qsh+$i+2)->setRowHeight($hg);
    			 
    		}
    		$k=$i;
    		for($i=$k;$i<$zdhs;$i++){
    			 
    			$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh+$i+2,$i+1);
    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			if($i==$zdhs-1){
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			}else{
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			}
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objFont = $objActSheet->getStyle('B'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    			 
    			$sheet=$sheet->setCellValueByColumnAndRow(2,$qsh+$i+2,'');
    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			if($i==$zdhs-1){
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			}else{
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			}
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objFont = $objActSheet->getStyle('C'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    			 
    			$sheet=$sheet->setCellValueByColumnAndRow(3,$qsh+$i+2,'');
    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			if($i==$zdhs-1){
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			}else{
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			}
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			$objFont = $objActSheet->getStyle('D'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    			 
    			$objActSheet->getRowDimension(''.$qsh+$i+2)->setRowHeight($hg);
    			 
    		}
    		//参加国家统考
    		$qsh=8+$zdhs+3;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=5;//最大行数
    		if($zdhs<count($cjzxlszk)){
    			$zdhs=count($cjzxlszk);
    		}
    		
    		$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
    		$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'本学期参加国家统考情况');
    		$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    		$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
    		$objFont->setBold(true);
    		$objFont->setName('楷体_GB2312');
    		$objFont->setSize($btzh);
    		$objFont->getColor()->setARGB('FF000000');
    		$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
    		
    		$sheet->setCellValueByColumnAndRow(1,($qsh+1),'序号');
    		$objActSheet->getStyle('B'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('B'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+1))->getBorders();
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objFont = $objActSheet->getStyle('B'.($qsh+1))->getFont();
    		$objFont->setName('楷体_GB2312');
    		$objFont->setSize($zh);
    		$objFont->getColor()->setARGB('FF000000');
    		
    		$sheet->setCellValueByColumnAndRow(2,($qsh+1),'课程名称');
    		$objActSheet->getStyle('C'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('C'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+1))->getBorders();
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objFont = $objActSheet->getStyle('C'.($qsh+1))->getFont();
    		$objFont->setName('楷体_GB2312');
    		$objFont->setSize($zh);
    		$objFont->getColor()->setARGB('FF000000');
    		
    		$sheet->setCellValueByColumnAndRow(3,($qsh+1),'考试成绩');
    		$objActSheet->getStyle('D'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objActSheet->getStyle('D'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+1))->getBorders();
    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    		$objFont = $objActSheet->getStyle('D'.($qsh+1))->getFont();
    		$objFont->setName('楷体_GB2312');
    		$objFont->setSize($zh);
    		$objFont->getColor()->setARGB('FF000000');
    		
    		$objActSheet->getRowDimension(''.($qsh+1))->setRowHeight($hg);
    		
    		
    		
    		for($i=0;$i<count($cjzxlszk);$i++){
    			 
    			$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh+$i+2,$i+1);
    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objFont = $objActSheet->getStyle('B'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    			 
    			$sheet=$sheet->setCellValueByColumnAndRow(2,$qsh+$i+2,$cjzxlszk[$i]['kcnm']);
    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objFont = $objActSheet->getStyle('C'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			if(mb_strlen($cjzxlszk[$i]['kcnm'],'utf-8')<11){
    				$objFont->setSize($zh);
    			}else{
    				$objFont->setSize('10');
    			}
    			$objFont->getColor()->setARGB('FF000000');
    			 
    			if(is_numeric($cjzxlszk[$i]['cjzxzf'])&&$cjzxlszk[$i]['cjzxzf']<60){
    				$cjzxlszk[$i]['cjzxzf']='未通过';
    			}
    			$sheet=$sheet->setCellValueByColumnAndRow(3,$qsh+$i+2,$cjzxlszk[$i]['cjzxzf']);
    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			$objFont = $objActSheet->getStyle('D'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    			 
    			$objActSheet->getRowDimension(''.$qsh+$i+2)->setRowHeight($hg);
    			 
    		}
    		$k=$i;
    		for($i=$k;$i<$zdhs;$i++){
    			 
    			$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh+$i+2,$i+1);
    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			if($i==$zdhs-1){
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			}else{
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			}
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objFont = $objActSheet->getStyle('B'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    			 
    			$sheet=$sheet->setCellValueByColumnAndRow(2,$qsh+$i+2,'');
    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			if($i==$zdhs-1){
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			}else{
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			}
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objFont = $objActSheet->getStyle('C'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    			 
    			$sheet=$sheet->setCellValueByColumnAndRow(3,$qsh+$i+2,'');
    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+$i+2))->getBorders();
    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			if($i==$zdhs-1){
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			}else{
    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			}
    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    			$objFont = $objActSheet->getStyle('D'.($qsh+$i+2))->getFont();
    			$objFont->setName('楷体_GB2312');
    			$objFont->setSize($zh);
    			$objFont->getColor()->setARGB('FF000000');
    			 
    			$objActSheet->getRowDimension(''.$qsh+$i+2)->setRowHeight($hg);
    			 
    		}
    	}
    	
    	
    	
		$qsh=$qsh+$i+3;$hg=19;$zh=12;$bthg=20;$btzh=12;
    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,$smj.'时间：');
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
    	$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
    	
    	
    	$qsh=$qsh+1;$hg=19;$zh=12;$bthg=20;$btzh=12;
    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,$jqo['jqqs'].'——'.$jqo['jqjs']);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	
    	
    	$qsh=$qsh+1;$hg=19;$zh=12;$bthg=20;$btzh=12;
    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,$jqo['jqljc'].'报到注册，领教材、课表');
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	
		//右半边
    	
    	//
    	$qsh=1;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
    	$sheet->setCellValueByColumnAndRow(6,$qsh,'上学期综合量化排名：');
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
    	$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($zh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	//H1 I1
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('H'.$qsh)->getBorders();
    	$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
    	$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	 
    	 
    	
    	//
    	//
    	$qsh=2;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
    	$sheet->setCellValueByColumnAndRow(6,$qsh,'班主任评语：');
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($zh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	//I1
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	 
    	 
    	
    	// 
    	$qsh=3;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
    	$sheet->mergeCells("G".$qsh.':'.'I'.($qsh+10));
    	$sheet->setCellValueByColumnAndRow(6,$qsh,$plo['plctt']);
    	$objActSheet->getStyle('G'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setWrapText(true);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($zh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	///左侧连续
    	for($i=$qsh+1;$i<=$qsh+10;$i++){
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getBorders();
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	}
    	//右侧连续
		for($i=$qsh;$i<=$qsh+10;$i++){
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getBorders();
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	}
    	
    	//
    	$qsh=14;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
    	$sheet->setCellValueByColumnAndRow(6,$qsh,'班主任：'.$bzro['usrnn']);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($zh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	//I1
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	
    	//
    	$qsh=15;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
    	$sheet->setCellValueByColumnAndRow(6,$qsh,$jintian);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($zh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	//H1 I1
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('H'.$qsh)->getBorders();
    	$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
    	$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	
    	//家长回执
    	$qsh=17;$hg=19;$zh=12;$bthg=18;$btzh=12;//最大行数
    	    	
    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(6,$qsh,'家长回执');
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
    	
    	//
    	$qsh=18;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
    	$sheet->setCellValueByColumnAndRow(6,$qsh,'对您孩子成绩的意见');
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
    	$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($zh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	//H1 I1
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('H'.$qsh)->getBorders();
    	$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
    	$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	 
    	 
    	 
    	 
    	
    	// 
    	$qsh=19;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
    	$sheet->mergeCells("G".$qsh.':'.'I'.($qsh+1));
    	$sheet->setCellValueByColumnAndRow(6,$qsh,'');
    	$objActSheet->getStyle('G'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setWrapText(true);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($zh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	///左侧连续
    	for($i=$qsh+1;$i<=$qsh+1;$i++){
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getBorders();
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	}
    	//右侧连续
		for($i=$qsh;$i<=$qsh+1;$i++){
    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getBorders();
    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	}
    	
    	
    	//
    	$qsh=21;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
    	$sheet->setCellValueByColumnAndRow(6,$qsh,'对学校的要求和意见');
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($zh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	//H1 I1
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('H'.$qsh)->getBorders();
    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	
    	
    	
    	
    	 
    	//
    	$qsh=22;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
    	$sheet->mergeCells("G".$qsh.':'.'I'.($qsh+1));
    	$sheet->setCellValueByColumnAndRow(6,$qsh,'');
    	$objActSheet->getStyle('G'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    			$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
    			$objActSheet->getStyle('G'.$qsh)->getAlignment()->setWrapText(true);
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
    			//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($zh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	///左侧连续
    	for($i=$qsh+1;$i<=$qsh+1;$i++){
    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getBorders();
    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	}
    	//右侧连续
    	for($i=$qsh;$i<=$qsh+1;$i++){
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getBorders();
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	}
    	
    	
    	//
    	$qsh=24;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
    	$sheet->setCellValueByColumnAndRow(6,$qsh,'家长签名：                                             ');
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($zh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	//I1
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	
    	//
    	$qsh=25;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
    	$sheet->setCellValueByColumnAndRow(6,$qsh,'      年   月  日');
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($zh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	//H1 I1
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('H'.$qsh)->getBorders();
    	$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
    	$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
    	
    	
    	$qsh=26;$hg=19;$zh=12;$bthg=20;$btzh=12;
    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(6,$qsh,'家庭地址：');
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	
    	
    	$qsh=27;$hg=19;$zh=12;$bthg=20;$btzh=12;
    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(6,$qsh,'邮编：        联系电话：');
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	//$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	
    	 
    	$qsh=28;$hg=19;$zh=12;$bthg=20;$btzh=12;
    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
    	$sheet=$sheet->setCellValueByColumnAndRow(6,$qsh,'注：下学期开学时，学生凭此回条报到注册。');
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
    	$objFont->setBold(true);
    	$objFont->setName('楷体_GB2312');
    	$objFont->setSize($btzh);
    	$objFont->getColor()->setARGB('FF000000');
    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
    	 
    	 
    	
		
    	
    	
    	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    	$objPHPExcel->setActiveSheetIndex(0);
    	 
    	
    	
    	 
    	// excel头参数
    	header('Content-Type: application/vnd.ms-excel');
    	header("Content-Disposition: attachment;filename=".$stdo['stdnm'].$xno['xnnm'].$xqo['xqnm']."成绩单.xls");  //日期为文件名后缀
    	header('Cache-Control: max-age=0');
    	 
    	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式
    	$objWriter->save('php://output');
    	
    	
    	
    	
    }
    
    
    public function pldycjd(){
    	//先去数据库找出你要让哪些数据出来
    	header("Content-Type:text/html; charset=utf-8");
    	
    	//首先获取基本信息
    	$grdid=$_GET['grdid'];
    	$grd=M('grd');
    	$grdo=$grd->where('grdid='.$grdid)->find();
    	$sttid=$_GET['sttid'];
    	$xqid=$_GET['xqid'];
    	$clsid=$_GET['clsid'];
    	//先获取学生信息
    	$std=M($grdo['grdnm'].'_std')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
		$stdls=$std->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqcls_clsid=".$clsid.' AND f_std_statid=5')->order('f_mj_bxxsid ASC,clsid ASC,mjid ASC,stdno ASC')->select();
		
		$pl=M($grdo['grdnm'].'_pl');
		$cjzx=M($grdo['grdnm'].'_cjzx');
		$stdlsfn=array();
		foreach ($stdls as $v){
			$plo=$pl->where("f_pl_grdid=".$grdid." AND f_pl_sttid=".$sttid." AND f_pl_xqid=".$xqid." AND f_pl_stdid=".$v['stdid'])->find();
			$v['plo']=$plo;
			$cjzxlsfzk=$cjzx->join('tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid')->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->where("f_cjzx_grdid=".$grdid." AND f_cjzx_sttid=".$sttid." AND f_cjzx_xqid=".$xqid." AND f_cjzx_stdid=".$v['stdid'].' AND pkzkkm=0')->order('kcnm ASC')->select();//非自考
			$cjzxlszk=$cjzx->join('tb_'.$grdo['grdnm'].'_pk ON f_cjzx_pkid=pkid')->join('tb_'.$grdo['grdnm'].'_kc ON f_pk_kcid=kcid')->where("f_cjzx_grdid=".$grdid." AND f_cjzx_sttid=".$sttid." AND f_cjzx_xqid=".$xqid." AND f_cjzx_stdid=".$v['stdid'].' AND pkzkkm=1')->order('kcnm ASC')->select();//自考
			$v['cjzxlsfzk']=$cjzxlsfzk;
			$v['cjzxlszk']=$cjzxlszk;
			array_push($stdlsfn, $v);
		}
		
		
				
		
    	
    	$bzr=M($grdo['grdnm'].'_bzr');
    	$bzro=$bzr->join('tb_usr ON f_bzr_usrid=usrid')->where('f_bzr_clsid='.$clsid)->find();
    	
    	$jintian=date("Y年m月d日",time());
    	
    	$jq=M('jq');
    	$jqo=$jq->join('tb_stt ON f_jq_sttid=sttid')->join('tb_xq ON f_jq_xqid=xqid')->where('f_jq_sttid='.$sttid.' AND f_jq_xqid='.$xqid)->find();
    	$time = strtotime($jqo['jqqs']);
    	$jqo['jqqs']=date('n月j日',$time);
    	$time = strtotime($jqo['jqjs']);
    	$jqo['jqjs']=date('n月j日',$time);
    	$time = strtotime($jqo['jqljc']);
    	$jqo['jqljc']=date('n月j日',$time);
    	$smj='';//什么假
    	if(preg_match('/第2学期/',$jqo['xqnm'])){
    		$smj='暑假';
    	}else{
    		$smj='寒假';
    	}
    	

    	$cls=M($grdo['grdnm'].'_cls');
    	$clso=$cls->where('clsid='.$clsid)->find();
    	
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
    	 


    	//设置宽度
    	$objActSheet = $objPHPExcel->getActiveSheet();
    	//$objActSheet->getColumnDimension('A')->setAutoSize();
    	$objActSheet->getColumnDimension('A')->setWidth(0);
    	$objActSheet->getColumnDimension('B')->setWidth(5);
    	$objActSheet->getColumnDimension('C')->setWidth(26);
    	$objActSheet->getColumnDimension('D')->setWidth(13);
    	
    	$objActSheet->getColumnDimension('E')->setWidth(12);
    	$objActSheet->getColumnDimension('F')->setWidth(12);
    	 
    	$objActSheet->getColumnDimension('G')->setWidth(5);
    	$objActSheet->getColumnDimension('H')->setWidth(26);
    	$objActSheet->getColumnDimension('I')->setWidth(13);

    	
    	
    	
    	//-------------下半部分为必填
    	$sheet=$objPHPExcel->setActiveSheetIndex(0);
    	
    	$iforcnt=0;
	    foreach ($stdlsfn as $v){
			$stdo=$v;
			$plo=$v['plo'];
			$cjzxlsfzk=$v['cjzxlsfzk'];
			$cjzxlszk=$v['cjzxlszk'];
	    	
	    	//左半页
	    	$qsh=28*$iforcnt+1;$hg=19;$zh=12;$bthg=25;$btzh=14;//起始行 行高 字号 标题行高 标题字号
	    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'中国计量学院继续教育学院');
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
	    	$objFont->setBold(true);
	    	$objFont->setName('黑体');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
	    	
	    	$qsh=28*$iforcnt+2;$hg=19;$zh=12;$bthg=16;$btzh=12;
	    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,$stdo['bxxsnm']);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
	    	
	    	$qsh=28*$iforcnt+3;$hg=19;$zh=12;$bthg=16;$btzh=12;
	    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,$stdo['xqnm'].' 学生成绩报告单');
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
	    	
	    	$qsh=28*$iforcnt+4;$hg=19;$zh=12;$bthg=16;$btzh=12;
	    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'');
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
	    	
	    	$qsh=28*$iforcnt+5;$hg=19;$zh=12;$bthg=16;$btzh=12;
	    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'姓名:  '.$stdo['stdnm'].'   学号:  '.$stdo['stdno']);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
	    	
	    	
	    	
	    	$qsh=28*$iforcnt+6;$hg=19;$zh=12;$bthg=16;$btzh=12;
	    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'班级:  '.$stdo['clsnm']);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
	    	
	    	$qsh=28*$iforcnt+7;$hg=19;$zh=12;$bthg=20;$btzh=12;
	    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'   专业:  '.$stdo['mjnm']);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
	    	
	    	
	    	if(preg_match('/技能/',$stdo['bxxsnm'])){
	    		
	    		//期末成绩
	    		$qsh=28*$iforcnt+8;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=11;//最大行数
	    		if($zdhs<count($cjzxlsfzk)){
	    			$zdhs=count($cjzxlsfzk);
	    		}
	    		$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
	    		$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'学生期末考试成绩');
	    		$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    		$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    		$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
	    		$objFont->setBold(true);
	    		$objFont->setName('楷体_GB2312');
	    		$objFont->setSize($btzh);
	    		$objFont->getColor()->setARGB('FF000000');
	    		$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
	    		 
	    		$sheet->setCellValueByColumnAndRow(1,($qsh+1),'序号');
	    		$objActSheet->getStyle('B'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    		$objActSheet->getStyle('B'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+1))->getBorders();
	    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objFont = $objActSheet->getStyle('B'.($qsh+1))->getFont();
	    		$objFont->setName('楷体_GB2312');
	    		$objFont->setSize($zh);
	    		$objFont->getColor()->setARGB('FF000000');
	    		 
	    		$sheet->setCellValueByColumnAndRow(2,($qsh+1),'课程名称');
	    		$objActSheet->getStyle('C'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    		$objActSheet->getStyle('C'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+1))->getBorders();
	    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objFont = $objActSheet->getStyle('C'.($qsh+1))->getFont();
	    		$objFont->setName('楷体_GB2312');
	    		$objFont->setSize($zh);
	    		$objFont->getColor()->setARGB('FF000000');
	    		 
	    		$sheet->setCellValueByColumnAndRow(3,($qsh+1),'考试成绩');
	    		$objActSheet->getStyle('D'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    		$objActSheet->getStyle('D'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+1))->getBorders();
	    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objFont = $objActSheet->getStyle('D'.($qsh+1))->getFont();
	    		$objFont->setName('楷体_GB2312');
	    		$objFont->setSize($zh);
	    		$objFont->getColor()->setARGB('FF000000');
	    		 
	    		$objActSheet->getRowDimension(''.($qsh+1))->setRowHeight($hg);
	    		 
	    		 
	    		 
	    		for($i=0;$i<count($cjzxlsfzk);$i++){
	    		
	    			$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh+$i+2,$i+1);
	    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objFont = $objActSheet->getStyle('B'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    		
	    			$sheet=$sheet->setCellValueByColumnAndRow(2,$qsh+$i+2,$cjzxlsfzk[$i]['kcnm']);
	    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objFont = $objActSheet->getStyle('C'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			if(mb_strlen($cjzxlsfzk[$i]['kcnm'],'utf-8')<11){
	    				$objFont->setSize($zh);
	    			}else{
	    				$objFont->setSize('10');
	    			}
	    			$objFont->getColor()->setARGB('FF000000');
	    		
	    			$sheet=$sheet->setCellValueByColumnAndRow(3,$qsh+$i+2,$cjzxlsfzk[$i]['cjzxzf']);
	    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			$objFont = $objActSheet->getStyle('D'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    		
	    			$objActSheet->getRowDimension(''.$qsh+$i+2)->setRowHeight($hg);
	    			 
	    		}
	    		$k=$i;
	    		for($i=$k;$i<$zdhs;$i++){
	    			 
	    			$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh+$i+2,$i+1);
	    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			if($i==$zdhs-1){
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			}else{
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			}
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objFont = $objActSheet->getStyle('B'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    			 
	    			$sheet=$sheet->setCellValueByColumnAndRow(2,$qsh+$i+2,'');
	    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			if($i==$zdhs-1){
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			}else{
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			}
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objFont = $objActSheet->getStyle('C'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    			 
	    			$sheet=$sheet->setCellValueByColumnAndRow(3,$qsh+$i+2,'');
	    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			if($i==$zdhs-1){
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			}else{
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			}
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			$objFont = $objActSheet->getStyle('D'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    			 
	    			$objActSheet->getRowDimension(''.$qsh+$i+2)->setRowHeight($hg);
	    			 
	    		}
	    		
	    	}else if(preg_match('/自考/', $stdo['bxxsnm'])){
	    		//期末成绩
	    		$qsh=28*$iforcnt+8;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=6;//最大行数
	    		if($zdhs<count($cjzxlsfzk)){
	    			$zdhs=count($cjzxlsfzk);
	    		}
	    		$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
	    		$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'学生期末考试成绩');
	    		$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    		$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    		$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
	    		$objFont->setBold(true);
	    		$objFont->setName('楷体_GB2312');
	    		$objFont->setSize($btzh);
	    		$objFont->getColor()->setARGB('FF000000');
	    		$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
	    		 
	    		$sheet->setCellValueByColumnAndRow(1,($qsh+1),'序号');
	    		$objActSheet->getStyle('B'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    		$objActSheet->getStyle('B'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+1))->getBorders();
	    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objFont = $objActSheet->getStyle('B'.($qsh+1))->getFont();
	    		$objFont->setName('楷体_GB2312');
	    		$objFont->setSize($zh);
	    		$objFont->getColor()->setARGB('FF000000');
	    		 
	    		$sheet->setCellValueByColumnAndRow(2,($qsh+1),'课程名称');
	    		$objActSheet->getStyle('C'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    		$objActSheet->getStyle('C'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+1))->getBorders();
	    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objFont = $objActSheet->getStyle('C'.($qsh+1))->getFont();
	    		$objFont->setName('楷体_GB2312');
	    		$objFont->setSize($zh);
	    		$objFont->getColor()->setARGB('FF000000');
	    		 
	    		$sheet->setCellValueByColumnAndRow(3,($qsh+1),'考试成绩');
	    		$objActSheet->getStyle('D'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    		$objActSheet->getStyle('D'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+1))->getBorders();
	    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objFont = $objActSheet->getStyle('D'.($qsh+1))->getFont();
	    		$objFont->setName('楷体_GB2312');
	    		$objFont->setSize($zh);
	    		$objFont->getColor()->setARGB('FF000000');
	    		 
	    		$objActSheet->getRowDimension(''.($qsh+1))->setRowHeight($hg);
	    		 
	    		 
	    		 
	    		for($i=0;$i<count($cjzxlsfzk);$i++){
	    		
	    			$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh+$i+2,$i+1);
	    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objFont = $objActSheet->getStyle('B'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    		
	    			$sheet=$sheet->setCellValueByColumnAndRow(2,$qsh+$i+2,$cjzxlsfzk[$i]['kcnm']);
	    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objFont = $objActSheet->getStyle('C'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			if(mb_strlen($cjzxlsfzk[$i]['kcnm'],'utf-8')<11){
	    				$objFont->setSize($zh);
	    			}else{
	    				$objFont->setSize('10');
	    			}
	    			$objFont->getColor()->setARGB('FF000000');
	    		
	    			$sheet=$sheet->setCellValueByColumnAndRow(3,$qsh+$i+2,$cjzxlsfzk[$i]['cjzxzf']);
	    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			$objFont = $objActSheet->getStyle('D'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    		
	    			$objActSheet->getRowDimension(''.$qsh+$i+2)->setRowHeight($hg);
	    			 
	    		}
	    		$k=$i;
	    		for($i=$k;$i<$zdhs;$i++){
	    			 
	    			$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh+$i+2,$i+1);
	    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			if($i==$zdhs-1){
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			}else{
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			}
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objFont = $objActSheet->getStyle('B'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    			 
	    			$sheet=$sheet->setCellValueByColumnAndRow(2,$qsh+$i+2,'');
	    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			if($i==$zdhs-1){
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			}else{
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			}
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objFont = $objActSheet->getStyle('C'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    			 
	    			$sheet=$sheet->setCellValueByColumnAndRow(3,$qsh+$i+2,'');
	    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			if($i==$zdhs-1){
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			}else{
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			}
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			$objFont = $objActSheet->getStyle('D'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    			 
	    			$objActSheet->getRowDimension(''.$qsh+$i+2)->setRowHeight($hg);
	    			 
	    		}
	    		//参加国家统考
	    		$qsh=28*$iforcnt+8+$zdhs+3;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=5;//最大行数
	    		if($zdhs<count($cjzxlszk)){
	    			$zdhs=count($cjzxlszk);
	    		}
	    		
	    		$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
	    		$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,'本学期参加国家统考情况');
	    		$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    		$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    		$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
	    		$objFont->setBold(true);
	    		$objFont->setName('楷体_GB2312');
	    		$objFont->setSize($btzh);
	    		$objFont->getColor()->setARGB('FF000000');
	    		$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
	    		
	    		$sheet->setCellValueByColumnAndRow(1,($qsh+1),'序号');
	    		$objActSheet->getStyle('B'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    		$objActSheet->getStyle('B'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+1))->getBorders();
	    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objFont = $objActSheet->getStyle('B'.($qsh+1))->getFont();
	    		$objFont->setName('楷体_GB2312');
	    		$objFont->setSize($zh);
	    		$objFont->getColor()->setARGB('FF000000');
	    		
	    		$sheet->setCellValueByColumnAndRow(2,($qsh+1),'课程名称');
	    		$objActSheet->getStyle('C'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    		$objActSheet->getStyle('C'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+1))->getBorders();
	    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objFont = $objActSheet->getStyle('C'.($qsh+1))->getFont();
	    		$objFont->setName('楷体_GB2312');
	    		$objFont->setSize($zh);
	    		$objFont->getColor()->setARGB('FF000000');
	    		
	    		$sheet->setCellValueByColumnAndRow(3,($qsh+1),'考试成绩');
	    		$objActSheet->getStyle('D'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    		$objActSheet->getStyle('D'.($qsh+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+1))->getBorders();
	    		$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    		$objFont = $objActSheet->getStyle('D'.($qsh+1))->getFont();
	    		$objFont->setName('楷体_GB2312');
	    		$objFont->setSize($zh);
	    		$objFont->getColor()->setARGB('FF000000');
	    		
	    		$objActSheet->getRowDimension(''.($qsh+1))->setRowHeight($hg);
	    		
	    		
	    		
	    		for($i=0;$i<count($cjzxlszk);$i++){
	    			 
	    			$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh+$i+2,$i+1);
	    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objFont = $objActSheet->getStyle('B'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    			 
	    			$sheet=$sheet->setCellValueByColumnAndRow(2,$qsh+$i+2,$cjzxlszk[$i]['kcnm']);
	    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objFont = $objActSheet->getStyle('C'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			if(mb_strlen($cjzxlszk[$i]['kcnm'],'utf-8')<11){
	    				$objFont->setSize($zh);
	    			}else{
	    				$objFont->setSize('10');
	    			}
	    			$objFont->getColor()->setARGB('FF000000');
	    			 
	    			if(is_numeric($cjzxlszk[$i]['cjzxzf'])&&$cjzxlszk[$i]['cjzxzf']<60){
	    				$cjzxlszk[$i]['cjzxzf']='未通过';
	    			}
	    			$sheet=$sheet->setCellValueByColumnAndRow(3,$qsh+$i+2,$cjzxlszk[$i]['cjzxzf']);
	    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			$objFont = $objActSheet->getStyle('D'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    			 
	    			$objActSheet->getRowDimension(''.$qsh+$i+2)->setRowHeight($hg);
	    			 
	    		}
	    		$k=$i;
	    		for($i=$k;$i<$zdhs;$i++){
	    			 
	    			$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh+$i+2,$i+1);
	    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('B'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('B'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			if($i==$zdhs-1){
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			}else{
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			}
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objFont = $objActSheet->getStyle('B'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    			 
	    			$sheet=$sheet->setCellValueByColumnAndRow(2,$qsh+$i+2,'');
	    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('C'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('C'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			if($i==$zdhs-1){
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			}else{
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			}
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objFont = $objActSheet->getStyle('C'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    			 
	    			$sheet=$sheet->setCellValueByColumnAndRow(3,$qsh+$i+2,'');
	    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	    			$objActSheet->getStyle('D'.($qsh+$i+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('D'.($qsh+$i+2))->getBorders();
	    			$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			if($i==$zdhs-1){
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			}else{
	    				$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			}
	    			$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    			$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    			$objFont = $objActSheet->getStyle('D'.($qsh+$i+2))->getFont();
	    			$objFont->setName('楷体_GB2312');
	    			$objFont->setSize($zh);
	    			$objFont->getColor()->setARGB('FF000000');
	    			 
	    			$objActSheet->getRowDimension(''.$qsh+$i+2)->setRowHeight($hg);
	    			 
	    		}
	    	}
	    	
	    	
	    	
			$qsh=$qsh+$i+3;$hg=19;$zh=12;$bthg=20;$btzh=12;
	    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,$smj.'时间：');
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
	    	$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
	    	
	    	
	    	$qsh=$qsh+1;$hg=19;$zh=12;$bthg=20;$btzh=12;
	    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,$jqo['jqqs'].'——'.$jqo['jqjs']);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	
	    	
	    	$qsh=$qsh+1;$hg=19;$zh=12;$bthg=20;$btzh=12;
	    	$sheet->mergeCells("B".$qsh.':'.'D'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(1,$qsh,$jqo['jqljc'].'报到注册，领教材、课表');
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    	$objActSheet->getStyle('B'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('B'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	
			//右半边
	    	
	    	//
	    	$qsh=28*$iforcnt+1;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
	    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
	    	$sheet->setCellValueByColumnAndRow(6,$qsh,'上学期综合量化排名：');
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
	    	$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($zh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	//H1 I1
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('H'.$qsh)->getBorders();
	    	$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
	    	$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	 
	    	 
	    	
	    	//
	    	//
	    	$qsh=28*$iforcnt+2;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
	    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
	    	$sheet->setCellValueByColumnAndRow(6,$qsh,'班主任评语：');
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
	    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($zh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	//I1
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	 
	    	 
	    	
	    	// 
	    	$qsh=28*$iforcnt+3;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
	    	$sheet->mergeCells("G".$qsh.':'.'I'.($qsh+10));
	    	$sheet->setCellValueByColumnAndRow(6,$qsh,$plo['plctt']);
	    	$objActSheet->getStyle('G'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setWrapText(true);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
	    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($zh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	///左侧连续
	    	for($i=$qsh+1;$i<=$qsh+10;$i++){
	    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getBorders();
	    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	}
	    	//右侧连续
			for($i=$qsh;$i<=$qsh+10;$i++){
	    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getBorders();
	    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	}
	    	
	    	//
	    	$qsh=28*$iforcnt+14;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
	    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
	    	$sheet->setCellValueByColumnAndRow(6,$qsh,'班主任：'.$bzro['usrnn']);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
	    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($zh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	//I1
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	
	    	//
	    	$qsh=28*$iforcnt+15;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
	    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
	    	$sheet->setCellValueByColumnAndRow(6,$qsh,$jintian);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
	    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($zh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	//H1 I1
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('H'.$qsh)->getBorders();
	    	$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
	    	$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	
	    	//家长回执
	    	$qsh=28*$iforcnt+17;$hg=19;$zh=12;$bthg=18;$btzh=12;//最大行数
	    	    	
	    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(6,$qsh,'家长回执');
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($bthg);
	    	
	    	//
	    	$qsh=28*$iforcnt+18;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
	    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
	    	$sheet->setCellValueByColumnAndRow(6,$qsh,'对您孩子成绩的意见');
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
	    	$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($zh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	//H1 I1
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('H'.$qsh)->getBorders();
	    	$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
	    	$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	 
	    	 
	    	 
	    	 
	    	
	    	// 
	    	$qsh=28*$iforcnt+19;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
	    	$sheet->mergeCells("G".$qsh.':'.'I'.($qsh+1));
	    	$sheet->setCellValueByColumnAndRow(6,$qsh,'');
	    	$objActSheet->getStyle('G'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setWrapText(true);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
	    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($zh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	///左侧连续
	    	for($i=$qsh+1;$i<=$qsh+1;$i++){
	    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getBorders();
	    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	}
	    	//右侧连续
			for($i=$qsh;$i<=$qsh+1;$i++){
	    		$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getBorders();
	    		$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	}
	    	
	    	
	    	//
	    	$qsh=28*$iforcnt+21;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
	    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
	    	$sheet->setCellValueByColumnAndRow(6,$qsh,'对学校的要求和意见');
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
	    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($zh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	//H1 I1
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('H'.$qsh)->getBorders();
	    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
	    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	
	    	
	    	
	    	
	    	 
	    	//
	    	$qsh=28*$iforcnt+22;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
	    	$sheet->mergeCells("G".$qsh.':'.'I'.($qsh+1));
	    	$sheet->setCellValueByColumnAndRow(6,$qsh,'');
	    	$objActSheet->getStyle('G'.($qsh+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    			$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	    			$objActSheet->getStyle('G'.$qsh)->getAlignment()->setWrapText(true);
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
	    			//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($zh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	///左侧连续
	    	for($i=$qsh+1;$i<=$qsh+1;$i++){
	    			$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$i)->getBorders();
	    		$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	}
	    	//右侧连续
	    	for($i=$qsh;$i<=$qsh+1;$i++){
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$i)->getBorders();
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	}
	    	
	    	
	    	//
	    	$qsh=28*$iforcnt+24;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
	    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
	    	$sheet->setCellValueByColumnAndRow(6,$qsh,'家长签名：                                             ');
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
	    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	//$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($zh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	//I1
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	
	    	//
	    	$qsh=28*$iforcnt+25;$hg=19;$zh=12;$bthg=18;$btzh=12;$zdhs=14;//最大行数
	    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
	    	$sheet->setCellValueByColumnAndRow(6,$qsh,'      年   月  日');
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('G'.$qsh)->getBorders();
	    	//$objBorder->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($zh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	//H1 I1
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('H'.$qsh)->getBorders();
	    	$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder=$objPHPExcel->getActiveSheet()->getStyle('I'.$qsh)->getBorders();
	    	$objBorder->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	$objBorder->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	    	
	    	
	    	$qsh=28*$iforcnt+26;$hg=19;$zh=12;$bthg=20;$btzh=12;
	    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(6,$qsh,'家庭地址：');
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	
	    	
	    	$qsh=28*$iforcnt+27;$hg=19;$zh=12;$bthg=20;$btzh=12;
	    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(6,$qsh,'邮编：        联系电话：');
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	//$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	
	    	 
	    	$qsh=28*$iforcnt+28;$hg=19;$zh=12;$bthg=20;$btzh=12;
	    	$sheet->mergeCells("G".$qsh.':'.'I'.$qsh);
	    	$sheet=$sheet->setCellValueByColumnAndRow(6,$qsh,'注：下学期开学时，学生凭此回条报到注册。');
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	    	$objActSheet->getStyle('G'.$qsh)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    	$objFont = $objActSheet->getStyle('G'.$qsh)->getFont();
	    	$objFont->setBold(true);
	    	$objFont->setName('楷体_GB2312');
	    	$objFont->setSize($btzh);
	    	$objFont->getColor()->setARGB('FF000000');
	    	$objActSheet->getRowDimension(''.$qsh)->setRowHeight($hg);
	    	
	    	$iforcnt++;
   		} 
    	
		
    	
    	
    	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    	$objPHPExcel->setActiveSheetIndex(0);
    	 
    	
    	
    	 
    	// excel头参数
    	header('Content-Type: application/vnd.ms-excel');
    	header("Content-Disposition: attachment;filename=".$clso['clsnm'].$xqo['xqnm']."成绩单.xls");  //日期为文件名后缀
    	header('Cache-Control: max-age=0');
    	 
    	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式
    	$objWriter->save('php://output');
    	 
    	 
    	 
    	 
    }
	
}



?>