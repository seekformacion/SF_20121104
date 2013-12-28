<?php
global $datCur;


$Datos['imgLogo']=loadIMG("logo.png");
$v['imgCat']=imgCATg($datCur['idcat']); 
$Datos['imgCat']=$v['imgCat'];
$Datos['imgMaskCat']=loadIMG("mascaras/mascarafondocat.png");

$Datos['home']="http://" . $v['where']['site'];

?>