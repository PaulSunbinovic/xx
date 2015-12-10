<?php 

//规矩：需要display的 就m mls 不需要的 只要uo uls 之类，方便批量移植
class AtstAction extends Action{
	
	//测试专业和班级不对应，有些学生换了专业但是班级却还在老班级，这样是不对的
	function test(){
		
		$dzb=array(
				'1'=>'1',
				'2'=>'2',
				'3'=>'8',
				'4'=>'9',
				'5'=>'10',
				'6'=>'11',
				'7'=>'12',
				'9'=>'13',
				'10'=>'14',
				'11'=>'15',
				'12'=>'16',
		);

		$std=M('2015_std');

		$std->join('inner join tb_2015_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_2015_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_2015_stdxqmj ON stdid=f_stdxqmj_stdid');

		$where="f_stdxqcls_xqid=3 AND f_stdxqmj_xqid=3 AND f_stdxqdm_xqid=3 AND f_std_statid<>9";

		$stdls=$std->join('tb_2015_mj ON f_stdxqmj_mjid=mjid')->join('tb_2015_cls ON f_stdxqcls_clsid=clsid')->where($where)->select();

		$stdlsnw=array();

		foreach ($stdls as $stdv) {
			//理应的班级
			$ygclsid=$dzb[$stdv['mjid']];
			$sjclsid=$stdv['clsid'];
			if($ygclsid!=$sjclsid){
				array_push($stdlsnw,$stdv);
			}
		}

		p($stdlsnw);die;
				


	}	

	function fenban(){
		$dzb=array(
				'1'=>'1',//计算机//18
				'2'=>'2',//金融//17
				'3'=>'8',//会计
				'4'=>'9',//国贸//17
				'5'=>'10',//市场//17
				'6'=>'11',//电商//18
				'7'=>'12',//工商//17
				'9'=>'13',//环艺//19
				'10'=>'14',//视觉//19
				'11'=>'15',//广告//19
				'12'=>'16',//机电
		);
		// $dzb=array(
		// 		'1'=>'18',//计算机//18
		// 		'2'=>'17',//金融//17
		// 		'3'=>'8',//会计
		// 		'4'=>'17',//国贸//17
		// 		'5'=>'17',//市场//17
		// 		'6'=>'18',//电商//18
		// 		'7'=>'17',//工商//17
		// 		'9'=>'19',//环艺//19
		// 		'10'=>'19',//视觉//19
		// 		'11'=>'19',//广告//19
		// 		'12'=>'16',//机电
		// );
		$stdxqcls=M('2015_stdxqcls');
		$stdxqclsls=$stdxqcls->select();
		foreach ($stdxqclsls as $stdxqclsv) {



			if($stdxqclsv['f_stdxqcls_clsid']==1||$stdxqclsv['f_stdxqcls_clsid']==11){
				$dt=array(
					'f_stdxqcls_clsid'=>18,
				);

			}else if($stdxqclsv['f_stdxqcls_clsid']==2||$stdxqclsv['f_stdxqcls_clsid']==9||$stdxqclsv['f_stdxqcls_clsid']==10||$stdxqclsv['f_stdxqcls_clsid']==12){
				$dt=array(
					'f_stdxqcls_clsid'=>17,
				);

			}else if($stdxqclsv['f_stdxqcls_clsid']==13||$stdxqclsv['f_stdxqcls_clsid']==14||$stdxqclsv['f_stdxqcls_clsid']==15){
				$dt=array(
					'f_stdxqcls_clsid'=>19,
				);

			}else{//若果非以上情况，那么照旧
				$dt=array(
					'f_stdxqcls_clsid'=>$stdxqclsv['f_stdxqcls_clsid'],
				);
			}
			$stdxqcls->where('stdxqclsid='.$stdxqclsv['stdxqclsid'])->setField($dt);
		}
		p('done!');die;
	}


	function zhuceclsmj(){
		$grdnm=$_GET['grdnm'];

		$xqid=$_GET['xqid'];
		$std=M($grdnm.'_std');

		$stdls=$std->where('f_std_statid=5')->select();



		$stdxqcls=M($grdnm.'_stdxqcls');
		foreach($stdls as $stdv){
			$stdxqclsoorg=$stdxqcls->where('f_stdxqcls_stdid='.$stdv['stdid'].' AND f_stdxqcls_xqid='.($xqid-1))->find();
			$dt=array(
				'f_stdxqcls_stdid'=>$stdv['stdid'],
				'f_stdxqcls_xqid'=>$xqid,
				'f_stdxqcls_clsid'=>$stdxqclsoorg['f_stdxqcls_clsid'],
			);
			$stdxqcls->data($dt)->add();
		}

		$stdxqmj=M($grdnm.'_stdxqmj');
		foreach($stdls as $stdv){
			$stdxqmjoorg=$stdxqmj->where('f_stdxqmj_stdid='.$stdv['stdid'].' AND f_stdxqmj_xqid='.($xqid-1))->find();
			$dt=array(
				'f_stdxqmj_stdid'=>$stdv['stdid'],
				'f_stdxqmj_xqid'=>$xqid,
				'f_stdxqmj_mjid'=>$stdxqmjoorg['f_stdxqmj_mjid'],
			);
			$stdxqmj->data($dt)->add();
		}


		p('搞定！');die;
	}

	function zhucedm(){
		//只有把专业定下来了才能获得办学形式，才能安排住宿
		//
		$grdnm=$_GET['grdnm'];

		$xqid=$_GET['xqid'];

		$stdls=M($grdnm.'_stdxqmj')->join('tb_'.$grdnm.'_std ON f_stdxqmj_stdid=stdid')->join('tb_'.$grdnm.'_mj ON f_stdxqmj_mjid=mjid')->where('f_stdxqmj_xqid='.$xqid.' AND f_std_statid=5')->select();
		$stdxqdm=M($grdnm.'_stdxqdm');
		foreach($stdls as $stdv){

			if($grdnm=='2013'){
				if($stdv['f_std_sexid']==1){
					$dmid=2;
				}else{
					$dmid=1;
				}
			}

			if($grdnm=='2014'){
				if($stdv['f_std_sexid']==2){
					$dmid=1;
				}else{
					if($stdv['f_mj_bxxsid']==3){//男人若是自考
						$dmid=2;
					}else{
						$dmid=3;
					}
				}
			}

			$dt=array(
				'f_stdxqdm_stdid'=>$stdv['stdid'],
				'f_stdxqdm_xqid'=>$xqid,
				'f_stdxqdm_dmid'=>$dmid,
			);
			$stdxqdm->data($dt)->add();
			
		}
		p('done!');die;
	}


}

?>