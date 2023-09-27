( function () {
	'use strict';
	// Initialize Popovers: https://getbootstrap.com/docs/5.0/components/popovers
	var popoverTriggerList = [].slice.call( document.querySelectorAll( '[data-bs-toggle="popover"]' ) );
	var popoverList = popoverTriggerList.map( function ( popoverTriggerEl ) {
		return new bootstrap.Popover( popoverTriggerEl, {
			trigger: 'focus',
		} );
	} );
	(function($) {
		var footerContent =$('.footer-content');
		var footerLinks = $('.footer-content .fl a');
		var footerNav = $('#footer .navbar-nav');

		
		footerNav.on("mouseenter", function(){     
			footerContent.addClass('hovered');    
		}), footerNav.on("mouseleave", function(){    
			footerContent.removeClass('hovered');     
		});
		footerLinks.each(function(i, obj) {
			var footerLink = $(this);
			footerLink.on("mouseenter", function(){     
				footerContent.addClass('hovered');    
			}), footerLink.on("mouseleave", function(){    
				footerContent.removeClass('hovered');     
			});
		});

		$('.fadeScroll').on('inview', function(event, isInView) {
			var scrollObject = $(this);
			//if (isInView) {
			//	setTimeout(
			//		function() {
			//			scrollObject.addClass('in');
			//		}, 400);
			//} else {
			//	scrollObject.removeClass('in');
			//}
		  });
		  $('.fadeNoScroll, blockquote').on('inview', function(event, isInView) {
			var scrollObject = $(this);
		//	if (isInView) {
			//	setTimeout(
			//		function() {
			//			scrollObject.addClass('in');
			//		}, 700);
				
			//} else {
		//	}
		  });

	})( jQuery );

} )();
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
function ISiOS() {
	return [
	  'iPad Simulator',
	  'iPhone Simulator',
	  'iPod Simulator',
	  'iPad',
	  'iPhone',
	  'iPod'
	].includes(navigator.platform)
	// iPad on iOS 13 detection
	|| (navigator.userAgent.includes("Mac") && "ontouchend" in document)
  }
var ua = navigator.userAgent || navigator.vendor || window.opera;
var isInstagram = (ua.indexOf('Instagram') > -1) ? true : false;

var iOS = !!ua.match(/iPad/i) || !!ua.match(/iPhone/i);
var webkit = !!ua.match(/WebKit/i);
var iOSSafari = iOS && webkit && !ua.match(/CriOS/i);


var isSafari = (ua.indexOf('Safari') > -1) ? true : false;
if (document.documentElement.classList ){
	if (isInstagram) {
		window.document.body.classList.add('instagram-browser');
    // alert("debugging within the Instagram in-app browser");
	}
	if (isSafari) {
		window.document.body.classList.add('Safari');
    // alert("debugging within the Instagram in-app browser");
	} else if(iOSSafari){
		window.document.body.classList.add('Safari');
	}
	if(ISiOS()){
		window.document.body.classList.add('ios');
	}
}