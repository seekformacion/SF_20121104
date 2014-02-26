<?php
foreach($_GET as $nombre_campo => $valor){  $asignacion = "\$" . $nombre_campo . "='" . $valor . "';";   eval($asignacion);};
######### add boton   https://www.facebook.com/dialog/pagetab?api_key=715730281795141&next=https%3A%2F%2Fwww.facebook.com%2F
########## params https://www.facebook.com/cursodecursos?v=app_715730281795141&app_data=jajajajaj



$v['where']['view']='categorias';
$v['where']['id']=1; 
require_once ('iniAJX.php');




$v['conf']['host']="thegoprofamily.com";
$v['conf']['db']="laiislac_boletines";
$v['conf']['usr']="laiislac";
$v['conf']['pass']="ideosites2009";



$bol_email="";
$inf=DBselect("select id_boletin, bol_email FROM boletines WHERE fb_done=0 AND (bol_email like '%hotmail.%' OR bol_email like '%gmail.%' OR bol_email like '%yahoo.%')  limit 1;");	
if(count($inf)>0){$bol_email=$inf[1]['bol_email'];$id_boletin=$inf[1]['id_boletin'];};




if($bol_email){
$bol_email=str_replace("@", '%40', $bol_email);


$url="http://www.facebook.com/search/results.php?q=$bol_email";


echo $url . "<br>";
$dat= get_web_page($url);

$chk=0;
if(isset($dat['content'])){
$content=$dat['content'];
$content=str_replace("\n", '||', $content);
$lineas=explode("||", $content);


print_r($lineas);
foreach ($lineas as $key => $value) {if(strlen($value) > strlen(str_replace('adir a mis amigos','',$value))){
$chk++;	
//echo $key . " ---- >" . $value . "\n";		

}}


if(!$chk){echo "no existe";$ee=0;}else{echo "existe";$ee=1;}	
$res=DBUpIns("UPDATE boletines SET fb_done=1, fb_exist=$ee WHERE id_boletin=$id_boletin;");	
}

}



function get_web_page( $url, $cookiesIn = 'datr=NvwMU0bgjVLuMYGj6AgAQHEW; fr=0O9VRS92Chb43Igbe.AWWKUFOiDnSMz9HAAQP9bJxohVw.BTDPxH.a3.AAA.AWWHloNJ; lu=RhGSpf2CpmitwnN6Qo_ukouw; locale=es_ES; xs=150%3Awtt9eekTXwMICQ%3A2%3A1393360600%3A3691; s=Aa7OnYi0NZJ5zHNr.BTDP7Y; csm=2; c_user=100007780393344; p=174; presence=EM393360883EuserFA21B07780393344A2EstateFDsb2F0Et2F_5b_5dElm2FnullEuct2F139336BB0EtrFnullEtwF2852263233EatF1393360882893G393360883371CEchFDp_5f1B07780393344F1CC; act=1393360894637%2F11; wd=1280x367' )
{
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => true,     //return headers in addition to content
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLINFO_HEADER_OUT    => true,
            CURLOPT_SSL_VERIFYPEER => false,     // Disabled SSL Cert checks
           // CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_USERAGENT 	=> 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5',
            CURLOPT_COOKIE         => $cookiesIn
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $rough_content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header_content = substr($rough_content, 0, $header['header_size']);
        $body_content = trim(str_replace($header_content, '', $rough_content));
        $pattern = "#Set-Cookie:\\s+(?<cookie>[^=]+=[^;]+)#m"; 
        preg_match_all($pattern, $header_content, $matches); 
        $cookiesOut = implode("; ", $matches['cookie']);

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['headers']  = $header_content;
        $header['content'] = $body_content;
        $header['cookies'] = $cookiesOut;
    return $header;
}




sleep(60);

?>

<script type="text/javascript">

top.location.href = "http://cursodecursos.com/ajx/chkmails.php";

</script>

