<?php
header("Content-Type:text/html; charset=utf-8");
class IndexAction extends Action {
    public function index(){
     $m1=M('Info_kind');
     $m2=M('Reflect');
     $m3=M('Info');
     // 获取咨讯种类
     $kind=$m1->select();
      // 连接Reflect和Info表根据kind_id获取分类后的咨讯  
     for($i=1;$i<=5;$i++){
     	$id_array=$m2->where('kind_id='.$i)->select();
     	for($j=0;$j<count($id_array);$j++){
     		$condition['info_id']=$id_array[$j]['info_id'];
     		$info[$i-1][$j]=$m3->where($condition)->find();
     	}
     }
     // 热搜榜
     $info_order=$m3->order('scanNumber desc')->limit(5)->select();
     $this->assign('info_order',$info_order);
     $this->assign('info',$info);
     $this->assign('kind',$kind);
	 $this->display();
    }
}

?>