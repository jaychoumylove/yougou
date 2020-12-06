<?php include ("Include/mysql_open.php");?>
<?php include ("session_chk.php");?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>我的购物车-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_shopping_cart.css">
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
  	$(document).ready(function(){
  		//加的效果 start
  		$(".jia").click(function(){
  			var prive_sigle=$(this).parent().siblings(".pre_box").children("span").text();
  			var price_min=$(this).parent().siblings(".stt_box").children("span");
  			var n=$(this).prev().val();
  			var num=parseInt(n)+1;
  			if(num==0){return;}
  			$(this).prev().val(num);
  			var pay=prive_sigle*$(this).prev().val();
  			price_min.html(pay);
  			chk_price();
  		})
  		//加的效果 end
  		//减的效果 start
  		$(".jian").click(function(){
  			var m=$(this).next().val();
  			var nun=parseInt(m)-1;
  			var prive_sigle=$(this).parent().siblings(".pre_box").children("span").text();
  			var price_min=$(this).parent().siblings(".stt_box").children("span");
  			if(nun==0){return;}
  			$(this).next().val(nun);
  			var pay=prive_sigle*$(this).next().val();
  			price_min.html(pay);
  			chk_price();
  		})
  		//减的效果 end
  		//输入购买数量变动
  		$(".many_box input").blur(function(){
  			var prive_sigle=$(this).parent().siblings(".pre_box").children("span").text();
  			var price_min=$(this).parent().siblings(".stt_box").children("span");
  			var pay=prive_sigle*$(this).val();
  			price_min.html(pay);
  			chk_price();
  		})
  		//重置选框
  		$("#checkall").attr("checked",false);
  		$(".check_li").attr("checked",false);
  		//全选 start
  		$("#checkall").click(function(){
  			var check=$(this).is(":checked");
  			$(".check_li").attr("checked",check);
  			chk_price();
  		});
  		//全选 end
  		function all(){
  			var checkbox=$(".check_li");
  			var num=checkbox.size();
  			var count=0;
  			checkbox.each(function(index,dom){
  				if($(dom).is(":checked")){
  					count++;
  				}
  			});
  			if(num==count){
  				$("#checkall").attr("checked",true);
  			}else{
  				$("#checkall").attr("checked",false);
  			}	
  			chk_price();
  		}
  		//点击事件
  		$(".check_li").click(function(){
  			all();
  			chk_price()
  		});
  		 //反选 start
  		$("#check_revsern").click(function(){
  			$(".check_li").each(function() {
                  $(this).attr("checked",!$(this).attr("checked"));
              });
  			all();
  			chk_price()
  		}) 
  		//反选 end
  		$(".SC_po").mouseenter(function(){
  			$(this).siblings().children(".jn_SC").animate({bottom:"0px"},100);
  		})
  		$(".jn_SC").parent().parent("dl").mouseleave(function(){
  			$(".jn_SC").animate({bottom:"-40px"},500);
  		})
  		//检测客户实付款
		function chk_price(){
			var price_all=0;
			var product_all=0;
			for(var i=0;i<$(".check_li").length;i++){
				if($(".check_li").eq(i).attr("checked")==true){
					$(".someId").eq(i).val($(".check_li").eq(i).val());
					var price_li=$(".check_li").eq(i).parent().siblings(".stt_box").children("span").text()*1;
					price_all=price_all+price_li;
					product_all=product_all+1;
				}else{
					$(".someId").eq(i).val("null");
				}
			}
			$(".all_chk strong").html(product_all);
			$(".all_pre strong").html(price_all);
		}
		//删除弹出框
		$(".del_bun .false").click(function(){
			$(".tanc_del").hide(500);
		})
		$(".del_sel a").click(function(){
			$(".tanc_del").show(1000);
			$("#some_act").val("del");
			$(".del_tt").html("删除所选商品");
			$(".del_con").html("你确定要删除所选商品吗？");
		})
		$(".coll_deal a").click(function(){
			$(".tanc_del").show(1000);
			$("#some_act").val("coll");
			$(".del_tt").html("移动所选商品至收藏");
			$(".del_con").html("你确定要将所选商品移动到你的收藏吗？");
		})
		/*$("#checkall").attr("checked",false);
		$(".check_li").attr("checked",false);
		$("#checkall").click(function(){
			if($("#checkall").attr("checked")==true){
				$(".check_li").attr("checked",true);
			}else{
				$(".check_li").attr("checked",false);
			}
		})
		$(".check_li").each(function() {
			$(this).click(function() {
				jisuan();
			});
		})
		function jisuan(){
			var price_all=0;
			for(var i=0;i<$(".check_li").length;i++){
				if($(".check_li").eq(i).attr("checked")==true){
					var price_li=$(".check_li").eq(i).parent().siblings(".stt_box").children("span").text()*1;
					price_all=price_all+price_li;
				}
			}
			$(".all_pre strong").html(price_all);
			$("#heji_hid").val(price_all);
		}*/
	})
</script>

</head>

