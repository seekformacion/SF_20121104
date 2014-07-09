<?php 

includeFUNC('categorias');
includeFUNC('sacaCursos');
includeFUNC('images');

$idcat=$v['where']['id'];
catsINF($idcat);


$appid[1]="676600425716555";
$appid[2]="586283288126818";
$appid[3]="726238200741616";
$appid[4]="1468920489988724";


$Datos['imgLogo']=loadIMG("logo.png");
$Datos['home']="http://" . $v['where']['site'];

$v['imgCat']=imgCATg($v['where']['id']); 
$Datos['imgCat']=$v['imgCat'];


$Datos['fbAPP']=$appid[$v['where']['idp']];


$Datos['pagTittle']=$v['where']['pagTittle'];# . " | " . $v['where']['id'];
$Datos['idcfA']=$v['where']['id'];



$Datos['breadcrumbs']=breadCRUMBS($idcat);


###### descripcion y SOCIAL
$txt=trim(TXTcat($v['where']['id']));
if(!$txt){$txt=InventaTXTcat($v['where']['pagTittleSimp'],0);};
$Datos['txtDesc']=$txt;
$Datos['fburl']="http://" . $v['where']['site']  . $v['where']['urlSimple'];




$bc=$v['where']['bc2'];

$bc=str_replace('<a href', '<a class="color1" href', $bc);
$v['where']['bc']=$bc . " ". $v['where']['pagTittle'];

//$Datos['sliders']=loadChild('objt','sliders');

$Datos['catsinf']=loadChild('n_objt','catsinf');


$Datos['listCursos']=loadChild('n_objt','listCursos');


$Datos['catsinf_Otras']=loadChild('n_objt','catsinf_Otras');

global $lccu;
$Datos['topCURinf']=$lccu['html'];


//$Datos['adW_LD']=loadChild('objt','adW_LD');


//$Datos['tod_CUR']=loadChild('objt','tod_CUR');




//$Datos['bloqueGEO']=loadChild('objt','bloqueGEO');
//$Datos['bloqueONLINE']=loadChild('objt','bloqueONLINE');
//$Datos['bloqueDISTANCIA']=loadChild('objt','bloqueDISTANCIA');


//$Datos['masCATS']=loadChild('objt','masCATS');


//$Datos['navBAR']=loadChild('objt','navBAR');

//$Datos['header']=loadChild('objt','header');
//$Datos['footer']=loadChild('objt','footer');


//$Datos['descTXTcat']=loadChild('objt','descTXTcat');

global $lccuT;
//$Datos['curDEST']=$lccuT['html'];


$Datos['metas']=loadChild('n_objt','metas');






?>