
function init(){$.ajaxSetup({'async': false});
if(!window.top.cSELS){window.top.cSELS=new Array;}
	
checkCookie();
window.top.HTML=' %listHTML% ';
loadCarrito();
if(document.getElementById('hidc')){var idcur=document.getElementById('hidc').value; addVis(idcur);}	


}

function lcurSOC(){
var url=window.location.href; 
var url2=url.replace('#lc','');
var url3=url.replace('|','');
if (url.length>url2.length){var dats=url.split('#lc'); var lc=dats[1]; listSOC(lc); }
if (url.length>url3.length){
var dats=url.split('|'); 
var mode=dats[1]; var nurl=dats[0];
setCookie("modeA",mode,365);
}

if(getCookie("modeA")=='admin'){admin();}
}


function admin(){
var UID=window.top.ckk;	
var url='/ajx/adminCat.php?uid=' + UID + '&url=' + window.top.idcfA;	
$.getJSON(url, function(data) {
$.each(data, function(key, val) {
if(key=='js'){$.getScript(val, function(){});}
if(key=='admin'){document.getElementById('ppA').innerHTML=val;}
});
});	
	
}



function listSOC(lc){

var UID=window.top.ckk;
var url='/ajx/importSOC.php?uid=' + UID + '&lc=' + lc;	
$.getJSON(url, function(data) {
$.each(data, function(key, val) {

if(key=="newlc"){

var pops=document.getElementById('pops2').innerHTML;
var newlc=val; 
pops=pops + newlc;
document.getElementById('pops2').innerHTML=pops;
emerge('em-3'); 


}	

});
});		



}

function closAlert(){
document.getElementById('header').innerHTML="";
$("#header:not(:animated)").animate({height:22}, 600);	
}

function acceptC(){
if(window.top.accept>0){


$("#header:not(:animated)").animate({height:60},800,function(){
document.getElementById('header').innerHTML='<div class="alert"><div class="ialert iconos"></div> Esta página utiliza Cookies para mejorar su navegación. Si continua navegando entendemos que acepta la <a href="/cookies.html" style="color:#bbbbbb; font-weight: normal;" >política de Cookies</a>.<div class="iconos closeA" onclick="closAlert();"></div> </div>';    
});

	
}}

function initiate_geolocation() {  
            navigator.geolocation.getCurrentPosition(handle_geolocation_query);  
        }  
function handle_geolocation_query(position){  
            alert('Lat: ' + position.coords.latitude + ' ' +  
                  'Lon: ' + position.coords.longitude);  
        } 



function loadCarrito(){
document.getElementById('pops').innerHTML=window.top.HTML;	



}


function formup(){
chekData();	
	
emerge('em-2'); showSl(800); selpC(1);cargaSel();
}


function formupC(){
chekData();	
	
emerge('em-2'); showSl(1600); selpC(1);cargaSel();
}



function socialup(){
chekData();		
showSl(0);	
emerge('em-2'); selpC(1);cargaSel();
}


function emerge(d){
document.getElementById('fondoGris').style.visibility = 'visible';
document.getElementById(d).style.visibility = 'visible';
}

function outemer(){

document.getElementById('fondoGris').style.visibility = 'hidden';
for (var a=1; a <= 12; a++){
if(document.getElementById('em-'+a)){document.getElementById('em-'+a).style.visibility = 'hidden';}	
}


for (i=1 ; i <= 5; i++){if(document.getElementById('P' + i + 'c')){
document.getElementById('P' + i + 'c').setAttribute("style", "visibility:hidden;");
}}

insVals();


}




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
  	window.top.ckk=cookie;
  	initCurSEL();chkCsels(); 
  	checkGEOip();window.top.accept=0;lcurSOC();
  	}else{
  	
  	getremotecookie();
  	
  	}
  
 
 
}

