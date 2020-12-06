<?php include ("Include/mysql_open.php");?>
<?php include ("session_chk.php");?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>我的资料-个人中心-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_user_info.css">
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
		$(".c_phone .chg_box").blur(function(){
			var phone=$(this).val();
			if(phone==""){
				$(this).siblings("i").html("清空左边可重置哦！");
			   return true;
			}
			var reg=/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
			if(reg.test(phone)){
			  $(this).siblings("i").html("通过！").addClass("ok").removeClass("no");
			   return true;
		   }else{
			   $(this).siblings("i").html("格式不对哦！").addClass("no").removeClass("ok");
			   return false;			   
		   }
		})
		$(".c_email .chg_box").blur(function(){
			var email=$(this).val();
			if(email==""){
				$(this).siblings("i").html("清空左边可重置哦！");
			   return true;
			}
			var reg=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
			if(reg.test(email)){
			  $(this).siblings("i").html("通过！").addClass("ok").removeClass("no");
			   return true;
		   }else{
			   $(this).siblings("i").html("格式不对哦！").addClass("no").removeClass("ok");
			   return false;	   
		   }
		})
		$(".file_sty").click(function(){
			$(this).next().click();
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
                <li><a href="YG_user_collection.php" target="_blank">我的收藏</a></li>
                <li class="hover"><a href="YG_user_info.php" target="_blank">我的资料</a></li>
                <li><a href="YG_user_info_address.php" target="_blank">收货地址</a></li>
                <li><a href="YG_user_info_password.php" target="_blank">修改密码</a></li>
            </ul>
        </div>
        <div class="con_right">
        	<ul>
            	<li class="hover"><a href="YG_user_info.php" target="_blank">基本资料</a></li>
                <li><a href="YG_user_info_address.php" target="_blank">收货地址</a></li>
                <li><a href="YG_user_info_password.php" target="_blank">修改密码</a></li>
            </ul>
            <div class="change_box">
            	<? 
					$sql="select * from `yg_user` where `user`='".$_SESSION["user"]."';";
					$result=mysql_query($sql);
					$result_arr=mysql_fetch_array($result);
				?>
            	<form method="post" action="YG_user_deal.php?act=update_info" id="change_info" enctype="multipart/form-data">
                	<ul>
                    	<li class="c_nickname">
                        	<span>昵称：</span><strong><input type="text" name="name"  placeholder="<?
							if($result_arr["name"]==""){
								echo $result_arr["user"];
							}else{
								echo $result_arr["name"];
							}
							 ?>"/></strong>
                             <input type="hidden" value="<? echo $result_arr["Id"];?>" name="myId" />
                             <input type="hidden" value="<? echo $result_arr["name"];?>" name="name_hdn" />
                        </li>
                        <li class="c_sex">
                        	<span>性别：</span><strong>
                            <? if($result_arr["sex"]=="1"){?>
                            <input id="u_sex_man" value="1" name="sex" checked="checked" autocomplete="off" type="radio"> 
                            <label for="u_sex_man">男</label>
                            <input id="u_sex_woman" value="0" name="sex" autocomplete="off" type="radio"> 
                            <label for="u_sex_woman">女</label>
                            <? }else{?>
                            <input id="u_sex_man" value="1" name="sex" autocomplete="off" type="radio"> 
                            <label for="u_sex_man">男</label>
                            <input id="u_sex_woman" value="0" name="sex" checked="checked" autocomplete="off" type="radio"> 
                            <label for="u_sex_woman">女</label>
                            <? } ?>
                        </li>
                        <li class="c_phone">
                        	<span>手机号码：</span><strong><input class="chg_box" type="tel" name="phone" placeholder="<? echo $result_arr["phone"]?>" disableautocomplete="" autocomplete="off"/><i>清空左边可重置哦</i></strong><input type="hidden" value="<? echo $result_arr["phone"]?>" name="phone_hdn"/>
                        </li>
                        <li class="c_email">
                        	<span>email：</span><strong><input class="chg_box" type="text" name="email" placeholder="<? echo $result_arr["email"]?>" disableautocomplete="" autocomplete="off"/><i>清空左边可重置哦</i></strong><input type="hidden" value="<? echo $result_arr["email"]?>" name="email_hdn"/>
                        </li>
                        <li class="c_h_p">
                        	<img src="
                           <? if($result_arr["head_tx"]==""){ ?>
								images/headetx-1.png
							<? }else{
								echo $result_arr["head_tx"];
							}?>
                           " alt="用户头像"  style="width:130px; height:130px;"/><br/>
                            <input type="button" name="file" class="file_sty" value="浏览..."/><!---->
                            <input type="file" name="txUpload" class="file_mr" />
                            <input type="hidden" value="<? echo $result_arr["head_tx"];?>" name="file_hidden" />
                            <input type="hidden" value="<? echo $result_arr["head_tx_admin"];?>" name="file_admin_hidden" />
                        </li>
                    </ul>
                    <input class="sub" type="submit" value="确认修改" />
                </form>
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