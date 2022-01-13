<?php

require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

header('Acess-Control-Allow-Origin: *');
header('Content-Type: Appliction/json; charset=UTF-8');
require_once '../Main/Opérations.php';
require_once '../Main/database.php';
$reponse= array();

$database= new connection();
$db= $database->connecter();
$token= new Operations();
if ($token->auth()){
http_response_code(200);
echo json_encode($token->auth());

}













echo json_encode($reponse);
