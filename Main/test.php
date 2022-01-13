<?php
/*
require_once '../Main/Opérations.php';
require_once '../Main/database.php';

$reponse= array();
            if (isset($_POST['nom'])
                and isset($_POST['lieu'])
                and isset($_POST['DateDedebut'])
                and isset($_POST['Description'])
                and isset($_POST['photo'])
            ){

                $items= new Operations();
                if($items->CreateEvent($_POST['nom'],$_POST['lieu'],$_POST['DateDedebut'],$_POST['Description'],$_POST['photo'])){
                    $reponse['error']=false;
                    $reponse['message']="Un evenement a bien ete ajoute ! ";
                }else{
                    $reponse['error']=true;
                    $reponse['message']="l evenement n a pas pu etre ajoute il y a peut etre une erreur ";
                }
            }else{
                $reponse['error']=true;
                $reponse['message']="Veuillez bien entrer le nom, le lieu , la date, la description et la photo sinon ca ne marchera pas ";
            }


echo json_encode($reponse);
*/
/*
require_once '../Main/Opérations.php';
require_once '../Main/database.php';
$reponse= array();

$database= new connection();
$db= $database->connecter();
$token= new Operations();
$token->CreateEvent($_POST['nom'],$_POST['lieu'],$_POST['DateDedebut'],$_POST['Description'],$_POST['photo']);
*/
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

header('Access-Control-Allow-Origin: *');
header('content-type: application/json; charset=UTF-8');
require_once '../Main/database.php';
require_once '../Main/Opérations.php';

$database=new connection();
$db=$database->connecter();
$items= new Operations();
$stmt= $items->read();
if($stmt){
    $items->read();



}
else{
    http_response_code(400);
    echo json_encode(
        array("message"=>"Votre token n est pas correct")
    );
}




