<?
	require("Include/mysql_open.php");
	$act=$_GET["act"];
	
	if($act=="update"){//执行修改操作
		$myId=$_POST["myId"];
		$user=$_POST["user"];
		$password=$_POST["password"];
		if(empty($password)){
			$password1=$_POST["password1"];
		}else{
			$password1=md5($password);
		}
		
		$sex=$_POST["sex"];
		$name=$_POST["name"];
		$phone=$_POST["phone"];
		$email=$_POST["email"];
		
		$sql="update `yg_user` set `user`='".$user."', `password`='".$password1."',`name`='".$name."',`sex`='".$sex."',`email`='".$email."',`phone`='".$phone."' where Id=".$myId;
		//exit($sql);
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行数
		
		if($result && $affet_rows){
			echo "<script>window.location.href='user.php';alert('修改成功！');</script>";
		}else{
			echo "<script>window.location.href='user.php';alert('修改失败！');</script>";
		}
	
		
	}elseif($act=="add"){//执行添加操作
		
		$user=$_POST["user"];
		$password=$_POST["password"];
		$rpassword=$_POST["rpassword"];
		if($rpassword!=$rpassword){
			exit("<script>window.location.href='user.php';alert('密码不一致！！');</script>");
		}
		$sex=$_POST["sex"];
		$name=$_POST["name"];
		$email=$_POST["email"];
		$phone=$_POST["phone"];
		$date=date("Y-m-d H:i:s",time());
		
		$sql="insert into yg_user(user,password,sex,name,email,phone,addtime) values('".$user."','".md5($password)."','".$sex."','".$name."','".$email."','".$phone."','".$date."')";
		//exit($sql);

		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行数
		
		if($result && $affet_rows){
			echo "<script>window.location.href='user.php';alert('添加成功！');</script>";
		}else{
			echo "<script>window.location.href='user.php';alert('添加失败！');</script>";
		}
	
		
	}elseif($act=="del"){//执行删除
	
		$Id=$_GET["Id"];
		$sql="delete from `yg_user` where `Id`=".$Id;
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行		
		if($result && $affet_rows){
			echo "<script>window.location.href='user.php';alert('删除成功！');</script>";
		}else{
			echo "<script>window.location.href='user.php';alert('删除失败！');</script>";
		}		
	}elseif($act=="delAll"){
		$checkbox_Id=$_POST["checkbox_Id"];//获取被选中复选框的值
		 
		$Id_str=implode(",",$checkbox_Id);//把集合按照逗号 合并成字符串
		
		$sql="delete from `yg_user` where Id in (".$Id_str.")";
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行		
		if($result && $affet_rows){
			echo "<script>window.location.href='user.php';alert('删除成功！');</script>";
		}else{
			echo "<script>window.location.href='user.php';alert('删除失败！');</script>";
		}				
		
		
	}




?>