function chekData(){
getDatos();	
var datos=getCookie("datos");	

if (datos!=null && datos!="")
    {
  	aDatos=datos.split('|');
  	}else{
  	aDatos=new Array;
  	}


for(a=1; a<=12; a++){if(document.getElementById(a)){
if(aDatos[a]){document.getElementById(a).value=aDatos[a];};	
}}	
	
}


function checkGEOip(){
$.ajaxSetup({'async': false});
getCP();
	
var geoCP=getCookie("geoCP");	

if (geoCP!=null && geoCP!="")
  {
  	window.top.geoCP=geoCP;
  	geoIMG();  	
  	}else{
  	getgeoCP();
  	}

	
acceptC();	
}

function getDatos(){$.ajaxSetup({ cache: false });
var UID=window.top.ckk;
var url='/ajx/getDatos.php?uid=' + UID;	
$.getJSON(url, function(data) {
$.each(data, function(key, val) {
	
if(key=="datos"){
setCookie("datos",val,365);
return val;
}	

});
});		

}


function geoIMG(){
cp=window.top.geoCP; cp3=cp.substring(0,3);

if((cp3=='077') || (cp3=='078')){
cp=cp3;	
}else{
cp=cp.substring(0,2); 
cp=cp + '0';	
}


var pos=$.inArray(cp,window.top.PCOD);

//var pos=window.top.PCOD.indexOf(cp);

//console.log(cp);
//console.info(window.top.PCOD);

if(pos>0){


var url=window.top.PURL[pos];
var nom=window.top.PNOM[pos];
var img=window.top.PIMG[pos];
var tit=window.top.TIT[pos];
var tita=window.top.TITA[pos];

var html='<div onclick="lK(\'' + url 
+ '\');" style="background-image: url(\'' + img 
+ '\');" class="GeoImage"><div class="titGeoImg"><p><a alt="' + tita 
+ '" href="' + url + '" style="color: #FFFFFF;">' 
+ tit + ' EN:</a></p></div><div class="PROVGeoImg"><div class="iconos flechaGeo"></div><p><a alt="' + tita 
+ '" href="' 
+ url + '" style="color: #FFFFFF;">' 
+ nom + '</a></p></div></div>';

document.getElementById('gI').innerHTML=html;	
}}


function getgeoCP2(){
var UID=window.top.ckk;
var url='/ajx/geoip.php?uid=' + UID;
$.getJSON(url, function(data) {
$.each(data, function(key, val) {
if(key=="cp"){
setCookie("geoCP",val,365);
window.top.geoCP=val;
geoIMG();
}	


});
});	
	
}


function getgeoCP(){
var UID=window.top.ckk;
//var url='http:/ajx/geoip.php?uid=' + UID;


	var surl =  "http://cursodecursos.com:8080/ajx/geoip2.php?uid=" + UID + "&callback=?"; 
	var me = $(this); 
	$.getJSON(surl,  function(rtndata) { 
	var cp=rtndata.message; var cp = cp.toString();
	//console.log(cp);
	setCookie("geoCP",cp,365);
	window.top.geoCP=cp;
	geoIMG();
 
 });

	
}




function bfecha(id){
if(document.getElementById(id).value=='dd/mm/aaaa'){	
document.getElementById(id).value="";
}	
}

function ffecha(id){
var f=document.getElementById(id).value;
if(f.length==2){f=f+'/';};	
if(f.length==5){f=f+'/';};
if(f.length>10){f=f.substring(0,10);};
document.getElementById(id).value=f;
}


function getCP(){
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
	initCurSEL();chkCsels(); 
	checkGEOip();lcurSOC();
 });
 
}

