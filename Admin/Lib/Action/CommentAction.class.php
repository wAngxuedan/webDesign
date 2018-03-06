<?php
header("Content-Type:text/html; charset=utf-8");
import('ORG.Util.Page');
class CommentAction extends Action {
    public function index(){
	    $m=M('Comment');
	    $m1=M('info');
        $count=$m->count();
        $Page=new Page($count,10);
        $show=$Page->show();
        $array=$m->limit($Page->firstRow.','.$Page->listRows)->select();
        for($i=0;$i<$count;$i++){
        	$condition['info_id']=$array[$i]['info_id'];
        	$title[$i]=$m1->where($condition)->getField('title');
        }
		$this->assign('title',$title);
        $this->assign('comment',$array);
        $this->assign('show',$show);
        $this->display();  
    }
     // 通过评论内容搜索相关评论
    public function search(){
      $string=$_POST['condition'];
      $m=M('Comment');
      $m1=M('Info');
      $condition['com_content']=array('like',"%$string%");
      $count=$m->where($condition)->count();      
      $Page=new Page($count,10);
      $show=$Page->show();
      $result=$m->limit($Page->firstRow.','.$Page->listRows)->where($condition)->select();
	   for($i=0;$i<$count;$i++){
	    	$array['info_id']=$result[$i]['info_id'];
	    	$title[$i]=$m1->where($array)->getField('title');
	    }
      $this->assign('comment',$result);
      $this->assign('title',$title);
      $this->assign('show',$show);
      $this->display();
    }
      // 删除单条评论
    public function delete(){
      $id=$_GET['id'];
      $m=M('Comment');
      $result=$m->delete($id);
      if($result>0){
        $this->success("删除成功");
      }
      else{
        $this->error("删除失败");
      }
    }
    // 批量删除评论
    public function muldelete(){
      $array=json_decode(stripslashes($_GET['checked']));
      $m=M("Comment");
 
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
