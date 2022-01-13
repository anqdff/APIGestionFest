<?php

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
            if (isset($_POST['Name'])
                and isset($_POST['Firstname'])
                and isset($_POST['Password'])


            ){
                $db= new Operations();
                if($db->AddUser($_POST['Name'],$_POST['Firstname'],$_POST['Password'])){
                    $reponse['error']=false;
                    $reponse['message']="Un utilisateur a bien ete ajoute ! ";
                }else{
                    $reponse['error']=true;
                    $reponse['message']="l utilisateur n a pas pu etre ajoute il y a peut etre une erreur ";
                }
            }else{
                $reponse['error']=true;
                $reponse['message']="Veuillez bien entrer les infos(Name,Firstname,Password) sinon ca ne marchera pas ";
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
