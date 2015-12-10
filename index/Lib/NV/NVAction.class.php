<?php
class NVAction extends Action{
	function setnv(){
		
		import('@.TREE.TreeAction');
		$tree = new TreeAction();
		$bd=M('bd');
		$bdls=$bd->order('bdodr ASC')->select();//在按照这个顺序前提下，使用tree方法就能有序的得到
		$str=$tree->unlimitedForListNv($bdls,0,'bdid','bdnm','bdpid','bdodr');
		//给TREE前后增加首页和登录模块
		$str=substr_replace($str, "<li><a href='".__APP__."'>首页</a></li>", 4,0);
		$this->assign('tree',$str);
		
    	if(session('cstmusridss')){
    		$cstmusr=M('cstmusr');
    		$cstmusro=$cstmusr->where('cstmusrid='.session('cstmusridss'))->find();
			$lgstt="<li class='dropdown'><a data-toggle='dropdown' class='dropdown-toggle' href='#'><img src='".$cstmusro['cstmusrpt']."' class='img-circle' style='height:20px' /> ".$cstmusro['cstmusrnn']."<b class='caret'></b>							
					</a><ul class='dropdown-menu'><li><a href='".__ROOT__."/cstm.php' id='cstmusr_center' target='_blank'><i class=' glyphicon glyphicon-th-large'></i> 进入后台 </a>
					</li><li><a href='".__ROOT__."/cstm.php/Cstmusr/gtxpg/x/center' id='cstmusr_center' target='_blank'><i class='glyphicon glyphicon-user'></i> 个人中心 </a>
					</li><li><a href='".__ROOT__."/cstm.php/Cstmusr/gtxpg/x/modifypw' target='_blank'><i class='glyphicon glyphicon-lock'></i> 更改密码</a>
					</li><li class='divider'></li><li><a href='#' id='cstmusr_loginout'><i class='glyphicon glyphicon-off'></i> 注销 </a>
					</li></ul></li><li><a href='".__APP__."/Atc/collect'><i class='glyphicon glyphicon-heart'></i> 我的收藏 </a></li>";
    	}else{
    		$lgstt="<li><a href='#' data-toggle='modal' data-target='#myModal'>登录</a></li>";
		}
		$this->assign('lgstt',$lgstt);
		
	}
}
?>