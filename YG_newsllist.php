<?php include ("Include/mysql_open.php");?>
<?php include ("Include/function.php");?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>新闻资讯-优购户外商城</title>
<link rel="icon" href="images/logo_icon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/base_1.css">
<link rel="stylesheet" type="text/css" href="css/YG_newsllist.css">
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
		//滑动门特效 start
		$(".r_tittle ul li").each(function(i){
			$(this).mouseenter(function(){
				$(".r_box ul:eq("+i+")").show(500).siblings().hide(500);
			})
		})
		//滑动门特效 end
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
    <div class="space_hx"></div>
    <div class="space_hx"></div>
    <div class="n_content">
        <!--left start-->
        <div class="c_left">
            <div>
                <a href="YG_newsllist.php?class=new" target="_blank"><img src="images/cd.png" alt="..."/>
                <span>户外资讯</span></a>
            </div>
            <ul>
            	<?
					$sql_cl="select * from `yg_news_class`";
					$result_cl=mysql_query($sql_cl);
					while($result_arr_cl=mysql_fetch_array($result_cl)){
				?>
                <li><a href="YG_newsllist.php?class=new&classId=<? echo $result_arr_cl["Id"]?>" target="_blank"><? echo $result_arr_cl["classname"]?></a></li>
                <? }?>
            </ul>
            <div>
                <a href="YG_newsllist.php?class=aron" target="_self"><img src="images/cd.png" alt="..."/>
                <span>帮助中心</span></a>
            </div>
            <ul>
                <?
					$sql_ol="select * from `yg_artonce_class` ";
					$result_ol=mysql_query($sql_ol);
					while($result_arr_ol=mysql_fetch_array($result_ol)){
				?>
                <li><a href="YG_newsllist.php?class=aron&classId=<? echo $result_arr_ol["Id"]?>" target="_self"><? echo $result_arr_ol["name"]?></a></li>
                <? }?>
            </ul>
        </div>
        <!--left end-->
        <!--main start-->
        <div class="c_main">
            <ul>
            	<?
					if(@$_GET["class"]=="new"){
						$classId=@$_GET["classId"];
						if($classId!=""){
							$sql_r="select * from `yg_news` where `classId`=".$classId;
						}else{
							$sql_r="select * from `yg_news` ";
						}
					}else if(@$_GET["class"]=="aron"){
						$classId=@$_GET["classId"];
						if($classId!=""){
							$sql_r="select * from `yg_artonce` where `classId`=".$classId;
						}else{
							$sql_r="select * from `yg_artonce` ";
						}
					}else{
						$sql_r="select * from `yg_news` ";
					}
					$result_r=mysql_query($sql_r);
					$rows_num=mysql_num_rows($result_r);//显示出结果集 的记录数
					
					$pagesize=8;//每一页有25条记录
					
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
					
					if(@$_GET["class"]=="new"){
						$classId=@$_GET["classId"];
						if($classId!=""){
							$sql="select * from `yg_news` where `classId`=".$classId;
						}else{
							$sql="select * from `yg_news` ";
						}
					}else if(@$_GET["class"]=="aron"){
						$classId=@$_GET["classId"];
						if($classId!=""){
							$sql="select * from `yg_artonce` where `classId`=".$classId."  order by Id desc limit ".$offset.",".$pagesize;
						}else{
							$sql="select * from `yg_artonce`  order by Id desc limit ".$offset.",".$pagesize;
						}
					}else{
						$sql="select * from `yg_news`  order by Id desc limit ".$offset.",".$pagesize;
					}
					$result=mysql_query($sql);
					while($result_arr=mysql_fetch_array($result)){
				?>
                <li><a href="#" target="_blank">
                    <h1><? echo $result_arr["title"]?><span><? echo $result_arr["addtime"]?></span></h1>
                    <p><? echo cutstr_html($result_arr["content"],150)?></p>
                </a></li>
                </ul>
                <? }?>
                <!--一共展示8条信息-->
                <ul class="page">
			   <?
                  $m="";
                  if(@$search!="" || @$classId!=""){
                      $m.="&act=search";
                  }
                  if(@$search!=""){
                      $m.="&search=".urlencode($search);
                  }
                  if(@$classId!=""){
                      $m.="&classId=".urlencode($classId);
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
                    <li><a href="?page_now=<? echo $page_now+1;?><? echo $m;?>" target="_self">下一页</a></li>
                    <li><a href="?page_now=<? echo $page_all;?><? echo $m;?>" target="_self">尾页</a></li>
               <? }?>
            </ul>
        </div>
        <!--main end-->
        <!--right start-->
        <div class="c_right">
            <div class="r_tittle">
                <ul>
                    <li><a href="#" target="_blank">最新文章</a></li>
                    <li><a href="#" target="_blank">推荐文章</a></li>
                </ul>
            </div>
            <div class="r_box">
                    <ul class="r_list" id="list_zx">
                    	<? 
							$sql_rx="select * from `yg_news` order by `addtime` desc limit 10";
							$result_rx=mysql_query($sql_rx);
							while($result_arr_rx=mysql_fetch_array($result_rx)){
						?>
                        <li><a href="YG_new.php?class=new&Id=<? echo $result_arr_rx["Id"]?>" target="_blank"><? echo $result_arr_rx["title"]?><span><? echo $result_arr_rx["addtime"]?></span></a></li>
                        <? }?>
                        <!--一共展示10条信息-->
                    </ul>
                    <ul class="r_list" id="list_tj" style="display:none">
                    	<? 
							$sql_rt="select * from `yg_news` where `isRecommended`=1 limit 10";
							$result_rt=mysql_query($sql_rt);
							while($result_arr_rt=mysql_fetch_array($result_rt)){
						?>
                        <li><a href="YG_new.php?class=new&Id=<? echo $result_arr_rt["Id"]?>" target="_blank"><? echo $result_arr_rt["title"]?><span><? echo $result_arr_rt["addtime"]?></span></a></li>
                        <? }?>
                        <!--一共展示10条信息-->
                    </ul>
                </div>
        </div>
        <!--right end-->
    </div>
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