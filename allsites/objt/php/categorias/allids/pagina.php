<?php 

includeFUNC('categorias');
includeFUNC('sacaCursos');
includeFUNC('images');

$idcat=$v['where']['id'];
catsINF($idcat);





$Datos['pagTittle']=$v['where']['pagTittle'] . " | " . $v['where']['id'];
$Datos['idcfA']=$v['where']['id'];



$Datos['breadcrumbs']=breadCRUMBS($idcat);

$Datos['sliders']=loadChild('objt','sliders');

$Datos['catsinf']=loadChild('objt','catsinf');

$Datos['listCursos']=loadChild('objt','listCursos');

global $lccu;
$Datos['topCURinf']=$lccu['html'];

$Datos['descTXTcat']=loadChild('objt','descTXTcat');
$Datos['adW_LD']=loadChild('objt','adW_LD');


$Datos['tod_CUR']=loadChild('objt','tod_CUR');
$Datos['bloqueGEO']=loadChild('objt','bloqueGEO');
$Datos['bloqueONLINE']=loadChild('objt','bloqueONLINE');
$Datos['bloqueDISTANCIA']=loadChild('objt','bloqueDISTANCIA');


$Datos['masCATS']=loadChild('objt','masCATS');


$Datos['navBAR']=loadChild('objt','navBAR');

$Datos['header']=loadChild('objt','header');
$Datos['footer']=loadChild('objt','footer');




$Datos['metas']=loadChild('objt','metas');






?>