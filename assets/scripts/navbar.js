var navbar = $('nav#header');
var navbarCollapse = $('.navbar-collapse');
var pBody = $('body');

navbar.on('show.bs.collapse', function () {
    setTimeout(
        function() {
            pBody.addClass('nd-open');
            navbar.addClass('mobile-nav-open is-active');
    }, 300);
});		  
navbar.on('hide.bs.collapse', function () {
    setTimeout(
        function() {
            pBody.removeClass('nd-open');
            pBody.addClass('nd-closing');
            navbar.removeClass('mobile-nav-open is-active');
    }, 300);
});
navbar.on('hidden.bs.collapse', function () {
    setTimeout(
        function() {
            pBody.removeClass('nd-closing');
    }, 300);
});
jQuery(function() {
    var previousScroll = 0;
    $(window).scroll(function () {
        var currentScroll = $(this).scrollTop();
        if (currentScroll < 250) {
            showNav();
        } else if (currentScroll > 0 && currentScroll < $(document).height() - $(window).height()) {
            if (currentScroll > previousScroll) {
                hideNav();
            } else {
                showNav();
            }
            previousScroll = currentScroll;
        }
        hideGRecaptcha();
    });

    function hideNav() {
        navbar.removeClass("is-visible").addClass("is-hidden");
    }

    function showNav() {
        navbar.removeClass("is-hidden").addClass("is-visible").addClass("scrolling");
    }
});
function hideGRecaptcha() {
    var $cf7Form = $('.wpcf7-form'),
    $gREC = $('.grecaptcha-badge');
    
    if($gREC.length){
        var $gRECParent = $gREC.parent().closest('div');
        $(document).ready(function () {
            if($cf7Form) {
                if($gRECParent.hasClass('gre-loaded')) {} else {
                    $gRECParent.addClass('d-none gre-loaded');
                }
            }
        });
        $cf7Form.on('inview', function(event, isInView) {
            if (isInView) {
                setTimeout(
                    function() {
                        $gRECParent.removeClass('d-none');
                    }, 400);
                
            } else {
                $gRECParent.addClass('d-none');
            }
        });
    }
}