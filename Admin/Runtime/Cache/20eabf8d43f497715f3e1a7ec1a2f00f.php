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
  </head>
  <body>
   <div class="body">
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
          <a class="nav-link" href="#">返回前台</a>
        </li>
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
		        <th>sex</th>
		        <th>phone</th>
		        <th>mail</th>
		        <th>Sex</th>
			  </tr>
			 </thead>
		    <tbody>
		      <tr>
		        <td>1</td>
		        <td>Anna</td>
		        <td>Pitt</td>
		        <td>35</td>
		        <td>New York</td>
		        <td>USA</td>
		        <td>Female</td>
		      </tr>
		    </tbody>
		</table>
	</div>
</div>
  </body>
</html>