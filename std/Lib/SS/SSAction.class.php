<?php
class SSAction extends Action{
	function setss(){
		$grd=M('grd');
		
		if(cookie('stdidck')&&cookie('grdidck')){
			$grdid=cookie('grdidck');
			$grdo=$grd->where('grdid='.$grdid)->find();
			$std=M($grdo['grdnm'].'_std');
			if($std->where('stdid='.cookie('stdidck'))->find()){
				session('grdidss',cookie('grdidck'));
				session('stdidss',cookie('stdidck'));
			}
		}
		$stdid=session('stdidss');
		$grdid=session('grdidss');
		$grdo=$grd->where('grdid='.$grdid)->find();
		
		$xq=M('xq');
		$xqo=$xq->where('xqdq=1')->find();
		$xqid=$xqo['xqid'];
		
		$std=M($grdo['grdnm'].'_std')->join('inner join tb_'.$grdo['grdnm'].'_stdxqdm ON stdid=f_stdxqdm_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqcls ON stdid=f_stdxqcls_stdid')->join('inner join tb_'.$grdo['grdnm'].'_stdxqmj ON stdid=f_stdxqmj_stdid');
		$stdoss=$std->join('tb_stt ON f_std_sttid=sttid')->join('tb_grd ON f_std_grdid=grdid')->join('tb_'.$grdo['grdnm'].'_mj ON f_stdxqmj_mjid=mjid')->join('tb_bxxs ON f_mj_bxxsid=bxxsid')->join('tb_cc ON f_mj_ccid=ccid')->join('tb_kl ON f_mj_klid=klid')->join('tb_xxxs ON f_mj_xxxsid=xxxsid')->join('tb_zsfw ON f_mj_zsfwid=zsfwid')->join('tb_xz ON f_mj_xzid=xzid')->join('tb_'.$grdo['grdnm'].'_cls ON f_stdxqcls_clsid=clsid')->join('tb_dm ON f_stdxqdm_dmid=dmid')->join('tb_sex ON f_std_sexid=sexid')->join('tb_rc ON f_std_rcid=rcid')->join('tb_zzmm ON f_std_zzmmid=zzmmid')->join('tb_xl ON f_std_xlid=xlid')->join('tb_stat ON f_std_statid=statid')->join('tb_xq ON f_stdxqcls_xqid=xqid')->where("f_stdxqcls_xqid=".$xqid." AND f_stdxqmj_xqid=".$xqid." AND f_stdxqdm_xqid=".$xqid." AND stdid=".$stdid)->find();
			
		$this->assign('stdoss',$stdoss);
	}
}
?>