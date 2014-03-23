<?php 

function updtCUR($idcur){
	

$nue=DBselectSDB("SELECT id_centro,           
id_old, 
nombre, 
nombre_viejo, 
cd1, 
cd2, 
cd3, 
cd4, 
cur_id_tipocurso, 
cur_id_metodo, 
cur_id_certificado, 
cur_titoficial, 
cur_precio, 
cur_mostarprecio, 
cur_facilidad, 
cur_practicas, 
cur_otrosdatos, 
cur_duracion, 
cur_descripcion, 
cur_dirigidoa, 
cur_paraqueteprepara, 
cur_edadmin, 
cur_edadmax, 
t_html, 
temario, 
cur_palclave, 
cur_minestudi, 
cur_cat FROM skP_cursos WHERE id=$idcur;",'seekpanel');

$q="UPDATE skv_cursos SET ";
if(count($nue)>0){ foreach ($nue as $key => $vals) {foreach ($vals as $camp => $valor){
$q.="$camp='$valor', ";	
}}}
$q=substr($q, 0,-2) . " WHERE id=$idcur;";
$err=DBUpInsSDB($q,'seekformacion');
echo $err . "\n";

}

?>


