// Webpack Imports
import * as bootstrap from 'bootstrap';
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){function i(){var b,c,d={height:f.innerHeight,width:f.innerWidth};return d.height||(b=e.compatMode,(b||!a.support.boxModel)&&(c="CSS1Compat"===b?g:e.body,d={height:c.clientHeight,width:c.clientWidth})),d}function j(){return{top:f.pageYOffset||g.scrollTop||e.body.scrollTop,left:f.pageXOffset||g.scrollLeft||e.body.scrollLeft}}function k(){if(b.length){var e=0,f=a.map(b,function(a){var b=a.data.selector,c=a.$element;return b?c.find(b):c});for(c=c||i(),d=d||j();e<b.length;e++)if(a.contains(g,f[e][0])){var h=a(f[e]),k={height:h[0].offsetHeight,width:h[0].offsetWidth},l=h.offset(),m=h.data("inview");if(!d||!c)return;l.top+k.height>d.top&&l.top<d.top+c.height&&l.left+k.width>d.left&&l.left<d.left+c.width?m||h.data("inview",!0).trigger("inview",[!0]):m&&h.data("inview",!1).trigger("inview",[!1])}}}var c,d,h,b=[],e=document,f=window,g=e.documentElement;a.event.special.inview={add:function(c){b.push({data:c,$element:a(this),element:this}),!h&&b.length&&(h=setInterval(k,250))},remove:function(a){for(var c=0;c<b.length;c++){var d=b[c];if(d.element===this&&d.data.guid===a.guid){b.splice(c,1);break}}b.length||(clearInterval(h),h=null)}},a(f).bind("scroll resize scrollstop",function(){c=d=null}),!g.addEventListener&&g.attachEvent&&g.attachEvent("onfocusin",function(){d=null})});
import Splide from '@splidejs/splide';
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
		var splide = new Splide( '.splide', {
			direction: 'ttb',
			height   : '16rem',
			autoplay: true,
			perMove: 1,
			arrows: false,
			speed:400,
			gap: '48px',
			type  : 'loop',
			padding: { top: '60px'},
			updateOnMove: true,
			pagination: false,
			pauseOnFocus: false,
			pauseOnHover: false,
			perPage: 2,
			breakpoints: {
				  768: {
					  gap:58,
					  padding: { top: '0px'}
				  },
				  1024: {
					  gap:105
				  },
				  1290: {
					gap:58
				},
				  1920: {
					gap:79
				},
			}
		  } );
		  
		  splide.mount();
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
		var footerContent =$('.footer-content');
		var footerLinks = $('.footer-content .fl a');
		
		footerLinks.each(function(i, obj) {
			var footerLink = $(this);
			footerLink.on("mouseenter", function(){     
				footerContent.addClass('hovered');    
			}), footerLink.on("mouseleave", function(){    
				footerContent.removeClass('hovered');     
			});
		});
		jQuery(function() {
			var $message = $('#message');
				if(($message).length) {
					expandTextarea('message');
				}			
			var $contentContainer = $('.fold-container');
			var homeHeader = $('.home-header');
			function checkHeader(){
				homeHeader.on('inview', function(event, isInView) {
					var scrollObject = $(this);
					if (isInView) {
							$contentContainer.removeClass('bg-light');
							$contentContainer.removeClass('bg-pattern');
					} 
				});
			}
			
			if($contentContainer) {
				// list of elements to be observed
				const targets = document.getElementsByClassName('fold');
				
				const header = document.querySelector('#header');

				const options = {
				root: null, // null means root is viewport
				rootMargin: '0px',
				threshold: 0.5 // trigger callback when 75% of the element is visible
				}

				function callback(entries, observer) { 
					entries.forEach(entry => {
						const winPos = window.scrollY;
						if(entry.isIntersecting){
							const contentContainer = document.querySelector('.fold-container');
						contentContainer.style.color = '';
						contentContainer.style.background = '';
						const foldClass = entry.target.dataset.class; // identify which element is visible in the viewport at 75%
						const containerClasses = contentContainer.classList;
						if(foldClass == 'bg-pattern' && containerClasses.contains('bg-pattern-fold')) {
							if(containerClasses.contains('bg-dark')) {
								if(winPos === 0){
									checkHeader();
								} else {
									contentContainer.classList.remove("bg-dark");
								}
							}
						} else {
							contentContainer.classList.remove("bg-dark", "bg-light", "bg-pattern-fold", "bg-black", "adjust-text","fold-text-white","fold-text-dark","bg-custom");
						}
						if(foldClass == 'bg-custom') {
							const foldBG = entry.target.dataset.bg;
							const foldColor = entry.target.dataset.color;
							if(foldColor == 'default'){
								checkFoldColor(foldColor);
							} else {
								contentContainer.style.color = foldColor;
							}
							contentContainer.style.background = foldBG;
						}
						if(foldClass == 'bg-pattern') {
							if(containerClasses.contains('bg-dark')){
							} else {
								contentContainer.classList.add('bg-light');
								setTimeout(
									function() {
										contentContainer.classList.add('bg-pattern-fold');
								}, 800);
							}								
							} else {
								contentContainer.classList.add(`${foldClass}`);
							}
						}	
						if(winPos === 0){
							checkHeader();
						} 
					});
				};
				let observer = new IntersectionObserver(callback, options);

				if(homeHeader.length > 0) {
					homeHeader.on('inview', function(event, isInView) {
						var scrollObject = $(this);
						if (isInView) {
								$contentContainer.removeClass('bg-light');
								$contentContainer.removeClass('bg-pattern');
								$contentContainer.addClass('bg-dark');
						} else {
							[...targets].forEach(target => observer.observe(target));
						}
					});
				} else {
					[...targets].forEach(target => observer.observe(target));
				}
	
				function checkFoldColor(){
					//extract R G and B from element background color
					var contentContainer = $('.fold-container');
					let backgroundColor = contentContainer.css("background-color");
					backgroundColor =  backgroundColor.split(',')
					let R = parseInt(backgroundColor[0].split('(')[1])
					let G = parseInt(backgroundColor[1])
					let B = parseInt(backgroundColor[2].split(')')[0])
			
					//Convert RGB to HSL
					
					//The R,G,B values are divided by 255 to change the range from 0..255 to 0..1
					let rPrime = R/255
					let gPrime = G/255
					let bPrime = B/255
					//Then we extract max and min values
					let cMax = Math.max(rPrime, gPrime, bPrime)
					let cMin = Math.min(rPrime, gPrime, bPrime)
					/*
					HSL is Hue, saturation and lightness.
					We need only lightness to determine if the color is bright or dark.
					So we gonna calculate only the last value with formula: L = (Cmax + Cmin) / 2
					*/
				   let lightness = (cMax + cMin)/2
				   /*
				   Now we gonna check if our lightness is >50% or < 50%.
				   If it is >50% we are goin to change text color to black
				   otherwise, we gonna set text color to white.
				   */
				  	var contentContainer = $('.fold-container');
					lightness >= 0.50 ? contentContainer.addClass('fold-text-dark') : contentContainer.addClass('fold-text-white');
				}
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
				var navHeader = $('.navuncatch');
				navHeader.on('inview', function(event, isInView) {
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
						if(window.scrollY==0){
							navbar.removeClass('bg-light navbar-light');
							if(navbar.hasClass('dark-scheme')){
								navbar.addClass('navbar-dark bg-transparent-dark');		
							}
							if(navbar.hasClass('light-scheme')){
								navbar.addClass('navbar-light bg-transparent-light');		
							}
						} else {
							navbar.addClass('bg-light navbar-light');
							if(navbar.hasClass('dark-scheme')){
								navbar.removeClass('navbar-dark bg-transparent-dark');		
							}
							if(navbar.hasClass('light-scheme')){
								navbar.removeClass('navbar-light bg-transparent-light');		
							}
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