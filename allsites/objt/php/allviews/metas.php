<?php 
includeCORE('css/css');
includeCORE('js/js');




$lb=array("\n"); 
$javacon=loadChild('objt','carrito');
$java=str_replace($lb,'',$javacon);
/*
echo $javacon;
echo "\n----------------\n ";
echo $java;
echo "\n---------------- \n";
*/
$v['JSpostPROCESS']['%listHTML%']=$java;
loadJS('objt','init');


createCSS();

global $datCur;

$Datos['codTittle']=$v['where']['codTittle'];
$Datos['baseurlFonts']=$v['path']['baseURLskin'][$v['conf']['mode']];

$Datos['codTittleSIN']=$v['where']['pagTittle'];
$Datos['canonical']='http://' . strtolower($v['where']['site']) . strtolower($_SERVER['REQUEST_URI']);
$Datos['Portal']=$v['where']['site'];


########## diferentes tipos de descripcion
if($v['where']['view']=='categorias'){

$txt=trim(DTXTcat($v['where']['id']));
if(!$txt){$txt=InventaDTXTcat($v['where']['pagTittle']);};

$Datos['description']=$txt;
}

if($v['where']['view']=='cursos'){
$Datos['description']=$datCur['cur_descripcion'];
}
##########################################


$Datos['imgIconos']=loadIMG("iconos.png");
$Datos['imgValor']=loadIMG("valoracion.png");
$Datos['imgFspain']=loadIMG("spainF.png");
$Datos['imgIprovis']=loadIMG("spainP.png");



$Datos['links_css']=$v['linksCSS'];
$Datos['links_cssIE']=$v['linksCSSIE'];

createJS();

$Datos['links_js']=$v['linksjS'];

##########################################################






?>