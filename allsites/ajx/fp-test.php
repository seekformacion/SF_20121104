hola esto es una prueba
<br>
<?php


echo time();


print_r($_GET);
?>
<br>
<br>
<?php
print_r($_POST);

require '/www/repositorios/facebook-php-sdk/src/facebook.php';

$app_id = "622071311181276";
$app_secret = "24c6ad4ef66b34ec0fd74021bfd0fb5a";
$facebook = new Facebook(array(
'appId' => $app_id,
'secret' => $app_secret,
'cookie' => true
));
$signed_request = $facebook->getSignedRequest();
$like_status = $signed_request["page"]["liked"];

if ($like_status) {

echo "<br>
UNOOOOO
<br>";	
	
}else{

echo "<br>
DOSSSS
<br>";	
	
}

?>


