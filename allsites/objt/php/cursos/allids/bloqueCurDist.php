<?php
global $datCur;

$idcatBD= $datCur['idcat'];
$idt=$v['where']['idt'];

$idcur=$datCur['idCurso'];

$res=DBselect("SELECT id_metodo, id_cur FROM skv_relCurCats WHERE id_cat=$idcatBD AND id_tipo IN ($idt) AND id_metodo NOT IN (1,2,3) AND id_cur != $idcur ORDER BY id_metodo;");

$onli="";$dist="";
foreach ($res as $key => $Vals) {
if  ($Vals['id_metodo']==5){$onli .=$Vals['id_cur'] . ",";};		
if  ($Vals['id_metodo']==4){$dist .=$Vals['id_cur'] . ",";};	
}

$onli=substr($onli, 0,-1);
$dist=substr($dist, 0,-1);

$cc=0;

if($onli){$cc++;
$conl=ordenaCURs($onli,0,3);	

$bcur="";
foreach ($conl as $key => $idccur) {$dat=minidatCUR($idccur);
$ncur=$dat['pagTittleC']; $urlCur=$dat['url'];
$bcur.="<a href='$urlCur' title='$ncur'><li class='iconos color1'>$ncur</li></a>";
}

$rDatos['cdBLOQ'][$cc]['catDCurNOM']=$datCur['catDCurNOM'];
$rDatos['cdBLOQ'][$cc]['catDCurURL']='/online' .  str_replace('.html', '_online.html', $datCur['catDCurURL']);
$rDatos['cdBLOQ'][$cc]['class']='BQDonline';
$rDatos['cdBLOQ'][$cc]['met']='Online';	
$rDatos['cdBLOQ'][$cc]['bcur']=$bcur;
}




if($dist){$cc++;
$cdis=ordenaCURs($dist,0,3);	

$bcur="";
foreach ($cdis as $key => $idccur) {$dat=minidatCUR($idccur);
$ncur=$dat['pagTittleC']; $urlCur=$dat['url'];
$bcur.="<a href='$urlCur' title='$ncur'><li class='iconos color1'>$ncur</li></a>";
}

$rDatos['cdBLOQ'][$cc]['catDCurNOM']=$datCur['catDCurNOM'];
$rDatos['cdBLOQ'][$cc]['catDCurURL']='/a_distancia' . str_replace('.html', '_a_distancia.html', $datCur['catDCurURL']);
$rDatos['cdBLOQ'][$cc]['class']='BQDdistancia';	
$rDatos['cdBLOQ'][$cc]['met']='a distancia';
$rDatos['cdBLOQ'][$cc]['bcur']=$bcur;	
}




if ($cc==0){
$Datos['codNULL']=1;	
}


/*
$listcur="";	
$res=DBselect("SELECT id_cur FROM skv_relCurCats WHERE id_cat=$idcatBD;");	
foreach ($res as $key => $data) {$listcur.=$data['id_cur'] . ",";};
$listcur=substr($listcur, 0,-1);
$curs=ordenaCURs($listcur,0,5);
$cc=0;
foreach ($curs as $p => $idcur){$cc++;$rOtroscur[$cc]=minidatCUR($idcur);};
 
  */
?>
 