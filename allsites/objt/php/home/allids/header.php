<?php


$Datos['imgLogo']=loadIMG("logo.png");
$Datos['imgCat']=loadIMGCat('g');
$Datos['imgMaskCat']=loadIMG("mascaras/mascarafondocat.png");

$Datos['home']="http://" . $v['where']['site'];


$Datos['Hprev']=$v['where']['Hprev'];
$Datos['Hnext']=$v['where']['Hnext'];

if($v['admin']==1){
$Datos['admin']=loadChild('objt','adminCAT');
}else{
$Datos['admin']="";
}

?>