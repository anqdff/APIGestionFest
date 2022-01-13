<?php

use Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once  '../vendor/autoload.php';
require_once '../Main/Opérations.php';
$reponse= array();

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!isset($_SERVER['PHP_AUTH_USER'])){

        header("WWW-Authenticate: Basic realm=\"Private Area\"");
        header("HTTP/1.04 401 Unauthorized");
        print "vous n avez pas les droits de faire cette action, connectez vous en tant qu admin";
        exit;


    }else{
        if(($_SERVER['PHP_AUTH_USER']=="Admin") && ($_SERVER["PHP_AUTH_PW"]=="PassAdmin")){
            print "Welcome admin ! , vous etes autorise a faire les actions CRUD \n";

            $secret_key = "KeyAdmin";
            $issuer_claim = "THE_ISSUER"; // this can be the servername
            $audience_claim = "THE_AUDIENCE";
            $issuedat_claim = time(); // issued at
            $notbefore_claim = $issuedat_claim + 10; //not before in seconds
            $expire_claim = $issuedat_claim + 60;

            $token= array(
                "data"=>array(
                    "iss" => $issuer_claim,
                    "iat" => $issuedat_claim,
                    "nbf" => $notbefore_claim,
                    "exp" => $expire_claim,
                    "username"=>"Admin"
                )
            );
            http_response_code(200);
            $jwt = JWT::encode($token, $secret_key);
            echo json_encode(
                array(
                    "message" => "Authentification JWT Json Web Token reussi, Welcome Admin ",
                    "jwt" => $jwt,
                    "Username" => $_SERVER['PHP_AUTH_USER']

                ));




            if (isset($_POST['id'])
            ){
                $db= new Operations();
                if($db->DeleteArtiste($_POST['id'])){
                    $reponse['error']=false;
                    $reponse['message']="Un artiste a bien ete supprime ! ";
                }else{
                    $reponse['error']=true;
                    $reponse['message']="l artiste n a pas pu etre suprime il y a peut etre une erreur ";
                }
            }else{
                $reponse['error']=true;
                $reponse['message']="Veuillez bien entrer l id sinon ca ne marchera pas ";
            }
        }else{
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.04 401 Unauthorized");
            print "vous n avez pas les droits de faire cette action, connectez vous en tant qu admin";
            exit;
        }

    }

}else{
    $reponse['error']=true;
    $reponse['message']='Requete non valide ';
}
echo json_encode($reponse);
