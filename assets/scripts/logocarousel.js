const logoCarousel = document.querySelector('.logo-carousel');
if(logoCarousel){
    function loop ($swap) {
        var secLastLiA = $('.box .swap li').eq(-2);
        var nextIndex1 = $swap.index() + 1;
        if(secLastLiA.hasClass('visible')){cloneLogoA(nextIndex1);}
        var next = $swap.find("li.visible").removeClass("visible").index() + 1;
        $($swap.find("li").get(next)).addClass("visible");
        const element1 = document.querySelector('.box .swap li.visible');
        let pos = element1.offsetTop;
        let posRem1 = pos / 16;
        $swap.css({ "transform" : "translateY(-" + posRem1 + "rem)"});
        setTimeout(function () { loop($swap); }, 3000);
    };
    
    $(function () {
        $(".swap").each(function () {
        var $this = $(this);
        $this.find("li").each(function () {
            $(this).css({ top: $(this).index() * 2 + "rem" });
        });
        loop($this);
        });
    });
    function loop2 ($swap1) {
        var secLastLiB = $('.box .swap1 li').eq(-2);
        var nextIndex = $swap1.index() + 1;
        if(secLastLiB.hasClass('visible')){cloneLogoB(nextIndex);}
        
        var next = $swap1.find("li.visible").removeClass("visible").index() + 1;
        
        if(next >= $swap1.find("li").length) {
        }
        $($swap1.find("li").get(next)).addClass("visible");
        
        const element = document.querySelector('.box .swap1 li.visible');
        let pos = element.offsetTop;
        let posRem = pos / 16;
        $swap1.css({ "transform" : "translateY(-" + posRem + "rem)"});
        
        setTimeout(function () { loop2($swap1); }, 3000);
    };
    
    $(function () {
        $(".swap1").each(function () {
        var $this = $(this);
        
        $this.find("li").each(function () {
            $(this).css({ top: $(this).index() * 2 + "rem" });
        });
        
        loop2($this);
        });
    });
    function cloneLogoA(nextIndex){
        const element1 = document.querySelector('.box .swap li:last-child');
        let pos = element1.offsetTop;
        let posRem = pos / 16;
        var $el = $('.box .swap li:first-child');
        var $elCont = $('.box .swap');
        $el.css({ "top":  posRem + 2 + "rem" });
        $elCont.css({ "transform" : ""});
        $elCont.css({ "transform" : "translateY(-" + nextIndex + 2 + "rem)"});
        $el.clone(true).appendTo('.box .swap');
        $el.remove();
    }
    function cloneLogoB(nextIndex){
        
        const element2 = document.querySelector('.box .swap1 li:last-child');
        let pos = element2.offsetTop;
        let posRem = pos / 16;
        var $el = $('.box .swap1 li:first-child');
        var $elCont = $('.box .swap1');
        $el.css({ "top":  posRem + 2 + "rem" });
        $elCont.css({ "transform" : ""});
        $elCont.css({ "transform" : "translateY(-" + nextIndex + 2 + "rem)"});
        $el.clone(true).appendTo('.box .swap1');
        $el.remove();
    }
}