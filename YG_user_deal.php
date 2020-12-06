<?
	require("Include/mysql_open.php");
	$act=$_GET["act"];
	if($act=="update_info"){//执行修改操作
		$myId=$_POST["myId"];
		$name=$_POST["name"];
		$sex=$_POST["sex"];
		$phone=$_POST["phone"];
		$email=$_POST["email"];
		$head_tx_adminsrc="";
		$head_tx_src="";
		if($name==""){
			$name=$_POST["name_hdn"];
		}
		if($phone==""){
			$phone=$_POST["phone_hdn"];
		}else if(!preg_match("/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/",$phone)){
			exit("<script>window.location.href='YG_user.php';alert('手机号码不正确！');</script>");
		}
		if($email==""){
			$email=$_POST["email_hdn"];
		}else if(!preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/",$email)){
			exit("<script>window.location.href='YG_user.php';alert('邮箱格式不正确！');</script>");
		}
		if($_FILES["txUpload"]["name"]==""){
			$head_tx_adminsrc=$_POST["file_admin_hidden"];
			$head_tx_src=$_POST["file_hidden"];
		}else{
			$refuselExt="|txe|php|asp|exe|bat|html|";//预定义非法后缀文件名
			//print_r($_FILES["txUpload"]);
			$fileExt_arr=explode(".",$_FILES["txUpload"]["name"]);
			$fileExt=$fileExt_arr[count($fileExt_arr)-1];//利用explode分割文件名，取出后文件名后缀
			//echo $fileExt;
			if(strstr($refuselExt,$fileExt)){
				exit("<script>window.href='YG_user_info';alert('不允许上传".$fileExt."类文件');</script>");
			}//校验文件名后缀是否合理！
			$upload_path="../Upload/head_tx/";//创建预存储文件目录
			$upload="Upload/head_tx/";//预定义前台访问目录
			$fileNewname=date("ymdHi_").mt_rand(10000,99999).".".$fileExt;//为文件重命名（防止文件覆盖）
			//echo $_FILES["txUpload"]["error"];
			if(is_uploaded_file($_FILES["txUpload"]["tmp_name"])){//判断文件是否是通过post上传的，防止不合理上传
				if(move_uploaded_file($_FILES["txUpload"]["tmp_name"],$upload.$fileNewname)){//将文件移动到新目录
					
					$photosize=$_FILES["txUpload"]["size"];
					if($photosize > 1024*1024*1){
						exit("<script>window.href='YG_user_info';alert('头像不得大于2M哦！');</script>");
					}else{	
						$head_tx_adminsrc=$upload_path.$fileNewname;
						$head_tx_src=$upload.$fileNewname;
					}
				}else{
					echo "文件上传失败！";
				}
			}else{
				exit("<script>window.href='YG_user_info';alert('拒绝非法插入文件');</script>");
			}
		}
		$sql="update `yg_user` set `name`='".$name."',`sex`='".$sex."',`email`='".$email."',`phone`='".$phone."',`head_tx`='".$head_tx_src."',`head_tx_admin`='".$head_tx_adminsrc."' where Id=".$myId;
		//exit($sql);
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行数
		
		if($result && $affet_rows){
			echo "<script>window.location.href='YG_user.php';alert('修改成功！');</script>";
		}else{
			echo "<script>window.location.href='YG_user.php';alert('修改失败！');</script>";
		}
	
	}else if($act=="update_pwa"){
		$myId=$_POST["myId"];
		$j_password=$_POST["j_password"];
		$x_password=$_POST["x_password"];
		$r_password=$_POST["r_password"];
		$sql_j="select * from `yg_user` where `Id`=".$myId;
		$result_j=mysql_query($sql_j);
		$result_arr_j=mysql_fetch_array($result_j);
		//echo $j_password.$x_password.$r_password.md5($j_password).$result_arr_j["password"];
		if(md5($j_password)!=$result_arr_j["password"]){
			exit("<script>window.location.href='YG_user_info_password.php';alert('您输入的旧密码不正确！');</script>");
		}else if($x_password!=$r_password){
			exit("<script>window.location.href='YG_user_info_password.php';alert('您输入的新密码和重复密码不一致！');</script>");
		}else{
			$sql="update `yg_user` set `password`='".md5($r_password)."' where Id=".$myId;
			//exit($sql);
			$result=mysql_query($sql);
			$affet_rows=mysql_affected_rows();//记录受影响行数
			
			if($result && $affet_rows){
				echo "<script>window.location.href='YG_user.php';alert('修改成功！');</script>";
			}else{
				echo "<script>window.location.href='YG_user_info_password.php';alert('修改失败！');</script>";
			}
		}
	}else if($act=="update_address"){
		$act_ads=$_POST["act"];
		$name=$_POST["name"];
		$s_province=$_POST["s_province"];
		$s_city=$_POST["s_city"];
		$s_county=$_POST["s_county"];
		$address_info=$_POST["address_info"];
		$phonenumber=$_POST["phonenumber"];
		$postcode=$_POST["postcode"];
		$userName=$_SESSION["user"];
		if($act_ads=="update"){
			$myId=$_POST["myId"];
			if(@$_POST["ismoren"]=="1"){
				$sql_r="update `yg_address` set `ismoren`='0' where `user_Name`='".$userName."' ";
				$result_r=mysql_query($sql_r);
				$sql="update `yg_address` set `name`='".$name."',`address_province`='".$s_province."',`address_city`='".$s_city."',`address_county`='".$s_county."',`address_info`='".$address_info."',`phonenumber`='".$phonenumber."',`postcode`='".$postcode."',`ismoren`='1' where Id=".$myId;//echo $sql_r;exit($sql_s);
				$result=mysql_query($sql);
				//exit($sql);
				$affet_rows=mysql_affected_rows();//记录受影响行数
				if($result && $affet_rows && $result_r){
					echo "<script>window.location.href='YG_user_info_address.php';alert('修改成功！');</script>";
				}else{
					echo "<script>window.location.href='YG_user_info_address.php';alert('修改失败！');</script>";
				}
			}else{
				$sql="update `yg_address` set `name`='".$name."',`address_province`='".$s_province."',`address_city`='".$s_city."',`address_county`='".$s_county."',`address_info`='".$address_info."',`phonenumber`='".$phonenumber."',`postcode`='".$postcode."',`ismoren`='0' where Id=".$myId;//exit($sql_r);exit($sql_s);
				//exit($sql);
				$result=mysql_query($sql);
				$affet_rows=mysql_affected_rows();//记录受影响行数
				if($result && $affet_rows){
					echo "<script>window.location.href='YG_user_info_address.php';alert('修改成功！');</script>";
				}else{
					echo "<script>window.location.href='YG_user_info_address.php';alert('修改失败！');</script>";
				}
			}
		}else if($act_ads=="add"){
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
				echo "<script>window.location.href='YG_user_info_address.php';alert('添加成功！');</script>";
			}else{
				echo "<script>window.location.href='YG_user_info_address.php';alert('添加失败！');</script>";
			}
		}
	}else if($act=="del"){
		$Id=$_POST["Id_del"];
		$sql="delete from `yg_address` where `Id`=".$Id;
		//exit($sql);
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行		
		if($result && $affet_rows){
			echo "<script>window.location.href='YG_user_info_address.php';alert('删除成功！');</script>";
		}else{
			echo "<script>window.location.href='YG_user_info_address.php';alert('删除失败！');</script>";
		}		
	}
?>