<body>
	<!--top start-->
    <div class="top_content">
    	<div>
    		<div class="t_l_link"><a href="#" target="_blank"><img src="images/logo.png" alt="优购户外商城"></a><span>购物车</span></div>
            <div class="t_r_link">
            	<ul>
                	<li class="hover">购物车</li>
                    <li>填写核实订单信息</li>
                    <li>成功提交订单</li>
                </ul>
            </div>
        </div>
    </div>
    <!--top end-->
    <div class="s_c_main">
    	<div class="m_content">
            <h1>全部商品</h1>
            <form method="post" action="YG_ACK.php">
                <table>
                    <thead>
                        <tr>
                        	<th class="sel_box">&nbsp;&nbsp;&nbsp;</th>
                            <th class="prt_box">商品</th>
                            <th class="pre_box">单价</th>
                            <th class="many_box">数量</th>
                            <th class="stt_box">小计</th>
                            <th class="orn_box">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<? 
						$act=@$_GET["act"];
						$Id=@$_GET["Id"];
						$prdnum=@$_GET["prdnum"];
						$shopping_cart_Id_arr=explode(",",@$_SESSION["shopping_cart_Id"]);
						//echo $act.$Id.$prdnum.count($shopping_cart_Id_arr);
						if(@$_SESSION["shopping_cart_Id"]==""){ ?>
						<tr height="120px">
                        	<td colspan="6"><a href="YG_products.php" target="_blank">您的购物车还是空的哦！去逛逛吧</a></td
                        ></tr>
						<?	}else{
								$shopping_cart_Id_arr=explode(",",$_SESSION["shopping_cart_Id"]);
								$shopping_cart_much_arr=explode(",",$_SESSION["shopping_cart_much"]);
								$heji=0.00;
								$pageNow="";
								if(empty($_GET["pageNow"])){
									$pageNow=1;
								}else{
									$pageNow=$_GET["pageNow"];
								}
								$pageSize=5;
								$pageAll=ceil(count($shopping_cart_Id_arr)/$pageSize);
								if(empty($pageAll)){
									$pageAll=1;
								}else{
									$pageAll=ceil(count($shopping_cart_Id_arr)/$pageSize);
								}
								$pageNowage=$pageNow*5;
								if($pageNowage > count($shopping_cart_Id_arr)){
									$pageNowage=count($shopping_cart_Id_arr);
								}else{
									$pageNowage=$pageNowage;
								}
								for($i=($pageNow*5-5);$i<$pageNowage;$i++){
									$sql="select *,a.name as aname from `yg_product_class` as a join `yg_product`as b on a.Id=b.classId where b.`Id`=".$shopping_cart_Id_arr[$i];
									$result=mysql_query($sql);
									$result_arr=mysql_fetch_array($result);
									$xiaoji=$result_arr["yg_price"]*$shopping_cart_much_arr[$i];
									$heji+=$xiaoji;
						?>
                    	<tr class="space_hx tr_h_sp">
                        	<td colspan="1">&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                        	<td class="sel_box"><input type="checkbox" checked="" class="check_li" name="proId[]" value="<? echo $result_arr["Id"]?>" /></td>
                            <td class="prt_box">
                                <a href="YG_product_info.php?Id=<? echo $result_arr["Id"]?>" target="_blank">
                                	<img src="<? echo $result_arr["product_img"]?>" alt="<? echo $result_arr["name"]?>" style="width:80px; height:80px; overflow:hidden; vertical-align:middle;" />
                                    <ul>
                                    	<li><? echo $result_arr["name"]?></li><br/><br/>
                                    	<li><? echo $result_arr["aname"]?></li>
                                    </ul>
                                </a>
                            </td>
                            <td class="pre_box">￥&nbsp;&nbsp;<span><? echo $result_arr["yg_price"]?></span></td>
                            <?
								if($act=="changenum"){
									if($prdnum<=0){
										$prdnum=1;
										echo "<script>window.location.href='YG_shopping_cart.php?pageNow=".$pageNow."';alert('宝贝数量最小为1哦！');</script>";
									}
									if($Id==$shopping_cart_Id_arr[$i]){
										if($prdnum<=$result_arr["stock"]){
											$shopping_cart_much_arr[$i]=$prdnum;
										}else{
											echo "<script>window.location.href='YG_shopping_cart.php?pageNow=".$pageNow."';alert('没有库存啦！！');</script>";
										}
									}
								}
							?>
                            <td class="many_box">
                                <a class="jian" href="?act=changenum&Id=<? echo $result_arr["Id"]?>&prdnum=<? echo $shopping_cart_much_arr[$i]-1;?>&pageNow=<? echo $pageNow;?>">-</a>
                                <input type="text" value="<? echo $shopping_cart_much_arr[$i] ?>" onChange="window.location.href='?pageNow=<? echo $pageNow;?>&act=changenum&Id=<? echo $result_arr["Id"]?>&prdnum='+this.value" disableautocomplete="" autocomplete="off" />
                                <a class="jia" href="?pageNow=<? echo $pageNow;?>&act=changenum&Id=<? echo $result_arr["Id"]?>&prdnum=<? echo $shopping_cart_much_arr[$i]+1;?>">+</a>
                            </td>
                            <td class="stt_box">￥&nbsp;&nbsp;<span><? echo $xiaoji ?></span></td>
                            <td class="orn_box">
                            	<p><a href="shopping_cart_deal.php?act=del&Id=<? echo $result_arr["Id"]?>"><span class="del_li">删除</span></a></p>
                                <p><a href="collection_deal.php?act=add&pro_Id=<? echo $result_arr["Id"]?>&gwc=gwc&sess_Id=<? echo $i;?>" target="_self">移到我的收藏</a></p>
                            </td>
                        </tr>
                        <? 
							}
							$shopping_cart_Id_str=implode(",",$shopping_cart_Id_arr);
							$_SESSION["shopping_cart_Id"]=$shopping_cart_Id_str;
							$shopping_cart_much_str=implode(",",$shopping_cart_much_arr);
							$_SESSION["shopping_cart_much"]=$shopping_cart_much_str;
						}
						?>
                    </tbody>
                </table>
                <? if(@$_SESSION["shopping_cart_Id"]==""){ 
					echo "<!--";
				}?>
                <ul class="page">
               <? if($pageNow==1){?>
                    <li>首页</li>
                    <li>上一页</li>
               <? }else{?>
                    <li><a href="?pageNow=1" target="_self">首页</a></li>
                    <li><a href="?pageNow=<? echo $pageNow-1;?>" target="_self">上一页</a></li>
               <? }?>
                    <li class="now_page"><? echo $pageNow;?>&nbsp;&nbsp;/&nbsp;&nbsp;<? echo $pageAll;?></li>
               <? if($pageNow==$pageAll){ ?>
                    <li>下一页</li>
                    <li>尾页</li>
               <? }else{?>
                    <li><a href="?pageNow=<? echo $pageNow+1 ;?>" target="_self">下一页</a></li>
                    <li><a href="?pageNow=<? echo $pageAll;?>" target="_self">尾页</a></li>
               <? }?>
                </ul>
                <? if(@$_SESSION["shopping_cart_Id"]==""){ 
					echo "-->";
				}?>
                <div class="space_hx"></div>
        		<div class="space_hx"></div>
                <ul class="S_order">
                	<li><input type="checkbox" checked="" id="checkall" name="checkall" value="全选" /><label for="checkall" class="all_n">全选</label>&nbsp;&nbsp;&nbsp;</li>
                	<li><input type="button" id="check_revsern" name="check_revsern" value="反选" /></li><!---->
                	<li><span class="del_sel"><a href="shopping_cart_deal.php?act=clear" target="_self">清空购物车</a></span></li>
                    <li class="del_sel"><a>删除所选商品</a></li>
                    <li class="coll_deal"><a>将所选商品移到我的收藏</a></li>
                    <li><span class="all_chk">已选中[&nbsp;&nbsp;<strong>0</strong>&nbsp;&nbsp;]件商品</span></li><!---->
                    <li><span class="all_pre">合计:&nbsp;&nbsp;￥&nbsp;&nbsp;<strong>0</strong>&nbsp;&nbsp;</span><input type="hidden" value="" name="heji_hid" id="heji_hid" /></li>
                    <li><input type="submit" id="go_Settlement" value="去结算"/></li>
                </ul>
            </form>
            <div class="space_hx"></div>
            <div class="G_y_l">
                <h1>猜你喜欢</h1>
                <? 	$sql_gyl="select * from `yg_product` order by `sales_vol` desc limit 5"; 
					$result_gyl=mysql_query($sql_gyl);
					while($result_arr_gyl=mysql_fetch_array($result_gyl)){ ?>		
					<dl>
                        <a class="SC_po" href="YG_product_info.php?Id=<? echo $result_arr_gyl["Id"]?>" target="_blank">
                            <dt><img src="<? echo $result_arr_gyl["product_img"]?>" style="width:224px; height:224px;" alt=""></dt>
                            <dd><? echo $result_arr_gyl["name"]?></dd>
                            <dd class="pay_for">￥&nbsp;&nbsp;<? echo $result_arr_gyl["yg_price"]?><span>已售：&nbsp;&nbsp;<strong><? echo $result_arr_gyl["sales_vol"]?></strong></span></dd>
                        </a> 
                        <a href="shopping_cart_deal.php?act=add&Id=<? echo $result_arr_gyl["Id"]?>" target="_blank"><div class="jn_SC">加入购物车</div></a>
                    </dl>
				<? }?>
                <!--一共展示5件商品-->
            </div>
        </div>
        <div class="space_hx"></div>
        <div class="space_hx"></div>
    </div>
    <div class="tanc_del">
    	<div class="del_box">
        	<form action="shopping_cart_deal.php?act=deal_some" method="post">
            <? for($j=(@$pageNow*5-5);$j<@$pageNowage;$j++){ ?>
            	<input type="hidden" name="someId[]" value="null" class="someId" />
            <? } ?>
            	<input name="act" value="" type="hidden" id="some_act"/>
                <h1 class="del_tt">删除所选商品</h1>
                <div class="del_con">你确定要删除所选商品吗？</div>
                <div class="del_bun"><input class="ture" type="submit" value="确定"><input class="false" type="button" value="取消"></div>
            </form>
        </div>
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