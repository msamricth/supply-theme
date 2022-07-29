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
				e.target.nextElementSibling.querySelector(".iframe-video").contentWindow.postMessage({method:"play"}, "*"); 
			})
		}
		player.on('play', function() {
			console.log('played the video!');
		});
		player.getVideoTitle().then(function(title) {
			console.log('title:', title);
		});
	}
	(function($) {
		const transparentNav = document.querySelector('.navbar-transparent');
		const caseStudy = document.querySelector('.single-case-studies');
		var navbar = $('nav#header');
		$(document).ready(function () {
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
			});

			function hideNav() {
				navbar.removeClass("is-visible").addClass("is-hidden");
			}

			function showNav() {
				navbar.removeClass("is-hidden").addClass("is-visible").addClass("scrolling");
			}
		});
		if(transparentNav) {
			const colors = ['bg-white', 'bg-dark']

			const sections = [...document.getElementsByTagName('section')]
			
		
			$(document).ready(function () {
			var headerContainer = $('.header-container');
			const footer = document.querySelector('.footer');
			var $contentContainer = $('#content.entry');
			const sections = document.querySelectorAll('.fold');

			$('.fold').each(function(i, obj) {
				//test
				var foldClass = $(this).data("class") 
				$(this).on('inview', function(event, isInView) {
					if (isInView) {
						$contentContainer.removeClass('bg-dark');
						$contentContainer.removeClass('bg-light');
						$contentContainer.addClass(foldClass);
					} else {
					}
				});
				
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
				} else {
					if(navbar.hasClass('dark-scheme')){
						navbar.removeClass('navbar-dark bg-transparent-dark');		
					}
					if(navbar.hasClass('light-scheme')){
						navbar.removeClass('navbar-light bg-transparent-light');		
					}
					navbar.addClass('bg-light navbar-light');
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
		  $('.fadeNoScroll').on('inview', function(event, isInView) {
			var scrollObject = $(this);
			if (isInView) {
				setTimeout(
					function() {
						scrollObject.addClass('in');
					}, 400);
				
			} else {
			}
		  });

	})( jQuery );

} )();