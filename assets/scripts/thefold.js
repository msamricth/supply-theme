import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);
//New Fold
const foldON = document.body.classList.contains('fold_on');
const Wrapper = document.getElementById('wrapper');
const bodyOG  = Wrapper.dataset.og_class;
const dotsON = document.body.classList.contains('dots_on');
const lazy_load_videos = document.body.classList.contains('lazy_load_videos');
const caseStudy = document.body.classList.contains('single-case-studies');
const header = document.getElementById('header');
const sections = [...document.querySelectorAll('.fold')]

const scrollRoot = document.querySelector('[data-scroller]')
const headerLinks = [...document.querySelectorAll('[data-link]')]
const debuglog = scrollRoot.hasAttribute("debuglog");

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
function theFold() {

	if (!scrollRoot.hasAttribute("data-fold-reset")) {
		gsap.utils.toArray(".fold").forEach(function (elem) {

			var color = elem.getAttribute('data-class');
			
			ScrollTrigger.create({
				trigger: elem,
				start: topTA,
				end: bottomTA,
				markers: debugMarker,
				onEnter: () => FoldonEnter(color),
				onLeave: () => FoldonLeave(color),
				onLeaveBack: () => FoldonLeaveBack(color),
				onEnterBack: () => FoldonEnterBack(color)
			});
			if (!scrollRoot.hasAttribute("scroll-actions")) {
				// data attribute doesn't exist
				scrollActions = 'onEnter onEnterBack';
			} else {
				scrollActions = scrollRoot.getAttribute('scroll-actions');
			}
			function FoldonEnter(color){if(scrollActions.includes('onEnter')){setFold(color),varz_dump('onEnter')}}
			function FoldonLeave(color){if(scrollActions.includes('onLeave')){setFold(color),varz_dump('onLeave')}}
			function FoldonLeaveBack(color){if(scrollActions.includes('onLeaveBack')){setFold(color),varz_dump('onLeaveBack')}}
			function FoldonEnterBack(color){if(scrollActions.includes('onEnterBack')){setFold(color),varz_dump('onEnterBack')}}
			function varz_dump(action){
				if(!Wrapper.classList.contains(color)){
					if (scrollRoot.hasAttribute("debuglog")) {
						console.log('vardump - Action: '+ action +' bottomTA: '+bottomTA+' topTA: '+topTA+'\n- color(appears as class): '+color+'\n- Trigger classes: '+elem.classList)
					}
				}
			}
		});


	} else {
		
		gsap.utils.toArray(".fold").forEach(function (elem) {

			var color = elem.getAttribute('data-class');

			ScrollTrigger.create({
				trigger: elem,
				start: 'top 35%',
				end: 'bottom 35%',
				markers: debugMarker,
				onEnter: () =>setFold(color),
				onEnterBack: () => setFold(color),
			});
		});
	}
	
}
theFold();
if(lazy_load_videos){
	if(caseStudy) {
		let $videoI = 0,
        videos = document.querySelectorAll(".videofx");
		gsap.utils.toArray(".videofx").forEach(function (video, i) {
			const vimeoFrame = document.getElementById(video.id); 
			const player = new Vimeo.Player(vimeoFrame);
			const videoTitle = video.getAttribute('data-videotitle');
			var playPromise = player.play();
			if (playPromise !== undefined) {
				playPromise.then(_ => {
					if ($videoI != 0 ) { 
						player.pause();
					} else {
						video.loading = 'eager';
						if(debuglog){console.log("Dont pause first/header video");}
					}
					ScrollTrigger.create({
						trigger: video,
						start: 'top 40%',
						end: 'bottom 40%',
						markers: videoMarker,
						onEnter: () => (playVimeo(),varz_dump('onEnter','Play')),
						onLeave: () => (pauseVimeo(),varz_dump('onLeave','Pause')),
						onLeaveBack: () => (pauseVimeo(),varz_dump('onLeaveBack','Pause')),
						onEnterBack: () => (playVimeo(),varz_dump('onEnterBack','Play')),
						//onUpdate: updateVideo()
					});
					function updateVideo() {
						const isVideoInView =  ScrollTrigger.isInViewport(video);
						if(isVideoInView == 'true') {
							playVimeo();
						} else {
							pauseVimeo();
						}
						if(debuglog){console.log("Video Var Dump:  video titled: " + videoTitle + ', Is video in viewport:'+ ScrollTrigger.isInViewport(video) +'\n video|scroll position:'+ ScrollTrigger.positionInViewport(video, "center").toFixed(2) +'\n video ID: '+video.id);}
					  }
					function playVimeo(){
						var isPlaying = player.currentTime > 0 && !player.paused && !player.ended && player.readyState > player.HAVE_CURRENT_DATA;
						
						if(video.classList.contains('loaded')){
							if (!isPlaying) {
								var playPromise = player.play();
								if (playPromise !== undefined) {
									if (!isPlaying) {
										playPromise.then(_ => {
											
										})
										.catch(error => {
											// Auto-play was prevented
											// Show paused UI.
											video.classList.add('error');
											varz_dump("Error with video", 'video error:' + error);
										});
									}
								}
							}
						} else {
							var playPromise = player.play();
							if (playPromise !== undefined) {
								if (!isPlaying) {
									playPromise.then(_ => {
									})
									.catch(error => {
										// Auto-play was prevented
										// Show paused UI.
										video.classList.add('error');
										varz_dump("Error with video", 'video error:' + error);
									});
								}
							}
							video.classList.add('loaded');
							ScrollTrigger.refresh();
						}
					}
					function pauseVimeo(){
						var isPlaying = player.currentTime > 0 && !player.paused && !player.ended && player.readyState > player.HAVE_CURRENT_DATA;
						var hasPlayed = player.currentTime > 0;
						if ($videoI != 0 ) { 
							if (isPlaying) {
								player.pause();
							} else {
								if (hasPlayed) {
									player.pause();
								} else {
									if(video.classList.contains('loaded')){
										player.pause();
									}
								}
							}
						} else {
							if(debuglog){console.log("Dont pause first/header video");}
						}
					}
					function varz_dump(action, vaction){
						if(debuglog){console.log("Video Var Dump: "+ vaction+ ' video titled: ' + videoTitle + ', action: '+ action +'\n video ID: '+video.id);}
					}
				})
				.catch(error => {
					// Auto-play was prevented
					// Show paused UI.
					video.classList.add('error');
					if(debuglog){console.log("Video Var Dump: video titled: " + videoTitle + ', video error:' + error);}
				});
			}
			$videoI++;
		});
	}
	
}
if(nav_compression) {
	const showAnim = gsap.from('#header.navbar', { 
		y: -150,
		duration: 0.19
	  }).progress(.19);
	  
	  ScrollTrigger.create({
		start: "top top",
		end: 99999,
		onUpdate: (self) => {
		  self.direction === -1 ? showAnim.play() : showAnim.reverse()
		}
	  });
}
window.onresize = ScrollTrigger.refresh();
function setFold(theme){
	var customOn;
	if(!scrollRoot.hasAttribute("data-custom")) {
		customOn = true;
	}
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
					}, 600);
				}
				break;
			case 'bg-custom':
				if(customOn){
					Wrapper.classList = theme;
					const foldBG = target.dataset.bg;
					const foldColor = target.dataset.color;
					if(foldColor == 'default'){
						checkFoldColor(foldColor);
					} else {
						Wrapper.style.setProperty('--supply-fold-color', foldColor);
					}
					Wrapper.style.background = foldBG;
				}
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
		if(debuglog){
			console.log('Fold was called but No trigger detected, this could be intentional or caused by an inproperly set fold');
		}
	}
}
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

