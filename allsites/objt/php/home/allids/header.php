<?php


$Datos['imgLogo']=loadIMG("logo.png");
$Datos['imgCat']=loadIMGCat('g');
$Datos['imgMaskCat']=loadIMG("mascaras/mascarafondocat.png");

$Datos['home']="http://" . $v['where']['site'];


if($v['where']['idp']==1){$self='<a class="color" alt="Curso de cursos" href="http://cursodecursos.com">Curso cursos</a>';};
if($v['where']['idp']==2){$self='<a class="color" alt="Master de Masters" href="http://masterenmasters.com">Master en: Masters</a>';};

$Datos['self']=$self;


//
//$Datos['Hnext']=$v['where']['Hnext'];

if($v['admin']==1){
$Datos['admin']=loadChild('objt','adminCAT');
}else{
$Datos['admin']="";
}

?>