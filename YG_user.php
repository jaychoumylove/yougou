<?php include ("Include/mysql_open.php");?>
<?php include ("session_chk.php");?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>个人中心-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_user.css">
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
		//YG_lx 下拉 end
		$(".SC_po").mouseenter(function(){
			$(this).siblings().children(".jn_SC").animate({bottom:"0px"},100);
		})
		$(".jn_SC").parent().parent("dl").mouseleave(function(){
			$(".jn_SC").animate({bottom:"-40px"},500);
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
            <h1 class="hover"><img src="images/cd.png" alt="..."/><a href="#" target="_blank">个人中心</a></h1>
            <ul>
                <li><a href="YG_user_order.php" target="_blank">我的订单</a></li>
                <li><a href="YG_user_comment.php" target="_blank">我的评论</a></li>
                <li><a href="YG_user_collection.php" target="_blank">我的收藏</a></li>
                <li><a href="YG_user_info.php" target="_blank">我的资料</a></li>
                <li><a href="YG_user_info_address.php" target="_blank">收货地址</a></li>
                <li><a href="YG_user_info_password.php" target="_blank">修改密码</a></li>
            </ul>
        </div>
        <div class="con_right">
        	<div class="user_info">
            	<? 
					$sql="select * from `yg_user` where `user`='".$_SESSION["user"]."';";
					$result=mysql_query($sql);
					$result_arr=mysql_fetch_array($result); 
				?>
            	<div style="width:100px; height:100px; border-radius:50px; overflow:hidden;">
                	
                	<img src="<? if($result_arr["head_tx"]!=""){ 
						echo $result_arr["head_tx"];
						}else{ 
						echo "images/headetx-1.png";
						}?>" 
                    alt="<? echo $_SESSION["user"]?>" style="height:100px; width:100px; overflow:hidden; vertical-align:middle;">
                 </div>   
                <ul>
                    <li><strong><? if($result_arr["name"]==""){
						echo $_SESSION["user"];
					}else{
						echo $result_arr["name"];
					}?></strong>&nbsp;&nbsp;&nbsp;&nbsp;你好！</li>
                    <!--<li>所在地：长沙&nbsp;&nbsp;&nbsp;&nbsp;</li>-->
                </ul>
                <ul class="order_list">
                	<li><a href="YG_user_order.php?orderment= " target="_blank">所有订单</a></li>
                    <li><a href="YG_user_order.php?orderment=0" target="_blank">待付款</a></li>
                    <li><a href="YG_user_order.php?orderment=1" target="_blank">待发货</a></li>
                    <li><a href="YG_user_order.php?orderment=2" target="_blank">待收货</a></li>
                    <li><a href="YG_user_order.php?orderment=3" target="_blank">待评论</a></li>
                </ul>
            </div>
            <div class="space_hx"></div>
            <div class="recent_orders">
            	<h1>最近订单<span><a href="YG_user_order.php" target="_blank">查看所有订单</a></span></h1>
                <table>
                    <thead>
                        <tr>
                            <th class="prt_box">商品</th>
                            <th class="pre_box">单价</th>
                            <th class="many_box">数量</th>
                            <th class="actual_payment">实付款</th>
                            <th class="trading_sta">交易状态</th>
                            <th class="trading_pra">交易操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<? 
							$sql_order="select * from `yg_order` where `user_Name`='".$_SESSION["user"]."' order by Id desc limit 3;";
							//exit($sql_order);
							$result_order=mysql_query($sql_order);
							while($result_arr_order=mysql_fetch_array($result_order)){
						?>
                    	<tr class="space_hx tr_h_sp">
                        	<td colspan="6">&nbsp;&nbsp;</td>
                        </tr>
                        <tr class="order_top">
                        	<td colspan="6">
                            	<input type="checkbox" checked="" value="<? echo $result_arr_order["Id"]?>" >&nbsp;&nbsp;<? echo $result_arr_order["paytime"]?>&nbsp;&nbsp;<a href="YG_user_order_info.php?Id=<? echo $result_arr["Id"]?>" target="_blank">&nbsp;订单号：&nbsp;<span><? echo $result_arr_order["order_Num"]?></span></a>
                            </td>
                        </tr>
                        <tr class="u_order_info">
                            <td class="prt_box">
                            	<?
									 $sql_orderlist_1="select *,a.`Id` as aId from `yg_product` as a join `yg_orderlist` as b on a.`Id`=b.`pro_Id` where b.`order_Num`='".$result_arr_order["order_Num"]."' order by b.Id desc limit 3;";
									 //echo $sql_orderlist_1;
									$result_orderlist_1=mysql_query($sql_orderlist_1);
									while($result_arr_orderlist_1=mysql_fetch_array($result_orderlist_1)){
								?>
                                <a href="YG_product_info.php?Id=<? echo $result_arr_orderlist["aId"]?>" target="_blank">
                                	<img src="<? echo $result_arr_orderlist_1["product_img"]?>" alt="<? echo $result_arr_orderlist_1["pro_name"]?>" style="height:80px; width:80px; overflow:hidden; vertical-align:middle;" />
                                    <ul class="clearfix">
                                    	<li><? echo $result_arr_orderlist_1["pro_name"]?></li><br/>
                                    	<li><? echo $result_arr_orderlist_1["pro_class"]?></li>
                                    </ul>
                                </a>
                                <? }?>
                            </td>
                            <td class="pre_box" style="line-height:120px;">
								<?
									 $sql_orderlist_3="select *,a.`Id` as aId from `yg_product` as a join `yg_orderlist` as b on a.`Id`=b.`pro_Id` where b.`order_Num`='".$result_arr_order["order_Num"]."' order by b.Id desc limit 3;";
									  //echo $sql_orderlist_3;
									$result_orderlist_3=mysql_query($sql_orderlist_3);
									while($result_arr_orderlist_3=mysql_fetch_array($result_orderlist_3)){
								?>
                            	￥&nbsp;&nbsp;<? echo $result_arr_orderlist_3["pro_price"]?>&nbsp;&nbsp;<br/>
                                <? } ?>
                            </td>
                            <td class="many_box" style="line-height:120px;">
                            	<?
									 $sql_orderlist_2="select *,a.`Id` as aId from `yg_product` as a join `yg_orderlist` as b on a.`Id`=b.`pro_Id` where b.`order_Num`='".$result_arr_order["order_Num"]."' order by b.Id desc limit 3;";
									  //sexit($sql_orderlist_2);
									$result_orderlist_2=mysql_query($sql_orderlist_2);
									while($result_arr_orderlist_2=mysql_fetch_array($result_orderlist_2)){
								?>
                            	&nbsp;<? echo $result_arr_orderlist_2["pro_num"]?>&nbsp;<br/>
                                <? }?>
                            </td>
                            <td class="actual_payment">
                            	￥&nbsp;&nbsp;<? echo $result_arr_order["pay"]?>&nbsp;&nbsp;<br/>
                            </td>
                            <td class="trading_sta">
                            	<? if($result_arr_order["orderment"]==0){
									echo "<p>交易进行——未付款</p>";
								}else if($result_arr_order["orderment"]==1){
									echo "<p>交易进行——未发货</p>";
								}else if($result_arr_order["orderment"]==2){
									echo "<p>交易进行——未收货</p>";
								}else if($result_arr_order["orderment"]==3){
									echo "<p>交易进行——未评论</p>";
								}else if($result_arr_order["orderment"]==4){
									echo "<p>交易完成</p>";
								}?>
                            </td>
                            <td class="trading_pra">
                            	<a href="#" target="_self">删除该订单</a><br/>
                                <? if($result_arr_order["orderment"]==0){?>
                                <a href="#" target="_self">去付款</a>
                                <? }else if($result_arr_order["orderment"]==2){?>
                                <a href="#" target="_self">确认收货</a>
                                <? }else if($result_arr_order["orderment"]==3){?>
                                <a href="#" target="_self">去评论</a>
                                <? }?>
                            </td>
                        </tr>
                        <? }?>
                    </tbody>
                </table>
            </div>
            <div class="space_hx"></div>
            <div class="G_y_l">
                <h1>猜你喜欢</h1>
                <?
					$sql_gyl="select * from `yg_product` limit 4"; 
					$result_gyl=mysql_query($sql_gyl);
					while($result_arr_gyl=mysql_fetch_array($result_gyl)){
				?>		
					<dl>
                        <a class="SC_po" href="YG_product_info.php?Id=<? echo $result_arr_gyl["Id"]?>" target="_blank">
                            <dt><img src="<? echo $result_arr_gyl["product_img"]?>" style="width:224px; height:224px;" alt=""></dt>
                            <dd><? echo $result_arr_gyl["name"]?></dd>
                            <dd class="pay_for">￥&nbsp;&nbsp;<? echo $result_arr_gyl["yg_price"]?><span>已售：&nbsp;&nbsp;<strong><? echo $result_arr_gyl["sales_vol"]?></strong></span></dd>
                        </a> 
                        <a href="#" target="_blank"><div class="jn_SC">加入购物车</div></a>
                    </dl>
				<? }?>
                <!--一共展示4件商品-->
            </div>
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
