const postsBlock = document.querySelector(".posts-loop-section");
const article = document.querySelector("article.post.type-post");
if(postsBlock){
    var articlePostBlocks = document.querySelectorAll(".type-post");
    
    articlePostBlocks.forEach(function(articlePostBlock) {
        readingTime(articlePostBlock);
    });
}
if(article){
    readingTime(article);
}
//Articles sticky fade in
const articleInteriorPage = document.querySelector(".supply-articles");
const sidebar = document.querySelector(".sidbar-meta");
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
	sidebar.classList.add('fadeOut');
}
if(articleInteriorPage){
		const observer = new IntersectionObserver( 
		  ([e]) => e.target.classList.toggle("fade-in-top", e.intersectionRatio < 1),
		  { rootMargin: '-1px 0px 0px 0px',
		  threshold: [1]}
		);
		
		//observer.observe(sidebar);


}
function readingTime(obj){
    var objID = obj.id;
    const estimateContainer = document.getElementById(objID);
    const text = estimateContainer.querySelector(".estimate").innerText;
    const wpm = 225;
    const words = text.trim().split(/\s+/).length;
    const time = Math.ceil(words / wpm);
    estimateContainer.querySelector(".read-time").innerText = time + ' min read';
}
function copyLink() {
	if (!window.getSelection) {
		alert('Please copy the URL from the location bar.');
		return;
	  }
	  const toasts = document.querySelectorAll('.liveToast')
	 // const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
	  const dummy = document.createElement('p');
	  dummy.textContent = window.location.href;
	  document.body.appendChild(dummy);
	
	  const range = document.createRange();
	  range.setStartBefore(dummy);
	  range.setEndAfter(dummy);
	
	  const selection = window.getSelection();
	  // First clear, in case the user already selected some other text
	  selection.removeAllRanges();
	  selection.addRange(range);
	
	  document.execCommand('copy');
	  document.body.removeChild(dummy);
	  toasts.forEach(function(toast){
		toast.classList.add('fade-in-bottom','show');
		if(toast.classList.contains('fadeout')){
			toast.classList.remove('fadeout');
		}
		const callback = () => {
			toast.classList.remove('show');
			window.removeEventListener('scroll', callback); 
		}
		
		window.addEventListener('scroll', callback);       // add scroll event listener
		
		
		setTimeout(
			function() {
				toast.classList.add('fadeout');
				setTimeout(
					function() {
						toast.classList.remove('show');
					}, 700);
			}, 7000);
	});
}

const shareLinks = document.querySelectorAll(".copy-to-clipboard");
shareLinks.forEach(function(shareLink) {
	if(shareLink){
	
		shareLink.addEventListener("click", (e) => {
			e.preventDefault();
			copyLink();
		});
	}
});

