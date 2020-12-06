<?php include ("Include/mysql_open.php");?>
<?php include ("session_chk.php");?>
<?
	$Id_str="";
	$Id_arr=array();
	if(@$_GET["Id_str_i"]){
		$Id_str=@$_GET["Id_str_i"];
		$Id_arr=@explode(",",$Id_str);
	}else{
		$Id_arr=@$_POST["proId"];
		$Id_str=@implode(",",$Id_arr);
	}
	if($Id_arr==""){
		exit("<script>window.location.href='YG_shopping_cart.php';alert('请勾选您要购买的商品！');</script>");
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>填写核实订单信息-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_ACK.css">
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script class="resources library" src="js/area.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
        /*$(".ads_other").click(function(){
			if($(this).children("span").html()=="展开地址"){
				$(this).siblings("ul").children("li").slideDown(500);
				$(this).children("span").html("收起地址");
				$(this).children("img").attr("src","images/sl.png");
			}else{
				$(this).siblings("ul").children("li").slideUp(500);
				$(this).siblings("ul").children(".selected").show();
				$(this).children("span").html("展开地址");
				$(this).children("img").attr("src","images/xl.png");
			}
		})*/
		$(".consignee_info h1 input,.t_info,.ads_Change input").click(function(){
			$(".tanc").show(1000);
		})
		$(".tanc .ads_sub .false").click(function(){
			$(".tanc").hide(1000);
		})
		$(".consignee_info ul li").click(function(){
			$.ajax({
				type:"get",
				url:"ajax_chk_ads.php",
				data:"Id="+$(this).children(".u_name").children(".ads_Id").val(),
				success: function(d){
					$("#ads_sel").html(d);
				}
			})
			$(this).addClass("selected").siblings().removeClass("selected");
		})
		$(".shipping li input,.shipping li label").click(function(){
			$(this).parent().addClass("selected").siblings().removeClass("selected");
		})
		$(".payment ul li input,.payment ul li label").click(function(){
			$(this).parent().addClass("selected").siblings().removeClass("selected");
		})
		$(".consignee_info h1 input,.t_info").click(function(){ //新增地址
			$(".tanc").show(1000);
			qk_address();
			$("#act_add").val("add");
			$("#myId").val(" ");
		})
		$(".false").click(function(){ //取消编辑、新增地址
			$(".tanc").hide(1000);
			qk_address();
			$("#act_add").val(" ");
			$("#myId").val(" ");
			$(".add_chose").children("span").hide(1000);
		})/**/
		$(".add_chose span").click(function(){ //删除地址
			$("#Id_del").val($("#myId").val());
			$(".ads_del").show(500);
		})
		$(".button").click(function(){ //取消删除地址
			$("#Id_del").val(" ");
			$(".ads_del").hide(500);
		})
		function qk_address(){  //清空弹出窗
			$(".sh_name").html('收货人：<input type="text" name="name" id="sh_name" placeholder="请输入收货人" disableautocomplete="" autocomplete="off" />');
			$(".inp_address").html('<input type="text" id="inp_address" name="address_info" placeholder="请输入详细地址" disableautocomplete="" autocomplete="off" />');
			$(".inp_pho").html('联系电话：<input type="text" id="inp_pho" name="phonenumber" placeholder="请输入联系电话号码" disableautocomplete="" autocomplete="off" />');
			$(".inp_ads_name").html('邮编：<input type="text" id="inp_ads_name" name="postcode" placeholder="请输入邮编" disableautocomplete="" autocomplete="off" />');
			$("#s_province").val(" ");
			$("#s_city").children(".city").remove();
			$("#s_city").val(" ");
			$("#s_county").children(".county").remove();
			$("#s_county").val(" ");
		}
	   $(".consignee_info ul li .ads_Change input").click(function(){
		  $(".tanc").show(1000);
		  $("#sh_name").val($(this).parent(".ads_Change").siblings(".u_address").children(".shr_name").val());
		  $("#inp_address").val($(this).parent(".ads_Change").siblings(".u_address").children(".address_info").val());
		  $("#inp_pho").val($(this).parent(".ads_Change").siblings(".u_address").children(".phonenumber").val());
		  $("#inp_ads_name").val($(this).parent(".ads_Change").siblings(".u_address").children(".postcode").val());
		  $("#myId").val($(this).parent(".ads_Change").siblings(".u_name").children(".ads_Id").val());
		  $("#s_province").val($(this).parent(".ads_Change").siblings(".u_address").children(".address_province").val());
		  var address_city=$(this).parent(".ads_Change").siblings(".u_address").children(".address_city").val();
		  $("#s_city").append("<option class='city' value="+address_city+">"+address_city+"</option>");
		  $("#s_city").val(address_city);
		  var address_county=$(this).parent(".ads_Change").siblings(".u_address").children(".address_county").val();
		  $("#s_county").append("<option class='county' value="+address_county+">"+address_county+"</option>");
		  $("#s_county").val(address_county);
		  $("#ismoren").attr("checked",true);
		  $("#act_add").val("update");
		  $(".add_chose").children("span").css("display","inline-block");
	   })
    });
