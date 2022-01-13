<?php

$con=mysqli_connect('localhost','root','','gestfest');
$nom=$_POST['nom'];
$lieu=$_POST['lieu'];
$date=$_POST['datedebut'];
$description=$_POST['Description'];
$photo=$_POST['photo'];
$sql="INSERT INTO `evenement` (`id`, `nom`, `lieu`, `datedebut`, `Description`,`photo`) VALUES (Null,'$nom','$lieu','$date','$description','$photo')";
$result=mysqli_query($con,$sql);
