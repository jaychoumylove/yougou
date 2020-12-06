<?php include ("Include/mysql_open.php");?>
<?php include ("session_chk.php");?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>我的收货地址-个人中心-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_user_info_address.css">
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script class="resources library" src="js/area.js" type="text/javascript"></script>
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
		$("#change_address ul li").hover(function(){
			$(this).children("p").children("strong").animate({"right":"0px"},500);
		},function(){
			$(this).children("p").children("strong").animate({"right":"-60px"},500);
		})
		$("#change_address h1 span input").click(function(){
			$(".tanc").show(1000);
			qk_address();
			$("#act").val("add");
			$("#myId").val(" ");
		})
	   $("#change_address ul li p strong input").click(function(){
		  $(".tanc").show(1000);
		  $("#sh_name").val($(this).parent("strong").parent("p").siblings("p").children(".name").val());
		  $("#inp_address").val($(this).parent("strong").parent("p").siblings("p").children(".address_info").val());
		  $("#inp_pho").val($(this).parent("strong").siblings("span").children(".phonenumber").val());
		  $("#inp_ads_name").val($(this).parent("strong").parent("p").siblings("p").children(".postcode").val());
		  $("#myId").val($(this).parent("strong").parent("p").siblings(".Id").val());
		  $("#s_province").val($(this).parent("strong").parent("p").siblings("p").children("span").children(".address_province").val());
		  var address_city=$(this).parent("strong").parent("p").siblings("p").children("span").children(".address_city").val();
		  $("#s_city").append("<option class='city' value="+address_city+">"+address_city+"</option>");
		  //$("#s_city").val(address_city);
		  var address_county=$(this).parent("strong").parent("p").siblings("p").children("span").children(".address_county").val();
		  $("#s_county").append("<option class='county' value="+address_county+">"+address_county+"</option>");
		  //$("#s_county").val(address_county);
		  if($(this).parent("strong").parent("p").siblings(".ismoren").val()==1){
			  $("#ismoren").attr("checked",true);
		  }else{
			  $("#ismoren").attr("checked",false);
		  }
		  $("#act").val("update");
		  $(".add_chose").children("span").css("display","inline-block");
	   })
		$(".tanc .ads_sub .false").click(function(){
			$(".tanc").hide(1000);
			qk_address();
			$("#act").val(" ");
			$("#myId").val(" ");
			$(".add_chose").children("span").hide(1000);
		})
		$(".add_chose span").click(function(){
			$("#Id_del").val($("#myId").val());
			$(".ads_del").show(500);
		})
		$(".button").click(function(){
			$("#Id_del").val(" ");
			$(".ads_del").hide(500);
		})
		function qk_address(){
			$(".sh_name").html('收货人：<input type="text" name="name" id="sh_name" placeholder="请输入收货人" disableautocomplete="" autocomplete="off"/>');
			$(".inp_address").html('<input type="text" id="inp_address" name="address_info" placeholder="请输入详细地址" disableautocomplete="" autocomplete="off" />');
			$(".inp_pho").html('联系电话：<input type="text" id="inp_pho" name="phonenumber" placeholder="请输入联系电话号码" disableautocomplete="" autocomplete="off" />');
			$(".inp_ads_name").html('邮编：<input type="text" id="inp_ads_name" name="postcode" placeholder="请输入邮编" disableautocomplete="" autocomplete="off" />');
			$("#s_province").val(" ");
			$("#s_city").children(".city").remove();
			$("#s_city").val(" ");
			$("#s_county").children(".county").remove();
			$("#s_county").val(" ");
		}
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
                <li><a href="YG_user_comment.php" target="_blank">我的评论</a></li>
                <li><a href="YG_user_collection.php" target="_blank">我的收藏</a></li>
                <li><a href="YG_user_info.php" target="_blank">我的资料</a></li>
                <li class="hover"><a href="YG_user_info_address.php" target="_blank">收货地址</a></li>
                <li><a href="YG_user_info_password.php" target="_blank">修改密码</a></li>
            </ul>
        </div>
        <div class="con_right">
        	<ul>
            	<li><a href="YG_user_info.php" target="_blank">基本资料</a></li>
                <li class="hover"><a href="YG_user_info_address.php" target="_blank">收货地址</a></li>
                <li><a href="YG_user_info_password.php" target="_blank">修改密码</a></li>
            </ul>
            <div class="change_box">
                <form method="post" action="YG_user_deal.php" id="change_address">
                	<h1>我的地址<a href="#" target="_self"><span><input type="button" value="新增地址"></span></a></h1>
                	<ul>
                    	<?
							$sql="select * from `yg_address` where `user_Name`='".$_SESSION["user"]."' order by Id desc;";
							$result=mysql_query($sql);
							while($result_arr=mysql_fetch_array($result)){ 
						?>
                    	<li>
                        	<input type="hidden" value="<? echo $result_arr["ismoren"]?>" class="ismoren" />
                        	<input type="hidden" value="<? echo $result_arr["Id"]?>" class="Id" />
                        	<p><img src="images/u_.png" alt="收货人"/><span><? echo $result_arr["name"]?></span><input type="hidden" value="<? echo $result_arr["name"]?>" class="name" /><input type="hidden" value="<? echo $result_arr["ismoren"]?>" class="ismoren" /><? if($result_arr["ismoren"]==1){ ?>
								<span class="moren">默认</span>
							<? }?></p>
                            <p>
                                <img src="images/a_.png" alt="收货地址"/>
                                <span>&nbsp;<? echo $result_arr["address_province"]?>
                                <input type="hidden" value="<? echo $result_arr["address_province"]?>" class="address_province"/>&nbsp;
                                </span>
                                <span>&nbsp;<? echo $result_arr["address_city"]?>
                                <input type="hidden" value="<? echo $result_arr["address_city"]?>" class="address_city"/>&nbsp;
                                </span>
                                <span>&nbsp;<? echo $result_arr["address_county"]?>
                                <input type="hidden" value="<? echo $result_arr["address_county"]?>" class="address_county"/>&nbsp;
                                </span>
                            </p>
                            <p><? echo $result_arr["address_info"]?><input type="hidden" value="<? echo $result_arr["address_info"]?>" class="address_info" /><input type="hidden" value="<? echo $result_arr["postcode"]?>" class="postcode"/></p>
                            <p><img src="images/_p.png" alt="联系电话"/><span>&nbsp;&nbsp;<? echo $result_arr["phonenumber"]?><input type="hidden" value="<? echo $result_arr["phonenumber"]?>" class="phonenumber"/>&nbsp;&nbsp;</span><strong><input type="button" value="编辑"></strong></p>
                        </li>
                        <? }?>
                    </ul>
                </form>
            </div>
        </div>
    </div>
    <!--content end-->
    <div class="space_hx"></div>
    <div class="space_hx"></div>
    <div class="tanc">
    	<form action="YG_user_deal.php?act=update_address" method="post">
        	<h1>新增/编辑收货地址</h1>
            <ul>
            	<input type="hidden" value="" name="act" id="act" />
                <input type="hidden" value="" name="myId" id="myId"/>
            	<li class="sh_name">收货人：<input type="text" name="name" id="sh_name" placeholder="请输入收货人" disableautocomplete="" autocomplete="off"/></li>
                <li class="sh_address">
                	请选择地址：
                	<div class="info">
                        <div id="info_ads_chose">
                            <select id="s_province" name="s_province" disableautocomplete="" autocomplete="off"></select>&nbsp;&nbsp;
                            <select id="s_city" name="s_city" disableautocomplete="" autocomplete="off" ></select>&nbsp;&nbsp;
                            <select id="s_county" name="s_county" disableautocomplete="" autocomplete="off"></select>
                        </div>
                        <div id="show"></div>
                    </div>
                
                <!--三级联动 start-->
                    <script type="text/javascript">
                        var Gid  = document.getElementById ;
                        var showArea = function(){
                            Gid('show').innerHTML = "<h3>省" + Gid('Marquee').value + " - 市" + 	
                            Gid('s_city').value + " - 县/区" + 
                            Gid('s_county').value + "</h3>"
                                                    }
                        Gid('s_county').setAttribute('onchange','showArea()');
                    </script>
                    <!--三级联动 end-->
                
                    <script type="text/javascript">_init_area();</script>
                </li>
                <li class="inp_address"><input type="text" id="inp_address" name="address_info" placeholder="请输入详细地址" disableautocomplete="" autocomplete="off" /></li>
                <li class="inp_pho">联系电话：<input type="text" id="inp_pho" name="phonenumber" placeholder="请输入联系电话号码" disableautocomplete="" autocomplete="off" /></li>
                <li class="inp_ads_name">邮编：<input type="text" id="inp_ads_name" name="postcode" placeholder="请输入邮编" disableautocomplete="" autocomplete="off" /></li>
                <li class="add_chose">
                	<span>删除该地址</span>
                    <input id="ismoren" value="1" name="ismoren" checked="" autocomplete="off" type="checkbox" disableautocomplete="" autocomplete="off" /> 
                    <label for="ismoren">设为默认</label></li>
                <li class="ads_sub"><input class="sure" type="submit" name="sure" value="确认"/><input class="false" id="false" type="button" name="false" value="取消"/></li>
            </ul>
        </form>
    </div> 
    <div class="ads_del">
    	<form class="del_ads" method="post" action="YG_user_deal.php?act=del">
        	<input type="hidden" id="Id_del" value="" name="Id_del" />
            <h1>删除地址</h1>
            <p class="del_ts">你确定删除该地址吗？</p>
            <p class="del_bun"><input class="submit" type="submit" value="确定" /><input class="button" type="button" value="取消" /></p>
        </form>
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