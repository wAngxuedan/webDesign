<?php
header("Content-Type:text/html; charset=utf-8");
import('ORG.Util.Page');
class UserAction extends Action {
    public function index(){
        $m=M('User');
        $count=$m->count();
        $Page=new Page($count,10);
        $show=$Page->show();
        $array=$m->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('user',$array);
        $this->assign('show',$show);
        $this->display();
    } 
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
}