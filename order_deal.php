<?php 
	include ("Include/mysql_open.php");
	$act=$_GET["act"];
	if($act=="add"){
		$ordernum=$_POST["ordernum"];
		$user=$_SESSION["user"];
		$heji_hid=$_POST["heji_hid"];
		$pay_ment=$_POST["pay_ment"];
		$ship_ment=$_POST["ship_ment"];
		$addtime=date("Y/m/d H:i:s",time());
		$ment=$_POST["ment"];
		$sql_ads="select * from `yg_address` where (`ismoren`='1' and `user_Name`='".$user."') ;";
		$result_ads=mysql_query($sql_ads);
		$result_arr_ads=mysql_fetch_array($result_ads);
		$ads_info=$result_arr_ads["address_info"];
		$ads_name=$result_arr_ads["name"];
		$ads_phone=$result_arr_ads["phonenumber"];
		$ads_pscd=$result_arr_ads["postcode"];
		$sql_order="insert into `yg_order`(`order_Num`,`user_Name`,`pay`,`payment`,`shippingment`,`paytime`,`ads_info`,`ads_name`,`phone`,`postcode`,`ment`) values('".$ordernum."','".$user."','".$heji_hid."','".$pay_ment."','".$ship_ment."','".$addtime."','".$ads_info."','".$ads_name."','".$ads_phone."','".$ads_pscd."','".$ment."')";
		$result_order=mysql_query($sql_order);
		
		$pro_str=$_POST["proid"];
		/*$much="";*/
		$shopping_cart_Id_arr=explode(",",$_SESSION["shopping_cart_Id"]);
		$shopping_cart_much_arr=explode(",",$_SESSION["shopping_cart_much"]);
		$pro_arr=explode(",",$pro_str);
		for($n=0;$n<count($pro_arr);$n++){
			$sql_pro="select *,a.name as aname from `yg_product_class` as a join `yg_product`as b on a.Id=b.classId where b.`Id`=".$pro_arr[$n];
		   /*for($i=0;$i<count($shopping_cart_Id_arr);$i++){
			   if($pro_arr[$n]==$shopping_cart_Id_arr[$i]){
				   $much=$shopping_cart_much_arr[$i];
			   }
		   }*/
		   $Id_n=array_search($pro_arr[$n],$shopping_cart_Id_arr);
		   $result_pro=mysql_query($sql_pro);
		   $result_arr_pro=mysql_fetch_array($result_pro);
		   $sql_orderlist="insert into `yg_orderlist`(`order_Num`,`user_Name`,`pro_Id`,`pro_num`,`pro_price`,`pro_name`,`addtime`,`pro_class`) values('".$ordernum."','".$user."','".$pro_arr[$n]."','".$shopping_cart_much_arr[$Id_n]."','".$result_arr_pro["yg_price"]."','".$result_arr_pro["name"]."','".$addtime."','".$result_arr_pro["aname"]."')";
		   $result_orderlist=mysql_query($sql_orderlist);
		   /*for($m=0;$m<count($shopping_cart_Id_arr);$m++){
			   if($pro_arr[$n]==$shopping_cart_Id_arr[$m]){
			   }
		   }
		   echo $sql_orderlist;*/
		   unset($shopping_cart_Id_arr[$Id_n]);
		   unset($shopping_cart_much_arr[$Id_n]);
		}
		$shopping_cart_Id_str=implode(",",$shopping_cart_Id_arr);
		$_SESSION["shopping_cart_Id"]=$shopping_cart_Id_str;
		$shopping_cart_much_str=implode(",",$shopping_cart_much_arr);
		$_SESSION["shopping_cart_much"]=$shopping_cart_much_str;
		exit("<script>window.location.href='YG_SOSy.php?order_Num=".$ordernum."&ads_name=".$ads_name."&payment=".$pay_ment."&pay=".$heji_hid."';</script>");
	}else if($act=="del"){
		$Id=$_GET["Id"];
		$sql="delete from `yg_order` where `Id`=".$Id;
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行		
		if($result && $affet_rows){
			echo "<script>window.location.href='YG_user_order.php';alert('删除成功！');</script>";
		}else{
			echo "<script>window.location.href='YG_user_order.php';alert('删除失败！');</script>";
		}		
	}else if($act=="update"){
		$orderment=$_GET["orderment"];
		$Id=$_GET["Id"];
		if($orderment==1){
			$sql="update `yg_order` set `orderment`='".$orderment."' where Id=".$Id;//exit($sql_r);exit($sql_s);exit($sql);
			$result=mysql_query($sql);
			$affet_rows=mysql_affected_rows();//记录受影响行数
			if($result && $affet_rows){
				echo "<script>window.location.href='YG_user_order.php';alert('付款成功！');</script>";
			}else{
				echo "<script>window.location.href='YG_user_order.php';alert('付款失败！');</script>";
			}
		}else if($orderment==3){
			$sql="update `yg_order` set `orderment`='".$orderment."' where Id=".$Id;//exit($sql_r);exit($sql_s);exit($sql);
			$ordernum=$_GET["ordernum"];
			$sql_r="select * from `yg_orderlist` where `order_Num`=".$ordernum;
			$result_r=mysql_query($sql_r);
			while($result_arr_r=mysql_fetch_array($result_r)){
				$sql_l="select * from `yg_product` where `Id` =".$result_arr_r["pro_Id"];
				$result_l=mysql_query($sql_l);
				$result_arr_l=mysql_fetch_array($result_l);
				$sale=$result_arr_l["sales_vol"]+$result_arr_r["pro_num"];
				$stock=$result_arr_l["stock"]-$result_arr_r["pro_num"];
				$sql_j="update `yg_product` set `sales_vol`='".$sale."',`stock`='".$stock."' where Id=".$result_arr_r["pro_Id"];
				$result_j=mysql_query($sql_j);
			}
			$result=mysql_query($sql);
			$affet_rows=mysql_affected_rows();//记录受影响行数
			if($result && $affet_rows){
				echo "<script>window.location.href='YG_user_order.php';alert('确认收货成功！');</script>";
			}else{
				echo "<script>window.location.href='YG_user_order.php';alert('确认收货失败！');</script>";
			}
		}
	}else if($act=="update_address"){
		$act_add=$_POST["act_add"];
		$name=$_POST["name"];
		$s_province=$_POST["s_province"];
		$s_city=$_POST["s_city"];
		$s_county=$_POST["s_county"];
		$address_info=$_POST["address_info"];
		$phonenumber=$_POST["phonenumber"];
		$postcode=$_POST["postcode"];
		$userName=$_SESSION["user"];
		$Id_str_i=$_GET["Id_str"];
		$heji_i=$_GET["heji"];
		if($act_add=="add"){
			$date=date("Y-m-d H:i:s",time());
			if(@$_POST["ismoren"]==""){
				$ismoren=0;
			}else{
				$ismoren=1;
				$sql="update `yg_address` set `ismoren`='0' where user_Name='".$userName."' ";
				$result=mysql_query($sql);
			}
			$sql_r="insert into `yg_address`(`name`,`address_province`,`user_Name`,`address_city`,`address_county`,`address_info`,`phonenumber`,`postcode`,`ismoren`,`addtime`) values('".$name."','".$s_province."','".$userName."','".$s_city."','".$s_county."','".$address_info."','".$phonenumber."','".$postcode."','".$ismoren."','".$date."')";
			//exit($sql);
			//exit($sql_r);
			$result_r=mysql_query($sql_r);
			$affet_rows_r=mysql_affected_rows();//记录受影响行数
			if($result_r && $affet_rows_r){
				echo "<script>window.location.href='YG_ACK.php?Id_str_i=".$Id_str_i."&heji_i=".$heji_i."';alert('添加成功！');</script>";
			}else{
				echo "<script>window.location.href='YG_ACK.php?Id_str_i=".$Id_str_i."&heji_i=".$heji_i."';alert('添加失败！');</script>";
			}
		}else if($act_add=="update"){
			$myId=$_POST["myId"];
			if(@$_POST["ismoren"]=="1"){
				$sql_r="update `yg_address` set `ismoren`='0' where `user_Name`='".$userName."' ";
				$result_r=mysql_query($sql_r);
				$sql="update `yg_address` set `name`='".$name."',`address_province`='".$s_province."',`address_city`='".$s_city."',`address_county`='".$s_county."',`address_info`='".$address_info."',`phonenumber`='".$phonenumber."',`postcode`='".$postcode."',`ismoren`='1' where Id=".$myId;//echo $sql_r;exit($sql_s);
				$result=mysql_query($sql);//exit($sql);
				$affet_rows=mysql_affected_rows();//记录受影响行数
				if($result && $affet_rows && $result_r){
					echo "<script>window.location.href='YG_ACK.php?Id_str_i=".$Id_str_i."&heji_i=".$heji_i."';alert('修改成功！');</script>";
				}else{
					echo "<script>window.location.href='YG_ACK.php?Id_str_i=".$Id_str_i."&heji_i=".$heji_i."';alert('修改失败！');</script>";
				}
			}else{
				$sql="update `yg_address` set `name`='".$name."',`address_province`='".$s_province."',`address_city`='".$s_city."',`address_county`='".$s_county."',`address_info`='".$address_info."',`phonenumber`='".$phonenumber."',`postcode`='".$postcode."',`ismoren`='0' where Id=".$myId;//exit($sql_r);exit($sql_s);exit($sql);
				$result=mysql_query($sql);
				$affet_rows=mysql_affected_rows();//记录受影响行数
				if($result && $affet_rows){
					echo "<script>window.location.href='YG_ACK.php?Id_str_i=".$Id_str_i."&heji_i=".$heji_i."';alert('修改成功！');</script>";
				}else{
					echo "<script>window.location.href='YG_ACK.php?Id_str_i=".$Id_str_i."&heji_i=".$heji_i."';alert('修改失败！');</script>";
				}
			}
		}
	}else if($act=="deladdress"){
		$Id=$_POST["Id_del"];
		$Id_str_i=$_GET["Id_str"];
		$heji_i=$_GET["heji"];
		$sql="delete from `yg_address` where `Id`=".$Id;
		//exit($sql);
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行		
		if($result && $affet_rows){
			echo "<script>window.location.href='YG_ACK.php?Id_str_i=".$Id_str_i."&heji_i=".$heji_i."';alert('删除成功！');</script>";
		}else{
			echo "<script>window.location.href='YG_ACK.php?Id_str_i=".$Id_str_i."&heji_i=".$heji_i."';alert('删除失败！');</script>";
		}		
	}
?>