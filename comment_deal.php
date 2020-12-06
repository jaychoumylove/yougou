<?
	 include ("Include/mysql_open.php");
	 $pro_Id=$_POST["pro_Id"];
	 $list_Id=$_POST["list_Id"];
	 $com_class=$_POST["com_class"];
	 if($com_class==0){
		 exit("<script>window.location.href='YG_user_comment.php';alert('请选择评价星级！');</script>");
	 }
	 $comment=$_POST["comment"];
	 $user=$_SESSION["user"];
	 $date=date("Y-m-d H:i:s",time());
	 $sql="insert into yg_comment(pro_Id,com_class,comment,user_Name,addtime) values('".$pro_Id."','".$com_class."','".$comment."','".$user."','".$date."')";
	$sql_list="update `yg_orderlist` set `iscomment`='1' where Id=".$list_Id;
	$result=mysql_query($sql);
	$result_l=mysql_query($sql_list);
	$affet_rows=mysql_affected_rows();//记录受影响行数
	if($result && $affet_rows && $result_l){
		echo "<script>window.location.href='YG_user_comment.php';alert('添加成功！');</script>";
	}else{
		echo "<script>window.location.href='YG_user_comment.php';alert('添加失败！');</script>";
	}
?>