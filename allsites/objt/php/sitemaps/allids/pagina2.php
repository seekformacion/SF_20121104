<?php

$homes[1]=1;
$homes[1183]=1;
$homes[2365]=1;
$homes[3547]=1;

$idp=$v['where']['idp'];
$ruta= $v['path']['httpd'];
$port=$v['vars']['purl'][$idp]; 
$port=str_replace('http://', '', $port); $ruta=str_replace('cursodecursos.com', $port, $ruta);

//echo $ruta;

$SiteTXT="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n\n";



$res=DBselect("SELECT * FROM util_sitemap WHERE idp=$idp AND done=0;");
if(array_key_exists(1, $res)){ foreach ($res as $key => $value) {
$id=$value['id']; $idc=$value['t_id']; $url=$value['url']; $pri=$value['prior']; $date=$value['date']; $chksum=$value['chksum'];

$date2=substr($date, 0,4) . "-" . substr($date, 4,2) .  "-" . substr($date, 6,2);$dateV2=$date2;
if(array_key_exists($idc, $homes)){$freq="monthly";}else{$freq="weekly";};

$pri=($pri/10);	if($pri==1){$pri="1.0";};	
		
$content = file_get_contents($url);

if ($content !== false) {

$chk2=0;	
$cks=md5($content);	
echo $url . " -> " . $cks . "\n";

$res=DBselect("SELECT chksum, date FROM util_sitemap WHERE url='$url' AND done=1 ORDER BY date DESC limit 1;");
if(array_key_exists(1, $res)){$chk2=$res[1]['chksum']; $dateV=$res[1]['date']; $dateV2=substr($dateV, 0,4) . "-" . substr($dateV, 4,2) .  "-" . substr($dateV, 6,2); };
if($cks == $chk2){$date2=$dateV2;}

$dateU=str_replace('-','', $date2);
$res=DBUpIns("UPDATE util_sitemap SET chksum='$cks', done=1 WHERE id='$id';");	


} else {
     //An error occurred
}
	
	
	



	
$SiteTXT .="<url>\n<loc>$url</loc>\n<lastmod>$date2</lastmod>\n<changefreq>$freq</changefreq>\n<priority>$pri</priority>\n</url>\n\n";

	 	 
}}

$SiteTXT.="</urlset>\n";

$myFile = $ruta . "/sitemap.xml";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = $SiteTXT;
fwrite($fh, $stringData);
fclose($fh);
?>

