<?php
$cc=0;
global $datCur;;

$Datos['cat']=$datCur['catDCurNOM'];

$idcur=$v['where']['id'];
$Datos['curnom']=$v['where']['pagTittle'];

$eqp=$v['vars']['provN'];

$idcentroS=$datCur['id_centro'];
#$cps=DBselect("SELECT idpro FROM skv_relCurPro WHERE idcur=$idcur;");
#$cps=DBselect("SELECT distinct provincia FROM skv_sedes WHERE idcentro=$idcentroS ORDER BY nombre;");$cc=0;

/*
if(count($cps)>0){
foreach ($cps as $key => $prov) {$cc++;
$rDatos['cadasede'][$cc]['cp']=	$prov['provincia'];
$rDatos['cadasede2'][$cc]['nombre']=$eqp[$prov['provincia']];
}	
}
*/

$pros=getCURProv();


foreach ($pros as $cp => $nu) {$cc++;
$prov=$eqp[$cp];
$rDatos['cadasede'][$cc]['cp']=	$cp;
$rDatos['cadasede2'][$cc]['nombre']=$datCur['catDCurNOM'] . " en " . $prov;
$rDatos['cadasede2'][$cc]['nombre2']=$datCur['catDCurNOM'] . " presenciales en " . $prov;
$rDatos['cadasede2'][$cc]['url']='/presencial/' . normaliza($prov) . str_replace('.html', '_presenciales_en_' . normaliza($prov) .'.html', $datCur['catDCurURL']);
}	


?>

