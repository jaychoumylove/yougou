<?
	require("Include/mysql_open.php");
	require("Include/ck_session.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/select.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script> 
<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="js/select-ui.min.js"></script>
<script type="text/javascript" src="editor/kindeditor.js"></script>


<script type="text/javascript">
$(document).ready(function(){
	$("#Id").blur(function(){
		$.ajax({
			type:"get",
			url:"ajax_chk_p_c.php",
			data:"Id="+$("#Id").val(),
			success: function(d){
				$("#active_Id").html(d);
			}
		})
	})
	//以下注释的是上传多张图片的js代码
	/*$("#img_show").blur(function(){*/
		/*$.ajax({
			type:"get",
			url:"ajax_chk_img.php",
			data:"img_show="+$("#img_show").val(),
			success: function(d){
				$("#img_show").siblings("i").html(d);
			}
		})*/
		/*var files=document.getElementById("img_show").files;
		if(files.length>5){
			$("#img_show").siblings("i").html("上传的图片超过了五个了哦，筛选出五个吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else{
			var filesNames="|";
			var filesNames_size="";
			var filesNames_type="";
			for( var n=0;n<files.length;n++){
				if(files[n].name==""){
					filesNames="";
				}else if(!/\.(jpg|jpeg|png|JPG|PNG)$/.test(files[n].name)) {
					filesNames_type=filesNames_type+files[n].name+"|";
				}else if(files[n].size > 1024*1024*2){
					filesNames_size=filesNames_size+files[n].name+"|";
				}else{
					filesNames=filesNames+files[n].name+"|";
				}
			}
			if(filesNames==""){
				$("#img_show").siblings("i").html("请上传图片！").css("color","rgba(255,3,8,1.00)");
				return false;
			}else if(filesNames_type!=""){
				$("#img_show").siblings("i").html("名为"+filesNames_type+"的图片格式必须为[jpeg|jpe|png]其中的一个，换一换吧！").css("color","rgba(255,3,8,1.00)");
				return false;
			}else if(filesNames_size!=""){
				$("#img_show").siblings("i").html("名为"+filesNames_size+"的图片大于2M哦，换一换吧！").css("color","rgba(255,3,8,1.00)");
				return false;
			}else{
				$("#img_show").siblings("i").html("上传了这些图："+filesNames).css("color","rgba(3,255,8,1.00)");
				return true;
			}
		}
	})*/
	$("#img_math").blur(function(){
		var file=document.getElementById("img_math").files;
		if(file[0].name==""){
			$("#img_math").siblings("i").html("请上传图片！").css("color","rgba(3,255,8,1.00)");
			return false;
		}else if(!/\.(jpg|jpeg|png|JPG|PNG)$/.test(file[0].name)){
			$("#img_math").siblings("i").html("图片格式必须为[jpeg|jpe|png]"+file.name+"其中的一个，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else if(file[0].size > 1024*1024){
			$("#img_math").siblings("i").html("图片大小不得超过2M哦，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else{
			$("#img_math").siblings("i").html("图片:"+file[0].name+"上传检测通过！").css("color","rgba(0,255,8,1.00)");
			return true;
		}
	})
	/**/for(var j=1;j<6;j++){
		$("#img_show"+j).blur(function(){
			var file=document.getElementById("img_show"+j).files;
			if(file[0].name==""){
				$("#img_show"+j).siblings("i").html("请上传图片！").css("color","rgba(3,255,8,1.00)");
				return false;
			}else if(!/\.(jpg|jpeg|png|JPG|PNG)$/.test(file[0].name)){
				$("#img_show"+j).siblings("i").html("图片格式必须为[jpeg|jpe|png]"+file.name+"其中的一个，换一换吧！").css("color","rgba(255,3,8,1.00)");
				return false;
			}else if(file[0].size > 1024*1024){
				$("#img_show"+j).siblings("i").html("图片大小不得超过2M哦，换一换吧！").css("color","rgba(255,3,8,1.00)");
				return false;
			}else{
				$("#img_show"+j).siblings("i").html("图片:"+file[0].name+"上传检测通过！").css("color","rgba(0,255,8,1.00)");
				return true;
			}
		})
	}
	/*$("#img_show1").blur(function(){
		var file=document.getElementById("img_show1").files;
		if(file[0].name==""){
			$("#img_show1").siblings("i").html("请上传图片！").css("color","rgba(3,255,8,1.00)");
			return false;
		}else if(!/\.(jpg|jpeg|png|JPG|PNG)$/.test(file[0].name)){
			$("#img_show1").siblings("i").html("图片格式必须为[jpeg|jpe|png]"+file.name+"其中的一个，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else if(file[0].size > 1024*1024){
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
		}else if(file[0].size > 1024*1024){
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
		}else if(file[0].size > 1024*1024){
			$("#img_show3").siblings("i").html("图片大小不得超过2M哦，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else{
			$("#img_show3").siblings("i").html("图片:"+file[0].name+"上传检测通过！").css("color","rgba(0,255,8,1.00)");
			return true;
		}
	})
	$("#img_show4").blur(function(){
		var file=document.getElementById("img_math").files;
		if(file[0].name==""){
			$("#img_show4").siblings("i").html("请上传图片！").css("color","rgba(3,255,8,1.00)");
			return false;
		}else if(!/\.(jpg|jpeg|png|JPG|PNG)$/.test(file[0].name)){
			$("#img_show4").siblings("i").html("图片格式必须为[jpeg|jpe|png]"+file.name+"其中的一个，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else if(file[0].size > 1024*1024){
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
		}else if(file[0].size > 1024*1024){
			$("#img_show5").siblings("i").html("图片大小不得超过2M哦，换一换吧！").css("color","rgba(255,3,8,1.00)");
			return false;
		}else{
			$("#img_show5").siblings("i").html("图片:"+file[0].name+"上传检测通过！").css("color","rgba(0,255,8,1.00)");
			return true;
		}
	})*/
  $(".click").click(function(){
  $(".tip").fadeIn(200);
  });
  
  $(".tiptop a").click(function(){
  $(".tip").fadeOut(200);
});

  $(".sure").click(function(){
  $(".tip").fadeOut(100);
});

  $(".cancel").click(function(){
  $(".tip").fadeOut(100);
});

});
</script>
<link rel="stylesheet" href="kindeditor/themes/default/default.css" />
<script charset="utf-8" src="kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript">
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('#content6', {
			allowFileManager : true
		});
	});
</script>
<script type="text/javascript">
    KE.show({
        id : 'content7',
        cssPath : './index.css'
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
<script type="text/javascript">
$(document).ready(function() {

	$("#checkAll").click(function(){
		
		if(this.checked){
			$(".checkbox_Id").prop("checked",true);
		}else{
			$(".checkbox_Id").prop("checked",false);
		}
		
	});	
	
});
</script>

</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">产品管理</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    
    <div id="usual1" class="usual"> 
    
    <div class="itab">
  	<ul> 
    <li><a href="#tab1">添加产品</a></li> 
    <li><a href="#tab2" class="selected">产品管理</a></li> 
  	</ul>
    </div> 
    
  	<div id="tab1" class="tabson">    
    <ul class="forminfo">
 	<form action="product_deal.php?act=add" method="post"  enctype="multipart/form-data">
    <li><label>产品名称<b>*</b></label><input id="chkbox" name="name" type="text" class="dfinput" value=""  /><i id="chk_box">请输入你要添加的产品名称。</i></li>
    <li>
    <label>所属分类：<b>*</b></label>
    <div class="vocation">
    <select name="Id" id="Id" class="select1">
    	<option value="*">请选择：</option>
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
    <li><label>产品主图<b>*</b></label><input name="img_math" type="file" class="dfinput" id="img_math" value=""  /><i>建议上传一张分辨率大于224*224且大小不超过1M的图片，用于主页展示、订单展示</i></li>
    <li><label>产品展示图<b>*</b></label><input name="img_show[]" type="file" class="dfinput" id="img_show1" value="" /><i>建议上传分辨率大于800*800且大小不超过1M的图片，用于产品细节展示</i></li>
    <li><label>产品展示图<b>*</b></label><input name="img_show[]" type="file" class="dfinput" id="img_show2" value="" /><i>建议上传分辨率大于800*800且大小不超过1M的图片，用于产品细节展示</i></li>
    <li><label>产品展示图<b>*</b></label><input name="img_show[]" type="file" class="dfinput" id="img_show3" value="" /><i>建议上传分辨率大于800*800且大小不超过1M的图片，用于产品细节展示</i></li>
    <li><label>产品展示图<b>*</b></label><input name="img_show[]" type="file" class="dfinput" id="img_show4" value="" /><i>建议上传分辨率大于800*800且大小不超过1M的图片，用于产品细节展示</i></li>
    <li><label>产品展示图<b>*</b></label><input name="img_show[]" type="file" class="dfinput" id="img_show5" value="" /><i>建议上传分辨率大于800*800且大小不超过1M的图片，用于产品细节展示</i></li>
    <li><label>库存<b>*</b></label><input id="chkbox" name="stock" type="text" class="dfinput" value=""  /><i id="chk_box">请输入你的产品库存。</i></li>
    <li><label>市场价<b>*</b></label><input id="chkbox" name="machete_price" type="text" class="dfinput" value=""  /><i id="chk_box">请输入你的产品市场价</i></li>
    <li><label>优购价<b>*</b></label><input id="chkbox" name="yg_price" type="text" class="dfinput" value=""  /><i id="chk_box">请输入你的产品优购价</i></li>
    <li><label>是否热销<b>*</b></label>
    <input name="ishot" type="radio" value="1"  checked="checked"/> 是
    <input name="ishot" type="radio"  value="0"  /> 否
    </li> 
    <li><label>是否上架<b>*</b></label>
    <input name="isput_on" type="radio" value="1"  checked="checked"/> 是
    <input name="isput_on" type="radio"  value="0"  /> 否
    </li>
    <li>
        <label>参加活动：<b>*</b></label>
        <div class="vocation">
    	<select name="active_Id" id="active_Id" class="select1">
        
    	<option value="">选此项不参加任何活动</option>
        <? 
			$sql_sm="select * from `yg_product` where `classId`=0 ";
			$result_sm=mysql_query($sql_sm);
			while($result_arr_sm=mysql_fetch_array($result_sm)){
		?>
            <option value='<? echo $result_arr_sm['Id']?>'><? echo $result_arr_sm['name'] ?></option>";
         <?  } ?>
        </select>
    	</div>
    	<i>请选择产品参与活动</i> 
    </li>
    </li>
    <li><label>产品详情描述<b>*</b></label><textarea id="content6" name="description" style="width:700px;height:250px;visibility:hidden;"></textarea></li>
    
    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认添加"/></li>
    </form>
    </ul>  
    
    </div> 
    
    
  	<div id="tab2" class="tabson">
    <form action="product.php?act=search" method="post">
    <ul class="seachform">
    <li><label>产品类别</label>  
    <div class="vocation">
    <select class="select3" name="classId">
        <option value="0">全部产品</option>
        <?
			$sql_a_d="select * from `yg_product_class` where `parentId`=0;"; 
			$result_a_d=mysql_query($sql_a_d);
			while($result_arr_a_d=mysql_fetch_array($result_a_d)){
		?>
        <option value="<? echo $result_arr_a_d["Id"]?>"><? echo $result_arr_a_d["name"]?></option>
        	<?
				$sql_a_dd="select * from `yg_product_class` where `parentId` =".$result_arr_a_d["Id"]; 
				$result_a_dd=mysql_query($sql_a_dd);
				while($result_arr_a_dd=mysql_fetch_array($result_a_dd)){
			?>
			<option value="<? echo $result_arr_a_dd["Id"]?>">——<? echo $result_arr_a_dd["name"]?></option>
				
			<? } ?>
        <? } ?>
    </select>
    </div>
    </li>   
  
	<li><label>产品名称</label><input name="name" type="text" class="scinput" /></li>
    <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询"/></li>
  
    </ul>
    </form>

  <form action="product_deal.php?act=delAll" method="post">  
    <table class="tablelist">
    	<thead>
    	<tr>
        <th width="14%" height="77"><input name="checkAll" id="checkAll" type="checkbox" value=""/></th>
        <th width="26%">产品名称<i class="sort"><img src="images/px.gif" /></i></th>
        <th width="9%">优购价</th>
        <th width="9%">是否热销</th>
        <th width="9%">是否上架</th>
        <th width="13%">参与活动</th>
        <th width="11%">销量</th>
        <th width="9%">操作</th>
        </tr>
        </thead>
        <tbody>
        <?
			$act=@$_GET["act"];					
			if($act=="search"){
				
				$classId=@$_POST["classId"];
				if(empty($classId)){
					$classId=@urldecode($_GET["classId"]);
				}
				
				$name=@$_POST["name"];
				if(empty($name)){
					$name=@urldecode($_GET["name"]);
				}	
				
				$sql_m="select * from `yg_product` where 1=1 ";
				if($classId!=""){
					$sql_m.= "and `classId` =  '".$classId."' ";
				}else{
					$sql_m.=" ";
				}
				if($name!=""){
					$sql_m.= "and (name like '%".$name."%') ";
				}
				$sql_m.="order by Id desc";
				//exit($sql);
			}else{
				$sql_m="select * from `yg_product` order by Id desc";
			}		
			$result=mysql_query($sql_m);
			$rows_num=mysql_num_rows($result);//显示出结果集 的记录数
			
			$pagesize=5;//每一页有5条记录
			
			$page_all=ceil($rows_num/$pagesize);//这里是进一法
			
			$page_now=@ceil($_GET["page_now"]==""?1:$_GET["page_now"]);//当前页码
			
			$offset=($page_now-1)*$pagesize;//根据当前的页码 计算出偏移量
		
        	//第三步 执行SQL语句
			
			if($act=="search"){
				$classId=@$_POST["classId"];
				if(empty($classId)){
					$classId=@urldecode($_GET["classId"]);
					                               
				}
				$name=@$_POST["name"];
				if(empty($name)){
					$name=@urldecode($_GET["name"]);
				}	
				$sql="select * from `yg_product` where 1=1 ";
				if($classId!=""){
					$sql.= "and `classId` = '".$classId."' ";
				}else{
					$sql.=" ";
				}
				if($name!=""){
					$sql.= "and (name like '%".$name."%') ";
				}
				$sql.="order by Id desc limit ".$offset.",".$pagesize;
				//exit($sql);
			}else{
				$sql="select * from `yg_product`  order by Id desc limit ".$offset.",".$pagesize;
			}	
				
			$result=mysql_query($sql);
			while($result_arr=mysql_fetch_array($result)){
		?>
        <tr>
        <td width="14%" style="text-align:center;"><input style="margin-right:10px;" name="checkbox_Id[]" type="checkbox" value="<? echo $result_arr["Id"];?>"  class="checkbox_Id"/>
          <img src="<? echo $result_arr["admin_product_img"];?>" style="height:80px; width:80px; vertical-align:middle; margin:10px;"/></td>
        <td width="26%"><? echo $result_arr["name"];?><br/><br/>
        	<?
				$sql_p_c="select * from `yg_product_class` where Id=".$result_arr["classId"];
				$result_p_c=mysql_query($sql_p_c);
				$result_arr_p_c=mysql_fetch_array($result_p_c);
				echo $result_arr_p_c["name"];
			?>
        </td>
        <td width="9%"><? echo $result_arr["yg_price"];?></td>
        <td width="9%"><? if($result_arr["ishot"]=="1"){
			echo "是";
		}else{
			echo "否";
		} ;?></td>
        <td width="9%"><? if($result_arr["isput_on"]=="1"){
			echo "是";
		}else{
			echo "否";
		} ;?></td>
        <td width="13%"><?
			$sql_at="select * from `yg_active` where Id=".$result_arr["active_Id"];
			$result_at=mysql_query($sql_at);
			$result_arr_at=mysql_fetch_array($result_at);
			if($result_arr_at["act_classId"]==0){
				echo $result_arr_at["act_name"];
			}else{
				echo "热卖——".$result_arr_at["act_name"];
			}
		?></td>
        <td width="11%"><? echo $result_arr["sales_vol"];?></td>
        <td width="9%"><a href="product_update.php?Id=<? echo $result_arr["Id"];?>" class="tablelink">查看/修改</a><a href="product_deal.php?Id=<? echo $result_arr["Id"];?>&act=del" class="tablelink">删除</a></td>
        </tr> 
       <? }?>
       
       <tr>
        <td colspan="2"><a class="tablelink click">删除全部</a></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>&nbsp;</td>
        <td width="9%">&nbsp;</td>
        </tr> 
        </tbody>
    </table>
    <div class="pagin">
    	<div class="message">共<i class="blue"><? echo $rows_num;?></i>条记录，当前显示第&nbsp;<i class="blue"><? echo $page_now;?>&nbsp;</i>页，总共&nbsp;<i class="blue"><? echo $page_all;?>&nbsp;</i>页   &nbsp;&nbsp;&nbsp; 
        
        	<?
				$m="";
				if(@$classId!="" || @$name!=""){
					$m.="&act=search";
				}
				if(@$classId!=""){
					$m.="&classId=".urlencode($classId);
				}
				if(@$name!=""){
					$m.="&name=".$name;
				}           
			 ?>
        
        
            <? if($page_now==1){ ?>   
                <b>首页</b>
                <b>上一页</b> 
            <? }else{?>
                <b><a href="product.php?page_now=1<? echo $m;?>" class="blue">首页</a></b> 
                <b><a href="product.php?page_now=<? echo $page_now-1 ;?><? echo $m;?>" class="blue">上一页</a></b>
            <? }?>
             
             <? if($page_now==$page_all){ ?>  
                <b>下一页</b> 
            	<b>尾页</b>           
             <? }else{?>
            	<b><a href="product.php?page_now=<? echo $page_now+1 ;?><? echo $m;?>" class="blue">下一页</a></b> 
            	<b><a href="product.php?page_now=<? echo $page_all;?><? echo $m;?>" class="blue">尾页</a></b>  
              <? }?>     
       </div>
        
    </div>
  
  	<div class="tip">
     <div class="tiptop"><span>提示信息</span><a></a></div>
        
      <div class="tipinfo">
        <span><img src="images/ticon.png" /></span>
        <div class="tipright">
        <p>是否确认对信息的删除？</p>
        <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
        </div>
        </div>
        
        <div class="tipbtn">
        <input name="" type="submit"  class="sure" value="确定" />&nbsp;
        <input name="" type="button"  class="cancel" value="取消" />
        </div>
    
    </div> 
    
	</form>
    
    </div>  
       
	</div> 
 
	<script type="text/javascript"> 
      $("#usual1 ul").idTabs(); 
    </script>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>

    </div>


</body>

</html>
