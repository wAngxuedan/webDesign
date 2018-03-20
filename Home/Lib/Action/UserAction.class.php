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
          cookie('account',$account,3600);
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
        // 将用户相关的所有cookie设为null
        cookie('username',null);
        cookie('account',null);
        cookie('manageraccount',null);
        $this->redirect("Index/index","注销成功");

     }
     // 上传图片功能
     public function uploadicon(){
      $maxSize = 1024 * 1024; //1M 设置附件上传大小
      $allowExts = array("gif", "jpg", "jpeg", "png"); // 设置附件上传类型
      $file_save = "Public/img/upload/";
      include_once("UploadFile.class.php");
      $upload = new UploadFile(); // 实例化上传类
      $upload->maxSize = $maxSize;
      $upload->allowExts = $allowExts;
      $upload->savePath = $file_save; // 设置附件
      $upload->saveRule = time() . sprintf('%04s', mt_rand(0, 1000));
      if (!$upload->upload()) {// 上传错误提示错误信息
          $errormsg = $upload->getErrorMsg();
          $arr = array(
              'error' => $errormsg, //返回错误
          );
          echo json_encode($arr);
          exit;
      } else {// 上传成功 获取上传文件信息
          $info = $upload->getUploadFileInfo();
          $imgurl = $info[0]['savename'];

          $x = $_POST['x1'];
          $y = $_POST['y1'];
          $x2 = $_POST['x2'];
          $y2 = $_POST['y2'];
          $w = $_POST['w'];
          $h = $_POST['h'];
          include_once("jcrop_image.class.php");
          $file_save = "Public/img/upload/";
          $pic_name = $file_save . $imgurl;
          $crop = new jcrop_image($file_save, $pic_name, $x, $y, $w, $h, $w, $h);
          $file = $crop->crop();
          // 将上传的图片删除
          unlink($pic_name);
          $icon=str_replace($file_save,"",$file);
          // 将确定选择的图片名称存至数据库
          $m=M('User');
          $condition['account']=cookie('account');
          $old_icon=$m->where($condition)->getField('icon');
          $array['account']=cookie('account');
          $array['icon']=$icon;
          if($m->save($array)){
             $this->success("上传图像成功");
             if($old_icon!=="icon.png"){
             unlink($file_save.$old_icon);
            }
          }
          else{
             $this->error("上传图像失败");
          }
          // echo "上传后的原图片：<p><img src='" . $pic_name . "'/></p>";
          // echo "缩略图：<p><img src='" . $file . "'/></p>";
          // echo "<p><input type='button' value='返回' onclick='history.go(-1)'/></p>";
       }
     }
     public function userSpace(){
        $m=M('User');
        $condition['account']=$_GET['account'];
        if($condition['account']==cookie('account')){
            $icon=$m->where($condition)->getField('icon');
        }
        $this->assign("icon",$icon);
        $this->display();
     }
}

?>