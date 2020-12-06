<?
	require("Include/mysql_open.php");
	$act=$_GET["act"];
	
	if($act=="update"){//执行修改操作
		$myId=$_POST["myId"];
		$name=$_POST["name"];
		$description=$_POST["description"];
		$sql="update `yg_product_class` set `name`='".$name."' , `description`='".$description."' where Id=".$myId;
		//exit($sql);
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行数
		if($result && $affet_rows){
			echo "<script>window.location.href='product_class.php';alert('修改成功！');</script>";
		}else{
			echo "<script>window.location.href='product_class.php';alert('修改失败！');</script>";
		}
	}elseif($act=="add"){//执行添加操作
		$parentId=$_POST["parentId"];
		$name=$_POST["name"];
		$description=$_POST["description"];
  
		$date=date("Y-m-d H:i:s",time());
		
		$sql="insert into `yg_product_class` (parentId,name,description,addtime) values(".$parentId.",'".$name."','".$description."','".$date."')";
		//exit($sql);
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行数
		
		if($result && $affet_rows){
			echo "<script>window.location.href='product_class.php';alert('添加成功！');</script>";
		}else{
			echo "<script>window.location.href='product_class.php';alert('添加失败！');</script>";
		}
	
		
	}elseif($act=="del"){//执行删除
		$Id=$_GET["Id"];
		$sql_c="select * from `yg_product_class` where `Id`=".$Id;
		$result_c=mysql_query($sql_c);
		$rows_num_c=mysql_num_rows($result_c);
		$result_arr_p=mysql_fetch_array($result_c);
		$sql_s="select * from `yg_product_class` where `parentId`=".$Id;
		$result_s=mysql_query($sql_s);
		$rows_num_s=mysql_num_rows($result_s);
		//exit($sql_s);
		if($result_arr_p["parentId"]==0 && $rows_num_s){
			exit("<script>window.location.href='product_class.php';alert('该类下面有子类，请删除子类再删除本类！');</script>");
		}
		$sql="delete from `yg_product_class` where `Id`=".$Id;
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行		
		if($result && $affet_rows){
			echo "<script>window.location.href='product_class.php';alert('删除成功！');</script>";
		}else{
			echo "<script>window.location.href='product_class.php';alert('删除失败！');</script>";
		}		
	}else if($act=="delAll"){
		$checkbox_Id=$_POST["checkbox_Id"];//获取被选中复选框的值
		 
		$Id_str=implode(",",$checkbox_Id);//把集合按照逗号 合并成字符串
		
		$sql="delete from `yg_product_class` where Id in (".$Id_str.")";
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行		
		if($result && $affet_rows){
			echo "<script>window.location.href='product_class.php';alert('删除成功！');</script>";
		}else{
			echo "<script>window.location.href='product_class.php';alert('删除失败！');</script>";
		}				
		
		
	}




?>