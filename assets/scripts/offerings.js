
import { fold as fold } from "./thefold.js";
const offeringsPage = document.querySelector('.single-service-offerings');
if(offeringsPage){    
  function navControls(){
    const subnavContainers = offeringsPage.querySelectorAll('.subnav');
      subnavContainers.forEach(function(subnavContainer){

        const subnavItems = subnavContainer.querySelectorAll('a'),
        activeSubnavItem = subnavContainer.querySelector('a.active');


        var subnavLink,subnavTitle,subnavLinkID;

            
        subnavItems.forEach(function(subnavItem) {
            subnavItem.addEventListener("click", (e) => {
                e.preventDefault();
                if(activeSubnavItem){activeSubnavItem.classList.remove('active');}
                subnavTitle = subnavItem.getAttribute('data-title');
                subnavLink = "/services"+subnavItem.getAttribute('data-slug');
                subnavLinkID = subnavItem.getAttribute('id');
                jediMindTricks(subnavLink, subnavTitle, subnavLinkID);
              

            });
        });
      });
    }
    navControls();
    var decodeEntities = (function() {
      // this prevents any overhead from creating the object each time
      var element = document.createElement('div');
    
      function decodeHTMLEntities (str) {
        if(str && typeof str === 'string') {
          // strip script/html tags
          str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
          str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
          element.innerHTML = str;
          str = element.textContent;
          element.textContent = '';
        }
    
        return str;
      }
    
      return decodeHTMLEntities;
    })();
  //let lottieInstances = document.querySelectorAll('.lottiedottie');
  //lottieInstances.forEach(function(lottieInstance) {

    let lottieInstance = document.querySelector('.lottiedottie'); 
    if(lottieInstance){
      lottieInstance.addEventListener("ready", () => {
          // if Supply ever goes the direction for multiple animations on a page unmute the muted lines and mute the next line
          
          //lottieHeight();

      });
    }
  
    //window.onresize = lottieHeight; 
    function lottieHeight(){
      let lottieInstanceHeight = lottieInstance.offsetHeight + 28+'px';

      let lottie_master_container = lottieInstance.closest('.lottie-master-container');
      lottie_master_container.style.height = lottieInstanceHeight;
    }
    function jediMindTricks($pageURL, $pageTitle, $pageID){
        (function($) {
            $('#streamload').html("<h5 class='text-center'>Loading...</h5>");
            $(".entry").load($pageURL+" #streamload", function( response, status, xhr ) {
                if ( status == "error" ) {
                  var msg = "Sorry but there was an error: ";
                  $( "#streamload" ).html('Error loading');
                  console.log( msg + xhr.status + " " + xhr.statusText );
                }
              });
              if($('.subnav a').hasClass('active')){$('.subnav a.active').removeClass('active');}
            
            const nextURL = window.location.protocol+'//'+window.location.hostname+$pageURL;
            const nextTitle = decodeEntities($pageTitle + ' - Supply');
            const nextState = { additionalInformation: 'Updated the URL with JS' };
            document.title = nextTitle;
            const navlinkID = document.getElementById($pageID);
            navlinkID.classList.add('active');
            // This will create a new entry in the browser's history, without reloading
            window.history.pushState(nextState, nextTitle, nextURL);
            window.scrollTo(0,0);
            setTimeout(
              function() {
                navControls();
                fold();
            }, 1400);
        })( jQuery );
    }

} 