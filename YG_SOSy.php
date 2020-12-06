<?php include ("Include/mysql_open.php");?>
<?php include ("session_chk.php");?>
<?
	$ordernum=$_GET["order_Num"];
	if($ordernum==""){
		exit("<script>window.location.href='YG_index.php';alert('您未提交订单！')</script>");
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>成功提交订单-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_SOSy.css">
</head>

<body>
	<!--top start-->
    <div class="top_content">
    	<div>
    		<div class="t_l_link"><a href="#" target="_blank"><img src="images/logo.png" alt="优购户外商城"></a><span>结算成功</span></div>
            <div class="t_r_link">
            	<ul>
                	<li>购物车</li>
                    <li>填写核实订单信息</li>
                    <li>成功提交订单</li>
                </ul>
            </div>
        </div>
    </div>
    <!--top end-->
    <div class="SOSy_main">
    	<div class="m_content">
        	<div class="space_hx"></div>
            <div class="space_hx"></div>
            <div class="SOSy_t"><h1>订单提交成功！<img src="images/SOS_t_yes.png" alt="订单提交成功！"></h1></div>
            <div class="space_hx"></div>
            <div class="space_hx"></div>
            <div class="order_info">
            <? 
				$ads_name=$_GET["ads_name"];
				$payment=$_GET["payment"];
				$pay=$_GET["pay"];
				$sql="select * from `yg_orderlist` where `order_Num`='".$ordernum."' ";
				$result=mysql_query($sql);
			?>
            	<p><span>订单信息：&nbsp;&nbsp;收货人：</span><strong><? echo $ads_name?></strong></p>
                <p><span>支付方式：</span><strong><? if($payment==1){
					echo "货到付款";
				}else if($payment==0){
					echo "账户余额";
				}?></strong></p>
            	<? 
					while($result_arr=mysql_fetch_array($result)){
				?>
                <p><span>商品信息：</span><strong><? echo $result_arr["pro_name"]?>&nbsp;&nbsp;*&nbsp;&nbsp;<? echo $result_arr["pro_num"]?></strong>
                
                </p><? }?>
                <p><span>总金额：</span><strong>￥&nbsp;&nbsp;<? echo $pay?></strong></p>
            </div>
            <div class="space_hx"></div>
            <div class="go_on_shopping">
            	<!--<input type="submit" value="提交订单"/>--><a href="YG_index.php" target="_blank">继续购物</a>
            </div>
        </div>
        <div class="space_hx"></div>
    </div>
    <!--foot start-->   
     <div class="foot clearfix">
        <div class="foot_con">
            <div class="foot_1 clearfix">
                <div class="li_01">
                    <ul>
                        <li class="li_001"><a href="#" target="_blank">新手帮助</a></li>
                        <li><a href="#" target="_blank">正品保证</a></li>
                        <li><a href="#" target="_blank">玩转优购</a></li>
                        <li><a href="#" target="_blank">常见问题</a></li>
                        <li><a href="#" target="_blank">优惠指南</a></li>
                    </ul>
                </div>
                <div class="li_01">
                    <ul>
                        <li class="li_001"><a href="#" target="_blank">购物指南</a></li>
                        <li><a href="#" target="_blank">发货时间</a></li>
                        <li><a href="#" target="_blank">配送运费</a></li>
                        <li><a href="#" target="_blank">签收/验货</a></li>
                    </ul>
                </div>
                <div class="li_01">
                    <ul>
                        <li class="li_001"><a href="#" target="_blank">支付/配送</a></li>
                        <li><a href="#" target="_blank">货到付款</a></li>
                        <li><a href="#" target="_blank">网上支付</a></li>
                        <li><a href="#" target="_blank">配送时间</a></li>
                        <li><a href="#" target="_blank">配送查询</a></li>
                    </ul>
                </div>
                <div class="li_01">
                    <ul>
                        <li class="li_001"><a href="#" target="_blank">售后服务</a></li>
                        <li><a href="#" target="_blank">退换货政策</a></li>
                        <li><a href="#" target="_blank">退换货办理</a></li>
                        <li><a href="#" target="_blank">退款说明</a></li>
                    </ul>
                </div>
                <div class="li_01">
                    <ul>
                        <li class="li_001"><a href="#" target="_blank">会员服务</a></li>
                        <li><a href="#" target="_blank">建议反馈</a></li>
                        <li><a href="#" target="_blank">CEO邮箱</a></li>
                    </ul>
                </div>
                <div class="li_01">
                    <ul>
                        <li class="li_001">7*24小时电话</li>
                        <li><a href="#" target="_blank">400-8008-258</a></li>
                        <li class="li_002"><a href="#" target="_blank"><img src="images/lxdior.png" alt="联系优购" />联系优购</a></li>
                    </ul>
                </div>
            </div>
        </div>  
        <div class="space_hx"></div>
        <div class="foot_2">
            <p>Copyright © 2008 - 2017 yougou Inc. 优购户外商城商城网  版权所有    <a href="#" target="_blank">粤ICP备14013125号</a></p>
            <div class="space_hx"></div>
        </div>
    </div>
    <!--foot end-->
</body>
</html>