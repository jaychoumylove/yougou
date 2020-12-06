<?php include ("Include/mysql_open.php");?>
<?php include ("session_chk.php");?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>我的收藏-个人中心-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_user_collection.css">
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
		$(".my_coll dl").hover(function(){
			$(this).children("a").children(".qx_SC").animate({bottom:"10px"},500);
		},function(){
			$(this).children("a").children(".qx_SC").animate({bottom:"-40px"},500);
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
                <li><a href="YG_user_order.php" target="_blank">我的订单</a></li>
                <li><a href="YG_user_comment.php" target="_blank">我的评论</a></li>
                <li class="hover"><a href="YG_user_collection.php" target="_blank">我的收藏</a></li>
                <li><a href="YG_user_info.php" target="_blank">我的资料</a></li>
                <li><a href="YG_user_info_address.php" target="_blank">收货地址</a></li>
                <li><a href="YG_user_info_password.php" target="_blank">修改密码</a></li>
            </ul>
        </div>
        <div class="con_right">
            <div class="recent_orders">
            	<h1>我的收藏</h1>
                <div class="my_coll">
                <? 
					$sql="select *,a.Id as aId from `yg_farite` as a join `yg_product` as b on a.`pro_Id`=b.`Id` where a.`userName`='".$_SESSION["user"]."' order by a.`addtime` desc"; 
					$result=mysql_query($sql);
					$rows_num=mysql_num_rows($result);
					if($rows_num==""){
						echo "<p style='height:120px; line-height:120px; font-size:18px; text-align:center;'><a href='YG_products.php'>您还没有收藏的商品哦，去逛逛吧！</a></p>";
					}else{
					while($result_arr=mysql_fetch_array($result)){
                ?>
                	<dl>
                        <a class="SC_po" href="YG_product_info.php?Id=<? echo $result_arr["Id"]?>" target="_blank">
                            <dt><img src="<? echo $result_arr["product_img"]?>" style="width:224px; height:224px;" alt="<? echo $result_arr["name"]?>"></dt>
                            <dd><? echo $result_arr["name"]?></dd>
                            <dd class="pay_for">￥&nbsp;&nbsp;<? echo $result_arr["yg_price"]?><span>已售：&nbsp;&nbsp;<strong><? echo $result_arr["sales_vol"]?></strong></span></dd>
                        </a> 
                        <a href="collection_deal.php?act=del&Id=<? echo $result_arr["aId"]?>" target="_blank"><div class="qx_SC">取消收藏</div></a>
                    </dl>
                <? 
				}
				} ?>
                </div>
            </div>
            <div class="space_hx"></div>
    		<div class="space_hx"></div>
            <div class="G_y_l">
                <h1>猜你喜欢</h1>
                <?
					$sql_gyl="select * from `yg_product` order by `sales_vol` desc limit 4"; 
					$result_gyl=mysql_query($sql_gyl);
					while($result_arr_gyl=mysql_fetch_array($result_gyl)){
				?>		
					<dl>
                        <a class="SC_po" href="YG_product_info.php?Id=<? echo $result_arr_gyl["Id"]?>" target="_blank">
                            <dt><img src="<? echo $result_arr_gyl["product_img"]?>" style="width:224px; height:224px;" alt=""></dt>
                            <dd><? echo $result_arr_gyl["name"]?></dd>
                            <dd class="pay_for">￥&nbsp;&nbsp;<? echo $result_arr_gyl["yg_price"]?><span>已售：&nbsp;&nbsp;<strong><? echo $result_arr_gyl["sales_vol"]?></strong></span></dd>
                        </a> 
                        <a href="shopping_cart_deal.php?act=add&Id=<? echo $result_arr_gyl["Id"]?>" target="_blank"><div class="jn_SC">加入购物车</div></a>
                    </dl>
				<? }?>
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