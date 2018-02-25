<?php
header("Content-Type:text/html; charset=utf-8");
import('ORG.Util.Page');
class InfoAction extends Action {

    public function index(){
		    $m1=M('Info');
        $m2=M('Info_kind');
        $count=$m1->count();
        $Page=new Page($count,10);
        $show=$Page->show();
        $array=$m1->limit($Page->firstRow.','.$Page->listRows)->select();
        $info_kind=$m2->select();
        $this->assign('info',$array);
        $this->assign('info_kind',$info_kind);
        $this->assign('show',$show);
        $this->display();
    }
    // 通过title搜索咨讯
    public function search(){
      $string=$_POST['condition'];
      $m=M('Info');
      $condition['title']=array('like',"%$string%");
      $count=$m->where($condition)->count();      
      $Page=new Page($count,10);
      $show=$Page->show();
      $result=$m->limit($Page->firstRow.','.$Page->listRows)->where($condition)->select();
      $this->assign('info',$result);
      $this->assign('show',$show);
      $this->display();
    }
     // 删除单条咨讯
    public function delete(){
      $id=$_GET['id'];
      $m=M('Info');
      $result=$m->delete($id);
      if($result>0){
        $this->success("删除成功");
        // 同步删除reflect表的数据
        $m1=M('Reflect');
        $condition['info_id']=$id;
        $m1->where($condition)->delete();
      }
      else{
        $this->error("删除失败");
      }
    }
    // 批量删除用咨讯
    public function muldelete(){
      $array=json_decode(stripslashes($_GET['checked']));
      $m=M("Info");
      $m1=M("Reflect");
      if(count($array)>0){
        for ($i=0;$i<=count($array);$i++) {
           $m->delete($array[$i]);
            // 同步删除reflect表的数据
           $condition['info_id']=$array[$i];
           $m1->where($condition)->delete();
        }
          $this->success("批量删除成功");
      
      }
      else{
          $this->error("请先选择要删除的内容");
      }
    }
     // 添加咨讯
   public function add()
   {
       $attr['title']=$_POST['title'];
       $attr['content']=$_POST['content'];
       $attr['time']=$_POST['time'];
       $attr['from']=$_POST['from'];
       $kind_id=$_POST['kind_id'];
       // 添加数据
       $m=M('Info'); 
       $result=$m->add($attr);
       if($result){
         	  $this->success('添加咨讯成功');
            // 同步添加reflect表的数据
            $m1=M('Reflect');
            $array['kind_id']=$kind_id;
            $array['info_id']=$result;
            $m1->add($array);
         }
        else{
         	  $this->error('添加咨讯失败');
         	}
   }
   // 修改咨讯
   public function changeInfo()
   { 
   	   $condition['info_id']=$_POST['id'];
   	   $attr['title']=$_POST['title'];
       $attr['content']=$_POST['content'];
       $attr['time']=$_POST['time'];
       $attr['from']=$_POST['from'];
       $m=M("Info");
       $result=$m->where($condition)->save($attr);
       if($result!==false){
         	  $this->success('修改咨讯成功');
         }
        else{
         	  $this->error('修改咨讯失败');
         	}
    }
}