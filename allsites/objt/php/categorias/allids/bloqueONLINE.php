<?php




$chkDist=getCURMet(3);

if((!$chkDist)||($v['where']['online'])){
$Datos['codNULL']=1;	
}else{

$Datos['imgOnline']=loadIMG("geo/tip_online.jpg");

$urlS=$v['where']['urlSimple'];
$urlS=str_replace('.html', '', $urlS);
$url="/online$urlS" . "_online.html";


$Datos['cabPROtit']=$v['where']['pagTittleSimp'];
$Datos['cabPROURL']=$url;
$Datos['cabPROURLA']=$v['where']['pagTittleSimp'] . " online";	


}



?>