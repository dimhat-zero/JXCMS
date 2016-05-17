$(function(){
	//表格行，鼠标放上去变色
	$(".tr:odd").css("background", "#FFFCEA");
	$(".tr:odd").each(function(){
		$(this).hover(function(){
			$(this).css("background-color", "#FFE1FF");
		}, function(){
			$(this).css("background-color", "#FFFCEA");
		});
	});
	$(".tr:even").each(function(){
		$(this).hover(function(){
			$(this).css("background-color", "#FFE1FF");
		}, function(){
			$(this).css("background-color", "#fff");
		});
	}); 

	/*ie6,7下拉框美化*/
    if ( $.browser.msie ){
    	if($.browser.version == '7.0' || $.browser.version == '6.0'){
    		$('.select').each(function(i){
			   $(this).parents('.select_border,.select_containers').width($(this).width()+5); 
			 });
    		
    	}
    }

    /**
     * 按钮栏功能
     */
    $(".btn_checked").click(function(){
    	$("input[name='checkbox']").attr("checked",true);
	});
	$(".btn_nochecked").click(function(){
	    $("input[name='checkbox']").attr("checked",false);
	});
	$(".btn_search").click(function(){
		$('#pageNo').val(1);
		$("#search_form").submit();
	})

});

function getCheckboxIds(){
	var ids = new Array();
	$("input[name='checkbox']:checked").each(function(){
		ids.push($(this).data("id"));
	})
	var idsStr=ids.join(',');
	return idsStr;
}


