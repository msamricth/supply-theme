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