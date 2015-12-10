<?php 
	//header("Content-Type: text/html; charset=UTF-8");
	Class TreeAction extends Action{
		//组合一维数组
		Static Public function unlimitedForLevel ($cate, $html = '--', $pid = 0, $level = 0) {
			$arr = array();
			foreach ($cate as $k => $v) {
				if ($v['pid'] == $pid) {
					$v['level'] = $level + 1;
					$v['html']  = str_repeat($html, $level);
					$arr[] = $v;
					$arr = array_merge($arr, self::unlimitedForLevel($cate, $html, $v['id'], $level + 1));
				}
			}
			return $arr;
		}
		//组合多维数组
		Static Public function unlimitedForLayer ($cate, $name = 'child', $pid = 0) {
			$arr = array();
			foreach ($cate as $v) {
				if ($v['pid'] == $pid) {
					$v[$name] = self::unlimitedForLayer($cate, $name, $v['id']);
					$arr[] = $v;
				}
			}
			return $arr;
		}
// 		//BD组合多维数组
// 		Static Public function unlimited ($cate, $name = 'child', $bdpid = 0) {
// 			$arr = array();
// 			foreach ($cate as $v) {
// 				if ($v['bdpid'] == $bdpid) {
// 					$v[$name] = self::unlimited($cate, $name, $v['bdid']);
// 					$arr[] = $v;
// 				}
// 			}
// 			return $arr;
// 		}
		//BD组合多维数组结果以List形式（ul li）
		Static Public function unlimitedForList($cate,$pid,$idzd,$nmzd,$pidzd,$odrzd){
			$str='';
			$a_oc_x="<a class='oc'><i class='glyphicon glyphicon-plus'></i></a>";
			$a_oc_i="<a class='oc'><i class='glyphicon glyphicon-minus'></i></a>";
			foreach ($cate as $v) {
				
				if ($v[$pidzd] == $pid) {
					if($v[$odrzd]==1){
						$str=$str.'<ul>';
					}
					$rslt=self::unlimitedForList($cate,$v[$idzd],$idzd,$nmzd,$pidzd,$odrzd);
					if($rslt==''){//无子嗣就算了
						$str=$str."<li>".$a_oc_i."&nbsp;".$v[$nmzd];
					}else{
						$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd].$rslt;
					}
					$str=$str.'</li>';
					//$arr[] = $v;
				}
			}
			if($str==''){
				return '';
			}else{
				return $str.'</ul>';//有子嗣要补上/ul
			}
			
		}
		
		//BD组合多维数组结果以List形式（ul li）
		Static Public function unlimitedForListSLCT($cate,$pid,$idzd,$nmzd,$pidzd,$odrzd){
			$str='';
					
			foreach ($cate as $v) {
				if ($v[$pidzd] == $pid) {
					$hg=TreeAction::henggang($cate, $v[$idzd], $idzd, $pidzd);
					$str=$str."<option value='".$v[$idzd]."'>".$hg.$v[$nmzd].'</option>';
					$str=$str.self::unlimitedForListSLCT($cate,$v[$idzd],$idzd,$nmzd,$pidzd,$odrzd);
				}
			}
			if($str==''){
				return '';
			}else{
				return $str;//
			}
				
		}
		//找有几个祖先（爸爸的爸爸的爸爸...）
		Static Public function henggang($cate,$id,$idzd,$pidzd){
			$str='';
			foreach ($cate as $v){
				if($v[$idzd]==$id){
					if($v[$pidzd]!=0){
						$str='-'.self::henggang($cate, $v[$pidzd], $idzd, $pidzd);
						break;
					}
				}
			}
			return $str;
		}
		
		Static Public function findF($cate,$id,$idzd,$nmzd,$pidzd){
			$str='';
			foreach ($cate as $v){
				if($v[$idzd]==$id){
					$str=self::findF($cate,$v[$pidzd],$idzd,$nmzd,$pidzd).'<li><a href="#">'.$v[$nmzd].'</a> </li>';
					break;
				}
			}
			return $str;
		}
		
		//BD组合多维数组结果以List形式（ul li）寻找所有ID
		Static Public function unlimitedForListID($cate,$pid,$idzd,$nmzd,$pidzd,$odrzd){
			$str='';
			
			foreach ($cate as $v) {
				if ($v[$pidzd] == $pid) {
					$str=$str.$v[$idzd].'-';
					$str=$str.self::unlimitedForListID($cate,$v[$idzd],$idzd,$nmzd,$pidzd,$odrzd);
				}
			}
			if($str==''){
				return '';
			}else{
				return $str;//
			}
				
		}
		
		//BD组合多维数组结果以List形式（ul li）
		Static Public function unlimitedForListMv($cate,$pid,$idzd,$nmzd,$pidzd,$odrzd){
			$str='';$odr=0;
			//$a_add="<a class='tadd' href='#'>添加</a>";
			//$a_mdf="<a href='#'>修改</a>";
			//$a_mv="<a href='#'>移位</a>";
			//$a_dlt="<a href='#'>删除</a>";
			$a_oc_x="<a class='oc'><i class='glyphicon glyphicon-plus'></i></a>";
			$a_oc_i="<a class='oc'><i class='glyphicon glyphicon-minus'></i></a>";
			foreach ($cate as $v) {
				if ($v[$pidzd] == $pid) {
					$odr=$v[$odrzd];
					if($v[$odrzd]==1){
						$str=$str."<ul><li><a href='javascript:mvhr(".$v[$pidzd].",0)' style='color:red'>移动至此处</a></li>";
					}
					$rslt=self::unlimitedForListMv($cate,$v[$idzd],$idzd,$nmzd,$pidzd,$odrzd);
					if($rslt=="<ul><li>"."<a href='javascript:mvhr(".$v[$idzd].",0)' style='color:red'>移动至此处</a>"."</li></ul>"){//无子嗣就算了
						$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd].$rslt;
					}else{
						$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd].$rslt;
					}
					$str=$str.'</li>'."<li><a href='javascript:mvhr(".$v[$pidzd].",".$v[$odrzd].")' style='color:red'>移动至此处</a></li>";
					//$arr[] = $v;
				}
			}
			if($str==''){//没找着儿子
				return "<ul><li><a href='javascript:mvhr(".$pid.",0)' style='color:red'>移动至此处</a></li></ul>";
			}else{
				return $str."</ul>";//有子嗣要补上/ul
			}
		}
