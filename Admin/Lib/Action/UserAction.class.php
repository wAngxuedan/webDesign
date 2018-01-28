<?php
header("Content-Type:text/html; charset=utf-8");
import('ORG.Util.Page');
class UserAction extends Action {
    public function index(){$m=M('User');
        $count=$m->count();
        $Page=new Page($count,10);
        $show=$Page->show();
        $array=$m->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('user',$array);
        $this->assign('show',$show);
        $this->display();  
    } 
    // 修改用户信息
    public function changeUserInfo(){ 
       // 获取前台数据
       $acc=$_POST['account'];
       $attr['username']=$_POST['username'];
       $attr['sex']=$_POST['sex'];
       $attr['phone']=$_POST['phone'];
       $attr['mail']=$_POST['mail'];
       // 修改数据库
       $m=M('User'); 
       $condition['account']=$acc;
       $result=$m->where($condition)->save($attr);
       if($result!==false){
         	  $this->success('修改用户信息成功');
         }
        else{
         	  $this->error('修改用户信息失败');
         	}
    }
    // 通过用户名或者账号搜索用户
    public function search(){
      $string=$_POST['condition'];
      $m=M('User');
      $condition['account']=array('like',"%$string%");
      $condition['username']=array('like',"%$string%");
      $condition['_logic'] = 'OR';
      $count=$m->where($condition)->count();      
      $Page=new Page($count,10);
      $show=$Page->show();
      $result=$m->limit($Page->firstRow.','.$Page->listRows)->where($condition)->select();
      $this->assign('user',$result);
      $this->assign('show',$show);
      $this->display();
    }
    // 删除单个用户数据
    public function delete(){
      $id=$_GET['id'];
      $m=M('User');
      $result=$m->delete($id);
      if($result>0){
        $this->success("删除成功");
      }
      else{
        $this->error("删除失败");
      }
    }
    // 批量删除用户数据
    public function muldelete(){
      $array=json_decode(stripslashes($_GET['checked']));
      $m=M("User");
      if(count($array)>0){
        for ($i=0;$i<=count($array);$i++) {
           $m->delete($array[$i]);
        }
          $this->success("批量删除成功");
      }
      else{
          $this->error("请先选择要删除的内容");
      }
    }
}