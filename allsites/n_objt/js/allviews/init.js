
function lK(url){window.location.href =	url;}

function detectIE() {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf('MSIE ');
    var trident = ua.indexOf('Trident/');

    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }

    if (trident > 0) {
        // IE 11 (or newer) => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }

    // other browser
    return false;
}



function dMp(){ 
if(document.getElementById('prov').className=='liPreC'){
document.getElementById('prov').className='liPreD';
document.getElementById('lisP').style.display='block';		
}else{
document.getElementById('prov').className='liPreC'	
document.getElementById('lisP').style.display='none';
}
	
}



    
$(function () {$(window).bind( "scroll", function(e) {
if(!detectIE()){	
	
var top=f_scrollTop();
var hM =$("#cmenu").height();
var hW =window.innerHeight;
var dif= hW - hM;
var fH=$("#cmenu").height();

var max = $("#footer");
var footP=max.position().top;


if(dif<0){dif=dif*-1; var limit=90+dif;}else{var limit=90;}
var ptop=90-limit;

var ptop2=footP-hM-ptop;

//console.log('top:' +top);
//console.log('limit:' + limit);

if(top>limit){
document.getElementById('cmenu').className='fijo';
if(top>ptop2){
	
	//var dop=ptop+(fH+footP-top);
	//console.log('calc:' + ptop + '+(' + fH + '+' + footP + '-' + top);
	//console.log('ch:' + (top+hW-footP));
	//console.log('footP:' +footP);
	
	    var dop=top+hW-footP;
		//document.getElementById('cmenu').className='fijob';
		document.getElementById("cmenu").removeAttribute("style");
		document.getElementById('cmenu').style.bottom=dop + 'px';
		
	
	
	}else{
		
		var dop=ptop;
		document.getElementById("cmenu").removeAttribute("style");
		document.getElementById('cmenu').style.top=dop + 'px';
		}




}else{
document.getElementById('cmenu').className='nofijo';	
}

}

});});

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



