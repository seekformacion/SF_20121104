
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



function formPromo(idc){$.ajaxSetup({'async': false});
init();	
uid=window.top.ckk;	
var url='/ajx/form.php?promo=1&uid=' + uid + '&idc=' + idc;
	$.getJSON(url, function(data) {	$.each(data, function(key, val) {  
		if(key=='html'){document.getElementById('formdinamico').innerHTML=val;}
		if(key=='pie'){document.getElementById('pie').innerHTML=val;}
		if(key=='idp'){window.top.idport=val;} 
	});
	});	
	
}



function init(){$.ajaxSetup({'async': false});
checkCookie();
}








function checkCookie()
{
$.ajaxSetup({'async': false});	
var cookie=getCookie("seekforID");
  if (cookie!=null && cookie!="")
  {	
  	window.top.ckk=cookie;
  	checkGEOip();  	
  	}else{ 	getremotecookie();
  	  	}
 }

function getremotecookie() {

	var surl =  "http://cursodecursos.com:8080/ajx/session.php?callback=?"; 
	var me = $(this); 
	$.getJSON(surl,  function(rtndata) { 
	var cookie=rtndata.message;
	
	var csin=cookie.replace('||new','');
	//console.log(csin);
	
	if(csin.length < cookie.length){
	cookie=csin;
	window.top.accept=1;	
	}
	
	setCookie("seekforReferal",document.referrer,365);
	setCookie("seekforID",cookie,365);
	window.top.ckk=cookie;
	checkGEOip();
		
 });
 
}


function checkGEOip(){
$.ajaxSetup({'async': false});
getCP();
	
var geoCP=getCookie("geoCP");	

if (geoCP!=null && geoCP!="")
  {
  	window.top.geoCP=geoCP;
  	 	
  	}else{
  	getgeoCP();
  	}


}




function getCP(){$.ajaxSetup({'async': false});
uid=window.top.ckk;
var url='/ajx/getCP.php?&uid=' + uid;
$.getJSON(url, function(data) {
$.each(data, function(key, val) {

if((key=='cp')&&(val)){
setCookie("geoCP",val,365);
window.top.geoCP=val;
}else{
getgeoCP();	
}

});
});		
	
}

function getgeoCP(){$.ajaxSetup({'async': false});
var UID=window.top.ckk;
//var url='http:/ajx/geoip.php?uid=' + UID;

	var surl =  "http://cursodecursos.com:8080/ajx/geoip2.php?uid=" + UID + "&callback=?"; 
	var me = $(this); 
	$.getJSON(surl,  function(rtndata) { 
	var cp=rtndata.message; var cp = cp.toString();
	//console.log(cp);
	setCookie("geoCP",cp,365);
	window.top.geoCP=cp;
	
 
 });

	
}

