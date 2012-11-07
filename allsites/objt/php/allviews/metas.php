<?php 
includeCORE('css/css');
includeCORE('js/js');

createCSS();



#print_r($v[css][recursividad]);
######## creo enlaces a los css en funcion de visualizacion
#foreach($v[css][urls] as $res => $urls){foreach($urls as $num => $url){
#if($res == ""){ $Datos[links_css].="<link rel='stylesheet' type='text/css' href='$url' /> \n";};
#	if($res == "A"){ $stls=explode('/',$url);$num=count($stls)-1;$stl=str_replace('.','_',$stls[$num]);
#					 $Datos[links_css].="<link rel='stylesheet' type='text/css' href='$url' id='stl_$stl' /> \n";};
#}}
##########################################################

$Datos['links_css']=$v['linksCSS'];

createJS();

$Datos['links_js']=$v['linksjS'];

##########################################################






?>