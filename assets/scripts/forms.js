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
        document.getElementById(id).addEventListener('keyup', function() {
            this.style.overflow = 'hidden';
            this.style.height = 0;
            this.style.height = this.scrollHeight + 'px';
        }, false);
    }

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
    var $message = $('#message');
    if(($message).length) {
        expandTextarea('message');
    }	
});