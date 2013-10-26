<?php 


includeFUNC('sacaCursos');

$Datos['pagTittle']=$v['where']['pagTittle'];


$Datos['sliders']=loadChild('objt','sliders');

$Datos['listCursos']=loadChild('objt','listCursos');



$Datos['descTXTcat']=loadChild('objt','descTXTcat');
$Datos['adW_LD']=loadChild('objt','adW_LD');



$Datos['bloqueGEO']=loadChild('objt','bloqueGEO');
$Datos['bloqueONLINE']=loadChild('objt','bloqueONLINE');
$Datos['bloqueDISTANCIA']=loadChild('objt','bloqueDISTANCIA');


$Datos['masCATS']=loadChild('objt','masCATS');


$Datos['navBAR']=loadChild('objt','navBAR');

$Datos['header']=loadChild('objt','header');
$Datos['footer']=loadChild('objt','footer');
$Datos['emergentes']=loadChild('objt','emergentes');



$Datos['metas']=loadChild('objt','metas');






?>