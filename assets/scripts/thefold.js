import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

//Articles sticky fade in
const articleInteriorPage = document.querySelector(".supply-articles");
const sidebar = document.querySelector(".sidbar-meta");
if(articleInteriorPage){
		gsap.from(".sidbar-meta", {
		scrollTrigger: {
			onEnter: () => fadeintop(),
			start: 'top 45%',
			trigger: ".sidbar-meta",
			end: 'bottom 35%',
			onEnterBack: () => fadeOut()
		}
		});

}

function fadeintop(){
	if(sidebar.classList.contains('fadeOut')){
		sidebar.classList.remove('fadeOut');
	}
	sidebar.classList.add('fade-in-top');
}

function fadeOut(){
	if(sidebar.classList.contains('fade-in-top')){
		sidebar.classList.remove('fade-in-top');
	}
}

//New Fold
const foldON = document.body.classList.contains('fold_on');
const Wrapper = document.getElementById('wrapper');
const bodyOG  = Wrapper.dataset.og_class;
const dotsON = document.body.classList.contains('dots_on');
const lazy_load_videos = document.body.classList.contains('lazy_load_videos');
const caseStudy = document.body.classList.contains('single-case-studies');
const header = document.getElementById('header');
const sections = [...document.querySelectorAll('.fold')]
const selfhosted = document.body.classList.contains('dots_on');
const scrollRoot = document.querySelector('[data-scroller]')
const headerLinks = [...document.querySelectorAll('[data-link]')]
const debuglog = scrollRoot.hasAttribute("debuglog");
const hasCustomTxtColor = Wrapper.hasAttribute("data-color");
const hasCustomBGColor = Wrapper.hasAttribute("data-bg");
var OGbg, OGtxt, foldColor, foldBG;
if(hasCustomBGColor){
	OGbg = Wrapper.getAttribute('data-bg'),
	OGtxt = Wrapper.getAttribute('data-color');
	if(bodyOG == 'bg-custom ') {customFold()};
	
}

var topTA;
var bottomTA;
var scrollActions;
if (!scrollRoot.hasAttribute("data-topta")) {
    // data attribute doesn't exist
	topTA = 'top 35%';
} else {
	topTA = 'top ' + scrollRoot.getAttribute('data-topta');
}  
if (!scrollRoot.hasAttribute("data-bottomta")) {
    // data attribute doesn't exist
	bottomTA = 'bottom 35%';
} else {
	bottomTA = 'bottom ' + scrollRoot.getAttribute('data-bottomta');
}

const nav_compression = document.body.classList.contains('nav_compression');
const debugMarker = scrollRoot.hasAttribute("debugmarker");
const videoMarker = scrollRoot.hasAttribute("videoMarker");
