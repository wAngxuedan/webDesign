<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <title>悟空咨讯</title>
    <link rel="shortcut icon" type="image/x-icon" href="/webDesign/Public/img/favicon.ico" />
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1">
    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="/webDesign/Public/bootstrap-4.0.0-beta.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/webDesign/Public/bootstrap-4.0.0-beta.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="/webDesign/Public/Font-Awesome-3.2.1/css/font-awesome.min.css">
    <!-- 自定义css文件 -->
    <link rel="stylesheet" href="/webDesign/Public/css/admin.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="/webDesign/Public/bootstrap-4.0.0-beta.3-dist/js/jquery-3.2.1.js"></script>
    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="/webDesign/Public/bootstrap-4.0.0-beta.3-dist/js/bootstrap.min.js"></script>
    <!-- 自定义js文件 -->
     <script src="/webDesign/Public/js/admin.js"></script>
  </head>
  <body>
   <div class="header">
     <!-- 顶部导航栏 -->
     <nav class="navbar navbar-expand-sm bg-secondary navbar-dark">
      <ul class="navbar-nav">
          <li class="nav-item ">
            <div class="nav-link logo" ></div>
          </li>
          <p>&nbsp&nbsp&nbsp</p>
          <li class="nav-item ">
            <a class="nav-link" href="__APP__/User/index" >用户管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="__APP__/Info/index">咨讯管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="__APP__/Manager/index">管理员管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="__APP__/Comment/index">评论管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/webDesign/index.php/Index/index.html">返回前台</a>
          </li>
      </ul>
     </nav>   
   </div>
    
<div class="contain">
<form class="searchframe" action="__APP__/Comment/search" method="POST">
	  <div class="inputframe">
	    <input type="text" name="condition" class="form-control"  placeholder="评论内容" />
      <button class="btn btn-info"><i class="icon-search " ></i></button>
	  </div>
</form>
	<div class="table-responsive" >
		<table class="table table-bordered  table-hover">
		    <thead>
		      <tr class="table-primary">
		        <th>#</th>
		        <th >对应咨讯标题</th>
		        <th >评论内容</th>
		        <th >评论者</th>
		        <th >评论时间</th>
            <th ></th>
			    </tr>
			  </thead>
		    <tbody>	
           <?php if(is_array($comment)): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
              	<td><?php echo ($i); ?></td>
              	<td><textarea><?php echo ($title[$i-1]); ?></textarea></td>
              	<td><textarea><?php echo ($vo["com_content"]); ?></textarea></td>
              	<td><?php echo ($vo["account"]); ?></td>
              	<td><?php echo ($vo["com_time"]); ?></td>
              	<td>
              		<button type="button" class="btn btn-danger" onclick="deleteComment(<?php echo ($vo["com_id"]); ?>)">删除</button>&nbsp&nbsp 
                  <input type="checkbox" name="indexComment" value="<?php echo ($vo["com_id"]); ?>" />
              	</td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>	
		    </tbody>
		</table>
    <button type="button" class="btn btn-danger" onclick="muldeleteComment()" >批量删除</button>
    <div class="pageInfo"><?php echo ($show); ?> </div>
	</div>
</div>
<!-- 自定义js文件 -->
 <script src="/webDesign/Public/js/adminComment.js"></script> 
  
</body>
</html>