( function () {
	'use strict';
    (function($) {
        const transparentNav = document.querySelector('.navbar-transparent');
        const caseStudy = document.querySelector('.single-case-studies');
        var navbar = $('nav#header');
        var navbarCollapse = $('.navbar-collapse');
        var pBody = $('body');
        var foldContainer = $('.fold-container');
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
            rootMargin: '-50px 0px -55%', // 50px from the top, 55% above bottom
            threshold: 1 // trigger callback when 100% of the element is visible
            }
            function callback(entries, observer) { 
                entries.forEach(entry => {
                    if(entry.isIntersecting){
                        contentContainer.style.color = '';
                        contentContainer.style.background = '';
                        const foldClass = entry.target.dataset.class; // identify which element is visible in the viewport at 75%
                        const containerClasses = contentContainer.classList;
                        foldCheck(foldClass, containerClasses, entry);
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
                        window.addEventListener("scroll", function() {
                            var elementTarget = document.querySelector('.home-header');
                            if (window.scrollY < (elementTarget.offsetTop + elementTarget.offsetHeight)) {
                                contentContainer.classList.remove('bg-light', 'bg-pattern', 'bg-pattern-fold');
                                    contentContainer.classList.add('bg-dark');
                                    checkNavAgainstFold("bg-dark");
                            } else {
                                foldChanger(foldClass, containerClasses, entry);
                                if(foldClass == 'bg-pattern' && containerClasses.contains('bg-pattern-fold')) {
                                    if(containerClasses.contains('bg-dark')) {
                                        contentContainer.classList.remove("bg-dark");
                                    }
                                }
                            } 
                        });
                    
                    
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
                    //	console.log("The current fold theme is in the view port:" + foldClass);
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
	})( jQuery );

} )();