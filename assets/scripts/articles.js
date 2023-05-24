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
	  const toastLiveExample = document.getElementById('liveToast')
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
	  toastLiveExample.show()
}

const shareLink = document.getElementById("copy-to-clipboard");
if(shareLink){
	
	shareLink.addEventListener("click", (e) => {
		e.preventDefault();
		copyLink();
	});
}



