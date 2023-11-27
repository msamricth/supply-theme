
var reels = document.querySelectorAll(".video-embed.reels");
function reelAnimation(){
    reels.forEach(function(reel) {
        var iframe = reel.querySelector('.iframe-video');
        var player = new Vimeo.Player(iframe);
      //  iframe.contentWindow.postMessage('{"method":"setVolume", "value":0}', '*');
       // player.setMuted(true);
        var videoPlaceholder = reel.querySelector(".reels--button");
        var preview = reel.querySelector(".reels--preview");
        videoPlaceholder.addEventListener("mouseover", func, false);
        videoPlaceholder.addEventListener("mouseout", func1, false);
    
        videoPlaceholder.addEventListener("click", function(e) {
            

            // Play vimeo video when pressing the play button


                    reel.className += " video-iframe-container";
                    iframe.classList.remove("d-none");
        
                    if(document.body.matches('.ios.Safari')){
                        setTimeout(
                            function() {
                            iframe.contentWindow.postMessage({method:"play"}, "*"); 
                        }, 700);
                    } else {
                        player.play();
                    }
                    e.preventDefault();
            
        })


        function func()
        {  
            
            if (screen.width > 768){
              reel.classList.add('play-hover');
            }
            
        }
        
        function func1()
        {  
          
            if (screen.width > 768){
                reel.classList.remove('play-hover');
            }
        }
        
    });
}


function varz_dump(action, vaction){
        console.log("Video Var Dump: "+ vaction+ ', action: '+ action);
}

function muteAnimation(){
    var muteBTNs = document.querySelectorAll(".mute-button");
    if(muteBTNs){
        muteBTNs.forEach(function(muteBTN) {
            var CNTR = muteBTN.parentElement;
            var iframe = CNTR.querySelector('.videofx');
            var player = new Vimeo.Player(iframe);
            var videoID = iframe.id; 
            var video =  document.getElementById(videoID);
            console.log(iframe.id);
            muteBTN.addEventListener("mouseover", func, false);
            muteBTN.addEventListener("mouseout", func1, false);
            muteBTN.addEventListener("click", () => {
                if(CNTR.classList.contains('unmute')) {
                    CNTR.classList.remove('unmute');
                    player.setMuted(true);
                } else {
                    CNTR.classList.add('unmute');
                    player.setMuted(false);
                }
            });
            muteBTN.addEventListener("change", () => {
                if(CNTR.classList.contains('unmute')) {
                    CNTR.classList.remove('unmute');
                    player.setMuted(true);
                } else {
                    CNTR.classList.add('unmute');
                    player.setMuted(false);
                }
            });
            function func()
            {  
                if (screen.width > 768){
                    muteBTN.parentElement.classList.add('mute-hover');
                }
                
                
            }
            
            function func1()
            {  
              
                if (screen.width > 768){
                    muteBTN.parentElement.classList.remove('mute-hover');
                }
            }
            
            function func2()
            {  
              
                if (screen.width > 768){
                //muteBTN.parentElement.classList.remove('mute-hover');
                  muteBTN.parentElement.classList.remove('mute-hover-overide');
               // muteBTN.classList.remove('active-on')
                }
            }
    
        });
    }
    
}
window.addEventListener("load", (event) => {
    muteAnimation();
    reelAnimation();
});
window.addEventListener("resize", (event) => {
    muteAnimation();
    reelAnimation();
});