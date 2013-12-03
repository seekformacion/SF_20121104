<?php 
includeCORE('css/css');
includeCORE('js/js');

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

createJS();

$Datos['links_js']=$v['linksjS'];

##########################################################






?>