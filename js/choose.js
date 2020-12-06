/*结算 信息选择 start*/
$(".my_reform01 .my_rebox span").click(function(){
	$(this).addClass("sorange");
	$(this).find("img").show();
	$(this).parents(".my_rebox").siblings(".my_rebox").find("span").removeClass("sorange");
	$(this).parents(".my_rebox").siblings(".my_rebox").find("span img").hide();
})
$(".my_reform02 .my_rebox span").click(function(){
	$(this).addClass("sorange");
	$(this).find("img").show();
	$(this).siblings("span").removeClass("sorange");
	$(this).siblings("span").find("img").hide();
})

$(document).ready(function(){ 
   $(".my_reform01 .my_rebox:eq(1)").nextAll(".my_rebox").hide();
}); 
$(".my_redis").click(function(){
	$(this).find("img").toggle();
	$(this).parents(".my_reform01").find(".my_rebox:eq(1)").nextAll(".my_rebox").slideToggle("fast");
})
/*结算 信息选择 end*/

/*产品中心 start*/
$(".ct_R02 .ct_R02cont .ct_R02div span").click(function(){
	$(this).parents(".ct_R02div").siblings(".ct_R02ul_02").slideToggle(300);
})
$(".ct_R02 .ct_R02cont .ct_R02div .ct_R02ul_01 li").click(function(){
	$(this).addClass("ct_R02li");
	$(this).siblings("li").removeClass("ct_R02li");
	$(this).parents(".ct_R02div").siblings(".ct_R02ul_02").find("li").removeClass("ct_R02li");
})
$(".ct_R02 .ct_R02cont .ct_R02ul_02 li").click(function(){
	$(this).addClass("ct_R02li");
	$(this).siblings("li").removeClass("ct_R02li");
	$(this).parents(".ct_R02ul_02").siblings(".ct_R02div").find(".ct_R02ul_01 li").removeClass("ct_R02li");
})
/*产品中心 end*/

/*首页 start*/
/*倒计时商品 start*/
/*$("#fbL01_btm .fbL01_div:eq(2) .fbL01_divR").css("background","#fff");
$("#fbL01_btm .fbL01_div").mouseenter(function(){
	$(this).find(".fbL01_car").animate({bottom:"0px"});
	$(this).find(".fbL01_divL").animate({marginTop:"-15px"});
})
$("#fbL01_btm .fbL01_div").mouseleave(function(){
	$(this).find(".fbL01_car").animate({bottom:"-35px"},"300");
	$(this).find(".fbL01_divL").animate({marginTop:"0px"},"300");
})*/
/*倒计时商品 end*/
/*进店必败 start*/
$(".fbL02_box .fbL02_ul .fbL02_li").mouseenter(function(){
	$(this).css("border","1px solid #eee");
	$(this).find(".fbL02_licont").css("border","4px solid #f8f8f6");
	$(this).find("a").animate({'marginTop':'10px'});
	$(this).find("a i").animate({'height':'15px','line-height':'15px'});
	$(this).find(".fbL02_car").animate({'bottom':'20px'});
})
$(".fbL02_box .fbL02_ul .fbL02_li").mouseleave(function(){
	$(this).css("border","1px solid #fff");
	$(this).find(".fbL02_licont").css("border","4px solid #fff");
	$(this).find("a").animate({'marginTop':'20px'});
	$(this).find("a i").animate({'height':'30px','line-height':'30px'});
	$(this).find(".fbL02_car").animate({'bottom':'-15px'});
})
/*进店必败 end*/
/*商品 start*/
$(".my_fir .fir_list .fir_lR .fir_lRbox").mouseenter(function(){
	$(this).find(".fir_lsadd").animate({bottom:"0px"},"50");
	$(this).find("p").animate({marginTop:"0px"},"50");
	$(this).find("p i").css("height","30px");
	$(this).find("p i").css("line-height","30px");
})
$(".my_fir .fir_list .fir_lR .fir_lRbox").mouseleave(function(){
	$(this).find(".fir_lsadd").animate({bottom:"-30px"},"50");
	$(this).find("p").animate({marginTop:"30px"},"50");
	$(this).find("p i").css("height","35px");
	$(this).find("p i").css("line-height","35px");
})
/*商品 end*/
/*首页 end*/

/*产品详情页 start*/
/*收藏 start*/
$("#det_or04R").click(function(){
	$(this).find("img").toggle();
})
/*收藏 end*/
/*好评度 start*/
$(document).ready(function(){
	var emLength=$(".det_pj02 li font");
	emLength.each(function(){
//		alert($(this).text());
		$(this).siblings("b").find("em").animate({width:parseInt($(this).text())+"%"});
	})
	
})
/*好评度 end*/

