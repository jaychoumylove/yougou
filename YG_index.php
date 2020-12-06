<? 
	require("Include/mysql_open.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>首页-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_index.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
<script src="js/jquery-1.8.3.min.js"></script>
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
		//banner 特效 start
		var l=0;
		var h;
		$(".bn_pg b,.banner li").hover(   //鼠标进入和出去的事件
			function(){
				window.clearInterval(h);
			},
			function(){
				h=window.setInterval(function(){shou(l)},3000);
			}
		);
		$(".bn_pg b").eq(0).trigger("mouseleave");
		function shou(j){
			$(".bn_pg b:eq("+j+")").css("background","rgba(255,255,255,0.66)").siblings().css("background","rgba(0,0,0,0.8)");
			$(".banner li:eq("+j+")").slideDown(1000).siblings().fadeOut(1300);
			j++;
			if(j==$(".bn_pg b").length){
				l=0;
			}else{
				l=j;
			}
		}
		//banner特效end
		//0f 滑动门 start
		$(".ff_list li").each(function(n){
			$(this).mouseenter(function(){
				$(this).addClass("hover").siblings().removeClass("hover");
				$(".ff_box li:eq("+n+")").show().siblings().hide();
			})
		})
		//0f 滑动门 end
		//nf 滑动门 start
		$(".fq_list li").each(function(n){
			$(this).mouseenter(function(){
				$(this).addClass("hover").siblings().removeClass("hover");
				$(".fq_box li:eq("+n+")").show().siblings().hide();
			})
		})
		//nf 滑动门 end
		$(".SC_po").mouseenter(function(){
			$(this).siblings().children(".jn_SC").animate({bottom:"0px"},100);
		})
		$(".jn_SC").parent().parent("dl").mouseleave(function(){
			$(".jn_SC").animate({bottom:"-40px"},500);
		})
		
		
		 $(".lc_page").hide();
    	//根据滚动条的位置，跳转链接出现或消失
		
		$(window).scroll(function() {
			var wytop=$(window).scrollTop();
			if ($(window).scrollTop() > 682.5) {
				$(".lc_page").fadeIn(500);
			} else if ($(window).scrollTop() > 6390) {
				$(".lc_page").fadeOut(500);
			} else if ($(window).scrollTop() < 682.5) {
				$(".lc_page").fadeOut(500);
			}
			//拖动滚轮，对应的楼层样式进行匹配
			$(".lc_page ul li").each(function() {
				var lc_top=$(".fq").eq($(this).index()).offset().top+668;
				if(lc_top > $(window).scrollTop()){
					$(".lc_page ul li").removeClass("hover");
					$(".lc_page ul li").eq($(this).index()).addClass("hover");
					return false;//中断循环
				}
			});
		});
		//当点击跳转链接后，回到页面顶部位置
		$(".back_to_top").click(function() {
			$("body,html").animate({
				scrollTop: 0
			}, 100);
			return false;
		});
		//点击楼层页码到楼层特效
		$(".lc_page ul li").not(".back_to_top").click(function(){
			$(this).addClass("hover").siblings().removeClass("hover");
			var lctop=$(".fq").eq($(this).index()).offset().top;//获取每个楼梯的offsetTop值
			$("body,html").animate({//$('html,body')兼容问题body属于chrome
				scrollTop: lctop
			},500)
		})
		
    });
</script>
</head>

