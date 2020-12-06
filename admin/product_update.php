<?
	require("Include/mysql_open.php");
	require("Include/ck_session.php");
	$Id=@$_GET["Id"];
	if(empty($Id)){
		echo "<script>window.location.href='article_class.php';alert('非法入侵！');</script>";
	}
	//第三步 执行SQL语句
	$sql="select * from `yg_product` where Id=".$Id;
	$result=mysql_query($sql);
	// 第四步 从结果集取出数据 转换为数组
	$result_arr=mysql_fetch_array($result)
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="js/select-ui.min.js"></script>
<link rel="stylesheet" href="kindeditor/themes/default/default.css" />
<script charset="utf-8" src="kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('#content7', {
			allowFileManager : true
		});
	});
	$(document).ready(function(){
		$("#classId").blur(function(){
			$.ajax({
				type:"get",
				url:"ajax_chk_p_c.php",
				data:"Id="+$("#classId").val(),
				success: function(d){
					$("#active_Id").html(d);
				}
			})
		})
        $("#img_math").blur(function(){
		var file=document.getElementById("img_math").files;
		if(file[0].name==""){
			$("#img_math").siblings("i").html("请上传图片！").css("color","rgba(3,255,8,1.00)");
			return false;
		}else if(!/\.(jpg|jpeg|png|JPG|PNG)$/.test(file[0].name)){
			$("#img_math").siblings("i").html("图片格式必须为[jpeg|jpe|png]"+file.name+"其中的一个，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else if(file[0].size > 1024*1024*2){
			$("#img_math").siblings("i").html("图片大小不得超过2M哦，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else{
			$("#img_math").siblings("i").html("图片:"+file[0].name+"上传检测通过！").css("color","rgba(0,255,8,1.00)");
			return true;
		}
	})
	$("#img_show1").blur(function(){
		var file=document.getElementById("img_show1").files;
		if(file[0].name==""){
			$("#img_show1").siblings("i").html("请上传图片！").css("color","rgba(3,255,8,1.00)");
			return false;
		}else if(!/\.(jpg|jpeg|png|JPG|PNG)$/.test(file[0].name)){
			$("#img_show1").siblings("i").html("图片格式必须为[jpeg|jpe|png]"+file.name+"其中的一个，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else if(file[0].size > 1024*1024*2){
			$("#img_show1").siblings("i").html("图片大小不得超过2M哦，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else{
			$("#img_show1").siblings("i").html("图片:"+file[0].name+"上传检测通过！").css("color","rgba(0,255,8,1.00)");
			return true;
		}
	})
	$("#img_show2").blur(function(){
		var file=document.getElementById("img_show2").files;
		if(file[0].name==""){
			$("#img_show2").siblings("i").html("请上传图片！").css("color","rgba(3,255,8,1.00)");
			return false;
		}else if(!/\.(jpg|jpeg|png|JPG|PNG)$/.test(file[0].name)){
			$("#img_show2").siblings("i").html("图片格式必须为[jpeg|jpe|png]"+file.name+"其中的一个，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else if(file[0].size > 1024*1024*2){
			$("#img_show2").siblings("i").html("图片大小不得超过2M哦，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else{
			$("#img_show2").siblings("i").html("图片:"+file[0].name+"上传检测通过！").css("color","rgba(0,255,8,1.00)");
			return true;
		}
	})
	$("#img_show3").blur(function(){
		var file=document.getElementById("img_show3").files;
		if(file[0].name==""){
			$("#img_show3").siblings("i").html("请上传图片！").css("color","rgba(3,255,8,1.00)");
			return false;
		}else if(!/\.(jpg|jpeg|png|JPG|PNG)$/.test(file[0].name)){
			$("#img_show3").siblings("i").html("图片格式必须为[jpeg|jpe|png]"+file.name+"其中的一个，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else if(file[0].size > 1024*1024*2){
			$("#img_show3").siblings("i").html("图片大小不得超过2M哦，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else{
			$("#img_show3").siblings("i").html("图片:"+file[0].name+"上传检测通过！").css("color","rgba(0,255,8,1.00)");
			return true;
		}
	})
	$("#img_show4").blur(function(){
		var file=document.getElementById("img_show4").files;
		if(file[0].name==""){
			$("#img_show4").siblings("i").html("请上传图片！").css("color","rgba(3,255,8,1.00)");
			return false;
		}else if(!/\.(jpg|jpeg|png|JPG|PNG)$/.test(file[0].name)){
			$("#img_show4").siblings("i").html("图片格式必须为[jpeg|jpe|png]"+file.name+"其中的一个，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else if(file[0].size > 1024*1024*2){
			$("#img_show4").siblings("i").html("图片大小不得超过2M哦，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else{
			$("#img_show4").siblings("i").html("图片:"+file[0].name+"上传检测通过！").css("color","rgba(0,255,8,1.00)");
			return true;
		}
	})
	$("#img_show5").blur(function(){
		var file=document.getElementById("img_show5").files;
		if(file[0].name==""){
			$("#img_show5").siblings("i").html("请上传图片！").css("color","rgba(3,255,8,1.00)");
			return false;
		}else if(!/\.(jpg|jpeg|png|JPG|PNG)$/.test(file[0].name)){
			$("#img_show5").siblings("i").html("图片格式必须为[jpeg|jpe|png]"+file.name+"其中的一个，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else if(file[0].size > 1024*1024*2){
			$("#img_show5").siblings("i").html("图片大小不得超过2M哦，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else{
			$("#img_show5").siblings("i").html("图片:"+file[0].name+"上传检测通过！").css("color","rgba(0,255,8,1.00)");
			return true;
		}
	})
    });
	
</script>
<script type="text/javascript">
$(document).ready(function(e) {
    $(".select1").uedSelect({
		width : 345			  
	});
	$(".select2").uedSelect({
		width : 167  
	});
	$(".select3").uedSelect({
		width : 100
	});
});
</script>
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">修改产品信息</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>产品信息</span></div>
    
    
	<ul class="forminfo">
 	<form action="product_deal.php?act=update" method="post" enctype="multipart/form-data">
    <li><label>修改产品名称<b>*</b></label><input name="name" type="text" class="dfinput" value="<? echo $result_arr["name"];?>"  /><input name="myId" type="hidden"  value="<? echo $result_arr["Id"];?>"  /></li> 
    <li>
    <label>修改产品分类<b>*</b></label>
    <div class='vocation'>
    <select name='classId' id='classId' class='select1'>
    	<option value="<? echo $result_arr["classId"]; ?>"><? 
			$sql_p="select * from `yg_product_class` where `id` =".$result_arr["classId"];
			$result_p=mysql_query($sql_p);
			$result_arr_p=mysql_fetch_array($result_p);
			echo $result_arr_p["name"];
			 ?>
            </option>
        <?
			$sql_p="select * from `yg_product_class` where `parentId` <> 0";
			$result_p=mysql_query($sql_p);
			$rows_num_p=mysql_num_rows($result_p);
			while($result_arr_p=mysql_fetch_array($result_p)){
		?>
            <option value="<? echo $result_arr_p["Id"]; ?>"><? echo $result_arr_p["name"]; ?></option>
        <? } ?>
    </select>
    </div><i>请选择产品所属分类</i>
    </li>
    <li><img src="<? echo $result_arr["admin_product_img"];?>" style="width:80px; height:80px; vertical-align:middle;" /></li>
    <li><label>产品主图<b>*</b></label><input name="admin_product_img" type="file" class="dfinput" id="img_math" value=""  /><input type="hidden" value="<? echo $result_arr["admin_product_img"];?>" name="admin_product_img_hidden" /><input type="hidden" value="<? echo $result_arr["product_img"];?>" name="product_img_hidden" /><i>建议上传一张分辨率大于224*224且大小不超过2M的图片，用于主页展示、订单展示</i></li>
    <? 
	$admin_show_img_arr=explode(",",$result_arr["admin_show_img"]);
	$show_img_arr=explode(",",$result_arr["show_img"]);
	//echo $show_img_arr[1].$admin_show_img_arr[1];
	?>
    <li><img src="<? echo $admin_show_img_arr[0];?>" style="width:80px; height:80px; vertical-align:middle;" /></li>
    <li>
    <label>产品展示图<b>*</b></label>
    <input name="admin_show_img[]" type="file" class="dfinput" id="img_show1" value="" />
    <input type="hidden" value="<? echo $admin_show_img_arr[0];?>" name="admin_show_img_arr_hidden[]" />
    <input type="hidden" value="<? echo $show_img_arr[0];?>" name="show_img_arr_hidden[]" />
    <i>建议上传分辨率大于800*800且大小不超过2M的图片，用于产品细节展示</i>
    </li>
    <li><img src="<? echo $admin_show_img_arr[1];?>" style="width:80px; height:80px; vertical-align:middle;" /></li>
    <li>
    <label>产品展示图<b>*</b></label>
    <input name="admin_show_img[]" type="file" class="dfinput" id="img_show2" value="" />
    <input type="hidden" value="<? echo $admin_show_img_arr[1];?>" name="admin_show_img_arr_hidden[]" />
    <input type="hidden" value="<? echo $show_img_arr[1];?>" name="show_img_arr_hidden[]" />
    <i>建议上传分辨率大于800*800且大小不超过2M的图片，用于产品细节展示</i>
    </li>
    <li><img src="<? echo $admin_show_img_arr[2];?>"  style="width:80px; height:80px; vertical-align:middle;"/></li>
    <li>
    <label>产品展示图<b>*</b></label>
    <input name="admin_show_img[]" type="file" class="dfinput" id="img_show3" value="" />
    <input type="hidden" value="<? echo $admin_show_img_arr[2];?>" name="admin_show_img_arr_hidden[]" />
    <input type="hidden" value="<? echo $show_img_arr[2];?>" name="show_img_arr_hidden[]" />
    <i>建议上传分辨率大于800*800且大小不超过2M的图片，用于产品细节展示</i>
    </li>
    <li><img src="<? echo $admin_show_img_arr[3];?>"  style="width:80px; height:80px; vertical-align:middle;"/></li>
    <li>
    <label>产品展示图<b>*</b></label>
    <input name="admin_show_img[]" type="file" class="dfinput" id="img_show4" value="" />
    <input type="hidden" value="<? echo $admin_show_img_arr[3];?>" name="admin_show_img_arr_hidden[]" />
    <input type="hidden" value="<? echo $show_img_arr[3];?>" name="show_img_arr_hidden[]" />
    <i>建议上传分辨率大于800*800且大小不超过2M的图片，用于产品细节展示</i>
    </li>
    <li><img src="<? echo $admin_show_img_arr[4];?>"  style="width:80px; height:80px; vertical-align:middle;"/></li>
    <li>
    <label>产品展示图<b>*</b></label>
    <input name="admin_show_img[]" type="file" class="dfinput" id="img_show5" value="" />
    <input type="hidden" value="<? echo $admin_show_img_arr[4];?>" name="admin_show_img_arr_hidden[]" />
    <input type="hidden" value="<? echo $show_img_arr[4];?>" name="show_img_arr_hidden[]" />
    <i>建议上传分辨率大于800*800且大小不超过2M的图片，用于产品细节展示</i>
    </li>
    <li>
    <label>市场价<b>*</b></label><input name="machete_price" type="text" class="dfinput" value="<? echo $result_arr["machete_price"]; ?>" /><i id="chk_box"></i></li>
    <li><label>优购价<b>*</b></label><input name="yg_price" type="text" class="dfinput" value="<? echo $result_arr["yg_price"]; ?>" /><i id="chk_box">请输入你的产品优购价</i></li>
    <li><label>库存<b>*</b></label><input name="stock" type="text" class="dfinput" value="<? echo $result_arr["stock"]; ?>" /><i id="chk_box">请输入你的产品库存</i></li>
    <li>
        <label>参加活动<b>*</b></label>
        <div class="vocation">
    	<select name="active_Id" id="active_Id" class="select1">
        <option value="<? echo $result_arr["active_Id"];?>"><? 
			$sql_s="select * from `yg_product_class` as a join `yg_active` as b on a.`parentId`=b.`act_classId` where  a.`Id`=".$result_arr["classId"];
			//exit($sql_s);
			$result_s=mysql_query($sql_s);
			$affected_rows_s=mysql_affected_rows();
			if(!$affected_rows_s){
				echo "未选择任何活动";
			}
			$result_arr_s=mysql_fetch_array($result_s);
			if($result_arr_s["act_classId"]!=0){
				echo "热卖——".$result_arr_s["act_name"];
			}else{
				echo $result_arr_s["act_name"];
			}
			?></option>
    	<option value="">选此项不参加任何活动</option>
        <? 
			$sql_sm="select * from `yg_active` where `act_classId`=0 ";
			$result_sm=mysql_query($sql_sm);
			while($result_arr_sm=mysql_fetch_array($result_sm)){
		?>
            <option value='<? echo $result_arr_sm['Id']?>'><?
			 if($result_arr_sm["act_classId"]!=0){
				echo "热卖——".$result_arr_sm["act_name"];
			}else{
				echo $result_arr_sm["act_name"];
			} ?></option>";
         <?  } ?>
         <?
		 	$sql_s="select * from `yg_product_class` as a join `yg_active` as b on a.`parentId`=b.`act_classId` where  a.`Id`=".$result_arr["classId"];
			//exit($sql_s);
			$result_s=mysql_query($sql_s);
			$affected_rows_s=mysql_affected_rows(); 
			while($result_arr_s=mysql_fetch_array($result_s)){
			?>
    		<option value='<? echo $result_arr_s['Id']?>'>热卖——<? echo $result_arr_s['act_name']?></option>
         <?  } ?>
        </select>
    	</div>
    	<i>请选择产品参与活动</i> 
    </li>
    <li><label>是否热销<b>*</b></label>
    <? if($result_arr["ishot"]=="1"){ ?>
    <input name="ishot" type="radio" value="1"  checked="checked"/> 是
    <input name="ishot" type="radio"  value="0"  /> 否
    <? }else{?>
    <input name="ishot" type="radio" value="1" /> 是
    <input name="ishot" type="radio"  value="0"   checked="checked"/> 否
    <? }?>
    </li> 
    <li><label>是否上架<b>*</b></label>
	<? if($result_arr["isput_on"]=="1"){ ?>
    <input name="isput_on" type="radio" value="1"  checked="checked"/> 是
    <input name="isput_on" type="radio"  value="0"  /> 否
    <? }else{?>
     <input name="isput_on" type="radio" value="1" /> 是
    <input name="isput_on" type="radio"  value="0"  checked="checked"/> 否
    <? }?>
    </li>
   <li><label>产品详情描述<b>*</b></label><textarea id="content7" name="description" style="width:700px;height:250px;visibility:hidden;"><? echo $result_arr["description"];?></textarea></li>   

    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存"/></li>
    </form>
    </ul>    

 

</body>

</html>
