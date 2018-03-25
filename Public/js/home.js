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
                            },
                        success:function(){
                            ele[i].style.color='grey';
                        }
                     })
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
                            },
                        success:function(){
                          ele[i].style.color='grey';
                        }    
                     })
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
// 咨讯详情页关注评论者，如果已关注则取消关注重复关注，未关注则执行关注操作
function attention(account,user){
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
            if(array[i].className == 'attention'+account){
                // 取消关注
                if($("."+array[i].className).css('backgroundColor')=="rgb(152, 0, 0)"){ 
                     $.ajax({
                        url:'/webDesign/index.php/Info/disattention',
                        data:{payer:user,
                              bePayer:account,
                            },
                        success:function(data, textStatus){
                          // 成功取消后改变css样式
                          for(var i = 0; i < array.length; i++){
                             if(array[i].className=='attention'+account){
                                 array[i].style.backgroundColor='white'; 
                              } 
                          } 
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
                },
            success:function(data, textStatus){
              // 成功关注后改变css样式
              for(var i = 0; i < array.length; i++){
                 if(array[i].className=='attention'+account){
                     array[i].style.backgroundColor='#980000'; 
                  } 
              } 
            }    
         })
    }
   }
}
// userSpace页关注/取消关注用户
function att(payer,bePayer){
  if(payer==""){
       alert("请先登录");
  }else{
    var ele = document.getElementsByTagName('span');
        for(var i = 0; i < ele.length; i++){
          if(ele[i].className == 'att'){
              // 取消收藏
              if(ele[i].style.backgroundColor=='rgb(0, 204, 255)'){
                   $.ajax({
                      url:'/webDesign/index.php/Info/disattention',
                      data:{payer:payer,
                            bePayer:bePayer
                          },
                      success:function(){
                        ele[i].style.backgroundColor='white';
                      }    
                   })
                  return;
              }
                ele[i].style.backgroundColor='rgb(0, 204, 255)'; 
                break;
          }}
           $.ajax({
              url:'/webDesign/index.php/Info/attention',
              data:{payer:payer,
                    bePayer:bePayer
                  }
          })
    }
}
