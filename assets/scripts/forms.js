( function () {
	'use strict';
    var animatedInput = $('input.link-up');
    if(animatedInput.length){
        animatedInput.after('<span class="linked-up">></span>');
    }
	// Focus input if Searchform is empty
	[].forEach.call( document.querySelectorAll( '.search-form' ), ( el ) => {
		el.addEventListener( 'submit', function ( e ) {
			var search = el.querySelector( 'input' );
			if ( search.value.length < 1 ) {
				e.preventDefault();
				search.focus();
			}
		} );
	} );


	function calcHeight(value) {
		let numberOfLineBreaks = (value.match(/\n/g) || []).length;
		// min-height + lines x line-height + padding + border
		let heightVar = 30;
		let newHeight = heightVar + numberOfLineBreaks * heightVar + 12 + 2;
		return newHeight;
	  }
	let textareaEX = document.querySelector("textarea.form-control");
	if(textareaEX){
		textareaEX.addEventListener("keyup", () => {
			textareaEX.style.height = calcHeight(textareaEX.value) + "px";
		});
	}
    function expandTextarea(id) {
        document.querySelector(id).addEventListener('keyup', function() {
            this.style.overflow = 'hidden';
            this.style.height = 0;
            this.style.height = this.scrollHeight + 'px';
        }, false);
    }


    function hideGRecaptcha() {
        var $cf7Form = $('.wpcf7-form'),
        $gREC = $('.grecaptcha-badge');
        
        if($gREC.length){
            var $gRECParent = $gREC.parent().closest('div');
            $(document).ready(function () {
                if($cf7Form) {
                    if($gRECParent.hasClass('gre-loaded')) {} else {
                        $gRECParent.addClass('d-none gre-loaded');
                    }
                }
            });
            $cf7Form.on('inview', function(event, isInView) {
                if (isInView) {
                    setTimeout(
                        function() {
                            $gRECParent.removeClass('d-none');
                        }, 400);
                    
                } else {
                    $gRECParent.addClass('d-none');
                }
            });
        }
    }
});
pageCheck();
const cf7Formtextarea = document.querySelector('.wpcf7-textarea');
if(cf7Formtextarea) {	
    document.querySelector('.wpcf7-textarea').addEventListener('keyup', function() {
        pageCheck();
        this.style.overflow = 'hidden';
        this.style.height = 0;
        this.style.height = this.scrollHeight + 'px';
    }, false);
}
(function($) {
    $('.block-supply-contact-block .footer-btn').prop("disabled",true);
    $('.wp-block-contact-form-7-contact-form-selector .btn').prop("disabled",true);
    function checkHoneyPot($class = null){
        var honeyPot = document.getElementById("honeypot");
        if (honeyPot && honeyPot.value) {
            $($class).prop("disabled",true);
        } else {
            $($class).prop("disabled",false);
        }
    }
    


    document.addEventListener( 'wpcf7invalid', function( event ) {
        $('.contact-form').addClass('invalid');
      }, false );
    document.addEventListener( 'wpcf7mailsent', function( event ) {
        var CF7ID = event.detail.contactFormId;
        console.log(CF7ID);
        $('.contact-form').addClass('success');
        $('#'+CF7ID+' .visible-only-if-sent').show();
        $('#'+CF7ID+' .hidden-only-if-sent').hide();
    }, false );


    
    if($('.block-supply-contact-block  .wpcf7-email').length){
        $('.block-supply-contact-block  .btn').prop("disabled",true);
        document.querySelector('.block-supply-contact-block  .wpcf7-email').addEventListener('input', function (evt) {
           // pageCheck();
            var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            if (testEmail.test(this.value)) checkHoneyPot('.block-supply-contact-block .footer-btn');
            else $('.block-supply-contact-block .btn').prop("disabled",true);
        });
    }
    if($('.wp-block-contact-form-7-contact-form-selector .wpcf7-email').length){
        $('.wp-block-contact-form-7-contact-form-selector .btn').prop("disabled",true);
        document.querySelector('.wp-block-contact-form-7-contact-form-selector .wpcf7-email').addEventListener('input', function (evt) {
            //pageCheck();
            var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            if (testEmail.test(this.value)) checkHoneyPot('.wp-block-contact-form-7-contact-form-selector .btn');
            else $('.wp-block-contact-form-7-contact-form-selector .btn').prop("disabled",true);
        });
    }
})( jQuery );

function pageCheck(){
        const cf7Form = document.querySelector('.wpcf7-form');
        const currentURL= document.getElementById('currentURL');
        const currentTitle= document.getElementById('currentTitle');
        const CcurrentURL= document.getElementById('CcurrentURL');
        const CcurrentTitle= document.getElementById('CcurrentTitle');
        if(cf7Form){
            if(currentURL){currentURL.value = window.location.href;}
            if(currentTitle){currentTitle.value = document.title;}
            if(CcurrentURL){CcurrentURL.value = window.location.href;}      
            if(CcurrentTitle){CcurrentTitle.value = document.title;}
            }    
}