const ifWork = document.body.classList.contains('page-template-careers');
if(ifWork) {
    // HiringThing Job Embed Widget
    //orginally from https://assets.gorgehr-ats.com/javascripts/embed.js - were using this script to get basic job posting details + the job ID. Then we make a second api call to a different api with that job id to get more advance details. Doing it this way prevents dumping unlisted job postings.
    (function () {
    
        function main() {
        jQuery(document).ready(function ($) {
            // We can use jQuery here
    
            // set a default source code
            if (
            typeof ht_settings.src_code === "undefined" ||
            ht_settings.src_code === null
            ) {
            ht_settings.src_code = "standard";
            }
    
            if (
            typeof ht_settings.open_jobs_in_new_tab === "undefined" ||
            ht_settings.open_jobs_in_new_tab === null
            ) {
            ht_settings.open_jobs_in_new_tab = false;
            }
    
            var container = $("#hiringthing-jobs");
            var spinner = $(
            '<img src="https://images.applicant-tracking.com/images/loading2.gif" />'
            );
            container.html(spinner);
    
            var site_url = ht_settings.site_url;
            if (typeof site_url === "string") {
            site_url = [site_url];
            }
            var promises = [];
            $.each(site_url, function (idx, site_url) {
            promises.push(
                /*$.ajax({
                            url:
                                "https://" +
                                site_url +
                                ".applicant-tracking.com/api/widget_jobs?src=" +
                                ht_settings.src_code +
                                "&callback=?",
                            type: "GET",
                            dataType: "json",
                        })*/
                $.ajax({
                url: "https://api.applicant-tracking.com/api/v1/jobs/active",
                type: "GET",
                dataType: "json",
                timeout: 0,
                headers: {
                    "Content-type": "application/json",
                    Authorization:
                    "Basic YjNkNGNhNDAtMzkzOS00MjZlLTlkZTQtYjI3MzA5ODNhZTAxOjU4M2RlMTAzLWYzN2YtNDIzZC05MWEwLTcxOWIzMzBkOTllMQ=="
                }
                })
            );
            });
    
            $.when
            .apply($, promises)
            .done(function (response) {
                //importing here to get right block sizes
                var start = "";
                console.log(response);
                var jobs = [];
                if (promises.length == 1) {
                Array.prototype.push.apply(jobs, response);
                } else {
                $.each(arguments, function (idx, response) {
                    Array.prototype.push.apply(jobs, response[0]);
                });
                }
    
                var str = "";
                for (var i = 0; i < jobs.length; i++) {
                //make changes to job description
                if (jobs[i].distribution_status == "none") {
                    continue;
                }
                var descstr = jobs[i].description,
                    jobsDescription = null;
    
                jobsDescription = descstr.substring(
                    descstr.indexOf("<h3>") + 1,
                    descstr.lastIndexOf("</h3>")
                );
                jobsDescription = jobsDescription.replace("h3>", "");
                jobsDescription = descstr.substring(
                    descstr.indexOf("<h3>") + 1,
                    descstr.lastIndexOf("</h3>")
                );
                jobsDescription = jobsDescription.replace("h3>", "");
    
                //end
                str += '<article id="post-'+jobs[i].id+'" class="cp2">';
                str += '<div class="card border-0 rounded-0 position-relative fadeNoScroll">';
                str += '<div class="card-body p-0 cp2">';
                start = '<div class="d-dlg-flex align-items-end justify-content-between  cp1">';
                start += '<h3 class="card-title mb-0">' + jobs[i].title + '</h3>';
                start += '<span class="single-careers__label h8 d-inline-block">';
                start += jobs[i].city + ", "+ jobs[i].state;
                if(jobs[i].remote) {
                    start += ' / Remote';
                }
                start +='</span>';
                start += '</div>';
                
                
    
                str += start;
                
                str += '<div class="entry-summary cp2">' + jobsDescription + "</div>";
                str += '<a href="'+ jobs[i].joblink+'" class="link-up" target="_blank">Learn more</a>';
                str += '</div>';
                str += '</div>';
                str += '</article>';
            
                }
    
                if (str == "") {
                str =
                    '<div class="ht-no-positions">We have no open positions at this time.</div>';
                }
    
                container.html(str);
                ScrollTrigger.refresh();
            })
            .fail(function () {
                container.html(
                "Account not found.<br /><br /> Please configure 'site_url' to match your Applicant Tracking account domain. "
                );
            });
        });
        }
		main();

    })();
}




setTimeout(
	function() {
		ScrollTrigger.refresh();
}, 1200);