<body>
	<!--top start-->
	<div class="top">
        <?php include ("top_link.php");?>
        <div class="space_hx"></div>
        <div class="space_hx"></div>    
        <ul class="top_content">
            <li class="logo clearfix"><a href="#" target="_self"><img src="images/logo.png" alt="优购户外商城"></a></li>
            <li class="search clearfix">
                <form method="post" action="">
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
    <!--banner start--> 
        <ul class="banner">
            <li class="ban_1"><a href="#" target="_blank"></a></li>
            <li class="ban_2"><a href="#" target="_blank"></a></li>
            <li class="ban_3"><a href="#" target="_blank"></a></li>
            <li class="ban_4"><a href="#" target="_blank"></a></li>
        </ul>
        <div class="bn_pg">
            <b class="b_1"></b>
            <b class="b_2"></b>
            <b class="b_3"></b>
            <b class="b_4"></b>
        </div>
    <!--nav end-->
    <div class="space_hx"></div>
    <!--0F start-->
    <div class="ff">
    	<div class="class_li clearfix">因为运动，每一天都很精彩！</div>
    	<ul class="clearfix ff_list">
        	<? 
				$sql_ac="select * from `yg_active` where `act_classId`=0 ";
				$result_ac=mysql_query($sql_ac);
				while($result_arr_ac=mysql_fetch_array($result_ac)){
			?>
        	<li <? if($result_arr_ac["Id"]==1){ echo "class='hover'";}?> style="cursor:pointer;"><a style="cursor:pointer;"><? echo $result_arr_ac["act_name"]?></a></li>
            <? } ?>
        </ul>
        <ul class="ff_box">
        	<? 
				$sql_aca="select * from `yg_active` where `act_classId`=0 ";
				$result_aca=mysql_query($sql_aca);
				$l=1;
				while($result_arr_aca=mysql_fetch_array($result_aca)){
			?>
        	<li <? if($l==1){ ?>class="hover" <? } ?>>
				<? 
                    
                    $sql_ac_1="select * from `yg_product` where `active_Id`=".$result_arr_aca["Id"]." order by `sales_vol` desc limit 5";
                    $result_ac_1=mysql_query($sql_ac_1);
                    while($result_arr_ac_1=mysql_fetch_array($result_ac_1)){
                ?>
                <dl>
                    <a class="SC_po" href="YG_product_info.php?Id=<? echo $result_arr_ac_1["Id"]?>" target="_blank">
                        <dt><img src="<? echo $result_arr_ac_1["product_img"]?>" style="width:224px; height:224px; overflow:hidden; vertical-align:middle;" alt="<? echo $result_arr_ac_1["name"]?>"></dt>
                        <dd><? echo $result_arr_ac_1["name"]?></dd>
                        <dd class="pay_for">￥&nbsp;&nbsp;<? echo $result_arr_ac_1["yg_price"]?><span>已售：&nbsp;&nbsp;<strong><? echo $result_arr_ac_1["sales_vol"]?></strong></span></dd>
                    </a> 
                    <a href="shopping_cart_deal.php?act=add&Id=<? echo $result_arr_ac_1["Id"]?>" target="_blank"><div class="jn_SC">加入购物车</div></a>
                </dl>
            	<? } ?>
            </li>
            <? $l++;} ?>
         </ul>
    </div>
    <!--0F end-->
    <div class="space_hx"></div>
    <div class="space_hx"></div>
    <? 
		$sql="select * from `yg_product_class` where `parentId`=0 ";
		$result=mysql_query($sql);
		$n=1;
		while($result_arr=mysql_fetch_array($result)){
	?>
    <!--1F start-->
    <div class="fq">
    	<div class="class_li clearfix"><? echo $n;?>F&nbsp;&nbsp;<? echo $result_arr["name"]?></div>
    	<ul class="clearfix fq_list">
        <? 
			$sql_proac="select * from `yg_active` where `act_classId`= ".$result_arr["Id"];
			$result_proac=mysql_query($sql_proac);
			$m=1;
			while($result_arr_proac=mysql_fetch_array($result_proac)){
		?>
        	<li <? if($m==1){?>class="hover" <? } ?>><a><? echo $result_arr_proac["act_name"]?></a></li>
        <?
			$m++; 
		} ?>
        </ul>
        <div class="fq_all">
        	<ul class="all_class">
            <? 
				$sql_proc="select * from `yg_product_class` where `parentId`= ".$result_arr["Id"];
				$result_proc=mysql_query($sql_proc);
				while($result_arr_proc=mysql_fetch_array($result_proc)){
			?>
            	<li><a href="YG_products.php?classId=<? echo $result_arr_proc["Id"]?>" target="_blank"><? echo $result_arr_proc["name"]?></a></li>
            <? } ?>
            </ul>
            <?
				$sql_sc_po="select * from `yg_product_class` as a join `yg_product` as b on a.Id=b.classId where a.`parentId`=".$result_arr["Id"]." order by `sales_vol` desc limit 1";
				//echo $sql_sc_po;
				$result_sc_po=mysql_query($sql_sc_po);
				$result_arr_sc_po=mysql_fetch_array($result_sc_po);
			?>
            <dl>
            <a class="SC_po" href="YG_product_info.php?Id=<? echo $result_arr_sc_po["Id"]?>" target="_blank">
                <dt><img src="<? echo $result_arr_sc_po["product_img"]?>" style="width:224px; height:224px; vertical-align:middle; overflow:hidden"  alt="<? echo $result_arr_sc_po["name"]?>"></dt>
                <dd><? echo $result_arr_sc_po["name"]?></dd>
                <dd class="pay_for">￥&nbsp;&nbsp;<? echo $result_arr_sc_po["yg_price"]?><span>已售：&nbsp;&nbsp;<strong><? echo $result_arr_sc_po["sales_vol"]?></strong></span></dd>
            </a> 
            <a href="shopping_cart_deal.php?act=add&Id=<? echo $result_arr_sc_po["Id"]?>" target="_blank"><div class="jn_SC">加入购物车</div></a>
            </dl>
        </div>
        <ul class="fq_box">
        	<? 
				$sql_proace="select * from `yg_active` where `act_classId`= ".$result_arr["Id"];
				$result_proace=mysql_query($sql_proace);
				$f=1;
				while($result_arr_proace=mysql_fetch_array($result_proace)){
					
			?>
        	<li <? if($f==1){?>class="hover" <? } ?>>
            <? 
				$sql_proc="select * from `yg_product` where `active_Id`= ".$result_arr_proace["Id"]." order by `sales_vol` desc limit 8";
				$result_proc=mysql_query($sql_proc);
				while($result_arr_proac=mysql_fetch_array($result_proc)){
			?>
                <dl>
                    <a class="SC_po" href="YG_product_info.php?Id=<? echo $result_arr_proac["Id"]?>" target="_blank">
                        <dt><img src="<? echo $result_arr_proac["product_img"]?>" style="width:224px; height:224px; vertical-align:middle; overflow:hidden"  alt="<? echo $result_arr_proac["name"]?>"></dt>
                        <dd><? echo $result_arr_proac["name"]?></dd>
                        <dd class="pay_for">￥&nbsp;&nbsp;<? echo $result_arr_proac["yg_price"]?><span>已售：&nbsp;&nbsp;<strong><? echo $result_arr_proac["sales_vol"]?></strong></span></dd>
                    </a> 
                    <a href="shopping_cart_deal.php?act=add&Id=<? echo $result_arr_proac["Id"]?>" target="_blank"><div class="jn_SC">加入购物车</div></a>
                </dl>
            <? } ?>
            </li>
            <? $f++;} ?>
         </ul>
    </div>
    <div class="space_hx"></div>
    <div class="space_hx"></div>
    <!--1F end-->;
    <? $n++;
	 } ?>
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
    <div class="lc_page">
    	<ul>
        	<? 
				$sql_page="select * from `yg_product_class` where `parentId`=0 ";
				$result_page=mysql_query($sql_page);
				while($result_arr_page=mysql_fetch_array($result_page)){
			?>
        	<li><? echo $result_arr_page["name"]?></li>
            <? }?>
            <li class="back_to_top">返回顶部</li>
        </ul>
    </div>
</body>
</html>
