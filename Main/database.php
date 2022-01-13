<?php

class connection{
    private $con;

    public function __construct()
    {
    }

    public function connecter(){
        include_once dirname(__FILE__).'/Constantes.php';
        $this->con = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if (mysqli_connect_errno()){
            echo 'Echec de la connection à la base de données'.mysqli_connect_error();
        }
        return $this->con;
    }
}
