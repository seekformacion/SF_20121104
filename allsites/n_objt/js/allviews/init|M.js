
function getAndroidVersion(ua) {
    var ua = ua || navigator.userAgent; 
    var match = ua.match(/Android\s([0-9\.]*)/);
    return match ? match[1] : false;
}






window.addEventListener("orientationchange", function() {

if(parseInt(getAndroidVersion()) >=3){
viewport_set();	
}else{
viewport_set_old();	
} 


}, false);


		

function first(){

if(parseInt(getAndroidVersion())>=3){
viewport_set();	
}else{
document.getElementById('cmenu').className='oldclosed';		
}

}

function viewport_set(){
var ancho=$('#page').width();
document.getElementById("viewport").setAttribute("content", "user-scalable=no, width=" + ancho);  	
}

function viewport_set_old(){
var ancho=$('#page').width();
document.getElementById("viewport").setAttribute("content", "width=" + ancho);  	

}






function omenu(){
var hW =window.innerHeight;	

	document.getElementById('page').className='pageD';
	document.getElementById('page').style.height=hW + 'px';
	document.getElementById('shadow').style.display='block';	
	document.getElementById('MmenuL').style.display='block';
	
if(parseInt(getAndroidVersion())>=3){	
document.getElementById('cmenu').className='opened';
}else{
document.getElementById('cmenu').className='oldopened';
}		

}



function cmenu(){
var hW =window.innerHeight;	

	document.getElementById('MmenuL').style.display='none';	
	document.getElementById('shadow').style.display='none';	
	document.getElementById('page').className='page';
	document.getElementById('page').style.height='inherit';

if(parseInt(getAndroidVersion())>=3){	
	document.getElementById('cmenu').className='closed';
}else{
document.getElementById('cmenu').className='oldclosed';	
}


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



    