function initCurSEL(){$.ajaxSetup({ cache: false });
uid=window.top.ckk;
var csels=getCookie("csels");

if (csels!=null && csels!=""){
		
csels2=unescape(csels);
var fromC=csels2.split(',');
window.top.cSELS=new Array;	
	
for(var i=0; i < fromC.length; i++){
val=Number(fromC[i]);	
window.top.cSELS.push(val);
}


}else{

window.top.cSELS=new Array;		
var url='/ajx/curSelUID.php?do=1&uid=' + uid;
$.getJSON(url, function(data) {
$.each(data, function(key, val) {
val=Number(val);	
window.top.cSELS.push(val);	
});
});	



}
}

function chkCsels(){
var csel=window.top.cSELS;  //console.info(window.top.cSELS);
for (i=0; i<=csel.length ; i++){
if(document.getElementById(csel[i])){document.getElementById(csel[i]).className='iconos IaddList IadlON';}	
}

}


function adCScarr(idc,p){
adCS(idc);
cargaSel();
	
}

function addVis(idcur){$.ajaxSetup({ cache: false });
uid=window.top.ckk;	idcur=Number(idcur);
var url='/ajx/curSelUID.php?do=4&uid=' + uid + '&idc=' + idcur;
$.getJSON(url, function(data) {	$.each(data, function(key, val) { });
});		
}

function masinfo(idc){
uid=window.top.ckk;	idc=Number(idc);	

	window.top.cSELS.push(idc);
	if(document.getElementById(idc)){document.getElementById(idc).className='iconos IaddList IadlON';};	
	var url='/ajx/curSelUID.php?do=2&uid=' + uid + '&idc=' + idc;
	$.getJSON(url, function(data) {	$.each(data, function(key, val) { });
	});


var val= escape(window.top.cSELS.join(','));
setCookie('csels',val,0);
formupC()		
}


function adCS(idc){$.ajaxSetup({ cache: false });
uid=window.top.ckk;	idc=Number(idc);
var ind=window.top.cSELS;

document.getElementById('timR').style.visibility = "visible" ;


var posSel=	jQuery.inArray(idc,ind);
if(posSel!=-1){
	window.top.cSELS.splice(posSel, 1);
	if(document.getElementById(idc)){document.getElementById(idc).className='iconos IaddList IadlOFF';};
	var url='/ajx/curSelUID.php?do=3&uid=' + uid + '&idc=' + idc;
	$.getJSON(url, function(data) {	$.each(data, function(key, val) { });
	});	
	
	}else{
	window.top.cSELS.push(idc);
	if(document.getElementById(idc)){document.getElementById(idc).className='iconos IaddList IadlON';};	
	var url='/ajx/curSelUID.php?do=2&uid=' + uid + '&idc=' + idc;
	$.getJSON(url, function(data) {	$.each(data, function(key, val) { });
	});	
	}	

	
var val= escape(window.top.cSELS.join(','));

setCookie('csels',val,0);
setTimeout('hidTim()', 900);
}


function hidTim(){


document.getElementById('timR').style.visibility = "hidden" ;	
}


function cargaSel(){
$.ajaxSetup({ cache: false });
uid=window.top.ckk;
window.top.cSELS=new Array;	
var url='/ajx/cargaSels.php?uid=' + uid;
$.getJSON(url, function(data) {
$.each(data, function(key, val) {

if(key=="nnc"){
if(val==0){document.getElementById('social2').setAttribute("style", "visibility:hidden;");	}	
if(val>0) {document.getElementById('social2').setAttribute("style", "visibility:inherit;");	}	
}
if(key=="social"){document.getElementById(key).innerHTML=val;}
if(key=="ncur"){document.getElementById(key).innerHTML=val;}	
if((key=='P1c')||(key=='P2c')){document.getElementById(key).innerHTML=val;}else{val=Number(val); window.top.cSELS.push(val);};
});

var val= escape(window.top.cSELS.join(','));

setCookie('csels',val,0);

});	


document.getElementById('showdoit').setAttribute("style", "visibility:hidden;");
document.getElementById('timer').setAttribute("style", "visibility:inherit;");	
document.getElementById('fin').setAttribute("style", "visibility:hidden;");	
}	



