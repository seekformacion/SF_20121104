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

if(array_key_exists('imgCat', $v)){
$Datos['imgCatPEQ']=$v['imgCat'];
}else{$Datos['imgCatPEQ']="";}
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

$Datos['imgDedo']=loadIMG("dedo.png");
$Datos['imgIconos']=loadIMG("iconos.png");
$Datos['imgValor']=loadIMG("valoracion.png");
$Datos['imgFspain']=loadIMG("spainF.png");
$Datos['imgIprovis']=loadIMG("spainP.png");



$Datos['links_css']=$v['linksCSS'];
$Datos['links_cssIE']=$v['linksCSSIE'];

createJS();

$Datos['links_js']=$v['linksjS'];

$gaccounts[1]="UA-36119979-1"; $gaccountsN[1]="cursodecursos.com";
$gaccounts[2]="UA-46923978-1"; $gaccountsN[2]="masterenmasters.com";
$gaccounts[3]="UA-36119979-1"; $gaccountsN[3]="cursodecursos.com";
$gaccounts[4]="UA-36119979-1"; $gaccountsN[4]="cursodecursos.com";

$Datos['analytics']=$gaccounts[$v['where']['idp']];
$Datos['analyticsN']=$gaccountsN[$v['where']['idp']];
##########################################################




?>