<?php
includeFUNC('crossPCUR');

$slid=getSliders();


if($slid){
$Datos['Slides']=$slid; 
}else{
$Datos['codNULL']=1; 
}


?>