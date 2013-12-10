



function init(){
window.top.HTML=' %listHTML% ';


loadCarrito();	




}


function loadCarrito(){
document.getElementById('pops').innerHTML=window.top.HTML;	



}


function formup(){
showSl(-800);	
emerge('em-2');	
}


function socialup(){
showSl(0);	
emerge('em-2');	
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
	
}
