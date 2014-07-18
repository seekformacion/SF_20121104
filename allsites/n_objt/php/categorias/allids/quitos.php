<?php


$idpro=$v['where']['id_provi'];
$online=$v['where']['online'];
$distancia=$v['where']['distancia'];

$c=0;

$bacKurl=$v['where']['urlSimple'];

$lk='onclick="lK(\'' . $bacKurl . '\')"';	


$c=1;

$bkn=$v['where']['pagTittleSimp'];
$bk=$v['where']['csup']['url'];

$rDatos['cadaquito'][$c]['quito']=$bkn;	
$rDatos['cadaquito'][$c]['lk']=$bk;


if($idpro){$quito="<h2>" . "Presenciales / " . $v['vars']['provN'][$idpro] . "</h2>";$c++;}
if($online){$quito="<h2>" . "Online" . "</h2>";$c++; }
if($distancia){$quito="<h2>" . "A distancia" . "</h2>";$c++; }

if($c>1){
	
$rDatos['cadaquito'][$c]['quito']=$quito;	
$rDatos['cadaquito'][$c]['lk']=$lk;	


}







?>