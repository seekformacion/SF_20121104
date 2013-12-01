<?php

$Datos=array();

$catsinf=DBselect("select * from skv_arbolCats where id_sup=" . $v['where']['id'] . ";");


includeFUNC('categorias');

$rDatos['cadacat']=filtraCATS($catsinf);


?>

