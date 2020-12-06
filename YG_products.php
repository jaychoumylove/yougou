<?php include ("Include/mysql_open.php");?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>产品搜索-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_products.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
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
		$(".SC_po").mouseenter(function(){
			$(this).siblings().children(".jn_SC").animate({bottom:"0px"},100);
		})
		$(".jn_SC").parent().parent("dl").mouseleave(function(){
			$(".jn_SC").animate({bottom:"-40px"},500);
		})
		$(".S_C_s h2").mouseenter(function(){
			$(this).siblings("ul").slideDown(500);
			$(this).find("img").attr("src","images/sl.png");
		})
		$(".S_C_s").mouseleave(function(){
			$(".S_C_s ul").slideUp(200);
			$(this).find("img").attr("src","images/xl.png");
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
    <!--search start-->
    <div class="Search_box">
        <div class="space_hx"></div>	
        <div class="S_C_s">
        	<h2>全部商品<img src="images/xl.png" alt="..."></h2>
            <ul>
            	<? 
					$sql_pd="select * from `yg_product_class` where `parentId`=0 ";
					$result_pd=mysql_query($sql_pd);
					while($result_arr_pd=mysql_fetch_array($result_pd)){
				?>
            	<li>
                	<a href="#?classId=<? echo $result_arr_pd["Id"]?>" target="_blank"><h3><? echo $result_arr_pd["name"]?></h3></a>&nbsp;>&nbsp;
                    <? 
						$sql_cl="select * from `yg_product_class` where `parentId` = '".$result_arr_pd["Id"]."' ";
						$result_cl=mysql_query($sql_cl);
						while($result_arr_cl=mysql_fetch_array($result_cl)){
					?>
						<a href="?classId=<? echo $result_arr_cl["Id"]?>" target="_blank"><? echo $result_arr_cl["name"]?></a>&nbsp;|&nbsp;
						
					<? } ?>
				</li>
                <? } ?>
            </ul>
        </div>
        <div class="Search_rk">
            <ul class="rank">
                <li class="hover"><a href="YG_products.php?rank=all" target="_self">综合</a></li>
                <li><a href="YG_products.php?rank=price" target="_self">价格<img src="images/rank_s.png" alt="..."></a></li>
                <li><a href="YG_products.php?rank=date" target="_self">最新<img src="images/rank_s.png" alt="..."></a></li>
            </ul>
        </div>
    </div>
    <!--search end-->
    <div class="space_hx"></div>
    <div class="space_hx"></div>
    <!--foot start-->
    <div class="ff">
    	<?
			$act=@$_GET["act"];					
			if($act=="search"){
				
				$search=@$_POST["search"];
				if(empty($search)){
					$search=@urldecode($_GET["search"]);
				}
				$rank=@urldecode($_GET["rank"]);
				$classId=@urldecode($_GET["classId"]);
				$sql_m="select * from `yg_product` where 1=1 ";
				if($search!=""){
					$sql_m.= "and `name` like '%".$search."%' ";
				}
				if($classId!=""){
					$sql_m.="and `classId` = '".$classId."' ";
				}
				if($rank!=""){
					$sql_m.="order by '".$rank."' desc";
				}
				$sql_m.="order by Id desc";
				//exit($sql);
			}else{
				$sql_m="select * from `yg_product` order by Id desc";
			}		
			$result_m=mysql_query($sql_m);
			$rows_num=mysql_num_rows($result_m);//显示出结果集 的记录数
			
			$pagesize=25;//每一页有25条记录
			
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
			//echo $page_now;
			//echo $page_all;
			$offset=($page_now-1)*$pagesize;//根据当前的页码 计算出偏移量
		
        	//第三步 执行SQL语句
			
			if($act=="search"){
				$search=@$_POST["search"];
				if(empty($search)){
					$search=@urldecode($_GET["search"]);                    
				}
				$rank=@urldecode($_GET["rank"]);
				$classId=@urldecode($_GET["classId"]);
				$sql="select * from `yg_product` where 1=1 ";
				if($search!=""){
					$sql.= "and `name` like '%".$search."%' ";
				}
				if($classId!=""){
					$sql.= "and `classId` = '".$classId."' ";
				}
				if($rank!=""){
					$sql.= "order by '".$rank."' desc  ";
				}else{
					$sql.= "order by Id desc  ";
				}
				$sql.="limit ".$offset.",".$pagesize;
				//exit($sql);
			}else{
				$sql="select * from `yg_product` order by Id desc limit ".$offset.",".$pagesize;
			}	
			//echo $sql;
			$result=mysql_query($sql);
			while($result_arr=mysql_fetch_array($result)){
		?>
        <dl>
            <a class="SC_po" href="YG_product_info.php?Id=<? echo $result_arr["Id"]?>" target="_blank">
                <dt><img src="<? echo $result_arr["product_img"]?>" style="width:224px; height:224px; overflow:hidden; vertical-align:middle;" alt="<? echo $result_arr["name"]?>"></dt>
                <dd><? echo $result_arr["name"]?></dd>
                <dd class="pay_for">￥&nbsp;&nbsp;<? echo $result_arr["yg_price"]?><span>已售：&nbsp;&nbsp;<strong><? echo $result_arr["sales_vol"]?></strong></span></dd>
            </a> 
            <a href="shopping_cart_deal.php?act=add&Id=<? echo $result_arr["Id"]?>" target="_blank"><div class="jn_SC">加入购物车</div></a>
        </dl>
        <? }?>
        <div class="space_hx"></div>
        <div class="space_hx"></div>
        <!--page start-->
        <ul class="page">
        <?
		  $m="";
		  if(@$search!="" || @$rank!="" || @$classId!=""){
			  $m.="&act=search";
		  }
		  if(@$search!=""){
			  $m.="&search=".urlencode($search);
		  }
		  if(@$rank!=""){
			  $m.="&rank=".$rank;
		  }  
		  if(@$classId!=""){
			  $m.="&classId=".$classId;
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
            <form method="post" action="YG_products.php?act=search"/>
            <li><input type="text" class="pg_it" name="page" value="1"/></li>
            <li><input type="submit" class="pg_st" value="转到"/></li>
            </form>
        </ul>
        <div class="space_hx"></div>
    </div>
    <!--search end-->
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
