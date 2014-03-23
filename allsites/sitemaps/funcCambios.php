<?php 

function updtCUR($idcur){
echo $idcur . "\n";	

$nue=DBselectSDB("SELECT * FROM skP_cursos WHERE id=$idcur;",'seekpanel');

print_r($nue);	
}

?>