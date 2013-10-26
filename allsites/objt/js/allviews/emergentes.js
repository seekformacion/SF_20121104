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
