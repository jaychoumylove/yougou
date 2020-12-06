<?
	require("Include/mysql_open.php")
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登录-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_login.css">
</head>

<body>
	<!--top start-->
    <div class="top_content">
    	<div><a href="#" target="_blank"><img src="images/logo.png" alt="优购户外商城"></a><span>欢迎登录</span></div>
    </div>
    <!--top end-->
    <div class="l_main">
    	<div>
            <form method="post" action="YG_login_deal.php?act=login">
                <ul>
                    <h1><strong>账户登录</strong></h1>
                    <li class="t_ifm">账号密码不能为空！</li>
                    <li class="user"><img src="images/li——1.png" alt="账户"><input type="text" name="user" placeholder="请输入账户名" /></li>
                    <li class="paw"><img src="images/li——2.png" alt="密码"><input type="password" name="password" placeholder="请输入密码" /></li>
                            
                    <li class="remember_register"><span><input type="checkbox" id="jz_pad" name="checked" checked="" /><label for="jz_pad">&nbsp;记住密码&nbsp;&nbsp;</label></span><a href="YG_register.php" target="_self">没有账户？去注册</a></li>
                    <li class="button"><input type="submit" value="登录"/></li>
                </ul>
            </form>
        </div>
    </div>
    <!--foot start-->   
     <div class="foot">
    	<div>
        	<p>Copyright © 2008 - 2017 yougou Inc. 优购户外商城商城网  版权所有    <a href="#" target="_blank">粤ICP备14013125号</a></p>
        </div>
    </div>
    <!--foot end-->
</body>
</html>