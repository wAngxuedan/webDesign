<?php
header("Content-Type:text/html; charset=utf-8");
class UserAction extends Action {
    public function index(){
        $m=M('User');
        $array=$m->select();
        $this->assign('user',$array);
        $this->display();
    } 
}