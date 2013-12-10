

// del carrito


function showSl(x){
 $("#alSld:not(:animated)").animate({left:x}, 400);

//$('#alSld:not(:animated)').animate({scrollLeft:x},600);
	
	
}




function selpC(p){
var cn=document.getElementById('P' + p).className;	
var scn=cn.replace('nact','');
if(scn.length < cn.length){

for (i=1 ; i <= 5; i++){if(document.getElementById('P' + i)){
var icn=document.getElementById('P' + i).className;	
var iscn=icn.replace('act','');
if(iscn.length < icn.length){
	document.getElementById('P' + i).className=iscn + " nact";
	document.getElementById('fp' + i).className="fnacti iconos";}
}}

document.getElementById('P' + p).className=scn + " act";
document.getElementById('fp' + p).className="facti iconos";
	
}		
}

