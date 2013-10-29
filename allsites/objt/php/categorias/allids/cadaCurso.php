<?php

global $v;global $data; global $pals; 
$eqtip=$v['vars']['eqtip'];
$eqmet=$v['vars']['eqmet'];
$eqp=$v['vars']['provN'];

$nom=$data['nombre'];

############ añado nombre de provin en titulo
$idpro=$v['where']['id_provi'];
if($idpro){
$np=$eqp[$idpro];
$nom="$nom en $np";		
}
#############################################

############ añado online en titulo
//if($v['where']['online']){$nom="$nom online";};
#############################################

############ añado distancia en titulo
//if($v['where']['distancia']){$nom="$nom a distancia";};
#############################################



 
$Datos['nombre']=$nom;
$Datos['url']=$data['url'];
$Datos['tip']=$eqtip[$data['cur_id_tipocurso']]['s'];
$Datos['met']=$eqmet[$data['cur_id_metodo']]['s'];

$descripcion=$data['cur_paraqueteprepara'] . "</p><p>" . $data['cur_descripcion'];
$descripcion=strongTXT($descripcion,$pals);

$Datos['cur_descripcion']= $descripcion;
$Datos['ncent']=$data['ncent'];
$Datos['imgLogoCent']=loadLogoCent('p/' . $data['file_logo']);


?>