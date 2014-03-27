<?php 



includeFUNC('categorias');
includeFUNC('sacaCursos');
includeFUNC('images');

$appid[1]="676600425716555";
$appid[2]="586283288126818";
$appid[3]="726238200741616";
$appid[4]="1468920489988724";

$Datos['fbAPP']=$appid[$v['where']['idp']];


$Datos['pagTittle']=$v['where']['pagTittle'];

$idcur=$v['where']['id'];

$shc=DBselect("SELECT showC FROM skv_relCurCats WHERE id_cur=$idcur;");
if(count($shc)>0){$showc=$shc[1]['showC'];}

//echo "SELECT showC FROM skv_relCurCats WHERE id_cur=$idcur; --- $showc";




$datCur=array();
global $datCur;
$datos=DBselect("SELECT * FROM skv_cursos WHERE id=$idcur;");
if(array_key_exists(1, $datos)){$datCur=$datos[1];};


$idcat="";
$dato=DBselect("select id_cat from skv_relCurCats where id_cur=$idcur;");
if(array_key_exists(1, $dato)){$idcat=$dato[1]['id_cat'];};

if($idcat){
$Datos['breadcrumbs']=breadCRUMBSCUR($idcat);

$datCur['idcat']=$idcat;
$datCur['idCurso']=$idcur;

$catnoms=DBselect("SELECT pagTittleC, url FROM skf_urls WHERE t_id=$idcat AND tipo=1;");
$datCur['catDCurNOM']=$catnoms[1]['pagTittleC'];
$datCur['catDCurURL']=$catnoms[1]['url'];
################# cursos de la cat
global $rOtroscur;

$listcur="";	
$res=DBselect("SELECT id_cur FROM skv_relCurCats WHERE id_cat=$idcat AND id_cur != $idcur;");
foreach ($res as $key => $data) {$listcur.=$data['id_cur'] . ",";};
$listcur=trim(substr($listcur, 0,-1));

$curs=array();$cc=0;
if($listcur){$curs=ordenaCURs($listcur,0,5);}
if(count($curs)>0){foreach ($curs as $p => $idcur){$cc++;$rOtroscur[$cc]=minidatCUR($idcur);};}

}else{$Datos['breadcrumbs']="";};



if ($showc){


$Datos['header']=loadChild('objt','header');
$Datos['cabCurso']=loadChild('objt','cabCurso');
$Datos['detallesCurso']=loadChild('objt','detallesCurso');

//$Datos['add_CUR_cent']=loadChild('objt','add_CUR_cent');

$Datos['claves']=loadChild('objt','claves');
$Datos['cursosSimilares']=loadChild('objt','cursosSimilares');

#$Datos['descTXTcat']=loadChild('objt','descTXTcat');


#### si es presencial cargo sedes
if(($datCur['cur_id_metodo']<=3)){
$Datos['sedes']=loadChild('objt','sedes');
}else{
$Datos['sedes']=loadChild('objt','sedes2');	
}

//$Datos['adW_LD']=loadChild('objt','adW_LD');

$Datos['bloqueCurDist']=loadChild('objt','bloqueCurDist');
#$Datos['bloqueDISTANCIA']=loadChild('objt','bloqueDISTANCIA');


#$Datos['masCATS']=loadChild('objt','masCATS');


$Datos['navBAR']=loadChild('objt','navBAR');

$Datos['footer']=loadChild('objt','footer');


$Datos['metas']=loadChild('objt','metas');


}else{

$Datos['H_redirect']=$datCur['catDCurURL'];


	
}


?>