<?php
/**
 * @OA\SecurityScheme(
 *     type="http",
 *     name="Authorization",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="bearerAuth",
 * )
 * seucrity={{"bearerAuth":{} }}
 */


require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

header('Access-Control-Allow-Origin: *');
header('content-type: application/json; charset=UTF-8');


class Operations
{

    private $connection;
    private $key = "macleprivee!";

    public function __construct()
    {
        require_once dirname(__FILE__) . '/database.php';
        $db = new connection();
        $this->connection = $db->connecter();
    }
//-------------------------------------------------------------------------------------------------------------
    /* Mise en place des méthodes CRUD Pour les évènements ci-dessous
    Create
    Read
    Update
    Delete
    */
    //Ajout de la fonction permettant d'ajouter des évènements dans la base de données
    function CreateEvent($nom, $lieu, $dateDeDebut, $Description, $photo)
    {

        $etat = $this->connection->prepare("INSERT INTO `evenement` (`id`, `nom`, `lieu`, `datedebut`, `Description`,`photo`) VALUES (NULL,?,?,?,?,?);");
        $etat->bind_param("sssss", $nom, $lieu, $dateDeDebut, $Description, $photo);
        if ($etat->execute()) {
            return true;
        } else {
            return false;
        }


    }
//-------------------------------------------------------------------------------------------------------------
    //Ajout de la fonction permettant de supprimer des évènements
    function DeleteEvent($id)
    {
        $etat = $this->connection->prepare("DELETE FROM `evenement` WHERE `evenement`.`id` = ?");
        $etat->bind_param("i", $id);
        if ($etat->execute()) {
            return true;
        } else {
            return false;
        }
    }
//-------------------------------------------------------------------------------------------------------------
    //Ajout de la fonction permettant de Modifier des évènements
    function UpdateEvent($id, $nom, $lieu, $DateDedebut, $Description, $photo)
    {
        $etat = $this->connection->prepare("UPDATE `evenement` SET `nom` = ?, `lieu` = ?, `datedebut` = ?, `Description` = ?,`photo`=? WHERE `evenement`.`id` = ?;");
        $etat->bind_param("sssssi", $nom, $lieu, $DateDedebut, $Description, $photo, $id);
        if ($etat->execute()) {
            return true;
        } else {
            return false;
        }
    }
//-------------------------------------------------------------------------------------------------------------
    //fonction ajoutant un artiste
    function AddArtiste($nom, $prenom, $nomArtiste, $age, $sexe, $style,$photo)
    {

        $etat = $this->connection->prepare("INSERT INTO `artiste` ( `nom`, `prenom`, `nomArtiste`, `age`, `sexe`, `style`,`photo`) VALUES (?,?,?,?,?,?,?);");
        $etat->bind_param("sssisss", $nom, $prenom, $nomArtiste, $age, $sexe, $style,$photo);
        if ($etat->execute()) {
            return true;
        } else {
            return false;
        }

    }
//-------------------------------------------------------------------------------------------------------------
    //fonction permettant la modification d'un artitse
    function UpdateArtiste($id, $nom, $prenom, $nomArtiste, $age, $sexe, $style,$photo)
    {
        $etat = $this->connection->prepare("UPDATE `artiste` SET `nom` = ?, `prenom` = ?, `nomArtiste` = ?, `age` = ?, `sexe` = ?, `style` = ?,`photo`=? WHERE `artiste`.`id` = ?;");
        $etat->bind_param("sssisssi", $nom, $prenom, $nomArtiste, $age, $sexe, $style,$photo, $id);
        if ($etat->execute()) {
            return true;
        } else {
            return false;
        }
    }
//-------------------------------------------------------------------------------------------------------------
    function DeleteArtiste($id)
    {
        $etat = $this->connection->prepare("DELETE FROM `artiste` WHERE `artiste`.`id` = ?");
        $etat->bind_param("i", $id);
        if ($etat->execute()) {
            return true;
        } else {
            return false;
        }

    }
//-------------------------------------------------------------------------------------------------------------
    function AddUser($name,$firstanme,$password)
    {

        $etat = $this->connection->prepare("INSERT INTO `user` (`id`, `Name`, `Firstname`,`Password`) VALUES (NULL,?,?,?);");
        $etat->bind_param("sss", $name,$firstanme,$password);
        if ($etat->execute()) {
            return true;
        } else {
            return false;
        }


    }
//-------------------------------------------------------------------------------------------------------------
    function UpdateUser($id,$name,$firstanme,$password)
    {

        $etat = $this->connection->prepare("UPDATE `user` SET `Name`=?,`Firstname`=?,`Password`= ? where `user`.id=?");
        $etat->bind_param("sssi", $name,$firstanme,$password,$id);
        if ($etat->execute()) {
            return true;
        } else {
            return false;
        }


    }
//-------------------------------------------------------------------------------------------------------------
    function DeleteUser($id)
    {

        $etat = $this->connection->prepare("DELETE from `user` where `user`.id=?");
        $etat->bind_param("i", $id);
        if ($etat->execute()) {
            return true;
        } else {
            return false;
        }


    }
//-------------------------------------------------------------------------------------------------------------
//Génération du token
    function auth()
    {
        $iat = time();
        $exp = $iat + 60 * 60;
        $payload = array(
            'iss' => 'http://localhost/xampp/GestionFest/',
            'aud' => 'http://localhost/xampp/GestionFest/',
            'iat' => $iat,
            'exp' => $exp

        );
        $jwt = JWT::encode($payload, $this->key, 'HS512');
        return array(
            'Token' => $jwt,
            'Expiration' => $exp
        );
    }

    function read()
    {
        $headers = apache_request_headers();
        if (isset($headers['Auhtorization'])) {
            $token = str_replace('Bearer', '', $headers['Authorization']);
            try {

                $token = JWT::decode($token, $this->key, array('HS512'));
                $etat = $this->connection->prepare("INSERT INTO `evenement` (`id`, `nom`, `lieu`, `datedebut`, `Description`,`photo`) VALUES (NULL,?,?,?,?,?);");
                $etat->bind_param("sssss", $nom, $lieu, $dateDeDebut, $Description, $photo);
                return $etat;
            } catch (\Exception $e) {

                return false;
            }
        } else {
            return false;
        }
    }
}

//---------------------------------------------------------------------------------

