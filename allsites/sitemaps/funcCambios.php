<?php 

function updtCUR($idcur){
	
$err="";
$nue=DBselectSDB("SELECT id_centro,           
id_old, nombre, nombre_viejo, cd1, cd2, cd3, cd4, cur_id_tipocurso, cur_id_metodo, cur_id_certificado, cur_titoficial, cur_precio, cur_mostarprecio, 
cur_facilidad, cur_practicas, cur_otrosdatos, cur_duracion, cur_descripcion, cur_dirigidoa, cur_paraqueteprepara, cur_edadmin, cur_edadmax, t_html, 
temario, cur_palclave, cur_minestudi, cur_cat FROM skP_cursos WHERE id=$idcur;",'seekpanel');


#### tabla cursos
$q="UPDATE skv_cursos SET ";
if(count($nue)>0){ foreach ($nue as $key => $vals) {
foreach ($vals as $camp => $valor){
$q.="$camp='$valor', ";	
}}}
$q=substr($q, 0,-2) . " WHERE id=$idcur;";
$err.=DBUpInsSDB($q,'seekformacion');
echo $err . "\n";


### tabla urls
$nue=DBselectSDB("SELECT idp, url, tipo, codTittle, pagTittle, pagTittleC, crsTittle FROM skP_C_urls WHERE t_id=$idcur;",'seekpanel');
$q="UPDATE skf_urls SET ";
if(count($nue)>0){ foreach ($nue as $key => $vals) {
foreach ($vals as $camp => $valor){
$q.="$camp='$valor', ";	
}}}
$q=substr($q, 0,-2) . " WHERE t_id=$idcur AND tipo=2;";
$err.=DBUpInsSDB($q,'seekformacion');
echo $err . "\n";


###  tabla  relCurCats
$dcur=DBselectSDB("SELECT cur_id_tipocurso, cur_id_metodo, cur_cat, showC FROM skP_cursos WHERE id=$idcur;",'seekpanel');
if(count($dcur)>0){
$id_cat=$dcur[1]['cur_cat'];
$id_tipo=$dcur[1]['cur_id_tipocurso'];		
$id_metodo=$dcur[1]['cur_id_metodo'];	
$showC=$dcur[1]['showC'];	

$err.=DBUpInsSDB("DELETE FROM skv_relCurCats WHERE id_cur=$idcur;",'seekformacion');	
$err.=DBUpInsSDB("INSERT INTO skv_relCurCats (id_cur, id_cat, id_tipo, id_metodo, showC) VALUES ($idcur,$id_cat,$id_tipo,$id_metodo,$showC);",'seekformacion');	
	
}


###  tabla  relCurPRO
$err.=DBUpInsSDB("DELETE FROM skv_relCurPro WHERE idcur=$idcur;",'seekformacion');
$dcur=DBselectSDB("SELECT sedes FROM skP_cur_sedes WHERE id=$idcur;",'seekpanel');
$sed=array();
if(count($dcur)>0){$sedes=$dcur[1]['sedes'];$sed=explode(',', $sedes);};
if(count($sed)>0){
$q="INSERT INTO skv_relCurPro (idcur,idpro) VALUES ";
foreach ($sed as $key => $sedeid) {$sedeid=$sedeid . "00";
$q.="($idcur,$sedeid),";	
}	
$q=substr($q, 0,-1) . ";";
$err.=DBUpInsSDB($q,'seekformacion');
}



}

?>


