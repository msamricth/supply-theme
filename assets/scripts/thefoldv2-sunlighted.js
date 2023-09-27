const foldON = document.body.classList.contains('fold_on');
const Wrapper = document.getElementById('wrapper');
const bodyOG  = Wrapper.dataset.og_class;
const dotsON = document.body.classList.contains('dots_on');
const header = document.getElementById('header');
const sections = [...document.querySelectorAll('.fold')]

const scrollRoot = document.querySelector('[data-scroller]')
const headerLinks = [...document.querySelectorAll('[data-link]')]

var navbar = $('nav#header');
let prevYPosition = 0
let direction = 'up'

const options = {
	root: null,
	rootMargin: `${header.offsetHeight * -1}px`,
	threshold: 0
}

const getTargetSection = (entry) => {
	const index = sections.findIndex((section) => section == entry.target)
	
	if (index >= sections.length - 1) {
	 return entry.target
	} else {
	 return sections[index + 1]
    //console.log(sections[index + 1].dataset.color);
	}
}

const updateColors = (target) => {
	const theme = target.dataset.class;
	if(theme){
		if (Wrapper.style.background) {
			Wrapper.style.background = '';		
		}
		Wrapper.style.removeProperty('--supply-fold-color');
		switch (theme) {
			case 'header':
				Wrapper.classList = bodyOG + ' bg-header';
				break;
			case 'undefined':
				Wrapper.classList = bodyOG;
				console.log('No trigger detected');
				break;
			case 'bg-pattern':
				if(Wrapper.classList.contains(theme)){
					if(Wrapper.classList.contains('bg-header')){
						Wrapper.classList = 'bg-light';
						setTimeout(
							function() {
								Wrapper.classList = 'bg-light ' + theme;
						}, 400);
					}
				} else {
					Wrapper.classList = 'bg-light';
					setTimeout(
						function() {
							Wrapper.classList = 'bg-light ' + theme;
					}, 400);
				}
				break;
			case 'bg-custom':
				Wrapper.classList = theme;
				const foldBG = target.dataset.bg;
				const foldColor = target.dataset.color;
				if(foldColor == 'default'){
					checkFoldColor(foldColor);
				} else {
					Wrapper.style.setProperty('--supply-fold-color', foldColor);
				}
				Wrapper.style.background = foldBG;
				break;
			default:
				if(Wrapper.classList.contains(theme)){
					if(Wrapper.classList.contains('bg-header')){
						Wrapper.classList = theme;
					}
				} else {
					Wrapper.classList = theme;
				}
		}
	} else {
		Wrapper.classList = bodyOG;
		console.log('No trigger detected');
	}
 
  console.log(theme);
}

const shouldUpdate = (entry) => {

	// new condition needed - if header is at top return

	if (direction === 'down' && !entry.isIntersecting) {
		return true
	}

	if (direction === 'up' && entry.isIntersecting) {
		return true
	}
	
	return false
}

const onIntersect = (entries, observer) => {
	entries.forEach((entry) => {


		if (document.body.scrollTop > prevYPosition) {
			direction = 'down';
		} else {
			direction = 'up';
		}
		
		prevYPosition = document.body.scrollTop
		
		const target = direction === 'down' ? getTargetSection(entry) : entry.target
		
		if (shouldUpdate(entry)) {
			updateColors(target)
		}
	})
}
function hideNav() {
  navbarMain.classList.remove("is-visible");
  navbarMain.classList.add("is-hidden");
}

function showNav() {
  navbarMain.classList.remove("is-hidden");
  navbarMain.classList.add("is-visible", "scrolling");
}
const observer = new IntersectionObserver(onIntersect, options)


sections.forEach((section) => {
	observer.observe(section)
	setTimeout(
		function() {observer.observe(section)
	}, 600);
})

function checkFoldColor(){
	//extract R G and B from element background color
	var contentContainer = $('#wrapper');
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
	var contentContainer = $('#wrapper');
	lightness >= 0.50 ? Wrapper.style.setProperty('--supply-fold-color', '#111512') : Wrapper.style.setProperty('--supply-fold-color', '#fff') ;
} 