</script>
</head>

<body>
	<!--top start-->
    <div class="top_content">
    	<div>
    		<div class="t_l_link"><a href="#" target="_blank"><img src="images/logo.png" alt="优购户外商城"></a><span>填写核实订单信息</span></div>
            <div class="t_r_link">
            	<ul>
                	<li>购物车</li>
                    <li>填写核实订单信息</li>
                    <li class="hover">成功提交订单</li>
                </ul>
            </div>
        </div>
    </div>
    <!--top end-->
    <div class="ACK_main">
    	<form method="post" action="order_deal.php?act=add">
    	<div class="m_content">
            <h1>填写核实订单信息<input type="hidden" value="<? echo $ordernum=date("YmdHis").mt_rand(100000,999999)?>" name="ordernum"  /></h1>
            <div class="consignee_info">
            	<h1>收货人信息<input type="button" value="新增收货地址"></h1><!---->
                
            	<ul>
                <? 
					$sql_ad="select * from `yg_address` where `user_Name` ='".$_SESSION["user"]."' ;";
					$result_ad=mysql_query($sql_ad);
					$rows_num_ad=mysql_num_rows($result_ad);
					$heji=0.00;
					if($rows_num_ad==""){ ?>
                    <li><div class="t_info">无地址，请先添加收货地址！</div></li>
                <?
					}else{
						while($result_arr_ad=mysql_fetch_array($result_ad)){
				?>
                	<li class="<? if($result_arr_ad["ismoren"]=="1"){
						echo "selected";
					}?> clearfix">
                    	<div class="u_name"><? echo $result_arr_ad["name"]?>
                        <input type="hidden" value="<? echo $result_arr_ad["ismoren"]?>" class="ismoren" />
                        <input type="hidden" value="<? echo $result_arr_ad["Id"]?>" class="ads_Id"  />
                        </div>
                        <div class="u_address">
                        	<span><? echo $result_arr_ad["name"]?></span>
                            <input type="hidden" value="<? echo $result_arr_ad["name"]?>" class="shr_name"/>
                            <span><? echo $result_arr_ad["address_province"]?>&nbsp;&nbsp;<? echo $result_arr_ad["address_city"]?>&nbsp;&nbsp;<? echo $result_arr_ad["address_county"]?></span>
                            <input type="hidden" value="<? echo $result_arr_ad["address_province"]?>" class="address_province" />
                            <input type="hidden" value="<? echo $result_arr_ad["address_city"]?>" class="address_city" />
                            <input type="hidden" value="<? echo $result_arr_ad["address_county"]?>" class="address_county" />
                            <span><? echo $result_arr_ad["address_info"]?></span>
                            <input type="hidden" value="<? echo $result_arr_ad["address_info"]?>" class="address_info" />
                            <span><? echo $result_arr_ad["phonenumber"]?></span>
                            <input type="hidden" value="<? echo $result_arr_ad["phonenumber"]?>" class="phonenumber" />
                            <input type="hidden" value="<? echo $result_arr_ad["postcode"]?>" class="postcode" />
                        </div>
                        <div class="ads_Change">
                        	<input type="button" value="编辑"><!--<a href="#" target="_self">编辑</a>-->
                        </div>
                    </li>
                <? 		}
					}?>
                </ul>
                <!--<div class="ads_other"><span>展开地址</span><img src="images/xl.png" alt="..."></div>-->
            </div>
            <div class="space_hx"></div>
            <div class="payment">
            	<h1>支付方式</h1>
            	<ul>
                	<li class="selected"><input type="radio" value="0" id="0_pay" name="pay_ment" checked="true" /> <label for="0_pay">账户余额</label></li>
                    <li><input type="radio" value="1" name="pay_ment" id="1_pay" /><label for="1_pay">货到付款</label></li>
                    <!--<li>其他方式</li>-->
                </ul>
            </div>
            <div class="space_hx"></div>
            <div class="shipping_met">
            	<h1>配送/清单</h1>
            	<ul class="shipping">
                	<h1>配送方式</h1>
                	<li class="selected"><input type="radio" value="0" id="0_ship" name="ship_ment" checked="true" /> <label for="0_ship">快速配送</label></li>
                    <li><input type="radio" value="1" name="ship_ment" id="1_ship" /><label for="1_ship">顺丰快递</label></li>
                </ul>
                <div class="listing clearfix">
                	<? 
						$shopping_cart_Id_arr=explode(",",$_SESSION["shopping_cart_Id"]);
						$shopping_cart_much_arr=explode(",",$_SESSION["shopping_cart_much"]);
						$much="";
						 for($n=0;$n<count($Id_arr);$n++){
							 $sql_pro="select *,a.name as aname from `yg_product_class` as a join `yg_product`as b on a.Id=b.classId where b.`Id`=".$Id_arr[$n];
							 for($i=0;$i<count($shopping_cart_Id_arr);$i++){
								 if($Id_arr[$n]==$shopping_cart_Id_arr[$i]){
									 $much=$shopping_cart_much_arr[$i];
							 	}
							 }
							 $result_pro=mysql_query($sql_pro);
							while($result_arr_pro=mysql_fetch_array($result_pro)){
					?>
                	<div class="goods">
                    	<img src="<? echo $result_arr_pro["product_img"]?>" style="height:80px; width:80px; vertical-align:middle; overflow:hidden;" alt="<? echo $result_arr_pro["name"]?>" /><input type="hidden" value="<? echo $result_arr_pro["Id"];?>" name="Id_hid[]" />
                        <ul>
                            <li><? echo $result_arr_pro["name"]?></li><br/><br/>
                            <li><? echo $result_arr_pro["aname"]?></li>
                        </ul>
                    </div>
                    <div class="gds_price">
                    	￥&nbsp;&nbsp;<span><? echo $result_arr_pro["yg_price"]?></span>
                    </div>
                    <div class="gds_many">
                    	*&nbsp;&nbsp;<span><? echo $much?></span>
                    </div>
                    <? 
						$xiaoji=$result_arr_pro["yg_price"]*$much;
						$heji+=$xiaoji;
					?>
                    <input type="hidden" value="<? echo $xiaoji?>" name="xiaoji" />
                    <? }
						 }?>
                </div>
            </div>
            <div class="space_hx"></div>
            <div class="o_notes">
            	备注：<textarea cols="70" rows="3" placeholder="选填，对本次交易的说明（建议填写与卖家协商一致的内容）。" name="ment"></textarea>
            </div>
            <div class="statistic">
            	<p><span><!--一共<strong>&nbsp;1&nbsp;</strong>件商品，-->商品总金额：</span><strong>￥&nbsp;&nbsp;<? echo $heji?></strong></p>
                <p><span>运费：</span><strong>￥&nbsp;&nbsp;0.00</strong></p>
            </div>
            <div class="pay_info">
            	<p><span>应付总额：</span><strong>￥&nbsp;&nbsp;<? echo $heji?><input type="hidden" value="<? echo @$heji;?>" name="heji_hid" /</strong></p>
                <p id="ads_sel">请确认收货地址</p>
            </div>
            <div class="space_hx"></div>
            <div class="sum_order">
            	<input type="hidden" value="<?
				$proid_str=implode(",",$Id_arr);
				 echo  $proid_str?>" name="proid"/>
            	<input type="submit" value="提交订单"/><!--<a href="" target="_blank">提交订单</a>-->
            </div>
        </div>    
        </form>
        <div class="space_hx"></div>
    </div>
    <div class="tanc">
    	<form action="order_deal.php?act=update_address&Id_str=<? echo $Id_str?>&heji=<? echo $heji?>" method="post">
        	<h1>新增/编辑收货地址</h1>
            <ul>
            	<input type="hidden" value="" name="act_add" id="act_add" />
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
                    <label for="ismoren">设为默认</label>
                </li>
                <li class="ads_sub"><input class="sure" type="submit" name="sure" value="确认"/><input class="false" id="false" type="button" name="false" value="取消"/></li>
            </ul>
        </form>
    </div> <!---->   
    <div class="ads_del">
    	<form class="del_ads" method="post" action="order_deal.php?act=deladdress&Id_str=<? echo $Id_str?>&heji=<? echo $heji?>">
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
