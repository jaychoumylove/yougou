<?
	require("Include/mysql_open.php");
	require("Include/ck_session.php");
	
	$Id=@$_GET["Id"];
	if(empty($Id)){
		echo "<script>window.location.href='user.php';alert('非法入侵！');</script>";
	}
	//第三步 执行SQL语句
	$sql="select * from `yg_order` where Id=".$Id;
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
    <li><a href="#">订单详情</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div class="formtitle"><span>订单信息</span></div>
    
    
	<ul class="forminfo">
    <li><label>订单号<b>*</b></label><span style="font-size:14px;"><? echo $result_arr["order_Num"];?></span></li>
    <li><label>状态<b>*</b></label><span style="font-size:14px;">
	<? 
		if($result_arr["orderment"]!=3){
			echo "交易正进行——";
			if($result_arr["orderment"]==0){
				echo "未付款！";
			}
			if($result_arr["orderment"]==1){
				echo "未发货！";
			}
			if($result_arr["orderment"]==2){
				echo "未收货！";
			}
		}else{
			echo "交易完成！";
		}
	?></span></li>
    <li><label>下单时间<b>*</b></label><span style="font-size:14px;"><? echo $result_arr["paytime"];?></span> 
    <li><label>收货人<b>*</b></label><span style="font-size:14px;"><? echo $result_arr["ads_name"];?></span>
    </li> 
    <li><label>地址<b>*</b></label><span style="font-size:14px;"><? echo $result_arr["ads_info"];?></span>
    </li> 
    <li><label>手机号码<b>*</b></label><span style="font-size:14px;"><? echo $result_arr["phone"];?></span></li> 
    <li><label>支付方式<b>*</b></label><span style="font-size:14px;"><? if($result_arr["payment"]==1){
		echo "货到付款";
	}else{
		echo "账户余额";
	}?></span></li>
    <li><label>配送方式<b>*</b></label><span style="font-size:14px;"><? if($result_arr["shippingment"]==1){
		echo "顺丰快递";
	}else{
		echo "快速配送";
	}?></span></li>
    </ul>
    <table class="tablelist">
    	<thead>
    	<tr>
        <th width="15%">商品主图</th>
        <th width="42%">购买商品名<i class="sort"><img src="images/px.gif" /></i></th>
        <th width="17%">单价</th>
        <th width="6%">数量</th>
        <th width="20%">下单时间</th>
        </tr>
        </thead>
        <tbody>
        <? 
			$sql_list="select *,b.addtime as baddtime from `yg_product` as a join `yg_orderlist` as b on a.Id=b.pro_Id where b.order_Num=".$result_arr["order_Num"];
			$result_list=mysql_query($sql_list);
			// 第四步 从结果集取出数据 转换为数组
			while($result_arr_list=mysql_fetch_array($result_list)){
		?>
        <tr>
        <td><img src="<? echo $result_arr_list["admin_product_img"]?>" style="width:80px; height:80px; margin:20px;" alt="<? echo $result_arr_list["pro_name"]?>" /></td>
        <td><? echo $result_arr_list["pro_name"]?></td>
        <td><? echo $result_arr_list["pro_price"]?></td>
        <td><? echo $result_arr_list["pro_num"]?></td>
        <td><? echo $result_arr_list["baddtime"]?></td>
        </tr> 
       <? } ?>
        </tbody>
    </table>
    <br/>
    <ul style="float:right">
    <li><label>用户名<b>*</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:rgba(255,35,69,1.00); font-size:16px; display:inline-block; text-align:right;"><? echo $result_arr["user_Name"];?></span>
    </li> 
    <li><label>实付款<b>*</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:rgba(255,35,69,1.00); font-size:16px; display:inline-block; text-align:right;"><? echo $result_arr["pay"];?> </span>
    <li>&nbsp;</li>
    <li>&nbsp;</li>
    <li>&nbsp;</li>
    </ul>    

</body>

</html>
