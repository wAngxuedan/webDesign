<?php if (!defined('THINK_PATH')) exit();?>  <!DOCTYPE html>
  <html>
    <head>
      <title>悟空咨讯</title>
      <link rel="shortcut icon" type="image/x-icon" href="/webDesign/Public/img/logo1.png" />
      <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1">
      <!-- 新 Bootstrap4 核心 CSS 文件 -->
      <link rel="stylesheet" href="/webDesign/Public/bootstrap-4.0.0-beta.3-dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="/webDesign/Public/bootstrap-4.0.0-beta.3-dist/css/bootstrap.css">
      <link rel="stylesheet" href="/webDesign/Public/Font-Awesome-3.2.1/css/font-awesome.min.css">
      <!-- 自定义css文件 -->
      <link rel="stylesheet" href="/webDesign/Public/css/home.css">
      <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
      <script src="/webDesign/Public/bootstrap-4.0.0-beta.3-dist/js/jquery-3.2.1.js"></script>
      <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
      <script src="/webDesign/Public/bootstrap-4.0.0-beta.3-dist/js/bootstrap.min.js"></script>
      <!-- 自定义js文件 -->
      <script src="/webDesign/Public/js/home.js"></script>
    </head>
    <body>
    <div class="body">
      <!-- 顶部导航栏 -->
      <nav class="navbar navbar-expand-sm bg-secondary navbar-dark">
        <!-- 分类导航 -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link logo" href="__APP__" ><img src="/webDesign/Public/img/logo1.png" ></a>
          </li>
          <p>&nbsp&nbsp&nbsp</p>
          <li class="nav-item">
            <a class="nav-link" href="__APP__/Info/outline/info_kind/1">股票</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="__APP__/Info/outline/info_kind/2">基金</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="__APP__/Info/outline/info_kind/3">期货</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="__APP__/Info/outline/info_kind/4">外汇</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="__APP__/Info/outline/info_kind/5">债券</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="__APP__/Info/hotSearch">热搜榜</a>
          </li>
          <!-- search框 -->
          <li class="nav-item searchframe">
            <div class="inputframe">
              <form action="__APP__/Info/search" method="POST">
                <input type="text" class="form-control" placeholder="咨讯标题" name="condition">
                <button class="btn "><i class="icon-search " ></i></button>              
              </form>
            </div>
          </li>
        </ul>
        <!-- 用户部分 -->
        <ul class="userbar">
           <?php if($_COOKIE['manageraccount']!= null): ?><li class="user-item" >
                <a class="user-link" href="/webDesign/admin.php/Index/index">后台</a>
              </li><?php endif; ?>   
          <li class="nuser-item">
            <?php if($_COOKIE['username']!= null): ?><a class="user-link" href="#" onclick="logoff()">注销</a>
             <?php else: ?>
                <a class="user-link" href="#" data-toggle="modal" data-target="#myModal2" onclick="document.getElementById('img2').click()">注册</a><?php endif; ?>  
          </li>
          <li class="user-item ">
             <?php if($_COOKIE['username']!= null): ?><a class="user-link" href="__APP__/User/userSpace/account/<?php echo (cookie('account')); ?>">hi,<?php echo (cookie('username')); ?></a>
             <?php else: ?>
                <a class="user-link" href="#" data-toggle="modal" data-target="#myModal1" onclick="document.getElementById('img1').click()">登录</a><?php endif; ?>  
          </li>
        </ul>
      </nav>
      <img src="__APP__/Public/code" style="display:none" />
      <!-- 登录模态框 -->
      <div class="modal fade" id="myModal1">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- 模态框头部 -->
            <div class="modal-header">
              <h4 class="modal-title" >登录</h4>
              <!-- <h6 class="tip">没有账号？<span>点击注册</span></h6> -->
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- 模态框主体 -->
            <div class="modal-body">
              <form class="form-signin" action="__APP__/User/login" method="Post" >
                <input type="text" name="account"  class="form-control" placeholder="账号" required autofocus>
                <br/>
                <input type="password" name="password" autocomplete="new-password" id="inputPassword1" class="form-control" placeholder="密码" required />
                <br/>
                <div class="form-control ">
                  <input type="test" name="verifyCode" id="verifyCode1"  placeholder="验证码" required />
                  <img id="img1" src="__APP__/Public/code" onclick='this.src=this.src+"?"+Math.random' />
                </div>
                <br/>
                <input type="submit" class="btn btn-lg btn-primary " id="loginBtn" value="登录" />
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
      <div class="modal fade" id="myModal2" >
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
              <form class="form-register" action="__APP__/User/register" method="post" >
                <input type="text" name="account"  class="form-control" placeholder="账号" required autofocus />
                <br/>
                <input type="text" name="username"  class="form-control" placeholder="用户名" required />
                <br/>
                <div class="form-control sex">
                  <span>性别：<span>
                  <input type="radio" name="sex"  value="1" checked /><span>男</span>&nbsp&nbsp
                  <input type="radio" name="sex"  value="0" /><span>女</span>
                </div>
                <br/>
                <input type="password" name="password" autocomplete="new-password" id="inputPassword2" class="form-control" placeholder="密码" required />
                <br/>
                <input type="text" name="phone"  class="form-control" placeholder="电话号码" required />
                <br/>
                <input type="e-mail" name="mail"  class="form-control" placeholder="邮箱" required />
                <br/>
                <div class="form-control ">
                  <input type="test" name="verifyCode" id="verifyCode2"  placeholder="验证码" required>
                  <img id="img2" src="__APP__/Public/code" onclick='this.src=this.src+"?"+Math.random' />
                </div>
                <br/>
                <input type="submit" class="btn btn-lg btn-primary " id="registerBtn" value="注册"  />
              </form>
            </div>
            <!-- 模态框底部 -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            </div>
          </div>
        </div>
      </div>
         
