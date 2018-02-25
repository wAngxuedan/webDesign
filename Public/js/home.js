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