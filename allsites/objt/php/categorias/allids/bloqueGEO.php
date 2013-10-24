<?php

global $rDatos2;
$pros=getCURProv();

$key=0;
foreach ($pros as $idp => $count) {

$provn=$v['vars']['provN'][$idp];



$urlS=$v['where']['urlSimple'];
$urlS=str_replace('.html', '', $urlS);
$provn2=normaliza($provn);
$url="/presencial/$provn2$urlS" . "_presenciales_en_$provn2.html";

if($key==0){

$Datos['imgGEO']=loadIMG("geo/" . $provn2 . ".jpg"); echo "geo/" . $provn2 . ".jpg";
$Datos['cabPROtit']=$v['where']['pagTittle'];
$Datos['cabPRO']=$provn;
$Datos['cabPROURL']=$url;
$Datos['cabPROURLA']=$v['where']['pagTittle'] . " presenciales en " . $provn;;	
}elseif($key <= 4){


$rDatos['prov'][$key]['cpro']=$v['where']['pagTittle'] . " en ";
$rDatos['prov'][$key]['idp']=$provn;
$rDatos['prov'][$key]['cproal']=$v['where']['pagTittle'] . " presenciales en " . $provn;
$rDatos['prov'][$key]['url']=$url;

}

$rDatos2['prov'][$key]['cpro']=$v['where']['pagTittle'] . " en ";
$rDatos2['prov'][$key]['idp']=$provn;
$rDatos2['prov'][$key]['cproal']=$v['where']['pagTittle'] . " presenciales en " . $provn;
$rDatos2['prov'][$key]['url']=$url;


$key++;
}


?>