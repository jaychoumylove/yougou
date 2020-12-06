<?php include ("Include/mysql_open.php");?>
<?php include ("session_chk.php");?>
<? 
	$Id=@$_GET["Id"];
	if($Id==""){
		exit("<script>window.location.href='YG_user_order.php';alert('请选择你要查看的订单号！');</script>");
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>订单详情-个人中心-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_uer_order_info.css">
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		//top 下拉 start
        $(".link_right").children("div").hover(function(){
			$(this).children("ul").slideDown(1000);
			$(this).find(".xial").attr("src","images/sl.png");
		},function(){
			$(this).children("ul").slideUp(1000);
			$(this).find(".xial").attr("src","images/xl.png");
		})
		//top 下拉 end
		//YG_lx 下拉 start
		$(".YG_lx").hover(function(){
			$(".YG_wc").fadeIn(1000);
		},function(){
			$(".YG_wc").fadeOut(1000);
		})
	})
</script>
</head>

<body>
	<!--top start-->
	<div class="top">
        <?php include ("top_link.php");?>    
        <div class="top_menu">
        	<div class="menu">
            	<div class="user">
                	<a href="#" target="_blank"><img src="images/logo_user3.png" alt="会员中心" /></a>会员中心
                </div>
                <ul>
                	<li><a href="YG_index.php" target="_blank">首页</a></li>
                    <li><a href="YG_user_info.php" target="_blank">账户设置</a></li>
                    <li><a href="YG_user_info_password.php" target="_blank">修改密码</a></li>
                </ul>
                <form method="post" action="YG_products.php?act=search" class="u_search">
                	<input class="search_inp" type="text" placeholder="骑行服" />
                    <input class="search_sub" type="submit" value="" />
                </form>
                <div class="u_S_cart">
                	<a href="YG_shopping_cart.php" target="_self"><img src="images/gwc_red.png" alt="购物车" >我的购物车</a>
                </div>
            </div>
        </div>
    </div>
    <!--top end-->
    <div class="space_hx"></div>
    <div class="space_hx"></div>
    <!--content start-->
    <div class="u_content">
    	<div class="con_left">
            <h1><img src="images/cd.png" alt="..."/><a href="YG_user.php" target="_blank">个人中心</a></h1>
            <ul>
                <li class="hover"><a href="YG_user_order.php" target="_blank">我的订单</a></li>
                <li><a href="YG_user_comment.php" target="_blank">我的评论</a></li>
                <li><a href="YG_user_collection.php" target="_blank">我的收藏</a></li>
                <li><a href="YG_user_info.php" target="_blank">我的资料</a></li>
                <li><a href="YG_user_info_address.php" target="_blank">收货地址</a></li>
                <li><a href="YG_user_info_password.php" target="_blank">修改密码</a></li>
            </ul>
        </div>
        <div class="con_right">
        	<div class="o_infoBox">
            	<h1>订单详情</h1>
                <? 
					$heji=0.00;
					$sql_order="select * from `yg_order` where `Id`=".$Id;
					//exit($sql_order);
					$result_order=mysql_query($sql_order);
					$result_arr=mysql_fetch_array($result_order);
				?>
                <div class="ord_number">
                	<p>订单号：<a href="" target="_blank"><span><? echo $result_arr["order_Num"]?></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订单状态：<span>
					<? if($result_arr["orderment"]==0){
						  echo "交易进行——未付款";
					  }else if($result_arr["orderment"]==1){
						  echo "交易进行——未发货";
					  }else if($result_arr["orderment"]==2){
						  echo "交易进行——未收货";
					  }else if($result_arr["orderment"]==3){
						  echo "交易完成";
					  }?>
                     </span><a class="cz_dd" href="order_deal.php?act=del&Id=<? echo $result_arr["Id"]?>" target="_blank">删除该订单</a></p>
                </div>
                <div class="ord_info">
                	<div class="c_info">
                		<h1>收货人信息</h1>
                    	<p><span>收&nbsp;&nbsp;货&nbsp;&nbsp;人：</span><strong><? echo $result_arr["ads_name"]?></strong></p>
                        <p><span>地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</span><strong><? echo $result_arr["ads_info"]?></strong></p>
                        <p><span>手机号码：</span><strong><? echo $result_arr["phone"]?></strong></p>
                	</div>
                    <div class="p_s_ment">
                    	<h1>支付/配送方式</h1>
                    	<p><span>支付方式：</span><strong><? if($result_arr["payment"]==1){echo "货到付款";}else{echo "账户余额";}?></strong></p>
                        <p><span>配送方式：</span><strong><? if($result_arr["shippingment"]==1){echo "顺丰快递";}else{echo "快速配送";}?></strong></p>
                	</div>
                    <div class="lis_goods">
                    	<h1>商品清单</h1>
                        <table>
                            <thead>
                                <tr>
                                    <th class="prt_box">商品</th>
                                    <th class="pre_box">单价</th>
                                    <th class="many_box">数量</th>
                                    <th class="trading_sta">小计</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<? 
									$sql_orderlist="select *,a.`Id` as aId from `yg_product` as a join `yg_orderlist` as b on a.`Id`=b.`pro_Id` where b.`order_Num`='".$result_arr["order_Num"]."' ";
									$result_orderlist=mysql_query($sql_orderlist);
									while($result_arr_t=mysql_fetch_array($result_orderlist)){
								?>
                                <tr class="space_hx tr_h_sp">
                                    <td colspan="4">&nbsp;&nbsp;</td>
                                </tr>
                                <tr class="u_order_info">
                                    <td class="prt_box">
                                        <a href="YG_product_info.php?Id=<? echo $result_arr_t["aId"]?>" target="_blank">
                                            <img src="<? echo $result_arr_t["product_img"]?>" alt="<? echo $result_arr_t["pro_name"]?>" style="height:80px; width:80px; overflow:hidden; vertical-align:middle;" />
                                            <ul class="clearfix">
                                                <li><? echo $result_arr_t["pro_name"]?></li>
                                                <li><? echo $result_arr_t["pro_class"]?></li>
                                            </ul>
                                        </a>
                                    </td>
                                    <td class="pre_box">
                                    ￥&nbsp;&nbsp;<? echo $result_arr_t["pro_price"]?>
                                    </td>
                                    <td class="many_box">
                                        &nbsp;<? echo $result_arr_t["pro_num"]?>&nbsp;
                                    </td>
                                    <td class="trading_sta">
                                        ￥&nbsp;&nbsp;
										<? 
											$xiaoji=$result_arr_t["pro_price"]*$result_arr_t["pro_num"];
											$heji+=$xiaoji;
											echo $xiaoji;
										?>
                                    </td>
                                </tr>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="A_combined">
                    	<p><span>商品金额：</span><strong>￥&nbsp;&nbsp;<? echo $heji?></strong></p>
                        <p><span>运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：</span><strong>￥&nbsp;&nbsp;0.00</strong></p>
                        <p><span>实&nbsp;付&nbsp;&nbsp;款：</span><strong>￥&nbsp;&nbsp;<? echo $result_arr["pay"]?></strong></p>
                    </div>
                </div>
            </div>
        	<div class="space_hx"></div>
        </div>
    </div>
    <!--content end-->
    <div class="space_hx"></div>
    <div class="space_hx"></div>
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
