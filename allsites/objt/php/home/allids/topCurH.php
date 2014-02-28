<?php
$idp=$v['where']['idp'];

$lcusos=""; 
$curinf=DBselect("SELECT t_id FROM skf_urls WHERE tipo=2 AND idp=$idp AND t_id IN (SELECT id_cur FROM skv_relCurCats WHERE showC=1);");
if(count($curinf)>0){foreach ($curinf as $k => $vals){$lcusos.=$vals['t_id'] . ",";};};$lcusos=substr($lcusos, 0,-1);
$lcusos=ordenaCURs($lcusos,0,2);

//print_r($lcusos);

$cc=0;
foreach ($lcusos as $key => $idc) {
$curinf=DBselect("SELECT pagTittleC, url, t_id, (SELECT file_logo FROM skv_centros WHERE id IN (SELECT id_centro FROM skv_cursos WHERE id=t_id)) as idc from skf_urls where tipo=2 AND t_id=$idc;");
if(count($curinf)>0){
foreach ($curinf as $k => $vals){
$cc++;
$rDatos['curD'][$cc]['cnom']=$vals['pagTittleC'];		
$rDatos['curD'][$cc]['url']=$vals['url'];
$rDatos['curD'][$cc]['idc']=$vals['idc'];
}}}

//print_r($rDatos);
?>