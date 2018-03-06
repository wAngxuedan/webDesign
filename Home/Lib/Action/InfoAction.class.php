<?php
header("Content-Type:text/html; charset=utf-8");
import('ORG.Util.Page');
class InfoAction extends Action {
	// 各类咨讯数据
    public function outline(){
    	$m1=M('Info_kind');
	    $m2=M('Reflect');
	    $m3=M('Info');
        $kind_id=$_GET['info_kind'];
        $condition['kind_id']=$kind_id;
        $count=$m2->where($condition)->count();
        $Page=new Page($count,8);
        $show=$Page->show();
    	// 获取咨讯种类名称
        $kind_name=$m1->where($condition)->getField('kind_name');
        //获取咨讯内容
        $info_id=$m2->where($condition)->select();
        for($i=0;$i<count($info_id);$i++){
        	$array['info_id']=$info_id[$i]['info_id'];
        	$info[$i]=$m3->where($array)->find();
        }
        $this->assign('info',$info);
        $this->assign('kind_name',$kind_name);
        $this->assign('show',$show);
	    $this->display();
    }
    // 热搜榜数据
    public function hotSearch()
    {
    	$m=M('Info');
    	$count=$m->count();
    	$Page=new Page($count,8);
        $show=$Page->show();
    	$info=$m->limit($Page->firstRow.','.$Page->listRows)->order('scanNumber desc')->select();
    	$this->assign('info',$info);
    	$this->assign('show',$show);
    	$this->display();
    }
    // 查询功能
    public function search(){
      $string=$_POST['condition'];
      if($string==""){
      	 $this->error("请先输入你要查找的内容");
      }
      else{    
	      $m=M('Info');
	      $condition['title']=array('like',"%$string%");
	      $count=$m->where($condition)->count();  
	      if($count==0){
	      	  $this->error("抱歉，没有找到你要的内容");
	      }    
	      else{
		      $Page=new Page($count,8);
		      $show=$Page->show();
		      $result=$m->limit($Page->firstRow.','.$Page->listRows)->where($condition)->select();
		      $this->assign('info',$result);
		      $this->assign('show',$show);
		      $this->display();
	      }
      }
    }
    // 资讯详情页
    public function infoDetail(){
        $m1=M('Info');
        $m2=M('Comment');
        $m3=M('Scan'); 
        $info_id=$_GET['info_id'];
        // 首先在scan表记录该次浏览记录
        if(cookie('account')){
            $array['account']=cookie('account');  
        }
        else{
            $array['account']="游客";
        }
        $array['info_id']=$info_id;
        $array['scan_time']=date('Y-m-d h:i:s',time());
        if($m3->add($array)){
             // 获取资讯内容
            $condition['info_id']=$info_id;
            $info=$m1->where($condition)->find();
            // 该咨询浏览数+1
            $condition['scanNumber']=$info['scanNumber']+1;
            if($m1->save($condition)!==false){
                // 评论分页
                $count=$m2->where($condition)->count();
                $Page=new Page($count,6);
                $show=$Page->show();
                // 获取资讯对应的评论
                $commentList=$m2->limit($Page->firstRow.','.$Page->listRows)->where($condition)->select();
                $content=explode("\n",$info['content']);
                $this->assign('count',$count);
                $this->assign('content',$content);
                $this->assign('commentList',$commentList);
                $this->assign('info',$info);
                $this->assign('show',$show);
                $this->display();
            }
            else{
                $this->error("添加咨询浏览数失败");
            }
        }
        else{
            $this->error("添加浏览记录失败");
        }
    }
    public function comment(){
        if(cookie('account')==""){
            $this->error("对不起,请先登录");
        }
        else{ 
            // 获取该条评论的信息添加到数据库
            $arr['com_content']=$_POST['comment'];
            $arr['info_id']=$_POST['info_id'];
            $arr['account']=cookie('account');
            $arr['com_time']=date('Y-m-d h:i:s',time());
            $arr['username']=cookie('username');
            $m=M('Comment'); 
            if($m->add($arr)){
                $this->success('添加评论成功');
            }  
            else{
                $this->error("添加评论失败");
            }
            
        }


    }
}

?>