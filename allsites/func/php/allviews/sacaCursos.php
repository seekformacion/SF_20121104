<?php

function getBloqueCursos(){
$a=1;$bloqueCursos="";	
while ($a <= 7) {
$a++;
	
global $Dcurso;
$Dcurso['a']=$a;

$bloqueCursos .=loadChild('objt','cadaCurso');
	
}

return $bloqueCursos;
}

?>