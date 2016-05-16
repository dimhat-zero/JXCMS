$(function(){
    $(".sideMenu").slide({
        titCell:"h3",
        targetCell:"ul",
        defaultIndex:0,
        effect:'slideDown',
        delayTime:'500' ,
        trigger:'click',
        triggerTime:'150',
        defaultPlay:true,
        returnDefault:false,
        easing:'easeInQuint',
        endFun:function(){
            scrollWW();
        }
    });
    $(window).resize(function() {
        scrollWW();
    });

    $(".sideMenu ul li").click(function(){
        $(".sideMenu ul li").removeClass("on");
        $(this).addClass("on");
    });
});
function scrollWW(){
    if($(".side").height()<$(".sideMenu").height()){
        $(".scroll").show();
        var pos = $(".sideMenu ul:visible").position().top-38;
        $('.sideMenu').animate({top:-pos});
    }else{
        $(".scroll").hide();
        $('.sideMenu').animate({top:0});
        n=1;
    }
}

var n=1;
function menuScroll(num){
    var Scroll = $('.sideMenu');
    var ScrollP = $('.sideMenu').position();
    /*alert(n);
     alert(ScrollP.top);*/
    if(num==1){
        Scroll.animate({top:ScrollP.top-38});
        n = n+1;
    }else{
        if (ScrollP.top > -38 && ScrollP.top != 0) { ScrollP.top = -38; }
        if (ScrollP.top<0) {
            Scroll.animate({top:38+ScrollP.top});
        }else{
            n=1;
        }
        if(n>1){
            n = n-1;
        }
    }
}