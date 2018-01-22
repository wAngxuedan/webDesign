<?php
header("Content-Type:text/html; charset=utf-8");
class UserAction extends Action {
    public function index(){
        $m=M('User');
        $array=$m->select();
        $this->assign('user',$array);
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
}