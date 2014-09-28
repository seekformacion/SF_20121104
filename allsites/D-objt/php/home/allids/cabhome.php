<?php


$eqALT[1]="Cursos de";
$eqALT[2]="Masters en";
$eqALT[3]="Fp formación profesional grados";
$eqALT[4]="Preparación de oposiciones a";

$eqTXT[1]="La mejor selección de cursos. Encuentra fácilmente y compara entre una gran seleción de cursos en toda España";
$eqTXT[2]="Completa tu formación, Aspira a mejores puestos de trabajo. Sigue formandote con la grán selección de masters, postgrados y carreras universitarias que te proponemos";
$eqTXT[3]="Desarrollate profesionalmente haciendo lo que más te gusta. Con las opciones que te proponemos para obtener tu titulación como técnico. Ciclos de grado medio y grado superior";
$eqTXT[4]="Encuentra facilmente el programa para preparar las oposiciones que mas te interesan. ";


$Datos['cabc']=loadIMG("cabcurso.gif");

$ports=$v['vars']['purlT'];$c=0;
foreach ($ports as $idp => $tit) {

if($idp==$v['where']['idp']){

$Datos['cTIT']=$tit;	
$Datos['cURL']=$v['vars']['purl'][$idp];
$Datos['cALT']=$eqALT[$idp];
$Datos['cTXT']=$eqTXT[$idp];

}else{$c++;

$rDatos['cadaP'][$c]['tit']=$tit;	
$rDatos['cadaP'][$c]['url']=$v['vars']['purl'][$idp];		
}
	
}

?>