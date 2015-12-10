<?php
class NTFAction extends Action{
	function setntf(){
		
		
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Usr'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athusro=$Idtath->identify($mdo['mdid'],'ntf');
		if($athusro['aths']==1){
			$usr=M('usr');
			$ntfusrnum=$usr->where("usrvw=0")->count();
			if($ntfusrnum!=0){
				$ntfstrusr="<li><a href='__APP__/Usr/notify'>未查看用户 <span class='badge'>".$ntfusrnum."</span></a></li>";
			}
		}
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Cstmusr'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athcstmusro=$Idtath->identify($mdo['mdid'],'ntf');
		if($athcstmusro['aths']==1){
			$cstmusr=M('cstmusr');
			$ntfcstmusrnum=$cstmusr->where("cstmusrvw=0")->count();
			if($ntfcstmusrnum!=0){
				$ntfstrcstmusr="<li><a href='__APP__/Cstmusr/notify'>未查看客户用户 <span class='badge'>".$ntfcstmusrnum."</span></a></li>";
			}
		}
		
		//鉴权 如果OK的就正常显示，或者出现查看神马的，否则就呵呵了,query he gtxpg两处
		$mdII=M('md');
		$mdo=$mdII->where("mdmk='Atc'")->find();
		import('@.IDTATH.IdtathAction');
		$Idtath = new IdtathAction();
		$athatco=$Idtath->identify($mdo['mdid'],'ntf');
		if($athatco['aths']==1){
			$atc=M('atc');
			$ntfatcnum=$atc->where("atcvw=0")->count();
			if($ntfatcnum!=0){
				$ntfstratc="<li><a href='__APP__/Atc/notify'>未查看文章 <span class='badge'>".$ntfatcnum."</span></a></li>";
			}
		}
		
		if($athusro['aths']==1||$athatco['aths']==1||$athcstmusro['aths']){
			$ntfstr="<li>";
			if($ntfusrnum+$ntfatcnum+$ntfcstmusrnum==0){
				$ntfstr=$ntfstr."<ul class='dropdown-menu'>";
			}else{
				$ntfstr=$ntfstr."<a data-toggle='dropdown' class='dropdown-toggle' href='#'>未读信息<b class='caret'></b> <span class='badge'>".($ntfusrnum+$ntfatcnum+$ntfcstmusrnum)."</span></a><ul class='dropdown-menu'>";
			}
			
			$ntfstr=$ntfstr.$ntfstrusr.$ntfstratc.$ntfstrcstmusr;
			$ntfstr=$ntfstr."</ul></li>";
			$this->assign('ntfstr',$ntfstr);
		}
	}
}
?>