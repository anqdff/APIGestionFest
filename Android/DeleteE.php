<?php
$connection=mysqli_connect('localhost','root','','gestfest');
//$id=$_POST['id'];
$id=$_GET['id'];
$sql1= "DELETE FROM `evenement` WHERE `evenement`.`id` = '$id'";
$result=mysqli_query($connection,$sql1);
if(mysqli_query($connection, $sql1))
{
    echo "L evenement a été suprimé !";
}
else
{
    echo mysqli_error($connection);
}

mysqli_close($connection);
?>