<div class="content2">
	<div class="infoDetail">
	   <h1><a class="infoTitle" ><?php echo ($info["title"]); ?></a></h1>
	   <h5><?php echo ($info["time"]); ?>&nbsp&nbsp&nbsp&nbsp<?php echo ($info["from"]); ?></h5>
	   <?php if(is_array($content)): foreach($content as $key=>$vo): if($vo != ''): ?><p><?php echo ($vo); ?></p>
            <?php else: ?>
            	<br/><?php endif; endforeach; endif; ?>
	   <div class="tips">
	   	    <?php if($_COOKIE['like']== 'yes'): ?><span class="like"><i class="icon-heart" onclick="like(<?php echo ($info["info_id"]); ?>,'<?php echo (cookie('account')); ?>')" style="color:red"></i><br/><span>点个赞</span></span>
	   	    <?php else: ?>
	   	    <span class="like"><i class="icon-heart" onclick="like(<?php echo ($info["info_id"]); ?>,'<?php echo (cookie('account')); ?>')"></i><br/><span>点个赞</span></span><?php endif; ?>
	   		<?php if($_COOKIE['collect']== 'yes'): ?><span class="collect"><i class="icon-star" onclick="collect(<?php echo ($info["info_id"]); ?>,'<?php echo (cookie('account')); ?>')" style="color:red"></i><br/><span>收藏</span></span>
	   	    <?php else: ?>
	   	    <span class="collect"><i class="icon-star" onclick="collect(<?php echo ($info["info_id"]); ?>,'<?php echo (cookie('account')); ?>')"></i><br/><span>收藏</span></span><?php endif; ?>
	   </div>
	   <!-- 提交评论区域 -->
	   <div class="commentFrame">
	       <span>写评论</span>&nbsp&nbsp&nbsp
	       <span>已有<?php echo ($count); ?>条评论</span> 
	       <br/>
	       <form action="__APP__/Info/comment" method="POST">
	       	   <input name="info_id" value="<?php echo ($info["info_id"]); ?>"/ style="display:none">
		       <textarea class="comment" name='comment' placeholder="说两句吧..."></textarea>
		       <button type="submit" class="btn btn-info submitBtn">提交</button>
	       </form>
	   </div>
	   <!-- 显示评论区域 -->
	   <div class="commentList">
	   	   	<h2>全部评论</h2><hr/>
	   	   	<?php if($commentList == null): ?><h4>暂无评论</h4>
	    	<?php else: ?> 	
		    	<?php if(is_array($commentList)): foreach($commentList as $i=>$vo): ?><div class="commentDetail">	
			   			<div class="commnentTop">#<?php echo ($i+1); ?>楼&nbsp&nbsp&nbsp&nbsp	
			   				<img src="/webDesign/Public/img/upload/<?php echo ($icon[$i]); ?>" >&nbsp&nbsp	
			   				<?php echo ($username[$i]); ?>
			   				<?php if($attention[$vo['account']] == 'yes'): ?><span class="attention<?php echo ($i); ?>" onclick="attention('<?php echo ($vo["account"]); ?>','<?php echo (cookie('account')); ?>',<?php echo ($i); ?>)" style="background-color:#980000">+关注</span>
			   				<?php else: ?>	
			   				<span class="attention<?php echo ($i); ?>" onclick="attention('<?php echo ($vo["account"]); ?>','<?php echo (cookie('account')); ?>',<?php echo ($i); ?>)" >+关注</span><?php endif; ?>	
			   				<div class="commentTime"><?php echo ($vo["com_time"]); ?></div>
			   			</div>
			   			<div class="commnentbottom">
			   				<p data-toggle="tooltip" title="<?php echo ($vo["com_content"]); ?>"><?php echo ($vo["com_content"]); ?></p>
			   			</div>
			   	    </div><?php endforeach; endif; endif; ?>
	   		<div class="pageInfo"><?php echo ($show); ?> </div>
	   </div>
	  
	</div>
</div>  
      <div class="footer">
         <div class="footer_nav">
           <div class="footer_img"><img src="/webDesign/Public/img/logo2.png"></div>
           <span>悟空资讯</span>
           <h2>投资有风险，理财需谨慎</h2>
         </div>
      </div>
    </div> 
    </body>
  </html>