<?php
header("content-type: application/json"); 






function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
	
	if(strpos($ip,'92.168.1')>0){$ip="37.11.40.103";};
	if($ip=="127.0.0.1"){$ip="37.11.40.103";};
    return $ip;
}




function geo_ip($ipaddress)
{
global $v;

$cp="";$cordenadas="";
$rest=DBselect("select country, postalCode, latitude, longitude FROM location WHERE locId = (SELECT locId FROM blocks WHERE INET_ATON('$ipaddress') >= startIpNum  AND INET_ATON('$ipaddress') <= endIpNum); ");
if(count($rest)>0){
$cp=$rest[1]['postalCode']; $ct=$rest[1]['country'];
$cordenadas=$rest[1]['latitude'] . "," . $rest[1]['longitude'];		
}


echo $cordenadas;

$exludecords['40,-4']=1;









$res['ct']=$ct;
$res['cp']=$cp;
return $res;
	
}







foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};

$v['where']['view']='categorias';
$v['where']['id']=1; 
require_once ('iniAJX.php');

$cp="";$ct="";
$res=DBselect("SELECT cp, ct FROM skv_user_sessions WHERE seekforID='$uid';");
if(count($res)>0){
$cp=$res[1]['cp']; $ct=$res[1]['ct'];	
}

if(!$cp){
$ip=getRealIpAddr();

if(($ip=="2.139.164.215")||($ip=="88.26.254.6")||($ip=="83.61.73.130")){
$res['cp']="00";
$res['ct']="00";
}else{
$res= geo_ip($ip);
}
	

if (isset($_COOKIE["seekforReferal"])){
$ante= $_COOKIE["seekforReferal"];
}else{$ante="";}

$cp=$res['cp'];
$ct=$res['ct']; $val['ins']=1; $dest=$_SERVER['HTTP_REFERER'];
$res=DBUpIns("UPDATE skv_user_sessions SET cp='$cp', ct='$ct', referer='$ante', destino='$dest' WHERE seekforID='$uid';");	
}



if (isset($_GET['id'])) $rtnjsonobj->id = $_GET['id'];
$rtnjsonobj->message = $cp;
echo $_GET['callback']. '('. json_encode($rtnjsonobj) . ')';  


?>