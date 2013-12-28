<?php


$Datos['imgLogo']=loadIMG("logo.png");
$v['imgCat']=imgCATg($v['where']['id']); 
$Datos['imgCat']=$v['imgCat'];
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