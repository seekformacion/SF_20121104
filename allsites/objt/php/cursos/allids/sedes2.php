<?php
$cc=0;
global $datCur;
$pros=getCURProv();

if(count($pros)>0){
	

$Datos['cat']=$datCur['catDCurNOM'];

$idcur=$v['where']['id'];
$Datos['curnom']=$v['where']['pagTittle'];

$eqp=$v['vars']['provN'];

$idcentroS=$datCur['id_centro'];

foreach ($pros as $cp => $nu) {$cc++;
$prov=$eqp[$cp];
$rDatos['cadasede'][$cc]['cp']=	$cp;
$rDatos['cadasede2'][$cc]['nombre']=$datCur['catDCurNOM'] . " en " . $prov;
$rDatos['cadasede2'][$cc]['nombre2']=$datCur['catDCurNOM'] . " presenciales en " . $prov;
$rDatos['cadasede2'][$cc]['url']='/presencial/' . normaliza($prov) . str_replace('.html', '_presenciales_en_' . normaliza($prov) .'.html', $datCur['catDCurURL']);
}	

}else{
$Datos['ALTbloq']=loadChild('objt','addGimage');;

}

?>

