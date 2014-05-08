
function init(){$.ajaxSetup({'async': false});
if(!window.top.cSELS){window.top.cSELS=new Array;}
	
checkCookie();
window.top.HTML=' %listHTML% ';
loadCarrito();


Ncsel();
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


function formup2(){
	
}


function formup(){
chekData();	
	
 showSl(800); emerge('em-2');selpC(1);cargaSel();
}


function formupC(){
chekData();	
	
emerge('em-4'); // selpC(1);cargaSel();
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

//insVals();


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
  	if(document.getElementById('hidc')){var idcur=document.getElementById('hidc').value; addVis(idcur);}	
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
if(f.slice(-1)=='/'){var not=1}else{var not=0;}

f=f.replace(/\//g,'');
var l=f.length;
var a="";
for (var i = 0; i < l; i ++) {
a=a + f.substring(i, i + 1); 
if((i==1)&&((l>2)||(not))){a=a+'/';}
if((i==3)&&((l>4)||(not))){a=a+'/';}
}

document.getElementById(id).value=a;
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
	if(document.getElementById('hidc')){var idcur=document.getElementById('hidc').value; addVis(idcur);}	
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


function multicup(){
var csel=window.top.cSELS; var lcurs="";

//console.log(csel);

for (i=0; i<=csel.length ; i++){
var cur=Number(csel[i]);
	if((cur>0)&&(!isNaN(cur))){
	lcurs=lcurs + csel[i] + ",";	
	}
}
lcurs=lcurs.slice(0,-1);

//console.log(lcurs);
outemer();
masinfo(lcurs);	
}


function isMobile(){
    return (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino|android|ipad|playbook|silk/i.test(navigator.userAgent||navigator.vendor||window.opera)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test((navigator.userAgent||navigator.vendor||window.opera).substr(0,4)))
}

function masinfo(idc){$.ajaxSetup({'async': false}); $.ajaxSetup({ cache: false });
uid=window.top.ckk;	//idc=Number(idc);	

	window.top.cSELS.push(idc);
	if(document.getElementById(idc)){document.getElementById(idc).className='iconos IaddList IadlON';};	
	var url='/ajx/curSelUID.php?do=2&uid=' + uid + '&idc=' + idc;
	$.getJSON(url, function(data) {	$.each(data, function(key, val) {  if(key=='N'){window.top.Ncs=val; hidTim();}  });
	});


var val= escape(window.top.cSELS.join(','));
setCookie('csels',val,0);


if(isMobile()) {
var url='/ajx/formW.php?uid=' + uid + '&idc=' + idc;	
window.open(url);

}else{
formupC();
var url='/ajx/form.php?uid=' + uid + '&idc=' + idc;
	$.getJSON(url, function(data) {	$.each(data, function(key, val) {  
		if(key=='html'){document.getElementById('formdinamico').innerHTML=val;}
		if(key=='idp'){window.top.idport=val;} 
	});
	});
}	
	

}


function Ncsel(){$.ajaxSetup({ cache: false });
uid=window.top.ckk;
var url='/ajx/curSelUID.php?do=5&uid=' + uid;
	$.getJSON(url, function(data) {	$.each(data, function(key, val) {  if(key=='N'){window.top.Ncs=val; hidTim();}  });
	});	
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
	$.getJSON(url, function(data) {	$.each(data, function(key, val) { if(key=='N'){window.top.Ncs=val;} });
	});	
	
	}else{
	window.top.cSELS.push(idc);
	if(document.getElementById(idc)){document.getElementById(idc).className='iconos IaddList IadlON';};	
	var url='/ajx/curSelUID.php?do=2&uid=' + uid + '&idc=' + idc;
	$.getJSON(url, function(data) {	$.each(data, function(key, val) { if(key=='N'){window.top.Ncs=val;} });
	});	
	}	

	
var val= escape(window.top.cSELS.join(','));

setCookie('csels',val,0);
setTimeout('hidTim()', 700);
}


function hidTim(){



document.getElementById('etiNC').innerHTML = window.top.Ncs;
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
//if(key=="ncur"){document.getElementById(key).innerHTML=val;}	
if((key=='P1c')||(key=='P2c')){document.getElementById(key).innerHTML=val;}else{val=Number(val); window.top.cSELS.push(val);};
});

var val= escape(window.top.cSELS.join(','));

setCookie('csels',val,0);

});	


//document.getElementById('showdoit').setAttribute("style", "visibility:hidden;");
//document.getElementById('timer').setAttribute("style", "visibility:inherit;");	
//document.getElementById('fin').setAttribute("style", "visibility:hidden;");	
}	