/*猜你喜欢 start*/
$(".det_fir .fir_lRbox").mouseenter(function(){
	$(this).find(".fir_lsadd").animate({bottom:"15px"},"50");
	$(this).find("p").animate({marginTop:"0px"},"50");
	$(this).find("p i").css("height","20px");
	$(this).find("p i").css("line-height","20px");
	$(this).find("p font").css("height","20px");
	$(this).find("p font").css("line-height","20px");
})
$(".det_fir .fir_lRbox").mouseleave(function(){
	$(this).find(".fir_lsadd").animate({bottom:"-30px"},"50");
	$(this).find("p").animate({marginTop:"10px"},"50");
	$(this).find("p i").css("height","35px");
	$(this).find("p i").css("line-height","35px");
	$(this).find("p font").css("height","25px");
	$(this).find("p font").css("line-height","25px");
})
/*猜你喜欢 end*/
/*产品详情页 end*/

/*top start*/
$(".shead_navr>div").mouseover(function(){
	$(this).addClass("divlink");
	$(this).find("ul").show();
	$(this).prev("div").find("span").css("borderRight","1px solid #f7f9f8");
	$(this).find("span").css("borderRight","1px solid #e0e0e0");
})
$(".shead_navr>div").mouseout(function(){
	$(this).removeClass("divlink");
	$(this).find("ul").hide();
	$(this).prev("div").find("span").css("borderRight","1px solid #d9d9d9");
	$(this).find("span").css("borderRight","1px solid #d9d9d9");
})
/*top end*/

/*猜你喜欢 选项卡 start*/
$(function(){
    function tabs(tabTit,on,tabCon){
        $(tabTit).children().hover(function(){
            $(this).addClass(on).siblings().removeClass(on);
            var index = $(tabTit).children().index(this);
           	$(tabCon).children().eq(index).show().siblings().hide();
    	});
	};
    tabs(".my_crtab_hd","my_clink",".my_crtab_cd");
});
/*猜你喜欢 选项卡 end*/

/*我的红包 选项卡 start*/
$(function(){
    function tabs(tabTit,on,tabCon){
        $(tabTit).children().click(function(){
            $(this).addClass(on).siblings().removeClass(on);
            var index = $(tabTit).children().index(this);
           	$(tabCon).children().eq(index).show().siblings().hide();
    	});
	};
    tabs(".my_cbag","my_cbagli",".my_cbagtab_hd");
});
/*我的红包 选项卡 end*/

/*产品详情页 选项卡 start*/
$(function(){
    function tabs(tabTit,on,tabCon){
        $(tabTit).children().click(function(){
            $(this).addClass(on).siblings().removeClass(on);
            var index = $(tabTit).children().index(this);
           	$(tabCon).children().eq(index).show().siblings().hide();
    	});
	};
    tabs(".det_crp p","det_clink",".det_Rcont");
});
/*产品详情页 选项卡 end*/


//健康水果 展开全文 start
$(function(){
	    $(".my_fruCont01").each(function(){
	        var _this = $(this);
	        var lHeight = _this.height();
	        _this.css('height','80px')
	        _this.siblings('.my_fruCont02').find('i').toggle(function(){
//	            console.log(1);
	            $(this).parent().siblings('.my_fruCont01').animate({'height':lHeight+'px'},600)
	            $(this).html('收起');
	        },function(){
	            $(this).parent().siblings('.my_fruCont01').animate({'height':'80px'},600)
	            $(this).html('展开查看全文>');
	        })           
	    })
	 
	})     
//健康水果 展开全文 end

/*爱心公益 start*/
var RpHeight=$(".lv01_contR p").height();
$(".lv01_contR p").css('height','90px');
$(".lv01_contR .lv01_contRa a").toggle(function(){
	$(this).parent().siblings("p").animate({'height':RpHeight+'px'});
	$(this).html('收起');
},
function(){
	$(this).parent().siblings("p").animate({'height':'90px'});
	$(this).html('展开查看全文>');
})
/*合作基地介绍 start*/
$(function(){
	$(".lv1225 .lv12_box .lv12_btm .lv12_p font").each(function(){
		var fontHeight=$(this).height();
		if(fontHeight<125){
			fontHeight=125;
		}
		$(this).css('height','125px')
		$(this).siblings("a").toggle(function(){
			$(this).html('收起');
			$(this).siblings("font").animate({'height':fontHeight+'px'});
		},function(){
			$(this).html('展开查看全文>');
			$(this).siblings("font").animate({'height':'125px'});
		})
	})
})
/*合作基地介绍 end*/
/*爱心公益 end*/

