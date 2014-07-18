

window.onresize = function() { 
	viewport_set(); 
}

function viewport_set(){
var ancho=$('#page').width();	
document.getElementById("viewport").setAttribute("content", "user-scalable=no,width=" + ancho);  	
document.getElementById("viewport").setAttribute("content", "user-scalable=no,width=" + ancho); 
}


function omenu(){
var hW =window.innerHeight;	
	
if(document.getElementById('cmenu').className=="closed"){	
	document.getElementById('page').className='pageD';
	document.getElementById('page').style.height=hW + 'px';
	document.getElementById('shadow').style.display='block';	
	document.getElementById('cmenu').className='opened';
	
	setTimeout(function(){
    document.getElementById('MmenuL').style.display='block';
    }, 300);
	
		
}else{
	document.getElementById('MmenuL').style.display='none';	
	document.getElementById('cmenu').className='closed';
	document.getElementById('shadow').style.display='none';	
	document.getElementById('page').className='page';
	document.getElementById('page').style.height='inherit';
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



    
