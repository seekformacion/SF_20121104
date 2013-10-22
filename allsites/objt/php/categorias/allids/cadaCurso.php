<?php

global $v;global $data; global $pals; 
$eqtip=$v['vars']['eqtip'];
$eqmet=$v['vars']['eqmet'];


$Datos['a']=$data['id'];	 
$Datos['nombre']=$data['nombre'];
$Datos['tip']=$eqtip[$data['cur_id_tipocurso']]['s'];
$Datos['met']=$eqmet[$data['cur_id_metodo']]['s'];

$descripcion=$data['cur_paraqueteprepara'] . "</p><p>" . $data['cur_descripcion'];
$descripcion=strongTXT($descripcion,$pals);

$Datos['cur_descripcion']= $descripcion;
$Datos['ncent']=$data['ncent'];
$Datos['imgLogoCent']=loadLogoCent('p/' . $data['file_logo']);


?>