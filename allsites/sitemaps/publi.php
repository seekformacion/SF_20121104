<?php
set_time_limit(0);
ini_set("memory_limit", "-1");


include('/www/dbA.php');
include('/www/db-1.php');

$v['debug']=0;
$v['admin']=0;

$v['conf']['state']=1; # 1=test 2=produccion
$v['conf']['mode']=1; # 1=local 2=cloud
$v['where']['idp']=						1; #### ID DEL PORTAL PARA TABLA urls
$v['where']['view']=					'sitemaps'; #### ID DEL PORTAL PARA TABLA urls
$v['where']['id']=					    '1'; 
$v['where']['site']=					"cursodecursos.com";



$v['path']['bin']=$v['path']['repo'] .	"/SF_20121104";
$v['path']['fw']=$v['path']['repo'] .	"/FrameW_1";
$v['path']['img']=$v['path']['repo'] .	"/SeekFormacion_images";

$v['path']['baseURLskin'][1]=""; ## baseURL del SKIN local
$v['path']['baseURLskin'][2]="http://s3-eu-west-1.amazonaws.com/seekf"; ## baseURL del SKIN en CLOUD







include('funcSitemaps.php');  
require_once $v['path']['fw'] . '/core/templates/paths.php';

includeINIT('vars');
includeINIT('provins');
includeINIT('config');
includeCORE('db/dbfuncs');
includeCORE('templates/templates');
includeCORE('funcs/general');
includeCORE('mail/mail');




$hechos1=DBselectSDB("SELECT max(id_boletin) as ulti FROM envios WHERE (
 email like '%@yahoo.com' 
OR email like '%@yahoo.es' 
OR email like '%@gmail.com' 
OR email like '%@terra.es'
OR email like '%@wanadoo.es'
OR email like '%@ono.com'
);",'SeekforFB');
if(array_key_exists(1, $hechos1)){$ulti1=$hechos1[1]['ulti'];};
if(!$ulti1){$ulti1=1;}

$hechos2=DBselectSDB("SELECT max(id_boletin) as ulti FROM envios WHERE (
   email like '%@hotmail.com' 
OR email like '%@msn.com'
OR email like '%@hotmail.es'
);",'SeekforFB');
if(array_key_exists(1, $hechos2)){$ulti2=$hechos2[1]['ulti'];};
if(!$ulti2){$ulti2=1;}






include('/www/db-2.php');

$nuevos1=DBselect("
select * from boletines where bol_provincia NOT IN (28,08) AND bol_fechanacimiento > 19830000 
AND (
bol_email like '%@yahoo.com' 
OR bol_email like '%@yahoo.es' 
OR bol_email like '%@gmail.com' 
OR bol_email like '%@terra.es'
OR bol_email like '%@wanadoo.es'
OR bol_email like '%@ono.com'
) AND id_boletin > $ulti1 ORDER BY id_boletin LIMIT 10;
");




$nuevos2=DBselect("
select * from boletines where bol_provincia NOT IN (28,08) AND bol_fechanacimiento > 19830000 
AND (bol_email like '%@hotmail.com' 
OR bol_email like '%@msn.com'
OR bol_email like '%@hotmail.es'
) AND id_boletin > $ulti2 ORDER BY id_boletin LIMIT 10;
");


//$nuevos = array_merge($nuevos1, $nuevos2);
$nuevos = $nuevos1;

//vuelvo a cargar default
include('/www/db-1.php');

$asuntos[]="Hazte fan y gana un IPhone 5";
$asuntos[]="Llévate un IPhone 5 concursando en Facebook";
$asuntos[]="Síguenos en Facebook y consigue un IPhone 5";

$m=1;

global $valuesi;

$nuevos=array();
$nuevos[1]['id_boletin']="9999";
$nuevos[1]['bol_sexo']="1";
$nuevos[1]['bol_nombre']="Eduardo";
$nuevos[1]['bol_apellidos']="Buenadicha";
$nuevos[1]['bol_email']="e_b_moya@hotmail.com";

foreach ($nuevos as $key => $valuesi) {
$id=$valuesi['id_boletin'];	
$sexo=$valuesi['bol_sexo'];
$nombre=$valuesi['bol_nombre'] . " " . $valuesi['bol_apellidos'];
$email=$valuesi['bol_email'];		

$tot=count($asuntos) - 1; $a=rand(0, $tot); ### asunto aleatorio


$from="concurso@publiactive.net";
$fromN="Concurso Apple";


$subject=$asuntos[$a];

$valuesi['a']=$a; $valuesi['m']=$m; 
$message=loadChild('mails',"promo_apple_$m");
$plain=strip_tags($message);
//$message="hola caracola";

// ----  DBUpInsSDB("INSERT INTO envios (id_boletin,nombre,email,mail,asunto) VALUES ($id,'$nombre','$email',$m,$a);",'SeekforFB');	

//$email="e.b.moya@gmail.com";
//$nombre="Eduardo Buenadicha";
//$email="mno.perezz@hotmail.com";
//$nombre="Mariano Perez";
$to=$email;
$toN=$nombre;

/*
if(sendM($from,$fromN,$to,$toN,$subject,$message,$plain,'mail2.php')){
// ---   DBUpInsSDB("UPDATE envios SET enviado=1 WHERE id_boletin=$id",'SeekforFB');		
};	
*/


print_r(verifyEmail($to));
echo "\n" . sendM($from,$fromN,$to,$toN,$subject,$message,$plain,'mail2.php') . "\n -------- \n";

}





?>