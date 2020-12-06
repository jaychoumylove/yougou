<?
	require("Include/mysql_open.php");
	$act=$_GET["act"];
	
	if($act=="update"){//执行修改操作
		$myId=$_POST["myId"];
		$name=$_POST["name"];
		$classId=$_POST["classId"];
		$refuselExt="|txe|php|asp|exe|bat|html|";//预定义非法后缀文件名
		$upload_path="../Upload/";//创建预存储文件目录
		$upload="Upload/";//预定义前台访问目录
		$upload_path_adminshow="../Upload/show/";
		$upload_show="Upload/show/";
		$show_img=array();//预创建数组
		$admin_show_img=array();//预创建数组
		$admin_product_img="";
		$product_img="";
		//echo $_FILES['admin_product_img']['name'];
		//print_r($_FILES['admin_product_img']['name']);
		//exit();
		$sql_un='select * from `yg_product` where `Id`='.$myId;
		$result_un=mysql_query($sql_un);
		$result_arr_un=mysql_fetch_array($result_un);
		$admin_show_img_arr_un=explode(",",$result_arr_un["admin_show_img"]);
		if($_FILES["admin_product_img"]["name"]==""){
			$admin_product_img=$_POST["admin_product_img_hidden"];
			$product_img=$_POST["product_img_hidden"];
		}else{
			if(unlink($result_arr_un['admin_product_img'])){
				$fileExt_arr=explode(".",$_FILES["admin_product_img"]["name"]);
				$fileExt=$fileExt_arr[count($fileExt_arr)-1];//利用explode分割文件名，取出后文件名后缀
				//echo $fileExt;
				if(strstr($refuselExt,$fileExt)){
					exit("<script>window.href='product.php';alert('不允许上传".$fileExt."类文件');</script>");
				}//校验文件名后缀是否合理！
				$fileNewname=date("ymdHi_").mt_rand(10000,99999).".".$fileExt;//为文件重命名（防止文件覆盖）
				//echo $_FILES["img_math"]["error"];
				if(is_uploaded_file($_FILES["admin_product_img"]["tmp_name"])){//判断文件是否是通过post上传的，防止不合理上传
					if(move_uploaded_file($_FILES["admin_product_img"]["tmp_name"],$upload_path.$fileNewname)){//将文件移动到新目录
						$product_img_size=$_FILES["admin_product_img"]["size"];//大小
						if($product_img_size> 1024*1024*2){
							exit("<script>window.href='product.php';alert('上传文件大于2M');</script>");
						}else{
							$admin_product_img=$upload_path.$fileNewname;//后台访问地址
							$product_img=$upload.$fileNewname;//前台访问地址
						}
					}else{
						echo "文件上传失败！";
					}
				}else{
					exit("<script>window.href='product.php';alert('拒绝非法插入文件');</script>");
				}
			}else{
				exit("<script>window.href='product.php';alert('文件删除失败');</script>");
			}
		}
		for($i=0;$i<=4;$i++){
			$admin_show_img[$i]="";
			$show_img[$i]="";
			//echo $i;
			if($_FILES["admin_show_img"]["name"][$i]==""){
				$admin_show_img[$i]=$_POST["admin_show_img_arr_hidden"][$i];
				$show_img[$i]=$_POST["show_img_arr_hidden"][$i];
				array_push($admin_show_img,$admin_show_img[$i]);//把数据添加至数组里面
				array_push($show_img,$show_img[$i]);//把数据添加至数组里面
			}else{
				if(unlink($admin_show_img_arr_un[$i])){
					$filesExt_arr=explode(".",$_FILES["admin_show_img"]["name"][$i]);
					//print_r($_FILES["admin_show_img"]["name"]);
					//print_r($filesExt_arr);
					$filesExt=$filesExt_arr[count($filesExt_arr)-1];//利用explode分割文件名，取出后文件名后缀
					//print_r($_FILES["admin_show_img"]["name"][$i]);
					if(strstr($refuselExt,$filesExt)){
						exit("<script>window.href='product.php';alert('不允许上传".$filesExt."类文件');</script>");
					}
					$filesNewname=date("ymdHi_").mt_rand(10000,99999).".".$filesExt;//为文件重命名（防止文件覆盖）
					if(is_uploaded_file($_FILES["admin_show_img"]["tmp_name"][$i])){//判断文件是否是通过post上传的，防止不合理上传
						if(move_uploaded_file($_FILES["admin_show_img"]["tmp_name"][$i],$upload_path_adminshow.$filesNewname)){//将文件移动到新目录
							$show_img_size=$_FILES["admin_product_img"]["size"];//大小
							if($show_img_size > 1024*1024*2){
								exit("<script>window.href='product.php';alert('上传文件大于2M');</script>");
							}else{
								$admin_show_img[$i]=$upload_path_adminshow.$filesNewname;//后台访问地址
								$show_img[$i]=$upload_show.$filesNewname;//前台访问地址
								array_push($admin_show_img,$admin_show_img[$i]);//把数据添加至数组里面
								array_push($show_img,$show_img[$i]);//把数据添加至数组里面
							}
						}else{
							echo "文件上传失败！";
						}
					}else{
						exit("<script>window.href='product.php';alert('拒绝非法插入文件');</script>");
					}
				}else{
					exit("<script>window.href='product.php';alert('文件删除失败');</script>");
				}
			}	
			//echo $_FILES["admin_show_img"]["name"][$i];
		}
		$show_img_str=implode(",",$show_img);
		$admin_show_img_str=implode(",",$admin_show_img);
		//echo $show_img_str.$admin_show_img_str;
		$stock=$_POST["stock"];
		$machete_price=$_POST["machete_price"];
		$yg_price=$_POST["yg_price"];
		$ishot=$_POST["ishot"];
		$isput_on=$_POST["isput_on"];
		$active_Id=$_POST["active_Id"];
		$description=$_POST["description"];
		$sql="update `yg_product` set `name`='".$name."',`classId`='".$classId."',`show_img`='".$show_img_str."',`admin_show_img`='".$admin_show_img_str."',`admin_product_img`='".$admin_product_img."',`product_img`='".$product_img."',`stock`='".$stock."',`machete_price`='".$machete_price."',`yg_price`='".$yg_price."',`ishot`='".$ishot."',`isput_on`='".$isput_on."',`active_Id`='".$active_Id."', `description`='".$description."' where Id=".$myId;
		//exit($sql);
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行数
		if($result && $affet_rows){
			echo "<script>window.location.href='product.php';alert('修改成功！');</script>";
		}else{
			echo "<script>window.location.href='product.php';alert('修改失败！');</script>";
		}
	}else if($act=="add"){//执行添加操作
		$classId=$_POST["Id"];
		$name=$_POST["name"];
		$refuselExt="|txe|php|asp|exe|bat|html|";//预定义非法后缀文件名
		//print_r($_FILES["img_math"]);
		$fileExt_arr=explode(".",$_FILES["img_math"]["name"]);
		//print_r($_FILES["img_show"]["name"]);
		$upload_path="../Upload/";//创建预存储文件目录
		$upload="Upload/";//预定义前台访问目录
		$upload_path_adminshow="../Upload/show/";
		$upload_show="Upload/show/";
		$show_img=array();//预创建数组
		$admin_show_img=array();//预创建数组
		for($i=0;$i<5;$i++){
			$filesExt_arr=explode(".",$_FILES["img_show"]["name"][$i]);
			$filesExt=$filesExt_arr[count($filesExt_arr)-1];
			//echo $filesExt;
			if(strstr($refuselExt,$filesExt)){
				exit("<script>window.href='product.php';alert('不允许上传".$filesExt."类文件');</script>");
			}
			$filesNewname[$i]=date("ymdHi_").mt_rand(10000,99999).".".$filesExt;//为文件重命名（防止文件覆盖）
			if(is_uploaded_file($_FILES["img_show"]["tmp_name"][$i])){//判断文件是否是通过post上传的，防止不合理上传
			if(move_uploaded_file($_FILES["img_show"]["tmp_name"][$i],$upload_path_adminshow.$filesNewname[$i])){//将文件移动到新目录
					
					$show_img_max_size[$i]=$_FILES["img_show"]["size"][$i];////大小
					//echo $show_img_max[$i].$admin_show_img_max[$i];
					if($show_img_max_size[$i] > 1024*1024*2 ){
						exit("<script>window.href='product.php';alert('上传文件大于2M');</script>");
					}else{
						$admin_show_img_max[$i]=$upload_path_adminshow.$filesNewname[$i];//后台访问地址
						array_push($admin_show_img,$admin_show_img_max[$i]);//把数据添加至数组里面
						$show_img_max[$i]=$upload_show.$filesNewname[$i];//前台访问地址
						array_push($show_img,$show_img_max[$i]);//把数据添加至数组里面
					}
				}else{
					echo "文件上传失败！";
				}
			}else{
				exit("<script>window.href='product.php';alert('拒绝非法插入文件');</script>");
			}
		}
		//echo $show_img.$admin_show_img;
		$show_img_str=implode(",",$show_img);
		$admin_show_img_str=implode(",",$admin_show_img);
		$fileExt=$fileExt_arr[count($fileExt_arr)-1];//利用explode分割文件名，取出后文件名后缀
		//echo $fileExt;
		if(strstr($refuselExt,$fileExt)){
			exit("<script>window.href='product.php';alert('不允许上传".$fileExt."类文件');</script>");
		}//校验文件名后缀是否合理！
		$fileNewname=date("ymdHi_").mt_rand(10000,99999).".".$fileExt;//为文件重命名（防止文件覆盖）
		//echo $_FILES["img_math"]["error"];
		if(is_uploaded_file($_FILES["img_math"]["tmp_name"])){//判断文件是否是通过post上传的，防止不合理上传
			if(move_uploaded_file($_FILES["img_math"]["tmp_name"],$upload_path.$fileNewname)){//将文件移动到新目录
				$admin_product_img=$upload_path.$fileNewname;//后台访问地址
				$product_img=$upload.$fileNewname;//前台访问地址
				$product_img_size=$_FILES["img_math"]["size"];//大小
				if($product_img_size> 1024*1024*2){
					exit("<script>window.href='product.php';alert('上传文件大于2M');</script>");
				}
			}else{
				echo "文件上传失败！";
			}
		}else{
			exit("<script>window.href='product.php';alert('拒绝非法插入文件');</script>");
		}
		$stock=$_POST["stock"];
		$machete_price=$_POST["machete_price"];
		$yg_price=$_POST["yg_price"];
		$ishot=$_POST["ishot"];
		$isput_on=$_POST["isput_on"];
		$active_Id=$_POST["active_Id"];//还未获取参与活动id
		$description=$_POST["description"];
		$date=date("Y-m-d H:i:s",time());
		$sql="insert into yg_product (classId,name,stock,machete_price,admin_product_img,product_img,admin_show_img,show_img,yg_price,ishot,isput_on,active_Id,description,sales_vol,addtime) values('".$classId."','".$name."','".$stock."','".$machete_price."','".$admin_product_img."','".$product_img."','".$admin_show_img_str."','".$show_img_str."','".$yg_price."','".$ishot."','".$isput_on."','".$active_Id."','".$description."','0','".$date."')";
		//exit($sql);
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行数
		
		if($result && $affet_rows){
			echo "<script>window.location.href='product.php';alert('添加成功！');</script>";
		}else{
			echo "<script>window.location.href='product.php';alert('添加失败！');</script>";
		}
	}elseif($act=="del"){//执行删除
		$Id=$_GET["Id"];
		$sql="delete from `yg_product` where `Id`=".$Id;
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行		
		if($result && $affet_rows){
			echo "<script>window.location.href='product.php';alert('删除成功！');</script>";
		}else{
			echo "<script>window.location.href='product.php';alert('删除失败！');</script>";
		}		
	}elseif($act=="delAll"){
		$checkbox_Id=$_POST["checkbox_Id"];//获取被选中复选框的值
		 
		$Id_str=implode(",",$checkbox_Id);//把集合按照逗号 合并成字符串
		
		$sql="delete from `yg_product` where Id in (".$Id_str.")";
		$result=mysql_query($sql);
		$affet_rows=mysql_affected_rows();//记录受影响行		
		if($result && $affet_rows){
			echo "<script>window.location.href='product.php';alert('删除成功！');</script>";
		}else{
			echo "<script>window.location.href='product.php';alert('删除失败！');</script>";
		}				
		
	}

?>