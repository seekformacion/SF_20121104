<?php
global $datCur;

$Datos['fburl']=trim("http://" . $v['where']['site'] . $v['where']['url']);

$Datos['pagTittle']=$v['where']['pagTittle'];

$Datos['id']=$datCur['id'];
$Datos['imgLogoCent']=loadLogoCent('g/logo1.gif');
$Datos['v']=valoracion($datCur['id']);
$Datos['rv']=$Datos['v'] + 5;
$Datos['rc']=rcount($datCur['id']);
$Datos['cur_descripcion']=$datCur['cur_descripcion'];

$Datos['tipo']=$v['vars']['eqtip'][$datCur['cur_id_tipocurso']]['s']; 
$Datos['metodo']=$v['vars']['eqmet'][$datCur['cur_id_metodo']]['s'];

$idcentro=$datCur['id_centro'];$logo="";
$datos=DBselect("SELECT file_logo FROM skv_centros WHERE id=$idcentro;");
if(array_key_exists(1, $datos)){$logo=$datos[1]['file_logo'];};      
$Datos['imgLogoCent']=loadLogoCent('g/' . $logo);

$Datos['altIMGc']=$v['where']['pagTittle'];

?>