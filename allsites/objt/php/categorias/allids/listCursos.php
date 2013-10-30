<?php



$Datos['fondCur']=loadIMG('fondos/fondolistC.gif');

$bcursos=getBloqueCursos();
if(trim($bcursos)){$Datos['suma_cadaCurso']=$bcursos;}else{$Datos['codNULL']=1;};


?>