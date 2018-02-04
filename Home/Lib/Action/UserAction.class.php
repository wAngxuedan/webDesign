<?php
header("Content-Type:text/html; charset=utf-8");
class UserAction extends Action {
    public function login(){
	   // 获取前台传过来的用户名和密码，与数据库比对，看是否存在用户
       $account=$_POST['account'];
       $password=$_POST['password'];
       $code=$_POST['verifyCode'];
       // 比对验证码
       if($_SESSION['verify']!=md5($code)){
       	$this->error('验证码错误！');
       }
       $m=M('User');
       $condition['account'] = $account;
       $condition['password'] = md5($password);
       $i=$m->where($condition)->count();
       if($i>0){
        // 登录成功把username放在cookie里
          $username=$m->where($condition)->getField('username'); 
          cookie('username',$username,3600);
          // 如果该用户是管理员，设置managername cookie
          $m1=M('Manager');
          $condition1['account']=$account;
          if($m1->where($condition1)->count()>0)
            cookie('manageraccount',$account,3600);
          $this->success("登录成功");
       }
       else{
          $this->error("用户名或者密码错误");
       }
      
    }
    public function register(){
	   // 获取前台传过来的用户名和密码，与数据库比对，看是否存在用户
       $attr['account']=$_POST['account'];
       $attr['username']=$_POST['username'];
       $attr['password']=md5($_POST['password']);
       $attr['sex']=$_POST['sex'];
       $attr['phone']=$_POST['phone'];
       $attr['mail']=$_POST['mail'];
       $code=$_POST['verifyCode'];
       //比对验证码
       if($_SESSION['verify']!=md5($code)){
       	$this->error('验证码错误！');
       }
       $m=M('User'); 
       $condition['account']=$_POST['account']; 
       $i=$m->where($condition)->count();
       if($i>0){
          $this->error("该账号已注册过了");
       }else{
         if($m->add($attr)){
         	  $this->success('注册成功');
         }
         else{
         	  $this->error('注册失败');
         }
        }
    }
     public function logoff(){
        cookie('username',null);
        cookie('manageraccount',null);
        $this->success("注销成功");

     }
}

?>