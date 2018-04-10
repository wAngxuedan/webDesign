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
		<form class="searchframe" action="__APP__/Manager/search" method="POST">
			  <div class="inputframe">
			    <input type="text" name="condition" class="form-control"  placeholder="用户id/账号" />
		      <button class="btn btn-info"><i class="icon-search " ></i></button>
			  </div>			  
		</form>
		<button class="btn btn-info addInfo"  data-toggle="modal" data-target="#myModal7">添加管理员</button>			
		<div class="table-responsive" >
		<table class="table table-bordered  table-hover">
		    <thead>
		      <tr class="table-primary">
		        <th>用户id</th>
		        <th>账号</th>
		        <th>权限等级</th>
		        <th></th>
			    </tr>
			  </thead>
		    <tbody>	
           <?php if(is_array($manager)): $i = 0; $__LIST__ = $manager;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
              	<td class="mid<?php echo ($i); ?>"><?php echo ($vo["m_id"]); ?></td>
              	<td ><?php echo ($vo["account"]); ?></td>
              	<td class="mrange<?php echo ($i); ?>"><?php echo ($vo["range"]); ?></td>
              	<td>
              		<button type="button" class="btn btn-primary" onclick="setInfoItem(<?php echo ($i); ?>)" data-toggle="modal" data-target="#myModal6">修改权限</button>
              		<button type="button" class="btn btn-danger" onclick="deleteManager(<?php echo ($vo["m_id"]); ?>)">删除</button>&nbsp&nbsp 
                    <input type="checkbox" name="indexManager" value="<?php echo ($vo["m_id"]); ?>" />
              	</td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>	
		    </tbody>
		</table>
	    <button type="button" class="btn btn-danger" onclick="muldeleteManager()" >批量删除</button>
	    <div class="pageInfo"><?php echo ($show); ?> </div>
  	</div>
  </div>
    <!-- 修改管理员信息模态框 -->
  <div class="modal fade" id="myModal6">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- 模态框头部 -->
        <div class="modal-header">
          <h4 class="modal-title">修改管理员信息</h4>
          <!-- <h6 class="tip">没有账号？<span>点击注册</span></h6> -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- 模态框主体 -->
        <div class="modal-body">
          <form  action="__APP__/Manager/change" method="post">
            <input type="text" name="m_id" id="mid6" style="display:none">
            <br/>
            <input type="text" name="range" id="range6" class="form-control" placeholder="权限等级" required autofocus>
            <br/>
            <input type="submit" class="btn btn-lg btn-primary changeBtn"  value="确认修改">
            <br/>
          </form>
         </div>
        <!-- 模态框底部 -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
        </div>
      </div>
    </div>
  </div>
    <!-- 添加管理员信息模态框 -->
  <div class="modal fade" id="myModal7">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- 模态框头部 -->
        <div class="modal-header">
          <h4 class="modal-title">添加管理员</h4>
          <!-- <h6 class="tip">没有账号？<span>点击注册</span></h6> -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- 模态框主体 -->
        <div class="modal-body">
          <form  action="__APP__/Manager/add" method="post">
            <input type="text" name="account" class="form-control" placeholder="账号" required>
            <br/>
            <input type="text" name="range" class="form-control" placeholder="权限等级" required>
            <br/>
            <input type="submit" class="btn btn-lg btn-primary addBtn" value="确认添加">
            <br/>
          </form>
         </div>
        <!-- 模态框底部 -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
        </div>
      </div>
    </div>
  </div>
<!-- 自定义js文件 -->
 <script src="/webDesign/Public/js/adminManager.js"></script> 
  
</body>
</html>