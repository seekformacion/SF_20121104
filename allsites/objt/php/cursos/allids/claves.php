<?php
global $datCur;

$Datos['curnom']=$v['where']['pagTittle'];
$Datos['cur_paraqueteprepara']=$datCur['cur_paraqueteprepara'];
$Datos['cur_dirigidoa']=$datCur['cur_dirigidoa'];

$codO=array('[|br]','[br]','[|str]','[str]','[|p]','[p]','[|em]','[em]');
$codN=array('</br>','<br>','</strong>','<strong>','</p>','<p>','</em>','<em>');

//$Datos['temario']=str_replace($codO, $codN, strip_tags($datCur['temario'])) . '</em></p></strong>';

$Datos['temario']=$datCur['temario'];
?>