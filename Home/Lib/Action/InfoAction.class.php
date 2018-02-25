<?php
header("Content-Type:text/html; charset=utf-8");
import('ORG.Util.Page');
class InfoAction extends Action {
	// 各类咨讯数据
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
    // 热搜榜数据
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
    // 查询功能
    public function search(){
      $string=$_POST['condition'];
      if($string==""){
      	 $this->error("请先输入你要查找的内容");
      }
      else{    
	      $m=M('Info');
	      $condition['title']=array('like',"%$string%");
	      $count=$m->where($condition)->count();  
	      if($count==0){
	      	  $this->error("抱歉，没有找到你要的内容");
	      }    
	      else{
		      $Page=new Page($count,8);
		      $show=$Page->show();
		      $result=$m->limit($Page->firstRow.','.$Page->listRows)->where($condition)->select();
		      $this->assign('info',$result);
		      $this->assign('show',$show);
		      $this->display();
	      }
      }

    }


}

?>