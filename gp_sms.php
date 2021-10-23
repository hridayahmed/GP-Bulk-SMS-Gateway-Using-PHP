<?php
session_start();

$error_msg = "";

$phone_number = '01744-666950';
$plane_message = 'Hello I am Hriday Ahmed. GP Bulk SMS gateway.';


$url = "https://gpcmp.grameenphone.com/ecmapigw/webresources/ecmapigw.v2";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


echo $data = <<<DATA
{
    "username": "Your Username",
    "password": "Your Password",
    "apicode": "1",
    "msisdn": "$phone_number",
    "countrycode": "880",
    "cli": "Your Provide CLI",
    "messagetype": "1",
    "message": "$plane_message",
    "messageid": "0"
}
DATA;

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
//var_dump($resp);

$obj = json_decode($resp);

echo $obj->statusCode;
echo $obj->message;

$obj->disconnection();
?>
