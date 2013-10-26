<?php
global $rDatos2;
$bloquesEMER="";


if(count($rDatos2['prov'])>4){

$bloquesEMER .=loadChild('objt','EMER_todasPROVS');	
	
}



$Datos['bloquesEMER']=$bloquesEMER;




?>