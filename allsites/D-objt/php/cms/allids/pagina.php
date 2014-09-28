<?php 


$idcms=$v['where']['id'];


$inf=DBselect("select html from skf_cms where t_id=$idcms;");
if(array_key_exists(1, $inf)){$cms=$inf[1]['html'];}

$Datos['cms']=$cms;

$Datos['adW_LD']=loadChild('objt','adW_LD');



$Datos['navBAR']=loadChild('objt','navBAR');

$Datos['header']=loadChild('objt','header');
$Datos['footer']=loadChild('objt','footer');
$Datos['emergentes']=loadChild('objt','emergentes');



$Datos['metas']=loadChild('objt','metas');






?>