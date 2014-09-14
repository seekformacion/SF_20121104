



function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
if(exdays==0){
var c_value=escape(value);
}else{
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());	
}

document.cookie=c_name + "=" + c_value + '; path=/';
}




function getCookie(w){
	cName = "";
	pCOOKIES = new Array();
	pCOOKIES = document.cookie.split('; ');
	for(bb = 0; bb < pCOOKIES.length; bb++){
		NmeVal  = new Array();
		NmeVal  = pCOOKIES[bb].split('=');
		if(NmeVal[0] == w){
			cName = unescape(NmeVal[1]);
		}
	}
	return cName;
}




function checkCookie()
{
$.ajaxSetup({'async': false});	
var cookie=getCookie("seekforID");
  if (cookie!=null && cookie!="")
  {
  	getDatForm(cookie);
  	}else{
  	
  	getremotecookie();
  
  	}
  
 
 
}

function getDatForm(cookie){$.ajaxSetup({ cache: false });
if(document.getElementById('df_1')){
	


var url='/ajx/getCD.php?uid=' + cookie;
$.getJSON(url, function(data) {
$.each(data, function(key, val) {

if( (key==12) && ( document.getElementById('df_dn') )){
document.getElementById('df_an').value=val.substr(0, 4);
document.getElementById('df_mn').value=val.substr(4, 2);
document.getElementById('df_dn').value=val.substr(6, 2);

	
}else{

if(document.getElementById('df_' + key)){
document.getElementById('df_' + key).value=val;	
}

}


	
});
});


	
}}

function getremotecookie() {

	var surl =  "http://cursodecursos.com:8080/ajx/session.php?callback=?"; 
	var me = $(this); 
	$.getJSON(surl,  function(rtndata) { 
	var cookie=rtndata.message;
	var csin=cookie.replace('||new','');
	//console.log(csin);
	
	if(csin.length < cookie.length){
	cookie=csin; window.top.accept=1;	
	}
	
	setCookie("seekforReferal",document.referrer,365);
	setCookie("seekforID",cookie,365);
	getDatForm(cookie);
		
 });
 
}




function lK(url){window.location.href =	url;}




function dMp(){ 
if(document.getElementById('prov').className=='liPreC'){
document.getElementById('prov').className='liPreD';
document.getElementById('lisP').style.display='block';		
}else{
document.getElementById('prov').className='liPreC'	
document.getElementById('lisP').style.display='none';
}
	
}




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




function search(idp){
var str=document.getElementById('str').value;
var cookie=getCookie("seekforID");

var url='/ajx/searchQ.php?str=' + str + '&idp=' + idp + '&uid=' + cookie;
$.getJSON(url, function(data) {
$.each(data, function(key, val) {

if(key=='lk'){lK(val);}
	
});
});



	
}


