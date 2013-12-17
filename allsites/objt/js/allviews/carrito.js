

// del carrito


function showSl2(x){
 $("#alSld:not(:animated)").animate({left:x}, 500);

//$('#alSld:not(:animated)').animate({scrollLeft:x},600);
	
	
}




function showSl(x){
	
 if(navigator.appName!='Microsoft Internet Explorer'){	
 $("#em-2:not(:animated)").animate({scrollLeft:x}, 500);
 }else{
 //$("#alSld").css('left', x);	
 //document.getElementById('alSld').setAttribute("style", "left:" + x + 'px;');	
 $("#em-2:not(:animated)").scrollLeft(x);
 }	


	
}




function selpC(p){
var cn=document.getElementById('P' + p).className;	
var scn=cn.replace('nact','');
if(scn.length < cn.length){
	
for (i=1 ; i <= 5; i++){if(document.getElementById('P' + i)){
document.getElementById('P' + i + 'c').setAttribute("style", "visibility:hidden;");	
var icn=document.getElementById('P' + i).className;	
var iscn=icn.replace('act','');
if(iscn.length < icn.length){
	document.getElementById('P' + i).className=iscn + " nact";
	document.getElementById('fp' + i).className="fnacti iconos";}
	
}}

document.getElementById('P' + p).className=scn + " act";
document.getElementById('fp' + p).className="facti iconos";
}
document.getElementById('P' + p + 'c').setAttribute("style", "visibility:visible;");			
}


function scrll(p,w){
var hei=$("#" + p).height();
var hei=(Number(hei)* -1) + 100;
	
var pos=document.getElementById(p).style.top;
pos=pos.replace('px','');pos=Number(pos);
if(w==0){pos=pos+103}
if(w==1){pos=pos-103}

if(pos>0){pos=0;}
if(pos<=hei){pos=hei;}

if(navigator.appName!='Microsoft Internet Explorer'){
$("#" + p + ":not(:animated)").animate({top:pos}, 500);	
}else{
document.getElementById(p).setAttribute("style", "top:" + pos + 'px;');		
}


}

function revi1(){

var doit=1;
for (a=1 ; a<=7 ; a++){
var cnt="";

var cnt = document.getElementById(a).value; if(cnt==0){cnt="";}; cnt=cnt.replace('dd/mm/aaaa','');
if(!cnt){doit=0;

document.getElementById('e'+ a).innerHTML="Campo obligatorio.";
document.getElementById('e'+ a).setAttribute("style", "visibility:visible;");

var clas=document.getElementById(a).className; 
clas=clas.replace('bdc1','bdcE');
clas=clas.replace('color2_BG','color2_B_GE');
document.getElementById(a).className=clas; 		
}else{

document.getElementById('e'+ a).innerHTML="";
document.getElementById('e'+ a).setAttribute("style", "visibility:hidden;");
var clas=document.getElementById(a).className; 
clas=clas.replace('bdcE','bdc1');
clas=clas.replace('color2_B_GE','color2_BG');
document.getElementById(a).className=clas; 
	
}
	
}


if(document.getElementById(4).value!='dd/mm/aaaa'){
	
}

if(document.getElementById(6).value!=''){if(!chkMail()){doit=0;}}

if(document.getElementById(5).value!=''){if(!chkPhone()){doit=0;}}

var naci=document.getElementById(4).value; naci=naci.replace('dd/mm/aaaa','');
if(naci!=''){if(!chkNacimiento()){doit=0;}}

	
if(doit){insVals();showSl(2400);};	
}


function insVals(){if(!window.top.fields){window.top.fields=new Array;window.top.fields[0]="";}

for (a=1; a<=12 ; a++){
var val = document.getElementById(a).value; val=val.replace('|','/');
window.top.fields[a]=val;	
}
var datos= window.top.fields.join('|');

if(datos!=getCookie("datos")){
setCookie('datos',datos,365);	
insDatos(datos);
}

}


function insDatos(datos){
uid=window.top.ckk;		
var url='/ajx/insDatos.php?uid=' + uid + '&datos=' + datos;
$.getJSON(url, function(data) {


});	

	
}


function chkPhone(){
var phone=document.getElementById(5).value; 
phone=phone.replace(/ /g,'');
phone=phone.replace(/\+/g,'');
phone=phone.replace(/\-/g,'');
phone=phone.replace(/\(/g,'');
phone=phone.replace(/\)/g,'');

var pattern=/^[0-9]+$/;	
if((pattern.test(phone))&&(phone.length>=9)){ 
document.getElementById('e5').innerHTML="";
document.getElementById('e5').setAttribute("style", "visibility:hidden;");
var clas=document.getElementById(5).className; 
clas=clas.replace('bdcE','bdc1');
clas=clas.replace('color2_B_GE','color2_BG');
document.getElementById(5).className=clas; 
	
	        
return true;   
    }else{   

document.getElementById('e5').innerHTML="Formato incorrecto";
document.getElementById('e5').setAttribute("style", "visibility:visible;");

var clas=document.getElementById(5).className; 
clas=clas.replace('bdc1','bdcE');
clas=clas.replace('color2_BG','color2_B_GE');
document.getElementById(5).className=clas;
return false;
    }
	
	
}



function chkNacimiento(){
var naci=document.getElementById(4).value;
var pattern=/^(0[1-9]|1\d|2\d|3[01])\/(0[1-9]|1[0-2])\/(19|20)\d{2}$/;	
if(pattern.test(naci)){ 
document.getElementById('e4').innerHTML="";
document.getElementById('e4').setAttribute("style", "visibility:hidden;");
var clas=document.getElementById(4).className; 
clas=clas.replace('bdcE','bdc1');
clas=clas.replace('color2_B_GE','color2_BG');
document.getElementById(4).className=clas; 
	
	        
return true;   
    }else{   

document.getElementById('e4').innerHTML="Fecha incorrecta";
document.getElementById('e4').setAttribute("style", "visibility:visible;");

var clas=document.getElementById(4).className; 
clas=clas.replace('bdc1','bdcE');
clas=clas.replace('color2_BG','color2_B_GE');
document.getElementById(4).className=clas;
return false;
    }


	
}


function chkMail(){
var mail=document.getElementById(6).value;
var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
if(pattern.test(mail)){ 
document.getElementById('e6').innerHTML="";
document.getElementById('e6').setAttribute("style", "visibility:hidden;");
var clas=document.getElementById(6).className; 
clas=clas.replace('bdcE','bdc1');
clas=clas.replace('color2_B_GE','color2_BG');
document.getElementById(6).className=clas; 
	
	        
return true;   
    }else{   

document.getElementById('e6').innerHTML="Formato incorrecto";
document.getElementById('e6').setAttribute("style", "visibility:visible;");

var clas=document.getElementById(6).className; 
clas=clas.replace('bdc1','bdcE');
clas=clas.replace('color2_BG','color2_B_GE');
document.getElementById(6).className=clas;
return false;
    }	
}



