<?php

global $lccu;

$Datos['class']=$lccu['key'];
$idcu= $lccu['$idcc'];

$res=DBselect("
SELECT t_id, url, pagTittle, pagTittleC, 
(SELECT cur_descripcion FROM skv_cursos WHERE id=t_id) as cur_descripcion, 
(SELECT cur_id_metodo FROM skv_cursos WHERE id=t_id) as cur_id_metodo, 
(SELECT file_logo FROM skv_centros WHERE skv_centros.id IN (SELECT id_centro FROM skv_cursos WHERE skv_cursos.id=t_id)) as file_logo, 
(SELECT cur_id_tipocurso FROM skv_cursos WHERE id=t_id) as cur_id_tipocurso 
 FROM skf_urls WHERE tipo=2 AND t_id=$idcu;");	

$Datos['nombre']=$res[1]['pagTittle'];	
$Datos['descripcion']=$res[1]['cur_descripcion'];	
$Datos['url']=$res[1]['url'];
$Datos['tip']=$v['vars']['eqtip'][$res[1]['cur_id_tipocurso']]['s'];
$Datos['met']=$v['vars']['eqmet'][$res[1]['cur_id_metodo']]['s'];
$Datos['imgLogoCent']=loadLogoCent('p/' . $res[1]['file_logo']);

$Datos['v']=valoracion($idcu);

?>