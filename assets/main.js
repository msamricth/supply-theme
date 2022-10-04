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
			if($contentContainer) {
				// list of elements to be observed
				const targets = document.getElementsByClassName('fold')

				const options = {
				root: null, // null means root is viewport
				rootMargin: '0px',
				threshold: 0.5 // trigger callback when 50% of the element is visible
				}

				function callback(entries, observer) { 
				entries.forEach(entry => {

					if(entry.isIntersecting){
						const contentContainer = document.querySelector('.fold-container');
					
					contentContainer.classList.remove("bg-dark", "bg-light", "bg-pattern", "bg-black");
					const foldClass = entry.target.dataset.class; // identify which element is visible in the viewport at 50%
					if(foldClass == 'bg-pattern') {
								contentContainer.classList.add('bg-light');
						setTimeout(
														function() {
															contentContainer.classList.add(`${foldClass}`);
													}, 400);
								
						} else {
							contentContainer.classList.add(`${foldClass}`);
						}
					}
				});
				};
				let observer = new IntersectionObserver(callback, options);

				[...targets].forEach(target => observer.observe(target));

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