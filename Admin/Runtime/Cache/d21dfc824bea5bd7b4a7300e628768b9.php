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
            <a class="nav-link active" href="#" >用户管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">咨讯管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">管理员管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">评论管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/webDesign/index.php/Index/index.html">返回前台</a>
          </li>
      </ul>
     </nav>   
   </div>
    
<div class="contain">
<form class="searchframe" action="" method="POST">
	  <div class="inputframe">
	    <input type="text" class="form-control">
	    <i class="icon-search "></i>
	  </div>
</form>
	<div class="table-responsive" >
		<table class="table table-bordered  table-hover">
		    <thead>
		      <tr class="table-primary">
		        <th>#</th>
		        <th>account</th>
		        <th>username</th>
		        <th>phone</th>
		        <th>mail</th>
		        <th>sex</th>
		        <th>operation</th>
			  </tr>
			 </thead>
		    <tbody>	
           <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
              	<td><?php echo ($i); ?></td>
              	<td class="account<?php echo ($i); ?>"><?php echo ($vo["account"]); ?></td>
              	<td class="username<?php echo ($i); ?>"><?php echo ($vo["username"]); ?></td>
              	<td class="phone<?php echo ($i); ?>"><?php echo ($vo["phone"]); ?></td>
              	<td class="mail<?php echo ($i); ?>"><?php echo ($vo["mail"]); ?></td>
                <?php if($vo["sex"] == 0): ?><td class="sex<?php echo ($i); ?>">女</td>
              	<?php else: ?><td class="sex<?php echo ($i); ?>">男</td><?php endif; ?>
              
              	<td>
              		<button type="button" class="btn btn-primary" onclick="setItem(<?php echo ($i); ?>)" data-toggle="modal" data-target="#myModal3">修改</button>
              		<button type="button" class="btn btn-danger">删除</button>
              	</td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>		
		    </tbody>
		</table>
	</div>
</div>
   <!-- 修改用户信息模态框 -->
    <div class="modal fade" id="myModal3">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- 模态框头部 -->
          <div class="modal-header">
            <h4 class="modal-title">修改用户信息</h4>
            <!-- <h6 class="tip">没有账号？<span>点击注册</span></h6> -->
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- 模态框主体 -->
          <div class="modal-body">
            <form class="form-register" action="__APP__/User/changeUserInfo" method="post">
              <input type="text" name="account" id="account3" class="form-control" placeholder="account" required autofocus>
              <br/>
              <input type="text" name="username" id="username3" class="form-control" placeholder="username" required >
              <br/>
              <div class="form-control sex">
                <span>性别：<span>
                <input type="radio" name="sex"  value="1" checked><span>男</span>&nbsp&nbsp
                <input type="radio" name="sex"  value="0"><span>女</span>
              </div>
              <br/>
              <input type="text" name="phone" id="phone3" class="form-control" placeholder="phone" required>
              <br/>
              <input type="e-mail" name="mail" id="mail3" class="form-control" placeholder="e-mail" required>
              <br/>
              <input type="submit" class="btn btn-lg btn-primary " id="changeUserBtn" value="确认修改">
            </form>
          </div>
          <!-- 模态框底部 -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
          </div>
        </div>
      </div>
    </div>
  
</body>
</html>