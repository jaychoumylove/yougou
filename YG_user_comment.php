<?php include ("Include/mysql_open.php");?>
<?php include ("session_chk.php");?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>我的评论-个人中心-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_user_comment.css">
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
		$(".trading_sta span").click(function(){
			if($(this).children("strong").html()=="评论"){
				$(this).children("strong").html("收起")
				$(this).parent("td").parent("tr").next(".com_info").css("display","table-row");
			}else{
				$(this).children("strong").html("评论")
				$(this).parent("td").parent("tr").next(".com_info").css("display","none");
			}
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
                    <input class="search_sub" type="submit" value=""/>
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
                <li><a href="YG_user_order.php" target="_blank">我的订单</a></li>
                <li class="hover"><a href="YG_user_comment.php" target="_blank">我的评论</a></li>
                <li><a href="YG_user_collection.php" target="_blank">我的收藏</a></li>
                <li><a href="YG_user_info.php" target="_blank">我的资料</a></li>
                <li><a href="YG_user_info_address.php" target="_blank">收货地址</a></li>
                <li><a href="YG_user_info_password.php" target="_blank">修改密码</a></li>
            </ul>
        </div>
        <div class="con_right">
            <div class="recent_orders">
            	<h1>我的评论</h1>
                <table>
                    <thead>
                        <tr>
                            <th class="prt_box">商品</th>
                            <th class="pre_box">单价</th>
                            <th class="many_box">购买时间</th>
                            <th class="trading_sta">评价</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<? 
							$sql="select * from `yg_order` where (`user_Name`='".$_SESSION["user"]."' and `orderment`=3) order by Id desc";
							//echo $sql;
							$result=mysql_query($sql);
							while($result_arr=mysql_fetch_array($result)){
							$sql_orderlist_1="select *,a.`Id` as aId from `yg_product` as a join `yg_orderlist` as b on a.`Id`=b.`pro_Id` where b.`order_Num`='".$result_arr["order_Num"]."';";
							$result_orderlist_1=mysql_query($sql_orderlist_1);
							while($result_arr_orderlist_1=mysql_fetch_array($result_orderlist_1)){
						?><tr class="space_hx tr_h_sp">
                        	<td colspan="4">&nbsp;&nbsp;</td>
                        </tr>
                        <tr class="u_order_info">
                            <td class="prt_box">
                                <a href="YG_product_info.php?Id=<? echo $result_arr_orderlist_1["aId"]?>" target="_blank">
                                	<img src="<? echo $result_arr_orderlist_1["product_img"]?>" alt="<? echo $result_arr_orderlist_1["pro_name"]?>" style="height:80px; width:80px; overflow:hidden; vertical-align:middle;" />
                                    <ul class="clearfix">
                                    	<li><? echo $result_arr_orderlist_1["pro_name"]?></li><br/>
                                    	<li><? echo $result_arr_orderlist_1["pro_class"]?></li>
                                    </ul>
                                </a>
                            </td>
                            <td class="pre_box">￥&nbsp;&nbsp;<? echo $result_arr_orderlist_1["pro_price"]?></td>
                            <td class="many_box">
                            	&nbsp;<? echo $result_arr_orderlist_1["addtime"]?>&nbsp;
                            </td>
                            <td class="trading_sta">
                            	<? 
								if($result_arr_orderlist_1["iscomment"]==0){ ?>
                                <span>未<strong>评论</strong></span>
								<? }else{?>
                                <span>已<strong>评论</strong></span>
                                <? }?>
                            </td>
                        </tr>
                        <? if($result_arr_orderlist_1["iscomment"]==1){?>
                        <tr class="com_info" style="display:none">
                        	<? 
								$sql_com="select * from `yg_comment` where (`user_Name`='".$_SESSION["user"]."' and `pro_Id`=".$result_arr_orderlist_1["aId"].")";
								//exit($sql_com);
								$result_com=mysql_query($sql_com);
								$result_arr_com=mysql_fetch_array($result_com);
							?>
                        	<td colspan="4">
                            	<p class="top">&nbsp;&nbsp;评分：&nbsp;&nbsp;
                               <!--<? /*if($result_arr_com["com_class"]==5){*/ ?><img src="images/hp_1.png" alt="好评星"/><img src="images/hp_1.png" alt="好评星"/><img src="images/hp_1.png" alt="好评星"/><img src="images/hp_1.png" alt="好评星"/><img src="images/hp_1.png" alt="好评星"/><? /*}else if($result_arr_com["com_class"]==4){*/ ?><img src="images/hp_1.png" alt="好评星"/><img src="images/hp_1.png" alt="好评星"/><img src="images/hp_1.png" alt="好评星"/><img src="images/hp_1.png" alt="好评星"/><img src="images/cp_2.png" alt="差评星"/><? /*}else if($result_arr_com["com_class"]==3){*/ ?><img src="images/hp_1.png" alt="好评星"/><img src="images/hp_1.png" alt="好评星"/><img src="images/hp_1.png" alt="好评星"/><img src="images/cp_2.png" alt="差评星"/><img src="images/cp_2.png" alt="差评星"/><? /*}else if($result_arr_com["com_class"]==2){*/?><img src="images/hp_1.png" alt="好评星"/><img src="images/hp_1.png" alt="好评星"/><img src="images/cp_2.png" alt="差评星"/><img src="images/cp_2.png" alt="差评星"/><img src="images/cp_2.png" alt="差评星"/><? /*}else if($result_arr_com["com_class"]==1){*/?><img src="images/hp_1.png" alt="好评星"/><img src="images/cp_2.png" alt="差评星"/><img src="images/cp_2.png" alt="差评星"/><img src="images/cp_2.png" alt="差评星"/><img src="images/cp_2.png" alt="差评星"/><? /*}*/?>-->
                                <? 
									for($n=(5-$result_arr_com["com_class"]);$n<5;$n++){
								?>		
									<img src="images/hp_1.png" alt="好评星"/>
								<?    } 
									for($n=$result_arr_com["com_class"];$n<5;$n++){
								?>		
									<img src="images/cp_2.png" alt="差评星"/>
								<?    } ?>
                               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;评价时间：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $result_arr_com["addtime"]?></p>
                                <p><? echo $result_arr_com["comment"]?></p>
                            </td>
                        </tr>
                        <? }else{?>
                        <tr class="com_info" style="display:none">
                        	<td colspan="4">
                        	<form method="post" action="comment_deal.php">
                            	<p>请选择购物感受
                                <select name="com_class" >
                                	<option value="0" >请选择</option>
                                	<option value="1" >惨淡一星差评</option>
                                    <option value="2" >可怜两星差评</option>
                                    <option value="3" >一般般三星评</option>
                                    <option value="4" >四星略微好评</option>
                                    <option value="5" >顶级五星好评</option>
                                </select>
                                </p>
                                <textarea cols="117" rows="2" placeholder="请写出你的感受" name="comment"></textarea>
                                <p><input type="hidden" name="pro_Id" value="<? echo $result_arr_orderlist_1["aId"]?>" /><input type="hidden" name="list_Id" value="<? echo $result_arr_orderlist_1["Id"]?>" /><input type="submit" value="发表评论" /></p>
                            </form>
                            </td>
                        </tr>
                        <? }
							}
							}?>
                    </tbody>
                </table>
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