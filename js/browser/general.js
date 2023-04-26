//当前页面导航变色
$(document).ready(function(){
	var title = $('title').text();
	$("#nav a").removeClass("nav-color");
	$("#nav a").each(function(){		
		if($(this).text()===title){
			$(this).addClass("nav-color").css("color", "white");
		}		
	});
});

//search页，下拉解释框
$(document).ready(function(){
	$('#moreInfo').hide();
	$('#quote').click(function(){
		$('#moreInfo').toggle();
	})
})

$(document).ready(function(){
	$('#hide').hide();
	$('#hide_tool').click(function(){
		$('#hide').toggle();
	})
})

//search页默认值更改
$(document).ready(function(){	
	$("#DataSet").change(function(){	
		var p1=$(this).children('option:selected').val();
		if(p1 == 'actor'){
			$("#KeywordSearch").val("hsa-miR-34a-5p");
			// $("input[name='fuzzy']").prop("checked",true);
		}else if(p1 == 'id'){
			$("#KeywordSearch").val("MIMAT0000255");
			// $("input[name='fuzzy']").prop("checked",false);
		}else{
			$("#KeywordSearch").val("tRNA");
		}
	});
});

//help页
$(document).ready(function(){
	$('#collapse1').hide();
	$('#my_collapse1').click(function(){
		$('#collapse1').slideToggle();
		$('#collapse2').hide();
		$('#collapse3').hide();
		$('#collapse4').hide();
		$('#collapse5').hide();
		$('#collapse6').hide();
		$('#collapse7').hide();
	})
})
$(document).ready(function(){
	$('#collapse2').hide();
	$('#my_collapse2').click(function(){
		$('#collapse2').slideToggle();
		$('#collapse1').hide();
		$('#collapse3').hide();
		$('#collapse4').hide();
		$('#collapse5').hide();
		$('#collapse6').hide();
		$('#collapse7').hide();
	})
})
$(document).ready(function(){
	$('#collapse3').hide();
	$('#my_collapse3').click(function(){
		$('#collapse3').slideToggle();
		$('#collapse1').hide();
		$('#collapse2').hide();
		$('#collapse4').hide();
		$('#collapse5').hide();
		$('#collapse6').hide();
		$('#collapse7').hide();
	})
})
$(document).ready(function(){
	$('#collapse4').hide();
	$('#my_collapse4').click(function(){
		$('#collapse4').slideToggle();
		$('#collapse1').hide();
		$('#collapse2').hide();
		$('#collapse3').hide();
		$('#collapse5').hide();
		$('#collapse6').hide();
		$('#collapse7').hide();
	})
})
$(document).ready(function(){
	$('#collapse5').hide();
	$('#my_collapse5').click(function(){
		$('#collapse5').slideToggle();
		$('#collapse1').hide();
		$('#collapse2').hide();
		$('#collapse3').hide();
		$('#collapse4').hide();
		$('#collapse6').hide();
		$('#collapse7').hide();
	})
})
$(document).ready(function(){
	$('#collapse6').hide();
	$('#my_collapse6').click(function(){
		$('#collapse6').slideToggle();
		$('#collapse1').hide();
		$('#collapse2').hide();
		$('#collapse3').hide();
		$('#collapse4').hide();
		$('#collapse5').hide();
		$('#collapse7').hide();
	})
})
$(document).ready(function(){
	$('#collapse7').hide();
	$('#my_collapse7').click(function(){
		$('#collapse7').slideToggle();
		$('#collapse1').hide();
		$('#collapse2').hide();
		$('#collapse3').hide();
		$('#collapse4').hide();
		$('#collapse5').hide();
		$('#collapse6').hide();
	})
})
// //home页,cite us与intro的信息转换
// $(document).ready(function(){
// 	$('#more').hide();
// 	$('#moreText').click(function(){			
// 		if($("#more").is(":hidden")){	
// 			$('#citeInfo').hide();
// 			$("#more").show();
// 		}else{
// 			$("#more").hide();
// 			$('#citeInfo').show();
// 		}
// 	});
// });


//两大搜索方式切换 !!!
// $(document).ready(function(){
// 	$('#advancedSearch').hide();
// 	$('#advanClick').click(function(){
// 		$('#mainSearch').hide();
// 		$('#advancedSearch').show();
// 	})
// })

 
 //download标签页切换
// $(document).ready(function(){
// 	$("#down1").addClass("postcolor");
// 	$("#api1").removeClass("postcolor");
// 	$("#down2").show();
// 	$("#api2").hide();
// 	$("#down1").click(function(){
// 		$(this).addClass("postcolor");
// 		$("#api1").removeClass("postcolor");
// 		$("#down2").show();
// 		$("#api2").hide();
// 	})
// 	$("#api1").click(function(){
// 		$(this).addClass("postcolor");
// 		$("#down1").removeClass("postcolor");
// 		$("#api2").show();
// 		$("#down2").hide();
// 	})
// });




