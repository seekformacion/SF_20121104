<?php

global $datCur;;

$idcur=$v['where']['id'];
$Datos['curnom']=$v['where']['pagTittle'];

$met=$v['vars']['eqmet'][$datCur['cur_id_metodo']]['s'];
if($met=='Personalizado'){$met='Personalizada';};
$met=strtolower($met);

$Datos['metodo']=$met;
$eqp=$v['vars']['provN'];

$idcentroS=$datCur['id_centro'];
$cps=DBselect("SELECT idpro FROM skv_relCurPro WHERE idcur=$idcur;");
//$cps=DBselect("SELECT distinct provincia FROM skv_sedes WHERE idcentro=$idcentroS ORDER BY nombre;");
$cc=0;


if(count($cps)>0){
foreach ($cps as $key => $prov) {$cc++;
$idp=substr($prov['provincia'],0,3);
if(($idp=='070')||($idp=='077')||($idp=='078')){}else{$idp=substr($idp, 0,2) . "0";}	
$rDatos['cadasede'][$cc]['cp']=	$idp;
$rDatos['cadasede2'][$cc]['nombre']=$eqp[$idp];
}	
}

/*
foreach ($eqp as $cp => $prov) {$cc++;
$rDatos['cadasede'][$cc]['cp']=	$cp;
$rDatos['cadasede2'][$cc]['nombre']=$prov;
}	
*/

?>