// 		//BD组合多维数组结果以List形式添加修改删除（ul li）
// 		Static Public function unlimitedForListM ($cate, $name = 'child', $bdpid = 0) {
// 			$str='';
// 			foreach ($cate as $v) {
// 				if ($v['bdpid'] == $bdpid) {
// 					if($v['bdodr']==1){
// 						$str=$str.'<ul>';
// 					}
// 					$str=$str.'<li>'.$v['bdnm']."&nbsp;&nbsp;<a href='#'>修改</a>"."&nbsp;&nbsp;<a href='#'>删除</a>";
// 					if(self::unlimitedForList($cate, $name, $v['bdid'])==''){//无子嗣就算了
// 						$str=$str."<ul><li><a href='#'>添加</a></li></ul>";
// 					}else{
// 						$str= $str.self::unlimitedForListM($cate, $name, $v['bdid']).'</ul>';//有子嗣要补上/ul
// 					}
// 					$str=$str.'</li>';
// 					//$arr[] = $v;
// 				}
// 			}
// 			return $str."<li><a href='#'>添加</a></li>";
// 		}
		
		//BD组合多维数组结果以List形式添加修改删除（ul li）//递归的精髓就是 有节点，能递下去，能会上来，下级给我的回馈和我给上级的回馈一致
// 		Static Public function unlimitedForListMNew($cate,$pid,$idzd,$nmzd,$pidzd,$odrzd){
// 			$str='';
// 			$a_add="<a class='tadd' href='#'>添加</a>";
// 			$a_mdf="<a href='#'>修改</a>";
// 			$a_mv="<a href='#'>移位</a>";
// 			$a_dlt="<a href='#'>删除</a>";
// 			$a_oc_x="<a class='oc'>+</a>";
// 			$a_oc_i="<a class='oc'>-</a>";
// 			foreach ($cate as $v) {
// 				if ($v[$pidzd] == $pid) {
// 					if($v[$odrzd]==1){
// 						$str=$str.'<ul>';
// 					}
// 					$rslt=self::unlimitedForListMNew($cate,$v[$idzd],$idzd,$nmzd,$pidzd,$odrzd);
// 					if($rslt=="<ul><li>".$a_add."</li></ul>"){//无子嗣就算了
// 						$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd]."&nbsp;&nbsp;".$a_mdf."&nbsp;&nbsp;".$a_mv."&nbsp;&nbsp;".$a_dlt.$rslt;
// 					}else{
// 						$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd]."&nbsp;&nbsp;".$a_mdf."&nbsp;&nbsp;".$a_mv."&nbsp;&nbsp;".$a_dlt.$rslt;
// 					}
// 					$str=$str.'</li>';
// 					//$arr[] = $v;
// 				}
// 			}
// 			if($str==''){//没找着儿子
// 				return "<ul><li>".$a_add."</li></ul>";
// 			}else{
// 				return $str."<li>".$a_add."</li>".'</ul>';//有子嗣要补上/ul
// 			}
// 		}
		
		Static Public function unlimitedForListPlus($cate,$pid,$idzd,$nmzd,$pidzd,$odrzd,$url,$thm){
			//额外模块专门验证有没有a的权限
			$mdII=M('md');
			$mdo=$mdII->where("mdmk='".$thm."'")->find();
			import('@.IDTATH.IdtathAction');
			$Idtath = new IdtathAction();
			$athofn=$Idtath->identify($mdo['mdid'],'tree');
			if($athofn['atha']==1){
				$str='';$odr=0;
				//$a_add="<a class='tadd' href='#'>添加</a>";
				//$a_mdf="<a href='#'>修改</a>";
				//$a_mv="<a href='#'>移位</a>";
				//$a_dlt="<a href='#'>删除</a>";
				$a_oc_x="<a class='oc'><i class='glyphicon glyphicon-plus'></i></a>";
				$a_oc_i="<a class='oc'><i class='glyphicon glyphicon-minus'></i></a>";
				foreach ($cate as $v) {
					if ($v[$pidzd] == $pid) {
						$odr=$v[$odrzd];
						if($v[$odrzd]==1){
							$str=$str.'<ul>';
						}
						$rslt=self::unlimitedForListPlus($cate,$v[$idzd],$idzd,$nmzd,$pidzd,$odrzd,$url,$thm);
						if($rslt=="<ul><li>"."<a class='tadd' href='".$url."/gtxpg/x/update/id/0/pid/".$v[$pidzd]."/odr/1'>添加</a>"."</li></ul>"){//无子嗣就算了
							$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd]."&nbsp;&nbsp;"."<a href='".$url."/gtxpg/x/updt/id/".$v[$idzd]."'>修改</a>"."&nbsp;&nbsp;"."<a href='javascript:disp(".$v[$idzd].")'>移位</a>"."&nbsp;&nbsp;"."<a href='javascript:dlt(".$v[$idzd].")'>删除</a>".$rslt;
						}else{
							$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd]."&nbsp;&nbsp;"."<a href='".$url."/gtxpg/x/updt/id/".$v[$idzd]."'>修改</a>"."&nbsp;&nbsp;"."<a href='javascript:disp(".$v[$idzd].")'>移位</a>"."&nbsp;&nbsp;"."<a href='javascript:dlt(".$v[$idzd].")'>删除</a>".$rslt;
						}
						$str=$str.'</li>';
						//$arr[] = $v;
					}
				}
				
				if($str==''){//没找着儿子
					return "<ul><li>"."<a class='tadd' href='".$url."/gtxpg/x/updt/id/0/pid/".$pid."/odr/1'>添加</a>"."</li></ul>";
				}else{
					return $str."<li>"."<a class='tadd' href='".$url."/gtxpg/x/updt/id/0/pid/".$pid."/odr/".($odr+1)."'>添加</a>"."</li>".'</ul>';//有子嗣要补上/ul
				}
			}else{
				$str='';
				$a_oc_x="<a class='oc'><i class='glyphicon glyphicon-plus'></i></a>";
				$a_oc_i="<a class='oc'><i class='glyphicon glyphicon-minus'></i></a>";
				foreach ($cate as $v) {
				
					if ($v[$pidzd] == $pid) {
						if($v[$odrzd]==1){
							$str=$str.'<ul>';
						}
						$rslt=self::unlimitedForListPlus($cate,$v[$idzd],$idzd,$nmzd,$pidzd,$odrzd,$url);
						if($rslt==''){//无子嗣就算了
							$str=$str."<li>".$a_oc_i."&nbsp;".$v[$nmzd]."&nbsp;&nbsp;"."<a href='".$url."/gtxpg/x/updt/id/".$v[$idzd]."'>修改</a>"."&nbsp;&nbsp;"."<a href='javascript:disp(".$v[$idzd].")'>移位</a>"."&nbsp;&nbsp;"."<a href='javascript:dlt(".$v[$idzd].")'>删除</a>";
						}else{
							$str=$str."<li>".$a_oc_x."&nbsp;".$v[$nmzd]."&nbsp;&nbsp;"."<a href='".$url."/gtxpg/x/updt/id/".$v[$idzd]."'>修改</a>"."&nbsp;&nbsp;"."<a href='javascript:disp(".$v[$idzd].")'>移位</a>"."&nbsp;&nbsp;"."<a href='javascript:dlt(".$v[$idzd].")'>删除</a>".$rslt;
						}
						$str=$str.'</li>';
						//$arr[] = $v;
					}
				}
				if($str==''){
					return '';
				}else{
					return $str.'</ul>';//有子嗣要补上/ul
				}
			}	
			
			
		}
		//传递一个子分类ID返回所有的父级分类  
		Static Public function getParents ($cate, $id) {
			$arr = array();
			foreach ($cate as $v) {
				if ($v['id'] == $id) {
					$arr[] = $v;
					$arr = array_merge(self::getParents($cate, $v['pid']), $arr); 
				}
			}
			return $arr;
		}
		//传递一个父级分类ID返回所有子分类ID
		Static Public function getChildsId ($cate, $pid) {
			$arr = array();
			foreach ($cate as $v) {
				if ($v['pid'] == $pid) {
					$arr[] = $v['id'];
					$arr = array_merge($arr, self::getChildsId($cate, $v['id']));
				}
			}
			return $arr;
		}
		//传递一个父级分类ID返回所有子分类
		Static Public function getChilds ($cate, $pid) {
			$arr = array();
			foreach ($cate as $v) {
				if ($v['pid'] == $pid) {
					$arr[] = $v;
					$arr = array_merge($arr, self::getChilds($cate, $v['id']));
				}
			}
			return $arr;
		}

	}

