import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
import { articleInteriorPage, scrollRoot, debugMarker, debuglog, videoMarker, $videoI } from "./identifiers.js";
import { topTA, bottomTA, scrollActions } from "./utils.js";
import { foldDebug, loadVideoErrorHandler } from "./console.js";
import { playVimeo, pauseVimeo, playVideo, pauseVideo } from "./video.js";
import { fadeintop, fadeOut } from "./extras.js";
import { setFold } from "./main.js";
gsap.registerPlugin(ScrollTrigger);

function videoScrollTriggerFunction(video, player, videoTitle, videoID = null, sTIIV = null, sTPIV = null, vimeoFrame = null) {


}



function vimeoGSAP() {
    gsap.utils.toArray(".videofx.vimeo").forEach(function (video, i) {
        const vimeoFrame = document.getElementById(video.id);
        const player = vimeoFrame;
        const videoTitle = video.getAttribute('data-videotitle');
        const videoID = video.id;
        var sTIIV = ScrollTrigger.isInViewport(video),
            sTPIV = ScrollTrigger.positionInViewport(video, "center").toFixed(2);

        var playPromise = player.play();
        if (playPromise !== undefined) {
            playPromise.then(_ => {
                if ($videoI != 0) {
                    player.pause();
                } else {
                    video.loading = 'eager';
                }
                ScrollTrigger.create({
                    trigger: video,
                    start: 'top 100%',
                    end: 'bottom 15%',
                    markers: videoMarker,
                    onEnter: () => (
                        playVimeo(player, video, videoTitle, videoID, sTIIV, sTPIV),
                        loadVideoErrorHandler(videoTitle, videoID, '', 'play', 'onEnter', sTIIV, sTPIV)
                    ),
                    onLeave: () => (pauseVimeo(player, video), loadVideoErrorHandler(videoTitle, videoID, '', 'Pause', 'onLeave', sTIIV, sTPIV)),
                    onLeaveBack: () => (pauseVimeo(player, video), loadVideoErrorHandler(videoTitle, videoID, '', 'Pause', 'onLeaveBack', sTIIV, sTPIV)),
                    onEnterBack: () => (playVimeo(player, video, videoTitle, videoID, sTIIV, sTPIV), loadVideoErrorHandler(videoTitle, videoID, '', 'Play', 'onEnterBack', sTIIV, sTPIV)),
                    //onUpdate: updateVideo()
                });
            })
                .catch(error => {
                    // Auto-play was prevented
                    // Show paused UI.
                    video.classList.add('error');
                    loadVideoErrorHandler(videoTitle, videoID, error, 'player.pause', 'Paused with error', sTIIV, sTPIV);
                });
        }
        $videoI++;
    });
}

function selfHostedGSAP() {

    gsap.utils.toArray(".videofx.selfhosted").forEach(function (video, i) {
        const vimeoFrame = document.getElementById(video.id);
        const videoID = video.id;
        const player = video;
        const videoTitle = video.getAttribute('data-videotitle');
        var sTIIV = ScrollTrigger.isInViewport(video),
            sTPIV = ScrollTrigger.positionInViewport(video, "center").toFixed(2);

        ScrollTrigger.create({
            trigger: video,
            start: 'top 100%',
            end: 'bottom 15%',
            markers: videoMarker,
            onEnter: () => (
                playVideo(player, video, videoTitle, videoID, sTIIV, sTPIV),
                loadVideoErrorHandler(videoTitle, videoID, '', 'play', 'onEnter', sTIIV, sTPIV)
            ),
            onLeave: () => (
                pauseVideo(player, video, videoTitle, videoID, sTIIV, sTPIV),
                loadVideoErrorHandler(videoTitle, videoID, '', 'Pause', 'onLeave', sTIIV, sTPIV)
            ),
            onLeaveBack: () => (
                pauseVideo(player, video, videoTitle, videoID, sTIIV, sTPIV),
                loadVideoErrorHandler(videoTitle, videoID, '', 'Pause', 'onLeaveBack', sTIIV, sTPIV)
            ),
            onEnterBack: () => (
                playVideo(player, video, videoTitle, videoID, sTIIV, sTPIV),
                loadVideoErrorHandler(videoTitle, videoID, '', 'Play', 'onEnterBack', sTIIV, sTPIV)
            ),
            //onUpdate: updateVideo()
        });
    });
}
function videoScrollTrigger() {
    vimeoGSAP();
    selfHostedGSAP();
}

function theFoldScrollTrigger() {
    if (!scrollRoot.hasAttribute("data-fold-reset")) {
        gsap.utils.toArray(".fold").forEach(function (elem) {

            var color = elem.getAttribute('data-class'),
                elemClassList = elem.classList,
                elemID = elem.id,
                bg, txt, error;
            if (color) { } else {
                error = 'Fold was called but No Color Schme was detected, this could be intentional or caused by an inproperly set fold';
            }
            if (color == 'bg-custom') {
                bg = elem.getAttribute('data-bg');
                txt = elem.getAttribute('data-color');
            }

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
            function FoldonEnter(color) {
                if (scrollActions.includes('onEnter')) {
                    if (color) setFold(color, bg, txt);
                    foldDebug('onEnter', color, elemID, elemClassList, topTA, bottomTA, error, bg, txt);
                }
            }
            function FoldonLeave(color) {
                if (scrollActions.includes('onLeave')) {
                    if (color) setFold(color, bg, txt);
                    foldDebug('onLeave', color, elemID, elemClassList, topTA, bottomTA, error, bg, txt);
                }
            }
            function FoldonLeaveBack(color) {
                if (scrollActions.includes('onLeaveBack')) {
                    if (color) setFold(color, bg, txt);
                    foldDebug('onLeaveBack', color, elemID, elemClassList, topTA, bottomTA, error, bg, txt);
                }
            }
            function FoldonEnterBack(color) {
                if (scrollActions.includes('onEnterBack')) {
                    if (color) setFold(color, bg, txt);
                    foldDebug('onEnterBack', color, elemID, elemClassList, topTA, bottomTA, error, bg, txt);
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
                onEnter: () => setFold(color),
                onEnterBack: () => setFold(color),
            });
        });
    }

    ScrollTrigger.refresh();
}
function foldRefresh() {

    ScrollTrigger.refresh();
    setTimeout(
        function () {
            ScrollTrigger.refresh();
        }, 1200);
}

if (articleInteriorPage) {
    function articlesSidebar() {
        gsap.from(".sidbar-meta", {
            scrollTrigger: {
                onEnter: () => fadeintop(),
                start: 'top 45%',
                trigger: ".sidbar-meta",
                end: 'bottom 35%',
                onEnterBack: () => fadeOut()
            }
        });
    }
    articlesSidebar();
}
export { theFoldScrollTrigger, foldRefresh, videoScrollTrigger }