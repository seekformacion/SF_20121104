<?php

global $rDatos2;
$pros=getCURProv();

$key=0; $npros=count($pros);



foreach ($pros as $idp => $count) {

$provn=$v['vars']['provN'][$idp];



$urlS=$v['where']['urlSimple'];
$urlS=str_replace('.html', '', $urlS);
$provn2=normaliza($provn);
$url="/presencial/$provn2$urlS" . "_presenciales_en_$provn2.html";

if($key==0){

$Datos['imgGEO']=loadIMG("geo/" . $provn2 . ".jpg");
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
$c=$key+1;
$rDatos2['prov'][$c]['cpro']=$v['where']['pagTittle'] . " en ";
$rDatos2['prov'][$c]['idp']=$provn;
$rDatos2['prov'][$c]['cproal']=$v['where']['pagTittle'] . " presenciales en " . $provn;
$rDatos2['prov'][$c]['url']=$url;


$key++;
}


if($npros<2){
$rDatos['prov'][0]['cpro']="";
$rDatos['prov'][0]['idp']="";
$rDatos['prov'][0]['cproal']="";
$rDatos['prov'][0]['url']="";
}


if($npros>5){
$Datos['todas']='<div class="masPROVIS color1 iconos" onclick="javascript:emerge(\'em-1\')" >TODAS</div>';	
}else{
$Datos['todas']='';		
}


if ($npros==0){
$Datos['codNULL']=1;	
}


?>