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
	
});
</script>

</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="#">首页</a></li>
    <li><a href="#">活动类别管理</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    
    <div id="usual1" class="usual"> 
    
    <div class="itab">
  	<ul> 
    <li><a href="#tab1">添加活动类别</a></li> 
    <li><a href="#tab2" class="selected">活动类别管理</a></li> 
  	</ul>
    </div> 
   
  	<div id="tab1" class="tabson">    
    <ul class="forminfo">
 	<form action="active_class_deal.php?act=add" method="post">
    <li>
    <label>选择活动分类：<b>*</b></label>
    <div class="vocation">
    <select name="act_classId" class="select1">
 	<option value="0">全品活动</option>
    <?
		$sql_p="select * from `yg_product_class` where `parentId`='0'";
		$result_p=mysql_query($sql_p);
		$rows_num_p=mysql_num_rows($result_p);
		while($result_arr_p=mysql_fetch_array($result_p)){
	?>
    	<option value="<? echo $result_arr_p["Id"]; ?>"><? echo $result_arr_p["name"]; ?></option>
    <? } ?>
    </select>
    </div> </li>
    <li><label>活动类别名称<b>*</b></label><input type="text" name="act_name" border="1px" class="dfinput"/></li>
    <li><label>是否正进行<b>*</b></label>
    <input name="act_ising" type="radio" value="1"  checked="checked"/> 是
    <input name="act_ising" type="radio"  value="0"  /> 否
    </li>
     <li><label>活动类别描述<b>*</b></label><textarea id="content6" name="description" style="width:700px;height:250px;visibility:hidden;"></textarea></li>
    <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认添加"/></li>
    </form>
    </ul>  
    
    </div> 
    
    
  	<div id="tab2" class="tabson">
     <form action="active_class.php?act=search" method="post">
    <ul class="seachform">
    <li><label>活动类别等级</label>  
    <div class="vocation">
    <select class="select3" name="act_classId">
        <option value="0">全品活动</option>
        <?
			$sql_a_d="select * from `yg_product_class` where `parentId`=0;"; 
			$result_a_d=mysql_query($sql_a_d);
			while($result_arr_a_d=mysql_fetch_array($result_a_d)){
		?>
        <option value="<? echo $result_arr_a_d["Id"]?>"><? echo $result_arr_a_d["name"]?></option>
        <? } ?>
    </select>
    </div>
    </li>   
  
	<li><label>活动类别名</label><input name="act_name" type="text" class="scinput" /></li>
    <li><label>&nbsp;</label><input name="" type="submit" class="scbtn" value="查询"/></li>
  
    </ul>
    </form>

  <form action="active_class_deal.php?act=delAll" method="post">  
    <table class="tablelist">
    	<thead>
    	<tr>
        <th width="6%"><input name="checkAll" id="checkAll" type="checkbox" value=""/></th>
        <th width="15%">类别名称<i class="sort"><img src="images/px.gif" /></i></th>
        <th width="16%">活动所属</th>
        <th width="10%">是否正在进行</th>
        <th width="18%">添加时间</th>
        <th width="26%">描述</th>
        <th width="9%">操作</th>
        </tr>
        </thead>
        <tbody>
        <?
			$act=@$_GET["act"];					
			if($act=="search"){
				
				$act_classId=@$_POST["act_classId"];
				if(empty($act_classId)){
					$act_classId=@urldecode($_GET["act_classId"]);
				}
				
				$act_name=@$_POST["act_name"];
				if(empty($act_name)){
					$act_name=@urldecode($_GET["act_name"]);
				}	
				
				$sql_m="select * from `yg_active` where 1=1 ";
				if($act_classId!=""){
					$sql_m.= "and `act_classId` =  '".$act_classId."' ";
				}else{
					$sql_m.=" ";
				}
				if($act_name!=""){
					$sql_m.= "and (act_name like '%".$act_name."%') ";
				}
				$sql_m.="order by Id desc";
				//exit($sql);
			}else{
				$sql_m="select * from `yg_active` order by Id desc";
			}		
			$result=mysql_query($sql_m);
			$rows_num=mysql_num_rows($result);//显示出结果集 的记录数
			
			$pagesize=8;//每一页有9条记录
			
			$page_all=ceil($rows_num/$pagesize);//这里是进一法
			
			$page_now=@ceil($_GET["page_now"]==""?1:$_GET["page_now"]);//当前页码
			
			$offset=($page_now-1)*$pagesize;//根据当前的页码 计算出偏移量
		
        	//第三步 执行SQL语句
			
			if($act=="search"){
				$act_classId=@$_POST["act_classId"];
				if(empty($act_classId)){
					$act_classId=@urldecode($_GET["act_classId"]);
					                               
				}
				$act_name=@$_POST["act_name"];
				if(empty($act_name)){
					$act_name=@urldecode($_GET["act_name"]);
				}	
				$sql="select * from `yg_active` where 1=1 ";
				if($act_classId!=""){
					$sql.= "and `act_classId` = '".$act_classId."' ";
				}else{
					$sql.=" ";
				}
				if($act_name!=""){
					$sql.= "and (name like '%".$act_name."%') ";
				}
				$sql.="order by Id desc limit ".$offset.",".$pagesize;
				//exit($sql);
			}else{
				$sql="select * from `yg_active` order by Id desc limit ".$offset.",".$pagesize;
			}	
			//echo $sql;
			$result=mysql_query($sql);
			while($result_arr=mysql_fetch_array($result)){
		?>
        <tr>
        <td width="6%"><input name="checkbox_Id[]" type="checkbox" value="<? echo $result_arr["Id"];?>"  class="checkbox_Id"/>  </td>
        <td width="15%"><? if($result_arr["act_classId"]==0){
			echo $result_arr["act_name"];
		}else{
			echo "——".$result_arr["act_name"];
		}?></td>
        <td width="16%">
		<?
			$sql_cl="select * from `yg_product_class` where `Id`=".$result_arr["act_classId"];
			$result_cl=mysql_query($sql_cl);
			$result_arr_cl=mysql_fetch_array($result_cl);
			if($result_arr_cl["name"]==""){
				echo "全品";
			}else{
				echo $result_arr_cl["name"];
			}
		 ?></td>
        <td width="10%">
		<?
			if($result_arr["act_ising"]=="1"){
				echo "是";
			}else{
				echo "否";
			}
		 
		 ?></td>
        <td width="18%"><? echo $result_arr["addtime"];?></td>
        <td width="26%"><? echo $result_arr["description"];?></td>
        <td width="9%"><a href="active_class_update.php?Id=<? echo $result_arr["Id"];?>" class="tablelink">查看/修改</a><a href="active_class_deal.php?Id=<? echo $result_arr["Id"];?>&act=del" class="tablelink">删除</a></td>
        </tr> 
       <? }?>
       
       <tr>
        <td colspan="2"><a class="tablelink click">删除全部</a></td>
        <td></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td width="9%">&nbsp;</td>
        </tr> 
        </tbody>
    </table>
    <div class="pagin">
    	<div class="message">共<i class="blue"><? echo $rows_num;?></i>条记录，当前显示第&nbsp;<i class="blue"><? echo $page_now;?>&nbsp;</i>页，总共&nbsp;<i class="blue"><? echo $page_all;?>&nbsp;</i>页   &nbsp;&nbsp;&nbsp; 
        
        	<?
				$m="";
				if(@$act_classId!="" || @$act_name!=""){
					$m.="&act=search";
				}
				if(@$act_classId!=""){
					$m.="&act_classId=".urlencode($act_classId);
				}
				if(@$act_name!=""){
					$m.="&act_name=".$act_name;
				}           
			 ?>
        
        
            <? if($page_now==1){ ?>   
                <b>首页</b>
                <b>上一页</b> 
            <? }else{?>
                <b><a href="active_class.php?page_now=1<? echo $m;?>" class="blue">首页</a></b> 
                <b><a href="active_class.php?page_now=<? echo $page_now-1 ;?><? echo $m;?>" class="blue">上一页</a></b>
            <? }?>
             
             <? if($page_now==$page_all){ ?>  
                <b>下一页</b> 
            	<b>尾页</b>           
             <? }else{?>
            	<b><a href="active_class.php?page_now=<? echo $page_now+1 ;?><? echo $m;?>" class="blue">下一页</a></b> 
            	<b><a href="active_class.php?page_now=<? echo $page_all;?><? echo $m;?>" class="blue">尾页</a></b>  
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
