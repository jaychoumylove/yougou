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
	$("#chkbox").blur(function(){
		$.ajax({
			type:"get",
			url:"ajax_chk.php",
			data:"name="+$("#chkbox").val(),
			success: function(d){
				$("#chk_box").html(d);
			}
		})
	})
	
});
</script>

</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">产品类别管理</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    
    <div id="usual1" class="usual"> 
    
    <div class="itab">
  	<ul> 
    <li><a href="#tab1">添加产品类别</a></li> 
    <li><a href="#tab2" class="selected">类别管理</a></li> 
  	</ul>
    </div> 
   
  	<div id="tab1" class="tabson">    
    <ul class="forminfo">
 	<form action="product_class_deal.php?act=add" method="post">
    <li>
    <label>选择产品分类：<b>*</b></label>
    <div class="vocation">
    <select name="parentId" class="select1">
 	<option value="0">一级分类</option>
    <?
		$sql_p="select * from `yg_product_class` where `parentId`=0";
		$result_p=mysql_query($sql_p);
		$rows_num_p=mysql_num_rows($result_p);
		while($result_arr_p=mysql_fetch_array($result_p)){
	?>
    	<option value="<? echo $result_arr_p["Id"]; ?>"><? echo $result_arr_p["name"]; ?></option>
    <? } ?>
    </select>
    </div> </li>
    <li><label>产品类别名称<b>*</b></label><input type="text" name="name" border="1px" class="dfinput"/></li>
    <li><label>产品类别描述<b>*</b></label><textarea id="content6" name="description" style="width:700px;height:250px;visibility:hidden;"></textarea></li>
    
    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认添加"/></li>
    </form>
    </ul>  
    
    </div> 
    
    
  	<div id="tab2" class="tabson">
     
  <form action="product_class_deal.php?act=delAll" method="post">  
    <table class="tablelist">
    	<thead>
    	<tr>
        <th width="10%"><input name="checkAll" id="checkAll" type="checkbox" value=""/></th>
        <th width="23%">类别名称<i class="sort"><img src="images/px.gif" /></i></th>
        <th width="12%">添加时间</th>
        <th width="40%">描述</th>
        <th width="15%">操作</th>
        </tr>
        </thead>
        <tbody>
        <?
			$sql="select * from `yg_product_class` where `parentId`=0 order by Id desc";
			//echo $sql;
			$result=mysql_query($sql);
			while($result_arr=mysql_fetch_array($result)){
		?>
        <tr>
        <td width="10%"><input name="checkbox_Id[]" type="checkbox" value="<? echo $result_arr["Id"];?>"  class="checkbox_Id"/>  </td>
        <td width="23%"><? echo $result_arr["name"];?></td>
        <td width="12%"><? echo $result_arr["addtime"];?></td>
        <td width="40%"><? echo $result_arr["description"];?></td>
        <td width="15%"><a href="product_class_update.php?Id=<? echo $result_arr["Id"];?>" class="tablelink">查看/修改</a><a href="product_class_deal.php?Id=<? echo $result_arr["Id"];?>&act=del" class="tablelink">删除</a></td>
        </tr> 
			<? 
				$sql_s="select * from `yg_product_class` where `parentId`=".$result_arr["Id"]." order by Id desc";
				//echo $sql;
				$result_s=mysql_query($sql_s);
				while($result_arr_s=mysql_fetch_array($result_s)){
            ?>
            <tr>
                <td width="10%"><input name="checkbox_Id[]" type="checkbox" value="<? echo $result_arr_s["Id"];?>"  class="checkbox_Id"/>  </td>
                <td width="23%"><? echo "——".$result_arr_s["name"];?></td>
                <td width="12%"><? echo $result_arr_s["addtime"];?></td>
                <td width="40%"><? echo $result_arr_s["description"];?></td>
                <td width="15%"><a href="product_class_update.php?Id=<? echo $result_arr_s["Id"];?>" class="tablelink">查看/修改</a><a href="product_class_deal.php?Id=<? echo $result_arr_s["Id"];?>&act=del" class="tablelink">删除</a></td>
            </tr> 
            <? }?>
       <? }?>
       
       <tr>
        <td colspan="2"><a class="tablelink click">删除全部</a></td>
        <td></td>
        <td>&nbsp;</td>
        <td width="15%">&nbsp;</td>
        </tr> 
        </tbody>
    </table>
    
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
