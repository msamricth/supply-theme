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
	root: scrollRoot,
	rootMargin: `${header.offsetHeight * -1}px`,
	threshold: 0
}

const getTargetSection = (entry) => {
	const index = sections.findIndex((section) => section == entry.target)
	
	if (index >= sections.length - 1) {
	 return entry.target
	} else {
	 return sections[index + 1]
    console.log(sections[index + 1].dataset.color);
	}
}

const updateColors = (target) => {
	const theme = target.dataset.class;
  if(theme === 'header') {
    Wrapper.classList = bodyOG + ' bg-header';
  } else if(theme === 'undefined'){
    Wrapper.classList = bodyOG;
    console.log('No trigger detected');
  }else if (theme === 'bg-light') {
    if(Wrapper.classList.contains('bg-light')){
		if(Wrapper.classList.contains('bg-header')){
			if(dotsON){
				Wrapper.classList = theme;
				setTimeout(
					function() {
						Wrapper.classList.add('bg-pattern');
				}, 800);
			} else {
				Wrapper.classList = theme;
			}
		}
    } else {
        if(dotsON){
            Wrapper.classList = theme;
            setTimeout(
                function() {
                    Wrapper.classList.add('bg-pattern');
            }, 800);
        } else {
            Wrapper.classList = theme;
        }
    }
  } else {
	  Wrapper.classList = theme;
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


		if (scrollRoot.scrollTop > prevYPosition) {
			direction = 'down';
		} else {
			direction = 'up';
		}
		
		prevYPosition = scrollRoot.scrollTop
		
		const target = direction === 'down' ? getTargetSection(entry) : entry.target
		
		if (shouldUpdate(entry)) {
			updateColors(target)
		}
	})
}
function hideNav() {
    navbar.removeClass("is-visible").addClass("is-hidden");
}

function showNav() {
    navbar.removeClass("is-hidden").addClass("is-visible").addClass("scrolling");
}
const observer = new IntersectionObserver(onIntersect, options)


sections.forEach((section) => {
	observer.observe(section)
})