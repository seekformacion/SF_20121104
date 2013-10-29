<?php

$chkDist=getCURMet(2);

if((!$chkDist)||($v['where']['distancia'])){
$Datos['codNULL']=1;	
}else{

$Datos['imgDistancia']=loadIMG("geo/tip_distancia.jpg");

$urlS=$v['where']['urlSimple'];
$urlS=str_replace('.html', '', $urlS);
$url="/a_distancia$urlS" . "_a_distancia.html";


$Datos['cabPROtit']=$v['where']['pagTittleSimp'];
$Datos['cabPROURL']=$url;
$Datos['cabPROURLA']=$v['where']['pagTittleSimp'] . " a distancia ";	


}





?>