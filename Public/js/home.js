function logoff () {
	if(confirm("您确定要注销该账号吗？"))
		window.location="/webDesign/index.php/User/logoff";
}

 // 控制导航栏的active类
  $(function () {
        $(".navbar-nav").find("li").each(function () {
            var a = $(this).find("a:first")[0];
            if ($(a).attr("href") === location.pathname) {
                $(this).addClass("active");
            } else {
                $(this).removeClass("active");
            }
        });
    })

// 资讯点赞,如果已点赞则取消点赞，未点赞则执行点赞操作
function like(info_id,account) {
    if(account==""){
        alert("请先登录");
    }
    else{
          var ele = document.getElementsByTagName('i');
          for(var i = 0; i < ele.length; i++){
            if(ele[i].className == 'icon-heart'){
                // 取消点赞
                if(ele[i].style.color=='red'){
                     $.ajax({
                        url:'/webDesign/index.php/Info/dislike',
                        data:{info_id:info_id,
                              account:account
                            }
                     })
                    ele[i].style.color='grey';
                    return;
                }
                  ele[i].style.color='red'; 
                  break;
            }
          }
         $.ajax({
            url:'/webDesign/index.php/Info/like',
            data:{info_id:info_id,
                  account:account
                }
         })
    }
}
// 资讯收藏,如果已收藏则取消收藏重复收藏，未收藏则执行收藏操作
function collect(info_id,account) {
    if(account==""){
        alert("请先登录");
    }
    else{
          var ele = document.getElementsByTagName('i');
          for(var i = 0; i < ele.length; i++){
            if(ele[i].className == 'icon-star'){
                // 取消收藏
                if(ele[i].style.color=='red'){
                     $.ajax({
                        url:'/webDesign/index.php/Info/discollect',
                        data:{info_id:info_id,
                              account:account
                            }
                     })
                    ele[i].style.color='grey';
                    return;
                }
                  ele[i].style.color='red'; 
                  break;
            }
          }
         $.ajax({
            url:'/webDesign/index.php/Info/collect',
            data:{info_id:info_id,
                  account:account
                }
         })
    }
}
// 关注评论者，如果已关注则取消关注重复关注，未关注则执行关注操作
function attention(account,user,index){
     array=new Array();
    if(user==""){
        alert("请先登录");
    }
    else{
        if(account==user){
          alert("不需要关注自己哦");
        }
        else{
          var ele = document.getElementsByTagName('span');
          // 先筛选出className是attention开头的
          for(var i = 0; i < ele.length; i++){
            if(ele[i].className.indexOf("attention")>=0){
                 array.push(ele[i]);
            } 
          }
          for(var i = 0; i < array.length; i++){
            if(array[i].className == 'attention'+index){
                // 取消收藏
                if($("."+array[i].className).css('backgroundColor')=="rgb(152, 0, 0)"){ 
                     $.ajax({
                        url:'/webDesign/index.php/Info/disattention',
                        data:{payer:user,
                              bePayer:account,
                              index:index
                            },
                        success:function(data, textStatus){
                          array[i].style.backgroundColor='#17a2b8';
                        }
                     })
                    return;
                }
                  break;
            }
          }
         $.ajax({
            url:'/webDesign/index.php/Info/attention',
            data:{payer:user,
                  bePayer:account,
                  index:index
                },
            success:function(data, textStatus){
              for(var i = 0; i < array.length; i++){
                 if(array[i].className=='attention'+index){
                     array[i].style.backgroundColor='#980000'; 
                  } 
              } 
            }    
         })
    }
   }
}
