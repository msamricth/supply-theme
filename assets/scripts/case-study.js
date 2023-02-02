const ifcasestudy = document.body.classList.contains('single-case-studies');

if(ifcasestudy) {
    const appHeight = () => {
        function iOS() {
            return [
              'iPad Simulator',
              'iPhone Simulator',
              'iPod Simulator',
              'iPad',
              'iPhone',
              'iPod'
            ].includes(navigator.platform)
            // iPad on iOS 13 detection
            || (navigator.userAgent.includes("Mac") && "ontouchend" in document)
        }
        const doc = document.documentElement
        doc.style.setProperty('--cs-video-height', `${window.innerHeight}px`)
        if(iOS()) {window.removeEventListener('resize', appHeight);}
    }
    window.addEventListener('resize', appHeight)
    appHeight()
}

