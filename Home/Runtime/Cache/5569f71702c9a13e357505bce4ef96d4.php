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
             <?php if($_COOKIE['username']!= null): ?><a class="user-link" href="__APP__/User/ownSpace/account/<?php echo (cookie('account')); ?>"  data-toggle="tooltip" title="<?php echo (cookie('username')); ?>">hi,<?php echo (cookie('username')); ?></a>
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
         
    <div class="content1">
        <div class="userInfo">
            <!-- 左边头像部分 -->
            <div class="infoLeft">
                <!-- 上传头像组件 -->
                <div class="demo">
                    <form id="upload_form" enctype="multipart/form-data" method="post" action="__APP__/User/uploadicon" onsubmit="return checkForm()">
                        <!-- hidden crop params -->
                        <input type="hidden" id="x1" name="x1"autocomplete="off" />
                        <input type="hidden" id="y1" name="y1" autocomplete="off"/>
                        <input type="hidden" id="x2" name="x2"autocomplete="off" />
                        <input type="hidden" id="y2" name="y2"autocomplete="off" />
                        <div class="iconBorder">
                            <img id="icon1" src="/webDesign/Public/img/upload/<?php echo ($user["icon"]); ?>">
                            <div class="previewBorder">
                            <img id="preview"/> 
                            </div>
                            <!-- <input type="submit" value="上传" class="btn btn-warning uploadIcon" />  -->
                        </div>
                        <div class="error">注意：选择图片-截图-上传</div><br/>
                        <input type="file" name="image_file" id="image_file" onchange="fileSelectHandler()" /><br/> <br/>
                        <input type="submit" value="上传" class="btn btn-warning uploadIcon" />
                        <div class="info1" style="display:none">
                            <ul>
                                <li><label ">文件大小</label> <input type="text" id="filesize" name="filesize" class="input" autocomplete="off" "/></li>
                                <li><label ">类型</label> <input type="text" id="filetype" name="filetype" class="input"autocomplete="off"/ "></li>
                                <li><label ">图像尺寸</label> <input type="text" id="filedim" name="filedim" class="input"autocomplete="off"/ "></li>
                                <li><label ">宽度</label> <input type="text" id="w" name="w" class="input"autocomplete="off"/ "></li>
                                <li><label ">高度</label> <input type="text" id="h" name="h" class="input"autocomplete="off"/ "></li>
                            </ul>
                         </div>
                    </form>
                </div>
            </div>
            <!-- 右边个人资料部分 -->
            <div class="infoRight"> 
            <label>用户:</label>
            <span><?php echo ($user["username"]); ?></span>
            <label>性别:</label>
            <span>
                <?php if($user["sex"] == 0): ?>男
                    <?php else: ?>女<?php endif; ?>
            </span>
            <label>账号:</label>
            <span><?php echo ($user["account"]); ?></span>  
            <label>邮箱:</label>
            <span><?php echo ($user["mail"]); ?></span>
            <label>住址:</label>  
            <span>/</span>
            <label>电话:</label>
            <span><?php echo ($user["phone"]); ?></span>
            </div>
            <div class="clear"></div>
            <!-- 关注，点赞，收藏标签分页 -->
            <div class="sortPage">
                <ul id="myTab" class="nav nav-pills">
                    <li class="active">
                        <a href="#attention" data-toggle="tab">关注</a>
                    </li>
                    <li>
                        <a href="#fans" data-toggle="tab">粉丝</a>
                    </li>
                     <li>
                        <a href="#thubmup" data-toggle="tab">点赞</a>
                    </li>
                     <li>
                        <a href="#collect" data-toggle="tab">收藏</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="attention">
                       <?php if(is_array($attention)): foreach($attention as $key=>$vo): ?><div class="usertap">
                                <img src="/webDesign/Public/img/upload/<?php echo ($vo["icon"]); ?>" >
                                <a href="__APP__/User/userSpace/account/<?php echo ($vo["account"]); ?>"><?php echo ($vo["username"]); ?></a>&nbsp&nbsp
                                <span onclick="window.location.href='__APP__/User/disattention/payer/<?php echo (cookie('account')); ?>/bePayer/<?php echo ($vo["account"]); ?>'" >取消关注</span>
                            </div><?php endforeach; endif; ?>
                    </div>
                    <div class="tab-pane fade" id="fans">
                        <?php if(is_array($fans)): foreach($fans as $key=>$vo): ?><div class="usertap">
                                <img src="/webDesign/Public/img/upload/<?php echo ($vo["icon"]); ?>" >
                                <a href="__APP__/User/userSpace/account/<?php echo ($vo["account"]); ?>"><?php echo ($vo["username"]); ?></a>&nbsp&nbsp
                                <?php if($attention1[$vo['account']] == 'yes'): ?><span class="attention<?php echo ($vo["account"]); ?>" onclick="attention('<?php echo ($vo["account"]); ?>','<?php echo (cookie('account')); ?>')" style="background-color:#980000">+关注</span>
                                <?php else: ?> 
                                    <span class="attention<?php echo ($vo["account"]); ?>" onclick="attention('<?php echo ($vo["account"]); ?>','<?php echo (cookie('account')); ?>')" >+关注</span><?php endif; ?>   
                            </div><?php endforeach; endif; ?>
                    </div>
                    <div class="tab-pane fade" id="thubmup">
                          <?php if($info1 != null ): if(is_array($info1)): foreach($info1 as $i=>$vo): ?><h5><a class="infoTitle" data-toggle="tooltip" title="<?php echo ($vo["title"]); ?> "href="__APP__/Info/infoDetail/info_id/<?php echo ($vo["info_id"]); ?>"><?php echo ($i+1); ?>.<?php echo ($vo["title"]); ?></a></h5><?php endforeach; endif; ?>
                          <?php else: ?><h5>暂无点赞</h5><?php endif; ?>
                    </div>
                    <div class="tab-pane fade" id="collect" >
                          <?php if($info2 != null ): if(is_array($info2)): foreach($info2 as $j=>$vo): ?><h5><a class="infoTitle" data-toggle="tooltip" title="<?php echo ($vo["title"]); ?>" href="__APP__/Info/infoDetail/info_id/<?php echo ($vo["info_id"]); ?>"><?php echo ($j+1); ?>.<?php echo ($vo["title"]); ?></a></h5><?php endforeach; endif; ?>
                          <?php else: ?><h5>暂无收藏</h5><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
      // 页面加载完成自动点击关注标签页
    window.onload=function(){
      $('#myTab a:first')[0].click();
    }
    </script>
    <script type="text/javascript" src="/webDesign/Public/js/upload/jquery.js"></script> 
    <script src="/webDesign/Public/js/upload/jquery.Jcrop.min.js"></script>
    <script src="/webDesign/Public/js/upload/script.js"></script>
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