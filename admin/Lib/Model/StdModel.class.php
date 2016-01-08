<?php 
class StdModel{
	//giveclsnmfromckxls//根据身份证号查询学生的班级with【ck成考】的excel表格
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
	
}
?>