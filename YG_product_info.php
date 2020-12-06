<?php 
	include ("Include/mysql_open.php");
	$Id=@$_GET["Id"];
	if($Id==""){
		exit("<script>alert('您尚未选择商品哦，去逛逛吧！');window.location.href='YG_products.php'</script>");
	}
	$sql="select * from `yg_product` where `Id` =".$Id;
	$result=mysql_query($sql);
	$result_arr=mysql_fetch_array($result);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>产品详情-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_product_info.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="JS/jquery.imagezoom.min.js"></script>
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
		//左侧分类 特效 start
		$(".all_link div").each(function(n){
			$(this).mouseenter(function(){
				var dw_top=-(n*42)+"px";
				/*alert(dw_top);*/
				$(this).children("ul").animate({'top':dw_top});
				$(this).children("ul").fadeIn().parent("div").siblings("div").children("ul").fadeOut();
			})
			$(this).mouseleave(function(){
				$(this).children("ul").fadeOut();
			})
		})
		//左侧分类 特效 end
		//伪淘宝放大镜特效 start
		$(".sw_pt").imagezoom();
		$(".pt_lt li .pt_bn a").mouseover(function(){
			$(this).parents(".pt_bn").parents("li").addClass("l_selected").siblings().removeClass("l_selected");
			$(".sw_pt").attr('src',$(this).find("img").attr("mid"));
			$(".sw_pt").attr('rel',$(this).find("img").attr("big"));
		});
		//伪淘宝放大镜特效 end
		//加的效果 start
		$(".T_n_o .jia").click(function(){
			var n=$(this).prev().val();
			var num=parseInt(n)+1;
			if(num>$("#stock").val()){alert("宝贝数量太多啦，库存不够哦！！"); num=$("#stock").val();}
			$(this).prev().val(num);
		})
		//加的效果 end
		$(".many").change(function(){
			if($(this).val()>$("#stock").val()){
				$(this).val()=$("#stock").val();
				alert("宝贝数量太多啦，库存不够哦！！");
			}
			if($(this).val()<1){
				$(this).val()=1;
				alert("宝贝数量最小为1哦！！");
			}
		})
		//减的效果 start
		$(".T_n_o .jian").click(function(){
			var m=$(this).prev().prev().val();
			var nun=parseInt(m)-1;
			if(nun==0){alert("宝贝数量最小为1哦！！"); nun=1;}
			$(this).prev().prev().val(nun);
		})
		//减的效果 end
		//鼠标进入分享淡入淡出特效 start
		$(".pt_share").hover(function(){
			$(".se_list").show(1000);
		},function(){
			$(".se_list").hide(1000);
		});
		//鼠标进入分享淡入淡出特效 end
		//滑动门特效 start
		$(".rt_te li").each(function(i){
			$(this).click(function(){
				$(this).addClass("selected").siblings().removeClass("selected");
				$(".rt_box").children("div:eq("+i+")").slideDown(500).siblings().slideUp(500);
			})
		})
		//滑动门特效 end
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
        <div class="space_hx"></div>
        <div class="space_hx"></div>    
        <ul class="top_content">
            <li class="logo clearfix"><a href="YG_index.php" target="_self"><img src="images/logo.png" alt="优购户外商城"></a></li>
            <li class="search clearfix">
                <form method="post" action="YG_products.php?act=search">
                    <input class="sea_sr" type="text" placeholder="滑雪杖" name="search"/>
                    <input class="sea_sm" type="submit" value=""/>
                </form>
                <a href="#" target="_blank">热搜词</a>
                <a href="#" target="_blank">热搜词</a>
                <a href="#" target="_blank">热搜词</a>
                <a href="#" target="_blank">热搜词</a>
            </li>
            <li class="SCt clearfix">
                <a href="YG_shopping_cart.php" target="_blank"><img src="images/gwc_red.png" alt="购物车">购物车</a>
            </li>
        </ul>
        <div class="space_hx"></div>
    </div>
    <!--top end-->
    <!--nav start-->
    <div class="nav">
        <ul>
            <li class="all">
            	<div class="all_list"><a href="YG_products.php" target="_blank"><img src="images/all.png" alt="all"><strong>所有产品分类</strong></a></div>
                <div class="all_link">
                	<? 
						$sql_a_l="select * from `yg_product_class` where `parentId`=0 ";
						$result_a_l=mysql_query($sql_a_l);
						while($result_arr_a_l=mysql_fetch_array($result_a_l)){
					?>
                    <div>
                        <a href="YG_products.php?classId=<? echo $result_arr_a_l["Id"]?>" target="_blank"><? echo $result_arr_a_l["name"]?></a>
                        <ul class="clearfix">
                        <?
							 $sql_a_k="select * from `yg_product_class` where `parentId`= '".$result_arr_a_l["Id"]."' ";
							$result_a_k=mysql_query($sql_a_k);
							while($result_arr_a_k=mysql_fetch_array($result_a_k)){
						?>
                        	<li>
                                <a href="YG_products.php?classId=<? echo $result_arr_a_k["Id"]?>" target="_blank"><? echo $result_arr_a_k["name"]?></a>
                            </li>
                        <? }?>
                        </ul>
                    </div>
                    <? } ?>
                </div>
            </li>
            <li class="hover"><a href="#" target="_blank"><strong>首页</strong></a></li>
            <li><a href="YG_products.php" target="_blank"><strong>产品中心</strong></a></li>
            <li><a href="#" target="_blank"><strong>特惠专区</strong></a></li>
            <li><a href="#" target="_blank"><strong>会员中心</strong></a></li>
            <li><a href="YG_newsllist.php" target="_blank"><strong>企业资讯</strong></a></li>
        </ul>
    </div>
    <!--nav end-->
    <div class="space_hx"></div>
    <!--up start-->
    <div class="P_I_up">
    	<div class="up_lt">
            <div class="pt_show">
            <? 
				$show_img_arr=explode(",",$result_arr["show_img"]);
			?>
                <img src="<? echo $show_img_arr[0]?>" style="width:350px; height:350px; overflow:hidden; vertical-align:middle;opacity:1" alt="<? echo $result_arr["name"]?>" rel="<? echo $show_img_arr[0]?>" class="sw_pt"/>
            </div>
            <div class="space_hx"></div>
            <div class="space_hx"></div>
            <ul class="pt_lt" id="pt_list">
                <li class="l_selected"><div class="pt_bn"><a><img src="<? echo $show_img_arr[0]?>" mid="<? echo $show_img_arr[0]?>" big="<? echo $show_img_arr[0]?>" alt="<? echo $result_arr["name"]?>" style="width:50px; height:50px; overflow:hidden; vertical-align:middle;"></a></div></li>
                <? for( $i=1;$i<5;$i++){?>
                <li><div class="pt_bn"><a><img src="<? echo $show_img_arr[$i]?>" mid="<? echo $show_img_arr[$i]?>" big="<? echo $show_img_arr[$i]?>" alt="<? echo $result_arr["name"]?>" style="width:50px; height:50px; overflow:hidden; vertical-align:middle;"></a></div></li>
                <? }?>
            </ul>
        </div>
    	<div class="up_rt">
            <div class="space_hx"></div>
        	<h1><strong><? echo $result_arr["name"]?></strong></h1>
        	<div class="rt_info">
                <ul>
                    <li class="li_01">市场价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>￥&nbsp;&nbsp;&nbsp;&nbsp;<? echo $result_arr["machete_price"]?></span></li>
                    <li class="li_02">优购价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>￥&nbsp;&nbsp;&nbsp;&nbsp;<? echo $result_arr["yg_price"]?></span></li>
                    <li class="li_02">支&nbsp;&nbsp;&nbsp;持&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>货到付款</strong></li>
                </ul>
            </div>
            <div class="space_hx"></div>
            <div class="sales">
                <div class="freight">运&nbsp;&nbsp;&nbsp;费&nbsp;&nbsp;&nbsp;&nbsp;广东深圳 至 长沙&nbsp;&nbsp;&nbsp;&nbsp;快递：<span>￥&nbsp;&nbsp;0.00</span></div>
                <div class="space_hx"></div>
                <? 
					$sql_com_l="select * from `yg_comment` where `pro_Id`='".$Id."' order by Id desc";
					$result_com_l=mysql_query($sql_com_l);
					$rows_num_l=mysql_num_rows($result_com_l);
				?>
                <div class="comments">销&nbsp;&nbsp;&nbsp;量&nbsp;&nbsp;&nbsp;&nbsp;<span>&nbsp;&nbsp;<? echo $result_arr["sales_vol"]?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;评价累计&nbsp;&nbsp;&nbsp;&nbsp;<span>&nbsp;<? echo $rows_num_l?>&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;</div>
                <div class="space_hx"></div>
                <div class="space_hx"></div>
                <ul class="shopping">
                    <li class="T_n_o">
                        <input type="text" class="many" value="1" />
                        <a class="jia">+</a>
                        <a class="jian">-</a>
                        <input type="hidden" value="<? echo $result_arr["stock"];?>" id="stock" />
                    </li>
                    <li class="A_t_c"><a href="shopping_cart_deal.php?act=add&Id=<? echo $result_arr["Id"]?>" target="_blank"><img src="Images/gwc_w.png" alt="购物车"/>加入购物车</a></li>
                </ul>
                <div class="space_hx"></div>
                <ul class="promise">
                    <li><a href="#" target="_blank"><img src="Images/icon_1.gif" alt="订单险"/>订单险</a></li>
                    <li><a href="#" target="_blank"><img src="Images/icon_2.gif" alt="7天无理由"/>7天无理由</a></li>
                </ul>
                <div class="space_hx"></div>
                <ul class="pay">
                    <li><a href="#" target="_blank"><img src="Images/icon_3.gif" alt="快捷支付"/>快捷支付</a></li>
                    <li><a href="#" target="_blank"><img src="Images/icon_4.gif" alt="信用卡"/>信用卡</a></li>
                    <li><a href="#" target="_blank"><img src="Images/icon_5.gif" alt="余额宝"/>余额宝</a></li>
                    <li><a href="#" target="_blank"><img src="Images/icon_6.jpg" alt="蚂蚁花呗"/>蚂蚁花呗</a></li>
                </ul>
                <div class="space_hx"></div>
                <div class="pt_share">
                    <div class="share">分享至<img src="Images/fenxiang.png" alt="分享"/></div>
                    <ul class="se_list">
                        <li><a href="#" target="_blank"><img src="Images/wchat.png" alt="WeChat"/></a></li>
                        <li><a href="#" target="_blank"><img src="Images/wchat_friend.png" alt="WeChat_friend"/></a></li>
                        <li><a href="#" target="_blank"><img src="Images/QQ.png" alt="QQ" /></a></li>
                        <li><a href="#" target="_blank"><img src="Images/QQkj.png" alt="Qzone" /></a></li>
                        <li><a href="#" target="_blank"><img src="Images/sinaweibo.png" alt="sinaweibo" /></a></li>
                    </ul>
                    <? 
						$sql_col="select * from `yg_farite` where `userName`='".@$_SESSION["user"]."' and `pro_Id`=".$result_arr["Id"];
						//exit($sql_col);
						$result_col=mysql_query($sql_col);
						$rows_num_col=mysql_num_rows($result_col);
						$result_arr_col=mysql_fetch_array($result_col);
						if($rows_num_col){
					?>
                    <div class="pt_concern"><a href="collection_deal.php?act=del&Id=<? echo $result_arr_col["Id"]?>&pro_Id=<? echo $result_arr["Id"]?>" target="_self"><span>取消收藏</span><img src="Images/gzax_2.png" alt="concern"/></a></div>
                    <? }else{ ?>
                    <div class="pt_concern"><a href="collection_deal.php?act=add&pro_Id=<? echo $result_arr["Id"]?>" target="_self"><span>点我收藏</span><img src="Images/gzax_1.png" alt="concern"/></a></div>
                    <? } ?>
                </div>
                <div class="space_hx"></div>
            </div>
        </div>
    </div>
    <!--up end-->
    <div class="space_hx"></div>
    <div class="space_hx"></div>
    <!--down start-->
    <div class="P_I_down">
        <div class="G_y_l">
            <h1>猜你喜欢</h1>
                <?
					$sql_gyl="select * from `yg_product` order by `sales_vol` desc limit 6"; 
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
                    <div class="bom"></div>
				<? }?>
            
        	<!--一共展示5件商品-->
        </div>
        <div class="down_rt clearfix">
            <ul class="rt_te">
                <li class="pt_info selected">商品详情</li>
                <li>用户评价</li>
            </ul>
            <div class="space_hx"></div>
            <div class="rt_box">
                <div class="rt_info" style="display:block;">
                    <p><? echo $result_arr["description"]?></p>
                </div>
                <div class="rt_comment" style="display:none">
                    <div class="rt_top">
                        <div class="top_tt">
                            <strong><h1>商品评价</h1></strong>
                        </div>
                        <div class="space_hx"></div>
                        <? 
							$sql_com_h="select * from `yg_comment` where (`pro_Id`=".$Id." and (`com_class`=4 or `com_class`=5)) order by Id desc";
							$result_com_h=mysql_query($sql_com_h);
							$rows_num_h=mysql_num_rows($result_com_h);
						?>
                        <div class="top_con">
                            <div class="con_left">
                                <p class="p_01"><? echo $rows_num_h;?><span></span></p>
                                <p class="p_02">累计好评</p>
                            </div>
                            <div class="con_mid">
                                <dl>
                                    <dt>好&nbsp;&nbsp;评:<span>(<? echo $rows_num_h?>)</span></dt>
                                    <!--<dd><div class="hp"></div></dd>-->
                                </dl>
                                <? 
									$sql_com_z="select * from `yg_comment` where (`pro_Id`='".$Id."' and `com_class`=3) order by Id desc";
									$result_com_z=mysql_query($sql_com_z);
									$rows_num_z=mysql_num_rows($result_com_z);
								?>
                                <dl>
                                    <dt>中&nbsp;&nbsp;评:<span>(<? echo $rows_num_z?>)</span></dt>
                                    <!--<dd><div class="zp"></div></dd>-->
                                </dl>
                                <? 
									$sql_com_c="select * from `yg_comment` where (`pro_Id`='".$Id."' and `com_class`=3) order by Id desc";
									$result_com_c=mysql_query($sql_com_c);
									$rows_num_c=mysql_num_rows($result_com_c);
								?>
                                <dl>
                                    <dt>差&nbsp;&nbsp;评:<span>(<? echo $rows_num_c?>)</span></dt>
                                    <!--<dd><div class="cp"></div></dd>-->
                                </dl>
                            </div>
                            <div class="space_hx"></div>
                        </div>
                    </div>
                    <div class="space_hx"></div>
                    <div class="rmt_con">
                        <ul class="rmt_tt">
                            <li><a <? $com=@$_GET["com"];if($com==""){ echo "style='color:#f00'";}?> href="YG_product_info.php?Id=<? echo $Id?>&com= " target="_blank">所有评论</a></li>
                            <li><a <? if($com=="4"){ echo "style='color:#f00'";}?> href="YG_product_info.php?Id=<? echo $Id?>&com=4" target="_blank">好评</a></li>
                            <li><a <? if($com=="3"){ echo "style='color:#f00'";}?> href="YG_product_info.php?Id=<? echo $Id?>&com=3" target="_blank">中评</a></li>
                            <li><a <? if($com=="2"){ echo "style='color:#f00'";}?> href="YG_product_info.php?Id=<? echo $Id?>&com=2" target="_blank">差评</a></li>
                        </ul>
                        <div class="space_hx"></div>
                        <ul class="rmt_info">
                        	<? 
								if($com==""){
									$sql_m="select *,b.`addtime` as baddtime from `yg_user` as a join `yg_comment` as b on a.`user`=b.`user_Name` where b.`pro_Id`=".$Id." order by b.Id desc";
								}else if($com=="2"){
									$sql_m="select *,b.`addtime` as baddtime from `yg_user` as a join `yg_comment` as b on a.`user`=b.`user_Name` where (b.`pro_Id`=".$Id." and (b.`com_class`=1 or b.`com_class`=2)) order by b.Id desc";
								}else if($com=="3"){
									$sql_m="select *,b.`addtime` as baddtime from `yg_user` as a join `yg_comment` as b on a.`user`=b.`user_Name` where (b.`pro_Id`=".$Id." and b.`com_class`=3) order by b.Id desc";
								}else if($com=="4"){
									$sql_m="select *,b.`addtime` as baddtime from `yg_user` as a join `yg_comment` as b on a.`user`=b.`user_Name` where (b.`pro_Id`=".$Id." and (b.`com_class`=4 or b.`com_class`=5)) order by b.Id desc";
								}		
								$result=mysql_query($sql_m);
								//exit($sql_m);
								$rows_num=mysql_num_rows($result);//显示出结果集 的记录数
								
								$pagesize=10;//每一页有10条记录
								
								$page_all=ceil($rows_num/$pagesize);//这里进一法
								
								if(@$_GET["page_now"]!=""){
									$page_now=@$_GET["page_now"];
								}else if(@$_GET["page_now"]==""){
									$page_now=1;
								}//当前页码
								
								$offset=($page_now-1)*$pagesize;//根据当前的页码 计算出偏移量
							
								//第三步 执行SQL语句
								if($com==""){
									$sql_com="select *b.`addtime` as baddtime from `yg_user` as a join `yg_comment` as b on a.`user`=b.`user_Name` where (b.`pro_Id`='".$Id."' and b.`com_class`=3) order by Id desc";
								}else if($com=="2"){
									$sql_com="select *b.`addtime` as baddtime from `yg_user` as a join `yg_comment` as b on a.`user`=b.`user_Name` where (b.`pro_Id`='".$Id."' and (b.`com_class`=1 or b.`com_class`=2)) order by Id desc";
								}else if($com=="3"){
									$sql_com="select *b.`addtime` as baddtime from `yg_user` as a join `yg_comment` as b on a.`user`=b.`user_Name` where (b.`pro_Id`='".$Id."' and b.`com_class`=3) order by Id desc";
								}else if($com=="4"){
									$sql_com="select *b.`addtime` as baddtime from `yg_user` as a join `yg_comment` as b on a.`user`=b.`user_Name` where (b.`pro_Id`='".$Id."' and (b.`com_class`=4 or b.`com_class`=5)) order by Id desc";
								}
								$result_com=mysql_query($sql_com);
								while($result_arr=mysql_fetch_array($result)){
							?>
                            <li>
                                <div class="cm_user">
                                    <div class="cm_name"><img src="<? echo $result_arr["head_tx"]?>" style="height:30; width:30px; overflow:hidden; vertical-align:middle;" alt="<? echo $result_arr["user"]?>"/><? echo $result_arr["user"]?></div>
                                    <div class="cm_xin">
                                        <? 
											for($n=(5-$result_arr["com_class"]);$n<5;$n++){
										?>		
											<img src="images/hp_1.png" alt="好评星"/>
                                        <?    } 
											for($n=$result_arr["com_class"];$n<5;$n++){
										?>		
											<img src="images/cp_2.png" alt="差评星"/>
                                        <?    } ?>
                                    </div>
                                </div>
                                <div class="cm_info">
                                    <p style="height:50px;"><? echo $result_arr["comment"]?></p>
                                    <span><? echo $result_arr["baddtime"]?></span>
                                </div>
                            </li>
                            <? }?>
                        </ul>
                        <div class="space_hx"></div>
                        <ul class="page">
					   <?
                          $m="";
                          if(@$com!=""){
                              $m.="&com=".$com;
                          }
                          if(@$Id!=""){
                              $m.="&Id=".$Id;
                          }         
                       ?>
                       <? 
					   	  if($rows_num=="" || $rows_num=="0"){
							  
						  }else {
							if($page_now==1){?>
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
                           <? }
						  }?>
                        </ul>
                        <div class="space_hx"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--down end-->
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