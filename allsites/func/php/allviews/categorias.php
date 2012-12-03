<?php

function filtraCATS($catsinf){

foreach ($catsinf as $point => $values) {
$id=$values['id'];	
$nom=$values['nom'];
$id_old=$values['id_old'];

$res[$point]['id']=$id;
$res[$point]['nom']=$nom;
$res[$point]['id_old']=$id_old;

$res[$point]['cats_inf']=CATS_inf($id);

}	

return $res;
}


function CATS_inf($cat){
$listinf="";
$inferiores=DBselect("select id from skv_arbolCats where superiores like '%|$cat|%';");

foreach ($inferiores as $key => $values) {$listinf .=$values['id'] . ",";};

return $listinf;
}

?>