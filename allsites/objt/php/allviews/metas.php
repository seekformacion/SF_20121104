<?php 
includeCORE('css/css');
includeCORE('js/js');

createCSS();

$Datos['baseurlFonts']=$v['path']['baseURLskin'][$v['conf']['mode']];

$Datos['imgIconos']=loadIMG("iconos.png");
$Datos['imgFspain']=loadIMG("spainF.png");
$Datos['imgIprovis']=loadIMG("spainP.png");

$Datos['links_css']=$v['linksCSS'];

createJS();

$Datos['links_js']=$v['linksjS'];

##########################################################






?>