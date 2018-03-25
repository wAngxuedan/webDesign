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
        $m1=M('Thumbup');
        $m2=M('Collect');
        $m3=M('Info');
        $m4=m('Attention');
        $condition['account']=$_GET['account'];
        $user=$m->where($condition)->find();
        // 如果有关注该用户，设置cookie
        cookie('attention',null);
        $con['payer']=cookie('account');
        $con['bePayer']=$_GET['account'];
        if($m4->where($con)->count()>0){
          cookie('attention','yes');
        }
        // 收藏和点赞过的咨讯
        $info_id1=$m1->where($condition)->select();
        $info_id2=$m2->where($condition)->select();
        // 粉丝
        $array1['bePayer']=$_GET['account'];
        $acc1=$m4->where($array1)->select();
        for($i=0;$i<count($acc1);$i++){
          $condition['account']=$acc1[$i]['payer'];
          $user1[$i]=$m->where($condition)->find();
        }
        // 关注的人
        $array2['payer']=$_GET['account'];
        $acc2=$m4->where($array2)->select();
        for($i=0;$i<count($acc2);$i++){
          $condition['account']=$acc2[$i]['bePayer'];
          $user2[$i]=$m->where($condition)->find();
        }
        // 返回该用户点赞过的咨讯
        for($i=0;$i<count($info_id1);$i++){
            $arr['info_id']=$info_id1[$i]['info_id'];
            $info1[$i]=$m3->where($arr)->find();      
        }
         // 返回该用户收藏过的咨讯
        for($i=0;$i<count($info_id2);$i++){
            $arr['info_id']=$info_id2[$i]['info_id'];
            $info2[$i]=$m3->where($arr)->find();      
        }
        $this->assign('info1',$info1);
        $this->assign('info2',$info2);
        $this->assign('fans',$user1);
        $this->assign('attention',$user2);
        $this->assign("user",$user);
        $this->display();
     }
       public function ownSpace(){
          $m=M('User');
          $m1=M('Thumbup');
          $m2=M('Collect');
          $m3=M('Info');
          $m4=m('Attention');
          $condition['account']=$_GET['account'];
          $user=$m->where($condition)->find();
          //以$attention["被关注者的account"]=’yes‘存储数据，然后传到前端方便确认是否关注过
          $arr1['payer']=cookie('account');
          $count1=$m4->where($arr1)->count();
          $arr1=$m4->where($arr1)->select();
          for($i=0;$i<$count1;$i++){
              $index=$arr1[$i]['bePayer'];
              $attention1[$index]='yes';
          } 
          // 收藏和点赞过的咨讯
          $info_id1=$m1->where($condition)->select();
          $info_id2=$m2->where($condition)->select();
          // 粉丝
          $array1['bePayer']=$_GET['account'];
          $acc1=$m4->where($array1)->select();
          for($i=0;$i<count($acc1);$i++){
            $condition['account']=$acc1[$i]['payer'];
            $user1[$i]=$m->where($condition)->find();
          }
          // 关注的人
          $array2['payer']=$_GET['account'];
          $acc2=$m4->where($array2)->select();
          for($i=0;$i<count($acc2);$i++){
            $condition['account']=$acc2[$i]['bePayer'];
            $user2[$i]=$m->where($condition)->find();
          }
          // 返回该用户点赞过的咨讯
          for($i=0;$i<count($info_id1);$i++){
              $arr['info_id']=$info_id1[$i]['info_id'];
              $info1[$i]=$m3->where($arr)->find();      
          }
           // 返回该用户收藏过的咨讯
          for($i=0;$i<count($info_id2);$i++){
              $arr['info_id']=$info_id2[$i]['info_id'];
              $info2[$i]=$m3->where($arr)->find();      
          }
          $this->assign('attention1',$attention1);
          $this->assign('info1',$info1);
          $this->assign('info2',$info2);
          $this->assign('fans',$user1);
          $this->assign('attention',$user2);
          $this->assign("user",$user);
          $this->display();
       }
       // ownSpace页取消关注
       public function disattention(){
          $m=M('attention');
          $array['payer']=$_GET['payer'];
          $array['bePayer']=$_GET['bePayer'];
          if($result=$m->where($array)->delete()){
               $this->success('取消关注成功');
          }
          else{
               $this->error('取消关注失败');
          }
       }
}

?>