<?php
header("Content-Type:text/html; charset=utf-8");
import('ORG.Util.Page');
class InfoAction extends Action {
    public function outline(){
    	$m1=M('Info_kind');
	    $m2=M('Reflect');
	    $m3=M('Info');
    	$kind_id=$_GET['info_kind'];
    	$condition['kind_id']=$kind_id;
    	// 获取咨讯种类名称
        $kind_name=$m1->where($condition)->getField('kind_name');
        //获取咨讯内容
        $info_id=$m2->where($condition)->select();
        for($i=0;$i<count($info_id);$i++){
        	$array['info_id']=$info_id[$i]['info_id'];
        	$info[$i]=$m3->where($array)->find();
        }

        $this->assign('info',$info);
        $this->assign('kind_name',$kind_name);
	    $this->display();
    }
    public function hotSearch()
    {
    	$m=M('Info');
    	$count=$m->count();
    	$Page=new Page($count,8);
        $show=$Page->show();
    	$info=$m->limit($Page->firstRow.','.$Page->listRows)->order('scanNumber desc')->select();
    	$this->assign('info',$info);
    	$this->assign('show',$show);
    	$this->display();
    }
}

?>