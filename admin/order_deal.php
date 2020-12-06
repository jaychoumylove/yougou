<?
	require("Include/mysql_open.php");
	$act=$_GET["act"];
	if($act=="fahuo"){
		$Id=$_GET["Id"];
		$sql="update `yg_order` set `orderment`='2' where Id=".$Id;
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行数
		if($result && $affet_rows){
			echo "<script>window.location.href='order.php';alert('发货成功！');</script>";
		}else{
			echo "<script>window.location.href='order.php';alert('发货失败！');</script>";
		}
	}
?>