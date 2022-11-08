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