<?php
$con=mysqli_connect('localhost','root','','gestfest');
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$nomArtiste=$_POST['nomArtiste'];
$age=$_POST['age'];
$sexe=$_POST['sexe'];
$style=$_POST['style'];
$photo=$_POST['photo'];
$sql="INSERT INTO `artiste` (`id`, `nom`, `prenom`, `nomArtiste`, `age`,`sexe`,`style`,`photo`) VALUES (Null,'$nom','$prenom','$nomArtiste','$age','$sexe','$style','$photo')";
$result=mysqli_query($con,$sql);