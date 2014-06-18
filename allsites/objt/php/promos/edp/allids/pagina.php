<?php

$Datos['pagTittle']=$v['where']['pagTittle'];

$idcur=$v['where']['id'];
$Datos['idc']=$idcur;

$res=DBselect("SELECT html FROM skf_cms_promos WHERE t_id=$idcur;");
if(array_key_exists(1, $res)){$Datos['cms']=$res[1]['html'];}else{$Datos['cms']="";};


$Datos['metas']=loadChild('objt','metas');

?>
