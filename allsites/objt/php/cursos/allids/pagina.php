<?php 

includeFUNC('categorias');

$Datos['pagTittle']=$v['where']['pagTittle'];

$idcur=$v['where']['id'];

$idcat="";
$dato=DBselect("select id_cat from skv_relCurCats where id_cur=$idcur;");
if(array_key_exists(1, $dato)){$idcat=$dato[1]['id_cat'];};
if($idcat){$Datos['breadcrumbs']=breadCRUMBSCUR($idcat);}else{$Datos['breadcrumbs']="";};



$datCur=array();
global $datCur;
$datos=DBselect("SELECT * FROM skv_cursos WHERE id=$idcur;");
if(array_key_exists(1, $datos)){$datCur=$datos[1];};

$Datos['header']=loadChild('objt','header');
$Datos['cabCurso']=loadChild('objt','cabCurso');
$Datos['detallesCurso']=loadChild('objt','detallesCurso');

$Datos['claves']=loadChild('objt','claves');
$Datos['cursosSimilares']=loadChild('objt','cursosSimilares');

#$Datos['descTXTcat']=loadChild('objt','descTXTcat');

$Datos['sedes']=loadChild('objt','sedes');
$Datos['bloqueCurDist']=loadChild('objt','bloqueCurDist');
#$Datos['bloqueDISTANCIA']=loadChild('objt','bloqueDISTANCIA');


#$Datos['masCATS']=loadChild('objt','masCATS');


$Datos['navBAR']=loadChild('objt','navBAR');

$Datos['footer']=loadChild('objt','footer');


$Datos['metas']=loadChild('objt','metas');





?>