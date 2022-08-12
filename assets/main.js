// Webpack Imports
import * as bootstrap from 'bootstrap';



( function () {
	'use strict';

	// Focus input if Searchform is empty
	[].forEach.call( document.querySelectorAll( '.search-form' ), ( el ) => {
		el.addEventListener( 'submit', function ( e ) {
			var search = el.querySelector( 'input' );
			if ( search.value.length < 1 ) {
				e.preventDefault();
				search.focus();
			}
		} );
	} );
	
	// Initialize Popovers: https://getbootstrap.com/docs/5.0/components/popovers
	var popoverTriggerList = [].slice.call( document.querySelectorAll( '[data-bs-toggle="popover"]' ) );
	var popoverList = popoverTriggerList.map( function ( popoverTriggerEl ) {
		return new bootstrap.Popover( popoverTriggerEl, {
			trigger: 'focus',
		} );
	} );
	!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){function i(){var b,c,d={height:f.innerHeight,width:f.innerWidth};return d.height||(b=e.compatMode,(b||!a.support.boxModel)&&(c="CSS1Compat"===b?g:e.body,d={height:c.clientHeight,width:c.clientWidth})),d}function j(){return{top:f.pageYOffset||g.scrollTop||e.body.scrollTop,left:f.pageXOffset||g.scrollLeft||e.body.scrollLeft}}function k(){if(b.length){var e=0,f=a.map(b,function(a){var b=a.data.selector,c=a.$element;return b?c.find(b):c});for(c=c||i(),d=d||j();e<b.length;e++)if(a.contains(g,f[e][0])){var h=a(f[e]),k={height:h[0].offsetHeight,width:h[0].offsetWidth},l=h.offset(),m=h.data("inview");if(!d||!c)return;l.top+k.height>d.top&&l.top<d.top+c.height&&l.left+k.width>d.left&&l.left<d.left+c.width?m||h.data("inview",!0).trigger("inview",[!0]):m&&h.data("inview",!1).trigger("inview",[!1])}}}var c,d,h,b=[],e=document,f=window,g=e.documentElement;a.event.special.inview={add:function(c){b.push({data:c,$element:a(this),element:this}),!h&&b.length&&(h=setInterval(k,250))},remove:function(a){for(var c=0;c<b.length;c++){var d=b[c];if(d.element===this&&d.data.guid===a.guid){b.splice(c,1);break}}b.length||(clearInterval(h),h=null)}},a(f).bind("scroll resize scrollstop",function(){c=d=null}),!g.addEventListener&&g.attachEvent&&g.attachEvent("onfocusin",function(){d=null})});

	const cf7Form = document.querySelector('.wpcf7-form');
	const currentURL= document.getElementById('currentURL');
	const currentTitle= document.getElementById('currentTitle');
	const CcurrentURL= document.getElementById('CcurrentURL');
	const CcurrentTitle= document.getElementById('CcurrentTitle');
	if(cf7Form){
		if(currentURL){currentURL.value = window.location.href;}
		if(currentTitle){currentTitle.value = document.title;}
		if(CcurrentURL){CcurrentURL.value = window.location.href;}
		if(CcurrentTitle){CcurrentTitle.value = document.title;}
	}
	const homePage = document.querySelector('.page-template-page-home');
	if(homePage) {
		function play_video() {
			var player = document.getElementById("vimeoFrame");
			var data = { method: "play" };
			player.contentWindow.postMessage(JSON.stringify(data), "*");
		}
		const iframe = document.querySelector('.iframe-video');
		const player = new Vimeo.Player(iframe);
		// Play vimeo video when pressing the play button
		var videoPlaceholders = document.querySelectorAll("#play-button");
		for(var i = 0; i < videoPlaceholders.length; i++) {
			videoPlaceholders[i].addEventListener("click", function(e) {
				e.preventDefault();
				player.play();
				document.querySelector(".video-embed").className += " video-iframe-container";
			})
		}
	}
	function expandTextarea(id) {
		document.getElementById(id).addEventListener('keyup', function() {
			this.style.overflow = 'hidden';
			this.style.height = 0;
			this.style.height = this.scrollHeight + 'px';
		}, false);
	}
	
	(function($) {
		const transparentNav = document.querySelector('.navbar-transparent');
		const caseStudy = document.querySelector('.single-case-studies');
		var navbar = $('nav#header');
		var foldContainer = $('.fold-container');
		$(document).ready(function () {
			var $message = $('#message');
				if(($message).length) {
					expandTextarea('message');
				}			
			var $contentContainer = $('.fold-container');
			const sections = document.querySelectorAll('.fold');
			if($contentContainer) {
				$('.fold').each(function(i, obj) {
					//test
					var foldClass = $(this).data("class"); 
					$(this).on('inview', function(event, isInView) {
						if (isInView) {
							if($contentContainer.hasClass(foldClass)){
							} else {
								$contentContainer.removeClass('bg-dark');
								$contentContainer.removeClass('bg-light');
								$contentContainer.removeClass('bg-pattern');
								if(foldClass == 'bg-pattern') {
									$contentContainer.addClass('bg-light');
									setTimeout(
										function() {
											$contentContainer.addClass(foldClass);
									}, 400);
								} else {
									$contentContainer.addClass(foldClass);
								}
							}
						} else {
						}
					});
				});
			}
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
		if(transparentNav) {
			const colors = ['bg-white', 'bg-dark']

			const sections = [...document.getElementsByTagName('section')]
			
		
			$(document).ready(function () {
				var headerContainer = $('.header-container');
				var navCatch = $('.nav-catch');
				const footer = document.querySelector('.footer');
				
				headerContainer.on('inview', function(event, isInView) {
					var scrollObject = $(this);
					if (isInView) {
						navbar.removeClass('bg-light navbar-light');
						if(navbar.hasClass('dark-scheme')){
							navbar.addClass('navbar-dark bg-transparent-dark');		
						}
						if(navbar.hasClass('light-scheme')){
							navbar.addClass('navbar-light bg-transparent-light');		
						}
					} 
				});
				navCatch.on('inview', function(event, isInView) {
					var scrollObject = $(this);
					if (isInView) {
						navbar.addClass('bg-light navbar-light');
						if(navbar.hasClass('dark-scheme')){
							navbar.removeClass('navbar-dark bg-transparent-dark');		
						}
						if(navbar.hasClass('light-scheme')){
							navbar.removeClass('navbar-light bg-transparent-light');		
						}
					}
				});
			});
		}
	
		$('.fadeScroll').on('inview', function(event, isInView) {
			var scrollObject = $(this);
			if (isInView) {
				setTimeout(
					function() {
						scrollObject.addClass('in');
					}, 400);
				
			} else {
				scrollObject.removeClass('in');
			}
		  });
		  $('.fadeNoScroll, blockquote').on('inview', function(event, isInView) {
			var scrollObject = $(this);
			if (isInView) {
				setTimeout(
					function() {
						scrollObject.addClass('in');
					}, 700);
				
			} else {
			}
		  });

	})( jQuery );

} )();