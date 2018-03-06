<?php
header("Content-Type:text/html; charset=utf-8");
import('ORG.Util.Page');
class ManagerAction extends Action {
    public function index(){
	 	    $m=M('Manager');
        $count=$m->count();
        $Page=new Page($count,10);
        $show=$Page->show();
        $array=$m->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('manager',$array);
        $this->assign('show',$show);
        $this->display();  
    }
    // 通过m_id或account搜索用户
    public function search(){
      $string=$_POST['condition'];
      $m=M('Manager');
      $condition['m_id']=array('like',"%$string%");
      $condition['account']=array('like',"%$string%");
      $condition['_logic'] = 'OR';
      $count=$m->where($condition)->count();      
      $Page=new Page($count,10);
      $show=$Page->show();
      $result=$m->limit($Page->firstRow.','.$Page->listRows)->where($condition)->select();
      $this->assign('manager',$result);
      $this->assign('show',$show);
      $this->display();
    }
      // 删除单个管理员数据数据
    public function delete(){
       // 首先获取当前管理员的权限
       $m=M('Manager');
       $condition['account']=cookie('manageraccount');
       $range=$m->where($condition)->getField('range'); 
       // 再获取被修改的管理员的权限
       $condition1['m_id']=$_GET['m_id'];
       $ranged=$m->where($condition1)->getField('range');
       if($range<$ranged){
          $m_id=$_GET['m_id'];
          $result=$m->delete($m_id);
          if($result>0){
            $this->success("删除成功");
          }
          else{
            $this->error("删除失败");
          }
       }
       else{
          $this->error('删除失败，您的权限不够高');
       }
    }
      // 批量删除管理员数据
    public function muldelete(){
      // 首先获取当前管理员的权限
       $m=M('Manager');
       $condition['account']=cookie('manageraccount');
       $range=$m->where($condition)->getField('range'); 
          $array=json_decode(stripslashes($_GET['checked']));
          if(count($array)>0){
            for ($i=0;$i<count($array);$i++) {
               $condition1['m_id']=$array[$i];
               $ranged=$m->where($condition1)->getField('range');
               if($ranged<$range){
                  $this->error('删除失败，您的权限不够高');
                  break;
               }
            }
            for ($i=0;$i<count($array);$i++) {
               $m->delete($array[$i]);
            }
              $this->success("批量删除成功");
          }
          else{
              $this->error("请先选择要删除的内容");
          }
    }
     // 修改管理员信息
   public function change()
   {   
       // 首先获取当前管理员的权限
       $m=M('Manager');
       $condition['account']=cookie('manageraccount');
       $range=$m->where($condition)->getField('range'); 
       // 再获取被修改的管理员的权限
       $condition1['m_id']=$_POST['m_id'];
       $ranged=$m->where($condition1)->getField('range');
       if($range<$ranged){
          // 判断权限是否足够添加
          if($range<$_POST['range']){
             $attr['range']=$_POST['range'];
             $result=$m->where($condition1)->save($attr);
             if($result!==false){
                  $this->success('修改管理员权限成功');
               }
              else{
                  $this->error('修改管理员权限失败');
                }
          }
          else{
              $this->error('无法修改成高过您的权限');
          }
       }
       else{
          $this->error('操作失败，您的权限不够高');
       }   
    }
    // 添加管理员
     public function add()
   {
      // 首先获取当前管理员的权限
       $m=M('Manager');
       $condition['account']=cookie('manageraccount');
       $range=$m->where($condition)->getField('range'); 
      // 判断要添加的管理员是不是已存在的用户
       $account=$_POST['account'];
       $condition1['account']=$account;
       $m1=M('User');
       if($m1->where($condition1)->count()==0)
          $this->error('该用户不存在');
       else{
           // 判断权限是否足够添加
           if($range<$_POST['range']){ 
               // 修改数据库 
               $attr['account']=$_POST['account'];
               $attr['range']=$_POST['range'];
               $result=$m->add($attr);
               if($result){
                    $this->success('添加管理员成功');
                 }
                else{
                    $this->error('添加管理员失败');
                  }
            }    
            else{
                $this->error('您的权限无法执行该操作');
            }
        }
   }
}