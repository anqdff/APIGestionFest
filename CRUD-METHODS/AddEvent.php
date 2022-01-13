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
    if (isset($_POST['nom'])
        and isset($_POST['lieu'])
        and isset($_POST['DateDedebut'])
        and isset($_POST['Description'])
        and isset($_POST['photo'])
    ){
        $db= new Operations();
        if($db->CreateEvent($_POST['nom'],$_POST['lieu'],$_POST['DateDedebut'],$_POST['Description'],$_POST['photo'])){
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
