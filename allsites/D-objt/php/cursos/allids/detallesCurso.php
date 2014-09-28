<?php
global $datCur;

if( ($datCur['cur_precio']) && ($datCur['cur_mostarprecio']==1) ){$precio=$datCur['cur_precio'];}else{$precio="Consultar con el centro.";};
$Datos['cur_precio']=$precio;

$Datos['cur_duracion']=$datCur['cur_duracion'];
$Datos['cur_titoficial']=$datCur['cur_titoficial'];
$Datos['cur_id_certificado']=$v['vars']['certi'][$datCur['cur_id_certificado']];

$edad="";      
if( ($datCur['cur_edadmin']) && ($datCur['cur_edadmax']) ){$edad="Entre " . $datCur['cur_edadmin'] . " y " . $datCur['cur_edadmax'] . " años.";};	
if( ($datCur['cur_edadmin']) && (!$datCur['cur_edadmax']) ){$edad="Mas de  " . $datCur['cur_edadmin'] .  " años.";};	
if( (!$datCur['cur_edadmin']) && ($datCur['cur_edadmax']) ){$edad="Menos de  " . $datCur['cur_edadmax'] .  " años.";};		  
if($edad){$edad="<strong>Edad:</strong> $edad";};

$esmin="";
$esmin=$v['vars']['esmin'][$datCur['cur_minestudi']];
if($esmin){$esmin="<strong>Nivel de estudios mínimo:</strong> $esmin</p>";};
	  
if(($edad)||($esmin)){$requi="$edad $esmin";}else{$requi="Sin requisitos.";}

$Datos['requi']=$requi;

$Datos['cur_otrosdatos']=$datCur['cur_otrosdatos'];


?>