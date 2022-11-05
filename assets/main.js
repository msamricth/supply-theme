// Webpack Imports
import * as bootstrap from 'bootstrap';
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){function i(){var b,c,d={height:f.innerHeight,width:f.innerWidth};return d.height||(b=e.compatMode,(b||!a.support.boxModel)&&(c="CSS1Compat"===b?g:e.body,d={height:c.clientHeight,width:c.clientWidth})),d}function j(){return{top:f.pageYOffset||g.scrollTop||e.body.scrollTop,left:f.pageXOffset||g.scrollLeft||e.body.scrollLeft}}function k(){if(b.length){var e=0,f=a.map(b,function(a){var b=a.data.selector,c=a.$element;return b?c.find(b):c});for(c=c||i(),d=d||j();e<b.length;e++)if(a.contains(g,f[e][0])){var h=a(f[e]),k={height:h[0].offsetHeight,width:h[0].offsetWidth},l=h.offset(),m=h.data("inview");if(!d||!c)return;l.top+k.height>d.top&&l.top<d.top+c.height&&l.left+k.width>d.left&&l.left<d.left+c.width?m||h.data("inview",!0).trigger("inview",[!0]):m&&h.data("inview",!1).trigger("inview",[!1])}}}var c,d,h,b=[],e=document,f=window,g=e.documentElement;a.event.special.inview={add:function(c){b.push({data:c,$element:a(this),element:this}),!h&&b.length&&(h=setInterval(k,250))},remove:function(a){for(var c=0;c<b.length;c++){var d=b[c];if(d.element===this&&d.data.guid===a.guid){b.splice(c,1);break}}b.length||(clearInterval(h),h=null)}},a(f).bind("scroll resize scrollstop",function(){c=d=null}),!g.addEventListener&&g.attachEvent&&g.attachEvent("onfocusin",function(){d=null})});

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
	function calcHeight(value) {
		let numberOfLineBreaks = (value.match(/\n/g) || []).length;
		// min-height + lines x line-height + padding + border
		let heightVar = 30;
		let newHeight = heightVar + numberOfLineBreaks * heightVar + 12 + 2;
		return newHeight;
	  }
	let textareaEX = document.querySelector("textarea.form-control");
	if(textareaEX){
		textareaEX.addEventListener("keyup", () => {
			textareaEX.style.height = calcHeight(textareaEX.value) + "px";
		});
	}
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
				iframe.classList.remove("d-none");
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
		const logoCarousel = document.querySelector('.logo-carousel');
		var navbar = $('nav#header');
		var navbarCollapse = $('.navbar-collapse');
		var pBody = $('body');
		var foldContainer = $('.fold-container');
		var footerContent =$('.footer-content');
		var footerLinks = $('.footer-content .fl a');
		var animatedInput = $('input.link-up');


		if(logoCarousel){
			function loop ($swap) {
				var secLastLiA = $('.box .swap li').eq(-2);
				var nextIndex1 = $swap.index() + 1;
				if(secLastLiA.hasClass('visible')){cloneLogoA(nextIndex1);}
				
				var next = $swap.find("li.visible").removeClass("visible").index() + 1;
				
				if(next >= $swap.find("li").length) {
				}
				$swap.width($($swap.find("li").get(next)).addClass("visible").outerWidth());
				
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
				$swap1.width($($swap1.find("li").get(next)).addClass("visible").outerWidth());
				
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

		const caseStudyPage = document.querySelector('.deep-dive-CS');
		
		if(caseStudyPage){
			const videos = document.querySelectorAll(".videofx"); // Select ALL the Videos
			const observer = new IntersectionObserver((entries) => {
			  entries.forEach((entry) => {
				if (!entry.isIntersecting) {
				  var data = { method: "pause" };
				} else {
				  var data = { method: "play" };
				}
				entry.target.contentWindow.postMessage(JSON.stringify(data), "*");
			  });
			}, {});
			for (const video of videos) observer.observe(video); // Observe EACH video
			const onVisibilityChange = () => {
			  if (document.hidden) {
				
				var data = { method: "pause" };
				for (const video of videos) video.contentWindow.postMessage(JSON.stringify(data), "*"); // Pause EACH video
			  } else {
				var data = { method: "play" };
				for (const video of videos) video.contentWindow.postMessage(JSON.stringify(data), "*"); // Play EACH video
			  }
			};
			document.addEventListener("visibilitychange", onVisibilityChange);
		}
		if(animatedInput.length){
			animatedInput.after('<span class="linked-up">></span>');
		}
		navbar.on('show.bs.collapse', function () {
			setTimeout(
				function() {
					pBody.addClass('nd-open');
					navbar.addClass('mobile-nav-open');
			}, 600);
		  });		  
		  navbar.on('hide.bs.collapse', function () {
			setTimeout(
				function() {
					pBody.removeClass('nd-open');
					navbar.removeClass('mobile-nav-open');
			}, 600);
		  })
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
				
			const screenWidth  = window.innerWidth;
			const screenHeight = window.innerHeight;	
			const contentContainer = document.querySelector('.fold-container');
			var homeHeader = $('.home-header');
			const headerContainer = document.querySelector('.header-container');
			var homeMain = $('.home-main');
			if(contentContainer) {
				
				const header = document.querySelector('#header');
				const targets = document.getElementsByClassName('fold');
				const options = {
				root: null, // null means root is viewport
				rootMargin: '0px',
				threshold: 0.5 // trigger callback when 75% of the element is visible
				}
				function callback(entries, observer) { 
					entries.forEach(entry => {
						if(entry.isIntersecting){
							contentContainer.style.color = '';
							contentContainer.style.background = '';
							const foldClass = entry.target.dataset.class; // identify which element is visible in the viewport at 75%
							const containerClasses = contentContainer.classList;
							foldCheck(foldClass, containerClasses, entry);
							
							console.log('fold inview:' + foldClass);
								
						}
					});
				};
				let observer = new IntersectionObserver(callback, options);
				window.addEventListener('resize', function(event) {
					if(navbarCollapse.hasClass('show')){
						pBody.removeClass('nd-open');
						navbar.removeClass('mobile-nav-open');
						navbarCollapse.collapse('hide');
					}
					[...targets].forEach(target => observer.observe(target));
				}, true);
				
				[...targets].forEach(target => observer.observe(target));
				function foldCheck(foldClass, containerClasses, entry){
					
					if(homeHeader.length > 0) {
						if(screenHeight > screenWidth) {
							window.addEventListener("scroll", function() {
								var elementTarget = document.querySelector('.home-header');
								if (window.scrollY < (elementTarget.offsetTop + elementTarget.offsetHeight)) {
									contentContainer.classList.remove('bg-light', 'bg-pattern', 'bg-pattern-fold');
										contentContainer.addClass('bg-dark');
										checkNavAgainstFold("bg-dark");
										console.log('header inview');
								} else {
									foldChanger(foldClass, containerClasses, entry);
									if(foldClass == 'bg-pattern' && containerClasses.contains('bg-pattern-fold')) {
										if(containerClasses.contains('bg-dark')) {
											contentContainer.classList.remove("bg-dark");
											
										console.log('header else script');
										}
									}
								} 
								if (window.scrollY > (elementTarget.offsetTop + elementTarget.offsetHeight)) {
									foldChanger(foldClass, containerClasses, entry);
									if(foldClass == 'bg-pattern' && containerClasses.contains('bg-pattern-fold')) {
										if(containerClasses.contains('bg-dark')) {
											contentContainer.classList.remove("bg-dark");
											
										console.log('fold inview');
										}
									}
								}
							});
						} else {
							foldChanger(foldClass, containerClasses, entry);
							if(foldClass == 'bg-pattern' && containerClasses.contains('bg-pattern-fold')) {
								if(containerClasses.contains('bg-dark')) {
									contentContainer.classList.remove("bg-dark");
									
								console.log('fold inview');
								}
							}
						}
						
					} else if(headerContainer) { 

						if(screenHeight > screenWidth) {

							let headerOptions = {
								rootMargin: '0px',
								threshold: 0.5
							}
							let headerCallback = (hentries, observer) => { 
								hentries.forEach(hentry => {
								
									if (hentry.intersectionRatio === 0) {
										console.log('Header is NOT in viewport');
										checkNavAgainstFold('bg-light');
										foldChanger(foldClass, containerClasses, entry);
									} else {
										if (hentry.intersectionRatio > 0.5) {
											transparentNavFold();
											console.log('Header is in viewport');
										}
										
									}
								});
							};
							let headerObserver = new IntersectionObserver(headerCallback, headerOptions);
							
							let target = headerContainer; //document.querySelector('#oneElement') or document.querySelectorAll('.multiple-elements')
							headerObserver.observe(target); // if you have multiple elements, loop through them to add observer
						} else {
							foldChanger(foldClass, containerClasses, entry);		
						}		
					} else {
						foldChanger(foldClass, containerClasses, entry)
					}  

				}
				function foldChanger(foldClass, containerClasses, entry){
					
				
					switch (foldClass) {
						case 'bg-custom':
							contentContainer.classList.remove("bg-dark", "bg-light", "bg-pattern-fold", "bg-black", "adjust-text","fold-text-white","fold-text-dark","bg-custom");
							const foldBG = entry.target.dataset.bg;
							const foldColor = entry.target.dataset.color;
							if(foldColor == 'default'){
								checkFoldColor(foldColor);
							} else {
								contentContainer.style.color = foldColor;
							}
							contentContainer.style.background = foldBG;
							break;
						case 'bg-pattern':
							checkNavAgainstFold('bg-light');
								if(containerClasses.contains('bg-pattern-fold')){ 
								} else {
									contentContainer.classList.remove("bg-dark", "bg-light", "bg-pattern-fold", "bg-black", "adjust-text","fold-text-white","fold-text-dark","bg-custom");
									contentContainer.classList.add('bg-light');
									setTimeout(
										function() {
											contentContainer.classList.add('bg-pattern-fold');
									}, 800);
							}							
							// code block
							break;
						case 'header':
							if(transparentNav) {
								transparentNavFold();
							} else {
								if(homeHeader.length > 0) {
									contentContainer.classList.remove("bg-dark", "bg-light", "bg-pattern-fold", "bg-black", "adjust-text","fold-text-white","fold-text-dark","bg-custom");
									contentContainer.classList.add("bg-dark");
									checkNavAgainstFold("bg-dark");
								}
							}
							// code block
							break;
						default:
							contentContainer.classList.remove("bg-dark", "bg-light", "bg-pattern-fold", "bg-black", "adjust-text","fold-text-white","fold-text-dark","bg-custom");
							contentContainer.classList.add(`${foldClass}`);
							checkNavAgainstFold(foldClass);
						// code block
					}
					
							//for troubleshooting 
							console.log("The current fold theme is in the view port:" + foldClass);
				}
				
				function transparentNavFold (){
					if(navbar.hasClass('dark-scheme')){
						var scheme = 'dark';
					} else {
						if(navbar.hasClass('light-scheme')){
							var scheme = 'light';
						} else {
							var scheme = 'error';
						}
					}
					var classTransparentVar = 'bg-transparent-'+ scheme +' navbar-'+scheme;
					var headerContainer = $('.header-container');
					var headerSize = headerContainer.outerHeight();
					checkNavAgainstFold('clear');
					navbar.addClass(classTransparentVar);
				}
				function checkNavAgainstFold(functionColor){
					var foldClass = functionColor;
					var lightClass = 'bg-light navbar-light';
					var lightTransparentClass = 'navbar-light bg-transparent-light';
					var darkClass = 'bg-dark navbar-dark';
					var darkTransparentClass = 'navbar-dark bg-transparent-dark';
					var theme = foldClass.replace('bg-', '');
		 
					var classVar = foldClass +' navbar-'+theme;
					var classPossibilities = lightClass + lightTransparentClass + darkClass + darkTransparentClass;
					navbar.removeClass(darkClass);
					navbar.removeClass(lightClass);	
					navbar.removeClass(lightTransparentClass);
					navbar.removeClass(darkTransparentClass);
					if(foldClass.indexOf('clear') !== -1){
					} else {
						navbar.addClass(classVar);
					}
				};
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