// $cate = array(
//     0 => array('id' => 1, 'pid' => 0, 'name' => '江西省'),
//     1 => array('id' => 2, 'pid' => 0, 'name' => '浙江省'),
//     2 => array('id' => 3, 'pid' => 1, 'name' => '上饶市'),
//     3 => array('id' => 4, 'pid' => 3, 'name' => '广丰县'),
//     4 => array('id' => 5, 'pid' => 2, 'name' => '杭州市'),
//     5 => array('id' => 6, 'pid' => 5, 'name' => '西湖'),
//     6 => array('id' => 7, 'pid' => 6, 'name' => '断桥'),
// );
// $cate=array(
// 	0 => array('id' => 1, 'pid' => 0, 'name' => '一','odr'=>1,'cc'=>1),
// 	1 => array('id' => 11, 'pid' => 7, 'name' => '十一','odr'=>2,'cc'=>3),
// 	2 => array('id' => 5, 'pid' => 0, 'name' => '五','odr'=>4,'cc'=>1),
// 	3 => array('id' => 8, 'pid' => 5, 'name' => '八','odr'=>3,'cc'=>2),
// 	4 => array('id' => 3, 'pid' => 0, 'name' => '三','odr'=>2,'cc'=>1),
// 	5 => array('id' => 9, 'pid' => 5, 'name' => '九','odr'=>4,'cc'=>2),
// 	6 => array('id' => 10, 'pid' => 7, 'name' => '十','odr'=>1,'cc'=>3),
// 	7 => array('id' => 7, 'pid' => 5, 'name' => '七','odr'=>2,'cc'=>2),
// 	8 => array('id' => 2, 'pid' => 1, 'name' => '二','odr'=>1,'cc'=>2),
// 	9 => array('id' => 6, 'pid' => 5, 'name' => '六','odr'=>1,'cc'=>2),
// 	10 => array('id' => 4, 'pid' => 0, 'name' => '四','odr'=>3,'cc'=>1),
// );
//print_r(Category::unlimitedForLevel($cate));
// echo '<pre>';
// print_r(TreeAction::unlimitedForLayer($cate));
//print_r(Category::getParents($cate,7));
//print_r(Category::getChildsId($cate,2));
//print_r(Category::getChilds($cate,2));

 ?>