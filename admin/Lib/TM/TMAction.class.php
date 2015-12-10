<?php
class TMAction extends Action{
	function timelist($begin,$end){
		$begin = strtotime($begin);
		$end = strtotime($end);
		$datels=array();
		for($i=$begin; $i<=$end;$i+=(24*3600)){
			array_push($datels, $i);
		}
		return $datels;
	}
	
}
?>