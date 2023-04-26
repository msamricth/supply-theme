
var reels = document.querySelectorAll(".video-embed.reels");


function reelAnimation(){
    reels.forEach(function(reel) {
        var iframe = reel.querySelector('.iframe-video');
        var player = new Vimeo.Player(iframe);
        var videoPlaceholder = reel.querySelector(".reels--button");
        var preview = reel.querySelector(".reels--preview");
        videoPlaceholder.addEventListener("mouseover", func, false);
        videoPlaceholder.addEventListener("mouseout", func1, false);
    
        videoPlaceholder.addEventListener("click", function(e) {
            e.preventDefault();
        //	var isPlaying = player.currentTime > 0 && !player.paused && !player.ended && player.readyState > player.HAVE_CURRENT_DATA;
            var playPromise = player.play();
            if (playPromise !== undefined) {
                    playPromise.then(_ => {
                    })
                    .catch(error => {
                        // Auto-play was prevented
                        // Show paused UI.
                        video.classList.add('error');
                        varz_dump("Error with video", 'video error:' + error);
                    });
                    
                    videoPlayed();
                    function videoPlayed(){
                        reel.className += " video-iframe-container";
                        iframe.classList.remove("d-none");
                        reel.classList.add('played');
                        preview.classList.add('d-none');
                        videoPlaceholder.classList.add('d-none');
                    }
                    
            }
            
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
                // toggle mute feature
                //player.muted = !player.muted;
                
                // toggle mute feature
                //player.muted = !player.muted;
               // muteBTN.classList.add('active-on');
              //  if(muteBTN.classList.contains('active-on')){
               //     muteBTN.parentElement.classList.add('mute-hover-overide');
              //      muteBTN.addEventListener("mouseover", func2, false);
               //}
                if(CNTR.classList.contains('unmute')) {
                    CNTR.classList.remove('unmute');
                    player.setMuted(true);
                } else {
                    CNTR.classList.add('unmute');
                    player.setMuted(false);
                }
            });
            muteBTN.addEventListener("change", () => {
                // toggle mute feature
                //player.muted = !player.muted;
               // muteBTN.classList.add('active-on');
              //  if(muteBTN.classList.contains('active-on')){
               //     muteBTN.parentElement.classList.add('mute-hover-overide');
              //      muteBTN.addEventListener("mouseover", func2, false);
               //}
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