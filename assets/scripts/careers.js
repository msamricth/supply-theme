import { theFold } from "./thefold/index.js";
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
    
            var container = $("#job-listings");
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
                    '<h5 class="ht-no-positions">We have no open positions at this time.</h5>';
                }
    
                container.html(str);
                theFold();
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