﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录后台管理系统</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>
<script src="js/cloud.js" type="text/javascript"></script>

<script language="javascript">
	$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })  
	
	
});  
</script> 
<script >
	$(function(){
		$(".loginbtn").click(function(){
			if($(".loginuser").val()==""){
				alert("用户名不能为空！");
			}else if($(".loginpwd").val()==""){
				alert("密码不能为空！");
			}else{
				$("#myform").submit();	
			}			
		});
	});
</script>
</head>

<body style="background-color:#df7611; background-image:url(images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">



    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>  


<div class="logintop">    
    <span>欢迎登录后台管理界面平台</span>    
    <ul>
    <li><a href="#">回首页</a></li>
    <li><a href="#">帮助</a></li>
    <li><a href="#">关于</a></li>
    </ul>    
    </div>
    
    <div class="loginbody">
    
    <span class="systemlogo"></span> 
       
    <div class="loginbox loginbox3">
    <form action="login_deal.php?act=login" method="post" id="myform">
    <ul>
    <li><input name="adminname" type="text" class="loginuser" value="" onclick="JavaScript:this.value=''"/></li>
    <li><input name="adminpwd" type="password" class="loginpwd" value="" onclick="JavaScript:this.value=''"/></li>
    <li class="yzm">
    <span><input name="admincode" type="text" value="验证码" onclick="JavaScript:this.value=''"/></span><cite><img src="identifCode.php" onclick="this.src='identifCode.php?'+Math.random();"></cite> 
    </li>
    <li><input name="" type="button" class="loginbtn" value="登录"  /><label><input name="" type="checkbox" value="" checked="checked" />记住密码</label><label><a href="#">忘记密码？</a></label></li>
    </ul>
    </form>
    
    </div>
    
    </div>
    
    
    <div class="loginbm">版权所有  2014  <a href="http://www.uimaker.com">uimaker.com</a>  仅供学习交流，勿用于任何商业用途</div>
	
    
</body>

</html>
