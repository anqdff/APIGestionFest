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
            if (isset($_POST['id'])
                and isset($_POST['nom'])
                and isset($_POST['prenom'])
                and isset($_POST['nomArtiste'])
                and isset($_POST['age'])
                and isset($_POST['sexe'])
                and isset($_POST['style'])
                and isset($_POST['photo'])

            ){
                $db= new Operations();
                if($db->UpdateArtiste($_POST['id'],$_POST['nom'],$_POST['prenom'],$_POST['nomArtiste'],$_POST['age'],$_POST['sexe'],$_POST['style'],$_POST['photo'])){
                    $reponse['error']=false;
                    $reponse['message']="Un artiste a bien ete modifie ! ";
                }else{
                    $reponse['error']=true;
                    $reponse['message']="l artiste n a pas pu etre modifie il y a peut etre une erreur ";
                }
            }else{
                $reponse['error']=true;
                $reponse['message']="Veuillez bien entrer les infos (id,nom,prenom,nomArtiste,age,sexe,style,et photo) sinon ca ne marchera pas ";
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
