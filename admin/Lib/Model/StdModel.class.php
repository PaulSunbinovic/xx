<?php 
class StdModel{
	//giveclsnmfromckxls//根据身份证号查询学生的班级with【ck成考】的excel表格adddbtbck mdfdbtbck
	public function test(){

	}
#######################
	public function giveclsnmfromckxls($stdidcd){
		$year=date('Y',time());
		$std=M($year.'_std');
		$stdo=$std->join('tb_'.$year.'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('tb_'.$year.'_cls ON f_stdxqcls_clsid=clsid')->where("stdidcd='".$stdidcd."'")->order('stdxqclsid DESC')->find();
		if($stdo){
			return $stdo['clsnm'];
		}else{
			$year--;
			$std=M($year.'_std');
			$stdo=$std->join('tb_'.$year.'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('tb_'.$year.'_cls ON f_stdxqcls_clsid=clsid')->where("stdidcd='".$stdidcd."'")->order('stdxqclsid DESC')->find();
			if($stdo){
				return $stdo['clsnm'];
			}else{
				$year--;
				$std=M($year.'_std');
				$stdo=$std->join('tb_'.$year.'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('tb_'.$year.'_cls ON f_stdxqcls_clsid=clsid')->where("stdidcd='".$stdidcd."'")->order('stdxqclsid DESC')->find();
				if($stdo){
					return $stdo['clsnm'];
				}else{
					return 'not find';
					
				}
				
			}

		}

	}
	##########
	public function adddbtbck($bmo){
		$ck=D('Ck');
		
		$stdidcd=$bmo[2];
		$year=2015;
		$std=M($year.'_std');
		$stdo=$std->join('tb_'.$year.'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('tb_'.$year.'_cls ON f_stdxqcls_clsid=clsid')->where("stdidcd='".$stdidcd."'")->order('stdxqclsid DESC')->find();
		if($stdo){
			$ck->adddata($stdo,$bmo,$year);
		}else{
			$year--;
			$std=M($year.'_std');
			$stdo=$std->join('tb_'.$year.'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('tb_'.$year.'_cls ON f_stdxqcls_clsid=clsid')->where("stdidcd='".$stdidcd."'")->order('stdxqclsid DESC')->find();
			if($stdo){
				$ck->adddata($stdo,$bmo,$year);
			}else{
				$year--;
				$std=M($year.'_std');
				$stdo=$std->join('tb_'.$year.'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('tb_'.$year.'_cls ON f_stdxqcls_clsid=clsid')->where("stdidcd='".$stdidcd."'")->order('stdxqclsid DESC')->find();
				if($stdo){
					$ck->adddata($stdo,$bmo,$year);
				}else{
					p(json_encode($bmo,JSON_UNESCAPED_UNICODE));
					
				}
				
			}

		}

	}
	##########
	public function mdfdbtbck($ckcjo){
		$ck=D('Ck');
		/*举例
		 Array
		(
		    [0] => 
		    [1] => 1533010115103606
		    [2] => 施存威
		    [3] => 1 男
		    [4] => 
		    [5] => 245
		    [6] => 351 (高起专)文
		    [7] => 1 202 计算机信息管理
		    [8] => 330721199704131410
		    [9] => 86875669
		    [10] => 杭州下沙学源街258号
		    [11] => 310018
		    [12] => 5 已录取
		)
		*/
		$stdidcd=$ckcjo[8];
		$year=2015;
		$std=M($year.'_std');
		$stdo=$std->join('tb_'.$year.'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('tb_'.$year.'_cls ON f_stdxqcls_clsid=clsid')->where("stdidcd='".$stdidcd."'")->order('stdxqclsid DESC')->find();
		if($stdo){
			$ck->mdfdata($stdo,$ckcjo,$year);
		}else{
			$year--;
			$std=M($year.'_std');
			$stdo=$std->join('tb_'.$year.'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('tb_'.$year.'_cls ON f_stdxqcls_clsid=clsid')->where("stdidcd='".$stdidcd."'")->order('stdxqclsid DESC')->find();
			if($stdo){
				$ck->mdfdata($stdo,$ckcjo,$year);
			}else{
				$year--;
				$std=M($year.'_std');
				$stdo=$std->join('tb_'.$year.'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('tb_'.$year.'_cls ON f_stdxqcls_clsid=clsid')->where("stdidcd='".$stdidcd."'")->order('stdxqclsid DESC')->find();
				if($stdo){
					$ck->mdfdata($stdo,$ckcjo,$year);
				}else{
					p(json_encode($ckcjo,JSON_UNESCAPED_UNICODE));
					
				}
				
			}

		}

	}
}
?>