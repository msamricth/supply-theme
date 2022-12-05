const caseStudyPage = document.querySelector('.single-case-studies');

if(caseStudyPage){
    const videos = document.querySelectorAll(".videofx"); // Select ALL the Videos
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
        if (!entry.isIntersecting) {
            var data = { method: "pause" };
        } else {
            var data = { method: "play" };
        }
        entry.target.contentWindow.postMessage(JSON.stringify(data), "*");
        });
    }, {});
    for (const video of videos) observer.observe(video); // Observe EACH video
    const onVisibilityChange = () => {
        if (document.hidden) {
        
        var data = { method: "pause" };
        for (const video of videos) video.contentWindow.postMessage(JSON.stringify(data), "*"); // Pause EACH video
        } else {
        var data = { method: "play" };
        for (const video of videos) video.contentWindow.postMessage(JSON.stringify(data), "*"); // Play EACH video
        }
    };
    document.addEventListener("visibilitychange", onVisibilityChange);
}