<?php
$connection=mysqli_connect('localhost','root','','gestfest');

$id=$_GET['id'];
$nom=$_GET['nom'];
$datedebut=$_GET['datedebut'];
$lieu=$_GET['lieu'];
$Description=$_GET['Description'];
$photo=$_GET['photo'];

$sql1= "UPDATE `evenement` SET `nom` = '$nom', `lieu` = '$lieu', `datedebut` = '$datedebut', `Description` = '$Description',`photo`='$photo'  WHERE `evenement`.`id` = '$id'";
$result=mysqli_query($connection,$sql1);
if(mysqli_query($connection, $sql1))
{
    echo "Modification réussie :)!";
}
else
{
    echo mysqli_error($connection);
}

mysqli_close($connection);
?>