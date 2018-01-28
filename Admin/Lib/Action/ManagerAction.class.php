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
      $m_id=$_GET['m_id'];
      $m=M('Manager');
      $result=$m->delete($m_id);
      if($result>0){
        $this->success("删除成功");
      }
      else{
        $this->error("删除失败");
      }
    }
      // 批量删除管理员数据
    public function muldelete(){
      $array=json_decode(stripslashes($_GET['checked']));
      $m=M("Manager");
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
     // 修改管理员信息
   public function change()
   { 
       $condition['m_id']=$_POST['m_id'];
       $attr['range']=intval($_POST['range']);
       $m=M("Manager");
       $result=$m->where($condition)->save($attr);
       if($result!==false){
            $this->success('修改管理员权限成功');
         }
        else{
            $this->error('修改管理员权限失败');
          }
    }
    // 添加管理员
     public function add()
   {
       $attr['account']=$_POST['account'];
       $attr['range']=$_POST['range'];
       // 修改数据库
       $m=M('Manager'); 
       $result=$m->add($attr);
       if($result){
            $this->success('添加管理员成功');
         }
        else{
            $this->error('添加管理员失败');
          }
   }
}