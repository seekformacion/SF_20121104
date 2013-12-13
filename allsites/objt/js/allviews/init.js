



function init(){

checkCookie();	
window.top.HTML=' %listHTML% ';
loadCarrito();
if(document.getElementById('hidc')){var idcur=document.getElementById('hidc').value; addVis(idcur);}	
}


function loadCarrito(){
document.getElementById('pops').innerHTML=window.top.HTML;	



}


function formup(){
	
	
emerge('em-2'); showSl(800); selpC(1);cargaSel();
}


function socialup(){
		
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


function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
{
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}


function checkCookie()
{
$.ajaxSetup({'async': false});	
var cookie=getCookie("seekforID");
  if (cookie!=null && cookie!="")
  {
  	window.top.ckk=cookie;
  	initCurSEL();chkCsels(); 
  	
  	}else{
  	getremotecookie();
  	}
  
 
 
}


function getremotecookie() {

	var surl =  "http://cursodecursos.com/ajx/session.php?callback=?"; 
	var me = $(this); 
	$.getJSON(surl,  function(rtndata) { 
	var cookie=rtndata.message;
	setCookie("seekforID",cookie,365);
	window.top.ckk=cookie;
	initCurSEL();chkCsels(); 
 });
 
}; 

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

function adCS(idc){$.ajaxSetup({ cache: false });
uid=window.top.ckk;	idc=Number(idc);
var ind=window.top.cSELS;



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
}


function cargaSel(){
$.ajaxSetup({ cache: false });
uid=window.top.ckk;
window.top.cSELS=new Array;	
var url='/ajx/cargaSels.php?uid=' + uid;
$.getJSON(url, function(data) {
$.each(data, function(key, val) {
	
if((key=='P1c')||(key=='P2c')){document.getElementById(key).innerHTML=val;}else{val=Number(val); window.top.cSELS.push(val);};
});

var val= escape(window.top.cSELS.join(','));

setCookie('csels',val,0);

});	
	
}	



