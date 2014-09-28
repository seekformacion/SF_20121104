<?php 
$url=$v['where']['url']; $idprovi=$v['where']['id_provi'];

if(($idprovi)||($v['where']['distancia'])||($v['where']['online'])){

$Datos['txt']=strtolower($v['where']['pagTittleSimp']);
$Datos['url']=$v['where']['urlSimple'];

}else{
	
$Datos['codNULL']=1;		
}



?>