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


 
$Datos['nombre']=$nom;# . "-" . $data['cur_id_metodo'] . "-" . $data['id'];
$Datos['url']=$data['url'];
$Datos['id']=$data['id'];
$Datos['tip']=$eqtip[$data['cur_id_tipocurso']]['s'];
$Datos['met']=$eqmet[$data['cur_id_metodo']]['s'];
$Datos['v']=valoracion($data['id']);
$Datos['bc']=$v['where']['bc'];

$descripcion=$data['cur_paraqueteprepara'] . "</p><p>" . $data['cur_descripcion'];
$descripcion=strongTXT($descripcion,$pals);

$Datos['cur_descripcion']= $descripcion;
$Datos['ncent']=$data['ncent'];
$Datos['imgLogoCent']=loadLogoCent('p/' . $data['file_logo']);


?>