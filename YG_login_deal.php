<?
	require("Include/mysql_open.php");
	$act=$_GET["act"];
	
	if($act=="login"){
		$user=$_POST["user"];
		$password=md5($_POST["password"]);
		if($user=="" &&  $password==""){//为了安全性 服务器验证
			exit("<script>alert('用户名和密码不能为空！');window.location.href='login.php'</script>");
		}
		$sql="select * from `yg_user` where `user`='".$user."' and `password`='".$password."'";
		$result=mysql_query($sql);
		$rows_num=mysql_num_rows($result);
		if($result && $rows_num){
			/*$checked=$_POST["checked"];
			if($checked=="true"){
				setcookie('user',$user,time()+3600*24*7);
				setcookie('password',$password,time()+3600*24*7);
			}else{
				setcookie('user',$user,time()-1);
				setcookie('password',$password,time()-1);
			}*/
			$_SESSION["user"]=$user;
			exit("<script>alert('登录成功！');window.location.href='YG_index.php'</script>");
		}else{
			exit("<script>alert('登录失败！');window.location.href='YG_login.php'</script>");
		}
	}else if($act=="cancellation"){
		unset($_SESSION["user"]);
		exit("<script>alert('注销成功！');window.location.href='YG_index.php'</script>");
	}else if($act=="switch"){
		unset($_SESSION["user"]);
		exit("<script>window.location.href='YG_login.php'</script>");
	}
?>