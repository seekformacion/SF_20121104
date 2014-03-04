
// Listen for orientation changes
//window.addEventListener("orientationchange", function() {
	// Announce the new orientation number
//	var mql = window.matchMedia("(orientation: portrait)");
//	if(mql.matches) {  
//	cambia_css('V');
//	} else {  
//	cambia_css('H');
//}
//}, false);


function Glow(id){
var cla=document.getElementById(id).className	
var claSIN=cla.replace(' color2_BG','');
if(claSIN.length < cla.length){document.getElementById(id).className=claSIN;}else{document.getElementById(id).className=cla + ' color2_BG';};
	
}



window.addEventListener("orientationchange", function() {

    var top=f_scrollTop();
    var max = $("#footer");
    var footP=max.position().top;
    var limit = (footP)+18; 
    var largo=alto();
    top=top+largo;  

    if(top <= limit){
 	 $("#test").html(top + ' limit ' +limit + ' alto ' + largo);	
	$("#mNAV").addClass("menu_NAV_fijo");	 
 	}else{
 	 $("#test").html(top + ' limit ' +limit + ' alto ' + largo);
 	 $("#mNAV").removeClass("menu_NAV_fijo");	 
 	}

	if(((max.position().top)+150)<largo){
	var contH=$(".content").height();
	var falta=largo-(footP);
	var anadir=contH+falta-130;	
	$('.content').css({ "min-height": anadir});	
	}


}, false);



$(document).ready(function(){ 

    var top=f_scrollTop();
    var max = $("#footer");
    var footP=max.position().top;
    var limit = (footP)+18; 
    var largo=alto();
    top=top+largo;  

    if(top <= limit){
 	 $("#test").html(top + ' limit ' +limit + ' alto ' + largo);	
	$("#mNAV").addClass("menu_NAV_fijo");	 
 	}else{
 	 $("#test").html(top + ' limit ' +limit + ' alto ' + largo);
 	 $("#mNAV").removeClass("menu_NAV_fijo");	 
 	}

	if(((max.position().top)+150)<largo){
	var contH=$(".content").height();
	var falta=largo-(footP);
	var anadir=contH+falta-130;	
	$('.content').css({ "min-height": anadir});	
	}

}); 

    
$(function () {
  $(window).bind( "scroll", function(e) {
  
    var top=f_scrollTop();
    var max = $("#footer");
    var footP=max.position().top;
    var limit = (footP); 
    var largo=alto();
    top=top+largo;  

    if(top <= limit){
 	 $("#test").html(top + ' limit ' +limit + ' alto ' + largo);	
	$("#mNAV").addClass("menu_NAV_fijo");	 
 	}else{
 	 $("#test").html(top + ' limit ' +limit + ' alto ' + largo);
 	 $("#mNAV").removeClass("menu_NAV_fijo");	 
 	}

	if(((max.position().top)+150)<largo){
	var contH=$(".content").height();
	var falta=largo-(footP);
	var anadir=contH+falta-130;	
	$('.content').css({ "min-height": anadir});	
	}

     
  });

});





//window.onorientationchange = screen_init;

//$(window).resize(function(e) {
//screen_init();
//});


 
//function screen_init(){
//	var orientation=window.orientation;
//	if (orientation==undefined)		{tipo=mide();}
	


//	cambia_css(tipo);
//}





   
//function cambia_css(tipo){
	
//	if(tipo=="V"){
//	%B%
//	}else{ 
//	%A%
//	}   
//}		

	

function mide(){
var ancho = (window.innerWidth);
if (ancho==undefined){if (document.body){var ancho = (document.body.clientWidth);
var alto = (document.body.clientHeight);}};
if(ancho>1110){ancho="H";}else{ancho="V";};
return ancho;
}

function alto(){
var alto = (window.innerHeight);
if (alto==undefined){
	
	if (document.body){
	
	var B= document.body, 
        D= document.documentElement;
        var alto= D.clientHeight;
	
	}
	
	}


return alto;
}



function f_clientWidth() {
	return f_filterResults (
		window.innerWidth ? window.innerWidth : 0,
		document.documentElement ? document.documentElement.clientWidth : 0,
		document.body ? document.body.clientWidth : 0
	);
}
function f_clientHeight() {
	return f_filterResults (
		window.innerHeight ? window.innerHeight : 0,
		document.documentElement ? document.documentElement.clientHeight : 0,
		document.body ? document.body.clientHeight : 0
	);
}
function f_scrollLeft() {
	return f_filterResults (
		window.pageXOffset ? window.pageXOffset : 0,
		document.documentElement ? document.documentElement.scrollLeft : 0,
		document.body ? document.body.scrollLeft : 0
	);
}
function f_scrollTop() {
	return f_filterResults (
		window.pageYOffset ? window.pageYOffset : 0,
		document.documentElement ? document.documentElement.scrollTop : 0,
		document.body ? document.body.scrollTop : 0
	);
}
function f_filterResults(n_win, n_docel, n_body) {
	var n_result = n_win ? n_win : 0;
	if (n_docel && (!n_result || (n_result > n_docel)))
		n_result = n_docel;
	return n_body && (!n_result || (n_result > n_body)) ? n_body : n_result;
}





