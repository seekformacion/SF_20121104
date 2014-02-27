<?php 

includeFUNC('categorias');
includeFUNC('sacaCursos');
includeFUNC('images');

$idcat=$v['where']['id'];
catsINF($idcat);





$Datos['pagTittle']=$v['where']['pagTittle'];# . " | " . $v['where']['id'];
$Datos['idcfA']=$v['where']['id'];



$Datos['breadcrumbs']=breadCRUMBS($idcat);


$bc=$v['where']['bc2'];

$bc=str_replace('<a href', '<a class="color1" href', $bc);
$v['where']['bc']=$bc . " ". $v['where']['pagTittle'];

$Datos['sliders']=loadChild('objt','sliders');

$Datos['catsinf']=loadChild('objt','catsinf');

$Datos['listCursos']=loadChild('objt','listCursos');

global $lccu;
$Datos['topCURinf']=$lccu['html'];


//$Datos['adW_LD']=loadChild('objt','adW_LD');


$Datos['tod_CUR']=loadChild('objt','tod_CUR');




$Datos['bloqueGEO']=loadChild('objt','bloqueGEO');
$Datos['bloqueONLINE']=loadChild('objt','bloqueONLINE');
$Datos['bloqueDISTANCIA']=loadChild('objt','bloqueDISTANCIA');


$Datos['masCATS']=loadChild('objt','masCATS');


$Datos['navBAR']=loadChild('objt','navBAR');

$Datos['header']=loadChild('objt','header');
$Datos['footer']=loadChild('objt','footer');


$Datos['descTXTcat']=loadChild('objt','descTXTcat');

global $lccuT;
$Datos['curDEST']=$lccuT['html'];


$Datos['metas']=loadChild('objt','metas');






?>