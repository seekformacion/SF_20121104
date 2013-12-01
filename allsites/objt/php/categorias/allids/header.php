<?php


$Datos['imgLogo']=loadIMG("logo.png");
$Datos['imgCat']=imgCATg($v['where']['id']);
$Datos['imgMaskCat']=loadIMG("mascaras/mascarafondocat.png");

$Datos['Hprev']=$v['where']['Hprev'];
$Datos['Hnext']=$v['where']['Hnext'];

if($v['admin']==1){
$Datos['admin']=loadChild('objt','adminCAT');
}else{
$Datos['admin']="";
}

?>