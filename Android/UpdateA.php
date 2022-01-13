<?php
$connection=mysqli_connect('localhost','root','','gestfest');

$id=$_GET['id'];
$nom=$_GET['nom'];
$prenom=$_GET['prenom'];
$nomArtiste=$_GET['nomArtiste'];
$age=$_GET['age'];
$sexe=$_GET['sexe'];
$style=$_GET['style'];
$photo=$_GET['photo'];

$sql1= "UPDATE `artiste` SET `nom` = '$nom', `prenom` = '$prenom', `nomArtiste` = '$nomArtiste', `age` = '$age',`sexe` = '$sexe',`style` = '$style',`photo`='$photo'  WHERE `artiste`.`id` = '$id'";
$result=mysqli_query($connection,$sql1);
if(mysqli_query($connection, $sql1))
{
    echo "Artiste modifie :)!";
}
else
{
    echo mysqli_error($connection);
}

mysqli_close($connection);
?>