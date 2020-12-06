<?
	if(@$_SESSION["user"]==""){
		exit("<script>alert('您尚未登录，请登录！');window.location.href='YG_login.php'</script>");
	}
?>