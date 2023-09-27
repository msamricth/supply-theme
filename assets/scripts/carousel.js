function splider(splideBlock){
    var sliderID = splideBlock.id;
    var slider = document.getElementById(sliderID);
    var slidrGap = slider.getAttribute('data-gap');
    const slidrType = slider.getAttribute('data-type');
    const slidrDrag = slider.getAttribute('data-drag');
    const slidrPerMove = slider.getAttribute('data-per_move');
    const addlOptions = slider.getAttribute('data-additional-options');
    const ifCustomHeight = slider.hasAttribute('data-custom_height');
    const ifSameHeight = slider.hasAttribute('data-same-height');
    var s320 = slider.getAttribute('data-s320');
    var s768 = slider.getAttribute('data-s768');
    var s1024 = slider.getAttribute('data-s1024');
    var s1290 = slider.getAttribute('data-s1290');
    var s1440 = slider.getAttribute('data-s1440');
    var s1920 = slider.getAttribute('data-s1920');
    var s2400 = slider.getAttribute('data-s2400');

    
    
    var slidrArrows = slider.getAttribute('data-arrows');
    sliderID = '#'+sliderID;
    if(slidrArrows == 'false') {
        slidrArrows = false;
    }
    
    slidrGap = parseInt(slidrGap);
    document.addEventListener( 'DOMContentLoaded', function () {
        function thisHeight(){
            return $(this).height();
        }
        var $largePaging = 3,
            $mediumPaging = 2,
            $smallPaging = 1,
            sldrMaxHeight = 400;
        function getMaxHeight(className) {
          var max = 0;
           document.querySelectorAll(className).forEach(
                function(el) {
              if (el.scrollHeight > max) {
                max = el.scrollHeight;
              }
            }
          );
      
          return max;
        }
        if(s320){} else {s320 = $smallPaging;}
        if(s768){} else {s768 = $mediumPaging;}
        if(s1024){} else {s1024 = $mediumPaging;}
        if(s1290){} else {s1290 = $mediumPaging;}
        if(s1440){} else {s1440 = $mediumPaging;}
        if(s1920){} else {s1920 = $largePaging;}
        if(s2400){} else {s2400 = $largePaging;}
        var max = getMaxHeight('.splide__slide');
        document.body.style.setProperty('--supply-carousel-height', max + 'px');

        if(slidrGap == ''){
            slidrGap = 40;
        }
        var splide = '';
        if(ifSameHeight) {
            if(ifCustomHeight){
                const CustomHeight = slider.getAttribute('data-custom_height');
                document.body.style.setProperty('--supply-carousel-height', CustomHeight/2 + 'px');
                document.body.style.setProperty('--supply-carousel-maxheight', CustomHeight+'px');
            }
            splide = new Splide( sliderID, {
                arrows: slidrArrows,
                gap: slidrGap,
                pagination: false, 
                type: slidrType,
                drag: slidrDrag,
                autoWidth: true,
                mediaQuery: 'min',
                breakpoints: {
                1920: {
                    padding: { left: 120, right: 120 },
                    fixedHeight: '705px',
                },
                1440: {
                    padding: { left: 120, right: 120 }
                },
                1290: {
                    padding: { left: 120, right: 120 }
                },
                1024: {
                    padding: { left: 92, right: 92 },
                    fixedHeight: '562px',
                },
                768: {
                    padding: { left: 72, right: 76 },
                    fixedHeight: '405px',
                },
                320: {
                    padding: { left: 40, right: 77 },
                    fixedHeight: '177px',
                }
                },
                addlOptions
          });
     
          (function(){
            var
              is_ios = /iP(ad|od|hone)/i.test(window.navigator.userAgent),
              is_safari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/);
                if ( is_ios && is_safari ) {


                    var iosSlides = slider.querySelectorAll('.splide__slide');
                    iosSlides.forEach((element, index) => {
                        var slideWidth = element.getElementsByTagName("img").width;
                        element.style.setProperty('width', slideWidth);
                    });                  
                }
          })();
        } else {
            window.addEventListener('resize', function(event) {
          
                var max = getMaxHeight('.splide__slide');
                document.body.style.setProperty('--supply-carousel-height', max + 'px');
            });
            splide = new Splide( sliderID, {
            arrows: slidrArrows,
            gap: slidrGap,
            pagination: false, 
            perPage: 2,
            type: slidrType,
            drag: slidrDrag,
            perMove: slidrPerMove,
            mediaQuery: 'min',
            breakpoints: {
                2400: {
                padding: { left: 156, right: 156 },
                perPage: s2400,
                },
                1920: {
                padding: { left: 156, right: 156 },
                perPage: s1920,
                },
                1440: {
                padding: { left: 120, right: 120 },
                perPage: s1440,
                },
                1290: {
                padding: { left: 104, right: 104 },
                perPage: s1290,
                },
                1024: {
                padding: { left: 92, right: 92 },
                perPage: s1024,
                autoWidth: false
                },
                868: {
                autoWidth:true
                },
                768: {
                padding: { left: 72, right: 76 },
                perPage: s768,
                autoWidth:false
                },
                420: {
                autoWidth:true
                },
                320: {
                padding: { left: 38, right: 77 },
                perPage: s320,
                },
                0: {
                    padding: { left: 38, right: 77 },
                    perPage: $smallPaging

                }
            },
            addlOptions
            });
        }
      
      splide.mount();
      });

}
let splideBlocks = document.getElementsByClassName("splide");
if(splideBlocks.length  > 0) {
        
    for (var i = 0; i < splideBlocks.length; i++) {
        splider(splideBlocks[i])
     }

      document.addEventListener("DOMContentLoaded", function() {
		var lazyVideos = document.querySelectorAll(".splide__slide  video.selfhosted.lazy");
        var loadVids = function() {
            console.log("test");
          }
          function loadVid(video){
            for (var source in video.children) {
                var videoSource = video.children[source];
                if (typeof videoSource.tagName === "string" && videoSource.tagName === "SOURCE") {
                  videoSource.src = videoSource.dataset.src;
                }
              }
    
              video.load();
              video.classList.remove("lazy");
          }
          lazyVideos.forEach((element, index) => {loadVid(element)});
	  });
}

var captions = document.querySelectorAll(".splide__slide__caption");
(function($) {
    $(window).load(function() { 
        if (captions) {
            var maxHeight = 0;
            $('.splide__slide__caption > span').each(function(){
            if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
            });

            $(".splide__slide__caption").height(maxHeight);
        }
    });
})( jQuery );