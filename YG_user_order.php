<?php include ("Include/mysql_open.php");?>
<?php include ("session_chk.php");?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>我的订单-个人中心-优购户外商城</title>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/YG_user_order.css">
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
		$(".all_list").mouseenter(function(){
			$(".all_link").slideDown(500);
			$(".all_link").css("z-index","3");
		})
		$(".all").mouseleave(function(){
			$(".all_link").slideUp(500);
			$(".all_link").css("z-index","3");
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
            <h1><a href="#" target="_blank"><img src="images/cd.png" alt="..."/>个人中心</a></h1>
            <ul>
                <li class="hover"><a href="#" target="_blank">我的订单</a></li>
                <li><a href="#" target="_blank">我的评论</a></li>
                <li><a href="#" target="_blank">我的收藏</a></li>
                <li><a href="#" target="_blank">我的资料</a></li>
                <li><a href="#" target="_blank">收货地址</a></li>
                <li><a href="#" target="_blank">修改密码</a></li>
            </ul>
        </div>
        <div class="con_right">
            <div class="recent_orders">
            	<ul>
                	<? 
						$orderment=@$_GET["orderment"];
					?>
                	<li <? if($orderment==""){echo "class='selected'";}?>><a href="YG_user_order.php?orderment= " target="_blank">所有订单</a></li>
                    <li <? if($orderment=="0"){echo "class='selected'";}?>><a href="YG_user_order.php?orderment=0" target="_blank">待付款</a></li>
                    <li <? if($orderment=="1"){echo "class='selected'";}?>><a href="YG_user_order.php?orderment=1" target="_blank">待发货</a></li>
                    <li <? if($orderment=="2"){echo "class='selected'";}?>><a href="YG_user_order.php?orderment=2" target="_blank">待收货</a></li>
                    <li <? if($orderment=="3"){echo "class='selected'";}?>><a href="YG_user_order.php?orderment=3" target="_blank">待评论</a></li>
                </ul>
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
						if($orderment!=""){
							$sql_m= "select * from `yg_order` where (`orderment`='".$orderment."' and `user_Name`='".$_SESSION["user"]."')  order by Id desc";
						}else{
							$sql_m="select * from `yg_order` where `user_Name`='".$_SESSION["user"]."' order by Id desc";
						}		
						$result_m=mysql_query($sql_m);
						$rows_num=mysql_num_rows($result_m);//显示出结果集 的记录数
						$pagesize=5;//每一页有5条记录
						$page_all=ceil($rows_num/$pagesize);//这里是进一法
						if(@$_GET["page_now"]!=""){
							$page_now=@$_GET["page_now"];
						}else if(@$_GET["page_now"]==""){
							$page_now=@$_POST["page"];
							if(@$_POST["page"]==""){
								$page_now=1;
							}
						}
						//当前页码
						$offset=($page_now-1)*$pagesize;//根据当前的页码 计算出偏移量
						//第三步 执行SQL语句
						if($orderment!=""){
							$sql= "select * from `yg_order` where (`orderment`='".$orderment."' and `user_Name`='".$_SESSION["user"]."')  order by Id desc limit ".$offset.",".$pagesize;
						}else{
							$sql="select * from `yg_order` where `user_Name`='".$_SESSION["user"]."' order by Id desc limit ".$offset.",".$pagesize;
						}	
						//echo $sql;
						$result=mysql_query($sql);
						while($result_arr=mysql_fetch_array($result)){
					?>
                    	<tr class="space_hx tr_h_sp">
                        	<td colspan="6">&nbsp;&nbsp;</td>
                        </tr>
                        <tr class="order_top">
                        	<td colspan="6">
                            	<input type="checkbox" checked="" value="<? echo $result_arr["Id"]?>" >&nbsp;&nbsp;<? echo $result_arr["paytime"]?>&nbsp;&nbsp;&nbsp;<a href="YG_user_order_info.php?Id=<? echo $result_arr["Id"]?>" target="_blank">订单号：&nbsp;<span><? echo $result_arr["order_Num"]?></span></a>
                            </td>
                        </tr>
                        <tr class="u_order_info">
                            <td class="prt_box">
                            	<?
									 $sql_orderlist_1="select *,a.`Id` as aId from `yg_product` as a join `yg_orderlist` as b on a.`Id`=b.`pro_Id` where b.`order_Num`='".$result_arr["order_Num"]."' order by b.Id desc limit 3;";
									 //echo $sql_orderlist_1;
									$result_orderlist_1=mysql_query($sql_orderlist_1);
									while($result_arr_orderlist_1=mysql_fetch_array($result_orderlist_1)){
								?>
                                <a href="YG_product_info.php?Id=<? echo $result_arr_orderlist_1["aId"]?>" target="_blank">
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
									 $sql_orderlist_3="select *,a.`Id` as aId from `yg_product` as a join `yg_orderlist` as b on a.`Id`=b.`pro_Id` where b.`order_Num`='".$result_arr["order_Num"]."' order by b.Id desc limit 3;";
									  //echo $sql_orderlist_3;
									$result_orderlist_3=mysql_query($sql_orderlist_3);
									while($result_arr_orderlist_3=mysql_fetch_array($result_orderlist_3)){
								?>
                            	￥&nbsp;&nbsp;<? echo $result_arr_orderlist_3["pro_price"]?>&nbsp;&nbsp;<br/>
                                <? } ?>
                            </td>
                            <td class="many_box" style="line-height:120px;">
                            	<?
									 $sql_orderlist_2="select *,a.`Id` as aId from `yg_product` as a join `yg_orderlist` as b on a.`Id`=b.`pro_Id` where b.`order_Num`='".$result_arr["order_Num"]."' order by b.Id desc limit 3;";
									  //sexit($sql_orderlist_2);
									$result_orderlist_2=mysql_query($sql_orderlist_2);
									while($result_arr_orderlist_2=mysql_fetch_array($result_orderlist_2)){
								?>
                            	&nbsp;<? echo $result_arr_orderlist_2["pro_num"]?>&nbsp;<br/>
                                <? }?>
                            </td>
                            <td class="actual_payment">
                            	￥&nbsp;&nbsp;<? echo $result_arr["pay"]?>&nbsp;&nbsp;<br/>
                            </td>
                            <td class="trading_sta">
                            	<? if($result_arr["orderment"]==0){
									echo "<p>交易进行——未付款</p>";
								}else if($result_arr["orderment"]==1){
									echo "<p>交易进行——未发货</p>";
								}else if($result_arr["orderment"]==2){
									echo "<p>交易进行——未收货</p>";
								}else if($result_arr["orderment"]==3){
									echo "<p>交易完成</p>";
								}?>
                            </td>
                            <td class="trading_pra">
                            	<!--<a href="order_deal.php?act=del&Id= echo $result_arr["Id"]" target="_self">删除该订单</a><br/>-->
                                <? if($result_arr["orderment"]==0){?>
                                <a href="order_deal.php?act=update&Id=<? echo $result_arr["Id"]?>&orderment=1" target="_self">去付款</a>
                                <? }else if($result_arr["orderment"]==1 || $result_arr["orderment"]==2){?>
                                <a href="order_deal.php?act=update&Id=<? echo $result_arr["Id"]?>&orderment=3&ordernum=<? echo $result_arr["order_Num"]?>" target="_self">确认收货</a>
                                <? }else if($result_arr["orderment"]==3){?>
                                <a href="YG_user_comment.php" target="_self">去评论</a>
                                <? }?>
                            </td>
                        </tr>
                        <? }?>
                    </tbody>
                </table>
                <ul class="page">
			   <?
                  $m="";
                  if(@$orderment!=""){
                      $m.="&orderment=".$orderment;
                  }
               ?>
               <? if($page_now==1){?>
                    <li>首页</li>
                    <li>上一页</li>
               <? }else{?>
                    <li><a href="?page_now=1<? echo $m;?>" target="_self">首页</a></li>
                    <li><a href="?page_now=<? echo $page_now-1 ;?><? echo $m;?>" target="_self">上一页</a></li>
               <? }?>
                    <li class="now_page"><? echo $page_now;?>&nbsp;/&nbsp;<? echo $page_all;?></li>
               <? if($page_now==$page_all){ ?>
                    <li>下一页</li>
                    <li>尾页</li>
               <? }else{?>
                    <li><a href="?page_now=<? echo $page_now+1 ;?><? echo $m;?>" target="_self">下一页</a></li>
                    <li><a href="?page_now=<? echo $page_all;?><? echo $m;?>" target="_self">尾页</a></li>
               <? }?>
                </ul>
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