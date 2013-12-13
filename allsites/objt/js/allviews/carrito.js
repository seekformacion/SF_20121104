

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


