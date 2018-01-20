<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <title>悟空咨讯</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1">
    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="/webDesign/Public/bootstrap-4.0.0-beta.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/webDesign/Public/bootstrap-4.0.0-beta.3/dist/css/bootstrap.css">
    <!-- 自定义css文件 -->
    <link rel="stylesheet" href="/webDesign/Public/css/index.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="/webDesign/Public/bootstrap-4.0.0-beta.3/dist/js/jquery-3.2.1.js"></script>

    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="/webDesign/Public/bootstrap-4.0.0-beta.3/dist/js/bootstrap.min.js"></script>
  </head>
  <body>
  <div class="body">
    <nav class="navbar navbar-expand-sm bg-secondary navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item ">
          <div class="nav-link logo" ></div>
        </li>
        <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</p>
        <li class="nav-item ">
          <a class="nav-link" href="#">股票</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">基金</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">期货</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">外汇</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">债券</a>
        </li>
        <li class="nav-item searchframe">
          <div class="inputframe">
            <input type="text" class="form-control">
            <span class="glyphicon glyphicon-search"></span>
          </div>
        </li>

      </ul>
      
      <ul class="userbar">
        <li class="user-item" >
          <a class="user-link" href="#">后台入口</a>
        </li>
        <li class="nuser-item">
          <a class="user-link" href="#" data-toggle="modal" data-target="#myModal2">注册</a>
        </li>
        <li class="user-item">
          <a class="user-link" href="#" data-toggle="modal" data-target="#myModal1">登录</a>
        </li>
      </ul>
    </nav>
    <img src="__APP__/Public/code/id" style="display:none" />
    <!-- 登录模态框 -->
    <div class="modal fade" id="myModal1">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- 模态框头部 -->
          <div class="modal-header">
            <h4 class="modal-title">登录</h4>
            <!-- <h6 class="tip">没有账号？<span>点击注册</span></h6> -->
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- 模态框主体 -->
          <div class="modal-body">
            <form class="form-signin" action="__APP__/User/login" method="Post">
              <input type="text" name="account"  class="form-control" placeholder="account" required autofocus>
              <br/>
              <input type="password" name="password" id="inputPassword1" class="form-control" placeholder="Password" required>
              <br/>
              <div class="form-control ">
                <input type="test" name="verifyCode" id="verifyCode1"  placeholder="verifyCode" required>
                <img src="__APP__/Public/code/id" onclick='this.src=this.src+"?"+Math.random' />
              </div>
              <br/>
              <input type="submit" class="btn btn-lg btn-primary " id="loginBtn" value="登录">
            </form>
          </div>
          <!-- 模态框底部 -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
          </div>
        </div>
      </div>
     </div> 
   <!-- 注册模态框 -->
    <div class="modal fade" id="myModal2">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- 模态框头部 -->
          <div class="modal-header">
            <h4 class="modal-title">注册</h4>
            <!-- <h6 class="tip">没有账号？<span>点击注册</span></h6> -->
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- 模态框主体 -->
          <div class="modal-body">
            <form class="form-register" action="__APP__/User/register" method="post">
              <input type="text" name="account"  class="form-control" placeholder="account" required autofocus>
              <br/>
              <input type="text" name="username" class="form-control" placeholder="username" required >
              <br/>
              <div class="form-control sex">
                <span>性别：<span>
                <input type="radio" name="sex"  value="1" checked><span>男</span>
                <input type="radio" name="sex"  value="0"><span>女</span>
              </div>
              <br/>
              <input type="password" name="password" id="inputPassword2" class="form-control" placeholder="Password" required>
              <br/>
              <input type="text" name="phone"  class="form-control" placeholder="phone" required>
              <br/>
              <input type="e-mail" name="mail"  class="form-control" placeholder="e-mail" required>
              <br/>
              <br/>
              <div class="form-control ">
                <input type="test" name="verifyCode" id="verifyCode2"  placeholder="verifyCode" required>
                <img src="__APP__/Public/code/id" onclick='this.src=this.src+"?"+Math.random' />
              </div>
              <br/>
              <input type="submit" class="btn btn-lg btn-primary " id="registerBtn" value="注册">
            </form>
          </div>
          <!-- 模态框底部 -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
          </div>
        </div>
      </div>
  </div>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{ padding: 24px 48px; }
.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
.system-message .jump{ padding-top: 10px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
</head>
<body>
<div class="system-message">
<?php if(isset($message)): ?><h1>:)</h1>
<p class="success"><?php echo($message); ?></p>
<?php else: ?>
<h1>:(</h1>
<p class="error"><?php echo($error); ?></p><?php endif; ?>
<p class="detail"></p>
<p class="jump">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>
</div>
  </body>
</html>