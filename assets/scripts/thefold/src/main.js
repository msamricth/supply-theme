
import { Wrapper, bodyOG, scrollRoot, hasCustomBGColor } from "./identifiers.js";
// import {OGbg, OGtxt, topTA, bottomTA, customOn} from "./utils.js";
import { foldSwitch, customFold } from "./custom.js";
import { clearchemes, playFoldAnimation } from "./extras.js";
import { initCustom } from "./init.js";
import { foldDebug } from "./console.js"; 
var scrollActions, foldColor, foldBG;;


function setFold(theme, bg = null, txt = null){
	clearchemes();
	initCustom(theme);
	switch (theme) {
		case 'bg-header':
			Wrapper.classList = bodyOG + ' bg-header';
			if(bodyOG == 'bg-custom ') {
				customFold();
			}
			if(bodyOG == 'bg-pattern ') {
				Wrapper.classList = 'bg-light';
				setTimeout(
					function() {
						Wrapper.classList = 'bg-light ' + theme;
				}, 400);
			}
			if(bodyOG == 'bg-offerings ') {
				Wrapper.classList = 'bg-dark ' + theme;
			}
			break;
		case 'bg-play-animation':
				playFoldAnimation();
			break;
		case 'bg-footer':
			if(bodyOG == 'bg-custom ') {
				Wrapper.classList = bodyOG;
			} else {
				Wrapper.classList = 'bg-dark';
			}
			break;
		case 'header':
			Wrapper.classList = bodyOG + ' bg-header';
			if(bodyOG == 'bg-custom ') {
				customFold();
			}
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
			foldSwitch(theme, bg, txt, foldBG = null, foldColor = null);
			break;
		default:
			if(Wrapper.classList.contains(theme)){
				if(Wrapper.classList.contains('bg-header')){
					Wrapper.classList = theme;
					if(bodyOG == 'bg-custom') {
						customFold();
					}
				}
			} else {
				Wrapper.classList = theme;
			}
	}
	if(theme == null) {
		Wrapper.classList = bodyOG;
	}
}

export{setFold};