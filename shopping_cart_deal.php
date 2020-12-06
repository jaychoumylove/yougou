<?php 
	include ("Include/mysql_open.php");
    include ("session_chk.php");
	$act=$_GET["act"];
	//$act="clear";
	if($act=="add"){
		$Id=$_GET["Id"];
		if(@$_SESSION["shopping_cart_Id"]==""){
			$_SESSION["shopping_cart_Id"]=$Id;
			$_SESSION["shopping_cart_much"]=1;
		}else{
			$shopping_cart_Id_arr=explode(",",$_SESSION["shopping_cart_Id"]);
			for($i=0;$i<count($shopping_cart_Id_arr);$i++){
				if($Id==$shopping_cart_Id_arr[$i]){
					exit("<script>window.location.href='YG_products.php';alert('该商品已在您的购物车中，试试添加别的吧！');</script>");
				}
			}
			array_push($shopping_cart_Id_arr,$Id);
			$shopping_cart_Id_str=implode(",",$shopping_cart_Id_arr);
			$_SESSION["shopping_cart_Id"]=$shopping_cart_Id_str;
			$shopping_cart_much_arr=explode(",",$_SESSION["shopping_cart_much"]);
			array_push($shopping_cart_much_arr,1);
			$shopping_cart_much_str=implode(",",$shopping_cart_much_arr);
			$_SESSION["shopping_cart_much"]=$shopping_cart_much_str;
		}
		exit("<script>window.location.href='YG_shopping_cart.php';alert('添加成功')</script>");
	}else if($act=="del"){
		$Id=$_GET["Id"];
		$shopping_cart_much_arr=explode(",",$_SESSION["shopping_cart_much"]);
		$shopping_cart_Id_arr=explode(",",$_SESSION["shopping_cart_Id"]);
		for($i=0;$i<count($shopping_cart_Id_arr);$i++){
			if($Id==$shopping_cart_Id_arr[$i]){
				unset($shopping_cart_Id_arr[$i]);
				unset($shopping_cart_much_arr[$i]);
			}
		}
		//exit();
		$shopping_cart_Id_str=implode(",",$shopping_cart_Id_arr);
		$_SESSION["shopping_cart_Id"]=$shopping_cart_Id_str;
		$shopping_cart_much_str=implode(",",$shopping_cart_much_arr);
		$_SESSION["shopping_cart_much"]=$shopping_cart_much_str;	
		exit("<script>window.location.href='YG_shopping_cart.php';alert('删除成功！')</script>");
	}else if($act=="clear"){
		unset($_SESSION["shopping_cart_Id"]);
		unset($_SESSION["shopping_cart_much"]);
		exit("<script>window.location.href='YG_shopping_cart.php';alert('清空成功！')</script>");
	}else if($act=="deal_some"){
		$someId=$_POST["someId"];
		$some_act=$_POST["act"];
		if($someId!=""){
			$shopping_cart_Id_arr=explode(",",$_SESSION["shopping_cart_Id"]);
			$shopping_cart_much_arr=explode(",",$_SESSION["shopping_cart_much"]);
			//print_r($shopping_cart_Id_arr);echo "<br/>";
			for($i=0;$i<count($someId);$i++){
				for($j=0;$j<count($shopping_cart_Id_arr);$j++){
					if(@$someId[$i]==$shopping_cart_Id_arr[$j]){
						unset($shopping_cart_Id_arr[$j]);
						unset($shopping_cart_much_arr[$j]);
					}
				}
				if($some_act!="del"){
					$user=$_SESSION["user"];
					$addtime=date("Y/m/d H:i:s",time());
					$sql="insert into `yg_farite`(`pro_Id`,`userName`,`addtime`) values('".$someId[$i]."','".$user."','".$addtime."')";
					$result=mysql_query($sql);
				}
			}
			$shopping_cart_Id_str=implode(",",$shopping_cart_Id_arr);
			$_SESSION["shopping_cart_Id"]=$shopping_cart_Id_str;
			$shopping_cart_much_str=implode(",",$shopping_cart_much_arr);
			$_SESSION["shopping_cart_much"]=$shopping_cart_much_str;
			//echo "<br/>";
			//print_r($someId);
			//echo "<br/>";
			//print_r($shopping_cart_Id_arr);
			//exit();
			if($some_act=="del"){
				exit("<script>window.location.href='YG_shopping_cart.php';alert('删除成功！')</script>");
			}else if($some_act=="coll"){
				$affet_rows=mysql_affected_rows();//记录受影响行数
				if($affet_rows){
					exit("<script>window.location.href='YG_shopping_cart.php';alert('收藏成功！')</script>");
				}else{
					exit("<script>window.location.href='YG_shopping_cart.php';alert('收藏失败！')</script>");
				}
			}
		}else{
			exit("<script>window.location.href='YG_shopping_cart.php';alert('请勾选你要处理的商品！')</script>");
		}
	}
?>